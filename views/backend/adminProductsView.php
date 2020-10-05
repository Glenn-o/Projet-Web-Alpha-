<?php
$title = "Liste Utilisateurs";
$css = "adminSpace.css";
ob_start() 
?>
<section id="main">
<?php
if($action == "affichage")
{
?>
    <div id="info_product">
        <img src="data:img/jpg/png;base64,<?= $product["image"] ?>" alt="photo du produit"></div>
        <p>Nom : <?= $product["name"] ?></h1>
        <p>Etat : <?= $product["state"] ?></h1>
        <p>Prix : <?= $product["format_price"] ?> €</p>
        <p>Description : <?= $product["description"] ?></p>
        <a href="index.php?page=adminSpace&vue=product&action=modification&product=<?= $product["id_product"] ?>"><button>Modifier</button></a>
        <a href="index.php?page=adminSpace&vue=product&action=suppression&product=<?= $product["id_product"] ?>"><button>Supprimer</button></a>
    </div>
<?php
}
else if($action == "modification")
{
?>
    <div id="info_product">
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
                <input type="checkbox" class="input_modif"name="premium">
                <input type="text" class="input_modif"name="city"  placeholder = "Ville de vente">
                <div>
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
    <div class="div_user">
        <img src="data:img/png;base64,<?= $product["image"] ?>" alt="photo du produit">
        <p> Nom : <?= $product["name"] ?></p>
        <p> Etat : <?= $product["state"] ?></p>
        <p> Prix : <?= $product["format_price"] ?> €</p>
        <p> Description : <?= $product["description"] ?></p>
        <a href="index.php?page=adminSpace&vue=product&action=affichage&product=<?= $product["id_product"] ?>"><button>Afficher</button></a>
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
