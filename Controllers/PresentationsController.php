<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Controllers/UsersController.php";
class PresentationsController extends Controller{
    public function __construct()
    {
        
    }

    public function Index()
    {
        $this->render("index.php");
    }

    public function Insert()
    {
        $this->render("insert.php");
    }

    public function Update()
    {
        $this->render("update.php");
    }
}
?>