<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Controllers/UsersController.php";
include_once "./Models/ArticlesModel.php";
include_once "./Models/DeparmentsModel.php";
//Incluimos el archivo con las validacions
include_once "./Core/validaciones.php";
class ArticlesController extends Controller{
    public function __construct()
    {
        $this->modelo = new ArticlesModel();
        $this->deparmentsModel = new DeparmentsModel();
    }

    public function Index()
    {
        $viewBag = [];
        //en la variable empleados pondremos los datos que obtengamos de la consulta get() de UsersModel
        $viewBag['productos'] = $this->modelo->get();
        $this->render("index.php",$viewBag);
    }

    public function Insert()
    {
        $viewBag = [];
        $viewBag['lugares'] = $this->deparmentsModel->get();
        $this->render("insert.php",$viewBag);
    }
}
?>