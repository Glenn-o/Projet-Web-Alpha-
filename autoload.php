<?php

function autoload($class_name)
{
    print('<br>'.$class_name.'<br>');
    $path = str_replace('\\', '/', $class_name).'.class.php';
    $path = dirname(__FILE__).'/'.$path;
    if(is_file($path))
    {
        require_once($path);
    }
    print($path);
}


spl_autoload_register('autoload');