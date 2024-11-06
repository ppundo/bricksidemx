

<?php
	
	$mnu =  $_GET['mnu'];
	$op = $_GET['op'];
	$submnu = $_GET['submnu'];
	
	$url = 'index.php?mnu='.$mnu.'&op='.$op; 
	
	$mail = $_GET['mail'];
	
	$user = 'TEST USER';
	$email = 'pepe.nando18@gmail.com'; 
	
	if($mail != 0){
		
		$data_sendb = $mail.';'.$user.';'.$email.';'.'xxxxxxxx';
		mail_me($data_sendb);	
		
		$msg = 'mensaje '.$mail.' enviado';	
	}else{
		$msg = '';
	}
	
	?>
	
	
<div class="scrollable" style="overflow: hidden;">	
	<p>
		<a href="<?php echo $url.'&mail=1&submnu='.$submnu; ?>"> Validar mail 1 - Nuevo registro (to Owner)</a>
	</p>
	
	<p>
		<a href="<?php echo $url.'&mail=2&submnu='.$submnu; ?>"> Validar mail 2 - Intento Acceso</a>
	</p>

	<p>
		<a href="<?php echo $url.'&mail=3&submnu='.$submnu; ?>"> Validar mail 3 - Cambio de Contraseña</a>
	</p>
	
	<p>
		<a href="<?php echo $url.'&mail=4&submnu='.$submnu; ?>"> Validar mail 4 - Activa cuenta</a>
	</p>
	
	<p>
		<a href="<?php echo $url.'&mail=5&submnu='.$submnu; ?>"> Validar mail 5 - Intento Inicio Sesión</a>
	</p>
		
	<h4> <?php echo $msg; ?></h4>
</div>