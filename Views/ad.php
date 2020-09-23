<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces</title>
    <link href="../assets/css/ad.css" rel="stylesheet">
    <link href="../assets/css/header.css" rel="stylesheet">
    <link href="../assets/css/footer.css" rel="stylesheet">
</head>
<body>
    <?php require_once "../include/header.php"?>
    <section id="main">
        <div id="container1">
            <img id="product_img" src="../assets/img/point_interogation.jpg" alt="photo du produit">
            <h1 class="title_product" id="product_name">Nom du Produit</h1>
            <h1 class="title_product" id="product_state">État du produit</h1>
            <h1 class="title_product" id="product_price">XXX €</h1>
            <p id="product_description">Déscription du produit. Est-ce que tu connais l'histoire tragique de Dark Plagueis le Sage ? Ce n'est pas le genre d'histoires que racontent les Jedi. C'est une légende Sith. Dark Plagueis était un Seigneur Noir des Sith tellement puissant et tellement sage qu'il pouvait utiliser la Force pour influer sur les midi-chloriens et créer la vie.</p>
        </div>
        <div id="container2">
            <h1 id="seller_name">Nom Vendeur</h1>
            <image id="avatar" src="../assets/img/user.png" alt="avatar utilisateur">
            <button class="button_seller" type="submit">Contacter par mail</button>
            <button class="button_seller" type="submit">Afficher téléphone</button>

        </div>
    </section>
    <?php require_once "../include/footer.php"?>
</body>
</html>