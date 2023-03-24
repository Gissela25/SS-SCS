<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Controllers/UsersController.php";
include_once "./Models/PresentationsModel.php";
include_once "./Core/validaciones.php";

class PresentationsController extends Controller{
    public function __construct()
    {
        $this->modelo = new PresentationsModel();
    }

    public function Index()
    {
        $viewBag = [];
        $viewBag['formas'] = $this->modelo->get();
        $this->render("index.php",$viewBag);
    }

    public function Insert()
    {
        $this->render("insert.php");
    }

    //Función para añadir un registro a la tabla usuarios
    public function AddPresentation()
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
                array_push($errores,"Debes ingresar una Presentación");
            }
            elseif(!isOnlyText($Nombre))
            {
              array_push($errores,"El campo presentación acepta solo texto");
            }
            // Guardamos las variables en un arreglo llamado usuario
            $presentacion['Id_Presentacion']=$this->modelo->getCode();
            $presentacion['NombreP']=$Nombre;
            //Comprobamos si el arreglo errores está vacío o no
            if(count($errores)>0)
                {

                    $viewBag['formas']=$presentacion;
                    $viewBag['errores']=$errores;
                    $this->render("insert.php",$viewBag);
                }
                else
                {
                    //Si el conteo es menor o igual a cero procedemos a crear un registro
                    if($this->modelo->create($presentacion)>0)
                    {
                        header('Location: '.PATH.'Presentations');
                    }
                    else{
                        array_push($errores, "Ha ocurrido un error al ingresar departamento");
                        $viewBag['errores']=$errores;
                        $viewBag['formas']=$presentacion;
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
        $viewBag["formas"]=$this->modelo->get($id);
        $this->render("update.php",$viewBag);
    }

    //Funcion para actualizar los datos generales de un usuario
    public function SetPresentation()
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
                 array_push($errores,"Debes ingresar una Presentación");
             }
             elseif(!isOnlyText($Nombre))
             {
               array_push($errores,"El campo presentación acepta solo texto");
             }
             // Guardamos las variables en un arreglo llamado usuario
             $presentacion['Nombre']=$Nombre;
             $presentacion['Id_Presentacion']=$Id_Presentacion;
             //Comprobamos si el arreglo errores está vacío o no
             if(count($errores)>0)
                 {
 
                     $viewBag['formas']=$presentacion;
                     $viewBag['errores']=$errores;
                     $this->render("update.php",$viewBag);
                 }
                 else
                 {
                     //Si el conteo es menor o igual a cero procedemos a crear un registro
                     if($this->modelo->update($presentacion)>0)
                     {
                         header('Location: '.PATH.'Presentations');
                     }
                     else{
                         array_push($errores, "Nos haz realizado ningún cambio 👀");
                         $viewBag['errores']=$errores;
                         $viewBag['formas']=$this->modelo->get($Id_Presentacion);
                         $this->render("update.php",$viewBag);
                     }
                 }
             
            
         }
    }
}
?>