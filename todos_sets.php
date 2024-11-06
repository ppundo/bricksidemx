<?php


///// Vista lista 
$lista = $_GET['lista'];
$modal = $_GET['mod'];


if($lista==1){
	$list_vis = 'display:block;';

}else{
	$list_vis = 'display:none;';

}

if($modal==1){
	$mod_vis = 'display:block;';

}else{
	$mod_vis = 'display:none;';

}
/////


	$perfil_user = $GLOBALS['user_perfil'];
	$user = $_SESSION['clave_user'];	
//$user = $_SESSION['clave_user'];
//var_dump($user);

	if($user==0 or $user==""){
			
		echo '<meta http-equiv = "refresh" content = "0; url = '.$link_site.'?access=1" />';
			
	}else{
		
		if($user_perfil==0 or $user_perfil==""){
			}
			



///////////////// 
$user_id = $GLOBALS['user'];
//echo $user_id; 
$user_perfil = $GLOBALS['user_perfil'] ;
$user_masterpass = $GLOBALS['user_masterpass'] ;


//var_dump($id_tema); 

$order = $_GET['order'];
$pos = $_GET['position'];

	
	if($order == 0 or $order==""){
		
		$order_q = 'order by id';
		$fa_ico1 = 'fa-sort';
		$fa_ico2 = 'fa-sort';
		$fa_ico3 = 'fa-sort';
		$fa_ico4 = 'fa-sort';
		$fa_ico5 = 'fa-sort';
		
	}elseif($order == 1){
	
		if($pos == 1){
			
			$order_b = ' asc';
			$position = '&position=2'; //asecendente
			$fa_ico1 = 'fa-sort-down'; 
			 
		}else{
			
			$order_b = ' desc';
			$position = '&position=1'; 
			$fa_ico1 = 'fa-sort-up';
		}
		//$fa_ico1 = 'fa-sort';
		$fa_ico2 = 'fa-sort';
		$fa_ico3 = 'fa-sort';
		$fa_ico4 = 'fa-sort';
		$fa_ico5 = 'fa-sort';
		
		$order_q = 'order by nombre'.$order_b;
		
	}elseif($order == 2){
		
		if($pos == 1){
			
			$order_b = ' desc';
			$position = '&position=2'; //asecendente
			$fa_ico2 = 'fa-sort-down'; 
			 
		}else{
			
			$order_b = ' asc';
			$position = '&position=1'; 
			$fa_ico2 = 'fa-sort-up';
		}
		$fa_ico1 = 'fa-sort';
		//$fa_ico1 = 'fa-sort';
		$fa_ico3 = 'fa-sort';
		$fa_ico4 = 'fa-sort';
		$fa_ico5 = 'fa-sort';
		
		$order_q = 'order by cve_lego'.$order_b;
		
	}elseif($order == 3){
		
		if($pos == 1){
			
			$order_b = ' desc';
			$position = '&position=2'; //asecendente
			$fa_ico3 = 'fa-sort-down'; 
			 
		}else{
			
			$order_b = ' asc';
			$position = '&position=1'; 
			$fa_ico3 = 'fa-sort-up';
		}

		$fa_ico1 = 'fa-sort';
		$fa_ico2 = 'fa-sort';
		//$fa_ico3 = 'fa-sort';
		$fa_ico4 = 'fa-sort';
		$fa_ico5 = 'fa-sort';
		
		$order_q = 'order by id_tema'.$order_b;
		
		
	}elseif($order == 4){
		
		if($pos == 1){
			
			$order_b = ' desc';
			$position = '&position=2'; //asecendente
			$fa_ico4 = 'fa-sort-down'; 
			 
		}else{
			
			$order_b = ' asc';
			$position = '&position=1'; 
			$fa_ico4 = 'fa-sort-up';
		}

		$fa_ico1 = 'fa-sort';
		$fa_ico2 = 'fa-sort';
		$fa_ico3 = 'fa-sort';
		//$fa_ico4 = 'fa-sort';
		$fa_ico5 = 'fa-sort';
		
		$order_q = 'order by anio_public'.$order_b;
	
	}elseif($order == 5){
		
		if($pos == 1){
			
			$order_b = ' desc';
			$position = '&position=2'; //asecendente
			$fa_ico5 = 'fa-sort-down'; 
			 
		}else{
			
			$order_b = ' asc';
			$position = '&position=1'; 
			$fa_ico5 = 'fa-sort-up';
		}

		$fa_ico1 = 'fa-sort';
		$fa_ico2 = 'fa-sort';
		$fa_ico3 = 'fa-sort';
		$fa_ico4 = 'fa-sort';
		//$fa_ico5 = 'fa-sort';
		
		$order_q = 'order by fecha_add'.$order_b;
	
	}

if($user==2){
	$limit = ' limit 50 ';
}else{
	$limit = '';
}
	
	$qset = "SELECT * FROM sets where id_user = $user_id and estado = 1 $order_q ".$limit ;// preparando la instruccion sql
	//echo $qset; 
	
	
	    $result= $dbh->query($qset);
	  //  var_dump($result); 
    if ($result->num_rows > 0) {
	  
	//echo   $result->num_rows; 
	$id_tema = 1; 
	  
	  $path_set = 'assets/images/sets/';
	  
	    $tarjetas_ini = ""; 
	    $num = 1; 
                        
		while($rowb= $result->fetch_assoc()){
	                        


////////////////


	$len_user = strlen($user_id);

				if($len_user==1){
					$nvo_user_id = '0'.$user_id;
				}else{
					$nvo_user_id = $user_id;
				}

	                        
			$len_id_serie = strlen($rowb['id_tema']);
			//var_dump($len_id_serie);

				if($len_id_serie==1){
					$nvo_serie_id = '00'.$rowb['id_tema'];
				}elseif($len_id_serie==2){
					$nvo_serie_id = '0'.$rowb['id_tema'];
				}else{
					$nvo_serie_id = $rowb['id_tema'];
				}

	

			$len_cve = strlen($rowb['cve_lego']);
			//var_dump($len_id_serie);

				if($len_cve==5){
					$nvo_cve = '0'.$rowb['cve_lego'];
				}elseif($len_cve==4){
					$nvo_cve = '00'.$rowb['cve_lego'];
				}elseif($len_cve==3){
					$nvo_cve = '000'.$rowb['cve_lego'];
				}else{
					$nvo_cve= $rowb['cve_lego'];
				}

$cve_barcode = $nvo_cve.''.$nvo_serie_id.''.$nvo_user_id;

///////////////

	                       $data = getinfotema($rowb['id_tema']); 
	                      
							$datab = explode('|', $data);
							
							$s_nombre = $datab[0];
							$s_color = $datab[1];
							$s_logo = $datab[2];
	                        
	                      // var_dump($data); 

	                        
	                        $no_piezas = $rowb['piezas'];
	                        
	                        
	                        
	                        
		                    $search = strtolower($rowb['nombre']).' '.$rowb['cve_lego'].' '.strtolower($s_nombre).' '.$rowb['anio_public'].' ';
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
							
							if($rowb['anio_public']=='0000'){
								$anio = ''; 
							}else{
								$anio = $rowb['anio_public']; 
							}
		                    
		                    
		                    if($user_perfil==1){
								$admin_tools = '
								
								
								<span class="ico-option ico_set '.$class_text.'"  onclick="elimina_set(\''.$rowb['id'].'\') " > 
									<i class="fas fa-trash" ></i>
								</span>
								';
								
								//$admin_tools =''; 
								
							}else{
								$admin_tools = '';
							}
							

															
	                    
		                    $classes .= ' 
		                    .set_'.$rowb['cve_lego'].'{
		                    background: #fff; 
		                    }';
		                    
		                   // $call_api = apibrickowl($rowb['cve_lego']);
		                   // var_dump($call_api); 
		                   $largo_title = strlen($rowb['nombre']); 
							
					if($largo_title <= 15){
			                   $fontsize = '20px';
		                   	}elseif($largo_title > 15 and $largo_title <= 35){
			                   $fontsize = '14px'; 
		                   	}elseif($largo_title > 35){
			                   $fontsize = '12px'; 
		                   	}

		                    
							if($rowb['estado']==0){
								$tarjetas_ini .=''; 
								
								$ico_edo = '';
								
								$btn_show = '';
									
	                    	}else{
		                    	
								/*$file = $path_set.$rowb['item_foto'];
								
								if(file_exists($file)) {
								       //echo "The file exists";
								       $foto = $rowb['item_foto'];
								       $path_set_b = 'assets/images/sets/';
								} else {
								       //echo "The file does not exist";
								       $foto = 'noimage.png';
								       $path_set_b = 'assets/images/sets/';
								}*/								
	                     
								$fotobx = valida_foto_tipo_adv($rowb['cve_lego'],1);
	                     
								$ico_edo = '';
								
								$path_logo = 'assets/images/logos/'.$s_logo;
								//src="data:image/png;base64,'.base64_encode(file_get_contents($fotobx)).'" 
									                     
								$btn_show = '';
								
								$list_sets .= '
								<div class="col-sm-12 p-1 border-bottom " style="text-align:left; " > 
								<span class="text-muted text-sm" >'.$num.'. [ '.$s_nombre.' ] - '.$rowb['nombre'].' </span> 
								</div>';
								
	                     
								$tarjetas_ini .= '
								<card class="col-md-3 grid-margin stretch-card " id="set-'.$rowb['id'].'" searchable="'.$search.' '.$cve_barcode.'" >
									<div class="card shelf_card" style="border: 1px solid rgba(200,200,200,0.9); border-radius:5px; background: #fff; " >
										
									<div class="set_hover_imagen  " > 
										<img src="data:image/png;base64,'.base64_encode(file_get_contents($fotobx)).'"  style=" position: absolute; max-heigth: 99%; max-width:75%; height:80%; width:auto; right: 20%; bottom: 8px;" >
										<input type="hidden" id="foto_set_'.$rowb['id'].'" value="'.$fotobx.'">
									</div>
										
									<div class="set_back_color" id="" style="background:linear-gradient(120deg, rgba('.$color.',0.9) 40%, rgba('.$color.',0.4) 120%); height:'.$h.'%; " >
									</div>
										
									<div class="set_hold_info" style="  ">
										
										<div class="set_logo_lego" style="border-radius: 3px; border: 1px solid '.$class_color.';  " ></div>
										
										<div class="set_logo_tema" style="" >
											<img src="data:image/png;base64,'.base64_encode(file_get_contents($path_logo)).'"  style="height: 20px;  " >
											
										</div>
										
										<div class="set_data_row set_detail_font" style="margin-top: 3px; font-weight: 300;  " >
											<span class="'.$class_text.' set_info set_txt_min" >'.$rowb['cve_lego'].' - '.$rowb['piezas'].' pzs. </span>
										</div>
										
										<div class="set_data_row set_title_font"  >
											<span class="'.$class_text.' set_info " style="font-size: '.$fontsize.'; line-height: '.$fontsize.';  " > 
											'.$rowb['nombre'].' '.$largo_titl.'
											</span>
										</div>									
										
						            </div>
						                
										<div class="hold_icons_set" style="background:linear-gradient(360deg, rgba('.$color.',0.7) 30%, rgba('.$color.',0) 90%); border-left: 1px solid rgba(255,255,255,0.2); " >
												
												<span class="'.$class_text.' text-sm" style="margin-bottom:5px; text-align: center; display:block; filter:opacity:30%;">'.$num.'</span>
												
												'.$admin_tools.$ico_edo.'
												
												<span class="'.$class_text.'" style="position: absolute; bottom: 1px; right: 5px; display: block; font-size: 12px;  "> 
												'.$anio.' 
												</span>
												
						                </div> 
						                
										<div class="card-body card_body_main" style="border: 0px solid #ca0;  margin-left: 0px; z-index: 80;   " >
					                    	<h4 class="card-title card_title_main">
												<span id="">
													<h4 class="title_card">  </h4>
												</span> 
					                    </div>
					                    
					                    <input type="hidden" value="'.$cve_barcode.'"> 

					                    
					                    
									</div>									
								</card>'; 
	                    
	                    	} // else estado
							
							$num = $num +1;
	                    }// while
	                   
	                
	                   
		}else{ // resultados del query 
			$tarjetas_ini = '
			
			<div class="col-lg-12 center" >
			<span class="text-neutral"> No se encontraron sets registrados. <br> <span>'.$qset.'</span> </span>
			</div>
			';
		}
	
			//	echo $q; 
			echo '<style>'.$classes. '</style>';
			
			$mnu_cve = $_GET['mnu'];
			
			echo'
			<div id="filtros" class="col-md-12 border bg-light grid-margin" style="display:none;">
				<div class="btn-group" role="group" aria-label="Basic example" style="">
					<span class="btn btn-neutral" > Ordenar por:</span>
					<a class="btn btn-outline-neutral" href="index.php?mnu='.$mnu_cve.'&order=1'.$position.'"><i class="fa '.$fa_ico1.'" ></i> Nombre</a>
					<a class="btn btn-outline-neutral" href="index.php?mnu='.$mnu_cve.'&order=2'.$position.'"><i class="fa '.$fa_ico2.'" ></i> Clave</a>
					<a class="btn btn-outline-neutral" href="index.php?mnu='.$mnu_cve.'&order=3'.$position.'"><i class="fa '.$fa_ico3.'" ></i> Tema</a>
					<a class="btn btn-outline-neutral" href="index.php?mnu='.$mnu_cve.'&order=4'.$position.'"><i class="fa '.$fa_ico4.'" ></i> Año</a>
					<a class="btn btn-outline-neutral" href="index.php?mnu='.$mnu_cve.'&order=5'.$position.'"><i class="fa '.$fa_ico5.'" ></i> Fecha Agregado</a>
				</div>
			</div>
				'; 
			
                echo '<div class="scrollable" >'.$tarjetas_ini.'</div>';
	
	////////////////--- validacion perfil 
	
			
	}
	
	///////
?>

<!-- //////////////////////////               LISTA             //////////////////////////// -->

<div id="lista_set" class="hold_set_edita"  style="<?php echo $list_vis ?> "  >
	<div class="degrade_modal"></div>
	
	<div class=" col-lg-12 body_modal semi-transparent " style="margin-top: 20px; margin-bottom: 10px; width: 40%; padding:0px; height:90%;">
	
    <h5 class="col-md-12 p-2 title_sec_sm bg-head " style="padding:0px; border-radius:5px 0 0 0;"> 
            
            <i class="fa-solid fa-sliders"></i> <b> Lista de Todos los Sets </b>
    
            <div class="btn-group" role="group" style="float:right; border:none;"> 
                <button type="button" onclick="toggle('lista_set')" class=" btn btn-outline-primary  text-clear" style="border:0px solid #ccc;"> 
                    <i class="fa-solid fa-times fa-lg"></i>
                </button>
            </div> 
     </h5>  


            <div class="p-1 border-bottom center " style="padding: 10px 0 0 5px;">  
                <div class="row">
                    <div class="col-md-12">                                 
                            <div class="btn-group" role="group" aria-label="" style="float:left; " >   
                                <span id="res_csv" style="margin:0px auto;"></span>  
                            </div>  
                    </div>
                </div>
            </div>
	
	   	<div class="content-wrapper-thin" style="background: #fff; "  >
	   		<div class="col-lg-12">
											
				<div class="row">
	   			<div class="col-md-12 grid-margin " style="height: 300px; max-height: 300px; overflow: scroll; overflow-x: hidden; overflow-y: auto;"  >	
				   
				    <?php echo $list_sets; ?>        				                    
				</div>
				
				<div class="col-md-6 grid-margin " style="height: 350px; max-height: 350px; border:0px solid #c30; " >
				</div>
				</div>

				
			</div>
	   	</div>
	</div>
		
</div>

<?php 
	
// boton para generar link. 
	
	$mnu = $_GET['mnu'];
	$cve = $_GET['cve'];
				
				$id_user_b = $GLOBALS['user'];
				$estado_link = get_estatus_link($id_user_b);
				
				$modal_link = $link_site.'?mnu='.$mnu.'&cve='.$cve.'&mod=1'; 
				
				if($estado_link==0 or $estado_link==2){
					
					$link = '
					
						<button style="" onclick="genera_enlace(\''.$id_user_b.'\');"  class="btn btn-icons btn-rounded btn-inverse-secondary"> 
							<i class="fa fa-toggle-off fa-md"></i> 
						</button>
						
						<input type="hidden"  id="url_user" class="form-control text-primary" style="border-radius:5px; background: transparent; width: 50%; margin-top:2px; " ></input>
						<input type="hidden" id="token_user_current" class="form-control text-primary" value="0" >
					';
					
					$disp_link = 'none';
					
					$nlace = '';
					
					$btn_link = '
					<div class="col-md-12 row ">
						<label class="text-muted col-form-label" style=""> <i class="fa fa-user"></i> </label> 
						
						<a class="" href="#" onclick="genera_enlace(\''.$id_user_b.'\');" style="float:right; margin:6px 10px;" > 
							<span class="text-secondary"><i class="fa fa-toggle-off fa-md"></i></span>
						</a> 
						
						<input type="hidden" id="token_user_current" class="form-control text-primary" value="0" >
						
						<span class="text-primary" id="link_ext" style="margin:6px 10px;"> </span>
					</div>
					
					<a href="'.$modal_link.'" style="float:right; margin:6px 10px;" ><i class="fa fa-link"  ></i></a>
					 ';
					 
					 $url = '';
					 
				}elseif($estado_link==1){

					$token = get_info_link($id_user_b);
					$pag = md5('public_coleccion');
					$url = $link_site_public.'mnu='.$pag.'&token='.$token;
					
					$disp_link = 'block'; 
					
					$link = '
					
						<button style="" onclick="genera_enlace(\''.$id_user_b.'\');"  class="btn btn-icons btn-rounded btn-inverse-secondary"> 
							<span class="text-success"> <i class="fa fa-toggle-on fa-md"></i> </span>
						</button>	
						
												
						<input type="hidden" id="token_user_current" class="form-control text-primary" value="'.$token.'" >
						
					';
					
					$nlace = '

						<a style="" target="_new" href="'.$url.'" class="btn btn-icons btn-rounded btn-inverse-secondary"> 
							<i class="fa fa-external-link-square-alt"></i> 
						</a>					
					'; 
					
					

					
					$btn_link = '
					<div class="col-md-12 row ">
						<label class="text-muted col-form-label" style=""> <i class="fa fa-user-check"></i> </label>					
					
						<a class="" href="#" onclick="genera_enlace(\''.$id_user_b.'\');" style="float:right; margin:6px 10px;" >
							<span class="text-success"><i class="fa fa-toggle-on fa-md"></i></span> 
						</a> 
						
						<input type="text" autocomplete="off" id="url_user" class="form-control text-primary" value="'.$url.'" style="border-radius:5px; background: transparent; width: 50%; margin-top:2px; " >
						
						<input type="hidden" id="token_user_current" class="form-control text-primary" value="'.$token.'" >
						
						<span class="text-primary" id="link_ext" style="margin:6px 10px;">
							<a href="#" class="text-primary"> <i class="fas fa-copy"></i> </a>
						</span>
												
						<span class="text-primary" id="link_ext" style="margin:6px 10px;">
							<a target="_new" href="'.$url.'" class="text-primary"> <i class="fas fa-external-link-square-alt"></i> </a>
						</span>
					</div>
					
					<a href="'.$modal_link.'" style="float:right; margin:6px 10px;" ><i class="fa fa-link"  ></i></a>
					';
				}
		
		
		//termina genera link 

?>

<!-- //////////////////////////               Modal Link             //////////////////////////// -->

<div id="link_sets" class="hold_set_edita"  style="<?php echo $mod_vis ?>; text-align: center;"  >
	<div class="degrade_modal"></div>
	
	<div class="pestana_edita" style="top: -5%;"> <span class="claro" onclick="toggle('link_sets'); "> <i class="fas fa-times"></i></span></div>
	
               <div class="col-md-6 grid-margin" style="margin-top: 30px; left: 50%; margin-left: -25%; border-radius: 20px; ">
                <div class="card" style="text-align: center; border-radius: 5px; padding: 3px 10px;">
                  <div class="row p-3 " style="text-align: center; border-radius: 20px; ">
                    
                    <button style="" class="btn btn-icons btn-rounded btn-inverse-secondary" style="margin-right: 20px;"> 
							<i class="fa fa-user-plus"></i> 
					</button>
                    
                    
                    <h3 class="card-title mb-0 text-muted" style="position: relative; float: left;  margin-top: 5px; margin-left: 10px;"> Compartir con personas </h3><br>
 
                      <div class="col-md-3 " style="position: absolute; right: 4%; top: 30%; float: right;">
	                    
						<?php echo $link;
							echo $nlace;
							 ?>
						

						
	                     
                     </div>
                                        
                  </div>                  
                </div>
              </div>

               <div class="col-md-6 grid-margin" style="margin-top:; left: 50%; margin-left: -25%; display: <?php echo $disp_link; ?>; ">
                <div class="card" style="text-align: center; border-radius: 5px; padding: 3px 10px;">
                  <div class="row p-3" style="text-align: center;">
	                  
	                 
                    <button style="" class="btn btn-icons btn-rounded btn-inverse-secondary" style="border-radius: 55px; padding: 5px 13px; margin-right: 10px;"> 
							<i class="fa fa-link"></i> 
					</button>
						                  
                    
                    <h3 class="card-title mb-0 text-muted grid-margin" style="position: relative; float: left;  margin-top: 5px; 5px; margin-left: 10px;"> Enlace </h3>
                     

                    <br>
                    <div class="col-md-12" style="margin-top: 20px;">
	                    <input id="url_user" type="text" style="border-radius: 5px; padding: 0 5px;" readonly class="form-control col-md-8 txt_link text-primary " value="<?php echo $url; ?>"> 
	                    <a class="btn btn-outline-secondary btn-md text-primary" style="padding: 7px 10px; font-size: 18px;"> Copiar Enlace</a>
                    </div>
                    
                  </div>                  
                </div>
              </div>

		
</div>



<?php  
	
	if($lista==1){
		echo'	
<script type="text/javascript">
	genera_csv(2);	
</script>		
		';
		}
	
	 ?>