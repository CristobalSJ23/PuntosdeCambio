<?php

class catalogosModel{
    public function __construct()
    {
        require_once('connection/connection.php');
        $con = new Connection();
        $this->con = $con->connection();
    }
    public function getCatalogoEstatus(){
        $query = "SELECT * FROM co_catalogo_estatus";
        $res = mysqli_query($this->con, $query);
        $i = 0;

        while($row = mysqli_fetch_assoc($res)) {
            $data['id'][$i] = $row['id_estatus'];
            $data['estatus'][$i] = $row['estatus'];
            $i++;
        }

        return $data;
    }
}
?>