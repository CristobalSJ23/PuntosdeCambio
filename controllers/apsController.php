<?php
require_once(__DIR__.'/../core/coreController.php');
class apsController extends coreController{
    public function __construct(){
        parent::__construct();
        $this->js='../assets/js/aps.js';
        require_once('models/apsModel.php');
        $this->aps = new apsModel();
        require_once("models/userModel.php");
        $this->users = new userModel();
    }

    public function aps(){
        $res = $this->aps->listAps();
        $arquitectos = $this->users->getArquitectos();
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/aps.php");
        require_once("views/templates/footer.php");
        
    }

    public function edit() {
        $res = $this->aps->editAps($_POST);
        $data["res"] = "Tu registro se ha actualizado correctamente";
        echo json_encode($data); 
    }

    public function delete(){
        $res = $this->aps->deleteAps($_POST);
        echo json_encode($res);
    }

    public function save(){
        $res = $this->aps->saveAps($_POST);
        $data["res"] = "Tu registro se ha agregado correctamente";
        echo json_encode($data);
    }

}
?>