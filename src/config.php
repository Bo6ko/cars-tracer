<?php

// singleton helper
class DB
{
    protected static $db;

    public static function get()
    {
        if (static::$db === null) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "cars_tracer";
            static::$db = mysqli_connect($servername, $username, $password, $dbname);
        }

        return static::$db;
    }
}