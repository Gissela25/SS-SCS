<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
class UsersController extends Controller{
    public function __construct()
    {
        
    }

    public function Index()
    {
        $this->render("index.php");
    }

}
?>