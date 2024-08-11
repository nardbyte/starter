<?php
// app/controllers/InfoController.php
namespace App\Controllers;

class InfoController extends BaseController {
    public function index() {
        // Asignar el título de la página
        $page_title = "Explicación de las Rutas y Carpetas";
        $this->smarty->assign('title', $page_title);
        // Renderizar la plantilla
        $this->render('pages/routes.tpl', $page_title);
    }
}
