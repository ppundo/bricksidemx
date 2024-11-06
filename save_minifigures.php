<?php
	
	include("access.php");
	include("globals.php");
	include("minifigures.php");
	require_once("sesion.class.php");
	//include("mailing.php");

	$id_user_b = $_SESSION['clave_user'];
	$item = $_POST['item'];
	$id_user = $_POST['id_user'];
	$action = $_POST['action'];
	$values = $_POST['values'];
	
	//$user_conf = get_cofiguraciones($id_user);
	 
	
	switch($action){
		
		case 1: // 
		
		$idioma = $_POST['idioma'];
		
					if($id_user!='' or $id_user!=0){
						
							$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
								if ($dbh->connect_error) {
							    	die("Connection failed: " . $dbh->connect_error);
								}
				
								$hoy = date("Y-m-d H:i:s");
								
								// comprueba si ya existe el registro
								 $q = "SELECT * FROM coleccion WHERE item = '$item' and id_user= $id_user";// preparando la instruccion sql
							
							   
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
								 $row= $result->fetch_assoc(); // trae el valor del campo estado
								 
								 $estado = $row['estado']; 
								 $hoyb = date("Y-m-d H:i:s");
				 
								 	if($estado == 1){ // Si el esado del registro es 1, cambialo a cero
										 
										$nombre_fig = get_data($item,0);
										 
										$data_figa = explode('/', $nombre_fig); 
										$nombre_mini_es = $data_figa[0];
										$nombre_mini_en = $data_figa[1];
										$foto = $data_figa[2];
										$cve_lego = $data_figa[3];

										if($idioma == 'es' || $idioma == 'ES'){
											$nombre_minifig = $nombre_mini_es;
											
										}elseif($idioma=='en' || $idioma == 'EN'){
											$nombre_minifig = $nombre_mini_en;
											
										}else{
											$nombre_minifig = $nombre_mini_es; 
										}	
					 	
							 			$qb = "UPDATE coleccion SET estado = 0, faltantes = '0', mostrar_mkt = 0 , fecha_actualizado = '$hoyb' where item='$item' and id_user= $id_user";// preparando la instruccion sql
					 		 
							   			if (mysqli_query($dbh, $qb)) {								   			
								   				$tot_user = get_total_coleccion_user($cve_lego, $id_user);
						   					    echo '300|1|'.$nombre_minifig.'|'.$item.'||'.$tot_user; 
						   				} else {
						   						$tot_user = get_total_coleccion_user($cve_lego, $id_user);
											    echo '300|0|||'.mysqli_error($dbh).'|'.$tot_user;  
									    }
					 	
					
									}elseif($estado ==0) { //De lo contrario cambialo a 1
										$nombre_fig = get_data($item,$index);

										$data_figb = explode('/', $nombre_fig); 
										$nombre_mini_es = $data_figb[0];
										$nombre_mini_en = $data_figb[1];
										$foto = $data_figb[2];
										$cve_lego = $data_figb[3];
										
										if($idioma == 'es' || $idioma == 'ES'){
											$nombre_minifig = $nombre_mini_es;
											
										}elseif($idioma=='en' || $idioma == 'EN'){
											$nombre_minifig = $nombre_mini_en;
											
										}else{
											$nombre_minifig = $nombre_mini_es; 
										}	
										
																	
										
										$qb = "UPDATE coleccion SET estado = 1, fecha_actualizado = '$hoyb' where item='$item' and id_user= $id_user";// preparando la instruccion sql
									//	$qb = "UPDATE coleccion SET estado = 1, fecha_actualizado = '$hoyb', fecha_registro = '$hoyb' where item='$item' and id_user= $id_user";// preparando la instruccion sql
										
                                        //echo $qb;
										
										   if (mysqli_query($dbh, $qb)) {
										   		$tot_user = get_total_coleccion_user($cve_lego, $id_user);	
											   // echo '300'.','.'1'.','.$nombre_minifig.','.$item.','."";
											    echo '300|1|'.$nombre_minifig.'|'.$item.'||'.$tot_user; 
											} else {
												$tot_user = get_total_coleccion_user($cve_lego, $id_user);	
												//echo '300'.','.'0'.','."".','."".','.mysqli_error($dbh); 
												echo '300|0|||'.mysqli_error($dbh).'|'.$tot_user; 
										    }
									} // else Estado = 0
				
								}else{ // Si la consulta no trea registros, lo inserta activo. 
									
									

									$nombre_fig = get_data($item,$index);
									
									$data_minifig = explode('/', $nombre_fig); 
									
									$nombre_mini_es = $data_minifig[0];
									$nombre_mini_en = $data_minifig[1];
									$imagen = $data_minifig[2];
									$cve_lego = $data_minifig[3];
									
										if($idioma == 'es' || $idioma == 'ES'){
											$nombre_minifig = $nombre_mini_es;
											
										}elseif($idioma=='en' || $idioma == 'EN'){
											$nombre_minifig = $nombre_mini_en;
											
										}else{
											$nombre_minifig = $nombre_mini_es; 
										}

                                        $hoy = date("Y-m-d H:i:s");
									// preparando la instruccion sql
									$q = "INSERT INTO coleccion (id, id_user, item, estado, fecha_registro, fecha_actualizado, clave_lego) VALUES ('', '".$id_user."','".$item."', 1, '".$hoy."', '".$hoy."' , ".$cve_lego.")";						
									   if (mysqli_query($dbh, $q)) {
										   
										   $tot_user = get_total_coleccion_user($cve_lego, $id_user);					   
										    echo '300|1|'.$nombre_minifig.'|||'.$tot_user.'|'; 
										} else {

											$tot_user = get_total_coleccion_user($cve_lego, $id_user);
											echo '300|0|||'.mysqli_error($dbh).'|'.$tot_user; 
									    }
								}	
										
					}else{
							echo "<span class=\"theme_color\"> 
							<i class=\"fa fa-times\"> </i> Para poder registrar tu colección deberás acceder o registrarte en <b>BrickShelf Collector</b> 
							</span>";
					}
		
		
		
		break; 
		
		case 2: //Guardara los tags de la minifigura.
						/*
						$data = explode('-',$item );
						$serie = $data[0];
						$imagen = $data[1];
				*/
						$id = $item;
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
						if ($dbh->connect_error) {
					    	die("Connection failed: " . $dbh->connect_error);
						}
						$q = "UPDATE minifiguras SET tags = '$values' where id = $id";// preparando la instruccion sql
						
						if (mysqli_query($dbh, $q)) {
			   
						  $nombre_fig = get_data($item,$index);
						  $data_fig = explode('/', $nombre_fig); 
						  $nombre_mini_es = $data_fig[0];
						  $nombre_mini_en = $data_fig[1];
						  $foto = $data_fig[2];
						  $tags = $data_fig[4];
						  
						  //$fiel_tags = '';
						  $fiel_tags = '<textarea class="form-control" aria-label="tags" data-custom = "updated"  onfocus="editado();" value="" rows="3" id="edita_tags" onblur="save_edita(1);">'.$values.'</textarea>'; 
						  						  					    
						    echo '200|1|'.$nombre_mini_es.'|'.$item.'||'.$fiel_tags.'|'.$tags; 
						
						} else {
					      //echo '200'.','.'0'.','."".','."".','.mysqli_error($dbh);
					      
					      echo '200|0|||'.mysqli_error($dbh).'|';
					    }
					    
		break; 
		
		case 3: // Guarda Nombre de Figura
		
		/*
						$data = explode('-',$item );
						$serie = $data[0];
						$imagen = $data[1];
		*/
						$user_idiom = $_POST['user_idioma'];
						$datab = explode('|',$values);
						$nombre_es = trim($datab[0]); 
						$nombre_en = trim($datab[1]); 
				
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
						if ($dbh->connect_error) {
					    	die("Connection failed: " . $dbh->connect_error);
						}
						
						// preparando la instruccion sql

						$q = "UPDATE minifiguras SET nombre_es = '$nombre_es', nombre_en = '$nombre_en' where id = $item";		
						
						if (mysqli_query($dbh, $q)) {
			   
						  // echo $item; 
						  $datos_fig = get_data($item,$index);
						  $data_fig = explode('/', $datos_fig); 
						  $nombre_mini_es = $data_fig[0];
						  $nombre_mini_en = $data_fig[1];
						  $foto = $data_fig[2];
						  $serie = $data_fig[3];
						  
									if($user_idiom=='es'){
										$nombre_minifig = $nombre_mini_es;
									}else{
										$nombre_minifig = $nombre_mini_en; 
									}	
						
							$noms_select = get_all_info_serie($serie,$item);				  
						  
						  echo '100|1|'.$nombre_minifig.'|'.$item.'||'.$noms_select; 
						  						     
						   //echo '100'.','.'1'.','.$nombre_.$$user_idioma .','.$item.','.""; 
						
						} else {
							//echo '100'.','.'0'.','."".','."".','.mysqli_error($dbh); 
							echo '100|0|||'.mysqli_error($dbh);
							
					    }
					    
		break; 

		case 4: // Valida User
		
				$username = $_POST['username'];
			 	//$key = $_POST['key'];
			 	//$key= md5($key);
			 	$key = hash('sha256', $_POST['key']);

			 	$mantener = $_POST['mantener'];
			 	
			 	$valida_mail = filter_var($username, FILTER_VALIDATE_EMAIL); 
			 	
			 	if($valida_mail == false){
				 	$username = strtolower($username);
				 	$query = " usuario = '$username'"; 
				 	
			 	}else{
				 	
				 	$query = " correo = '$username'"; 
				 
				 }
			 	
			 	
				 	//echo $req;
					$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
							//informacion de acceso a la bd
							// Check connection
					if ($dbh->connect_error) {
						  die("Connection failed: " . $dbh->connect_error);
					}
					
				 	$q = "SELECT * FROM usuarios WHERE".$query;
				 	//var_dump($q); 
				 	
				 	 $result= $dbh->query($q);
					    if ($result->num_rows > 0) { // Si la consulta trae registro, 
						 $row= $result->fetch_assoc(); 
						 
						 $id_usuario = $row['id'];
							 	if($row['estado']== 0){
								 	
									echo '400|0|x|x|'; 
								
								}else if($row['estado']== 1){
								
									if($row['password'] != $key ){ // password no coincide
									
										if($row['password'] == 'RESET') { // Password reiniciado
																
											//echo '400'.','.'4'.','.'x'.','.'x'.','.'';
											echo '400|4|x|x|'; 
										
										}else if($row['password'] != $key){
											$passb = $_POST['key'];
										
											//echo '400'.','.'2'.','.''.','.''.','.'';
											echo '400|2|||'; 
										
											$data_send = '2'.';'.$row['usuario'].';'.$row['correo'].';'.$passb; 
											//mail_me($data_send); 
										}
									
									}else if($row['password'] == $key) { // Password coincide

										 	$qu = "SELECT * FROM configuraciones WHERE id_user = $id_usuario ";
							//			 	var_dump($q); 
										 	
										 	 $result= $dbh->query($qu);
											    if ($result->num_rows > 0) { // Si la consulta trae registro, 
												 $rowu= $result->fetch_assoc();
												 
												 	$pag_inicial = $rowu['pagina_inicial'].'.php';
												 
												 }else{
													
													$pag_inicial = 'index.php'; 
												 }
								
								// obtiene la clave cifrada del menu 
												 $nombre_mnu = $rowu['pagina_inicial'];
												 //$nombre_mnu = $pag_inicial;
												 
										 	$qmnu = "SELECT * FROM menus WHERE nombre = '$nombre_mnu' ";
										 	
										 	 $resultmnu= $dbh->query($qmnu);
											    if ($result->num_rows > 0) { // Si la consulta trae registro, 
												 $rowmnu= $resultmnu->fetch_assoc();
												 
												 	$cve_menu = $rowmnu['cve'];
												 
												 }else{
													
													$cve_menu = '79d0442db7beede17d680cdd2186df35'; // menu bienvenida
												 }												 
												 
												// $GLOBALS['user_pag_inicial_cve'] = $cve_menu;
												 
												 /////
												//$sesion = new sesion();
							    		
												$sesion->set("clave_user",$row['id']);
												$sesion->set("user_profile",$row['clave']);
							    
							    												 
										
										if($mantener==1){
											// 1 dia 
											$ttl = 60 * 60 * 24;

											ini_set("session.cookie_lifetime",$ttl);
											ini_set("session.gc_maxlifetime",$ttl);

											//ini_set("session.cookie_lifetime","7200");
											//ini_set("session.gc_maxlifetime","7200");

											session_cache_expire($ttl);												
										}elseif($mantener==0){

											$ttl = 60 * 30;

											ini_set("session.cookie_lifetime",$ttl);
											ini_set("session.gc_maxlifetime",$ttl);
											session_cache_expire($ttl);											
										}				
										

										
										// $GLOBALS['user_lifetime'] = $ttl;

										//var_dump($mantener);
										
										
							    		
							    		// envia notificacion de acceso
							    		
											$data_send = '2'.';'.$row['usuario'].';'.$row['correo'].';'.$passb; 
											//mail_me($data_send); 							    		
	
										// busca e masterpass 
										
											$qc = "SELECT * FROM masterpass WHERE id_user = '$id_usuario'";
										 	 $resultc= $dbh->query($qc);
											    if ($resultc->num_rows > 0) { // Si la consulta trae registro, 
													$rowc= $resultc->fetch_assoc(); 
													$sesion->set("user_masterpass",$rowc['token']);
												}
												 
										// busca el idioma
										
											$qd = "SELECT * FROM configuraciones WHERE id_user = '$id_usuario';";
										 	 $resultd= $dbh->query($qd);
											    
											    if ($resultd->num_rows > 0) { // Si la consulta trae registro, 
												 $rowd= $resultd->fetch_assoc(); 
												 
												 if($rowd['idioma']== ''){
													 $user_idioma = 'es';
												 }else{
													 $user_idioma = $rowd['idioma']; 
												 }
												 
												// $sesion->set("user_idioma",$rowd['idioma']);
												// $GLOBALS['user_idioma'];
												 
												 }else{
													 $sesion->set("user_idioma",'es');
												 }		

												 $sesion->set("user_lifetime",$ttl);	
												 $_SESSION['user_lifetime'] = $tttl;					

											echo '400|1|'.$cve_menu.'|'.$ttl.'|'; 
									}
									
								}else if($row['estado']== ""){ // el registro esta vacio  / no existe la cuenta
									//echo '400'.','.'3'.','.'x'.','.'x'.','.'';
									echo '400|3|x|x|'; 
								}
						 }else{
							 // error  no hay registros 
							 //echo '400'.','.'3'.','.'x'.','.'x'.','.''; 
							 echo '400|3|x|x|'; 
						 }
					
					 
		break;

		case 5: // Registra Usuario
		
					$usuario = strtolower($_POST['usuario']); 
					//$pass = md5($_POST['contrasena']);
					$pass = hash('sha256', $_POST['contrasena']);
					$correo = $_POST['correo'];
					$foto= $_POST['profile_foto'];
					$hoyb = date("Y-m-d");
					$user_ency = md5(trim($_POST['correo']));
					/// comprueba si el usuario existe ne la base de dtos 
					
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
						if ($dbh->connect_error) {
							  die("Connection failed: " . $dbh->connect_error);
						}
						
			 		$q = "SELECT * FROM usuarios WHERE correo = '$correo'";
			 		$result= $dbh->query($q);
				    if ($result->num_rows > 0) {
					    
						//echo '500'.','.'2'.','.''.','.''.','.''; // usuario existente
						echo '500|2|||'; 
					
					}else{
						
						$qb = "INSERT INTO usuarios (id, clave, correo, usuario, password, fecha_registro, estado, foto, correo_cifrado) VALUES 
									('', '0','".$correo."', '".$usuario."', '".$pass."','".$hoyb."','1','".$foto."','".$user_ency."')";// preparando la instruccion sql
						
						   if (mysqli_query($dbh, $qb)) {
							   // echo '500'.','.'1'.','.''.','.''.','.''; // usuario registrado
							    echo '500|1|||'; 
							    $data_send = '1'.';'.$usuario.';'.$correo.';'.''; 
							    //mail_me($data_send); // notifica al owner 
							    
							    
							    // notifica al usuario
							    $data_sendb = '4'.';'.$usuario.';'.$correo.';'.''; 
							    //mail_me($data_sendb); 
							    
							} else {
								//echo '500'.','.'0'.','."".','."".','.mysqli_error($dbh); 
								echo '500|0|||'.mysqli_error($dbh); 
						    }
					}
					
		break;

		case 6: // Guarda las piezas 
		
						//$data = explode('-',$item );
						//$serie = $data[0];
						//$imagen = $data[1];
							// comprueba que el ultimo caracter no sea una coma. 
							 $ultimo_c = substr($values,-1); 
							 
							 if($ultimo_c == ','){
								 $code = substr($values,0,-1);
							 }else{
								 $code = $values; 
							 }
							 
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						if ($dbh->connect_error) {
					    	die("Connection failed: " . $dbh->connect_error);
						}
						// 
						$q = "UPDATE minifiguras SET piezas = '$values' where id = $item ;";// preparando la instruccion sql
						
						if (mysqli_query($dbh, $q)) {
			   
						  $nombre_fig = get_data($item,$index);
						  $data_fig = explode('/', $nombre_fig); 
						  $nombre_mini_es = $data_fig[0];
						  $nombre_mini_en = $data_fig[1];
						  $foto = $data_fig[2];
						  						  
						    //echo '600'.','.'1'.','.$nombre_fig.','.$item.','."";
						    echo '600|1|'.$nombre_mini_es.'|'.$item.'|'; 
						} else {
					      //echo '600'.','.'0'.','."".','."".','.mysqli_error($dbh);
					      	echo '600|0|||'.mysqli_error($dbh); 
					    }
					    $dbh->close();
		break;

		case 7: // Crea Lista de Pieza por figura
		
						//$data_fa = explode('-',$item);
						//$serie = trim($data_fa[0]);
						//$imagen = trim($data_fa[1]);
				
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
						if ($dbh->connect_error) {
					    	die("Connection failed: " . $dbh->connect_error);
						}
						// 
						$q = "select * from minifiguras where id = $item";// preparando la instruccion sql
						
						//echo $q;
						
						$result= $dbh->query($q);
						if ($result->num_rows > 0) { // Si la consulta trae registro, 
							$row= $result->fetch_assoc(); 
							
							$piezas = "";
							$check_piezas = "";
							
							$piezas = $row['piezas']; 
							$data_pieza = explode(",", $piezas);
							
							//$nombre_fig = get_data($item);
							$ultimo = sizeof($data_pieza)-1;
							
									// obtiene la info del usuario actual para hacer el cruce. 
									$parameters = $id_user.';'.$item;
									//echo $item;
									$user_faltantes = get_user_faltantes($parameters); 
									//echo $user_faltantes;
									$data_f = explode('.', $user_faltantes); 
									
									////////////////////
							
							for($i=0; $i < sizeof($data_pieza);$i++) {
								if(trim($data_pieza[$i]) != ""){
									
									if($i == $ultimo){
										if($data_f[$i]==1){
											$code_fantantes .= '1';
											$chk_selected = 'checked'; 
										}else{
											$code_fantantes .= '0';
											$chk_selected = ''; 
										}
										 
									}else{
										if($data_f[$i]==1){
											$code_fantantes .= '1'.'.'; 
											$chk_selected = 'checked'; 
										}else{
											$code_fantantes .= '0'.'.';
											$chk_selected = ''; 
										}
										
									}
									
									$no = $i +1; 
									$check_piezas .= '<div class="form-check form-check-flat">
									
									<label class="form-check-label" >'.$no.'. 
									<input class="form-check-input" id="chk-'.$item.'-'.$i.'" onchange="save_edita('.$id_user.');" onclick="genera_faltantes('.$i.'); " type="checkbox" '.$chk_selected.' > '.ucfirst(trim($data_pieza[$i])).'<i class="input-helper"></i></label><input type="hidden" value="'.$parameters.'" >
									</div>';
								}
							} 	
						   // echo '700,1,'.$check_piezas.','.$code_fantantes.','."";
						    echo '700|1|'.$check_piezas.'|'.$code_fantantes.'|'; 
						
						} else {
					      //echo '700'.','.'0'.','."".','."".','.mysqli_error($dbh);
					      echo '700|0|||'.mysqli_error($dbh); 
					    }	
						
		break;
		
		case 8: // Guarda Figuras Faltantes por usuario

					if($id_user != "" or $id_user != 0){
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
						if ($dbh->connect_error) {
					    	die("Connection failed: " . $dbh->connect_error);
						}
						
						
						$q = "UPDATE coleccion SET faltantes = '$values' where item  ='$item' and id_user = '$id_user'";// preparando la instruccion sql
						
					//	echo $q;
						
						if (mysqli_query($dbh, $q)) {
			   
						  // echo $item; 
						  $nombre_fig = get_data($item,$index);
						  
						  // estado, mensaje, id. : (0-1, texto , 8834-01)
						  // echo '800'.','.'1'.','.$nombre_fig.','.$item.','."";
						   echo '800|1|'.$nombre_fig.'|'.$item.'|';
						   
					      //echo "<span class=\"theme_color\"> <i class=\"fa fa-check\"> </i> El nombre de <b>".$nombre_fig."</b> se han actualizado.</span>";
						
						} else {
							//echo '800'.','.'0'.','."".','."".','.mysqli_error($dbh);
							echo '800|0|||'.mysqli_error($dbh);  
							
					      //echo "Error: " . $q . "<br>" . mysqli_error($dbh);
					    }
					}else{
						$error = 'Para poder guardar las piezas faltantes deberá iniciar sesion'; 
						//echo '800'.','.'0'.','."".','."".','.$error;
						echo '800|0|||'.$error;  
					}
					    
		break;
		
		case 9: // Envia notificacion de Cambio de contraseña
		
			 	$correo = $_POST['correo'];
			 	//$key= md5($key);
			 	//echo $req;
			 	

							    
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
				if ($dbh->connect_error) {
					  die("Connection failed: " . $dbh->connect_error);
				}
				
			 	$q = "SELECT * FROM usuarios WHERE correo = '$correo'";
			 	$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) { // Si la consulta trae registro, 
					 $row= $result->fetch_assoc(); 
					 
					 $id_usuario = $row['id'];
						 	if($row['estado']== 0){
								//$error = 1; // cuenta desactivada 
								//echo '900'.','.'0'.','.$correo.','.$id_usuario .','.'';
								echo '900|0|'.$correo.'|'.$id_usuario.'|';
							
							}else if($row['estado']== 1){ // activada pero no recuerd pass
							//	echo '900'.','.'1'.','.$correo.','.$id_usuario.','.''; 
								echo '900|1|'.$correo.'|'.$id_usuario.'|';
							}
							
							$data_send = '3'.';'.$id_usuario.';'.$correo.';'.''; 
							//mail_me($data_send); 
							    
							
					 }else{ // si no hay resultado sdel query 
						// echo '900'.','.'2'.','.'x'.','.'x'.','.''; // no existe
						 echo '900|2|x|x|';  
					 }
					
		break;

		case 10: // Envia notificacion de Cambio de contraseña
		
			 	$correo = $_POST['correo'];
			 //	$key = $_POST['key'];
			 //	$key= md5($key);
			 	$key = hash('sha256',$_POST['key']);

			 	//echo $req;
			 	

							    
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
				if ($dbh->connect_error) {
					  die("Connection failed: " . $dbh->connect_error);
				}
				
				$qb = "UPDATE usuarios SET estado = 1, password = '$key'  where correo='$correo'";// preparando la instruccion sql
				 		 
				if (mysqli_query($dbh, $qb)) {
				    //echo '1000'.','.'0'.','.$nombre_fig.','.$item.','."";
				    echo '1000|0|'.$nombre_fig.'|'.$item.'|';
				    
				    unset($user_ref); 
				    
				    
				} else {
				    // echo '1000'.','.'1'.','."".','."".','.$qb;
				     echo '1000|1|||'.$qb;
				}
					
		break;
		
		
		case 11: // togle de cuenta
		
			 	$correo = $_POST['correo'];
			 	$accion = $_POST['accion'];
			 	//$key= md5($key);
			 	//echo $req;
			 	
			 	if($accion == 1){ // activa
				 	$value_estado = 1; 
			 	}elseif($accion == 0){ // desactiva
				 	$value_estado = 0;
			 	}

							    
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
				if ($dbh->connect_error) {
					  die("Connection failed: " . $dbh->connect_error);
				}
				
				$qb = "UPDATE usuarios SET estado = $value_estado  where correo='$correo'";// preparando la instruccion sql
				 		 
				if (mysqli_query($dbh, $qb)) {
				    //echo '1100'.','.'0'.','.$nombre_fig.','.$item.','.""; 
				    echo '1100|0|'.$nombre_fig.'|'.$item.'|';
				  //  unset($user_ref); 
				    
				    
				} else {
				     //echo '1100'.','.'1'.','."".','."".','.$qb; 
				     echo '1100|1|||'.$qb;
				}
					
		break;

		case 12: // Busca las imagenes de la carpeta para generar la asociacion nombre imagen (step 4)
    
			 //	$archivos = $_POST['archivos'];
			 	$serie = $_POST['serie'];
			 	$path = 'minifig/'.$serie.'/';
			 	
			 	
			 	$archivos = scandir($path);
			 	
			 	
			 	$no_archivos = count($archivos);	
			 	//echo $no_archivos;
			 	
			 	if($no_archivos > 1){
				 	
					for($i=0; $i< $no_archivos ; $i++ ){
					 	$nombre_archivo .= $archivos[$i].';';
				 	}	 	
				 	//echo '1200'.','.'0'.','.$nombre_archivo.','.$no_archivos.','.'';
				 	echo '1200|0|'.$nombre_archivo.'|'.$no_archivos.'|';	
				 				 	
				 }else{
					 $msg = 'No hay archivos para esta serie, cargue los archivos para continuar.'; 
				 	//echo '1200'.','.'1'.','.$nombre_archivo.','.$item.','.'No hay archivos para esta serie, cargue los archivos para continuar.';
				 	echo '1200|1|'.$nombre_archivo.'|'.$item.'|'.$msg;
			 	}
			 	
			 	
								
		break;

		case 13: // Guarda la Serie nueva, 1. registro en tabla series; 2. registro de minifiguras. 
		
    		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
						
			$nombre_serie = $_POST['nombre_serie'];
			$clave_serie = $_POST['clave_serie'];
			$fecha_serie = $_POST['fecha_serie'];
			$color_serie = $_POST['color_serie'];
			$nombresfig_serie = $_POST['nombresfig_serie'];
			$tipo_serie = $_POST['tipo_serie'];
			$asign_serie = $_POST['asign_serie'];
			$total_serie = $_POST['total_serie'];
			$estado_serie = $_POST['estado_serie'];
			$precio_serie = $_POST['precio_serie'];
			$moneda_serie = $_POST['moneda_serie'];
			$premium = $_POST['premium'];
			
			$ext = array();
			$n_es = array();
			$n_en = array();
			
			// Separa las imagenes
				$ultimo_i = substr($asign_serie,-1); 
							 
				if($ultimo_i == ';'){
					$img = substr($asign_serie,0,-1);
				}else{
					$img = $asign_serie; 
				}
				
				// separa cada imagen
				$data_img = explode(';', $img); 
				
				for($j=0; $j<= sizeof($data_img); $j++){
					// separa el nombre y la extension
					$data_ext = explode('.', $data_img[$j]);
					$nombre_base = $data_ext[0]; 
					$nombre_ext = $data_ext[1]; 
					array_push($ext, $data_ext[0]);
					
				}
				
				//echo var_dump($ext); 
			
			// Verifica y quita el ultiimo caracteri si es un ";"
				$ultimo_c = substr($nombresfig_serie,-1); 
							 
				if($ultimo_c == ';'){
					$nam = substr($nombresfig_serie,0,-1);
				}else{
					$nam = $nombresfig_serie; 
				}
			
			// Separa los nombres de cada personaje
			
			$data = explode(';', $nam); 
			
			for($i=0 ; $i<= sizeof($data) ; $i++ ){
				
				// separa los nombres en ES y EN
				$datab = explode(',', $data[$i]); 
				$nom_es = $datab[0]; 
				$nom_en = $datab[1];
				
				array_push($n_es, $datab[0]);
				array_push($n_en, $datab[1]);
			}
			
			$hoyb = date("Y-m-d H:i:s"); 
			// Trabaja en L abase de datos: 
			
				// Busca el registros en la tabla series, para comprobar que no esta duplicado
				
				$q = "SELECT * FROM series WHERE clave_lego = '$clave_serie'";
			 	$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) { // Si la consulta trae registro, 
					 $row= $result->fetch_assoc(); 
					 
					 	$qc = "UPDATE series SET estado = '$estado_serie' where clave_lego= '$clave_serie' ";// preparando la instruccion sql					 
					
						if (mysqli_query($dbh, $qc)) {
							//echo '1300|1|||';
						} else {
							//echo '1300|0|||'.mysqli_error($dbh).' '.$qc;
						}
					
					}else{
						
							$q = "INSERT INTO series (id, clave_lego, nombre, no_serie, color, tipo, estado, consecutivo, fecha_lanzamiento, premium, precio_premium, moneda_premium) VALUES ('','".$clave_serie."','".$nombre_serie."',".$clave_serie.",'".$color_serie."',".$tipo_serie.", ".$estado_serie.", ".$clave_serie.", '".$fecha_serie."', ".$premium." ,".$precio_serie." , '".$moneda_serie."' )";
											
							if (mysqli_query($dbh, $q)) {
								
								//echo '1300'.','.'2'.','.$clave_serie.','.$item.','.""; // Serie Guardada
								
									      //echo "<span class=\"theme_color\"><i class=\"fa fa-check\"> </i> Minifigura <b>".$nombre_fig."</b> agregada a la colección.</span>";
								$reg .= 'reg=1;';

							} else {
							//	echo '1300'.','.'3'.','."".','."".','.$q; // error al guardar
								$reg .= 'reg=0;';
							}
						
						
					}


         echo '1300|6|||'.$reg;

			/// Trabaja con los datos para insertar las figuras
			
			
			$res_save_fig = ""; 
			
			for($j= 0; $j< $total_serie ; $j++){
				
				$current_image = trim($ext[$j]); 
				$current_name_es = trim($n_es[$j]); 
				$current_name_en = trim($n_en[$j]); 
				

				
				$qa = "SELECT * from minifiguras where cve_lego = '".$clave_serie."' and nombre_es = '".$current_name_es."'; ";
				
				$qspy = $qa.'<br>';
				
				$resultb = ""; 
				$resultb= $dbh->query($qa);
				
					if ($resultb->num_rows > 0) { // Si la consulta trae registro, 
						$rowb= $resultb->fetch_assoc(); 
					 
							//$res_save_fig = 'La figura <b>'.$current_name_es.' / '.$current_name_en.'</b> ya se encuentra registrada. <br>';
							$error_flag = intval($error_flag + 1); 
							
							
							
							$qc = "UPDATE minifiguras set imagen = '$current_image' where nombre_es = '$current_name_es';"; 
							mysqli_query($dbh, $qc);
							
							//echo $qc;
							
					}else{
							
							$qb = "INSERT INTO minifiguras (id, nombre_es, nombre_en, cve_lego, imagen, tags, estado, no_folleto, piezas, fecha_registro) VALUES ('','".$current_name_es."', '".$current_name_en."','".$clave_serie."', '".$current_image."', '',1, '".$current_image."' , 'cabeza, torso, pies, brazo derecho, brazo izquierdo, cabello', '".$hoy."' )";
											
							if (mysqli_query($dbh, $qb)) {
								//echo '1300'.','.'2'.','.$clave_serie.','.$item.','.""; // Serie Guardada
								$res_save_fig .= 'La figura <b>'. $current_name_es.' / '.$current_name_en .'</b> se ha guardado.<br>';
								
								$error_flag .=  intval($error_flag + 0);  
									      //echo "<span class=\"theme_color\"><i class=\"fa fa-check\"> </i> Minifigura <b>".$nombre_fig."</b> agregada a la colección.</span>";
							} else {
								
								$res_save_fig .= 'Error: '. mysqli_error($dbh);
								$error_flag .=  intval($error_flag + 1); 
								//echo '1300'.','.'3'.','."".','."".','.mysqli_error($dbh); // error al guardar figuras
							}
						
						//echo $error_flag;
					}
			}
			
			if($error_flag >= 1 ){
				//echo '1300'.','.'5'.','.''.','.''.','.$res_save_fig; // error al guardar las figuras
				echo '1300|5|||'.$res_save_fig;
			}else{
				//echo '1300'.','.'4'.','.$res_save_fig.','.''.','.''; // guardado exitoso
				echo '1300|4|'.$res_save_fig.'||';
			}
				

								
		break;
		
		case 14: // activa o desactiva serie
		
		//echo '1400'.','.'1'.','."Hola Mundo".','."".','.''; 
		
			$item_id = $_POST['item_id'];
			$estado_mant = $_POST['estado']; 
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$q = "SELECT * FROM series WHERE id = $item_id";// preparando la instruccion sql
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$row= $result->fetch_assoc();

										$estado = $row['estado']; 
										$serie = $row['nombre'];						

									
									if($estado_mant ==2) { //
										
										$qb = "UPDATE series SET estado = 2 where id= $item_id";// preparando la instruccion sql
										$status = "activado en modo mantenimiento"; 

									}elseif($estado_mant ==3) { //
										
										$qb = "UPDATE series SET estado = 3 where id= $item_id";// preparando la instruccion sql
										$status = "activado en teaser"; 

									}elseif($estado_mant ==0){
														 
									 	if($estado == 1){ // Si el esado del registro es 1, cambialo a cero
						 	
								 			$qb = "UPDATE series SET estado = 0 where id= $item_id ";// preparando la instruccion sql
								 			$status = "desactivado"; 
	 
										}elseif($estado != 1) { //De lo contrario cambialo a 1
											
											$qb = "UPDATE series SET estado = 1 where id= $item_id";// preparando la instruccion sql
											$status = "activado"; 
	
										}
																		
									}elseif($estado_mant == 99){
						 	
								 			$qb = "UPDATE series SET estado = 99 where id= $item_id ";// preparando la instruccion sql
								 			$status = "actualizado"; 
																		
									} // else Estado = 0									
									
										if (mysqli_query($dbh, $qb)) {
											//echo '1400'.','.'1'.','.$serie.','.$status.','."";
											echo '1400|1|'.$serie.'|'.$status.'|';
											
										} else {
											//echo '1400'.','.'0'.','."".','."".','.mysqli_error($dbh); 
											echo '1400|0|||'.mysqli_error($dbh);
										}
										
	
								
								
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error';
									echo '1400|0|||error';
								}
		
		break;  

		case 15: // actualiza color serie
		
		$item_id = $_POST['item_id'];
		$color = $_POST['val']; 
		$flanzamiento = $_POST['flanzamiento']; 
		$nombre = $_POST['nombre']; 
		$tipo = $_POST['tipo'];
		$precio = $_POST['precio'];
		$moneda = $_POST['moneda'];
		$descuento = $_POST['desc'];
		$color_txt = $_POST['color_txt'];
		$colorb = $_POST['colorb']; 
		
		$hoy = date("Y-m-d H:i:s");
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
					$qb = "UPDATE series SET color= '$color', precio_premium = $precio, moneda_premium = '$moneda', fecha_lanzamiento = '$flanzamiento', tipo = $tipo, nombre = '$nombre', descuento = $descuento, fecha_actualizado = '$hoy', color_text = '$color_txt', colorb= '$colorb'  where id= $item_id";// preparando la instruccion sql
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '1500'.','.'1'.','.$serie.','."".','.""; 
						echo '1500|1|'.$serie.'||';
					} else {
						//echo '1500'.','.'0'.','.$qb.','."".','.''; 
						echo '1500|0|'.$qb.'||';
					}
								
		
		break; 
		
		case 16: // Elimina Serie

			$item_id = $_POST['item_id'];
			$serie_code= $_POST['serie'];
		//$color = $_POST['val']; 
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
					$qb = "DELETE FROM series WHERE id =  $item_id";// preparando la instruccion sql
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '1600|1|'.$serie.'||';
												
							$qd = "DELETE FROM minifiguras WHERE cve_lego = '$serie_code' ";
							
							$path_serie = 'minifig/'.$serie_code; 
						/*	if (!is_dir($path_serie)) {
							    rmdir($path_serie);
							}
						*/
						// Elimina directorio con imagenes del serie eliminada
						rrmdir($path_serie);
							
							if (mysqli_query($dbh, $qd)) {
								echo '1600|1|'.$serie.'||';
							} else {
								echo '1600|0|'.$qd.'||';
							}
							
						
						
					} else {
						//echo '1600'.','.'0'.','.$qb.','."".','.'';
						echo '1600|0|'.$qb.'||';
					}
					
		break; 
		
		case 17: // Cambia Perfil Usuario
			$item_id = $_POST['item_id'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$q = "SELECT * FROM usuarios WHERE id = $item_id";// preparando la instruccion sql
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$row= $result->fetch_assoc();
								
									$clave = $row['clave']; 
									$usuario = $row['correo'];
				 
								 	if($clave == 1){ // Si el esado del registro es 1, cambialo a cero
					 	
							 			$qb = "UPDATE usuarios SET clave = 0 where id= $item_id ";// preparando la instruccion sql
							 			$status = "usuario"; 
 
									}elseif($clave ==0) { //De lo contrario cambialo a 1
										
										$qb = "UPDATE usuarios SET clave = 1 where id= $item_id";// preparando la instruccion sql
										$status = "administrador"; 

									} // else Estado = 0
									
										if (mysqli_query($dbh, $qb)) {
											//echo '1700'.','.'1'.','.$usuario.','.$status.','."";
											echo '1700|1|'.$usuario.'|'.$status.'|'; 
										} else {
											//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '1700|0|||'.mysqli_error($ddh);
										}
								
								
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error'; 
									echo '1700|0|||error';
								}
		break; 


		case 18: // Activa desactiva Usuario

			$item_id = $_POST['item_id'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$q = "SELECT * FROM usuarios WHERE id = $item_id";// preparando la instruccion sql
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$row= $result->fetch_assoc();
								
									$estado = $row['estado']; 
									$usuario = $row['correo'];
				 
								 	if($estado == 1){ // Si el esado del registro es 1, cambialo a cero
					 	
							 			$qb = "UPDATE usuarios SET estado = 0 where id= $item_id ";// preparando la instruccion sql
							 			$status = "desactivado"; 
 
									}elseif($estado ==0) { //De lo contrario cambialo a 1
										
										$qb = "UPDATE usuarios SET estado = 1 where id= $item_id";// preparando la instruccion sql
										$status = "activado"; 

									}elseif($estado ==99) { //De lo contrario cambialo a 1
										
										$qb = "UPDATE usuarios SET estado = 0 where id= $item_id";// preparando la instruccion sql
										$status = "descativado"; 

									} // else Estado = 0
									
										if (mysqli_query($dbh, $qb)) {
											//echo '1800'.','.'1'.','.$usuario.','.$status.','.""; 
											echo '1800|1|'.$usuario.'|'.$status.'|';
										} else {
											//echo '1800'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '1800|0|||'.mysqli_error($dbh);
										}
								
								
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error';
									echo '1800|0|||No Existe Usuario';
								}
		break; 
				
				
		case 19: // reset pass usuario
		
		$item_id = $_POST['item_id'];
		//$color = $_POST['val']; 
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
					$qb = "UPDATE usuarios SET password= 'RESET' where id= $item_id";// preparando la instruccion sql
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '1900'.','.'1'.','.$serie.','."".','.""; 
						echo '1900|1|'.$serie.'||';
					} else {
						//echo '1900'.','.'0'.','.$qb.','."".','.'';
						echo '1900|0|'.$qb.'||';
					}
								
		
		
		break;
		
		case 20: // Elimina usuario 
		
			$item_id = $_POST['item_id'];
		//$color = $_POST['val']; 
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}

			$q = "SELECT * FROM usuarios WHERE id = $item_id";// preparando la instruccion sql
			$resulta= $dbh->query($q);
			
			if ($resulta->num_rows > 0) { // Si la consulta trae registro, cambia el estado
				$row= $resulta->fetch_assoc();

				// Desactiva colecciones
				$qb = "UPDATE coleccion SET estado = 0 where id_user = $item_id";// preparando la instruccion sql
					//$status = "activado"; 
					if (mysqli_query($dbh, $qb)) {
						//echo '1800|1|'.$usuario.'|'.$status.'|';
						$res_col = $res_col + 0;
					} else {
						//echo '1800|0|||'.mysqli_error($dbh);
						$res_col= $res_col + 1;
					}

				// Desactiva sets

				$qc = "UPDATE sets SET estado = 0 where id_user= $item_id";// preparando la instruccion sql
				//$status = "activado"; 
				if (mysqli_query($dbh, $qc)) {
					//echo '1800|1|'.$usuario.'|'.$status.'|';
					$res_set = $res_set + 0;
				} else {
					//echo '1800|0|||'.mysqli_error($dbh);
					$res_set= $res_Set + 1;
				}

					/////// Soft Elimina 

					$qe = "UPDATE usuarios SET estado = 999 where id = $item_id";// preparando la instruccion sql
					//$status = "activado"; 
					if (mysqli_query($dbh, $qe)) {
						//echo '1800|1|'.$usuario.'|'.$status.'|';
						$res_set = $res_set + 0;
					} else {
						//echo '1800|0|||'.mysqli_error($dbh);
						$res_set= $res_set + 1;
					}

				//Elimina Usuario
			
					//$qd = "DELETE FROM usuarioss WHERE id = $item_id";// preparando la instruccion sql
																		
					//if (mysqli_query($dbh, $qd)) {
						//echo '2000|1|'.$qb.'||';
						//echo '2000|1|'.$res_col.'/'.$res_set.'||';
					//} else {
						//echo '2000|0|'.$qd.'||';
					//}
			}else{
					//echo '1400'.','.'0'.','."".','."".','.'error';
					echo '2000|0|||Usuario No encontrado '.$q;
			}
                    // Elimina los permisos del perfil

                    
		
		break; 

		case 21: // Busca la direccion basado en el CP con la api de sepomex
		
			$cp_busca = $_POST['cp'];

				$response = request_sepomex_api($cp_busca);
				
				//var_dump($response);
				
				if($response){
					
					$res = json_decode($response, true);

					$bandera_error = $res["response"]['error'][0];
					
					if($bandera_error== TRUE){
						$code_error = $res["response"]['code_error'][0];
						$msg_error = $res["response"]['error_message'][0];
						
						if($code_error==2){
							
							echo '2100|0|'.$cp_busca.'||'.$msg_error.'.';
						}
						
						
						echo '2100|0|'.$cp_busca.'||Error al consultar.';
						
					}else{
						

					
						$latitud = $res["response"]['asentamiento'][0];
						
						$no_col = count($res["response"]['asentamiento']); 
						//echo $no_col;
						$ops_col="";
						
						for($j=0; $j< $no_col; $j++){
							
							$ops_col .='<option value="'.$res["response"]['asentamiento'][$j].'" > '.$res["response"]['asentamiento'][$j].'</option>';
							
						}
						
						if($no_col>1){
							$col = '<select class="form-control col-md-12" onchange="save_direccion();" id="dir_colonia" ><option value="X">Elije una...</option> '.$ops_col.'</select>';
						}else{
							$col = '<textarea autocapitalize="sentences" onblur="save_direccion();" autocomplete="off"  autocorrect="on" maxlength="50" name="displayName" placeholder="Colonia" spellcheck="true" type="text" disabled dir="auto" disabled id="dir_colonia" data-focusable="true" class="form-control col-md-12" value="">'.$latitud.'</textarea>';
						}
						
						$delegacion = $res["response"]['municipio'];
						$estado = $res["response"]['estado'];
						$ciudad = $res["response"]['ciudad'];
						
					//	echo $latitud;
					
						$data_col = $col.'--'.$delegacion.'--'.$estado.'--'.$ciudad;
						
						// notificamos exito 
						
						//echo '2100'.','.'1'.','.$data_col.','."".','."";
						echo '2100|1|'.$data_col.'||';
					
					}
					
				}else{

										
					//echo '2100'.','.'0'.','.$cp_busca.','."".','.'El códigp postal ingresado no es válido';
					echo '2100|0|'.$cp_busca.'||El Código Postal '.$cp_busca.' no es válido.';
					
				}
				
		
		break; 

		case 22: // Guarda Direccion
		
			$id_user = $_POST['id_user'];
			$calle = $_POST['calle'];
			$no_int = $_POST['no_int'];
			$no_ext = $_POST['no_ext'];
			$cp = $_POST['cp'];
			$colonia = $_POST['colonia'];
			$delegacion = $_POST['delegacion'];
			$estado = $_POST['estado'];

				
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
								if ($dbh->connect_error) {
							    	die("Connection failed: " . $dbh->connect_error);
								}
								// comprueba si ya existe el registro
								$q = "SELECT * FROM personal WHERE id_user = $id_user ";// preparando la instruccion sql
								 $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si hay resultados, actualiza la info del usuario
																 
								 	$qb = "UPDATE personal SET dir_estado = '$estado', dir_calle = '$calle', dir_no_ext = '$no_ext', dir_no_int= '$no_int', dir_col= '$colonia', dir_mun_del = '$delegacion', dir_cp= '$cp' where id_user ='$id_user'";// preparando la instruccion sql
					 		 
							   			if (mysqli_query($dbh, $qb)) {
						   					    //echo '2200'.','.'1'.','.$id_user.','.''.','."";
						   					    echo '2200|1|'.$id_user.'||';
						   				} else {
											    //echo '2200'.','.'0'.','."".','."".','.mysqli_error($dbh);
											    echo '2200|0|||'.mysqli_error($dbh); 
									    }
								
								}else{ // si no hay resultados, inserta un registro nuevo.
								
									$qb = "INSERT INTO personal (id, id_user, nombre, apellido, fecha_nac, dir_calle, dir_estado, dir_no_ext, dir_no_int, dir_col, dir_mun_del, dir_extra, dir_cp) VALUES ('', $id_user, '','', '', '".$calle."', '".$estado."', '".$no_ext."', '".$no_int."', '".$colonia."', '".$delegacion."', '', '".$cp."' )";						
							   			if (mysqli_query($dbh, $qb)) {
						   					    //echo '2200'.','.'1'.','.$id_user.','.''.','."";
						   					    echo '2200|1|'.$id_user.'||'; 
						   				} else {
											    //echo '2200'.','.'0'.','."".','."".','.mysqli_error($dbh);
											    echo '2200|0|||'.mysqli_error($dbh); 
									    }
								
								}
					

		
		break;


		case 23: // Guarda Direccion
		
			$id_user = $_POST['id_user'];
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$f_nac = $_POST['f_nac'];
			$usuario = $_POST['usuario'];
			$pass_new = $_POST['pass_new'];
			$idioma_p = $_POST['idioma_p'];
			$vista_fig = $_POST['vista_fig'];
			$code_series = $_POST['code_series'];
			$pagina_inicial = $_POST['pagina_inicial'];
			$series_opcionales = $_POST['series_op'];
			$vista_m = $_POST['vista_m'];
			$vista_s = $_POST['vista_s'];
			
			
			
			// decodifica el estatus de las series elegidas por el usuario. 
			
			//$data_series = explode('.', $code_series); 
			
			/*
			$s_8909 = $data_series[0];
			$s_71014 = $data_series[1];
			$s_41775 = $data_series[2];
			$s_71361 = $data_series[3];
			$s_71386 = $data_series[4];
			$s_43101 = $data_series[5];
			*/
			
			/// AUtomatic serie opcionales 
			
			$data_series = explode('.', $code_series); 
			$data_opcionales = explode(';', $series_opcionales);
			
			for($i=0 ; $i< count($data_opcionales); $i++){
				if($data_opcionales[$i] != '' and $data_series[$i] != '' ){
				$q_c .= ' estado_'.$data_opcionales[$i].'='.$data_series[$i].','; 
				
				$code_op .= $data_opcionales[$i].'-'.$data_series[$i].';';
				}
			}
			
			$q_cc = substr($q_c, 0, -1);
			$code_series = substr($code_series, 0, -1);
			
			//$qs = "UPDATE configuraciones SET ".$q_cc." where id_user = $id_user";	

								
			////////
				
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
			///// Actualiza informacion de perfil 
			
								// comprueba si ya existe el registro
				$q = "SELECT * FROM personal WHERE id_user = $id_user ";// preparando la instruccion sql
					$result= $dbh->query($q);
							    
					if ($result->num_rows > 0) { // Si hay resultados, actualiza la info del usuario
						$qb = "UPDATE personal SET nombre = '$nombre', apellido = '$apellido', fecha_nac = '$f_nac' where id_user ='$id_user'";
					}else{
						$qb = "INSERT INTO personal (id, id_user, nombre, apellido, fecha_nac ) VALUES ('', $id_user, '".$nombre."', '".$apellido."', '".$f_nac."' )";	
					}
					
					$full_name = $nombre.' '.$apellido;
					
					if (mysqli_query($dbh, $qb)) {
						
																
			//guarda opcionales
						// XXXX-1;XXXX-0; 
						
						$data_col = explode(';', $code_op);
						$count = count($data_col);
						
						for($i=0; $i <= $count; $i++){
							$save_opcionales .= save_serie_opcional($id_user,$data_col[$i]);
						}
						
						
						if($save_opcionales > 0){
							$estado = 2;
						}else{
							$estado = 0;
						}
						/*
						
						$qs_b = "UPDATE configuraciones SET estado_opcionales = '$code_op' where id_user = $id_user";


						if (mysqli_query($dbh, $qs_b)) {
							$estado = 2; 
						} else {
							$estado = 0; 
						}
						*/
						
						
												
			//guarda el masterpass 
						if($pass_new != "X"){
							
							//$contrasenia = md5($pass_new);
							$contrasenia = hash('sha256',$pass_new);

							//$qc = ", password = '$contrasenia'";
							$qc = "UPDATE usuarios SET usuario = '$usuario', nombre= '$full_name', password = '$contrasenia'  where id ='$id_user'";
							$sta = 'A';
							
						}else{
							$qc = "UPDATE usuarios SET usuario = '$usuario', nombre= '$full_name' where id ='$id_user'";
							$sta = 'B';
						}
								
					 							 		
						if (mysqli_query($dbh, $qc)) {
							$estado = 2; 
						} else {
							$estado = 0; 
						}
						
			// Guarda el idioma
						
						
						// comprueba que exista el parametro IDIOMA
						$qtt = "SELECT * FROM configuraciones WHERE id_user = $id_user";// preparando la instruccion sql
						$result= $dbh->query($qtt);
							    
						if ($result->num_rows > 0) {

							if( $idioma_p != 'XX'){
								$qi = "UPDATE configuraciones SET idioma = '$idioma_p' where id_user = $id_user";
								//var_dump($qd); 
							}
													
						}else{
							$qi = "INSERT INTO configuraciones(id, id_user, idioma ) VALUES ('',$id_user,'$idioma_p')";

						}

						if (mysqli_query($dbh, $qi)) {
							$estado = 2; 
						} else {
							$estado = 0; 
						}					

		// VISTAS
						$qtt = "SELECT * FROM configuraciones WHERE id_user = $id_user";// preparando la instruccion sql
						$result= $dbh->query($qtt);
							    
						if ($result->num_rows > 0) {

							if( $vista_m != 'XX'){
								$qm = "UPDATE configuraciones SET vista_mosaico_minifig = $vista_m where id_user = $id_user";
								//var_dump($qd); 
							}

							if( $vista_s != 'XX'){
								$qs = "UPDATE configuraciones SET vista_mosaico_sets = $vista_s where id_user = $id_user";
								//var_dump($qd); 
							}
																				
						}else{
							$qm = "INSERT INTO configuraciones (id, id_user, vista_mosaico_minifig ) VALUES ('',$id_user,$vista_m)";
							$qs = "INSERT INTO configuraciones (id, id_user, vista_mosaico_sets ) VALUES ('',$id_user,$vista_s)";
						}
						
																	
						if (mysqli_query($dbh, $qm)) {
							$estado = 2; 
						} else {
							$estado = 0; 
						}

						if (mysqli_query($dbh, $qs)) {
							$estado = 2; 
						} else {
							$estado = 0; 
						}
						
		// comprueba que exista el parametro PAGINA INICIAL
						$qtt = "SELECT * FROM configuraciones WHERE id_user = $id_user";// preparando la instruccion sql
						$result= $dbh->query($qtt);
							    
						if ($result->num_rows > 0) {

							if( $pagina_inicial != 'XX'){
								$qp = "UPDATE configuraciones SET pagina_inicial = '$pagina_inicial' where id_user = $id_user";
								//var_dump($qd); 
							}elseif( $pagina_inicial != ''){
								$qp = "UPDATE configuraciones SET pagina_inicial = '$pagina_inicial' where id_user = $id_user";
							}
													
						}else{
							$qp = "INSERT INTO configuraciones(id, id_user, pagina_inicial ) VALUES ('',$id_user,'$pagina_inicial')";

						}
						
																	
						if (mysqli_query($dbh, $qp)) {
							$estado = 2; 
						} else {
							$estado = 0; 
						}						
						
						
			// Guarda el tema 
						
						// comprua que exista CSS
						$qt = "SELECT * FROM configuraciones WHERE id_user = $id_user";// preparando la instruccion sql
						$result= $dbh->query($qt);
							    
						if ($result->num_rows > 0) {

							if( $vista_fig != 'XX'){
								$qe = "UPDATE configuraciones SET css_figuras = '$vista_fig' where id_user = $id_user";
								//var_dump($qd); 
							}else{
								$qe = "UPDATE configuraciones SET valor = 'default' where id_user = $id_user";
							}
													
						}else{
							$qe = "INSERT INTO configuraciones(id, id_user, css_figuras) VALUES ('',$id_user,'$vista_fig')";

						}
												
							if (mysqli_query($dbh, $qe)) {
								$estado = 2; 
							} else {
								$estado = 0; 
							}					////
								
						//echo '2300'.','.'1'.','.mysqli_error($dbh).','.''.','.'';
						echo '2300|1|'.mysqli_error($dbh).'||'; 
					} else {
						//echo '2300'.','.'0'.','."".','."".','.mysqli_error($dbh);
						echo '2200|0|||'.mysqli_error($dbh);
					}
					

		
		break; 

	case 24: // Valida User
		
				$user_mail = $_POST['user_mail'];
			 	//echo $req;
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
				if ($dbh->connect_error) {
					  die("Connection failed: " . $dbh->connect_error);
				}
			 	$q = "SELECT * FROM usuarios WHERE correo = '$user_mail'";
			 	
			 	$result= $dbh->query($q);
				    if ($result->num_rows > 0) { // Si la consulta trae registro, 
					 $row= $result->fetch_assoc(); 
					 	
					 	$id_usuario = $row['id'];
					 															
						ini_set("session.cookie_lifetime","30");
						ini_set("session.gc_maxlifetime","30");
						session_cache_expire(60);
						//$sesion = new sesion();
						    		
						$sesion->set("clave_user",$row['id']);
						$sesion->set("user_profile",$row['clave']);

									// busca e masterpass 
									
						$qc = "SELECT * FROM masterpass WHERE id_user = '$id_usuario'";
						$resultc= $dbh->query($qc);
						if ($resultc->num_rows > 0) { // Si la consulta trae registro, 
							$rowc= $resultc->fetch_assoc(); 
											 
							$sesion->set("user_masterpass",$rowc['token']);
											 
						}
									
									
						//echo '2400'.','.'1'.','.'x'.','.'x'.','.'';
						echo '400|1|x|x|';
						
					}else{
						//echo '2400'.','.'3'.','.'x'.','.'x'.','.'';
						echo '400|3|x|x|'; 
									
					}
		break;	

	case 25: // Guarda Menu
	
	$title = $_POST['title'];
	$cve = $_POST['clave'];
	$file = $_POST['file'];
	$id_padre = $_POST['id_padre'];
	$id = $_POST['id'];
	$nivel = $_POST['nivel'];
	$icono = $_POST['icono'];
	$orden = $_POST['orden'];
	$color = $_POST['color'];
	$tipo = $_POST['tipo'];
	
	$pos = strpos($file,'.');


	
	if($pos>=0){
		
		$dta_file = explode('.', $file);
		$name = $dta_file[0];
		$ext = $dta_file[1];
		
		$nombre_f = $name;
		
	}else{
		
		$nombre_f = $file;
	}
		
		if($nivel != 999){
			$nvo_n = ' nivel='.$nivel;
		}else{
			$nvo_n = '';
		}
				
			 	//echo $req;
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
				if ($dbh->connect_error) {
					  die("Connection failed: " . $dbh->connect_error);
				}
			 	

			 	$qb = "UPDATE menus SET cve = '$cve', link = '$file', nombre = '$nombre_f', mnu_padre = $id_padre, icon= '$icono', title = '$title', orden = $orden, color = '$color', tipo_menu = $tipo, ".$nvo_n." where id=$id ";// preparando la instruccion sql
					 		 
					if (mysqli_query($dbh, $qb)) {
						//echo '2500'.','.'1'.','.''.','.''.','."";
						echo '2500|1|||';
					} else {
						//echo '2500'.','.'0'.','."".','."".','.mysqli_error($dbh);
						echo '2500|0|||'.mysqli_error($dbh);
					}
	break;	


	case 26: // Nuevo Menu
	
	$id = $_POST['id'];
	$cve = $_POST['clave'];
	$file = $_POST['file'];
	$id_padre = $_POST['id_padre'];
	$title = $_POST['title'];
	$nombre = $_POST['nombre'];
	$link = $_POST['link'];
	$nivel = $_POST['nivel'];
	$tipo = $_POST['tipo'];
					
			 	//echo $req;
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
				if ($dbh->connect_error) {
					  die("Connection failed: " . $dbh->connect_error);
				}
			 	
			if($tipo==0){
				$miArchivo = fopen($link, "w") or die("No se puede abrir/crear el archivo!");
				fclose($miArchivo);
			}
			 
	$qb = "INSERT INTO menus (id, nombre, link, estado, cve, title, mnu_padre, icon, profile_permission, nivel, orden, tipo_menu) VALUES ('', '".$nombre."','".$link."', 1, '".$cve."', '".$title."', ".$id_padre.", 'gear', 0, ".$nivel.",0, ".$tipo." )";
							 		 		 
					if (mysqli_query($dbh, $qb)) {
						//echo '2600'.','.'1'.','.''.','.''.','."";
						echo '2600|1|||';
					} else {
						//echo '2600'.','.'0'.','."".','."".','.mysqli_error($dbh);
						echo '2600|0|||'.mysqli_error($dbh); 
						//echo '2600|0|||'.$qb; 
					}
	break;		


	case 27: // Nuevo Menu
	
	$id = $_POST['id'];
					
			 	//echo $req;
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
				if ($dbh->connect_error) {
					  die("Connection failed: " . $dbh->connect_error);
				}
			 	

	
								// comprueba si ya existe el registro
								 $q = "SELECT * FROM menus WHERE id = $id ";// preparando la instruccion sql
							
							   
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
								 $row= $result->fetch_assoc(); // trae el valor del campo estado
								 
								 $estado = $row['estado']; 
								 $title = $row['title'];
								 $id_papa = $row['mnu_padre'];
				 
								 	if($estado == 1){ // Si el esado del registro es 1, cambialo a cero										 
					 	
							 			$qb = "UPDATE menus SET estado = 0  where id = $id ";// preparando la instruccion sql
							 			
							 			$qc = "UPDATE menus SET estado = 0  where mnu_padre = $id ";
							 			mysqli_query($dbh, $qc); 

 
							 			
									}elseif($estado==0) { //De lo contrario cambialo a 1	
										$qb = "UPDATE menus SET estado = 1 where id=$id";// preparando la instruccion sql
										
										$qc = "UPDATE menus SET estado = 1  where mnu_padre = $id ";
							 			mysqli_query($dbh, $qc);

							 			$qa = "UPDATE menus SET estado = 1  where id = $id_papa ";
							 			mysqli_query($dbh, $qa);
							 			
									}
								
									
									if (mysqli_query($dbh, $qb)) {
						   				    //echo '2700'.','.'1'.','.$title.','.''.','."";
						   				    echo '2700|1|'.$title.'||';
						   			} else {
										    //echo '2700'.','.'0'.','."".','."".','.mysqli_error($dbh);
										    echo '2700|0|||'.mysqli_error($dbh); 
									}
									}
			

	break;
	
	
		case 28: // Elimina Menu

			$id = $_POST['id'];
		//$color = $_POST['val']; 
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
			$qa = "UPDATE menus SET mnu_padre = 9999 where mnu_padre = $id";
			mysqli_query($dbh, $qa);
			
			//unlink('prueba.html');
								 
			
					$qb = "DELETE FROM menus WHERE id = $id";// preparando la instruccion sql
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '2800'.','.'1'.','.$serie.','."".','."";
						echo '2800|1|'.$serie.'||';
					} else {
						//echo '2800'.','.'0'.','.$qb.','."".','.'';
						echo '2800|0|'.$qb.'||';
					}
		break;
		
		
		case 29: // Trae Info del Set


			$id = $_POST['id'];
			$user_id = $_POST['user_id'];
		//$color = $_POST['val']; 
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
			$q = "select * from sets where id = $id and id_user = $user_id";
				$result= $dbh->query($q);
						if ($result->num_rows > 0) { // Si la consulta trae registro, 
							$row= $result->fetch_assoc(); 
							
							$tema_actual = $row['id_tema'];
							$origen_actual = $row['id_origen'];
							
							$list_temas = generaListTemas($tema_actual);
							$list_origen = generaListOrigen($origen_actual);
							//$list_temas = '';
							//$list_origen = '';
							//var_dump($list_origen);
							
							$lista_temas = '<option value="0">Elije...</option>'.$list_temas;
							
							// verifica si el archivo existe 
							//$path_set = 'assets/images/sets/'.$user_id.'/';
							$path_set = 'assets/images/sets/';
							$foto_set = $row['item_foto']; 
							
							$list_edo_c = genera_select_edo_col($row['set_edo']);
							$list_edo_col = '<option value="0">Elije...</option>'.$list_edo_c;
							//$list_edo_col .= genera_select_edo_col($row['set_edo']);

							$list_presenta = genera_select_presentacion($row['id_presentacion']);
							$list_presenta_col = '<option value="0">Elije...</option>'.$list_presenta;
							/// Genera etiqueta 

							//$lbl_bar = genera_barcode_label_clavelego($rowb['cve_lego'],1,$user_id);

							//// Comprueba foto

							$data_f = explode('.',$row['item_foto']);
							$nom_f = $data_f[0]; 

							$fotos = comprueba_image($nom_f,'set');
							$ruta_foto = $path_set.$fotos;

							$grupo_set = getinfogrupo($row['grupo']); 
							$data_grupo = explode('|',$grupo_set);
							$nom_grupo = $data_grupo[0];
							$ubicacion = $data_grupo[2];

							$ubicacion_set = getinfoubicacion($ubicacion);
							$data_ubic = explode('|',$ubicacion_set);
							$nombre_ubic = $data_ubic[0];

                            $nombre_set= str_replace('-', ' ', $row['nombre']);
											 
							$data = $nombre_set.'-'.$row['piezas'].'-'.$row['cve_lego'].'-'.$lista_temas.'-'.$row['precio'].'-'.$row['anio_public'].'-'.$id.'-'.$fotos.'-'.$ruta_foto.'-'.$btn_show.'-'.$list_origen.'-'.$row['no_minifig'].'-'.$row['id_tema'].'-'.$nom_grupo.'-'.$row['cantidad'].'-'.$nombre_ubic.'-'.$list_edo_col.'-'.$list_presenta_col.'-'.$row['codebar_box'];
							
							echo '2900|1|'.$data.'|x|';
											 
						}else{
							//echo '2900'.','.'0'.','.'x'.','.'x'.','.$q;
							echo '2900|0|x|x|'.$q;
						}
		


		break; 
		
		case 30: // Actualiza set

/*
				var params = 'id='+ id;
				params += '&cve='+ cve;	
				params += '&nombre='+ nombre;
				params += '&tema='+ tema;
				params += '&piezas='+ piezas;
				params += '&precio='+ precio;
				params += '&anio='+ anio;
	*/
			$user_id = $_POST['id_user'];
			$id = $_POST['id'];
			$cve = $_POST['cve'];
			$nombre = $_POST['nombre'];
			$tema = $_POST['tema'];
			$piezas = $_POST['piezas'];
			$precio = $_POST['precio'];
			$anio = $_POST['anio'];
			$foto = $_POST['foto'];
			$origen = $_POST['origen'];
			$minifigs = $_POST['minifigs'];
			$cantidad = $_POST['cantidad'];
			$edo_col = $_POST['edo_col'];
			$edo_presenta = $_POST['edo_presenta'];
			 $nombre_nuevo = str_replace("'","", $nombre);
			 $codebar_box = $_POST['codebar_box'];
			
			if($foto==''){
				$image = 'cover_logo.png'; 
			}else{
				$image = $_POST['foto']; 
			}
		
			 	//echo $req;
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
				if ($dbh->connect_error) {
					  die("Connection failed: " . $dbh->connect_error);
				}
			 	

			 	$qb = "UPDATE sets SET cve_lego = $cve, nombre = '$nombre_nuevo', id_tema = $tema, piezas = $piezas, id_origen= $origen, precio = '$precio', anio_public = $anio, item_foto= '$image', no_minifig = $minifigs, cantidad = $cantidad, set_edo = $edo_col, id_presentacion = $edo_presenta, codebar_box = '$codebar_box' where id=$id and id_user = $user_id  ";// preparando la instruccion sql
			 	
			 	//var_dump($qb); 
			 	
			 	$q_nuevo = str_replace(',', '|', $qb); 
			 	//$q_nuevo = str_replace("'","|", $qb);
					 		 
					if (mysqli_query($dbh, $qb )) {
						//echo '3000'.','.'1'.','.''.','.''.','.'';
						echo '3000|1|||';
					} else {
						//echo '3000'.','.'0'.','."".','."".','.$qb;
						//echo '3000'.','.'0'.','."".','."".','.mysqli_error($dbh);
						echo '3000|0|||'.$qb;
					}
		break; 		

		case 31: // Activa desactiva Usuario

			$item_id = $_POST['item_id'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$q = "SELECT * FROM temas_sets WHERE id = $item_id";// preparando la instruccion sql
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$row= $result->fetch_assoc();
								
									$estado = $row['estado']; 
									$usuario = $row['nombre'];
				 
								 	if($estado == 1){ // Si el esado del registro es 1, cambialo a cero
					 	
							 			$qb = "UPDATE temas_sets SET estado = 0 where id= $item_id ";// preparando la instruccion sql
							 			$status = "desactivado"; 
 
									}elseif($estado ==0) { //De lo contrario cambialo a 1
										
										$qb = "UPDATE temas_sets SET estado = 1 where id= $item_id";// preparando la instruccion sql
										$status = "activado"; 

									} // else Estado = 0
									
										if (mysqli_query($dbh, $qb)) {
											//echo '3100'.','.'1'.','.$usuario.','.$status.','."";
											echo '3100|1|'.$usuario.'|'.$status.'|';
										} else {
											//echo '3100'.','.'0'.','."".','."".','.mysqli_error($dbh); 
											echo '3100|0|||'.mysqli_error($dbh);
										}
								
								
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error';
									echo '3100|0|||Error: No Existe Este Tema'; 
								}
		break; 
		
		case 32: // Elimina Tema Sets 
		
			$item_id = $_POST['item_id'];
		//$color = $_POST['val']; 
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
					$qb = "DELETE FROM temas_sets WHERE id =  $item_id";// preparando la instruccion sql
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '3200'.','.'1'.','.$serie.','."".','."";
						echo '3200|1|'.$serie.'||';
					} else {
						//echo '3200'.','.'0'.','.$qb.','."".','.'';
						echo '3200|0|'.$qb.'||';
					}
		
		break;

		case 33: // Actualiza Tema
		
		$item_id = $_POST['item_id'];
		$color = $_POST['val']; 
		$colorb = $_POST['valb'];
		$colorc = $_POST['valc'];
		$nombre = $_POST['nombre']; 
		$logo = $_POST['logo'];
		
		$hoy = date("Y-m-d H:i:s");
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
					$qb = "UPDATE temas_sets SET color= '$color', nombre = '$nombre', logo = '$logo', color_alt = '$colorb', color_txt = '$colorc', fecha_actualizado ='$hoy' where id= $item_id";// preparando la instruccion sql
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '3300'.','.'1'.','.$nombre.','."".','."";
						echo '3300|1|'.$nombre.'||';
					} else {
						//echo '3300'.','.'0'.','.$qb.','."".','.'';
						echo '3300|0|'.$qb.'||';
					}
								
		
		break; 
		
		case 34: // guarda set


			$user_id = $_POST['id_user'];
			//$id = $_POST['id'];
			$cve = $_POST['cve'];
			$nombre = $_POST['nombre'];
			$tema = $_POST['tema'];
			$piezas = $_POST['piezas'];
			$precio = $_POST['precio'];
			$anio = $_POST['anio'];
			$foto = $_POST['foto'];
			$figs = $_POST['figs'];
			$cantidad = $_POST['cantidad'];
			$edo_set = $_POST['estado_set'];
			$origen = $_POST['origen'];
			$codebar_box = $_POST['codebar_box'];
			//$origen = 0;
 
			if($foto==''){
				$image = 'cover_logo.png'; 
			}else{
				$image = $_POST['foto']; 
			}
		
            //genera QR set publico

                $codigo = genera_barcode_codigo($cve,0,$user_id);

                $qr_png= genera_qrcode_set($codigo);
                $qr_webp = convert_to_webp($codigo);


            ///
			 	//echo $req;
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
				if ($dbh->connect_error) {
					  die("Connection failed: " . $dbh->connect_error);
				}
			 	
								// comprueba si ya existe el registro
								$q = "SELECT * FROM sets WHERE cve_lego = $cve and id_user = $user_id";// preparando la instruccion sql
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$row= $result->fetch_assoc();
								
									$nombre_set = $row['nombre'];
									$msg = 'El set '.$nombre_set.' ya se encuentra registrado.';
				 
								 	//echo '3400'.','.'2'.','.$msg.','."".','.'';
								 	echo '3400|2|'.$msg.'||';
								
								
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error'; 
				
									$hoy = date("Y-m-d");
									$hoy_hora = date('Y-m-d G:i:s');
									
		//$qb = "INSERT INTO sets (id, id_user, cve_lego, piezas, nombre, id_tema, precio, anio_public, fecha_add, estado, item_foto, id_origen, no_minifig, cantidad, set_edo) VALUES ('', ".$user_id.", ".$cve.", ".$piezas.", '".$nombre."', ".$tema.", ".$precio.", ".$anio." , '".$hoy_hora."' , 1, '".$foto."', ".$origen.", ".$figs.", ".$cantidad.",".$edo_set.")";  $codebar_box
		$qb = "INSERT INTO sets (id, id_user, cve_lego, piezas, nombre, id_tema, precio, anio_public, fecha_add, estado, item_foto, id_origen, no_minifig, cantidad, set_edo, codebar_box) VALUES ('', ".$user_id.", ".$cve.", ".$piezas.", '".$nombre."', ".$tema.", ".$precio.", ".$anio." , '".$hoy_hora."' , 1, '".$foto."', ".$origen.", ".$figs.", ".$cantidad.",".$edo_set.",'".$codebar_box."')";
		
		
									$q_nuevo = str_replace(',', ':', $qb); 			
										
										
					
									if (mysqli_query($dbh, $qb)) {
										
										//echo '3400'.','.'1'.','.$nombre.','."".','.'';
										echo '3400|1|'.$nombre.'||';  
									} else {
										//echo '3400'.','.'0'.','."".','."".','.mysqli_error($dbh);
										//echo '3400|0|||'.mysqli_error($dbh);
										echo '3400|0|||'.$qb;
									}
										
								}
		 	
					 		 

		break;
		
		case 35: // Elimina set
		
			$item_id = $_POST['item_id'];
			$id_user = $_POST['id_user'];
			$fotoe = $_POST['fotoe'];
			
			$path = 'assets/images/sets/'.$id_user.'/'; 
			$file_e = $path.$fotoe; 
			
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
					
					$qb = "DELETE FROM sets WHERE id = $item_id and id_user = $id_user ";// preparando la instruccion sql
																		
					if (mysqli_query($dbh, $qb)) {
						
						//unlink($path.$fotoe);
						
						//echo '3500'.','.'1'.','.$serie.','.''.','."";
						echo '3500|1|'.$serie.'||';
					} else {
						//echo '3500'.','.'0'.','.$qb.','."".','.'';
						echo '3500|0|'.$qb.'||';
					}
		
		break;

		case 36: // Save Foto inifigura
		
					/*
						$data = explode('-',$item );
						$serie = $data[0];
						$imagen = $data[1];
					*/	
						$nva_foto = $_POST['foto'];
						
						$datab = explode('.', $nva_foto); 
						$nombre_file = $datab[0]; 
						$exten = $datab[1]; 
						
					
				
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
						if ($dbh->connect_error) {
					    	die("Connection failed: " . $dbh->connect_error);
						}
						
						// preparando la instruccion sql

						$q = "UPDATE minifiguras SET imagen = '$nombre_file' where id = $item";
						
				//	echo($q); 		
						
						if (mysqli_query($dbh, $q)) {
			   
						  // echo $item; 
						  $nombre_fig = get_data($item,$index);
						  
						   //echo '3600'.','.'1'.','.$nombre_fig.','.$item.','."";
						   echo '3600|1|'.$nombre_fig.'|'.$item.'|';
						
						} else {
							//echo '3600'.','.'0'.','."".','."".','.mysqli_error($dbh);
							echo '3600|0|||'.mysqli_error($dbh);
							
					    }
		
		break;
		
		case 37: // Guarda Otra informacion de la minigigura almacenados en variable Values
				// 1. NO en Folleto
				
				
						$datab = explode(';', $values);
						$folleto = $datab[0];
								
				
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
						if ($dbh->connect_error) {
					    	die("Connection failed: " . $dbh->connect_error);
						}
						
						// preparando la instruccion sql

						$q = "UPDATE minifiguras SET no_folleto = $folleto where id = $item ";
						
				//	echo($q); 		
						
						if (mysqli_query($dbh, $q)) {
			   
						  // echo $item; 
						  $nombre_fig = get_data($item, $index);
						  
						   //echo '3700'.','.'1'.','.$nombre_fig.','.$item.','."";
						   	echo '3700|1|'.$nombre_fig.'|'.$item.'|'; 
						
						} else {
							//echo '3700'.','.'0'.','."".','."".','.mysqli_error($dbh);
							echo '3700|0|||'.mysqli_error($dbh); 
							
					    }
		
		break;

		case 38: // Agregar Minifigura a una serie en especifico
		
		$serie = $_POST['serie'];
		$nombre_es= $_POST['nombre_es'];
		$nombre_en= $_POST['nombre_en'];
		$foto= $_POST['foto'];
		$tags= $_POST['tags'];
		
		$data_foto = explode('.',$foto); 
		
		$foto_nombre = $data_foto[0];
		
				// 1. NO en Folleto
				
				
						$datab = explode(';', $values);
						$folleto = $datab[0];
								
				
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
						if ($dbh->connect_error) {
					    	die("Connection failed: " . $dbh->connect_error);
						}
						
						// preparando la instruccion sql

						$q = "INSERT INTO minifiguras (id, nombre_es, nombre_en, cve_lego, imagen, tags, estado, no_folleto, piezas) VALUES ('','$nombre_es','$nombre_en', '$serie', '$foto_nombre', '$tags',1, 1,'cabeza, torso, pies, brazo derecho, brazo izquierdo, cabello' );";
						
												
						if (mysqli_query($dbh, $q)) {
						    //echo '3800'.','.'1'.','.$nombre_fig.','.$item.','."";
						    echo '3800|1|'.$nombre_fig.'|'.$item.'|'; 
						} else {
							//echo '3800'.','.'0'.','."".','."".','.mysqli_error($dbh);
							echo '3800|0|||'.mysqli_error($dbh);  
						}
		
		break;		

		case 39: // Elimina Minifigura

			$item_id = $_POST['id'];
		//$color = $_POST['val']; 
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
					$qb = "DELETE FROM minifiguras WHERE id =  $item_id";// preparando la instruccion sql
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '3900'.','.'1'.','.$serie.','."".','."";
						
						// Elimina de la coleccion de los usuarios. 
						
						$qb = "DELETE FROM coleccion WHERE item = $item_id";// preparando la instruccion sql
							if (mysqli_query($dbh, $qb)) {
							$mensaje = ' y de TODAS las colecciones.'; 
							}else{
								
							}
						
						/////
						
						echo '3900|1|'.$serie.'|'.$mensaje.'|'; 
					} else {
						//echo '3900'.','.'0'.','.$qb.','."".','.'';
						echo '3900|0|'.$qb.'||';  
					}
		break;
			

		case 40: // Elimina Serie

			$path = $_POST['archivo'];
		//$color = $_POST['val']; 
			//$path = 'minifig/'.$foto;
		
			//var_dump($path);

			unlink($path); 
			
	                 	        if(file_exists($path)) {
								       //echo "The file exists";
								       //echo '4000'.','.'0'.','.$serie.','."".','."";
								       echo '4000|0|'.$serie.'||'; 
								} else {
								       //echo "The file does not exist";
								       //echo '4000'.','.'1'.','.$serie.','."".','."";
								       echo '4000|1|'.$serie.'||'; 
								}			
			

		break; 						

		case 41: // busca las colecciones donde esta registrada la figura
			$id= $_POST['id'];
			//$serie = $_POST['serie'];
			//$imagen = $_POST['foto'];
			//$item = $serie.'-'.$imagen; 

			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
				if ($dbh->connect_error) {
					  die("Connection failed: " . $dbh->connect_error);
				}
			 	
								// comprueba si ya existe el registro
								$q = "SELECT * FROM coleccion WHERE item = '$id'";// preparando la instruccion sql
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									
									
									while($row= $result->fetch_assoc()){
										$users .= $row['id_user'].';';
													
										$data_user = busca_user($row['id_user']); 													
										$info = explode('--', $data_user); 
										$error =  $info[0];
										$nombre = $info[1];
										$correo = $info[2];
										$username = $info[3];
										$foto = $info[4];
													
										if($username!= ''){
											$usuarios .= '<span class="text-muted border-bottom" style="display: block; clear:both; margin: 1px 0px;  " ><i class="fa fa-user" ></i> '.$username.' </span>';
										}
													
													//$inversion = $inversion + $row['precio'];
								}
								
								$btn = '<button class="btn btn-danger" onclick="elimina_item(\''.$id.'\'); "> <i class="fa fa-trash"  ></i> Eliminar </button>';
								
								 	//echo '4100'.','.'1'.','.$usuarios.','.$btn.','.'';
								 echo '4100|1|'.$usuarios.'|'.$btn.'|';
								
								}else{
									$btn = '<button class="btn btn-danger" onclick="elimina_item(\''.$id.'\'); "> <i class="fa fa-trash"  ></i> Eliminar </button>';
									$usuarios .= '<span class="text-muted border-bottom" style="display: block; clear:both; margin: 1px 0px;  " >- Sin registro de usuarios -  </span>';
									//echo '4100'.','.'0'.','."".','."".','.'error';
									echo '4100|1|'.$usuarios.'|'.$btn.'|';
								}
		
			

		break; 	

		
		case 42: // busca las colecciones donde esta registrada la figura

		$serie = $_POST['serie'];
		
		$result = labels_admin_fotos($serie); 
		echo '4200|1|'.$result.'||';

		break; 	
		

		case 43: // Guarda LAs figuras extras de cada usuario

		$compartir = $_POST['compartir'];
		$extras = $_POST['extras'];
		$id_user = trim($_POST['id_user']); 
		
					if($id_user != "" or $id_user != 0){
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
						if ($dbh->connect_error) {
					    	die("Connection failed: " . $dbh->connect_error);
						}
						
						
						$q = "UPDATE coleccion SET no_extra = $extras, mostrar_mkt = $compartir where item = '$item' and id_user= '$id_user'";// preparando la instruccion sql
						
						//echo $q;
						
						if (mysqli_query($dbh, $q)) {
			   
						  // echo $item; 
						  $nombre_fig = get_data($item, $index);
						  
						  // estado, mensaje, id. : (0-1, texto , 8834-01)
						  // echo '800'.','.'1'.','.$nombre_fig.','.$item.','."";
						   echo '4300|1|'.$nombre_fig.'|'.$item.'|';
						   
					      //echo "<span class=\"theme_color\"> <i class=\"fa fa-check\"> </i> El nombre de <b>".$nombre_fig."</b> se han actualizado.</span>";
						
						} else {
							//echo '800'.','.'0'.','."".','."".','.mysqli_error($dbh);
							echo '4300|0|||'.mysqli_error($dbh);  
							
					      //echo "Error: " . $q . "<br>" . mysqli_error($dbh);
					    }
					}else{
						$error = 'Para poder guardar las piezas faltantes deberá iniciar sesion'; 
						//echo '800'.','.'0'.','."".','."".','.$error;
						echo '4300|0|||'.$error;  
					}
					   
		
		break;

		case 44: // Elimina Serie

			$foto = $_POST['archivo'];
		//$color = $_POST['val']; 
			$path = 'assets/images/logos/'.$foto;
		
			unlink($path); 
			
	                 	        if(file_exists($path)) {
								       //echo "The file exists";
								       //echo '4000'.','.'0'.','.$serie.','."".','."";
								       echo '4400|0|'.$serie.'||'; 
								} else {
								       //echo "The file does not exist";
								       //echo '4000'.','.'1'.','.$serie.','."".','."";
								       echo '4400|1|'.$serie.'||'; 
								}			
			

		break; 

		case 45: // busca las colecciones donde esta registrada la figura

				//$serie = $_POST['serie'];
				
				$result = labels_admin_logos(); 
				echo '4500|1|'.$result.'||';
		
				break; 
				
		
		
		case 46: // busca las colecciones donde esta registrada la figura
		
		//		$serieb = $_POST['serie'];
				
		//		$all_data_minifigb = get_all_info_serie($serieb);
				
		//		$selectb = '<select class="col-sm-2 form-control" onchange="cambia_minifig();" id="select_minifig" ><option value="0">Elije...</option> '.$all_data_minifigb.'</select>'; 
				
				
				//echo '4600|1|'.$selectb.'||';

		break; 

		case 47: // activa o desactiva premium
		
		//echo '1400'.','.'1'.','."Hola Mundo".','."".','.''; 
		
			$item_id = $_POST['item_id'];
			//$estado_mant = $_POST['estado']; 
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$q = "SELECT * FROM series WHERE id = $item_id";// preparando la instruccion sql
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$row= $result->fetch_assoc();

										$estado = $row['estado']; 
										$serie = $row['nombre'];
										$premium = $row['premium'];						

									
									if($premium ==0) { //
										
										$qb = "UPDATE series SET premium = 1 where id= $item_id";// preparando la instruccion sql
										$status = "Premium activado."; 

									}elseif($premium ==1) { //
										
										$qb = "UPDATE series SET premium = 0 where id= $item_id";// preparando la instruccion sql
										$status = "Premium desactivado"; 																
									} // else Estado = 0									
									
										if (mysqli_query($dbh, $qb)) {
											//echo '1400'.','.'1'.','.$serie.','.$status.','."";
											echo '4700|1|'.$serie.'|'.$status.'|';
											
										} else {
											//echo '1400'.','.'0'.','."".','."".','.mysqli_error($dbh); 
											echo '4700|0|||'.mysqli_error($dbh);
										}
										
	
								
								
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error';
									echo '4700|0|||error';
								}
		
		break;	
		
		case 48:
		
		$id_user = $_POST['id_user'];
		$serie = $_POST['serie'];
		
		/// Info Recibo 
		
		$id_recibo = $_POST['id_recibo'];
		$prod_descripcion = $_POST['prod_descripcion'];
		$prod_nombre = $_POST['prod_nombre'];
		$moneda = $_POST['moneda'];
		$importe = $_POST['importe'];
		$id_venta = $_POST['id_venta'];
		$id_pago = $_POST['id_pago'];
		$nombre_comp = $_POST['nombre_comp'];
		$correo_comp = $_POST['correo_comp'];
		$tel_comp = $_POST['tel_comp'];
		$transaction = $_POST['transaction'];
		$cupon = $_POST['cupon'];
		

		
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
						if ($dbh->connect_error) {
					    	die("Connection failed: " . $dbh->connect_error);
						}
						
						$hoy = date("Y-m-d");
						$hoy_hora = date('Y-m-d G:i:s');
						// preparando la instruccion sql

						$q = "select * from transactions where id_user = $id_user and clave_lego = $serie and estado < 99";
						$result= $dbh->query($q);
						
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$row= $result->fetch_assoc();

																										
						$qb = "UPDATE transactions SET estado_pago = 1, f_pago = '$hoy', estado = 1, id_recibo = '$id_recibo', h_pago = '$hoy_hora' where id_user= $id_user and clave_lego= $serie, id_cupon = $cupon;";
						// preparando la instruccion sql
				
									
										if (mysqli_query($dbh, $qb)) {
											//echo '1400'.','.'1'.','.$serie.','.$status.','."";
											echo '4800|1|'.$serie.'|'.$status.'|';
											
										} else {
											//echo '1400'.','.'0'.','."".','."".','.mysqli_error($dbh); 
											echo '4800|0|||'.mysqli_error($dbh);
										}
										
	
								
								
								}else{
									

						$qb = "INSERT into transactions (id, id_user, f_pago, estado_pago, estado, clave_lego, id_recibo, h_pago, id_cupon) VALUES ('', $id_user, '$hoy',1,1,$serie, '$id_recibo', '$hoy_hora', $cupon)";
						
									
										if (mysqli_query($dbh, $qb)) {
											//echo '1400'.','.'1'.','.$serie.','.$status.','."";
											//echo '4800|1|'.$serie.'|'.$status.'|';
											
										} else {
											//echo '1400'.','.'0'.','."".','."".','.mysqli_error($dbh); 
											echo '4800|0|||'.mysqli_error($dbh);
										}



								}

//var_dump($qb);

								// Garda el Recibo 
								
$qr = "INSERT into recibos (id, id_recibo, id_user, id_venta, fecha_venta, cantidad_prod, nombre_prod, descripcion_prod, precio_prod, moneda_prod, nombre_comp, correo_comp, telefono_comp, id_pago, estado_recibo, hora_venta) VALUES ('', '$id_recibo', $id_user, '$id_venta', '$hoy_hora', 1, '$prod_nombre', '$prod_descripcion', $importe, '$moneda', '$nombre_comp', '$correo_comp', '$tel_comp', '$id_pago', 1, '$hoy_hora')"; // preparando la instruccion sql
							
							if (mysqli_query($dbh, $qr)) {
									//echo '4800|1|'.$qr.'|'.$status.'|';
											
								} else {
									echo '4800|0|||'.mysqli_error($dbh);
								}
								
								//// Genera el log de la transaccion. 
								
								$anio = date('Y');
								$mes = date('m');
								$path_dir = 'logs/transactions/'; 
								$path_dir_anio = 'logs/transactions/'.$anio.'/';
								$path_dir_mes = 'logs/transactions/'.$anio.'/'.$mes.'/';
								
								$comp_dir = is_dir($path_dir_anio);
								
								if($comp_dir== true){
									$comp_dir_mes = is_dir($path_dir_mes);
									
									if($comp_dir_mes== true){
									
									}else{
										mkdir($path_dir_mes, 0777);	
									}
																
								}else{
									mkdir($path_dir_anio, 0777);
								}
								
								
								$name_file = $id_recibo.'_'.$hoy.'_'.$id_user.'.txt';
								$path_log_file = $path_dir_mes.$name_file; 
								
								$logFile = fopen($path_log_file , 'a') or die("Error creando archivo");
								fwrite($logFile, "\n".date("d/m/Y H:i:s")."\n\n".$transaction) or die("Error escribiendo en el archivo");
								fclose($logFile);


							
		break;

		case 49: // Cambia etado recibo
		
		$estado = $_POST['estado'];
		$id = $_POST['item_id'];
		$id_recibo = $_POST['id_recibo'];
				
			
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

						if ($dbh->connect_error) {
					    	die("Connection failed: " . $dbh->connect_error);
						}


						$q = "UPDATE recibos SET estado_recibo = $estado where id = $id";
		
						
						if (mysqli_query($dbh, $q)) {

						  // 	echo '4900|1|'.$id_recibo.'|'.$estado.'|'; 
						   	
							$q = "UPDATE transactions SET estado = $estado where id_recibo = '$id_recibo' ";
																				
							if (mysqli_query($dbh, $q)) {
								echo '4900|1|'.$item_id.'||';
															
							} else {
								//echo '1600'.','.'0'.','.$qb.','."".','.'';
								echo '4900|0|'.$qb.'||'.mysqli_error($dbh);
							}
						
						} else {
							echo '4900|0|||'.mysqli_error($dbh); 
							
					    }
		
		break;

		case 50: // Elimina el recibo
		
		$item_id = $_POST['item_id'];
		$id_recibo = $_POST['id_recibo'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
					$qb = "UPDATE recibos SET estado_recibo = 99 where id = $item_id";
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '5000|1|'.$item_id.'||';

							$q = "UPDATE transactions SET estado = 99 where id_recibo = '$id_recibo' ";
																				
							if (mysqli_query($dbh, $q)) {
								echo '5000|1|'.$item_id.'||';
															
							} else {
								//echo '1600'.','.'0'.','.$qb.','."".','.'';
								echo '5000|0|'.$qb.'||'.mysqli_error($dbh);
							}
												
					} else {
						//echo '1600'.','.'0'.','.$qb.','."".','.'';
						echo '5000|0|'.$qb.'||'.mysqli_error($dbh);
					}
					
					//Mensaje: Unknown column '0CV10257AC410593R' in 'where clause'

		break;

		case 51: // Elimina el recibo
		
		$act = $_POST['act'];
		
		$param = $_POST['param'];
		//$nuevo_correo = $_POST['nuevo_correo'];
		
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			if($act==1){

					$qb = "SELECT * from usuarios where usuario = '$param' ";
					$result= $dbh->query($qb);
									
			}elseif($act==2){


					$qb = "SELECT * from usuarios where correo = '$param' ";
					$result= $dbh->query($qb);				
			}

					var_dump($qb);
							    
					if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
					$row= $result->fetch_assoc();
						$user_duplicado = 1; 							
					}else{
						$user_duplicado = 0;
						
					}
					
					
					if($user_duplicado==1){
						
						$campo = 'usuario'; 
						echo '5100|1|'.$qb.'|'.$campo.'|';
						
					}elseif($user_duplicado==0){
						
						$campo = 'correo'; 
						echo '5100|2|'.$qb.'|'.$campo.'|';
					}else{
						echo '5000|0|'.$qb.'||'.mysqli_error($dbh);
					}					
					
					//echo '5000|0|'.$qb.'||'.mysqli_error($dbh);	
					//Mensaje: Unknown column '0CV10257AC410593R' in 'where clause'

		break;

		case 52: // Guarda el nombre de la foto de perfil en la base de usuarios
								
				
				$id = $_POST['id'];
				$foto = $_POST['foto'];
				
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
						if ($dbh->connect_error) {
					    	die("Connection failed: " . $dbh->connect_error);
						}
						
						// preparando la instruccion sql

						$q = "UPDATE usuarios SET foto = '$foto' where id = $id ";
	
						
						if (mysqli_query($dbh, $q)) {
						  //$nombre_fig = get_data($item);
						   	echo '5200|1|||'; 
						
						} else {
							echo '5200|0|||'.mysqli_error($dbh); 
							
					    }
		
		break;

		case 53: // Guarda nuevo tema
								
			$nombre = trim($_POST['nombre']);
			$logo =$_POST['logo'];
			$color = $_POST['color'];
			$color_txt = '100,100,100'; 
				
			 	//echo $req;
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
				if ($dbh->connect_error) {
					  die("Connection failed: " . $dbh->connect_error);
				}
			 	
			 $hoy = date("Y-m-d H:i:s");
			 
	$qb = "INSERT INTO temas_sets (id, nombre, color,logo, estado, fecha_registro, color_txt ) VALUES ('','".$nombre."','".$color."', '".$logo."', 1, '".$hoy."', '".$color_txt."' )";
							 		 		 
					if (mysqli_query($dbh, $qb)) {
						//echo '2600'.','.'1'.','.''.','.''.','."";
						echo '5300|1|||';
					} else {
						//echo '2600'.','.'0'.','."".','."".','.mysqli_error($dbh);
						echo '5300|0|||'.mysqli_error($dbh); 
					}
		
		break;
		
		case 54: // Cambia Perfil Usuario
			
			$item_id = $_POST['item_id'];
			$perfil = $_POST['perfil'];
			$correo = $_POST['correo'];
			$usuario = $_POST['user'];
			$correo_cifrado = md5($correo);
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$q = "SELECT * FROM usuarios WHERE id = $item_id";// preparando la instruccion sql
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$row= $result->fetch_assoc();
								
									
										$qb = "UPDATE usuarios SET clave = $perfil, correo = '$correo', usuario= '$usuario', correo_cifrado = '$correo_cifrado' where id= $item_id";// preparando la instruccion sql
																			
										if (mysqli_query($dbh, $qb)) {
											//echo '1700'.','.'1'.','.$usuario.','.$status.','."";
											echo '5400|1|'.$usuario.'|'.$status.'|'; 
										} else {
											//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '5400|0|||'.mysqli_error($ddh);
										}
								
								
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error'; 
									echo '5400|0|||No se ha encontrado el Usuario';
								}
		break; 

		case 55: // Guarda sugerencias
			
			$user = $_POST['user'];
			$cve = $_POST['cve'];
			$tema = $_POST['tema'];
			$tipo= $_POST['tipo'];
			$detalles= $_POST['detalles'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
				
				
				// Comprueba que no haya mas de 5 activas
				
					$qa = "SELECT * FROM sugerencias WHERE id_user = $user and estado between 1 and 4;";
			 		$resulta= $dbh->query($qa);
				    if ($resulta->num_rows > 0) {
					    
					    $total_sug = $resulta->num_rows;
					    
					    if($total_sug>= $sug_activas){
						    
						    $bandera_continua = 0; 
							echo '5500|3|||'; 
							
					    
					    }else{
						    						
							$bandera_continua = 1; 
					    }
					    

					
					}else{
						$bandera_continua = 1; 
					}
					
					
					if($bandera_continua==1){
			 		
			 		$q = "SELECT * FROM sugerencias WHERE id_user = $user and cve_lego = $cve;";
			 		$result= $dbh->query($q);
				    if ($result->num_rows > 0) {
					    
					    
					    if($total_sug>=5){
						    
						    echo '5500|3|||'; 
					    }else{
						    						
						echo '5500|2|||'; 
					    }
					    

					
					}else{
						
						$hoy = date("Y-m-d");
						$hoyc = date("Y-m-d H:i:s");
						
						$data = explode('-', $hoy);
						$a = $data[0];
						$m = $data[1];
						$d = $data[2];
						
						$folio = $d.$m.$a.'-'.$user.'-'.date("s");
						
						$qb = "INSERT INTO sugerencias (id, id_user, fecha_envio, cve_lego, id_tema, tipo, detalles, estado,fecha_completa,folio) VALUES ('', ".$user.",'".$hoy."','".$cve."', ".$tema.", '".$tipo."','".$detalles."','2','".$hoyc."','".$folio."')";// preparando la instruccion sql
						
						   if (mysqli_query($dbh, $qb)) {
							   // echo '500'.','.'1'.','.''.','.''.','.''; // usuario registrado
							    echo '5500|1|||'; 
											    
							} else {
								//echo '500'.','.'0'.','."".','."".','.mysqli_error($dbh); 
								echo '5500|0|||'.mysqli_error($dbh); 
						    }
					}
					
					}							


		break; 		

		case 56: // Guarda el nombre de la foto de perfil en la base de usuarios
								
				
				$id = $_POST['id'];
				$act = $_POST['act'];
				
				
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$q = "SELECT * FROM sugerencias WHERE id = $id";// preparando la instruccion sql
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$row= $result->fetch_assoc();
								
									$estado = $row['archivado'];
									
									if($estado==1){
										$nvo_edo = 0;
									}else{
										$nvo_edo = 1;
									}
									
										if($act==1){ // Archivar 
											$qb = "UPDATE sugerencias SET archivado = $nvo_edo where id= $id";// preparando la instruccion sql
										}elseif($act==2){ // cancelar
											$qb = "UPDATE sugerencias SET archivado = 0, estado = 0 where id= $id";// preparando la instruccion sql
										}
										
																			
										if (mysqli_query($dbh, $qb)) {
											//echo '1700'.','.'1'.','.$usuario.','.$status.','."";
											echo '5600|1|'.$nvo_edo.'|'.$act.'|'; 
										} else {
											//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '5600|0|||'.mysqli_error($ddh);
										}
								
								
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error'; 
									echo '5600|0|||No se ha encontrado sugerencia';
								}
		
		break;

		case 57: // Elimina Sugerencia
		
		$item_id = $_POST['item_id'];
		$id_sug = $_POST['id_sug'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
					$qb = "UPDATE sugerencias SET estado = 99 where id = $item_id";
																		
					if (mysqli_query($dbh, $qb)) {
						
						echo '5700|1|'.$item_id.'||';
																			
					} else {
						//echo '1600'.','.'0'.','.$qb.','."".','.'';
						echo '5700|0|'.$qb.'||'.mysqli_error($dbh);
					}
					
					//Mensaje: Unknown column '0CV10257AC410593R' in 'where clause'

		break;

		case 58: // Actualiza sugerencia admin
			
			$id = $_POST['id'];
			$respuesta = $_POST['respuesta'];
			$estado = $_POST['estado'];
			
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$q = "SELECT * FROM sugerencias WHERE id = $id";// preparando la instruccion sql
							    $result= $dbh->query($q);
							    
							    
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$row= $result->fetch_assoc();
									
									$hoy = date("Y-m-d H:i:s");
									$respuesta_ant = $row['respuesta'];
									
									$resp_rec = $respuesta.'--'.$hoy.'|'.$respuesta_ant;
								
									
									
										$qb = "UPDATE sugerencias SET estado = $estado, respuesta = '$resp_rec', fecha_respuesta= '$hoy' where id= $id";// preparando la instruccion sql
																			
										if (mysqli_query($dbh, $qb)) {
											//echo '1700'.','.'1'.','.$usuario.','.$status.','."";
											echo '5800|1|'.$usuario.'|'.$status.'|'; 
										} else {
											//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '5800|0|||'.mysqli_error($ddh);
										}
								
								
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error'; 
									echo '5800|0|||No se ha encontrado la sugerencia';
								}
		break; 

		case 59: // Nuevo registro en catalogo
		
						$tabla = $_POST['tabla'];
						$op= $_POST['op'];
						$valores = $_POST['var'];
					
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
						if ($dbh->connect_error) {
							  die("Connection failed: " . $dbh->connect_error);
						}


					switch($op){
						case 1:
						
						 $data_vals = explode(';', $valores);
						 $clave = $data_vals[0];
						 $simbolo = $data_vals[1];
						 $nombre = $data_vals[2];
						 $valor = $data_vals[3];
						 
						 $hoy = date("Y-m-d H:i:s");
						 

					 		$q = "SELECT * FROM $tabla WHERE clave = '$clave'";
					 		$result= $dbh->query($q);
						    if ($result->num_rows > 0) {
							    
								//echo '500'.','.'2'.','.''.','.''.','.''; // usuario existente
								echo '5900|2|||'; 
							
							}else{
								
								//$hoy = date("Y-m-d H:i:s");
								$qb = "INSERT INTO $tabla (id, clave, nombre, valor, estado, fecha_registro, simbolo ) VALUES 
											('', '".$clave."','".$nombre."', ".$valor.", 0 ,'".$hoy."','".$simbolo."')";// preparando la instruccion sql
								
								   if (mysqli_query($dbh, $qb)) {
									   // echo '500'.','.'1'.','.''.','.''.','.''; // usuario registrado
									    echo '5900|1|||'; 
									    $data_send = '1'.';'.$usuario.';'.$correo.';'.''; 
									    //mail_me($data_send); // notifica al owner 
									    
									    
									    // notifica al usuario
									   // $data_sendb = '4'.';'.$usuario.';'.$correo.';'.''; 
									    //mail_me($data_sendb); 
									    
									} else {
										//echo '500'.','.'0'.','."".','."".','.mysqli_error($dbh); 
										echo '5900|0|||'.mysqli_error($dbh); 
										//echo '5900|0|||'.$qb; 
								    }
							}


						break; 


						case 2:
						
						 $data_vals = explode(';', $valores);
						 $clave = $data_vals[0];
						 $nombre = $data_vals[1];
						 $icono = $data_vals[2];
						 $color = $data_vals[3];
						 $avance = $data_vals[4];
						 $comment = $data_vals[5];
						 

					 		$q = "SELECT * FROM $tabla WHERE clave = '$clave'";
					 		$result= $dbh->query($q);
						    if ($result->num_rows > 0) {
							    
								//echo '500'.','.'2'.','.''.','.''.','.''; // usuario existente
								echo '5900|2|||'; 
							
							}else{
								
								$hoy = date("Y-m-d H:i:s");
								
								$qb = "INSERT INTO $tabla (id, cve, nombre, icono, color, estado, avance, comentario) VALUES 
											('', '".$clave."','".$nombre."', '".$icono."', '".$color."', 0 ,".$avance.", ".$comment.")";// preparando la instruccion sql
								
								   if (mysqli_query($dbh, $qb)) {
									   // echo '500'.','.'1'.','.''.','.''.','.''; // usuario registrado
									    echo '5900|1|||'; 
									    $data_send = '1'.';'.$usuario.';'.$correo.';'.''; 
									    //mail_me($data_send); // notifica al owner 
									    
									    
									    // notifica al usuario
									   // $data_sendb = '4'.';'.$usuario.';'.$correo.';'.''; 
									    //mail_me($data_sendb); 
									    
									} else {
										//echo '500'.','.'0'.','."".','."".','.mysqli_error($dbh); 
										echo '5900|0|||'.mysqli_error($dbh); 
								    }
							}


						break; 

						case 3:
						
						 $data_vals = explode(';', $valores);
						 $clave = $data_vals[0];
						 $nombre = $data_vals[1];
						 $nom_cto = $data_vals[2];
						 $icono = $data_vals[3];
						 

					 		$q = "SELECT * FROM $tabla WHERE clave = '$clave'";
					 		$result= $dbh->query($q);
						    if ($result->num_rows > 0) {
							    
								//echo '500'.','.'2'.','.''.','.''.','.''; // usuario existente
								echo '5900|2|||'; 
							
							}else{
								
								$hoy = date("Y-m-d H:i:s");
								
								$qb = "INSERT INTO $tabla (id, cve_perfil, nombre, estado, nombre_corto, icono, fecha_registro) VALUES 
											('', '".$clave."','".$nombre."', 0, '".$nom_cto."', '".$icono."', '".$hoy."')";// preparando la instruccion sql
								
								   if (mysqli_query($dbh, $qb)) {
									   // echo '500'.','.'1'.','.''.','.''.','.''; // usuario registrado
									    echo '5900|1|||'; 
									    $data_send = '1'.';'.$usuario.';'.$correo.';'.''; 
									    //mail_me($data_send); // notifica al owner 
									    
									    
									    // notifica al usuario
									   // $data_sendb = '4'.';'.$usuario.';'.$correo.';'.''; 
									    //mail_me($data_sendb); 
									    
									} else {
										//echo '500'.','.'0'.','."".','."".','.mysqli_error($dbh); 
										echo '5900|0|||'.mysqli_error($dbh); 
								    }
							}


						break; 

						case 4:
						
						 $data_vals = explode(';', $valores);
						 $porcentaje = $data_vals[0];
						 $etiqueta = $data_vals[1];
						 

					 		$q = "SELECT * FROM $tabla WHERE clave = '$clave'";
					 		$result= $dbh->query($q);
						    if ($result->num_rows > 0) {
							    
								//echo '500'.','.'2'.','.''.','.''.','.''; // usuario existente
								echo '5900|2|||'; 
							
							}else{
								
								$hoy = date("Y-m-d H:i:s");
								
								$qb = "INSERT INTO $tabla (id, cve, descripcion, estado, fecha_registro) VALUES 
											('', ".$porcentaje.",'".$etiqueta."', 0, '".$hoy."')";// preparando la instruccion sql
								
								   if (mysqli_query($dbh, $qb)) {
									   // echo '500'.','.'1'.','.''.','.''.','.''; // usuario registrado
									    echo '5900|1|||'; 
									    $data_send = '1'.';'.$usuario.';'.$correo.';'.''; 
									    //mail_me($data_send); // notifica al owner 

									    
									} else {
										//echo '500'.','.'0'.','."".','."".','.mysqli_error($dbh); 
										echo '5900|0|||'.mysqli_error($dbh); 
								    }
							}


						break; 												

						case 5:
						
						 $data_vals = explode(';', $valores);
						 $clave = $data_vals[0];
						 $etiqueta = $data_vals[1];
						 $icono = $data_vals[2];
						 $color = $data_vals[3];						 

					 		$q = "SELECT * FROM $tabla WHERE clave = '$clave'";
					 		$result= $dbh->query($q);
						    if ($result->num_rows > 0) {
							    
								//echo '500'.','.'2'.','.''.','.''.','.''; // usuario existente
								echo '5900|2|||'; 
							
							}else{
								
								$hoy = date("Y-m-d H:i:s");
								
								$qb = "INSERT INTO $tabla (id, cve, nombre, icono, color, estado, fecha_registro) VALUES 
											('', ".$clave.",'".$etiqueta."', '".$icono."', '".$color."',0, '".$hoy."')";// preparando la instruccion sql
								
								   if (mysqli_query($dbh, $qb)) {
									   // echo '500'.','.'1'.','.''.','.''.','.''; // usuario registrado
									    echo '5900|1|||'; 
									    $data_send = '1'.';'.$usuario.';'.$correo.';'.''; 
									    //mail_me($data_send); // notifica al owner 

									    
									} else {
										//echo '500'.','.'0'.','."".','."".','.mysqli_error($dbh); 
										echo '5900|0|||'.mysqli_error($dbh); 
								    }
							}


						break; 												


						case 6:
						
						 $data_vals = explode(';', $valores);
						 $nombre = $data_vals[0];
						 $clave = $data_vals[1];						 

					 		$q = "SELECT * FROM $tabla WHERE clave = '$clave'";
					 		$result= $dbh->query($q);
						    if ($result->num_rows > 0) {
							    
								//echo '500'.','.'2'.','.''.','.''.','.''; // usuario existente
								echo '5900|2|||'; 
							
							}else{
								
								$hoy = date("Y-m-d H:i:s");
								
								$qb = "INSERT INTO $tabla (id, nombre, cve_idioma, estado, fecha_registro) VALUES 
											('', '".$nombre."','".$clave."',0, '".$hoy."')";// preparando la instruccion sql
								
								   if (mysqli_query($dbh, $qb)) {
									   // echo '500'.','.'1'.','.''.','.''.','.''; // usuario registrado
									    echo '5900|1|||'; 
									    $data_send = '1'.';'.$usuario.';'.$correo.';'.''; 
									    //mail_me($data_send); // notifica al owner 

									    
									} else {
										//echo '500'.','.'0'.','."".','."".','.mysqli_error($dbh); 
										echo '5900|0|||'.mysqli_error($dbh); 
								    }
							}


						break; 									
																				
						case 7:
						
						 $data_vals = explode(';', $valores);
						 $descripcion = $data_vals[0];
						 $clave = $data_vals[1];						 

					 		$q = "SELECT * FROM $tabla WHERE clave = '$clave'";
					 		$result= $dbh->query($q);
						    if ($result->num_rows > 0) {
							    
								//echo '500'.','.'2'.','.''.','.''.','.''; // usuario existente
								echo '5900|2|||'; 
							
							}else{
								
								$hoy = date("Y-m-d H:i:s");
								
								
								$qb = "INSERT INTO $tabla (id, descripcion, clave, estado, fecha_registro) VALUES 
											('', '".$descripcion."','".$clave."',0, '".$hoy."')";// preparando la instruccion sql
								
								   if (mysqli_query($dbh, $qb)) {
									   // echo '500'.','.'1'.','.''.','.''.','.''; // usuario registrado
									    echo '5900|1|||'; 
									    $data_send = '1'.';'.$usuario.';'.$correo.';'.''; 
									    //mail_me($data_send); // notifica al owner 

									    
									} else {
										//echo '500'.','.'0'.','."".','."".','.mysqli_error($dbh); 
										echo '5900|0|||'.'7'.mysqli_error($dbh); 
								    }
							}


						break; 

						case 8:
						
						 $data_vals = explode(';', $valores);
						 $clave = $data_vals[0];
						 $nombre = $data_vals[1];	
						 $tamano = $data_vals[2];						 

					 		$q = "SELECT * FROM $tabla WHERE clave = '$clave'";
					 		$result= $dbh->query($q);
						    if ($result->num_rows > 0) {
							    
								//echo '500'.','.'2'.','.''.','.''.','.''; // usuario existente
								echo '5900|2|||'; 
							
							}else{
								
								$hoy = date("Y-m-d H:i:s");
								
								$qb = "INSERT INTO $tabla (id, cve, nombre, estado, tam_col, fecha_registro) VALUES 
											('', '".$clave."','".$nombre."',0,".$tamano." ,'".$hoy."')";// preparando la instruccion sql
								
								   if (mysqli_query($dbh, $qb)) {
									   // echo '500'.','.'1'.','.''.','.''.','.''; // usuario registrado
									    echo '5900|1|||'; 
									    $data_send = '1'.';'.$usuario.';'.$correo.';'.''; 
									    //mail_me($data_send); // notifica al owner 

									    
									} else {
										//echo '500'.','.'0'.','."".','."".','.mysqli_error($dbh); 
										echo '5900|0|||'.mysqli_error($dbh); 
								    }
							}


						break; 

						case 9:
						
						 $data_vals = explode(';', $valores);
						 $nombre = $data_vals[0];					 

					 		$q = "SELECT * FROM $tabla WHERE nombre = '$nombre' ";
					 		$result= $dbh->query($q);
						    if ($result->num_rows > 0) {
							    
								//echo '500'.','.'2'.','.''.','.''.','.''; // usuario existente
								echo '5900|2|||'; 
							
							}else{
								
								$hoy = date("Y-m-d H:i:s");
								
								$qb = "INSERT INTO $tabla (id, nombre, estado, fecha_registro) VALUES 
											('', '".$nombre."',0,'".$hoy."')";// preparando la instruccion sql
									
										
									$file_name = $nombre.'.css';
									
									fopen($file_name, 'w') or die("Se produjo un error al crear el archivo");
  
								
								   if (mysqli_query($dbh, $qb)) {
									   // echo '500'.','.'1'.','.''.','.''.','.''; // usuario registrado
									    echo '5900|1|||'; 
									    $data_send = '1'.';'.$usuario.';'.$correo.';'.''; 
									    //mail_me($data_send); // notifica al owner 

									    
									} else {
										//echo '500'.','.'0'.','."".','."".','.mysqli_error($dbh); 
										echo '5900|0|||'.mysqli_error($dbh); 
								    }
							}


						break;
						
						case 10:
						
						 $data_vals = explode(';', $valores);
						 $tabla_n = $data_vals[0];
						 $nombre = $data_vals[1];					 

					 		$q = "SELECT * FROM $tabla WHERE clave = '$tabla_n' ";
					 		$result= $dbh->query($q);
						    if ($result->num_rows > 0) {
							    
								//echo '500'.','.'2'.','.''.','.''.','.''; // usuario existente
								echo '5900|2|||'; 
							
							}else{
								
								//Mensaje: Table 'dignirdn_bsmx_collect.test' doesn't exist
								$hoy = date("Y-m-d H:i:s");
								
								$qb = "INSERT INTO $tabla (id, clave, nombre, estado, icono, fecha_registro) VALUES 
											('', '".$tabla_n."','".$nombre."',0,'','".$hoy."')";// preparando la instruccion sql
									
								
								   if (mysqli_query($dbh, $qb)) {
									   // echo '500'.','.'1'.','.''.','.''.','.''; // usuario registrado
									    echo '5900|1|||'; 
									    $data_send = '1'.';'.$usuario.';'.$correo.';'.''; 
									    //mail_me($data_send); // notifica al owner 

									    
									} else {
										//echo '500'.','.'0'.','."".','."".','.mysqli_error($dbh); 
										echo '5900|0|||'.mysqli_error($dbh); 
								    }
							}


						break;	
						
											
						
						default:
						
						//echo '5900|4|'.$valores.'||'; 

						 $data_vals = explode(';', $valores);
						 $id = $data_vals[0];
						 
						// obtiene los campos de la tabla
						
									$qcol="SHOW COLUMNS FROM $tabla";
									    
									   // $output=mysqli_query($dbh,$qcol);
									    $resultcol= $dbh->query($qcol);
									
								    
									 if ($resultcol->num_rows > 0) {
									    while($rowc= $resultcol->fetch_assoc()){
									       
										       $cols .= $rowc['Field'].';';
										       $tipo .= $rowc['Type'].';';
									       
									    }
								    }else{
									  // echo '6300|0|'.$qcol.'||'.mysqli_error($dbh);
								    }
								    
						//////////
						
									$cols = substr($cols, 0, -1); 
									$valores= substr($valores,0,-1);
									$tipo= substr($tipo,0,-1);	

									$data_cols = explode(';', $cols); 
									$data_vals = explode(';', $valores);
									$data_tipo = explode(';', $tipo);

									$total_cols = count($data_cols); 
									$total_vals = count($data_vals); 
														

									if($total_cols != $total_vals){
										echo '5900|2| '.$id.' El numero de registros no coincide '.$total_cols.'vs'.$total_vals.'||';
									}else{
										
										for($i=0;$i<= $total_cols;$i++){
											
											if($i != 0){ // evita id
												$sub = substr($data_tipo[$i],0,3);
												
													$qpart_campos .= $data_cols[$i].",";
												
												if($sub == 'int'){
													
													$qpart_vals .= $data_vals[$i].","; 
												}elseif($sub == 'var'){
													$qpart_vals .= "'".$data_vals[$i]."',"; 
												}elseif($sub == 'dat'){
													$hoy = date("Y-m-d H:i:s");
													$qpart_vals .= "'".$hoy."',";
												}		
											}
												
											
										}		
									
										$qpart_campos = substr($qpart_campos,0,-2);
										$qpart_vals = substr($qpart_vals,0,-1);
									
									
									
															 	$q = "SELECT * FROM $tabla WHERE id=$id;";
														 		$result= $dbh->query($q);
															    
															    if ($result->num_rows <= 0) {
																    								
																									
																	//$qb = "INSERT INTO $tabla (id, cve, nombre, estado, tam_col, fecha_registro) VALUES 

																	$qb = "INSERT INTO $tabla (id,".$qpart_campos.") VALUES ('',".$qpart_vals.");";// preparando la instruccion sql
									
																													
																	if (mysqli_query($dbh, $qb)) {
																		
																		echo '5900|1|'.$qb.'||';
																															
																	} else {
																		//echo '1600'.','.'0'.','.$qb.','."".','.'';
																		//echo '5900|0|'.$qb.'||'.mysqli_error($dbh);
																		echo '5900|0|||'.$qb; 
																	}
																	
														
																}else{
																	
																	echo '5900|2|'.$q.'||'; 
																}
														
									
									}						
						
						//echo '5900|4|'.$qb.'||';
						
						
						break;
						
					}
						

					
		break;

		case 60: // Cambia estado 
		
		$id = $_POST['id'];
		$tabla = $_POST['tabla'];
		$new_estado = $_POST['estado'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
					$qb = "UPDATE $tabla SET estado = $new_estado where id = $id;";
																		
					if (mysqli_query($dbh, $qb)) {
						
						echo '6000|1|'.$item_id.'||';
																			
					} else {
						//echo '1600'.','.'0'.','.$qb.','."".','.'';
						echo '6000|0|'.$qb.'||'.mysqli_error($dbh);
					}
					
					//Mensaje: Unknown column '0CV10257AC410593R' in 'where clause'

		break;

		case 61: // Cambia estado sugerencia
		
		$id = $_POST['id'];
		$tabla = $_POST['tabla'];
		$new_estado = $_POST['estado'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
					$qb = "UPDATE $tabla SET comentario = $new_estado where id = $id;";
																		
					if (mysqli_query($dbh, $qb)) {
						
						echo '6000|1|'.$item_id.'||';
																			
					} else {
						//echo '1600'.','.'0'.','.$qb.','."".','.'';
						echo '6000|0|'.$qb.'||'.mysqli_error($dbh);
					}
					
					//Mensaje: Unknown column '0CV10257AC410593R' in 'where clause'

		break;


		case 62: // Elimina registro
		
		$id = $_POST['id'];
		$tabla = $_POST['tabla'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			

					 		$q = "SELECT * FROM $tabla WHERE id=$id;";
					 		$result= $dbh->query($q);
						    
						    if ($result->num_rows > 0) {
							    								
																
								//$qb = "UPDATE $tabla SET comentario = $new_estado where id = $id;";
								$qb = "DELETE FROM $tabla WHERE id = $id";// preparando la instruccion sql

																					
								if (mysqli_query($dbh, $qb)) {
									
									echo '6200|1|'.$id.'||';
																						
								} else {
									//echo '1600'.','.'0'.','.$qb.','."".','.'';
									echo '6200|0|'.$qb.'||'.mysqli_error($dbh);
								}
					
							}else{
								
								echo '6200|2|'.$q.'||'; 
							}
					

		break;

		case 63: // Gurdar regisstro

			$id = $_POST['id'];
			$tabla = $_POST['tabla'];
			$vals = $_POST['vals'];
			
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
	
// obtiene los campos de la tabla

			$qcol="SHOW COLUMNS FROM $tabla";
			    
			   // $output=mysqli_query($dbh,$qcol);
			 $resultcol= $dbh->query($qcol);
			
		    
			 if ($resultcol->num_rows > 0) {
			    while($rowc= $resultcol->fetch_assoc()){
			       
				       $cols .= $rowc['Field'].';';
				       $tipo .= $rowc['Type'].';';
			       
			    }
		    }else{
			  // echo '6300|0|'.$qcol.'||'.mysqli_error($dbh);
		    }
		    
//////////

//echo '6300|2| '.$cols.'||';

// Quita el ultimo caracter a las dos cadenas valores y cols

$cols = substr($cols, 0, -1); 
$vals= substr($vals,0,-1);
$tipo= substr($tipo,0,-1);

//echo '6300|2|'.$cols.$vals.'||';
//echo '6300|2|'.$cols.$vals.'||';

// prepara la cadene de valosres para el query 

$data_cols = explode(';', $cols); 
$data_vals = explode(';', $vals);
$data_tipo = explode(';', $tipo);			

$total_cols = count($data_cols); 
$total_vals = count($data_vals); 

if($total_cols != $total_vals){
	echo '6300|2| '.$tabla.' El numero de registros no coincide '.$total_cols.'vs'.$total_vals.'||';
}else{
	
	for($i=0;$i<= $total_cols;$i++){
		
		if($i != 0){ // evita id
			$sub = substr($data_tipo[$i],0,3);
			
			if($sub == 'int'){
				$qpart .= $data_cols[$i]."=".$data_vals[$i].", "; 
			}elseif($sub == 'var'){
				$qpart .= $data_cols[$i]."= '".$data_vals[$i]."', "; 
			}elseif($sub == 'dat'){
				
				if($data_cols[$i]=='fecha_actualizado'){
					$hoy = date("Y-m-d H:i:s");
					$qpart .= $data_cols[$i]."= '".$hoy."', "; 
					
				}else{

				//$hoy = date("Y-m-d H:i:s");
				$qpart .= $data_cols[$i]."= '".$data_vals[$i]."', "; 					
				}

			}		
		}
			
		
	}		

	$qpart = substr($qpart,0,-2);

	//echo '6300|2| '.$qpart.' ||';
			


						 		$q = "SELECT * FROM $tabla WHERE id=$id;";
					 		$result= $dbh->query($q);
						    
						    if ($result->num_rows > 0) {
							    
							   // $hoy = date("Y-m-d H:i:s");
																
								//$qb = "UPDATE $tabla SET comentario = $new_estado where id = $id;";
								$qb = "Update  $tabla SET $qpart where id= $id ";// preparando la instruccion sql

																					
								if (mysqli_query($dbh, $qb)) {
									
									echo '6300|1|'.$qb.'||';
																						
								} else {
									//echo '1600'.','.'0'.','.$qb.','."".','.'';
									echo '6300|0|'.$qb.'||'.mysqli_error($dbh);
								}
					
							}else{
								
								echo '6300|2|'.$q.'||'; 
							}
					

}
		break;		


		case 64:
		
			$id_perfil = $_POST['id_user'];
			$tema = $_POST['tema'];
			
			
			if($tema == 888){
				$res = genera_csv_minifig($tema,$id_perfil);
			}else if($tema == 999){
				$res = genera_csv($tema,$id_perfil);
			}else if($tema >500 and $tema < 599){ // lista de grupo
				//$res = genera_csv_sets_grupo($tema,$id_perfil);
			}else{
				$res = genera_csv($tema,$id_perfil);
			}
			
			echo '6400|1|'.$res.'||';
		
		break;																																										


		case 65:
		
		
			$id_perfil = $_POST['perfil'];
			
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
				if ($dbh->connect_error) {
					  die("Connection failed: " . $dbh->connect_error);
				}
		// GEnera codigo por consulra directa
		/*
			 	$q = "SELECT * FROM permisos_perfil WHERE id_perfil = $id_perfil;";
			 	$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) { // Si la consulta trae registro, 
					 $row= $result->fetch_assoc(); 
					 
					 	$permisos = $row['permisos'];
							    					
					 }else{ // si no hay resultado sdel query 
						$permisos = '0.0';
					 }
		*/
		///// 
		
		// Genera codigo por registro de permisos. 
				$q = "SELECT * FROM permisos_pagina WHERE id_perfil = $id_perfil and tipo = 1;";
			 	$result= $dbh->query($q);		

				while($row= $result->fetch_assoc()){
					
					$permisos .= $row['id_recurso'].'-'.$row['estado'].';';
										
				}
		//////
			 
					 
					 $info_perfil = get_info_perfil($id_perfil);
					 
					 $data_info_perfil = explode(';', $info_perfil);
					 $estado = $data_info_perfil[5];
					 
					 $btn_guardar = '<button class="btn btn-outline-secondary" type="button" onclick="save_permisos();" ><i class="fas fa-save"></i> Guardar </button>';
					 
					 if($estado==1){
						 $btn_edo_perfil = '
						 <span class=" text-success col-form-label " style="margin: 0px 15px;"> <i class="fa fa-eye"></i></span>
						 <button class="btn btn-outline-secondary" type="button" onclick="cambia_estado_perfil(\''.$id_perfil.'\');" > <i class="fas fa-toggle-off"></i> Desactivar </button> '.$btn_guardar;
					 }else{
						 $btn_edo_perfil = '
						 <span class=" text-gris col-form-label " style="margin: 0px 15px;"> <i class="fa fa-eye-slash"></i></span>
						 <button class="btn btn-outline-secondary" type="button" onclick="cambia_estado_perfil(\''.$id_perfil.'\');"> <i class="fas fa-toggle-on"></i> Activar </button> '.$btn_guardar;
					 }
							
					 //$permisos_grid = 'test';
				
					$permisos_grid = genera_grid_permisos($permisos);
					$permisos_config = get_profile_config($id_perfil);
					
					//$all_permisos = $permisos_grid.'---'.$permisos_config
					
					echo '6500|1|'.$permisos_grid.'|'.$btn_edo_perfil.'||'.$permisos_config;
				
								 
		
		break;	
		
		
		case 66:
		
			$id_perfil = $_POST['id_perfil'];
			$code = $_POST['code'];
			$code_config = $_POST['code_config'];
					
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}

			
			// guarda por codigo en BD 
			
			$hoy = date('Y-m-d G:i:s');
			$hoyb = date("Y-m-d H:i:s");




			//////// GUARDA PERMISOS PAGINA /////////
			
			// TIPO PERMISO 
			// 1. PAGINAS 
			// 2. CONFIGURACIONES
			
			$data_code = explode(';', $code);
			$tot_reg = count($data_code);
			$tot_reg_db = 0; 
			
			for($i=0; $i < count($data_code); $i++){
				
			
				if($data_code[$i] != ''){
					 
				 
					$data_reg = explode('-',$data_code[$i]);
					$id_menu = $data_reg[0];
					$permiso = $data_reg[1];				
	
					if($permiso==''){
						$per = 0; 
						
					}else{
						$per = $data_reg[1];
					}
					
					
					$qc = "SELECT * FROM permisos_pagina WHERE id_recurso = $id_menu and id_perfil = $id_perfil and tipo=1;";// preparando la instruccion sql
					
				//$queris .= "SELECT * FROM permisos_pagina WHERE id_recurso = $id_menu and id_perfil = $id_perfil and tipo = 1;";
						$result= $dbh->query($qc);
								    
					if ($result->num_rows > 0) { // Si hay resultados, actualiza la info del usuario
						$qd = "UPDATE permisos_pagina SET estado = $per, fecha_actualizado = '$hoyb' where id_recurso =$id_menu and id_perfil = $id_perfil and tipo = 1;";
						
					//$queris .= "UPDATE permisos_pagina SET estado = $per, tipo= 1, fecha_actualizado = '$hoyb' where id_recurso =$id_menu and id_perfil = $id_perfil;";
						
						mysqli_query($dbh, $qd);
						
						$tot_reg_db = $tot_reg_db +1;
					}else{
						$qd = "INSERT INTO permisos_pagina (id, id_perfil, id_recurso, tipo, estado, fecha_registro) VALUES ('', $id_perfil, $id_menu, 1, $per, '".$hoyb."');";	
						
			//$queris .= "INSERT INTO permisos_pagina (id, id_perfil, id_recurso, tipo, estado, fecha_registro) VALUES ('', $id_perfil, $id_menu, 1, $per, '".$hoyb."');";
						
						mysqli_query($dbh, $qd);
						
						$tot_reg_db = $tot_reg_db +1;
					}
					
						
				}
			}



			//////// GUARDA PERMISOS CONFIGURACION /////////
			
			// TIPO PERMISO 
			// 1. PAGINAS 
			// 2. CONFIGURACIONES
			
			$data_codeb = explode(';',$code_config);
			$tot_regb = count($data_codeb);
			$tot_reg_dbb = 0; 
			
			for($j=0; $j < count($data_codeb); $j++){
				
				$qcc = ''; 
				$resultb = ''; 
				if($data_codeb[$j] != ''){
					 
				 
					$data_regb = explode('-',$data_codeb[$j]);
					$id_menub = $data_regb[0];
					$permisob = $data_regb[1];				
	
					if($permisob ==''){
						$perb = 0; 
						
					}else{
						$perb = $data_regb[1];
					}
					
					$qcc = "SELECT * FROM permisos_pagina WHERE id_recurso = $id_menub and id_perfil = $id_perfil and tipo = 2;";// preparando la instruccion sql
					
					$queris .= "SELECT * FROM permisos_pagina WHERE id_recurso = $id_menub and id_perfil = $id_perfil and tipo = 2;";
						$resultb= $dbh->query($qcc);
						
					$queris .= 'Result:'.$resultb->num_rows.';';
								    
					if ($resultb->num_rows > 0) { // Si hay resultados, actualiza la info del usuario
						$qdd = "UPDATE permisos_pagina SET estado = $perb, fecha_actualizado = '$hoyb' where id_recurso =$id_menub and id_perfil = $id_perfil and tipo = 2;";
						
					//$queris .= "UPDATE permisos_pagina SET estado = $perb, tipo= 2, fecha_actualizado = '$hoyb' where id_recurso =$id_menub and id_perfil = $id_perfil;";
						
						mysqli_query($dbh, $qdd);
						
						$tot_reg_db = $tot_reg_db +1;
					}else{
						$qdd = "INSERT INTO permisos_pagina (id, id_perfil, id_recurso, tipo, estado, fecha_registro) VALUES ('', $id_perfil, $id_menub, 2, $perb, '".$hoyb."');";	
						
		//$queris .= "INSERT INTO permisos_pagina (id, id_perfil, id_recurso, tipo, estado, fecha_registro) VALUES ('', $id_perfil, $id_menub, 2, $perb, '".$hoyb."');";
						
						mysqli_query($dbh, $qdd);
						$tot_reg_db = $tot_reg_db +1;
					}
					
					

						
				}
			}		
			

					if($tot_reg_db > 0){
						//echo '6600|1|'.$queris.'||'; 
						echo '6600|1|||';
					}else{
						echo '6600|0|||'.mysqli_error($dbh);
					}

/*
						if (mysqli_query($dbh, $qd)) {
						
							echo '6600|1|||'; 
						} else {
							//echo '6600|0|||'.$qd;
							echo '6600|0|||'.mysqli_error($dbh);
						}
				*/									
		break;
				
		case 67:	
				$id = $_POST['id_perfil'];
				
				
						$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$q = "SELECT * FROM perfiles WHERE cve_perfil = $id";// preparando la instruccion sql
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$row= $result->fetch_assoc();
								
									$estado = $row['estado'];
									
									if($estado==1){
										$nvo_edo = 0;
									}else{
										$nvo_edo = 1;
									}									
										
											$qb = "UPDATE perfiles SET estado = $nvo_edo where cve_perfil= $id";// preparando la instruccion sql										
																			
										if (mysqli_query($dbh, $qb)) {
											//echo '1700'.','.'1'.','.$usuario.','.$status.','."";
											echo '6700|1|||'; 
										} else {
											//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '6700|0|||'.mysqli_error($dbh);
										}
								
								
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error'; 
									echo '6700|0||| No hay registros para este perfil';
								}				
		break;	
		
		case 68: 


			$nombre_serie = $_POST['nombre_serie'];
			$clave_serie = $_POST['clave_serie'];
			$fecha_serie = $_POST['fecha_serie'];
			$color_serie = $_POST['color_serie'];
			$tipo_serie = $_POST['tipo_serie'];
			$total_serie = $_POST['total_serie'];
			$estado_serie = $_POST['estado_serie'];
			$precio_serie = $_POST['precio_serie'];
			$moneda_serie = $_POST['moneda_serie'];
			$premium = $_POST['premium'];
			
			$estado_serie = 99;

			$hoyb = date("Y-m-d H:i:s"); 
			

    		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
						

			// Trabaja en L abase de datos: 
			
				// Busca el registros en la tabla series, para comprobar que no esta duplicado
				
				$q = "SELECT * FROM series WHERE clave_lego = '$clave_serie'";
			 	$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) { // Si la consulta trae registro, 
					 $row= $result->fetch_assoc(); 

					 	$qc = "UPDATE series SET color= '$color_serie', precio_premium = $precio_serie, moneda_premium = '$moneda_serie', tipo = $tipo_serie, nombre = '$nombre_serie', fecha_actualizado = '$hoyb', aux = '$total_serie' where clave_lego= '$clave_serie' ";// preparando la instruccion sql					 
					
						if (mysqli_query($dbh, $qc)) {
							echo '6800|1|||';
						} else {
							echo '6800|0|||'.mysqli_error($dbh).' '.$qc;
						}
					
					
					}else{
						
							$qb = "INSERT INTO series (id, clave_lego, nombre, no_serie, color, tipo, estado, consecutivo, fecha_lanzamiento, premium, precio_premium, moneda_premium, fecha_registro, fecha_actualizado, aux) VALUES ('','".$clave_serie."','".$nombre_serie."',".$clave_serie.",'".$color_serie."',".$tipo_serie.", ".$estado_serie.", ".$clave_serie.", '".$fecha_serie."', ".$premium." ,".$precio_serie.",'".$moneda_serie."', '".$hoyb."', '".$hoyb."', '".$total_serie."')";
											
							if (mysqli_query($dbh, $qb)) {
									echo '6800|1|'.$clave_serie.'||'; 
							} else {
											//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
									echo '6800|0|||'.mysqli_error($dbh).' '.$qb;
							}
						
						
					}

		break;	


		case 69: 

			$user_id = $_POST['user'];
			$clave_serie = $_POST['clave_serie'];
			$fig_nombres = trim($_POST['nombresfig_serie']);
			$hoyb = date("Y-m-d H:i:s"); 
			
			//$fig_nombres = str_replace(';', '//', $fig_nombres); 
			//$fig_nombres = str_replace(',', '|', $fig_nombres); 

    		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}			

				$q = "SELECT * FROM temporal_serie WHERE clave = '$clave_serie'";
			 	$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) { // Si la consulta trae registro, 
					 $row= $result->fetch_assoc(); 

					 	$qc = "UPDATE temporal_serie SET id_user = $user_id, step2 = '$fig_nombres', fecha_actualizado = '$hoyb' where clave = '$clave_serie' ";// preparando la instruccion sql					 
					
						if (mysqli_query($dbh, $qc)) {
							echo '6900|1|||';
						} else {
							echo '6900|0|||'.mysqli_error($dbh).' '.$qc;
						}
					
					
					}else{
						
							$qb = "INSERT INTO temporal_serie (id, id_user, clave, step1, step2, step3, step4, estado, fecha_agregado, fecha_actualizado, auxiliar) VALUES ('',".$user_id." , '".$clave_serie."','','".$fig_nombres."','','',1, '".$hoyb."', '".$hoyb."', '')";
											
							if (mysqli_query($dbh, $qb)) {
									echo '6900|1|||'; 
							} else {
											//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
									echo '6900|0|||'.mysqli_error($dbh).' '.$qb;
							}
						
						
					}			
						
		break;

		case 70: // Bannea Usuario
			$item_id = $_POST['item_id'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$q = "SELECT * FROM usuarios WHERE id = $item_id";// preparando la instruccion sql
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$row= $result->fetch_assoc();
								
									//$clave = $row['clave']; 
									$usuario = $row['correo'];
									$hoy = date("Y-m-d H:i:s");
				 
					 	
							 			$qb = "UPDATE usuarios SET estado = 99, password= 'RESET', fecha_banned = '$hoy' where id= $item_id ";// preparando la instruccion sql
							 			$status = "usuario"; 
 
									
									
										if (mysqli_query($dbh, $qb)) {
											//echo '1700'.','.'1'.','.$usuario.','.$status.','."";
											echo '7000|1|'.$usuario.'|'.$status.'|'; 
												

										} else {
											//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '7000|0|||'.mysqli_error($ddh);
										}

							
								
								
								
								
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error'; 
									echo '7000|0|||error';
								}
		break; 			


		case 71: // Bannea Usuario
			$item_id = $_POST['item_id'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$qw = "SELECT * FROM usuarios WHERE id = $item_id";// preparando la instruccion sql
							    $resultw= $dbh->query($qw);
							    
							    if ($resultw->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$roww= $resultw->fetch_assoc();
								
									//$clave = $row['clave']; 
									$correo = $roww['correo'];
									$usuario = $roww['usuario'];
									
									$hoy = date("Y-m-d H:i:s");
				 
									$data_sendb = '4'.';'.$usuario.';'.$correo.';'.'';
									mail_me($data_sendb);					 	
									
									echo '7100|1|||';
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error'; 
									echo '7100|0|||error';
								}
		break; 

		case 72: // GEnera URL 
			$user_id = $_POST['id_user'];
			$current_token = $_POST['current_token'];
			$pag = md5('public_coleccion');
			$hoy = date("Y-m-d H:i:s");
			
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$qw = "SELECT * FROM token_user WHERE id_user = $user_id ";// preparando la instruccion sql
							    $resultw= $dbh->query($qw);
							    
							    if ($resultw->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$roww= $resultw->fetch_assoc();
								
									$estado = $roww['estado'];
									
									if($estado==1){
										
										$token = $roww['token'];
							 			$qb = "UPDATE token_user SET estado = 0, token='', token_anterior = '$token', fecha_actualizado= '$hoy' where id_user= $user_id ";// preparando la instruccion sql
							 											
										if (mysqli_query($dbh, $qb)) {
											
											$url = $link_site_public.'mnu='.$pag.'&token='.$token;
											echo '7200|0|'.$url.'||';

										} else {
											//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '7200|0|||'.mysqli_error($ddh);
										}	

										$url = $link_site_public.'mnu='.$pag.'&token='.$roww['token'];
										
									}elseif($estado==0){
										
										$token = generateRandomString();
										
										
										//Guardar token
							 			$qb = "UPDATE token_user SET estado = 1, token = '$token', fecha_actualizado= '$hoy' where id_user= $user_id ";// preparando la instruccion sql
							 											
										if (mysqli_query($dbh, $qb)) {
											
											$url = $link_site_public.'mnu='.$pag.'&token='.$token;
											echo '7200|1|'.$url.'||';

										} else {
											//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '7200|0|||'.mysqli_error($ddh);
										}		
										
									}elseif($estado==99){
										
										//$token = generateRandomString();
										
										
										//Guardar token
							 			$qb = "UPDATE token_user SET estado = 0, token = 'BLOCKED', fecha_actualizado= '$hoy' where id_user= $user_id ";// preparando la instruccion sql
							 											
										if (mysqli_query($dbh, $qb)) {
											
											$url = $link_site_public.'mnu='.$pag.'&token='.$token;
											echo '7200|0|'.$url.'||';

										} else {
											//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '7200|0|||'.mysqli_error($ddh);
										}		
										
									}
									
									
								}else{
									
									$token = generateRandomString();
									
									$hoy = date("Y-m-d H:i:s");

									$qb = "INSERT INTO token_user (id, id_user, token, correo, estado, fecha_registro, fecha_actualizado, token_anterior) VALUES 
																  ('', ".$user_id." , '".$token."','',1,'".$hoy."', '".$hoy."', '')";
									
									$url = $link_site_public.'mnu='.$pag.'&token='.$token;				
									if (mysqli_query($dbh, $qb)) {
											echo '7200|1|'.$url.'||';
									} else {
													//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '7200|0|||'.mysqli_error($dbh).' '.$qb;
									}										
									
								}
		break; 		


		case 73: // Guarda Solo opcionales
		
			$id_user = $_POST['id_user'];
			
			$code_series = $_POST['code_series'];
			
			$series_opcionales = $_POST['series_op'];
						
			/// AUtomatic serie opcionales 
			
			$data_series = explode('.', $code_series); 
			$data_opcionales = explode(';',$series_opcionales);
			
			for($i=0 ; $i< count($data_opcionales); $i++){
				if($data_opcionales[$i] != '' and $data_series[$i] != '' ){
				//$q_c .= ' estado_'.$data_opcionales[$i].'='.$data_series[$i].','; 
				
				$code_op .= $data_opcionales[$i].'-'.$data_series[$i].';';
				}
			}
			
			//$q_cc = substr($q_c, 0, -1);
			$code_series = substr($code_series, 0, -1);
			
				//guarda opcionales
						// XXXX-1;XXXX-0; 
						
						$data_col = explode(';', $code_op);
						$count = count($data_col);
						
						for($i=0; $i <= $count; $i++){
							$save_opcionales .= save_serie_opcional($id_user,$data_col[$i]);
						}
						
						
						if($save_opcionales > 0){
							echo '7300|1|'.$id_user.'||'; 
						}else{
							echo '7300|0|||'.mysqli_error($dbh);
						}
	
	
	
		break; 
		
		case 74: // Guarda Solo opcionales
		
			$id_user = $_POST['id_user'];
			
			$code_series = $_POST['code_series'];
			
			$series_opcionales = $_POST['series_op'];
						
			/// AUtomatic serie opcionales 
			
			$data_series = explode('.', $code_series); 
			$data_opcionales = explode(';',$series_opcionales);
			
			for($i=0 ; $i< count($data_opcionales); $i++){
				if($data_opcionales[$i] != '' and $data_series[$i] != '' ){
				//$q_c .= ' estado_'.$data_opcionales[$i].'='.$data_series[$i].','; 
				
				$code_op .= $data_opcionales[$i].'-'.$data_series[$i].';';
				}
			}
			
			//$q_cc = substr($q_c, 0, -1);
			$code_series = substr($code_series, 0, -1);
			
			//$qs = "UPDATE configuraciones SET ".$q_cc." where id_user = $id_user";	

								
			////////

			//guarda opcionales
						// XXXX-1;XXXX-0; 
						
						$data_col = explode(';', $code_op);
						$count = count($data_col);
						
						for($i=0; $i <= $count; $i++){
							$save_opcionales .= save_serie_opcional_admin($id_user,$data_col[$i]);
						}
						
						
						if($save_opcionales > 0){
							echo '7400|1|'.$id_user.'||'; 
						}else{
							echo '7400|0|||'.mysqli_error($dbh);
						}
									

		break; 
		
		case 75: // Bannea Usuario
			$codigo = $_POST['code'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$qw = "SELECT * FROM acceso_serie WHERE clave = '$codigo' ";// preparando la instruccion sql
							    $resultw= $dbh->query($qw);
							    
							    if ($resultw->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$roww= $resultw->fetch_assoc();
								
									
									
									echo '7500|1|'.$roww['estado_definido'].'||';
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error'; 
									echo '7500|0|||'.mysqli_error($dbh);
								}
		break; 

		case 76: // guarda vista
			
			$vista_code = $_POST['vista_code'];
			$option = $_POST['option'];
			
			$hoy = date("Y-m-d H:i:s");
			
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$qw = "SELECT * FROM acceso_serie WHERE clave = '$vista_code' ";// preparando la instruccion sql
							    $resultw= $dbh->query($qw);
							    
							    if ($resultw->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$roww= $resultw->fetch_assoc();
								

							 			$qb = "UPDATE acceso_serie SET estado_definido = $option, fecha_actualizado= '$hoy' where clave= '$vista_code' ";
							 			// preparando la instruccion sql
							 											
										if (mysqli_query($dbh, $qb)) {
											
											$lbl_estado_nvo = crea_lbl_vista($option);
											
																						
											echo '7600|1|'.$lbl_estado_nvo.'||';

										} else {
											echo '7600|0|||'.mysqli_error($ddh);
										}	

									
									
								}else{
									

									$qb = "INSERT INTO acceso_serie (id, clave, estado_definido, estado, fecha_registro, fecha_actualizado ) VALUES 
																	('', '".$vista_code."' , ".$option.", 1,'".$hoy."', '".$hoy."')";
									
									if (mysqli_query($dbh, $qb)) {
										
											$lbl_estado_nvo = crea_lbl_vista($option);
										
											echo '7600|1|'.$lbl_estado_nvo.'||';
									} else {
													//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '7600|0|||'.mysqli_error($dbh).' '.$qb;
									}										
									
								}
								
								
								
		break;

		case 77: // Archivos existentes
			$clave = $_POST['clave_set'];
		
		// Comprueba que exista foto
							
							$path_folleto = 'assets/images/sets/';
							$file_folleto = $path_folleto.$clave.'.webp';

								if(file_exists($file_folleto)){
									//echo "The file exists";
									//$foto_folleto = $path_folleto.$clave.'.jpg';
									$foto_img = $clave.'.webp';
									$bandera_foto = 1;
								} else {
								
                                   
									if(file_exists($path_folleto.$clave.'.png')){
										//echo "The file exists";
										//$foto_folleto= $patƒ29Ωßh_folleto.$clave.'.png';
                                        $file_folleto_b = convert_to_webp_url($path_folleto.$clave.'.png');
										$foto_img = $clave.'.png';
										$bandera_foto = 1;
									}else{
								    //echo "The file does not exist";
								    //$foto_folleto = 'assets/images/noimage.png';	
											if(file_exists($path_folleto.$clave.'.jpeg')){
												//echo "The file exists";
												//$foto_folleto= $path_folleto.$clave.'.jpeg';
                                                $file_folleto_b = convert_to_webp_url($path_folleto.$clave.'.jpeg');
												$foto_img = $clave.'.jpeg';
												$bandera_foto = 1;
											}else{
										    	//echo "The file does not exist";
										    	//$foto_folleto = 'assets/images/noimage.png';
										    	//$foto_img = $clave.'.png';
										    	//$bandera_foto = 0;
												    if(file_exists($path_folleto.$clave.'.jpg')){
														//echo "The file exists";
														//$foto_folleto= $path_folleto.$clave.'.jpeg';
                                                        $file_folleto_b = convert_to_webp_url($path_folleto.$clave.'.jpg');
														$foto_img = $clave.'.jpg';
														$bandera_foto = 1;
													}else{
												    //echo "The file does not exist";
												    	//$foto_folleto = 'assets/images/noimage.png';
												    	$foto_img = $clave.'.webp';
                                                        //$foto_img = 'noimage.png';
												    	$bandera_foto = 0;		
													}			
											}								    
								    
								    		
									}
							
								}

                                

								if($bandera_foto==1){
									$info_set = get_info_sets_foto($foto_img);
									$info_set = str_replace('|',';', $info_set);
								
								}else{
									
									$info_set = 'X;X;X;X;X;X;X'; 
								}

									echo '7700|1|'.$bandera_foto.'|||'.$foto_img.'|'.$info_set;
															
							
			////
		
/*		
// registra archivo faltante		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								
								// comprueba si ya existe el registro
								$qw = "SELECT * FROM acceso_serie WHERE clave = '$codigo' ";// preparando la instruccion sql
							    $resultw= $dbh->query($qw);
							    
							    if ($resultw->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$roww= $resultw->fetch_assoc();
								
									
									
									echo '7500|1|'.$roww['estado_definido'].'||';
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error'; 
									echo '7500|0|||'.mysqli_error($dbh);
								}
								
							*/
		break; 		
		
		case 78: // Borrar Foto de Set
		
			$foto = $_POST['foto'];
		
			$file = 'assets/images/sets/'.$foto;
			
			unlink($file);
			
			if(file_exists($file)){
				echo '7800|0|||';
			}else{
				echo '7800|1|||';	
			}
			
			/*
			if(unlink($file)) {
			  // file was successfully deleted
			  echo '7800|1|||';
			} else {
			  // there was a problem deleting the file
			  echo '7800|0|'.$roww['estado_definido'].'||';
			}	
			*/
										
								
		break; 


		case 79: // Bannea Usuario
			$codigo = $_POST['code'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$qw = "SELECT * FROM acceso_serie WHERE clave = '$codigo' ";// preparando la instruccion sql
							    $resultw= $dbh->query($qw);
							    
							    if ($resultw->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$roww= $resultw->fetch_assoc();
								
									
									
									echo '7900|1|'.$roww['estado_definido'].'||';
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error'; 
									echo '7900|0|||'.mysqli_error($dbh);
								}
		break; 
		
		case 80: // guarda vista
			
			$vista_code = $_POST['vista_code'];
			$option = $_POST['option'];
			
			$hoy = date("Y-m-d H:i:s");
			
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$qw = "SELECT * FROM acceso_serie WHERE clave = '$vista_code' ";// preparando la instruccion sql
							    $resultw= $dbh->query($qw);
							    
							    if ($resultw->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$roww= $resultw->fetch_assoc();
								

							 			$qb = "UPDATE acceso_serie SET estado_definido = $option, fecha_actualizado= '$hoy' where clave= '$vista_code' ";
							 			// preparando la instruccion sql
							 											
										if (mysqli_query($dbh, $qb)) {
											
											$lbl_estado_nvo = crea_lbl_vista($option);
											
																						
											echo '8000|1|'.$lbl_estado_nvo.'||';

										} else {
											echo '8000|0|||'.mysqli_error($ddh);
										}	

									
									
								}else{
									

									$qb = "INSERT INTO acceso_serie (id, clave, estado_definido, estado, fecha_registro, fecha_actualizado ) VALUES 
																	('', '".$vista_code."' , ".$option.", 1,'".$hoy."', '".$hoy."')";
									
									if (mysqli_query($dbh, $qb)) {
										
											$lbl_estado_nvo = crea_lbl_vista($option);
										
											echo '8000|1|'.$lbl_estado_nvo.'||';
									} else {
													//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '8000|0|||'.mysqli_error($dbh).' '.$qb;
									}										
									
								}
								
								
								
		break;

		case 81: // 
			$id_user= $_POST['id_user'];
			$serie= $_POST['serie'];
			$current_val= $_POST['current_val'];
			$id_admin = $_POST['id_admin'];
			

		
			$hoy = date("Y-m-d H:i:s");
			
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$qw = "SELECT * FROM permiso_serie_premium WHERE clave_serie = $serie and id_user = $id_user ";// preparando la instruccion sql
							    $resultw= $dbh->query($qw);						

							    
							    if ($resultw->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$roww= $resultw->fetch_assoc();

									$current_val = $roww['permiso_admin'];
									
									if($current_val==1){
										$nvo_val = 0;
									}else{
										$nvo_val = 1;
									}	


							 		$qb = "UPDATE permiso_serie_premium SET permiso_admin= $nvo_val, fecha_actualizado= '$hoy', id_user_permiso = $id_admin where clave_serie = $serie and id_user = $id_user";
							 			// preparando la instruccion sql
							 											
										if (mysqli_query($dbh, $qb)) {
											
											//$lbl_estado_nvo = crea_lbl_vista($option);
											
											$update_estatus = genera_check_series_premium_admin_perfil($id_user);
											
																						
											echo '8100|1|'.$update_estatus.'||';

										} else {
											echo '8100|0|||'.mysqli_error($ddh);
										}	

									
									
								}else{
									

									$qb = "INSERT INTO permiso_serie_premium (id, id_user, clave_serie, permiso_asignado, permiso_admin, estado, fecha_registro, fecha_actualizado, id_user_permiso) VALUES ('',".$id_user.", ".$serie.", 0, 1, 1,'".$hoy."', '".$hoy."', ".$id_admin." )";
									
									if (mysqli_query($dbh, $qb)) {
										
											$update_estatus = genera_check_series_premium_admin_perfil($id_user);
										
											echo '8100|1|'.$update_estatus.'||';
									} else {
													//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '8100|0|||'.mysqli_error($dbh).' '.$qb;
									}										
									
								}
		break; 		


		case 82: // Guarda Solo opcionales
		
			$id_user = $_POST['id_user'];
			
			$code_series = $_POST['code_series'];
			
			$series_opcionales = $_POST['series_op'];
						
			/// AUtomatic serie opcionales 
			
			$data_series = explode('.', $code_series); 
			$data_opcionales = explode(';',$series_opcionales);
			
			for($i=0 ; $i< count($data_opcionales); $i++){
				if($data_opcionales[$i] != '' and $data_series[$i] != '' ){
				//$q_c .= ' estado_'.$data_opcionales[$i].'='.$data_series[$i].','; 
				
				$code_op .= $data_opcionales[$i].'-'.$data_series[$i].';';
				}
			}
			
			//$q_cc = substr($q_c, 0, -1);
			$code_series = substr($code_series, 0, -1);
			
			//$qs = "UPDATE configuraciones SET ".$q_cc." where id_user = $id_user";	

								
			////////

			//guarda opcionales
						// XXXX-1;XXXX-0; 
						
						$data_col = explode(';', $code_op);
						$count = count($data_col);
						
						for($i=0; $i <= $count; $i++){
							$save_opcionales .= save_serie_opcional_admin($id_user,$data_col[$i]);
						}
						
						
						if($save_opcionales > 0){
							echo '8200|1|'.$id_user.'||'; 
						}else{
							echo '8200|0|||'.mysqli_error($dbh);
						}
									

		break; 

		case 83: // 
			$id_user= $_POST['id_user'];
			$serie= $_POST['serie'];
			$id_admin = $_POST['id_admin'];
			//$current_val= $_POST['current_val'];
			

		
			$hoy = date("Y-m-d H:i:s");
			
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$qw = "SELECT * FROM permiso_serie_opcional WHERE clave_serie = $serie and id_user = $id_user ";// preparando la instruccion sql
							    $resultw= $dbh->query($qw);						

							    
							    if ($resultw->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$roww= $resultw->fetch_assoc();

									$current_val = $roww['permiso_admin'];
									
									if($current_val==1){
										$nvo_val = 0;
										
										//$qry = ', fecha_actualizado_restriccion ='.$hoy;
									}else{
										$nvo_val = 1;
									}
									
									//$current_val_b = $roww['permiso_admin'];


	$qb = "UPDATE permiso_serie_opcional SET permiso_admin= $nvo_val, permiso_asignado = $nvo_val, fecha_actualizado= '$hoy', fecha_actualizado_restriccion='$hoy', 
			id_user_permiso = $id_admin where clave_serie = $serie and id_user = $id_user;";
							 			// preparando la instruccion sql
							 											
										if (mysqli_query($dbh, $qb)) {
											
											//$lbl_estado_nvo = crea_lbl_vista($option);
											
											//$update_estatus = genera_check_series_premium_admin_perfil($id_user);
											$update_estatus = genera_check_series_opcionales_admin_perfil($id_user);
											
																						
											echo '8300|1|'.$update_estatus.'||';

										} else {
											echo '8300|0|||'.$qb;
										}	

									
									
								}else{
									

									$qb = "INSERT INTO permiso_serie_opcional (id, id_user, clave_serie, permiso_asignado, permiso_admin, estado, fecha_registro, fecha_actualizado, fecha_actualizado_restriccion, id_user_permiso ) VALUES ('',".$id_user.", ".$serie.", 0, 0, 1,'".$hoy."', '".$hoy."', '".$hoy."',".$id_admin.")";
									
									if (mysqli_query($dbh, $qb)) {
										
											//$update_estatus = genera_check_series_premium_admin_perfil($id_user);
											$update_estatus = genera_check_series_opcionales_admin_perfil($id_user);
										
											echo '8300|1|'.$update_estatus.'||';
									} else {
													//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '8300|0|||'.mysqli_error($dbh).' '.$qb;
									}										
									
								}
		break; 			


		case 84: // Guarda Direccion
		
			$caso = $_POST['sec_perfil'];
			$id_user = $_POST['id_user'];

			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
						
			switch($caso){
				
				case 1: // Nombre
				
					$nombre = $_POST['nombre'];
					$apellido = $_POST['apellido'];
					$f_nac = $_POST['f_nac'];
					$hoy = date("Y-m-d H:i:s");


					$q = "SELECT * FROM personal WHERE id_user = $id_user ";// preparando la instruccion sql
					$result= $dbh->query($q);
							    
					if ($result->num_rows > 0) { // Si hay resultados, actualiza la info del usuario
						$qb = "UPDATE personal SET nombre = '$nombre', apellido = '$apellido', fecha_nac = '$f_nac', fecha_actualizado = '$hoy' where id_user ='$id_user'";
					}else{
						$qb = "INSERT INTO personal (id, id_user, nombre, apellido, fecha_nac, fecha_actualizado) VALUES ('', $id_user, '".$nombre."', '".$apellido."', '".$f_nac."', '".$hoy."' )";	
					}
					
					$full_name = $nombre.' '.$apellido;
					
					if (mysqli_query($dbh, $qb)) {
						
						echo '2300|1|'.mysqli_error($dbh).'||'; 
					} else {
						//echo '2300'.','.'0'.','."".','."".','.mysqli_error($dbh);
						echo '2300|0|||'.mysqli_error($dbh);
					}													
						
						
									
				break;
				
				case 2: // Usuario 
					
					$usuario = $_POST['usuario'];
					$hoy = date("Y-m-d H:i:s");

					$q = "SELECT * FROM usuarios WHERE id = $id_user and estado = 1;";// preparando la instruccion sql
					$result= $dbh->query($q);
									
							    
							if ($result->num_rows > 0) { // Si hay resultados, actualiza la info del usuario
								$roww= $result->fetch_assoc();
								//var_dump($roww['usuario']);
								
								if($roww['usuario']!= $usuario){
									$qb = "UPDATE usuarios SET usuario = '$usuario', fecha_actualizado = '$hoy' where id ='$id_user'";
									$bandera_msg = 1;
								}else{
									$bandera_msg = 0;
								}
								
								
							}else{
								$qb = "UPDATE usuarios SET usuario = '$usuario', nombre = '', fecha_actualizado = '$hoy'  where id ='$id_user'";
								$bandera_guarda = 0;
								$bandera_msg = 1;
							}
							
							
							if($bandera_msg==1){
								if (mysqli_query($dbh, $qb)) {
									
									echo '2300|1|'.mysqli_error($dbh).'||'; 
								} else {
									//echo '2300'.','.'0'.','."".','."".','.mysqli_error($dbh);
									echo '2300|0|||'.mysqli_error($dbh);
								}
							}
						
											
				break;

				case 3: // Contraseña 
					
					$pass = $_POST['pass_new'];
					$hoy = date("Y-m-d H:i:s");

					$q = "SELECT * FROM usuarios WHERE id = $id_user and estado = 1;";// preparando la instruccion sql
					$result= $dbh->query($q);
									
							    
							if ($result->num_rows > 0) { // Si hay resultados, actualiza la info del usuario

								if($pass != "X"){
									
									//$contrasenia = md5($pass);
									$contrasenia = hash('sha256',$pass);
									//$qc = ", password = '$contrasenia'";
									$qc = "UPDATE usuarios SET password = '$contrasenia', fecha_actualizado = '$hoy'  where id ='$id_user'";
									
									$reg_hist = registra_token_historial($id_user,$contrasenia);
									
									$bandera_msg = 1;
								}else{
									//$qc = "UPDATE usuarios SET usuario = '$usuario', nombre= '$full_name' where id ='$id_user'";
									$bandera_msg = 0;
									
								}
								
								
							}else{
								//$qb = "UPDATE usuarios SET usuario = '$usuario', nombre = '', fecha_actualizado = '$hoy'  where id ='$id_user'";
								$bandera_guarda = 0;
								$bandera_msg = 0;
							}
							
							
							if($bandera_msg==1){
								if (mysqli_query($dbh, $qc)) {
									
									echo '2300|1|'.mysqli_error($dbh).'||'; 
								} else {
									//echo '2300'.','.'0'.','."".','."".','.mysqli_error($dbh);
									echo '2300|0|||'.mysqli_error($dbh);
								}
							}
							
			//guarda el masterpass 

								
					 							 		
						if (mysqli_query($dbh, $qc)) {
							$estado = 2; 
						} else {
							$estado = 0; 
						}
						
											
				break;


				case 4: // Contraseña Maestra
					
					$pass = $_POST['pass_new'];
					$hoy = date("Y-m-d H:i:s");

					$q = "SELECT * FROM masterpass WHERE id_user = $id_user and estado = 1;";// preparando la instruccion sql
					$result= $dbh->query($q);
									
							    
							if ($result->num_rows > 0) { // Si hay resultados, actualiza la info del usuario

								if($pass != "X"){
									
									$contrasenia = md5($pass);
									//$qc = ", password = '$contrasenia'";
									$qc = "UPDATE masterpass SET token = '$contrasenia', fecha_actualizado = '$hoy'  where id_user =$id_user";
									$bandera_msg = 1;
								}else{
									//$qc = "UPDATE usuarios SET usuario = '$usuario', nombre= '$full_name' where id ='$id_user'";
									$bandera_msg = 0;
									
								}
								
								
							}else{
								$qc = "INSERT INTO masterpass (id, id_user, token, estado, fecha_actualizado, fecha_agregado) VALUES ('', $id_user, '".$contrasenia."', 1, '".$hoy."', '".$hoy."' )";
								$bandera_guarda = 0;
								$bandera_msg = 1;
							}
							
							
							if($bandera_msg==1){
								if (mysqli_query($dbh, $qc)) {
									
									echo '2300|1|'.mysqli_error($dbh).'||'; 
								} else {
									//echo '2300'.','.'0'.','."".','."".','.mysqli_error($dbh);
									echo '2300|0|||'.mysqli_error($dbh);
								}
							}
							
			//guarda el masterpass 

								
					 							 		
						if (mysqli_query($dbh, $qc)) {
							$estado = 2; 
						} else {
							$estado = 0; 
						}
						
											
				break;				

 				case 5: // Genera (idioma y pagina inicial
				
					$idioma = $_POST['idioma_p'];
					$pag_ini = $_POST['pagina_inicial'];
					
					$hoy = date("Y-m-d H:i:s");


					$q = "SELECT * FROM configuraciones WHERE id_user = $id_user";// preparando la instruccion sql
					$result= $dbh->query($q);
							    
					
					if ($result->num_rows > 0) { // Si hay resultados, actualiza la info del usuario
						$qp = "UPDATE configuraciones SET pagina_inicial = '$pag_ini', idioma = '$idioma', fecha_actualizado = '$hoy' where id_user = $id_user";
						
					}else{
						$qp = "INSERT INTO configuraciones(id, id_user, pagina_inicial, idioma, fecha_agregado, fecha_actualizado ) VALUES ('',$id_user,'".$pag_ini."', '".$idioma."' , '".$hoy."', '".$hoy."' )";
					}
					
					
					
					if (mysqli_query($dbh, $qp)) {
						
						echo '2300|1|'.mysqli_error($dbh).'||'; 
					} else {
						//echo '2300'.','.'0'.','."".','."".','.mysqli_error($dbh);
						echo '2300|0|||'.mysqli_error($dbh);
					}													
						
			
							
									
				break;								

 				case 6: // Genera (idioma y pagina inicial
				
					$vista_fig = $_POST['vista_f'];
					$vista_m = $_POST['vista_m'];
					$vista_s = $_POST['vista_s'];
					
					
					$hoy = date("Y-m-d H:i:s");


					$q = "SELECT * FROM configuraciones WHERE id_user = $id_user";// preparando la instruccion sql
					$result= $dbh->query($q);
							    
					
					if ($result->num_rows > 0) { // Si hay resultados, actualiza la info del usuario
						$qp = "UPDATE configuraciones SET css_figuras = '$vista_fig', vista_mosaico_minifig = $vista_m, vista_mosaico_sets = $vista_s, fecha_actualizado = '$hoy' where id_user = $id_user";
						
					}else{
						$qp = "INSERT INTO configuraciones(id, id_user, css_figuras, vista_mosaico_minifig, vista_mosaico_sets , fecha_agregado, fecha_actualizado ) VALUES ('',$id_user,'".$vista_fig."', ".$vista_m." , ".$vista_s.", '".$hoy."', '".$hoy."' )";
					}
					
					
					
					if (mysqli_query($dbh, $qp)) {
						
						echo '2300|1|'.mysqli_error($dbh).'||'; 
					} else {
						//echo '2300'.','.'0'.','."".','."".','.mysqli_error($dbh);
						echo '2300|0|||'.mysqli_error($dbh);
					}													
						
			
							
									
				break;

 				case 7: // Opcionales
				
 				$code_series = $_POST['code_series'];
 				$series_opcionales = $_POST['series_op'];
				
 				$data_series = explode('.', $code_series); 
 				$data_opcionales = explode(';', $series_opcionales);
			
					for($i=0 ; $i< count($data_opcionales); $i++){
						if($data_opcionales[$i] != '' and $data_series[$i] != '' ){
						//$q_c .= ' estado_'.$data_opcionales[$i].'='.$data_series[$i].','; 
						
						$code_op .= $data_opcionales[$i].'-'.$data_series[$i].';';
						}
					}
					
					//$q_cc = substr($q_c, 0, -1);
					//$code_series = substr($code_series, 0, -1);
					
					
						$data_col = explode(';', $code_op);
						$count = count($data_col);
						
						for($i=0; $i <= $count; $i++){
							$save_opcionales .=  save_serie_opcional($id_user,$data_col[$i]);
						}
					
					
					
					if($save_opcionales>0) {
						
						echo '2300|1|||'; 
					}else{
						//echo '2300'.','.'0'.','."".','."".','.mysqli_error($dbh);
						echo '2300|0|||';
					}																
									
				break;			

				default:
				break;
			}
			
		break; 
		
		case 85: // 
				
			$nombre= $_POST['nombre'];
			$id_user= $_POST['usuario'];
			$fini = $_POST['f_ini'];
			$usos = $_POST['usos'];
			$ffin = $_POST['f_fin'];
			$desc = $_POST['descuento'];
			$serie = $_POST['serie'];
			$estado = $_POST['estado'];
			$bandera_edit = $_POST['bandera'];
			$id_reg = $_POST['id_reg'];
			//$current_val= $_POST['current_val'];
			
			if($bandera_edit==1){
				$qw = "SELECT * FROM cupones WHERE id = $id_reg";// preparando la instruccion sql
			
			}else{
				$qw = "SELECT * FROM cupones WHERE titulo = '$nombre'";// preparando la instruccion sql
					
			}
		
		
			$hoy = date("Y-m-d H:i:s");
			
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								//$qw = "SELECT * FROM cupones WHERE id_user = $id_user and clave_serie = $serie and titulo = '$nombre'";// preparando la instruccion sql
							    $resultw= $dbh->query($qw);						

							    
							    if ($resultw->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$roww= $resultw->fetch_assoc();											
									
									if($bandera_edit==1){
										
						$qp = "UPDATE cupones SET id_user = $id_user,  clave_serie = $serie, titulo = '$nombre', no_usos= $usos, fecha_inicio = '$fini', fecha_fin= '$ffin', 
						descuento = $desc, estado = $estado, fecha_actualizado = '$hoy' where id = $id_reg";
						
										if (mysqli_query($dbh, $qp)) {								
											
												echo '8500|3|||';
										} else {
														//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
												echo '8500|0|||'.mysqli_error($dbh).' '.$qp;
										}
										
									}else{
																						
										echo '8500|2|||';	
									}								
									
								}else{									

			$qb = "INSERT INTO cupones (id, id_user, clave_serie, titulo, no_usos, privacidad,fecha_inicio, fecha_fin, descuento, estado, fecha_agregado, fecha_actualizado) VALUES ('', ".$id_user.", ".$serie.",'".$nombre."', ".$usos.", 0,'".$fini."', '".$ffin."', ".$desc.", ".$estado." , '".$hoy."','".$hoy."')";
									
									if (mysqli_query($dbh, $qb)) {								
										
											echo '8500|1|||';
									} else {
													//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '8500|0|||'.mysqli_error($dbh).' '.$qb;
									}										
									
								}
		break; 
		
		case 86: // 
				
			$codigo= $_POST['codigo'];
			$id_user= $_POST['id_user_solicitado']; 
			$serie_solicitada= $_POST['serie_solicitada'];
			
			
			// Valida la vigencia y existencia del Cupon 
			
			$vigencia_cupon = valida_vigencia_cupon($codigo,$serie_solicitada,$id_user);
			//$duplicado = valida_cupon_duplicado($id_user, $serie_solicitada);
			
			
			if($vigencia_cupon==1){
				
				$valida_uso = valida_uso_cupon($codigo,$serie_solicitada,$id_user);
				
				if($valida_uso==0){
					$resp = 9; // este cupon ya no tiene usos
				}else if($valida_uso==1){
					$resp = 1; // este cupon tiene usos
				}else if($valida_uso > 1){
					$resp = 1; // este cupon tiene usos)
				}elseif($resp=''){
					$resp = 8;
				}else{
					$resp = $valida_uso;
				}
				
				
				
			}else{
				//echo '8600|'.$vigencia_cupon.'|'.$vigencia_cupon.'||';
				
				$resp = $vigencia_cupon;
			}
			
			
			
			if($resp==1){
				
				// Saca id del cupon 
				
					$info_cupon = get_info_cupon($codigo);
					$data_cup = explode('|', $info_cupon);
					
					$id_cupon = $data_cup[0];
					$serie_cupon = $data_cup[1];
					$descuento =  $data_cup[7];

				//registra el uo del cupon 
				
				$reg_uso_cupon = registra_uso_cupon($id_user,$id_cupon,$serie_solicitada);
				

				//en caso de ser un cupon con descuento 100, registra transaxccion

					if($descuento==100){
						$reg_tras = registra_transaccion_cupon($id_user,$id_cupon,$serie_solicitada);
					}
				
				//////

				if($reg_uso_cupon==2){
					$resp = 7; 
				}else if($reg_uso_cupon==3){
					$resp = 10; 
				}else{
					$resp = $reg_uso_cupon;
				}
			}
			
			echo '8600|'.$resp.'|'.$valida_uso.'|||'.$reg_uso_cupon;
			
			//var_dump($vigencia_cupon);
			
			// Valida uso del cupon
			
		//	$uso_cupon= valida_uso_cupon($id_user,$codigo);
		
		
			
		
		break;
		
	case 87: // Cambia Estado Cupon usado
	
	$id = $_POST['id'];
					
			 	//echo $req;
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
				if ($dbh->connect_error) {
					  die("Connection failed: " . $dbh->connect_error);
				}
			 	

	
								// comprueba si ya existe el registro
								 $q = "SELECT * FROM uso_cupon WHERE id = $id ";// preparando la instruccion sql
							
							   
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
								 $row= $result->fetch_assoc(); // trae el valor del campo estado
								 
								 $estado = $row['estado']; 
								 //$title = $row['title'];
								 //$id_papa = $row['mnu_padre'];
				 
								 	if($estado == 1){ // Si el esado del registro es 1, cambialo a cero										 
					 	
							 			$qb = "UPDATE uso_cupon SET estado = 0 where id = $id ";// preparando la instruccion sql
							 			
									}elseif($estado==0) { //De lo contrario cambialo a 1	
										$qb = "UPDATE uso_cupon SET estado = 1 where id = $id";// preparando la instruccion sql
										
									}elseif($estado==999) { //De lo contrario cambialo a 1	
										$qb = "UPDATE uso_cupon SET estado = 0 where id = $id";// preparando la instruccion sql
										
									}
								
									
									if (mysqli_query($dbh, $qb)) {
						   				    //echo '2700'.','.'1'.','.$title.','.''.','."";
						   				    echo '8700|1|'.$title.'||';
						   			} else {
										    //echo '2700'.','.'0'.','."".','."".','.mysqli_error($dbh);
										    echo '8700|0|||'.$qb; 
									}
								}
			

		break;

		case 88: // desactiva cupon usado

			$id = $_POST['id'];
			$user_elim = $_POST['user_elimina'];
		//$color = $_POST['val']; 
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}

			$hoy = date("Y-m-d H:i:s");

			if($user_elim == 1){
				$estado = 999;
				$campos = ', fecha_ban_admin = "'.$hoy.'"';
			}else{
				$estado = 998;
				$campos = ', fecha_eliminado_user = "'.$hoy.'"';
			}
								 
			
					$qb = "UPDATE uso_cupon SET estado = $estado ".$campos." where id = $id";
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '2800'.','.'1'.','.$serie.','."".','."";
						echo '8800|1|'.$serie.'||';
					} else {
						//echo '2800'.','.'0'.','.$qb.','."".','.'';
						echo '8800|0|'.$qb.'||';
					}
		break;

		case 89: // Elimina Cupon

			$id = $_POST['id'];
		//$color = $_POST['val']; 
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
								 
			
					$qb = "UPDATE cupones SET estado = 999 where id = $id";
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '2800'.','.'1'.','.$serie.','."".','."";
						echo '8800|1|'.$serie.'||';
					} else {
						//echo '2800'.','.'0'.','.$qb.','."".','.'';
						echo '8800|0|'.$qb.'||';
					}
		break;		


		case 90: // Agrega configuracion

			$titulo  = $_POST['titulo'];
			$seccion = $_POST['seccion'];
		//$color = $_POST['val']; 
		$hoy = date("Y-m-d H:i:s");
		
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
								 
			
		$qb = "INSERT INTO opciones (id, titulo, seccion_padre, estado, fecha_registro, fecha_actualizado) VALUES ('', '".$titulo."', ".$seccion.",1, '".$hoy."', '".$hoy."')";
									
									if (mysqli_query($dbh, $qb)) {								
										
											echo '9000|1|||';
									} else {
													//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '9000|0|||'.mysqli_error($dbh).' '.$qb;
									}	
		break;	
		
		case 91: // Elimina Serie

			$id_config = $_POST['id_conf'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
					$qb = "DELETE FROM opciones WHERE id = $id_config ";// preparando la instruccion sql
																		
							
							if (mysqli_query($dbh, $qb)) {
								echo '9100|1|'.$serie.'||';
							} else {
								echo '9100|0|'.$qb.'||';
							}
							
						
					
		break; 

		case 92: // Agrega grupo

			$title = $_POST['title'];

			$id_u = $_POST['id_u'];
		

			$hoy = date("Y-m-d H:i:s");
		
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
								 
			
		$qr = "INSERT INTO grupos_inventario (id, id_user, nombre, fecha_registro, estado) VALUES ('', ".$id_u." ,'".$title."', '".$hoy."',1)";
									
									if (mysqli_query($dbh, $qr)) {								
										
											echo '9200|1|||';
									} else {
													//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '9200|0|||'.mysqli_error($dbh).' '.$qr;
									}	
		break;	

		case 93: // Elimina grupo

			$id_config = $_POST['id_conf'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
					$qb = "DELETE FROM grupos_inventario WHERE id = $id_config ";// preparando la instruccion sql
																		
							
							if (mysqli_query($dbh, $qb)) {
								echo '9300|1|'.$serie.'||';
							} else {
								echo '9300|0|'.$qb.'||';
							}
							
						
					
		break; 
		case 94: //Guardar lista 

			$grupo = $_POST['grupo'];
			$itms = $_POST['itm'];
			$id_user = $_POST['id_user'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
            $data_its = explode(';', $itms);
			$hoy = date("Y-m-d H:i:s");

     for($i=0; $i<= count($data_its);$i++ ){

         if($data_its[$i]!=''){
            // $qr = "INSERT INTO grupos_inventario (id, id_user, nombre, fecha_registro, estado) VALUES ('', ".$id_u." ,'".$title."', '".$hoy."',1)";

            		$qb = "UPDATE sets SET grupo = $grupo, fecha_grupo = '$hoy' where id = $data_its[$i] and id_user = $id_user";
																		
					if (mysqli_query($dbh, $qb)) {
                        
                        $result = $result +1;
                        $resb += 'OK;';
						//echo '8800|1|'.$serie.'||';
					} else {
                         $result = $result +0;
						//echo '8800|0|'.$qb.'||';
                        $resb += mysqli_error($dbh); 
					}
         }

     }
     
			
		echo '9400|1|'.$result.$resb.'||';
							
						
					
		break; 


		case 95: //quitar itm de la lista

			$grupo = $_POST['grupo'];
			$itm = $_POST['itm'];
			$id_user = $_POST['id_user'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}


            		$qb = "UPDATE sets SET grupo = 0  where id = $itm and id_user = $id_user";
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '2800'.','.'1'.','.$serie.','."".','."";
						echo '9500|1|'.$serie.'||';
					} else {
						//echo '2800'.','.'0'.','.$qb.','."".','.'';
						echo '9500|0|'.$qb.'||';
					}	
					
		break; 

		case 96: //gurda minifiguras

			$clave_serie = $_POST['clave_serie'];
			$nombresfig_serie = $_POST['nombresfig_serie'];
			
			$ext = array();
			$n_es = array();
			$n_en = array();
		


// Verifica y quita el ultiimo caracteri si es un ";"
				$ultimo_c = substr($nombresfig_serie,-1); 
							 
				if($ultimo_c == ';'){
					$nam = substr($nombresfig_serie,0,-1);
				}else{
					$nam = $nombresfig_serie; 
				}
			
			// Separa los nombres de cada personaje
			
			$data = explode(';', $nam); 
			
			for($i=0 ; $i<= sizeof($data) ; $i++ ){
				
				// separa los nombres en ES y EN
				$datab = explode(',', $data[$i]); 
				$nom_es = $datab[0]; 
				$nom_en = $datab[1];
				
				array_push($n_es, $datab[0]);
				array_push($n_en, $datab[1]);
			}
			
			$hoyb = date("Y-m-d H:i:s"); 

			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}

for($j= 0; $j< sizeof($n_es); $j++){
		
		if($n_es[$j]!= ''){
				$n= $j+1;
				$current_image = ''; 
				$current_name_es = trim($n_es[$j]); 
				$current_name_en = trim($n_en[$j]); 
				
				$cve_temp = $clave_serie.$n;
				$hoyb = date("Y-m-d H:i:s"); 

				
				$qa = "SELECT * from minifiguras where cve_lego = '".$clave_serie."' and nombre_es = '".$current_name_es."'";
				
				$resultb= $dbh->query($qa);
				
				if ($resultb->num_rows > 0) { // Si la consulta trae registro, 
						$rowb= $resultb->fetch_assoc(); 
					 
							$error_flag = intval($error_flag + 1);



							
				}else{
							
						$qb = "INSERT INTO minifiguras (id, nombre_es, nombre_en, cve_lego, imagen, tags, estado, no_folleto, piezas, fecha_registro, cve_temp) VALUES ('','".$current_name_es."', '".$current_name_en."','".$clave_serie."', '".$n."', '',1, '".$n."' , 'cabeza, torso, pies, brazo derecho, brazo izquierdo, cabello', '".$hoyb."', '".$cve_temp."' )";
											
							
						if (mysqli_query($dbh, $qb)) {
							$res_save_fig .= 'La figura <b>'. $current_name_es.' / '.$current_name_en .'</b> se ha guardado.<br>';
							echo '9600|1|'.$res_save_fig.'||';
						} else {
							$res_save_fig .= 'Error: '. mysqli_error($dbh);
							echo '9600|0|'.$qb.'||'.$res_save_fig;
						}	
				}
		}
					
}
            	
					
		break; 


case 97: //actualiza las fotos 

			$clave_serie = $_POST['clave_serie'];
			$nombresfig_serie = $_POST['nombresfig_serie'];
			$asign_serie = $_POST['asign_serie'];
			
			$ext = array();
			$n_es = array();
			$n_en = array();
		
// separa las imagenes

				$ultimo_i = substr($asign_serie,-1); 
							 
				if($ultimo_i == ';'){
					$img = substr($asign_serie,0,-1);
				}else{
					$img = $asign_serie; 
				}
				
				// separa cada imagen
				$data_img = explode(';', $img); 
				
				for($j=0; $j<= sizeof($data_img); $j++){
					// separa el nombre y la extension
					$data_ext = explode('.', $data_img[$j]);
					$nombre_base = $data_ext[0]; 
					$nombre_ext = $data_ext[1]; 
					array_push($ext, $data_ext[0]);
					
				}

// Verifica y quita el ultiimo caracteri si es un ";"
				$ultimo_c = substr($nombresfig_serie,-1); 
							 
				if($ultimo_c == ';'){
					$nam = substr($nombresfig_serie,0,-1);
				}else{
					$nam = $nombresfig_serie; 
				}
			
			// Separa los nombres de cada personaje
			
			$data = explode(';', $nam); 
			
			for($i=0 ; $i<= sizeof($data) ; $i++ ){
				
				// separa los nombres en ES y EN
				$datab = explode(',', $data[$i]); 
				$nom_es = $datab[0]; 
				$nom_en = $datab[1];
				
				array_push($n_es, $datab[0]);
				array_push($n_en, $datab[1]);
			}
			
			$hoyb = date("Y-m-d H:i:s"); 

			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}

for($j= 0; $j< sizeof($n_es); $j++){

				$n= $j+1;
				
				$current_image = trim($ext[$j]); 
				$current_name_es = trim($n_es[$j]); 
				$current_name_en = trim($n_en[$j]); 
				
				$cve_temp = $clave_serie.$n;
				
				$qa = "SELECT * from minifiguras where cve_lego = '".$clave_serie."' and cve_temp = '$cve_temp' ";
				
				$resultb= $dbh->query($qa);
				
				if ($resultb->num_rows > 0) { // Si la consulta trae registro, 
						$rowb= $resultb->fetch_assoc(); 
					 
							$error_flag = intval($error_flag + 1);

							$qc = "UPDATE minifiguras set imagen = '$current_image', no_folleto = $current_image where nombre_es = '$current_name_es';"; 
							mysqli_query($dbh, $qc);

							
				}else{
							
						$qb = "INSERT INTO minifiguras (id, nombre_es, nombre_en, cve_lego, imagen, tags, estado, no_folleto, piezas, fecha_registro) VALUES ('','".$current_name_es."', '".$current_name_en."','".$clave_serie."', '".$current_image."', '',1, '".$current_image."' , 'cabeza, torso, pies, brazo derecho, brazo izquierdo, cabello', '".$hoyb."' )";
											
							
						if (mysqli_query($dbh, $qb)) {
							$res_save_fig .= 'La figura <b>'. $current_name_es.' / '.$current_name_en .'</b> se ha guardado.<br>';
							echo '9700|1|'.$res_save_fig.'||';
						} else {
							$res_save_fig .= 'Error: '. mysqli_error($dbh);
							echo '9700|0|'.$qb.'||'.$res_save_fig;
						}	
				}

					
}
            	
					
		break; 

		case 98: //convierte la serie en teaser cuando se termina de crear

			$clave_serie= $_POST['clave_serie'];
			
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}


            		$qb = "UPDATE series SET estado = 3  where clave_lego = '$clave_serie'";
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '2800'.','.'1'.','.$serie.','."".','."";
						echo '9700|1|'.$serie.'||';
					} else {
						//echo '2800'.','.'0'.','.$qb.','."".','.'';
						echo '9700|0|'.$qb.'||';
					}	
					
		break; 

		case 99: //edita un grupo

			$nombre = $_POST['new_name'];
			$order = $_POST['new_orden'];
			$itm = $_POST['itm'];
			$id_user = $_POST['id_user'];
			$ubi = $_POST['new_ubi'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			$hoy = date("Y-m-d H:i:s"); 
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}


            		$qb = "UPDATE grupos_inventario SET nombre = '$nombre', orden= $order, fecha_actualizado = '$hoy', id_ubicacion = $ubi where id = $itm";
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '2800'.','.'1'.','.$serie.','."".','."";
						echo '9900|1|'.$serie.'||';
					} else {
						//echo '2800'.','.'0'.','.$qb.','."".','.'';
						echo '9900|0|'.$qb.'||';
					}	
					
		break; 


		case 100: //agrega a favoritos

			$user= $_POST['user'];
			$id = $_POST['registro'];
			$serie = $_POST['serie'];
			
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			$hoy = date("Y-m-d H:i:s"); 
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}


			 	$q = "SELECT * FROM coleccion WHERE item= $id and id_user = $user";
			 	$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) { // Si la consulta trae registro, 
					 $row= $result->fetch_assoc(); 
					 
					// $fav  = $row['favorito'];

						 	if($row['favorito']== 0){								
								$fav = 1;
                                $hoy = date("Y-m-d H:i:s"); 
							}else if($row['favorito']== 1){ // 
								$fav = 0;
                                $hoy= '0000-00-00 00:00:00'; 
							}

                            
						//$qb = "UPDATE coleccion SET favorito = $fav where id = $registro";
						$cve_lego = $_GET['ref'];

						$qb = "UPDATE coleccion SET favorito = $fav, fecha_fav = '$hoy' where item= $id and id_user = $user";

						$reg = $id.';'.$user;
						
						if (mysqli_query($dbh, $qb)) {
							//echo '2800'.','.'1'.','.$serie.','."".','."";
							echo '10000|1|'.$fav.'|'.$reg.'||'.$id; 
						} else {
							//echo '2800'.','.'0'.','.$qb.','."".','.'';
							echo '10000|0|'.$fav.'||';
						}								
							
						$hoy = date("Y-m-d H:i:s"); 

						
							
					 }else{ // si no hay resultado sdel query 

					 	$cve_lego = $_GET['ref'];
					 	$reg = $id.';'.$user;
					 	$fav = 1; 

					 	$qb = "INSERT INTO coleccion (id, id_user, item, estado, fecha_fav, clave_lego, favorito) VALUES ('', '".$user."','".$id."', 0, '".$hoy."' , ".$serie.",1".")";		

					 	
									   if (mysqli_query($dbh, $qb)) {
										   
										   echo '10000|2|'.$fav.'|'.$reg.'||'.$id; 
										} else {
											echo '10000|0|||'.$qb;
									    }

						// echo '10000|2|x|'.$reg.'|';  
					 }
						
					
		break; 


		case 101: // genera csv grupo sets
		
			$id_user = $_POST['id_user'];
			$id_grupo= $_POST['grupo'];
			
			//var_dump($grupo);
			
			$res = genera_csv_sets_grupo($id_grupo,$id_user);
			
			
			
			echo '10100|1|'.$res.'||';
		
		break;	

		case 102: // Agrega grupo

			$title = $_POST['title'];
			$id_u = $_POST['id_u'];
		

			$hoy = date("Y-m-d H:i:s");
		
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
								 
			
		$qr = "INSERT INTO ubicaciones_usuario (id, id_user, nombre,coordenadas,tipo, estado, fecha_agregado ) VALUES ('', ".$id_u." ,'".$title."',0,1,1,'".$hoy."')";
									
									if (mysqli_query($dbh, $qr)) {								
										
											echo '10200|1|||';
									} else {
													//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
											echo '10200|0|||'.mysqli_error($dbh).' '.$qr;
									}	
		break;	

		case 103: // Elimina grupo

			$id_config = $_POST['id_conf'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
					$qb = "DELETE FROM ubicaciones_usuario WHERE id = $id_config ";// preparando la instruccion sql
																		
							
							if (mysqli_query($dbh, $qb)) {
								echo '10300|1|'.$serie.'||';
							} else {
								echo '10300|0|'.$qb.'||';
							}
							
					
		break; 

        case 104: // Convierte imagen set en webp

           // echo '10400|1|'.$serie.'||';
            
			$tipo = $_POST['tipo'];
            $url_set = $_POST['set'];
		
        // extrae el formato 
            $data_url = explode(".", $url_set); 
            $url = $data_url[0];
            $format = $data_url[1];

        // extrae la url

        $data_url_fin = explode("/", $url_set);

            $ante = count($data_url_fin)-1;
       
        for($i=0 ; $i<count($data_url_fin) ; $i++){
            
            if($i != $ante){
                $url_fin .= $data_url_fin[$i].'/'; 
            }elseif($i == $ante){
                $url_fin .= $data_url_fin[$i].''; 
            }
        }

           $new_img = webpConvert2($url_fin);
           $name_new_img = explode('/',$new_img);
           $name_n = $name_new_img[count($name_new_img)-1];

// si el archivo existe: 
//a) mueve el archivo origen
/*
for($j=0 ; $j<count($data_url_fin)-1; $j++){
    $url_prev_img.= $data_url_fin[$j].'/'; 
}

if (file_exists($new_img)) {

    $url_prev = $url_prev_img.$format.'/';
    
   move_uploaded_file($url_set, $url_prev);
} 
*/

            echo '10400|1|'.$name_n.'||';
            

		break; 

		case 105: // cambiar ver lista 

			$id_config = $_POST['id_config'];
			$id_user = $_POST['id_user'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
			$qb = "SELECT * FROM usuario_configuraciones WHERE id_user = $id_user and id_config = $id_config ";// preparando la instruccion sql
																		
			$result= $dbh->query($qb);
							    
			if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
				$row= $result->fetch_assoc(); // trae el valor del campo estado
				
				$estado = $row['valor']; 
				$id_reg= $row['id']; 
				$hoy = date("Y-m-d H:i:s");

				if($estado == 1){ 
					$qc = "UPDATE usuario_configuraciones SET valor = 0, fecha_actualizado = '$hoy' WHERE id = $id_reg";// preparando la instruccion sql
					 		 
					if (mysqli_query($dbh, $qc)) {								   			
						echo '10500|1|'.'0'.'|||'; 
					} else {
						echo '10500|0|'.$qc.'||';
				 	}
				}else if($estado==0){

					$qc = "UPDATE usuario_configuraciones SET valor = 1, fecha_actualizado = '$hoy' where id = $id_reg";// preparando la instruccion sql
					 		 
					if (mysqli_query($dbh, $qc)) {								   			
						echo '10500|1|'.'1'.'|||';  
					} else {
						echo '10500|0|'.$qc.'||'; 
				 	}
				}
			}else{
				//$estado = 0;
				//echo '10500|0|'.mysqli_error($dbh).'|'.$qb; 
				//echo '10500|0|'.$qb.'||';
				$hoy = date("Y-m-d H:i:s");
				$qr = "INSERT INTO usuario_configuraciones (id, id_user, id_config, valor, titulo, estado, fecha_agregado, fecha_actualizado) VALUES ('', ".$id_user." , ".$id_config.",1,'barra coleccion',1,'".$hoy."','".$hoy."')";
									
				if (mysqli_query($dbh, $qr)) {								
					
						echo '10500|1|0||';
				} else {
								//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
						echo '10500|0|||'.mysqli_error($dbh).' '.$qr;
				}	


			}		
		break; 

		case 106: // cambiar ver lista

			$titulo = $_POST['title']; 			
		
			$hoy = date("Y-m-d H:i:s");
			
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$qw = "SELECT * FROM seccion WHERE titulo = $titulo;";// preparando la instruccion sql
								$resultw= $dbh->query($qw);
								
								if ($resultw->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									//$roww= $resultw->fetch_assoc();
								
									echo '10600|0|||'.mysqli_error($dbh);
								}else{
									$tot = get_total_secciones()+1;
									// $q = "INSERT INTO impresion_etiqueta_set (id, id_user, clave_lego, no_imp ) VALUES ('',".$id_user.", '".$serie."',1)";

									$qb = "INSERT INTO seccion (id, clave, titulo, estado, fecha_registro, fecha_actualizado ) VALUES ('',".$tot.", '".$titulo."',1,'".$hoy."','".$hoy."')";// preparando la instruccion sql
																		 
									if (mysqli_query($dbh, $qb)) {
										echo '10600|1|||';
									
									} else {
										echo '10600|0|||'.mysqli_error($dbh).' '.$qb;
									}	
									
							
											
																		
								}	

		
		break; 

		case 107: // cambiar ver lista 

			$id_mnu = $_POST['id_mnu'];
			//$id_user = $_POST['id_user'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
			
			
			$qb = "SELECT * FROM menus WHERE id = $id_mnu;";// preparando la instruccion sql

			$result= $dbh->query($qb);
			$row= $result->fetch_assoc();
			
				if ($result->num_rows > 0) {

					$hoy = date("Y-m-d H:i:s");
					$info_mnu = get_info_mnu($id_mnu).'|'.$hoy;
					$select_tipo = genera_select_tipo_menu($row['tipo_menu']);
					$select_padre = dropmenupadre($row['mnu_padre']);
					$select_posicion = genera_select_posicion_menu($row['nivel']);
				
					$info_mnu = str_replace('|','&',$info_mnu).'&'.$select_tipo.'&'.$select_padre.'&'.$select_posicion;

					
	
	
					if (mysqli_query($dbh, $qb)) {								   			
						echo '10700|1|'.$info_mnu.'|||'; 
					} else {
						echo '10700|0|'.$qb.'||'.$qb;
					}
				
				}else{
					
					echo '10700|0|||'.mysqli_error($dbh).' '.$qb;
				}

		
		break; 
		case 108: // re hacer la lista de imagenes sets

        

            $lista = list_set_foto('X');
            $lista = str_replace('|','-',$lista);

            echo '10800|1|'.$lista.'||'.$qb;

		
		break; 
		case 109: // re hacer la lista de imagenes sets

            $clave_pag = $_POST['clave_pag'];

            $mnu = get_pag($clave_pag);
            

            echo '10900|1|'.$mnu.'||';

		
		break; 

		case 110: // re hacer la lista de imagenes sets

			$item_id = $_POST['id_reg'];
			$tabla = $_POST['tabla'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$q = "SELECT * FROM ".$tabla." WHERE id = $item_id";// preparando la instruccion sql
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$row= $result->fetch_assoc();

										$estado = $row['estado']; 
									
									if($estado ==99) { //
										
										$qb = "UPDATE ".$tabla." SET estado = 0 where id= $item_id;";// preparando la instruccion sql
										$status = "activado en modo mantenimiento"; 

																		
									}elseif($estado == 1){
						 	
								 			$qb = "UPDATE ".$tabla." SET estado = 0 where id= $item_id;";// preparando la instruccion sql
								 			$status = "actualizado"; 
																		
									}elseif($estado == 0){
						 	
										$qb = "UPDATE ".$tabla." SET estado = 1 where id= $item_id;";// preparando la instruccion sql
										$status = "actualizado"; 
																   
							   		} // else Estado = 0									
									
										if (mysqli_query($dbh, $qb)) {
											//echo '1400'.','.'1'.','.$serie.','.$status.','."";
											echo '11000|1|'.$serie.'|'.$status.'|';
											
										} else {
											//echo '1400'.','.'0'.','."".','."".','.mysqli_error($dbh); 
											echo '11000|0|||'.mysqli_error($dbh);
										}
										
	
								
								
								}else{
									//echo '1400'.','.'0'.','."".','."".','.'error';
									echo '11000|0|||'.$q;
								}

		
		break; 
        
        case 111:
        break;
		
        case 112:

            $cve_perfil = $_POST['perfil'];
			//$tabla = $_POST['tabla'];
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}

//// ---- Permisos Pagina ------
                $qb = "SELECT * FROM permisos_pagina WHERE id_perfil = $cve_perfil and tipo=1 and estado = 1 order by id_recurso;";// preparando la instruccion sql

                $resultb= $dbh->query($qb);
    
    
                if ($resultb->num_rows > 0) {
                    
                    $num = 0; 
                    
                    while($row= $resultb->fetch_assoc()){
                        $num = $num +1;	
                        
                        $info_mnu = get_info_mnu($row['id_recurso']);
                        $data_mnu = explode('|',$info_mnu); 
                        $titulo_mnu = $data_mnu[2];
                        $icono_mnu = $data_mnu[3];
 
                        $lista .= $row['id_recurso'].';';
                        $option .= '<option class="text-muted" style="font-size:0.6rem; border-bottom: 1px solid #f3f3f3; padding:5px;" value="'.$row['id_recurso'].'">'.$num.'. [ '.$row['id_recurso'].' ] - <i class="fa-solid fa-'.$icono_mnu.'"> </i> '.$titulo_mnu.'</b> </option>';

                    }
                }else{
                        $lista = ''; 
                        $option = '';
                }
/////------------------------////


//// ---- Permisos Config ------
                $qc = "SELECT * FROM permisos_pagina WHERE id_perfil = $cve_perfil and tipo=2 and estado = 1 order by id_recurso;";// preparando la instruccion sql

                $resultc= $dbh->query($qc);
    
    
                if ($resultc->num_rows > 0) {
                    
                    $num = 0; 
                    
                    while($rowc= $resultc->fetch_assoc()){
                        $numc = $numc +1;	
                        
                        $info_conf = get_info_conf($rowc['id_recurso']);
                        $data_conf = explode('|',$info_conf); 
                        $titulo_conf = $data_conf[0];
 
                        $listab .= $rowc['id_recurso'].';';

                        $optionb .= '<option class="text-muted" style="font-size:0.6rem; border-bottom: 1px solid #f3f3f3; padding:5px;" value="'.$rowc['id_recurso'].'">'.$numc.'. [ '.$rowc['id_recurso'].' ] - '.$titulo_conf.'</b> </option>';

                    }
                }else{
                        $listab = ''; 
                        $optionb = '';
                }
/////------------------------////
               
                    echo '11200|1|'.$lista.'|'.$option.'||'.$listab.'|'.$optionb;
                
                    //echo '11200|0|||'.mysqli_error($dbh);
                

        break;

        case 113: // guarda nuevo perfil
             
            $clave= $_POST['clave'];
            $nombre= $_POST['nombre'];
            $nombre_cto= $_POST['nombre_cto'];
            $icono= $_POST['icono'];
            $edo= $_POST['edo'];
            $permisos= $_POST['permisos'];
            $permisos_conf= $_POST['permisos_conf'];

            if($icono==''){
                $ico = 'fa fa-cog';
            }else{
                $ico = $icono;
            }

	            $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}

                // comprueba que no existe el registro en la tabla perfiles

                    $qb = "SELECT * FROM perfiles where cve_perfil = $clave;";// preparando la instruccion sql

                    $resultb= $dbh->query($qb);
                    $row= $resultb->fetch_assoc();
                       

                    if ($resultb->num_rows > 0) {
                        $bandera_add = 0;  
                        echo '11300|0|||'.mysqli_error($dbh);                         
                    }else{                                
                       $bandera_add = 1;
                    }
                ////////

                if($bandera_add==1){

                   $hoy = date("Y-m-d H:i:s");

            $qc = "INSERT INTO perfiles (id, cve_perfil, nombre, estado, nombre_corto, icono, color, fecha_registro, fecha_actualizado) VALUES ('',".$clave.", '".$nombre."',".$edo.", '".$nombre_cto."', '".$ico."', 'muted' , '".$hoy."', '".$hoy."')";
						// preparando la instruccion sql
						
            if (mysqli_query($dbh, $qc)) {
               // echo '11300|1|'.$lista.'|'.$option.'|';
                $bandera_paso_permisos = 1;
                
            } else {
                echo '11300|0|||'.mysqli_error($dbh);
                 $bandera_paso_permisos = 0;
            } 

            //// si el campo permisos esta lleno guarda los permisos de pagina

            if($permisos!=0){

                $info_permisos = explode(';',$permisos);

                $tam = count($info_permisos);
                $hoyb = date("Y-m-d H:i:s");

                for($i=0; $i<$tam; $i++){

                    if($info_permisos[$i]!=''){

                        $qd = "SELECT * FROM permisos_pagina WHERE id_recurso = $info_permisos[$i] and id_perfil = $clave and tipo=1;";// preparando la instruccion sql					
						$result= $dbh->query($qd);
                        $row= $result->fetch_assoc();
								    
                        if ($result->num_rows > 0) { 
                            //$qd = "UPDATE permisos_pagina SET estado = $per, fecha_actualizado = '$hoyb' where id_recurso =$id_menu and id_perfil = $id_perfil and tipo = 1;";
                            //mysqli_query($dbh, $qd);	
                            echo '11300|2|||'.mysqli_error($dbh);				
                        }else{
                            $qe = "INSERT INTO permisos_pagina (id, id_perfil, id_recurso, tipo, estado, fecha_registro) VALUES ('', ".$clave.",".$info_permisos[$i].", 1, 1, '".$hoyb."');";				
                            mysqli_query($dbh, $qe);
                            
                          //  echo '11300|1|'.$lista.'|'.$option.'|';
                        }


                    }

                }
                

            } // Prmisos

            
            if($permisos_conf !=0){

                $info_permisosb = explode(';',$permisos_conf);

                $tamb = count($info_permisosb);
                $hoybb = date("Y-m-d H:i:s");

                for($j=0; $j<$tamb; $j++){

                    if($info_permisosb[$j]!=''){

                        $qdb= "SELECT * FROM permisos_pagina WHERE id_recurso = $info_permisosb[$j] and id_perfil = $clave and tipo=2;";// preparando la instruccion sql					
						$resultbb= $dbh->query($qdb);
                        $rowb= $resultbb->fetch_assoc();
								    
                        if ($resultbb->num_rows > 0) { // Si hay resultados, actualiza la info del usuario
                            //$qd = "UPDATE permisos_pagina SET estado = $per, fecha_actualizado = '$hoyb' where id_recurso =$id_menu and id_perfil = $id_perfil and tipo = 1;";
                            //mysqli_query($dbh, $qd);					
                        }else{
                            $qeb = "INSERT INTO permisos_pagina (id, id_perfil, id_recurso, tipo, estado, fecha_registro) VALUES ('', ".$clave.",".$info_permisosb[$j].", 2, 1, '".$hoybb."');";				
                            mysqli_query($dbh, $qeb);
                            
                            echo '11300|1|||';
                        }


                    }

                }
                

            } // Prmisos
                
        
        }//bandera == 1

        break; 
 
        case 114: // actualiza info perfil
		
            $clave = $_POST['clave']; 
            $nombre = $_POST['nombre']; 
            $nombre_cto = $_POST['nombre_cto']; 
            $icono = $_POST['icono']; 
            $edo = $_POST['edo']; 
            $color = $_POST['color'];
            $id = $_POST['id']; 
            
            $hoy = date("Y-m-d H:i:s");
            
                $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
                
                if ($dbh->connect_error) {
                    die("Connection failed: " . $dbh->connect_error);
                }
                        $qb = "UPDATE perfiles SET  cve_perfil = $clave, nombre = '$nombre', nombre_corto = '$nombre_cto', icono= '$icono', color= '$color', estado = $edo, fecha_actualizado = '$hoy' where id = $id";// preparando la instruccion sql
                                                                            
                        if (mysqli_query($dbh, $qb)) {
                            //echo '1500'.','.'1'.','.$serie.','."".','.""; 
                            echo '11400|1|'.$serie.'||';
                        } else {
                            //echo '1500'.','.'0'.','.$qb.','."".','.''; 
                            echo '11400|0|'.$qb.'||'.$qb;
                        }
                                    
            
            break; 

            case 115: 

                $id_user= $_POST['id_user'];
                $id_item = $_POST['id_item'];
		
                if($id_user!='' or $id_user!=0){
                    
                        $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
        
                            if ($dbh->connect_error) {
                                die("Connection failed: " . $dbh->connect_error);
                            }
            
                            $hoy = date("Y-m-d H:i:s");
                            
                            // comprueba si ya existe el registro
                             $q = "SELECT * FROM coleccion WHERE item = '$id_item' and id_user= $id_user";// preparando la instruccion sql
                        
                           
                            $result= $dbh->query($q);
                            
                            if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
                             $row= $result->fetch_assoc(); // trae el valor del campo estado
                             
                             $estado = $row['estado']; 
                             $hoy = date("Y-m-d H:i:s");
             
                                 if($estado == 1){ // Si el esado del registro es 1, cambialo a cero
                                     
                                                  
                                     $qb = "UPDATE coleccion SET estado = 0, fecha_admin_add = '$hoy' where item='$id_item' and id_user= $id_user";// preparando la instruccion sql
                          
                                       if (mysqli_query($dbh, $qb)) {								   		
                                               echo '11500|1|'.$nombre_minifig.'|'.$item.'||'.$tot_user; 
                                       } else {
                                              
                                            echo '11500|0|||'.mysqli_error($dbh).'|'.$tot_user;  
                                    }
                     
                
                                }elseif($estado ==0) { //De lo contrario cambialo a 1

                                    $qb = "UPDATE coleccion SET estado = 1 where item='$id_item' and id_user= $id_user";// preparando la instruccion sql

                                       if (mysqli_query($dbh, $qb)) {                                             
                                            echo '11500|1|'.$nombre_minifig.'|'.$item.'||'.$tot_user; 
                                        } else {
                                           
                                            echo '11500|0|||'.mysqli_error($dbh).'|'.$tot_user; 
                                        }
                                } // else Estado = 0
            
                            }else{ // Si la consulta no trea registros, lo inserta activo. 
                                

                             echo '11500|0||| Error en consulta:'.mysqli_error($dbh).'|'.$tot_user; 
                                    
                            }	
                                    
                }else{
                        echo "<span class=\"theme_color\"> 
                        <i class=\"fa fa-times\"> </i> Usuario no encontrado </b> 
                        </span>";
                }

            break;

			case 116: //agrega a favoritos

				$user= $_POST['user'];
				$id = $_POST['registro'];
				
			
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
				$hoy = date("Y-m-d H:i:s"); 
				
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
	
	
					 $q = "SELECT * FROM coleccion WHERE item= $id and id_user = $user";
					 $result= $dbh->query($q);
						
						if ($result->num_rows > 0) { // Si la consulta trae registro, 
						 $row= $result->fetch_assoc(); 
						 
						// $fav  = $row['favorito'];
	
								 if($row['favorito']== 0){								
									$fav = 1;
									$hoy= '0000-00-00 00:00:00'; 
								}else if($row['favorito']== 1){ // 
									$fav = 0;
									$hoy = date("Y-m-d H:i:s");
									
								}
	
								
							//$qb = "UPDATE coleccion SET favorito = $fav where id = $registro";
	
							$qb = "UPDATE coleccion SET favorito = $fav, fecha_admin_fav = '$hoy' where item= $id and id_user = $user";
	
							$reg = $id.';'.$user;
							
							if (mysqli_query($dbh, $qb)) {
								//echo '2800'.','.'1'.','.$serie.','."".','."";
								echo '11600|1|'.$fav.'|'.$reg.'||'.$id; 
							} else {
								//echo '2800'.','.'0'.','.$qb.','."".','.'';
								echo '11600|0|'.$fav.'||';
							}								
								
	
								
						 }
							
						
			break; 

            case 117: // 
                $id_user= $_POST['id_user'];
                $serie= $_POST['serie'];
                $id_admin = $_POST['id_admin'];
                //$current_val= $_POST['current_val'];
                
    
            
                $hoy = date("Y-m-d H:i:s");
                
                $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
                
                    if ($dbh->connect_error) {
                        die("Connection failed: " . $dbh->connect_error);
                    }
                                    
                                    // comprueba si ya existe el registro
                                    $qw = "SELECT * FROM permiso_serie WHERE clave_serie = $serie and id_user = $id_user ";// preparando la instruccion sql
                                    $resultw= $dbh->query($qw);						
    
                                    
                                    if ($resultw->num_rows > 0) { // Si la consulta trae registro, cambia el estado
                                        $roww= $resultw->fetch_assoc();
    
                                        $current_val = $roww['permiso_admin'];
                                        
                                        if($current_val==1){
                                            $nvo_val = 0;
                                            
                                            //$qry = ', fecha_actualizado_restriccion ='.$hoy;
                                        }else{
                                            $nvo_val = 1;
                                        }
                                        
                                        //$current_val_b = $roww['permiso_admin'];
    
    
        $qb = "UPDATE permiso_serie SET permiso_admin= $nvo_val, permiso_asignado = $nvo_val, fecha_actualizado= '$hoy', fecha_actualizado_restriccion='$hoy', 
                id_user_permiso = $id_admin where clave_serie = $serie and id_user = $id_user;";
                                             // preparando la instruccion sql
                                                                             
                                            if (mysqli_query($dbh, $qb)) {
                                                
                                                //$lbl_estado_nvo = crea_lbl_vista($option);
                                                
                                                //$update_estatus = genera_check_series_premium_admin_perfil($id_user);
                                               // $update_estatus = genera_check_series_admin_perfil($id_user);
                                                
                                                                                            
                                                echo '11700|1|'.$update_estatus.'||';
    
                                            } else {
                                                echo '11700|0|||'.$qb;
                                            }	
    
                                        
                                        
                                    }else{
                                        
    
                                        $qb = "INSERT INTO permiso_serie (id, id_user, clave_serie, permiso_asignado, permiso_admin, estado, fecha_registro, fecha_actualizado, fecha_actualizado_restriccion, id_user_permiso ) VALUES ('',".$id_user.", ".$serie.", 0, 0, 1,'".$hoy."', '".$hoy."', '".$hoy."',".$id_admin.")";
                                        
                                        if (mysqli_query($dbh, $qb)) {
                                            
                                                //$update_estatus = genera_check_series_premium_admin_perfil($id_user);
                                                $update_estatus = genera_check_series_admin_perfil($id_user);
                                            
                                                echo '11700|1|'.$update_estatus.'||';
                                        } else {
                                                        //echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
                                                echo '11700|0|||'.mysqli_error($dbh).' '.$qb;
                                        }										
                                        
                                    }
            break;


		case 118: // Elimina cupon usado

			$id = $_POST['id'];
			$user_elim = $_POST['user_elimina'];
		//$color = $_POST['val']; 
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}

								 
			
					//$qb = "DELETE from uso_cupon SET estado = $estado ".$campos." where id = $id";
					$qb = "DELETE FROM uso_cupon WHERE id = $id";// preparando la instruccion sql
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '2800'.','.'1'.','.$serie.','."".','."";
						echo '11800|1|'.$serie.'||';
					} else {
						//echo '2800'.','.'0'.','.$qb.','."".','.'';
						echo '11800|0|'.$qb.'||';
					}
		break;

		case 119: // Elimina cupon usado

			$id = $_POST['id'];
			$user_elim = $_POST['user_elimina'];
		//$color = $_POST['val']; 
		
			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}

								 
			
					//$qb = "DELETE from uso_cupon SET estado = $estado ".$campos." where id = $id";
					$qb = "DELETE FROM cupones WHERE id = $id";// preparando la instruccion sql
																		
					if (mysqli_query($dbh, $qb)) {
						//echo '2800'.','.'1'.','.$serie.','."".','."";
						echo '11900|1|'.$serie.'||';
					} else {
						//echo '2800'.','.'0'.','.$qb.','."".','.'';
						echo '11900|0|'.$qb.'||';
					}
		break;

		case 120: // 

			$nuevo_name = $_POST['nvo_nombre'];
			$current_name = $_POST['current_nombre'];
			$current_ext = $_POST['current_ext'];
			$serie = $_POST['serie'];

			$dir = 'minifig/'.$serie.'/';

			$rutaArchivoa = $dir.$current_name.$current_ext;
			$rutaArchivob = $dir.$nuevo_name.$current_ext;

			//var_dump($rutaArchivo1);

			if(rename($rutaArchivoa, $rutaArchivob)) {
				echo '12000|1|'.$serie.'||';
		 	} else {
				//var_dump($rutaArchivoa);
				echo '12000|0|||'.$rutaArchivoa;
		 	}
								 
			

		break;

		case 121: // Elimina cupon usado

			$ruta = $_POST['ruta'];


			$dir = opendir($ruta);
			while(false !== ( $file = readdir($dir)) ) {
				if (( $file != '.' ) && ( $file != '..' )) {
					$full = $src . '/' . $file;
					if ( is_dir($full) ) {
						rrmdir($full);
					}
					else {
						unlink($full);
					}
				}
			}
			closedir($dir);
			rmdir($ruta);

			echo '12100|1|'.$serie.'||';
		break;
		case 122: // Elimina cupon usado

			$ruta = $_POST['ruta'];
			$nombre_dir = $_POST['nombre_dir'];

			$micarpeta = $ruta.$nombre_dir;
			//$micarpeta = '/ruta/miserver/public_html/carpeta';

			if (!file_exists($micarpeta)) {
				mkdir($micarpeta, 0777, true);
				echo '12200|1|'.$serie.'||';
			}else{
				echo '12200|0|'.$serie.'||';
			}

			closedir($dir);
			

			
		break;

		case 123: // Elimina cupon usado

			$ruta = $_POST['ruta'];
			$archivo = $_POST['archivo'];
			$nombre_dir_bk = 'bckup';

			$current = $ruta.$archivo;
			$bck_nvo = $ruta.$nombre_dir_bk;
			$final = $ruta.$nombre_dir_bk.'/'.$archivo;

			if (!file_exists($bck_nvo)) {
				mkdir($bck_nvo, 0777, true);				
				copy($current,$final);
				unlink($current);

				$rech_img = labels_admin_fotos_url($ruta,1); 

				echo '12300|1|'.$rech_img.'|'.$rech_img.'|';
			}else{

				copy($current,$final);
				unlink($current);
				$rech_img = labels_admin_fotos_url($ruta,1); 
				echo '12300|1|'.$rech_img.'||';
			}

			closedir($dir);
			

			
		break;

		case 124: // Elimina cupon usado

			$ruta = $_POST['ruta'];
			$archivo = $_POST['archivo'];
			$nombre_dir_bk = 'bckup';

			$current = $ruta.$archivo;
			//$current_file = $raiz_nvo = $ruta.$nombre_dir_bk;
			$data = explode('/',$current);
			$dir_origen = $data[0].'/'.$data[1].'/'.$archivo;
			//$final = $ruta.$nombre_dir_bk.'/'.$archivo;

			if (!file_exists($dir_origen)){

				copy($current,$dir_origen);
				unlink($current);
				$rech_img = labels_admin_fotos_url($ruta,1);
				echo '12400|1|'.$rech_img.'||';
				
				//minifig/71047/bckup/8.webp
			}else{

				echo '12400|0|'.$current.'||'.$current;
			}

			//closedir($dir);
		
		break;

        case 125: // Elimina cupon usado

            $id_user = $_POST['user'];
            $id_minifig = $_POST['id_minifig'];
            $total_minifig = $_POST['total_minifig'];
            $precio = $_POST['precio'];

            if($id_user != "" or $id_user != 0){
                $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
                //informacion de acceso a la bd
                // Check connection
                if ($dbh->connect_error) {
                    die("Connection failed: " . $dbh->connect_error);
                }
                
                
                $q = "UPDATE coleccion SET no_extra = $total_minifig, precio = $precio where item  = '$id_minifig' and id_user = '$id_user'";// preparando la instruccion sql
                
            //	echo $q;
                
                if (mysqli_query($dbh, $q)) {
       
                  // echo $item; 
                //  $nombre_fig = get_data($item,$index);
                  
                  // estado, mensaje, id. : (0-1, texto , 8834-01)
                  // echo '800'.','.'1'.','.$nombre_fig.','.$item.','."";
                   echo '12500|1|'.$nombre_fig.'|'.$item.'|';
                   
                  //echo "<span class=\"theme_color\"> <i class=\"fa fa-check\"> </i> El nombre de <b>".$nombre_fig."</b> se han actualizado.</span>";
                
                } else {
                    //echo '800'.','.'0'.','."".','."".','.mysqli_error($dbh);
                    echo '12500|0|||'.mysqli_error($dbh);  
                    
                  //echo "Error: " . $q . "<br>" . mysqli_error($dbh);
                }
            }else{
                $error = 'Para poder guardar las piezas faltantes deberá iniciar sesion'; 
                //echo '800'.','.'0'.','."".','."".','.$error;
                echo '12500|0|||'.$error;  
            }
		
		break;

        case 126: // Elimina cupon usado

            $id_user = $_POST['user'];
            $id_minifig = $_POST['id_minifig'];

            $lbl_barcode = genera_barcode_label_minifig($id_minifig,$id_user);
            $lbl_barcode = str_replace('|', '-', $lbl_barcode);


            $info_min = get_all_data_minifig($id_minifig);
            $data_min = explode('/',$info_min);
            $fecha_add = formatFechaHora($row['fecha_registro']);
            //$dato_encontrado = $row['nombre_es'].' / '.$row['nombre_en'].'/'.$row['cve_lego'].'/'.$row['imagen'].'/'.$row['tags'].'/'.$row['estado'].'/'.$row['no_folleto'].'/'.$row['piezas'].'/'.$row['fecha_registro'].'/'.$row['fecha_actualizado'].'/'.$tot_fig;

            $nombre_es = $data_min[0];
            $nombre_en = $data_min[1];
            $img = $data_min[3];
            $no_folleto = $data_min[6];
            $serie_disp = $data_min[2];// background: url(\'assets/images/bg_pattern_30.png\') center no-repeat;

            $img_minifig = '
            <div class="border" id="hold_minifig" style="padding:0px 3px; width:250px; position:relative; text-align: center; background: url(\'assets/images/bg_pattern_30.png\') center no-repeat;" >
                <img src="minifig/'.$serie_disp.'/'.$img.'.webp" style=" max-width:248px; height:280px; margin:10px auto;" id="img_'.$id_minifig.'" > 
                <div style="position:absolute; top:65%; background:rgba(250,250,250,0.7); width: 100%;font-weight:600; font-family: \'Kanit\', sans-serif; text-align:center; "> 
                    <span style="display:block; font-size:1.5rem; color:rgba(20, 28, 27,0.8);">'.$nombre_es.'</span>
                    <span style="display:block; font-size:0.9rem; color:rgba(20, 28, 27,0.6);">'.$nombre_en.'</span> 
                </div>
            </div>';
            $label_name =  $serie_disp.'_'.trim(strtolower($nombre_es)); 
            $label_name = str_replace(" ","_",$label_name);
            $label_name = quita_acento($label_name);

                if($lbl_barcode!=''){
                    echo '12600|1|'.$lbl_barcode.'|'.$img_minifig.'||'.$label_name;
                }else{
                    echo '12600|0|'.$nombre_fig.'|'.$item.'|';
                }

		
		break;
		case 127: // genera csv grupo sets
		
			$id_user = $_POST['id_user'];
			$serie= $_POST['serie'];
			
			$res = genera_csv_minifig_extra($serie,$id_user);
			
			echo '12700|1|'.$res.'||';
		
		break;

        case 128: // Ver codigo de barras set

            $user_id = $_POST['user'];
            $clave_lego= $_POST['set'];
            $formato = $_POST['format'];

            $lbl_barcode_set = genera_barcode_label_clavelego($clave_lego,$formato,$user_id);
            $lbl_barcode_set = str_replace('|', '-', $lbl_barcode_set);

                if($lbl_barcode_set != ''){
                    echo '12800|1|'.$lbl_barcode_set.'|'.$item.'|';
                }else{
                    echo '12800|0|'.$lbl_barcode_set.'|'.$item.'|'.$lbl_barcode_set;
                }

		
		break;

        case 129: // Elimina cupon usado

            //$id_user = $_POST['user'];
            $id_minifig = $_POST['id_minifig'];

           // $lbl_barcode = genera_barcode_label_minifig($id_minifig,$id_user);
            //$lbl_barcode = str_replace('|', '-', $lbl_barcode);


            $info_min = get_all_data_minifig($id_minifig);
            $data_min = explode('/',$info_min);
            $fecha_add = formatFechaHora($row['fecha_registro']);
            //$dato_encontrado = $row['nombre_es'].' / '.$row['nombre_en'].'/'.$row['cve_lego'].'/'.$row['imagen'].'/'.$row['tags'].'/'.$row['estado'].'/'.$row['no_folleto'].'/'.$row['piezas'].'/'.$row['fecha_registro'].'/'.$row['fecha_actualizado'].'/'.$tot_fig;

            $nombre_es = $data_min[0];
            $nombre_en = $data_min[1];
            $img = $data_min[3];
            $no_folleto = $data_min[6];//background:rgba(221, 236, 240,1);
            $serie_disp = $data_min[2];// background: url(\'assets/images/bg_pattern_30.png\') center no-repeat;

            $img_minifig = '
            <div class="border" id="hold_minifig" style="padding:0px 3px; width:505px; height:505px; position:relative; text-align: center; background: url(\'assets/images/bg_pattern_30.png\') repeat; " >
                <img src="minifig/'.$serie_disp.'/'.$img.'.webp" style=" max-width:90%; height:435px; margin:20px auto;" id="img_'.$id_minifig.'" > 
                <div style="position:absolute; top:65%; background:rgba(250,250,250,0.7); width: 100%;font-weight:600; font-family: \'Kanit\', sans-serif; text-align:center; "> 
                    <span style="display:block; font-size:1.3rem; color:rgba(20, 28, 27,0.8);">'.$nombre_es.'</span>
                    <span style="display:block; font-size:0.9rem; color:rgba(20, 28, 27,0.6);">'.$nombre_en.'</span> 
                </div>
            </div>';
            $label_name =  $serie_disp.'_'.trim(strtolower($nombre_es)); 
            $label_name = str_replace(" ","_",$label_name);
            $label_name = quita_acento($label_name);

                if($img_minifig!=''){
                    echo '12900|1|'.$img_minifig.'|'.$img_minifig.'||'.$label_name;
                }else{
                    echo '12900|0|'.$nombre_fig.'|'.$item.'|';
                }

		
		break;

        case 130: // Elimina cupon usado

            $ids_minifig = $_POST['ids_minifig'];
            $user = $_POST['user'];

            $data_mf = explode('|',$ids_minifig);

            $total_card = count($data_mf)-1;

            if($total_card==1){
                $width = (100/$total_card)-25;
                $height = (100/$total_card)-50;
                $max_width = 40;
            }elseif($total_card==2){
                $width = (100/$total_card)-15;
                $height = (100/$total_card)-25;
                $max_width = 80;
            }else{
                $width = (100/$total_card);
                $height = (100/$total_card)-25;
                $max_width =  80;
            }

            

            //if($total_card)
            $precio_final = 0;
            for($i=0;$i<count($data_mf);$i++){

                if($data_mf[$i]!=''){
                    $margin = random_int(0, 10);
                    $info_min = get_all_data_minifig($data_mf[$i]);
                    $data_min = explode('/',$info_min);
                    $fecha_add = formatFechaHora($row['fecha_registro']);
                    //$dato_encontrado = $row['nombre_es'].' / '.$row['nombre_en'].'/'.$row['cve_lego'].'/'.$row['imagen'].'/'.$row['tags'].'/'.$row['estado'].'/'.$row['no_folleto'].'/'.$row['piezas'].'/'.$row['fecha_registro'].'/'.$row['fecha_actualizado'].'/'.$tot_fig;

                    $nombre_es = $data_min[0];
                    $nombre_en = $data_min[1];
                    $img = $data_min[3];
                    $no_folleto = $data_min[6];//background:rgba(221, 236, 240,1);
                    $serie_disp = $data_min[2];// background: url(\'assets/images/bg_pattern_30.png\') center no-repeat;

                    $nom_serie = busca_serie($serie_disp);

                    /// item-user-clave
                    $id_item_search = $data_mf[$i].';'.$user.';'.$serie_disp;
                    $datab = busca_coleccion($id_item_search ); 
                    //echo($data);
                    $data_coleccion = explode(';', $datab); 

                    $precio = $data_coleccion[15];
                    $precio_final = $precio_final + $precio;
                    //	$datas = $row['faltantes'].';'.$row['fecha_registro'].';'.$row['estado'].';'.$row['favorito'].';'.$row['id'].';'.$row['id_user'].';'.$row['item'].';'.$row['clave_lego'].';'.$row['no_extra'].';'.$row['mostrar_mkt'].';'.$row['fecha_actualizado'].';'.$row['fecha_fav'].';'.$row['fecha_admin_fav'].';'.$row['fecha_admin_add'].';'.$tot.';'.$row['precio'];  


                    $img_minifig .= '
                    <div class="" style="padding:0px 3px; width:'.$width.'%; height:80%; position:relative; text-align: center; background: rgba(255,255,255,0.6); margin:'.$margin.'% auto; " >
                        <img src="minifig/'.$serie_disp.'/'.$img.'.webp" style=" max-width:'.$max_width.'%; height:'.$height.'%; margin:10px auto;" id="img_'.$id_minifig.'" > 
                        <div style="position:absolute; top:65%; background:rgba(250,250,250,0.7); width: 100%; font-weight:600; font-family: \'Kanit\', sans-serif; text-align:center; "> 
                            <span style="display:block; font-size:100%; color:rgba(20, 28, 27,0.8);">'.$nombre_es.'</span>
                            <span style="display:block; font-size:80%; color:rgba(20, 28, 27,0.6);">'.$nombre_en.'</span> 
                        </div>
                    </div>';

                    $hoy = date("s");

                    $title_name =  $serie_disp.' - '.trim(strtolower($nom_serie)); 
                    $label_name =  $serie_disp.'_'.trim(strtolower($nom_serie)).'_'.$hoy; 
                    $label_name = str_replace(" ","_",$label_name);
                    $label_name = quita_acento($label_name);
                   // $label_name = $serie_disp.' - '.$nom_serie;
                }

            }

                if($img_minifig!=''){
                    echo '13000|1|'.$img_minifig.'|'.$label_name.'||'.$title_name.'|'.$precio_final;
                }else{
                    echo '13000|0|'.$nombre_fig.'|'.$item.'|';
                }

		
		break;
		case 131: // 

			$nuevo_name = $_POST['nvo_nombre'];
			$current_name = $_POST['current_nombre'];
			$current_ext = '.'.$_POST['current_ext'];

			$dir = 'assets/images/sets/';
            //assets/images/sets/90750_testwebp


			$rutaArchivoa = $dir.$current_name.$current_ext;
			$rutaArchivob = $dir.$nuevo_name.$current_ext;

			//var_dump($rutaArchivo1);

			if(rename($rutaArchivoa, $rutaArchivob)) {
				echo '13100|1|||';
		 	} else {
				//var_dump($rutaArchivoa);
				echo '13100|0|||'.$rutaArchivoa;
		 	}
								 
			

		break;

		case 132:

			$item = $_POST['item'];
			$formato = $_POST['formato'];

			$data_item = explode('-',$item);
			$id_user = $data_item[1];
			$serie = $data_item[0];


			$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
						
			
				// Busca el registros en la tabla series, para comprobar que no esta duplicado
				
				$q = "SELECT * FROM impresion_etiqueta_set WHERE clave_lego = '$serie' and id_user = $id_user";
			 	$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) { // Si la consulta trae registro, 
					 $row= $result->fetch_assoc(); 

						$current = $row['no_imp'];
						$new_cant = $current +1;
					 
					 	$qc = "UPDATE impresion_etiqueta_set SET no_imp = $new_cant where clave_lego= '$serie' and id_user = $id_user; ";// preparando la instruccion sql					 
					
						if (mysqli_query($dbh, $qc)) {
							$lbl_barcode = genera_barcode_label_clavelego($serie,$formato,$id_user);
							$lbl_barcode = str_replace('|', '!', $lbl_barcode);
							$no_impresiones = get_impresiones($serie,$id_user);
							echo '13200|1|'.$lbl_barcode.'|'.$serie.'-'.$no_impresiones.'|';
						} else {
							echo '13200|0|||'.mysqli_error($dbh).' '.$qc;
						}
					
					}else{
						
				$q = "INSERT INTO impresion_etiqueta_set (id, id_user, clave_lego, no_imp ) VALUES ('',".$id_user.", '".$serie."',1)";
											
							if (mysqli_query($dbh, $q)) {
								$lbl_barcode = genera_barcode_label_clavelego($serie,$formato,$id_user);
								$lbl_barcode = str_replace('|', '!', $lbl_barcode);

								$no_impresiones = get_impresiones($serie,$id_user);

								echo '13200|1|'.$lbl_barcode.'|'.$serie.'-'.$no_impresiones.'|';

							} else {
								echo '13200|0|||'.mysqli_error($dbh).' '.$q;
								
							}
						
						
					}

					
				
		break;

		case 133:	
			
			$id = $_POST['id'];
			$clave= $_POST['clave'];
			$nombre = $_POST['nombre'];
			$nombre_cto= $_POST['nombre_cto'];
			$icono = $_POST['icono'];
			$estado = $_POST['estado'];
			$color = $_POST['color'];
			//$id = $_POST['id'];
			
			
					$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

			if ($dbh->connect_error) {
				die("Connection failed: " . $dbh->connect_error);
			}
							
							// comprueba si ya existe el registro
							$q = "SELECT * FROM perfiles WHERE id = $id";// preparando la instruccion sql
							$result= $dbh->query($q);
							
							if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
								$row= $result->fetch_assoc();
							
									
									
									$qb = "UPDATE perfiles SET estado = $estado, nombre = '$nombre', nombre_corto = '$nombre_cto', icono = '$icono', color = '$color' where id = $id ";// preparando la instruccion sql										
																		
									if (mysqli_query($dbh, $qb)) {
										//echo '1700'.','.'1'.','.$usuario.','.$status.','."";
										echo '13300|1|||'; 
									} else {
										//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
										echo '13300|0|||'.mysqli_error($dbh);
									}
							
							
							}			
	break;
	case 134:	
			
		$id_user = $_POST['id_user'];
		$foto = $_POST['foto'];
			

						   
		   $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
				   //informacion de acceso a la bd
				   // Check connection
		   if ($dbh->connect_error) {
				 die("Connection failed: " . $dbh->connect_error);
		   }
		   
		   $qb = "UPDATE usuarios SET foto = '$foto' where id = $id_user";// preparando la instruccion sql

		   $img = '<img class="img-lg rounded-circle" src="assets/images/faces/profile/'.$foto.'" alt="Profile image">'; 
					 
		   if (mysqli_query($dbh, $qb)) {
			   //echo '1000'.','.'0'.','.$nombre_fig.','.$item.','."";
			   echo '13400|1|'.$img.'|'.$item.'|';

			   
			   
		   } else {
			   // echo '1000'.','.'1'.','."".','."".','.$qb;
				echo '13400|0|'.$foto.'||'.$qb;
		   }		
break;

case 135: // GEnera URL 
	$user_id = $_POST['id_user'];
	$current_token = $_POST['current_token'];
	//$pag = md5('public_coleccion');
	$hoy = date("Y-m-d H:i:s");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}
						
						// comprueba si ya existe el registro
						$qw = "SELECT * FROM token_user WHERE id_user = $user_id ";// preparando la instruccion sql
						$resultw= $dbh->query($qw);
						
						if ($resultw->num_rows > 0) { // Si la consulta trae registro, cambia el estado
							$roww= $resultw->fetch_assoc();
						
							$estado = $roww['estado'];
							
							if($estado==1){
								
								$token = $roww['token'];
								 $qb = "UPDATE token_user SET estado = 99, token='BLOQUEADO', token_anterior = '$token', fecha_actualizado= '$hoy' where id_user= $user_id ";// preparando la instruccion sql
																 
								if (mysqli_query($dbh, $qb)) {
									
									//$url = $link_site_public.'mnu='.$pag.'&token='.$token;
									echo '13500|1|'.$url.'||';

								} else {
									//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
									echo '13500|0|||'.mysqli_error($dbh);
								}	

								$url = $link_site_public.'mnu='.$pag.'&token='.$roww['token'];
								
							}elseif($estado==0){
								
								//$token = generateRandomString();
								
								
								//Guardar token
								 $qb = "UPDATE token_user SET estado = 99, token = 'BLOQUEADO', fecha_actualizado= '$hoy' where id_user= $user_id ";// preparando la instruccion sql
																 
								if (mysqli_query($dbh, $qb)) {
									
									//$url = $link_site_public.'mnu='.$pag.'&token='.$token;
									echo '13500|1|'.$url.'||';

								} else {
									//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
									echo '13500|0|||'.mysqli_error($dbh);
								}		
								
							}elseif($estado==99){
								
								//$token = generateRandomString();
								
								
								//Guardar token
								 $qb = "UPDATE token_user SET estado = 0, token = '', fecha_actualizado= '$hoy' where id_user= $user_id ";// preparando la instruccion sql
																 
								if (mysqli_query($dbh, $qb)) {
									
									//$url = $link_site_public.'mnu='.$pag.'&token='.$token;
									echo '13500|1|'.$url.'||';

								} else {
									//echo '1700'.','.'0'.','."".','."".','.mysqli_error($dbh);
									echo '13500|0|||'.mysqli_error($dbh);
								}		
								
							}
							
							
						}else{
							
					
									echo '13500|0|||'.mysqli_error($dbh).' '.$qb;
																
							
						}
break;
case 136:	
			
	$folio = $_POST['folio']; 
	$correo= $_POST['correo'];
	$cupon = $_POST['cupon'];
	$clave_folio = $_POST['clave_folio'];
	$key_clave = $_POST['key_clave'];
	$consecutivo = $_POST['consecutivo'];
	$qr = $_POST['gen_qr'];
	

	$hoy = date("Y-m-d H:i:s");

	if($qr==1){
	/// Valida QR 
	$nombre_fichero = 'assets/images/qr_invitacion/'.$folio.'.webp';

	if(file_exists($nombre_fichero)) {
		$codigo_qr = '<img src="data:image/webp;base64,'.base64_encode(file_get_contents($nombre_fichero)).'" class="qr_img" name="current" />'; 
	} else {

		$nombre_fichero_png = 'assets/images/qr_invitacion/'.$folio.'.png';
		
		if (file_exists($nombre_fichero_png)) {
			$qr_webp = convert_to_webp($nombre_fichero_png);
		}else{
			$url_site_inv = $GLOBALS['path_site'].'login.php?ref='.$folio;
			//$qr_png= genera_qrcode_invitacion($folio);
			$qr_png= genera_qrcode_invitacion($url_site_inv,$folio);
			$qr_webp = convert_to_webp_url_gral($nombre_fichero_png);
		}

		$codigo_qr = '<img src="data:image/webp;base64,'.base64_encode(file_get_contents($qr_webp)).'" name="nuevo" class="qr_img"  />'; 
	}
	//////////////
}else{
	$qr_webp = 'assets/images/qr_invitacion/qr_site.png';
	$codigo_qr = '<img src="data:image/webp;base64,'.base64_encode(file_get_contents($qr_webp)).'" name="nuevo" class="qr_img"  />'; 
	$url_site_inv = 'No se ha generado códio QR';
}


	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}
						
						// comprueba si ya existe el registro
						$qw = "SELECT * FROM invitaciones WHERE folio = $folio ";// preparando la instruccion sql
						$resultw= $dbh->query($qw);
						
						if ($resultw->num_rows > 0) { // Si la consulta trae registro, cambia el estado
							//$roww= $resultw->fetch_assoc();
						
							echo '13600|2|||'.mysqli_error($dbh);
						}else{

							// $q = "INSERT INTO impresion_etiqueta_set (id, id_user, clave_lego, no_imp ) VALUES ('',".$id_user.", '".$serie."',1)";
							$qb = "INSERT INTO invitaciones (id, folio, llave, clave, correo, id_cupon, consecutivo, fecha_registro,estado) VALUES ('','".$folio."', '".$key_clave."', '".$clave_folio."','".$correo."',".$cupon.",".$consecutivo.", '".$hoy."', 1 )";// preparando la instruccion sql
																 
							if (mysqli_query($dbh, $qb)) {
								echo '13600|1|'.$folio.'|'.$codigo_qr.'||'.$url_site_inv.'|';
							
							} else {
								echo '13600|0|||'.mysqli_error($dbh).' '.$qb;
							}	
							
					
									
																
						}	
break;

case 137:	
			
	$id_invitacion = $_POST['id_invitacion'];

	$invi = crear_invitacion($id_invitacion,'MD');



	if($invi==''){
		echo '13700|0|||';
	}else{
		echo '13700|1|'.$invi.'|'.$id_invitacion.'|';
	}
	
break;
case 138: // Elimina Invitacion

	$id = $_POST['id'];
	$folio = $_POST['folio'];

	$nombre_fichero = 'assets/images/qr_invitacion/'.$folio.'.webp';
	$nombre_fichero_png = 'assets/images/qr_invitacion/'.$folio.'.png';
		
	if (file_exists($nombre_fichero)) {
		if (file_exists($nombre_fichero_png)) {
			unlink($nombre_fichero);
			unlink($nombre_fichero_png);
		}
	}else{
		
	}
//$color = $_POST['val']; 
//unlink('prueba.html');

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
	if ($dbh->connect_error) {
		die("Connection failed: " . $dbh->connect_error);
	}
	
						 
	
			$qb = "DELETE FROM invitaciones WHERE id = $id";// preparando la instruccion sql
																
			if (mysqli_query($dbh, $qb)) {
				//echo '2800'.','.'1'.','.$serie.','."".','."";
				echo '13800|1|'.$serie.'||';
			} else {
				//echo '2800'.','.'0'.','.$qb.','."".','.'';
				echo '13800|0|'.$qb.'||';
			}
break;
case 139: // Elimina Invitacion

	$mes = $_POST['mes'];
	$anio = $_POST['anio'];
	$serie = $_POST['serie'];
	$tipo = $_POST['tipo'];
	$user_perfil = $_POST['user_perfil'];
	$mensualidad = $mes.'-'.$anio.'-'.$user_perfil;

	if($tipo==1){
		$balance = get_stats_mensual($serie,$mensualidad,$tipo);
		echo '13900|1|'.$balance.'||';
	}elseif($tipo==2){
		$balance = get_stats_mensual($serie,$mensualidad,$tipo);
		echo '14000|1|'.$balance.'||';
	}elseif($tipo==3){
		$balance =get_transac_mensual($serie,$mensualidad,$tipo);
		echo '14000|2|'.$balance.'||';
	}
	
	
	/*
	$dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
	$fecha_min = $anio.'-'.$mes.'-'.'1 00:00:00';
	$fecha_max = $anio.'-'.$mes.'-'.$dias_mes.' 23:59:59';

	//echo '13900|1|'.$dias_mes.'||';


	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

	if ($dbh->connect_error) {
		die("Connection failed: " . $dbh->connect_error);
	}

	$qc = "SELECT * FROM recibos where nombre_prod = '$serie' and (fecha_venta BETWEEN '$fecha_min' and '$fecha_max');";// preparando la instruccion sql
		
		//var_dump($current);
    $resultc= $dbh->query($qc);
    
    	if ($resultc->num_rows > 0) {			
			while($rowc= $resultc->fetch_assoc()){

				if($tipo==1){
						$n = $n+1;
						$user_info = busca_user($rowc['id_user']);
							$data_user = explode('--', $user_info);
							$error = $data_user[0];
							$nombre = $data_user[1];
							$correo = $data_user[2];
							$user_name = $data_user[3];
							$foto = $data_user[4];

							$total_cash = $total_cash + $rowc['precio_prod'];

						$mov.='
						<tr>
							<td> 
								<span class="text-primary" style="font-size:0.7rem"> '.$n.'. <b>'.$rowc['descripcion_prod'].'</b> </span><br>								
								<span class="text-muted" style="font-size:0.6rem">'.$rowc['id_recibo'].'</span><br>								
								<span class="text-muted" style="font-size:0.6rem">'.formatFechaHora($rowc['fecha_venta']).' -  </span> 								<span class="text-muted" style="font-size:0.6rem"> @'.$user_name.' </span>
							</td>							
							<td> <span class="text-muted" style="font-size:0.7rem" >  $ '.money_format('%(#10n',$rowc['precio_prod']).' '.$rowc['moneda_prod'].' </span> </td>
							
						</tr>';

				}elseif($tipo==2){

					$total_mov = $resultc->num_rows;

					if($rowc['estado_recibo']==1){
						$aprovados = $aprovados + 1;
						$ingreso = $ingreso + $rowc['precio_prod'];
					}elseif($row['estado_recibo']==0){
						$cancel = $cancel +1;
						$ingreso_desc = $ingreso_desc - $rowc['precio_prod'];
					}

				}					
						
			}	   
	
	    }else{
		    $mov = '<tr>
					<td colspan="2">  
					<span class="text-muted">No hay movimientos para el periodo indicado</span>
					</td>
					</tr>'; 
	    }

		if($tipo==1){
				$table = '
				<div class="col-12 center" style="margin:10px 5px;"> 
					<span class="text-success" style="padding:10px 5px;"> $'.money_format('%(#10n',$total_cash).'</span> 
				</div>

				<table class="table table-striped">
					<thead>
					</thead>

					<tbody>
					'.$mov.'
					</tbody>

					<tfooter>
					</tfooter>
				</table>
			'; 

			echo '13900|1|'.$table.'||';
		}elseif($tipo==2){

			$f_min = $anio.'-'.$mes.'-'.'1';
			$f_max = $anio.'-'.$mes.'-'.$dias_mes;

			$table .= '
					<div class="row col-md-6 " style="margin-left:5px;padding:0px;">
						<span class="col-1 text-muted text-small label_thin"> Del: </span>
						<span class="col-10 text-muted text-small label_thin"> <b>'.formatFecha($f_min).'</b> </span>
					</div>	

					<div class="row col-md-6  " style="margin:0px;padding:0px;">
						<span class="col-1 text-muted text-small label_thin"> Al:</span>
						<span class="col-10 text-muted text-small label_thin"> <b>'.formatFecha($f_max).'</b> </span>
					</div>	
			';

			$table .= '
						¿ <div class="col-md-6">
								<span class="col-md-12 text-muted text-small label_thin"> Ingreso:</span>
								<span class="col-md-12 text-small label_thin"> 
									<span class="text-success" style="font-size:1rem"> $'.money_format('%(#10n',$ingreso).'</span>
								</span>
							</div>
							
							<div class="col-md-6 ">
								<span class="col-md-12 text-muted text-small label_thin"> Devuelto:</span>
								<span class="col-md-12 text-small label_thin"> 
									<span class="text-danger" style="font-size:1rem"> $'.money_format('%(#10n',$ingreso_desc).'</span>
								</span>
							</div>	
			'; 

			$table .='
							¿ <div class="row col-md-12 label_thin" style="margin:0px; padding:0px;">
								<span class="col-sm-9 text-primary text-small label_thin"> Movimientos:</span>
								<span class="col-sm-2 text-small label_thin">'.$total_mov.'</span>
							</div>	

							<div class="row col-md-12 border-top " style="margin:0px; padding:0px;">
								<span class="col-sm-9 text-muted text-small label_thin"> Aprobados:</span>
								<span class="col-sm-2 text-small label_thin">'.$aprovados.'</span>
							</div>																
									
							<div class="row col-md-12 border-top " style="margin:0px; padding:0px;">
								<span class="col-sm-9 text-muted text-small label_thin"> Cancelados:</span>
								<span class="col-sm-2 text-small label_thin">'.$cancel.'</span>
							</div>	
			';
			
			echo '14000|1|'.$table.'||';
		}
*/
break;

default: 
break; 
		
	}
	


	
	
?>