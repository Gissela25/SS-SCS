<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Controllers/UsersController.php";
include_once "./Models/MovementsModel.php";

class MovementsController extends Controller{

    private $modelo;

    public function __construct()
    {
        Auth::checkAuth();
        $this->modelo = new MovementsModel();
    }

    public function WithDrawals()
    {
        $viewBag = [];
        //en la variable empleados pondremos los datos que obtengamos de la consulta get() de UsersModel
        $viewBag['productos'] = $this->modelo->getArticlesByArea($_SESSION['area']);
        $id_session = $_SESSION['dataBuffer']['Id_Usuario'];
        $viewBag['quantity'] = $this->modelo->getMovementsTemp(sha1($id_session));
        $viewBag['movimientos']=$this->modelo->getMovementsTemp(sha1($id_session));
        $this->render("withdrawals.php",$viewBag);
    }

    public function Index(){
        $viewBag = [];
        $viewBag['movimientos']=$this->modelo->searchMovementsByArea($_SESSION['area']);
        $this->render("index.php",$viewBag);
    }

    public function KardexByArticle(){
        $viewBag = [];
        $viewBag["productos"] = $this->modelo->getMovementsByArea($_SESSION['area']);
        $this->render("kardex.php",$viewBag);
    }

    public function MovementsByDeparment(){
        $viewBag = [];
        $viewBag["productos"] = $this->modelo->getMovementsDeparmentByArea($_SESSION['area']);
        $this->render("Movements.php",$viewBag);
    }

    public function EntryByDate(){
        $viewBag = [];
        $viewBag["productos"] = $this->modelo->getEntryByDate($_SESSION['area']);
        $this->render("EntryDate.php",$viewBag);
    }

    public function WithdrawalByDate(){
        $viewBag = [];
        $viewBag["productos"] = $this->modelo->getWithdrawalByDate($_SESSION['area']);
        $this->render("WithdrawalDate.php",$viewBag);
    }

    public function SeeSpecificKardex($id){
        $viewBag = [];
        $viewBag["productos"] = $this->modelo->getMovements($id);
        $this->render("kardexByArticle.php",$viewBag);
    }

    public function SeeSpecificEntryByDate($id){
        $viewBag = [];
        $viewBag["productos"] = $this->modelo->getMovementsEntryByArea($id, $_SESSION['area']);
        $this->render("EntryDateByDate.php",$viewBag);
    }

    public function SeeSpecificWithdrawelByDate($id){
        $viewBag = [];
        $viewBag["productos"] = $this->modelo->getMovementsWithdrawalByArea($id, $_SESSION['area']);
        $this->render("WithdrawalDateByDate.php",$viewBag);
    }

    public function WithdrawalByDateReport($id){
        $viewBag = [];
        $viewBag["productos"] = $this->modelo->getMovementsWithdrawalByArea($id, $_SESSION['area']);
        $this->render("WithdrawalDateByDateReport.php",$viewBag);
    }

    public function EntryByDateReport($id){
        $viewBag = [];
        $viewBag["productos"] = $this->modelo->getMovementsEntryByArea($id, $_SESSION['area']);
        $this->render("EntryDateByDateReport.php",$viewBag);
    }

    public function SeeSpecificMovementsforDeparment($id){
        $viewBag = [];
        $viewBag["productos"] = $this->modelo->getMovementsByDeparment($id);
        $this->render("MovementsByDeparment.php",$viewBag);
    }

    public function KardexByArticleReport($id){
        $viewBag = [];
        $viewBag["productos"] = $this->modelo->getMovements($id);
        $this->render("kardexByArticleReport.php",$viewBag);
    }

    public function MovementsByDeparmentReport($id){
        $viewBag = [];
        $viewBag["productos"] = $this->modelo->getMovementsByDeparment($id);
        $this->render("MovementsByDeparmentReport.php",$viewBag);
    }

    public function WithdrawalArticlesReport($id){
        $viewBag = [];
        $viewBag["movimientos"] = $this->modelo->getWithdrawalArticlesReport($id);
        $this->render("WithdrawalArticlesReport.php",$viewBag);
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
        $movimiento['Cantidad'] = $Salida;        
        if($this->modelo->ModifyItemToWithDraw($movimiento))
        {
            echo "success";
        }
    }

    if(isset($_POST['Quitar']))
    {
        extract($_POST);
        $movimiento['Id_Articulo']=$id;
        $movimiento['Cantidad'] = $Salida;        
        if($this->modelo->ModifyItemToWithDraw($movimiento))
        {
            echo "success";
        }
    }

    if(isset($_POST['Eliminar']))
    {
        extract($_POST);   
        $buffer['Id_Articulo']=$id;
        $buffer['Id_Session']= sha1($_SESSION['dataBuffer']['Id_Usuario']);
        if($this->modelo->deleteSpecificTemporaryWithDrawalData($buffer))
        {
            header('Location: '.PATH.'Movements/WithDrawals');
        }
    }
}




    public function CompleteWithDrawls(){
        if(isset($_POST['Completar'])){
            extract($_POST);
            $errores = array();
            $id_session = sha1($_SESSION['dataBuffer']['Id_Usuario']);
            $correlativo = $this->modelo->generateCorrelative();
            $checkTempData = $this->modelo->checkWithDrawalAmount();
            $tempData = $this->modelo->getTemporaryWithDrawalData($id_session);
            $correlative['Id_Correlativo'] = $correlativo;
            $correlative['Id_Usuario']=$_SESSION['dataBuffer']['Id_Usuario'];
            $erroresVag = [];
            $counter=0;
            $negativeCounter=0;
            foreach($checkTempData as $item)
            {
                if($item['SaldoResultante'] < 0)
                {
                    $negativeCounter+=1;
                    $erroresVag[] = [
                        'SaldoResultante' => (-1) * $item['SaldoResultante'],
                        'Articulo' => $item['NombreA'],
                        'Saldo' => $item['Saldo']
                    ] ;
                }
            }
            if($negativeCounter == 0)
            {
                if($this->modelo->createCorrelative($correlative)){
                    foreach ($tempData as $item) {
                        $item['F_Movimiento'] = date('Y-m-d');
                        $item['Id_Correlativo'] = $correlativo;             
                        if($this->modelo->completeWithDrawals($item)){
                            $newBalance['Id_Existencia'] = $item['Id_Existencia'];
                            $newBalance['Id_Articulo'] = $item['Id_Articulo'];
                            $newBalance['Saldo'] = $item['SaldoResultante'];
                            if($this->modelo->updateBalances($newBalance))
                            {
                                $counter +=1;
                            }
                        }
                    }
                }
                if(count($tempData)== $counter){
                    if($this->modelo->deleteAllTemporaryWithDrawalData($id_session))
                    {
                        header('Location: '.PATH.'Movements');
                    }
                }  
                else{
                    array_push($errores,"Algo salió mal al intentar coompletar el retiro");
                    $this->renderWithDrawals($errores);
                }  
            }
            else{
                foreach($erroresVag as $item){
                    array_push($errores, "Has superado el saldo actual <b>(".$item['Saldo'].")</b> por un saldo excendente de ". $item['SaldoResultante']. " en el artículo ".$item['Articulo']);
                }
                $this->renderWithDrawals($errores);
            }
           
        }
    }

    public function renderWithDrawals($errores = array())
    {
        $viewBag = [];
        $viewBag['errores'] = $errores;
        $viewBag['productos'] = $this->modelo->get();
        $id_session = $_SESSION['dataBuffer']['Id_Usuario'];
        $viewBag['quantity'] = $this->modelo->getMovementsTemp(sha1($id_session));
        $viewBag['movimientos']=$this->modelo->getMovementsTemp(sha1($id_session));
        $this->render("withdrawals.php",$viewBag);
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
                $item['Id_Session']=sha1($_SESSION['dataBuffer']['Id_Usuario']);
                $cantidad = 0 ;
                $op = "";
                if(count($this->modelo->verifyItem($item)) >0)
                {
                    $article = $this->modelo->verifyItem($item);
                    extract($article[0]);
                    $op = "notFirst";
                    $withdraw['Id_Session']= sha1($_SESSION['dataBuffer']['Id_Usuario']);
                    $withdraw['Id_Articulo']=$id;
                    $withdraw['Cantidad']= $Salida + $Cantidad; 
                }
                else{
                    $cantidad= $Salida;
                    $op = "firts";
                    $withdraw['Id_Session']= sha1($_SESSION['dataBuffer']['Id_Usuario']);
                    $withdraw['Id_Articulo']=$id;
                    $withdraw['Id_Usuario']= $_SESSION['dataBuffer']['Id_Usuario'];
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