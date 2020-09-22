<?php  
    $action = GETPOST("action");
    $categorie = GETPOST("categorie");
    $name = GETPOST("name");
    $location = GETPOST("location");

    // Create sql
    $sql = 'SELECT * FROM product';
    $tabWhere = [];
    if($categorie != "") {$tabWhere[] = "categorie = ".$categorie; }
    if($name != "") {$tabWhere[] = "name = ".$name; }
    if($location != "") {$tabWhere[] = "location = ".$location; }
    if(count($tabWhere) > 0)
    {
        $sql .= ' WHERE '.join(" and ", $tabWhere);
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
    
</body>
</html>