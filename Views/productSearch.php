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
    $sql = 'SELECT * FROM product';
    $tabWhere = [];
    // if($category != "") {$tabWhere[] = "categorie = '$category'"; }
    // if($research != "") {$tabWhere[] = "research = '$research'"; }
    // if($location != "") {$tabWhere[] = "location = '$location'"; }
    // if(count($tabWhere) > 0)
    // {
    //     $sql .= ' WHERE '.join(" and ", $tabWhere);
    // }

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
            print($all[$i]["name"]);
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