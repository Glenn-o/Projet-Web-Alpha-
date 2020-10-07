<?php 
$title = "Creation d'annonce";
$css = "createProduct.css";
ob_start() ?>
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
        <textarea type="text" class="input_modif"name="description"  placeholder = "Description" style="resize:none"></textarea>
        <select name="state" id="">
            <option value="neuf">Neuf</option>
            <option value="abime">Abimé</option>
            <option value="piece">En pièce</option>
        </select>
        <div id="checkbox_div">
            <label for="checkbox">Premium : </label>
            <input type="checkbox" id="checkbox" class="input_modif"name="premium">
        </div>
        <input type="text" class="input_modif"name="city"  placeholder = "Ville de vente">
        <div>
            <label for="img_01">Image :</label>
            <input type="file" name="img_01" id="img_01">
        </div>
        
        <button type="submit"> Valider </button>
    </form>
</section>

<?php $content = ob_get_clean() ?>

<?php require "template.php" ?>