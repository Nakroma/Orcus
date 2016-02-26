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
    header("Location: ?view=error&type=1&detail=".urlencode(mysqli_connect_error()));
    exit();
}

// Prepare statement
$mStmt = mysqli_stmt_init($mConn);
$mPrep = mysqli_stmt_prepare($mStmt, "INSERT INTO orcus_users (email, password) VALUES (?, ?)");
if ($mPrep) {
    // Bind parameters
    mysqli_stmt_bind_param($mStmt, 'ss', $data['email'], $data['password']);

    // Execute
    mysqli_stmt_execute($mStmt);

    // Close statement
    mysqli_stmt_close($mStmt);
}

// Close connection
mysqli_close($mConn);

// Insert
if ($mPrep) {
    header("Location: ?view=default");
} else {
    header("Location: ?view=error&type=1&detail=".urlencode(mysqli_error($mConn)));
}