<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 02.02.2016
 * Time: 21:54
 */

// Session security
session_start();
if (empty($_SESSION)) {
    session_regenerate_id(true);
}

// Assign data variables for easier use
$skey = $this->_['skey'];

// Redirect if not logged in
if (!isset($_SESSION[$skey])) {
    header("Location: ?view=default");
    exit();
}

echo "You are definitely logged in :)";