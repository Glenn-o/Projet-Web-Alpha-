<?php
$title = "Liste Utilisateurs";
$css = "adminSpace.css";
ob_start() 
?>
<section id="main_product">
<h1>Liste des annonces</h1>
<?php
if($action == "affichage")
{
?>
    <div id="info_product1">
        <img src="data:img/jpg/png;base64,<?= $product["image"] ?>" alt="photo du produit">
        <p>Nom : <span><?= $product["name"] ?></span></h1>
        <p>Etat : <span><?= $product["state"] ?></span></h1>
        <p>Prix : <span><?= $product["format_price"] ?> €</span></p>
        <p id="description_p">Description : <span><?= $product["description"] ?></span></p>
        <div id="div_button_ad">
            <a href="index.php?page=adminSpace&vue=product&action=modification&product=<?= $product["id_product"] ?>" id="button_modif_ad">Modifier</a>
            <a href="index.php?page=adminSpace&vue=product&action=suppression&product=<?= $product["id_product"] ?>" id="button_supp_ad">Supprimer</a>
        </div>
    </div>
<?php
}
else if($action == "modification")
{
?>
    <div id="info_product2">
            <form action="index.php?page=adminSpace&vue=product&action=validation&product= <?= $product["id_product"] ?>" method="post" class="form_info_product" enctype="multipart/form-data">
                <select name="categorie" id="">
                    <option value="default">Categorie</option>
                    <option value="console">Console</option>
                    <option value="jeu">Jeux-video</option>
                    <option value="accessoire">Accessoires</option>
                </select>
                <input type="text" class="input_modif"name="name" placeholder = "Nom">
                <input type="number" class="input_modif"name="price"  placeholder = "Prix">
                <textarea type="text" class="input_modif"name="description"  placeholder = "Description" style="resize:none"></textarea>
                <select name="state" id="">
                    <option value="neuf">Neuf</option>
                    <option value="abime">Abimé</option>
                    <option value="piece">En pièce</option>
                </select>
               <div id="div_premium">
                    <label for="premium">Premium : </label>
                    <input type="checkbox" id="premium"name="premium">
               </div>
                <input type="text" class="input_modif"name="city"  placeholder = "Ville de vente">
                <div id="div_avatar">
                    <label for="img_01">Image :</label>
                    <input type="file" name="img_01" id="img_01">
                </div>

                <button class="button_info" type="submit">Valider Changement</button>
            </form>
        </div>
<?php
}
else
{
    while ($product = $reqProduct->fetch(PDO::FETCH_ASSOC))
    {
?>
    <div class="div_user_product">
        <img src="data:img/png;base64,<?= $product["image"] ?>" >
        <p> Nom : <span><?= $product["name"] ?></span></p>
        <p> Etat : <span><?= $product["state"] ?></span></p>
        <p> Prix : <span><?= $product["format_price"] ?> €</span></p>
        <p> Description : <span><?= $product["description"] ?></span></p>
        <a href="index.php?page=adminSpace&vue=product&action=affichage&product=<?= $product["id_product"] ?>">Afficher</a>
    </div>
<?php
    }
    $reqProduct->closeCursor();
}
?>
</section>
<?php 


$content = ob_get_clean();
require "template.php";
?>
