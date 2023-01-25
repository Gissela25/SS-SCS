<?php
include_once "./Core/config.php";
include_once "./Core/routing.php";
include_once "./Controllers/IndexController.php";
include_once "./Controllers/UsersController.php";
include_once "./Controllers/AreasController.php";
include_once "./Controllers/ArticlesController.php";
include_once "./Controllers/DeparmentsController.php";
$router = new Routing();
$controller = $router->controller;
$method = $router->method;
$param = $router->param;

$controller = new $controller;
$controller->$method($param);
?>