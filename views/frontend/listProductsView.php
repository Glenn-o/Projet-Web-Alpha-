<?php
$title = "Mes produits";
$css = "listProduct.css";
ob_start() 
?>
<section id="main">
<?php
while ($data = $req->fetch(PDO::FETCH_ASSOC))
{
?>
    <a class="a_product" href="">
        <div class="div_product">
            <img id="produit" src="data:image/jpg/png;base64,<?= base64_encode($data['image1']) ?>" >
            <div id="div_info_product">
                <p class="name_product"><?= $data["name"] ?></p>
                <p class="price_product"><?= $data["price"] ?>€</p>
                <p class="description_product"><?= $data["description"] ?> kdofkdlfklkldsfkdlfsmfdslfksmfkdslfslmfkdsmlfkdsmfkdslmfkdslmfkdsfkm</p>
            </div>
            <div id="div_info_user">
                <p><?= $data["city"]?></p>
            </div>
        </div>
    </a>
<?php
}
$req->closeCursor();
?>
</section>
<?php 
$content = ob_get_clean();
require "template.php";
?>
