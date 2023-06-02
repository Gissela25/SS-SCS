<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Models/UsersModel.php";
//Incluimos el archivo con las validacions
include_once "./Core/validaciones.php";
class UsersController extends Controller{
    private $modelo;
    public function __construct()
    {
        //Creamos una instania del modelo UsersModel
        Auth::checkAuth();
        $this->modelo = new UsersModel();
    }

    public function Index()
    {
        Auth::checkUser();
        //Creamos un arreglo en donde podremos cargar variables al renderizar las vistas
        $viewBag = [];
        //en la variable empleados pondremos los datos que obtengamos de la consulta get() de UsersModel
        $viewBag['empleados'] = $this->modelo->get();
        //Obtenemos el numero de inactivos
        $viewBag['inactivos'] = count($this->modelo->getInactive());
        $this->render("index.php",$viewBag);
    }

    //Renderizado del formulario de agregar usuarios
    public function Insert()
    {
        Auth::checkUser();
        $viewBag = [];
        $viewBag['areas']=$this->modelo->getArea();
        $this->render("insert.php",$viewBag);
    }

    //Función para añadir un registro a la tabla usuarios
    public function AddUser()
    {
        Auth::checkUser();
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
                array_push($errores,"Debes ingresar un nombre");
            }
            elseif(!isOnlyText($Nombre))
            {
              array_push($errores,"El campo nombre acepta solo texto");
            }
            if(!isset($Apellido)||isEmpty($Apellido))
            {
                array_push($errores,"Debes ingresar un apellido");
            }
            elseif(!isOnlyText($Apellido))
            {
              array_push($errores,"El campo apellido acepta solo texto");
            }
            if(!isset($Clave)||isEmpty($Clave))
            {
                array_push($errores,"Debes ingresar una clave");
            }
            elseif(!isPassword($Clave))
            {
                array_push($errores,"Clave invalida");
            }
            if(!isset($Correo)||isEmpty($Correo))
            {
                array_push($errores,"Debes ingresar tu correo");
            }
            elseif(!esMail($Correo))
            {
              array_push($errores,"Correo no válido");
            }

            if (!isset($Id_Area) || isEmpty($Id_Area)) {
                array_push($errores,  "Debes seleccionar el area temporal del usuario.");
            }
            // Guardamos las variables en un arreglo llamado usuario
            $usuario['Id_Usuario']=$this->modelo->getCodeUser($Nombre,$Apellido);
            $usuario['Nombre']=$Nombre;
            $usuario['Apellido']=$Apellido;
            $usuario['Correo']=$Correo;
            $usuario['Clave']=hash('sha256',$Clave);
            $usuario['Id_Area']=$Id_Area;
            //Comprobamos si el arreglo errores está vacío o no
            if(count($errores)>0)
                {

                    $viewBag['empleado']=$usuario;
                    $viewBag['errores']=$errores;
                    $viewBag['areas']=$this->modelo->getArea();
                    $this->render("insert.php",$viewBag);
                }
                else
                {
                    //Si el conteo es menor o igual a cero procedemos a crear un registro
                    if($this->modelo->create($usuario)>0)
                    {
                        header('Location: '.PATH.'Users');
                    }
                    else{
                        array_push($errores, "Ha ocurrido un error al intentar registrarse");
                        $viewBag['errores']=$errores;
                        $viewBag['empleado']=$usuario;
                        $viewBag['areas']=$this->modelo->getArea();
                        $this->render("insert.php",$viewBag);
                    }
                }
            
           
        }
    }

    //Activar o Desactivar registros (usuarios)
    public function Operations($id)
    {
        Auth::checkUser();
        if(isset($_POST['Desactivar']))
        {
            if($this->modelo->delete($id))
            {
                header('Location: '.PATH.'Users');
            }
        }

        if(isset($_POST['Activar']))
        {
            if($this->modelo->reactivate($id))
            {
                header('Location: '.PATH.'Users');
            }
        }
    }

    public function UpdatePassword()
    {
        $viewBag["empleados"]=$this->modelo->get($_SESSION['dataBuffer']['Id_Usuario']);
        $this->render("updatePwd.php",$viewBag);
    }

    public function SetPassword()
    {
        if(isset($_POST['Actualizar']))
         {
             //Extraemos los datos del POST
             extract($_POST);
             $errores=array();
             $viewBag=array();
             if(!isset($Clave)||isEmpty($Clave))
             {
                 array_push($errores,"Debes ingresar tu contraseña");
             }
             if(!isset($NuevaClave)||isEmpty($NuevaClave))
             {
                 array_push($errores,"Debes ingresar la nueva contraseña");
             }
             elseif(!isPassword($NuevaClave))
             {
               array_push($errores,"Correo no válido");
             }
             $Id_Usuario = $_SESSION['dataBuffer']['Id_Usuario'];
             $usuario['Id_Usuario']=$Id_Usuario;
             $usuario['Clave']=hash('sha256',$NuevaClave);
             //Comprobamos si el arreglo errores está vacío o no
             if(count($errores)>0)
                 {
 
                     $viewBag['empleados']=$this->modelo->get($Id_Usuario);
                     $viewBag['errores']=$errores;
                     $this->render("updatePwd.php",$viewBag);
                 }
                 else
                 {
                    if(hash('sha256',$Clave) == $CurrentPassword)
                    {
                        if($this->modelo->setPassword($usuario))
                        {
                            header('Location: '.PATH.'Articles');
                        }
                        else{
                            array_push($errores,"Algo salió mal al intentar guardar la contraseña.");
                            $viewBag['errores']=$errores;
                            $viewBag["empleados"]=$this->modelo->get($_SESSION['dataBuffer']['Id_Usuario']);
                            $this->render("updatePwd.php",$viewBag);
                        }
                    }
                    else{
                        array_push($errores,"La contraseña actual ingresada es incorrecta.");
                        $viewBag['errores']=$errores;
                        $viewBag["empleados"]=$this->modelo->get($_SESSION['dataBuffer']['Id_Usuario']);
                        $this->render("updatePwd.php",$viewBag);
                 }
                    }
                     
                 }
             
            
    }

    //Rendirzamos la vista de actualizacion de perfil
    public function Update($id)
    {
        $viewBag = [];
        if($_SESSION['dataBuffer']['Id_Usuario'] == $id || ($_SESSION['dataBuffer']['Tipo_Usuario']==0))
        {
            $viewBag['areas']=$this->modelo->getArea();
            $viewBag["empleados"]=$this->modelo->get($id);
            $this->render("update.php",$viewBag);
        }
        else{
            header('Location: '.PATH.'Articles');
        }

    }

    //Funcion para actualizar los datos generales de un usuario
    public function SetUser()
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
                 array_push($errores,"Debes ingresar un nombre");
             }
             elseif(!isOnlyText($Nombre))
             {
               array_push($errores,"El campo nombre acepta solo texto");
             }
             if(!isset($Apellido)||isEmpty($Apellido))
             {
                 array_push($errores,"Debes ingresar un apellido");
             }
             elseif(!isOnlyText($Apellido))
             {
               array_push($errores,"El campo apellido acepta solo texto");
             }
             if(!isset($Correo)||isEmpty($Correo))
             {
                 array_push($errores,"Debes ingresar tu correo");
             }
             elseif(!esMail($Correo))
             {
               array_push($errores,"Correo no válido");
             }

             if (!isset($Id_Area) || isEmpty($Id_Area)) {
                array_push($errores,  "Debes seleccionar el area temporal del usuario.");
            }
             // Guardamos las variables en un arreglo llamado usuario
             $usuario['Nombre']=$Nombre;
             $usuario['Apellido']=$Apellido;
             $usuario['Correo']=$Correo;
             $usuario['Id_Area']=$Id_Area;
             $usuario['Id_Usuario']=$Id_Usuario;
             //Comprobamos si el arreglo errores está vacío o no
             if(count($errores)>0)
                 {
 
                     $viewBag['empleados']=$this->modelo->get($Id_Usuario);
                     $viewBag['errores']=$errores;
                     $viewBag['areas']=$this->modelo->getArea();
                     $this->render("update.php",$viewBag);
                 }
                 else
                 {
                     //Si el conteo es menor o igual a cero procedemos a crear un registro
                     if($this->modelo->update($usuario)>0)
                     {
                         header('Location: '.PATH.'Users');
                     }
                     else{
                         array_push($errores, "No haz realizado ningún cambio 👀");
                         $viewBag['errores']=$errores;
                         $viewBag['areas']=$this->modelo->getArea();
                         $viewBag['empleados']=$this->modelo->get($Id_Usuario);
                         $this->render("update.php",$viewBag);
                     }
                 }
             
            
         }
    }

}
?>