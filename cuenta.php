
<?php
	
// Comprueba que exista una sesion iniciada
include("check_access.php");

// modal Direccion 
$ver_modal = $_GET['moddir'];

if ($ver_modal==1){
	$disp_mod = 'display: block;';
}else{
	$disp_mod = 'display: none;';
}


// modal Sugerencia 
$ver_modal_g = $_GET['modsug'];

if ($ver_modal_g==1){
	$disp_mod_g = 'display: block;';
}else{
	$disp_mod_g = 'display: none;';
}

//////////
	$link = $link_site.'?mnu=9019cbe4458150159d9cc2f1cd473cf1';

$menu_col_a = $_GET['ma'];
$menu_col_b = $_GET['mb'];

if($menu_col_a==1){	
	$display_mnu_a = 'display: block;';
	$display_mnu_b = 'display: none;';
	$display_mnu_c = 'display: none;';
	$display_mnu_d = 'display: none;';
	
	$title_col = 'Info Personal';
	
}elseif($menu_col_a==2){
	$display_mnu_a = 'display: none;';
	$display_mnu_b = 'display: block;';
	$display_mnu_c = 'display: none;';
	$display_mnu_d = 'display: none;';	
	$title_col = 'Acceso';
}elseif($menu_col_a==3){
	$display_mnu_a = 'display: none;';
	$display_mnu_b = 'display: none;';
	$display_mnu_c = 'display: none;';
	$display_mnu_d = 'display: block;';	
	$title_col = 'Personalizar';
}elseif($menu_col_a==4){
	$display_mnu_a = 'display: none;';
	$display_mnu_b = 'display: none;';
	$display_mnu_c = 'display: block;';
	$display_mnu_d = 'display: none;';	
	$title_col = 'Colecciones';
}else{
	$display_mnu_a = 'display: block;';
	$display_mnu_b = 'display: none;';
	$display_mnu_c = 'display: none;';
	$display_mnu_d = 'display: none;';
	$title_col = 'Info Personal';
}

/////// 

if($menu_col_b==11){	
	$display_smnu_a = 'display: block;';
	$display_smnu_b = 'display: none;';
	$display_smnu_c = 'display: none;';
	$display_smnu_d = 'display: none;';
	$display_smnu_e = 'display: none;';
	$display_smnu_f = 'display: none;';
	$display_smnu_g = 'display: none;';
	$display_smnu_h = 'display: none;';
	$display_smnu_i = 'display: none;';
	$display_smnu_j = 'display: none;';
				
	$title_scol = 'Nombre';
	
}elseif($menu_col_b==12){	
	$display_smnu_a = 'display: none;';
	$display_smnu_b = 'display: block;';
	$display_smnu_c = 'display: none;';
	$display_smnu_d = 'display: none;';
	$display_smnu_e = 'display: none;';
	$display_smnu_f = 'display: none;';
	$display_smnu_g = 'display: none;';
	$display_smnu_h = 'display: none;';
	$display_smnu_i = 'display: none;';
	$display_smnu_j = 'display: none;';
	
	$title_scol = 'Dirección';
	
}elseif($menu_col_b==21){
	$display_smnu_a = 'display: none;';
	$display_smnu_b = 'display: none;';
	$display_smnu_c = 'display: block;';
	$display_smnu_d = 'display: none;';
	$display_smnu_e = 'display: none;';
	$display_smnu_f = 'display: none;';
	$display_smnu_g = 'display: none;';
	$display_smnu_h = 'display: none;';
	$display_smnu_i = 'display: none;';
	$display_smnu_j = 'display: none;';
		
	$title_scol = 'Cuenta';
}elseif($menu_col_b==22){
	$display_smnu_a = 'display: none;';
	$display_smnu_b = 'display: none;';
	$display_smnu_c = 'display: none;';
	$display_smnu_d = 'display: block;';
	$display_smnu_e = 'display: none;';
	$display_smnu_f = 'display: none;';
	$display_smnu_g = 'display: none;';
	$display_smnu_h = 'display: none;';
	$display_smnu_i = 'display: none;';
	$display_smnu_j = 'display: none;';
		
	$title_scol = 'Contraseña';
}elseif($menu_col_b==23){
	$display_smnu_a = 'display: none;';
	$display_smnu_b = 'display: none;';
	$display_smnu_c = 'display: none;';
	$display_smnu_d = 'display: none;';
	$display_smnu_e = 'display: block;';
	$display_smnu_f = 'display: none;';
	$display_smnu_g = 'display: none;';
	$display_smnu_h = 'display: none;';
	$display_smnu_i = 'display: none;';
	$display_smnu_j = 'display: none;';
	
	$title_scol = 'Contraseña Maestra';
}elseif($menu_col_b==31){
	$display_smnu_a = 'display: none;';
	$display_smnu_b = 'display: none;';
	$display_smnu_c = 'display: none;';
	$display_smnu_d = 'display: none;';
	$display_smnu_e = 'display: none;';
	$display_smnu_f = 'display: block;';
	$display_smnu_g = 'display: none;';
	$display_smnu_h = 'display: none;';
	$display_smnu_i = 'display: none;';
	$display_smnu_j = 'display: none;';
	
	$title_scol = 'General';
}elseif($menu_col_b==32){
	$display_smnu_a = 'display: none;';
	$display_smnu_b = 'display: none;';
	$display_smnu_c = 'display: none;';
	$display_smnu_d = 'display: none;';
	$display_smnu_e = 'display: none;';
	$display_smnu_f = 'display: none;';
	$display_smnu_g = 'display: block;';
	$display_smnu_h = 'display: none;';
	$display_smnu_i = 'display: none;';
	$display_smnu_j = 'display: none;';
		
	$title_scol = 'Apariencia';
}elseif($menu_col_b==41){
	$display_smnu_a = 'display: none;';
	$display_smnu_b = 'display: none;';
	$display_smnu_c = 'display: none;';
	$display_smnu_d = 'display: none;';
	$display_smnu_e = 'display: none;';
	$display_smnu_f = 'display: none;';
	$display_smnu_g = 'display: none;';
	$display_smnu_h = 'display: block;';
	$display_smnu_i = 'display: none;';
	$display_smnu_j = 'display: none;';
	
	$title_scol = 'Colecciones Opcionales';
}elseif($menu_col_b==42){
	$display_smnu_a = 'display: none;';
	$display_smnu_b = 'display: none;';
	$display_smnu_c = 'display: none;';
	$display_smnu_d = 'display: none;';
	$display_smnu_e = 'display: none;';
	$display_smnu_f = 'display: none;';
	$display_smnu_g = 'display: none;';
	$display_smnu_h = 'display: none;';
	$display_smnu_i = 'display: block;';
	$display_smnu_j = 'display: none;';
	
	$title_scol = 'Recibos Series Premium';
	
}elseif($menu_col_b==43){
	$display_smnu_a = 'display: none;';
	$display_smnu_b = 'display: none;';
	$display_smnu_c = 'display: none;';
	$display_smnu_d = 'display: none;';
	$display_smnu_e = 'display: none;';
	$display_smnu_f = 'display: none;';
	$display_smnu_g = 'display: none;';
	$display_smnu_h = 'display: none;';
	$display_smnu_i = 'display: none;';
	$display_smnu_j = 'display: block;';
	
	$title_scol = 'Sugerencias Enviadas';
	
}elseif($menu_col_b==0 or $menu_col_b=='' ){
	$display_smnu_a = 'display: none;';
	$display_smnu_b = 'display: none;';
	$display_smnu_c = 'display: none;';
	$display_smnu_d = 'display: none;';
	$display_smnu_e = 'display: none;';
	$display_smnu_f = 'display: none;';
	$display_smnu_g = 'display: none;';
	$display_smnu_h = 'display: none;';
	$display_smnu_i = 'display: none;';
	$display_smnu_j = 'display: none;';
	
	$title_scol = ' <span class="text-secondary">x</span>';
}


//////////////////////////////////
	
	function format_date_es($date){
		
		$data = explode('-', $date);
	                        
	    $anio = $data[0]; 
	    $mes = $data[1];
	    $dia = $data[2];
		$mes_txt = getMonth($data[1]);
							
		$mes_txt = substr($mes_txt,0, 3);
	                        
	    $fecha_es = strtoupper($mes_txt).' '.$anio;
	    return $fecha_es; 
	}
	

$user_admin = $GLOBALS['user_perfil']; 


	
$user_sesion_correo = $GLOBALS['user_correo'];

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						//informacion de acceso a la bd
						// Check connection
						if ($dbh->connect_error) {
							  die("Connection failed: " . $dbh->connect_error);
						}
						
			 		$q = "SELECT * FROM usuarios WHERE correo = '$user_sesion_correo'";
			 		$result= $dbh->query($q);
				    if ($result->num_rows > 0) {
					    $row= $result->fetch_assoc(); 
					    
					    $id = $row['id'];
						$user = $row['usuario'];
						$nombre = $row['nombre'];
						$foto = $row['foto'];
						$current_pass = $row['password'];
						
						
	                        // obtiene info del perfil
	                        $lbl_perfil = get_info_perfil($row['clave']);
	                        
	                        $data_perfil = explode(';', $lbl_perfil);
	                        $id_p = $data_perfil[0];
	                        $nombre_p = strtoupper($data_perfil[1]);
	                        $nom_corto_p = strtoupper($data_perfil[2]);
	                        $clave_p = $data_perfil[3];
	                        $icono_p = $data_perfil[4];
	                        
	                      //  $perfil = '<span class="theme_gris" style="font-size: 22px;"> <i class="fas fa-'.$icono_p.'"></i>  </span> <br>
		                  //      <label class="badge badge-secondary"> '.$nom_corto_p.'</label> ';
		                        
		                    $perfil = '<label class="badge badge-secondary text-muted">
		                    				<span class="" style="font-size: 14px;"> 
												<i class="'.$icono_p.'"></i> 
											</span> 
											'.$nombre_p.' 
										</label> ';
	                        //////						
						
						
						
						$tam_foto = strlen($foto); 
		
						$sub = substr($foto,0,4);
	
							//if($tam_foto>20){
							if($sub == 'http'){
								
								$foto_perfil = $row['foto'];
								
							}elseif($row['foto'] == ''){
								$foto_perfil = 'assets/images/faces/profile/face0.png';
							}else{
													
								
								
										$file_p = 'assets/images/faces/profile/'.$row['foto'];
																	
										if(file_exists($file_p)) {
										       //echo "The file exists";
										       $foto_perfil = 'assets/images/faces/profile/'.strtolower($row['foto']);
										       $debug = 'A'; 
										} else {
											
											$foto_perfil = 'assets/images/faces/profile/face0.png';	
											$debug = 'B';
										}
							
							}
						
						//var_dump($foto_perfil);

						
						$class_image ='
						.div_p9{
							background-image: url("'.$path_foto .'");
						}
						';
						
						// busca informacion Personal
						
						$qb = "SELECT * FROM personal WHERE id_user = $id";
							$resultb= $dbh->query($qb);
							if ($resultb->num_rows > 0) {
								$rowb= $resultb->fetch_assoc();
								
								
								$nombre = $rowb['nombre'];
								$apellido = $rowb['apellido'];
								$fecha_nac = $rowb['fecha_nac'];
								
								$calle = $rowb['dir_calle'];
								$numero = $rowb['dir_no_int'];
								$numero_ext = $rowb['dir_no_ext'];
								$numero_int = $rowb['dir_no_int'];
								$colonia = $rowb['dir_col'];
								$delegacion = $rowb['dir_mun_del'];
								$estado = $rowb['dir_estado'];
								$cp = $rowb['dir_cp'];
								$extra = $rowb['dir_extra'];
								
								$full_name = $nombre .' '. $apellido;
								$fnac = format_date_es($fecha_nac);
								
								if($numero_ext != "" or $numero_ext != 0){
									$ext = "";
									
								}else{
									$ext = ' Int. '.$numero_int;
								}
								
								$direccion = '<b>Calle:</b>'.$calle.' '. $numero_ext.$ext.',<br> <b>Col.</b> '.$colonia.',<br> <b>Del/Mun.</b>'.$delegacion.',<br> <b>CP.</b> '.$cp.', '.$estado.'.'; 
								
								/*
									for($i=0; $i<= count($estados); $i++ ){
										
										if($estado == $estados[$i]){
											$ops .= '<option selected value="'.$estados[$i].'">'.$estados[$i].'</option>';
										}else{
											$ops .= '<option  value="'.$estados[$i].'">'.$estados[$i].'</option>';
										}
									}
									*/
									
								}else{
									/*
										for($i=0; $i<= count($estados); $i++ ){
												$ops .= '<option  value="'.$estados[$i].'">'.$estados[$i].'</option>';
										}
										*/
								}
							
							
							
					
					}

							$data = explode('-', $row['fecha_registro']);
	                        
	                        $anio = $data[0]; 
	                        $mes = $data[1];
	                        $dia = $data[2];
							$mes_txt = getMonth($data[1]);
							
							$mes_txt = substr($mes_txt,0, 3);
	                        
	                        $fecha_reg = strtoupper($mes_txt).' '.$anio;

/*
	                        if($row['clave']==1){
		                        
		                        $perfil = '<label class="badge badge-success text-light"><span class="" style="font-size: 22px;"> 
		                        <i class="fas fa-user-astronaut"></i> </span> Administrador </label> ';
		                        
		                        	                        
	                        }elseif($row['clave']==0){
		                        
		                        $perfil = '<label class="badge badge-secondary"><span class="" style="font-size: 22px;"> 
		                        <i class="fas fa-user"></i></span> Coleccionista</label> ';
		                    }
*/		                    
		                   // var_dump($display_smnu_e);

$perfilb = $GLOBALS['user_perfil'];
$permiso_elimina = get_permiso_config('9', $perfilb);

if($permiso_elimina==1){
	
	$masterpass= '
	
	 <div class="col-sm-12 " style="border: 0px solid #c30; margin-left: 0px; '.$display_smnu_e.' " id="mnu_perfil_5" title="Contraseña Maestra"  >
				
			    <div class="btn_custom div_a">
			    
							<div class="row col-md-12 form-group  ">
								
								<label class="text-primary col-form-label col-sm-10">Contraseña Maestra </label>
								
								<input  autocomplete="off" type="password"  maxlength="50" name="displayName" placeholder="Escribe contraseña maestra" spellcheck="true" id="masterpass"  type="text" dir="auto" data-focusable="true" class="form-control col-sm-10" value="">
										
										
													
							</div>			    


							<div class="row col-md-12 form-group  ">
								
								<label class="text-primary col-form-label col-sm-10">Repite Contraseña Maestra </label>
								
								<input autocapitalize="sentences" autocomplete="off" type="password" autocorrect="on" maxlength="50" name="displayName" placeholder="Repite contraseña maestra" spellcheck="true" id="masterpass_verifica" type="text" onblur="save_perfil(\''. $id.'\');" dir="auto" data-focusable="true" class="form-control col-sm-10" value="">
								
													
							</div>	
							<small class="col-md-12 text-info">Si actualizas este dato, deberás reiniciar sesión.</small>		    
			    
			    </div>
				    
		<!--
				    <label class="label_a">
				    	<div class="div_b">
					    	<div dir="auto" class="div_c">
								<span class="span_a">Contraseña Maestra <i class="fas fa-pen"></i></span>
					    	</div>
					     
						 	<div class="div_d">
						    	<div dir="auto" class="div_e">
							    	<input  autocomplete="off" type="password"  maxlength="50" name="displayName" placeholder="Escribe nueva contraseña" spellcheck="true" id="masterpass"  type="text" dir="auto" data-focusable="true" class="input_a" value="">
						     	</div>
						 	</div>
						</div>
					</label>
				</div>			    
			    
			    <div class="div_a">
				    <label class="label_a">
				    	<div class="div_b">
					    	<div dir="auto" class="div_c">
								<span class="span_a">Repite Contraseña Maestra <i class="fas fa-pen"></i></span>
					    	</div>
					     
						 	<div class="div_d">
						    	<div dir="auto" class="div_e">
							    	<input autocapitalize="sentences" autocomplete="off" type="password" autocorrect="on" maxlength="50" name="displayName" placeholder="Repite nueva contraseña" spellcheck="true" id="masterpass_verifica" type="text" onblur="save_perfil(\''. $id.'\');" dir="auto" data-focusable="true" class="input_a" value="">
						     	</div>
						 	</div>
						</div>
					</label>
				</div>			
		-->
				
				        <div class="row block card-body" id="">
                        	
                         			
                        </div>  

		    </div><!-- Masterpass -->
	
	'; 
	
	$mnu_master = '
				    <div class="btn btn_custom text-left" > 
				    <a href="'.$link.'&ma=2&mb=23'.'"> 
				    	<span class="text-primary dropdown-item left" style="padding-left: 0px; "> <i class="fa fa-unlock"></i> Contraseña Maestra </span> 
				    	
				    	<small class="text-muted" >Para poder administrar algunas opciones del coleccionador deberás ingresar tu contraseña maestra.  Esta solo está definida para perfiles de <code>Administrador</code>.</small>
				    	</a>
			    	</div>
	
	
	'; 
	
}else{
	$masterpass= '<div id="mnu_perfil_5" style="'.$display_smnu_e.'" ></div>'; 
	$mnu_master = ''; 
}


echo '<style>'.$class_image.'</style>';



// crea el list para los css disponibles 
$current_css_fig = $GLOBALS['user_css_fig']; 
//var_dump($current_css_fig); 

include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbh->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}	


	//////////////////////////   BUSCA SERIES ACTIVAS   ////////////////////////////////////
	
		$qs = "SELECT * FROM css_files_fig where estado = 1;";// preparando la instruccion sql
	
		$results= $dbh->query($qs);
	    if ($results->num_rows > 0) {
		
		$tot_reg = $results->num_rows; 
		$tot = 0; 
		
			while($rows= $results->fetch_assoc()){
				
				if($rows['nombre'] == $current_css_fig){
					$opt .= '<option selected value="'.$rows['nombre'].'">'. strtoupper($rows['nombre']).'</option>';
				}else{
					if($current_css_fig=='' && $rows['nombre'] == 'default'){
						$opt .= '<option selected value="'.$rows['nombre'].'">'. strtoupper($rows['nombre']).'</option>';
					}else{
						$opt .= '<option value="'.$rows['nombre'].'">'. strtoupper($rows['nombre']).'</option>';
					}
					
				}
							
				$tot = $tot + 1; 
			}
		
		
		$select_css = '
		
	<select class="form-control col-sm-6 grid-margin-md" name="vista_fig" id="vista_fig" onchange="save_perfil(\''.$id.'\');" >
	<option value="XX">Elija una...</option>
	'.$opt.'
	</select>		
		
		';
		
		}

/*
	
	<select class="input_a" name="vista_fig" id="vista_fig" >
	<option value="XX">Elija una...</option>
	<option value="minimal">Minimalista</option>
	<option value="tech">Technologic</option>
	<option value="default">Default</option>
	</select>
	
	*/
	//$carpetas = $_SERVER[REQUEST_URI];

	



?>


 <div class="col-md-12 container-scroller "  id="main" style="height: 550px; border: 0px solid #c30; " >

	<div class="p-2-b border-bottom no-show ">
		<h1 class="text-neutral no-show" style="font-family: 'Lalezar', Serif" ><?php echo 'Hola '. strtoupper($nombre).'!'; ?> </h1>
		
				<div class="p-1 "  style="text-align: left; "> &nbsp;  
					<span id=""  style=" border-radius: 5px;" >
				<div class="btn-group left no-show " role="group" >
			    	<a href="" class ="btn btn-outline-primary" onclick="menu_perfil(1);" ><i class="fa fa-user" ></i> Info Personal</a>
			    	<a href="#" class ="btn btn-outline-primary" onclick="menu_perfil(2);"> <i class="fa fa-lock" ></i>Acceso</a>
			    	<?php echo $mnu_master;  ?>
			    	<a href="#" class ="btn btn-outline-primary" onclick="menu_perfil(4);"> <i class="fa fa-gear" ></i>Configuraciones</a>
		    	</div>			    		    
				    </span>
				    
				<button style="float: right; " type="submit" class="btn btn-primary mr-2 no-show"  onclick="save_perfil('<?php echo $id?>');">Actualizar Perfil</button> 
				
			    </div>
		
	</div>


    <div class="container-fluid page-body-wrapper">
	    
	    <div class="content-wrapper" style="padding-top:0.3rem;" >
		  <div class="row col-md-12" >
			  
		
			  
			<div class="col-md-3 " style="border-right: 1px solid #ddd; text-align: center;" >
				
				<!-- foto -->
				<div class="col-md-12 " style="align-content: center; text-align: center" >
				<div id="avatar" class="div_p1">
					<img alt="" style="height: 100%; width: 100%; max-height: 100%; max-width: 100%;" draggable="true" src="<?php echo $foto_perfil; ?>"  >
					
					<div style="position: absolute; height: 25%; bottom: 0px; width: 100%; background: rgba(5, 84, 78,0.6); padding: 10px; border-radius: 100% 100% 0 0;" onclick="toggle('form_foto_perfil');"> 
							<span class="text-light" style="margin-top: 50%; "> <i class="fa fa-camera fa-2x"></i>
							</span> 
					</div>
					
				</div>


				<div id="form_foto_perfil" class="col-md-12" style="display: none;">
					<hr>
				        <form name="form_up_perfil" method="post" action="?" id="form_up_perfil" enctype="multipart/form-data">  
					        <input type="file" name="foto_perfil" class="form-control " id="foto_perfil" placeholder="Imagen">
					            <a class="btn btn-primary btn-block  text-light" id="btn_up_foto_perfil" onclick="save_foto(1); "> 
						            <i class="fa fa-save"></i> Subir Foto 
						            
						        </a>
						    <input type="hidden" name="id_user_perfil" id="id_user_perfil" value="<?php echo $id?>" >   
					        <input type="hidden" name="tipo" value="1" >
				        </form>					
				</div>

		    	<input type="hidden" id="dir_id_user" value="<?php echo $id; ?>">

			    <br>
				    <?php echo $perfil; ?>
					<p> <span class="text-neutral">Miembro desde:</span><br> <?php echo $fecha_reg;?></p> 
				</div>
				
				<?php  ?>
						    	
			</div>
		    	
		    	<!-- termina foto --->
		  <!-- Columna de menus -->
		  
		<div class="col-sm-2 " style="border-right: 1px solid #ddd; float: left; padding: 0px; max-height: 450px;  "  >

				<div class="col-md-12 bg-secondary" style="text-align: center; padding: 0px; ">
					<h4 class="p-1 text-neutral btn_custom" style="vertical-align: middle; margin-bottom: 0px; padding-bottom: 0px; " > 
						<b>Configuración</b>
					</h4>
				</div>
					
					<div class="left sub_mnu " role="group">
				    	<a href="<?php echo $link.'&ma=1'; ?>"  class ="btn text-primary dropdown-item btn_custom" ><i class="fa fa-user"></i> Info Personal</a>
				    	<a href="<?php echo $link.'&ma=2'; ?>"  class ="btn text-primary dropdown-item btn_custom" ><i class="fas fa-sign-in-alt"></i> Acceso</a>
				    	<a href="<?php echo $link.'&ma=3'; ?>"  class ="btn text-primary dropdown-item btn_custom no-show" ><i class="fa fa-user-shield"></i>Permisos Administrador</a>
				    	<a href="<?php echo $link.'&ma=3'; ?>"  class ="btn text-primary dropdown-item btn_custom" ><i class="fa fa-user-edit"></i>Personalizar	</a>
				    	<a href="<?php echo $link.'&ma=4'; ?>"  class ="btn text-primary dropdown-item btn_custom" ><i class="fa fa-boxes"></i>Colecciones</a>
			    	
					</div>
		  
		</div>
		  
		  <!---- Fin Columna de menus -->
		    	
		  <!-- Columna de menus N2 -->
		  
		<div class="col-sm-3 " style="border-right: 1px solid #ddd; float: left; padding: 0px; max-height: 450px;  "  >

				<div class="col-md-12 bg-secondary" style="text-align: center; padding: 0px; ">
					<h4 class="p-1 text-neutral btn_custom" style="vertical-align: middle;  " > 
						<b style="margin-top: 5px; "> <?php echo $title_col; ?></b>
					</h4>
				</div>
					
				<div class="left sub_mnu " role="group" id="mnu_col_1" title="Info Personal" style="<?php echo $display_mnu_a; ?>" > 
			    				    	
			    	<div class="btn btn_custom text-left"> 
				    	<a href="<?php echo $link.'&ma=1&mb=11'; ?>">
				    	<span class="text-primary dropdown-item left btn_lbl_mnu" style="padding-left: 0px; "><i class="fa fa-user"></i> Nombre </span> 
				    	<small class="text-muted" >Captura tus datos personales, queremos conocerte mejor.</small>
				    	</a>
			    	</div> 

			    	<div class="btn btn_custom text-left"> 
				    	<a href="<?php echo $link.'&ma=1&mb=12'; ?>">
				    	<span class="text-primary dropdown-item left btn_lbl_mnu" style="padding-left: 0px; "><i class="fa fa-map-pin"></i> Dirección </span> 
				    	<small class="text-muted" > Este es un campo opcional por ahora.</small>
				    	
			    	</div> 
			    	
		    	</div>	

				<div class="left sub_mnu " role="group" id="mnu_col_2" title="Acceso" style="<?php echo $display_mnu_b; ?>" >

			    	<div class="btn btn_custom text-left" >
				    	<a href="<?php echo $link.'&ma=2&mb=21'; ?>"> 
				    	<span class="text-primary dropdown-item left btn_lbl_mnu" style="padding-left: 0px; "><i class="fa fa-user"></i> Cuenta </span> 
				    	<small class="text-muted" >Captura tus datos únicos, estos son tus datos de acceso y podremos identificarte dentro de <?php echo $name_site ?> .</small>
				    	</a>
			    	</div>
			    	
			    	<div class="btn btn_custom text-left" >
					    	<a href="<?php echo $link.'&ma=2&mb=22'; ?>">  
				    	<span class="text-primary dropdown-item left btn_lbl_mnu" style="padding-left: 0px; "><i class="fa fa-lock"></i> Contraseña </span> 
				    	<small class="text-muted" >Cambia tu contraseña de acceso. Si alguna vez la olvidas podrás restablecerla desde la pantalla de inicio.</small>
				    	</a>
			    	</div>
			    				    	
			    	<?php echo $mnu_master;  ?>		    	
		    	</div>	

				<div class="left sub_mnu " role="group" id="mnu_col_4" title="Colecciones" style="<?php echo $display_mnu_c; ?>" >

			    	<div class="btn btn_custom text-left" > 
				    	<a href="<?php echo $link.'&ma=4&mb=41'; ?>"> 
				    	<span class="text-primary dropdown-item left btn_lbl_mnu" style="padding-left: 0px; "> <i class="fa fa-boxes"></i> Colecciones Opcionales </span> 
				    	<small class="text-muted" > Tenemos colecciones extras, escoge las que quieras visualizar.</small>
				    	</a>
			    	</div>

			    	<div class="btn btn_custom text-left"> 
				    	<a href="<?php echo $link.'&ma=4&mb=42'; ?>"> 
				    	<span class="text-primary dropdown-item left btn_lbl_mnu" style="padding-left: 0px; "> <i class="fas fa-receipt"></i> Recibos Series Premium</span> 
				    	<small class="text-muted" > Consulta tus comprobantes de Donativos por las series Premium.</small>
				    	</a>
			    	</div>			    				    	
			    	<div class="btn btn_custom text-left"> 
				    	<a href="<?php echo $link.'&ma=4&mb=43'; ?>"> 
				    	<span class="text-primary dropdown-item left btn_lbl_mnu" style="padding-left: 0px; "> <i class="fa fa-comment-dots"></i> Sugerencias Enviadas</span> 
				    	<small class="text-muted" > Consulta tus comprobantes de Donativos por las series Premium.</small>
				    	</a>
			    	</div>

		    	</div>	
		    	
				<div class="left sub_mnu  " role="group" id="mnu_col_3" title="Personalizar" style="<?php echo $display_mnu_d; ?>" >
					
			    	<div class="btn btn_custom text-left" >
				    	<a href="<?php echo $link.'&ma=3&mb=31'; ?>"> 
				    	<span class="text-primary dropdown-item left btn_lbl_mnu" style="padding-left: 0px; "><i class="fa fa-gear"></i> General </span> 
				    	<small class="text-muted" > Selecciona el idioma y otras opciones para adaptar el coleccionador</small>
				    	</a>
			    	</div>

			    	<div class="btn btn_custom text-left" >
				    	<a href="<?php echo $link.'&ma=3&mb=32'; ?>"> 
				    	<span class="text-primary dropdown-item left btn_lbl_mnu" style="padding-left: 0px; "><i class="fa fa-brush"></i>Apariencia </span> 
				    	<small class="text-muted" > Escoge un tema para desplegar tu coleccionador.</small>
				    	</a>
			    	</div>
			    			    	
		    	</div>			    			    			  
		</div>
		  
		  <!---- Fin Columna de menus N2 -->		

		  <!-- Columna de menus Nivel 3 -->
		  
		<div class="col-sm-4 " style=" border-right: 0px solid #c30; float: left; padding: 0px;  height:450px; ">

			<div class="col-md-12 bg-secondary" style="text-align: center; padding: 0px; ">
				<h4  class="p-1 text-neutral btn_custom" style="vertical-align: middle; margin-bottom: 0px; padding-bottom: 0px; border-bottom: 0px solid #ddd;"  > 
					<b> <?php echo $title_scol; ?> </b>
				</h4>
			</div>
					
					<div class="left sub_mnu " role="group" id="mnu_perfil_1" title="Nombre" style="<?php echo $display_smnu_a; ?>"> 

<!--						<div class="btn_custom div_a">

							<span class="span_a">Nombre <i class="fas fa-pen"></i></span>
							<input autocapitalize="sentences" autocomplete="off" autocorrect="on" maxlength="50" name="displayName" placeholder="Escribe Nombre" spellcheck="true" type="text" dir="auto" data-focusable="true" onblur="save_perfil('<?php echo $id?>');" id="nombre" class="input_a" value="<?php echo strtoupper($nombre) ?>">
						</div>
-->

					<div class="btn_custom div_a">
	
							<div class="row col-md-12 form-group  ">
								
								<label class="text-primary col-form-label col-sm-4">Nombre  </label>
									<input autocapitalize="sentences" autocomplete="off" autocorrect="on" maxlength="50" name="displayName" placeholder="Escribe Nombre" spellcheck="true" type="text" dir="auto" data-focusable="true" onblur="save_perfil('<?php echo $id?>');" id="nombre" class="form-control col-sm-8" value="<?php echo strtoupper($nombre) ?>">								
							</div>


							<div class="row col-md-12 form-group  ">
								
								<label class="text-primary col-form-label col-sm-4">Apellidos  </label>
									<input autocapitalize="sentences" autocomplete="off" autocorrect="on" maxlength="50" name="displayName" placeholder="Escribe Apellido" spellcheck="true" type="text" dir="auto" data-focusable="true" onblur="save_perfil('<?php echo $id?>');" id="apellido" class="form-control col-sm-8" value="<?php echo strtoupper($apellido) ?>">								
							</div>

							<div class="row col-md-12 form-group  ">
								
								<label class="text-primary col-form-label col-sm-4">Fecha de Nac.  </label>
									<input autocapitalize="sentences" type="date" autocomplete="off" autocorrect="on" maxlength="50" name="displayName" placeholder="" spellcheck="true" type="text" dir="auto" data-focusable="true" id="f_nac" class="form-control col-sm-8" value="<?php echo $fecha_nac ?>">					
							</div>

<!--
					    <div class="btn_custom div_a">
							<span class="span_a">Apellido <i class="fas fa-pen"></i> </span>
							<input autocapitalize="sentences" autocomplete="off" autocorrect="on" maxlength="50" name="displayName" placeholder="Escribe Apellido" spellcheck="true" type="text" dir="auto" data-focusable="true" onblur="save_perfil('<?php echo $id?>');" id="apellido"class="input_a" value="<?php echo strtoupper($apellido) ?>">
						</div>
					
					    <div class="btn_custom div_a">
						    <span class="span_a">Fecha de Nacimiento <i class="fas fa-pen"></i> </span>
							<input autocapitalize="sentences" type="date" autocomplete="off" autocorrect="on" maxlength="50" name="displayName" placeholder="" spellcheck="true" type="text" dir="auto" data-focusable="true" id="f_nac" class="input_a" value="<?php echo $fecha_nac ?>">
						</div>
						
-->	
</div>
			    	</div>	<!-- Nombre -->
	
	
	
					<div class="left sub_mnu " role="group" id="mnu_perfil_2" title="Dirección" style="<?php echo $display_smnu_b; ?>" > 
						
					    
					    <div class="row col-md-12 form-group border-bottom ">
					    	<span class="text-primary col-sm-12 col-form-label grid-margin-md">Domicilio&nbsp; 
					    		<small >
					    			<a class="btn btn-secondary" href="<?php echo $link_site; ?>?mnu=9019cbe4458150159d9cc2f1cd473cf1&ma=1&mb=12&moddir=1"  style="padding: 2px 3px; ">Editar</a>
					    		</small>
							</span> 
							
							<label class="col-sm-12 text-muted" ><?php echo $direccion; ?></label>
					    </div>
					   
					   <!--
					    <label class="btn_custom label_a">
					    	<div class="div_b">
						    	<div dir="auto" class="div_c">
									<span class="text-primary">Domicilio</span> &nbsp; <small ><a class="btn btn-secondary" onclick="toggle('edit_direccion');" style="padding: 2px 3px; ">Editar</a></small>
						    	</div>
						     
							 	<div class="div_d">
							    	<div dir="auto" class="div_e">
								    	<label class="input_a" ><?php echo $direccion; ?></label>
								    	
							     	</div>
							 	</div>
							</div>
						</label>		
						-->
									
			    	</div> <!-- Direccion -->
		    	
		    <!---------#########################------------->
		    	
				<div class="left  " role="group" id="mnu_col_2" title="Acceso" >
					
					<div class="left sub_mnu " role="group" id="mnu_perfil_3" title="Cuenta" style="<?php echo $display_smnu_c; ?>"> 
					    
					    <div class="btn_custom div_a">
						    <!--
						    <label class="label_a">
						    	<div class="div_b">
							    	<div dir="auto" class="div_c">
										<span class="span_a">Usuario* <i class="fas fa-pen"></i></span>
							    	</div>
							     
								 	<div class="div_d">
								    	<div dir="auto" class="div_e">
									    	<input autocapitalize="sentences" autocomplete="off" autocorrect="on" maxlength="50" name="displayName" placeholder="Agrega tu nombre" spellcheck="true" type="text" dir="auto" id="usuario" data-focusable="true" onblur="save_perfil('<?php echo $id?>');" class="input_a" value="<?php echo $user;?>">
								     	</div>
								 	</div>
								</div>
							</label>
							-->
							
							<div class="row col-md-12 form-group  ">
								
								<label class="text-primary col-form-label col-sm-4">Usuario </label>
									<input autocapitalize="sentences" autocomplete="off" autocorrect="on" maxlength="50" name="displayName" placeholder="Agrega tu nombre" spellcheck="true" type="text" dir="auto" id="usuario" data-focusable="true" onblur="save_perfil('<?php echo $id?>');" class="form-control col-sm-8" value="<?php echo $user;?>">
									
													
							</div>

							
							<div class="row col-md-12 form-group  ">
								
								<label class="text-primary col-form-label col-sm-4">Correo </label>
									<label class="col-form-label col-sm-8 text-gris"> <?php echo $user_sesion_correo; ?> <span class="text-gris" title="No es posible cambiar tu correo electrónico"> <i class="fa fa-ban"></i></span> </label>
									<small class="col-md-12 text-info no-show">Esta información no es posible modificarla.</small>													
							</div>							
														
							
						</div>
		
		<!--
					    <div class="btn_custom div_a">
						    <label class="label_a">
						    	<div class="div_b">
							    	<div dir="auto" class="div_c">
										<span class="span_a">Correo* <i class="fas fa-lock"></i></span>
							    	</div>
							     
								 	<div class="div_d">
								    	<div dir="auto" class="div_e">
									    	<label class="input_a text-muted"> <?php echo $user_sesion_correo; ?> </label>
								     	</div>
								 	</div>
								</div>
							</label>
						</div>
					-->

			    	</div>	<!-- Cuenta -->
	
					<div class="left sub_mnu " role="group" id="mnu_perfil_4" title="Contraseña" style="<?php echo $display_smnu_d; ?>" > 
						
					    <div class="btn_custom div_a">
						    
			<!--			    
						    <label class="label_a">
						    	<div class="div_b">
							    	<div dir="auto" class="div_c">
										<span class="span_a">Contraseña <i class="fas fa-pen"></i></span>
							    	</div>
							     
								 	<div class="div_d">
								    	<div dir="auto" class="div_e">
									    	<input autocapitalize="sentences" autocomplete="off" type="password" autocorrect="on" maxlength="50" name="displayName" placeholder="Escribe nueva contraseña" spellcheck="true" id="p_pass"  type="text" dir="auto" data-focusable="true" class="input_a" value="">
								     	</div>
								 	</div>
								</div>
							</label>
						</div>	
			-->
			
							<div class="row col-md-12 form-group  ">
								
								<label class="text-primary col-form-label col-sm-4">Contraseña </label>
								
								<input autocapitalize="sentences" autocomplete="off" type="password" autocorrect="on" maxlength="50" name="displayName" placeholder="Escribe nueva contraseña" spellcheck="true" id="p_pass"  type="text" dir="auto" data-focusable="true" class="form-control col-sm-8" value="">
													
							</div>


							<div class="row col-md-12 form-group  ">
								
								<label class="text-primary col-form-label col-sm-4">Verifica Contraseña </label>
								
								<input autocapitalize="sentences" autocomplete="off" type="password" autocorrect="on" maxlength="50" name="displayName" placeholder="Repite nueva contraseña" spellcheck="true" id="p_pass_verifica" type="text" onblur="save_perfil('<?php echo $id?>');" dir="auto" data-focusable="true" class="form-control col-sm-8" value="">
													
							</div>												    
			<!--
					    <div class="btn_custom div_a">
						    <label class="label_a">
						    	<div class=" div_b">
							    	<div dir="auto" class="div_c">
										<span class="span_a">Verifica Contraseña <i class="fas fa-pen"></i></span>
							    	</div>
							     
								 	<div class="div_d">
								    	<div dir="auto" class="div_e">
									    	<input autocapitalize="sentences" autocomplete="off" type="password" autocorrect="on" maxlength="50" name="displayName" placeholder="Repite nueva contraseña" spellcheck="true" id="p_pass_verifica" type="text" onblur="save_perfil('<?php echo $id?>');" dir="auto" data-focusable="true" class="input_a" value="">
								     	</div>
								 	</div>
								</div>
							</label>
						</div>	
			-->
					    </div>
			    	</div>	<!-- Contraseña -->		    	
		    	

		    <!---------#########################------------->
		    
				<div class="left  " role="group" id="mnu_col_3" title="Seguridad" >
			    	<?php echo $masterpass;  ?>
		    	</div>	

		    <!---------#########################------------->
		    		    	
				<div class="left  " role="group" id="mnu_col_4" title="Personalizar" style=" overflow-y:auto;" >
					<div class="left sub_mnu " role="group" id="mnu_perfil_6" title="General" style="<?php echo $display_smnu_f; ?>" > 

						<div class="btn_custom div_a ">
<!--
					    <div class="btn_custom div_a">
						    <label class="label_a">
						    	<div class="div_b">
							    	
							    	<div dir="auto" class="div_c">
										<span class="span_a">Idioma &nbsp;<i class="fas fa-pen"> </i></span>
										
							    	</div>
							     
								 	<div class="div_d">
									 	
									 	
								    	<div dir="auto" class="div_e">
									    	
									    	<select class="input_a" name="idioma_p" onchange="save_perfil('<?php echo $id?>');" id="idioma_p" >
										    	<option value="XX">Elija una...</option>
										    	<?php echo generaListIdiomas(); ?>
									    	</select>
									    	
								     	</div>
								 	</div>
								 	
								</div>
							</label>
						</div>
-->						
						
							<div class="col-md-12 form-group  ">
								<label class="text-primary col-form-label">Idioma Inicial </label>
								
								<div class="row border-bottom ">
									<p class="col-sm-4 col-form-label">Idioma: </p>
									    	
									    	<select class="form-control col-sm-6 grid-margin-md" name="idioma_p" onchange="save_perfil('<?php echo $id?>');" id="idioma_p" >
										    	<option value="XX">Elija una...</option>
										    	<?php echo generaListIdiomas(); ?>
									    	</select>

								</div>

							</div>
					
<!--
					    <div class="btn_custom div_a">
						    <label class="label_a">
						    	<div class="div_b">
							    	
							    	<div dir="auto" class="div_c">
										<span class="span_a">Página Inicial &nbsp;<i class="fas fa-pen"> </i></span>
							    	</div>
								 	<div class="div_d">
								    	<div dir="auto" class="div_e">
									    	
									    	<select class="input_a" onchange="save_perfil('<?php echo $id?>');" name="pagina_inicial_p" id="pagina_inicial_p" >
										    	<option value="XX">Elija una...</option>
										    	 <?php echo generaListPaginas();  ?>
									    	</select>
									    	
								     	</div>
								 	</div>
								 	
								</div>
							</label>
						</div>
-->
							<div class="col-md-12 grid-margin-md ">
								<label class="text-primary col-form-label"> Página Inicial  </label>
								
								<div class="row border-bottom">
									<p class="col-sm-4 col-form-label">Página: </p>
									    	
									    	<select class="form-control col-sm-6 grid-margin-md" onchange="save_perfil('<?php echo $id?>');" name="pagina_inicial_p" id="pagina_inicial_p" >
										    	<option value="XX">Elija una...</option>
										    	 <?php echo generaListPaginas();  ?>
									    	</select>

								</div>

							</div>
						</div>
			    	</div>	<!-- General -->
	


					<div class="left sub_mnu " role="group" id="mnu_perfil_7" title="Apariencia" style="<?php echo $display_smnu_g; ?>" >
					    <div class="btn_custom div_a">

							
							<div class="col-md-12 grid-margin-md ">
								<label class="text-primary col-form-label"> Tema Minifiguras  </label>
								
								<div class="row border-bottom ">
									<p class="col-sm-4 col-form-label">Tema</p>
									<?php echo $select_css;  ?>
								</div>

							</div>
							
							<div class="col-md-12 grid-margin-md">
								<label class="text-primary"> Vista del Mosaico </label>
								
								<div class="row ">
									<p class="col-sm-4 col-form-label">Minifiguras</p>
									<select class="form-control col-sm-6" id="vista_m_p" onchange="save_perfil('<?php echo $id?>');" >
										<option value="XX">Elija una...</option>
										 <?php echo generaListVistas(1);  ?>
										
									</select>
								</div>

								<div class="row border-bottom">
									<label class="col-sm-4 col-form-label">Sets</label>
									<select id="vista_s_p" class="form-control col-sm-6 grid-margin-md" onchange="save_perfil('<?php echo $id?>');">
										<option value="XX">Elija una...</option>
										<?php echo generaListVistas(2);  ?>
									</select>
								</div>
								
							</div>
							
						</div>
			    	</div>	<!-- Apariencia-->	 
			    	
			    	
			    	   	
					<div class="left sub_mnu " role="group" id="mnu_perfil_8" title="Colecciones Opcionales" style="<?php echo $display_smnu_h; ?>" >
						
						 
					    <div class="btn_custom div_a">
						    <small class="text-muted"> 
								<p class="text-muted"> Estas colecciones fueron sugerencia de los usuarios para integrarse al coleccionador. </p> 
								
									
							</small>
							
						    <label class="label_a">
						    	<div class="div_b">
							    	<div dir="auto " class="div_c">
										
										<div class="col-sm-12" style="padding-top: 5px; max-height: 250px; overflow: scroll; overflow-x: hidden; overflow-y:auto; border:0px solid #c30;">	

											<?php 
										echo genera_check_series_opcionales($id); 
											
										 ?>
										</div>
                          		
							    	</div>
							     <br>
								 	<small>
								<p class="text-muted" style="font-size: 12px;">Algunas <b>Colecciones Opcionales</b> pueden aparecer deshabilitadas. ¡No te preocupes! tu colección no será modificada y estará intacta una vez que el administrador las active. Te avisaremos cuando esto ocurra.</p>
								 	</small>
								 	
								 	<p>¿Quires sugerir una colección?</p> 
								 		<a href="<?php echo $link_site; ?>?mnu=9019cbe4458150159d9cc2f1cd473cf1&ma=4&mb=41&modsug=1"  class="btn btn-sm btn-primary"> <i class="fa fa-envelope"></i> Envia Sugerencia </a>
								 	
								</div>
							</label>
						</div>

			    	</div> <!-- Colecciones -->

					<div class="left sub_mnu " role="group" id="mnu_perfil_9" title="Recibos Series Premium" style="<?php echo $display_smnu_i; ?>" >
						
						 
					    <div class="btn_custom div_a">
						    <small class="text-muted"> 
								<p class="text-muted"> Consulta tus recibos de Donativos. </p>
									
							</small>
							
						    
									<div class="col-sm-12" style="padding-top: 5px; max-height: 400px; overflow: scroll; overflow-x: hidden; overflow-y:auto; border:0px solid #c30;">	
										<?php
											
											echo genera_recibos($id);
											
										 ?>
									</div>
							    
						</div>

			    	</div> <!-- Sugerencias-->			    	

					<div class="left sub_mnu " role="group" id="mnu_perfil_10" title="Sugerencias Enviadas" style="<?php echo $display_smnu_j; ?>" >
						
						 
					    <div class="btn_custom div_a">
						    <small class="text-muted"> 
								<p class="text-muted"> Consulta el estado de las sugerencias que has enviado. </p>
									
							</small>
								<div class="col-sm-12" style="padding-top: 5px; max-height: 400px; overflow: scroll; overflow-x: hidden; overflow-y:auto; border:0px solid #c30;">	
										<?php
											
											echo genera_sugerencias($id);
											
										 ?>
								</div>
							    
						</div>

			    	</div> <!-- Recibos -->				    	
			    	
			    	
			    	

		    	</div>			    			    			  
		</div>
		  
		  <!---- Fin Columna de menus Niv 3 -->	
		  
		  	
		

		    
		    
	    

	
					
		  </div><!-- row col-->
		  
    	</div>


	
    </div>
    
   


<!-- Modal Recibos -->


<?php

 $modal =$_GET['mdl']; 
// $obj =$_GET['obj']; 
 $cmd = $_GET['cmd']; 
 $id_recibo = $_GET['qry'];
 
 if($modal==1){
	 
	 if($id_recibo != ''){
		 	$info_recibo = get_recibo($id_recibo,$id);
		 	$data_rec = explode(';', $info_recibo);
	 
	

						$error=$data_rec[0];
						$id=$data_rec[1];
						$id_recibo=$data_rec[2];
						$id_user=$data_rec[3];
						$id_venta=$data_rec[4];
						$fecha_venta=$data_rec[5];
						$cantidad_prod=$data_rec[6];
						$nombre_prod=$data_rec[7];
						$descripcion_prod=$data_rec[8];
						$precio_prod=$data_rec[9];
						$moneda_prod=$data_rec[10];
						$nombre_comp=$data_rec[11];
						$correo_comp=$data_rec[12];
						$telefono_comp=$data_rec[13];
						$id_pago=$data_rec[14];
						$estado_recibo=$data_rec[15];
						
						 
	 
				if($error == 0){
					$display_info = 'none';
					$card = '
					<div class="card-body" style="display:block; text-align: center;">
						<div class="col-md-12" > 
							<span class="text-muted" > <i class="fa fa-receipt fa-3x" > </i> </span> <br><br>
							<h4 class="text-muted"> El recibo no ha sido encontrado </h4> 
						</div>
					</div>
					';
				}else{
					$display_info = 'block';
					$card = ''; 
					
					if($estado_recibo == 1 ){
						
						$estado_rec = '<span class="text-success"><i class="fa fa-circle"></i> Actual </span> ';
						
					}elseif($estado_recibo == 0 ){
						$estado_rec = '<span class="text-danger"><i class="fa fa-ban"></i> Cancelado </span> ';
						
					}elseif($estado_recibo == 2 ){
						$estado_rec = '<span class="text-warning"><i class="fa fa-adjust"></i> Pendiente </span> ';
						
					}elseif($estado_recibo == 3 ){
						$estado_rec = '<span class="text-info"><i class="fa fa-retweet"></i> Devuelto </span> ';
						
					}
					
					
				}

	
		$title = '<i class="fa fa-receipt"> </i> Detalle del Recibo'; 
		$scroll = 'hidden';
		$display = 'block'; 
	}
	 
 }else{
	 $display = 'none'; 
	 $scroll = 'auto';
 }

	
?>
<div id="detalles_recibo" class="hold_general" style="border: 0px solid #c30; z-index: 9999; height: 100%; width: 100%; display:  <?php echo $display; ?>; ">
	<div class="degrade_modal"></div>
		
	<div class="pestana_edita"> 
		<span> <a href="<?php echo $link_site; ?>?mnu=9019cbe4458150159d9cc2f1cd473cf1&ma=4&mb=42&mdl=0"> <span class="claro"> <i class="fas fa-times"></i> </span> </a> </span> </div>
		
		<div class="col-lg-8 body_edita semi-transparent"  style="overflow-y:hidden ; overflow-x: hidden; margin-top: 30px;  ">
			<div class="p-2 border-bottom bg-light">
				<?php echo $title; ?>
			</div>
			
			<?php echo $card; ?>
			<div class="card-body" style="display: <?php echo $display_info; ?>">
				
				<div class="row">
					<div class="col-md-4" style=" height: 400px;" >
					
							<div class="col-md-12 border">
								
							<div class="p-3 row col-md-12  ">
								<div class=" col-sm-12 text-primary">
									<i class="fa fa-user"></i> Suscriptor 
								</div>
	
							</div>	
								
								
								<div class=" border-bottom">
									<label class="col-sm-12 text-muted text-small"> Nombre:</label>
									<label class="col-sm-12 text-medium"> <?php echo $nombre_comp;?>  </label>
								</div>

								<div class=" border-bottom">
									<label class="col-md-12 text-muted text-small"> Correo:</label>
									<label class="col-md-12 text-medium text-small"> <?php echo $correo_comp;?>  </label>
								</div>
								
								<div class=" ">
									<label class="col-md-12 text-muted text-small"> Teléfono:</label>
									<label class="col-md-12 text-medium"> <?php echo $telefono_comp; ?>  </label>
								</div>
									
													
							</div>
					
					</div>
					<div class="col-md-8 bg-secondary" style="padding:5px 20px; border-radius: 3px; height: 400px; overflow: scroll; overflow-x: hidden; overflow-y:auto; border-left: 1px solid #ccc;" >
						
						
							
							<div class="p-3 row col-md-12  ">
								<div class=" col-sm-8 text-primary">
									<i class="fa fa-paypal"></i> Info Transacción PAYPAL
								</div>
	
								<div class=" col-sm-4">
									<span class=""> <?php echo $estado_rec; ?></span>
								</div>
							</div>							
						
							
								<div class="col-md-12 row ">

									<div class="col-md-6 border-right">
										<label class="col-md-12 text-muted text-small"> ID Recibo:</label>
										<label class="col-md-12 text-medium"> <?php echo $id_recibo; ?> </label>
									</div>	

									<div class="col-md-6 ">
										<label class="col-md-12 text-muted text-small"> Fecha:</label>
										<label class="col-md-12 text-medium"> <?php echo $fecha_venta; ?> </label>
									</div>	
								</div>
								<hr>
								
								<div class="col-md-12 row ">
										
									<div class="col-md-4 border-right">
										<label class="col-md-12 text-muted text-small"> Cantidad:</label>
										<label class="col-md-12 text-medium"> <?php echo $cantidad_prod;?>  </label>
									</div>
									<div class="col-md-4 border-right">
										<label class="col-md-12 text-muted text-small"> Importe:</label>
										<label class="col-md-12 text-medium"> $ <?php echo $precio_prod;?>  </label>
									</div>
									<div class="col-md-4 border-right">
										<label class="col-md-12 text-muted text-small"> Moneda:</label>
										<label class="col-md-12 text-medium"> <?php echo $moneda_prod; ?>  </label>
									</div>								

								</div>			

								<hr>


								<div class="col-md-12 row border-bottom">



									<div class="col-md-12 ">
										<label class="col-md-12 text-muted text-small"> Descripción :</label>
										<label class="col-md-12 text-medium"> <?php echo $descripcion_prod; ?>  </label>
									</div>	

									<div class="col-md-6 border-right ">
										<label class="col-md-12 text-muted text-small"> ID Venta:</label>
										<label class="col-md-12 text-medium"> <?php echo $id_venta;?>  </label>
									</div>																	
									<div class="col-md-6 ">
										<label class="col-md-12 text-muted text-small"> Autorización:</label>
										<label class="col-md-12 text-medium"> <?php echo $id_pago;?>  </label>
									</div>	
									
							

								</div>	
								
														
					</div>
				</div>
				
			</div>
		</div>
</div>			

<!------   --> 


<!-- Modal Sugerir Serie -->

   <div class="hold_general" id="sugerir_serie" style="border: 0px solid #c30; z-index: 9999; <?php echo $disp_mod_g; ?> ">
	   <div class="degrade_modal"></div>
		<div class="col-lg-8 body_edita semi-transparent" style="overflow-y: auto; overflow-x: hidden; height: 80%; width: 90%; ">
			
			<div class="p-2 border-bottom grid-margin">
					<h4 class="text-primary"> <i class="fa fa-comment-dots"></i> Sugerir Colección</h4>
			</div>
			
    			<div class="col-sm-12" style="border: 0px solid #c30; z-index: 999;" id="" >
 
				<div class="col row">	
					<div class="col-md-6">
							
							<div class="col-md-12 grid-margin-md ">
								<div class="row ">
									<label class="text-primary col-form-label col-sm-4"> Clave LEGO </label>
									<input autocapitalize="sentences" autocomplete="off"  autocorrect="on" maxlength="50" name="Clave Lego" placeholder="Clave LEGO" spellcheck="true" type="text" dir="auto" data-focusable="true" id="clave_sug" class="form-control col-sm-8 " value="">
								</div>
							</div> 

							<div class="col-md-12 grid-margin-md ">
								<div class="row ">
									<label class="text-primary col-form-label col-sm-4"> Tema</label>
									
										<select id="tema_sug"  class="col-md-8 form-control" > 
												<option value="XX">Elije...</option> 
												<?php echo generaListTemas($a); ?> 
										</select>
									
								</div>
							</div> 
							
							<div class="col-md-12 grid-margin-md ">
								<div class="row ">
									<label class="text-primary col-form-label col-sm-4"> Tipo </label>
									<select class="form-control col-sm-8 " id="tipo_sug" >
										<option value="XX">Elije...</option>
										<option value="Minifiguras" > Minifiguras </option>
										<option value="Piezas" > Piezas de colección </option>
										<option value="Placas" > Placas Conmemorativas</option>
										<option value="Otro">Otro</option>
									</select>
								</div>
							</div> 
							
							<div class="col-md-12 ">
								<div class="row ">
									<label class="text-primary col-form-label col-sm-12"> Mas Detalles </label>
									<textarea  autocapitalize="sentences" autocomplete="off"  autocorrect="on" maxlength="300" name="detalles_sug" placeholder="Clave LEGO" spellcheck="true" type="text" dir="auto" data-focusable="true" id="detalles_sug" class="form-control col-sm-12 " value=""> </textarea>
									<small class="text-muted"> Escribe mas detalles de la colección, si esta relacionada con alguna película o programa. Cantidad de elementos, si es reciente o de ediciones pasadas.</small>
								</div>
							</div> 	


																			
					</div>
					
					<div class="col-md-6">
							<p>
								<span class="text-success" style="font-size: 18px;">¡GRACIAS POR ESCRIBIRNOS!</span> <br>
								<p class="text-muted">Analizaremos tu sugerencia con base a la información que nos proporciones, una vez que evaluemos te notificaremos sobre el resultado. </p>
								
								<p class="text-muted">Revisa Avances en el apartado de Colecciones desde tu Perfil. Recuerda que puedes tener solo <?php echo $sug_activas?> sugerencias activas simultaneamente. </p>
							</p>
							<p class="text-muted"> Recuerda que por ahora solo consideraremos productos oficiales de LEGO. </p>
							
							<a class="btn btn-success text-light btn-block" onclick="save_sugest();"><i class="fa fa-paper-plane"></i> Enviar </a>
					</div>
				</div>			
    			
    			
    			
    			
    			</div>

    	<div class="pestana_edita_top"> 
	    	<span class="claro" >
	    		<a href="<?php echo $link_site; ?>?mnu=9019cbe4458150159d9cc2f1cd473cf1&ma=4&mb=41&modsug=0" class="text-light" > <i class="fas fa-times"></i>
		    </span>
		</div>

		</div>
		

		
   </div>
   

  <!-- Modal Direccion -->
    
   <div class="hold_general" id="edit_direccion" style="border: 0px solid #c30; z-index: 9999; <?php echo $disp_mod; ?> ">
	   <div class="degrade_modal"></div>
		<div class="col-lg-8 body_edita semi-transparent" style="overflow-y: auto; overflow-x: hidden; height: 70%">
			
			<div class="p-2 border-bottom grid-margin">
				
					<h4>Edita Domicilio</h4>
				
			</div>
			
    			<div class="col-sm-12" style="border: 0px solid #c30; z-index: 999;" id="" >
				
				
		
			<div class="col row">	
				<div class="col-md-6">
							
							<div class="col-md-12 grid-margin-md ">
								
								<div class="row ">
									<label class="text-primary col-form-label col-sm-4"> Calle  </label>
									<input autocapitalize="sentences" autocomplete="off"  autocorrect="on" maxlength="50" name="displayName" placeholder="Calle" spellcheck="true" type="text" dir="auto" data-focusable="true" onblur="save_direccion();" id="dir_calle" class="form-control col-sm-8 " value="<?php echo $calle ?>">
								</div>

							</div>

							<div class="col-md-12 grid-margin-md ">
								
								<div class="row ">
									<label class="text-primary col-form-label col-sm-4"> No </label>
									<input autocapitalize="sentences" autocomplete="off"  autocorrect="on" maxlength="50" name="displayName" placeholder="No Exterior" spellcheck="true" type="text" dir="auto" data-focusable="true" onblur="save_direccion();" id="dir_no_ext" class="form-control col-sm-8" value="<?php echo $numero_ext ?>">
								</div>

							</div>

							<div class="col-md-12 grid-margin-md ">
								
								<div class="row ">
									<label class="text-primary col-form-label col-sm-4"> No Int.</label>
									<input autocapitalize="sentences" autocomplete="off"  autocorrect="on" maxlength="50" name="displayName" placeholder="No Interior" spellcheck="true" type="text" dir="auto" data-focusable="true" onblur="save_direccion();" id="dir_no_int" class="form-control col-sm-8" value="<?php echo $numero ?>">
								</div>

							</div>

							<div class="col-md-12 grid-margin-md ">
								
								<div class="row ">
									<label class="text-primary col-form-label col-sm-4"> CP. </label>
									<input id="dir_cp" autocapitalize="sentences" autocomplete="off"  autocorrect="off" maxlength="50" name="displayName" placeholder="Código Postal" spellcheck="true" type="text" dir="auto"  data-focusable="true" class="form-control col-sm-8" onkeyup="get_dir_sepomex();" value="<?php echo $cp ?>">
								</div>

							</div>


				</div>
				
				<div class="col-md-6">

							<div class="col-md-12 grid-margin-md ">
								
								<div class="row ">
									<label class="text-primary col-form-label col-sm-4"> Colonia:</label>
									<span class="col-md-8" id="div_dir_col">
										
										<textarea  autocapitalize="sentences" id="dir_colonia" autocomplete="off"  autocorrect="on" name="dir_colonia" placeholder="Colonia" spellcheck="true" type="text" dir="auto" disabled="disabled" data-focusable="true" class="form-control " ><?php echo $colonia ?></textarea>
									</span>
									
								</div>

							</div>
			

							<div class="col-md-12 grid-margin-md ">
								
								<div class="row ">
									<label class="text-primary col-form-label col-sm-4"> Del.</label>
									
									<input autocapitalize="sentences" disabled="disabled" id="dir_del" autocomplete="off"  autocorrect="on" maxlength="50" name="displayName" placeholder="Delegacion" spellcheck="true" disabled="" type="text"  dir="auto" data-focusable="true" class="form-control col-sm-8" value="<?php echo $delegacion;?>">
								</div>

							</div>

							<div class="col-md-12 grid-margin-md ">
								
								<div class="row ">
									<label class="text-primary col-form-label col-sm-4"> Estado</label>
									
									<input autocapitalize="sentences" id="dir_estado" autocomplete="off"  autocorrect="on" maxlength="50" name="displayName" placeholder="Estado" spellcheck="true" type="text" disabled="" onblur="save_direccion();" dir="auto" data-focusable="true" class="form-control col-sm-8" value="<?php echo $estado ?>">
								</div>

							</div>


				</div>
				
    		</div><!-- row -->
			

    	                <div class="row block card-body" id="">
                        	
                          	<button type="submit" class="btn btn-success mr-2" onclick="save_direccion();">Actualizar Domicilio</button>
						  	
                        </div>  
    	
    	
    	</div>
    	<div class="pestana_edita_top"> 
	    	<span class="claro" >
	    		<a href="<?php echo $link_site; ?>?mnu=9019cbe4458150159d9cc2f1cd473cf1&ma=1&mb=12&moddir=0" class="text-light" > <i class="fas fa-times"></i>
		    </span>
		</div>
		</div>
   </div> <!-- Container Scroll -->
			</div><!--  col-sm -->