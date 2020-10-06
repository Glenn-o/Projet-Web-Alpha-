<?php
$title = "Vue produit";
$css = "ad.css";

if(Utils::ACTIVESESSION())
{
    $id = UserManager::getIDByName($_SESSION["name"]);
    if($id == $product["id_user"])
        $presenceAcheter = 'style="display:none"';
    else
        $presenceAcheter = 'href="index.php?page=ad&action=achat$product='.$product["id_product"].'"';
}
else
    $presenceAcheter = 'href="index.php?page=connexion"';

ob_start();
?>

<section id="main">
    <div id="container1">
        <div id="product_img"><img src="data:img/png;base64,<?= $product["image"] ?>" alt="photo du produit"></div>
        
            <div class="title_product"><h1 id="product_name"><?= $product["name"] ?></h1></div>
            <div class="title_product"><h1 id="product_state"><?= $product["state"] ?></h1></div>
            <div class="title_product"><h1 id="product_price"><?= $product["format_price"] ?> €</h1></div>
        
        <p id="product_description"><?= $product["description"] ?></p>
        <a <?= $presenceAcheter ?> id="button_buy">Acheter</a>
    </div>
    <div id="container2">
        <div id="seller">
            <div id="seller_name"><h1><?= $seller["username"] ?></h1></div>
            <div id="avatar"><img  src="data:img/png/jpg;base64,<?= $seller["avatar"] ?>" alt="avatar utilisateur"></div>
            <div id="buttons_seller"> <button class="button_seller_email" type="submit">Contacter par mail</button>
            <button class="button_seller_phone" type="submit">Afficher téléphone</button></div>
        </div>

    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
<script>
$(function(){
    $(".button_seller_phone").click(function(){
        var seller_name = $('.seller_name').val()
        $.post("includes/EmailPhoneSeller.php", {submit: 'phone', name:<?= '"'. $seller['username']  . '"'?>},function(data){
            $(".button_seller_phone").html(data);
        })
    });
    $(".button_seller_email").click(function(){
        $.post("includes/EmailPhoneSeller.php", {submit: 'email', name:<?= '"'. $seller['username']  . '"'?>},function(data){
            $(".button_seller_email").html(data);
        })
    });
    
})
</script>
<?php
$content = ob_get_clean();

require "template.php";
?>