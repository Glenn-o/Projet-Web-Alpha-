<?php
require_once "models/ProductManager.class.php";
require_once "models/UserManager.class.php";


function listProducts()
{
    $category = GETPOST("category");
    $research = GETPOST("research");
    $location = GETPOST("location");

    $req = ProductManager::getProductByFilter($location, $research, $category);

    require ("views/frontend/listProductsView.php");
}

function connexion()
{
    $message = "";
    if(GETPOST("action") == "tryConnexion")
    {
        echo 'tentative de connexion';
        $username = GETPOST("username");
        $password = GETPOST("password");
        if($username == "" or $password == "")
        {
            throw new Exception("Mot de passe non renseigné");
        }
        else
        {
            if(UserManager::tryConnexion($username, $password) == FALSE)
            {
                $message = "Erreur d'identifiant";
            }
        }
    }
    
    require("views/frontend/connexionView.php");
}

function inscription()
{
    $wrongPassword = "";
    if(GETPOSTEMPTY("firstName") and GETPOSTEMPTY("lastName") and GETPOSTEMPTY("userName") and 
    GETPOSTEMPTY("address") and GETPOSTEMPTY("city") and GETPOSTEMPTY("postalCode") and 
    GETPOSTEMPTY("country") and GETPOSTEMPTY("phone") and GETPOSTEMPTY("password") and
    GETPOSTEMPTY("email"))
    {
            if(UserManager::createUser($wrongPassword))
            {
                $wrongPassword =  'connexion reussie';
            }
    }
    else
    {
        $wrongPassword = "Tout les champs ne sont pas remplis";
    }

    require("views/frontend/inscriptionView.php");
}

function pageAccueil()
{
    require("views/frontend/accueilView.php");
}

function clientSpace()
{
    //Dernieres annonces
    if(!empty($_SESSION["name"]))
    {
        $data = UserManager::getUserByUsername($_SESSION["name"]);
    }
    //Info utilisateur

    //View
    require("views/frontend/clientSpaceView.php");
}


#region Utils

#endregion