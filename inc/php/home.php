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
	$msPage = "home"; // Template a mostrar
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

	$page = (is_numeric($_GET['page']) ? $_GET['page'] : "1");
	
/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	
	// LISTAR PELICULAS
	$msMovie = $msClass->view("SELECT * FROM ms_generos,ms_peliculas WHERE ms_peliculas.p_genero = ms_generos.g_id and ms_peliculas.p_online = '1' ORDER BY ms_peliculas.p_id DESC",$page);
	//
	$smarty->assign("msMovie",$msMovie);
	$smarty->assign("msPag",$msClass->linkpage);
	
/**********************************\

* (AGREGAR DATOS GENERADOS | SMARTY) *

\*********************************/
	}
	
	include("../../footer.php");
?>