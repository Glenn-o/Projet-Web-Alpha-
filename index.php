<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
    <title>Accueil</title>
</head>
<body>
    <?php require_once "include/header.php"?>
    <section id="form">
        <form action="" method="POST">
            <div id="container_input">
                <select name="" id="">
                    <option value="default">Categorie</option>
                    <option value="console">Console</option>
                    <option value="video_games">Jeux-video</option>
                    <option value="accessories">Accessoires</option>
                </select>
                <input type="text" name="" id="" placeholder="rechercher">
                <input type="text" name="" id="" placeholder="lieu">
            </div>
            <div id="submit_search">
                <a href="" type="submit"><img src="" alt="chercher"></a>
            </div>
        </form>
    </section>

    <section id="content">
        <h1>top categeries</h1>
        <div id="category">
            <div id="slide_category1">

            </div>
            <div id="slide_category2">

            </div>
            <div id="slide_category3">

            </div>
            <div id="slide_category4">

            </div>
            <div id="slide_category5">

            </div>
            <div id="slide_category6">

            </div>
        </div>
        <h1>interessant pour vous</h1>
        <div id="user_suggestion">
            <div id="slide_suggestion1">

            </div>
            <div id="slide_suggestion2">

            </div>
            <div id="slide_suggestion3">

            </div>
            <div id="slide_suggestion4">

            </div>
            <div id="slide_suggestion5">

            </div>
            <div id="slide_suggestion6">

            </div>
        </div>
        <h1>Dans la categorie</h1>
        <div id="rand_category">
            <div id="slide_rand1">

            </div>
            <div id="slide_rand2">

            </div>
            <div id="slide_rand3">

            </div>
            <div id="slide_rand4">

            </div>
            <div id="slide_rand5">

            </div>
            <div id="slide_rand6">

            </div>
        </div>
    </section>
    <?php require_once "include/footer.php"?>
</body>
</html>