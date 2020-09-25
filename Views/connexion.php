<?php
require_once '../include/dbcon.php';
include '../include/class/User.class.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces</title>
    <link href="../assets/css/ad.css" rel="stylesheet">
    <link href="../assets/css/header.css" rel="stylesheet">
    <link href="../assets/css/footer.css" rel="stylesheet">
</head>
<body>
    <?php require_once "../include/header.php";
    if(!empty($_POST)){
        if (!User::tryConnexion($_POST["name"], $_POST["password"]))
        {
        }
    }
    ?>
    <form action="" method="POST">
        <input type="text" name="name">
        <input type="text" name = "password">
        <input type="submit">
    </form>
    <a href="inscription.php"><p>Créer un compte</p></a>
</body>
</html>