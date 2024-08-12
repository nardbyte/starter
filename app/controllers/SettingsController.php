<?php
// app/controllers/SettingsController.php
namespace App\Controllers;

use App\Models\User;

class SettingsController extends BaseController {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . $this->smarty->getTemplateVars('base_url') . 'login');
            exit;
        }

        $user = $this->userModel->findById($_SESSION['user_id']);
        $this->smarty->assign('user', $user);
        $this->render('pages/user/settings.tpl', 'Settings');
    }

    public function updatePassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $current_password = filter_input(INPUT_POST, 'current_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $new_password = filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $user = $this->userModel->findById($_SESSION['user_id']);

            if (!$this->userModel->verifyPassword($current_password, $user['password'])) {
                $_SESSION['error'] = 'Current password is incorrect';
            } elseif ($new_password !== $confirm_password) {
                $_SESSION['error'] = 'New passwords do not match';
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                if ($this->userModel->updatePassword($_SESSION['user_id'], $hashed_password)) {
                    $_SESSION['success'] = 'Password updated successfully';
                } else {
                    $_SESSION['error'] = 'There was an error updating your password';
                }
            }

            header('Location: ' . $this->smarty->getTemplateVars('base_url'));
            exit;
        }
    }
}
