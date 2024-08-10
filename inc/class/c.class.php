<?php
/********************************************************************************
* c.class.php                                                                   *
*********************************************************************************
* MScript: Desarrollado por Marcofbb ®											*
* ==============================================================================*
* Software Version:           MS 1.0 BETA          								*
* Software by:                Marcofbb			     							*
*********************************************************************************/


/*

	CLASE CON LOS ATRIBUTOS Y METODOS PARA LOS POSTS
	
*/
class msClass extends msMySQL{
	//
	var $linkpage;
	// INSTANCIA DE LA CLASE
	function &getInstance(){
		static $instance;
		
		if( is_null($instance) ){
			$instance = new msClass();
    	}
		return $instance;
	}
	
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*\
								LISTADOS
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*
		view()
	*/
	function view($sql, $p = false, $ext = NULL){
		//
		$query = $this->query($sql);
		if($p){
			$ptot = $this->num_rows($query);
			$p = $this->getPagination($p,28,$ptot,$ext);
			$sql.= " LIMIT {$p}";
			$query = $this->query($sql);
		}
		while($row = mysql_fetch_assoc($query)){
			$data[] = $row;
		}
		return $data;
	}
	/*
		newVideo()
	*/
	function newVideo(){
		$p_id = (int) $_GET['pid'];
		//
		$postData = array(
			'titulo' => mysql_real_escape_string($_POST['titulo']),
			'source' => $_POST['source'],
		);
		// VACIOS
		foreach($postData as $key => $val){
            $val = trim(preg_replace("/[^ A-Za-z0-9]/", "", $val));
            $val = str_replace(' ', '', $val);
			if(empty($val)) return "Falta completar algun dato.";
		}
		//
		$postData['online'] = (empty($_POST['online']) ? 0 : 1);
		$this->query("INSERT INTO ms_videos (p_id, v_source, v_titulo, v_online) VALUES ('{$p_id}','{$postData['source']}','{$postData['titulo']}','{$postData['online']}')");
		
		return "Reproductor agregado correctamente.";
		
	}
	/*
		saveVideo()
	*/
	function saveVideo(){
		$p_id = (int) $_GET['pid'];
		$v_id = (int) $_GET['vid'];
		//
		$postData = array(
			'titulo' => mysql_real_escape_string($_POST['titulo']),
			'source' => $_POST['source'],
		);
		// VACIOS
		foreach($postData as $key => $val){
            $val = trim(preg_replace("/[^ A-Za-z0-9]/", "", $val));
            $val = str_replace(' ', '', $val);
			if(empty($val)) return "Falta completar algun dato.";
		}
		//
		$postData['online'] = (empty($_POST['online']) ? 0 : 1);
		$this->query("UPDATE ms_videos SET v_source='{$postData['source']}', v_titulo='{$postData['titulo']}', v_online='{$postData['online']}' WHERE v_id = '{$v_id}'");
		
		return "Reproductor editado correctamente.";
		
	}
	/*
		newPost()
	*/
	function newPost(){
		//
		$postData = array(
			'titulo' => mysql_real_escape_string($_POST['titulo']),
			'seo' => $this->setSeo($_POST['titulo']),
			'anio' => (int) $_POST['anio'],
			'idioma' => mysql_real_escape_string($_POST['idioma']),
			'calidad' => mysql_real_escape_string($_POST['calidad']),
			'genero' => (int) $_POST['genero'],
			'sinopsis' => mysql_real_escape_string($_POST['sinopsis']),
		);
		// VACIOS
		foreach($postData as $key => $val){
            $val = trim(preg_replace("/[^ A-Za-z0-9]/", "", $val));
            $val = str_replace(' ', '', $val);
			if(empty($val)) return "Falta completar algun dato.";
		}
		//
		$postData['estreno'] = (empty($_POST['estreno']) ? 0 : 1);
		$postData['online'] = (empty($_POST['online']) ? 0 : 1);
		$fecha = time();
		if (!is_uploaded_file($_FILES["imagen"]["tmp_name"])) { return "Falta elegir la imagen a subir."; }
		// EXISTE CATEGORIA ?
		$query = $this->query("SELECT * FROM ms_generos WHERE g_id='{$postData['genero']}' LIMIT 1");
		if($this->num_rows($query) == 0) return "El género expecificado no existe.";
		// INSERTAMOS LOS DATOS
		$this->query("INSERT INTO ms_peliculas (p_titulo, p_seo, p_sinopsis, p_ano, p_genero, p_idioma, p_calidad, p_estreno, p_date, p_online, p_hits, p_votos, p_reports) VALUES ('{$postData['titulo']}','{$postData['seo']}','{$postData['sinopsis']}','{$postData['anio']}','{$postData['genero']}','{$postData['idioma']}','{$postData['calidad']}','{$postData['estreno']}','{$fecha}','{$postData['online']}','0','0','0')");
		$lid = mysql_insert_id();
		// Subir foto
		$varallw = array("image/jpeg","image/pjpeg");
		$tips = array("jpeg","jpg");
		$varname = $_FILES["imagen"]['name'];
		$vartemp = $_FILES['imagen']['tmp_name'];
		$vartype = $_FILES['imagen']['type'];
		if (in_array($vartype, $varallw) && $varname != "") {
			$arrname = explode(".", $varname);
			$i = strtolower(end($arrname));
			if(in_array($i, $tips)){
			$varname = $lid.".jpg";
				if (!copy($vartemp, "../../files/uploads/".$varname)) {
					return "Error al subir el archivo";
				}
			} else { return "Archivo no valido, solo se acepta JPG"; }
		} else {
			return "Archivo no valido, solo se acepta JPG";
		}
		
		return "Pelicula guardada exitosamente.";
	}
	/*
		editPost()
	*/
	function editPost(){
		$p_id = (int) $_GET['pid'];
		//
		$postData = array(
			'titulo' => mysql_real_escape_string($_POST['titulo']),
			'seo' => $this->setSeo($_POST['titulo']),
			'anio' => (int) $_POST['anio'],
			'idioma' => mysql_real_escape_string($_POST['idioma']),
			'calidad' => mysql_real_escape_string($_POST['calidad']),
			'genero' => (int) $_POST['genero'],
			'sinopsis' => mysql_real_escape_string($_POST['sinopsis']),
		);
		// VACIOS
		foreach($postData as $key => $val){
            $val = trim(preg_replace("/[^ A-Za-z0-9]/", "", $val));
            $val = str_replace(' ', '', $val);
			if(empty($val)) return "Falta completar algun dato.";
		}
		//
		$postData['estreno'] = (empty($_POST['estreno']) ? 0 : 1);
		$postData['online'] = (empty($_POST['online']) ? 0 : 1);
		$postData['hits'] = (is_numeric($_POST['hits']) ? $_POST['hits'] : 0);
		$postData['votos'] = (is_numeric($_POST['votos']) ? $_POST['votos'] : 0);
		$postData['reports'] = (empty($_POST['reports']) ? 0 : 1);
		// EXISTE CATEGORIA ?
		$query = $this->query("SELECT * FROM ms_generos WHERE g_id='{$postData['genero']}' LIMIT 1");
		if($this->num_rows($query) == 0) return "El género expecificado no existe.";
		// EDITAMOS LOS DATOS
		$this->query("UPDATE ms_peliculas SET p_titulo='{$postData['titulo']}', p_seo='{$postData['seo']}', p_sinopsis='{$postData['sinopsis']}', p_ano='{$postData['anio']}', p_genero='{$postData['genero']}', p_idioma='{$postData['idioma']}', p_calidad='{$postData['calidad']}', p_estreno='{$postData['estreno']}', p_online='{$postData['online']}', p_hits='{$postData['hits']}', p_votos='{$postData['votos']}', p_reports='{$postData['reports']}' WHERE p_id='{$p_id}'");
		
		
		$lid = $p_id;
		// Subir foto
		if (is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
		$varallw = array("image/jpeg","image/pjpeg");
		$tips = array("jpeg","jpg");
		$varname = $_FILES["imagen"]['name'];
		$vartemp = $_FILES['imagen']['tmp_name'];
		$vartype = $_FILES['imagen']['type'];
		if (in_array($vartype, $varallw) && $varname != "") {
			$arrname = explode(".", $varname);
			$i = strtolower(end($arrname));
			if(in_array($i, $tips)){
			$varname = $lid.".jpg";
				if (!copy($vartemp, "../../files/uploads/".$varname)) {
					return "Error al subir el archivo";
				}
			} else { return "Archivo no valido, solo se acepta JPG"; }
		} else {
			return "Archivo no valido, solo se acepta JPG";
		}
		}
		return "Pelicula guardada exitosamente.";
	}
	/*
		deletPost()
	*/
	function deletPost(){
		global $msCore;
		$p_id = (int) $_GET['pid'];
		//
		$this->query("DELETE FROM ms_peliculas WHERE p_id = '{$p_id}'");
		$this->query("DELETE FROM ms_videos WHERE p_id = '{$p_id}'");
		$this->query("DELETE FROM ms_descargas WHERE p_id = '{$p_id}'");
		//
		$msCore->redirect($msCore->settings['datos']['w_url']."/admin/?a=post");
	}
	/*
		linkPost
	*/
	function linkPost(){
		$p_id = (int) $_GET['pid'];
		//
		$postData['links'] = mysql_real_escape_string($_POST['links']);
		$postData['offline'] = (empty($_POST['offline']) ? 0 : 1);
		$this->query("UPDATE ms_descargas SET d_links=' {$postData['links']}', d_online='{$postData['offline']}' WHERE p_id = '{$p_id}'");
		return "Enlaces agregados correctamente.";
	}
	/*
		newLink()
	*/
	function newLink(){
		//
		$postData = array(
			'titulo' => mysql_real_escape_string($_POST['titulo']),
			'url' => mysql_real_escape_string($_POST['url']),
		);
		// VACIOS
		foreach($postData as $key => $val){
            $val = trim(preg_replace("/[^ A-Za-z0-9]/", "", $val));
            $val = str_replace(' ', '', $val);
			if(empty($val)) return "Falta completar algun dato.";
		}
		//
		$postData['online'] = (!empty($_POST['online']) ? "1" : "0");
		//
		$this->query("INSERT INTO ms_links (l_nombre, l_url, l_online) VALUES ('{$postData['titulo']}','{$postData['url']}','{$postData['online']}')");
		return "Enlace agregado correctamente.";
	}
	/*
		editLink()
	*/
	function editLink(){
		$w_id = (int) $_GET['wid'];
		//
		$postData = array(
			'titulo' => mysql_real_escape_string($_POST['titulo']),
			'url' => mysql_real_escape_string($_POST['url']),
		);
		// VACIOS
		foreach($postData as $key => $val){
            $val = trim(preg_replace("/[^ A-Za-z0-9]/", "", $val));
            $val = str_replace(' ', '', $val);
			if(empty($val)) return "Falta completar algun dato.";
		}
		//
		$postData['online'] = (!empty($_POST['online']) ? "1" : "0");
		//
		$this->query("UPDATE ms_links SET l_nombre = '{$postData['titulo']}', l_url = '{$postData['url']}', l_online = '{$postData['online']}' WHERE l_id = '{$w_id}'");
		return "Enlace editado correctamente.";
	}
	/*
		deletLink()
	*/
	function deletLink(){
		global $msCore;
		//
		$w_id = (int) $_GET['wid'];
		//
		$this->query("DELETE FROM ms_links WHERE l_id='{$w_id}'");
		$msCore->redirect($msCore->settings['datos']['w_url']."/admin/?a=links");
	}
	/*
		saveAds()
	*/
	function saveAds(){
	global $msCore;
		//
		$postData = array(
			'728x90' => htmlentities($_POST['728x90']),
			'300x250' => htmlentities($_POST['300x250']),
			'120x600' => htmlentities($_POST['120x600']),
			'fb' => htmlentities($_POST['fb']),
		);
		foreach($postData as $key => $value){
			$this->query("UPDATE ms_publicidad SET ad_code='{$value}' WHERE ad_key='{$key}'");
		}
		$msCore->redirect($msCore->settings['datos']['w_url']."/admin/?a=ads");
	}
	/*
		saveAds()
	*/
	function saveConfig(){
	global $msCore;
		//
		$postData = array(
			'nombre' => htmlentities($_POST['nombre']),
			'slogan' => htmlentities($_POST['slogan']),
			'url' => htmlentities($_POST['url']),
			'tema' => htmlentities($_POST['tema']),
			'offline' => (int) $_POST['offline'],
			'txtoff' => htmlentities($_POST['txtoff']),
		);
		$this->query("UPDATE ms_config SET w_titulo='{$postData['nombre']}', w_slogan='{$postData['slogan']}', w_url='{$postData['url']}', w_tema='{$postData['tema']}', w_offline='{$postData['offline']}', w_txtoff='{$postData['txtoff']}' WHERE w_id = '1'");
		$msCore->redirect($msCore->settings['datos']['w_url']."/admin/?a=config");
	}
	/*getPagination()
	*/
	function getPagination($page,$amostrar,$total,$ext = NULL){
		if($page == 1){ $inicio = 0; } else { $inicio = ($page -1) * $amostrar; }
		$pages = ceil($total / $amostrar);
		$next = $page +1;
		$prev = $page -1;
		if($page != 1){	$this->linkpage = "<li><a href=\"?{$ext}page=$prev\" >Anterior</a></li>"; if($page < $pages)	{ $this->linkpage.= "<li><a href=\"?{$ext}page=$next\" >Siguiente</a></li>"; }} elseif ($page < $pages) { $this->linkpage = "<li><a href=\"?{$ext}page=$next\" >Siguiente</a></li>"; }
		return "{$inicio},{$amostrar}";
	}

/*
		newcontacto()
	*/
	    function newContacto(){
         global $msCore;
        $nombre		=	mysql_real_escape_string($_POST['nombre']);
        $mail		=	mysql_real_escape_string($_POST['email']);
        $cuerpo		=	mysql_real_escape_string($_POST['comentarios']);
        $captcha = $_POST['recaptcha_response_field'];
        if(empty($nombre)) return 'Debes ingresar tu nombre.';
        elseif(empty($mail)) return 'Debes ingresar tu mail.';
        elseif(empty($cuerpo)) return 'Debes ingresar un comentario o opinion.';
        elseif(empty($captcha)) return 'Debes ingresar el codigo de la imagen.';
                      else {
   $sql = "INSERT INTO ms_contacto (nombre, mail,comentario, fecha) VALUES ('$nombre', '$mail', '$cuerpo', NOW())";
        $result = mysql_query($sql);
if($result) return true;
		else return false;
	}}
	/*
		deletContacto()
	*/
	function deletContacto(){
		global $msCore;
		//
		$c_id = (int) $_GET['coid'];
		//
		$this->query("DELETE FROM ms_contacto WHERE id='{$c_id}'");
		$msCore->redirect($msCore->settings['datos']['w_url']."/admin/?a=contactos");
	}
	/*
		editLink()
	*/
	function editContacto(){
		$c_id = (int) $_GET['coid'];
		//
		$postData = array(
			'nombre' => mysql_real_escape_string($_POST['nombre']),
			'email' => mysql_real_escape_string($_POST['email']),
			'comentario' => mysql_real_escape_string($_POST['cuerpo']),
		);
		// VACIOS
		foreach($postData as $key => $val){
            $val = trim(preg_replace("/[^ A-Za-z0-9]/", "", $val));
            $val = str_replace(' ', '', $val);
			if(empty($val)) return "Falta completar algun dato.";
		}
		//
		$this->query("UPDATE ms_contacto SET nombre = '{$postData['nombre']}', mail = '{$postData['email']}', comentario = '{$postData['comentario']}' WHERE id = '{$c_id}'");
		return "Contacto editado correctamente.";
	}

	/*
		setSeo(Nombre)
	*/
	function setSeo($url){
		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ');
		$repl = array('a', 'e', 'i', 'o', 'u', 'n', 'a', 'e', 'i', 'o', 'u', 'n');
		$url = strtolower($url); 
		$url = str_replace ($find, $repl, $url);
		$find = array(' ', '&', '\r\n', '\n', '+'); 
		$url = str_replace ($find, '-', $url);
		$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
		$repl = array('', '-', '');
		$url = preg_replace ($find, $repl, $url);
		return $url;
	}
}
?>