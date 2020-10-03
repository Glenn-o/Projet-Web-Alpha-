<?php 
$title = "Espace Client";
$css = "clientSpace.css";
?>

<?php ob_start() ?>
<<<<<<< HEAD
<h1> Espace Client</h1>
<?= $errorMessage ?>
=======

>>>>>>> modif list product
<section id="main">
    <h1 id="titre"> Espace Client</h1>
    <div id="container1">
        <div id="info_user">
            <form action="<?= $pageModif ?>" method="post" class="form_info_user" enctype="multipart/form-data">
                <label class="label_info" id="lbl1" for="inp1">Pseudo</label>
                <input type="text" class="text_info" id="inp1" name="username" value="<?= $data["username"] ?>">

                <label class="label_info"id="lbl2" for="inp2">Mot de passe</label>
                <input type="password" class="text_info" id="inp2" name="password" value="">

                <label class="label_info"id="lbl2" for="inp2">Confirmation</label>
                <input type="password" class="text_info" id="inp2" name="password_confirmed" value="">

                <label class="label_info"id="lbl2" for="inp2">Ancien mot de passe</label>
                <input type="password" class="text_info" id="inp2" name="old_password" value="">
                
                <label class="label_info" id="lbl3" for="inp3">E-mail</label>
                <input type="email" class="text_info" id="inp3" name="email" value="<?= $data["email"]?>" >

                <image id="avatar" src="data:img/png;base64,<?= $data["avatar"]?>" alt="avatar utilisateur">
                <input type="file" class="avatar_info" id="inp4" name="avatar">
                <button class="button_info" type="submit">Modifier</button>
            </form>

                <!-- INFO PERSO -->
            <form action="<?= $pageModif ?>" method="post" class="form_info_user" enctype="multipart/form-data">
                <label class="label_info" id="lbl1" for="inp1">Nom</label>
                <input type="text" class="text_info" id="inp1" name="lastname" value="<?= $data["lastname"] ?>">

                <label class="label_info" id="lbl1" for="inp1">Prenom</label>
                <input type="text" class="text_info" id="inp1" name="firstname" value="<?= $data["firstname"] ?>">

                <label class="label_info" id="lbl1" for="inp1">Adresse</label>
                <input type="text" class="text_info" id="inp1" name="address" value="<?= $data["address"] ?>">

                <label class="label_info" id="lbl1" for="inp1">Ville</label>
                <input type="text" class="text_info" id="inp1" name="city" value="<?= $data["city"] ?>">

                <label class="label_info" id="lbl1" for="inp1">Code Postal</label>
                <input type="text" class="text_info" id="inp1" name="postal_code" value="<?= $data["postal_code"] ?>">

                <label class="label_info" id="lbl1" for="inp1">Pays</label>
                <input type="text" class="text_info" id="inp1" name="country" value="<?= $data["country"] ?>">

                <label class="label_info" id="lbl1" for="inp1">Téléphone</label>
                <input type="number" class="text_info" id="inp1" name="phone" value="<?= $data["phone"] ?>">

                <button class="button_info" type="submit">Modifier</button>
            </form>

        </div>
        <div id="last_ad">
            <h1>Mes dernieres annonces</h1>
            <?php
            while($reg = $reqProduct->fetch(PDO::FETCH_ASSOC))
            {
            ?>
            <div class="card">
            <p><?= $reg["name"] ?></p>
            <img src="data:img/png/jpg;base64,<?= $reg["cover_image"] ?>"
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <p id="title_ads">Partenaire</p>
    <p id="title_newsletter">Newsletter</p>

    <div id="container2">
        <form action="<?= $pageModif ?>" method="post" class="form_info_user">
            <div id="ads">
                <label class="label_checkbox" id="lblchbox1" for="chbox1">Recevoir les dernières nouveautés</label>
                <input type="checkbox" id="chbox1" name="newsletter" value="1" <?= $data["config_news"] ? "checked" : "" ?> >

                <label class="label_checkbox" id="lblchbox2" for="chbox2">Recevoir les offres de nos partenaires</label>
                <input type="checkbox" id="chbox2" name="partnernews" value="1" <?= $data["config_part"] ? "checked" : "" ?> >

            </div>
            <button class="button_info" type="submit">Modifier</button>
        </form>
    </div>
    <a href="index.php?action=deconnexion">Deconnexion</a>
</section>

<?php $content = ob_get_clean() ?>

<?php require "template.php" ?>