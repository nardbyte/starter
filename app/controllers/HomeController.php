<?php
// app/controllers/HomeController.php
namespace App\Controllers;
class HomeController extends BaseController {
    public function index() {
        // Renderizar la vista utilizando la función render de BaseController
        $this->render('layouts/home.tpl', 'Página principal');
    }

    public function notFound() {
        $this->render('layouts/404.tpl', 'Página no encontrada');
    }
}
