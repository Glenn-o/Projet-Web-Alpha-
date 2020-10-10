<?php

class Manager
{
    /**
     * Renvoie le fichier spécifié ou un fichier par default si absent
     * @return string Image en base64
     */
    public static function getFileWithDefault($fileName){
        $directory = "public/img/";
        if(!empty($_FILES[$fileName]['name'])){ // Si image envoyé dans formulaire, on va la chercher
            $tmp_name = $_FILES[$fileName]['tmp_name'];
            $name = basename($_FILES[$fileName]['name']);
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

    /**
     * Renvoie le fichier specifié
     * @return string Fichier spécifié
     * @throws \Exception Mauvais format ou fichier absent
     */
    public static function getFile($fileName) {
        $directory = "public/img/";
        if(!empty($_FILES[$fileName]['name'])){ // Si image envoyé dans formulaire, on va la chercher
            $tmp_name = $_FILES[$fileName]['tmp_name'];
            $name = basename($_FILES[$fileName]['name']);
            move_uploaded_file($tmp_name, "$directory/$name");
            $path = $directory. $name ;
            if(exif_imagetype($path) == IMAGETYPE_PNG or exif_imagetype($path) == IMAGETYPE_JPEG) {
                $data = file_get_contents($path);
                $base64 = base64_encode($data);
                unlink($path);
                return $base64; 
            }
            else {
                unlink($path);
                throw new Exception("Mauvais format d'image");
            }
        }else{                              // Sinon on prend celle par defaut
            throw new Exception("Image non trouvé");
        }
    }
}