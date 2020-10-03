<?php
$title = "Test Template";
$css = "index.css";

ob_start(); ?>

<h1> La mega Teuf en fait ! </h1>
<h2> Le pourquoi du comment </h2>

<?php
while($data = $req->fetch(PDO::FETCH_ASSOC))
{
?>
<p><?= $data["name"] ?>
<p><?= $data["description"] ?>
<?php
}
$req->closeCursor();
?>

<?php $content = ob_get_clean() ?>

<?php require "template.php" ?>