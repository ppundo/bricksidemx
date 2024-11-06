<?php 


// Comprueba que exista una sesion iniciada
include("check_access.php");

$order=$_POST['filter'];

if($order==''){
	$q_filter = 'fecha_lanzamiento desc';
}else{
	$q_filter = $_POST['filter'];
}
		
////////////////
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		      //informacion de acceso a la bd
		// Check connection
			if ($dbh->connect_error) {
		    	die("Connection failed: " . $dbh->connect_error);
			}
			
              $qb = "SELECT * FROM series order by $q_filter;";// preparando la instruccion sql

//   var_dump($qb);
			    $resultb= $dbh->query($qb);
			    if ($resultb->num_rows > 0) {
				    
				    $no = 1; 
                        while($rowb= $resultb->fetch_assoc()){
	                        
	                        $num = get_total_minifig($rowb['clave_lego']);
	                        
							$data = explode(',', $rowb['color']); 
			                    
			                    $r = $data[0];
		                        $g = $data[1];
		                        $b = $data[2];
		                        
		                        $color = fromRGB($r, $g, $b);                        
	                        
	                        ///////--------
	                        
	                        $color_txtb = $rowb['color_text'];                        
	                        
	                        if($color_txtb == ''){
							
								$color_textb = '250,250,250';
									                        
	                        }else{
		                        
		                        $data_coltxtb = explode(',',$color_txtb); 
	                        
		                        $r = $data_coltxtb[0];
		                        $g = $data_coltxtb[1];
		                        $b = $data_coltxtb[2];
		                        $color_textb = fromRGB($r, $g, $b); 
		                        
		                        //$color_textb = $rowb['color_text'];
		                        
	                        }
	                        


	
		                        if($r < 77 || $g < 71 || $b < 71){
				                    $class_btn = 'btn-outline-light';
				                    $class_text = 'text-light';
				                    $border = '0px solid #ccc';
			                    }else{
									$class_btn = 'btn-outline-success'; 
									 $class_text = '';
									 $border = '1px solid #ccc';
								}
							
							
						//	if($user_perfil==1){
								
								// Botones
								/*$btn_elimina = '<button class="btn btn-outline-secondary btn_thin" title="Eliminar" onclick="quick_edit(\'3-'.$rowb['id'].'\')" > <i class="fa fa-trash" ></i> </button>'; */
								$btn_sandbox = '<button class="btn btn-inverse-primary btn_thin" title="Activar Modo Borrador" onclick="quick_edit(\'4-'.$rowb['id'].'\')" > 
													<i class="fas fa-eraser"></i> 
												</button>';  
								$btn_teaser = '<button class="btn btn-inverse-primary btn_thin" title="Activar Modo Teaser" onclick="quick_edit(\'5-'.$rowb['id'].'\')" > 
													<i class="fas fa-bullhorn"></i> 
												</button>';  
												
								$btn_pencil = '<button class="btn btn-inverse-primary btn_thin" onclick="toggleb(\'row_'.$rowb['id'].'\');" > <i class="fa fa-pencil" ></i> </button> ';
								 
								 
								 //Menus 
								 
								 //busca los menus segun la pagn ay el nivel
								 $op_mnu = '';
								 $qc = "SELECT * FROM menus where mnu_padre = 4 and nivel = 4 and estado = 1;";// preparando la instruccion sql
								 									   
											    $resultc= $dbh->query($qc);
											    if ($resultc->num_rows > 0) {	
												    while($rowc= $resultc->fetch_assoc()){
													
														$perfil = $GLOBALS['user_perfil'];
														$permiso = valida_permiso_perfil($rowc['id'],$perfil);
														
														if($permiso==1){
															$op_mnu .= '
															
														<a class="dropdown-item text-neutral" href="index.php?mnu='.$rowc['cve'].'&obj='.$rowb['clave_lego'].'" >
															<span class="ico_dropdown"><i class="fa fa-'.$rowc['icon'].'"></i></span> '.$rowc['title'].' <span class="ico_small">
															<i class="fas fa-external-link-alt"></i></span>
														</a>'; 
														
														}else{
															$op_mnu .= '';
														}
													
													}
										}
													     						 
								 //
								 
								 $permiso_elimina = get_permiso_config('3', $perfil);
								 
								 if($permiso_elimina==1){


								 	$btn_elimina = '<button class="btn btn-inverse-primary btn_thin" title="Eliminar" onclick="quick_edit(\'3-'.$rowb['id'].'\')" > <i class="fa fa-trash" ></i> </button>';

									$mnu_elimina = '<a href="#" class="dropdown-item text-danger btn-danger" onclick="quick_edit(\'3-'.$rowb['id'].'\')" >
									<span class="ico_dropdown"> <i class="fa fa-trash" ></i> </span> Eliminar Serie
									</a>'; 									 
								 }else{

								 	$btn_elimina = '<button class="btn btn-secondary btn_thin text-clear" title="Eliminar" disabled > <i class="fa fa-trash" ></i> </button>';

									$mnu_elimina = '<a href="#" class="dropdown-item text-diactive btn-inverse-primary" >
									<span class="ico_dropdown"> <i class="fa fa-trash" ></i> </span> Eliminar Serie
									</a>'; 

																 
								 }
								 

								
								/*			
								$mnu_fig = '<a class="dropdown-item text-neutral" href="index.php?mnu=7c88bb06696ba345c03eeb5719809705&obj='.$rowb['clave_lego'].'" >
												<span class="ico_dropdown"><i class="fa fa-pencil"></i></span> Editar Figuras <span class="ico_small">
												<i class="fas fa-external-link-alt"></i></span>
											</a>'; 
												
								$mnu_images = '<a class="dropdown-item text-neutral" href="index.php?mnu=4a8898a712015f09468808973cd180d2&obj='.$rowb['clave_lego'].'" >
												<span class="ico_dropdown"> <i class="fas fa-images" ></i></span>  Editar Empaques 
												<span class="ico_small"><i class="fas fa-external-link-alt"></i></span>
											</a>';
								*/	
								$mnu_users = '<a class="dropdown-item text-neutral" href="index.php?mnu=2e14b8f9a6750c809f85780adef0dfc0&obj='.$rowb['clave_lego'].'&mdl=1&cmd=1" >
												<span class="ico_dropdown"> <i class="fas fa-users" ></i></span> Ver Coleccionistas 
												<span class="ico_small"> <i class="fas fa-external-link-alt"></i></span>
											</a>';
										
								
						//	}else{
						//		$btn_elimina = ''; 
						//		$btn_sandbox = ''; 
						//		$btn_teaser = ''; 
						//		$btn_pencil ='';
						//	}
							
							
							$edo = get_lbl_estado_serie($rowb['estado']);
							
	                        if($rowb['estado']==1){
		                       // $edo = '<span class="theme_color ico_estado" title="Modo Público"> <i class=" fa fa-eye " ></i> </span>';
		                        $btn_edita = '<button class="btn btn-inverse-primary btn_thin" title="Modo Oculto" onclick="quick_edit(\'2-'.$rowb['id'].'\')" > <i class="fa fa-eye-slash" ></i> </button>'; 
	                        }else if($rowb['estado']==0){
		                        //$edo = '<span class="theme_gris ico_estado" title="Modo Oculto" > <i class=" fa fa-eye-slash" ></i> </span>';
		                        $btn_edita = '<button class="btn btn-inverse-primary btn_thin" title="Modo Público" onclick="quick_edit(\'2-'.$rowb['id'].'\')" > <i class="fa fa-eye" ></i> </button>'; 
	                        }else if($rowb['estado']==2){
		                        //$edo = '<span class="text-mantenimiento ico_estado" title="Modo Borrador"> <i class="fas fa-eraser"></i>  </span>';
		                        $btn_edita ='<button class="btn btn-inverse-primary btn_thin" title="Modo Público" onclick="quick_edit(\'2-'.$rowb['id'].'\')" > <i class="fa fa-eye-slash" ></i> </button>'; 
		                        $btn_sandbox = '
		                        <button class="btn btn-secondary text-neutral btn_thin" disabled="disabled" title="Activar Modo Borrador" onclick="quick_edit(\'4-'.$rowb['id'].'\')" > 
		                        <i class="fas fa-eraser"></i>  
		                        </button>';  
		                        
	                        }else if($rowb['estado']==3){
		                        
		                        //$edo = '<span class="text-teaser" title="Modo Teaser"> <i class="fas fa-bullhorn"></i>  </span>';
								
								$btn_edita ='
								<button class="btn btn-inverse-primary btn_thin" title="Modo Público" onclick="quick_edit(\'2-'.$rowb['id'].'\')" > 
									<i class="fa fa-eye" ></i> 
								</button>';
								
								$btn_sandbox = '
		                        <button class="btn btn-inverse-primary text-neutral btn_thin" title="Activar Modo Borrador" onclick="quick_edit(\'4-'.$rowb['id'].'\')" > 
		                        	<i class="fas fa-eraser"></i>  
		                        </button>';   		                        
								
								$btn_teaser = '
								<button class="btn btn-secondary text-muted btn_thin" disabled="disabled" title="Activar Modo Borrador" onclick="quick_edit(\'5-'.$rowb['id'].'\')" > 
										<i class="fas fa-bullhorn"></i> 
								</button>';
										                         
	                        }else if($rowb['estado']==4){
		                       
		                       // $edo = '<span class="text-test ico_estado" title="Modo Test"> <i class="fas fa-band-aid"></i> </span>';
		                        
		                        $btn_edita ='<button class="btn btn-secondary btn_thin"  title="Modo Público" onclick="quick_edit(\'2-'.$rowb['id'].'\')"  > 
		                        <i class="fa fa-eye" ></i> 
		                        </button>'; 

								$btn_sandbox = '
		                        <button class="btn btn-secondary text-neutral btn_thin"  title="Activar Modo Borrador" onclick="quick_edit(\'4-'.$rowb['id'].'\')"  > 
		                        	<i class="fas fa-eraser"></i>  
		                        </button>';   		                        
								
								$btn_teaser = '
								<button class="btn btn-secondary text-muted btn_thin"  title="Activar Modo Borrador" onclick="quick_edit(\'5-'.$rowb['id'].'\')" > 
										<i class="fas fa-bullhorn"></i> 
								</button>';
		                        
	                        }
	                        

	                        
	                        
	                        if($rowb['fecha_lanzamiento']== '0000-00-00' ){
		                        $def_fecha = '2010-01-01'; 
		                        $label_date = 'Sin Definir';
	                        }else{
		                        $def_fecha = $rowb['fecha_lanzamiento']; 
		                         $label_date = formatFechaTable($rowb['fecha_lanzamiento']);
	                        }
	                        
	                        $ops_tipo_serie = genera_ops_tipo_serie($rowb['tipo']);
	                        
	                        $ops_estado_serie = genera_ops_estado_serie($rowb['estado']);
	                        
	                        $ico_tipo_serie = get_ico_tipo_serie($rowb['tipo']);
	                        
	                        $data_ico = explode('|', $ico_tipo_serie);
	                        $icono_s = $data_ico[0];
	                        $nombre_s = $data_ico[1];
	                        $color_s = $data_ico[2];
	                        
	                        $data_nombre = explode(' ', $nombre_s);
	                        
	                        $gral = $data_nombre[0];
	                        $esp = $data_nombre[1];
	                        
	                      
	                        
	                       $tipo = '<span class="text-'.$color_s.'" style="font-size:12px;" title="'.$nombre_s.'" > <i class="'.$icono_s.'" ></i> '.$nombre_s.' </span>';
	                       
	                       /*
	                       if($rowb['tipo']==1 ){
		                       
		                       $tipo = '<span class="text-neutral" title="Consecutiva" > <i class="far fa-circle" ></i> </span>'; 
		                       
	                       }elseif($rowb['tipo']==2 ){
		                       
		                       $tipo = '<span class="active_star" title="Temática" > <i class="fas fa-circle" ></i></span> ';
		                       
	                       }elseif($rowb['tipo']==3 ){
		                       $tipo = '<span class="text-neutral" title="Opcional"> <i class="fas fa-tag"></i> </span> ';	
		                                              
	                       }else{
		                       $tipo = '<span class="text-neutral" title="Sin Definir"> <i class="fas fa-times"></i> </span> ';		                       
	                       }
	                        */
	                        
	                        
	                       //// Serie Premium 

	                        if($rowb['premium']==1){
		                        $btn_premium = '
									<button class="btn btn-inverse-primary btn_thin"  title="Activar Free" onclick="quick_edit(\'6-'.$rowb['id'].'\')" > 
											<i class="far fa-bookmark"></i>
									</button>';
									
								$mnu_premium = '<a class="dropdown-item text-neutral" href="index.php?mnu=2e14b8f9a6750c809f85780adef0dfc0&obj='.$rowb['clave_lego'].'&mdl=1&cmd=2">
													<span class="ico_dropdown"> <i class="fas fa-chart-area" ></i></span>  Ver Balance 
												</a>';
																
								$ico_premium = '<span class="text-premium ico_estado" title="Premium"> <i class="fas fa-bookmark"></i> </span>';
								
								$css_campos_prem = '';
								$css_label_prem = 'no-show';
								
								if($rowb['descuento']==0){

									$lbl_moneda = '<span class="text-muted text-sm " title="$ '.$rowb['precio_premium'].' '.$rowb['moneda_premium'].'" > 
									<i class="fa fa-dollar"></i>  '.$rowb['precio_premium'].'
									</span>';
									
								}else{
									
									$porcent = ($rowb['descuento']/100);
									$mont_desc = ($rowb['precio_premium'] * $porcent );
									$precio_final =round(($rowb['precio_premium'] - $mont_desc),2);

									$lbl_moneda = '
									<span class="text-muted text-sm " title="$ '.$rowb['precio_premium'].' '.$rowb['moneda_premium'].'" > 
										<span class="incorrecto text-danger" ><i class="fa fa-dollar"></i> ('.$rowb['precio_premium'].' )</span> 
										<span class="text-danger" > ('.$rowb['descuento'].'% )</span> <br>
										<span> <i class="fa fa-dollar"></i>  '.$precio_final.'</span>
									</span>';
									
								}
								

											 
							}elseif($rowb['premium']==0){
								$mnu_premium = '';
								
								$btn_premium = '
									<button class="btn btn-inverse-primary btn_thin"  title="Activar Premium" onclick="quick_edit(\'6-'.$rowb['id'].'\')" > 
											<i class="fa fa-bookmark"></i> 
									</button>';	
									
								$css_campos_prem = 'no-show';
								$css_label_prem = '';
								
								$ico_premium = '<span class="text-clear ico_estado" title="Premium"> <i class="far fa-bookmark"></i> 
								
								</span>';
								
								$lbl_moneda = '<span class="text-clear" style="font-size: 0.7rem; "> --- </span>';
								
							
							
							}
							
							/// Campos premium 
							
								$moneda_serie = genera_select_moneda($rowb['id'], $rowb['moneda_premium'],$rowb['id']);
								
								$field_premium = '
									<span class="text-muted '.$css_label_prem.'"> Esta serie no es Premium. </span>
									
									<span class="'.$css_campos_prem.'">
										$ <input class="col-md-3 form-control" id="s_precio_'.$rowb['id'].'" onblur="quick_edit(\'1-'.$rowb['id'].'\')" type="text" value="'.$rowb['precio_premium'].'" > 
										'.$moneda_serie.'
									</span>
									
									
								'; 	                       
	                       
	                       $select_descuentos = genera_select_descuento($rowb['id'], $rowb['descuento'],$rowb['id']);
	                       
	                       $select_dto = '	
	                       <span class="text-muted '.$css_label_prem.'"> Esta serie no es Premium. </span>  
	                       
	                       <span class="'.$css_campos_prem.'">
	                       '.$select_descuentos.'  
	                       </span>
	                       ';
	                       
	                       ///////
	                        
	                        if($rowb['estado']==99){
		                        $btn_draft = '
								<button class="btn btn-inverse-primary btn_thin" disabled title="Crear Draft: La serie sera eliminada del grid" > 
	                        		<i class="fa-regular fa-clipboard"></i>
								</button> ';
	                        }else{
		                        $btn_draft = '
								<button class="btn btn-inverse-primary btn_thin"  title="Convertir Draft" onclick="quick_edit(\'7-'.$rowb['id'].'\')" > 
	                        		<i class="fa-regular fa-clipboard"></i>
								</button> ';
	                        }
	                        
	                    	                        
	                        $btn_save = '<button class="btn btn-inverse-primary btn_thin" title="Guardar Cambios" onclick="quick_edit(\'1-'.$rowb['id'].'\')" > 
	                        <i class="fa fa-save" ></i> Guardar Cambios</button> ';
	                        
	                        $btn_mas = '<button class="btn btn-secondary text-neutral btn_thin" title="Opciones" onclick="toggle(\'drop_mnu_'.$rowb['id'].'\')" > 
	                        <i class="fas fa-ellipsis-h"></i> </button> 
	                        
	                        <div class="dropdown dropdown_ops dropdown_ops_serie" style="width:240px;"  id="drop_mnu_'.$rowb['id'].'" >
	                        
	                        	<div class="p-2 text-sm border-bottom text-neutral" > Más Opciones <b>'.$rowb['nombre'].'</b>  </div>
	                        
								
	                        	'.$op_mnu.'
	                        	
	                        	<div class="p-2-footer border-top bg-light " style="margin-top: 5px; text-align:left; padding: 3px 0px;">                        	
								'.$mnu_elimina.'
								</div>
	                        
	                        </div>
	                        
	                        ';
	                       
	                      $options_gral = $btn_elimina;
	                      
	                      
	                        
	                      //  $options = ''.$btn_edita.$btn_draft.$btn_sandbox.$btn_teaser.$btn_premium;
	                        $options = ''.$btn_edita.$btn_draft.$btn_premium;
	                        
	                        /// Busca Background Especial
	                        
	                        	$path_imagen = 'assets/images/backgrounds/'.$rowb['clave_lego'].'.png';
	             	            
	             	            if(file_exists($path_imagen)) {
								       //echo "The file exists";
								       $bg = $rowb['clave_lego'].'.png';
								} else {
								       //echo "The file does not exist";
								       $bg = 'default.png';
								}
	                        
							if($rowb['fecha_registro']=='0000-00-00 00:00:00'){
								$dato = '<span class="text-muted" > - </span>';
							}else{
								$dato = '<span class="text-muted">'.formatFechaHora($rowb['fecha_registro']).'</span>';
							}


							if($rowb['fecha_actualizado']=='0000-00-00 00:00:00'){
								$datob = '<span class="text-muted" > - </span>';
							}else{
								$datob = '<span class="text-muted">'.formatFechaHora($rowb['fecha_actualizado']).'</span>';
							}
							
							$mnu = 'edab7083e4d6a72dda1675d0b4878ee3'; 
							$url = $link_site.'?mnu='.$mnu.'&item='.$rowb['clave_lego'];	                  
	                        
	                        $filas .= '
	                        <span> </span>
	                        
	                        <tr id="'.$rowb['id'].'" style="" searchable="'.$rowb['nombre'].' '.$rowb['clave_lego'].' '.$num.' " > 
	                        	                     
	                        	
	                        	<td class="center"> <span class="text-muted center">'.$no.' </span> </td>
	                        	
	                        	<td> <span class="text-muted"> 
	                        		'.trim($rowb['clave_lego']).'		                        		
	                        		</td>
	                        
								<td> '.$tipo.'</td>
	                        
		                        <td> <span class="text-muted">'.$label_date.'</span> </td>
	                        
		                        <td class="text-muted">
		                        	<b >'.$rowb['nombre'].'</b>
									 
		                        </td>
		                        

	                        
		                        <td class="text-center" > 
		                        	<span class="form-group grid-margin" >
		                        		<span class="" style=" padding: 2px 15px; border-radius:3px; background: linear-gradient(90deg, rgba('.$rowb['color'].',0.5) 35%, rgba('.$rowb['colorb'].',1) 100%); color:'.$color_textb.'; " >  
		                        			<b>'.$num.'</b> <i class="fa-solid fa-child"></i> 
		                        		</span>
		                        	</span>
		                        </td>
		                        
								<td style="text-align: center;"> '.$ico_premium.'  </td>
								<td style="text-align: center;">  '.$lbl_moneda.' </td>
		                        
		                        <td style="text-align: center;"> '.$edo.' </td>
		                        
		                        
		                        <td >
			                          
			                          <div class="btn-group bg-light" role="group" aria-label="">
				                      '.$options.'
									  <a class="btn btn-inverse-primary text-light btn_thin" style="font-size:0.8rem;" href="'.$url.'">  '.$ico_global_edit.' </a> 
				                      </div> 
				                      
			                          <div class="btn-group" role="group" aria-label="">
				                      '.$options_gral.'
				                      </div>  
				                      
								</td>
							
	                        </tr>
	                                         
	                        
	                                             
	                        '; 
	                        $num = $num + 1;
	                        $no = $no + 1;
						}
				}

 $modal =$_GET['mdl']; 
 $obj =$_GET['obj']; 
 $cmd = $_GET['cmd']; 
 $user = $_GET['q'];
 
 if($modal==1){
	 
	 
	 if($cmd==1){ // Modal Coleccioistas
		 $title = 'Coleccionistas'; 
		$display = 'block'; 
		$scroll = 'hidden';
		$ancho_panel_a = '4';
		$ancho_panel_b = '8';
		$css_panel_a = 'block';
		$panel_a = get_users_serie($obj);	
		$bg_panels = ' bg-secondary';
		 
	 }elseif($cmd==2){ // Modal Balance
		 $title = '<span class="text-primary" ><i class="fas fa-chart-bar" ></i> Balance Serie Premium '.$obj.'</span>'; 
		$display = 'block'; 
		$scroll = 'hidden';
		$ancho_panel_a = '4'; 
		$css_panel_a = 'none';
		$bg_panels = ' ';
				
		$panel_a = '';	
		 
	 }else{

		$display = 'none'; 
		$scroll = 'auto';		 
	 }
	 
	 if($cmd==1){ // Modal Coleccionistas 

		$ancho_panel_b = '8'; 
		$css_panel_b= 'block';
		
		 if($user !=0){
			 $panel_b = get_coleccion_user($obj, $user);
		 }else{
				 $panel_b = '
				 <div class="col-md-10 " style="margin-left: 10px; ">
				 <span> Seleccione un usuario par ver su colección. </span>
				 </div>
				 '; 
		 }
	 }elseif($cmd==2){ // modal Balance 
		$panel_b = get_balance($obj);
		$ancho_panel_b = '12'; 
		$css_panel_b= 'block';
		
	 }else{
		 $panel_b = ''; 
	 }
	 
 }else{
	 $display = 'none'; 
	 $scroll = 'auto';
 }



$select_filtro = generaListFilterColeccion($order);
$mnu=$_GET['mnu'];
$link = $link_site.'?mnu='.$mnu;


?>




<!---->
<div class="col-lg-12" style="margin-top:10px; padding:0px;">
<div class="row">
		          <div class="col-md-4 form-group ">
			  <?php 
                //echo crea_campo_buscar_colecciones('admin_series');
                echo crea_campo_buscar_cust('admin_series',12);  
              
              ?>
		          </div>
		          
		        <div class="col-md-6 " style="padding-left: 0px;">
			  
                          <div class="input-group left" style="text-align: left; padding-left: 0px;">
                            
	                            <div class="btn-group col-md-5" role="group" style="text-align: left; border: 0px solid black; padding-left: 0px;" aria-label="">
	                            
		                            <div class="input-group-prepend bg-head">
		                              <span class="input-group-text text-ligth"><i class="fa-solid fa-filter"></i></span>
		                            </div>
		                            
		                            <form method="post" name="selectfilter" action="<?php echo $link; ?>">
	
										<select class="form-control" name="filter" onchange="this.form.submit()" >
											<option value="XXX"> Elije una opción </option>
											<?php echo $select_filtro; ?>
										</select>
								   
	                            	</form>
								
								</div>
                          </div>
		        </div>
			  

				
	          </div>
</div>

<div class="scrollable" style="overflow-y:<?php echo $scroll; ?>; height:465px;   "> 


<!-- Modal 1 -->
<div id="edita_serie_coleccionistas" class="hold_general" style="border: 0px solid #c30; z-index: 9999; height: 100%; width: 100%; display:  <?php echo $display; ?>; ">
	<div class="degrade_modal"></div>
		
	<div class="pestana_edita"> 
		<span> <a onclick="toggle('edita_serie_coleccionistas');" href="index.php?mnu=2e14b8f9a6750c809f85780adef0dfc0&obj=<?php echo trim($obj);?>&mdl=0"> <span class="claro"> <i class="fas fa-times"></i> </span> </a> </span> </div>
		
		<div class="col-lg-8 body_edita semi-transparent"  style="overflow-y:hidden ; overflow-x: hidden; margin-top: 30px;  ">
			<div class="p-2 border-bottom text-success">
			    <h4>	<?php echo $title; ?> XX</h4>
			</div>
			
			<div class="card-body">
				
				<div class="row">
					<div class="col-md-<?php echo $ancho_panel_a;?>" style="padding: 3px; height: 400px; display:<?php echo $css_panel_a?> ;" >
					
					<?php echo $panel_a; ?>
					
					</div>
					
					<div class="col-md-<?php echo $ancho_panel_b;  echo $bg_panels;?> " style="padding:5px 20px; border-radius: 3px; height: 400px; overflow: scroll; overflow-x: hidden; overflow-y:auto; border-left: 0px solid #ccc; display:<?php echo $css_panel_b?> ;" >
						<div class="row" style="padding-bottom: 20px; margin-bottom:20px;  ">
						   
						<?php echo $panel_b; ?>
						</div>
						
					</div>
					<div class="col-md-12" style="height:20px;" ></div>
				</div>
				
			</div>
		</div>
</div>			

<!------   --> 
          

         
                 
 <!-- TOOLS -->                      
				   <div class="card ">
				
				
								<table id="admin_series" class="table table-striped">
				                      <thead>
				                        <tr>
					                      <th class="thead_content" style=""> No </th>
				                          <th class="thead_content" style=""> Clave  </th>
				                          <th class="thead_content" style=""> Tipo  </th>
				                          <th class="thead_content" style=""> Fecha  </th>
				                          <th class="thead_content" style=""> Nombre </th>
				                          <th class="thead_content" style=""> Total  </th>
				                          <th colspan="2" class="thead_content" style=""> Premium </th>
				                          <th class="thead_content" style=""> Estado </th>
				                          <th class="thead_content" style=""> Opciones de serie</th>
				                        </tr>
				                      </thead>
				                      
				                      <tbody >
				                      	<?php echo $filas; ?>
				                      </tbody>

				                      <tfooter>
				                        <tr>
					                      <th class="thead_content" style=""> No </th>
				                          <th class="thead_content" style=""> Clave </th>
				                          <th class="thead_content" style=""> Tipo  </th>
				                          <th class="thead_content" style=""> Fecha  </th>
				                          <th class="thead_content" style=""> Nombre </th>
				                          <th class="thead_content" style=""> Total  </th>
				                          <th colspan="2" class="thead_content" style=""> Premium </th>
				                          <th class="thead_content" style=""> Estado </th>
				                          <th class="thead_content" style=""> Opciones de serie</th>
				                        </tr>
				                      </tfooter>

				                </table>
				</div> 

<!-- 		End of Container -->



                      
                    </div>
                    
                    </div>