<?php

require_once "models/Manager.class.php";
require_once "models/Database.class.php";

class UserManager extends Manager
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
    public static function createUser(&$errorMessage) : bool
    {
        // print_r([$_POST["password"], $_POST["password_confirmed"]]);
        if(GETPOST("password") !== GETPOST("password-confirmed"))
        {
            $errorMessage = "Les champs mot de passe ne correspondent pas";
            return FALSE;
        }
        $db = Database::getPDO();
        $password = sha1(GETPOST("password"));
        $avatar = parent::getFile('avatar');
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
        
        try{
            $req = $db->prepare($sql);
            $req->execute($tabParam);
            header('Location: index.php?page=connexion');
        }
        catch(PDOException $error )
        {
            if($error->getCode() == '23000')
                $errorMessage = "Utilisateur existant : ". GETPOST('userName');
            return false;
        }
        
    }
    #endregion

    #region READ
    //Recupere un User par son ID
    public static function getUserByUsername($userName)
    {
        $db = Database::getPDO();
        $req = $db->prepare("SELECT * from users where username = ?");
        $req->execute([$_SESSION["name"]]);
        return $req->fetch(PDO::FETCH_ASSOC);

    }

    public static function getUserById($id)
    {
        $db = Database::getPDO();
        $req = $db->prepare("SELECT * from users where id_user = ?");
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);

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
    public static function updateUserById($id, &$errorMessage) : bool
    {
        $db = Database::getPDO();
        //GESTION CHAMPS NORMAUX
        try{
            $tabUpdate =  [];
            if(GETPOST("lastname") != "")
                $tabUpdate["lastname"] = GETPOST("lastname");
            if(GETPOST("firstname") != "")
                $tabUpdate["firstname"] = GETPOST("firstname");
            if(GETPOST("address") != "")
                $tabUpdate["address"] = GETPOST("address");
            if(GETPOST("city") != "")
                $tabUpdate["city"] = GETPOST("city");
            if(GETPOST("postal_code") != "")
                $tabUpdate["postal_code"] = GETPOST("postal_code");
            if(GETPOST("country") != "")
                $tabUpdate["country"] = GETPOST("country");
            if(GETPOST("phone") != "")
                $tabUpdate["phone"] = GETPOST("phone");
            if(GETPOST("email") != "")
                $tabUpdate["email"] = GETPOST("email");
            if(GETPOST("username") != "")
                $tabUpdate["username"] = GETPOST("username");
            $tabUpdate["config_news"] = GETPOSTEMPTY("newsletter") ? "1" : 0;
            $tabUpdate["config_part"] = GETPOSTEMPTY("partnernews") ? "1" : 0;
            
            //GESTION PASSWORD
            if(GETPOSTEMPTY("password") and GETPOSTEMPTY("password_confirmed") and GETPOSTEMPTY("old_password"))
            {
                if(GETPOST("password") === GETPOST("password_confirmed"))
                {
                    if(GETPOSTEMPTY("old_password"))
                    {
                        $oldPassword = sha1(GETPOST("old_password"));
                        if(self::getPassword($id) === $oldPassword)
                        {
                            $tabUpdate["password"] = sha1(GETPOST("password"));
                        }
                        else
                        {
                            throw new Exception("Ancien mot de passe erroné");
                        }
                    }
                    else
                    {
                        throw new Exception("Ancien mot de passe non rempli");
                    }
                }
                else
                {
                    throw new Exception("Mots de passe de confirmation différent");
                }
            }
            
            //Gestion avatar
            if(!empty($_FILES['avatar']['name'])){ // Si image envoyé dans formulaire, on va la chercher
                $tabUpdate['avatar'] = parent::getFileWithDefault('avatar');
            }

            $sql = "UPDATE users SET ";


            $tabParamJoint = [];
            foreach($tabUpdate as $field => $value)
            {
                $tabParamJoint[] = " $field = :$field";
            }

            $sql .= join(',' ,$tabParamJoint);

            $sql .= " WHERE id_user = ".$id;

            $req = $db->prepare($sql);
            $result = $req->execute($tabUpdate);
            return true;
        }
        catch(Exception $error )
        {
            if($error->getCode() == '23000')
                $errorMessage = "Utilisateur existant : ". GETPOST('userName');
            else
                $errorMessage = $error->getMessage();
            return false;
        }
    }

    public static function getTypeById($id)
    {
        $db = Database::getPDO();
        $sql = "SELECT id_user_type FROM users WHERE id_user = ".$id;
        $result = $db->query($sql)->fetch(PDO::FETCH_ASSOC)["id_user_type"];
        return $result;
    }
    #endregion

    #region DELETE
    public static function deleteUserById($id)
    {
        $db = Database::getPDO();
        $sql = "DELETE FROM users WHERE id_user = ".$id;
        $result = $db->query();
        return $result != FALSE; // Si ok retourne vrai, sinon faux
    }
    #endregion


    #region Utils

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

    public static function getIDByName($userName)
    {
        $db = Database::getPDO();
        $req = $db->prepare("SELECT id_user FROM users WHERE username = ?");
        $req->execute([$userName]);
        return $req->fetch(PDO::FETCH_ASSOC)["id_user"];
    }

    public static function getIdBySession()
    {
        if(!empty($_SESSION["name"]))
        {
            return self::getIDByName($_SESSION["name"]);
        }
        else
            return FALSE;
    }

    public static function getUserBySession()
    {
        if(!empty($_SESSION["name"]))
        {
            return self::getUserByUsername($_SESSION["name"]);
        }
        else
            return FALSE;
    }
    #endregion

    #region Getter
    public static function getPassword($id)
    {
        $db = Database::getPDO();
        $req = $db->prepare("SELECT password FROM users WHERE id_user = ?");
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC)["password"];
    }
    #endregion

    #region Setter

    #endregion
}