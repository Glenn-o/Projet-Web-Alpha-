<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/<?= $css ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title><?= $title ?></title>
</head>
<body>
<section id="main">         
    <div id="pannel_left">             
        <h1>Panneau d'Administration</h1>             
        <a href="index.php?page=adminSpace&vue=user" class="button">Utilisateur</a>
        <a href="index.php?page=adminSpace&vue=product" class="button">Annonce</a>             
        <a href="index.php?page=adminSpace&vue=bill" class="button">Transaction</a>             
        <a href="index.php?page=adminSpace&vue=user" class="button">Reclamation</a>             
        <a href="index.php?page=adminSpace&vue=user" class="button">Message Moderation</a>             
        <a href="index.php?page=adminSpace&vue=user" class="button">Gestion Administration</a>            
        <a href="index.php">
        <img src="public/img/logout.png" alt="logo logout" id="logo_logout">
        </a>         
    </div>
    <?= $content ?>
</section>
</body>
</html>