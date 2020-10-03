<?php

require_once "models/ProductManager.class.php";
require_once "models/UserManager.class.php";


function pageAdmin()
{
    $productManager = new ProductManager();
    $req = $productManager->getAllProducts();

    require ("views/backend/adminView.php");
}