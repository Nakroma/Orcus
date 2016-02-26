<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 26.02.2016
 * Time: 14:56
 */

class ModelGames {

    // Sidebar menu template to use
    private static $templateSidebar = 'games_sidebar';


    /**
     * Returns the template of the menu sidebar
     *
     * @return String Template to use
     */
    public static function getTemplateSidebar() {
        return self::$templateSidebar . '.php';
    }

}