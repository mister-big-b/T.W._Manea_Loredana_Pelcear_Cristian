<?php
class BD{
    public static $connection=NULL;
    public static function get_con(){
        if(is_null(self::$connection)){
            $DATABASE_HOST = 'localhost';
            $DATABASE_USER = 'root';
            $DATABASE_PASS = '';
            $DATABASE_NAME = 'skvi';
            self::$connection = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
            if(!self::$connection){
                exit('Failed to connect to MySQL: ' . mysqli_connect_error());
            }
        }
        return self::$connection;
    }
}
