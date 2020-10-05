<?php

require_once "models/ProductManager.class.php";
require_once "models/UserManager.class.php";
require_once "models/BillManager.class.php";


function pageAdmin()
{
    switch(Utils::GETPOST("vue"))
    {
        case "user":
            vueUser();
        break;
        case "product":
            vueProduct();
        break;
        case "bill":
            vueBill();
        break;
        default:
        require 'views/backend/adminView.php';
        break;
    }
}

function vueUser()
{
    $message = "";
    $action = Utils::GETPOST('action');
    if($action != "")
    {
        $userId = Utils::GETPOST('user');
        if($action == "validation")
        {
            if(UserManager::updateUserById($userId, $message))
            {
                header("Location: index.php?page=adminSpace&vue=user");
            }
            else
            {
                throw new Exception("Erreur dans la creation de l'utilisateur");
            }
        }
        else if($action == "suppression")
        {  
            if(UserManager::deleteUserById($userId))
            {
                header("Location: index.php?page=adminSpace&vue=product");
            }
            else
            {
                throw new Exception("Erreur dans la suppression du produit");
            }
        }
        else
        {
            $user = UserManager::getUserById($userId);
        }
    }
    else
    {
        $reqUsers = UserManager::getAllUsers();
    }
    require 'views/backend/AdminUsersView.php';
}

function vueProduct()
{
    $message = "";
    $action = Utils::GETPOST('action');
    if($action != "")
    {
        $productId = Utils::GETPOST('product');
        if($action == "validation")
        {
            if(ProductManager::updateProductById($productId, $message))
            {
                header("Location: index.php?page=adminSpace&vue=product");
            }
            else
            {
                throw new Exception("Erreur dans la modification du produit");
            }
        }
        else if($action == "suppression")
        {  
            if(ProductManager::deleteProductById($productId))
            {
                header("Location: index.php?page=adminSpace&vue=product");
            }
            else
            {
                throw new Exception("Erreur dans la suppression du produit");
            }
        }
        else
        {
            $product = ProductManager::getProductById($productId);
        }
    }
    else
    {
        $reqProduct = ProductManager::getAllProducts();
    }
    require 'views/backend/AdminProductsView.php';
}

function vueBill()
{
    $reqBills = BillManager::getAllBills();
    require 'views/backend/adminBillsView.php';
}