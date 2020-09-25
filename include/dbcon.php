<?php

// connexion a la BDD fog_db
function getConn(): PDO {

    try {
        $con = new PDO('mysql:host=localhost;dbname=fog_bdd', 'admin_fog', 'FogCesi2020!');
        $con->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->exec('SET NAMES "utf8"');
    }
    catch (PDOException $e) {
        die($e->getMessage());
    }

    return $con;
}

function GETPOST($champ)
{
    if(isset($_POST[$champ]))
    {
        return htmlentities($_POST[$champ]);
    }
    else if(isset($_GET[$champ]))
    {
        return htmlentities($_GET[$champ]);
    }
    else 
    {
        return "";
    }
}
