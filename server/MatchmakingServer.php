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
                        $this->send($all[$i], 'N|LOBBY_JOINED|' . $user->session_id);
                    }

                    // Join lobby
                    $lobby->joinUser($user);
                    $this->send($user, 'S|LOBBY_JOIN');
                } else {
                    // Lobby full
                    $this->send($user, 'E|LOBBY_FULL');
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
        for ($i = 0; $i < count($this->lobbies); $i++) {
            $u = $this->lobbies[$i]->getUsers();
            for ($j = 0; $j < count($u); $j++) {
                if ($u[$j] == $user) {
                    $o = $this->lobbies[$i]->getOwner();

                    // Clean up user
                    $this->lobbies[$i]->removeUser($user);

                    // Notify other users
                    for ($k = 0; $k < count($u); $k++) {
                        if ($o == $user) {
                            $this->send($u[$k], 'N|LOBBY_DISBAND');
                        } else {
                            $this->send($u[$k], 'N|LOBBY_LEFT|' . $user->session_id);
                        }
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