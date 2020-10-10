<?php
$title = "Test Template";
$css = "home.css";
// BillManager::createPDF(1);
?>

<?php ob_start(); ?>

<section id="form">
    <form action="index.php?page=productSearch" method="POST">
        <div id="container_input">
            <select name="category" id="">
                <option value="default">Categorie</option>
                <option value="console">Console</option>
                <option value="game">Jeux-video</option>
                <option value="accessorie">Accessoires</option>
            </select>
            <input type="text" name="research" id="" placeholder="rechercher">
            <input type="text" name="location" id="" placeholder="lieu">
        </div>
        <div id="submit_search">
            <button type="submit"><img src="public/img/search.png" alt="chercher" id="button_search"></button>
        </div>
    </form>
</section>

<section id="content">
    <h1>interessant pour vous</h1>
    <div id="user_suggestion">
    <?php
    while($prod = $randomProduct->fetch(PDO::FETCH_ASSOC))
    { ?>
        <a href="index.php?page=ad&product=<?= $prod["id_product"] ?>"><div class="slide_suggestion">
        <img src="data:img/png/jpg;base64,<?= $prod["image"] ?>">
        <p><?= $prod["name"] ?></p>
        </div></a>
    <?php
    }
    ?>
    </div>
    <h1>Les derniers produits</h1>
    <div id="rand_category">
    <?php
    while($prod = $randomCategory->fetch(PDO::FETCH_ASSOC))
    { ?>
        <a href="index.php?page=ad&product=<?= $prod["id_product"] ?>"><div class="slide_category">
        <img src="data:img/png/jpg;base64,<?= $prod["image"] ?>">
        <p><?= $prod["name"] ?></p>
        </div></a>
    <?php
    }
    ?>
    </div>
    <a class="twitter-timeline" data-lang="fr" data-width="300" data-height="300" data-theme="light" href="https://twitter.com/TwitterDev?ref_src=twsrc%5Etfw">Tweets by Fog</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> 
</section>

<?php $content = ob_get_clean() ?>

<?php require "template.php" ?>