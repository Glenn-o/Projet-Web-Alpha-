<?php 
$title = "Inscription";
$css = "inscription";

?>

<?php ob_start() ?>
<h1> Inscription</h1>
<h2> Rentrez vos information pour pouvoir vous inscrire </h2>

<form action="<?= $_SERVER["PHP_SELF"].'?page=inscription&action=inscription'?>" method="POST" enctype="multipart/form-data">
    <input type="text" name="firstName" placeholder = "Nom"><br>
    <input type="text" name="lastName"  placeholder = "Prénom"><br>
    <input type="text" name="userName"  placeholder = "Utilisateur"><br>
    <input type="text" name="address"  placeholder = "Adresse"><br>
    <input type="text" name="city"  placeholder = "Ville"><br>
    <input type="text" name="postalCode"  placeholder = "Code Postal"><br>
    <input type="text" name="country"  placeholder = "Pays"><br>
    <input type="number" name="phone"  placeholder = "Téléphone"><br>
    <input type="email" name="email"  placeholder = "Email"><br>
    <input type="password" name="password"  placeholder = "Mot de passe"><br>
    <input type="password" name="password-confirmed"  placeholder = "Confirmation"><p><?= $wrongPassword?></p><br>
    <label for="avatar">Avatar :</label>
    <input type="file" name="avatar" id="avatar"><br>
    <button type="submit"> Valider </button>
</form>

<?php $content = ob_get_clean() ?>

<?php require "template.php" ?>