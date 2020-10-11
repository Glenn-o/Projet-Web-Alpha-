<?php

require_once "models/Manager.class.php";
use Mpdf\Mpdf;


/**
 * Classe contant toutes les fonctions utile a la gestion des Factures
 *
 * @author  FOGteam
 */
class BillManager extends Manager
{
    //CRUD
    //CREATE
    /**
     * Crée le PDF d'une facture
     * @param $id_buyer ID de la facture
     * @param $id_seller ID de la facture
     * @param $id_product ID de la facture
     * @return $pdf Fichier PDF en base64
     */
    public static function createPDF($id_seller, $id_buyer, $id_product)
    {
        $mpdf= new Mpdf(["mode" => "utf-8"]);
        $fileName = "public/ressource/facture.html";
        $handle = fopen($fileName, "r");
        $html = fread($handle, filesize($fileName));
        //injection
        // $bill = BillManager::getBillById($id_facture);
        $buyer = UserManager::getUserById($id_buyer);
        $seller = UserManager::getUserById($id_seller);
        $product = ProductManager::getProductById($id_product);
        //vendeur
        $html = str_replace(":nomVendeur:", $buyer["lastname"], $html);
        $html = str_replace(":addresseVendeur:", $buyer["address"], $html);
        $html = str_replace(":cpVendeur:", $buyer["postal_code"], $html);
        $html = str_replace(":villeVendeur:", $buyer["city"], $html);
        //acheteur
        $html = str_replace(":nomAcheteur:", $seller["lastname"], $html);
        $html = str_replace(":addresseAcheteur:", $seller["address"], $html);
        $html = str_replace(":cpAcheteur:", $seller["postal_code"], $html);
        $html = str_replace(":villeAcheteur:", $seller["city"], $html);
        // Facture
        $html = str_replace(":nomProduit:", $product["name"], $html);
        $html = str_replace(":quantiteProduit:", 1, $html);
        $html = str_replace(":prixProduit:", $product["price"], $html);
        $html = str_replace(":totalProduit:", 1 * floatval($product["price"]), $html);
        // Date
        $html = str_replace(":dateFacture:", date('Ydm'), $html);
        //fin d'injection
        fclose($handle);
        $stylesheet = file_get_contents('public/css/facture.css'); // external css
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html,2);
        $path = "public/ressource/bill_pdf.pdf";
        $mpdf->Output($path);
        $data = file_get_contents($path);
        $base64 = base64_encode($data);
        unlink($path);
        $mpdf->Output();
        return $base64;
    }

    /**
     * Crée une facture
     * @param $id_product ID du produit
     */
    public static function createBill($id_product)
    {
        try
        {
            $db = Database::getPDO();
            $product = ProductManager::getProductById($id_product);
            $id_buyer = UserManager::getIdBySession();
            $id_seller = $product["id_user"];
            $sql = "INSERT INTO `billing`(`date`, `quantity`, `id_seller`, `id_buyer`, `id_product`, `bill_pdf`) VALUES (:date,:quantity,:id_seller,:id_buyer,:id_product, :bill_pdf)";

            $req = $db->prepare($sql);
            $tabParam = [
                ":date"=> date('Ydm'),
                ":quantity" => '1',
                ":bill_pdf" => self::createPDF($id_seller, $id_buyer, $id_product),
                ":id_seller" => $id_seller,
                ":id_buyer" => $id_buyer,
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
    /**
     * Recupere toutes les factures
     * @return PDOStatement $req PDOStatement du resultat de la requete
     */
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

    /**
     * Recupere une facture par son ID
     * @param $id_facture ID de la facture a récuperer
     * @return PDOStatement $req Facture
     */
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
    /**
     * Met a jour une facture
     * @return bool $result Vrai si Update reussis sinon Faux
     */
    public static function updateBillById($id)
    {
        $db = Database::getPDO();
        $sql = "UPDATE billing
                SET date = :date,
                quantity = :quantity,
                bill_pdf = :pdf,
                id_seller = :id_seller,
                id_buyer = :id_buyer,
                id_product = :id_product";
    }

    //DELETE
    /**
     * Supprime une facture
     * @return bool $result Vrai si Update reussis sinon Faux
     */
    public static function deleteBillById($id)
    {
        $db = Database::getPDO();
        $sql = "DELETE FROM billing WHERE id_billing = $id";
        return $db->query($sql) != FALSE;
    }
}