<?php
class apsModel{
    public function __construct(){
        require_once('connection/connection.php');
        $con = new Connection();
        $this->con = $con->connection();
    }

    public function listAps(){
        $query = "SELECT a.id_aps, u.id_usuario, a.nombre, CONCAT(u.nombre,' ', u.apt_pat, ' ', u.apt_mat) AS nombreCompleto, a.fecha_reg, IF(a.estatus = 1, 'ACTIVO', 'INACTIVO') AS estatus_aps, IF(a.estatus = 1, 'bg-success', 'bg-warning') AS colores_aps FROM co_aps a 
            INNER JOIN co_usuarios u ON a.id_arquitecto = id_usuario ";
        $res = mysqli_query($this->con,$query);
        $count = 0;
        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                $data['id'][$count] = $row['id_aps'];
                $data['id_arquitecto'][$count] = $row['id_usuario'];
                $data['nombre'][$count] = $row['nombre'];
                $data['nombreArquitecto'][$count] = $row['nombreCompleto'];
                $data['estatus_aps'][$count] = $row['estatus_aps'];
                $data['colores_aps'][$count] = $row['colores_aps'];
                $data['fecha_reg'][$count] = $row['fecha_reg'];
                $count++;
            }
        }else{
            $data['sinData'] = "No se encontraron registros";
        }
        return $data;
    }

    public function editAps($datos) {
        $query = "UPDATE co_aps SET nombre = '".$datos['nombre']."', estatus = '".$datos['estatus']."',id_arquitecto = '".$datos['arquitecto']."' WHERE id_aps = '".$datos["id"]."' ";
        $res = mysqli_query($this->con, $query);
        return true;
    }

    public function deleteAps($datos) { 
        $query = "UPDATE co_aps SET estatus = 0 WHERE id_aps =".$datos['idAps'];
        $res = mysqli_query($this->con,$query);
        return true;
    }

    public function saveAps($datos){
        $fecha = getdate();
        $fecha = $fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"];
        $query = "INSERT INTO co_aps (nombre,estatus,fecha_reg, id_arquitecto) VALUES ('".$datos['nombre']."', 1, '$fecha', '".$datos['arquitecto']."')";
/*         echo $query;
        exit; */
        $res = mysqli_query($this->con, $query);
        return true;
    }
}
?>