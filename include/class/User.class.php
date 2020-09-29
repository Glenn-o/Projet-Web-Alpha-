<?php
class User
{
    /*
    id int auto_increment
    lastname string
    firstname string 
    adress string
    city string
    postal_code string
    country string
    phone number
    email string
    appreciation float
    avatar blob/base64
    username string
    password string/sha1
    */

    #region FONCTIONS CONNEXION / INSCRIPTION
    public static function tryConnexion(string $userName, string $password) : bool
    {
        $db = getConn();
        if($userName !== "") // Si nom renseigné
        {
            $password = sha1($password);
            $checkUserSQL = 'SELECT username FROM users WHERE username =  "'.$userName.'"';
            $resultUser = $db->query($checkUserSQL);
            if($resultUser->rowCount() > 0) // Si user trouvé grace a nom
            {
                if($password != "") // Si mot de passe renseigné
                {
                    $checkPassword = 'SELECT password FROM users WHERE password = "'.$password.'"';
                    $resultUser = $db->query($checkPassword);
                    if($resultUser->rowCount() > 0) // Si mot de passe correspond
                    {
                        $_SESSION["name"] = $_POST["name"];

                        header('Location: ../index.php');
                        return true;
                    }
                    else
                    {
                        print("Mauvais mot de passe");
                    }
                }
            }
        }
        else
        {
            print("Nom d'utilisateur nom renseigné");
        }
        return false;
        $db = null;
    }

    public static function deconnexion()
    {
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
    #endregion

    #region CREATE
    public static function createUser() : bool
    {
        $db = getConn();
        $password = sha1($_POST["password"]);
        $avatar = User::getFile();
        $insertUserSQL = "INSERT INTO `users`(`lastname`, `firstname`,`username`,`password`, `address`, `city`, `postal_code`, `country`, `phone`, `email`, `avatar`) VALUES ('".$_POST["lastName"]."', '".$_POST["firstName"] ."','".$_POST["userName"]."','".$password."','".$_POST["address"]."','".$_POST["city"]."','". $_POST["postalCode"] ."', '". $_POST["country"]."',".$_POST["phone"].",'".$_POST["email"]."','".$avatar."')";        
        $insert = $db->exec($insertUserSQL);
        if($insert !== FALSE){
            echo "vous etes inscrit";
            $db = null;
            return true;
        }
        else{
            echo "L'inscription n'a pas marché";
            $db = null;
            return false;
        }
        
    }
    #endregion

    #region READ
    //Recupere un User par son ID
    public static function getUserById($id)
    {
        $db = getConn();
        $sql = "SELECT * from users where id_user = ".$id;
        $result = $db->query($sql);
        if($result != FALSE)
        {
            return $result->fetch(PDO::FETCH_ASSOC);
        }

    }
    // Recupere toutes les annonces
    public static function getAllUser()
    {
        $db = getConn();
        $sql = "SELECT * from users";
        $result = $db->query($sql);
        if($result != FALSE)
        {
            return $result->fetch_all();
        }
        else
            return FALSE;

    }
    #endregion
    
    #region UPDATE
    public static function updateUserById($id)
    {
        $db = getConn();
        $password = sha1($_POST["password"]);
        $avatar = "";
        if(!empty($_FILES['avatar']['name'])){ // Si image envoyé dans formulaire, on va la chercher
            $tmp_name = $_FILES['avatar']['tmp_name'];
            $name = basename($_FILES['avatar']['name']);
            move_uploaded_file($tmp_name, "$directory/$name");
            $path = $directory. $name ;
            $data = file_get_contents($path);
            $avatar = base64_encode($data);
            unlink($path);
        }
        $sql = "UPDATE users SET ";
        $sql .= "name = '".$_POST["lastname"]."', firstname = '".$_POST["firstname"]."',";
        $sql .= "adress = '".$_POST["adress"]."', city = '".$_POST["city"]."',";
        $sql .= "postal_code = '".$_POST["postal_code"]."', country = '".$_POST["country"]."',";
        $sql .= "phone = ".$_POST["price"].", email = '".$_POST["email"]."',";
        $sql .= "username = '".$_POST["username"]."',";
        $sql .= "password = '".$password."', fk_product_id = ".$_POST["categorie"];
        if($avatar != "")
            $sql .= "avatar = ".$avatar;
        $sql .= " WHERE id_user = ".$id;
        $result = $db->query($sql);
        return $result != FALSE;
    }
    #endregion

    #region DELETE
    public static function deleteUserById($id)
    {
        $db = getConn();
        $sql = "DELETE FROM users WHERE id = ".$id;
        $result = $db->query();
        return $result != FALSE; // Si ok retourne vrai, sinon faux
    }
    #endregion


    #region Utils
    public static function findAvatar(){
        $directory = "../assets/img/";
        if(!empty($_FILES['avatar']['name'])){ // Si image envoyé dans formulaire, on va la chercher
            $tmp_name = $_FILES['avatar']['tmp_name'];
            $name = basename($_FILES['avatar']['name']);
            move_uploaded_file($tmp_name, "$directory/$name");
            $path = $directory. $name ;
            $data = file_get_contents($path);
            $base64 = base64_encode($data);
            unlink($path);
            return $base64; 
        }else{                              // Sinon on prend celle par defaut
            $data = file_get_contents("$directory/user.png");
            return base64_encode($data);
        }
    }

    public static function checkUsername(string $username)
    {
        $sql = "SELECT * from users WHERE username";
    }

    public static function getAvatar(string $username)
    {
        $db = getConn();
        $sql = "SELECT avatar from users WHERE username = '".$username."'";
        $result = $db->query($sql);
        if($result != FALSE)
        {
            $enregistrement = $result->fetch(PDO::FETCH_ASSOC);
            return $enregistrement["avatar"];
        }
        $db = null;
    }
    #endregion
}
?>