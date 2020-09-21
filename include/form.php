<?php

$action = GETPOST("action");
$categorie = GETPOST("categorie");
$name = GETPOST("name");
$location = GETPOST("location");

if($action == "generate")
{
    if($categorie != "" or $nom != "" or $lieu != "")
    {
        header('Location: /web/recherche.php?location="'.$lieu.'"?name="'.$name.'
                "?categorie="'.$categorie.'"');
    }
}



print $categorie;


print '<form action="'.$_SERVER['PHP_SELF'].'" method="post"/>';
print '<input type="hidden" name="action" value="generate"/>';
print '<input name="categorie"/>';
print '<input type="button" type="submit" value="Valider"/>';

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