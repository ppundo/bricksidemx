<?php

$pagina = $_GET['element'];

if(isset($pagina)== TRUE){
	$docs = get_pag($pagina);

}else{
	$docs= 'empty.php';
}

$btn = $_POST['btn_comb'];
if(isset($btn)== TRUE){

$disp_tabla = '';
	// opciones de cada aspecto a evaluar
	
	//$max_tipo_serie = 5; 
	//$max_edo_serie = 5;
	//$max_tipo_dona = 2;
	//$max_pago = 3; 
	//$max_perfil = 6; 
	//$max_tipo_vista = 2;
	//$max_sel_user = 2;
	$no= 0;

	$max_tipo_serie = get_total_reg('tipo_serie');
	$max_edo_serie = get_total_reg('estado_serie');
	$max_tipo_dona = get_total_reg('tipo_donativo');
	$max_pago = get_total_reg('estado_pago');
	$max_perfil = get_total_reg('perfiles');
	$max_tipo_vista = get_total_reg('tipo_vista');
	$max_sel_user = get_total_reg('tipo_seleccion_user');

	//var_dump($max_tipo_vista);
	
	for($i=1; $i<= $max_tipo_serie; $i++){
		
		$lbl_i = get_lbl_tabla('tipo_serie',$i);
		
		for($j=1; $j<= $max_edo_serie; $j++){
			$lbl_j = get_lbl_tabla('estado_serie',$j);
			
			for($k=1; $k<= $max_tipo_dona; $k++){
				$lbl_k = get_lbl_tabla('tipo_donativo',$k);
				
				for($l=1; $l<= $max_pago; $l++){
					$lbl_l = get_lbl_tabla('estado_pago',$l);
					
					for($m=1; $m<= $max_perfil; $m++){
						$lbl_m = get_lbl_tabla('perfiles',$m);
						
						for($n=1; $n<= $max_tipo_vista; $n++){
							$lbl_n = get_lbl_tabla('tipo_vista',$n);
							
							for($o=1; $o<= $max_sel_user; $o++){
								$lbl_o = get_lbl_tabla('tipo_seleccion_user',$o);
																
								$no = $no+1;
								
								$codigo = getLetraByPosition($i).getLetraByPosition($j).getLetraByPosition($k).getLetraByPosition($l).getLetraByPosition($m).getLetraByPosition($n).getLetraByPosition($o);
								
								$estado = get_permiso_coleccion_grid($codigo);
								
								if($estado==1){
									$lbl = '
										<label class="col-form-label" > <span class="text-primary " >  <i class="fa fa-toggle-on"></i> Mostrar Serie </span>  </label>
									'; 
								}elseif($estado==0){
									
									$lbl = ' <label class="col-form-label"> <span class="text-muted" >  <i class="fa fa-toggle-off"></i> Ocultar Serie </span>  </label>
									';
								}elseif($estado==3){
									$lbl = '
									<label class="col-form-label"> <span class="text-premium" >   <i class="fa fa-bookmark"></i> Donativo </span>  </label>
									';
								}elseif($estado < 0){
									
									$lbl = ' <label class="col-form-label" > <span class="text-clear" >  <i class="fa fa-ban"></i> No Registrado </span> </label>';
								}
								
								$tabla .= '
									<tr >
										<td class="text-muted" > '.$no.' </td>
										<td class="text-muted" > '.$codigo.' <a href="#" id="'.$codigo.'" onclick="copy_code_vista(this.id);" > <i class="fa-solid fa-magnifying-glass"></i> </a> </td>
										<td class="text-muted" > '.$lbl.'</td>
										<td class="text-muted" > 
											
							<button type="button" onclick="toggle(\'div_'.$codigo.'\')" class="form-control btn btn-outline-primary"> <i class="fa fa-eye"></i></button>
											
											<div class="col-sm-12" id="div_'.$codigo.'" style="display:none;">
												<span class="text-clear" style="font-size:0.8em;">
												'.$lbl_i.'<br>'.'
												'.$lbl_j.'<br>'.'
												'.$lbl_k.'<br>'.'
												'.$lbl_l.'<br>'.'
												'.$lbl_m.'<br>'.'
												'.$lbl_n.'<br>'.'
												'.$lbl_o.'<br>'.'
												
												</span>
											</div>
									    </td>
									</tr>
								'; 
								
							}
						
						}	
						
					}	
					
				}				
				
			}			
			
		}		
	//	$no = $no+1;
	}
	
	$campo_buscar = crea_campo_buscar_cust('vistas',6);

}else{
	$disp_tabla = 'no-show';
}

$list_temas = '<option value="X" selected >Elije...</option>'.generaListTiposerie(0);
$list_series ='<option value="X" selected >Elije...</option>'.generaListEstadoSerie(0);
$list_perfil ='<option value="X" selected >Elije...</option>'.generaListPerfilesCode(0);
$list_permisos_serie = '<option value="X" >Elije...</option>'.generaListPermisoVistaSerie(0);

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

//var_dump($actual_link);

?>

<textarea class="no-show" id="current_permisos_vista"><?php echo $list_permisos_serie; ?></textarea>




	<div class="col-12 " style=" padding:0px; margin:0px; " >
                    
    <h5 class="col-md-12 p-2 title_sec"> Minifiguras
	    <span class=" col-md-4  text-clear col-form-label " style="font-size: 12px;" id="code_minifig"></span>
    </h5>
 
       
	<div class="row" style="margin:0px; padding:0px; height:920px;">
                       
                        <div class="col-md-6 border-right" >  							
							<div class="row" style="padding-top: 10px; border: 0px solid #d2f;" >
							
									<div class="col-8 form-group" style="padding: 0px; margin:0px;">
									  
										  <div class="input-group" style="padding: 0px;">
											<div class="input-group-prepend bg-head">
											  <span class="input-group-text text-ligth"><i class="fa-solid fa-magnifying-glass"></i></span>
											</div>
											<input type="text" class="col-sm-6 form-control" onblur="decode_minifig(this.value)" value="" id="code_minifig_e" id="campo_buscar" value="" placeholder="Buscar Clave Registro" >
							
										  </div>
										  
							
									</div>		                        
							
									<div class="col-sm-4 group-button">
										<form name="form_comb" action="<?php  echo $actual_link; ?>" method="post">
										 <button type="submit" class="btn btn-inverse-primary"  name="btn_comb" title="Ver todas opciones"> <i class="fa-solid fa-diagram-project"></i> Ver Todo</button>
										</form>
									 </div>
							
								<div class="form-group row col-12 border-bottom border-top bg-head" style="padding: 0px; margin-left: 0px;">			                       
									<span class="col-6" style="font-size: 12px; " id="resultado_val"></span>
									<span class="col-6 " id="resultado_valb" style=""> </span>
								</div>
										
							</div>
							                    
                          <div style="height: 350px; overflow:scrolling; overflow-x:hidden; overflow-y:auto; ">

	                          <div class="form-group row">
	                            <label for="exampleInputEmail2" class="text-muted col-sm-4 col-form-label">Tipo de Serie</label>
	                            <div class="col-sm-6">
	                              		<select class="form-control" id="select_0" onchange="valida_select_serie(this.id);">
											<?php echo $list_temas; ?>
										</select>		
	                            </div>
	                          </div>

	                          <div class="form-group row">
	                            <label for="exampleInputEmail2" class="text-muted col-sm-4 col-form-label">Estado Serie</label>
	                            <div class="col-sm-6">
	                              		<select class="form-control" id="select_1" onchange="valida_select_serie(this.id);">
								  			<?php echo $list_series; ?>			
										</select>		
	                            </div>
	                          </div>

	                          <div class="form-group row">
	                            <label for="exampleInputEmail2" class="text-muted col-sm-4 col-form-label">Tipo Donativo</label>
	                            <div class="col-sm-6">
									<select class="form-control" id="select_2" onchange="valida_select_serie(this.id);">
										<option value="x">Elija...</option>
										<option value="A">Serie Premium</option>
										<option value="B">Serie Regular</option>
									</select>			
	                            </div>
	                          </div>
                          
	                          <div class="form-group row">
	                            <label for="exampleInputEmail2" class="text-muted col-sm-4 col-form-label">Pago</label>
	                            <div class="col-sm-6">
	                              		<select class="form-control" id="select_3" onchange="valida_select_serie(this.id);">
											<option value="X" >Elije...</option> 
											<option value="A" >Pagado</option> 
											<option value="B" >Sin Pago  </option>
											<option value="C" >Excento de Pago </option> 
											<option value="D" >Dcto Total Cupon </option> 
										</select>		
	                            </div>
	                          </div>  
                          
	                          <div class="form-group row">
	                            <label for="exampleInputEmail2" class="text-muted col-sm-4 col-form-label">Perfil Usuario</label>
	                            <div class="col-sm-6">
	                              		
										<select class="form-control"  id="select_4" onchange="valida_select_serie(this.id);">
											<?php echo $list_perfil; ?>
										</select>	
	                            </div>
	                          </div>
 
	                           <div class="form-group row">
	                            <label for="exampleInputEmail2" class="text-muted col-sm-4 col-form-label">Tipo de Vista</label>
	                            <div class="col-sm-6">
	                              			    
									<select  class="form-control" id="select_5" onchange="valida_select_serie(this.id);">
										<option value="X" >Elije...</option> 
										<option value="A" > Todas las Figuras</option> 
										<option value="B" > Serie Específica </option> 
									</select>	            
			
	                            </div>
	                          </div>
                          
	                          <div class="form-group row">
	                            <label for="exampleInputEmail2" class="text-muted col-sm-4 col-form-label">Selección Usuario</label>
	                            <div class="col-sm-6">
	                              		<select  class="form-control" id="select_6" onchange="valida_select_serie(this.id);">
											<option value="X" >Elije...</option> 
											<option value="A" >Seleccionada por Usuario</option> 
											<option value="B" >No Activada </option>
										</select>		
	                            </div>
	                          </div>

                        
                                                                                                           
                        
							  <textarea class="no-show"  id="per_act" > <?php echo $perfiles; ?> </textarea>
							  <input type="hidden" class="form-control" id="code_vista">
							  <input type="hidden" class="form-control" id="config_colection_minifig" value="A">

                            </div>   
                      
                        </div>
						
						
						<div class="col-md-6 <?php echo $disp_tabla; ?>" >					  
							<div class="card-body" style="padding: 0px; height: 100%;  border: 0px solid #cd0; ">
								<h5 class="col-md-12 p-1 subtitle_sec">Permisos Registrados
									<span class=" col-md-4  text-clear col-form-label " style="font-size: 12px;" </span>
								</h5>
								
								<?php echo $campo_buscar; ?>
								
								<div style=" height: 320px; overflow: scroll; overflow-x: hidden; overflow-y: auto;">
									
									
									<table class="table table-striped table-bordered" id="vistas">
										<thead>
											<tr>
											<th class="thead_content">No</th>
											<th class="thead_content"> Código</th>
											<th class="thead_content">Estado</th>
											<th class="thead_content">Acciones</th>
											</tr>
										</thead>
										<tbody>
											<?php echo $tabla; ?>
										</tbody>
										
									</table>
									
								</div>
							</div>
						</div>

				</div><!--row-->

					
						
                </div>
				

