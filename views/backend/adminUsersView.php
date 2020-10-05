<?php
$title = "Liste Utilisateurs";
$css = "adminSpace.css";
ob_start() 
?>
<section id="main">
<?php
if($action == "affichage")
{
?>
    <div id="info_user">
            <image id="avatar" src="data:img/png;base64,<?= $user["avatar"]?>" alt="avatar utilisateur">

            <p>Nom utilisateur : <?= $user["username"] ?>"></p>

            <p>E-mail : <?= $user["email"]?> ></p>
        
            <p>Nom : <?= $user["lastname"] ?> ></p>

            <p>Prenom : <?= $user["firstname"] ?>"></p>

            <p>Adresse : <?= $user["address"] ?> ></p>

            <p>Ville : <?= $user["city"] ?> ></p>

            <p>Code Postal : <?= $user["postal_code"] ?> ></p>

            <p>Pays : <?= $user["country"] ?> ></p>

            <p>Téléphone : <?= $user["phone"] ?></p>
            <a href="index.php?page=adminSpace&vue=user&action=modification&user=<?= $user["id_user"] ?>"><button>Modifier</button></a>
        </form>
    </div>
<?php
}
else if($action == "modification")
{
?>
    <div id="info_user">
            <form action="index.php?page=adminSpace&vue=user&action=validation&user= <?= $user["id_user"] ?>" method="post" class="form_info_user" enctype="multipart/form-data">
                <label class="label_info" id="lbl1" for="inp1">Pseudo</label>
                <input type="text" class="text_info" id="inp1" name="username" value="<?= $user["username"] ?>">

                <label class="label_info"id="lbl2" for="inp2">Mot de passe</label>
                <input type="password" class="text_info" id="inp2" name="password" value="">

                <label class="label_info"id="lbl2" for="inp2">Confirmation</label>
                <input type="password" class="text_info" id="inp2" name="password_confirmed" value="">

                <label class="label_info"id="lbl2" for="inp2">Ancien mot de passe</label>
                <input type="password" class="text_info" id="inp2" name="old_password" value="">
                
                <label class="label_info" id="lbl3" for="inp3">E-mail</label>
                <input type="email" class="text_info" id="inp3" name="email" value="<?= $user["email"]?>" >

                <image id="avatar" src="data:img/png;base64,<?= $user["avatar"]?>" alt="avatar utilisateur">
                <input type="file" class="avatar_info" id="inp4" name="avatar">
            
                <label class="label_info" id="lbl1" for="inp1">Nom</label>
                <input type="text" class="text_info" id="inp1" name="lastname" value="<?= $user["lastname"] ?>">

                <label class="label_info" id="lbl1" for="inp1">Prenom</label>
                <input type="text" class="text_info" id="inp1" name="firstname" value="<?= $user["firstname"] ?>">

                <label class="label_info" id="lbl1" for="inp1">Adresse</label>
                <input type="text" class="text_info" id="inp1" name="address" value="<?= $user["address"] ?>">

                <label class="label_info" id="lbl1" for="inp1">Ville</label>
                <input type="text" class="text_info" id="inp1" name="city" value="<?= $user["city"] ?>">

                <label class="label_info" id="lbl1" for="inp1">Code Postal</label>
                <input type="text" class="text_info" id="inp1" name="postal_code" value="<?= $user["postal_code"] ?>">

                <label class="label_info" id="lbl1" for="inp1">Pays</label>
                <input type="text" class="text_info" id="inp1" name="country" value="<?= $user["country"] ?>">

                <label class="label_info" id="lbl1" for="inp1">Téléphone</label>
                <input type="number" class="text_info" id="inp1" name="phone" value="<?= $user["phone"] ?>">

                <button class="button_info" type="submit">Valider Changement</button>
            </form>
        </div>
<?php
}
else
{
    while ($user = $reqUsers->fetch(PDO::FETCH_ASSOC))
    {
?>
    <div class="div_user">
        <img id="produit" src="data:image/jpg/png;base64,<?= $user['avatar'] ?>" >
        <div id="div_info_user">
            <p class="lastName_user"><?= $user["lastname"] ?></p>
            <p class="firstName_user"><?= $user["firstname"] ?></p>
            <p class="username_user"><?= $user["username"] ?> </p>
        </div>
        <a href="index.php?page=adminSpace&vue=user&action=affichage&user=<?= $user["id_user"] ?>"><button>Modifier</button></a>
    </div>
<?php
    }
    $reqUsers->closeCursor();
}
?>
</section>
<?php 


$content = ob_get_clean();
require "template.php";
?>
