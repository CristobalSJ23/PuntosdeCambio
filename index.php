<?php
//session_start();
//var_dump($_SESSION);
//exit;
//if($_SESSION['mail']!="" && $_SESSION['nombre']!="" && $_SESSION['rol']!="" && $_SESSION['id']!=""){
require_once("config/config.php");
$url = explode("/",URL);
require_once("routes/router.php");
if($url[0] == "" && $url[1] == ""){
     header("location: home/dashboard");
}
$routes = new Router();
$peticion = $_SERVER["REQUEST_METHOD"];
if($peticion == "GET"){
    $datos = $_GET;
}else{
    $datos = $_POST;
}
$routes->run($datos);
//}else{
    //header('location: ../login/login');
//}

// require_once("controllers/loginController.php");
// $inc = new LoginController();
/* Elektra */
?>