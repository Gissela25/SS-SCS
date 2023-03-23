<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Controllers/UsersController.php";
include_once "./Models/AreasModels.php";
include_once "./Core/validaciones.php";

class AreasController extends Controller{
    public function __construct()
    {
        $this->modelo = new AreasModels();
    }

    public function Index()
    {
        $viewBag=[];
        $viewBag['Areas'] = $this->modelo->get();

        $this->render("index.php",$viewBag);
    }

    public function Insert()
    {
        $this->render("insert.php");
    }
}
?>