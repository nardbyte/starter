<?php
/********************************************************************************
* home.php                                                                      *
*********************************************************************************
* MScript: Desarrollado por Marcofbb ®											*
* ==============================================================================*
* Software Version:           MS 1.0 BETA          								*
* Software by:                Marcofbb			     							*
*********************************************************************************/


/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	$msLevel = 0; // Nivel de acceso de esta página
	$msPage = "contacto"; // Template a mostrar
	$msContinue = true; // Continuar con el script

/*++++++++ = ++++++++*/

	include("../../header.php");	
	
	$msTitle = $msCore->settings['datos']['w_slogan'];	// Titulo de la pagina
	
/*++++++++ = ++++++++*/

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
	
	
	// hacemos el insert
if($_POST['enviar']) $error = $msClass->newContacto();
 if($result == 1){
                   $error = "Se Ah Enviado Correctamente";
                } else {
                   $error = "Error.....";
                }

	
/**********************************\

* (AGREGAR DATOS GENERADOS | SMARTY) *

\*********************************/
	}
	
	include("../../footer.php");
?>