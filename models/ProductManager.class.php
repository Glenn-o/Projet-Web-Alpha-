<?php

require_once "models/Database.class.php";
require_once "models/Manager.class.php";


/**
 * Classe contant toutes les fonctions utile a la gestion des Produits / Annonces
 *
 * @author  FOGteam
 */
class ProductManager extends Manager
{
    #region CREATE
    /**
     * Crée un nouvel produit
     * @param  string $id_user ID de l'utilisateur qui a créé le produit
     * @param  string $message Reference a la variable qui contiendra le message
     * @throws \Exception Si erreur lors de la creation du produit
    */
    public static function createProduct($id_user, &$message)
    {
        //DATABASE
        $db = Database::getPDO();
        //PREMIUM
        try
        {
            if(Utils::GETPOSTSETEMPTY('name') or Utils::GETPOSTSETEMPTY('price') or Utils::GETPOSTSETEMPTY('description') or Utils::GETPOSTSETEMPTY('state') or Utils::GETPOSTSETEMPTY('city') or Utils::GETPOSTSETEMPTY('category'))
            {
                throw new Exception("Tout les champs ne sont pas renseignés");
            }
            $name = Utils::GETPOST('name');
            $price = Utils::GETPOST('price');
            $description = Utils::GETPOST('description');
            $state = Utils::GETPOST('state');
            $city = Utils::GETPOST('city');
            $status = Utils::GETPOST('status');
            switch (Utils::GETPOST('category'))
            {
                case 'console': $id_product_type = 1; break;
                case 'jeu': $id_product_type = 2; break;
                case 'accessoire': $id_product_type = 3; break;
                default: throw new Exception("Pas de categorie selectionné");
            }
            $premium = Utils::ISGETPOST("premium") ? '1' : '0';
            //REQUETE
            $sql = "INSERT INTO `product`(`name`, `price`, `description`, `state`, `premium`, `city`, `status`, `id_product_type`, `id_user`) VALUES (:name,:price,:description,:state,:premium,:city,1,:id_product_type,:id_user)";
            $req = $db->prepare($sql);
            $tabParam = [
                ":name"=>$name,
                ":price" => $price,
                ":description" => $description,
                ":state" => $state,
                ":city" => $city,
                ":premium" => $premium,
                ":id_product_type" => $id_product_type,
                ":id_user" => $id_user
            ];
            $req->execute($tabParam);
            $message = "Requete Reussi !";

            $image = parent::getFile('img_01');
            if($image != FALSE) // Si une image a été envoyé
            {
                $lastID = $db->lastInsertId();
                $req = $db->prepare("INSERT INTO `product_image`(`image`, `id_product`) VALUES (:image, :lastID)");
                $req->execute([':image'=>$image, ':lastID' => $lastID]);
                if($req !== FALSE)
                {
                    header("Location: index.php?page=ad&product=".$lastID);
                }
                else
                {
                    throw new Exception("Erreur a la creation de l'image.");
                }
            }
            
        }
        catch(Exception $error)
        {
            $message = $error->getMessage();
        }
    }
    #endregion

    #region READ
    /**
     * Recupere un produit
     * @param  string $id_product ID du produit souhaité
     * @return PDOStatement $req Retourne le resultat de la requete
    */
    public static function getProductById($id_product)
    {
        $db = Database::getPDO();
        $req = $db->prepare("SELECT
            Product.*,
            FORMAT(Product.price, 2) as format_price,
            (SELECT image FROM product_image Image 
            WHERE Image.id_product = Product.id_product  LIMIT 1) as image
            FROM product Product
            WHERE id_product = ?");
        $req->execute([$id_product]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Recupere un nombre d'enregistrement aleatoire
     * @param  string $nbr Nombre d'enregistrement souhaité
     * @return PDOStatement $req Retourne le resultat de la requete
    */
    public static function getRandomProductNumber($nbr)
    {
        $db = Database::getPDO();
        $req = $db->prepare("SELECT
            Product.*,
            (SELECT image FROM product_image Image 
            WHERE Image.id_product = Product.id_product  LIMIT 1) as image
            FROM product Product
            WHERE status = 1
            ORDER BY RAND()
            LIMIT :nbr");
        $req->bindParam(':nbr', $nbr, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }

    /**
     * Recupere toutes les images d'une annonce par l'ID de ce dernier
     * @param  string $id_product Nom de la categorie recherché
     * @return PDOStatement $req Retourne le resultat de la requete
    */
    public static function getAllPictureByProductID($id_product) : array
    {
        $db = Database::getPDO();
        $sql = "SELECT image FROM product_image WHERE id_product = ".$id_product;
        $result = $db->query($sql);
        return $result;
    }

    // Recupere toutes les annonces
    /**
     * Recupere toutes les annonces
     * @return PDOStatement $req Retourne le resultat de la requete
    */
    public static function getAllProducts()
    {
        $db = Database::getPDO();
        $sql = "SELECT
        Product.*,
        FORMAT(Product.price, 2) as format_price,
        (SELECT image FROM product_image Image 
        WHERE Image.id_product = Product.id_product LIMIT 1) as image
        FROM product Product";
        $req = $db->query($sql);
        return $req;
    }

    /**
     * Recupere toutes les annonces qui ne sont pas desactivés
     * @return PDOStatement $req Retourne le resultat de la requete
    */
    public static function getAllActiveProducts()
    {
        $db = Database::getPDO();
        $sql = "SELECT
        Product.*,
        (SELECT image FROM product_image Image 
        WHERE Image.id_product = Product.id_product  LIMIT 1) as image
        FROM product Product
        WHERE Product.status = 0";
        $result = $db->query($sql);
        return $req;
    }

    /**
     * Recupere toutes les annonces avec les filtres du formulaire de recherche
     * @param  string $location Ville recherché
     * @param  string $research Nom ou partie de nom recherché
     * @param  string $category Nom de la categorie recherché
     * @return PDOStatement $req Retourne le resultat de la requete
    */
    public static function getProductByFilter($location, $research, $category)
    {
        $db = Database::getPDO();
        // Create sql
        $sql = "SELECT Product.*,
        FORMAT(Product.price, 2) as format_price,
        (SELECT image FROM product_image Image 
        WHERE Image.id_product = Product.id_product  LIMIT 1) cover_image 
        FROM product as Product";
        $tabWhere = [];
        if($category !== 'default') {
            $tabWhere[] = "Type.name = '$category'";
            $sql .= " INNER JOIN product_type as Type ON Type.id_product_type = Product.id_product_type";
        }
        if($research !== "") {
            $tabWhere[] = "Product.name LIKE '%$research%'";
        }
        if($location != "") {
            $tabWhere[] = "Product.city = '$location'";
        }
        if(count($tabWhere) > 0)
        {
            $sql .= ' WHERE '.join(" and ", $tabWhere);
        }
        $sql .= " ORDER BY id_product DESC";

        return $db->query($sql);
    }

    /**
     * Recupere toutes les annonces créé par un utilisateur via l'ID de ce dernier
     * @param  string $user_id Id de l'utilisateur
     * @return PDOStatement $req Retourne le resultat de la requete
     *
    */
    public static function getProductsByUserId($user_id)
    {
        $db = Database::getPDO();
        $req = $db->prepare("SELECT
            Product.*,
            (SELECT image FROM product_image Image 
            WHERE Image.id_product = Product.id_product  LIMIT 1) cover_image
            FROM product Product
            WHERE id_user = ?");
        $req->execute([$user_id]);
        return $req;
    }

    #region UPDATE
    /**
     * Met a jour un produit.
     * @param string $user_id Id du produit a modifier
     * @return bool Vrai si le produit a bien été update, sinon Faux.
    */
    public static function updateProductById($id_product) : bool
    {
        $db = Database::getPDO();
        $sql = "UPDATE product SET name = :name , price = :price , description = :description , state = :state,premium = :premium , city = :city , status = :status WHERE id_product = :id_product";
        $tabParam = [
            ":name" => Utils::GETPOST("name"),
            ":price" => Utils::GETPOST("price"),
            ":description" => Utils::GETPOST("description"),
            ":state" => Utils::GETPOST("state"),
            ":premium" => Utils::GETPOST("premium"),
            ":city" => Utils::GETPOST("city"),
            ":status" => Utils::GETPOST("status"),
            ":id_product" => $id_product
        ];
        $result = $db->query($sql);
        return $result != FALSE;
    }

    /**
     * Change le status premium d'un produit
     * @param $id_product Id du produit a modifier
     * @param $value Nouvelle valeur
     * @return bool Vrai si le produit a bien été update, sinon Faux.
    */
    public static function setStatusById($id_product, bool $value) : bool
    {
        $db = Database::getPDO();
        $value = $value ? 'true' : 'false';
        $result = $db->query('UPDATE product SET status = '.$value .' WHERE id_product = '. $id_product);
        return $result != FALSE;
    }
    #endregion

    #region DELETE
    /**
     * Supprime un produit via son ID
     * @param $id_product Id du produit a supprimer
     * @return bool Vrai si le produit a bien été supprimé, sinon Faux.
    */
    public static function deleteProductById($id_product)
    {
        $db = Database::getPDO();
        $sql = "DELETE FROM product WHERE id_product = ".$id_product;
        $result = $db->query($sql);
        return $result != FALSE;
    }

    /**
     * Supprime tout les produits lié a un user
     * @param $id_user ID de l'utilisateur
     * @return bool Vrai si tout les produits ont été supprimé, sinon Faux
    */
    public static function deleteAllByUser($id_user)
    {
        $db = Database::getPDO();
        $sql = "DELETE FROM product WHERE id_user = ".$id_user;
        $result = $db->query($sql);
        return $result != FALSE; // Si ok retourne vrai, sinon faux
    }
    #endregion
}