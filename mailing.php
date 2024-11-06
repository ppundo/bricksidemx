<?php

function make_mail($contenido_mail){
	
	$head = '<head>
	<style type="text/css" title="x-apple-mail-formatting"></style>
    <meta name="viewport" content="width = 375, initial-scale = -1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <title></title>
    <style>

    @media only screen and (max-device-width: 700px) {
      .table-wrapper {
        margin-top: 0px !important;
        border-radius: 0px !important;
      }

      .header {
        border-radius: 0px !important;
      }
    }
    </style>
  </head>'; 
	
	$cuerpo = ' 
	<body style="-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;font-size:100%;line-height:1.6">

    <table style="background: #F5F6F7;" width="100%" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td>
          <!-- body -->

          <table cellpadding="0" cellspacing="0" class="table-wrapper" style="margin:auto;margin-top:50px;border-radius:7px;-webkit-border-radius:7px;-moz-border-radius:7px;max-width:700px !important;box-shadow:0 8px 20px #e3e7ea !important;-webkit-box-shadow:0 8px 20px #e3e7ea !important;-moz-box-shadow:0 8px 20px #e3e7ea !important;box-shadow: 0 8px 20px #e3e7ea !important; -webkit-box-shadow: 0 8px 20px #e3e7ea !important; -moz-box-shadow: 0 8px 20px #e3e7ea !important;">
            <tbody><tr>

              <!-- Brand Header -->
                <td class="container" bgcolor="#FFFFFF" style="display:block !important;margin:0 auto !important;clear:both !important">
                  <img src="http://thebrickside.bluenibble.com/collector/assets/images/mail/head_mail.png" style="max-width:100%">
               </td>
            </tr>
            <tr>
              <td class="container content" bgcolor="#FFFFFF" style="padding:35px 40px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;display:block !important;margin:0 auto !important;clear:both !important">

                <!-- content -->

                <div class="content-box" style="max-width:600px;margin:0 auto;display:block"> 
<!-- Content -->

<div class="header-title">

  '.$contenido_mail.'
  

                </div>
                <!-- /content -->
              </td>

              <td>
              </td>
            </tr>
          </tbody></table>

          <!-- /body -->'; 
	
	$footer = '
	<div class="footer" style="padding-top:30px;padding-bottom:55px;width:100%;text-align:center;clear:both !important">

            <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0;font-size:12px;color:#666;margin-top:0px">BrickSideMx Community - The BrickShelf Collector</p>

            <p class="social-icons" style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0;font-size:12px;color:#666;padding-top:5px">

              <a href="https://www.facebook.com/bricksidemx" style="color:#1EA69A;word-wrap:break-word;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;font-weight:800;color:#999;color:#049075 !important"><img width="25" src="https://cdn2.hubspot.net/hubfs/677576/email-fb.png" style="max-width:100%"></a>

              <a href="https://twitter.com/bricksidemx" style="color:#1EA69A;word-wrap:break-word;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;font-weight:800;color:#999;color:#049075 !important"><img width="25" src="https://cdn2.hubspot.net/hubfs/677576/email-twitter.png" style="max-width:100%"></a>

              <a href="https://www.instagram.com/bricksidemx" style="color:#1EA69A;word-wrap:break-word;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;font-weight:800;color:#999;color:#049075 !important"><img width="25" src="https://cdn2.hubspot.net/hubfs/677576/email-insta.png" style="max-width:100%"></a>

             

            </p>
          </div>
        </td>
      </tr>
    </tbody></table>
</body>

	'; 
	
	$mail_estructure = $head.$cuerpo.$footer; 
	return $mail_estructure;
}



function mail_me($info){
	
	$mail_admin = 'admin@bricksidemx.com'; 
	
	$dataw = explode(';', $info);
	
	$tipo_mail = $dataw[0]; 
	$user_to = $dataw[1];
	$email_user = $dataw[2]; 
	$pass = $dataw[3];
	
	
	$hoy = date("d-m-Y h:i:s A"); 
	
	switch($tipo_mail){
		
		
		case 1: // NOtificacion de Registros al owner
		
					$ip =  $_SERVER['REMOTE_ADDR']; 
					//$ip = '187.189.79.167'; 
					
					$meta_dir = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
					$latitud = $meta_dir['geoplugin_latitude'];
					$longitud = $meta_dir['geoplugin_longitude'];
					$ciudad = $meta_dir['geoplugin_city'];
					$region = $meta_dir['geoplugin_region'];
					$pais = $meta_dir['geoplugin_countryName'];
							
						$subject_custom = '[Nuevo Registro] '. strtoupper($user_to); 
						$message_custom .= 
						'<ul class="list" style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E">
			
			  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Email: <a href="mailto:" dir="ltr" x-apple-data-detectors="true" x-apple-data-detectors-type="link" x-apple-data-detectors-result="0">'.$email_user.'</a></li>
			
			  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Fecha: '.$hoy.'</li>
			
			  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Localización*: '.$ciudad.', '.$region.' en '.$pais.'</li>
			  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Coordenadas*: '.$latitud.', '.$longitud.'</li>
			
			  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Dirección IP: '.$ip.'</li>
			
			</ul>	';
						$email_destino = $mail_admin; 
		
		break; 
		
		
		case 2: // password Erroneo
		
						$ip =  $_SERVER['REMOTE_ADDR']; 
						//$ip = '187.189.79.167'; 
						
						$meta_dir = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
						$latitud = $meta_dir['geoplugin_latitude'];
						$longitud = $meta_dir['geoplugin_longitude'];
						$ciudad = $meta_dir['geoplugin_city'];
						$region = $meta_dir['geoplugin_region'];
						$pais = $meta_dir['geoplugin_countryName'];
						
						//$ciudad = obtener_ciudad($ip);
						
						$subject_custom = '[Intentento de Acceso] Alerta de Seguridad BrickShelf Collector'; 
						//$message_custom = $hoy.' <br> Se ha registrado un intento de inicio de sesión desde la ubicación: '.$ciudad.', '.$region.' en '.$pais.' <br>';
						//$message_custom .= 'El siguiente pass se ha utilizado: <b>'.$pass.'</b>';
						
						$title_message = '<h1 style="font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;margin-bottom:15px;color:#47505E;margin:0px 0 10px;line-height:1.2;font-weight:200;font-size:28px;font-weight:bold;margin-bottom:30px">
						Nuevo Intento de Inicio de Sesión desde '.$region.'</h1>
				</div>'; 
						
						$message_custom = '
						<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0">
				
				 ¿Fuiste tu? Detectamos que alguien ha intentado entrar a tu cuenta:
				</p>
				
				<ul class="list" style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E">
				
				  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Email: <a href="mailto:" dir="ltr" x-apple-data-detectors="true" x-apple-data-detectors-type="link" x-apple-data-detectors-result="0">'.$email_user.'</a></li>
				
				  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Fecha: '.$hoy.'</li>
				
				  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Localización*: '.$ciudad.', '.$region.' en '.$pais.'</li>
				  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Coordenadas*: '.$latitud.', '.$longitud.'</li>
				
				  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Dirección IP: '.$ip.'</li>
				  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Clave Utilizada: '.$pass.'</li>
				
				</ul>	
				<hr style="border-top:1px solid #ccc;border-top:.5px solid #e7eeef;margin:20px 40px 10px">	
						';
					
							$foo = '
							
									  <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em; font-size:12px; color:#47505E; margin-bottom:0;"><strong> Si has sido tu, ignora este mensaje, de lo contrario te recomendamos cambiar tu contraseña.</strong></p>
									  
				   <footer>
				    <p style="font-weight:normal; padding:0; font-family:&quot; Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; line-height:1.7; margin-bottom:1.3em; font-size:12px; color:#47505E;  margin-bottom:0; ">
				
				      <strong>
				        ¿Por qué enviamos esto?
				      </strong>
				      <br>      
				Queremos mantenerlo informado sobre acciones importantes en su cuenta.
				      <br>
				      <br>
				      No pudimos determinar que navegador o dispositivo ha usado con su cuenta anteriormente. Es posible que vuelva a ver este correo electrónico si intenta acceder a su cuenta y su contraseña o es errónea. 
				      <br>
				      <br>
				         No Respondas a este correo electrónico.
				      <br>
				      <br> 
				      <small style="font-size:12px">
				        *La localización es aproximada y determinada por la dirección IP, si se usa un proxy, vpn esta puede no ser precisa.
				      </small>
				    </p>
				    </footer>
				    ';
						
						
						$email_destino = $email_user;
		
		break; 
		
		case 3: 
		
						$parameter = md5($email_user);
						$linkw = 'http://shelf.bricksidemx.com/collector/index.php?set=4&parameter='.$parameter;
						$subject_custom = '[Cambio de Contraseña] BrickShelf Collector'; 
						//$message_custom = $hoy.' <br> Se ha registrado un intento de inicio de sesión desde la ubicación: '.$ciudad.', '.$region.' en '.$pais.' <br>';
						//$message_custom .= 'El siguiente pass se ha utilizado: <b>'.$pass.'</b>';
						
						$title_message = '<h1 style="font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;margin-bottom:15px;color:#47505E;margin:0px 0 10px;line-height:1.2;font-weight:200;font-size:28px;font-weight:bold;margin-bottom:30px">
						Solicitud para Cambiar Contraseña </h1>
				</div>'; 
						
						$message_custom = '
						<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0">
				
				 Se ha solicitado cambiar la contraseña de tu cuenta, al realizar este proceso también podrás reactivarla. 
				</p>
				
				<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0">
				
				Para continuar sigue el siguiente link: <br> <a href="'.$linkw.'"> Restablecer contraseña</a> <br>
				<small> En caso que este no funcione copia y pega el siguiente link en tu navegador: '.$linkw.'</small>
				
				</p>
				<br>
				
				<hr style="border-top:1px solid #ccc;border-top:.5px solid #e7eeef;margin:20px 40px 10px">
				';	
				
						$foo = '
						  <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em; font-size:12px; color:#47505E; margin-bottom:0;"><strong> Si has sido tu, ignora este mensaje, de lo contrario escribenos a: soporte@bricksidemx.com.</strong></p>
						  
				<footer>
				    
				    <p style="font-weight:normal; padding:0; font-family:&quot; Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; line-height:1.7; margin-bottom:1.3em; font-size:15px; color:#47505E; font-size:16px; margin-bottom:0; font-size:14px">
				
				      <strong>
				        ¿Por qué enviamos esto?
				      </strong>
				      <br>      
				Queremos mantenerlo informado sobre acciones importantes en su cuenta.
				      <br>
				      <br>
				      No pudimos determinar que navegador o dispositivo ha usado con su cuenta anteriormente. Es posible que vuelva a ver este correo electrónico si intenta acceder a su cuenta y su contraseña o es errónea. 
				      <br>
				      <br>
				         No Respondas a este correo electrónico.
				      <br>
				      <br>       
				      <small style="font-size:12px">
				        *La localización es aproximada y determinada por la dirección IP, si se usa un proxy, vpn esta puede no ser precisa.
				      </small>
				    </p>
				    </footer>
				    
				    ';
				    	
						
						$email_destino = $email_user;
		
		break; 
		
		
		case 4: // Notificacion de Bienvenida al usuario

						$enlacew= 'http://shelf.bricksidemx.com/collector/login.php?token='.md5($email_user);
				
						$subject_custom = 'Bienvenido '.strtoupper($user_to).' a BrickShelf Collector'; 
					
						$title_message = '<h1 style="font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;margin-bottom:15px;color:#47505E;margin:0px 0 10px;line-height:1.2;font-weight:200;font-size:28px;font-weight:bold;margin-bottom:30px">
						¡Bienvenido '.strtoupper($user_to).'!</h1>
				</div>'; 
						
						$message_custom = '
				
							<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0">
							
							 Estamos emocionados de tenerte en la comunidad <strong>BrickSide Mx</strong>, en este sitio tendrás un coleccionador para registrar las las minifiguras y sets de LEGO<span style="font-size: 10px;">&reg;</span>.
							 </p>
							
							<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0">
										 Para activar tu cuenta haz click en el siguiente enlace: <br>
										 <a href="'.$enlacew.'"> Activa tu cuenta </a>
										 <br>
										 ò
										 <br>
										 
										 Copia y pega esta dirección en tu navegador: <br>
										 
										 <a href="'.$enlacew.'"> '.$enlacew.' </a>
							 </p>
							
					  <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0">  Recuerda:  
						
						<ul>
						<li> No reenvies este correo</li>
						<li> No respondas a este correo</li>
						<li> Este correo es valido por 24 horas.</li>
						</ul>
					
					</p>
				
							<hr style="border-top:1px solid #ccc;border-top: 5px solid #e7eeef; margin:20px 40px 10px">					
									';		
									
						$foo = '
							
						<p class="no-top-margin" style="font-weight:normal; padding:0; font-family:&quot; Helvetica Neue &quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; line-height:1.7; margin-bottom:1.3em; font-size:15px; color:#47505E; font-size:16px; font-size:14px; margin-top:0; margin-top:0px; margin-bottom:0">
				    </p>
				    
				    <footer>
				    <p style="font-weight:normal; padding:0; font-family:&quot; Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; line-height:1.7; margin-bottom:1.3em; font-size:10px; color:#47505E; font-size:16px; margin-bottom:0; ">
				
				   
				        ¿Tienes dudas?<br>
				        
				        <span>Escríbenos a: </span><a href="mailto:hola@bricksidemx.com"> hola@bricksidemx.com</a>
				
				      </p>
				      <br>  
				      <h3> Equipo BRICKSIDEMX COLLECTOR</h3>    
				    </p>
				
				    </footer>
				    ';
						
						$email_destino = $email_user;
		
		
		break; 
		
		case 5: 
		break; 
		
		default: 
		break; 
		
	}//switch
	
	
	$contenido_case = $title_message.$message_custom.$foo;
	$mail_listo = make_mail($contenido_case); 

    $from = "noreply@bricksidemx.com";
    $to = $email_destino;
    $subject = $subject_custom;
    $messagew = $mail_listo;
    
    $headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	//$headers .= 'Bcc:'.$mail_admin . "\r\n";

//dirección del remitente 
	$headers .= "From: BrickShelf Collector <noreply@bricksidemx.com.com>\r\n"; 
    
	
    mail($to,$subject,$messagew, $headers);
  //  echo $meta;
	
}




?>

																												