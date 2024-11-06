
<?php 
	
$cve_perfil = $_GET['item'];
//var_dump($correo_cifrado);
	
$info_perfil= get_info_perfil($cve_perfil); 
// 	    	$data = $row['id'].';'.$row['nombre'].';'.$row['nombre_corto'].';'.$row['cve_perfil'].';'.$row['icono'].';'.$row['estado'].';'.$row['color']; 


$data_userb = explode(';', $info_perfil);
$id = $data_userb[0];
$nombre = $data_userb[1];
$nombre_cto = $data_userb[2];
$icono = $data_userb[4];
$estado= $data_userb[5];
$color = $data_userb[6];
$fecha_reg = $data_userb[7];

$ops_perfil_edo = genera_select_edo_perfil($estado);
$select_color = genera_select_colores($color);

$lbl_estado = get_lbl_estado_perfil($estado);

$pagina = $_GET['element']; 

if(isset($pagina)== TRUE){
	
	$doc = get_pag($pagina);
}else{
	$doc= 'empty.php';
}


//var_dump($doc);

?>

<div class="scrollable" style="overflow: hidden;">

	<div class="row " style="margin-top: 0px; height: 100%;">
	
		<div class="col-md-3 border-right bg-light left_panel_shadow" style="height: 540px; padding-right:0px; padding-top:0px;" >
		
			<div class="col-md-12 border-bottom " style="background-color: rgba(163, 183, 196, 0.1);">

				<h4 class="p-3 card-title text-<?php echo $color; ?> center " style="margin-bottom:0px;"> <?php echo $nombre; ?> </h4>
				<p class="col-md-12 center">

					<span class="border text-muted" style="font-size: 0.9rem; border-radius:5px; padding:3px; margin-bottom:10px;"><i class="<?php echo $icono; ?>"></i> <?php echo $nombre_cto; ?></span> 

					<span class="border text-muted" style="font-size: 0.9rem; border-radius:5px; padding:3px; margin-top:25px;"> 
						<?php echo $lbl_estado; ?>
					</span>
				</p>
				<p class="text-muted col-md-12 center" style="font-size:0.7rem;"> <?php echo formatFechaHora($fecha_reg); ?></p>
			</div>
			
				                					            
            <div class="col-md-12 transparent  " id="lateral" style="overflow-y: auto; overflow-x: hidden; margin-bottom:0px; padding:0px;"></div>  
          
				        <div  class="col-md-12 p-0" style="">
					        <?php echo getmenu_opcion_frame(123,$cve_perfil); ?> 
				        </div>
            </div>
	
		<div class="col-md-9 border-right bg-light" style="height: 559px; overflow-x: hidden; padding: 0px;">
			
				
				
				<?php  
					
					//echo($doc);
					//include($doc);
                    include $doc;
					
					
				?>
			
		</div>
	
	
	</div> <!-- row -->
</div>