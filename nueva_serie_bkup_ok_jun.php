

<!-- ##################################. From para editar agregar serie ##################################. -->
	<?php 
		
		$user_perfil = $GLOBALS['user_perfil'];
		
		if($user_perfil==0 or $user_perfil==""){
			echo '<meta http-equiv = "refresh" content = "0; url = '.$link_site.'" />';
		}else{
		
	///////
	
	$resume = $_GET['resume'];
	
	if (isset($resume)== TRUE or $resume != ''){
		
		$data_serie = get_info_serie($resume);
		$data_step2 = get_info_temp($resume,2);
		$data_step3 = get_info_temp($resume,3);
		$data_step4 = get_info_temp($resume,4);
		
			$data_step4b = substr($data_step4,0,-1);
		
		$data_s = explode('/', $data_serie);
		//$row['nombre'].'/'.$row['color'].'/'.$row['fecha_lanzamiento'].'/'.$row['estado'].'/'.$row['precio_premium'].'/'.$row['moneda_premium'].'/'.$row['descuento'];
		
		$nombre_res = $data_s[0];
		$color_res = $data_s[1];
		$fecha_lanza_res = $data_s[2];
		$estado_res = $data_s[3];
		$precio_res = $data_s[4];
		$moneda_res = $data_s[5];
		$descuento_res = $data_s[6];
		$aux = $data_s[7];
		$premium = $data_s[8];
		
		if($aux==''){
			$total_res = get_total_minifig($resume);
		}else{
			$total_res = $data_s[7];
		}
		
		
		if($premium==1){
			$chk_edo = 'checked';
			$disp_div_prem = 'block';
		}else{
			$chk_edo = '';
			$disp_div_prem = 'none';
		}
		
		
		$data_color = explode(',', $color_res);
		$r = $data_color[0];
		$g = $data_color[1];
		$b = $data_color[2];
		
		$color_resb = fromRGB($r,$g,$b);
		
		//$display_resume = 'none';
		
		//step 3 -- datos 
		
		$data_file = explode('//', $data_step3); 
		$cant = $data_file[0];
		$archivos = $data_file[1];
		
		if($cant == $aux){
			
			$data_arch = explode('|', $archivos);
			
			for($i=0; $i<= count($data_arch); $i++){
				
				$datab = explode('/', $data_arch[$i]);
				$car = $datab[0];
				$ser = $datab[1];
				$nom = $datab[2];
				
				$img .= '<div class="col-sm-3" style="text-align:center;">
							<img src="'.$data_arch[$i].'" class="" style="height:100px; margin:3px; border-radius:5px;  " >
							<span class="text-light" style="text-align:center; adding:0 20px; width:60%;  border-radius:3px; margin:0px auto; font-size:16px; position: absolute; bottom: 0px; left: 0px; right: 0px; background:rgba(70,70,70,0.7)">'.$nom.'</span>
						</div>'; 
			}
			
			$ms = '<h4 class="text-muted">Carpeta existente y con imágenes. <br> Continue con el paso 4.</h4>'.'<br> <div class="row">'.$img.'</div>';
			$disp_upload = 'none';  
		}else{
			$ms = 'La carpeta NO contiene imágenes. Seleccione y suba las imagenes.';
			$disp_upload = 'block'; 
		}


		$serie_temp = get_temporal_serie();
		
		if($serie_temp == 'X'){
			$display_resume = 'none'; 
		}else{
			$display_resume = 'block';
		}

		
	}elseif(isset($resume)== FALSE or $resume == ''){

		$nombre_res = '';
		$color_res = '#d3d3d3';
		$fecha_lanza_res = '';
		$estado_res = '';
		$precio_res = '5.00';
		$moneda_res = '';
		$descuento_res = '';
		$aux = '';
		$premium = '';
		
		if($aux==''){
			$total_res = get_total_minifig($resume);
		}else{
			$total_res = $data_s[7];
		}
		
		if($premium==1){
			$chk_edo = 'checked';
			$disp_div_prem = 'block'; 
		}else{
			$chk_edo = '';
			$disp_div_prem = 'none';
		}
		
		
		$serie_temp = get_temporal_serie();
		
		if($serie_temp == 'X'){
			$display_resume = 'none'; 
		}else{
			$display_resume = 'block';
		}
	
	}
	
	
	///////
	
	

	
	
	$ops_moneda = genera_ops_moneda($moneda_res);
	$ops_tipo_serie = genera_ops_tipo_serie(0);
	$ops_estado_ini_serie = genera_ops_estado_serie(0);
	
	$mnu = $_GET['mnu'];
	$cve = $_GET['cve'];
	$url = $link_site.'?'.'mnu='.$mnu.'&cve='.$cve;
	
	$step = $_GET['step'];
	
	if($step == 0 or $step == ''){
		$display_step1 = 'none';
		$display_step2 = 'none';
		$display_step3 = 'none';
		$display_step4 = 'none';
	}elseif($step == 1 ){
		$display_step1 = 'block';
		$display_step2 = 'none';
		$display_step3 = 'none';
		$display_step4 = 'none';
		
		$next_step = intval($step+1);
		
		$href_s1_ad = $url.'&step='.$next_step.'&resume='.$resume;
		
	}elseif($step == 2 ){
		$display_step1 = 'none';
		$display_step2 = 'block';
		$display_step3 = 'none';
		$display_step4 = 'none';

		$next_step = intval($step+1);
		$back_step = intval($step-1);
		
		$href_s2_ad = $url.'&step='.$next_step.'&resume='.$resume;
		$href_s2_at = $url.'&step='.$back_step.'&resume='.$resume;
		
	}elseif($step == 3){
		$display_step1 = 'none';
		$display_step2 = 'none';
		$display_step3 = 'block';
		$display_step4 = 'none';

		$next_step = intval($step+1);
		$back_step = intval($step-1);
		
		$href_s3_ad = $url.'&step='.$next_step.'&resume='.$resume;
		$href_s3_at = $url.'&step='.$back_step.'&resume='.$resume;
		
	}elseif($step == 4 ){
		$display_step1 = 'none';
		$display_step2 = 'none';
		$display_step3 = 'none';
		$display_step4 = 'block';


		$back_step = intval($step-1);
		
		$href_s4_at = $url.'&step='.$back_step.'&resume='.$resume;			
	}
		


    $resumeb= $_GET['resume'];

    if(isset($resumeb)){
       // $resume = '?resume='.$_GET['resume'];
    }else{
       // $resume = '';
    }

		?>



    <div class="row" style="margin-top:0px;">
        
        <div class="col-md-2 bg-light border-right" style="height: 510px; padding:0px;" >
        
            <h5 class="col-md-12 p-3 title_sec " style=""> 

                    <div class="dropdown toolbar-item">
                      <button class="col-md-12 btn btn-secondary dropdown-toggle text-muted" type="button" id="dropdownsorting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Elije una opcion...</button>
                      <div class="dropdown-menu" aria-labelledby="dropdownsorting" style="">
                        <?php echo $serie_temp; ?>
                      </div>
                    </div>

            </h5>

            <a href="<?php echo $url.'&step=1'.$resume; ?>" class="menu_lateral border-bottom text-muted" style="padding-left:0px; padding-right:0px; padding-top:0px; padding-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; margin-bottom:0px; border-bottom:1px solid #ccc; color:; " id="mnu_77">

				<div class="row col-md-12  bg-light " style="background:  border-left:3px solid rgba(0,0,0,1); font-size:0.8em; margin:0px 0px; margin-left:0px; padding:14px 0px 14px 10px; padding-right:0px; border-bottom:1px solid rgba(200,200,200,0.6); " title="Información de Perfil">
				    <span class="col-1 " style=" font-size:1.1em; "><i class="fa-solid fa-file-pen"></i></span> 
					<span class="col-9 " style="font-size:1.1em;"> General</span>
					<span class=" col-1 text-head" style="float:right; right:-15px; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
				</div> 
			</a>

            <a href="<?php echo $url.'&step=2'; ?>" class="menu_lateral border-bottom text-muted" style="padding-left:0px; padding-right:0px; padding-top:0px; padding-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; margin-bottom:0px; border-bottom:1px solid #ccc; color:; " id="mnu_77">

				<div class="row col-md-12  bg-light " style="background:  border-left:3px solid rgba(0,0,0,1); font-size:0.8em; margin:0px 0px; margin-left:0px; padding:14px 0px 14px 10px; padding-right:0px; border-bottom:1px solid rgba(200,200,200,0.6); " title="Información de Perfil">
				    <span class="col-1 " style=" font-size:1.1em; "><i class="fa-solid fa-child"></i></span> 
					<span class="col-9 " style="font-size:1.1em;"> Personajes</span>
					<span class=" col-1 text-head" style="float:right; right:-15px; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
				</div> 
			</a>

            <a href="<?php echo $url.'&step=3'; ?>" class="menu_lateral border-bottom text-muted" style="padding-left:0px; padding-right:0px; padding-top:0px; padding-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; margin-bottom:0px; border-bottom:1px solid #ccc; color:; " id="mnu_77">

				<div class="row col-md-12  bg-light " style="background:  border-left:3px solid rgba(0,0,0,1); font-size:0.8em; margin:0px 0px; margin-left:0px; padding:14px 0px 14px 10px; padding-right:0px; border-bottom:1px solid rgba(200,200,200,0.6); " title="Información de Perfil">
				    <span class="col-1 " style=" font-size:1.1em; "><i class="fa-regular fa-image"></i></span> 
					<span class="col-9 " style="font-size:1.1em;"> Fotos de Personaje</span>
					<span class=" col-1 text-head" style="float:right; right:-15px; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
				</div> 
			</a>

            <a href="<?php echo $url.'&step=4'; ?>" class="menu_lateral border-bottom text-muted" style="padding-left:0px; padding-right:0px; padding-top:0px; padding-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; margin-bottom:0px; border-bottom:1px solid #ccc; color:; " id="mnu_77">

				<div class="row col-md-12  bg-light " style="background:  border-left:3px solid rgba(0,0,0,1); font-size:0.8em; margin:0px 0px; margin-left:0px; padding:14px 0px 14px 10px; padding-right:0px; border-bottom:1px solid rgba(200,200,200,0.6); " title="Información de Perfil">
				    <span class="col-1 " style=" font-size:1.1em; "><i class="fa-solid fa-people-arrows"></i></span> 
					<span class="col-9 " style="font-size:1.1em;"> Asocia</span>
					<span class=" col-1 text-head" style="float:right; right:-15px; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
				</div> 
			</a>


               
            

        </div>

        <!-- area de trabajo -->

				<div class="col-md bg-light border-right" style="padding:0px;">
          <form method="post" action="?" id="update_image_form" enctype="multipart/form-data">  
					
					<div style="height: 510px; max-height: 510px; overflow:scroll; overflow-x: hidden; overflow-y: auto; margin-right: 10px;">


<!-- Step 1 -->

				<div class="col-sm-12 grid-margin " id="step-1" style="float: left; display:<?php echo($display_step1); ?>"  >
						<h5 class="col-md-12 p-3 title_sec "> Informacion General </h5>
						
						<br>
						
						<div class="row">
								<div class="col-sm-6 form-group ">
				              <label for="tipo_add" >Tipo de Serie</label>
				              <select id="tipo_add" value="" class="form-control"> <?php echo $ops_tipo_serie; ?> </select>
				                            
				        </div>
											
								<div class="col-sm-6 form-group ">
				              <label for="estado_add" >Estado Inicial</label>
				              <select id="estado_add" value="" class="form-control"> <?php echo $ops_estado_ini_serie; ?> </select>
				                            
				        </div>
						</div>
									
						
						<div class="row">								  		                        
								<div class="col-md-6 form-group">
				            	<label for="nombre_add" class="c">Nombre de La Serie</label>
				            	<input type="text" class="form-control" id="nombre_add" name="nombre_add" value="<?php echo $nombre_res ?>" placeholder="Nombre de la Serie">
				        </div>

								<div class="col-md-6 form-group">
									<div class="form-check form-check-flat" style="padding-bottom:5px; padding-top:5px;" >
											<label class="form-check-label ">
											<input type="checkbox" id="premium_add" class="form-check-input" <?php echo $chk_edo; ?> onchange="toggle('detalles_premium');" value="1" > 
														Serie Premium
											</label>							
									</div>

									<span id="detalles_premium" style="display:<?php echo $disp_div_prem; ?>;">
										<div class="col-md-12">
											<label>Donativo:</label>
												<div class="row form-group">
															<label >$<input class="col-sm-3 form-control" type="number" min="5.00" id="precio_add" value="<?php echo $precio_res ?>" placeholder="precio">
														
															<select class="col-sm-4 form-control" id="moneda_add">
																<option value="X" selected="" >Elije...</option>
																<?php echo $ops_moneda; ?>
															</select>
															</label>
												</div>
														
										</div>
									</span>
											
				        </div>
				                        
						</div>
									
						<div class="row">
								<div class="col-sm-6 form-group ">
				            <label for="no_add" >Clave Lego de Serie</label>
				              <input type="number" min="71000"  class="form-control" id="no_add" name="no_add" value="<?php echo $resume ?>" placeholder=" Clave LEGO ">   
				        </div>
				                        
				        <div class="col-sm-6 form-group ">
				            <label for="fecha_add" >Fecha de Venta</label>
				            <input type="date" class="form-control" id="fecha_add" name="fecha_add" value="<?php echo $fecha_lanza_res ?>" placeholder="Fecha de salida ">
				        </div>
						</div>
			                        
			      <div class="row">	
				        <div class="col-sm-6 form-group ">
				          <label for="fecha_add" >Total de Figuras</label>
				          <input type="number" class="form-control" min="10" name="figuras_add" id="figuras_add" value="<?php echo $total_res; ?>" placeholder="No de Figuras ">
				        </div>
				                        	
				        <div class="col-sm-6 form-group ">
				          <label for="fecha_add" >Color Principal (RGB)</label>
				          <input type="color" class="form-control" id="color_add" name="color_add" value="<?php echo $color_resb ?>" placeholder="Formato RGB (100,100,100) ">
				        </div>	
			      </div>
			                        
			      <div class="col-md-4 form-group ">
			          <a type="button" href="#" class="btn btn-secondary mr-2 btn-block btn-lg" onclick="pre_save_serie();">Siguiente</a>
			      </div>  			                        	                     
			    </div>
							  	
							  	 <!------------- FIN STEP 1  --------------->

									<!-- Step 2 -->

				<div class="col-sm-12  grid-margin " id="step-2" style=" display:<?php echo $display_step2; ?>" >

			        <h5 class="col-md-12 p-3 title_sec "> Personajes </h5>
					<p>Ingresa la lista de nombres separados por ";". </p><p>Ejemplo:<br> <code>Nombre Español 1, Nombre Inglés 1;<br> Nombre Español 2, Nombre Inglés 2; </code> </p>
					
								<div class="row " >
									
									<div class="col-sm-6 grid-margin "   >
										<textarea class="col-sm-12 text-muted "  onblur="process_names();" id="nombres_fig_add" style="font-size: 12px;"  name="nombres_fig_add" rows="15"><?php echo $data_step2; ?></textarea>
											
									</div>
			
									<div class="col-sm-6 grid-margin border " style="border-radius: 3px; height: 280px; overflow:scroll; overflow-x: hidden; overflow-y: auto;" id="name_summary"  >
									
											
									</div>
									
								</div>						
									

									
									<div class="row text-center">
										<div class="form-group col-md-4 text-center ">
				                        	<a href="#" type="button" class="btn btn-secondary mr-2 btn-block" onclick="step(1); ">Atrás</a>
				                        </div>  
				                        <div class="form-group col-md-4 text-center ">
				                        	
				                        </div> 							
				                        <div class="form-group col-md-4 text-center ">
				                        	<button type="button" class="btn btn-secondary btn-block" onclick="pre_save_minifig(); step(3); ">Siguiente</button>
				                        </div> 
				                        
									</div>
							 </div>

							   <!-------------FIN STEP 2 --------------->
							   <!-- step 3 -->


							<div class="col-md-12  grid-margin"  id="step-3" style="float: left; display:<?php echo($display_step3); ?>" >
								  <h5 class="col-md-12 p-3 title_sec "> Imágenes </h5>
								  								  
								<div id="carga_images_add" class="row text-center" style="display:block;  height: 400px; padding: 5px; ">
									  
									<div class="row form-group  col-md-12 text-center " id="upload_form" style="display:<?php echo $disp_upload; ?>">
										<span><input type="file" name="imagenes[]" id="imagenes" class="col-sm-4 text-light btn-primary " value="" enctype="multipart/form-data" multiple="multiple"></span>
										<button type="button" class="btn btn-outline-primary " id="btn_upload" onclick="save_images();"> <i class="fa-solid fa-upload"></i> </button>
									</div>
				                
					                <div class="col-md-12 " id="result_upload" style="border: 0px solid #333; background: #f3f3f3; height: 390px; padding: 10px; overflow: scroll; overflow-x: hidden;" >
						                
						                <?php echo $ms;?>
					                </div>
					                
								</div>	
									
								
								  
								 <!-- BOTONES -->
								<div class="row text-center">
										<div class="form-group col-md-4  text-center ">
				                        	<a href="#" class="btn btn-secondary mr-2 btn-block" onclick="step(2); ">Atrás</a>
				                        </div>
				                        
				                        <div class="form-group col-md-2 text-center ">
				                        </div>
				                        				                        					
				                        <div class="form-group col-md-4 text-center ">
				                        	<a href="#" class="btn btn-secondary mr-2 btn-block" onclick="step(4);">Siguiente</a>
				                        </div> 		
								 </div>	                        
							</div>
							  
							  <!------------- FIN STEP 3 	------------>
							  <!-- step 4 -->

							   <!------------- STEP 4 - ASOCIAR --------------->
							  <div class="col-md-12  grid-margin "  id="step-4" style="float: left; display:<?php echo($display_step4); ?>" >
								  <h5 class="col-md-12 p-3 title_sec "> Asociar Minifiguras </h5>
								  <p class="text-center">Selecciona una opción que se asocie con el nombre, completa todas las imágenes para continuar.</p>
								  
								  <input type="hidden" value="<?php echo $data_step4b; ?>" id="current_img_draft" >
								  
								  <div id="carga_images_add" class="grid-margin" style="display:block; background: #f4f4f4; padding: 10px 5px;  height: 400px; overflow: auto; overflow-x: hidden; border: 0px solid #c30; padding: 5px; ">
									  
								  <input type="hidden" id="res_upload_images" value="">
								  <input type="hidden" id="name_asign" value="">
								  
									<div class="col-lg-12" id="lista_imagenes">
										
									</div>
								  	</div>
								  
								  
								  	<div class="row text-center">

									  	<div class="form-group col-md-4 text-center ">
				                        </div>  
										<div class="form-group col-md-4 text-center ">
				                        	<a href="#" class="btn btn-secondary mr-2 btn-block" onclick="step(3); ">Atrás</a>
				                        	<button type="button" class="btn btn-success mr-2 btn-block" id="guarda_serie" disabled onclick="save_serie();">Guardar Serie</button>
				                        </div>  
										<div class="form-group col-md-4 text-center ">
				                        </div> 
									</div>
				                        			                        
							  </div>							
						   <!------------- FIN STEP 4 - ASOCIAR --------------->
						

  <div class="row" onmouseover="" style="display: none" id="add_serie_btns">
                          	<button type="submit" class="btn btn-success mr-2" >Guardar</button>
                        </div>  


         </div>
       </form>
    
       <!-- fin area de trabajo -->

    



	<!--- Anterior -->

	





	



	<?php } ?>
