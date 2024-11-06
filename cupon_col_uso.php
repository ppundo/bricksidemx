<?php 
	
// Comprueba que exista una sesion iniciada
include("check_access.php");




$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		      //informacion de acceso a la bd
		// Check connection
			if ($dbh->connect_error) {
		    	die("Connection failed: " . $dbh->connect_error);
			}
			
              $qb = "SELECT * FROM uso_cupon order by id desc;";// preparando la instruccion sql

   
			    $resultb= $dbh->query($qb);
			    if ($resultb->num_rows > 0) {
				    
				    $no = 1; 
                        while($rowb= $resultb->fetch_assoc()){
	                                       	 								                  
	              
							if($rowb['id_user']==99){
								$userb = '<span class="text-primary"> <i class="fa fa-users"></i> Todos </span>';
							}else{								
							
								$info_userb = busca_user($rowb['id_user']);
								
								//var_dump($user);
								
								$data_userb = explode('--', $info_userb);
								
								$error = $data_userb[0];
								$nombre = $data_userb[1];
								$correo = $data_userb[2];
								$userb = $data_userb[3];
								$foto = $data_userb[4];
								$id_user = $data_userb[5];
							}


							if($rowb['clave_serie']==99){
								$nom_serie= '<span class="text-primary"><i class="fa fa-tags"></i> Todas</span>';
							}else{								
							
								$info_userb = get_info_serie($rowb['clave_serie']);
								
								//var_dump($user);
								
								$data_serie = explode('/', $info_userb);
								
								$nom_serie = $rowb['clave_serie'].' - '.$data_serie[0];

								$color= $data_serie[1];
								$f_lanzamiento = $data_serie[2];
								$estado = $data_serie[3];
								$precio_prem = $data_serie[4];
								$moneda_prem = $data_serie[5];
								$dcto = $data_serie[6];
								$aux = $data_serie[7];
								$premium = $data_serie[8];
								
								
								
							}
							
							$hoy = date("Y-m-d");
							
						$info_cup= get_info_cupon_id($rowb['id_cupon']);
						
						//var_dump($info_cup);
						
						$data_cup = explode('|', $info_cup);
						
						$id_cupon = $data_cup[0];
						$serie_cupon = $data_cup[1];
						$id_user_cupon = $data_cup[2];
						$usos_cupon = $data_cup[3];
						$descuento = $data_cup[7];
						$titulo = $data_cup[8];
						$fini = $data_cup[4];
						$ffin = $data_cup[5];



							///// Serie para la que se hizo el cupon 

							if($serie_cupon==99){
								
								$ico_serie = '<i class="fa fa-tags"></i>'; 
								$lbl_serie= '<span class="text-primary"> '.$ico_serie.' Todas</span>';
							}else{								
							
								$info_userb = get_info_serie($serie_cupon);
								
								//var_dump($user);
								
								$data_serie = explode('/', $info_userb);
								
								$nom_serieb = $data_serie[0];
								$colorb= $data_serie[1];
								$f_lanzamientob = $data_serie[2];
								$estadob = $data_serie[3];
								$precio_premb = $data_serie[4];
								$moneda_premb = $data_serie[5];
								$dctob = $data_serie[6];
								$auxb = $data_serie[7];
								$premiumb = $data_serie[8];
								$ico_serie = '<i class="fa fa-tag"></i>'; 
								
								$lbl_serie= '<span class="text-primary">'.$ico_serie.' '.$nom_serieb.'</span>';
								
							}
							
							////////							
		
							
														
  								  $permiso_edita_edo_cupon  = get_permiso_config('15', $GLOBALS['user_perfil']);
								                     
                          
                                                    
 								 if($rowb['estado']==1){
									 $estado_ico = '<span class="text-muted"><i class="fa-solid fa-toggle-on"></i></span>';
									 $option_ico = '<span ><i class="fa-solid fa-toggle-off"></i></span>';

								 }elseif($rowb['estado']==0){
									 $estado_ico = '<i class="fa-solid fa-toggle-off"></i>';
									 $option_ico = '<i class="fa-solid fa-toggle-on"></i>';

								 }elseif($rowb['estado']== 999){
									 $estado_ico = '<i class="fa-solid fa-toggle-off"></i>';
									 $option_ico = '<i class="fa-solid fa-toggle-on"></i>';

								 }else{
									 $estado_ico = '<i class="fa-solid fa-toggle-off"></i>';
									 $option_ico = '<i class="fa-solid fa-toggle-off"></i>';
									 $btn_pencil = '<button class="btn btn-inverse-primary btn_thin" > '.$option_ico.' </button> ';								
								}                   

								 $edo = get_lbl_estado_cupon_uso($rowb['estado']);
								 
	
	
	  							if($permiso_edita_edo_cupon ==1){

	  								$btn_pencil = '<button class="btn btn-inverse-primary btn_thin" onclick="cambia_estado_cupon(\''.$rowb['id'].'\');" > '.$option_ico.' </button> ';

								}else{
									 $btn_pencil = '<button class="btn btn-inverse-primary btn_thin" > '.$option_ico.' </button> ';								
										 
								} 							 
								 

								if($rowb['estado']== 999){
									$btn_eliminar ='<button class="btn btn-inverse-primary btn_thin " disabled title="Acción no permitida." > <i class="fa fa-trash"></i> </button>';
                                    $btn_ban ='<button class="btn btn-inverse-primary btn_thin " disabled title="Acción no permitida." > <i class="fa fa-ban"></i> </button>';
                                    $hora_elim = formatFechaHora($rowb['fecha_ban_admin']);
								}else{
									 $estado_ico = '<i class="fa-solid fa-toggle-off"></i>';
									 $option_ico = '<i class="fa-solid fa-toggle-off"></i>';
									 $btn_pencil = '<button class="btn btn-inverse-primary btn_thin" > '.$option_ico.' </button> ';
                                     
                                     if($rowb['estado']== 998){
                                        $hora_elim = formatFechaHora($rowb['fecha_eliminado_user']);
                                     }else{
                                        $hora_elim = formatFechaHora($rowb['fecha_registro']);
                                     }
									 
									 $permiso_elimina = get_permiso_config('14', $GLOBALS['user_perfil']);
								 
									 if($permiso_elimina==1){
										$btn_eliminar ='<button class="btn btn-inverse-primary btn_thin" onclick="elimina_def_cupon_uso(\''.$rowb['id'].'\');" > <i class="fa fa-trash"></i> </button> ';
                                        
                                         $btn_ban='<button class="btn btn-inverse-primary btn_thin" onclick="elimina_cupon_uso(\''.$rowb['id'].'\');" > <i class="fa fa-ban"></i> </button>';
							 
									 }else{
										$btn_eliminar ='<button class="btn btn-inverse-primary btn_thin text-clear" title="Acción no permitida." > <i class="fa fa-trash"></i> </button>';
										$btn_ban ='<button class="btn btn-inverse-primary btn_thin text-clear" title="Acción no permitida." > <i class="fa fa-ban"></i> </button>';
										$lbl_warning = '<blockquote class="blockquote btn-inverse-warning" style="padding: 3px 10px; font-size: 1em;" > ATENCIÓN: No tienes permiso para ejecutar ciertas acciones, comunicate con el admin para asignar nuevos permisos.</blockquote>'; 
	
																	 
									 }
								}
								 

								 
						 $options = $btn_pencil.$btn_ban;
                          
                          
	                        $filas .= '
	                        <tr> 	                        	                     
	                        	<input id="id_registro_'.$rowb['id'].'" type="hidden"   value="'.$rowb['id'].'">
	                        	
	                        	<td class="text-muted" style="text-align:center;"> '.$no.'</td>
	                        	
	                        	<td style="text-align:left;" > 
                                    <span class="text-muted" style="font-size:0.8rem;" > <b>'.strtoupper($titulo).'</b></span><br>
									<a href="#" style="font-size:0.6rem;" onclick="toggle(\'detalles_'.$rowb['id'].'\');">Ver detalles</a>

									<div id="detalles_'.$rowb['id'].'" style="border-radius:3px; padding: 5px 0px 5px 5px; margin:5px 0px 0px 0px;" class="col-12 border no-show">
									<span class="text-muted" style="font-size:0.6rem;" >ID cupón: '.$rowb['id_cupon'].'</span><br>
                                    <span class="text-muted" style="font-size:0.6rem;" >Aplica en: '.$lbl_serie.'</span><br>
									<span class="text-muted" style="font-size:0.6rem;" > Cantidad Usos: '.$usos_cupon.'</span><br>
									<span class="text-muted" style="font-size:0.6rem;" > Descuento: '.$descuento.'% </span>
									</div>
									
                                
                                </td>
	                        	
	                        	
	                        
								<td> <span class="text-muted"> '.$userb.' </span> </td>
	                        
		                        <td> 
									<span class="text-muted" style="font-size:0.8rem;">'.$nom_serie.'</span> 								
								
								</td>
								
								<td class="" > 
                                    <span style="font-size:0.6rem;">'.$edo.' </span><br> 
                                    <span class="text-muted" style="font-size:0.6rem;">'.$hora_elim.' </span>
                                </td>                   
		                        
 
		                        
                                
                                <td >
			                          
			                          <div class="btn-group" role="group" aria-label="">
				                      '.$options.'
				                      </div> 

									   <div class="btn-group" role="group" aria-label="">
									   '.$btn_eliminar.'
									   </div>
				                      
			                         
				                      
								</td>
							
	                        </tr>
	                        
                        
	                        '; 
	                        $num = $num + 1;
	                        $no = $no + 1;
						}
						
						$table = '
	
								<table id="uso_cupon" class="table table-striped table-bordered">
				                      <thead>
				                        <tr>
					                      <th class="thead_content" style=""> No </th>
				                          <th class="thead_content" style=""> Cupón  </th>
				                          <th class="thead_content" style=""> Usuario  </th>
				                          <th class="thead_content" style=""> Colección Canjeada </th>
				                          <th class="thead_content" style=""> Estado</th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      <tbody >
				                      	'.$filas.' <input type="hidden" id="perfil_elimina" value="1" />
				                      </tbody>

				                      <tfooter>
				                        <tr>
					                      <th class="thead_content" style=""> No </th>
				                          <th class="thead_content" style=""> Cupón  </th>
				                          <th class="thead_content" style=""> Usuario  </th>
				                          <th class="thead_content" style=""> Colección Canjeada </th>
				                          <th class="thead_content" style=""> Estado</th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </tfooter>

				                </table>					
						
						';
					
					}else{
						$table = '<div class="col-md-12 center text-muted"> <h4>Aún no hay cupones.</h4> </div>';
					}




?>

<h4 class="col-md-12 p-2 title_sec"> Administrar Cupones En Uso</h4>


<div class="col-md-12 center" style="">
<?php echo $lbl_warning; ?>
</div> 



<input id="bandera_actualiza" type="hidden" value="1">
            
<div class="col-lg-12" style="margin-top:10px;">
            <?php
			
                //echo $campo_buscar = crea_campo_buscar('uso_cupon');
                echo $campo_buscar = crea_campo_buscar_cust('uso_cupon',3); 
            ?>
</div>

<div class="col-lg-12" style="height: 430px; overflow-y:auto; overflow-x:hidden;">
			<?php
			
				echo $table; 
			?>
		</div>
				
