<?php
require('controllers/frontend.php');
require('controllers/backend.php');

session_start();
if(GETPOST("action") == "deconnexion")
{
    UserManager::deconnexion();
}

try {
    if (isset($_GET['page'])) {
        switch($_GET['page'])
        {
            case "accueil":
                pageAccueil();
                break;
            case "connexion":
                connexion();
                break;
            case "inscription":
                inscription();
                break;
            case "listProducts":
                listProducts();
                break;
            case "clientSpace":
                clientSpace();
                break;
        }
    }
    else {
        pageAccueil();
    }
}
catch(Exception $e) 
{
    echo "Erreur : " . $e;
}

#region Utils
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

function GETPOSTEMPTY($champ) : bool
{
    if(!empty($_POST[$champ]) or !empty($_GET[$champ]))
    {
        return true;
    }
    else
        return false;
}
#endregion