<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 21.01.2016
 * Time: 19:05
 */

// Include classes
include('classes/controller.php');
include('classes/model.php');
include('classes/view.php');


// Merge $_GET und $_POST
$request = array_merge($_GET, $_POST);

// Create controller
$controller = new Controller($request);

// Display content
echo $controller->display();