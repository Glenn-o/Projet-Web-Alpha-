<?php
$title = "Page Admin";
$css = "adminSpace.css";

ob_start(); ?>

<h1> La mega Teuf en fait ! </h1>
<h2> Le pourquoi du comment </h2>

<?php $content = ob_get_clean() ?>

<?php require "template.php" ?>