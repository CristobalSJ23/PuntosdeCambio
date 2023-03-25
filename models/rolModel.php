<?php
class RolModel{
    public function __construct(){
        require_once("connection/connection.php");
        $con = new Connection();
        $this->con = $con->connection();
    }

    public function read(){

        $query= "SELECT *, if(estatus=1,'ACTIVO','INACTIVO') AS estatus_rol,
                    if(estatus=1,'bg-success','bg-warning') AS estyles_rol
                    FROM co_roles;";
        $res = mysqli_query($this->con,$query);
        $i=0;
        if(mysqli_num_rows($res)>0){
        while($row = mysqli_fetch_assoc($res)){
            $data['id'][$i] = $row['id_rol'];
            $data['nombre'][$i] = $row['nombre'];
            $data['fecha_reg'][$i] = $row['fecha_reg'];
            $data['fecha_up'][$i] = $row['fecha_up'];
            $data['fecha_de'][$i] = $row['fecha_de'];
            $data['estatus'][$i] = $row['estatus_rol'];
            $data['bg'][$i] = $row['estyles_rol'];
            $i++;
        }
    }else{
        $data['sinData'] = "No se encontraron registros";
    }
        return $data;
    }
     public function update($datos){
       
        $fecha = getdate();
        $fecha_update = $fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"];
        $query = "UPDATE co_roles SET nombre='".$datos['nombre']."', estatus=".$datos['estatus'].", fecha_up='".$fecha_update."' WHERE id_rol='".$datos['id']."'";
        
        $res = mysqli_query($this->con, $query);
        return true;
    }

    public function save($nombre){
        $fecha = getdate();
        $fecha_registro = $fecha["year"]."-".$fecha["mon"]."-".($fecha["mday"]-1);
        $query = "INSERT INTO co_roles (nombre,fecha_reg,estatus) VALUES ('".$nombre."','".$fecha_registro."',1)";
        $res = mysqli_query($this->con, $query);
        $id = mysqli_insert_id($this->con);
        return $id;
    }

    public function getRelation($id){
        $query = "SELECT * FROM co_submenus WHERE id_menu = $id;";
        $res = mysqli_query($this->con,$query);
        $i = 0;
        while($row = mysqli_fetch_assoc($res)){
            $data['id'][$i] = $row['id_submenu'];
            $i++;
        }
        return  $data;
    }
    public function saveRelation($idRol,$idMenu,$objJson){
        $query = "INSERT INTO co_rel_rol_menu(id_rol,id_menu,json_submenu) VALUES ($idRol,$idMenu,'".$objJson."')";
        $res = mysqli_query($this->con,$query);
        return true;
    }

    public function delete($idRol){
        $fecha = getdate();
        $fecha = $fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"];
        $query = "UPDATE co_roles SET fecha_de = '$fecha', estatus = 0 WHERE id_rol =$idRol";
        mysqli_query($this->con, $query);
        return true;
    }

    public function getAllRoles() {
        $query= "SELECT *, if(estatus=1,'ACTIVO','INACTIVO') AS estatus_rol,
            if(estatus=1,'bg-success','bg-warning') AS estyles_rol FROM co_roles WHERE estatus = 1;";
        $res = mysqli_query($this->con,$query);

        $i=0;
        if(mysqli_num_rows($res)>0){
            while($row = mysqli_fetch_assoc($res)){
                $data['id'][$i] = $row['id_rol'];
                $data['nombre'][$i] = $row['nombre'];
                $data['fecha_reg'][$i] = $row['fecha_reg'];
                $data['fecha_up'][$i] = $row['fecha_up'];
                $data['fecha_de'][$i] = $row['fecha_de'];
                $data['estatus'][$i] = $row['estatus_rol'];
                $data['bg'][$i] = $row['estyles_rol'];
                $i++;
            }
            return $data;
        }
    }

}
?>