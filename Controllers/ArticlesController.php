<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Controllers/UsersController.php";
include_once "./Models/ArticlesModel.php";
include_once "./Models/DeparmentsModel.php";
include_once "./Models/PresentationsModel.php";
include_once "./Models/AreasModel.php";
//Incluimos el archivo con las validacions
include_once "./Core/validaciones.php";
class ArticlesController extends Controller{
    public function __construct()
    {
        $this->modelo = new ArticlesModel();
        $this->deparmentsModel = new DeparmentsModel();
        $this->presentationsModel = new PresentationsModel();
        $this->areasModel = new AreasModel();
    }

    public function Index()
    {
        $viewBag = [];
        //en la variable empleados pondremos los datos que obtengamos de la consulta get() de UsersModel
        $viewBag['productos'] = $this->modelo->get();
        $this->render("index.php",$viewBag);
    }

    public function Insert()
    {
        $viewBag = [];
        $viewBag['lugares'] = $this->deparmentsModel->get();
        $viewBag['formas'] = $this->presentationsModel->get();
        $viewBag['zonas'] = $this->areasModel->get();
        $this->render("insert.php",$viewBag);
    }

     public function AddArticle()
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
                array_push($errores,"Debes ingresar un artiuclo");
            }
            elseif(!isOnlyText($Nombre))
            {
              array_push($errores,"El campo articulo acepta solo texto");
            }
            // Guardamos las variables en un arreglo llamado usuario
            $articulo['Id_Articulo']=$this->modelo->getCode();
            $articulo['NombreA']=$Nombre;
            $articulo['Id_Presentacion']=$Id_Presentacion;
            $articulo['Id_Departamento']=$Id_Departamento;
            $articulo['Id_Area']=$Id_Area;
            //Comprobamos si el arreglo errores está vacío o no
            if(count($errores)>0)
                {

                    $viewBag['productos']=$articulo;
                    $viewBag['errores']=$errores;
                    $this->render("insert.php",$viewBag);
                }
                else
                {
                    //Si el conteo es menor o igual a cero procedemos a crear un registro
                    if($this->modelo->create($articulo)>0)
                    {
                        header('Location: '.PATH.'Articles');
                    }
                    else{
                        array_push($errores, "Ha ocurrido un error al ingresar Articulo");
                        $viewBag['errores']=$errores;
                        $viewBag['productos']=$articulo;
                        $this->render("insert.php",$viewBag);
                    }
                }
            
           
        }
    }

    // public function Update($id)
    // {
    //     $viewBag = [];
    //     $viewBag["productos"]=$this->modelo->get($id);
    //     $viewBag['lugares'] = $this->deparmentsModel->get($id);
    //     $viewBag['formas'] = $this->presentationsModel->get($id);
    //     $viewBag['zonas'] = $this->areasModel->get($id);
    //     $this->render("update.php",$viewBag);
    // }
    public function Update($id)
{
    $viewBag = [];
    $viewBag["productos"]=$this->modelo->get($id);
    $viewBag['lugares'] = $this->deparmentsModel->get();
    $viewBag['formas'] = $this->presentationsModel->get($id);
    $viewBag['zonas'] = $this->areasModel->get($id);
    $this->render("update.php",$viewBag);
}


    //Funcion para actualizar los datos generales de un usuario
    public function SetArticle()
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
                 array_push($errores,"Debes ingresar un articulo");
             }
             elseif(!isOnlyText($Nombre))
             {
               array_push($errores,"El campo articulo acepta solo texto");
             }
             // Guardamos las variables en un arreglo llamado usuario
             $articulo['NombreA']=$Nombre;
             $articulo['Id_Articulo']=$Id_Articulo;
             $articulo['Id_Presentacion']=$Id_Presentacion;
             $articulo['Id_Departamento']=$Id_Departamento;
             $articulo['Id_Area']=$Id_Area;
             //Comprobamos si el arreglo errores está vacío o no
             if(count($errores)>0)
                 {
 
                     $viewBag['productos']=$articulo;
                     $viewBag['errores']=$errores;
                     $this->render("update.php",$viewBag);
                 }
                 else
                 {
                     //Si el conteo es menor o igual a cero procedemos a crear un registro
                     if($this->modelo->update($articulo)>0)
                     {
                         header('Location: '.PATH.'Articles');
                     }
                     else{
                         array_push($errores, "Nos haz realizado ningún cambio 👀");
                         $viewBag['errores']=$errores;
                         $viewBag['productos']=$this->modelo->get($Id_Articulo);
                         
                         $this->render("update.php",$viewBag);
                     }
                 }
             
            
         }
    }

    public function Operations($id)
    {
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

}
?>