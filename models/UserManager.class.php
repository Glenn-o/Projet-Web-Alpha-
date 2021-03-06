<?php

require_once "models/Manager.class.php";
require_once "models/Database.class.php";

class UserManager extends Manager
{

    #region FONCTIONS CONNEXION / INSCRIPTION
    
    /**
     * @param string $userName Nom utilisateur
     * @param string $password mot de passe de l'utilisateur
     * @return bool Resultat de la connexion
     */
    public static function tryConnexion(string $userName, string $password) : bool
    {
        $db = Database::getPDO();
        $password = sha1($password);
        $checkUserSQL = 'SELECT password FROM users WHERE username = "'.$userName.'" and password = "'.$password.'"';
        $resultUser = $db->query($checkUserSQL);
        if($resultUser->rowCount() > 0) // Si user trouvé grace a nom
        {
            $_SESSION["name"] = $_POST["username"];

            header('Location: index.php');
            return true;
        }
        $db = null;
        return false;
    }

    /**
     * Deconnecte la session actuelle
     */
    public static function logout()
    {
        session_unset();
        session_destroy();
    }
    #endregion

    #region CREATE
    /**
     * Crée un nouvel utilisateur
     * @param  string $message Reference a la variable qui contiendra le message
     * @return bool Resultat de la creation
     * @throws \Exception Si erreur lors de la creation de l'utilisateur
    */
    public static function createUser(&$message)
    {
        if(Utils::GETPOST("password") !== Utils::GETPOST("password-confirmed"))
        {
            throw new Exception("Mot de passe non similaire");
        }
        $db = Database::getPDO();
        $password = sha1(Utils::GETPOST("password"));
        $avatar = parent::getFile('avatar');
        $sql = "INSERT INTO `users`(`lastname`, `firstname`, `address`, `city`, `postal_code`, `country`, `phone`, `email`, `username`, `password`, `avatar`, config_news, config_part, id_user_type) VALUES (:lastName,:firstName,:address,:city,:postalCode,:country,:phone,:email,:userName,:password,:avatar, 0, 0, 1)";

        $tabParam = [
            ":lastName" => Utils::GETPOST('lastName'),
            ":firstName" => Utils::GETPOST('firstName'),
            ":address" => Utils::GETPOST('address'),
            ":city" => Utils::GETPOST('city'),
            ":postalCode" => Utils::GETPOST('postalCode'),
            ":country" => Utils::GETPOST("country"),
            ":phone" => Utils::GETPOST('phone'),
            ":email" => Utils::GETPOST('email'),
            ":userName" => Utils::GETPOST('userName'),
            ":password" => $password,
            ":avatar" => $avatar
        ];
        
        try{
            $req = $db->prepare($sql);
            $req->execute($tabParam);
            header('Location: index.php?page=login');
            return true;
        }
        catch(Exception $error )
        {
            if($error->getCode() == '23000')
                $message = "Utilisateur existant : ". Utils::GETPOST('userName');
            else
                $message = $error->getMessage();
        }
        
    }
    #endregion

    #region READ
    /**
     * Recupere un utilisateur par son nom d'utilisateur
     * @param $userName Nom de l'utilisateur
     * @return $req     tableau associatif avec info de l'utilisateur
     */
    public static function getUserByUsername($userName)
    {
        $db = Database::getPDO();
        $req = $db->prepare("SELECT * from users where username = ?");
        $req->execute([$userName]);
        return $req->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * Recupere un utilisateur par son nom d'utilisateur
     * @param $id_user Nom de l'utilisateur
     * @return $req    Tableau associatif avec info de l'utilisateur
     */
    public static function getUserById($id_user)
    {
        $db = Database::getPDO();
        $req = $db->prepare("SELECT * from users where id_user = ?");
        $req->execute([$id_user]);
        return $req->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * Recupere tout les utilisateurs
     * @return PDOStatement $req Retourne le resultat de la requete
    */
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

    /**
     * Recupere le role d'un utilisateur
     * @param $id_user Retourne le resultat de la requete
    */
    public static function getTypeById($id_user)
    {
        #INNER JOIN user_type Role ON User.id_user_type = Role.id_user_type
        $db = Database::getPDO();
        $sql = "SELECT id_user_type FROM users User
                WHERE id_user = ".$id_user;
        $result = $db->query($sql)->fetch(PDO::FETCH_ASSOC)["id_user_type"];
        return $result;
    }

    /**
     * Recupere un utilisateur par la Session
     * @return string Tableau associatif si session, sinon faux 
     */
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

    #region UPDATE
    /**
     * Met a jour un utilisateur.
     * @param string $user_id Id du de l'utilisateur a modifier
     * @param string &$message Reference au message qui sera affiché en cas d'erreur
     * @return bool Vrai si l'utilisateur a bien été update, sinon Faux.
    */
    public static function updateUserById($id, &$message) : bool
    {
        $db = Database::getPDO();
        //GESTION CHAMPS NORMAUX
        try{
            $tabUpdate =  [];
            if(Utils::GETPOST("lastname") != "")
                $tabUpdate["lastname"] = Utils::GETPOST("lastname");
            if(Utils::GETPOST("firstname") != "")
                $tabUpdate["firstname"] = Utils::GETPOST("firstname");
            if(Utils::GETPOST("address") != "")
                $tabUpdate["address"] = Utils::GETPOST("address");
            if(Utils::GETPOST("city") != "")
                $tabUpdate["city"] = Utils::GETPOST("city");
            if(Utils::GETPOST("postal_code") != "")
                $tabUpdate["postal_code"] = Utils::GETPOST("postal_code");
            if(Utils::GETPOST("country") != "")
                $tabUpdate["country"] = Utils::GETPOST("country");
            if(Utils::GETPOST("phone") != "")
                $tabUpdate["phone"] = Utils::GETPOST("phone");
            if(Utils::GETPOST("email") != "")
                $tabUpdate["email"] = Utils::GETPOST("email");
            if(Utils::GETPOST("username") != "")
                $tabUpdate["username"] = Utils::GETPOST("username");
            $tabUpdate["config_news"] = Utils::ISGETPOST("newsletter") ? "1" : 0;
            $tabUpdate["config_part"] = Utils::ISGETPOST("partnernews") ? "1" : 0;
            
            //GESTION PASSWORD
            if(Utils::ISGETPOST("password") and Utils::ISGETPOST("password_confirmed") and Utils::ISGETPOST("old_password"))
            {
                if(Utils::GETPOST("password") === Utils::GETPOST("password_confirmed"))
                {
                    if(Utils::ISGETPOST("old_password"))
                    {
                        $oldPassword = sha1(Utils::GETPOST("old_password"));
                        if(self::getPassword($id) === $oldPassword)
                        {
                            $tabUpdate["password"] = sha1(Utils::GETPOST("password"));
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
                $message = "Utilisateur existant : ". Utils::GETPOST('userName');
            else
                $message = $error->getMessage();
            return false;
        }
    }
    #endregion

    #region DELETE
    public static function deleteUserById($id)
    {
        if(UserManager::getIdBySession() == $id)
        {
            return false;
        }
        ProductManager::deleteAllByUser($id);
        $db = Database::getPDO();
        $sql = "DELETE FROM users WHERE id_user = ".$id;
        $result = $db->query($sql);
        return $result != FALSE; // Si ok retourne vrai, sinon faux
    }
    #endregion

    #region Getter
    /**
     * Recupere le mot de passe
     * @return $req Mot de passe crypté de l'utilisateur
     */
    public static function getPassword($id)
    {
        $db = Database::getPDO();
        $req = $db->prepare("SELECT password FROM users WHERE id_user = ?");
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC)["password"];
    }

    /**
     * Recupere l'avatar
     * @return $req Image en base64
     */
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

    /**
     * Retourne l'ID selon un nom
     * @param $userName Nom de l'utilisateur
     * @return $req ID de l'utilisateur
     */
    public static function getIDByName($userName)
    {
        $db = Database::getPDO();
        $req = $db->prepare("SELECT id_user FROM users WHERE username = ?");
        $req->execute([$userName]);
        return $req->fetch(PDO::FETCH_ASSOC)["id_user"];
    }

     /**
     * Retourne l'ID de la session actuelle
     * @return int ID de l'utilisateur ou Faux si pas de session
     */
    public static function getIdBySession()
    {
        if(!empty($_SESSION["name"]))
        {
            return self::getIDByName($_SESSION["name"]);
        }
        else
            return FALSE;
    }

    /**
     * Retourne le role de la session actuelle
     * @return int Role de l'utilisateur ou 0 si pas de session
     */
    public static function getTypeBySession()
    {
        #INNER JOIN user_type Role ON User.id_user_type = Role.id_user_type
        if(!empty($_SESSION["name"]))
        {
            $db = Database::getPDO();
            $idUser = self::getIDByName($_SESSION["name"]);
            $sql = "SELECT id_user_type FROM users User
                    WHERE id_user = ?";
            $req = $db->prepare($sql);
            $req->execute([$idUser]);
            return $req->fetch(PDO::FETCH_ASSOC)["id_user_type"];
        }
        else
        {
            return 0;
        }
    }
    #endregion

    #region Setter

    #endregion
}