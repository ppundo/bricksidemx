<?php 

	$perfil = $GLOBALS['user_perfil'];
	
	$id_fig = $_POST['serie_select']; 
	
	$ref = $_GET['item'];
	$mod = $_GET['mod'];
	
	if( isset($ref) == TRUE ){
		$serie = $ref; 
	}else{
		$serie = '00000';
	}
	

if( isset($ref)== TRUE){

	if( isset($ref)== TRUE){
		$total_serie = get_total_minifig($ref);
	}

	if( isset($id_fig) == TRUE ){
		
		$disp = 'block'; 
		$label_show = ''; 
                  		
		


//////
$extras = get_all_extras_minifig($ref);
//echo $extras;
//document.getElementById('extras-'+id_figure).value;
//////

$ids = get_ids_current($ref);

$info_fig = get_all_data_minifig($id_fig);

$data_fig = explode('/', $info_fig);
$nombre_es = $data_fig[0];
$nombre_en = $data_fig[1];
$cve_lego = $data_fig[2];
$imagen = $data_fig[3];
$tags = $data_fig[4];
$estado = $data_fig[5];
$no_folleto = $data_fig[6];
$piezas = $data_fig[7];
$fecha_registro = $data_fig[8];
$fecha_actualizado = $data_fig[9];
$total = $data_fig[10];
//var_dump($info_fig);		

$vars = '
					<div class="variables ">
                   	  <textarea class="form-control no-show" id="piezas-chk-'.$id_fig.'" rows="2"> </textarea>
	                  <input type="hidden" value="'.$nombre_es.'" id="item-'.$id_fig.'">
	                  <input type="hidden" value="'.$estado.'" id="estado-'.$id_fig.'">
	                  <input type="hidden" value="'.$no_folleto.'" id="numero-'.$id_fig.'">
	                  <input type="hidden" value="'.$no_folleto.'" id="index-'.$id_fig.'">
	                  <input type="hidden" value="'.$id_fig.'" id="id-'.$id_fig.'">
	                  <input type="hidden" value="'.$serie.'-'.$no_folleto.'" id="sku-'.$id_fig.'">
	                  <input type="hidden" value="Serie 1-'.$serie.'" id="serie-'.$id_fig.'">
	                  <input type="hidden" value="Serie 1" id="serie-nombre-'.$id_fig.'">
	                  <input type="hidden" value="'.$serie.'" id="clave-'.$id_fig.'">
	                  <input type="hidden" value="'.$nombre_es.'" id="nombre_es-'.$id_fig.'">
	                  <input type="hidden" value="'.$nombre_en.'" id="nombre_en-'.$id_fig.'">
	                  <input type="hidden" value="minifig/'.$serie.'/'.$imagen.'.png" id="url-'.$id_fig.'">
	                  <input type="hidden" value="'.$piezas.'" id="faltantes-'.$id_fig.'">
	                  <input type="hidden" value="'.$fecha_registro.'" id="fecha-'.$id_fig.'">
	                   <input type="hidden" value="'.$fecha_actualizado.'" id="fechahora-'.$id_fig.'">
	                  <input type="hidden" value="'.$no_folleto.'" id="folleto-'.$id_fig.'">
	                  <input type="hidden" value="'.$tags.'" id="tags-'.$id_fig.'">
					  <input type="hidden" value="'.$piezas.'" id="pieces-'.$id_fig.'">
					  <input type="hidden" value="1" id="extras-'.$id_fig.'">
					  <input type="hidden" value="'.$estado.'" id="status-coleccion-'.$id_fig.'">
					  <input type="hidden" value="" id="ids-current-'.$id_fig.'">
					  <input type="hidden" value="'.$total.'" id="total-fig-'.$id_fig.'">
					  <input type="hidden" value="" id="total-general-'.$id_fig.'">
					  
					  <input type="hidden" name="tserie" id="tserie" value="'.$total_serie.'" >
					  <input type="hidden" name="user" id="serie_act"  value="'.$serie.'" >
					  <input type="hidden" name="user" id="ids-current" value="'.$ids.'" >
					  <input type="hidden" name="user" id="ids_current" value="'.$ids.'" >					  
					  <input type="hidden" name="user" id="user" value="'.$GLOBALS['user'].'" >
					  
					  <div class="no-show" id="hover_collect-'.$id_fig.'" searchable="";></div>
					  <div class="no-show" id="holdcard-'.$id_fig.'" searchable="";></div>
					  <div class="no-show" id="lblname-'.$id_fig.'" ></div>

                  </div>
                  
                    '.$extras.'
                  ';
                  
                  echo $vars;
                  
                  $fx_fig = '<script type="text/javascript"> cambia_minifig(); edita_toggle(1); </script>' ;
                  
                  $all_data_minifig = get_all_info_serie($serie,$id_fig);
                 
                 $select = '<select name="serie_select" class="col-sm-10 form-control" onchange="this.form.submit(); cambia_minifig();" id="select_minifig" >
					<option value="0">Elije una Figura...</option> '.$all_data_minifig.'
				</select>

				<div id="holdcard-" ></div>

				'; 
		
	}else{
		$disp = 'none';
		$label_show = '<h5 class="text-muted center col-sm-12 " style="margin-top:30px;" >Selecciona una figura de la lista.</h5>';
		$fx_fig = ''; 
		
		        $all_data_minifig = get_all_info_serie($serie,$id_fig);
                 
                 $select = '<select name="serie_select" class="col-sm-10 form-control" onchange="this.form.submit(); cambia_minifig();" id="select_minifig" >
					<option value="0">Elije una Figura...</option> '.$all_data_minifig.'
				</select>';
	}	

	
	// actualizar foto Minifigura 

$cambia_foto_mifig = get_permiso_config('23', $perfil);

if($cambia_foto_mifig==1){
    $btn_cambia_itm = '
     <button class="btn btn-outline-primary btn-block " style="margin-top:10px;" type="button" onclick="save_edita('.$perfil.');" >
                                                    <i class="fa-solid fa-arrows-rotate"></i> <i class="fa-solid fa-images"></i>
                                                </button>
    ';
}else{
     $btn_cambia_itm = '
      	<button class="btn btn-secondary btn-block" disabled style="margin-top:10px;" type="button"  >
                                                    <i class="fa-solid fa-arrows-rotate"></i> <i class="fa-solid fa-images"></i>
                                                </button>
    ';   
}

/////////

				
	$class_select = ''; 
	$class_status = ''; 
	
	$cambia_foto = '
	
			                          <div class="col-md-12 form-group  compacted '. $class_select.'">
			                            <label for="edita_nombre_en"  class="col-form-label">Foto Personaje</label><br>
			                            <small ><code>Foto actual: <span id="foto_actual"></span> </code></small>
			                            	
			                            	<div class="row">
				                            	
				                            	<div class="col-sm-6 border" style="text-align:center; background: rgba(223, 232, 233,0.7); padding: 10px; height: 100px; border-radius: 5px; " >
					                            	<div class="col-md-12 cover_image"></div>
					                            	<img src="" class="prev_foto_minifig_mini" style="max-height:100%; max-width: 95%;" id="disp_image_minifig" >
				                            	</div>
			                            	
			                            	
												<div class="col-sm-6 ">
					                              <select id="edita_foto" aria-label="foto" onchange="cambia_foto_minifig(); " class="col-sm-12 form-control  '.$class_status.' " ?>  onchange="cambia_foto_minifig(document.getElementById(\'edita_sku\').value);" >
						                              <option value="X">Elije...</option>
						                              <option value="0.png">Sin Imagen</option>
						                              '. list_fotos_minifig($serie).'
						                              
					                              </select>
                                                  
                                               
                                                '.$btn_cambia_itm.'

												</div>
												
			                              	</div>
			                          </div>	
	
	'; 
	
	$lbl_combo_minifigs = '| Ver Minifigura: '; 

}else{
	$class_select = ''; 
	$select = ''; 
	$class_status = 'disabled';
	$lbl_combo_minifigs = ''; 

	$cambia_foto = '
	
			                          <div class="col-md-12 form-group  compacted '. $class_select.'">
			                            <label for="edita_nombre_en"  class="col-form-label">Foto Personaje</label><br>
			                            <small ><code>Foto actual: <span id="foto_actual"></span> </code></small>
			                            	
			                            	<div class="row no-show">
				                            	
				                            	<div class="col-sm-6 border" style="text-align:center; background: rgba(223, 232, 233,0.7); padding: 10px; height: 100px; border-radius: 5px; " >
					                            	<div class="col-md-12 cover_image"></div>
					                            	<img src="" class="prev_foto_minifig_mini" style="max-height:100%; max-width: 95%;" id="disp_image_minifig" >
				                            	</div>
			                            	
			                            	
												<div class="col-sm-6 ">
					                              
					                              
					                              <a class="col-sm-12 btn btn-secondary text-sm" style="margin-top: 10px;" onclick="save_edita('. $perfil.');">
						                               Actualizar
						                          </a>
												</div>
												
			                              	</div>
			                          </div>	
	
	'; 
}

$perfil = $GLOBALS['user_perfil'];
$permiso_elimina = get_permiso_config('1', $perfil);

// eliminar minifigura 
$elimina_mifig = get_permiso_config('2', $perfil);

if($elimina_mifig==1){
    $btn_elimina_itm = '
    <button class="btn btn-outline-primary" onclick="elimina_item(\' '.$id_fig.' \');" > <i class="fa-solid fa-trash"></i></button>
    ';
}else{
     $btn_elimina_itm = '
     <button class="btn btn-secondary" disabled > <i class="fa-solid fa-trash"></i></button>
    ';   
}



/// Evalua perfil de administrador para mostras opciones de administrador
if($permiso_elimina ==1){
	


	$mnu_gralb .= '	
	
	<a href="#" class="border-bottom text-muted link_op_submenu " onclick="edita_toggle(1);" >
		<div class="row col-md-12  bg-head-light hold_op_submenu" >
			<span class="col-sm-8 " style="font-size:1.1em; margin-left:10px;"> Datos Figura </span>
			<span class=" col-sm-1 text-head"  style="float:right; right:-15px; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
		</div> 
	</a>
										
	<a href="#" class="border-bottom text-muted link_op_submenu" onclick="edita_toggle(2);" >
		<div class="row col-md-12  bg-light hold_op_submenu" >
			<span class="col-sm-8 " style="font-size:1.1em; margin-left:10px;"> Mi Colección </span>
			<span class=" col-sm-1 text-head"  style="float:right; right:-15px; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
		</div> 
	</a>

	<a href="#" class="border-bottom text-muted link_op_submenu" onclick="edita_toggle(3);" >
		<div class="row col-md-12  bg-light hold_op_submenu" >
			<span class="col-sm-8 " style="font-size:1.1em; margin-left:10px;"> Mis Fig. Extras </span>
			<span class=" col-sm-1 text-head"  style="float:right; right:-15px; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
		</div> 
	</a>	
	
	
	';



	$mnu_adminb .= '

	<a href="#" class="col-md-12 border-bottom text-muted link_op_submenu bg-secondary " onclick="edita_toggle(4);" >
		<div class="row  bg-head hold_op_submenu" >
			<span class="col-sm-8 " style="font-size:1.1em; margin-left:10px;"> Info Dev </span>
			<span class="col-sm-1 text-head"  style="float:right; right:-15px; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
		</div> 
	</a>

	<a href="#" class="col-md-12 border-bottom text-muted link_op_submenu " onclick="edita_toggle(5);" >
		<div class="row bg-head hold_op_submenu" >
			<span class="col-sm-8 " style="font-size:1.1em; margin-left:10px;"> Atributos </span>
			<span class="col-sm-1 text-head"  style="float:right; right:-15px; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
		</div> 
	</a>
	'; 
	
	 
}else{
	
		$mnu_admin .= ''; 
		$mnu_adminb .= ''; 
	

	
	$mnu_gralb .= '

									<a class="btn btn-secondary btn-md" href="#" onclick="edita_toggle(2); crea_piezas(document.getElementById(\'edita_id\').value);  ">
										<span class="">Admin Mi Colección </span>
              						</a>


									<a class="btn btn-secondary btn-md" href="#" onclick="edita_toggle(3);">
										<span class=""><i class="fa fa-bag"> </i> Mis Fig. Extras </span>
              						</a>	
	';
	
	


}


$url = $link_site.'?mnu='.$_GET['mnu'].'&item='.$_GET['item'].'&element='.$_GET['element'];

//$submnu = getmenu_opcion_frame(96,$correo_cifrado);

?>

<div class="row " style=" height:480px; " >
	

	
	
	<div class="col-md-3 border-right center" style="width:180px; padding:0px; margin-left: 13px; z-index:9999; background: rgba(250,250,250,0.8);">

		<h5 class="p-3 title_sec " ><i class="fa-solid fa-child"></i> Figura </h5>

		<div class="card-body border-bottom" style="padding: 23px 0px;">
			<form action="<?php echo $url; ?>" method="post">
		<?php echo  $select;  ?>
			</form>
		
		</div>
		<div class="card-body border-bottom" style="padding: 0px; margin-top: 0px; text-align: left;">
			<?php  	echo $mnu_gralb . $mnu_adminb; ?>
		</div>
	</div>
	
    <div class="col-md" style="padding:0px; z-index:9999; background: rgba(250,250,250,0.8); height: 550px;"> 
     
     
        <h5 class="p-3 title_sec " >
            <span class=""  id="title_nombre">Nombre Minifigura</span>
        </h5>
        
    
<!-- FORM -->

	<input type="hidden" id="last_edited" value="">
	<input type="hidden" id="serie_lego" value="<?php echo $serie;?>">
             		

        <?php echo $label_show; ?>
	                   
	                   <div class="" style=" width: 100%; height:100%; display: <?php echo $disp; ?>">
					   					   		

	                   		<div class="p-1 bg-light border-bottom ">
					   			<small><span style="padding-left: 15px; color: #666; " class="card-title-fig mb-0 "> Serie:</span> 
					   			<label style="margin-right: 8px; color: #666;" class="card-title-fig mb-0 " id="edita_sku_b" > </label> </small> 

					            	                   		
		                   		<div class="btn-group" role="group" aria-label="" >
									<span id="ico_estado" class="no-show">
									</span>	
									<!--<a href="#" class="btn  btn-primary" onclick="save_edita(<?php echo $perfil; ?>);" > 
							   			<i class="fas fa-save"></i> Guardar
									</a>	-->		
                                      <?php echo $btn_elimina_itm; ?>
                      			</div>
                      			                      			
					  		</div>
				            
				            <div class="p-1 bg-light border-bottom no-show " style="padding: 0px 15px; ">
							</div>
   
				            	                   
                      <div class=" col-sm-12" style="background: rgba(250,250,250,0.8);" >
				      		
				      		<div class="row" > <!-- Agrupa Foto y Div de seccion -->
					      		
					      	

							  	<div class="col-md-10 no-show " style="margin-left: 20px;">

					                   
					               			  	
							  	</div>

					      		<!-- IMAGEN -->
					      		<div class="row col-md-6 " style="margin-left: 5px;  border: 0px solid #d40; height: 350px; " >
					      			<div class="col-md-12 " style="" >
										 <div class="form-group compacted">
											<div class="card-body" >
												<div class="bg_imagen border">
													<div class="col-lg-12 cover_image"></div>
													<div class="col-lg-12 imagen_edita" id="image_holder" style="text-align: center;">
														
													</div> 
													
												<div class="col-md-12 gradient_up_gris" style="background: rgba(250,250,250,0.7); position: absolute; height: 20%; bottom: 0px;">
													<div style="position:absolute; bottom: 0px; display: block; background: rgba(1,1,1,0.0); padding:3px 5px; width:49%; font-size:11px; left:0px;">
														<span style="position: relative; float: left; " class="text-neutral bubble-light">Ancho: <span id="edita_foto_h"> </span> px.</span><br>
														<span style="position: relative; float: left; " class="text-neutral">Alto:  <span id="edita_foto_v"> </span> px.</span>
													</div>
													
													<div style="position:absolute; bottom: 0px; display: block; background: rgba(1,1,1,0.0); padding:3px 5px; width:49%; font-size:11px; right:0px;">
														<span style="position: relative; float: right; " class="text-neutral bubble-light">Archivo: <span id="edita_foto_nombre"></span></span><br>
														<span style="position: relative; float: right; " class="text-neutral bubble-light">Tamaño: <span id="edita_foto_p"></span></span><br>
													</div>
												</div>	
													
													
												</div>
											</div>
										 </div>			 
								  	</div>  
					      		</div>
							  				                          
						  			
							  		                     
	                     
	                     <!-- ################################# OPCION 1 -- GENERAL #################################-->
	                     <div id="edita_opcion_1" class="col-md-6 " style="display: none"  >
		                     
		                    <div class="row col-md-12" >

															
												                  
			                        <div class="form-group compacted" >
				                        
			                            <label for="edita_nombre_es"  class="col-form-label">Nombre Español</label>
			<input type="text" aria-label="nombrees"  value="<?php echo $nombre_es; ?>" class="col-md-12 form-control" id="edita_nombre_es" onblur="save_edita(<?php echo $perfil; ?>);" onfocus="editado();" placeholder="Nombre Español">
			                        </div>
			                          
			                        <div class="form-group  compacted">
			                            <label for="edita_nombre_en"  class="col-form-label">Nombre Inglés</label>
			<input type="text" aria-label="nombreen" class="form-control col-md-12" value="<?php echo $nombre_en; ?>" id="edita_nombre_en" onblur="save_edita(<?php echo $perfil; ?>);" onfocus="editado();" placeholder="Nombre Ingles">
			                        </div>
			                          
			                          <?php echo $cambia_foto; ?>							 									 			           
			                                               
								
														
							</div>
							
							<div class="col-md-4  " >
							</div>
							

						</div>
						
						 <!-- ################################# OPCION 2 -- COLECCION #################################-->
	                     <div id="edita_opcion_2" class="col-md-6 no-show" style="border:0px solid #c30;" >

						 	<div class="row">
							 						 	  						 	  		 
								<div class="col-md-12 grid-margin" >
	
									
									  	<div class="form-group " style="margin: 0px;">
				                            <label for="edita_nombre_en"  class="col-form-label text-muted">Agregado el: 
				                            	<b><span id="lbl_fecha" class="text-muted"></span> </b>
				                            </label>
				                              <input type="hidden" disabled class="form-control" id="edita_fecha" placeholder="Fecha registro">
				                          </div>	
				                      
				                      <hr style="margin: 0px; padding: 0px;">   
																										
						                <div class="form-group compacted" style="padding: 0px 15px;">
							                
							                
								            <div id="hover_collect" class="item_block" style=""> 
												<span class="snackbar" style="display: block; position: relative; clear: both; ">Esta figura aún no esta en tu colección.<br>
												<span id="btn_add" style="display: block; position: relative; margin-top: 15px; "> </span>
												</span>
											</div>
										
						                    <h4 for="edita_faltante" class=" col-form-label">Piezas Faltantes</h4> 
							            
							                <div class="form-check form-check-flat">
												<span class="hold_check"  id="hold_faltantes"> </span>
						                    </div>	                            
						                </div>
									 
	
								</div>


								<div class="col-md-12 border-left" >
									<div class="form-group compacted">							
					                    <h4 for="edita_faltante" class=" col-form-label"> Palabras Claves</h4> 
						            
						                <div class="" id="hold_tags">
											<span class="bubble-text-lg">test</span> <span class="bubble-text-lg">test 2</span>
					                    </div>	
									</div>                           
								</div>
								
								<div class="col-md-4 " >
								</div>
											                        
			                    <input type="hidden" class="form-control" id="faltantes_code" value="0">
			                    
						 	</div>
							
	                     </div>	        
	                                  
						 <!-- ################################# OPCION 3 -- MarcketPlace ################################-->
	                     <div id="edita_opcion_3" class="col-md-6 no-show"  >			                
				                	                  
							  	<div class="col-sm-12 grid-margin " >
								
								  	<div class="form-check form-check-flat">
								  		<label class="form-check-label">
								  		<span id="hols_compartir" >
								  		</span>
								  		<input type="checkbox" class="form-check-input" id="edita_compartir" value="1" > 
								  		 Publicar extras en Marketplace </label>
	                            	</div>
				                        
			                            <label for="edita_nombre_es"  class=" col-form-label">¿Cuantas figuras extras tienes?:</label>

			                          <div id="hold_grid_extras" class="form-group  compacted ">   
			                          </div>						 			                              
								</div>
	                     </div>	                     
						 <!-- ################################# OPCION 4 -- DESARROLLO #################################-->
	                     <div id="edita_opcion_4" class="col-md-6  no-show">
		                    
							 	<label for="edita_nombre_es"  class=" col-form-label">Información de Base de Datos</label>

				      
				      <div class="col-md-12">

				                	<div class="form-group">
			                          <div class="input-group">
			                            <div class="input-group-prepend bg-muted border-primary">
			                              <span class=" input-group-text bg-transparent" style="width: 90px;">
			                                INDEX
			                              </span>
			                            </div>
			                            <input type="text" class="form-control" id="edita_index" placeholder="Index" aria-label="Username" aria-describedby="colored-addon2">
			                          </div>
			                        </div>
								
								<hr>

				                	<div class="form-group">
			                          <div class="input-group">
			                            <div class="input-group-prepend bg-muted border-primary" style="width: 90px;">
			                              <span class="input-group-text bg-transparent" style="width: 90px;">
			                                ID
			                              </span>
			                            </div>
			                            <input type="text" class="form-control" id="edita_id" placeholder="ID" aria-label="Username" aria-describedby="colored-addon2">
			                          </div>
			                        </div>

				                	<div class="form-group">
			                          <div class="input-group">
			                            <div class="input-group-prepend bg-muted border-primary">
			                              <span class="input-group-text bg-transparent" style="width: 90px;">
			                                SERIE
			                              </span>
			                            </div>
			                            <input type="text" class="form-control" id="edita_serie" placeholder="Index" aria-label="Username" aria-describedby="colored-addon2">
			                          </div>
			                        </div>

				                	<div class="form-group">
			                          <div class="input-group">
			                            <div class="input-group-prepend bg-muted border-primary">
			                              <span class="input-group-text bg-transparent" style="width: 90px;">
			                                URL
			                              </span>
			                            </div>
			                            <input type="text" class="form-control" id="edita_url" placeholder="Index" aria-label="Username" aria-describedby="colored-addon2">
			                          </div>
			                        </div>


				                	<div class="form-group">
			                          <div class="input-group">
			                            <div class="input-group-prepend bg-muted border-primary">
			                              <span class="input-group-text bg-transparent" style="width: 90px;">
			                                SKU
			                              </span>
			                            </div>
			                            <input type="text" class="form-control" id="edita_sku" placeholder="Index" aria-label="Username" aria-describedby="colored-addon2">
			                          </div>
			                        </div>				                        

				                	<div class="form-group">
			                          <div class="input-group">
			                            <div class="input-group-prepend bg-muted border-primary">
			                              <span class="input-group-text bg-transparent" style="width: 90px;">
			                                FOLLETO
			                              </span>
			                            </div>
			                            <input type="text" class="form-control" id="edita_folleto_db" placeholder="Index" aria-label="Username" aria-describedby="colored-addon2">
			                          </div>
			                        </div>					                    

				                	<div class="form-group">
			                          <div class="input-group">
			                            <div class="input-group-prepend bg-muted border-primary">
			                              <span class="input-group-text bg-transparent" style="width: 90px;">
			                                FECHA
			                              </span>
			                            </div>
			                            <input type="text" class="form-control" id="edita_fecha_db" placeholder="Fecha Creacion" aria-label="Username" aria-describedby="colored-addon2">
			                          </div>
			                        </div>	


						        </div>           
								                     
	            </div>	<!-- edita_opcion_4 -->     
	                                
						 <!-- ################################# OPCION 5 -- ADMIN Atributos #################################-->
	                     <div id="edita_opcion_5" class="col-md-6  no-show">
		                     
						 
							<div class="row ">		 	
									
							  	<div class="col-md-12 " >
			                          <div class="form-group compacted" >
			                            <label for="edita_tags" class=" col-form-label">Tags de Búsqueda</label>
			                              
			                              <span id="field_tags">
			                              <textarea class="form-control" aria-label="tags" onfocus="editado();" rows="3" <?php echo $edicion ?> id="edita_tags" onblur="save_edita(<?php echo $perfil; ?>);" ></textarea>
			                              </span>
			                          </div>	
			                          								  	
			                          <div class="form-group compacted" >
			                            <label for="edita_piezas" class=" col-form-label">Piezas</label>
			                              <textarea class="form-control" aria-label="piezas" onfocus="editado();" rows="4" <?php echo $edicion ?> id="edita_piezas" onblur="save_edita(<?php echo $perfil; ?>);" ></textarea>
			                          </div>									  	
							  	</div>

							  	<div class="col-md-12  border-left" >
			                          
			                          <div class="row form-group compacted" style="margin-left: 3px;">
			                            <label for="edita_folleto"  class="col-form-label">Index Folleto </label> &nbsp;
			                              
			                              <input type="text" aria-label="no_folleto" onfocus="editado();" class="form-control col-sm-2" <?php echo $edicion ?> id="edita_folleto" onblur="save_edita(<?php echo $perfil; ?>);" placeholder="No en Folleto">
			                              
			                              <span class="text-neutral col-sm-2" style="font-size: 18px; " onclick="toggle('folleto');" ><i class="btn btn-outline-primary fa fa-image " ></i></span>
			                          </div>    								  	
							  	
							  			<div class="col-md-12 grid-margin" >
								  			
								  			<div class="" style=" " id="folleto_holder"> </div>
								  			
							      							  	
							  			</div>
							  			
							  	</div>
							  	
							  	<div class="col-md-4  border-left" >
								  	
							  	</div>
							</div>
						 	                    
	                     </div>	<!-- edita_opcion_5 -->     	                     
	                     
		</div>
		
		
		
		
		</div>

	</div>
		<!-- FIN FORM -->


    </div>
    
    <?php
	    
	    echo $fx_fig ;
	    
	     ?>