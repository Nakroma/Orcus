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
             * [3] Creator ID
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
                    // Lobby free
                    $lobby->joinUser($user);
                    $this->send($user, 'S|LOBBY_JOIN');
                } else {
                    // Lobby full
                    $this->send($user, 'E|LOBBY_FULL');
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
        // Do nothing: This is where cleanup would go, in case the user had any sort of
        // open files or other objects associated with them.  This runs after the socket
        // has been closed, so there is no need to clean up the socket itself here.
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