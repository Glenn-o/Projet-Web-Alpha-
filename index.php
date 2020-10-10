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
            case "home":
                homePage();
            break;
            case "login":
                login();
            break;
            case "register":
                register();
            break;
            case "productSearch":
                productSearch();
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
                adminSpace();
            break;
        }
    }
    else {
        homePage();
    }
}
catch(Exception $e) 
{
    echo "Erreur : " . $e;
}