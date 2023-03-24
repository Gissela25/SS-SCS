<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Controllers/UsersController.php";
include_once "./Models/AreasModel.php";
include_once "./Core/validaciones.php";

class AreasController extends Controller{
    public function __construct()
    {
        $this->modelo = new AreasModel();
    }

    public function Index()
    {
        $viewBag = [];
        $viewBag['zonas'] = $this->modelo->get();
        $this->render("index.php",$viewBag);
    }

    public function Insert()
    {
        $this->render("insert.php");
    }

    //Función para añadir un registro a la tabla usuarios
    public function AddArea()
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
                array_push($errores,"Debes ingresar una Area");
            }
            elseif(!isOnlyText($Nombre))
            {
              array_push($errores,"El campo nombre acepta solo texto");
            }
            // Guardamos las variables en un arreglo llamado usuario
            $area['Id_Area']=$this->modelo->getCode();
            $area['Nombre']=$Nombre;
            //Comprobamos si el arreglo errores está vacío o no
            if(count($errores)>0)
                {

                    $viewBag['zona']=$area;
                    $viewBag['errores']=$errores;
                    $this->render("insert.php",$viewBag);
                }
                else
                {
                    //Si el conteo es menor o igual a cero procedemos a crear un registro
                    if($this->modelo->create($area)>0)
                    {
                        header('Location: '.PATH.'Areas');
                    }
                    else{
                        array_push($errores, "Ha ocurrido un error al ingresar area");
                        $viewBag['errores']=$errores;
                        $viewBag['zona']=$area;
                        $this->render("insert.php",$viewBag);
                    }
                }
            
           
        }
    }

    //Activar o Desactivar registros (usuarios)
    // public function Operations($id)
    // {
    //     if(isset($_POST['Desactivar']))
    //     {
    //         if($this->modelo->delete($id))
    //         {
    //             header('Location: '.PATH.'Users');
    //         }
    //     }

    //     if(isset($_POST['Activar']))
    //     {
    //         if($this->modelo->reactivate($id))
    //         {
    //             header('Location: '.PATH.'Users');
    //         }
    //     }
    // }

    //Rendirzamos la vista de actualizacion de perfil
    public function Update($id)
    {
        $viewBag = [];
        $viewBag["zonas"]=$this->modelo->get($id);
        $this->render("update.php",$viewBag);
    }

    //Funcion para actualizar los datos generales de un usuario
    public function SetArea()
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
                 array_push($errores,"Debes ingresar un area");
             }
             elseif(!isOnlyText($Nombre))
             {
               array_push($errores,"El campo area acepta solo texto");
             }
             // Guardamos las variables en un arreglo llamado usuario
             $area['Nombre']=$Nombre;
             $area['Id_Area']=$Id_Area;
             //Comprobamos si el arreglo errores está vacío o no
             if(count($errores)>0)
                 {
 
                     $viewBag['zonas']=$area;
                     $viewBag['errores']=$errores;
                     $this->render("update.php",$viewBag);
                 }
                 else
                 {
                     //Si el conteo es menor o igual a cero procedemos a crear un registro
                     if($this->modelo->update($area)>0)
                     {
                         header('Location: '.PATH.'Areas');
                     }
                     else{
                         array_push($errores, "Nos haz realizado ningún cambio 👀");
                         $viewBag['errores']=$errores;
                         $viewBag['zonas']=$this->modelo->get($Id_Area);
                         $this->render("update.php",$viewBag);
                     }
                 }
             
            
         }
    }
}
?>