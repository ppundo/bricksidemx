<?php 
	
// Comprueba que exista una sesion iniciada
include("check_access.php");

$correo_cifrado = $_GET['item'];
//var_dump($correo_cifrado);
	
$info_user = busca_user_cifrado($correo_cifrado);

//$datos_encontrados= $error.'-'.$nombre.'-'.$correo.'-'.$user_name.'-'.$foto.'-'.$row['id'];	

$data_userb = explode('|', $info_user);
$error = $data_userb[0];
$nombre = $data_userb[1];
$correo = $data_userb[2];
$userb = $data_userb[3];
$foto = $data_userb[4];
$id_user = $data_userb[5];
$perfil_cve = $data_userb[6];
$fecha_reg = $data_userb[7];
$fecha_act = $data_userb[8];
$fecha_ban = $data_userb[9];
$estado = $data_userb[10];
$pass = $data_userb[11];

//////////////// Encuentra las facturas de cada usuario
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		      //informacion de acceso a la bd
		// Check connection
			if ($dbh->connect_error) {
		    	die("Connection failed: " . $dbh->connect_error);
			}


//Select * from recibos, 
		
              $qrr = "Select * from session_user group by id_user order by id_user asc;";// preparando la instruccion sql
              

			    $resultr= $dbh->query($qrr);
			    if ($resultr->num_rows > 0) {
				    
				   // $users .= ' <div class="p-1 text-muted border-bottom margin-grid center" style="text-align:center;"> <span> <i class="fa fa-users"></i> </span>Usuarios</div><br>';
				    
                        while($rowr= $resultr->fetch_assoc()){
					
					$user_info = busca_user($rowr['id_user']);
					$data_user = explode('--', $user_info);
					$error = $data_user[0];
					$nombre = $data_user[1];
					$correo = $data_user[2];
					$user_name = $data_user[3];
					$foto = $data_user[4];	                        
	                        
	                       // var_dump($data_user.'<br>');
	                        
                    $url = $link_site.'?mnu='.$mnu.'&item='.$rowr['id_user'];
                    
							if($error == 0 ){
									$users .= '
											<a href="'.$url.'" class="text-muted" style="padding-left:0px; margin-left:0px;" id="mnu_'.$rowr['id'].'">
												<div class="row col-md-12 border-bottom '.$border.'" style="font-size:0.8em; margin:5px 0px; margin-left:0px; padding:10px 0px;">
												    <span class="col-sm-2 "  style=" font-size:1.3em; "><i class="fa fa-user"></i></span> 
													<span class="col-sm-10 text-muted" style="font-size:1.2em;"> '.strtolower($user_name).'</span>
												</div> 
											</a> '; 
							
							}
						}
				}
					
				
				
				if(isset($correo_cifrado)== TRUE){
					
					$table_histo = get_historial_info_user($id_user);
                   
				}	
				

                     
?>




	
		<div class="col-md-12 border-right bg-light" >

        <h5 class="col-md-12  p-3 title_sec" style="margin-bottom:10px;"> Historial de Navegación</h5>
        <?php 
        
            //echo $campo_buscar = crea_campo_buscar('admin_historial');
            echo $campo_buscar = crea_campo_buscar_cust('admin_historial',3); 
        
        ?>
		
            <div style="height: 399px; overflow-x: hidden; overflow-y:auto; padding: 0px;">
			<?php 
					 echo $table_histo; 
			    ?>	
            </div>		
		</div>
	
	
	
