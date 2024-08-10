<?php
// inc/routes.php

$routes = [
    '/' => 'HomeController@index',
    '/contact' => 'ContactController@index',
];

function route($path) {
    global $routes;
    if (array_key_exists($path, $routes)) {
        return $routes[$path];
    } else {
        // Ruta no encontrada
        return 'HomeController@notFound';
    }
}
