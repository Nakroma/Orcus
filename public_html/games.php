<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 26.02.2016
 * Time: 21:49
 */

// Include classes
include('classes/games/controllerGames.php');
include('classes/model.php');
include('classes/games/modelGames.php');
include('classes/view.php');


// Merge $_GET und $_POST
$request = array_merge($_GET, $_POST);

// Create controller
$controller = new ControllerGames($request);

// Display content
echo $controller->display();