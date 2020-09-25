<?php
    require_once("../include/dbcon.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Client</title>
    <link href="../assets/css/clientSpace.css" rel="stylesheet">
    <link href="../assets/css/header.css" rel="stylesheet">
    <link href="../assets/css/footer.css" rel="stylesheet">
</head>
<body>
    <?php require_once "../include/header.php"?>
    <section id="main">
        <div id="container1">
            <div id="info_user">
                <form action="" method="post" class="form_info_user" enctype="multipart/form-data">
                    <label class="label_info" id="lbl1" for="inp1">Pseudo</label>
                    <input type="text" class="text_info" id="inp1" name="username" required >

                    <label class="label_info"id="lbl2" for="inp2">Mot de passe</label>
                    <input type="password" class="text_info" id="inp2" name="psswd_input" required >
                    
                    <label class="label_info" id="lbl3" for="inp3">E-mail</label>
                    <input type="email" class="text_info" id="inp3" name="email_input" required >

                    <image id="avatar" src="../assets/img/user.png" alt="avatar utilisateur">
                    <input type="file" class="avatar_info" id="inp4" name="avatar_input" required >

                    <button class="button_info" type="submit">Modifier</button>

                </form>

            </div>
            <div id="last_ad">
                <h1>Mes dernieres annonces</h1>
                <div class="card">
                </div>
                <div class="card">
                </div>
                <div class="card">
                </div>
                <div class="card">
                </div>
            </div>
        </div>
        <p id="title_ads">Partenaire</p>
        <p id="title_newsletter">Newsletter</p>

        <div id="container2">
            <form action="" method="post" class="form_info_user">
                <div id="ads">
                    <label class="label_checkbox" id="lblchbox1" for="chbox1">Recevoir les dernières nouveautés</label>
                    <input type="checkbox" id="chbox1" name="checkbox1">

                    <label class="label_checkbox" id="lblchbox2" for="chbox2">Recevoir les offres de nos partenaires</label>
                    <input type="checkbox" id="chbox2" name="checkbox2">

                </div>
                <div id="newsletter">
                    <label class="label_checkbox" id="lblchbox3" for="chbox3">Recevoir les offres de nos partenaires</label>
                    <input type="checkbox" id="chbox3" name="checkbox3">
                </div>
                <button class="button_info" type="submit">Enregistrer</button>
            </form>
        </div>
    </section>
    <?php require_once "../include/footer.php"?>
</body>
</html>