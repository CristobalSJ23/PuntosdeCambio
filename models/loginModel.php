<?php
class LoginModel{

    public function __construct()
    {
        require_once("connection/connection.php");
        $con = new Connection();
        $this->con = $con->connection();
    }

    public function validate($datos){
       $query = "select usu.correo as correo,
                usu.nombre as nombre,
                usu.apt_pat as apt_pat,
                usu.apt_mat as apt_mat ,
                r_usu.id_rol as rol,
                usu.id_usuario as id_usuario
                from co_usuarios usu
       INNER JOIN co_r_usu r_usu ON r_usu.id_usuario = usu.id_usuario 
       where usu.correo = '".$datos['usuario']."' 
       AND usu.password ='".$datos['pass']."' AND usu.estatus = 1";
       
       $res=mysqli_query($this->con,$query);
       if(mysqli_num_rows($res)>0){
            while($row = mysqli_fetch_assoc($res)){
                $data['mail'] = $row['correo'];
                $data['nombre'] = $row['nombre'].' '.$row['apt_pat'].' '.$row['apt_mat'];
                $data['rol'] = $row['rol'];
                $data['id'] = $row['id_usuario'];

            }
       }else{
            $data['errorLogin'] = "Usuario o/y contraseña incorrectos";
       }
       return $data;
    }
}
?>