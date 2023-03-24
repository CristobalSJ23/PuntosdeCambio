<?php
class Router{
    private $controller;
    private $method;
    public function __construct(){
        $this->matchRoute();
    }

    public function matchRoute(){
        $url = explode("/",URL);
        $this->controller = $url[1];
        $met = explode("?",$url[2]);
        $this->method = $met[0];
        $this->controller = $this->controller."Controller";
        require_once("controllers/".$this->controller.".php");
    }

    public function run($datos){
        $controller = new $this->controller();
        $metodo = $this->method;
        $controller->$metodo($datos);
    }
}
?>