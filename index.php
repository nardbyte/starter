<?php
require 'vendor/autoload.php';
require 'configs/config.php';

$smarty = new Smarty\Smarty;

$smarty->setTemplateDir(__DIR__ . '/templates/');
$smarty->setCompileDir(__DIR__ . '/templates/cache/');
$smarty->setConfigDir(__DIR__ . '/configs/');
$smarty->setCacheDir(__DIR__ . '/cache/');

// Asignar variables
$smarty->assign('title', 'Mi Página con Smarty y Bootstrap');

// Cargar plantilla
$smarty->display('layouts/index.tpl');
