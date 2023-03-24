<?php
require_once(__DIR__.'/../core/coreController.php');
class indicadoresController extends coreController{
    public function __construct(){
        parent::__construct();
        require_once("models/indicadoresModel.php");
        $this->indicadores = new indicadoresModel();
        require_once("models/sistemaModel.php");
        $this->sistema = new sistemaModel();
        require_once("models/userModel.php");
        $this->user = new userModel();
        $this->js='../assets/js/indicadores.js';
        require_once("models/planpruebasModel.php");
        $this->pdp = new planpruebasModel();
    }

    public function avanceDiario(){
        $res = $this->indicadores->getAvanceDiario();
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/avance.php");
        require_once("views/templates/footer.php");
    }

    public function indicadores(){
        $res = $this->sistema->getSistemaRelation();
        $gerentes = $this->user->getGerentes();
        $jefes = $this->user->getJefes();
        $usuarioAsi = $this->user->getUsuariosAsi();
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/indicadores.php");
        require_once("views/templates/footer.php");
    }

    public function crearSelect() {
        $res['gerentes'] = array();
        $res['jefes'] = array();
        $res['usuariosAsi'] = array();
        $res['gerentes'] = $this->user->getGerentes();
        $res['jefes'] = $this->user->getJefes();
        $res['usuariosAsi'] = $this->user->getUsuariosAsi();
        echo json_encode($res);
    }

    public function updateAsignaciones() {
        $res = $this->indicadores->updateAsignaciones($_POST);
        $respdp = $this->pdp->createPDP($_POST['idSistema']); 
        echo json_encode("Registro actualizados correctamente");
    }


}


?>