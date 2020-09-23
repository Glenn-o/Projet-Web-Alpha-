<?php 
    require_once "../include/dbcon.php";
    print_r($_POST);
    print_r($_GET);

    //const
    $maxProduct = 10;

    $db = getConn();
    $action = GETPOST("action");
    $category = GETPOST("category");
    $research = GETPOST("research");
    $location = GETPOST("location");
    print('<br>'.$category.'/'.$research.'/'.$location.'<br>');

    // Create sql
    $sql = 'SELECT * FROM product as Prod';
    $tabWhere = [];
    if($category !== 'default') {
        print("Presence de categorie");
        $tabWhere[] = "Type.name = '$category'";
        $sql .= " INNER JOIN product_type as Type ON Type.id_product_type = Prod.id_product_type";
    }
    if($research !== "") {
        print("Presence d'une recherche");
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
        }
    }
    else
    {
        print("Pas de resultat");
    }

    print($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

?>
    
</body>
</html>