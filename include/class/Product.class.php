<?php
require_once("../dbcon.php");
class Product {
    // Info product
    /*
    name string
    description string
    price float
    image1 blob
    image2 blob
    image3 blob
    image4 blob
    image5 blob
    state string
    city string
    premium bool
    id_product_type
    */


    #region CREATE
    public static function createProduct()
    {
        $db = getConn();
        $premium = $_POST["premium"] ? true : false;
        $image1 = base64_encode($_POST["image1"]);
        $sql = "INSERT INTO product(name, description, price, image1, state, city, premium, id_product_type) VALUES ";
        $sql .= "('".$_POST["name"]."','".$_POST["description"]."',".$_POST["price"].",'".$image1;
        $sql .= "','".$_POST["state"]."','".$_POST["city"]."',".$premium.")";
        $result = $db->query($sql);
        return $result != false;
    }
    #endregion

    #region READ
    public static function getProductById($id)
    {
        $db = getConn();
        $sql = "SELECT $ from product where id_product = ".$id;
        $result = $db->query($sql);
        if($result != false)
        {
            return $result->fetch(PDO::FETCH_ASSOC);
        }

    }

    // Recupere toutes les photos d'une annonce
    public static function getAllPictureByProductID($id) : array
    {
        $db = getConn();
        $sql = 'SELECT image1, ifnull(length(image2), ""), ifnull(length(image3), "")
                ,ifnull(length(image4), ""),ifnull(length(image5), "") from product';
        $result = $db->query($sql);
        if($result != FALSE)
        {
            return $result->fetch_all();
        }
        else
        {
            return FALSE;
        }
    }
    
    // Recupere toutes les annonces
    public static function getAllProduct()
    {
        $db = getConn();
        $sql = "SELECT $ from product";
        $result = $db->query($sql);
        if($result != false)
        {
            return $result->fetch_all();
        }
        else
        return FALSE;

    }

    // Retourne un tableau d'enregistrement selon un numero de page et un numero maximum de produit
    public static function getAllByPage($pageNbr, $maxProduct)
    {
        $db = getConn();
        $sql = "SELECT * FROM product";
        $result = $db->query($sql);
        $count = $result->rowCount();
        $all = $res->fetchAll();
        $nbrPage = ceil($count / $maxProduct);
        $capResult = $page * $maxProduct;
        if($capResult > $count)
        {
            $capResult = $count;
        }
        $start = ($page-1) * $maxProduct;
        $tabReturn = [];
        for($i=$start;$i< $capResult;$i++)
        {
            $tabReturn[] = $all[$i];
        }
        return $tabReturn;
    }
    #endregion

    #region UPDATE
    public static function updateProductById($id)
    {
        $db = getConn();
        $sql = "UPDATE product SET ";
        $sql .= "name = '".$_POST["name"]."', description = '".$_POST["description"]."',";
        $sql .= "price = ".$_POST["price"].", image1 = '".$image1."',";
        $sql .= "state = '".$_POST["state"]."', city = '".$_POST["city"]."', premium = ".$premium;
        $sql .= "fk_product_id = ".$_POST["categorie"];
        $sql .= " WHERE id_product = ".$id;
        $result = $db->query($sql);
        return $result != FALSE;
    }
    #endregion

    #region DELETE
    public static function deleteProductById()
    {
        $db = getConn();
        $sql = "DELETE FROM product WHERE product_id = ".$id;
        $result = $db->query($sql);
        return $result != FALSE;
    }
    #endregion

    
}