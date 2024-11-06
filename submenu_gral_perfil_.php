<?php 

?>

<div class="col-md-12 " style="border:0px solid #c30; padding:0px 1px 3px 1px; margin-left:5px; ">
		                        			
	<h4 class="col-md-12  p-3 title_sec">Información de Perfil</h4>
	
						
									
									
									<div class="border-bottom" style="padding:0px;">
                                    
                                    <div class="row card-body" style="padding:0px;"> 

		                        	<div class="col-md-4" style="border:0px solid #c30; padding: 0px 0px 1px 0px;">										
										<label class="col-md-12 p-2 subtitle_sec" >Información Personals</label>
									
										<div style="padding: 0px 10px; "> 
											<div class="" style="padding: 0px 5px; " >	                        		
			                        			<label class="col-md-3 col-form-label text-muted lbl_form_sm" >Fecha Nac.:</label>
			                        			<span class="col-md-8 text-muted lbl_form_sm" > <?php echo formatFecha($fnac); ?></span> 
	
											</div>
											
											<div class="">
			                        			<label class="col-md-3 col-form-label text-muted lbl_form_sm" >Dirección:</label>
			                        			<span class="col-md-8 text-muted" >
			                        			<button type="button" class="btn btn-sm <?php echo $btn_style.' '.$estado_btn_dir;?>"  onclick="toggle('dir')" > Ver Dirección</button>
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
	
	
	
		                        	<div class="col-md-4 border-left" style=" padding: 0px 0px 1px 0px; border:0px solid #c30;">
									<label class="col-md-12 p-2 subtitle_sec" >Configuración</label>
									
										<div style="padding: 0px 5px; ">                        		
			                        		
			                        		<div class="" >
			                        			<label class="col-md-3 col-form-label text-muted lbl_form_sm" >Perfil </label>
			                        		
												<select class="col-md-8 form-control" id="user_perfil_<?php echo $id_user;?>">
													<?php echo $perfiles; ?>
												</select>
												
			                        			
											</div>
											
											<div class="">	                        		
			                        			<label class="col-md-3 col-form-label text-muted lbl_form_sm" >Correo:</label>
			                        			<input class="col-md-8 form-control" <?php echo $att_per; ?> id="user_correo_<?php echo $id_user;?>" type="text" value="<?php echo $correo; ?>"  >
	
											</div>
	
											<div class="">	                        		
			                        			<label class="col-md-3 col-form-label text-muted lbl_form_sm" >Usuario:</label>
			                        			<input class="col-md-8 form-control" id="user_username_<?php echo $id_user;?>" type="text" value="<?php echo $userb; ?>" >
	
											</div>		                        		
	
											<div class="" >	                        		
			                        			<label class="col-md-3 col-form-label text-muted lbl_form_sm" >Estado:</label>
												<span class="col-md-8 text-muted"><?php echo $edo; ?> </span>
											</div>	
	
											<div class="" >	                        		
			                        			<label class="col-md-3 col-form-label text-muted lbl_form_sm" >Activado:</label>
												<span class="col-md-8 text-muted lbl_form_sm"> <?php echo formatFechaHora($fecha_act);?></span>
											</div>
											</div>									
		                        	</div>


		                        	<div class="col-md-4 border-left" style="padding: 0px 0px 1px 0px; border:0px solid #c30;">		                        		
		                        		<label class="col-md-12 p-2 subtitle_sec " >Información de Acceso</label>
		                        		
		                        		<div class="row col-md-12">
		                        			<label class="col-md-3 text-muted col-form-label lbl_form_sm" style="font-size: 0.8em;">Contraseña: </label> 
		                        			<span class="col-sm-8 col-form-label text-primary lbl_form_sm"><?php echo $edo_pass; ?></span>
												
										</div>
																			
										
										<div class="">	                        		
		                        			<label class="col-md-3 col-form-label text-muted lbl_form_sm" >Actividad:</label>
		                        			<button type="button" onclick="javascript:ventanaSecundaria('<?php echo $url?>')" class="btn btn-secondary text-primary"> Ver detalles</button>
										</div>											

										<div class="form-group">	                        		
		                        			<label class="col-md-12 col-form-label text-muted lbl_form_sm" >Ultima sesión: </label>
		                        			<span class="col-md-12 text-sm text-primary lbl_form_sm"><?php echo $tiempo ?><span> 
										</div>			                        		
										</div>								
		                        	</div>
</div>