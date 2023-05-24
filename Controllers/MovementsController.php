<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Controllers/UsersController.php";
include_once "./Models/MovementsModel.php";

class MovementsController extends Controller{

    private $modelo;

    public function __construct()
    {
        $this->modelo = new MovementsModel();
    }

    public function WithDrawals()
    {
        $viewBag = [];
        //en la variable empleados pondremos los datos que obtengamos de la consulta get() de UsersModel
        $viewBag['productos'] = $this->modelo->get();
        $this->render("withdrawals.php",$viewBag);
    }

}
?>