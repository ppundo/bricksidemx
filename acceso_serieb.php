<?php


$pagina = $_GET['element'];

if(isset($pagina)== TRUE){
	$docs = get_pag($pagina);
    //var_dump ($docs);
  
}else{
	$docs = 'empty.php';
}


?>

<div class="scrollable" style="overflow: hidden;">
	<div class="row " style="margin:0px; padding:0px; height:542px; ">
	
		<div class="col-2 border-right left_panel_shadow " style="height:100%; margin:0px; padding:0px;" >		
			 <?php echo getmenu_opcion_frame(51,0); ?> 
		</div>
	
		<div class="col-10 bg-light" style=" margin:0px; padding: 0px; ">
				<?php  
					
					//echo($doc);
					include($docs);
				?>
			
		</div>
	</div> <!-- row -->
</div>
