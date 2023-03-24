<?php
class loginController{

    public function __construct()
    {
        require_once("models/loginModel.php");
        $this->loginModel = new LoginModel();
    }

    public function login($datos = null){
        session_start();
        if(isset($_SESSION['mail']) && isset($_SESSION['nombre']) && isset($_SESSION['rol']) && isset($_SESSION['id'])){
            header('Location: ../home/dashboard');}
        if(isset($_POST['ingresar'])){
            $datos = $this->validate($_POST);
        }
        
        require_once("views/templates/header.php");
        require_once("views/login.php");
        require_once("views/templates/footer.php");
        

    }

    public function validate($datos){
        if(empty($datos['usuario'])){
         $data['errorUsuario'] = "Error favor de llenar el campo Usuario";   
        }
        if(empty($datos['pass'])){
         $data['errorPassword'] = "Error favor de llenar el campo Password";
        }
        if(isset($data)){
            $data['usuario'] = $datos['usuario'];
            $data['pass'] = $datos['pass'];
            return $data;
        }
        
        $res = $this->loginModel->validate($datos);
        if(isset($res['errorLogin'])){
            $data = $res;
            return $data;
        }

        if(isset($res['id'])){
            session_start();
            $_SESSION = $res;
            header('Location: ../home/dashboard');
            exit;
        }

    }

   
}
