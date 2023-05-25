<?php
include_once "./Core/config.php";
include_once "./Core/routing.php";
include_once "./Controllers/IndexController.php";
include_once "./Controllers/UsersController.php";
include_once "./Controllers/AreasController.php";
include_once "./Controllers/ArticlesController.php";
include_once "./Controllers/DeparmentsController.php";
include_once "./Controllers/StocksController.php";
include_once "./Controllers/PresentationsController.php";
include_once "./Controllers/MovementsController.php";
$router = new Routing();
$controller = $router->controller;
$method = $router->method;
$param = $router->param;
session_start();
$_SESSION['usuario']= "John Doe";
$_SESSION['id_usuario']= "U00005";
$_SESSION['id_session']= sha1("U00005");
$controller = new $controller;
$controller->$method($param);
?>