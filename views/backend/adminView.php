<?php
$title = "Page Admin";
$css = "adminSpace.css";

ob_start(); ?>

<h1 style="text-align: center;">Bienvenue sur l'espace Administrateur, veuillez selectionner un onglet</h1>
<?php $content = ob_get_clean() ?>

<?php require "template.php" ?>