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
        //$part = explode("|", $message);

        $this->stdout($message);

        // Decode JSON message
        $_prc = json_decode($message, true);

        switch ($_prc['code']) {

            /**
             * Sets the session ID for a WebSocket user. Required for everything to work.
             *
             * @argument Session ID
             */
            case 'SESSIONID_SET':
                $user->session_id = $_prc['args'][0];

                // Prepare User JSON
                $jsonUser = Model::getUser($user->session_id, 'id, username');

                // Prepare Master JSON
                $json = $this->prep("SUCCESS_SESSIONID_SET", $jsonUser);

                $this->send($user, $json);
                break;


            /**
             * Creates a new squad and sets the calling user as the owner.
             *
             * @argument Game
             */
            case 'SQUAD_CREATE':
                $lobby = new MatchmakingLobby($_prc['args'][0], 5, $user, 'squad');
                $this->lobbies[] = $lobby;

                // Get the last added lobby key
                end($this->lobbies);
                $lastkey = key($this->lobbies);
                reset($this->lobbies);

                // Adds lobby entry to user
                $user->squad_id = $lastkey;

                $this->stdout("Squad created with ID ".$lastkey." (".$_prc['args'][0].")");
                break;


            /**
             * Sends a chat message
             *
             * @argument Chat Lobby (ALL, SQUAD, PRIVATE)
             * @argument Message (LZ-String compressed)
             * @argument User to send to (only if arg0 is PRIVATE)
             */
            case 'CHAT_SEND_MESSAGE':
                switch ($_prc['args'][0]) {
                    // To all connected users
                    case 'ALL':
                        $jsonUser = Model::getUser($user->session_id, 'id, username'); // TODO: add picture

                        foreach ($this->users as $key => $value) {
                            // Dont send to original user
                            if ($value != $user) {
                                $json = $this->prep("NOTICE_CHAT_RECEIVE_MESSAGE", $_prc['args'][0], $_prc['args'][1], $jsonUser);
                                $this->send($value, $json);
                            }
                        }
                        break;

                    // To all users in squad
                    case 'SQUAD':

                        break;

                    // To another private user
                    case 'PRIVATE':

                        break;
                }
                break;
        }
    }

    /**
     * Prepares a statement for client communication. Takes infinite arguments for args
     * @param $code String Communication code
     * @return string JSON array
     */
    protected function prep($code) {
        $args = array();

        for ($i = 1; $i < func_num_args(); $i++) {
            $args[] = func_get_arg($i);
        }

        return json_encode(array("code" => $code, "args" => $args));
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
                                $this->send($u[$k], $this->prep("NOTICE_LOBBY_DISBAND"));
                            } else if ($this->lobbies[$i]->type == 'squad') {
                                $this->send($u[$k], $this->prep("NOTICE_SQUAD_DISBAND"));
                            }
                        } else {
                            if ($this->lobbies[$i]->type == 'lobby') {
                                $this->send($u[$k], $this->prep("NOTICE_LOBBY_LEFT", $user->session_id));
                            } else if ($this->lobbies[$i]->type == 'squad') {
                                $this->send($u[$k], $this->prep("NOTICE_SQUAD_LEFT", $user->session_id));
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

            // Clean up user
            $lo->removeUser($user);
            $u = $lo->getUsers();

            foreach ($u as $i => $value) {
                if ($o == $user) {
                    if ($lo->type == 'lobby') {
                        $this->send($u[$i], $this->prep("NOTICE_LOBBY_DISBAND"));
                    } else if ($lo->type == 'squad') {
                        $this->send($u[$i], $this->prep("NOTICE_SQUAD_DISBAND"));
                    }
                } else {
                    if ($lo->type == 'lobby') {
                        $this->send($u[$i], $this->prep("NOTICE_LOBBY_LEFT", $user->session_id));
                    } else if ($lo->type == 'squad') {
                        $this->send($u[$i], $this->prep("NOTICE_SQUAD_LEFT", $user->session_id));
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