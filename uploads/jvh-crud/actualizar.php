<?php 
    include("conexion.php");
    $con=conectar();

    $id = $_GET['id'];

    $sql="SELECT * FROM palabras p INNER JOIN lenguajes l ON p.Lenguaje_ID = l.Lenguaje_ID WHERE Palabras_ID = '$id'";
    $query=mysqli_query($con,$sql);

    $row=mysqli_fetch_array($query);

    $len = "SELECT * FROM lenguajes";
    $rec = mysqli_query($con,$len);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <title>Actualizar</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">        
    </head>
    <body>
        <div class="container mt-5">
            <form action="update.php?id=<?= $id ?>" method="POST">
                <input type="text" class="form-control mb-3" name="palabraClave" value="<?php echo $row['Palabra_Nombre']  ?>">
                <select name="lenguaje" id="lenguaje" class="form-control mb-3">
                    <option value="<?php $row['Lenguaje_ID'] ?>" selected><?= $row['Lenguaje_Nombre'] ?> </option>
                    <?php while($fila = $rec->fetch_assoc()): ?>
                        <option value="<?= $fila['Lenguaje_ID'] ?>"><?= $fila['Lenguaje_Nombre'] ?></option>
                    <?php endwhile; ?>
                </select>
                        
                <input type="submit" class="btn btn-primary btn-block" value="Actualizar">
            </form>
            
        </div>
    </body>
</html>