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
    $reqUsers = UserManager::getAllUsers();
    require 'views/backend/AdminUsersView.php';
}

function vueProduct()
{
    $reqProducts = ProductManager::getAllProducts();
    require 'views/backend/AdminProductsView.php';
}

function vueBill()
{
    $reqBills = BillManager::getAllBills();
    require 'views/backend/adminBillsView.php';
}