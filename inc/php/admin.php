<?php
/********************************************************************************
* admin.php                                                                     *
*********************************************************************************
* MScript: Desarrollado por Marcofbb ®											*
* ==============================================================================*
* Software Version:           MS 1.0 BETA          								*
* Software by:                Marcofbb			     							*
*********************************************************************************/


/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	$msLevel = 4; // Nivel de acceso de esta página
	$msPage = "admin"; // Template a mostrar
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

	$page = htmlentities($_GET['a']);
	$error = "";
	
/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	
	switch($page){
		case "home" :
			$msTitle = "Administración";
		break;
		
		case "config" :
			$msTitle = "Configuraciones";
			if($_POST['enviar']) $msClass->saveConfig();
		break;
		
		case "ads" :
			$msTitle = "Publicidad";
			if($_POST['enviar']) $msClass->saveAds();
		break;
		
		case "padd" :
			$msTitle = "Agregar película";
			if($_POST['enviar']) $error = $msClass->newPost();
		break;
		
		case "links" :
			$msTitle = "Webs amigas";
			$links = $msClass->view("SELECT * FROM ms_links");
			$smarty->assign("msData",$links);
		break;
		
		case "linksadd" :
			$msTitle = "Agregar web amiga";
			if($_POST['enviar']) $error = $msClass->newLink();
		break;
		
		case "linksdel" :
			$msClass->deletLink();
		break;
		
		case "linksedit" :
			$msTitle = "Editar web amiga";
			$w_id = (int) $_GET['wid'];
			if($_POST['enviar']) $error = $msClass->editLink();
			$smarty->assign("msData",$msClass->view("SELECT * FROM ms_links WHERE l_id = '{$w_id}'"));
		break;
                
                case "contacto" :
			$msTitle = "Contactos De Tus Webs";
			$contacto = $msClass->view("SELECT * FROM ms_contacto");
			$smarty->assign("msData",$contacto);
		break;
		
		case "contactosedit" :
			$msTitle = "Editar un contacto";
			$c_id = (int) $_GET['coid'];
			if($_POST['enviar']) $error = $msClass->editContacto();
			$smarty->assign("msData",$msClass->view("SELECT * FROM ms_contacto WHERE id = '{$c_id}'"));
		break;
		case "contactodel" :
			$msClass->deletContacto();
		break;
		
		case "post" :
			$msTitle = "Listado de películas";
			$p = (is_numeric($_GET['page']) ? $_GET['page'] : "1");
			$msMovie = $msClass->view("SELECT * FROM ms_peliculas ORDER BY p_id DESC", $p, "a=post&");
			$smarty->assign("msMovie",$msMovie);
			$smarty->assign("msPag",$msClass->linkpage);
		break;
		
		case "pedit" :
			$msTitle = "Editar pelicula";
			$p_id = (int) $_GET['pid'];
			if($_POST['enviar']) $error = $msClass->editPost();
			$msMovie = $msClass->view("SELECT * FROM ms_generos,ms_peliculas WHERE ms_peliculas.p_genero = ms_generos.g_id and ms_peliculas.p_id = '{$p_id}'");
			$smarty->assign("msMovie",$msMovie);
		break;
		
		case "pdelet" :
			$msClass->deletPost();
		break;
		
		case "plink" :
			$p_id = (int) $_GET['pid'];
			$msTitle = "Enlaces de descargas";
			if($b == "delet"){
				$msdb->query("DELETE FROM ms_descargas WHERE p_id = '{$p_id}'");
				$msCore->redirect($msCore->settings['datos']['w_url']."/admin/?a=plink&pid=".$p_id);
			}
			$msMovie = $msClass->view("SELECT * FROM ms_descargas WHERE p_id='{$p_id}' LIMIT 1");
			if(empty($msMovie)){
				if($_POST['enviar']) $msdb->query("INSERT INTO ms_descargas (p_id) VALUES ('{$p_id}')");
				$msMovie = $msClass->view("SELECT * FROM ms_descargas WHERE p_id='{$p_id}' LIMIT 1");
			} else {
				if($_POST['enviar']) { 
					$error = $msClass->linkPost();
					$msMovie = $msClass->view("SELECT * FROM ms_descargas WHERE p_id='{$p_id}' LIMIT 1");
				}
			}
			$smarty->assign("msMovie",$msMovie);
		break;
		
		case "pvideos" :
			$msTitle = "Videos de la película";
			$p_id = (int) $_GET['pid'];
			$msMovie = $msClass->view("SELECT * FROM ms_videos WHERE p_id = '{$p_id}'");
			$smarty->assign("msMovie",$msMovie);
			$smarty->assign("p_id",$p_id);
		break;
		
		case "vdelet" :
			$v_id = (int) $_GET['vid'];
			$p_id = (int) $_GET['pid'];
			$msdb->query("DELETE FROM ms_videos WHERE v_id = '{$v_id}'");
			$msCore->redirect($msCore->settings['datos']['w_url']."/admin/?a=pvideos&pid=".$p_id);
		break;
		
		case "vadd" :
			$p_id = (int) $_GET['pid'];
			$msTitle = "Agregar reproductor";
			if($_POST['enviar']) $error = $msClass->newVideo();
		break;
		
		case "vedit" :
			$v_id = (int) $_GET['vid'];
			$p_id = (int) $_GET['pid'];
			$msTitle = "Editar reproductor";
			if($_POST['enviar']) $error = $msClass->saveVideo();
			$msMovie = $msClass->view("SELECT * FROM ms_videos WHERE v_id = '{$v_id}'");
			$smarty->assign("msMovie",$msMovie);
		break;
		
		case "reportes" :
			$msTitle = "Películas reportadas";
			$msMovie = $msClass->view("SELECT * FROM ms_peliculas WHERE p_reports = '1' ORDER BY p_id DESC", $p, "a=reportes&");
			$smarty->assign("msMovie",$msMovie);
		break;
		
		default :
			$page = "home";
			$msTitle = "Administración";
	}
	
		$smarty->assign("msAction",$page);
		$smarty->assign("error",$error);

/**********************************\

* (AGREGAR DATOS GENERADOS | SMARTY) *

\*********************************/
	}
	
	include("../../footer.php");
?>