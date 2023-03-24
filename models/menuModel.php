<?php 
    class MenuModel {
        public function __construct() {
            require_once("connection/connection.php");
            $con = new Connection();
            $this->con = $con->connection();
        } 

        public function getMenu($rol) {
            $query = "SELECT 
                    cm.nombre AS nombre, cm.orden AS orden, crrm.json_submenu AS json_submenu, crrm.id_rol AS id_rol 
            FROM co_rel_rol_menu crrm 
            INNER JOIN co_menus cm ON crrm.id_menu = cm.id_menu
            WHERE crrm.id_rol = $rol AND cm.estatus = 1";
            $res = mysqli_query($this->con,$query);
            $i = 0;
            while($row = mysqli_fetch_assoc($res)) {
                $data['nombre_menu'][$i] = $row['nombre'];
                $data['orden_menu'][$i] = $row['orden'];
                $data['json_submenu'][$i] = $row['json_submenu'];
                $data['id_rol'][$i] = $row['id_rol'];
                $i++;
            }

            return $data;
        }

        public function getSubMenu($id){
            $query = "SELECT * FROM co_submenus WHERE id_submenu IN($id) AND estatus = 1";
            $res = mysqli_query($this->con, $query);
            $i = 0; 
            while($row = mysqli_fetch_assoc($res)){
                $data['id'][$i] = $row['id_submenu'];
                $data['nombre'][$i] = $row['nombre'];
                $data['url'][$i] = $row['url'];
                $data['idmenu'][$i] = $row['id_menu'];
                $i++;
            }
            return $data;
        }

        public function getAllMenu() {
            $query = "SELECT * FROM co_menus";
            $res = mysqli_query($this->con,$query);
            $i = 0; 
            while($row = mysqli_fetch_assoc($res)){
                $data['id'][$i] = $row['id_menu'];
                $data['nombre_menu'][$i] = $row['nombre'];
                $data['orden'][$i] = $row['orden'];
                $data['descripcion'][$i] = $row['descripcion'];
                $data['estatus'][$i] = $row['estatus'];
                $i++;
            }
            return $data;
        }

        public function getAllSubmenu($id) {
            /* var_dump($id);
            exit; */
            $query = "SELECT * FROM co_submenus WHERE id_menu = $id";
            $res = mysqli_query($this->con,$query);
            $i = 0; 
            while($row = mysqli_fetch_assoc($res)){
                $data['id'][$i] = $row['id_submenu'];
                $data['id_menu'][$i] = $row['id_menu'];
                $data['nombre'][$i] = $row['nombre'];
                $data['orden'][$i] = $row['orden'];
                $data['descripcion'][$i] = $row['descripcion'];
                $data['estatus'][$i] = $row['estatus'];
                $data['url'][$i] = $row['url'];
                $i++;
            }
            return $data;
        }
    }

?>