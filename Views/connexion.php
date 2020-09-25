<?php
error_reporting(E_ALL);
session_start();
require_once '../include/dbcon.php';
include '../include/class/User.class.php';
if(!empty($_POST)){
    if (!User::tryConnexion($_POST["name"], $_POST["password"]))
    {
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="name">
        <input type="text" name = "password">
        <input type="submit">
    </form>
    <a href="inscription.php"><p>Créer un compte</p></a>
</body>
</html>