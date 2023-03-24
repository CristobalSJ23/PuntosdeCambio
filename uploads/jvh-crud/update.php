<?php

    include("conexion.php");
    $con = conectar();

    $palabraID = $_GET['id'];
    $palabraClave = $_POST['palabraClave'];
    $lenguajeID = $_POST['lenguaje'];

    $sql="UPDATE palabras SET Palabra_Nombre='$palabraClave', Lenguaje_ID=$lenguajeID WHERE Palabras_ID=$palabraID";

    //echo $sql;
    //$sqlu = "UPDATE palabras SET Palabra_Nombre='$palabraClave', Lenguaje_ID='$lenguajeID' WHERE Palabras_ID='$palabraID'";
    $query = mysqli_query($con,$sql);

    if($query){
        Header("Location: index.php");
    }
?>