<?php

require_once "models/Manager.class.php";

class BillManager extends Manager
{
    //CRUD
    //CREATE
    public static function createBill($id_product)
    {
        try
        {
            $db = Database::getPDO();
            $product = ProductManager::getProductById($id_product);

            $sql = "INSERT INTO `billing`(`date`, `quantity`, `id_seller`, `id_buyer`, `id_product`) VALUES (:date,:quantity,:id_seller,:id_buyer,:id_product)";

            $req = $db->prepare($sql);
            $tabParam = [
                ":date"=> date('Ydm'),
                ":quantity" => '1',
                // ":bill_pdf" => $bill_pdf,
                ":id_seller" => $product["id_user"],
                ":id_buyer" => UserManager::getIdBySession(),
                ":id_product" => $id_product
            ];
            $req->execute($tabParam);
            
            if ($req == FALSE)
                throw new Exception("Probleme de creation de facture");
            
            if (!ProductManager::setStatusById($id_product, FALSE))
                throw new Exception("Le produit n'est pas passé en inactif");

            return true;
        }
        catch(Exception $error)
        {
            print($error->getMessage());
            return false;
        }
    }
    //READ

    //UPDATE

    //DELETE

    //GETTER ET SETTER
}