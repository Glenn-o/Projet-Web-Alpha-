<?php 
$title = "Creation d'annonce";
$css = "createProduct.css";

?>

<?php ob_start() ?>
<section id="main">
    <h1> Creation d'annonce</h1>
    <?= $message ?>
    <form action="index.php?page=createProduct&action=creation" method="POST" enctype="multipart/form-data">
        <select name="categorie" id="">
            <option value="default">Categorie</option>
            <option value="console">Console</option>
            <option value="jeu">Jeux-video</option>
            <option value="accessoire">Accessoires</option>
        </select>
        <input type="text" class="input_modif"name="name" placeholder = "Nom">
        <input type="number" class="input_modif"name="price"  placeholder = "Prix">
        <input type="text" class="input_modif"name="description"  placeholder = "Description">
        <select name="state" id="">
            <option value="neuf">Neuf</option>
            <option value="abime">Abimé</option>
            <option value="piece">En pièce</option>
        </select>
        <input type="checkbox" class="input_modif"name="premium">
        <input type="text" class="input_modif"name="city"  placeholder = "Ville de vente">
        <div>
            <label for="img_O1">Image :</label>
            <input type="file" name="img_01" id="avatar">
        </div>
        
        <button type="submit"> Valider </button>
    </form>
</section>

<?php $content = ob_get_clean() ?>

<?php require "template.php" ?>