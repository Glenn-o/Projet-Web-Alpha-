<?php 
    require_once "../include/dbcon.php";

    //const
    $maxProduct = 10;

    $db = getConn();
    $action = GETPOST("action");
    $category = GETPOST("category");
    $research = GETPOST("research");
    $location = GETPOST("location");

    // Create sql
    $sql = 'SELECT * FROM product as Prod';
    $tabWhere = [];
    if($category !== 'default') {
        $tabWhere[] = "Type.name = '$category'";
        $sql .= " INNER JOIN product_type as Type ON Type.id_product_type = Prod.id_product_type";
    }
    if($research !== "") {
        $tabWhere[] = "Prod.name LIKE '%$research%'";
    }
    if($location != "") {
        $tabWhere[] = "Prod.city = '$location'";
    }
    if(count($tabWhere) > 0)
    {
        $sql .= ' WHERE '.join(" and ", $tabWhere);
    }

    $res = $db->query($sql);
    $count = $res->rowCount();
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
<body>
<?php
if($count > 0)
{
    $all = $res->fetchAll();
    $page = $_GET["page"] ?? 1;
    $nbrPage = ceil($count / $maxProduct);
    $capResult = $page * $maxProduct;
    if($capResult > $count)
    {
        $capResult = $count;
    }
    $start = ($page-1) * $maxProduct;
    for($i=$start;$i< $capResult;$i++)
    {
        // $monImage = base64_decode($all[$i]["image1"]);
        print '<img id="produit_img_'.$i.'" src="data:image/jpg/png;base64,'.base64_encode($all[$i]["image1"]).'">';
        print '<p>'.$all[$i]["name"].'</p>';
        print '<p>'.$all[$i]["state"].'</p>';
        print '<p>'.$all[$i]["city"].'</p>';
        print '<p>'.round($all[$i]["price"], 2).'€</p>';

    }
}
else
{
    print("Pas de resultat");
}
?>
    
</body>
</html>