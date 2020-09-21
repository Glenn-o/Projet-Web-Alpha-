<?php

$action = GETPOST("action");
$categorie = GETPOST("categorie");
$nom = GETPOST("nom");
$lieu = GETPOST("lieu");

function GETPOST($champ)
{
    return htmlentities($_POST[$champ]) ?? "";
}
?>