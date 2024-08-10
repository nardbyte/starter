<?php
/********************************************************************************
* c.usuarios.php                                                                *
*********************************************************************************
* MScript: Desarrollado por Marcofbb ®											*
* ==============================================================================*
* Software Version:           MS 1.0 BETA          								*
* Software by:                Marcofbb			     							*
*********************************************************************************/

/*

	CLASE CON LOS ATRIBUTOS Y METODOS PARA LOS USUARIOS
	
*/
class msUsuarios {
	//
	var $info = array();	// SI EL USUARIO ES MIEMBRO CARGAMOS DATOS DE LA TABLA
	var $is_member = 0;		// EL USUARIO ESTA LOGUEADO?
    var $is_admod = 0;		// EL USUARIO ES ADMIN?
	var $nick = 'Visitante';// NOMBRE A MOSTRAR
	var $uid = 0;			// USER ID
	
	// INSTANCIA DE LA CLASE
	function &getInstance(){
		static $instance;
		if(is_null($instance)){
			$instance = new msUsuarios();
		}
		return $instance;
	}
	//
	function msUsuarios(){
		$this->setSession();
	}
	/*
		setSession
	*/
	function setSession(){
		global $msdb;
		if(!empty($_SESSION['msUser'])){
			$this->loadUser($_SESSION['msUser']);			
		} 
		elseif(isset($_COOKIE['msDatos'])){
			$cookie = htmlentities($_COOKIE['msDatos']);
			$cookie = explode("%",$cookie);
			$user = $cookie[0];
			$id = $cookie[1];
			$ip = $cookie[2];
			if ($HTTP_X_FORWARDED_FOR == ""){ $ip2 = getenv(REMOTE_ADDR); } else { $ip2 = getenv(HTTP_X_FORWARDED_FOR); }
			if($ip == $ip2){
				$sql = $msdb->query("SELECT * FROM ms_users WHERE u_hash='".$id."' and u_name='".$user."' LIMIT 1");
				if($msdb->num_rows($sql) > 0){
					$row = $msdb->fetch_array($sql);
					$this->loadUser($row['u_id'], true);
				}
			}
		} else { $_SESSION['msUser'] = 0; }
	}
	/*
		loadUser()
	*/
	function loadUser($id,$session = false){
		global $msdb;
		$sql = $msdb->query("SELECT * FROM ms_users WHERE u_id='".$id."' LIMIT 1");
		if($msdb->num_rows($sql) > 0){
			$msArray = $msdb->fetch_array($sql);
			$this->info = $msArray;
			if($session == true) $_SESSION['msUser'] = $msArray['u_id'];
			$this->is_member = 1;
			$this->is_admod = ($msArray['u_rango'] <= 2) ? $msArray['u_rango'] : 0;
			$this->nick = $msArray['u_name'];
			$this->uid = $msArray['u_id'];
			return true;
		} else { return false; }
	}
	/*
		loginUser
	*/
	function loginUser($remember = false, $redirectTo = NULL){
		global $msdb,$msCore;
		// Armamos variables
		$postData = array(
			'nombre' => mysql_escape_string(strtolower($_POST['nombre'])),
			'password' => md5($_POST['password']),
		);
		// VACIOS
		foreach($postData as $key => $val){
            $val = trim(preg_replace("/[^ A-Za-z0-9]/", "", $val));
            $val = str_replace(' ', '', $val);
			if(empty($val)) return "Falta completar algun dato.";
		}
		// Consulta
		$sql = $msdb->query("SELECT u_id,u_name,u_password FROM ms_users where u_name='{$postData['nombre']}' LIMIT 1");
		if($msdb->num_rows($sql) <= 0) return 'El usuario no existe.';
		$data = $msdb->fetch_array($sql);
		if($data['u_password'] != $postData['password']){
			return 'Tu contrase&ntilde;a es incorrecta.';
		} else {
			if($this->loadUser($data['u_id'],true)) {
				if($remember == true){
					if ($HTTP_X_FORWARDED_FOR == ""){ $ip = getenv(REMOTE_ADDR); } else { $ip = getenv(HTTP_X_FORWARDED_FOR); }
					$hash = md5(uniqid(rand(), true));
					$cookie = $postData['nombre']."%".$hash."%".$ip;
					setcookie('msDatos', $cookie, time()+7776000,'/');
					$msdb->query("UPDATE ms_users SET u_hash='".$hash."' WHERE u_name='".$postData['nombre']."' LIMIT 1");
				}
				if($redirectTo != NULL) $msCore->redirect($redirectTo);
				else $msCore->redirect($msCore->settings['datos']['w_url']);
			} else return 'Error inesperado...';
		}
	}
	/*
		logoutUser()
	*/
	function logoutUser(){
		global $msCore;
		$_SESSION['msUser'] = 0;	
		$this->info = '';
		$this->is_member = 0;
		setcookie("msDatos","x",time()-3600,"/");
		$msCore->redirect($msCore->settings['datos']['w_url']);
	}
}
?>