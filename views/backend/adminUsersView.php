<?php
$title = "Liste Utilisateurs";
$css = "adminSpace.css";
ob_start() 
?>
<section id="main">
<?php
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
    </div>
<?php
}
$reqUsers->closeCursor();
?>
</section>
<?php 
$content = ob_get_clean();
require "template.php";
?>
