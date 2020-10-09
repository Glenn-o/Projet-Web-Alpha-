<?php
$title = "Contact";
$css = "contact.css";
ob_start(); ?>
<section id="main">
    <h1> Contact </h1>
    <form action="" method="POST">
        <h2> Rentrez vos sujets et message </h2>
        <input type="email" placeholder="email" name ="email" id="email">
        <input id="subject" type="text" placeholder="Sujet" name="subject">
        <input id="message" type="text" placeholder="Message" name ="message">
        <input name="action" value="mail" type="hidden">
        <input id="submit" type="submit">Envoyer</input>
    </form>
</section>

<?php $content = ob_get_clean() ?>

<?php require "template.php" ?>