<?php

require "../include/dbcon.php";
require '../include/class/User.class.php';
if(!empty($_POST["firstName"]) and !empty($_POST["lastName"]) and !empty($_POST["userName"]) and 
!empty($_POST["address"]) and !empty($_POST["city"]) and !empty($_POST["postalCode"]) and 
!empty($_POST["country"]) and !empty($_POST["phone"]) and !empty($_POST["password"]) and
!empty($_POST["email"]))
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
    print 'Remplis les champs chien de la casse';
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
    <label>Nom de famille : <input type="text" name="firstName"><label><br>
    <label>Prenom : <input type="text" name="lastName" ><label/><br>
    <label>Nom d'utilisateur : <input type="text" name="userName" ><label/><br>
    <label>Adresse : <input type="text" name="address" ><label/><br>
    <label>Ville : <input type="text" name="city" ><label/><br>
    <label>Code Postal : <input type="text" name="postalCode" ><label/><br>
    <label>Pays : <input type="text" name="country" ><label/><br>
    <label>Téléphone : <input type="text" name="phone" ><label/><br>
    <label>Mot de passe : <input type="text" name="password" ><label/><br>
    <label>Confirmation : <input type="text" name="password-confirmed" ><label/><br>
    <label>Photo : <input type="file" name="avatar" ><label/><br>
    <button type="submit"> Valider </button>
    </form>
</body>
</html>