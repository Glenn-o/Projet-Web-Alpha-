<?php
class User
{
    // var $id;
    // var $lastName;
    // var $firstName;
    // var $address;
    // var $city;
    // var $postalCode;
    // var $country;
    // var $phone;
    // var $appreciation;
    // var $avatar;

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

    public static function tryRegister() : bool
    {
        $db = getConn();
        $password = sha1($_POST["password"]);
        $avatar = User::getFile();
        $insertUserSQL = 'INSERT INTO `users`(`lastname`, `firstname`,`password`, `address`, `city`, `postal_code`, `country`, `phone`, `email`, `avatar`) VALUES (' . $_POST["lastName"] . ', '.$_POST["firstName"] .','.$password.','.$_POST["address"].','.$_POST["city"].','. $_POST["postalCode"] .', '. $_POST["country"].','.$_POST["phone"].','.$_POST["email"].', '.$avatar.')';        
        $insert = $db->exec($insertUserSQL);
        if($insert === true){
            echo "vous etes inscrit";
            return true;
        }
        else{
            echo "L'inscription n'a pas marché";
            return false;
        }
        $db = null;
        // print $insertUserSQL;
        // print '<img id="produit" src="data:image/jpg/png;base64,'.$avatar.'">';
        
    }

    public static function getFile(){
        $directory = "../assets/img/";
        $tmp_name = $_FILES['avatar']['tmp_name'];
        $name = basename($_FILES['avatar']['name']);
        move_uploaded_file($tmp_name, "$directory/$name");
        $path = $directory. $name ;
        $data = file_get_contents($path);
        $base64 = base64_encode($data);
        unlink($path);
        return $base64;
    }

    public static function getMultiplesFiles() : array
    {
        print("Bonjour, voila vos fichiers");
        $returnFiles = [];
        return $returnFiles;
    }

    public static function getEmail() : string 
    {
        $db = getConn();

        $db = null;
    }

    public static function deconnexion() : bool
    {
        session_start();
        session_unset();
        session_destroy();
    }
    
}
?>