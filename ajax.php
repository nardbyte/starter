<?php
include('header.php');
$do = htmlentities($_GET['do']);
	
switch($do){
	case "report" :
		$id = (int) $_POST['id'];
		if(empty($id)) exit();
		if(isset($_COOKIE['msReport'])){
			$cookie = htmlentities($_COOKIE['msReport']);
			$explode = explode("%",$cookie);
			if(in_array($id,$explode)){
				echo "Usted ya ha reportado pelicula.";
			} else {			
				$cookie.= $id."%";
				$msdb->query("UPDATE ms_peliculas SET p_reports = '1' WHERE p_id='{$id}'");
				setcookie('msReport', $cookie, time()+7776000,'/');
				echo "Pelicula reportada.";
			}
		} else {	
			$cookie = $id."%";
			$msdb->query("UPDATE ms_peliculas SET p_reports = '1' WHERE p_id='{$id}'");
			setcookie('msReport', $cookie, time()+7776000,'/');
			echo "Pelicula reportada.";
		}		
	break;	
	
	case "votar" :
		$id = (int) $_POST['mid'];
		$voto = htmlentities($_POST['voto']);
		if(empty($id)) exit();
		if($voto == "pos"){
			if(isset($_COOKIE['msVotos'])){
				$cookie = htmlentities($_COOKIE['msVotos']);
				$explode = explode("%",$cookie);
				if(in_array($id,$explode)){
					echo "Usted ya ha votado esta pelicula.";
				} else {
					$cookie.= $id."%";
					$msdb->query("UPDATE ms_peliculas SET p_votos=p_votos+1 WHERE p_id='{$id}'");
					setcookie('msVotos', $cookie, time()+7776000,'/');
					echo "Voto contado.";
				}
			} else {
					$cookie.= $id."%";
					$msdb->query("UPDATE ms_peliculas SET p_votos=p_votos+1 WHERE p_id='{$id}'");
					setcookie('msVotos', $cookie, time()+7776000,'/');
					echo "Voto contado.";			
			}			
		} elseif($voto = "neg"){
			if(isset($_COOKIE['msVotos'])){
				$cookie = htmlentities($_COOKIE['msVotos']);
				$explode = explode("%",$cookie);
				if(in_array($id,$explode)){
					echo "Usted ya ha votado esta pelicula.";
				} else {
					$cookie.= $id."%";
					$msdb->query("UPDATE ms_peliculas SET p_votos=p_votos-1 WHERE p_id='{$id}'");
					setcookie('msVotos', $cookie, time()+7776000,'/');
					echo "Voto contado.";
				}
			} else {
					$cookie.= $id."%";
					$msdb->query("UPDATE ms_peliculas SET p_votos=p_votos-1 WHERE p_id='{$id}'");
					setcookie('msVotos', $cookie, time()+7776000,'/');
					echo "Voto contado.";			
			}
		} else { exit(); }
	break;
	
	default :
	exit();
}
?>