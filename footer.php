<?php
// PREVENIR INCLUSION
if(!defined('MS_HEADER') ) die("Error al cargar archivo directo.");

// Smarty ADD
$smarty->assign("msTitle", $msCore->settings['datos']['w_titulo']." - ".$msTitle);
$smarty->assign("msHits",$msClass->view("SELECT * FROM ms_peliculas WHERE p_online = '1' ORDER BY p_hits DESC LIMIT 30"));
$smarty->assign("msVotos",$msClass->view("SELECT * FROM ms_peliculas WHERE p_online = '1' ORDER BY p_votos DESC LIMIT 30"));
$smarty->assign("msEstrenos",$msClass->view("SELECT * FROM ms_peliculas WHERE p_online = '1' and p_estreno = '1' ORDER BY p_id DESC LIMIT 30"));
$smarty->assign("msEstreno",$msClass->view("SELECT * FROM ms_peliculas WHERE p_online = '1' and p_estreno = '1' ORDER BY p_id DESC LIMIT 30"));
$smarty->assign("msEstren",$msClass->view("SELECT * FROM ms_peliculas WHERE p_online = '1' and p_estreno = '1' ORDER BY p_id  DESC LIMIT 12"));
$smarty->assign("mspelis",$msClass->view("SELECT * FROM ms_peliculas WHERE p_online = '1' ORDER BY p_id  DESC LIMIT 30"));
$smarty->assign("msPeliculas",$msClass->view("SELECT * FROM ms_peliculas WHERE p_online = '1' ORDER BY p_id "));
$smarty->assign("msPelicul",$msClass->view("SELECT * FROM ms_peliculas WHERE p_online = '1' ORDER BY p_id DESC LIMIT 30"));
$smarty->assign("msGeneros",$msClass->view("SELECT * FROM ms_generos ORDER by g_nombre ASC"));
// DISPLAY PAGE
$smarty_next = false;
//
if(!$smarty->template_exists("$msPage.tpl")){
	$smarty->template_dir = MS_ROOT.DIRECTORY_SEPARATOR.'Temas'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.'templates';
	if($smarty->template_exists("$msPage.tpl")) $smarty_next = true;
} else $smarty_next = true;
//
if($smarty_next == true) $smarty->display("$msPage.tpl");
else die("Lo sentimos, se produjo un error al cargar la plantilla. Contacte al administrador");
//
/*function convert($size)
 {
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
 }

echo convert(memory_get_usage(true));*/
?>