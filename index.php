<?php
require 'vendor/autoload.php'; // Cargar las dependencias de Composer

// Cargar la configuración
require 'configs/config.php';

// Inicializa Smarty
$smarty = new Smarty();

// Configurar Smarty
$smarty->setTemplateDir(__DIR__ . '/templates/');
$smarty->setCompileDir(__DIR__ . '/templates/cache/');
$smarty->setConfigDir(__DIR__ . '/configs/');
$smarty->setCacheDir(__DIR__ . '/cache/');

// Asignar variables
$smarty->assign('title', 'Mi Página con Smarty y Bootstrap');

// Cargar plantilla
$smarty->display('index.tpl');
