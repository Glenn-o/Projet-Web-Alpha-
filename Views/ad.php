<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces</title>
    <link href="../assets/css/ad.css" rel="stylesheet">
    <link href="../assets/css/header.css" rel="stylesheet">
    <link href="../assets/css/footer.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
</head>
<body>
    <?php require_once "../include/header.php"?>
    <section id="main">
        <div id="container1">
            <div id="product_img"><img src="../assets/img/point_interogation.jpg" alt="photo du produit"></div>
            <div class="title_product"><h1 id="product_name">Nom du Produit aeaz eazeaeaze aze az eaz e</h1></div>
            <div class="title_product"><h1 id="product_state">État du produit</h1></div>
            <div class="title_product"><h1 id="product_price">XXX €</h1></div>
            <p id="product_description">Déscription du produit. Est-ce que tu connais l'histoire tragique de Dark Plagueis le Sage ? Ce n'est pas le genre d'histoires que racontent les Jedi. C'est une légende Sith. Dark Plagueis était un Seigneur Noir des Sith tellement puissant et tellement sage qu'il pouvait utiliser la Force pour influer sur les midi-chloriens et créer la vie.</p>
        </div>
        <div id="container2">
            <div id="seller">
                <div id="seller_name"><h1>Nom Vendeur</h1></div>
                <div id="avatar"><image  src="../assets/img/user.png" alt="avatar utilisateur"></div>
               <div id="buttons_seller"> <button class="button_seller" type="submit">Contacter par mail</button>
                <button class="button_seller" type="submit">Afficher téléphone</button></div>
            </div>

        </div>
    </section>
    <?php require_once "../include/footer.php"?>
</body>
</html>