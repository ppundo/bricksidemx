<?php 
	
	$cve_serie = $_GET['item'];
	$user = $_GET['q'];
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
	


$panel_b = get_coleccion_user_nvo($cve_serie, $user);


	
?>


<div class="col-md-12" style="background: rgba(250,250,250,0.8); z-index: 999; max-height:550px; padding:0px;">
		                        			

	<h5 class="col-md-12 p-3 title_sec" >Coleccionistas</h5>
		

	<div class="row col-md-12" style="" > 
		
        <div class="col-md-2 " style="height: 80%; overflow: auto; overflow-x: hidden; padding:0px; " id="check_admin_conf">
			<div class="card-body" style="padding: 1px; ">
				<?php echo $panel_a; ?>
			</div>			
		</div>
		
		<div class="col-md-10 border-left" style=" padding:0px; height: 470px; z-index: 999; " id="check_admin_conf">
            <div class="" style="background:rgba(250,250,250,0.7); "  >				
			    <?php echo $panel_b; ?>
			</div>
		</div>
												
	</div>
		                        	
</div>