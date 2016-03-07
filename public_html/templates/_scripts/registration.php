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
    echo json_encode(array('type' => 'error', 'text' => mysqli_connect_error()));
    exit();
}

// Prepare statement
$mStmt = mysqli_stmt_init($mConn);
$mPrep = mysqli_stmt_prepare($mStmt, "INSERT INTO orcus_users (email, password) VALUES (?, ?)");

if (!Model::isEmptyOrSpaces($data['email']) && !Model::isEmptyOrSpaces($data['password'])) {
    if ($mPrep) {
        // Check for duplicate email
        $mQuery = mysqli_query($mConn, "SELECT email FROM orcus_users WHERE email='".$data['email']."'");
        if (mysqli_num_rows($mQuery) > 0) {
            echo json_encode(array('type' => 'error', 'text' => 'Your chosen email already exists.'));
            mysqli_close($mConn);
            exit();
        } else {
            // Bind parameters
            mysqli_stmt_bind_param($mStmt, 'ss', $data['email'], $data['password']);

            // Execute
            mysqli_stmt_execute($mStmt);

            // Close statement
            mysqli_stmt_close($mStmt);
        }
    }
} else {
    echo json_encode(array('type' => 'error', 'text' => 'You need to enter a username or password.'));
    mysqli_close($mConn);
    exit();
}

// Close connection
mysqli_close($mConn);

// Insert
if ($mPrep) {
    echo json_encode(array('type' => 'success', 'text' => 'was'));
} else {
    echo json_encode(array('type' => 'error', 'text' => mysqli_error($mConn)));
}