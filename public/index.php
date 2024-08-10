<?php
require '../vendor/autoload.php'; // Autoload generado por Composer
require '../inc/config.php';
require '../inc/routes.php';
require '../inc/init_smarty.php';

// Obtener la ruta solicitada
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Encontrar la ruta en el array de rutas
$route = route($path);

// Separar el controlador y la acción
list($controller, $action) = explode('@', $route);

// Agregar el namespace completo al controlador
$controller = "App\\Controllers\\" . $controller;

// Instanciar el controlador y llamar a la acción
$controllerInstance = new $controller();
$controllerInstance->$action();
