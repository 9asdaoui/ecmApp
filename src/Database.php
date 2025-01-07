<?php

// namespace Ecm\App;

class Database
{
    private static $host = "localhost";
    private static $db_name = "ecmdb";
    private static $username = "root";
    private static $password = "redaader@2000";
    private static $conn;

    public static  function getConnection()
    {
        if(self::$conn){
            return self::$conn;
        }
        else {
            self::$conn = new \PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
            return self::$conn;
        }
    }
}

Database::getConnection();
