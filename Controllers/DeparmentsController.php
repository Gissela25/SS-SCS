<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Controllers/UsersController.php";
include_once "./Models/DeparmentsModel.php";
include_once "./Core/validaciones.php";

class DeparmentsController extends Controller{

    private $modelo;

    public function __construct()
    {
        $this->modelo = new DeparmentsModel();
    }

    public function Index()
    {
        $viewBag = [];
        $viewBag['lugares'] = $this->modelo->get();
        $this->render("index.php",$viewBag);
    }

    public function Insert()
    {
        $this->render("insert.php");
    }

    //Función para añadir un registro a la tabla usuarios
    public function AddDeparment()
    {
        //Comprobamos el submit del formuario con el nombre del botón
        if(isset($_POST['Guardar']))
        {
            //Extraemos los datos del POST
            extract($_POST);
            $errores=array();
            $viewBag=array();
            //Procedemos a comprobar las validaciones isEmpty e !isset comprueban que no esté vacío o nulo
            //la validación en el elseif es una validación especial para el campo que utilice
            if(!isset($Nombre)||isEmpty($Nombre))
            {
                array_push($errores,"Debes ingresar un departamento");
            }
            elseif(!isOnlyText($Nombre))
            {
              array_push($errores,"El campo nombre acepta solo texto");
            }
            // Guardamos las variables en un arreglo llamado usuario
            $departamento['Id_Departamento']=$this->modelo->getCode();
            $departamento['NombreD']=$Nombre;
            //Comprobamos si el arreglo errores está vacío o no
            if(count($errores)>0)
                {

                    $viewBag['lugar']=$departamento;
                    $viewBag['errores']=$errores;
                    $this->render("insert.php",$viewBag);
                }
                else
                {
                    //Si el conteo es menor o igual a cero procedemos a crear un registro
                    if($this->modelo->create($departamento)>0)
                    {
                        header('Location: '.PATH.'Deparments');
                    }
                    else{
                        array_push($errores, "Ha ocurrido un error al ingresar departamento");
                        $viewBag['errores']=$errores;
                        $viewBag['lugar']=$departamento;
                        $this->render("insert.php",$viewBag);
                    }
                }
            
           
        }
    }

        //Activar o Desactivar registros (Departamentos)
        public function Operations($id)
        {
            if(isset($_POST['Desactivar']))
            {
                if($this->modelo->delete($id))
                {
                    header('Location: '.PATH.'Deparments');
                }
            }
    
            if(isset($_POST['Activar']))
            {
                if($this->modelo->reactivate($id))
                {
                    header('Location: '.PATH.'Deparments');
                }
            }
        }


    //Rendirzamos la vista de actualizacion de perfil
    public function Update($id)
    {
        $viewBag = [];
        $viewBag["lugares"]=$this->modelo->get($id);
        $this->render("update.php",$viewBag);
    }

    //Funcion para actualizar los datos generales de un usuario
    public function SetDeparment()
    {
         //Comprobamos el submit del formuario con el nombre del botón
         if(isset($_POST['Actualizar']))
         {
             //Extraemos los datos del POST
             extract($_POST);
             $errores=array();
             $viewBag=array();
             //Procedemos a comprobar las validaciones isEmpty e !isset comprueban que no esté vacío o nulo
             //la validación en el elseif es una validación especial para el campo que utilice
             if(!isset($Nombre)||isEmpty($Nombre))
             {
                 array_push($errores,"Debes ingresar un departamento");
             }
             elseif(!isOnlyText($Nombre))
             {
               array_push($errores,"El campo departamento acepta solo texto");
             }
             // Guardamos las variables en un arreglo llamado usuario
             $departamento['Nombre']=$Nombre;
             $departamento['Id_Departamento']=$Id_Departamento;
             //Comprobamos si el arreglo errores está vacío o no
             if(count($errores)>0)
                 {
 
                     $viewBag['lugares']=$this->modelo->get($Id_Departamento);
                     $viewBag['errores']=$errores;
                     $this->render("update.php",$viewBag);
                 }
                 else
                 {
                     //Si el conteo es menor o igual a cero procedemos a crear un registro
                     if($this->modelo->update($departamento)>0)
                     {
                         header('Location: '.PATH.'Deparments');
                     }
                     else{
                         array_push($errores, "Nos haz realizado ningún cambio 👀");
                         $viewBag['errores']=$errores;
                         $viewBag['lugares']=$this->modelo->get($Id_Departamento);
                         $this->render("update.php",$viewBag);
                     }
                 }
             
            
         }
    }
}
?>