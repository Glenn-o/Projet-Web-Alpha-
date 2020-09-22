<?php

$action = GETPOST("action");
$categorie = GETPOST("categorie");
$name = GETPOST("name");
$location = GETPOST("location");

if($action == "generate")
{
    if($categorie != "" or $name != "" or $location != "")
    {
        header('Location: /web/searchForm.php?location="'.$location.'"&name="'.$name.'"&categorie="'.$categorie.'"');
    }
}
else
{
    print("Pas d'action");
}

function GETPOST($champ)
{
    if(isset($_POST[$champ]))
    {
        return htmlentities($_POST[$champ]);
    }
    else {
        return "";
    }
}
?>