<?php

//include("check_access.php");

	$perfil_user = $GLOBALS['user_perfil'];
	$user = $_SESSION['clave_user'];	
//$user = $_SESSION['clave_user'];
//var_dump($user);

	if($user==0 or $user==""){
			
		echo '<meta http-equiv = "refresh" content = "0; url = '.$link_site.'?access=1" />';
			
	}else{
		
		if($user_perfil==0 or $user_perfil==""){
			
			}
/////////////////////////


$user_id = $GLOBALS['user'];
//echo $user_id; 
$user_perfil = $GLOBALS['user_perfil'] ;
$user_masterpass = $GLOBALS['user_masterpass'] ;

$id_tema = $_GET['ref'];
$all_sets = $_GET['alle'];
//var_dump($id_tema); 


///// Vista lista 
$lista = $_GET['lista'];



if($lista==1){
	$list_vis = 'display:block;';
	$ancho_panel = 9;
	$ancho_list = 3;
	$ancho_card = 4;
}else{
	$list_vis = 'display:none;';
	$ancho_panel = 12;
	$ancho_list = 10;
	$ancho_card = 3;
}




////////////


if($id_tema != ""  ){ /// MOSAICO DE TEMAS 
	
	$qset = "SELECT * FROM sets where id_user = $user_id and id_tema = $id_tema order by fecha_add desc ;";// preparando la instruccion sql
	//echo $qset; 
	
	    $result= $dbh->query($qset);
	  //  var_dump($result); 
    if ($result->num_rows > 0) {
	  
	//echo   $result->num_rows; 
	  
	  
	 // $path_set = 'assets/images/sets/'.$user_id.'/';
	  $path_set = 'assets/images/sets/';
	  
	    $tarjetas_ini = ""; 
	    $num = 1; 
                        while($rowb= $result->fetch_assoc()){
	                        
	                       $data = getinfotema($id_tema); 
	                      
							$datab = explode('|', $data);
							
							$s_nombre = $datab[0];
							$s_color = $datab[1];
							$s_logo = $datab[2];
	                        
	                      // var_dump($data);                        
	                        
		                    $search = strtolower($rowb['nombre']).' '.$rowb['cve_lego'];;
		                    $h = 100; 
		                    $mnu = $_GET['mnu'];
		                    $color = $s_color;
		                    
		                    $rgb = explode(',',$color); 
		                    $r = $rgb[0]; 
		                    $g = $rgb[1]; 
		                    $b = $rgb[2]; 
		                    
		                    if($r < 77 || $g < 70 || $b < 50){
			                    $class_btn = 'btn-outline-light';
			                    $class_text = 'text-light';
			                    
		                    }elseif($r > 200 && $g > 200 && $b > 200){
								$class_btn = 'btn-outline-neutral'; 
								 $class_text = 'text-neutral';
							}else{
								
								 $class_text = 'text-neutral';
								 $class_btn = 'btn-outline-neutral';
							}	
							
							
							
							if($rowb['anio_public']=='0000'){
								$anio = ''; 
							}else{
								$anio = $rowb['anio_public']; 
							}
		                    
		                    
		                    if($user_perfil==1){

								
							}else{
								$admin_tools = '';
							}
							
								$admin_tools = '
								<div class="col-sm-12 ico_set '.$class_text.'" style="font-size:12px;"   onclick="getSetInfo(\''.$rowb['id'].'\') " > 
									<i class="fas fa-pencil-alt" ></i>
								</div>
								
								<div class="col-sm-12 ico_set '.$class_text.'" style="font-size:12px;"  onclick="elimina_set(\''.$rowb['id'].'\') " > 
									<i class="fa fa-trash-alt" ></i>
								</div>
								';
															
	                    
		                    $classes .= ' 
		                    .set_'.$rowb['cve_lego'].'{
		                    background: #fff; 
		                    }';
		                    
		                   // $call_api = apibrickowl($rowb['cve_lego']);
		                   // var_dump($call_api); 
		                   $largo_title = strlen($rowb['nombre']);
		                   
							if($largo_title >= 35){
			                   $fontsize = '12px';
		                   	}else{
			                   $fontsize = '16px'; 
		                   }

		                    
							if($rowb['estado']==0){
								$tarjetas_ini .=''; 
								
								$ico_edo = '';
								
								$btn_show = '';
									
	                    	}else{  
		                    	//$foto = '';
		                    	//$path_set = '';
		                    	
		                    	/*
											$file = $path_set.$rowb['item_foto'];											
											if(file_exists($file)) {
											       $foto = $rowb['item_foto'];
											} else {
											       $foto = 'noimage.png';
											}	
								*/
														
								$foto = valida_foto_tipo($rowb['cve_lego'],1);
								
								//var_dump($rowb['cve_lego']);
								//$path_set_b = 'assets/images/sets/';
								
								
								// adecuar precio 
								
								$inversion_tema = floatval($inversion_tema) + floatval($rowb['precio']);
								$precio = $rowb['precio'];
								$id_tema = $rowb['id_tema'];
								
								if($id_tema == 21){
									$disp_precio = 'Set de regalo / promocional';
								}else{
									if($precio < 1){
										$disp_precio = 'No se ha registrado precio';
										
										$count_sin_precio = $count_sin_precio +1;
										
										$style_ico_precio = 'opacity: 0.3;';
										
									}else{
										
										$count_precio = $count_precio +1;
										$data_precio = explode('.', $precio); 
										$style_ico_precio = 'opacity: 1;';
										
										$pesos = $data_precio[0];
										$centavos = $data_precio[1];
										

										
										// formato de centavos
										
										if($centavos == 00){
											$cent = '00'; 
											
										}else{
											$cent = $centavos;
										}									
										
										
										$disp_precio = money_format('%(#10n', $precio);
									}
									
									
									
								}
								
								$ico_precio = '<div class="col-sm-12 ico_set '.$class_text.'" style="font-size:12px; '.$style_ico_precio.' " title="'.$disp_precio.'"> <i class="fas fa-dollar-sign"></i></div>';
								
								///
								
								$ico_fecha = '
								<div class="col-sm-12 ico_set '.$class_text.'" style="font-size:12px;" title="Fecha de Registro: '.formatFecha($rowb['fecha_add']).'"> 
								<i class="fas fa-calendar-day"></i>
								</div>';
								
								//// Piezas 
									$tot_piezas = $tot_piezas + $rowb['piezas'];
								/////
								
								$ico_edo = '';
									         
									                     
								$btn_show = '';

								$list_sets .= '
								<div class="col-sm-12 p-1 border-bottom " style="text-align:left; " > 
								<span class="text-muted text-sm" >'.$num.'. '.$rowb['nombre'].' </span> 
								</div>';
								
								
								$list_csv.= $rowb['nombre'].',';
								
								
								// Minifiguras 
								if($rowb['no_minifig']==0){

								$ico_minifig = '
								<div class="col-sm-12 ico_set '.$class_text.'" style="font-size:12px; opacity: 0.3; " title=" No se han registrado Minifiguras en este set."> 
								<i class="fas fa-child"></i>
								</div>';
																	
								}else{

								$ico_minifig = '
								<div class="col-sm-12 ico_set '.$class_text.'" style="font-size:12px; " title="Minifiguras Incluidas: '.$rowb['no_minifig'].'"> 
								<i class="fas fa-child"></i> <span style="font-size:10px;">x'.$rowb['no_minifig'].'</span>
								</div>';
																	
								}
								
								$tot_minifig = $tot_minifig + $rowb['no_minifig'];
								///
								


								 
								 								
								
								$tarjetas_ini .= '
								<card class="col-md-'.$ancho_card.' grid-margin stretch-card " id="set-'.$rowb['id'].'" searchable="'.$search.'" >
									<div class="card shelf_card" style="border: 1px solid rgba(200,200,200,0.9); border-radius:5px; background: #fff; " >
										
									<div class="set_hover_imagen  " > 
										<img src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'" style=" position: absolute; max-heigth: 80%; max-width:75%; height:80%; width:auto; right: 18%; bottom: 8px;" >
										<input type="hidden" id="foto_set_'.$rowb['id'].'" value="'.$foto.'">
									</div>
									
									
									
									<div class="set_back_color" id="" style="align-content: center; text-align: center; background:linear-gradient(120deg, rgba('.$color.',0.9) 40%, rgba('.$color.',0.4) 120%); height:'.$h.'%; " >
									</div>
										
									<div class="set_hold_info" style="z-index:99;  ">
										
										<div class="set_logo_lego" style="" >
										<span class="'.$class_text.' text-sm" style="margin-top:3px; text-align: center; display:block; filter:opacity:30%;">'.$num.'</span>
										</div>
										
										<div class="set_logo_tema" style="" >
											<img src="data:image/png;base64,'.base64_encode(file_get_contents('assets/images/logos/'.$s_logo)).'" style="height: 20px;  " >
											
										</div>
										
										<div class="set_data_row set_detail_font" style="font-weight: 300;  " >
											<span class="'.$class_text.' set_info set_txt_sm" >'.$rowb['cve_lego'].' - '.$rowb['piezas'].' pzs. </span>
										</div>
										
										<div class="set_data_row set_title_font" style="border-bottom:0px solid #ccc;" >
											<span class="'.$class_text.' set_info " style="font-size: '.$fontsize.'; " > 
											'.$rowb['nombre'].' '.$largo_titl.'
											</span>
										</div>									
										
						            </div>
						                
										<div class="hold_icons_set" style="background:linear-gradient(360deg, rgba('.$color.',0.7) 30%, rgba('.$color.',0) 90%); border-left: 1px solid rgba(255,255,255,0.2); overflow-y:auto; overflow-x: hidden;" >
												
										
										<div style=" overflow:scroll; overflow-x: hidden; overflow-y:auto; border:0px solid #ccc; padding:0px;  ">
												
											'.$ico_edo.$ico_precio.$ico_fecha.$ico_minifig.$admin_tools.' 
												
										</div>
																			
										
										<span class="'.$class_text.' " style="position: absolute; bottom: 1px; right: 5px; display: block; font-size: 11px; opacity:50%;  "> '.$anio.' </span>
												
						                </div> 
						                
										<div class="card-body card_body_main" style="border: 0px solid #ca0;  margin-left: 0px; z-index: 80;   " >
					                    	<h4 class="card-title card_title_main">
												<span id="">
													<h4 class="title_card">  </h4>
												</span> 
					                    </div>
					                    
					                    

					                    
					                    
									</div>									
								</card>'; 
								

 /// Genera una tarjeta con estadisticos
 
 if($num != $count_precio){
	 
	 if($count_precio==1){
		 
		 $txt = '1 set tiene';
	 
	 }elseif($count_precio==0){
		 
		 $txt = 'Nungún set tiene';
		 
	 }else{
		 
		 $txt = 'Solo '.$count_precio.' sets tienen';
	 }
	 
	 $ico_war = '<span title="'.$txt.' precio regsitrado"> <i class="fa fa-exclamation-circle"></i></span>';
 }else{
	 $ico_war = '';
 }
 
 
 	//formato de miles 
											

											
	//var_dump($tam_pesos);
											
setlocale(LC_MONETARY, 'en_US');

$lbl_pesos = money_format('%(#10n', $inversion_tema);
		

											
				//background:linear-gradient(360deg, rgba('.$color.',0.7) 30%, rgba('.$color.',0) 90%); 
				// background:linear-gradient(1200deg, rgba(130,130,130,0.0) 30%, rgba('.$color.',0.7) 90%);  							
 
 
 $path_logo_tema = 'assets/images/logos/';
$stats_tema = '
<div class="row col-md-12" id="head_'.$rowb['cve_lego'].'">
<div class="col col-sm-4"></div>

<card class="col-sm-4 grid-margin stretch-card " id="stats-'.$rowb['cve_lego'].'"  >
	<div class="card shelf_card" style="border: 1px solid rgba(200,200,200,0.9); border-radius:5px; background: #fff; background: rgba(250,250,250,0.3);" >
		
		<div class="back_color_main fondo_negro_tarjeta" style="z-index:100; background:rgba('.$color.',0.5);" id=""></div>
										
		<div class="set_hover_imagen " style="z-index:99;" > 
			<img  src="data:image/png;base64,'.base64_encode(file_get_contents($path_logo_tema.$s_logo)).'" style=" position: absolute; max-height: 99%;  max-width:80%; height:auto; width:auto; left:10px; bottom: 10px; border:0px solid #c30;" > 
			
		</div>
									
									
		<div class="set_back_color" id="" style="background:linear-gradient(230deg, rgba('.$color.',0.6) 40%, rgba('.$color.',0.8) 120%); height:'.$h.'%; " > </div>
										
		<div class="col-sm-12 set_hold_info" style="width:99%; z-index:100; border:0px solid #fff; ">
										
															
					<div class="col-sm-4 set_data_row set_detail_font hold_icons_set_stats_flat " style="background:linear-gradient(120deg, rgba(130,130,130,0.0) 30%, rgba('.$color.',0.9) 90%); border:0px solid #ccc;"  >
					
							<div class="col-sm-12 '.$class_text.' set_stat "  > 
								<span  >
									'.$num.' <span class="col-sm-2 bubble_text"><i class="fa fa-box-open"></i> </span> 
								</span>
							</div>	
							
							
							<div class="col-sm-12 '.$class_text.' set_stat "  > 
								<span >
								'.$ico_war .' '.$lbl_pesos.' <span class="col-sm-2 bubble_text"><i class="fa fa-wallet"></i> </span>  
								</span>
							</div>	
							
							
							<div class="col-sm-12 '.$class_text.' set_stat "  > 
								<span>
									'.$tot_piezas .' <span class="col-sm-2 bubble_text"><i class="fa fa-puzzle-piece"></i> </span> 
								</span>
							</div>	
							
							<div class="col-sm-12 '.$class_text.' set_stat "  > 
								<span>
									'.$tot_minifig.' <span class="col-sm-2 bubble_text"><i class="fa fa-child"></i> </span> 
								</span>
							</div>										
					</div>
					
					
										
			</div>
						                
		<div class="imagen_main" style="border: 10x solid #ce0; height: 10%; padding: 5px; left:93%; width: 10%; z-index:101; text-align: right; top: -20px; display:block; ">
			<span class="'.$class_text.' text-neutral" style="font-size:22px; border-radius:30px; background:rgba(255,255,255,0.9);" onclick="toggle(\'head_'.$rowb['cve_lego'].'\')" > <i class="fa fa-times-circle"></i> </span>
		</div> 
						                
		<div class="card-body card_body_main" style="border: 0px solid #ca0;  margin-left: 0px; z-index: 80;   " >
			<h4 class="card-title card_title_main">
				<span id="">
					<h4 class="title_card"> </h4>
				</span> 
		</div>
		
	</div>									
</card>

<div class="col col-sm-4"></div>
</div>
';     
	
	
	//////////                
	  								
								
	                    
	                    	} // else estado
							
							$num = $num +1;
	                    }// while
	                   
	                     
		}else{ // resultados del query 
			$tarjetas_ini = '<span class="text-neutral"> No tines ningún set de este tema. </span>';
			$stats_tema = '';
		}
	
	
	
///	$file_csv = genera_csv_set($id_tema, $list_csv);
	
		//$file_csv = genera_csv($id_tema,$user_id);
	
																//////////////////// GRID DE TEMAS.  ///////////////////
	
}elseif($all_sets == '' or isset($all_sets) == FALSE and isset($id_tema) == TRUE){
			 
		$q = "SELECT * FROM temas_sets where estado = 1 order by nombre asc;";// preparando la instruccion sql
   
    $result= $dbh->query($q);
    if ($result->num_rows > 0) {


	  //vistas 
	  
		        			  $vista_grid = $_GET['vista'];
		        			  
		        			  if($vista_grid==''){
			        			  $tamanio_card  = $GLOBALS['user_vista_s'];
		        			  }else{
		        			  
		        			  $tamanio_card = $vista_grid ;
		        			  /*
			                    if($vista_grid==''){
				                    $tamanio_card =2;
			                    }elseif($vista_grid==1){
				                    $tamanio_card =12;
			                    }elseif($vista_grid==2){
				                    $tamanio_card =2;
			                    }elseif($vista_grid==3){
				                    $tamanio_card =6;
			                    }elseif($vista_grid>3 or $vista_grid ==0 ){
				                    $tamanio_card =2;
				                }
				                */
				              }
				            
				            if($vista_grid==2){	 // vista en grid	                   
		                   
			                    if($proporcion <= 1.2 ){ 
				                    $style_image = 'max-height: 150px; max-width:100px; margin-right:5px; '.$proporcion; 
			                    }elseif($proporcion > 1.2 and $proporcion < 2){
				                    $style_image = 'max-height: 65%; max-width: 60%; margin-right:5px; '.$proporcion;
			                    }else{
				                    $style_image = 'max-height: 70%; max-width: 75%; margin-right:5px; '.$proporcion;
			                    }
			                    
			                    $align_vista = ''; 
			                    
		                    }elseif($vista_grid==12){ // vista en lista

			                    if($proporcion <= 1.2 ){
				                    $style_image = 'max-height: 50%; max-width:9%; margin-right:5px; '.$proporcion; 
			                    }elseif($proporcion > 1.2 and $proporcion < 2){
				                    $style_image = 'max-height: 65%; max-width: 14%; margin-right:5px; '.$proporcion;
			                    }else{
				                    $style_image = 'max-height: 40%; max-width: 20%; margin-right:5px; '.$proporcion;
			                    }
			                    
			                    $align_vista = 'align-left-row'; 		                    
		                    }elseif($vista_grid==6){ // vista en lista

			                    if($proporcion <= 1.2 ){
				                    $style_image = 'max-height: 100px; margin-right:5px; 3-'.$proporcion; 
			                    }elseif($proporcion > 1.2 and $proporcion < 2){
				                    $style_image = 'max-height: 100px; margin-right:5px; 3-'.$proporcion;
			                    }else{
				                    $style_image = 'max-height: 100px; margin-right:5px; 3-'.$proporcion;
			                    }
			                    
			                    $align_vista = 'align-left-row'; 		                    
		                    }
	  
	  ///
	  
	  	    
	    $total_global_temas = $result->num_rows; 
	    
	    $tarjetas_ini = ""; 
	    $num = 1; 
                        while($row= $result->fetch_assoc()){
	                        
	                        $total_sets = getinfosets($row['id']);
	                        
	                        $datac = explode('-', $total_sets ); 
	                        
	                        $id = $row['id'];
	                        
	                        $total = $datac[0];
	                        $piezas = $datac[1];
	                        $precio = $datac[2];
	                        
	                        
	                        
	                        $total_global_sets = intval($total_global_sets) + intval($total); 
	                        $total_global_piezas = $total_global_piezas + $piezas; 
	                        $total_global_precio = $total_global_precio + $precio;
	                        
	                      //  var_dump($total_global_sets);
	                        	                       
							$color = $row['color'];
							$colorb = $row['color_alt'];
		                    
		                    $h = 100; 
		                    $mnu = $_GET['mnu'];
		                    
		                    $rgb = explode(',',$color); 
		                    $r = $rgb[0]; 
		                    $g = $rgb[1]; 
		                    $b = $rgb[2]; 
		                    
		                    if($r < 77 || $g < 70 || $b < 50){
			                    $class_btn = 'btn-outline-light';
			                    $class_text = 'text-light';
			                    
			                    $debug_btn = 'A';
			                    
		                    }elseif($r > 200 && $g > 200 && $b > 200){
								$class_btn = 'btn-outline-neutral'; 
								 $class_text = 'text-neutral';
								 
								 $debug_btn = 'B';
							}else{
								
								 $class_text = 'text-neutral';
								 $class_btn = 'btn-outline-neutral';
								 
								 $debug_btn = 'C';
							}	
							
				$tema_info = getinfotema($row['id_tema']);

				$data_tema = explode('|', $tema_info);

				$nombre_tema = $data_tema[0];

					
							$cuenta_temas = 0; 
							$cuenta_temas_no = 0;
							$lbl_show_sets = '';
							
	                        if($total>=1){
		                        
		                        $view_card = '';
		                        $lbl_show_sets = ''; 
		                        
		                        if($total==1){
	                        
		                        	$button_label = '
												<a href="index.php?mnu='.$mnu.'&ref='.$row['id'].'&cve=2&thema='.$row['id'].'" class="btn '.$class_btn .' " style="font-size: 12px; ">
													<span id=""  >  Ver <strong>'.$total.'</strong> set. </span> 
												</a>';
		                        }else{                        

		                        	$button_label = '
		                        				<a href="index.php?mnu='.$mnu.'&ref='.$row['id'].'&cve=2&thema='.$row['id'].'" class="btn '.$class_btn .' text-left " style="font-size: 12px; ">
													<span id=""  >  Ver <strong>'.$total.'</strong> sets. </span> 
												</a>
												';
												
												$cuenta_temas = $cuenta_temas + 1;
								}

	                        }else{
		                        $button_label = '
					                        	<a href="#" onclick="toggle(\'nuevo_set\');" class="btn '.$class_btn .' " style="font-size: 12px;" > 
													<span><i class="fa fa-plus-circle"> </i> Agregar Set </span>
												</a>
		                        '; 
		                        $view_card = ' display: none; ';
		                        
		                        $cuenta_temas_no = $cuenta_temas_no + 1;
		                        
		                        
	                        }							
							
							
							

							
							
							if($row['estado']==0){
              
								$tarjetas_ini .=''; 
	                    	}else{
								
								$file = 'assets/images/logos/'.$row['logo'];
								
								if(file_exists($file)) {
								       //echo "The file exists";
								       $foto = $row['logo'];
								} else {
								       //echo "The file does not exist";
								       $foto = 'logo.png';
								}
								
								
								$file = 'assets/images/logos/'.$foto;  // Dirección de la imagen
								 $imagen = getimagesize($file);    //Sacamos la información
								 $ancho = $imagen[0];              //Ancho
								 $alto = $imagen[1];               //Alto
								 
								 $proporcion = $ancho/$alto; 
								 
								if($ancho>$alto){
									$pos = 'h'; 
								}else if($ancho < $alto){
									$pos = 'v';
								}else if($ancho == $alto) {
									$pos = 'c';
								}
								
								//echo $pos .'-'.$row['nombre'].'<br>';
								
								if($proporcion > 2.5 ){
									$top = '20%; '; 
								}else{
									$top = '10%; '; 
									
								}
								
								
								if($pos=='h'){
									$atr = ' max-width: 100px; width:100px;';
								}else if($pos == 'v'){
									$atr = ' max-height: 60px; ';
								}else if($pos == 'c'){
									$atr = ' height: 40px; ';
								}
								
								$search = ' '.strtolower($row['nombre']).' '.$total.' ';
 


								 
								 										                     
								$tarjetas_ini .= '
								<card class="col-md-'.$tamanio_card.' grid-margin stretch-card " id="set-'.$row['id'].'" searchable="'.$search.'" style="'.$view_card.'" >
									<div class="card shelf_card" style="border: 0px solid rgba(200,200,200,0.9); border-radius:5px; background: #ddd; " >
										
										<div class="back_color_main fondo_negro_tarjeta" id=""></div>
										
										<div class="back_color_main set_card_bg" id="" style="background:linear-gradient(155deg, rgba('.$color.',0.9 ) 30%, rgba('.$colorb.',0.7) 100%); height:'.$h.'%; z-index:100;" >
										</div>

										<div class="set_card_bg" id="" style="z-index:99;" >
											<img class="set_logo_bg" style=" max-width:60%; max-height: 60%;" src="data:image/png;base64,'.base64_encode(file_get_contents('assets/images/logos/'.$foto)).'" >																	
										</div>						                
						                                
										<div class="set_card_body" style="border: 0px solid #ca0;  margin-left: 0px; z-index:800;" >
					                    	<h4 class="" style="border: 0px solid #ca0; display: block; width: 99%; text-align: left; " >
												<span id="">
													<h4 class="set_card_title '.$class_text.'">'. strtoupper($row['nombre']).' </h4>
													
												</span>
											</h4>
										
										'.$button_label.'
													
					                    </div>
					                    
					                    <div class="card_body no-show" style="border: 0px solid #ca0;  margin-left: 0px; z-index:800; " >
					                    
											<span class="bubble_text '.$class_text.'" ><i class="fa fa-box" ></i>'.$total_global_sets.' sets.</span><br>
											<span class="bubble_text '.$class_text.'" ><i class="fa fa-puzzle-piece" ></i> '.$total_global_piezas.' piezas.</span><br>
											<span class="bubble_text '.$class_text.'" ><i class="fa fa-wallet" ></i>'.$total_global_precio.'.</span><br>
													'.$button_label.'					                    
					                    </div>
					                    
									</div>
								</card>'; 
	                    
	                    	}
							
							$num = $num +1;
	                    }// while
	                    
	                    
	}
	
		
		
	 
	}// Else
//	echo $q; 

///////// Genera el select de temas //

$qs = "SELECT * FROM temas_sets where estado = 1 order by nombre ;";// preparando la instruccion sql
   
    $results= $dbh->query($qs);
    if ($results->num_rows > 0) {
	    
	    $current_tema= $_GET['thema'];
	    
	    while($rows= $results->fetch_assoc()){
		    
		    if($current_tema== $rows['id']){
			    $stat = ' selected ';
		    }else{
			    $stat = ''; 
		    }
		    
		    $opt_select .= '<option '.$stat.' value="'.$rows['id'].'--'.$rows['logo'].'" >'.$rows['nombre'].'</option>'; 
		    $opt_select_list .= '<option value="'.$rows['id'].'--'.$rows['logo'].'" >'.$rows['nombre'].'</option>';
		    $opt_select_list_edit .= '<option value="'.$rows['id'].'" >'.$rows['nombre'].'</option>';
		}
		$select_tema = '<option value="0">Elije...</option>'.$opt_select; 
	}

///////


echo '<style>'.$classes. '</style>';


?>





<?php /////////// Despliega en home la vista
	
if( isset($_GET['ref']) == FALSE ){

	$class_show_statics = ''; 
	
}elseif( isset($_GET['ref']) == TRUE ) {

	$class_show_statics = 'no-show'; 

}


////////////// Select Origen 


$select_origen = genera_select_origen($id, $current, $id_set);

//include ('statics.php');

//////// ---- mustra label de bienvenida 

					
					//var_dump($cuenta_temas.'-'.$cuenta_temas_no);
					//var_dump($total_global_sets);
					
							if($total_global_sets == 0 and isset($_GET['thema'])==FALSE){ 
								
								$lbl_show_sets = '
								<div class="col-md-12" style="text-align:center; margin-top: 5%;">
								<span style="font-size:80px;"><i class="em em-call_me_hand" aria-role="presentation" aria-label="CALL ME HAND"></i></span>
								
								<br><br>
									<span class=" text-neutral center" style="font-size:24px; font-weight:300; font-family: \'Open Sans Condensed\', sans-serif; "> ¡Tu mosaico de SETS esta como nuevo! <br> 
									Comienza tu colección registrando un set.</span>
									
								<div>
								'; 		
							//	echo 'A';	
													
							}elseif($total_global_sets > 0  ){
								$lbl_show_sets = ''; 
								//echo 'B';
							}

///////



///

	
	echo '
	
	<div class="scrollable" >
	
	<div hold_bg_scroll_top"></div>


		
		<input type="hidden" id="csv_user" value="'.$user_id.'">
		<input type="hidden" id="csv_tema" value="'.$id_tema.'">
		
			
			<div class="col-sm-12" style="margin-top:20px; padding-bottom:30px; " >
			'.$lbl_show_sets.$stats_tema.$tarjetas_ini.'
			
			<div style="height:40px; " class="col-md-12 bg-success border no-show"></div>
			</div>
			
	</div>';
	
	
	$tema_nom = getinfotema($id_tema);
	
	$datab = explode('|', $tema_nom);
							
	$nombre_tema = $datab[0];
	
	
?>

<!---- EDITA SET --->

<div id="edit_set" class="hold_set_edita" style="display:none;  " >
	
	<div class="degrade_modal no-show"></div>
	
	<div class="col-lg-12 body_modal semi-transparent border" style="width: 90%;">
	
		<div class="pestana_edita"> <span class="claro" onclick="toggle('edit_set'); "> <i class="fas fa-times"></i></span></div>
	
	
		
	   	<div class="content-wrapper-thin" style="background: #fff; "  >
	   		
	   		<div class=" col-lg-12">
		   		
		   			        <div class="p-1  border-bottom  " style="padding: 10px 0 0 5px;">
				                   <h4>
					                   <span class="card-title-set text-success " style="float: left;" id="title_nombre">Edita Set</span>

				                   		<div class="btn-group " role="group" aria-label="" style="margin-left: 25px; " >
											
											<a href="#" class="btn btn-outline-neutral" onclick="save_set();" > 
									   			<i class="fas fa-save"></i> 
											</a>
											<a href="#" class="btn btn-outline-neutral" onclick="elimina_set('');" > 
									   			<i class="fas fa-trash"></i> 
											</a>									
								
											<?php echo $btn_show;  ?>
		                      			</div>
                      			
                      				</h4>
                      			
					  				
                      								               
				            </div>

	                   		<div class="p-1 border-bottom grid-margin bg-light "  style="text-align: center; ">     
		                   		&nbsp;  <span id="set_status" class="text-light bg-info" style=" border-radius: 5px;" ></span>
	                   		</div>
	                   		
	                   		
				<div class="row">
				 
				<div class="col-md-3 grid-margin " style="border: 0px solid #d30; height:300px; overflow:scroll; overflow-y: auto; overflow-x: hidden;">	
					<form name="form_up_set_edita" method="post" action="?" id="form_up_set_edita" enctype="multipart/form-data"> 
				            	   			
								<div class="row compacted " style="border: 0px solid #333;">
				                    <label for="edita_id" class="col-sm-4 col-form-label lbl_form_set">Nombre</label>
				                    <div class="col-sm-8">
				                        <input type="text" class="form-control" id="set_nombre" placeholder="Nombre">
				                    </div>
				                </div>
				            
								<div class="row compacted ">
				                    <label for="set_cve" class="col-sm-4 col-form-label lbl_form_set">Clave</label>
				                    
				                    <div class="col-sm-8">
				                        <input type="text"  class="form-control" name="set_cve"  id="set_cve" placeholder="Index">
				                    </div>
				                </div>

								<div class="row compacted ">
			                        <label for="edita_serie" class="col-sm-4 col-form-label lbl_form_set">Tema</label>
			                        <div class="col-sm-8" >
				                        				                        
			                           
			                           	 <select class="form-control" id="set_tema" >
				                              
			                              </select>
			                             
			                              <!--
			                              <input class="form-control" id="set_tema" list="set_temab">
			                              <datalist aria-dropeffect="" id="set_temab">
			                              <?php echo $opt_select_list_edit ?>
			                              </datalist>	-->		                              
			                              			                              
			                        </div>
			                    </div>


								<div class=" row compacted ">
					                <label for="edita_sku" class="col-sm-4 col-form-label lbl_form_set">Origen</label>
					                   	<div class="col-sm-8" id="hold_origen">
					                            
					                    </div>
					            </div>
	   			  
								
			                    <div class="row compacted ">
			                        <label for="edita_imagen" class="col-sm-4 col-form-label lbl_form_set">Piezas</label>
			                    	    <div class="col-sm-8">
			                              <input type="number" min="100"  class="form-control" id="set_piezas" placeholder="Piezas"> 
			                            </div>
			                    </div>
			                
			                    
								<div class="row compacted ">
					                <label for="edita_sku" class="col-sm-4 col-form-label lbl_form_set">Precio</label>
					                   	<div class="col-sm-8">
					                            <input type="number" step="0.10"  class="form-control" id="set_precio" placeholder="Precio">
					                    </div>
					            </div>


								<div class=" row compacted ">
					                <label for="edita_sku" class="col-sm-4 col-form-label lbl_form_set">Año </label>
					                   	<div class="col-sm-8">
					                            <input type="number" min="1900"  class="form-control" id="set_anio" placeholder="año">
					                    </div>
					            </div>	

								<div class=" row compacted ">
					                <label for="edita_sku" class="col-sm-4 col-form-label lbl_form_set">Figuras:</label>
					                   	<div class="col-sm-8">
					                            <input type="number" min="0"  class="form-control" id="set_minifig" placeholder="Minifiguras Incluidas">
					                    </div>
					            </div>

			                    <div class="row compacted ">
			                        <label for="edita_imagen" class="col-sm-4 col-form-label lbl_form_set">Imagen: </label>
			                    	    <div class="col-sm-8">
			                              <input type="text" min="100" disabled="disabled" class="form-control" name="set_foto" id="set_foto" placeholder="Imagen"> 
			                            </div>
			                    </div> 

								<div class=" row compacted ">
				                    <label for="edita_index" class="col-sm-4 col-form-label lbl_form_set">ID DB</label>
				                    <div class="col-sm-8">
				                        <input type="text" disabled="disabled" class="form-control" id="set_id_d" placeholder="ID DB">
				                        <input type="hidden" id="set_id" >
				                    </div>
				                </div>	         
				            
					            			            				                    
				</div>
				
				
				<div class="col-md-2 border-left border-right bg-light" style="padding: 0px; max-height: 298px; margin-left: 10px;" >
					
					<div class="row col-md-12  bg-head side_menu text-muted " id="sidemenu_1" style=" " onclick="sidemenu(this.id)" title="Conf. Gral. Colección">
										    <span class="col-1 " style=" font-size:1.1em; "><i class="fa fa-fas fa-image"></i></span> 
											<span class="col-6 " style="font-size:1.1em;" onclick="sidemenu(this.id)"> Ver Foto</span>
											<span class=" col-1 text-head" style="float:right; right:-15px; font-size:1em; " onclick="sidemenu(this.id)"><i class="fa-solid fa-chevron-right"></i></span> 
					</div>
			        
			        <div class="row col-md-12  bg-head-low  side_menu text-muted" id="sidemenu_2" style=""  onclick="sidemenu(this.id)"  title="Etiqueta">
										    <span class="col-1 " style=" font-size:1.1em; "><i class="fa fa-fas fa-barcode"></i></span> 
											<span class="col-6 " style="font-size:1.1em;" onclick="sidemenu(this.id)" > Etiqueta</span>
											<span class=" col-1 text-head" style="float:right; right:-15px; font-size:1em; " onclick="sidemenu(this.id)"><i class="fa-solid fa-chevron-right"></i></span> 
										</div>
							                   			                                     
				</div>
				

				
				<div class="col-md-6 grid-margin  center " style="height: height: 298px; max-height: 298px;" >
					
					<div class="" id="side_div_1" style="display: block;">  
						<h5 class="col-md-12 p-2  subtitle_sec"> Imagen Set  </h5>
						<div  class="col-md-12 form-group compacted" id="display_image_set"  style="  display: block; border: 0px solid #ccc; max-height: 250px; ">  </div>
					</div>

					<div class="" id="side_div_2" style="display: none;">
						<h5 class="col-md-12 p-2  subtitle_sec"> Etiqueta Inventario  </h5>
						
						<div style="display: block;" id="lbl_barcode">
							<div class="barcode_holder"  >
								<span style="font-size: 9px;"><?php echo strtoupper($sitio_web); ?> </span>  <span style="font-size: 9px;"> | <b><?php echo strtoupper($nombre_tema); ?> </b> </span> <br><br>
								<span class="barcode_set" id="barcode_set">  </span><br>
								<span style="font-size: 9.5px;" id="nombre_set_barcode" ></span>					
							</div>
						</div>
						
						<br>
						
						<span id="btn_print_barcode" ></span>

						
					</div>

								

				</div>
				
				</form>
				</div>
				
			</div>
	   	</div>
	</div>
		
</div>


<!-- //////////////////////////               NUEVO SET              //////////////////////////// -->

<div id="nuevo_set" class="hold_set_edita" style="display:none; " >
	<div class="degrade_modal"></div>
	
	<div class="col-lg-12 body_modal semi-transparent" style="width: 70%;">
		
		<div class="pestana_edita"> <span class="claro" onclick="toggle('nuevo_set'); "> <i class="fas fa-times"></i></span></div>
		
	   	<div class="content-wrapper-thin" style="background: #fff; "  >
	   		<div class="col-lg-12">

		   			        <div class="p-1  border-bottom  " style="padding: 10px 0 0 5px;">
				                   <h4>
					                   <span class="card-title-set text-success " style="float: left;" id="title_nombre">Agregar Set</span>
					                   
				                   		<div class="btn-group " role="group" aria-label="" style="margin-left: 25px; " >
					                   		
											<a href="#" class="btn btn-outline-neutral" onclick="save_new_set();" > 
									   			<i class="fas fa-save"></i> 
											</a>
		
		                      			</div>
                      								                   
					               </h4>
					               
							</div>
							
	                   		<div class="p-1 border-bottom grid-margin bg-light"  style="text-align: center; "> 
		                   		&nbsp;  <span id="new_set_status" class="text-light bg-info" style=" border-radius: 5px;" ></span>
	                   		</div>

				<div class="row">
					
	   			<div class="col-md-4 grid-margin " >	
				    <form name="form_up_set" method="post" action="?" id="form_up_set" enctype="multipart/form-data">   			
								<div class="form-group row compacted">
				                    <label for="edita_index" class="col-sm-3 col-form-label">Clave</label>
				                    <div class="col-sm-8">
				                        <input type="number" name="new_set_cve"  onblur="valida_nombre_set(this.value);" class="form-control"  id="new_set_cve" placeholder="Clave">
				                    </div>
				                </div>
			
								<div class="form-group row compacted">
				                    <label for="edita_id" class="col-sm-3 col-form-label">Nombre</label>
				                    <div class="col-sm-8">
				                        <input type="text" class="form-control" id="new_set_nombre" placeholder="Nombre">
				                    </div>
				                </div>
			                        						  
								<div class="form-group row compacted">
			                        <label for="edita_serie" class="col-sm-3 col-form-label">Tema</label>
			                        <div class="col-sm-8" >
				                        
			                              
				                          <select class="form-control" id="new_set_tema" onchange="cambia_foto_tema(); ">
				                              <?php echo $select_tema;  ?>
			                              </select>
			                              
			                              
			                              <!--
			                              <input class="form-control" id="new_set_tema" list="new_set_temab">
			                              <datalist id="new_set_temab">
			                              <?php echo $opt_select_list; ?>
			                              </datalist>
			                              
			                              -->
			                              
			                              
			                              <div class="col-sm-12 border" style="text-align:center; background: rgba(127, 127, 127,0.9); padding: 10px; height: 80px; border-radius: 5px; margin-top: 5px; " >
				                              <img class="prev_foto_minifig_mini" src='' style="max-width: 95%; max-height: 95%; margin-top: 10px;" id="show_tema" >
			                              </div>			                              
			                        </div>
			                    </div>
			                        
				            				                    
				</div>
				
				<div class="col-md-4 grid-margin " style="border: 0px solid #c40;" >
					
			                    <div class="form-group row compacted">
			                        <label for="edita_imagen" class="col-sm-3 col-form-label">Piezas</label>
			                    	    <div class="col-sm-8">
			                              <input type="number" min="100"  class="form-control" id="new_set_piezas" placeholder="Piezas"> 
			                            </div>
			                    </div>
			                    
			                    <!-- $row['nombre'].'-'.$row['piezas'].'-'.$row['cve_lego'].'-'.$row['id_tema'].'-'.$row['precio'].'-'.$row['anio_public']; -->
								<div class="form-group row compacted ">
					                <label for="edita_sku" class="col-sm-3 col-form-label">Precio</label>
					                   	<div class="col-sm-8">
					                            <input type="number" step="0.10"  class="form-control" id="new_set_precio" placeholder="Precio">
					                    </div>
					            </div>

								<div class="form-group row compacted ">
					                <label for="edita_sku" class="col-sm-3 col-form-label">Origen</label>
					                   	<div class="col-sm-8">
					                            <?php echo $select_origen;  ?>
					                    </div>
					            </div>

								<div class="form-group row compacted ">
					                <label for="edita_sku" class="col-sm-3 col-form-label">Año </label>
					                   	<div class="col-sm-8">
					                            <input type="number" min="1900"  class="form-control" id="new_set_anio" placeholder="año">
					                    </div>
					            </div>

								<div class="form-group row compacted ">
					                <label for="edita_sku" class="col-sm-3 col-form-label">No Minifiguras </label>
					                   	<div class="col-sm-8">
					                            <input type="number" min="0"  class="form-control" id="new_set_minifig" placeholder="Minifiguras Incluidas">
					                    </div>
					            </div>
					            
								<div class="form-group row compacted ">
					                <label for="edita_sku" class="col-sm-3 col-form-label">Imagen </label>
					                   	<div class="col-sm-8">
					                            <input type="text" disabled="disabled" class="form-control" id="new_set_foto" placeholder="jpg / png">
					                            <span class="txt-sm" id="notice_set" > </span>
					                    </div>
					            </div>	
				</div>
				
				<div class="col-md-4 grid-margin " >
					<!--
			                    <div class="form-group row compacted grid-margin ">
			                        <label for="edita_imagen" class="col-sm-6 ">Subir Imagen</label>
			                    	
				                        <input type="file" name="foto" class="col-sm-10 form-control " id="foto" placeholder="Imagen">
				                        <a class="btn btn-primary btn-block  text-light col-sm-10" id="btn_up_foto" onclick="save_foto(2);"> <i class="fa fa-arrow-circle-up"></i> Subir Foto</a>
				                        <input type="hidden" name="user_id" value="<?php echo $user_id?>" >
				                        <input type="hidden" name="tipo" value="2" >
			                    	</form>
			                    </div> 
			                   
			                    
			                    <div id="prev_image" class="row form-group compacted" style=" display: block; border: 0px solid #ccc;  ">
				                   
			                    </div>
			                    -->
				</div>
				
				</div>
				
			</div>
	   	</div>
	</div>
		
</div>


<!-- //////////////////////////               LISTA             //////////////////////////// -->

<div id="lista_set" class="hold_set_edita"  style="<?php echo $list_vis ?> "  >
	<div class="degrade_modal"></div>
	
	<div class="col-lg-12 body_modal semi-transparent" style="width: 50%;">
		
		<div class="pestana_edita" style="top: -5%;"> <span class="claro" onclick="toggle('lista_set'); "> <i class="fas fa-times"></i></span></div>
		
	   	<div class="content-wrapper-thin" style="background: #fff; "  >
	   		<div class="col-lg-12">

		   			        <div class="p-1  border-bottom  " style="padding: 10px 0 0 5px;">
				                   <h4>
					                   <span class="card-title-set text-success " style="float: left;" id="title_nombre">Lista de Sets</span>
					                   
				                   		<div class="btn-group " role="group" aria-label="" style="margin-left: 25px; " >
					                   													
											<span id="res_csv"></span>
		
		                      			</div>
                      								                   
					               </h4>
					               
							</div>
											
				<div class="row">
	   			<div class="col-md-8 grid-margin " style="height: 350px; max-height: 350px; overflow: scroll; overflow-x: hidden; overflow-y: auto;"  >	
				   
				    <?php echo $list_sets; ?>        				                    
				</div>
				
				<div class="col-md-4 grid-margin " style="height: 350px; max-height: 350px; border:0px solid #c30; " >
				</div>
				</div>

				
			</div>
	   	</div>
	</div>
		
</div>



<?php 
	
			
	}
	
	if($lista==1){
		echo'	
<script type="text/javascript">
	genera_csv(1);	
</script>		
		';
		
	}

	  ?>