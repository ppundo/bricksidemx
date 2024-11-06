
<?php 
	
$correo_cifrado = $_GET['item'];
//var_dump($correo_cifrado);
	
$info_user = busca_user_cifrado($correo_cifrado);

//$datos_encontrados= $error.'-'.$nombre.'-'.$correo.'-'.$user_name.'-'.$foto.'-'.$row['id'];	

$data_userb = explode('|', $info_user);
$error = $data_userb[0];
$nombre = $data_userb[1];
$correo = $data_userb[2];
$userb = $data_userb[3];
$foto = $data_userb[4];
$id_user = $data_userb[5];

if($nombre==''){
	$name= strtoupper($data_userb[3]);
}else{
	$name= $data_userb[1];
}

$pagina = $_GET['element'];

if(isset($pagina)== TRUE){
	$doc = get_pag($pagina);
	$chk_col_op = genera_check_series_opcionales_admin_perfil($id_user);
	$chk_col_premium = genera_check_series_premium_admin_perfil($id_user);
    $chk_col_col =  genera_check_series_admin_perfil($id_user);

	$sets_col = genera_sets_admin_perfil($id_user);

}else{
	$doc= 'empty.php';
}

//var_dump($info_user);


?>

<div class="scrollable" style="overflow: hidden;">

	<div class="row " style="margin-top: 0px; height: 100%;">
	
		<div class="col-md-3 border-right bg-light left_panel_shadow" style="height: 540px; padding-right:0px; padding-top:0px;" >
		
			<div class="col-md-12 border-bottom" style="padding-bottom:15px; background-color: rgba(163, 183, 196, 0.1);">
				<h4 class="p-3 card-title text-muted " style="margin-bottom:0px;"><?php echo strtoupper($name); ?> </h4>

				<span class="col-md-12 text-clear" style="font-size: 0.9rem;"> <i class="fa fa-envelope"></i> <?php echo strtoupper($correo); ?></span> <br>
				<span class="col-md-12 text-clear" style="font-size: 0.9rem;"> <i class="fa fa-user-circle"></i> @<?php echo strtoupper($userb); ?></span>
				
			</div>
				                					            
            <div class=" col-md-12 transparent  " id="lateral" style="overflow-y: auto; overflow-x: hidden; margin-bottom:0px; padding:0px;"></div>  
          
				        <div  class="col-md-12 p-0" style=" height:75%; overflow:scroll; overflow-x: hidden; overflow-y:auto;">
					        <?php echo getmenu_opcion_frame(58,$correo_cifrado); ?> 
				        </div>
            </div>
	
		<div class="col-md-9 border-right bg-light" style="height: 559px; overflow-x: hidden; padding: 0px;">
			
				
				<div style="margin-left:0px 15px;">
				<?php  
					
					//echo($doc);
					//include($doc);
                    include $doc;
					
					
				?>
                </div>
			
		</div>
	
	
	</div> <!-- row -->
</div>