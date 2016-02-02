<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 02.02.2016
 * Time: 21:19
 */

// Session security
session_start();
if (empty($_SESSION)) {
    session_regenerate_id(true);
}

// Assign data variables for easier use
$data = $this->_['data'];
$db = $this->_['db'];
$skey = $this->_['skey'];

// Create connection
$mConn = mysqli_connect($db['host'], $db['username'], $db['password'], $db['dbname']);

// Check connection
if (!$mConn) {
    header("Location: ?view=error&type=1&detail=".urlencode(mysqli_connect_error()));
    exit();
}

// Escape all strings
$data['email'] = mysqli_escape_string($mConn, $data['email']);
$data['password'] = mysqli_escape_string($mConn, $data['password']);

// SQL code
$mail = $data['email'];
$sql = "SELECT email, password, id FROM orcus_users WHERE email='$mail' LIMIT 1";

// Read
$mQuery = mysqli_query($mConn, $sql);

// Close connection
mysqli_close($mConn);

// Results
if (mysqli_num_rows($mQuery) > 0) {
    // Found user
    $row = mysqli_fetch_assoc($mQuery);
    if ($data['password'] == $row['password']) {
        /**
         * Login process
         */

        // Set session
        $_SESSION[$skey] = $row['id'];

        // Redirect to control panel
        header("Location: ?view=controlpanel");
        exit;
    } else {
        // Password wrong
        header("Location: ?view=default");
        exit;
    }
} else {
    // User wasn't found
    header("Location: ?view=default");
    exit;
}