<?php

function dbConnect(string $user, string $pass, string $db, string $host = 'ID211210_ksblog.db.webhosting.be'): PDO
{
    $connection = new PDO(
        "mysql:host=".$host.";dbname=".$db, $user, $pass);
        $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
}

