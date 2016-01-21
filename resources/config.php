<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 21.01.2016
 * Time: 18:57
 */


/*
    Config
*/

$config = array(
    "db" => array(
        "dbOrcus" => array(
            "name" => "db_orcus",
            "username" => "root",
            "password" => "",
            "host" => "localhost"
        )
    ),
    "path" => array(
        "img" => $_SERVER["DOCUMENT_ROOT"] . "/bootstrap/img"
    )
);


/*
    Constants
*/

defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));

defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));


/*
    Errors
*/

ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRICT);

?>