#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 10.02.2016
 * Time: 20:14
 */

require_once(dirname(__FILE__).'/../public_html/classes/model.php');
require_once('src/WebSocketServer.php');
require_once('MatchmakingLobby.php');
// php -q htdocs/Orcus/server/MatchmakingServer.php
// BIG FAT TODO: CHANGE ARRAYS TO IDs AND FOREACH!!!!! (maybe)

class MatchmakingServer extends WebSocketServer {
    protected $lobbies = array();

    /**
     * Handles the arriving data
     *
     * @param $user user sending the message
     * @param $message received message
     */
    protected function process($user, $message) {
        // Splits every message into parts
        $part = explode("|", $message);

        $this->stdout($message);

        switch ($part[0]) {
            /**
             * Sets the session ID for a user
             * [1] Session ID
             */
            case 'SESSIONID_SET':
                $user->session_id = $part[1];
                $this->send($user, 'S|SESSIONID_SET');
                break;

            /**
             * Creates a new lobby
             * [1] Game
             * [2] Teamsize
             */
            case 'LOBBY_CREATE':
                $lobby = new MatchmakingLobby($part[1], $part[2], $user);
                $this->lobbies[] = $lobby;

                // Get the last added lobby key
                end($this->lobbies);
                $lastkey = key($this->lobbies);
                reset($this->lobbies);

                // Adds lobby entry to user
                $user->lobby_id = $lastkey;

                $this->stdout("Lobby created with ID ".$lastkey." (" . $part[1] . ", " . $part[2] . ")");
                break;

            /**
             * Joins a lobby
             * [1] Lobby ID
             */
            case 'LOBBY_JOIN':
                $lobby = $this->lobbies[$part[1]];
                if ($lobby->teamsize*2 > $lobby->getUserCount()) {
                    // Inform other lobby users
                    $all = $lobby->getUsers();
                    for ($i = 0; $i < count($all); $i++) {
                        if ($lobby->type == 'lobby') {
                            $this->send($all[$i], 'N|LOBBY_JOINED|' . $user->session_id);
                        } else if ($lobby->type == 'squad') {
                            // Prepare JSON
                            $jsonUser = Model::getUser($user->session_id, 'id, username'); // TODO: add picture
                            $json = json_encode($jsonUser);

                            $this->send($all[$i], 'N|SQUAD_JOINED|' . $json);
                        }
                    }

                    // Join lobby
                    $lobby->joinUser($user);
                    if ($lobby->type == 'lobby') {
                        $this->send($user, 'S|LOBBY_JOIN');
                        $user->lobby_id = $part[1];
                    } else if ($lobby->type == 'squad') {
                        $squadowner = $lobby->getOwner();
                        // Prepare JSON
                        $jsonSquad = array();
                        foreach ($lobby->getUsers() as $key => $value) {
                            $jsonSquad[] = Model::getUser($value->session_id, 'id, username'); // TODO: add picture
                            end($jsonSquad);
                            $lastkey = key($jsonSquad);
                            reset($jsonSquad);
                            if ($value == $squadowner) {
                                $jsonSquad[$lastkey]['owner'] = true;
                            } else {
                                $jsonSquad[$lastkey]['owner'] = false;
                            }
                        }
                        $json = json_encode($jsonSquad);

                        $this->send($user, 'S|SQUAD_JOIN|' . $json);
                        $user->squad_id = $part[1];
                    }
                } else {
                    // Lobby full
                    if ($lobby->type == 'lobby') {
                        $this->send($user, 'E|LOBBY_FULL');
                    } else if ($lobby->type == 'squad') {
                        $this->send($user, 'E|SQUAD_FULL');
                    }
                }
                break;

            /**
             * Creates a squad
             * [1] Game
             */
            case 'SQUAD_CREATE':
                $lobby = new MatchmakingLobby($part[1], 5, $user, 'squad');
                $this->lobbies[] = $lobby;

                // Get the last added lobby key
                end($this->lobbies);
                $lastkey = key($this->lobbies);
                reset($this->lobbies);

                // Adds lobby entry to user
                $user->squad_id = $lastkey;

                $this->stdout("Squad created with ID ".$lastkey." (".$part[1].")");
                break;

            /**
             * Searches for an open squad
             * [1] Game
             */
            case 'SQUAD_SEARCH':
                foreach ($this->lobbies as $key => $value) {
                    $l = $this->lobbies[$key];
                    if ($l->type == 'squad' && $l->open && $key != $user->squad_id) {
                        // Lobby is a squad and open and not the original squad
                        if ($l->getUserCount() < $l->teamsize) {
                            // Squad is open
                            if ($l->game == $part[1]) {
                                // Game is correct
                                // Everything is right -> join lobby
                                $this->removeUser($user, 'squad');
                                $this->process($user, 'LOBBY_JOIN|' . $key);
                                break;
                            }
                        }
                    }
                }
                break;

            /**
             * Joins a squad into a lobby
             * [1] Lobby ID
             */
            case 'SQUAD_MERGE':
                // Get squad owner
                foreach ($this->lobbies as $key => $value) {
                    $squad = $this->lobbies[$key];
                    if ($squad->owner == $user && $squad->type == 'squad') {
                        // Found Squad
                        $lobby = $this->lobbies[$part[1]];
                        if ($squad->getUserCount() <= $lobby->teamsize) { // Squad has the right size
                            if ($squad->getUserCount() <= ($lobby->teamsize - count($lobby->team1))) {
                                // Join team 1
                                foreach($squad->getUsers() as $key => $value) {
                                    $this->process($value, 'LOBBY_JOIN|' . $part[1]);
                                }
                            } else if ($squad->getUserCount() <= ($lobby->teamsize - count($lobby->team2))) {
                                // Join team 2
                                foreach($squad->getUsers() as $key => $value) {
                                    $this->process($value, 'LOBBY_JOIN|' . $part[1]);
                                }
                            } else {
                                // No space in lobby
                                $this->send($user, 'E|LOBBY_NOSPACE');
                            }
                        }

                        break;
                    }
                }
                break;

            /**
             * Changes the lock state of a squad
             * [1] State (True = Open, False = Closed)
             */
            case 'SQUAD_LOCK_CHANGE':
                // Get user squad
                $squad = $this->lobbies[$user->squad_id];

                // Check if user is actually owner
                if ($user == $squad->owner) {
                    $squad->open = filter_var($part[1], FILTER_VALIDATE_BOOLEAN);
                }
                break;


            /**
             * Admin info stuff
             * Note: Does not actually work yet
             */
            case 'ADMIN_SHOW_USERS':
                for ($i = 0; $i < count($this->users); $i++) {
                    $this->stdout(print_r($this->users[$i]));
                }
                break;
        }
    }

    /**
     * Calls after the user connected
     *
     * @param $user user who connected
     */
    protected function connected($user) {
        // Connected
    }

    /**
     * Calls after the socket has been closed
     *
     * @param $user user which socket has been closed
     */
    protected function closed($user) {
        // Complete lobby cleanup
        // May be resource intensive so check it later
        foreach ($this->lobbies as $i => $value) {
            $u = $this->lobbies[$i]->getUsers();
            for ($j = 0; $j < count($u); $j++) {
                if ($u[$j] == $user) {
                    $o = $this->lobbies[$i]->getOwner();

                    // Clean up user
                    $this->lobbies[$i]->removeUser($user);

                    // Notify other users
                    for ($k = 0; $k < count($u); $k++) {
                        if ($o == $user) {
                            if ($this->lobbies[$i]->type == 'lobby') {
                                $this->send($u[$k], 'N|LOBBY_DISBAND');
                            } else if ($this->lobbies[$i]->type == 'squad') {
                                $this->send($u[$k], 'N|SQUAD_DISBAND');
                            }
                        } else {
                            if ($this->lobbies[$i]->type == 'lobby') {
                                $this->send($u[$k], 'N|LOBBY_LEFT|' . $user->session_id);
                            } else if ($this->lobbies[$i]->type == 'squad') {
                                // Prepare JSON
                                $jsonUser = Model::getUser($user->session_id, 'id, username'); // TODO: add picture
                                $json = json_encode($jsonUser);

                                $this->send($u[$k], 'N|SQUAD_LEFT|' . $json);
                            }
                        }
                    }

                    if ($o == $user) {
                        // Delete lobby
                        unset($this->lobbies[$i]);
                    }

                    break;
                }
            }
        }
    }

    /**
     * Removes a user from a lobby or disbands it. Not a replacement for full cleanup
     *
     * @param $user User user to remove
     * @param $lobby String remove from lobby or squad
     */
    protected function removeUser($user, $lobby = 'lobby')
    {
        $l = -1;

        // Removes the user from the lobby
        if ($lobby == 'lobby') {
            $l = $user->lobby_id;
            unset($user->lobby_id);
        } else if ($lobby == 'squad') {
            $l = $user->squad_id;
            unset($user->squad_id);
        }

        // Notifiy other users
        if (isset($l) && $l != -1) {
            $lo = $this->lobbies[$l];
            $o = $lo->getOwner();
            $u = $lo->getUsers();

            // Clean up user
            $lo->removeUser($user);

            foreach ($u as $i => $value) {
                if ($o == $user) {
                    if ($lo->type == 'lobby') {
                        $this->send($u[$i], 'N|LOBBY_DISBAND');
                    } else if ($lo->type == 'squad') {
                        $this->send($u[$i], 'N|SQUAD_DISBAND');
                    }
                } else {
                    if ($lo->type == 'lobby') {
                        $this->send($u[$i], 'N|LOBBY_LEFT|' . $user->session_id);
                    } else if ($lo->type == 'squad') {
                        $this->send($u[$i], 'N|SQUAD_LEFT|' . $user->session_id);
                    }
                }
            }
        }
    }
}

// Start server
$serverMM = new MatchmakingServer("0.0.0.0", "9000");
try {
    $serverMM->run();
}
catch (Exception $e) {
    $serverMM->stdout($e->getMessage());
}