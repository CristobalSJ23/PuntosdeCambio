<?php
class Connection{

    public function __construct()
    {
        
    }

    public function connection(){
        $con = mysqli_connect("localhost","root","","sistema_versiones");
        if(!$con){
            echo "conexion fallida";
        }else{
            return $con;
        }
    }

}
?>