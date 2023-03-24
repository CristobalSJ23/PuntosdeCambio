<?php
class sistemaModel{
    public function __construct()
    {
        require_once("connection/connection.php");
        $con = new Connection();
        $this->con = $con->connection();
    }
    public function getSistema(){
        $query = "SELECT * FROM co_sistemas s INNER JOIN co_catalogo_estatus ce ON s.id_cat_estatus = ce.id_estatus";
        $res = mysqli_query($this->con, $query);
        $i = 0;
        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                $data['id'][$i] = $row['id_sistema'];
                $data['nombre'][$i] = $row['nombre'];
                $data['url'][$i] = $row['url'];
                $data['checkmarx'][$i] = $row['checkmarx'];
                $data['estatus'][$i] = $row['estatus'];
                $data['id_catE'][$i] = $row['id_cat_estatus'];
                $data['aprobado'][$i] = $row['vobo'];
                $data['fuente'][$i] = $row['fuente'];
                $data['total'][$i] = $row['total_pdc'];
                $data['resuelto'][$i] = $row['resuelto_pdc'];
                $data['aprobados'][$i] = $row['aprobados_pdc'];
                $data['altas'][$i] = $row['alta_vul'];
                $data['medias'][$i] = $row['media_vul'];
                $data['bajas'][$i] = $row['baja_vul'];
                $data['observacion'][$i] = $row['observacion'];
                $i++;
            }
        }else{
            $data['sinData'] = "No se encontraron registros";
        }
        return $data;
    }

    public function updateSistema($datos) {
        $query = "UPDATE co_sistemas SET 
        id_cat_estatus='".$datos['idEstatus']."', 
        checkmarx='".$datos['checkmarx']."',
        vobo='".$datos['aprobado']."',
        fuente='".$datos['fuente']."',
        resuelto_pdc='".$datos['resuelto']."',
        aprobados_pdc='".$datos['aprobados']."',
        alta_vul='".$datos['altas']."',
        media_vul='".$datos['medias']."',
        baja_vul='".$datos['bajas']."',
        observacion='".$datos['observacion']."'
        WHERE id_sistema ='".$datos['idSistema']."'";
        $res = mysqli_query($this->con, $query);
        return true;
    }

    public function getSistemaRelation(){
        $query = " SELECT * FROM co_sistemas s INNER JOIN co_r_sist_usu su ON s.id_sistema = su.id_sistema;";
        $res = mysqli_query($this->con, $query);
        $i = 0;
        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                $data['id'][$i] = $row['id_sistema'];
                $data['url'][$i] = $row['url'];
                $data['gerente'][$i] = $row['id_gerente_asignado'];
                $data['jefe'][$i] = $row['id_jefe_area_asignado'];
                $data['usuarioasi'][$i] = $row['id_usuario_asignado'];
                $i++;
            }
        }else{
            $data['sinData'] = "No se encontraron registros";
        }
        return $data;
    }
}
?>