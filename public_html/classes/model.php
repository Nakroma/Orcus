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

    // Database
    private static $db = array(
        "dbname" => "orcus",
        "username" => "root",
        "password" => "",
        "host" => "localhost"
    );

    // Session Key
    private static $skey = "nyywM6SaUosYKRMsjhxBG0j5933wDl4wETyXaVYFjoaiIASuGJo896iVX57jTIR9kCwMlSrXjz0eljh2tsfI";


    /**
     * Returns all paths
     *
     * @return Array Array of paths
     */
    public static function getPaths() {
        return self::$paths;
    }

    /**
     * Returns the database values
     *
     * @return Array Database credentials
     */
    public static function getDatabase() {
        return self::$db;
    }

    /**
     * Returns the session key
     *
     * @return String session key
     */
    public static function getSessionKey() {
        return self::$skey;
    }

    /**
     * Returns the mysql entry of a user
     *
     * @param Integer Session ID
     * @param String Entries to select
     * @return Array Mysql entry or false on error
     */
    public static function getUser($sid, $select = "*") {
        // Create connection
        $mConn = mysqli_connect(self::$db['host'], self::$db['username'], self::$db['password'], self::$db['dbname']);

        // Check connection
        if (!$mConn) {
            return false;
        }

        // Prepare statement
        $mStmt = mysqli_stmt_init($mConn);
        $sql = "SELECT ". $select ." FROM orcus_users WHERE id=? LIMIT 1";
        $mPrep = mysqli_stmt_prepare($mStmt, $sql);

        if ($mPrep) {
            // Bind parameters
            mysqli_stmt_bind_param($mStmt, 'i', $sid);

            // Execute
            mysqli_stmt_execute($mStmt);

            // Extract results
            $result = mysqli_stmt_get_result($mStmt);
            while ($data = mysqli_fetch_assoc($result)) {
                $user[] = $data;
            }

            // Close statement
            mysqli_stmt_close($mStmt);
        } else {
            return false;
        }

        // Close connection
        mysqli_close($mConn);

        // Return results
        return $user[0];
    }

    /**
     * Hashes a clear string with sha512
     *
     * @param String String to hash
     * @return String Hashed string
     */
    public static function hashValue($str) {
        return password_hash($str, PASSWORD_BCRYPT);
    }
}