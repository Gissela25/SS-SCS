<?php
include_once "./Core/config.php";
include_once "./Core/routing.php";
include_once "./Controllers/IndexController.php";
$router = new Routing();
$controller = $router->controller;
$method = $router->method;
$param = $router->param;

$controller = new $controller;
$controller->$method($param);
?>