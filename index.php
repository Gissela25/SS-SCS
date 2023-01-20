<?php
include_once "./Core/config.php";
include_once "./Core/routing.php";
include_once "./Controllers/IndexController.php";
include_once "../SS-SCS/Controllers/UsersController.php";
$router = new Routing();
$controller = $router->controller;
$method = $router->method;
$param = $router->param;

$controller = new $controller;
$controller->$method($param);
?>