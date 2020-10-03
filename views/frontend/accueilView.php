<?php
$title = "Test Template";
$css = "index.css";
?>

<?php ob_start(); ?>

<section id="form">
    <form action="index.php?page=listProducts" method="POST">
        <div id="container_input">
            <select name="category" id="">
                <option value="default">Categorie</option>
                <option value="console">Console</option>
                <option value="jeux">Jeux-video</option>
                <option value="accessoires">Accessoires</option>
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
    <h1>top categories</h1>
    <div id="category">

    </div>
    <h1>interessant pour vous</h1>
    <div id="user_suggestion">
        <div id="slide_suggestion1">

        </div>
        <div id="slide_suggestion2">

        </div>
        <div id="slide_suggestion3">

        </div>
        <div id="slide_suggestion4">

        </div>
        <div id="slide_suggestion5">

        </div>
        <div id="slide_suggestion6">

        </div>
    </div>
    <h1>Dans la categorie</h1>
    <div id="rand_category">
        <div id="slide_rand1">

        </div>
        <div id="slide_rand2">

        </div>
        <div id="slide_rand3">

        </div>
        <div id="slide_rand4">

        </div>
        <div id="slide_rand5">

        </div>
        <div id="slide_rand6">

        </div>
    </div>
</section>

<?php $content = ob_get_clean() ?>

<?php require "template.php" ?>