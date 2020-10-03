<?php
    $presenceSession = !empty($_SESSION["name"]);
    if($presenceSession)
    {
        $id = UserManager::getIDByName($_SESSION["name"]);
        $buttonAdmin = UserManager::getTypeById($id) != 1;
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/<?= $css ?>">
    <link href="public/css/header.css" rel="stylesheet">
    <link href="public/css/footer.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title><?= $title ?></title>
</head>
<body>
    <section id="header">
        <header>
            <a href="index.php"><img src="public/img/logo.png" alt="logo_fog" id="logo_fog"></a>
            <div id="container_menu">
                <a href='<?php echo  $presenceSession ? 'index.php?action=deconnexion' : "#" ?> '><img src="public/img/button.png" alt="button" id="button_ad"></a>
                <a href="#"><img src="public/img/bell.png" alt="logo_bell" id="logo_bell"></a>
                <a href="index.php?page=adminSpace"><img src="public/img/wrench.png" alt="logo_admin" id="logo_admin" <?php echo $buttonAdmin ? '' : 'style="display:none"' ?> ></a>
                <a href='<?php echo $presenceSession ? "index.php?page=clientSpace" : "index.php?page=connexion" ?>'><div id="container_user">
                    <img src='<?php echo $presenceSession ? "data:image/jpg/png;base64,".UserManager::getAvatar($_SESSION["name"]) : "public/img/user.png" ?>' alt="logo_user" id="logo_user">
                    <p><?php echo $presenceSession ? $_SESSION["name"] : "Se connecter"; ?></p>
                </div></a>
            </div>
        </header>
    </section>
    <?= $content ?>

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
            <a href=""><img src="public/img/twitter.png" alt="logo twitter" id="logo_twitter"><p>@FOGshop</p></a>
            <a href=""><img src="public/img/facebook.png" alt="logo facebook" id="logo_facebook"><p>F.O.G</p></a>
            <a href=""><img src="public/img/insta.png" alt="logo insta" id="logo_insta"><p>@FOGshop</p></a>
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