<?php

$action = GETPOST("action");
$categorie = GETPOST("categorie");
$name = GETPOST("name");
$location = GETPOST("location");

// Create sql
$sql = 'SELECT * FROM product';
$tabWhere = [];
if($categorie != "") {$tabWhere[] = "categorie = ".$categorie; }
if($name != "") {$tabWhere[] = "name = ".$name; }
if($location != "") {$tabWhere[] = "location = ".$location; }
if(count($tabWhere) > 0)
{
    $sql .= ' WHERE '.join(" and ", $tabWhere);
}

print($sql);

function GETPOST($champ)
{
    if(isset($_POST[$champ]))
    {
        print("Bes yes post");
        return htmlentities($_POST[$champ]);
    }
    else if(isset($_GET[$champ]))
    {
        print("Bes yes get");
        return htmlentities($_GET[$champ]);
    }
    else 
    {
        print("no");
        return "";
    }
}
?>