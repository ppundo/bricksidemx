
<?php 
	
$cve_serie = $_GET['item'];
//$id_sugerencia= $_POST['id_sugerencia'];
//$respuesta = $_POST['respuesta_formato'];

$pagina = $_GET['element'];

if(isset($pagina)== TRUE){
	$docs = get_pag($pagina);
  //  var_dump($docs);

}else{
	$docs= 'empty.php';
}


$info_col = get_info_serie($cve_serie);

// $row['nombre'].'/'.$row['color'].'/'.$row['fecha_lanzamiento'].'/'.$row['estado'].'/'.$row['precio_premium'].'/'.$row['moneda_premium'].'/'.$row['descuento'].'/'.$row['aux'].'/'.$row['premium'];tipo


$data_col = explode('/',$info_col);


		$nombre_col = $data_col[0]; 
		$color_col  = $data_col[1];
		$f_lan = $data_col[2];
		$estado_col = $data_col[3];
		$precio = $data_col[4];
		$moneda = $data_col[5];
		$descuento = $data_col[6];
		$premium = $data_col[8];
		$tipo = $data_col[9];
		$f_reg = $data_col[10];
		$f_act = $data_col[11];
		$color_text = $data_col[13];
        $colorb_col  = $data_col[14];
       // $colorb_col  = '0,0,0';
		


$bg = 'background:linear-gradient(155deg, rgba('.$color_col.',0.9) 50%, rgba('.$colorb_col.',1) 100%);';
$bg_solid = 'background:rgba('.$color_col.',0.1 );';

		//$edo = get_lbl_estado_serie($estado_col);

                        // Color fondo 1
	                        $data = explode(',',$color_col); 
	                        
	                        $r = $data[0];
	                        $g = $data[1];
	                        $b = $data[2];
	                        
	                        $color = fromRGB($r, $g, $b);
	                    //  

                        // Color fondo 2
	                        $data = explode(',',$colorb_col); 
	                        
	                        $rb = $data[0];
	                        $gb= $data[1];
	                        $bb = $data[2];
	                        
	                        $colorb = fromRGB($rb, $gb, $bb);
	                    //
                        
							$data_coltxt = explode(',',$color_text); 
	                        
	                        $rt = $data_coltxt[0];
	                        $gt = $data_coltxt[1];
	                        $bt = $data_coltxt[2];
	                        
	                        $color_txt = fromRGB($rt, $gt, $bt); 	                        
	                        
	                        
	                        
	                        
							$fotobx = valida_foto_tipo($cve_serie,3);
							
							$GLOBALS['color_txt']= $color_txt;

?>

<div class="scrollable" style="overflow: hidden;">

	<div class="" style="z-index:1; position: absolute; height: 100%; top:0px; right: 0px;  width: 100%; background: rgba(250,250,250,0.7);"> <!-- hover-->
	<div class="row " style="margin-top: 0px; height: 100%; z-index: 99; ">
	
		<div class="col-md-3  bg-light " style="border-right:1px solid #d4d4d4; height: 541px; z-index:999999; <?php echo $bgg_solid; ?> " >		
			
			<div class="row">
                            
				<div class="col-md-12 border-bottom " style="<?php echo $bg; ?>; ">
				                      
					<h3 class="p-2 card-title-col " style="margin-left: 5px; margin-top: 5px; padding-bottom: 0px; z-index: 999; color:<?php echo $color_txt;?>; "> 
						<?php echo $nombre_col.'<input type="hidden" value="'.$nombre_col.'" id="serie-nombre" /> ';?> </h3>
						
					<div class="col-md-12">
						<p>
                    <span class="" style="padding: 2px 5px; border-radius:3px; background: <?php echo $color; ?>; font-size:0.9rem; color:<?php echo $color_txt;?>; "><b><?php echo $cve_serie ; ?></b></span>  <br>
					<span class="" style="font-size: 12px; color:<?php echo $color_txt;?>;"><i class="fa fa-calendar"></i> <?php echo formatFecha($f_lan); ?></span>  <br>
					<span class="" style="font-size: 12px; color: rgba(<?php echo $color_text;?>,0.5);" ><i class="fa-solid fa-clipboard-check"></i> <?php echo formatFechaHora($f_reg) ?></span> <br>
					<span class="" style="font-size: 12px; color: rgba(<?php echo $color_text;?>,0.5); "><i class="fa-solid fa-retweet"></i> <?php echo formatFechaHora($f_act) ?></span> 
						</p>
					</div>				
					
					<div class="col-sm-12 no-show" style="width: 100%; border-top:1px solid rgba(250,250,250,0.5); z-index:9999; height: 30px; background:rgba(250,250,250,0.1);" ></div>
				
				</div>
						
				
                <div id="b_barra" class="card-body" style="margin-right: 0px; padding-right: 0px; padding-left:12px; padding-top:0px; ">
					        <?php echo getmenu_opcion_frame(86,$cve_serie); ?> 
                </div>
              
			</div>
		
		</div>

      <div class="col-md " style="margin:0px; padding:0px; float:right; height: 541px; overflow-x: hidden; background: rgba(250,250,250,0.6); border:0px solid #ccc; ">        	
        	<?php  include($docs); ?>        	
      </div>
		
		</div> <!-- hover-->		
	        <div class="" style=" z-index:0; width: 100%;">
                <img src="<?php echo $fotobx; ?>" style="max-height:60%; max-width: 60%; bottom:15px; right:20px; position:absolute; filter: opacity(90%);" >
            </div>	
	    </div> <!-- row -->
</div>