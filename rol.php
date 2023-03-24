<?php
    require_once("controllers/rolController.php");
    $rol = new RolController();
    $peticion = $_SERVER["REQUEST_METHOD"];

    if($peticion == "GET"){
        $rol->rol();
    }else{
        $respuesta = $rol->saveRol($_POST);
        $rol->rol($respuesta);
    }
    
?>