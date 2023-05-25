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
        $viewBag['quantity'] = $this->modelo->getMovementsTemp($_SESSION['id_session']);
        $viewBag['movimientos']=$this->modelo->getMovementsTemp($_SESSION['id_session']);
        $this->render("withdrawals.php",$viewBag);
    }

    public function Index(){
        $viewBag = [];
        $viewBag['movimientos']=$this->modelo->searchMovements();
        $this->render("index.php",$viewBag);
    }

    public function KardexByArticle(){
        $viewBag = [];
        $this->render("kardex.php");
    }

    public function WithDraw($id)
    {
        $viewBag = [];
        //en la variable empleados pondremos los datos que obtengamos de la consulta get() de UsersModel
        $viewBag['productos'] = $this->modelo->get($id);
        $this->render("withdraw.php",$viewBag);
    }

    public function Operations($id)
    {
        if(isset($_POST['Agregar']))
        {
            extract($_POST);
            $movimiento['Id_Articulo']=$id;
            $movimiento['Cantidad'] = $Salida + 1;        
            if($this->modelo->ModifyItemToWithDraw($movimiento))
            {
                header('Location: '.PATH.'Movements/WithDrawals');
            }
        }

        if(isset($_POST['Quitar']))
        {
            extract($_POST);
            $movimiento['Id_Articulo']=$id;
            $movimiento['Cantidad'] = $Salida - 1;        
            if($this->modelo->ModifyItemToWithDraw($movimiento))
            {
                header('Location: '.PATH.'Movements/WithDrawals');
            }
        }
    }


    public function MakeWithDrawal($id){
        if(isset($_POST['Aceptar'])){
            extract($_POST);
            $viewBag = array();
            $errores = array();
            if(!isset($Salida)||isEmpty($Salida))
            {
                array_push($errores,"Debes ingresar la cantidad de saldo a retirar. ¡Intenta de nuevo!");
            }
            elseif(!esInteger($Salida))
            {
              array_push($errores,"Solo puedes ingresar cantidades entereas.");
            }
            if(count($errores)>0){
                $viewBag['errores'] = $errores;
                $viewBag['productos'] = $this->modelo->get($id);
                $this->render("withdraw.php",$viewBag);
            }
            else{
                //Las variables que estamos obteniendo por $_SESSION se definiran cuando esté el login
                $item['Id_Articulo']=$id;
                $item['Id_Session']=$_SESSION['id_session'];
                $cantidad = 0 ;
                $op = "";
                if(count($this->modelo->verifyItem($item)) >0)
                {
                    $article = $this->modelo->verifyItem($item);
                    extract($article[0]);
                    $op = "notFirst";
                    $withdraw['Id_Session']=$_SESSION['id_session'];
                    $withdraw['Id_Articulo']=$id;
                    $withdraw['Cantidad']= $Salida + $Cantidad; 
                }
                else{
                    $cantidad= $Salida;
                    $op = "firts";
                    $withdraw['Id_Session']=$_SESSION['id_session'];
                    $withdraw['Id_Articulo']=$id;
                    $withdraw['Id_Usuario']=$_SESSION['id_usuario'];
                    $withdraw['Id_Existencia']=$Id_Existencia;
                    $withdraw['Cantidad']=$cantidad;
                }         
                if($this->modelo->createOrModifyWithDrawal($withdraw,$op))
                {
                    header('Location: '.PATH.'Movements/WithDrawals');
                }
                else{
                    array_push($errores,"Algo salió mal al intentar hacer el retiro.");
                    $viewBag['errores'] = $errores;
                    $viewBag['productos'] = $this->modelo->get($id);
                    $this->render("withdraw.php",$viewBag);
                }
            }
        }
    }

}
?>