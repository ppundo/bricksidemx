<?php 
	
$id_sugerencia = $_GET['item'];
//$id_sugerencia= $_POST['id_sugerencia'];
//$respuesta = $_POST['respuesta_formato'];


$info_sugerencia = get_info_sugerencia($id_sugerencia);
// $error.'|'.$row['id_user'].'|'.$row['fecha_envio'].'|'.$row['cve_lego'].'|'.$row['id_tema'].'|'.$row['tipo'].'|'.$row['detalles'].'|'.$row['estado'].'|'.$row['fecha_completa'].'|'.$row['respuesta'].'|'.$row['fecha_respuesta'].'|'.$row['folio'].'|'.$row['archivado'];

$data_sug = explode('|',$info_sugerencia);

$error = $data_sug[0];


if($error==0){
		$id_user = $data_sug[1];
		$f_envio = $data_sug[2];
		$clave_lego = $data_sug[3];
		$id_tema = $data_sug[4];
		$tipo = $data_sug[5];
		$detalles = $data_sug[6];
		$estado_sug = $data_sug[7];
		$f_reg = $data_sug[8];
		$f_resp = $data_sug[9];
		$folio = $data_sug[10];
		$archivado = $data_sug[11];
        $id_sug = $data_sug[12];


if($archivado==1){
	$lbl_archivado  = ' <span >'.crea_lbl_sugerencia(999).'</span>';
	 
}else{
	$lbl_archivado  = '';
}
		 

								$info_serie = get_info_serie($clave_lego);
								
								//var_dump($user);
								
								$data_serie = explode('/', $info_serie);
								
								$nom_serie = '<i class="fa-solid fa-street-view"></i> '.$data_serie[0] .' &bull; ';
								$color= $data_serie[1];
								$f_lanzamiento = $data_serie[2];
								$estado = $data_serie[3];
								$precio_prem = $data_serie[4];
								$moneda_prem = $data_serie[5];
								$dcto = $data_serie[6];
								$aux = $data_serie[7];
								$premium = $data_serie[8];


								$info_userb = busca_user($id_user);
								
								//var_dump($user);
								
								$data_userb = explode('--', $info_userb);
								
								$error = $data_userb[0];
								$nombre = $data_userb[1];
								$correo = $data_userb[2];
								$userb = $data_userb[3];
								$foto = $data_userb[4];
								$id_user = $data_userb[5];

if($archivado != 1){
	  
	  if($estado_sug == 99 or $estado_sug == 0 or $estado_sug == 999 ){
	
	       $select_edo = '
	       <p class="col-sm-12 text-muted" style="font-size:0.8em;"> Esta sugerencia se encuentra en un estado final, por lo que ya no es posible escribir una respuesta. </p>
	
		   <input type="hidden" id="estado_sug_'.$id_sugerencia.'" value="'.$estado_sug.'" >
		   <input type="hidden" id="respuesta_sug_'.$id_sugerencia.'" value="'.$estado_sug.'" >';
	
			$comment = '';
			$btn_archivar='<button class="btn btn-outline-primary btn_thin" title="Archivar" onclick="edit_sug(\'1-'.$id_sugerencia.'-1\')" > <i class="fa fa-archive"></i> </button> '; 
			$btn_guardar = '';
			
	  }else{
	    $select_edo = '
	    
        <div class="row col-md-12 form-group">
	        <label class="col-form-label col-md-4 text-muted"> Estado </label>
	        <select class="col-md-6 form-control form-control" id="estado_sug_'.$id_sugerencia.'" onchange="edit_recibo(\'1-'.$id_sugerencia.'\')" name="chk_edo_recibo" value="" >'. genera_select_edo_sug($estado_sug).'</select>
		</div>';
	
	$comment = '
	<div class="row col-md-12 form-group">
	    <label class="col-form-label col-md-4 text-muted"> Comentarios: </label>
	    <textarea id="respuesta_sug_'.$id_sugerencia.'" rows="6" class="form-control col-md-12" style="padding:10px; margin-left:10px;" ></textarea>
    </div>
	';

	$btn_archivar='<button class="btn btn-inverse-primary btn_thin" title="Archivar" onclick="edit_sug(\'1-'.$id_sugerencia.'-1\')" > <i class="fa fa-archive"></i> </button> '; 
	$btn_guardar = '<button class="btn btn-inverse-primary btn_thin" title="Guardar" onclick="edit_sug(\'3-'.$id_sugerencia.'\')" > <i class="fas fa-save"></i>  </button> '; 
 
	    
	  }
 
  }else{
	  $comment= ' <p class="col-sm-12 text-muted" style="font-size:0.7rem;" > Esta sugerencia se encuentra archivada, por lo que ya no es posible escribir una respuesta. </p>';
	  
	  $btn_archivar='<button class="btn btn-outline-primary btn_thin" title="Desarchivar" onclick="edit_sug(\'1-'.$id_sugerencia.'-1\')" > <i class="fa fa-box-open"></i> </button> ';
	  $btn_guardar = '';
  }


		$lbl_estado = crea_lbl_sugerencia($estado_sug);

		$respuesta = get_resp_sugerencia($id_sugerencia); 

						if($respuesta != ''){
							
							$pos = strpos($respuesta,'|');
							//var_dump($pos);
							
							if($pos === FALSE){
								
								$elem = explode('--', $respuesta);
								$coment = $elem[0];
								$fecha_r = formatFechaHora($elem[1]);
								
									$li = '
									      <li class="col-sm-12 timeline-item">
					                        <p class="timeline-content text-sm text-muted" style="display: flex;">'.$coment.'</p>
					                        <p class="event-time text-primary">'.$fecha_r.'</p>
					                      </li>
									
									';
								
								$conv = ' <ul class="timeline"> '.$li.' </ul> '; 
								
							}elseif($pos > 0){
								
								$data_res = explode('|', $respuesta);
								$itera = count($data_res);
								$li = '';
								
									for($i=0;$i<= count($data_res);$i++){
										
										$length_itr = strlen($data_res[$i]);
										
										if($length_itr > 5){
										
										$elem = explode('--', $data_res[$i]);
										$coment = $elem[0];
										$fecha_r = formatFechaHora($elem[1]);
																			
											$li .= '
											      <li class="timeline-item">
							                        <p class="timeline-content text-sm text-muted" >'.$coment.'</p>
							                        <p class="event-time text-primary" style="font-size:0.5em;">'.$fecha_r.'</p>
							                      </li>
											
											';
										}
									}	
								
								$conv = ' <ul class="timeline"> '.$li.' </ul> '; 
														
							}
						}
						


}else{
	
	$folio = 'No encontrado'; 
}






?>



	<div class="row " style="margin-top: 0px; height: 100%;">
	

	
		<div class="col-md-4 border-right  bg-light " style="height: 559px;" >		
			
	<h5 class="col-md-12  p-2 title_sec" >Sugerencia</h5>			
			
			<div class="row">
				
				<div class="col-md-12 border-bottom" style="text-align:center;"> 
					<div class="row">
						<div class="col-md-6 " style="text-align: center;"> <?php echo $lbl_estado; ?> </div>
						<div class="col-md-6 border-left" style="text-align: center;"> <?php echo $lbl_archivado;?> </div>
					</div>
				</div>
				
				<div class="col-md-12 border-bottom" style="margin:10px 0px; padding-bottom:5px;" >
					<h3 class="text-muted" style="font-size: 1.1rem;"> <i class="fa-regular fa-folder-open"></i> <?php echo $folio;?></h3> 
                    
                    <div class="">
                        <span class="col-md-4 text-muted" style="font-size: 0.6rem;"><i class="fa fa-database"></i> <?php echo $id_sug; ?></span><br>
                        <span class="col-md-4 text-muted" style="font-size: 0.6rem;"><i class="fa fa-calendar"></i> <?php echo formatFecha($f_envio); ?></span><br>
                        <span class="col-md-4 text-muted" style="font-size: 0.6rem;">  <?php echo $nom_serie .' '. strtoupper($clave_lego) ; ?></span> <br>
                        <span class="col-md-4 text-muted" style="font-size: 0.6rem;"> <i class="fa fa-user"></i> <?php echo strtoupper($userb); ?></span>
                    </div>
					
				</div>

			</div>
		
			<div class="card-body border bg-muted" style="border-radius: 5px; margin-left: 10px; ">
				<h5 class="card-title text-muted ">Detalles Recibidos: </h5> 
				<p class="text-muted" style="text-align: justify;">
					
					<?php echo $detalles; ?>
				</p>
			</div>
		
		</div>
		
		
					
			
			
		<div class="col-md-4 border-right bg-light" style="height: 559px; overflow-x: hidden; padding: 0px;">
			
			<h5 class="col-md-12  p-2 title_sec" >Interacción</h5>
                
            <div class="p-1  bg-muted">
                    <div class="btn-group">
                        <?php echo $btn_guardar; ?>
                    </div>
                </div>

			<div class="card-body ">


			                        		<div class="row">
		                        				
		                        				<?php echo $select_edo; ?>
		                        				
		                        			</div>

		                        			<div class="row" style="align-content: center;">
		                        				<?php echo $comment; ?>		                        			
		                        			</div>
		                        			<br>
		                        			
						</div>	
			
		</div>
		
			
		<div class="col-md-4 border-right " style="height: 559px; overflow-x: hidden; ">
			
				<h5 class="col-md-12  p-2 title_sec" >Historial</h5>
				
							<div class="col-md-12" style="width: 99%; overflow:scroll; overflow-x: hidden; overflow-y: auto; padding:15px;">
		                        				
		                        <span class="row col-sm-12"> <?php echo $conv; ?> </span>
		                        				
		                    </div>
				
			
		</div>
	
	
	</div> <!-- row -->
