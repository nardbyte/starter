<?php
/********************************************************************************
* buscar.php                                                                    *
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
	$msPage = "buscar"; // Template a mostrar
	$msContinue = true; // Continuar con el script

/*++++++++ = ++++++++*/

	include("../../header.php");	
	
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
	$q = htmlentities($_GET['q']);
	$a = (int) $_GET['a'];
	
/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	
	// BUSCAR POR PALABRA
	if($a == 1){
		$sql = "ms_peliculas.p_titulo like '%{$q}%' and ms_peliculas.p_genero = ms_generos.g_id"; 
	} elseif($a == 2){
	// LA PALABRA COMIENZA CON ....
		$sql = "ms_peliculas.p_titulo like '{$q}%' and ms_peliculas.p_genero = ms_generos.g_id";
			// COMIENZA CON NUMEROS ?
			if($q == "09"){ 
				$sql = "ms_peliculas.p_titulo like '1%' or '2%' or '3%' or '4%' or '5%' or '6%' or '7%' or '8%' or '9%' and ms_peliculas.p_genero = ms_generos.g_id"; 
			}
	// BUSCAR EN CATEGORIAS
	} elseif($a == 3){ 
		$sql = "ms_peliculas.p_genero = ms_generos.g_id and ms_generos.g_seo='{$q}'"; 
	}
	
	// ASIGNAMOS TITULOS SEGUN LO QUE SE BUSCO
	if(!empty($q)){
	   if($a == 1){ $msTitle = "Resultados para {$q}"; }
	   elseif($a == 2){ $msTitle = "Pel&iacute;culas con la letra {$q}"; }
	   elseif($a == 3){ $msTitle = "Pel&iacute;culas de la categor&iacute;a {$q}"; }
	} else { $msTitle = "Buscador"; }
	
	// CONSULTA SQL
	$msMovie = $msClass->view("SELECT * FROM ms_generos,ms_peliculas WHERE {$sql} and ms_peliculas.p_online = '1' ORDER BY p_id DESC",$page,"q={$q}&");
	//
	$smarty->assign("msQ",$q);
	$smarty->assign("msPag",$msPeliculas->linkpage);
	$smarty->assign("msMovie",$msMovie);
	
/**********************************\

* (AGREGAR DATOS GENERADOS | SMARTY) *

\*********************************/
	}
	
	include("../../footer.php");
?>