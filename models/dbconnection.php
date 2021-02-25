<?php

function ConnectDb()
{
    $dbServer = "127.0.0.1";
    $dbName = "portfolio";
    $dbUser = "user-portfolio";
    $dbPwd = '1cR€a7If';

    static $bdd = null;

    try {
        //code...
        if ($bdd === null) {
            $bdd = new PDO("mysql:host=$dbServer;dbname=$dbName;charset=utf8", $dbUser, $dbPwd);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $bdd;
    } catch (Exception $e) {
        //throw $th;
        die($e);
    }
}
