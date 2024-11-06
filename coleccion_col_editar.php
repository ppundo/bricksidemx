<?php 
	
	$cve_serie = $_GET['item'];
//$id_sugerencia= $_POST['id_sugerencia'];
//$respuesta = $_POST['respuesta_formato'];
	

$info_col = get_info_serie($cve_serie);

// $row['nombre'].'/'.$row['color'].'/'.$row['fecha_lanzamiento'].'/'.$row['estado'].'/'.$row['precio_premium'].'/'.$row['moneda_premium'].'/'.$row['descuento'].'/'.$row['aux'].'/'.$row['premium'];tipo


$data_col = explode('/',$info_col);

//var_dump($data_col);

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
		$id_serie = $data_col[12];
		$color_text = $data_col[13];
      	$colorb_col  = $data_col[14];
        //$colorb_col  = '0,0,0';
		
		//var_dump($premium);
	
	                        $ops_tipo_serie = genera_ops_tipo_serie($tipo);
	                        
	                        $ops_estado_serie = genera_ops_estado_serie($estado_col);
	                        
	                        $ico_tipo_serie = get_ico_tipo_serie($tipo);
							

	
							if($premium==1){
								$css_campos_prem = '';
								$css_label_prem = 'no-show';
							}else{
								$css_campos_prem = 'no-show';
								$css_label_prem = '';
							} 
							
							


							if($color_text==''){
								//$color_txt = '255,255,255'; 
								$color_txt = fromRGB('255', '255', '255');
							}else{

							$data_coltxt = explode(',',$color_text); 
	                        
	                        $r = $data_coltxt[0];
	                        $g = $data_coltxt[1];
	                        $b = $data_coltxt[2];
	                        
	                        //$color_t = 


								$color_txt = fromRGB($r, $g, $b); 
							}

							/// Campos premium 
							
								$moneda_serie = genera_select_moneda($id_serie, $moneda,$id_serie);
								
								$field_premium = '
									<span class="col-sm-12 form-control form-control-lg text-muted '.$css_label_prem.'"> Esta serie no es Premium. </span><br>
									
									<span class="'.$css_campos_prem.'">
										$ <input class="col-md-6 form-control" id="s_precio_'.$id_serie.'" onblur="quick_edit(\'1-'.$id_serie.'\')" type="text" value="'.$precio.'" > 
										'.$moneda_serie.'
									</span>
									
									
								'; 	   
								
                   
	                       
	                       $select_descuentos = genera_select_descuento($id_serie, $descuento,$id_serie);
	                       
	                       $select_dto = '	
	                       <span class="col-sm-6 form-control form-control-lg text-muted '.$css_label_prem.'"> Esta serie no es Premium. </span>  
	                       
	                       <span class="'.$css_campos_prem.'">
	                       '.$select_descuentos.'  
	                       </span>
	                       ';

$campos = '
	<div class=" row" style="padding-right:12px;">
									<div class="col-md-4 border-right " style="padding: 0px " >
		                        		<label class="col-md-12 p-2  subtitle_sec" >Generales</label>
		                        		
		                        		<div class="row col-md-12 form-group">
		                        			<label class="col-sm-4 col-form-label" >Tipo</label>		                        		
											<select class="col-sm-8 form-control form-control" id="s_tipo_'.$id_serie.'" onchange="quick_edit(\'1-'.$id_serie.'\')" >
		                        			'.$ops_tipo_serie .'
		                        			</select>
		                        			
		                        			<input id="s_serie_'.$id_serie.'" type="hidden" value="'.$cve_serie.'" > 
										</div>

		                        		<div class="row col-md-12 form-group">
		                        			<label class="col-sm-4 col-form-label" >Estado</label>
		                        		
											<select class="col-md-8 form-control form-control" id="s_estado_'.$id_serie.'" onchange="cambia_estado(\''.$id_serie.'\');" >
		                        			'.$ops_estado_serie.'
		                        			</select>
		                        			
		                        			<input id="s_serie_'.$id_serie.'" type="hidden" value="'.$cve_serie.'" > 
										</div>
										
										
										<div class="row col-md-12 form-group">	                        		
		                        			<label class="col-sm-4 col-form-label" >Relese</label>
		                        			<input class="col-md-8 form-control form-control-lg" id="s_flanzamiento_'.$id_serie.'" type="date" value="'.$f_lan.'" onblur="quick_edit(\'1-'.$id_serie.'\')" > 
		                        		</div>
		                        		
		                        		<div class="row col-md-12 form-group">
		                        			<label class="col-sm-4 col-form-label" >Nombre </label>
		                        			<input class="col-md-8 form-control form-control-lg" id="s_nombre_'.$id_serie.'" type="text" value="'.$nombre_col.'" onblur="quick_edit(\'1-'.$id_serie.'\')" >
										</div>
										

		                        	    <label class="col-md-12 p-2  subtitle_sec" >Especiales</label>                        	
		                        		

										<div class="col-md-12 form-group">	                        		
		                        			<label class=" col-form-label" >Donativo</label>
		                        			'.$field_premium.' 
		                        		</div>

										<div class="row col-md-12 form-group">	                        		
		                        			<label class="col-md-6 col-form-label" >Descuento</label><br>
		                        			'.$select_dto.'
		                        		</div>




		                        	</div>
		                        	

									<div class="col-md-8 border-right" style="padding:0px; ">
		                        		<label class="col-md-12 p-2  subtitle_sec" >Apariencia</label>
		                        		
                                        
    <div class="col-sm-12" >
        <label class="col-form-label">Color de Fondo:</label>
        
        <div style="padding: 10px; text-align: center; border-radius: 5px; width: 100%; margin:10px 10px 10px 0; background: linear-gradient(90deg, rgba('.$color_col.',1) 35%, rgba('.$colorb_col.',1) 100%);" >
            <span style="letter-spacing: 10px; color: rgba('.$color_text.',0.8);"> ABCDEFGHIJKLMNOPQRSTUVWXYZ</span>
        </div>
        
    </div>

                                    <div class="row">
		                        		
                                        <div class="col-sm-6 form-group" style="padding: 3px 25px;">	
											
                                            <div class="row">
                                            
                                            <input class="border" style="border-radius:3px; margin-left:10px; padding:5px; height:40px; width:40px; " id="s_color_'.$id_serie.'" type="color" value="'.$color.'" onchange="quick_edit(\'1-'.$id_serie.'\')" >

												<div class="col-sm-6">
													<span style="font-size: 0.7em;" class="text-muted"> RGB ('.$color_col.') </span><br>												
													<span style="font-size: 0.7em;" class="text-muted"> HEX '.$color.' </span>
												</div>

											</div>
										</div>
										
										<div class="col-sm-6 form-group" style="padding: 3px 25px;">

											<div class="row">
                                                <input class="border" style="border-radius:3px; margin-left:10px; padding:5px; height:40px; width:40px; " id="s_colorb_'.$id_serie.'" type="color" value="'.$colorb.'" onchange="quick_edit(\'1-'.$id_serie.'\')" > 											
											
											
												<div class="col-sm-6">
													<span style="font-size: 0.7em;" class="text-muted"> RGB ('.$colorb_col.') </span><br>
													<span style="font-size: 0.7em;" class="text-muted"> HEX '.$colorb.' </span>
												</div>
											</div>										
										
										</div>
										
										</div>


										<div class="col-sm-12 form-group border-top">
		                        			<label class="col-form-label">Color Texto:</label>	<br>	                        		
											
                                            <div class="row">
                                            
                                                <input class="border" style="border-radius:3px; margin-left:10px; padding:5px; height:40px; width:40px; " id="s_color_txt_'.$id_serie.'" type="color" 
											value="'.$color_txt.'" onchange="quick_edit(\'1-'.$id_serie.'\')" >

												<div class="col-sm-6">
													<span style="font-size: 0.7em;" class="text-muted"> RGB ('.$color_text.') </span><br>												
													<span style="font-size: 0.7em;" class="text-muted"> HEX '.$color_txt.' </span>
												</div>
											</div>										
										
										</div>										

										
																			
		                        	</div>
		                        	
	
		                        	<div class="col-md-4 border-right no-show" style="padding:0px; ">
		                        	    <label class="col-md-12 p-2  subtitle_sec" >Especiales</label>                        	
		                        		

										<div class="col-md-12 form-group">	                        		
		                        			<label class=" col-form-label" >Donativo</label>
		                        			'.$field_premium.' 
		                        		</div>

										<div class="row col-md-12 form-group">	                        		
		                        			<label class="col-md-6 col-form-label" >Descuento</label><br>
		                        			'.$select_dto.'
		                        		</div>	
																			
		                        	</div>             	
	                        	</div>
	                        	
	</div>                        	
'; 


	
?>


<div class="col-md-12" style="border:0px solid #c30; padding:0px 1px 3px 1px; max-height:550px; height: 540px; overflow: scroll; overflow-x:hidden; overflow-y: auto;">
		                        			
		<h4 class="col-md-12 p-3 title_sec"  >Configuración General de Colección </h4>
	
	<div class="card-body" style="margin-right: 0px; padding: 0px 0px; ">
		<div class="col-md-12 " style="height: 100%; overflow: auto; overflow-x: hidden; " id="check_admin_conf">
			
			<?php echo $campos; ?>
			
		</div>
	</div>
											

	
		                        	
</div>