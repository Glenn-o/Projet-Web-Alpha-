<?php

$result = 67;
$page = $_GET["page"] ?? 1;
$maxResult = 10;

$nbrPage = ceil($result / $maxResult);
$capResult = $page * $maxResult;
if($capResult > $result)
{
    $capResult = $result;
}
print('<p>'.$page.'/'. $nbrPage.'<p/>');

if($page > 1)
{
    $finalPage = $page - 1;
    print '<a href="?page='.$finalPage.'"><button>Gauche</button></a>'; 
}
else 
{
    print '<a><button style="visibility:hidden">Gauche</button></a>';
}

if($page < $nbrPage)
{
    $finalPage = $page + 1;
    print '<a href="?page='.$finalPage.'"><button>Droite</button></a>';
}
else
{
    print '<a><button style="visibility:hidden">Droite</button></a>';
}
$start = ($page-1) * $maxResult;

for($i=$start;$i < $capResult;$i++)
{
    print("$i");
}


?>