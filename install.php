<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 26.01.2016
 * Time: 17:17
 */

// Include model
require "public_html/classes/model.php";
$db = Model::getDatabase();

// Connect to database
$mConn = mysqli_connect($db['host'], $db['username'], $db['password'], $db['dbname']);
// Check connection
if (!$mConn) {
    die("Connection failed: " . mysqli_connect_error());
}


/**
 * SQL for the installation
 */
$sql = "CREATE TABLE orcus_users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(128) NOT NULL
);";


// Query
if (mysqli_query($mConn, $sql)) {
    echo "All tables were created successfully.";
} else {
    echo "Error creating tables: " . mysqli_error($mConn);
}

// Close connection
mysqli_close($mConn);