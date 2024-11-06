<?php 
	
// Comprueba que exista una sesion iniciada
include("check_access.php");




$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		      //informacion de acceso a la bd
		// Check connection
			if ($dbh->connect_error) {
		    	die("Connection failed: " . $dbh->connect_error);
			}
			
              $qb = "SELECT * FROM cupones order by fecha_agregado desc";// preparando la instruccion sql

   
			    $resultb= $dbh->query($qb);
			    if ($resultb->num_rows > 0) {
				    
				    $no = 1; 
                        while($rowb= $resultb->fetch_assoc()){
	                                       	 								                  
	                        $dta_fecha = explode(' ', $rowb['fecha_inicio']);
	                        $fecha_i = formatFechaTabla($dta_fecha[0]);
	                        $f_ini = $dta_fecha[0];

	                        $dta_fechab = explode(' ', $rowb['fecha_fin']);
	                        $fecha_f = formatFechaTabla($dta_fechab[0]);
	                        $f_fin = $dta_fechab[0];

							if($rowb['id_user']==99){
								$userb = '<span class="text-primary"> <i class="fa fa-users"></i> Todos </span>';
							}else{								
							
								$info_userb = busca_user($rowb['id_user']);
								
								//var_dump($user);
								
								$data_userb = explode('--', $info_userb);
								
								$error = $data_userb[0];
								$nombre = $data_userb[1];
								$correo = $data_userb[2];
								$userb = '<i class="fa fa-user"></i> '.$data_userb[3];
								$foto = $data_userb[4];
								$id_user = $data_userb[5];
							}


							if($rowb['clave_serie']==99){
								$nom_serie= '<span class="text-primary"><i class="fa fa-tags"></i> Todas</span>';
							}else{								
							
								$info_userb = get_info_serie($rowb['clave_serie']);
								
								//var_dump($user);
								
								$data_serie = explode('/', $info_userb);
								
								$nom_serie = '<i class="fa fa-tag"></i> '.$data_serie[0];
								$color= $data_serie[1];
								$f_lanzamiento = $data_serie[2];
								$estado = $data_serie[3];
								$precio_prem = $data_serie[4];
								$moneda_prem = $data_serie[5];
								$dcto = $data_serie[6];
								$aux = $data_serie[7];
								$premium = $data_serie[8];
								
								
								
							}
							
							if($rowb['privacidad']==0){
								$ico_privado = '<span class="text-muted"> <i class="fa-solid fa-eye"></i></span>'; 
								$btn_priv = '<button class="btn btn-inverse-primary btn_thin" > <i class="fa fa-eye-slash" ></i> </button> ';
							}else{
								$ico_privado = '<span class="text-muted"> <i class="fa-solid fa-eye-slash"></i></span>'; 
								$btn_priv = '<button class="btn btn-inverse-primary btn_thin" > <i class="fa fa-eye" ></i> </button> ';
							}

						//	$ico_privado = '<span class="text-muted"> <i class="fa-solid fa-eye-slash"></i></span>'; 
						//	$btn_priv = '<button class="btn btn-inverse-primary btn_thin" > <i class="fa fa-toggle-on" ></i> </button> ';
							
							$hoy = date("Y-m-d");
							
							
							//$row['fecha_lanzamiento'] > $f_hoy
							
							$res_valida = compara_fechas($f_ini,$f_fin);
							$barra = genera_barra_vigencia($f_ini,$f_fin,1);
							
						//	var_dump($res_valida);
							
							
							if($res_valida==0){ // Bloqueada
								
								if($rowb['estado']==999){
									$estado_filter = '999';
									$txt_color = 'text-clear ';
									//$estado_filter = 0;
								}else{
									$txt_color = 'text-muted '; 
									$estado_filter = 0;
								}
								
								
								//$edo = get_lbl_estado_cupon($estado_filter);
							}elseif($res_valida==1){ // vigenet
								
								if($rowb['estado']!= 0){
									
									$estado_filter = $rowb['estado'];
									$txt_color = 'text-muted ';
									//$edo = get_lbl_estado_cupon($rowb['estado']);
								}
								 
							}elseif($res_valida==2){ //Fecha previa
								
								if($rowb['estado']!= 0){
									
									$estado_filter = 2;
									$txt_color = 'text-muted ';
									//$edo = get_lbl_estado_cupon(2);
								}
								 
							}
							
							$edo = get_lbl_estado_cupon($estado_filter);
							
						
						if($estado_filter==98){
                          $btn_pencil = '<button class="btn btn-inverse-primary btn_thin" disabled > '.$ico_global_edita.' </button> ';
						}else{
                          $btn_pencil = '<button class="btn btn-inverse-primary  btn_thin" onclick="toggleb(\'row_'.$rowb['id'].'\');" > 
						  '.$ico_global_edit.' </button> ';
						}
							
                          
                          $btn_guardar ='<button class="btn btn-inverse-primary " onclick="save_cupon(\''.$rowb['id'].'\');" > <i class="fa fa-save"></i> Guardar </button>';
                          
                                                    
                         


								 $permiso_elimina = get_permiso_config('13', $GLOBALS['user_perfil']);
								 
								 if($permiso_elimina==1){
									
									if($rowb['estado']=='999'){

										
										$btn_ban ='<button class="btn btn-inverse-primary  btn_thin " disabled > <i class="fas fa-ban"></i> </button>';
									 }else{
										
										$btn_ban ='<button class="btn btn-inverse-primary  btn_thin" onclick="elimina_cupon(\''.$rowb['id'].'\');" > <i class="fas fa-ban"></i> </button>';
	
									}

									$btn_eliminar ='<button class="btn btn-inverse-primary  btn_thin" onclick="elimina_def_cupon(\''.$rowb['id'].'\');" > '.$ico_global_elimina.'  </button>';
								 
								 }elseif($permiso_elimina==0){

									$btn_eliminar ='<button class="btn btn-inverse-primary  btn_thin " > '.$ico_global_elimina.' </button>';
									$btn_ban ='<button class="btn btn-inverse-primary btn_thin" disabled > <i class="fas fa-ban"></i> </button>';

																 
								 }
								 
						 $options = $btn_ban.$btn_priv.$btn_pencil;
						 $options_gral = $btn_eliminar;
                          
 $ops_serie = genera_select_series($rowb['clave_serie']);
//var_dump($rowb['clave_serie']);
                          
$ops_user = genera_select_usuarios($rowb['id_user']);

$ops_dcto = genera_select_dcto($rowb['descuento']); 
                      
$ops_edo_cupon = genera_ops_estado_cupon($estado_filter);
                          
                          
	                        $filas .= '
	                        <tr> 	                        	                     
	                        	<input id="id_registro_'.$rowb['id'].'" type="hidden"   value="'.$rowb['id'].'">
	                        	<td style="text-align:center;"> <span class="text-muted" > '.$no.'</span> </td>
						
	                        	
	                        	<td " > 
                                    <span class="text-muted"  >'.$rowb['titulo'].'</span><br>
                                    <span class="text-muted" style="font-size: 0.6rem" > Usos: '.$rowb['no_usos'].' | </span> 
                                    <span class="text-muted" style="font-size: 0.6rem" > Desc: - %'.$rowb['descuento'].'</span><br>
                                    <span class="text-muted" style="font-size: 0.6rem">'.$nom_serie.'</span>
                                
                                </td>
	                        
								<td> <span class="text-muted"> '.$userb.' </span> </td>
	                        
		                       
								
                                <td><span class="'.$txt_color.'" > '.$barra.'</span></td>
                                
								
								<td class="text-muted" style="text-align:center;"> '.$edo.' </td>                   
		                        
		                        
		                        <td >
			                          
			                          <div class="btn-group " role="group" aria-label="">
				                      '.$options.'
				                      </div> 
				                      
			                          <div class="btn-group" role="group" aria-label="">
				                      '.$options_gral.'
				                      </div>  
				                      
								</td>
							
	                        </tr>
	                        
	                        <tr id="row_'.$rowb['id'].'" style="display:none;" class="bg-light" >
	                        
		                        <td colspan = "8" style="padding:0px 0px 0px 0px; ">
			<div class="row"  >

				<div class="col-md border-right" style="padding:0px;">
                 	<div class="col-md-12 col-form-label p-2  titlel-sec" style="padding-bottom:15px; width:100%; ">General</div>
                            
							<div class="col-md-12 grid-margin-md "style="margin-left:10px;" >								
								<div class="row ">
									<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Código </label>
									<input autocapitalize="sentences" autocomplete="off"  autocorrect="on" maxlength="50" name="displayName" placeholder="Nombre Cupon" spellcheck="true" type="text" dir="auto" data-focusable="true" disabled  id="cupon_nvo_nombre_'.$rowb['id'].'" class="col-sm-6 form-control " value="'.$rowb['titulo'].'">
                                    </div>
							</div>
       
       
     						<div class="col-md-12 grid-margin-md "style="margin-left:10px;" >								
								<div class="row ">
									<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Serie </label>
									<select class="col-sm-6 form-control" id="cupon_nvo_serie_'.$rowb['id'].'">
										'.$ops_serie.'
									</select>
								</div>
							</div>
                            
                            
    						<div class="col-md-12 grid-margin-md "style="margin-left:10px;" >								
								<div class="row ">
									<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Usuario </label>
                                    <select class="col-sm-6 form-control" id="cupon_nvo_usuario_'.$rowb['id'].'">
										'.$ops_user.'
									</select>
								</div>
							</div>

          					<div class="col-md-12 grid-margin-md "style="margin-left:10px;" >								
								<div class="row ">
									<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Usos </label>
                                    <input autocapitalize="sentences" autocomplete="off"  autocorrect="on" maxlength="50" name="displayName" placeholder="Usos" spellcheck="true" type="number" dir="auto" data-focusable="true"  id="cupon_nvo_usos_'.$rowb['id'].'" class="col-sm-6 form-control " value="'.$rowb['no_usos'].'">
								</div>
							</div>    
       		</div>



							<div class="col-md border-right" style="padding:0px;">
								<div class="col-md-12 col-form-label p-2  titlel-sec" style="padding-bottom:15px; width:100%; ">Vigencia</div>
														
							        <div class="col-md-12 grid-margin-md " style="margin-left:10px;"  >								
										<div class="row ">
											<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Fecha de inicio </label>
											<input id="cupon_nvo_fini_'.$rowb['id'].'" autocapitalize="sentences" autocomplete="off"  autocorrect="off" maxlength="50" name="displayName" placeholder="Fecha Inicio" spellcheck="true" type="date" dir="auto"  data-focusable="true" class="col-sm-6 form-control "  value="'.$f_ini.'"> <label class="text-muted" style="font-size:0.7em; margin-left:35%; margin-top:5px;" >Fecha Actual: <b>'.formatFecha($f_ini).'</b> </label>
										</div>							
									</div>
							
							        <div class="col-md-12 grid-margin-md " style="margin-left:10px;">								
										<div class="row ">
											<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Fecha Final </label>
											<input id="cupon_nvo_ffin_'.$rowb['id'].'" autocapitalize="sentences" autocomplete="off"  autocorrect="off" maxlength="50" name="displayName" placeholder="Fecha Final" spellcheck="true" type="date" dir="auto"  data-focusable="true" class="col-sm-6 form-control "  value="'.$f_fin.'"><label class="text-muted" style="font-size:0.7em; margin-left:35%; margin-top:5px;" >Fecha Actual: <b>'.formatFecha($f_fin).'</b></label>
										</div>							
									</div>
                                    
									<div class="col-md-12 grid-margin-md "style="margin-left:10px;" >								
										<div class="row ">
											<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Descuento </label>
											<select class="col-sm-6 form-control" id="cupon_nvo_descuento_'.$rowb['id'].'">
												'.$ops_dcto.'
											</select>
										</div>
									</div>      
							</div>

							<div class="col-md border-right" style="padding:0px;">
								<div class="col-md-12 col-form-label p-2  titlel-sec" style="padding-bottom:15px; width:100%; ">Opciones</div>
						
								<div class="col-md-12 grid-margin-md " style="margin-left:10px;">			
									<div class="row ">
										<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Estado </label>
										<select class="col-sm-6 form-control" id="cupon_nvo_estado_'.$rowb['id'].'">
											'.$ops_edo_cupon.'
										</select>
									</div>

									'.$btn_guardar.'
								</div> 
                
								<div class="col-md-10" style=" text-align:left;">                        
								
								</div>
                        
                			</div>
                            
                        
                        
                        
               </div>
                                	                      	
		            </td>
	            </tr>
                        
	                        '; 
	                        $num = $num + 1;
	                        $no = $no + 1;
						}
						
						$table = '
	
								<table id="cupones" class="table table-striped table-bordered">
				                      <thead>
				                        <tr>
					                      <th class="thead_content" style=""> No </th>
				                          <th class="thead_content" style=""> Cupón  </th>
				                          <th class="thead_content" style=""> Aplica para </th>
				                          <th class="thead_content" style=""> Vigencia </th>
				                          <th class="thead_content" style=""> Estado </th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      <tbody >
				                      	'.$filas.'
				                      </tbody>

				                      <tfooter>
				                        <tr>
					                      <th class="thead_content" style=""> No </th>
				                          <th class="thead_content" style=""> Cupón  </th>
				                          <th class="thead_content" style=""> Aplica para </th>
				                          <th class="thead_content" style=""> Vigencia </th>
				                          <th class="thead_content" style=""> Estado </th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </tfooter>

				                </table>					
						
						';
					
					}else{
						$table = '<div class="col-md-12 center text-muted"> <h4>Aún no hay cupones.</h4> </div>';
					}




?>
<div class="row" style="margin: 0px;">
	<div class="col-12 border-right" style="padding:0px;">
		<h4 class="p-2 title_sec"> Administrar Cupones </h4>
		

		<input id="bandera_actualiza" type="hidden" value="1">

		<div class="col-12" style="margin-top:10px;">
					<?php
						echo $campo_buscar = crea_campo_buscar_cust('cupones',6); 
					?>
		</div>

		<div class="col-12" style="height: 430px; overflow-y:auto; overflow-x:hidden;">
				<?php		
					
					echo $table;
				?>
		</div>
	</div>

	<div class="col-4 no-show" style="padding:0px; margin:0px;">
		<h4 class="col-12 p-2 title_sec"> Editar Cupon </h4>
		<div class="tool_bar"> <?php echo $btn_guardar; ?></div>

	<!-- capos -->
	<div class="col-12" style="padding:0px; margin:10px 0px; height:430px; overflow:scroll; overflow-x:hidden; overflow-y:auto; ">

	<div class="col-md-12 grid-margin-md "style="margin-left:10px;" >								
		
		<div class="row ">
			<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Código </label>
			<input autocapitalize="sentences" autocomplete="off"  autocorrect="on" maxlength="50" name="displayName" placeholder="Nombre Cupon" spellcheck="true" type="text" dir="auto" data-focusable="true" disabled  id="cupon_nvo_nombre" class="col-sm-6 form-control " value="">
        </div>
	</div>
       
       
    <div class="col-md-12 grid-margin-md "style="margin-left:10px;" >								
		<div class="row ">
			<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Serie </label>
			<select class="col-sm-6 form-control" id="cupon_nvo_serie">
				<?php echo $ops_serie; ?>
			</select>
		</div>
	</div>
                            
                            
    <div class="col-md-12 grid-margin-md "style="margin-left:10px;" >								
		<div class="row ">
			<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Usuario </label>
            <select class="col-sm-6 form-control" id="cupon_nvo_usuario">
				<?php echo $ops_user; ?>
			</select>
		</div>
	</div>

    <div class="col-md-12 grid-margin-md "style="margin-left:10px;" >								
		<div class="row ">
			<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Usos </label>
            
			<input autocapitalize="sentences" autocomplete="off"  autocorrect="on" maxlength="50" name="displayName" placeholder="Usos" spellcheck="true" type="number" dir="auto" data-focusable="true"  id="cupon_nvo_usos" class="col-sm-6 form-control " value="">
		</div>
	</div>  

		<div class="col-md-12 grid-margin-md " style="margin-left:10px;"  >								
			<div class="row ">
				<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Fecha de inicio </label>
				<input id="cupon_nvo_fini_'.$rowb['id'].'" autocapitalize="sentences" autocomplete="off"  autocorrect="off" maxlength="50" name="displayName" placeholder="Fecha Inicio" spellcheck="true" type="date" dir="auto"  data-focusable="true" class="col-sm-6 form-control "  value=""> <label class="text-muted" style="font-size:0.7em; margin-left:35%; margin-top:5px;" >Fecha Actual: <b><?php echo formatFecha($f_ini); ?></b> </label>
			</div>							
		</div>
							
		<div class="col-md-12 grid-margin-md " style="margin-left:10px;">								
			<div class="row ">
				<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Fecha Final </label>

				<input id="cupon_nvo_ffin_'.$rowb['id'].'" autocapitalize="sentences" autocomplete="off"  autocorrect="off" maxlength="50" name="displayName" placeholder="Fecha Final" spellcheck="true" type="date" dir="auto"  data-focusable="true" class="col-sm-6 form-control "  value="'.$f_fin.'"><label class="text-muted" style="font-size:0.7em; margin-left:35%; margin-top:5px;" >Fecha Actual: <b><?php echo formatFecha($f_fin) ?></b></label>
			</div>							
		</div>
                                    
		<div class="col-md-12 grid-margin-md "style="margin-left:10px;" >								
			<div class="row ">
				<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Descuento </label>
					<select class="col-sm-6 form-control" id="cupon_nvo_descuento_'.$rowb['id'].'">
						<?php echo $ops_dcto; ?>
					</select>
			</div>
		</div> 

		<div class="col-md-12 grid-margin-md " style="margin-left:10px;">			
			<div class="row ">
				<label class="text-muted col-form-label col-sm-4 lbl_form_sm"> Estado </label>
				<select class="col-sm-6 form-control" id="cupon_nvo_estado_'.$rowb['id'].'">
					<?php echo $ops_edo_cupon ?>
				</select>
			</div>

			
		</div> 
	</div>
	<!-- -->
	</div>
</div>
