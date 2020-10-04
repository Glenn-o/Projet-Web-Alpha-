<?php

require "models/Manager.class.php";

class BillManager extends Manager
{
    //CRUD
    //CREATE
    public static function createBill($id_product)
    {
        $db = Database::getPDO();
        $product = ProductManager::getProductById($id_product);

        $sql = "INSERT INTO `billing`(`date`, `quantity`, `bill_pdf`, `id_seller`, `id_buyer`, `id_product`) VALUES (:date,:quantity,:bill_pdf,:id_seller,:id_buyer,:id_product)";

        $req = $db->prepare($sql);
        $tabParam = [
            ":date"=> date('Ydm'),
            ":quantity" => '1',
            ":bill_pdf" => $bill_pdf,
            ":id_seller" => $product["id_user"],
            ":id_buyer" => UserManager::getIdBySession(),
            ":id_product" => $id_product
        ];
    }
    //READ

    //UPDATE

    //DELETE

    //GETTER ET SETTER
}