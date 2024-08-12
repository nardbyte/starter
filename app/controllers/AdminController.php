<?php
// app/controllers/AdminController.php
namespace App\Controllers;

use App\Models\User;

class AdminController extends BaseController {
    protected $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
    }

    public function index() {
        // Verificar si el usuario tiene el rol de Administrador
        $user = $this->userModel->findById($_SESSION['user_id']);

        if ($user['role'] !== 'Administrador') {
            // Redirigir al inicio si no es administrador
            header('Location: ' . $this->smarty->getTemplateVars('base_url'));
            exit;
        }

        // Asignar el título de la página
        $page_title = "Dashboard";
        $this->smarty->assign('title', $page_title);

        // Renderizar la plantilla del dashboard de administración
        $this->render('admin/dashboard.tpl', $page_title);
    }
}
