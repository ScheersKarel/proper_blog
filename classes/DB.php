<?php
class DB
{

    private static $objInstance;

    public static function getInstance(): object
    {

        if(!self::$objInstance)
        {
            self::$objInstance = new PDO("mysql:host=ID211210_ksblog.db.webhosting.be;dbname=ID211210_ksblog;charset=utf8", "ID211210_ksblog", "1234abcd");
			self::$objInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$objInstance;

    }
}