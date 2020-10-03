<?php

class Manager
{
    public static function getFile(){
        $directory = "public/img/";
        if(!empty($_FILES['avatar']['name'])){ // Si image envoyé dans formulaire, on va la chercher
            $tmp_name = $_FILES['avatar']['tmp_name'];
            $name = basename($_FILES['avatar']['name']);
            move_uploaded_file($tmp_name, "$directory/$name");
            $path = $directory. $name ;
            if(exif_imagetype($path) == IMAGETYPE_PNG or exif_imagetype($path) == IMAGETYPE_JPEG) {
                $data = file_get_contents($path);
                $base64 = base64_encode($data);
                unlink($path);
                return $base64; 
            }
            else {
                $data = file_get_contents("$directory/user.png");
                unlink($path);
                return base64_encode($data);
            }
        }else{                              // Sinon on prend celle par defaut
            $data = file_get_contents("$directory/user.png");
            return base64_encode($data);
        }
    }
}