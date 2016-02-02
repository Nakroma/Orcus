<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 27.01.2016
 * Time: 19:20
 */

// Assign data variables for easier use
$data = $this->_['data'];
$db = $this->_['db'];

// Create connection
$mConn = mysqli_connect($db['host'], $db['username'], $db['password'], $db['dbname']);

// Check connection
if (!$mConn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Escape all strings
$data['email'] = mysqli_escape_string($mConn, $data['email']);
$data['password'] = mysqli_escape_string($mConn, $data['password']);

// SQL code
$sql = "INSERT INTO orcus_users (email, password)
VALUES ('". $data['email'] ."', '". $data['password'] ."')";

// Insert
$mQuery = mysqli_query($mConn, $sql);

// Close connection
mysqli_close($mConn);

// Insert
if ($mQuery) {
    header("Location: ?view=default");
} else {
    header("Location: ?view=error&type=1&detail=".urlencode($mysqli_error($mConn)));
}