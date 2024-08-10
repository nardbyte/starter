<?php
require 'vendor/autoload.php';
require 'inc/functions.php';
require 'inc/config.php';

$start_time = start_timer();
$smarty = new Smarty\Smarty;

$smarty->setTemplateDir(__DIR__ . '/templates/');
$smarty->setCompileDir(__DIR__ . '/templates/cache/');
$smarty->setConfigDir(__DIR__ . '/configs/');
$smarty->setCacheDir(__DIR__ . '/cache/');

// Asignar las constantes a variables de Smarty
$smarty->assign('sitename', SITENAME);
$smarty->assign('description', DESCRIPTION);
$smarty->assign('url', URL);
$smarty->assign('mail', MAIL);
$smarty->assign('version', VERSION);
$smarty->assign('usage', convert(memory_get_usage(true)));
$smarty->assign('current_year', date('Y'));

// Calcular el tiempo de generación de la página
$page_generation_time = end_timer($start_time);
$smarty->assign('generation_time', number_format($page_generation_time, 5));

// Cargar la plantilla principal
$smarty->display('index.tpl');
