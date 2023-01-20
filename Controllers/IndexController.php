<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
class IndexController extends Controller{
    public function __construct()
    {
        
    }

    public function Index()
    {
        $this->render("SignUpScreen.php");
    }
}
?>