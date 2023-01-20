<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Controllers/UsersController.php";
class IndexController extends Controller{
    public function __construct()
    {
        
    }

    public function Index()
    {
        $this->render("SignUpScreen.php");
    }

    public function Login()
    {
        extract($_POST);
        if(isset($_POST['login']))
        {
            header('Location:  '.PATH.'Users/Index');
        }
        $this->render("SignUpScreen.php");
    }
}
?>