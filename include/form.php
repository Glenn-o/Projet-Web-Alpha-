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


print '<form action="'.$_SERVER['PHP_SELF'].'" method="post">
        <input type="hidden" name="action" value="generate">
        <div>
            <label for="name">Enter your name: </label>
            <input type="text" name="name" id="name">
        </div>
        <div class="form-example">
            <label for="email">Enter your email: </label>
            <input name="location" id="location" name="location">
        </div>
        <div>
            <label for="categorie">Enter your categorie: </label>
            <input name="categorie" id="categorie" name="categorie">
        </div>
        <div>
            <input type="submit" value="Valider!">
        </div>
        </form>';

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