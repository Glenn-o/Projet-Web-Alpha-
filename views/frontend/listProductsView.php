<?php
$title = "Mes produits";
$css = "listProducts";
ob_start() 
?>

<h1> Mes produits </h1>

<?php
while ($data = $req->fetch(PDO::FETCH_ASSOC))
{
?>
    <p><?= $data["name"] ?></p>
    <p><?= $data["description"] ?></p>
    <p><?= $data["price"] ?></p>
    <img id="produit" src="data:image/jpg/png;base64,<?= base64_encode($data['image1']) ?>" >;
<?php
}
$req->closeCursor();
?>

<?php 
$content = ob_get_clean();
require "template.php";
?>
