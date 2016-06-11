<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 10.02.2016
 * Time: 20:30
 */

// Define state constants
define('STATE_OPEN', 0);
define('STATE_ROLE_SELECTION', 1);
define('STATE_IN_LOBBY', 2);
define('STATE_IN_MATCHMAKING', 3);

class MatchmakingLobby {

    public $game;
    public $teamsize;
    public $owner;
    public $team1 = array();
    public $team2 = array();
    public $type; // lobby / squad
    public $state = STATE_OPEN; // 0: open, 1: role selection, 2: in lobby
    public $mm_params = array();    // Mode, Size, Entry

    function __construct($g, $ts, $o, $t = 'lobby') {
        $this->game = $g;
        $this->teamsize = $ts;
        $this->owner = $o;
        $this->team1[] = $o;
        $this->type = $t;
    }

    /**
     * Returns the number of users currently in the lobby
     *
     * @return Int The number of users currently in the lobby
     */
    public function getUserCount() {
        return count($this->team1) + count($this->team2);
    }

    /**
     * Returns an array with all users currently in the lobby
     *
     * @param Boolean if team composition matters or not
     * @return Array All users currently in the lobby
     */
    public function getUsers($team = false) {
        if ($team) {
            return array('team1' => $this->team1, 'team2' => $this->team2);
        } else {
            return array_merge($this->team1, $this->team2);
        }
    }

    /**
     * Returns the user who owns the lobby
     *
     * @return WebSocketUser User which owns the lobby
     */
    public function getOwner() {
        return $this->owner;
    }

    /**
     * Removes a user from the lobby
     *
     * @param WebSocketUser User to remove
     * @return Boolean True if user found and removed, false if not
     */
    public function removeUser($user) {
        for ($i = 0; $i < count($this->team1); $i++) {
            if ($this->team1[$i] == $user) {
                unset($this->team1[$i]);
                $this->team1 = array_values($this->team1);
                return true;
            }
        }
        for ($i = 0; $i < count($this->team2); $i++) {
            if ($this->team2[$i] == $user) {
                unset($this->team2[$i]);
                $this->team2 = array_values($this->team2);
                return true;
            }
        }
        return false;
    }

    /**
     * Joins a user in the next free team
     *
     * @param WebSocketUser User to join
     */
    public function joinUser($user) {
        if ($this->teamsize > count($this->team1)) {
            // Team 1 free
            $this->team1[] = $user;
        } else if ($this->teamsize > count($this->team2) && $this->type == 'lobby') {
            // Team 2 free
            $this->team2[] = $user;
        }
    }
} 