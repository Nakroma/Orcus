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
    echo json_encode(array('type' => 'error', 'text' => mysqli_connect_error()));
    exit();
}

// Prepare statement
$fPassword = "";
$mStmt = mysqli_stmt_init($mConn);
$mPrep = mysqli_stmt_prepare($mStmt, "SELECT password, id FROM orcus_users WHERE email=? LIMIT 1");

if (!Model::isEmptyOrSpaces($data['email']) && !Model::isEmptyOrSpaces($data['password'])) {
    if ($mPrep) {
        // Bind parameters
        mysqli_stmt_bind_param($mStmt, 's', $data['email']);

        // Execute
        mysqli_stmt_execute($mStmt);

        // Bind results
        mysqli_stmt_bind_result($mStmt, $rePassword, $reID);

        // Store result
        mysqli_stmt_store_result($mStmt);

        // Save result if row was found
        if (mysqli_stmt_num_rows($mStmt) > 0) {
            mysqli_stmt_fetch($mStmt);
            $fPassword = $rePassword;
            $fID = $reID;
        }

        // Close statement
        mysqli_stmt_close($mStmt);
    }
} else {
    echo json_encode(array('type' => 'error', 'text' => 'You need to enter a username or password.'));
    mysqli_close($mConn);
    exit();
}

// Close connection
mysqli_close($mConn);

// Results
if (password_verify($data['password'], $fPassword)) {
    /**
     * Login process
     */

    // Set session
    $_SESSION[$skey] = $fID;

    // Redirect to control panel
    echo json_encode(array('type' => 'success', 'text' => 'was'));
    exit;
} else {
    // User wasn't found or pw wrong
    echo json_encode(array('type' => 'error', 'text' => 'Username or password were not found.'));
    exit;
}