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

    public static function tryRegister(string $lastName, string $firstName, string $userName, string $address, string $city, string $postalCode, string $country, string $phone, float $appreciation, string $password, string $email, string $avatar) : boolean
    {
        $db = getConn();
        $insertUserSQL = 'INSERT INTO `users`(`lastname`, `firstname`, `address`, `city`, `postal_code`, `country`, `phone`, `email`, `appreciation`, `avatar`) VALUES (' . $lastName . ', '.$firstName.','.$address.','.$city.','. $postalCode.', '. $country.','.$phone.','.$email.','.$appreciation.', '.$avatar.')';        
        $insert = $db->exec($insertUserSQL);
        if($insert === true){
            echo "vous etes inscrit";
        }
        else{
            echo "L'inscription n'a pas marché";
        }
        $db = null;
    }

    public static function getEmail() : string 
    {
        $db = getConn();

        $db = null;
    }

    public static function checkUser(string $email, string $userName) : boolean
    {
        
    }
    
}
?>