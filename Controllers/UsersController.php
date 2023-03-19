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
        $this->modelo = new UsersModel();
    }

    public function Index()
    {
        //Creamos un arreglo en donde podremos cargar variables al renderizar las vistas
        $viewBag = [];
        //en la variable empleados pondremos los datos que obtengamos de la consulta get() de UsersModel
        $viewBag['empleados'] = $this->modelo->get();
        $this->render("index.php",$viewBag);
    }

    //Renderizado del formulario de agregar usuarios
    public function Insert()
    {
        $this->render("insert.php");
    }

    //Función para añadir un registro a la tabla usuarios
    public function AddUser()
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
            if(!isset($Id_Usuario)||isEmpty($Id_Usuario))
            {
                array_push($errores,"Debes ingresar un codigo de usuario");
            }elseif(!isUser($Id_Usuario))
            {
                array_push($errores,"El codigo no es válido");
            }
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
            // Guardamos las variables en un arreglo llamado usuario
            $usuario['Id_Usuario']=$Id_Usuario;
            $usuario['Nombre']=$Nombre;
            $usuario['Apellido']=$Apellido;
            $usuario['Correo']=$Correo;
            $usuario['Clave']=hash('sha256',$Clave);
            //Comprobamos si el arreglo errores está vacío o no
            if(count($errores)>0)
                {

                    $viewBag['empleado']=$usuario;
                    $viewBag['errores']=$errores;
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
                        $this->render("insert.php",$viewBag);
                    }
                }
            
           
        }
    }

}
?>