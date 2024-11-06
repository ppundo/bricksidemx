<?php
	

	
	
	require_once("sesion.class.php");
	
	$sesion = new sesion();
	$usuario = $sesion->get("clave_user");	
	if( $usuario == false )
	{	
		
		header("Location: login.php");
		
	}
	else 
	{

		 
		$usuario = $sesion->get("clave_user");	
		$sesion->termina_sesion();
		
		header("Cache-Control: no-cache, must-revalidate"); // Evitar guardado en cache del cliente HTTP/1.1
		header("location: login.php");
		

	}
?>

