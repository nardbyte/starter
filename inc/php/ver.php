<?php
/********************************************************************************
* ver.php                                                                       *
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
	$msPage = "ver"; // Template a mostrar
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

	$id = htmlentities($_GET['id']);
	
/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	
	// DATOS DE LA PELICULA
	$msMovie = $msClass->view("SELECT * FROM ms_generos,ms_peliculas WHERE ms_generos.g_id = ms_peliculas.p_genero and ms_peliculas.p_id='{$id}' LIMIT 1");	
	// VIDEOS DE LA PELICULA
	$msVideos = $msClass->view("SELECT * FROM ms_videos,ms_peliculas WHERE ms_videos.p_id = ms_peliculas.p_id and ms_peliculas.p_id='{$id}' and ms_videos.v_online = '1' ORDER BY v_id ASC");
	// LINKS DE DESCARGAS
	$msDown = $msClass->view("SELECT * FROM  ms_descargas,ms_peliculas WHERE  ms_descargas.p_id = ms_peliculas.p_id and ms_peliculas.p_id='{$id}' and  ms_descargas.d_online = '1'");
	// +1 VISITA
	if($msMovie) $msdb->query("UPDATE ms_peliculas SET p_hits=p_hits+1 WHERE p_id='{$id}'");	
	//
	$msTitle = $msMovie[0]['p_titulo'];	
	if(empty($msTitle)) $msTitle = "Error 404";
	$smarty->assign("msMovie",$msMovie);
	$smarty->assign("msVideos",$msVideos);
	$smarty->assign("msDown",$msDown);
	
/**********************************\

* (AGREGAR DATOS GENERADOS | SMARTY) *

\*********************************/
	}
	
	include("../../footer.php");
?>