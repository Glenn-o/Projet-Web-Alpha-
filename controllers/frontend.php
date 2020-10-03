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
        $username = GETPOST("username");
        $password = GETPOST("password");
        if(empty($username) or empty($password))
        {
            throw new Exception("Mot de passe ou Pseudo non renseigné");
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
    $errorMessage = "";
    if(!empty($_SESSION["name"]))
    {
        $id = UserManager::getIDByName($_SESSION["name"]);
        if(GETPOST("action") == "modification")
            UserManager::updateUserById($id, $errorMessage);
        $data = UserManager::getUserByUsername($_SESSION["name"]);
        $reqProduct = ProductManager::getProductsByUserId($id);

    }
    $pageModif = $_SERVER["PHP_SELF"]."?page=clientSpace&action=modification";
    //Info utilisateur

    //View
    require("views/frontend/clientSpaceView.php");
}


#region Utils

#endregion