<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 10.02.2016
 * Time: 20:30
 */

class MatchmakingLobby {

    public $game;
    public $teamsize;
    public $owner;
    public $team1 = array();
    public $team2 = array();

    function __construct($g, $ts, $o) {
        $this->game = $g;
        $this->teamsize = $ts;
        $this->owner = $o;
        $this->team1[] = $o;
    }

    /**
     * Returns the number of users currently in the lobby
     *
     * @return int the number of users currently in the lobby
     */
    public function getUserCount() {
        return count($this->team1) + count($this->team2);
    }

    /**
     * Joins a user in the next free team
     *
     * @param $user ID of the user to join
     */
    public function joinUser($user) {
        if ($this->teamsize > count($this->team1)) {
            // Team 1 free
            $this->team1[] = $user;
        } else if ($this->teamsize > count($this->team2)) {
            // Team 2 free
            $this->team2[] = $user;
        }
    }

} 