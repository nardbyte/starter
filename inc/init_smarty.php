<?php
// inc/init_smarty.php
$smarty = new Smarty\Smarty;
$smarty->setTemplateDir(__DIR__ . '/../templates/');
$smarty->setCompileDir(__DIR__ . '/../templates/cache/');
$smarty->setConfigDir(__DIR__ . '/../configs/');
$smarty->setCacheDir(__DIR__ . '/../cache/');
