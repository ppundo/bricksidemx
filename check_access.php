<?php
	
	$perfil_user = $GLOBALS['user_perfil'];
	$user = $_SESSION['clave_user'];	
//$user = $_SESSION['clave_user'];
//var_dump($user);

	if($user==0 or $user==""){
			
		echo '<meta http-equiv = "refresh" content = "0; url=http://bricksidemx.com/collector/login.php" />';
		
		$registro_url = registra_url($user);
			
	}else{
		
		if($user_perfil==0 or $user_perfil==""){
			//echo '<meta http-equiv = "refresh" content = "0; url = http://bricksidemx.com/collector/index.php" />';
		}
	}
		
		
	?>