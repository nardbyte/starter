<?php
/********************************************************************************
* c.core.php                                                                    *
*********************************************************************************
* MScript: Desarrollado por Marcofbb ®											*
* ==============================================================================*
* Software Version:           MS 1.0 BETA          								*
* Software by:                Marcofbb			     							*
*********************************************************************************/


/*

	CLASE CON LOS ATRIBUTOS Y METODOS PARA LA CONFIGURACION
	
*/
class msCore {
	var $settings;
	//
	function msCore(){
		// OBTENEMOS DATOS Y LOS GUARDAMOS EN VARIABLES
		$this->settings['datos'] = $this->getSettings();
		$this->settings['links'] = $this->getLinks();
		$this->settings['ads'] = $this->getAds();
	}
	// INSTANCIA DE LA CLASE
	function &getInstance(){
		static $instance;
		if(is_null($instance)){
			$instance = new msCore();
		}
		return $instance;
	}
	/*
		getSettings()
	*/
	function getSettings(){
		global $msdb;		
		$sql = $msdb->query("SELECT * FROM ms_config WHERE w_id = '1'");
		if($msdb->num_rows($sql) > 0)
		{
		return $msdb->fetch_array($sql);		
		}
	}
	/*
		getLinks()
	*/
	function getLinks(){
		global $msdb;
		$sql = $msdb->query("SELECT * FROM ms_links WHERE l_online = '1'");
		while($row = $msdb->fetch_array($sql)){
			$data[] = $row;
		}
		return $data;
	}
	/*
		getAds()
	*/
	function getAds(){
		global $msdb;
		$sql = $msdb->query("SELECT * FROM ms_publicidad");
		while($row = $msdb->fetch_array($sql)){
			$data[$row['ad_key']] = $row['ad_code'];
		}
		return $data;
	}
	/*
		setLevel()
	*/
	function setLevel($msLevel, $msg = false){
		global $msUser;		
		// CUALQUIERA
		if($msLevel == 0) return true;
		// SOLO VISITANTES
		elseif($msLevel == 1) {
			if($msUser->is_member == 0) return true;
			else {
				if($msg) $mensaje = 'Esta pagina solo es vista por los visitantes.';
				else $this->redirect($this->settings['datos']['w_url'].'/');
			}
		}
		// SOLO MIEMBROS
		elseif($msLevel == 2){
			if($msUser->is_member == 1) return true;
			else {
				if($msg) $mensaje = 'Para poder ver esta pagina debes iniciar sesi&oacute;n.';
				else $this->redirect($this->settings['datos']['w_url'].'/login/?a='.$this->currentUrl());
			}
		}
		// SOLO MODERADORES
		elseif($msLevel == 3){
			if($msUser->is_admod) return true;
			else {
				if($msg) $mensaje = 'Estas en un area restringida solo para moderadores.';
				else $this->redirect($this->settings['datos']['w_url'].'/login/?a='.$this->currentUrl());
			}
		}
		// SOLO ADMIN
		elseif($msLevel == 4) {
			if($msUser->is_admod == 1) return true;
			else {
				if($msg) $mensaje = 'Estas intentando algo no permitido.';
				else $this->redirect($this->settings['datos']['w_url'].'/login/?a='.$this->currentUrl());
			}
		}
		//
		return array('titulo' => 'Error', 'mensaje' => $mensaje);
	}
	/*
		redirect()
	*/
	function redirect($msDir){
		$msDir = urldecode($msDir);
		header("Location: $msDir");
		exit();
	}
	/*
		currentUrl
	*/
	function currentUrl(){
		$current_url_domain = $_SERVER['HTTP_HOST'];
		$current_url_path = $_SERVER['REQUEST_URI'];
		$current_url_querystring = $_SERVER['QUERY_STRING'];
		$current_url = "http://".$current_url_domain.$current_url_path;
		$current_url = urlencode($current_url);
		return $current_url;
	}
}
?>