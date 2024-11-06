<?php 

// Comprueba que exista una sesion iniciada
include("check_access.php");
		
////////////////
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		      //informacion de acceso a la bd
		// Check connection
			if ($dbh->connect_error) {
		    	die("Connection failed: " . $dbh->connect_error);
			}
			
              $qb = "SELECT * FROM usuarios;";// preparando la instruccion sql

   
			    $resultb= $dbh->query($qb);
			    if ($resultb->num_rows > 0) {
				    
				    $num = 1; 
                        while($rowb= $resultb->fetch_assoc()){
	                        
	                        if($user == $rowb['id'] ){
		                        $hab_btn = 'disabled'; 
		                        $label_tu = '<br> <label class="badge badge-dark text-light">Eres tu</label>'; 
		                        $btn_color = 'inverse-primary '; 
	                        }else{
		                        $hab_btn = '';
		                        $label_tu = ''; 
		                        $btn_color = 'inverse-primary';
	                        }
	                        
	                        //obtiene la direccion e info del usuario
	                        
	                        $data_user = get_info_user($rowb['id']);
	                        $data_u = explode(';', $data_user);
	                        $fnac = $data_u[0];
	                        $estado = $data_u[1];
	                        $calle = trim($data_u[2]);
	                        $no_ext = $data_u[3];
	                        $no_int = $data_u[4];
	                        $col = $data_u[5];
	                        $del_mun =  $data_u[6];
	                        $extra = $data_u[7];
	                        $cp = $data_u[8];
	                        
	                        if($fnac=='0' or $fnac == ''){
		                        $fnacc = '<span class="text-muted">Sin definir</span>';
		                        $ico_cumple = ''; 
	                        }else{
		                       $fnacc = formatFechaTable($fnac); 
		                       
		                       // determina cumple
		                        $hoy = date('m-d');
		                      //  var_dump($hoy);
		                        
		                        $data_fecha = explode('-', $fnac);
		                        $anio = $data_fecha[0];
		                        $mes = $data_fecha[1];
		                        $dia = $data_fecha[2];
		                        
		                        $cumple = $mes.'-'.$dia;
		                       // var_dump($cumple.'<br>');
		                        
		                        if($hoy == $cumple){
			                        $ico_cumple = '<span class="text-muted" style="padding: 3px 10px; font-size:12px;"><i class="fas fa-birthday-cake"></i></span>'; 
		                        }else{
			                        $ico_cumple = ''; 
		                        }
	                        		                        
	                        }
	                        

	                       // var_dump($hoy);
	                         
	                        
	                       // var_dump($calle);
	                        if($calle=='' and $estado==''){
		                        
		                        $direccion = '<span> La dirección del usuario no ha sido completa.</span>'; 
		                        $estado_btn_dir = 'disabled';
		                        $btn_style= 'btn-inverse-primary'; 
		                        
	                        }elseif($calle=='0' and $estado=='0'){
		                        $direccion = '<span> La dirección del usuario no ha sido completa.</span>'; 
		                        $estado_btn_dir = 'disabled';
		                        $btn_style= 'btn-inverse-primary'; 	                        
	                        }else{

								if($no_int != "" or $no_int!= 0){
										$ext = ' Int. '.$no_int;
								}else{
										$ext = "";
								}
									
								$direccion = '<span class="text-muted">'.$calle.' No. '. $no_ext.$ext.',<br> Col. '.$col.',<br>Del/Mun. '.$del_mun.',CP. '.$cp.'<br>'.$estado.'.</span>'; 	
		                        $estado_btn_dir = '';
		                        $btn_style= 'btn-primary'; 
	                        }
	                        
	                        
	                        ///info de la sesion 
	                        
	                        $now = date("Y-m-d H:i:s");
	                        $data_sesion = get_data_session_user($rowb['id']);
							                     
	                        $data_se = explode('|', $data_sesion);
	                        $ip	= $data_se[0];
	                        $fecha = $data_se[1];
	                        $ciudad = $data_se[2];
	                        $pais = $data_se[3];
	                        $query= $data_se[4];
	                        
	                        $ico_edo_sesion = '<div class="dot-indicator bg-muted" style="margin-top: 3px;"></div>';
	                        
	                        if($ip==0){
		                        $tiempo = '+ 30 días.'; 
		                       // $tiempo = $data_sesion;
	                        }else{
	                        
		                        $horaInicio = new DateTime($fecha);
								$horaTermino = new DateTime($now);
								//$interval = $horaInicio->diff($horaTermino);
								//echo $interval->format('%H horas %i minutos %s seconds').'<br>';
		                        
		                        $difference = date_diff($horaInicio, $horaTermino);
		                        $minutes = $difference->d * 24 * 60;
								$minutes += $difference->h * 60;
								$minutes += $difference->i;
		                        
		                        $dias_sesion = $difference->d;
		                        
		                        if($dias_sesion > 10 ){
			                        $tiempo = '+ 10 días.'; 
			                        $tiempo = $dias_sesion;
		                        }else{
									$tiempo=  $difference->format('%d dias, %h horas %i minutos').' <br> <span class="col-sm-12 control-form">('.$minutes.' minutos). <span>';
		                        }
		                        
		                        if($minutes <= 60){
			                        $ico_edo_sesion = '<div class="dot-indicator bg-right" style="margin-top: 3px;"></div>';
		                        }else{
			                        $ico_edo_sesion = '<div class="dot-indicator bg-muted" style="margin-top: 3px;"></div>';
		                        }
	                        }
	                        
	                        ////////////////////
	                        
	                        
	                        // obtiene info del perfil
	                        $lbl_perfil = get_info_perfil($rowb['clave']);
	                        
	                        $data_perfil = explode(';', $lbl_perfil);
	                        $id_p = $data_perfil[0];
	                        $nombre_p = $data_perfil[1];
	                        $nom_corto_p = strtoupper($data_perfil[2]);
	                        $clave_p = $data_perfil[3];
	                        $icono_p = $data_perfil[4];
	                        $color_p = $data_perfil[6];
	                        
	                        $perfilb = '  
	                        				<span class="text-'.$color_p.'" style="font-size: 0.8rem;"> 
	                        					<i class="fas '.$icono_p.'" ></i>  
	                        				</span> 
	                        				<span class="text-'.$color_p.'">'.$nombre_p.'</span> ';
	                        //////
	                        
	                        if($rowb['clave']==1){  
		                        $btn_perfil = '<button  '.$hab_btn.' class="btn btn-'.$btn_color.' btn_thin" onclick="quick_edit_user(\'1-'.$rowb['id'].'\')" > <i class="fas fa-user"></i>  </button>';
	                        
	                        }elseif($rowb['clave']==0){
		                        $btn_perfil = '<button aria-label="Cambia el perfil de este usuario" '.$hab_btn.' class="btn btn-'.$btn_color.' btn_thin" onclick="quick_edit_user(\'1-'.$rowb['id'].'\')" > <i class="fas fa-user-astronaut"></i>  </button>'; 
	                        }
							
							if($user_perfil==1){
								
								$edo_pass = $rowb['password'];
								
								if($rowb['password']== 'RESET'){
									$edo_pass = 'Restablece Contraseña';
								}elseif( strlen($rowb['password']) > 10 ){
									$edo_pass = 'Activo';
								}
								
								$cve = '<span style="margin-top:15px; padding-top: 15px; " > <code>'.$rowb['password'].'</code></span>';
								 
							}else{
								
								$cve = "";
								
							}
	                        
	                        $edo = get_lbl_estado($rowb['estado']);



							$perfil = $GLOBALS['user_perfil'];
							$permiso_elimina = get_permiso_config('5', $perfil);
								 
							if($permiso_elimina==1){

                                if($rowb['estado']==999){
                                    $btn_elimina = '';
                                }else{
                                    $btn_elimina = '
                                    <button class="btn btn-inverse-primary btn_thin" '.$hab_btn.'  onclick="quick_edit_user(\'4-'.$rowb['id'].'\')" > <i class="fa fa-trash" ></i> </button>
                                    ';
                                }


							 									 
								 }else{

							$btn_elimina = '
							<button class="btn btn-inverse-primary btn_thin " disabled  > <i class="fa fa-trash" ></i> </button>
							';

																 
								 }
								 

	                        
	                        if($rowb['estado']==1){
		                        
		                        
		                       
		                      //  $edo = '<span id="s_edo_'.$rowb['id'].'" class="theme_color" style="font-size: 20px;"> <i class=" fa fa-eye " ></i> </span>';
		                        $btn_edita = '<button '.$hab_btn.' class="btn btn-'.$btn_color.' btn_thin" title="DESACTIVAR" onclick="quick_edit_user(\'2-'.$rowb['id'].'\')" > <i class="fa fa-toggle-off" ></i> </button>'; 
		                        $btn_block = '<button '.$hab_btn.' class="btn btn-inverse-primary btn_thin" title="BLOQUEAR" onclick="quick_edit_user(\'6-'.$rowb['id'].'\')" > <i class="fa-solid fa-user-lock"></i> </button>';
		                        
		                        $fecha_banned = ''; 
		                        
		                        $f_display = formatFecha($rowb['fecha_registro']);

                                $btn_mail = '<button '.$hab_btn.' disabled class="btn btn-inverse-primary text-neutral btn_thin" title="Enviar Mail Confirmación" > <i class="fa fa-envelope" ></i> </button>'; 

                                $btn_reset = '
                                <button class="btn btn-inverse-primary btn_thin" title="Resetea Contraseña"  onclick="quick_edit_user(\'3-'.$rowb['id'].'\')" >
                                    <i class="fa-solid fa-arrows-rotate"></i>
                                </button>';
		                        
	                        }elseif($rowb['estado']==99){
		                       
		                     //   $edo = '<span id="s_edo_'.$rowb['id'].'" class="theme_color" style="font-size: 20px;"> <i class=" fa fa-user-slash " ></i> </span>';
		                        $btn_edita = '<button '.$hab_btn.' class="btn btn-'.$btn_color.' btn_thin" onclick="quick_edit_user(\'2-'.$rowb['id'].'\')" > <i class="fa fa-toggle-off" ></i> </button>'; 
		                        
		                        $btn_block = '<button disabled class="btn btn-inverse-primary text-neutral btn_thin" title="BLOQUEAR" > <i class="fa-solid fa-user-lock"></i> </button>';
		                        
		                        $fecha_banned = '<span class="text-muted">'.formatFechaHora($rowb['fecha_banned']).'</span>';
		                        
		                        $f_display = formatFechaHora($rowb['fecha_banned']);

                                $btn_mail = '<button '.$hab_btn.' disabled class="btn btn-inverse-primary text-neutral btn_thin" title="Enviar Mail Confirmación" > <i class="fa fa-envelope" ></i> </button>'; 
                                $btn_reset = '
                                <button class="btn btn-inverse-primary btn_thin " title="Resetea Contraseña"  onclick="quick_edit_user(\'3-'.$rowb['id'].'\')" >
                                    <i class="fa-solid fa-arrows-rotate"></i>
                                </button>';		                        
		                        
	                        }elseif($rowb['estado']==0){
		                      //  $edo = '<span class="theme_gris" style="font-size: 20px;"> <i class=" fa fa-eye-slash" ></i> </span>';
		                        $btn_edita = '<button '.$hab_btn.' class="btn btn-outline-primary btn_thin" title="ACTIVAR"   onclick="quick_edit_user(\'2-'.$rowb['id'].'\')" > <i class="fa fa-toggle-on" ></i> </button>'; 
		                        $btn_block = '<button '.$hab_btn.' class="btn btn-outline-primary btn_thin" title="BLOQUEAR" onclick="quick_edit_user(\'6-'.$rowb['id'].'\')" > <i class="fa-solid fa-user-lock"></i> </button>';
		                        
		                        $fecha_banned = ''; 
		                        $f_display = formatFecha($rowb['fecha_registro']);
		                        
		                        $btn_mail = '<button '.$hab_btn.' disabled class="btn btn-inverse-primary text-neutral btn_thin" title="Enviar Mail Confirmación" > <i class="fa fa-envelope" ></i> </button>'; 
                                $btn_reset = '
                                <button class="btn btn-inverse-primary btn_thin " title="Resetea Contraseña"  onclick="quick_edit_user(\'3-'.$rowb['id'].'\')" >
                                    <i class="fa-solid fa-arrows-rotate"></i>
                                </button>';

	                        }elseif($rowb['estado']==98){
                               // $btn_edita = '<button '.$hab_btn.' class="btn btn-outline-primary" title="ACTIVAR"   onclick="quick_edit_user(\'2-'.$rowb['id'].'\')" > <i class="fa fa-toggle-on" ></i> </button>'; 

		                        $btn_mail = '<button '.$hab_btn.' class="btn btn-inverse-primary btn_thin"  onclick="quick_edit_user(\'7-'.$rowb['id'].'\')" > <i class="fa fa-envelope" ></i> </button>'; 
	                        $btn_reset = '
	                        		<button class="btn btn-inverse-primary btn_thin" title="Resetea Contraseña"  onclick="quick_edit_user(\'3-'.$rowb['id'].'\')" >
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                    </button>';

		                    }elseif($rowb['estado']==999){
                                $btn_edita = ''; 

		                        $btn_mail = ''; 
                                $btn_block = '';
                              //  $btn_edita = '<button '.$hab_btn.' class="btn btn-outline-primary" title="ACTIVAR"   onclick="quick_edit_user(\'2-'.$rowb['id'].'\')" > <i class="fa fa-toggle-on" ></i> </button>'; 

	                        $btn_reset = '';		                    
		                    }
	                        
	                        $btn_guardar = '<button class="btn btn-inverse-primary btn_thin "  onclick="quick_edit_user(\'5-'.$rowb['id'].'\')" >
							'.$ico_global_save.' </button>'; 


	                        $options = '
	                           	<div class="btn-group" role="group" aria-label="">
	                        		'.$btn_reset.' '.$btn_mail.''.$btn_block.'
	                        		'.$btn_edita.'
									<a class="btn btn-inverse-primary text-muted btn_thin" href="'.$link_site.'?mnu=4301aabcd42d818a49be27ae6cac3ec0&item='.$rowb['correo_cifrado'].'"  > '.$ico_global_edit.' </a> 
	                        	</div>
	                        	
	                        	<div class="btn-group" role="group" aria-label="" style="margin-left:10px;" >
	                        	
	                        		'.$btn_elimina.'
	                        	</div>';

//<button class="btn btn-'.$btn_color.'" '.$hab_btn.'  onclick="quick_edit_user(\'4-'.$rowb['id'].'\')" > <i class="fa fa-trash" ></i> </button>
	                        
	                         
	                        // $url = 'http://shelf.bricksidemx.com/collector/index.php?mnu=36ab3f303db5a5b1e16a37f8f9386c98&token='.$rowb['id']; 
	                         $url = $path_site.'sesion.php?token='.$rowb['id']; 
	                         
	                       // Tares configuracion de colecciones opcionales. 
	                       
	                       
	                       $chk_col_op = genera_check_series_opcionales_admin($rowb['id']);
	                       
	                       
	                        
	                        $filas .= '
	                        
	                        <tr>
	                        
	                        <td style="text-align: center;"> <span class="text-muted" > '.$rowb['id'].'</span> </td>

	                        <td style=""> 
	                        	
	                        	<div class="row">
	                        		
	                        		<span style="margin-left:5px; vertical-align: middle;" class=" " >'.$ico_edo_sesion.' </span> 
	                        		<span style="margin-left:5px; vertical-align: middle;" class=" text-muted"> '.$rowb['usuario'].' </span> 
	                        		<span class="">'.$ico_cumple.'</span>                                  

	                        	</div>
	                        </td>

                            <td> <span class="text-muted"> '.$rowb['correo'].'</span> </td>

	                        <td style="text-align: center;"> <span class="text-muted" > '.$perfilb.' </span> </td>

	                        <td style="text-align: center;"> '.$edo.' </td>
	                        
	                        <td>

				                      '.$options.'
									  
				               
								  
			                       
							</td>
							
	                        </tr>
	                        
	                        
	                      							
	                        '; 
	                        $num = $num + 1;
						}
				}
	


?>


<div class="col-12" style="margin-top:10px;">
    <?php 
        
       // $campo_buscar = crea_campo_buscar('admin_usuarios');
       $campo_buscar = crea_campo_buscar_cust('admin_usuarios',3);   
        echo $campo_buscar;
        
    ?>   
</div>

				<div class="col-12 scrollable" style="background: none; border: none;">
    			                				
					<table id="admin_usuarios" class="table table-striped " style="background: #fff;">
                      <thead >
                        <tr>
                        	<th class="thead_content" > ID-DB </th>
                            <th class="thead_content" > Usuario </th>
                            <th class="thead_content" > Correo </th>
							<th class="thead_content" > Perfil </th>
							<th class="thead_content" > Estado </th>
							<th class="thead_content" > Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php echo $filas; ?>
                      </tbody>
                      <tfooter >
                        <tr>
                        <th class="thead_content" > ID-DB </th>
                            <th class="thead_content" > Usuario </th>
                            <th class="thead_content" > Correo </th>
							<th class="thead_content" > Perfil </th>
							<th class="thead_content" > Estado </th>
							<th class="thead_content" > Opciones</th>
                        </tr>
                      </tfooter>                      
                      
                      
                    </table>
                    
				</div>
                    
                    
                    
                    
                    
                    
<!-- ////////////////////////// Nuevo User //////////////////////////// -->

<div id="nuevo_user" class="hold_set_edita" style="display:none; " >
	
	
	<div class=" col-lg-12 body_modal semi-transparent " style="min-height: auto;  margin-top: 20px; margin-bottom: 10px; width: 40%; padding:0px;">
	
	<h5 class="col-md-12 p-2 title_sec_sm bg-head " style="padding:0px; border-radius:5px 0 0 0;"> 
            
            <i class="fa-solid fa-sliders"></i> <b> Nuevo Usuario </b>
    
            <div class="btn-group" role="group" style="float:right; border:none;"> 
                <button type="button" onclick="toggle('nuevo_user')" class=" btn btn-outline-primary  text-clear" style="border:0px solid #ccc;"> 
                    <i class="fa-solid fa-times fa-lg"></i>
                </button>
            </div> 
     </h5> 

			<div class="p-1 border-bottom center " style="padding: 10px 0 0 5px;">  
                <div class="row">
				<div class="col-md-6"> 
				<span id="new_minifigure_status"  style=" border-radius: 5px;" ></span>
				</div>
                    <div class="col-md-6">                                 
                            <div class="btn-group" role="group" aria-label="" style="float:right; " >   
								<button type="button" class="btn btn-inverse-primary" onclick="save_new_user();" > <i class="fas fa-save"></i>  </button>
                            </div>  
                    </div>
                </div>
            </div>


		<div class="content-wrapper" style="background: #fff; "  >
	   		<div class="col-lg-12">				            
				            
				<div class="row">
	   			<div class="col-md-12 grid-margin " >	
				    <form name="form_up_minifigure" method="post" action="?" id="form_up_minifigure" enctype="multipart/form-data">   			
								
								<div class="form-group row compacted">
				                    <label for="edita_index" class="col-sm-4 col-form-label">Nombre y Apellido </label>
				                    <div class="col-sm-6">
				                        <input type="text" name="new_user_nombre" class="form-control" value="" id="new_user_nombre" placeholder="Nombre Apellido">
				                    </div>
				                </div>
			
								<div class="form-group row compacted">
				                    <label for="edita_id" class="col-sm-4 col-form-label">Correo</label>
				                    <div class="col-sm-6">
				                        <input type="text" class="form-control" id="new_user_correo" placeholder="Correo">
				                    </div>
				                </div>

								<div class="form-group row compacted">
				                    <label for="edita_id" class="col-sm-4 col-form-label">Usuario</label>
				                    <div class="col-sm-6">
				                        <input type="text" class="form-control" id="new_user_usuario" placeholder="Usuario">
				                    </div>
				                </div>			                        						  


					            
								<div class="form-group row compacted ">
					                <label for="edita_sku" class="col-sm-4 col-form-label">Contraseña</label>
					                   	<div class="col-sm-6">
					                            <input type="text"  class="form-control" id="new_user_pass" placeholder="Contraseña">
					                    </div>
					            </div>

								<div class="form-group row compacted ">
					                <label for="edita_sku" class="col-sm-4 col-form-label">Tipo Usuario</label>
					                   	<div class="col-sm-6">
					                            <select id="new_user_tipo" class="form-control">
						                            <option value="X"> Elija...</option>
						                            <option value="0"> Coleccionista</option>
						                            <option value="1"> Administrador</option>
					                            </select>
					                    </div>
					            </div>

				            				                    
				</div>
				
				
				</div>
				
			</div>
	   	</div>
	</div>
		
</div>