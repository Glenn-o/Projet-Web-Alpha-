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
    <a class="a_product" href="index.php?page=ad&product=<?= $data["id_product"] ?> ">
        <div class="div_product">
            <img id="produit" src="data:image/jpg/png;base64,<?= $data['cover_image'] ?>" >
            <div id="div_info_product">
                <p class="name_product"><?= $data["name"] ?></p>
                <p class="price_product"><?= $data["format_price"] ?>€</p>
                <p class="description_product"><?= $data["description"] ?> </p>
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
