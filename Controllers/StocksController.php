<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Controllers/UsersController.php";
include_once "./Models/StocksModel.php";

class StocksController extends Controller{
    public function __construct()
    {
        $this->modelo = new StocksModel();
    }

    public function Index()
    {
        $viewBag = [];
        $viewBag['stock'] = $this->modelo->get();
        $this->render("index.php",$viewBag);
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