<?php

require_once "models/Database.class.php";
require_once "models/Manager.class.php";

class ProductManager extends Manager
{
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
        //DATABASE
        $db = Database::getPDO();
        //PREMIUM
        $name = GETPOST('name');
        $price = GETPOST('price');
        $description = GETPOST('$description');
        $state = GETPOST('state');
        $city = GETPOST('city');
        $status = GETPOST('status');
        switch (GETPOST('categorie'))
        {
            case 'console': $id_product_type = 1;
            case 'jeu': $id_product_type = 2;
            case 'accessoire': $id_product_type = 3;
            default: $id_product_type = 1;
        }
        $premium = GETPOST("premium") ? true : false;
        $image = base64_encode(GETPOST("image"));
        //REQUETE
        $sql = "INSERT INTO `product`(`name`, `price`, `description`, `state`, `premium`, `city`, `status`, `id_product_type`, `id_user`) VALUES (:name,:price,:description,:state,:premium,:city,:status,:id_product_type,:id_user)";
        $req = $db->prepare($sql);
        $tabParam = [
            ":name"=>$name,
            ":price" => $price,
            ":description" => $description,
            ":state" => $state,
            ":premium" => $premium,
            ":city" => $city,
            ":status" => $status,
            ":id_product_type" => $id_product_type,
            ":id_user" => $id_user
        ];
    }
    #endregion

    #region READ
    public static function getProductById($id)
    {
        $db = Database::getPDO();
        $sql = "SELECT * from product where id_product = ".$id;
        $result = $db->query($sql);
        if($result != false)
        {
            return $result;
        }

    }

    // Recupere toutes les photos d'une annonce
    public static function getAllPictureByProductID($id) : array
    {
        $db = Database::getPDO();
        $sql = "SELECT image FROM product_image WHERE id_product = ".$id;
        $result = $db->query($sql);
        return $result;
    }

    // Recupere toutes les annonces
    public static function getAllProducts()
    {
        $db = Database::getPDO();
        $sql = "SELECT * from product";
        $result = $db->query($sql);
        if($result != false)
        {
            return $result;
        }
        else
            return FALSE;

    }

    public static function getProductByFilter($location, $research, $category)
    {
        $db = Database::getPDO();
        // Create sql
        $sql = 'SELECT * FROM product as Prod';
        $tabWhere = [];
        if($category !== 'default') {
            $tabWhere[] = "Type.name = '$category'";
            $sql .= " INNER JOIN product_type as Type ON Type.id_product_type = Prod.id_product_type";
        }
        if($research !== "") {
            $tabWhere[] = "Prod.name LIKE '%$research%'";
        }
        if($location != "") {
            $tabWhere[] = "Prod.city = '$location'";
        }
        if(count($tabWhere) > 0)
        {
            $sql .= ' WHERE '.join(" and ", $tabWhere);
        }

        return $db->query($sql);
    }

    public static function getProductsByUserId($user_id)
    {
        $db = Database::getPDO();
        $req = $db->prepare("SELECT * FROM product WHERE id_user = ?");
        $req->execute([$user_id]);
        return $req;
    }

    // Retourne un tableau d'enregistrement selon un numero de page et un numero maximum de produit
    public static function getAllByPage($pageNbr, $maxProduct)
    {
        $db = Database::getPDO();
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
        $db = Database::getPDO();
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
        $db = Database::getPDO();
        $sql = "DELETE FROM product WHERE product_id = ".$id;
        $result = $db->query($sql);
        return $result != FALSE;
    }
    #endregion
}