<?php

	
$user_perfil = intval($GLOBALS['user_perfil']);
$user = $_SESSION['clave_user'];	
//$user = $_SESSION['clave_user'];
//var_dump($user);

	if($user==0 or $user==""){
			
		echo '<meta http-equiv = "refresh" content = "0; url = http://shelf.bricksidemx.com/collector/index.php?access=1" />';
			
	}else{
		
		if($user_perfil==0 or $user_perfil==""){
			//echo '<meta http-equiv = "refresh" content = "0; url = http://shelf.bricksidemx.com/collector/index.php" />';
		}

	

$order = $_GET['order'];
$pos = $_GET['position'];
//$user_idioma = $GLOBALS['user_idioma']; 
	





if($perfil_user == ""){
	$user_per=0;
	$class_sesion = 'no-show';
}else{
	$user_per = $GLOBALS['user_perfil'];
	$class_sesion = '';
}



$clave_lego = $_GET['ref']; 

$total_serie = get_total_minifig($clave_lego);
		
	//	echo 'No hay registros que mostrar.';
		//include("inicio.php"); 
				if(isset($clave_lego) == FALSE){ // si no hay clave muestra el grid de series
				
				$mnu_cve =  $_GET['mnu'];
				
				$btn_filtro = '<span class="btn btn-secondary" onclick="toggle(\'filtros_grid\')"> <i class="fa fa-filter"></i> Ver Filtros </span>';
	             
	             $btns_herramientas = $btn_filtro ;
	             
	             $herraminetas = '
	             <div class="col-md-12" >
			        <div class="row">
			        <div class="btn-group" role="group" aria-label="">
				         '.$btns_herramientas.'
				     </div>
				     
				     <div class="btn-group" role="group" id="filtros_grid" class="" style="display:; ">
				     
				     
                    <a class="btn btn-outline-neutral" href="index.php?mnu='.$mnu_cve.'&order=1'.$position.'&ref='.$referencia.'&cve=1 "><i class="fa '.$fa_ico1.'" ></i> Serie </a>
					<a class="btn btn-outline-neutral" href="index.php?mnu='.$mnu_cve.'&order=2'.$position.'&ref='.$referencia.'&cve=1 "><i class="fa '.$fa_ico2.'" ></i> Tipo</a>
					<a class="btn btn-outline-neutral" href="index.php?mnu='.$mnu_cve.'&order=4'.$position.'&ref='.$referencia.'&cve=1 "><i class="fa '.$fa_ico4.'" ></i> Nombre Serie</a>
					<a class="btn btn-outline-neutral" href="index.php?mnu='.$mnu_cve.'&order=3'.$position.'&ref='.$referencia.'&cve=1 "><i class="fa '.$fa_ico3.'" ></i> No de Figuras </a>
					<a class="btn btn-outline-neutral" href="index.php?mnu='.$mnu_cve.'&order=5'.$position.'&ref='.$referencia.'&cve=1 "><i class="fa '.$fa_ico5.'" ></i> Estado Colección </a>

				     </div>            
	             </div>
	             </div>';  
					
					//echo $herraminetas;
					
					
	include("inicio.php"); 
					//$res .= 'NNNNNNNNNNNNNNO';
				
				
			}elseif(isset($clave_lego) == TRUE){ // Si existe la variable clave muestra la serie.
					
					//$res .= 'SSSSSSSSSSSSSSSI';
                    $permiso_ver_serie = get_permiso_serie($clave_lego,$user);
                   // var_dump($clave_lego);

                    
						$status_serie = get_status_serie($clave_lego);

			
						//var_dump($status_serie);
			
						if( $user_perfil==1){
							
                            if($permiso_ver_serie==1){

                                if($status_serie==0 or $status_serie==2 or $status_serie==3 or $status_serie==4){
                                    $bandera_ver_serie = 1; 
                                    
                                }elseif($status_serie==1){
                                    $bandera_ver_serie = 1;
                                    
                                }elseif($status_serie==99){
                                    $bandera_ver_serie = 0;                                    
                                }

                            }else{
                                $bandera_ver_serie = 0; 
                            }
							
						}elseif($user_perfil!=1){
				
                            //verificar si no es una serie bloqueada 
                           // $permiso_ver_serie = get_permiso_serie($clave_lego,$user); 


                            if($permiso_ver_serie==1){

                                if($status_serie==0){
                                    $bandera_ver_serie = 0; 
                                    
                                }elseif($status_serie==1){
                                    $bandera_ver_serie = 1; 
                                    
                                }elseif($status_serie==2){
                                    $bandera_ver_serie = 0; 
                                    
                                }elseif($status_serie==3){
                                    //$bandera_ver_serie = 0; 

                                $f_serie = get_flanzamiento_serie($clave_lego);
                                
                                $f_hoy = date("Y-m-d");
                                    
                                    if($f_serie == 99){
                                        $bandera_ver_serie = 0;
                                    }elseif($f_serie > $f_hoy){
                                        $bandera_ver_serie = 1; 
                                    }else{
                                        $bandera_ver_serie = 1;
                                    }
                                                                    
                                }elseif($status_serie==4){
                                    $bandera_ver_serie = 0; 
                                    
                                }elseif($status_serie==99){
                                    $bandera_ver_serie = 0; 
                                }

                            }else{
                                $bandera_ver_serie = 0;
                            }
                                

							
						}else{
							$bandera_ver_serie = 0;
						}
				
							//var_dump($bandera_ver_serie); 
			 
			
						if($bandera_ver_serie == 1){
									
							$view = 1;
							$ress =  get_cards_minifigures($clave_lego, $view); 

                            $res = '<div class="scrollable" style="overflow-x:hidden;" >'.$ress.'</div>';
							
						//	$res .= "<script type=\"text/javascript\" > drag_drop(); </script>";
						
								
						}elseif($bandera_ver_serie == 0){
									
							if(isset($clave_lego) == TRUE){
								
								$res =  '<div class="col-lg-12 " style="padding: 10px; text-align: center; " id="stat_serie" >

								<h1 class="text-muted" style="font-size: 80px;">
								
								<i class="em em-thinking_face" aria-role="presentation" aria-label="THINKING FACE"></i>
								</h1>
								
									<br>
								<span class="col-md-10 text-neutral center" style="font-size:24px; font-weight:300; font-family: \'Open Sans Condensed\', sans-serif; "> 
									¡Opps!<br> 
									Este perfil no tiene permisos para visualizar esta página.
									
									
								</span>
												<span class="card-title-fig text-neutral no-show" style="text-align: center; padding: 2px 10px; border-radius: 30px; ">
												<i class="fas fa-retweet fa-fw"></i>
												Sera redireccionado en 10 segundos. 
												</span> 
											
											
										</div>'; 
						$res .= '
								<script>
								setTimeout_(function() {
								  window.location.href = "index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6";
								}, 10000);
								</script>
						
						'; 			            
						}
				} // if clave lego true
		}
	}
	$dbh->close();
	
	$referencia =$_GET['ref'];
	
	$ids = get_ids_current($referencia);
	
	/// VErifica sila sesion esta creada para desplegar info: 
	
?>

<input type="hidden" name="tuser" id="total_serie" alt="Total  Coleccionados" value="<?php echo $total_collect; ?>" >
<input type="hidden" name="tserie" id="tserie" value="<?php echo $total_serie; ?>" >
<input type="hidden" name="user" id="serie_act"  value="<?php echo trim($referencia);  ?>" >
<input type="hidden" name="user" id="user" alt="Usuario" value="<?php echo $user;  ?>" >

<input type="hidden" name="user" id="ids_current"  value="<?php echo $ids;  ?>" >
<?php
	//todas_minifig.php
	$mnu_cve = $_GET['mnu'];
	

	
	?>

<div id="debug_premium"> </div>

<?php 	echo $res;	?>

	
	<div id="item_cards" class="row grid-margin" >		
	</div>

 
 <?php 
	
// boton para generar link. 
	
	$mnu = $_GET['mnu'];
	$cve = $_GET['cve'];
				
				$id_user_b = $GLOBALS['user'];
				$estado_link = get_estatus_link($id_user_b);
				
				$modal_link = $link_site.'mnu='.$mnu.'&cve='.$cve.'&mod=1'; 
				
				if($estado_link==0 or $estado_link==2 or $estado_link==''){
					
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


               


