<?php

class logoutController{
    public function __construct()
    {
        
    }

    public function logout(){
      session_start();
      session_destroy();

        header("Location:../login/login");
    }
}