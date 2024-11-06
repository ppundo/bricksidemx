
	
	
	<div class="main-panel border" style="min-height: auto;  margin-top: 10px; margin-bottom: 10px; width: 90%; float: right;  z-index: 9999;  ">
		
	   
	   		<div class="col-lg-12">

		   	
							
	                   		<div class="p-1 border-bottom  bg-light grid-margin"  style="text-align: center; "> 
		                   		&nbsp;  <span id="admin_minifigure_status"  style=" border-radius: 5px;" >Las imágenes en amarillo, son las únicas que podrán manipularse. </span>
	                   		</div>    
	                   		
	                   		
				<div class="row" style="border: 0px solid #c30; max-height: 50%;  ">
					
					
		   			<div class="col-sm-4 grid-margin "style="max-height: 300px; border: 0px solid #c30;  " >	
			   			
			   			
			   			<?php
				   			
				   			$info = labels_admin_fotos($clave_lego);
				   			
				   			

				   			echo '
				   			<div class="col-md-12" style="height:100%; border: 0px solid #c34;overflow: scroll; overflow-x: hidden; overflow-y: auto; " id="hold_labels_images" >
				   			
				   			'.$info.'
				   			</div>
				   			'; 
				   			//echo $labels; 
				   			
				   			?>
	                				            				                    
					</div>
				
				<!-- Panel Imagen -->
					<div class="col-sm-3 grid-margin " style="max-height: 300px; text-align: center; " >
						
						
						<label for="edita_imagen" class="col-sm-12 text-muted center" ></label>
						

											<div class="card-body" >
												<div class="bg_imagen border">
													<div class="col-md-12 cover_image"></div>
													
													<div class="col-md-12 imagen_edita" style="text-align: center; vertical-align: middle;" id="image_holder_">
													<img class="picture_o" style=" max-width: 200px; max-width: 90%; max-height: 95%; margin-top: 20px;  " src="<?php echo 'minifig/'.$_GET['obj'].'/1.png';  ?>" id="prev_foto">
													</div> 
													
												</div>
											</div>
						
						
						
<!---- Cierre del DIV ----------- hold_labels_images -->
							
					</div>
					
					<div class="col-md-4 grid-margin " >
						
						<button class="btn btn-outline-secondary btn-block grid-margin" onclick="toggle('hold_subir_imagen')"> <i class="fa fa-upload"></i> Subir imagen </button>
						
							<div id="hold_subir_imagen" style="display: none; ">
				                    <div class="form-group row compacted grid-margin ">
				                        
				                    	<form name="form_up_minifig" method="post" action="?" id="form_up_minifig" enctype="multipart/form-data">  
					                        <input type="file" name="foto_minifig" class="form-control " id="foto_minifig" placeholder="Imagen">
					                        <a class="btn btn-primary btn-block  text-light" id="btn_up_foto_minifig" onclick="save_foto(6); "> <i class="fa fa-save"></i> Guardar Foto</a>
					                        <input type="hidden" name="serie_minifig" id="serie_minifig" value="<?php echo $clave_lego;?>" >
					                        <input type="hidden" name="tipo" value="6" >
					                        <input type="hidden" name="user_perfil" id="user_perfil" value="<?php echo $user_per;?>" >
					                        
				                    	</form>
				                    </div> 
				                   
				                    
				                    <div id="prev_image_minifig_admin" class="row form-group compacted" style=" display: block; border: 0px solid #ccc;  ">
					                   
				                    </div>
							</div>
					</div>					
					
				</div>
				
			</div>
	   	
	</div>
		
