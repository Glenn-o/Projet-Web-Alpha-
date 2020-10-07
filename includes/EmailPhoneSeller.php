<?php
require_once "../models/Database.class.php";
function getEmail($post){
    $db = $db = Database::getPDO();
    $sql = ("SELECT email FROM users where username = '" . $post . "'");
    $req = $db->query($sql);
    return $req->fetch(PDO::FETCH_ASSOC);
}
function getPhone($post){
    $db = $db = Database::getPDO();
    $sql = ("SELECT phone FROM users where username = '" . $post . "'");
    $req = $db->query($sql);
    return $req->fetch(PDO::FETCH_ASSOC);
}
if($_POST['submit'] === "phone"){
     echo (getPhone($_POST['name'])['phone']);
}
if($_POST['submit'] === "email"){
    echo (getEmail($_POST['name'])['email']);
}
?>