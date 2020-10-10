<?php
require_once "models/ProductManager.class.php";
require_once "models/UserManager.class.php";
require_once "models/BillManager.class.php";


function productSearch()
{
    $maxProduct = 10;
    $pageNbr = Utils::ISGETPOST("pageNbr") ? Utils::GETPOST("pageNbr") : 1;
    $category = Utils::GETPOST("category");
    $research = Utils::GETPOST("research");
    $location = Utils::GETPOST("location");

    $req = ProductManager::getProductByFilter($location, $research, $category);
    $pageCount = $req->rowCount();
    $all = $req->fetchAll();
    $nbrPage = ceil($pageCount / $maxProduct);
    $capResult = $pageNbr * $maxProduct;
    if($capResult > $pageCount)
    {
        $capResult = $pageCount;
    }
    $start = ($pageNbr-1) * $maxProduct;
    $res = [];
    for($i=$start;$i< $capResult;$i++)
    {
        $res[] = $all[$i];
    }

    require ("views/frontend/productSearchView.php");
}

function login()
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

    require("views/frontend/connectionView.php");
}

function register()
{
    $message = "";
    if(Utils::ISGETPOST("firstName") and Utils::ISGETPOST("lastName") and Utils::ISGETPOST("userName") and
    Utils::ISGETPOST("address") and Utils::ISGETPOST("city") and Utils::ISGETPOST("postalCode") and
    Utils::ISGETPOST("country") and Utils::ISGETPOST("phone") and Utils::ISGETPOST("password") and
    Utils::ISGETPOST("email"))
    {
            if(UserManager::createUser($message))
            {
                $message =  'connexion reussie';
            }
    }
    else
    {
        $message = "Tout les champs ne sont pas remplis";
    }

    require("views/frontend/inscriptionView.php");
}

function homePage()
{
    $randomProduct = ProductManager::getRandomProductNumber(6);
    $randomCategory = ProductManager::getRandomProductNumber(6);
    require("views/frontend/homePageView.php");
}

function clientSpace()
{
    //Dernieres annonces
    $message = "";
    if(!empty($_SESSION["name"]))
    {
        $id = UserManager::getIDByName($_SESSION["name"]);
        if(Utils::GETPOST("action") == "modification")
            UserManager::updateUserById($id, $message);
        $data = UserManager::getUserBySession();
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

function adView()
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
        if(!empty($_POST['message']) && !empty($_POST['subject']) &&!empty($_POST['email'])){
            $message = Utils::GETPOST('message');
            $subject = Utils::GETPOST('subject');
            $email = Utils::GETPOST('email');
            // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en  utilisant wordwrap()
            $message = wordwrap($message, 70, "\r\n");
            $headers =  'MIME-Version: 1.0' . "\r\n"; 
            $headers .= 'From: ' . $email . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n"; 
            
           
            $result = mail("fog@contact.com", $subject, $message, $headers);
            $result ? $send = "Votre mail à bien été envoyé" : $error = "Votre Mail n'a pas pu être envoyé veuillez reesseyer";
        }
        else{
            $error = "Veuillez remplir toutes les informations";
        }

       
    }
    require "views/frontend/contactView.php";
}