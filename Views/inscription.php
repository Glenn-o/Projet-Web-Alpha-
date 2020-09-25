<?php

require "../include/dbcon.php";
require '../include/class/User.class.php';
$wrongPassword = "";
if(!empty($_POST["firstName"]) and !empty($_POST["lastName"]) and !empty($_POST["userName"]) and 
!empty($_POST["address"]) and !empty($_POST["city"]) and !empty($_POST["postalCode"]) and 
!empty($_POST["country"]) and !empty($_POST["phone"]) and !empty($_POST["password"]) and
!empty($_POST["email"]))
{
    if($_POST["password"] === $_POST["password-confirmed"])
    {
        if(User::tryRegister())
        {
            print 'connexion reussi';
        }
        else
        {
            print 'connexion raté';
        }
    }
    else
    {
        $wrongPassword = "Mot de passe différent";
    }
    
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="firstName" placeholder = "Nom"><br>
    <input type="text" name="lastName"  placeholder = "Prénom"><br>
    <input type="text" name="userName"  placeholder = "Utilisateur"><br>
    <input type="text" name="address"  placeholder = "Adresse"><br>
    <input type="text" name="city"  placeholder = "Ville"><br>
    <input type="text" name="postalCode"  placeholder = "Code Postal"><br>
    <input type="text" name="country"  placeholder = "Pays"><br>
    <input type="text" name="phone"  placeholder = "Téléphone"><br>
    <input type="text" name="email"  placeholder = "Email"><br>
    <input type="text" name="password"  placeholder = "Mot de passe"><br>
    <input type="text" name="password-confirmed"  placeholder = "Confirmation"><p><?= $wrongPassword?></p><br>
    <label for="avatar">Avatar :</label>
    <input type="file" name="avatar" id="avatar"><br>
    <button type="submit"> Valider </button>
    </form>
</body>
</html>