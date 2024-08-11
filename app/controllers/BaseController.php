<?php
// app/controllers/BaseController.php
namespace App\Controllers;

class BaseController {
    protected $smarty;
    protected $start_time;

    public function __construct() {
        // Iniciar temporizador
        require_once '../inc/functions.php';
        $this->start_time = start_timer();

        // Inicializar Smarty
        global $smarty;
        $this->smarty = $smarty;

        // Registrar el plugin
        $this->smarty->registerPlugin('block', 'precode', 'smarty_block_precode');

        // Asignar variables comunes a Smarty
        $this->smarty->assign('sitename', SITENAME);
        $this->smarty->assign('description', DESCRIPTION);
        $this->smarty->assign('url', URL);
        $this->smarty->assign('mail', MAIL);
        $this->smarty->assign('version', VERSION);
        $this->smarty->assign('usage', convert(memory_get_usage(true)));
        $this->smarty->assign('current_year', date('Y'));
    }

    protected function render($template, $page_title = null) {
        // Asignar el título de la página
        if ($page_title) {
            $this->smarty->assign('title', $page_title . ' - ' . SITENAME);
        }

        // Calcular tiempo de generación de la página
        $page_generation_time = end_timer($this->start_time);
        $this->smarty->assign('generation_time', number_format($page_generation_time, 5));

        // Cargar la plantilla
        $this->smarty->display($template);
    }
}
