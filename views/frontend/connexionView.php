<?php
$title = "Connexion";
$css = "connexion.css";

ob_start(); ?>

<h1> Connexion <h1/>
<h2> Rentrez vos identifiants et mot de passe <h2/>

<form action="index.php?page=connexion&action=tryConnexion" method="POST">
    <input type="text" name="username">
    <input type="text" name = "password">
    <input type="submit">
</form>
<?= $message ?>
<a href="index.php?page=inscription"><p>Créer un compte</p></a>

<?php $content = ob_get_clean() ?>

<?php require "template.php" ?>