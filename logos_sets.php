<?php 
	

$logo = list_logos_foto('X');

$perfil = $GLOBALS['user_perfil'];
$permiso_elimina = get_permiso_config('16', $perfil);
$permiso_edita = get_permiso_config('17', $perfil);


$campo_buscar = crea_campo_buscar('logo_fotos'); 


?>


<div class="scrollable bg-light" style="overflow-y:<?php echo $scroll; ?>;   "> 

	<div class="col-12 " >
					
				<div class="row ">
					
					<!-- Lista de Imagenes -->
					<div class="col-md-5 border-right  " style="border-right: 1px solid #ccc;  padding:0px;">
						<h5 class="col-md-12 p-3 title_sec " style="margin-bottom:10px;" > Imágenes Encontradas</h5>
                        <div class="col-md">
                        <?php echo $campo_buscar; ?>
                        </div>
                        <div class="col-md" style="height: 370px; overflow: scroll; overflow-y: auto; overflow-x: hidden;">
						    <?php echo $logo; ?>
                        </div>
					</div>
					
					<!-- Desplegar Imagen -->
					<div class="col-md-4 border-right" style="padding:0px;  ">
						
						<h5 class="col-md-12 p-3 title_sec border-bottom " > Información</h5>

                        <div class="col-md" style="height: 329px;  overflow: hidden; margin-top:10px;">
                            <div class="col-md-12 border-bottom bg-muted " style=" margin-bottom: 10px;"> 
                                
                                
                                <div class="row" style="z-index: 999; padding: 3px 0px;">
                                    <label class="col-sm-2 text-muted col-form-label">Foto:</label>
                                    <input type="hidden" id="permiso_elimina_set" value="<?php echo $permiso_elimina; ?>">
                                    <input type="hidden" id="permiso_edita_set" value="<?php echo $permiso_edita; ?>">
                                    
                                    <input type="text" disabled="" placeholder="nombre_foto" class="col-sm-4 form-control" value="" id="foto_name_edit" style="margin-right: 10px;">
                                    <div class=" btn-group" role="group"  id="btn_img" style="margin-bottom: 2px;">	</div>
                                </div>
                                                                
                                <div id="new_set_status">
                                </div>
                            </div>
                            
                            <div class="col-md-12 form-group compacted" id="display_image_set_admin" style="  display: block; border: 0px solid #ccc; text-align: center; align-content:  center; "> 
                                <div class="col-lg-12 cover_image zoom"> </div>
                                <img src="assets/images/sets/noimage.png" class="result_image_set zoom" style="max-height:70%; max-width:100%;  ">
                                
                            </div>	
                        </div>					
						
					</div>
					
					<!-- Agregar Imagen -->
					<div class="col-md-3" style="padding:0px;">
					
						<h5 class="col-md-12 p-3 title_sec" > Opciones</h5>

                        <div class="col-md" style=" height: 329px; overflow-y: auto; overflow-x: hidden;">
							
                            <div class="col-md-12 border-bottom bg-muted " style="padding: 5px 10px; margin-top:10px;">
								<div class=" btn-group" role="group"  id="btn_plus" style="margin-bottom: 2px;"> &nbsp;	</div>
							</div>			
                            
								<div class="form-group row compacted grid-margin no-show" id="upload_new_imagen">
			                        <form name="form_up_set" method="post" action="?" id="form_up_set" enctype="multipart/form-data">
			                        <label for="edita_imagen" class="col-sm-6 ">Subir Imagen</label>
			                    	
				                        <input type="file" name="foto" class="col-sm-10 form-control " id="foto" placeholder="Imagen">
				                        <a class="btn btn-primary btn-block  text-light col-sm-10" id="btn_up_foto" onclick="save_foto(2);">
					                         <i class="fa fa-arrow-circle-up"></i> Subir Foto</a>
				                        <input type="hidden" name="user_id" value="<?php echo $user_id?>" >
				                        <input type="hidden" name="tipo" value="2" >
			                    	</form>
			                    </div> 
			                    		
			                    		
                        </div>
  				
					</div>
					
				</div>
				

	</div>


</div>