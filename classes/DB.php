<?php
class DB
{

    private static $objInstance;

    public static function getInstance(): object
    {

        if(!self::$objInstance)
        {
            self::$objInstance = new PDO("mysql:host=localhost;dbname=blog;charset=utf8", "root", "");
			self::$objInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$objInstance;

    }
}