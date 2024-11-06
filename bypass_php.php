<?php
	
	include("minifigures.php");
	
	
	$text = $_POST['text'];
	
	$data = explode('_', $text);
	
	$accion = $data[0];
	$parameter = $data[1];
	
		switch($accion){
			
			case 1: // restructura los check del panel usuarios admin
			//Para case 1 parameter es el ID de usuario
			
				$chk_admin = genera_check_series_opcionales_admin($parameter);
				$res = $parameter.'|'. $chk_admin;
				
				echo '1|'.$res;
				

			
			break; 

			case 2:


				$chk_admin = genera_check_series_opcionales_admin_perfil($parameter);
				$res = $parameter.'|'. $chk_admin;
				
				echo '2|'.$res;

			break; 
						
			default: 
			break;
		
		} 
	
	
	?>