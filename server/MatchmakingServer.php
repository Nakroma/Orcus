#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 10.02.2016
 * Time: 20:14
 */

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
                $this->stdout("Lobby created (" . $part[1] . ", " . $part[2] . ")");
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
                            $this->send($all[$i], 'N|SQUAD_JOINED|' . $user->session_id);
                        }
                    }

                    // Join lobby
                    $lobby->joinUser($user);
                    if ($lobby->type == 'lobby') {
                        $this->send($user, 'S|LOBBY_JOIN');
                    } else if ($lobby->type == 'squad') {
                        $this->send($user, 'S|SQUAD_JOIN');
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
                $this->stdout("Squad created (".$part[1].")");
                break;

            /**
             * Searches for an open squad
             * [1] Game
             */
            case 'SQUAD_SEARCH':
                foreach ($this->lobbies as $key => $value) {
                    $l = $this->lobbies[$key];
                    if ($l->type == 'squad' && $l->open) {
                        // Lobby is a squad and open
                        if ($l->getUserCount() < $l->teamsize) {
                            // Squad is open
                            if ($l->game == $part[1]) {
                                // Game is correct
                                // Everything is right -> join lobby
                                $this->process($user, 'LOBBY_JOIN|' . $key);
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
                                $this->send($u[$k], 'N|SQUAD_LEFT|' . $user->session_id);
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
}

// Start server
$serverMM = new MatchmakingServer("0.0.0.0", "9000");
try {
    $serverMM->run();
}
catch (Exception $e) {
    $serverMM->stdout($e->getMessage());
}