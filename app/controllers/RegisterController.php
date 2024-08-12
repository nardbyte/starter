<?php
// app/controllers/RegisterController.php
namespace App\Controllers;

use App\Models\User;

class RegisterController extends BaseController {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->register();
        } else {
            $this->render('pages/register.tpl', 'Register');
        }
    }

    private function register() {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($username && $email && $password && $confirm_password && $first_name && $last_name) {
            if ($password !== $confirm_password) {
                $_SESSION['error'] = 'Passwords do not match';
            } elseif ($this->userModel->findByUsername($username)) {
                $_SESSION['error'] = 'Username already exists';
            } elseif ($this->userModel->findByEmail($email)) {
                $_SESSION['error'] = 'Email already exists';
            } else {
                $data = [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'country' => $country,
                    'phone' => $phone
                ];

                if ($this->userModel->register($data)) {
                    $_SESSION['success'] = 'Registration successful! You can now log in.';
                    header('Location: ' . $this->smarty->getTemplateVars('base_url') . 'login');
                    exit;
                } else {
                    $_SESSION['error'] = 'There was an error registering your account';
                }
            }
        } else {
            $_SESSION['error'] = 'Please fill in all required fields';
        }

        $this->render('pages/register.tpl', 'Register');
    }
}
