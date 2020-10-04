<?php
$title = "Liste Utilisateurs";
$css = "adminSpace.css";
ob_start() 
?>
<section id="main">
<?php
while ($product = $reqProducts->fetch(PDO::FETCH_ASSOC))
{
?>
    <div class="div_user">
        <img id="produit" src="data:image/jpg/png;base64,<?= $product['image'] ?>" >
        <div id="div_info_user">
            <p class="lastName_user"><?= $product["name"] ?></p>
            <p class="firstName_user"><?= $product["price"] ?></p>
            <p class="username_user"><?= $product["state"] ?> </p>
        </div>
    </div>
<?php
}
$reqProducts->closeCursor();
?>
</section>
<?php 
$content = ob_get_clean();
require "template.php";
?>
