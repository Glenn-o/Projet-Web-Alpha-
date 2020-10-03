<?php


require_once "models/Database.class.php";

class UserManager
{
    /*
    Info Users

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
        $db = Database::getPDO();
        $password = sha1($password);
        $checkUserSQL = 'SELECT username FROM users WHERE username =  "'.$userName.'"';
        $resultUser = $db->query($checkUserSQL);
        if($resultUser->rowCount() > 0) // Si user trouvé grace a nom
        {
            $checkPassword = 'SELECT password FROM users WHERE password = "'.$password.'"';
            $resultUser = $db->query($checkPassword);
            if($resultUser->rowCount() > 0) // Si mot de passe correspond
            {
                $_SESSION["name"] = $_POST["username"];

                header('Location: index.php');
                return true;
            }
            else
            {
                return false;
            }
        }
        $db = null;
        return false;
    }

    public static function deconnexion()
    {
        session_unset();
        session_destroy();
    }
    #endregion

    #region CREATE
    public static function createUser() : bool
    {
        $db = Database::getPDO();
        $password = sha1(GETPOST("password"));
        $avatar = UserManager::getFile();
        $sql = "INSERT INTO `users`(`lastname`, `firstname`, `address`, `city`, `postal_code`, `country`, `phone`, `email`, `username`, `password`, `avatar`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        $tabParam = [
            GETPOST('lastName'),
            GETPOST('firstName'),
            GETPOST('address'),
            GETPOST('city'),
            GETPOST('postalCode'),
            GETPOST("country"),
            GETPOST('phone'),
            GETPOST('email'),
            GETPOST('userName'),
            $password,
            $avatar
        ];
        $req = $db->prepare($sql);
        $req->execute($tabParam);
        if($req != FALSE) {
            header('Location: index.php?page=connexion');
        } 
        else {
            return FALSE;
        }
        
    }
    #endregion

    #region READ
    //Recupere un User par son ID
    public static function getUserById($id)
    {
        $db = Database::getPDO();
        $sql = "SELECT * from users where id_user = ".$id;
        $result = $db->query($sql);
        if($result != FALSE)
        {
            return $result->fetch(PDO::FETCH_ASSOC);
        }

    }
    // Recupere toutes les annonces
    public static function getAllUsers()
    {
        $db = Database::getPDO();
        $sql = "SELECT * from users";
        $result = $db->query($sql);
        if($result != FALSE)
        {
            return $result;
        }
        else
            return FALSE;

    }
    #endregion

    #region UPDATE
    public static function updateUserById($id)
    {
        $db = Database::getPDO();
        $password = sha1(GETPOST("password"));
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
        $sql = "UPDATE users SET lastname = '?', firstname = '?', adress = '?', city = '?', postal_code = '?', country = '?', phone = ?, email = '?', username = '?', password = '?'";
        $tabParam = [GETPOST("lastName"), GETPOST('firstName'), GETPOST('address'), GETPOST('city'), GETPOST('postalCode'),GETPOST("country"), GETPOST('phone'), GETPOST('email'), GETPOST('username'), $password];
        if($avatar != "")
        {
            $sql .= "avatar = ?";
            $tabParam[] = $avatar;
        }
        $sql .= " WHERE id_user = ".$id;

        $req = $db->prepare($sql);
        $result = $req->execute($tabParam);
        return $result != FALSE;
    }
    #endregion

    #region DELETE
    public static function deleteUserById($id)
    {
        $db = Database::getPDO();
        $sql = "DELETE FROM users WHERE id = ".$id;
        $result = $db->query();
        return $result != FALSE; // Si ok retourne vrai, sinon faux
    }
    #endregion


    #region Utils
    public static function getFile(){
        $directory = "public/img/";
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
        $db = Database::getPDO();
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