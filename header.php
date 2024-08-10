<?php
//-> PREVENIR INCLUSION
if( defined('MS_HEADER') ) return;

//-> CREAMOS UNA SESSION
if(!isset($_SESSION)) session_start();

//-> REPORTER DE ERRORES
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
ini_set('display_errors', TRUE);

//-> LIMITE DE EJECUCION
set_time_limit(300);

//-> DEFINIR VARIABLES CONSTANTES
define(MS_ROOT, realpath(dirname(__FILE__)));
define(MS_HEADER, TRUE);
define(MS_CLASS, MS_ROOT.'/inc/class/');
define(MS_EXTRA, MS_ROOT.'/inc/ext/');
define(MS_FILES, MS_ROOT.'/files/');

//-> ARMAR RUTA PADRE
set_include_path(get_include_path() . PATH_SEPARATOR . realpath("./"));

//-> INCLUMIOS CONFIGURACIONES/CLASES
include("config.php"); 				// CONEXION A LA BASE DE DATOS
include(MS_CLASS."c.db.php"); 		// CLASS PARA CONSULTA A LA BD
include(MS_CLASS."c.core.php");	 	// NUCLEO DEL SCRIPT
include(MS_CLASS."c.usuarios.php"); 	// CLASS PARA CONTROL DE USUARIOS
include(MS_CLASS."c.smarty.php");		// SMARTY

//-> CREAMOS INSTANCIAS
$msdb =& msMySQL::getInstance();
$msCore	=& msCore::getInstance();

//-> DEFINIMOS EL TEMA A UTILIZAR
$msTema = $msCore->settings['tema'];
if(empty($msTema)) $msTema = 'default';
define(MS_TEMA, $msTema);

//-> CREAMOS INSTANCIAS
$msUser	=& msUsuarios::getInstance();
$smarty	=& msSmarty::getInstance();

//-> SMARTY ADD
$smarty->assign("msConfig",$msCore->settings);
$smarty->assign("msUser",$msUser);

//-> COMPROBAMOS SI ESTA ONLINE PARTE 1
if($msCore->settings['datos']['w_offline'] == 1 && $msUser->is_admod != 1 && $_SERVER["REQUEST_URI"] != "/login/") {
	$msPage = "aviso";
	$msContinue = false;
	$smarty->assign("msTitle", $msCore->settings['datos']['w_titulo']." - Mantenimiento");
	$smarty->assign("msAviso", $msCore->settings['datos']['w_txtoff']); 
}
	include(MS_CLASS."c.class.php");
	$msClass = new msClass();
?>