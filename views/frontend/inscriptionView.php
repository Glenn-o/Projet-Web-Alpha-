<?php 
$title = "Inscription";
$css = "inscription.css";

?>

<?php ob_start() ?>
<section id="main">
    <h1> Inscription</h1>

    <form action="index.php?page=inscription&action=inscription" method="POST" enctype="multipart/form-data">
        <h2> Rentrez vos information pour pouvoir vous inscrire </h2>
        <input type="text" class="input_modif"name="firstName" placeholder = "Nom">
        <input type="text" class="input_modif"name="lastName"  placeholder = "Prénom">
        <input type="text" class="input_modif"name="userName"  placeholder = "Utilisateur">
        <input type="text" class="input_modif"name="address"  placeholder = "Adresse">
        <input type="text" class="input_modif"name="city"  placeholder = "Ville">
        <input type="text" class="input_modif"name="postalCode"  placeholder = "Code Postal">
        <input type="text" class="input_modif"name="country"  placeholder = "Pays">
        <input type="number" class="input_modif"name="phone"  placeholder = "Téléphone">
        <input type="email" class="input_modif"name="email"  placeholder = "Email">
        <input type="password"class="input_modif" name="password"  placeholder = "Mot de passe">
        <input type="password"class="input_modif" name="password-confirmed"  placeholder = "Confirmation"><p><span><?= $wrongPassword?><span></p>
        <div>
            <label for="avatar">Avatar :</label>
            <input type="file" name="avatar" id="avatar">
        </div>
        
        <button type="submit"> Valider </button>
    </form>
</section>

<?php $content = ob_get_clean() ?>

<?php require "template.php" ?>