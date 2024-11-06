<?php 

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
$id_db = $data_userb[12];

 $edo = get_lbl_estado($estado);


$perfiles = genera_select_perfil($perfil_cve);

$data_info_user = get_info_user($id_user);

//var_dump($data_info_user);

$dta = explode(';', $data_info_user);
$fnac = $dta[0];
$estado = $dta[1];
$calle = $dta[2];
$noext = $dta[3];
$noint = $dta[4];
$col = $dta[5];
$colonia = $dta[6];
$extra = $dta[7];
$cp = $dta[8];

/*
if($fnac==0){
    $fnac = '0000-00-00';
}else{
    $fnac = $dta[0];
}
*/
//var_dump($fnac);


//$data = $row['fecha_nac'].';'.$row['dir_estado'].';'.$row['dir_calle'].';'.$row['dir_no_ext'].';'.$row['dir_no_int'].';'.$row['dir_col'].';'.$row['dir_mun_del'].';'.$row['dir_extra'].';'.$row['dir_cp'].';'.$row['nombre'].';'.$row['apellido'].';'.$row['fecha_nac']; 

$url = $path_site.'modal_sesion.php?token='.$id_user; 

///////////

							if($GLOBALS['user_perfil']==1){
								
								$edo_pass = $pass;
								
								if($pass == 'RESET'){
									$edo_pass = '<span style="font-size:0.9em; ">Restablece Contraseña</span>';
								}elseif( strlen($pass) > 10 ){
									$edo_pass = 'Activo';
								}
								
								$cve = '<span style="margin-top:15px; padding-top: 15px; " > <code>'.$pass.'</code></span>';
								 
							}else{
								
								$cve = "";
								$edo_pass = 'No dosponible';
							}
							
							/// direccion

							if($calle=='' and $estado==''){
		                        
		                        $direccion = '<p class="col-md col-form-label text-muted" style="font-size:0.9em;"> El usuario no ha registrado dirección.</p>'; 
		                        $estado_btn_dir = 'disabled';
		                        $btn_style= 'btn-secondary'; 
		                        
	                        }elseif($calle=='0' and $estado=='0'){
		                        $direccion = '<p class="col-md col-form-label text-muted" style="font-size:0.9em;"> El usuario no ha registrado dirección.</p>'; 
		                        $estado_btn_dir = 'disabled';
		                        $btn_style= 'btn-secondary'; 	                        
	                        }else{

								if($noint != "" or $noint != 0){
										$no_ext = $noext.' Int. '.$noint;
								}else{
										$no_ext = $noext." ";
								}
									
								$direccion = '
								<p class="col-md text-muted col-form-label" style="font-size:0.8em;" >
								<b>Calle:</b> '.$calle.' <b>No.</b> '. $no_ext.',<br> 
								<b>Colonia:</b> '.$col.',<br>
								<b>Del/Mun:</b> '.$colonia.',<br>
								<b>CP.</b> '.$cp.'<br>
								'.$estado.'.</p>'; 
									
		                        $estado_btn_dir = '';
		                        $btn_style= 'btn-primary'; 
	                        }

	                        ///info de la sesion 
	                        
	                        $now = date("Y-m-d H:i:s");
	                        $data_sesion = get_data_session_user($id_user);
							                     
	                        $data_se = explode('|', $data_sesion);
	                        $ip	= $data_se[0];
	                        $fecha = $data_se[1];
	                        $ciudad = $data_se[2];
	                        $pais = $data_se[3];
	                        $query= $data_se[4];
	                        
	                        $ico_edo_sesion = '<div class="dot-indicator bg-muted" style="margin-top: 3px;"></div>';
	                        
	                        if($ip==0){
		                        $tiempo = '<span class="col-form-label">+ 30 días.</span>'; 
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
			                        $tiempo = '<span class="col-form-label"> + 10 días. </span>'; 
			                        $tiempo = $dias_sesion;
		                        }else{
									$tiempo=  '<span class="col-form-label  ">'.$difference->format('%d dias, %h horas, %i minutos').'</span> <span class="col-form-label">('.$minutes.' minutos). <span>';
		                        }
		                        
		                        if($minutes <= 60){
			                        $ico_edo_sesion = '<div class="dot-indicator bg-success" style="margin-top: 3px;"></div>';
		                        }else{
			                        $ico_edo_sesion = '<div class="dot-indicator bg-muted" style="margin-top: 3px;"></div>';
		                        }
	                        }
	                        
	                        ////////////////////

  $btn_guardar = '<button class="btn btn-inverse-primary "  onclick="quick_edit_user(\'5-'.$id_user.'\')" > <i class="fa fa-save" ></i> </button>'; 

// permiso cambiar mail 

  $permiso_mail = get_permiso_config('24', $user_perfil);

 // var_dump($permiso_mail);
  
  if($permiso_mail==1){
  	$att_per = '';
  }else{
  	$att_per = 'disabled';
  }


  // token 

  $info_token =get_estatus_link($id_user);
  $data_token = explode(';',$info_token);

$estado = $data_token[0];
$token = $data_token[1];
$token_ant = $data_token[2];

if($estado==0){
	$tok = '<div class="col-md-12 text-muted bg-muted center " style="margin-bottom:10px; font-size:0.9rem; padding:5px 0px 3px 0px;"> Token Inactivo</div>';

	$button_tok = '<button type="button" onclick="genera_enlace(\''.$id_user.'\')" class="btn btn-inverse-primary btn-sm" value="1" title="Activar"> <i class="fa-solid fa-toggle-on"></i> </button> '; 
	$button_block = ''; 
	$btn_block = '<button type="button" onclick="block_token(\''.$id_user.'\')" class="btn btn-inverse-primary btn-sm" value="0" title="Bloquear"> <i class="fa-solid fa-ban"></i> </button> '; 

	$ico_edo = '<span class="col-1 text-muted" style="font-size:0.7rem;"> <i class="fa-solid fa-key"></i> </span>';
}else if($estado==1){
	$tok = '<div class="col-md-12 bg-success text-light center" style="margin-bottom:10px; font-size:0.9rem; padding:5px 0px 3px 0px;"> Token Activo </div>';
	$button_tok = '<button type="button" onclick="genera_enlace(\''.$id_user.'\')" class="btn btn-inverse-primary btn-sm" value="0" title="Desactivar"> <i class="fa-solid fa-toggle-off"></i> </button> '; 
	$button_block = ''; 
	$btn_block = '<button type="button" onclick="block_token(\''.$id_user.'\')" class="btn btn-inverse-primary btn-sm" value="0" title="Bloquear"> <i class="fa-solid fa-ban"></i> </button> '; 
	$ico_edo = '<span class="col-1 text-success" style="font-size:0.7rem;"> <i class="fa-solid fa-key"></i> </span>';
}elseif($estado == 99){
	$tok = '<div class="col-md-12 bg-warning text-dark center" style="margin-bottom:10px; font-size:0.9rem; padding:5px 0px 3px 0px;"> Token Bloqueado </div>';
	$button_block = '<button type="button" onclick="block_token(\''.$id_user.'\')" class="btn btn-inverse-primary btn-sm" value="0"> <i class="fa-solid fa-toggle-off"></i> Desactivar</button> ';
	$button_tok = '<button type="button" onclick="genera_enlace(\''.$id_user.'\')" class="btn btn-inverse-primary btn-sm" value="1"> <i class="fa-solid fa-toggle-on"></i>  </button> '; 
	$btn_block = '';
	$ico_edo = '<span class="col-1 text-warning" style="font-size:0.7rem;"> <i class="fa-solid fa-key"></i> </span>'; 
}



?>




<div class="col-md-12 " style="border:0px solid #c30; padding:0px 1px 3px 1px; ">
		                        			
	<h4 class="col-md-12 p-2 title_sec card">Información de Perfil</h4>
	
	<div class="col-md-12 tool_bar">
		<div class="btn-group-bar" role="group" aria-label="" style="margin-left:10px;"> 
				<?php echo $btn_guardar.$button_tok.$btn_block; ?>
		</div>
	</div>
									
									
									
	<div class="" style="padding:0px; border:0px solid #c30;">
        <div class="row" style="padding:0px;"> 
				
  		<div class="col-md-3" style="height:430px; padding:0px; border-right:1px solid #ddd; " >

		  	<div id="perfilmenu_1" class="row col-md-12 side_menu perfilmenu" style="background: rgba(163, 183, 196, 0.4); " onclick="sidemenu(this.id);">
				<span class="col-sm-8 text-muted" style="font-size:1.1em; "> 
				<span class="col-1"> <i class="fa-regular fa-address-card"></i> </span> Personal </span>
				<span class=" col-sm-1 text-head" style="text-align:right; float:right; right:-15px; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
			</div>

			<div id="perfilmenu_2" class="row col-md-12 side_menu perfilmenu" style="background: rgba(163, 183, 196, 0.1); "  onclick="sidemenu(this.id);">
				<span class="col-sm-8 text-muted" style="font-size:1.1em; ">
				<span class="col-1"> <i class="fa-solid fa-user-gear"></i> </span> Perfil</span>
				<span class=" col-sm-1 text-head" style="float:right; right:-15px; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
			</div>

			<div id="perfilmenu_3" class="row col-md-12 side_menu perfilmenu" style="background: rgba(163, 183, 196, 0.1); " onclick="sidemenu(this.id);">
				<span class="col-sm-8 text-muted" style="font-size:1.1em; "> 
				<span class="col-1"> <i class="fa-solid fa-user-lock"></i> </span> Inf. Acceso </span>
				<span class=" col-sm-1 text-head" style="float:right; right:-15px; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
			</div>

			<div id="perfilmenu_4" class="row col-md-12 side_menu perfilmenu" style="background: rgba(163, 183, 196, 0.1); " onclick="sidemenu(this.id);">
				<span class="col-sm-8 text-muted" style="font-size:1.1em; "> 
				<?php echo $ico_edo; ?> Token Público </span>
				<span class=" col-sm-1 text-head" style="float:right; right:-15px; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
			</div>
		</div>

		<div class="col-9" style="height:430px; padding:0px; margin:0px; " >

	<div id="div_perfilmenu_1" class="col-12" style="border:0px solid #c30; padding: 0px 0px 1px 0px;">										
		<div class="col-md-12 p-2 subtitle_sec" style="z-index: 9999;" >Información Personal</div>
					
			<div class="col-md-6" style="padding:10px; ">

			<div class="form-group" style="margin-bottom:5px;">
				<span class="text-muted border " style="padding: 3px 10px; border-radius:5px; font-size:0.8rem; ">
				Miembro desde: <b><?php echo formatFecha($fecha_reg); ?> </b> 
				</span>
			</div>

					<div class="form-group" style="margin-bottom:3px;">
                        <div class="input-group">
                            <div class="input-group-prepend bg-muted border-primary">
                                <span class=" input-group-text bg-transparent" style="width: 60px;">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                            </div>
                                
							<input type="text" <?php echo $att_per; ?> class="form-control col-md-8" id="user_correo_<?php echo $id_user;?> placeholder="Index"  value="<?php echo $correo; ?>" aria-label="Correo" aria-describedby="colored-addon2">
                        </div>
                    </div>

					<div class="form-group" style="margin-bottom:3px;">
                        <div class="input-group">
                            <div class="input-group-prepend bg-muted border-primary">
                                <span class=" input-group-text bg-transparent" style="width: 60px;"> <i class="fa-regular fa-calendar-days"></i> </span>
                            </div>
                                                   
							<input type="text" <?php echo $att_per; ?> class="form-control col-md-8" value="<?php echo formatFecha($fnac); ?>" aria-label="Fecha" aria-describedby="colored-addon2">

                        </div>
                    </div>
 
					<div class="">
			        	<label class="col-md-3 col-form-label text-muted lbl_form_sm" >Dirección:</label>    
						<span class="col-md-8 text-muted" >
							<a class="text-primary" style="font-size:0.7rem;" href="#" onclick="toggle('dir')" > Ver Direccion </a>
			            	<!--<button type="button" class="btn btn-sm <?php echo $btn_style.' '.$estado_btn_dir;?>"  onclick="toggle('dir')" > Ver Dirección</button>-->
			            </span>
					</div>										
					
					<br>
			        
					<div class="border col-md-12 bg-secondary b-3" id="dir" style="display:none" >
				    	<div class="row">
							<div class="col-sm-1 col-form-label text-muted center"><i class="fa fa-location-dot fa-2x"></i></div>
					    		<div class="col-sm-10"><?php echo $direccion ?> </div>
				        	</div>
			            </div>
					</div>
		                        	
		    </div>
	
			<!----- Seccion 2 -------->

		    <div id="div_perfilmenu_2" class="col-md-12 " style="display:none; padding: 0px 0px 1px 0px; border:0px solid #c30;">
				<label class="col-md-12 p-2 subtitle_sec" >Perfil</label>
									
				<div class="col-md-6 " style="padding: 0px 5px; ">
					<div class="form-group" style="margin-bottom:3px;">
                        <div class="input-group">
                            <div class="input-group-prepend bg-muted border-primary">
                                <span class=" input-group-text bg-transparent" style="width: 60px;"> IDDB</span>
                            </div>
							<input type="text" <?php echo $att_per; ?> class="form-control col-md-8" id="user_iddb_<?php echo $id_user;?> placeholder="Index"  value="<?php echo $id_db; ?>" aria-label="IDDB" aria-describedby="colored-addon2">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:3px;">
                        <div class="input-group">
                            <div class="input-group-prepend bg-muted border-primary">
                                <span class=" input-group-text bg-transparent" style="width: 60px;">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                            </div>
                            
							<select class="col-md-8 form-control" id="user_perfil_<?php echo $id_user;?>"><?php echo $perfiles; ?></select>
                        </div>
                    </div>


					<!--
					<div class="">	                        		
			            <label class="col-md-3 col-form-label text-muted lbl_form_sm" >Correo:</label>
			            <input class="col-md-8 form-control" <?php echo $att_per; ?> id="user_correo_<?php echo $id_user;?>" type="text" value="<?php echo $correo; ?>"  >
					</div>-->
                    

                    
					<!--	
					<div class="">	                        		
			            <label class="col-md-3 col-form-label text-muted lbl_form_sm" >Usuario:</label>
			            <input class="col-md-8 form-control" id="user_username_<?php echo $id_user;?>" type="text" value="<?php echo $userb; ?>" >
					</div>
					-->                        		

                    <div class="form-group" style="margin-bottom:3px;">
                        <div class="input-group">
                            <div class="input-group-prepend bg-muted border-primary">
                                <span class=" input-group-text bg-transparent" style="width: 60px;"><i class="fa-solid fa-font-awesome"></i></span>
                            </div>
                        	<span class="col-md-8 text-muted border"><?php echo $edo; ?> </span>
                        </div>
                    </div>
                    <!--
					<div class="" >	                        		
			            <label class="col-md-3 col-form-label text-muted lbl_form_sm" >Estado:</label>
							<span class="col-md-8 text-muted"><?php echo $edo; ?> </span>
					</div>
					-->

                    <div class="form-group" style="margin-bottom:3px;">
                        <div class="input-group">
                            <div class="input-group-prepend bg-muted border-primary">
                                <span class=" input-group-text bg-transparent" style="width: 60px;"><i class="fa-regular fa-calendar-days"></i></span>
                            </div>
                            <input type="text" <?php echo $att_per; ?> class="form-control col-md-8" value="<?php echo formatFechaHora($fecha_act); ?>" aria-label="Fecha" aria-describedby="colored-addon2">
                        </div>
                    </div>
                    
					<!--                                            
					<div class="" >	                        		
			            <label class="col-md-3 col-form-label text-muted lbl_form_sm" >Activado:</label>
							<span class="col-md-8 text-muted lbl_form_sm"> <?php echo formatFechaHora($fecha_act);?></span>
					</div>
                    -->
				</div>									
			</div>

			<!----- Seccion 3 -------->

		    <div id="div_perfilmenu_3" class="col-md-12 " style="display:none; padding: 0px 0px 1px 0px; border:0px solid #c30;">		                        		
		        <label class="col-md-12 p-2 subtitle_sec " >Información de Acceso</label>
		        
				<div class="col-md-10 " style="padding: 0px 5px; ">
					<div class="form-group" style="margin-bottom:3px;">
							<div class="input-group">
								<div class="input-group-prepend bg-muted border-primary">
									<span class=" input-group-text bg-transparent" style="width: 60px;"> <i class="fa-solid fa-at"></i> </span>
								</div>
								
								<input type="text" class="form-control col-md-8" id="user_username_<?php echo $id_user;?> placeholder="Index"  value="<?php echo $userb; ?>" aria-label="Correo" aria-describedby="colored-addon2">
							</div>
						</div>

					<div class="row col-md-12">
						<label class="col-md-3 text-muted col-form-label lbl_form_sm" style="font-size: 0.8em;">Contraseña: </label> 
						<span class="col-sm-8 col-form-label text-muted lbl_form_sm"><?php echo $edo_pass; ?></span>
					</div>
																				
					<div class="">	                        		
						<label class="col-md-3 col-form-label text-muted lbl_form_sm" >Actividad:</label>
						<!--<button type="button"  class="btn btn-secondary text-primary"> Ver detalles</button>-->
						<a class="text-primary" href="#" onclick="javascript:ventanaSecundaria('<?php echo $url?>')" style="font-size: 0.8em;"> Ver Detalles</a>
					</div>											

					<div class="form-group">	                        		
						<label class="col-md-3 col-form-label text-muted lbl_form_sm" >Ultima sesión: </label>
						<span class="col-md-12 text-sm text-muted lbl_form_sm"><?php echo $tiempo ?><span> 
					</div>		
				</div>	                        		
			</div>	

			<!----- Seccion 4 -------->

			<div id="div_perfilmenu_4" class="col-md-12 " style="display:none; padding: 0px 0px 1px 0px; border:0px solid #c30;">		                        		
		        		        
				<div class="col-md-12 tool_bar no-show">
					<div class="btn-group">
						<?php echo $button_tok.$btn_block; ?>
					</div>
				</div>

				

				<div class="col-md-6 " style="padding: 0px 5px; margin:5px; ">
				<div class="col-md-12" style="padding:0px;"> <?php echo $tok; ?> </div>

					<div class="form-group" style="margin-bottom:3px;">
							<div class="input-group">
								<div class="input-group-prepend bg-muted border-primary">
									<span class=" input-group-text bg-transparent" style="width: 60px;"> <i class="fa-solid fa-key"></i> </span>
								</div>
								
								<input type="text" class="form-control col-md-12" id="token_user_current" placeholder="Token"  value="<?php echo $token; ?>" aria-label="Correo" aria-describedby="colored-addon2">
							</div>
					</div>
				
					<div class="form-group" style="margin-bottom:3px;">
							<div class="input-group">
								<div class="input-group-prepend bg-muted border-primary">
									<span class=" input-group-text bg-transparent" style="width: 60px;"> <i class="fa-solid fa-clock-rotate-left"></i></span>
								</div>
								
								<input type="text" class="form-control col-md-12" id="token_user_last" placeholder="Teken anterior"  value="<?php echo $token_ant; ?>" aria-label="Correo" aria-describedby="colored-addon2">
							</div>
					</div>
				</div>


			</div>	
		</div>
			

		</div>
</div>