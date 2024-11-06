<?php 

if($user==0 or $user==""){
			
	echo '<meta http-equiv = "refresh" content = "0; url = http://shelf.bricksidemx.com/collector/index.php?access=1" />';
			
}else{
		
	if($user_perfil==0 or $user_perfil==""){
			
	}

$serie_img = $_GET['obj'];

//$path_portada ='assets/images/portada_serie/'; 
$path_folleto = 'assets/images/sheet/';
$path_caja = 'assets/images/caja/';
$path_empaque = 'assets/images/empaque/';
$path_fondo = 'assets/images/backgrounds/';

// Verifica Imagenes 

$foto_portada = valida_foto_tipo($serie_img,3);
$foto_folleto= valida_foto_tipo($serie_img,4);
$foto_caja = valida_foto_tipo($serie_img,5);
$foto_empaque = valida_foto_tipo($serie_img,6);
$foto_fondo = valida_foto_tipo($serie_img,7);
	                    

?>

<input id="imagenes_serie" type="hidden" value="<?php echo $_GET['obj']; ?>">


<div class="scrollable">
	
	<?php 
		
		//var_dump($foto_portada);
		
		?>

<!-- ---------------NUEVO MENU------------------ -->
<div class="col-sm-3 grid-margin stretch-card" >

		<div class="col-md-12 semi-transparent" id="lateral" style="overflow-y: auto; overflow-x: hidden; height: 500px; ">
			
			<div class="p-3  border-bottom ">
			    <h4 class="card-title">
			        <span class="card-title-fig mb-0" style="float: left;" id="title_nombre">Imagenes </span> 
	                
	            </h4>
	        </div>
	        
	        <div class="card-body" style="padding: 15px 3px 15px 3px; ">
		        
				<div class="blockquote rounded" style="padding: 0px;  margin-bottom: 5px; ">
					
					<div class="bg-secondary" onclick="toggle_images(1)" style="padding: 5px 0 5px 10px; margin-bottom:0px; " >
									
						<h6 style="margin-bottom: 0;" id="mnu_1" title="Portada">
							<span style="margin-right: 3px; "><i class="fa fa-image"></i></span> Portada
									
							<a  class="btn btn-outline-secondary" onclick="toggle_images(1)" style="float:right; margin-top:-5px; ">
								<i class="fa fa-eye"></i>
							</a>

						</h6> 
						
					</div>
								
						<div class="col-md-12 border hold_image_serie" id="display_min_1" >
							<img id="prev_image_folleto" class="picture_muestra" style=" max-width: 90%; " src="<?php echo $foto_portada; ?>" >
						</div>
				
				</div>	
				
				<!---- Folleto --->
				<div class="blockquote rounded" style="padding: 0px;  margin-bottom: 5px; ">
					
					<div class="bg-secondary" onclick="toggle_images(2)" style="padding: 5px 0 5px 10px; margin-bottom:0px; " >
									
						<h6 style="margin-bottom: 0;" id="mnu_2" title="Folleto" >
							<span style="margin-right: 3px; "><i class="fa fa-image"></i></span> Folleto
									
							<a  class="btn btn-outline-secondary " onclick="toggle_images(2)" style="float:right; margin-top:-5px; ">
								<i class="fa fa-eye"></i>
							</a>

						</h6> 
					</div>
					
						<div class="col-md-12 border hold_image_serie" id="display_min_2" >
							<img id="prev_image_folleto" class="picture_muestra" style=" max-width: 90%; " src="<?php echo $foto_folleto; ?>" >
						</div>					
					
				</div>					

				<!---- Caja --->
				<div class="blockquote rounded" style="padding: 0px;  margin-bottom: 5px; ">
					
					<div class="bg-secondary" onclick="toggle_images(3)" style="padding: 5px 0 5px 10px; margin-bottom:0px; " >
									
						<h6 style="margin-bottom: 0;" id="mnu_3" title="Caja">
							<span style="margin-right: 3px; "><i class="fa fa-image"></i></span> Caja
									
							<a  class="btn btn-outline-secondary " onclick="toggle_images(3)" style="float:right; margin-top:-5px; ">
								<i class="fa fa-eye"></i>
							</a>

						</h6> 
					</div>
					
						<div class="col-md-12 border hold_image_serie" id="display_min_3" >
							<img id="prev_image_folleto" class="picture_muestra" style=" max-width: 90%; " src="<?php echo $foto_caja; ?>" >
						</div>					
				</div>
						
				<!---- Folleto --->
				<div class="blockquote rounded" style="padding: 0px;  margin-bottom: 5px; ">
					
					<div class="bg-secondary" onclick="toggle_images(4)" style="padding: 5px 0 5px 10px; margin-bottom:0px; " >
									
						<h6 style="margin-bottom: 0;" id="mnu_4" title="Empaque" >
							<span style="margin-right: 3px; "><i class="fa fa-image"></i></span> Empaque
									
							<a  class="btn btn-outline-secondary " onclick="toggle_images(4)" style="float:right; margin-top:-5px; ">
								<i class="fa fa-eye"></i>
							</a>

						</h6> 
					</div>
					
						<div class="col-md-12 border hold_image_serie" id="display_min_4" >
							<img id="prev_image_folleto" class="picture_muestra" style=" max-width: 90%; " src="<?php echo $foto_empaque; ?>" >
						</div>
				</div>	
				
				<!---- Fondo --->
				<div class="blockquote rounded" style="padding: 0px;  margin-bottom: 5px; ">
					
					<div class="bg-secondary " onclick="toggle_images(5)" style="padding: 5px 0 5px 10px; margin-bottom:0px; " >
									
						<h6 style="margin-bottom: 0;" id="mnu_5" title="Fondo">
							<span style="margin-right: 3px; "><i class="fa fa-image"></i></span> Fondo
									
							<a  class="btn btn-outline-secondary " onclick="toggle_images(5)" style="float:right; margin-top:-5px; ">
								<i class="fa fa-eye"></i>
							</a>

						</h6> 
					</div>
					
						<div class="col-md-12 border hold_image_serie" id="display_min_5">
							<img id="prev_image_folleto" class="picture_muestra" style=" max-width: 90%; " src="<?php echo $foto_fondo; ?>" >
						</div>					
				</div>	
							
										
		        
	        </div>
	        
		</div>
		
</div>



<div class="col-sm-6 grid-margin stretch-card" style="height: 500px; " >

		<div class="col-md-12 semi-transparent" id="" style="overflow-y: auto; overflow-x: hidden; ">
			
			<div class="p-3  border-bottom ">
			    <h4 class="card-title">
			        <span class="card-title-fig mb-0" style="float: left;" id="title_nombre_image">Imagen</span> 
	                
	            </h4>
	        </div>
	        
	        <div class="card-body" style="padding: 15px 3px 15px 3px; ">
		        
		        <div class="row col-md-12 border" style="padding:5px; margin-left: 0px; margin-bottom: 10px;  text-align: center;  " >
				</div>
		        
				<div class="blockquote rounded" style="padding: 0px;  margin-bottom: 5px; ">
					<div class="bg-secondary no-show " style="padding: 5px 0 5px 10px; margin-bottom:0px; " >
									
						<h6 style="margin-bottom: 0;">
							<span style="margin-right: 3px; "><i class="fa fa-image"></i></span> Actual
									
							<a  class="btn btn-outline-secondary " onclick="toggle('show_image')" style="float:right; margin-top:-5px; ">
								<i class="fa fa-angle-down"></i>
							</a>

						</h6> 
					</div>
							
					
							
					<div class="col-md-12" style="padding:5px; display:block; " id="show_image" >
					
						<div id="display_2" title="Folleto" style="display: none;" class="hold_image_serie" >
							<img id="prev_image_folleto" class="picture_muestra" style=" max-width: 50%; " src="<?php echo $foto_folleto; ?>" id="img_2">
						</div>
						
						<div id="display_1" title="Portada" style="display: block;" class="hold_image_serie">
							<img id="prev_image_portada" class="picture_muestra" style=" max-width: 80%;  " src="<?php echo $foto_portada; ?>" id="img_1">
						</div>
						
						<div id="display_3" title="Caja" style="display: none;" class="hold_image_serie">						
							<img id="prev_image_caja" class="picture_muestra" style=" max-width: 60%;  " src="<?php echo $foto_caja; ?>" id="img_3">
						</div>
						
						<div id="display_4" title="Empaque" style="display: none;" class="hold_image_serie">						
							<img id="prev_image_empaque" class="picture_muestra" style=" max-width: 60%;  " src="<?php echo $foto_empaque; ?>" id="img_4">
						</div>
						
						<div id="display_5" title="Fondo" style="display: none;" class="hold_image_serie">						
							<img id="prev_image_fondo" class="picture_muestra" style=" max-width: 70%;  " src="<?php echo $foto_fondo; ?>" id="img_5">
						</div>
					
					</div>
						
				</div>		
				
				<div class="row col-md-12 border no-show" style="padding:5px; margin-left: 0px;  text-align: center;  " >
						<div class="col-md-3 border hold_image_serie" >
							<img id="prev_image_folleto" class="picture_muestra" style=" max-width: 90%; " src="<?php echo $foto_portada; ?>" >
						</div>
						<div class="col-md-2 border hold_image_serie" >
							<img id="prev_image_folleto" class="picture_muestra" style=" max-width: 90%; " src="<?php echo $foto_folleto; ?>" >
						</div>
						
						<div class="col-md-2 border hold_image_serie" >
							<img id="prev_image_caja" class="picture_muestra" style=" max-width: 90%;  " src="<?php echo $foto_caja; ?>" >
						</div>
						
						<div class="col-md-2 border hold_image_serie" >
							<img id="prev_image_empaque" class="picture_muestra" style=" max-width: 90%;  " src="<?php echo $foto_empaque; ?>" >
						</div>
						
						<div class="col-md-2 border hold_image_serie" >
							<img id="prev_image_fondo" class="picture_muestra" style=" max-width: 90%;  " src="<?php echo $foto_fondo; ?>" >
						</div>
						
				</div>			
		        
	        </div>
	        
		</div>

</div>


<div class="col-sm-3 grid-margin stretch-card" style="" >

		<div class="col-md-12 semi-transparent" id="" style="overflow-y: auto; overflow-x: hidden; ">
			
			<div class="p-3  border-bottom ">
			    <h4 class="card-title">
			        <span class="card-title-fig mb-0" style="float: left;" id="title_nombre">
			        	<span class="text-mutted"><i class="fa fa-pencil"></i>Actualizar <span id="title_file">Imagen</span> </span>
						
			        </span> 
	                
	            </h4>
	        </div>
	        
	        <div class="card-body" style="padding: 15px 3px 15px 3px; ">
		        
				<div class="blockquote rounded" style="padding: 0px;  margin-bottom: 5px; ">
					<span id="images_serie_status"  style=" border-radius: 5px;" >  </span>
								
					<div class="" style="padding:5px; display:block; " id="file_1" >
					
				        <form name="form_up_portada" method="post" action="?" id="form_up_portada" enctype="multipart/form-data">  
					        <input type="file" name="foto_portada" class="form-control " id="foto_portada" placeholder="Imagen">
					            <a class="btn btn-primary btn-block  text-light" id="btn_up_foto_portada" onclick="save_foto(8); "> 
						            <i class="fa fa-save"></i> Subir Portada
						            
						        </a>
						    <input type="hidden" name="serie_portada" value="<?php echo $serie_img ?>" >   
					        <input type="hidden" name="tipo" value="8" >
				        </form>
						
					</div>
				
					<!-- ------------ Folleto ---------------- !-->
					<div class="" style="padding:5px; display:none; " id="file_2" >

				        <form name="form_up_folleto" method="post" action="?" id="form_up_folleto" enctype="multipart/form-data">  
					        <input type="file" name="foto_folleto" class="form-control " id="foto_folleto" placeholder="Imagen">
					            <a class="btn btn-primary btn-block  text-light" id="btn_up_foto_folleto" onclick="save_foto(9); "> 
						            <i class="fa fa-save"></i> Subir Folleto
						            
						        </a>
						    <input type="hidden" name="serie_folleto" value="<?php echo $serie_img ?>" >
					        <input type="hidden" name="tipo" value="9" >
				        </form>					
						
					</div>			
				
					<!-- ------------ Folleto ---------------- !-->
					<div class="" style="padding:5px; display:none; " id="file_3" >

				        <form name="form_up_caja" method="post" action="?" id="form_up_caja" enctype="multipart/form-data">  
					        <input type="file" name="foto_caja" class="form-control " id="foto_caja" placeholder="Imagen">
					            <a class="btn btn-primary btn-block  text-light" id="btn_up_foto_caja" onclick="save_foto(10); "> 
						            <i class="fa fa-save"></i> Subir Caja
						            
						        </a>
						    <input type="hidden" name="serie_caja" value="<?php echo $serie_img ?>" >
					        <input type="hidden" name="tipo" value="10" >
				        </form>					
						
					</div>	

					<!-- ------------ Folleto ---------------- !-->
					<div class="" style="padding:5px; display:none; " id="file_4" >

				        <form name="form_up_empaque" method="post" action="?" id="form_up_empaque" enctype="multipart/form-data">  
					        <input type="file" name="foto_empaque" class="form-control " id="foto_empaque" placeholder="Imagen">
					            <a class="btn btn-primary btn-block  text-light" id="btn_up_foto_empaque" onclick="save_foto(11); "> 
						            <i class="fa fa-save"></i> Subir Empaque
						            
						        </a>
						    <input type="hidden" name="serie_empaque" value="<?php echo $serie_img ?>" >
					        <input type="hidden" name="tipo" value="11" >
				        </form>					
						
					</div>	
					
					
					<!-- ------------ Folleto ---------------- !-->
					<div class="" style="padding:5px; display:none; overflow: scroll; overflow-x: hidden;  " id="file_5" >

				        <form name="form_up_fondo" method="post" action="?" id="form_up_fondo" enctype="multipart/form-data">  
					        <input type="file" name="foto_fondo" class="form-control " id="foto_fondo" placeholder="Imagen">
					            <a class="btn btn-primary btn-block  text-light" id="btn_up_foto_fondo" onclick="save_foto(12); "> 
						            <i class="fa fa-save"></i> Subir Fondo
						            
						        </a>
					        <input type="hidden" name="serie_fondo" value="<?php echo $serie_img ?>" >
					        <input type="hidden" name="tipo" value="12" >
				        </form>					
						
					</div>	
					

				
												
								
				</div>				
		        
	        </div>
	        
		</div>

</div>


		
</div>

<?php 
	
	}
?>