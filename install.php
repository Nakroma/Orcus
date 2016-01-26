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
$mConn = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']);
// Check connection
if ($mConn->connect_error) {
    die("Connection failed: " . $mConn->connect_erorr);
}


/**
 * SQL for the installation
 */
$sql = "CREATE TABLE o_users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(128) NOT NULL
);";


// Query
if ($mConn->multi_query($sql) === TRUE) {
    echo "All tables were created successfully.";
} else {
    echo "Error creating tables: " . $mConn->error;
}

// Close connection
$mConn->close();