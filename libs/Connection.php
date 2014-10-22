<?php

final class Connection {
    
    static public $mysqli;
            
    static function connect() {
        /**
         * Connecting to the DATABASE
         * @return bool connected or not connected
         */
        //Установка временной зоны
        date_default_timezone_set('Europe/Kiev');
        if(!self::$mysqli){
            //Connect to the database
            self::$mysqli = new mysqli(Settings::$db_host, Settings::$db_user,
                                       Settings::$db_pass, Settings::$db_name);
            if(mysqli_connect_errno()){
                return false;
            } else {
                if(self::$mysqli->query("SET NAMES 'utf8'")){
                    return true;
                }
                return false;
            }
        }
        return true;
    }

}