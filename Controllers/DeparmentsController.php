<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Controllers/UsersController.php";
include_once "./Models/DeparmentsModel.php";
include_once "./Core/validaciones.php";

class DeparmentsController extends Controller{
    public function __construct()
    {
        $this->modelo = new DeparmentsModel();
    }

    public function Index()
    {
        $viewBag = [];
        $viewBag['departamentos'] = $this->modelo->get();
        $this->render("index.php",$viewBag);
    }

    public function Insert()
    {
        $this->render("insert.php");
    }
    public function AddDeparment()
    {
        if(isset($_POST['Guardar']))
        {
            extract($_POST);
            $errores=array();
            $viewBag=array(); 
            if(!isset($Nombre)||isEmpty($Nombre))
            {
                array_push($errores,"Debes ingresar un Departamento");
            }
            elseif(!isOnlyText($Nombre))
            {
                array_push($errores,"El campo Nombre de Departamento acepta solo texto");
            }

            $departamento['Id_Departamento']=$this->modelo->getCode();
            $departamento['Nombre']=$Nombre;

            if(count($errores)>0)
            {
                $viewBag['deparment']=$departamento;
                $viewBag['errores']=$errores;
                $this->render("insert.php",$viewBag);
            }
            else
            {
                if($this->modelo->create($departamento)>0)
                {
                    header('Location: '.PATH.'Deparments');
                }
                else{
                    array_push($errores, "Ha ocurrido un error al intentar agregar un departamento");
                    $viewBag['errores']=$errores;
                    $viewBag['deparment']=$departamento;
                    $this->render("insert.php",$viewBag);
                }
            }
        }
    }
}
?>