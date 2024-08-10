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
	$msPage = "pages"; // Template a mostrar
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

	$page = htmlentities($_GET['id']);
	
/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	
	switch($page){
		case "aviso-legal" :
			$msTitle = "Aviso Legal";
		break;

          case "estrenos" :
         $msTitle = "Estrenos";
      break;
           case "votadas" :
         $msTitle = "Votadas";
      break;
      case "peliculas" :
         $msTitle = "Peliculas";
      break;
      case "lista" :
         $msTitle = "Lista";
      break;
      case "masvista" :
         $msTitle = "Mas Vista";
      break;
      case "sinopsis" :
         $msTitle = "Sinopsis";
      break;
		
		default :
		$page = "";	
		$msTitle = "Error 404";
	}
	
		$smarty->assign("msPag",$page);

/**********************************\

* (AGREGAR DATOS GENERADOS | SMARTY) *

\*********************************/
	}
	
	include("../../footer.php");
?>