<?php
require_once(__DIR__.'/../core/coreController.php');
class planpruebasController extends coreController{
    public function __construct(){
        parent::__construct();
        $this->js='../assets/js/planpruebas.js';
        require_once('models/planpruebasModel.php');
        $this->plan = new planpruebasModel();

        require_once("models/catalogosModel.php");
        $this->catalogoEstatus = new catalogosModel();

        require_once("models/userModel.php");
        $this->user = new userModel();
    }

    public function read(){
        $res = $this->plan->getPlan();
        $catalogosEstatus = $this->catalogoEstatus->getCatalogoEstatus();
        $arquitectos = $this->user->getArquitectos();
        $programadores = $this->user->getProgramadores();
        $testers = $this->user->getTester();
        $gerentes = $this->user->getGerentes();
        $jefes = $this->user->getJefes();
        $usuarioAsi = $this->user->getUsuariosAsi();
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/planpruebas.php");
        require_once("views/templates/footer.php");

    }

    public function getEstatusNotas(){
        $res = $this->plan->getEstatusNotas($_POST['idpdp']);
        echo json_encode($res);
    }

    public function update(){
        $res = $this->plan->update($_POST);
        echo json_encode("El plan de pruebas se ha actualizado");
    }

    public function getHistorialPDP() {
        $res = $this->plan->getHistorialPDP($_POST['id_pdp']);
        echo json_encode($res);
    }

}
?>