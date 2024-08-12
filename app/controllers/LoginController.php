<?php
// app/controllers/LoginController.php
namespace App\Controllers;

use App\Models\User;

class LoginController extends BaseController {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User(); // No es necesario pasar PDO, se usa la global
    }

    public function index() {
        // Verificar si el usuario ya está autenticado
        if (isset($_SESSION['user_id'])) {

            header('Location: /');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->login();
        } else {
            $this->render('pages/login.tpl', 'Login');
        }
    }

    private function login() {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($username && $password) {
            $user = $this->userModel->findByUsername($username);

            if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
                // Iniciar sesión
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_avatar'] = $user['avatar'];

                // Redirigir al inicio o al dashboard
                header('Location: ' . $this->smarty->getTemplateVars('base_url'));
                exit;
            } else {
                $this->smarty->assign('error', 'Invalid username or password');
            }
        } else {
            $this->smarty->assign('error', 'Please fill in all fields');
        }

        $this->render('pages/login.tpl', 'Login');
    }

    public function logout() {
        session_destroy();
        header('Location: ' . $this->smarty->getTemplateVars('base_url') . 'login');
        exit;
    }
}
