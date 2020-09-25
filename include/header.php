<?php
    session_start();

    $presenceSession = !empty($_SESSION);
?>

<section id="header">
    <header>
        <a href="../index.php"><img src="../assets/img/logo.png" alt="logo_fog" id="logo_fog"></a>
        <div id="container_menu">
            <a href="#"><img src="../assets/img/button.png" alt="button" id="button_ad"></a>
            <a href="#"><img src="../assets/img/bell.png" alt="logo_bell" id="logo_bell"></a>
            <a href="#"><img src="../assets/img/wrench.png" alt="logo_admin" id="logo_admin"></a>
            <a href="<?php if($presenceSession) echo "Views/clientSpace.php"; else echo "Views/connexion.php"?>"><div id="container_user">
                    <img src="../assets/img/user.png" alt="logo_user" id="logo_user">
                    <p><?php if($presenceSession) echo $_SESSION["name"]; else echo "Se connecter" ?></p>
            </div></a>
        </div>
    </header>
</section>
