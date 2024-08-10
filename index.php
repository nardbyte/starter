<?php
require 'vendor/autoload.php';
require 'inc/config.php';

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

// Cargar la plantilla principal
$smarty->display('index.tpl');
