<?php
$title = "Mes produits";
$css = "productSearch.css";
ob_start() 
?>
<section id="main">
<?php
foreach($res as $index=>$value)
{
?>
    <a class="a_product" href="index.php?page=ad&product=<?= $value["id_product"] ?> ">
        <div class="div_product">
            <img id="produit" src="data:image/jpg/png;base64,<?= $value['cover_image'] ?>" >
            <div id="div_info_product">
                <p class="name_product"><?= $value["name"] ?></p>
                <p class="price_product"><?= $value["format_price"] ?>€</p>
                <p class="description_product"><?= $value["description"] ?> </p>
            </div>
            <div id="div_info_user">
                <p><?= $value["city"]?></p>
            </div>
        </div>
    </a>
<?php
}
// $req->closeCursor();
?>
<form action="" method="POST">
    <input type="hidden" name="category" value="<?= $category ?>">
    <input type="hidden" name="location" value="<?= $location ?>">
    <input type="hidden" name="research" value="<?= $research ?>">
<?php
if($pageNbr > 1)
{
    $beforePage = $pageNbr - 1 ;
    print '<input type="submit" name="pageNbr" value="'.$beforePage.'">';
}
if($pageNbr < $nbrPage)
{
    $afterPage = $pageNbr + 1;
    print '<input type="submit" name="pageNbr" value="'.$afterPage.'">';
}
?>
</form>
</section>
<?php
$content = ob_get_clean();
require "template.php";
?>
