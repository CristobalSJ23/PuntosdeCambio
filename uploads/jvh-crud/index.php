<?php 
    include("conexion.php");
    $con = conectar();

    $sql = "SELECT * FROM palabras p INNER JOIN lenguajes l ON p.Lenguaje_ID = l.Lenguaje_ID";

    $query = mysqli_query($con,$sql);

    $row = mysqli_fetch_array($query);

    $len = "SELECT * FROM lenguajes";
    $rec = mysqli_query($con,$len);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Puntos de Cambio </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    </head>
    <body>
            <div class="container mt-5">
                    <div class="row"> 
                        
                        <div class="col-md-3">
                            <h2>Agregar palabra</h2>
                            <form action="insertar.php" method="POST">
                                <input type="text" class="form-control mb-3" placeholder="Palabra" name="palabraClave" id="palabraClave">
                                <select name="lenguaje" id="lenguaje" class="form-select">
                                    <?php while($fila = $rec->fetch_assoc()): ?>
                                        <option value="<?= $fila['Lenguaje_ID'] ?>"><?= $fila['Lenguaje_Nombre'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <br>
                                <input type="submit" class="btn btn-primary">
                            </form>
                        </div>

                        <div class="col-md-8">
                            <table class="table align-middle" >
                                <thead class="" >
                                    <tr>
                                        <th>Lenguaje</th>
                                        <th>Palabra</th>
                                        <th colspan="2">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        while($row=mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?php  echo $row['Lenguaje_Nombre']?></td>
                                        <td><?php  echo $row['Palabra_Nombre']?></td> 
                                        <td class="col-md-1"><a href="actualizar.php?id=<?php echo $row['Palabras_ID'] ?>" class="text-success"><i class="bi bi-pencil-square"></i</a></td>
                                        <td class="col-md-1"><a href="delete.php?id=<?php echo $row['Palabras_ID'] ?>" class="text-danger"><i class="bi bi-trash"></i></a></td>                                        
                                    </tr>
                                    <?php 
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>  
            </div>
    </body>
</html>