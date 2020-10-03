<?php
$title = "Connexion";
$css = "connexion.css";
ob_start(); ?>
<section id="main">
    <h1> Connexion </h1>
    
    <form action="index.php?page=connexion&action=tryConnexion" method="POST">
        <h2> Rentrez vos identifiants et mot de passe </h2>
        <input id="username" type="text" placeholder="Pseudo" name="username">
        <input id="password" type="password" placeholder="Mot de passe"name = "password">
        <input id="submit" type="submit">
    </form>
<p id="message_error"><?= $message ?></p>
    <a href="index.php?page=inscription"><p>Vous n'avez pas de compte ? <span>Créer un compte</span></p></a>
</section>

<?php $content = ob_get_clean() ?>

<?php require "template.php" ?>