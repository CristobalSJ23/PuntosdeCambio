<?php
class coreController{
    public function __construct(){
        session_start();
        if(isset($_SESSION['mail']) && isset($_SESSION['nombre']) && isset($_SESSION['rol']) && isset($_SESSION['id'])){
        require_once(__DIR__.'/../models/menuModel.php');
        $this->instanciaMenu = new MenuModel();
        $this->menu = $this->crearMenu($this->instanciaMenu,$_SESSION['rol']);
       
    }else{
        header('Location: ../login/login');
        exit;
    }
    }   
    private function crearMenu($instancia,$rol){
        $menu = $instancia->getMenu($rol);
        foreach($menu['id_rol'] as $i=>$men) {
            $decode = json_decode($menu['json_submenu'][$i]);
            $id_submenu = explode(",",$decode->id);
                
            foreach($id_submenu as $id) {
                $submenu = $instancia->getSubMenu(implode(",", $id_submenu));               
                $menu['submenu'][$i] = $submenu;                    
            }             
        }
        return $menu;
    }
}
?>