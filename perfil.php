
<?php 
	
//$correo_cifrado = $_GET['item'];
//var_dump($correo_cifrado);

$info_user=busca_user($GLOBALS['user']);
//$datos_encontrados= $error.'--'.$nombre.'--'.$correo.'--'.$user_name.'--'.$foto.'--'.$cve.'--'.$row['correo_cifrado'];

$data_user = explode('--', $info_user);
$correo_cifrado = $data_user[6];
$fecha_act = $data_user[7];
//////////////////////////////////////////



//////////////////////////

$info_user = busca_user_cifrado($correo_cifrado); //$datos_encontrados= $error.'-'.$nombre.'-'.$correo.'-'.$user_name.'-'.$foto.'-'.$row['id'];	

$data_userb = explode('|', $info_user);
$correo = $data_userb[2];
$userb = $data_userb[3];
$foto = $data_userb[4];
$id_user = $data_userb[5];
$id_db = $data_userb[8];


$tam_foto = strlen($foto); 
		
						$sub = substr($foto,0,4);
	
							//if($tam_foto>20){
							if($sub == 'http'){
								
								$pic = $foto;
								
							}elseif($foto == ''){
								$pic = 'assets/images/faces/profile/face0.png';
							}else{
													
								
								
										$file_p = 'assets/images/faces/profile/'.$foto;
																	
										if(file_exists($file_p)) {
										       //echo "The file exists";
										       $pic = 'assets/images/faces/profile/'.strtolower($foto);
										       $debug = 'A'; 
										} else {
											
											$pic = 'assets/images/faces/profile/face0.png';	
											$debug = 'B';
										}
							
							}

/////

$info_userb = get_info_user($id_user);
/*
	$row['fecha_nac'].';'.
	$row['dir_estado'].';'.
	$row['dir_calle'].';'.
	$row['dir_no_ext'].';'.
	$row['dir_no_int'].';'.
	$row['dir_col'].';'.
	$row['dir_mun_del'].';'.
	$row['dir_extra'].';'.
	$row['dir_cp'].';'.
	$row['nombre'].';'.
	$row['apellido'].';'.
	$row['fecha_nac'];
	
	*/

//var_dump($user);

$data = explode(';', $info_userb);

$nombre = $data[9];
$apellido = $data[10];
$f_nac = $data[0];

//////

$pagina = $_GET['element'];
$paginab = $_GET['element_sub'];

$submnu = getmenu_opcion_frame($pagina,$correo_cifrado);

if(isset($paginab)== TRUE){
	$docs = get_pag($paginab);
}else{
	$docs= 'empty.php';
}


	                        $lbl_perfil = get_info_perfil($GLOBALS['user_perfil']);
	                        //var_dump($lbl_perfil);
	                        
	                        $data_perfil = explode(';', $lbl_perfil);
	                        $id_p = $data_perfil[0];
	                        $nombre_p = strtoupper($data_perfil[1]);
	                        $nom_corto_p = strtoupper($data_perfil[2]);
	                        $clave_p = $data_perfil[3];
	                        $icono_p = $data_perfil[4];
	                        
	                      //  $perfil = '<span class="theme_gris" style="font-size: 22px;"> <i class="fas fa-'.$icono_p.'"></i>  </span> <br>
		                  //      <label class="badge badge-secondary"> '.$nom_corto_p.'</label> ';
		                        
		                    $perfilb = '<label class="text-muted">
		                    				<span class="" style="font-size: 1em;"> 
												<i class="'.$icono_p.'"></i> 
											</span> 
											'.$nombre_p.' 
										</label> ';
//var_dump($info_user);


$chk_col_op = genera_check_series_opcionales_admin_perfil($id_user);
$chk_col_premium = genera_check_series_premium_admin_perfil($id_user);
?>

<div class="scrollable" style=" overflow:hidden;">

	<div class=" bg-light " style="margin-top: 0px; height: 100%;">
					
			<div class="row " style="height:81%; width:100%; left:0px; border:0px solid #c40;">
              <div class="col-md-3 border-right " style=" padding-left:13px; padding-right:0px; background: rgba(163, 183, 196, 0.1);">	

            	<div class="col-md-12 " style="margin-top: 5px; margin-bottom: 5px;">				
					
					<p class="col-md-12 center " id="profile_pic" style="margin-top:15px; ">
						<img class=" img-lg rounded-circle" src="<?php echo $pic; ?>" alt="Profile image">				
                    </p>
	              
					<p class="col-md-12 text-success center" style="font-size: 1.0rem; vertical-align: middle; margin: 25px 0px;" >	
						<?php echo $nombre.' '.$apellido.'<br> <span class="text-muted" style="font-size:0.8rem; margin-top:-10px;">@'.strtolower($userb).'</span>';?> 
                    </p>       
	            </div>	
	      
				<div class="col-md-12 " style="margin:10px 0px; padding:0px;"> <!--  INFO PErfil --> 
					
					<div class="col-md-12">
						<span class="text-muted" style="font-size: 0.8rem;"><i class="fa fa-envelope"></i> <?php echo strtolower($correo); ?></span>
					</div>

					<div class="col-md-12">
						<span class="text-muted" style="font-size: 0.8rem;"> <?php echo $perfilb; ?></span>
					</div>

					<div class="col-md-12">
						<span class="text-muted" style="font-size: 0.7rem;"> <?php echo formatFechaHora($fecha_act); ?></span>
					</div>
				</div>	
                  
						<div  class="border-top">
							<?PHP echo getmenu_opcion_frame(57,$correo_cifrado); ?> 
						</div>						        
					
				</div>
			
				
				<div class="col-md-3 border-right" style=" padding-left:0px; padding-right:0px;">	
                  <div  class="p-0 ">
						<?PHP echo $submnu; ?>
                  </div>
				</div>
			
				<div class="col-md row border-right border-left bg-light" style=" overflow-x: hidden; padding:0px;">
						
						<?php  include($docs); ?>
						
				</div>
			</div>
	
	
	</div> <!-- row -->
</div>


