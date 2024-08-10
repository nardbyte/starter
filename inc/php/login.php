<?php
/********************************************************************************
* login.php                                                                     *
*********************************************************************************
* MScript: Desarrollado por Marcofbb ®											*
* ==============================================================================*
* Software Version:           MS 1.0 BETA          								*
* Software by:                Marcofbb			     							*
*********************************************************************************/


/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	$msLevel = 1; // Nivel de acceso de esta página
	$msPage = "login"; // Template a mostrar
	$msContinue = true; // Continuar con el script

/*++++++++ = ++++++++*/

	include("../../header.php");	
	
	$msTitle = "Iniciar Sesión";	// Titulo de la pagina
	
/*++++++++ = ++++++++*/
	// CERRAMOS SESSION
	if($msContinue){
		$a = htmlentities($_GET['a']);
		if($a == "logout") $msUser->logoutUser();	
	}
	// VERIFICAMOS NIVEL DE ACCESO
	$msLevelMsg = $msCore->setLevel($msLevel, true);
	if($msLevelMsg != 1){	
		$msPage = 'aviso';
		$msTitle = $msLevelMsg['titulo'];
		$smarty->assign("msAviso",$msLevelMsg['mensaje']);
		//
		$msContinue = false;
	}
	//
	if($msContinue){
/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/

	$error = "";
	
/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	if($_POST['enviar']) $error = $msUser->loginUser(true,$a);
	$smarty->assign("error",$error);
	
/**********************************\

* (AGREGAR DATOS GENERADOS | SMARTY) *

\*********************************/
	}
	
	include("../../footer.php");
?>