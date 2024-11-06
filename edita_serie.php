 
<?php

//Verifica si hay una sesion para mostrar la pagina
include("check_access.php");


  $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
if ($dbh->connect_error) {
    die("Connection failed: " . $dbh->connect_error);
}


if($perfil_user == ""){
	$user_per=0;
	$class_sesion = 'no-show';
}else{
	$user_per = $GLOBALS['user_perfil'];
	$class_sesion = '';
}

//echo $user;
//<i class="fas fa-tag"></i>
if($user_per==1){
	$admin_tools = '';
	$class_admin = ""; 
	$edicion = 'enabled';
}else{
	
	$class_admin = "no-show"; 
	$edicion = 'disabled';
	
}

$clave_lego = $_GET['obj']; 

$total_serie = get_total_minifig($clave_lego);
$referencia = $clave_lego;
$ids = get_ids_current($referencia);
	?>



<input type="hidden" name="user" id="user" alt="Usuario" value="<?php echo $user; ?>" > 
<input type="hidden" name="tuser" id="total_serie" alt="Total  Coleccionados" value="<?php echo $total_collect; ?>" >
<input type="hidden" name="tserie" id="tserie" value="<?php echo $total_serie; ?>" >
<input type="hidden" name="user" id="serie_act"  value="<?php echo trim($referencia);  ?>" >
<input type="hidden" name="user" id="ids_current"  value="<?php echo $ids;  ?>" >


<div class="scrollable" >
<div id="item_cards" class="row grid-margin" >
	
<?php
	$clave_lego = $_GET['obj']; 
	//$imagen_effect= 0;  // 0 sin efecto ; 1 con efecto
	$view = 2; 
	echo get_cards_minifigures($clave_lego, $view);
	//echo $grid_body;
	
//	echo "<script type=\"text/javascript\" > drag_drop(); </script>";
	?>
	</div>
</div>
                
                

<!-- ////////////////////////// Nueva Minifigura //////////////////////////// -->

<div id="nueva_minifigura" class="hold_set_edita" style="display:none; " >
	
	
	<div class="main-panel set_panel " style="min-height: auto;  margin-top: 20px; margin-bottom: 10px; width: 70%; float: right; z-index: 99999;   ">
		<div class="set_pestana_edita" style=" "> <span class="claro" onclick="toggle('nueva_minifigura'); "> <i class="fas fa-times"></i></span></div>
	   	<div class="content-wrapper" style="background: #fff; "  >
	   		<div class="col-lg-12">

		   			        <div class="p-3  border-bottom  " style="padding: 10px 0 0 5px;">
				                   <h4>
					                   <span class="card-title-set text-success " style="float: left;" id="title_minifigure">Agregar Minifigura</span>
					                   
				                   		<div class="btn-group " role="group" aria-label="" style="margin-left: 25px; " >
					                   		
											<a href="#" class="btn btn-outline-neutral" onclick="save_new_minifigura();" > 
									   			<i class="fas fa-save"></i> 
											</a>
		
		                      			</div>
                      								                   
					               </h4>
					               
							</div>
							
	                   		<div class="p-1 border-bottom grid-margin bg-light"  style="text-align: center; "> 
		                   		&nbsp;  <span id="new_minifigure_status"  style=" border-radius: 5px;" ></span>
	                   		</div>


				            
				            
				            
				<div class="row">
	   			<div class="col-md-6 grid-margin " >	
				    <form name="form_up_minifigure" method="post" action="?" id="form_up_minifigure" enctype="multipart/form-data">   			
								
								<div class="form-group row compacted">
				                    <label for="edita_index" class="col-sm-4 col-form-label">Clave Lego </label>
				                    <div class="col-sm-6">
				                        <input type="text" name="new_minifigure_cve" class="form-control" value="<?php echo $_GET['obj'];?>" id="new_minifigure_cve" placeholder="Clave">
				                    </div>
				                </div>
			
								<div class="form-group row compacted">
				                    <label for="edita_id" class="col-sm-4 col-form-label">Nombre en Español</label>
				                    <div class="col-sm-6">
				                        <input type="text" class="form-control" id="new_minifigure_nombrees" placeholder="Nombre Español">
				                    </div>
				                </div>

								<div class="form-group row compacted">
				                    <label for="edita_id" class="col-sm-4 col-form-label">Nombre en Inglés</label>
				                    <div class="col-sm-6">
				                        <input type="text" class="form-control" id="new_minifigure_nombreen" placeholder="Nombre Inglés">
				                    </div>
				                </div>			                        						  


					            
								<div class="form-group row compacted ">
					                <label for="edita_sku" class="col-sm-4 col-form-label">Imagen </label>
					                   	<div class="col-sm-6">
					                            <input type="text" disabled="" class="form-control" id="new_minifigure_foto" placeholder="jpg / png">
					                    </div>
					            </div>


			                          <div class="form-group compacted" >
			                            <label for="edita_tags" class=" col-form-label">Tags de Búsqueda <br><span class="text-neutral"> Ingresa palabras claves separadas por comas (,).</span> </label>
			                            
			                              <textarea class="form-control col-sm-12 border" rows="3" <?php echo $edicion ?> id="new_minifigure_tags" ></textarea>
			                            
			                          </div>					            				                    
				</div>
				
				
				<div class="col-md-4 grid-margin " >
					
			                    <div class="form-group row compacted grid-margin ">
			                        <label for="edita_imagen" class="col-sm-5 ">Subir Imagen</label>
			                    	
				                        <input type="file" name="foto_minifigure" class="form-control " id="foto_minifigure" placeholder="Imagen">
				                        <a class="btn btn-primary btn-block  text-light" id="btn_up_foto_minifigure" onclick="save_foto(5);"> <i class="fa fa-arrow-circle-up"></i> Subir Foto</a>
				                        <input type="hidden" name="user_id" value="<?php echo $user_id?>" >
				                        <input type="hidden" name="tipo" value="5" >
			                    	</form>
			                    </div> 
			                   
			                    
			                    <div id="prev_image_minifig" class="row form-group compacted" style=" display: block; border: 0px solid #ccc;  ">
				                   
			                    </div>
				</div>
				</div>
				
			</div>
	   	</div>
	</div>
		
</div>



<!-- ////////////////////////// Admin Fotos Minifigura //////////////////////////// -->

<div id="admin_fotos" class="hold_set_edita" style="display:none;  " >
	
	
	<div class="main-panel set_panel " style="min-height: auto;  margin-top: 10px; margin-bottom: 10px; width: 90%; float: right;  z-index: 9999;  ">
		<div class="set_pestana_edita" style=" "> <span class="claro" onclick="toggle('admin_fotos'); "> <i class="fas fa-times"></i></span></div>
	   	<div class="content-wrapper" style="background: #fff; "  >
	   		<div class="col-lg-12">

		   			        <div class="p-3  border-bottom  " style="padding: 10px 0 0 5px;">
				                   <h4>
					                   <span class="card-title-set text-success " style="float: left;" id="title_minifigure">Administrar Fotos Serie: <?php echo($serie);  ?></span>
					                   <input type="hidden" id="serie_fotos_admin" value="<?php echo $clave_lego; ?>">
				                   		<div class="btn-group " role="group" aria-label="" style="margin-left: 25px; " >
					                   		
											
		
		                      			</div>
                      								                   
					               </h4>
					               
							</div>
							
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
	</div>
		
</div>


<!-- /////////////////////////. Usuarios Encontrados -->

<div id="confirmacion_elimina" class="hold_set_edita" style="display:none; " >
	
	<div class="degrade_modal"></div>
	<div class="main-panel set_panel " style="min-height: auto;  margin-top: 20px; margin-bottom: 10px; width: 40%; float: right;    ">
		<div class="set_pestana_edita" style=" "> <span class="claro" onclick="toggle('confirmacion_elimina'); "> <i class="fas fa-times"></i></span></div>
	   	<div class="content-wrapper" style="background: #fff; "  >
	   		<div class="col-lg-8">

		   			        <div class="p-3  border-bottom  " style="padding: 10px 0 0 5px;">
				                   <h4>
					                   <span class="card-title-set text-success " style="float: left;" id="title_minifigure">Eliminar Minifigura</span>
					                   
				                   		<div class="btn-group " role="group" aria-label="" style="margin-left: 25px; " >
					                   		
										
		
		                      			</div>
                      								                   
					               </h4>
					               
							</div>
							
	                   		<div class="p-1 border-bottom grid-margin bg-light"  style="text-align: center; "> 
		                   		&nbsp;  <small id=""  style=" border-radius: 5px;" > ¿Confirma que desea eliminar esta figura?. Los siguientes usuarios han registrado la figura en sus colecciones.</small>
	                   		</div>


				            <div class="col-md-12 grid-margin">
					            
					            <div id="lista_usuarios">
					            </div>
					            
					            
				            </div> 
				            
				            
				            <div id="hold_btn_elimina" >
					           
				            </div>
				            
				            

				
			</div>
	   	</div>
	</div>
		
</div>
