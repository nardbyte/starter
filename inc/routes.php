<?php
// inc/routes.php

$routes = [
    '/' => 'HomeController@index',
    '/login' => 'LoginController@index',
    '/logout' => 'LoginController@logout',
    '/register' => 'RegisterController@index',
    '/profile' => 'ProfileController@index',
    '/profile/update' => 'ProfileController@update',  // Ruta para actualizar el perfil
    '/settings' => 'SettingsController@index',
    '/settings/updatePassword' => 'SettingsController@updatePassword',  // Ruta para actualizar la contraseña
    '/contact' => 'ContactController@index',
    '/routes' => 'InfoController@index',
    // Agrega otras rutas aquí
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
