<?php

require_once "models/ProductManager.class.php";
require_once "models/UserManager.class.php";


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

}

function vueProduct()
{
    
}

function vueBill()
{
    
}