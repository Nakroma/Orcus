<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 23.01.2016
 * Time: 15:00
 * Desc: Class for data access
 */

class Model {

    // Paths
    private static $paths = array(
        "img" => "bootstrap/img/",
        "css" => "bootstrap/css/",
        "js" => "bootstrap/js/",
        "video" => "bootstrap/video/"
    );

    /**
     * Returns all paths
     *
     * @return Array Array of paths
     */
    public static function getPaths() {
        return self::$paths;
    }

}