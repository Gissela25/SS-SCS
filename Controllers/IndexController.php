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
                    
                    $dataUser = $this->modelo->getDataUser($user);
                    if(count($dataUser)>0){
                        $areaBuffer= $this->modelo->getArea($dataUser[0]['Id_Area']);
                        $_SESSION['dataBuffer']=$dataUser[0];
                        $_SESSION['areaBuffer']=$areaBuffer[0];
                        //En esta variable de sesión se almacena el Id del  Area
                        $_SESSION['area']=$areaBuffer[0]['Id_Area'];
                       echo "Hello friend, ".$_SESSION['dataBuffer']['Nombre'];
                       echo "<br>Area:  ".$_SESSION['areaBuffer']['Nombre'];
                       echo var_dump($areaBuffer);
                       echo var_dump($dataUser);
                       echo "<br><a href='".PATH."Articles'> Articulos</a>";
                       echo "<br><a href='".PATH."Index/Logout/".$_SESSION['dataBuffer']['Id_Usuario']."'> Cerra sesión</a>";
                        }
                }
                else{
                array_push($errores,"Algo salió ma al intentar ingresar");
                $viewBag['errores'] = $errores;
                $viewBag['areas']=$this->modelo->getArea();
                $this->render("SignUpScreen.php",$viewBag);
                }
          }
        }

   }

}
?>