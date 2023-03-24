<?php
require_once(__DIR__.'/../core/coreController.php');
class sistemaController extends coreController{
    public function __construct()
    {
        parent::__construct();
        $this->js='../assets/js/sistema.js';

        require_once("models/sistemaModel.php");
        $this->sistema = new sistemaModel();

        require_once("models/catalogosModel.php");
        $this->catalogoEstatus = new catalogosModel();
    }
    public function readSistema(){
        $res = $this->sistema->getSistema();
        $catalogosEstatus = $this->catalogoEstatus->getCatalogoEstatus();
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/sistema.php");
        require_once("views/templates/footer.php");
    }

    public function updateSistema() {
        $res = $this->sistema->updateSistema($_POST);
        $data['res'] = 'Tu registro se actualizo correctamente';
        echo json_encode($data);
    }

    public function crearSelect(){
        $catalogosEstatus = $this->catalogoEstatus->getCatalogoEstatus();
        echo json_encode($catalogosEstatus);
    }
}
?>