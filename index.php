<?php
require 'inc/functions.php';
$start_time = start_timer();
require 'vendor/autoload.php';
require 'inc/config.php';
require 'inc/init_smarty.php';

// Assign constants variables of Smarty
$smarty->assign('sitename', SITENAME);
$smarty->assign('description', DESCRIPTION);
$smarty->assign('url', URL);
$smarty->assign('mail', MAIL);
$smarty->assign('version', VERSION);
$smarty->assign('usage', convert(memory_get_usage(true)));
$smarty->assign('current_year', date('Y'));
$page_title = "Página principal - " . SITENAME;
$smarty->assign('title', $page_title);

$page_generation_time = end_timer($start_time);
$smarty->assign('generation_time', number_format($page_generation_time, 5));

// Load template
$smarty->display('index.tpl');
