<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 02.02.2016
 * Time: 20:54
 */

// Assign variables for easier use
$type = $this->_['type'];
$detail = $this->_['detail'];

// Choose error message
$e = "";
switch ($type) {
    case 1:
        $e = "There was an error with our database. Please try again.";

    default:
        $e = "Oops! Something went wrong!";
}

echo 'Error ' . $type . ': ' . $e;
echo PHP_EOL . $detail;