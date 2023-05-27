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
include_once "./Middleware/Auth.php";
$router = new Routing();
$controller = $router->controller;
$method = $router->method;
$param = $router->param;
session_start();
$controller = new $controller;
$controller->$method($param);
?>