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
class ArticlesController extends Controller {

    private $modelo;
    private $deparmentsModel;
    private $presentationsModel;
    private $areasModel;

    public function __construct() {
        Auth::checkAuth();
        $this->modelo = new ArticlesModel();
        $this->deparmentsModel = new DeparmentsModel();
        $this->presentationsModel = new PresentationsModel();
        $this->areasModel = new AreasModel();
    }

    public function Index() {
        $viewBag = [];
        //en la variable empleados pondremos los datos que obtengamos de la consulta get() de UsersModel
        $specificArea = $_SESSION['area'];
        $viewBag['productos'] = $this->modelo->getArticlesByArea($specificArea);
        $this->render("index.php", $viewBag);
    }

    public function Insert() {
        $viewBag = [];
        $viewBag['lugares'] = $this->deparmentsModel->getactive();
        $viewBag['formas'] = $this->presentationsModel->getactive();
        $viewBag['zonas'] = $this->areasModel->getactive();
        $this->render("insert.php", $viewBag);
    }

    public function AddArticle() {
        //Comprobamos el submit del formuario con el nombre del botón
        if (isset($_POST['Guardar'])) {
            //Extraemos los datos del POST
            extract($_POST);
            $errores = array();
            $viewBag = array();
            //Procedemos a comprobar las validaciones isEmpty e !isset comprueban que no esté vacío o nulo
            //la validación en el elseif es una validación especial para el campo que utilice
            if (!isset($Nombre) || isEmpty($Nombre)) {
                array_push($errores, "Debes ingresar un artículo");
            } elseif (!isText($Nombre)) {
                array_push($errores, "El campo articulo acepta solo texto");
            }
            if (!isset($Id_Presentacion) || isEmpty($Id_Presentacion)) {
                array_push($errores,  "Debes seleccionar un tipo de presentación.");
            }
            if (!isset($Id_Departamento) || isEmpty($Id_Departamento)) {
                array_push($errores,  "Debes seleccionar un departamento.");
            }

            if (!isset($Codigo) || isEmpty($Codigo)) {
                array_push($errores, "Debes ingresar el codigo del comprobante.");
            } elseif (!isCode($Codigo)) {
                array_push($errores, "El comprobante debe tener entre 8 a 15 caracteres numéricos.");
            }
            // Guardamos las variables en un arreglo llamado usuario

            $code1 = $this->modelo->getCode();
            $code2 = $this->modelo->getCode2();

            $articuloe['Id_Articulo'] = $code1;
            $articuloe['Id_Existencia'] = $code2;
            $articuloe['F_LastUpdate'] = date('Y-m-d');

            $articulo['Id_Articulo'] = $code1;
            $articulo['Codigo'] = $Codigo;
            $articulo['NombreA'] = $Nombre;
            $articulo['Id_Presentacion'] = $Id_Presentacion;
            $articulo['Id_Departamento'] = $Id_Departamento;
            $articulo['Id_Area'] = $_SESSION['area'];
            //$articulo['Id_Existencia']=$code2;
            //Comprobamos si el arreglo errores está vacío o no
            if (count($errores) > 0) {

                $viewBag['productos'] = $articulo;
                $viewBag['lugares'] = $this->deparmentsModel->getactive();
                $viewBag['formas'] = $this->presentationsModel->getactive();
                $viewBag['zonas'] = $this->areasModel->getactive();
                $viewBag['errores'] = $errores;
                $this->render("insert.php", $viewBag);
            } else {
                //Si el conteo es menor o igual a cero procedemos a crear un registro
                if ($this->modelo->create($articulo, $articuloe) > 0) {
                    header('Location: ' . PATH . 'Articles');
                } else {
                    array_push($errores, "Ha ocurrido un error al ingresar Articulo");
                    $viewBag['productos'] = $articulo;
                    $viewBag['lugares'] = $this->deparmentsModel->getactive();
                    $viewBag['formas'] = $this->presentationsModel->getactive();
                    $viewBag['zonas'] = $this->areasModel->getactive();
                    $viewBag['errores'] = $errores;
                    $this->render("insert.php", $viewBag);
                }
            }

        }
    }

    public function Update($id) {
        $viewBag = [];
        $viewBag["productos"] = $this->modelo->get($id);
        $viewBag['lugares'] = $this->deparmentsModel->getactive();
        $viewBag['formas'] = $this->presentationsModel->getactive();
        $viewBag['zonas'] = $this->areasModel->getactive($id);
        $this->render("update.php", $viewBag);
    }

    //Funcion para actualizar los datos generales de un usuario
    public function SetArticle($id) {
        //Comprobamos el submit del formuario con el nombre del botón
        if (isset($_POST['Actualizar'])) {
            //Extraemos los datos del POST
            extract($_POST);
            $errores = array();
            $viewBag = array();
            //Procedemos a comprobar las validaciones isEmpty e !isset comprueban que no esté vacío o nulo
            //la validación en el elseif es una validación especial para el campo que utilice
            if (!isset($Nombre) || isEmpty($Nombre)) {
                array_push($errores, "Debes ingresar un artículo");
            } elseif (!isText($Nombre)) {
                array_push($errores, "El campo articulo acepta solo texto");
            }
            if (!isset($Id_Presentacion) || isEmpty($Id_Presentacion) || $Id_Presentacion == "" ) {
                array_push($errores,  "Debes seleccionar un tipo de presentación.");
            }
            if (!isset($Id_Departamento) || isEmpty($Id_Departamento)) {
                array_push($errores,  "Debes seleccionar un departamento.");
            }

            if (!isset($Codigo) || isEmpty($Codigo)) {
                array_push($errores, "Debes ingresar el codigo del comprobante.");
            } elseif (!isCode($Codigo)) {
                array_push($errores, "El comprobante debe tener entre 8 a 15 caracteres numéricos.");
            }
            // Guardamos las variables en un arreglo llamado usuario
            $articulo['Codigo'] = $Codigo;
            $articulo['NombreA'] = $Nombre;
            $articulo['Id_Articulo'] = $Id_Articulo;
            $articulo['Id_Presentacion'] = $Id_Presentacion;
            $articulo['Id_Departamento'] = $Id_Departamento;
            //Comprobamos si el arreglo errores está vacío o no
            if (count($errores) > 0) {

                $viewBag['productos'] = $this->modelo->get($Id_Articulo);
                $viewBag['lugares'] = $this->deparmentsModel->getactive();
                $viewBag['formas'] = $this->presentationsModel->getactive();
                $viewBag['zonas'] = $this->areasModel->getactive($id);
                $viewBag['errores'] = $errores;
                $this->render("update.php", $viewBag);
            } else {
                //Si el conteo es menor o igual a cero procedemos a crear un registro
                if ($this->modelo->update($articulo) > 0) {
                    header('Location: ' . PATH . 'Articles');
                } else {
                    array_push($errores, "Nos haz realizado ningún cambio 👀");
                    $viewBag['errores'] = $errores;
                    $viewBag["productos"] = $this->modelo->get($id);
                    $viewBag['lugares'] = $this->deparmentsModel->getactive();
                    $viewBag['formas'] = $this->presentationsModel->getactive();
                    $viewBag['zonas'] = $this->areasModel->getactive($id);
                    $this->render("update.php", $viewBag);
                }
            }

        }
    }

    public function Operations($id) {
        if (isset($_POST['Desactivar'])) {
            if ($this->modelo->delete($id)) {
                header('Location: ' . PATH . 'Articles');
            }
        }

        if (isset($_POST['Activar'])) {
            if ($this->modelo->reactivate($id)) {
                header('Location: ' . PATH . 'Articles');
            }
        }
    }

}
?>