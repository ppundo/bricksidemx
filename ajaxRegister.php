<?php

include("access.php");
include("minifigures.php");
/*include("mailing.php");*/
require_once("sesion.class.php");
session_start();


//////------------------------ Registro usuario 
//'username='+username+'&password='+password+'&email='+email+'&passwordcon='+passcon;

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){

$password_new= md5($_POST['password']);
$username_new= $_POST['username'];
$email_new= $_POST['email'];
$user_ency = md5($_POST['email']);


//var_dump($password_new);

				 	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
							//informacion de acceso a la bd
							// Check connection
					if ($dbh->connect_error) {
						  die("Connection failed: " . $dbh->connect_error);
					}
					
				 	$q = "SELECT * FROM usuarios WHERE correo = '$email_new'";
				 	//var_dump($q); 
				 	
				 	 $result= $dbh->query($q);
				 	 
					if ($result->num_rows > 0) {
						
						//verifica el estado del usuario: 
						
						$row= $result->fetch_assoc(); 
						
						$data_pass = $row['password'];
						$data_correo = $row['correo'];
						$data_estado = $row['estado'];
						
						if($data_pass=='RESET'){
							$res = '0/2'; //2
						}else{
							
							if($data_estado < 90){ // usuario existente
								$res = '0/2'; // 2
							}elseif($data_estado==99){ // usuaio bloqueado
								$res = '0/3'; // 3
							}
							
						}
						
						
									
					
					}else{ // registra al usuario

						$hoyb = date("Y-m-d");
						
						$qb = "INSERT INTO usuarios (id, clave, nombre, correo, usuario, password, fecha_registro, estado, foto, correo_cifrado) VALUES ('', '0','".$username_new ."','".$email_new."', '".$username_new ."', '".$password_new."','".$hoyb."','98','face0.png','".$user_ency."')";// preparando la instruccion sql
						
						   if (mysqli_query($dbh, $qb)) {
							   // echo '500'.','.'1'.','.''.','.''.','.''; // usuario registrado
							    
							    // saca el ID del neuvo usuario
							    $data_user = busca_user_correo($email_new);
							    $data_user = explode('--', $data_user);
							    
							    //$error.'--'.$nombre.'--'.$correo.'--'.$user_name.'--'.$foto.'--'.$cve.'--'.$id;
							    
							    $error = $data_user[0];	
							    $id_nuevo = $data_user[6];	
							    
							    // inserta en tabla personal 
							    
									$qc = "INSERT INTO personal (id, id_user, nombre, apellido, fecha_nac, dir_calle, dir_estado, dir_no_ext, dir_no_int, dir_col, dir_mun_del, dir_extra, dir_cp) VALUES ('', $id_nuevo, 'nombre','apellido', '', '', '', '', '', '', '', '', '' )";
														
							   			if (mysqli_query($dbh, $qc)) {
						   					    //echo '2200'.','.'1'.','.$id_user.','.''.','."";
						   					   // echo '2200|1|'.$id_user.'||'; 
						   				} else {
											    //echo '2200'.','.'0'.','."".','."".','.mysqli_error($dbh);
											    //echo '2200|0|||'.mysqli_error($dbh); 
									    }							    
							    ///	
								
								// inserta en la TABLa COnfiguraciones 
								
								$qi = "INSERT INTO configuraciones(id, id_user, idioma, css_figuras, pagina_inicial) VALUES ('',$id_nuevo,'es','default', 'bienvenida')";

									
			
									if (mysqli_query($dbh, $qi)) {
										//$estado = 2; 
									} else {
										//$estado = 0; 
									}
							    							    
							    
							    $data_sendb = '4'.';'.$username_new.';'.$email_new.';'.'';
							    mail_me($data_sendb);
							    $res = '1/1';
							    
							} else {
								//echo '500'.','.'0'.','."".','."".','.mysqli_error($dbh); 
								$res = '0/'.$q; 
						    }
						    						
						
					}
					
					echo $res;
						    

}

?>