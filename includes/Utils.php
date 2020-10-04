<?php

class Utils
{
//recuperer valeur d'un champ en GET ou POST
    public static function GETPOST($champ)
    {
        if(isset($_POST[$champ]))
        {
            return htmlentities($_POST[$champ]);
        }
        else if(isset($_GET[$champ]))
        {
            return htmlentities($_GET[$champ]);
        }
        else 
        {
            return "";
        }
    }

    //SI VALEUR = "" RETURN TRUE ELSE FALSE
    public static function GETPOSTSETEMPTY($field)
    {
        if(Utils::ISGETPOST($field) AND Utils::GETPOST($field) == "")
        {
            return true;
        }
        else
            return false;
    }

    //SI DECLARE DANS GET OU POST RETURN TRUE ELSE FALSE
    public static function ISGETPOST($champ) : bool
    {
        if(!empty($_POST[$champ]) or !empty($_GET[$champ]))
        {
            return true;
        }
        else
            return false;
    }

    function ISFILESET($fileName) : bool
    {
        return !empty($_FILES[$fileName]);
    }
}
#endregion