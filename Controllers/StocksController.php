<?php
include_once "./Controllers/Controller.php";
include_once "./Core/config.php";
include_once "./Controllers/UsersController.php";
include_once "./Models/StocksModel.php";

class StocksController extends Controller {

    private $modelo;

    public function __construct() {
        Auth::checkAuth();
        $this->modelo = new StocksModel();
    }

    public function Index() {
        $viewBag = [];
        $idArea = $_SESSION['area'];
        $viewBag['stock'] = $this->modelo->getArticlesByArea($idArea);
        $this->render("index.php", $viewBag);
    }

    public function Insert($id) {
        $viewBag = [];
        $viewBag['stock'] = $this->modelo->get($id);
        $this->render("insert.php", $viewBag);
    }

    public function Update($id) {
        $viewBag = [];
        $viewBag['stock'] = $this->modelo->get($id);
        $this->render("update.php", $viewBag);
    }

    public function UpdateBalance($id) {
        if (isset($_POST['Actualizar'])) {
            extract($_POST);
            $viewBag = array();
            $errores = array();
            if (!isset($Saldo) || isEmpty($Saldo)) {
                array_push($errores, "El campo Saldo no puede estar vacío. ¡Intenta de nuevo!");
            } elseif (!esInteger($Saldo)) {
                array_push($errores, "Solo puedes ingresar cantidades entereas.");
            }

            if (count($errores) > 0) {
                $viewBag['errores'] = $errores;
                $viewBag['stock'] = $this->modelo->get($id);
                $this->render("update.php", $viewBag);
            } else {
                if ($EsSaldoInicial == "1") {
                    array_push($errores, "No puedes editar si no haz agregado un saldo inicial.");
                    $viewBag['errores'] = $errores;
                    $viewBag['stock'] = $this->modelo->get($id);
                    $this->render("update.php", $viewBag);
                } else {
                    $correctivo = abs($SaldoActual - $Saldo);

                    if ($Saldo != $SaldoActual) {
                        $correlativo = $this->modelo->generateCodeCorrelative();

                        $correlative['Id_Correlativo'] = $correlativo;
                        //Este dato se obtendra de la sesión, por ahora ocuparemos este.
                        $correlative["Id_Usuario"] = $_SESSION['dataBuffer']['Id_Usuario'];
                        $existencia["Id_Existencia"] = $id;
                        $existencia["NoComprobante"] = $NoComprobante;
                        $existencia["Saldo"] = $Saldo;
                        $existencia['F_LastUpdate'] = date('Y-m-d');
                        $movimiento['Id_Correlativo'] = $correlativo;
                        $movimiento['Id_Articulo'] = $Id_Articulo;
                        $movimiento["Id_Existencia"] = $id;
                        $movimiento["Correctivo"] = $correctivo;
                        $movimiento["SaldoResultante"] = $Saldo;
                        $movimiento["F_Movimiento"] = date('Y-m-d');
                        if ($this->modelo->UpdateBalance($existencia, $correlative, $movimiento) > 0) {
                            header('Location: ' . PATH . 'Stocks');
                        } else {
                            array_push($errores, "Ha ocurrido un error al intentar actualizar el saldo");
                            $viewBag['errores'] = $errores;
                            $viewBag['stock'] = $this->modelo->get($id);
                            $this->render("update.php", $viewBag);

                        }
                    } else {
                        array_push($errores, "No haz realizado ningún cambio");
                        $viewBag['errores'] = $errores;
                        $viewBag['stock'] = $this->modelo->get($id);
                        $this->render("update.php", $viewBag);

                    }

                }

            }
        }
    }

    public function AddBalance($id) {
        if (isset($_POST['Guardar'])) {
            extract($_POST);
            $viewBag = array();
            $errores = array();
            if (!isset($NuevoSaldo) || isEmpty($NuevoSaldo)) {
                array_push($errores, "El campo Saldo no puede estar vacío. ¡Intenta de nuevo!");
            } elseif (!esInteger($NuevoSaldo)) {
                array_push($errores, "Solo puedes ingresar cantidades entereas.");
            }

            if (!isset($NoComprobante) || isEmpty($NoComprobante)) {
                array_push($errores, "Ingresa tu comprobante.");
            } elseif (!isCode($NoComprobante)) {
                array_push($errores, "El comprobante debe tener entre 8 a 15 caracteres numéricos.");
            }

            if (count($errores) > 0) {
                $viewBag['errores'] = $errores;
                $viewBag['stock'] = $this->modelo->get($id);
                $this->render("insert.php", $viewBag);
            } else {
                if ($EsSaldoInicial == "1") {
                    $correlativo = $this->modelo->generateCodeCorrelative();
                    $correlative['Id_Correlativo'] = $correlativo;
                    //Este dato se obtendra de la sesión, por ahora ocuparemos este.
                    $correlative["Id_Usuario"] = $_SESSION['dataBuffer']['Id_Usuario'];
                    $existencia["Id_Existencia"] = $id;
                    $existencia["NoComprobante"] = $NoComprobante;
                    $existencia["Saldo"] = $NuevoSaldo;
                    $existencia["SaldoInicial"] = $NuevoSaldo;
                    $existencia['F_LastUpdate'] = date('Y-m-d');
                    $existencia["EsSaldoInicial"] = 0;
                    $movimiento['Id_Correlativo'] = $correlativo;
                    $movimiento['Id_Articulo'] = $Id_Articulo;
                    $movimiento["Id_Existencia"] = $id;
                    $movimiento["Entrada"] = $NuevoSaldo;
                    $movimiento["SaldoResultante"] = $NuevoSaldo;
                    $movimiento["F_Movimiento"] = date('Y-m-d');
                    if ($this->modelo->AddBeginningBalance($existencia, $correlative, $movimiento) > 0) {
                        header('Location: ' . PATH . 'Stocks');
                    } else {
                        array_push($errores, "Ha ocurrido un error al intentar actualizar el saldo");
                        $viewBag['errores'] = $errores;
                        $viewBag['stock'] = $this->modelo->get($id);
                        $this->render("insert.php", $viewBag);

                    }
                } else {
                    $saldoAcumulado = $NuevoSaldo + $Saldo;
                    $correlativo = $this->modelo->generateCodeCorrelative();
                    $correlative['Id_Correlativo'] = $correlativo;
                    //Este dato se obtendra de la sesión, por ahora ocuparemos este.
                    $correlative["Id_Usuario"] = $_SESSION['dataBuffer']['Id_Usuario'];
                    $existencia["Id_Existencia"] = $id;
                    $existencia["NoComprobante"] = $NoComprobante;
                    $existencia["Saldo"] = $saldoAcumulado;
                    $existencia['F_LastUpdate'] = date('Y-m-d');
                    $movimiento['Id_Correlativo'] = $correlativo;
                    $movimiento['Id_Articulo'] = $Id_Articulo;
                    $movimiento["Id_Existencia"] = $id;
                    $movimiento["Entrada"] = $NuevoSaldo;
                    $movimiento["SaldoResultante"] = $saldoAcumulado;
                    $movimiento["F_Movimiento"] = date('Y-m-d');

                    if ($this->modelo->AddBalance($existencia, $correlative, $movimiento) > 0) {
                        header('Location: ' . PATH . 'Stocks');
                    } else {
                        array_push($errores, "Ha ocurrido un error al intentar registrarse");
                        $viewBag['errores'] = $errores;
                        $viewBag['stock'] = $this->modelo->get($id);
                        $this->render("insert.php", $viewBag);

                    }
                }
            }
        }
    }
}
?>