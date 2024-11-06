<?php 
	
$cve_serie = $_GET['item'];
$serie_img = $_GET['item'];
//$id_sugerencia= $_POST['id_sugerencia'];
//$respuesta = $_POST['respuesta_formato'];
	

$info_col = get_info_serie($cve_serie);

// $row['nombre'].'/'.$row['color'].'/'.$row['fecha_lanzamiento'].'/'.$row['estado'].'/'.$row['precio_premium'].'/'.$row['moneda_premium'].'/'.$row['descuento'].'/'.$row['aux'].'/'.$row['premium'];tipo


$data_col = explode('/',$info_col);


		$nombre_col = $data_col[0]; 
		$color_col  = $data_col[1];
		$f_lan = $data_col[2];
		$estado_col = $data_col[3];
		$precio = $data_col[4];
		$moneda = $data_col[5];
		$descuento = $data_col[6];
		$premium = $data_col[8];
		$tipo = $data_col[9];
		$f_reg = $data_col[10];
		$f_act = $data_col[11];

$foto_portada = valida_foto_tipo($cve_serie ,3);
$foto_folleto= valida_foto_tipo($cve_serie ,4);
$foto_caja = valida_foto_tipo($cve_serie ,5);
$foto_empaque = valida_foto_tipo($cve_serie ,6);
$foto_fondo = valida_foto_tipo($cve_serie ,7);	


	
?>

<input id="imagenes_serie" type="hidden" value="<?php echo $_GET['item']; ?>">

<div class="col-md-12 bg-light" style="padding:0px; z-index: 999; ">
		                        			

<h5 class="col-md-12 p-2 title_sec" style="padding: 0px;" >Artes de la Colección </h5>

	<div class="mnu_bar center" style=" padding:0px; padding-top:1rem;">
            <div class="btn-group-bar" role="group" style=" border:none;"> 
				<button type="button" id="imagesmnu_1" onclick="barmenu(this.id)" class="btn btn-primary btn_menubar imagesmnu">Portada </button>
				<button type="button" id="imagesmnu_2" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar imagesmnu">Folleto </button>
				<button type="button" id="imagesmnu_3" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar imagesmnu">Caja </button>
				<button type="button" id="imagesmnu_4" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar imagesmnu">Empaque </button>
				<button type="button" id="imagesmnu_5" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar imagesmnu">Fondo </button>
            </div>
    </div>

	<!-- Div Portada -->
<div id="div_imagesmnu_1" class="col-md-12 " name="portada" style="padding: 0px; height:415px;"  >
	<div class="row" style="height: 420px;">
		<div class="col-md-3 border-right">
				
				<div id="display_1" title="Portada" style="display: block;" class="hold_image_serie">
					<img id="prev_image_portada" class="picture_muestra" style=" max-width: 80%;  " src="<?php echo $foto_portada; ?>" id="img_1">
				</div>

					<!-- Form Portada -->
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
		</div>
		
		<div class="col-md-9 center">

			<div class="col-md-8  hold_image_serie" id="display_min_1">
				<img id="prev_image_portada" class="picture_muestra" style=" max-width: 100%; " src="<?php echo $foto_portada; ?>" >
			</div>

		</div>
	</div>
</div>
	<!--- Fin div portada -->

	<!-- Div Folleto -->
<div class="col-md-12 no-show" name="portada" style="padding: 0px; height:415px;" id="div_imagesmnu_2" >
	<div class="row" style="height: 420px;">
		<div class="col-md-3 border-right">
				
		<!-- cambia -->
						<div id="display_2" title="Folleto" style="" class="hold_image_serie" >
							<img id="prev_image_folleto" class="picture_muestra zoom" style=" max-width: 50%; " src="<?php echo $foto_folleto; ?>" id="img_2">
						</div>
		<!-- -->

					<!-- Form Folleto -->
					 <!-- cambia -->
					<div class="" style="padding:5px;" id="file_2" >

					<form name="form_up_folleto" method="post" action="?" id="form_up_folleto" enctype="multipart/form-data">  
						<input type="file" name="foto_folleto" class="form-control " id="foto_folleto" placeholder="Imagen">
							<a class="btn btn-primary btn-block  text-light" id="btn_up_foto_folleto" onclick="save_foto(9); "> 
								<i class="fa fa-save"></i> Subir Folleto
								
							</a>
						<input type="hidden" name="serie_folleto" value="<?php echo $serie_img ?>" >
						<input type="hidden" name="tipo" value="9" >
					</form>					

					</div>
					<!-- cambia -->
		</div>
		
		<div class="col-md-9 center">

			<!-- cambia -->
			<div class="col-md-8 border hold_image_serie" id="display_min_2" >
				<img id="prev_image_folleto" class="picture_muestra" style=" max-width: 90%; " src="<?php echo $foto_folleto; ?>" >
			</div>
			<!-- cambia -->

		</div>
	</div>
</div>
	<!--- Fin div folleto-->

<!-- Div Caja -->
<div class="col-md-12 no-show" name="portada" style="padding: 0px; height:415px;" id="div_imagesmnu_3" >
	<div class="row" style="height: 420px;">
		<div class="col-md-3 border-right">
				
		<!-- cambia -->
			<div id="display_3" title="Caja" style="" class="hold_image_serie">						
				<img id="prev_image_caja" class="picture_muestra zoom" style=" max-width: 60%;  " src="<?php echo $foto_caja; ?>" id="img_3">
			</div>

		<!-- -->

					<!-- Form  -->
					 <!-- cambia -->
					 <div class="" style="padding:5px; " id="file_3" >

					<form name="form_up_caja" method="post" action="?" id="form_up_caja" enctype="multipart/form-data">  
						<input type="file" name="foto_caja" class="form-control " id="foto_caja" placeholder="Imagen">
							<a class="btn btn-primary btn-block  text-light" id="btn_up_foto_caja" onclick="save_foto(10); "> 
								<i class="fa fa-save"></i> Subir Caja
								
							</a>
						<input type="hidden" name="serie_caja" value="<?php echo $serie_img ?>" >
						<input type="hidden" name="tipo" value="10" >
					</form>					

					</div>	
					<!-- cambia -->
		</div>
		
		<div class="col-md-9 center">

			<!-- cambia -->
			<div class="col-md-12 border hold_image_serie " id="display_min_3" >
				<img id="prev_image_folleto" class="picture_muestra" style=" max-width: 90%; " src="<?php echo $foto_caja; ?>" >
			</div>	
			<!-- cambia -->

		</div>
	</div>
</div>
	<!--- Fin div caja-->

	<!-- Div Empaque -->
<div class="col-md-12 no-show" name="portada" style="padding: 0px; height:415px;" id="div_imagesmnu_4" >
	<div class="row" style="height:420px;">
		<div class="col-md-3 border-right">
				
		<!-- cambia -->
		<div id="display_4" title="Empaque" style="" class="hold_image_serie">						
			<img id="prev_image_empaque" class="picture_muestra zoom" style=" max-width: 60%;  " src="<?php echo $foto_empaque; ?>" id="img_4">
		</div>

		<!-- -->

					<!-- Form  -->
					 <!-- cambia -->
					 <div class="" style="padding:5px; " id="file_4" >

					<form name="form_up_empaque" method="post" action="?" id="form_up_empaque" enctype="multipart/form-data">  
						<input type="file" name="foto_empaque" class="form-control " id="foto_empaque" placeholder="Imagen">
							<a class="btn btn-primary btn-block  text-light" id="btn_up_foto_empaque" onclick="save_foto(11); "> 
								<i class="fa fa-save"></i> Subir Empaque
								
							</a>
						<input type="hidden" name="serie_empaque" value="<?php echo $serie_img ?>" >
						<input type="hidden" name="tipo" value="11" >
					</form>					

					</div>
					<!-- cambia -->
		</div>
		
		<div class="col-md-9 center">

			<!-- cambia -->
			<div class="col-md-12 hold_image_serie" id="display_min_4" >
				<img id="prev_image_folleto" class="picture_muestra" style=" max-width: 90%; " src="<?php echo $foto_empaque; ?>" >
			</div>
			<!-- cambia -->

		</div>
	</div>
</div>
	<!--- Fin div empaque-->

		<!-- Div Fondo -->
<div class="col-md-12 no-show" name="portada" style="padding: 0px; height:415px;" id="div_imagesmnu_5" >
	<div class="row" style="height:420px;">
		<div class="col-md-3 border-right">
				
		<!-- cambia -->
		<div id="display_5" title="Fondo"  class="hold_image_serie">						
			<img id="prev_image_fondo" class="picture_muestra zoom" style=" max-width: 70%;  " src="<?php echo $foto_fondo; ?>" id="img_5">
		</div>

		<!-- -->

					<!-- Form  -->
					 <!-- cambia -->
					 <div class="" style="padding:5px;  overflow: scroll; overflow-x: hidden;  " id="file_5" >

					<form name="form_up_fondo" method="post" action="?" id="form_up_fondo" enctype="multipart/form-data">  
						<input type="file" name="foto_fondo" class="form-control " id="foto_fondo" placeholder="Imagen">
							<a class="btn btn-primary btn-block  text-light" id="btn_up_foto_fondo" onclick="save_foto(12); "> 
								<i class="fa fa-save"></i> Subir Fondo
								
							</a>
						<input type="hidden" name="serie_fondo" value="<?php echo $serie_img ?>" >
						<input type="hidden" name="tipo" value="12" >
					</form>					

					</div>	
					<!-- cambia -->
		</div>
		
		<div class="col-md-9 center">

			<!-- cambia -->
			<div class="col-md-12 border hold_image_serie " id="display_min_5">
				<img id="prev_image_folleto" class="picture_muestra" style=" max-width: 90%; " src="<?php echo $foto_fondo; ?>" >
			</div>	
			<!-- cambia -->

		</div>
	</div>
</div>
	<!--- Fin div fondo-->



	
	
