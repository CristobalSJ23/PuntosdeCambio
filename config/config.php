<?php
//var_dump($_SESSION);
//exit;
    if(isset($_SESSION['mail']) && isset($_SESSION['nombre']) && isset($_SESSION['rol']) && isset($_SESSION['id'])){
        header('Location: ../home/dashboard');
    }
    $folderPath = dirname($_SERVER['SCRIPT_NAME']);
    $urlPath = $_SERVER['REQUEST_URI'];
    $url = substr($urlPath,strlen($folderPath));
    define("URL",$url);
?>