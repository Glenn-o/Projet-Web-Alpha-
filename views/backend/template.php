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
            <a href=""><img src="public/img/logo.png" alt="logo_fog" id="logo_fog"></a>
            <div id="container_menu">
                <a href="#"><img src="public/img/button.png" alt="button" id="button_ad"></a>
                <a href="#"><img src="public/img/bell.png" alt="logo_bell" id="logo_bell"></a>
                <a href="#"><img src="public/img/wrench.png" alt="logo_admin" id="logo_admin"></a>
                <a href="#"><div id="container_user">
                    <img src="public/img/user.png" alt="logo_user" id="logo_user">
                </div></a>
            </div>
        </header>
    </section>
    <?= $content ?>

    <section id="content">
        <h1>top categeries</h1>
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
    </section> -->
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