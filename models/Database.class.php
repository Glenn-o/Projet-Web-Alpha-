<?php

class Database
{
    public static function getPDO() {

        $con = new PDO('mysql:host=localhost;dbname=fog_bdd', 'admin_fog', 'FogCesi2020!');
        $con->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->exec('SET NAMES "utf8"');

        return $con;
    }
}