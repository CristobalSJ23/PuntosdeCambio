<?php
    require_once(__DIR__.'/../core/coreController.php');
 class usersController extends coreController{
    public function __construct()
    {
        parent::__construct();
        $this->js='../assets/js/user.js';
        
        require_once("models/userModel.php");
        $this->users = new userModel();

        require_once("models/rolModel.php");
        $this->rol = new RolModel();
    }

    public function list(){
       
        $roles = $this->rol->read();
        $res = $this->users->getusers();
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/user.php");
        require_once("views/templates/footer.php");
    }


    public function update(){
        
        $res = $this->users->update($_POST);
      $data["res"] = "Tu registro se ha actualizado correctamente";
      echo json_encode($data); 
    }

    public function save() {
        $id = $this->users->saveUser($_POST);
        $res = $this->users->saveUserRol($id,$_POST["rol"]);
        $data["res"] = "Registro agregado correctamente";
        echo json_encode($data);
    }

    public function delete() {
        $res = $this->users->deleteUser($_POST["idUser"]);
        echo json_encode($res);
    }

    public function listarArquitectos() {
        $res = $this->users->getArquitectos();
        echo json_encode($res);
    }

 }
?>