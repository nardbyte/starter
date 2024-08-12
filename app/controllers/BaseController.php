<?php
// app/controllers/BaseController.php
namespace App\Controllers;

use Smarty\Smarty;
use App\Models\User;

class BaseController {
    protected $smarty;
    protected $start_time;
    protected $userModel; // Cambiar a protected

    public function __construct() {
        require_once '../inc/functions.php';
        $this->start_time = start_timer();
        global $smarty;
        $this->smarty = $smarty;

        $this->smarty->registerPlugin('block', 'precode', 'smarty_block_precode');

        session_start();
        $this->userModel = new User();

        if (isset($_SESSION['user_id'])) {
            $user = $this->userModel->findById($_SESSION['user_id']);
            $this->smarty->assign('is_logged_in', true);
            $this->smarty->assign('username', $user['username']);
            $this->smarty->assign('user_avatar', $user['avatar'] ?? 'default_avatar.png');
        } else {
            $this->smarty->assign('is_logged_in', false);
        }

        if (isset($_SESSION['success'])) {
            $this->smarty->assign('success', $_SESSION['success']);
            unset($_SESSION['success']);
        }

        if (isset($_SESSION['error'])) {
            $this->smarty->assign('error', $_SESSION['error']);
            unset($_SESSION['error']);
        }

        $this->smarty->assign('sitename', SITENAME);
        $this->smarty->assign('description', DESCRIPTION);
        $this->smarty->assign('url', URL);
        $this->smarty->assign('mail', MAIL);
        $this->smarty->assign('version', VERSION);
        $this->smarty->assign('usage', convert(memory_get_usage(true)));
        $this->smarty->assign('current_year', date('Y'));
    }

    protected function render($template, $page_title = null) {
        if ($page_title) {
            $this->smarty->assign('title', $page_title);
        }

        $page_generation_time = end_timer($this->start_time);
        $this->smarty->assign('generation_time', number_format($page_generation_time, 5));
        $this->smarty->display($template);
    }
}
