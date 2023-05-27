<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Controllers/UsersController.php";
include_once "./Core/validaciones.php";
include_once "./Models/UsersModel.php";
include_once "./Models/ArticlesModel.php";

class IndexController extends Controller{

    private $modelo;
    public function __construct()
    {
        $this->modelo = new UsersModel();
    }

    public function Index()
    {
        $viewBag = [];
        $viewBag['areas']=$this->modelo->getArea();
        $this->render("SignUpScreen.php",$viewBag);
    }

    public function LogOut(){
        session_unset();
        session_destroy();
        header('Location: '.PATH.'Index');
    }

    public function Login()
    {
        if(isset($_POST['Ingresar']))
        {
            extract($_POST);
            $errores = array();
            $viewBag = [];
            if(!isset($Correo)||isEmpty($Correo))
            {
                array_push($errores,"Debes ingresar un correo");
            }
            if(!isset($Clave)||isEmpty($Clave))
            {
                array_push($errores,"Debes ingresar tu clave");
            }
            if(!isset($area)||isEmpty($area))
            {
                array_push($errores,"Debes seleccionar un área");
            }
            if(count($errores)>0){
                $viewBag['errores'] = $errores;
                $viewBag['areas']=$this->modelo->getArea();
                $this->render("SignUpScreen.php",$viewBag);
            }
            else{
                $user['Correo']=$Correo;
                $user['Clave']=$Clave;
                if($this->modelo->getDataUser($user))
                {
                    $areaBuffer= $this->modelo->getArea($area);
                    $dataUser = $this->modelo->getDataUser($user);
                    if(count($dataUser)>0){
                        $_SESSION['dataBuffer']=$dataUser[0];
                        $_SESSION['areaBuffer']=$areaBuffer[0];
                        $_SESSION['area']=$area;
                        header('Location: '.PATH.'Articles/Index');
                    }
                }
                else{
                    array_push($errores,"Algo salió mal");
                    $viewBag['errores'] = $errores;
                    $viewBag['areas']=$this->modelo->getArea();
                    $this->render("SignUpScreen.php",$viewBag);
                }
            }
        }
                   
    }

}
?>