<?php
    include("conexion.php");
    $con = conectar();

    $palabraClave = $_POST['palabraClave'];
    $lenguajeID = $_POST['lenguaje'];

    $sql = "INSERT INTO palabras VALUES ('','{$palabraClave}', '{$lenguajeID}')";
    $query= mysqli_query($con,$sql);

    if($query){
        Header("Location: index.php");    
    } else {

    }
?>