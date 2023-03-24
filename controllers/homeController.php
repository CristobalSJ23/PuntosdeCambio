<?php
    require_once(__DIR__.'/../core/coreController.php');

    class homeController extends coreController{
        public function __construct(){
            parent::__construct();
            if(isset($_SESSION) && ($_SESSION['id']) != 0) {
                
            } else {
                header("Location: index.php");
            }
        }

        public function dashboard(){
            require_once("views/templates/header.php");
            require_once("views/templates/menu.php");
            require_once("views/home.php");
            require_once("views/templates/footer.php");
        }
        
    }

?>