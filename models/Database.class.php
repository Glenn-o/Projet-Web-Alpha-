<?php

/**
 * Class regroupant toutes les fonctions de Base de donnée.
 */
class Database
{
    /**
     * Recupere un objet PDO
     * @return PDO Objet de connexion a la base de donnée fog_admin
     */
    public static function getPDO() {

        $con = new PDO('mysql:host=localhost;dbname=fog_bdd', 'admin_fog', 'FogCesi2020!');
        $con->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->exec('SET NAMES "utf8"');

        return $con;
    }
}