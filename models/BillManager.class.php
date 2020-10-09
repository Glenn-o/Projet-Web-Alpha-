<?php

require_once "models/Manager.class.php";
use Mpdf\Mpdf;

class BillManager extends Manager
{
    //CRUD
    //CREATE
    public static function createPDF($id_facture)
    {
        $mpdf= new Mpdf(["mode" => "utf-8"]);
        $fileName = "public/ressource/facture.html";
        $handle = fopen($fileName, "r");
        $html = fread($handle, filesize($fileName));
        //injection
        $bill = BillManager::getBillById($id_facture);
        //vendeur
        $html = str_replace(":nomVendeur:", $bill["sell_lastname"], $html);
        $html = str_replace(":addresseVendeur:", $bill["sell_address"], $html);
        $html = str_replace(":cpVendeur:", $bill["sell_cp"], $html);
        $html = str_replace(":villeVendeur:", $bill["sell_city"], $html);
        //acheteur
        $html = str_replace(":nomAcheteur:", $bill["buy_lastname"], $html);
        $html = str_replace(":addresseAcheteur:", $bill["buy_address"], $html);
        $html = str_replace(":cpAcheteur:", $bill["buy_cp"], $html);
        $html = str_replace(":villeAcheteur:", $bill["buy_city"], $html);
        // Facture
        $html = str_replace(":nomProduit:", $bill["prod_name"], $html);
        $html = str_replace(":quantiteProduit:", 1, $html);
        $html = str_replace(":prixProduit:", $bill["prod_price"], $html);
        $html = str_replace(":totalProduit:", 1 * floatval($bill["prod_price"]), $html);
        // Date
        $html = str_replace(":dateFacture:", $bill["bill_date"], $html);
        //fin d'injection
        fclose($handle);
        $stylesheet = file_get_contents('public/css/facture.css'); // external css
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html,2);
        $mpdf->Output();
    }

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
    public static function getAllBills()
    {
        $db = Database::getPDO();
        $sql = "SELECT 
        Bill.date as bill_date, Bill.bill_pdf as bill_pdf,
        Prod.name as prod_name, Prod.price as prod_price,
        Buyer.lastname as buy_lastname, Buyer.firstname as buy_firstname , Buyer.address as buy_adress,
        Seller.lastname as sell_lastname, Seller.firstname as sell_firstname, Seller.address as sell_adress 
        FROM billing Bill
        INNER JOIN product Prod ON Bill.id_product = Prod.id_product
        INNER JOIN users Seller on Bill.id_seller = Seller.id_user
        INNER JOIN users Buyer on Bill.id_buyer = Buyer.id_user";
        return $req = $db->query($sql);
    }

    public static function getBillById($id)
    {
        $db = Database::getPDO();
        $sql = "SELECT 
        Bill.date as bill_date, Bill.bill_pdf as bill_pdf,
        Prod.name as prod_name, Prod.price as prod_price,
        Buyer.lastname as buy_lastname, Buyer.firstname as buy_firstname , Buyer.address as buy_address, Buyer.city as buy_city, Buyer.postal_code as buy_cp,
        Seller.lastname as sell_lastname, Seller.firstname as sell_firstname, Seller.address as sell_address, Seller.city as sell_city, Seller.postal_code as sell_cp
        FROM billing Bill
        INNER JOIN product Prod ON Bill.id_product = Prod.id_product
        INNER JOIN users Seller on Bill.id_seller = Seller.id_user
        INNER JOIN users Buyer on Bill.id_buyer = Buyer.id_user
        WHERE id_billing = ".$id;
        return $req = $db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    //UPDATE
    public static function updateBillById($id)
    {
        $db = Database::getPDO();
        $sql = "UPDATE billing
                SET date = ?,
                quantity = ?,
                bill_pdf = ?,
                id_seller = ?,
                id_buyer = ?,
                id_product = ?";
    }

    //DELETE
    public static function deleteBillById($id)
    {
        $db = Database::getPDO();
        $sql = "DELETE FROM billing WHERE id_billing = $id";
        return $db->query($sql);
    }
    //GETTER ET SETTER
}