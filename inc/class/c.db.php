<?php
/********************************************************************************
* c.db.php                                                                      *
*********************************************************************************
* MScript: Desarrollado por Marcofbb ®											*
* ==============================================================================*
* Software Version:           MS 1.0 BETA          								*
* Software by:                Marcofbb			     							*
*********************************************************************************/


/*

	CLASE CON LOS ATRIBUTOS Y METODOS PARA LA BASE DE DATOS
	
*/
class msMySQL {
	
	private $conexion;	
	
	public function msMySQL(){
		if(!isset($this->conexion)){
			$this->conexion = (mysql_connect(db_host,db_user,db_pass)) or die(mysql_error());
			mysql_select_db(db_name,$this->conexion) or die(mysql_error());
		}
	}
	
	function &getInstance(){
		static $instance;
		if(is_null($instance)){
			$instance = new msMySQL();
		}
		return $instance;
	}
	
	public function query($sql){
		$res = mysql_query($sql,$this->conexion);
		if(!$res){
			echo 'MySQL Error: ' . mysql_error();
			exit;
		}
		return $res;
	}
	
	public function fetch_array($sql){   
  		return mysql_fetch_array($sql);  
	}
	
	public function num_rows($sql){   
		return mysql_num_rows($sql);  
	} 	
}
?>