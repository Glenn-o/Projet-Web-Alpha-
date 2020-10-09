<?php
require_once "models/ProductManager.class.php";
require_once "models/UserManager.class.php";
require_once "models/BillManager.class.php";


function listProducts()
{
    $category = Utils::GETPOST("category");
    $research = Utils::GETPOST("research");
    $location = Utils::GETPOST("location");

    $req = ProductManager::getProductByFilter($location, $research, $category);

    require ("views/frontend/listProductsView.php");
}

function connexion()
{
    $message = "";
    if(Utils::GETPOST("action") == "tryConnexion")
    {
        $username = Utils::GETPOST("username");
        $password = Utils::GETPOST("password");
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
    if(Utils::ISGETPOST("firstName") and Utils::ISGETPOST("lastName") and Utils::ISGETPOST("userName") and 
    Utils::ISGETPOST("address") and Utils::ISGETPOST("city") and Utils::ISGETPOST("postalCode") and 
    Utils::ISGETPOST("country") and Utils::ISGETPOST("phone") and Utils::ISGETPOST("password") and
    Utils::ISGETPOST("email"))
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
    $randomProduct = ProductManager::getRandomProductNumber(6);
    $randomCategory = ProductManager::getRandomProductNumber(6);
    require("views/frontend/accueilView.php");
}

function clientSpace()
{
    //Dernieres annonces
    $errorMessage = "";
    if(!empty($_SESSION["name"]))
    {
        $id = UserManager::getIDByName($_SESSION["name"]);
        if(Utils::GETPOST("action") == "modification")
            UserManager::updateUserById($id, $errorMessage);
        $data = UserManager::getUserByUsername($_SESSION["name"]);
        $reqProduct = ProductManager::getProductsByUserId($id);

    }
    $pageModif = $_SERVER["PHP_SELF"]."?page=clientSpace&action=modification";
    //Info utilisateur

    //View
    require("views/frontend/clientSpaceView.php");
}

function createProduct()
{
    $message = "";
    if(Utils::GETPOST("action") == "creation")
    {
        $user_id = UserManager::getIdBySession();
        ProductManager::createProduct($user_id, $message);
    }
    require("views/frontend/creationProductView.php");
}

function vueProduit()
{
    if(Utils::GETPOST('action') == "achat")
    {
        if(BillManager::createBill(Utils::GETPOST('product')))
        {
            header("Location: index.php");
        }
        else{
            throw new Exception("La facture n'as pas reussi a se creer");
        }

    }
    $product = ProductManager::getProductById(Utils::GETPOST("product"));
    $seller = UserManager::getUserById($product["id_user"]);
    require("views/frontend/adView.php");
}

function contact()
{
    if(Utils::GETPOST('action') == "mail")
    {
        $message = Utils::GETPOST('message');
        $subject = Utils::GETPOST('subject');

        // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en  utilisant wordwrap()
        $message = wordwrap($message, 70, "\r\n");

        // Envoi du mail
        $result = mail('dupycournau@gmail.com', $subject, $message);
        print $result ? "Mail accepté" : "Mail Refusé";
    }
    require "views/frontend/contactView.php";
}