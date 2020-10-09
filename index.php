<?php
require('includes/vendor/autoload.php');
require('includes/Utils.php');
require('controllers/frontend.php');
require('controllers/backend.php');

session_start();
if(Utils::GETPOST("action") == "deconnexion")
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
            case "createProduct":
                createProduct();
            break;
            case "ad":
                vueProduit();
            break;
            case "contact":
                contact();
            break;
            //BACKEND
            case "adminSpace":
                pageAdmin();
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