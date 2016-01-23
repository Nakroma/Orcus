<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 23.01.2016
 * Time: 15:00
 * Desc: Class for data access
 */

class Model {

    // Einträge
    private static $entries = array(
        array("id"=>0, "title"=>"Eintrag 1", "content"=>"Ich bin der erste Eintrag."),
        array("id"=>1, "title"=>"Eintrag 2", "content"=>"Ich bin der ewige Zweite!"),
        array("id"=>2, "title"=>"Eintrag 3", "content"=>"Na dann bin ich die Nummer drei.")
    );

    /**
     * Gibt alle einträge zurück
     */
    public static function getEntries() {
        return self::$entries;
    }

    /**
     * Returns Eintrag
     */
    public static function getEntry($id){
        if(array_key_exists($id, self::$entries)){
            return self::$entries[$id];
        }else{
            return null;
        }
    }

}