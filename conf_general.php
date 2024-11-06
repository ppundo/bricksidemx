<?php
	
	$submnu = $_GET['submnu'];
	
//	$page = get_pag($submnu);
	
	//var_dump($submnu);
	
$pagina = $_GET['element'];

if(isset($pagina)== TRUE){
	$doc = get_pag($pagina);
	//$chk_col_op = genera_check_series_opcionales_admin_perfil($id_user);
	//$chk_col_premium = genera_check_series_premium_admin_perfil($id_user);

}else{
	$doc= 'empty.php';
}


?>

<div class="scrollable " style="overflow: hidden;">

	<div class="row " style="margin-top: 0px; height: 100%;">
	
		<div class="col-md-2 border-right bg-light left_panel_shadow " style="height: 559px; padding-right:0px; padding-top:0px;">
				
			<div id="b_barra" class="card-body  " style="margin-right: 0px; padding-right: 0px; padding-left:0px; padding-top:0px; ">
					        <?PHP echo getmenu_opcion_frame(47,$correo_cifrado); ?> 
            </div>
				        
		</div>
	
		<div class="col-md-10 border-right bg-light" style="height: 559px; overflow-x: hidden; padding: 0px;">
			
				
				
				<?php  
					
					//echo($doc);
					include($doc);
					
					
				?>
			
		</div>
	
	
	</div> <!-- row -->
</div>




