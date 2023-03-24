<?php

    include("conexion.php");
    $con = conectar();

    $palabraID = $_GET['id'];

    $sql="DELETE FROM palabras  WHERE Palabras_ID = '$palabraID'";
    $query=mysqli_query($con,$sql);

    if($query){
        echo "Registro eliminado correctamente";
        Header("Location: index.php");
    }
?>
