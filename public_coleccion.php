

<?php
include("minifigures.php");
include("globals.php");

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}
///////////////// 

	$token = $_GET['token'];

		if ($dbh->connect_error) {
		    die("Connection failed: " . $dbh->connect_error);
		}
		$q = "SELECT * FROM token_user WHERE token = '$token' and estado = 1;";// preparando la instruccion sql

		//var_dump($q);

    $result= $dbh->query($q);
    if ($result->num_rows > 0) {
        $row= $result->fetch_assoc();
       
        $user_id = $row['id_user'];

		//var_dump($user_id);
        
        $user_info = busca_user($user_id);
		//var_dump($user_info);

		

        $data_user = explode('--',$user_info);

		if($data_user[1]==''){
			$nombres = $data_user[3];
		}else{
			$nombres = $data_user[1];
		}
        
        
        
        
	                        
	}else{
		$user_id = 0;
	}

//var_dump($user_id);

/////// 

	$qset = "SELECT * FROM sets where id_user = $user_id and estado = 1 $order_q order by fecha_add desc ";// preparando la instruccion sql
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
	                        
	                       $data = getinfotema($rowb['id_tema']); 
	                      // var_dump($data);
	                      
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
			                   $fontsize = '16px'; 
		                   	}elseif($largo_title > 35){
			                   $fontsize = '12px'; 
		                   	}

		                    
							if($rowb['estado']==0){
								$tarjetas_ini .=''; 
								
								$ico_edo = '';
								
								$btn_show = '';
									
	                    	}else{
		                    	

								$fotobx = valida_foto_tipo($rowb['cve_lego'],1);

	                     
								$ico_edo = '';

								$tema_logo_path = 'assets/images/logos/'.$s_logo;
									         
									                     
								$btn_show = '';
								
												//background:linear-gradient(360deg, rgba('.$color.',0.7) 30%, rgba('.$color.',0) 90%);			
	                     
								$tarjetas_ini .= '
								<card class="col-md-4 grid-margin stretch-card " id="set-'.$rowb['id'].'"  style="height:60%;" >
									<div class="card shelf_card" style="border: 1px solid rgba(200,200,200,0.9); border-radius:5px; background: #fff; " >
										
									<div class="set_hover_imagen  " > 
										<img src="data:image/png;base64,'.base64_encode(file_get_contents($fotobx)).'" style=" position: absolute; max-heigth: 99%; max-width:75%; height:80%; width:auto; right: 3%; bottom: 8px;" >
										<input type="hidden" id="foto_set_'.$rowb['id'].'" value="'.$fotobx.'">
									</div>
										
									<div class="set_back_color" id="" style="background:linear-gradient(120deg, rgba(30,30,30,0.2) 40%, rgba(50,50,50,0) 120%); height:'.$h.'%; " >
									</div>
										
									<div class="set_hold_info" style="  ">
									
	
										<div class="set_logo_tema" style="" >
											<img src="data:image/png;base64,'.base64_encode(file_get_contents($tema_logo_path)).'" style="height: 30px;  " >
											
										</div>
										
										<div class="set_data_row set_detail_font" style="margin-top: 3px; font-weight: 300;  " >
											<span class="text-muted set_info set_txt_min" >'.$rowb['cve_lego'].' - '.$rowb['piezas'].' pzs. </span>
										</div>
										
										<div class="set_data_row set_title_font"  >
											<span class="text-muted set_info " style="font-size: '.$fontsize.'; line-height: '.$fontsize.';  " > 
											'.$rowb['nombre'].' '.$largo_titl.'
											</span>
										</div>									
										
						            </div>
						                
										<div class="hold_icons_set " style=" border-left: 0px solid rgba(255,255,255,0.2); 	box-shadow: none; -webkit-box-shadow:none; -moz-box-shadow: none; " >
												
												<span class=" text-muted text-sm" style="margin-bottom:5px; text-align: center; display:block; filter:opacity:30%;">'.$num.'</span>
												
												'.$admin_tools.$ico_edo.'
												
												<span class="'.$class_text.'" style="position: absolute; bottom: 1px; right: 5px; display: block; font-size: 12px;  "> 
												'.$anio.' 
												</span>
												
						                </div> 
						                

					                    
										<div class="card-body card_body_main" style="border: 0px solid #ca0;  margin-left: 0px; z-index: 990;  " >
					                    	<h4 class="card-title card_title_main">
												<span id="">
													<h4 class="title_card">  </h4>
												</span> 
											</h4>
											<br>
											<br>
					                    </div>				                    

					                    
					                    
									</div>									
								</card>'; 
								
								

	                    
	                    	} // else estado
							
							$num = $num +1;
	                    }// while
	                   
	                
	                   
		}else{ // resultados del query 
			$tarjetas_ini = '
			
			<div class="col-lg-12 center" >
			<span class="text-neutral"> Sin sets en la colección </span>
			</div>
			';
		}

/////

if($user_id != 0){
//	echo 'Hola mundo';

//$display = 'Hola Mundo';
$display = $tarjetas_ini;
}elseif ($user_id==0){

//echo '<div class="scrollable" style="height:100%;" >'.$tarjetas_ini.'</div> hola mundo ';
	//$display = 'Adios Mundo';
	$display = $tarjetas_ini;
}

 
 
 
?>



     
              
               <div class="col-md-12 grid-margin center " style="margin-top: 20px;">
                  <div class="p-3 " style="padding-bottom: 0px;" >
	                    
						<div class="col-md-12 text-muted title_sec " style="width: 50%; padding: 1rem 1rem  0rem 1rem; font-size:2rem; margin: 10px auto;">COLECCIÓN DE <span class="text-success"> <?php echo $nombres; ?></div>
						<div class="text-muted" style="padding: 0rem 1rem  1rem 1rem;"><?php echo $GLOBALS['sitio_web']; ?></div>
						
                  </div>
				  
                 
              </div>
              

                           
              <div class="col-md-12 grid-margin">
                
                  <div class="card-body">
	                  
	                 <?php echo $display; ?>
	                 
                  </div>
                
              </div>
       

              

