<?php 
	
$logo = list_set_foto('X');

$perfil = $GLOBALS['user_perfil'];

$permiso_elimina = get_permiso_config('11', $perfil);
$permiso_edita = get_permiso_config('12', $perfil);

// enciuentra los sets nuevos que no tienen imagenes
$set_fotos = get_select_set_coleccion();


if(strlen($set_fotos)<=59){
    $param_select = ' disabled ';
}else{
    $param_select = '';
}

$contar = strlen($set_fotos);

//var_dump($contar);


$ops = $set_fotos; 


?>


					
				<div class="row bg-light" >
					
					<!-- Lista de Imagenes -->
					<div class="col-md-5 border-right left_panel_shadow " style="height: 540px; padding:0px;" >
						<h5 class="col-md-12 p-2 title_sec " > Imágenes Encontradas</h5>

                        <div id="display_imgs" class="col-lg" style="padding:0px;">
						    <?php echo $logo; ?>
                        </div>
					</div>
					
					<!-- Desplegar Imagen -->
					<div class="col-md-4 border-right bg-light left_panel_shadow" style="padding:0px; ">
						
						<h5 class="col-md-12 p-2 title_sec " > Información</h5>

                        <div id="display_imgs" class="col-lg" style="height:460px; padding:0px;">
						    <div class="col-md-12 border-bottom  " style=" margin-bottom: 10px; padding:0px;"> 
							
                                <div class="tool_bar" style="z-index: 999; padding: 3px 0px;">
                                    <div class=" btn-group" role="group"  id="btn_img" style="margin-bottom: 2px;">	</div>
                                    <div class=" btn-group" role="group"  id="btn_plus" style="margin-bottom: 2px; border:0px solid #ccc;">	</div>
                                </div>

                                <div class="col-md-12 row" style="margin-top:10px; padding-bottom:10px;">
                                    <label class="col-sm-3 text-muted col-form-label">Imagen:</label>
                                    <input class="col-sm-4 form-control" type="text" disabled="" placeholder="nombre_foto"  value="" id="foto_name_edit" style="">
                                    <input class="col-sm-2 form-control" type="text" disabled="" placeholder="ext_foto"  value="" id="foto_ext_edit" style="margin-right: 10px;">
                                </div>

                                <input type="hidden" id="permiso_elimina_set" value="<?php echo $permiso_elimina; ?>">
                                <input type="hidden" id="permiso_edita_set" value="<?php echo $permiso_edita; ?>">
                                <input type="hidden" id="nombre_set_actual" value="">
                                
                                <div id="new_set_status"></div>
						    </div>
						
						    <div class="" id="display_image_set_admin" style="height:350px; text-align: center; align-content:center; "> 
							    
							   <img src="assets/images/sets/noimage.png" class="result_image_set zoom" style="max-height:70%; max-width:100%;  ">
							
						    </div>

                        </div>				
						
					</div>
					
					<!-- Agregar Imagen -->
					<div class="col-md-3 " style="padding:0px;">
					
						<h5 class="col-md-12 p-2 title_sec " > Img. Faltantes</h5>

                        <div id="display_imgs" class="col-lg" style="padding:0px; height:400px; overflow: scroll; overflow-y: auto; overflow-x: hidden;">

							<div class="mnu_bar" style="">
                                <div class=" btn-group-bar" role="group"  style="margin-bottom: 2px;"> 
								
                                    <button id="fileimg_1" type="button" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar_sm fileimg fileimg_sm"> <i class="fa-solid fa-file-circle-plus"></i> </button>
                                    <button id="fileimg_2" type="button" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar_sm fileimg fileimg_sm"> <i class="fa-solid fa-file-image"></i> </button>
                                    
                                </div>
							</div>			
                            
								<!--inicio-->
                            <div class="col-md-12 img_sub_op " id="div_fileimg_2" style="margin-top: 10px; display:none;">
                            <span class="text-muted">Selecciona un set:</span>
                                <form name="form_up_set" method="post" action="?" id="form_up_set" enctype="multipart/form-data">
                                    
                                    <select id="new_set_cve" <?php echo $param_select; ?> name="new_set_cve" onchange="valida_img();" class="form-control">
                                        <?php echo $ops; ?>
                                    </select>
                                    <input type="hidden" id="new_set_foto" name="tipo" value="2" >
                                    
                                    <div class="col-md-12 " id="carga_img" style="display: none; margin-top:20px; padding:0px;">
                                        <span class="text-muted">Subir imagen:</span>
                                            <input type="file" name="foto" class="col-sm-12 form-control " id="foto" placeholder="Imagen">
                                            
                                            <a class="btn btn-primary btn-block  text-light col-sm-12" id="btn_up_foto" onclick="save_foto(2);"> <i class="fa fa-arrow-circle-up"></i> Subir Imagen</a>
                                            
                                            <input type="hidden" name="user_id" value="<?php echo $user_id?>" >
                                            <input type="hidden" name="tipo" value="2" >
                                                
                                    </div> 

                                    <div class="col-lg-12" id="new_set_status"></div>
                                    <div class="col-lg-12" id="display_image_set_admin"></div>                                    
                                    <div id="prev_image" class="row form-group compacted" style=" display: block; border: 0px solid #ccc;  "></div>
                                
                            </form>
                            </div><!--fin-->

							<!--inicio-->
							<div class="col-md-12 img_sub_op" id="div_fileimg_1" style="margin-top: 10px; display:none; ">						

                                   <span class="text-muted">Selecciona un archivo:</span>
			                        <form name="form_up_set_n" method="post" action="?" id="form_up_set_n" enctype="multipart/form-data">
			                        
                                        
			                    	
									    <input type="hidden" placeholder="Clave Lego" class="form-control" value="" id="new_set_cve_n" name="new_set_cve_n" >
									

				                        <input type="file" name="foto_n" class="col-sm-12 form-control " id="foto_n" placeholder="Imagen" >
				                        <a class="btn btn-primary btn-block  text-light col-sm-12" id="btn_up_foto_n" onclick="save_foto(22);">
					                         <i class="fa fa-arrow-circle-up"></i> Subir Imagen</a>
				                        <input type="hidden" name="user_id" value="<?php echo $user_id?>" >
				                        <input type="hidden" name="tipo" value="22" >
			                    	</form>

                            </div><!--fin-->



			                    		
			            </div>
			
  				
					</div>
					
				</div>


    