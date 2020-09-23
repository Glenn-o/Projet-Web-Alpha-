<?php
    session_start();
    error_reporting(E_ALL);
    require("include/dbcon.php");

    $db = getConn();

    $action = GETPOST("action");
    $category = GETPOST("category");
    $research = GETPOST("research");
    $location = GETPOST("location");

    if($action == "generate")
    {
        if($category != "" or $research != "" or $location != "")
        {
            header('Location: Views/productSearch.php?location="'.$location.'"&research="'.$name.'"&category="'.$categorie.'"');
        }
    }
    $presenceSession = !empty($_SESSION);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <link href="assets/css/header.css" rel="stylesheet">
    <link href="assets/css/footer.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
    <title>Accueil</title>
</head>
<body>
    <section id="header">
        <header>
            <a href=""><img src="assets/img/logo.png" alt="logo_fog" id="logo_fog"></a>
            <div id="container_menu">
                <a href="#"><img src="assets/img/button.png" alt="button" id="button_ad"></a>
                <a href="#"><img src="assets/img/bell.png" alt="logo_bell" id="logo_bell"></a>
                <a href="#"><img src="assets/img/wrench.png" alt="logo_admin" id="logo_admin"></a>
                <a href="<?php if($presenceSession) echo "Views/clientSpace.php"; else echo "Views/connexion.php"?>"><div id="container_user">
                    <img src="assets/img/user.png" alt="logo_user" id="logo_user">
                    <p><?php if($presenceSession) echo $_SESSION["name"]; else echo "Se connecter" ?></p>
                </div></a>
            </div>
        </header>
    </section>

    <section id="form">
        <form action="" method="POST">
            <div id="container_input">
                <select name="category" id="">
                    <option value="default">Categorie</option>
                    <option value="console">Console</option>
                    <option value="video_games">Jeux-video</option>
                    <option value="accessories">Accessoires</option>
                </select>
                <input type="text" name="research" id="" placeholder="rechercher">
                <input type="text" name="location" id="" placeholder="lieu">
                <input type="hidden" name="action" value="generate">
            </div>
            <div id="submit_search">
                <button type="submit"><img src="assets/img/search.png" alt="chercher" id="button_search"></button>
            </div>
        </form>
    </section>

    <section id="content">
        <h1>top categeries</h1>
        <div id="category">
            <?php 
                $result = $db->query("SELECT * FROM product_type");
                while($enr = $result->fetch(PDO::FETCH_ASSOC))
                {
                    print("Yes");
                }
            ?>
            
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
    <section id="footer">
        <div id="footer_left">
            <h1>A propos de F.O.G</h1>
            <hr>
            <a href="">Qui sommes nous ?</a>
            <a href="">Nous contacter</a>
            <a href="">Plan du site</a>
        </div>
        <div id="footer_center">
            <h1>Retrouvez nous sur les réseaux sociaux</h1>
            <hr>
            <a href=""><img src="assets/img/twitter.png" alt="logo twitter" id="logo_twitter"><p>@FOGshop</p></a>
            <a href=""><img src="assets/img/facebook.png" alt="logo facebook" id="logo_facebook"><p>F.O.G</p></a>
            <a href=""><img src="assets/img/insta.png" alt="logo insta" id="logo_insta"><p>@FOGshop</p></a>
        </div>
        <div id="footer_right">
            <h1>Informations légales</h1>
            <hr>
            <a href="">Conditions Générales de Vente</a>
            <a href="">Vie privée / Cookies</a>
            <a href="">Condition Générales d'utilisation</a>
            <a href="">Vos droits et obligations</a>
        </div>
    </section>
</body>
</html>