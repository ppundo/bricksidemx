
<?php 
	
include("check_access.php");

$urlb= $_SERVER['QUERY_STRING'];
$urlb = $_SERVER['REQUEST_URI'];

$op = $_POST['page_req'];
$mod = $_POST['modal'];

	$url = 'index.php?mnu=958153f1b8b96ec4c4eb2147429105d9';
	
	//$op = $_GET['op'];
	
	
//	$mod = $_GET['mod'];
	if($mod==0){
		$display='none';
	}else{
		$display='block';
	}
	

function select_ops($actual){
	
	if($actual == 1 ){
		$ops='
		<option value="0" >Desactivo</option>
		<option value="1" selected >Activo</option>
		
		';
		
	}elseif($actual == 0){
	
	$ops='
	<option value="0" selected >Desactivo</option>
	<option value="1" >Activo</option>
	
	';
	}
	
	return $ops;
}

//////////////// Encuentra las facturas de cada usuario
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		      //informacion de acceso a la bd
		// Check connection
			if ($dbh->connect_error) {
		    	die("Connection failed: " . $dbh->connect_error);
			}
		
              $qrr = "Select * from conf_catalogos where estado = 1 order by orden asc;";// preparando la instruccion sql
              

			    $resultr= $dbh->query($qrr);
			    if ($resultr->num_rows > 0) {
				    
// onclick="toggle_tr(\''.$rowr['id'].'\')"
				    
                        while($rowr= $resultr->fetch_assoc()){
					
						if($rowr['id']== $op){

	                     
							$opts .='<option selected value="'.$rowr['id'].'">'.$rowr['nombre'].'</option>';
						}else{
							
														        
								        $opts .='<option value="'.$rowr['id'].'">'.$rowr['nombre'].'</option>';
						}
	                    
	                    //// Buscra los registros de cada tabla
	                    
	                    $registros = ''; 
	                    $celdas = ''; 
	                    $rows_t = '';
	                    
	                    $tbody = '';
	                    	$registros = get_reg_tabla($rowr['clave']);
	                    	
	                    	//catalovar_dump($registros);
							$data_reg = explode('|', $registros);
							
							//echo count('No reg: '.$data_reg.'<br>');
							
							for($i=0;$i < count($data_reg)-1; $i++){
								$btn_save = '';
								$btn_del ='';
								
								$data_reg_sub = explode('--', $data_reg[$i]);
								
								$limit_cel = count($data_reg_sub);
								
								for($j=0; $j < $limit_cel ; $j++){
									

											//$id= $data_reg_sub[0].'-'.$rowr['id'].'-'.$j;
										$id= $data_reg_sub[0].'-'.$rowr['clave'].'-'.$j;
											// fila-seccion-campo
																				
											$btn_save = '
											<button class="btn btn-outline-secondary btn-thin text-muted" onclick="save_mnu_cat(\'1--'.$id.'\')" > 
											<i class="fa fa-save"></i> 
											</button>';

								$perfil = $GLOBALS['user_perfil'];
								 $permiso_elimina = get_permiso_config('10', $perfil);
								 
								 if($permiso_elimina==1){

										$btn_del = '
											<button class="btn btn-outline-secondary btn-thin text-muted" onclick="save_mnu_cat(\'2--'.$id.'\')"> 
											<i class="fa fa-trash"></i> 
											</button>';
																			 
								 }else{

											$btn_del = '
											<button class="btn btn-inverse-secondary btn-thin " disabled= "disabled"  > 
											<i class="fa fa-trash"></i> 
											</button>';

																 
								 }

							/*
											$btn_del = '
											<button class="btn btn-outline-secondary btn-thin text-muted" onclick="save_mnu_cat(\'2--'.$id.'\')"> 
											<i class="fa fa-trash"></i> 
											</button>';
							*/
											
											$name = $data_reg_sub[0].'-'.$rowr['clave'];
																		
										switch($rowr['clave']){
										
					
										default:
										
										$cols = get_cols_tabla($rowr['clave']);
										
										$data_cols = explode('|', $cols);
										
										
										
											if($j==0){
												$celdas .= '<td class="text-muted" style="text-align:center;"> '.$data_reg_sub[$j].' 
												<input class="form-control" name="'.$name.'" id="'.$id.'" type="hidden" value="'.$data_reg_sub[$j].'">
												<span class="text-muted debug" >ID: '.$id.'</span>
												</td>';
											}elseif($data_cols[$j]=='estado') {

												if($data_reg_sub[$j]==0){
													
													$ico_edo = '
													<a href="#"  > 
														<span class="text-disabled">
															<i onclick="save_mnu_cat(\'4--'.$id.'\');" class="fa fa-toggle-off fa-md"></i>
														</span>
													</a>
													';
													
												}else{
													
													$ico_edo = '
													<a href="#"  > 
														<span class="text-primary">
															<i onclick="save_mnu_cat(\'4--'.$id.'\');" class="fa fa-toggle-on fa-md"></i>
														</span>
													</a>
													
													';
												}
												

												$celdas .= '
												<td class="td-sm" style="text-align:center;">  '.$ico_edo.'
												<input class="form-control" name="'.$name.'" id="'.$id.'" type="hidden" value="'.$data_reg_sub[$j].'">
												
												
												<span class="text-muted debug" >ID: '.$id.'</span>
												
												</td>';	
												
											}elseif($data_cols[$j]=='comentario') {

												if($data_reg_sub[$j]==0){
													
													$ico_edo_c = '<a href="#" onclick="save_mnu_cat(\'3--'.$id.'\')" > <span class="text-disabled"><i class="fa fa-toggle-off fa-md"></i></span> </a>';
												}else{
													
													$ico_edo_c = '<a href="#" onclick="save_mnu_cat(\'3--'.$id.'\')" > <span class="text-primary"><i class="fa fa-toggle-on fa-md"></i></span> </a>';
												}

												$celdas .= '
												<td class="" style="text-align:center;">  '.$ico_edo_c.'
												<input class="form-control" id="'.$id.'" name="'.$name.'" type="hidden" value="'.$data_reg_sub[$j].'">
												<span class="text-muted debug" >ID: '.$id.'</span>
												</td>';	
												
											}elseif($data_cols[$j]=='fecha_registro' or $data_cols[$j]=='fecha_actualizado') {

												if($data_reg_sub[$j]=='0000-00-00 00:00:00'){
													$dato = '<span class="text-muted" > - </span>';
												}else{
													$dato = '<span class="text-muted">'.formatFechaHoraTable($data_reg_sub[$j]).'</span>';
												}
													
												$celdas .= '
												<td class="td-sm" style="text-align:center;" > '.$dato.'  
													
													<input class="form-control" name="'.$name.'" id="'.$id.'" type="hidden" value="'.$data_reg_sub[$j].'">
													
													<span class="text-muted debug" >ID: '.$id.'</span>
													
												</td>';
												
											}elseif($data_cols[$j]=='clave' or $data_cols[$j]=='cve' or $data_cols[$j]=='cve_perfil' or $data_cols[$j]=='cve_idioma' ) {

												$celdas .= '<td class="text-muted" style="text-align:center;"> '.$data_reg_sub[$j].' 
												<input class="form-control" name="'.$name.'" id="'.$id.'" type="hidden" value="'.$data_reg_sub[$j].'">
												<span class="text-muted debug" >ID: '.$id.'</span>
												</td>';
												
											}elseif($data_cols[$j]=='nombre' and $rowr['clave']=='colores'){
												$celdas .= '<td class="center"> 
												<span class="text-'.$data_reg_sub[$j].'" style="width: 25px; display: inline-block;"> <i class="fa fa-paint-brush" ></i></span>
												<input name="'.$name.'" id="'.$id.'" class="form-control" type="text" value="'.$data_reg_sub[$j].'"> 
												<span class="text-muted debug" >ID: '.$id.'</span>
												</td>';
											}elseif($data_cols[$j]=='color'){
												$celdas .= '<td class="center"> 
												<span class="text-'.$data_reg_sub[$j].'" style="width: 25px; display: inline-block;" > <i class="fa fa-paint-brush" ></i></span>
												<input name="'.$name.'" id="'.$id.'" style="width: 100px;" class="form-control" type="text" value="'.$data_reg_sub[$j].'"> 
												<span class="text-muted debug" >ID: '.$id.'</span>
												</td>';
											}elseif($data_cols[$j]=='step2'){
												$celdas .= '<td class="center"> 
												<span>'.str_replace(';', '-', $data_reg_sub[$j]).' </span>
												
												<input name="'.$name.'" id="'.$id.'" style="width: 100px;" class="form-control" type="text" value="'.$data_reg_sub[$j].'"> 
												
												</td>';
											}elseif($data_cols[$j]=='codigo_hex'){
												
												if($data_reg_sub[$j]!= 1){
													$color_rgb = hexToRgb('#'.$data_reg_sub[$j]);
													
																$r = strval($color_rgb['r']); 
																$g = strval($color_rgb['g']); 
																$b = strval($color_rgb['b']);	
																
																$color_rgb = $r.','.$g.','.$b;
												}else{
													$color_rgb = '';
												}
												
												$celdas .= '
												<td class="center"> 
												
													<span class="text-muted" style="width: 25px; display: inline-block;" onmouseover="toggle(\'zoom_'.$id.'\')" onmouseout="toggle(\'zoom_'.$id.'\')" > 
														<i class="fa fa-info " ></i>
													</span>
												
													<input name="'.$name.'" id="'.$id.'" class="form-control" style="width: 100px;" type="text" value="'.$data_reg_sub[$j].'"> 
												
												

													<div id="zoom_'.$id.'" class="zoom-ico bg-secondary" style="display:none"> 
														<span class="text-muted"> Codigo RGB = ('.$color_rgb.')</span> 
													</div>
												
												</td>';
												
											}elseif($data_cols[$j]=='codigo_rgb'){
												
												if($data_reg_sub[$j]!= 1){
													
													$dat_color = explode(',',$data_reg_sub[$j]);
													
													$r = trim($dat_color[0]);
													$g = trim($dat_color[1]);
													$b = trim($dat_color[2]);
													
													$color_hex = fromRGB($r,$g,$b);
												}else{
													$color_hex = '';
												}
												
												$celdas .= '
												<td class="center"> 
												
													<span class="text-muted" style="width: 25px; display: inline-block;" onmouseover="toggle(\'zoom_'.$id.'\')" onmouseout="toggle(\'zoom_'.$id.'\')" > 
														<i class="fa fa-info " ></i>
													</span>
												
													<input name="'.$name.'" id="'.$id.'" class="form-control" style="width: 100px;" type="text" value="'.$data_reg_sub[$j].'"> 
												
												

													<div id="zoom_'.$id.'" class="zoom-ico bg-secondary" style="display:none"> 
														<span class="text-muted"> Codigo HEX = ('.$color_hex.')</span> 
													</div>
												
												</td>';
												
											}elseif($data_cols[$j]=='icono'){
												
												if($data_reg_sub[$j]==''){
													$fa_ico = 'fa-times'; 
													$fa_ico_text = 'text-light'; 
												}else{
													$fa_ico = $data_reg_sub[$j];
													$fa_ico_text = 'text-muted';
												}
																				
												$celdas .= '<td class="center"> 
												<span class="'.$fa_ico_text.' " style="width: 25px; display:inline-block;" onmouseover="toggle(\'zoom_'.$id.'\')" onmouseout="toggle(\'zoom_'.$id.'\')" > <i class="'.$fa_ico.' " ></i></span>
												<input name="'.$name.'" id="'.$id.'" class="form-control" style="width: 100px;" type="text" value="'.$data_reg_sub[$j].'"> 
												<span class="text-muted debug" >ID: '.$id.'</span>
												
													<div id="zoom_'.$id.'" class="zoom-ico" style="display:none"> 
														<span class="text-muted" style="font-size:20px;"> <i class="'.$data_reg_sub[$j].' fa-3x " ></i></span> 
														<span class="text-muted" style="font-size:20px;"> <i class="'.$data_reg_sub[$j].' fa-3x " ></i></span>
														<span class="text-muted" style="font-size:20px;"> <i class="'.$data_reg_sub[$j].' fa-3x " ></i></span>
													</div>
												
												</td>';
											}else{
												$celdas .= '<td> <input name="'.$name.'" id="'.$id.'" class="form-control" type="text" value="'.$data_reg_sub[$j].'"> 
												<span class="text-muted debug" >ID: '.$id.'</span>
												</td>';
											}
										break;
										
										}
										
								
									
									//$celdas = $celdas.'<td> opciones </td>';
								}
								
								
								
								$rows_t .= '
								 <tr>'.$celdas.' 
								 	<td> 
								 		<div class="btn-group" > 
								 			'.$btn_edo.$btn_save.$btn_del.'
								 			
								 		</div>
								 	</td> 
								 </tr>';
								
								$celdas = '';
							}
							
							$tbody = '<tbody>'.$rows_t.'</tbody>';
							$rows_t = '';
							
	                    
	                    if($rowr['id']== $op){
		                    $disp = 'block';
		                    $title_ico_tabla = $rowr['icono']; 
		                    $title_tabla = $rowr['nombre']; 
		                    $fields = $campos_.$$rowr['clave'];
		                    
	                    }else{
		                    $disp = 'none';
	                    }
	                    
	                //////////// crea la tabla                     
	                    
	                    $cols = get_cols_tabla($rowr['clave']);
	                    $cols = substr($cols,0,-1);
	                    
						$data_cols = explode('|',$cols);
					   	$tot_cols = count($data_cols);
	                    $th = '';
						
						for($i=0; $i<$tot_cols; $i++){
							
							if($data_cols[$i]=='fecha_registro'){
								$th .= '<th class="thead_content" style=""> <i class="fas fa-calendar"></i> </th>';
							}elseif($data_cols[$i]=='fecha_actualizado'){
								$th .= '<th class="thead_content" style=""> <i class="fas fa-retweet"></i> </th>';
							}elseif($data_cols[$i]=='comentario'){
								$th .= '<th class="thead_content" style=""> <i class="fas fa-comment"></i> </th>';
							}else{
								$th .= '<th class="thead_content" style=""> '.strtoupper(str_replace("_", " ", $data_cols[$i])).' </th>';
							}
												
								
						}

					/////////////
							
					
		                    $table_com .= '
		                    <cardr class="grid-margin" style="display:'.$disp.';" searchable="-card_'.$rowr['id'].'-" id="card_'.$rowr['id'].'">
		                    <table class="table table-striped " id="table_'.$op.'" >
				                      <thead>
				                        <tr>
				                          '.$th.'
				                          <th class="thead_content" style=""> OPCIONES</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$tbody.'
				                      
				                      <tfooter>
				                        <tr>
				                          '.$th.'
				                          <th class="thead_content" style=""> OPCIONES</th>
				                        </tr>
				                      </tfooter>				                      
				            </table>	
				            </cardr>	                    
		                    '; 
	                    

	                    	            
	             }// while Fila padre
	             
	             
	             $select_opts = '<select class="col-md-4 form-control" name="page_req" id="page_reg" onchange="submit(this.value)" >
	             					<option value="X">Elije una opción</option>
	             					'.$opts.'
	             				</select>'; 
	             
/// FORULARIOS PARA ADICIONAR 
	             
							switch($op) {
								
								case 1: // moneda

								$tabla_info = get_info_tabla($op);
								$data_tabla = explode('|', $tabla_info);
								
								$clave = $data_tabla[0];
								$nombre = $data_tabla[1];
								$icono = $data_tabla[2];
																
								$tam_col_form = 6;
								$tam_col_tab = 8;
															
									$campos = '
									
									<input type="hidden" value="4" id="total_campos_form" >
									<input type="hidden" value="'.$op.'" id="table_op" >
									<input type="hidden" value="'.$clave.'" id="table_name" >
									
									<div class="row form-group col-sm-12 ">
										<label for="fiel_1" class="col-form-label col-sm-4"> Clave</label>
										<input class="col-sm-8 form-control" id="field_1_1" type="text" value="" placeholder="Clave Moneda ">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_2" class="col-form-label col-sm-4"> Simbolo</label>
										<input class="col-sm-8 form-control" id="field_1_2" type="text" value="" placeholder="simbolo">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_3" class="col-form-label col-sm-4"> Nombre</label>
										<input class="col-sm-8 form-control" id="field_1_3" type="text" value="" placeholder="nombre">
									</div>
									

									<div class="row form-group col-sm-12">
										<label for="fiel_4" class="col-form-label col-sm-4"> Valor</label>
										<input class="col-sm-8 form-control" id="field_1_4" type="number" value="" placeholder="Valor">
									</div>
									
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break; 

								case 2: //estado_sug

								$tabla_info = get_info_tabla($op);
								$data_tabla = explode('|', $tabla_info);
								
								$clave = $data_tabla[0];
								$nombre = $data_tabla[1];
								$icono = $data_tabla[2];
								
								$tam_col_form = 6;
								$tam_col_tab = 9;
								
									$campos = '
									<input type="hidden" value="6" id="total_campos_form" >
									<input type="hidden" value="'.$op.'" id="table_op" >
									<input type="hidden" value="'.$clave.'" id="table_name" >									
									
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Clave</label>
										<input class="col-sm-8 form-control" id="field_2_1" type="text" value="" placeholder="Clave Moneda ">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-2" class="col-form-label col-sm-4"> Nombre</label>
										<input class="col-sm-8 form-control" id="field_2_2" type="text" value="" placeholder="Nombre">
									</div>
									

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-3" class="col-form-label col-sm-4"> Icono </label>
										<input class="col-sm-8 form-control" id="field_2_3" type="text" value="" placeholder="fa-example">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-4" class="col-form-label col-sm-4"> Color</label>
										<input class="col-sm-8 form-control" id="field_2_4" type="text" value="" placeholder="predefined">
									</div>									

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-5" class="col-form-label col-sm-4"> Avance</label>
										<input class="col-sm-8 form-control" id="field_2_5" type="number" value="" placeholder="Avance">
									</div>
									
									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-6" class="col-form-label col-sm-4"> Req. Coment</label>
										<input class="col-sm-8 form-control" id="field_2_6" type="number" max-number="1" value="" placeholder=" 1 / 0 ">
									</div>
									
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break; 

								case 3: // perfiles

								$tabla_info = get_info_tabla($op);
								$data_tabla = explode('|', $tabla_info);
								
								$clave = $data_tabla[0];
								$nombre = $data_tabla[1];
								$icono = $data_tabla[2];
																
								$tam_col_form = 6;
								$tam_col_tab = 8;
								
									$campos = '
									
									<input type="hidden" value="4" id="total_campos_form" >
									<input type="hidden" value="'.$op.'" id="table_op" >
									<input type="hidden" value="'.$clave.'" id="table_name" >	
																		
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Clave</label>
										<input class="col-sm-8 form-control" id="field_3_1" type="number" value="" placeholder="Clave Perfil">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Nombre</label>
										<input class="col-sm-8 form-control" id="field_3_2" type="text" value="" placeholder="Nombre">
									</div>
									

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Nom Corto</label>
										<input class="col-sm-8 form-control" id="field_3_3" type="text" value="" placeholder="Nombre Corto">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Icono </label>
										<input class="col-sm-8 form-control" id="field_3_4" type="text" value="" placeholder="fa-example">
									</div>									
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;
								

								case 4: // descuentos
								
								$tabla_info = get_info_tabla($op);
								$data_tabla = explode('|', $tabla_info);
								
								$clave = $data_tabla[0];
								$nombre = $data_tabla[1];
								$icono = $data_tabla[2];

								$tam_col_form = 6;
								$tam_col_tab = 8;
								
									$campos = '

									<input type="hidden" value="2" id="total_campos_form" >
									<input type="hidden" value="'.$op.'" id="table_op" >
									<input type="hidden" value="'.$clave.'" id="table_name" >									
									
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Porcentaje </label>
										<input class="col-sm-8 form-control" id="field_4_1" type="number" value="" placeholder="sin %">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Etiqueta</label>
										<input class="col-sm-8 form-control" id="field_4_2" type="text" value="" placeholder="Etiqueta">
									</div>
									

								
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;
								
								case 5: // estado_recibo 

								$tabla_info = get_info_tabla($op);
								$data_tabla = explode('|', $tabla_info);
								
								$clave = $data_tabla[0];
								$nombre = $data_tabla[1];
								$icono = $data_tabla[2];
								
								$tam_col_form = 6;
								$tam_col_tab = 8;
								
									$campos = '
									<input type="hidden" value="4" id="total_campos_form" >
									<input type="hidden" value="'.$op.'" id="table_op" >
									<input type="hidden" value="'.$clave.'" id="table_name" >										
									
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Clave</label>
										<input class="col-sm-8 form-control" id="field_5_1" type="number" value="" placeholder="Clave">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Etiqueta</label>
										<input class="col-sm-8 form-control" id="field_5_2" type="text" value="" placeholder="Etiqueta">
									</div>
									

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Icono</label>
										<input class="col-sm-8 form-control" id="field_5_3" type="text" value="" placeholder="fa-example">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Color </label>
										<input class="col-sm-8 form-control" id="field_5_4" type="text" value="" placeholder="predefinido">
									</div>									
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;
								

								case 6: // idiomas

								$tabla_info = get_info_tabla($op);
								$data_tabla = explode('|', $tabla_info);
								
								$clave = $data_tabla[0];
								$nombre = $data_tabla[1];
								$icono = $data_tabla[2];
								
								$tam_col_form = 6;
								$tam_col_tab = 7;
								
									$campos = '


									<input type="hidden" value="2" id="total_campos_form" >
									<input type="hidden" value="'.$op.'" id="table_op" >
									<input type="hidden" value="'.$clave.'" id="table_name" >	

									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Nombre </label>
										<input class="col-sm-8 form-control" id="field_6_1" type="text" value="" placeholder="Nombre">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Código</label>
										<input class="col-sm-8 form-control" id="field_6_2" type="text" value="" placeholder="COD. ISO 639-1">
									</div>
									

								
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;
								
								case 7: // Origen del set
								
								$tabla_info = get_info_tabla($op);
								$data_tabla = explode('|', $tabla_info);
								
								$clave = $data_tabla[0];
								$nombre = $data_tabla[1];
								$icono = $data_tabla[2];

								$tam_col_form = 6;
								$tam_col_tab = 7;
								
									$campos = '

									<input type="hidden" value="2" id="total_campos_form" >
									<input type="hidden" value="'.$op.'" id="table_op" >
									<input type="hidden" value="'.$clave.'" id="table_name" >	

									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Descripción </label>
										<input class="col-sm-8 form-control" id="field_7_1" type="text" value="" placeholder="Descripción">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Clave</label>
										<input class="col-sm-8 form-control" id="field_7_2" type="number" value="" placeholder="Clave">
									</div>
									

								
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;

								case 8: // vistas_mosaico

								$tabla_info = get_info_tabla($op);
								$data_tabla = explode('|', $tabla_info);
								
								$clave = $data_tabla[0];
								$nombre = $data_tabla[1];
								$icono = $data_tabla[2];
								
								$tam_col_form = 6;
								$tam_col_tab = 8;
								
									$campos = '
									
									<input type="hidden" value="3" id="total_campos_form" >
									<input type="hidden" value="'.$op.'" id="table_op" >
									<input type="hidden" value="'.$clave.'" id="table_name" >										
									
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Clave</label>
										<input class="col-sm-8 form-control" id="field_8_1" type="number" value="" placeholder="Clave">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Etiqueta</label>
										<input class="col-sm-8 form-control" id="field_8_2" type="text" value="" placeholder="Etiqueta">
									</div>
									

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Tamaño</label>
										<input class="col-sm-8 form-control" id="field_8_3" type="number" value="" placeholder="Tamaño Columna">
									</div>
								
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;


								case 9: // thmas minifiguras
								

								$tabla_info = get_info_tabla($op);
								$data_tabla = explode('|', $tabla_info);
								
								$clave = $data_tabla[0];
								$nombre = $data_tabla[1];
								$icono = $data_tabla[2];
								
								$tam_col_form = 6;
								$tam_col_tab = 8;
								
									$campos = '
									
									<input type="hidden" value="1" id="total_campos_form" >
									<input type="hidden" value="'.$op.'" id="table_op" >
									<input type="hidden" value="'.$clave.'" id="table_name" >										
									
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> CSS  </label>
										<input class="col-sm-8 form-control" id="field_9_1" type="text" value="" placeholder="Nombre del archivo CSS sin extensión.">
									</div>
								
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;
								
								
																																																					
																
								default:

								$tabla_info = get_info_tabla($op);
								$data_tabla = explode('|', $tabla_info);
								
								$clave = $data_tabla[0];
								$nombre = $data_tabla[1];
								$icono = $data_tabla[2];
																
								$tam_col_form = 6;
								$tam_col_tab = 8;
								

				                //////////// crea la tabla                     
				                    
				                    $colss = get_cols_tabla($clave);
				                    
				                    //var_dump($clave);
				                    
				                    $colss = substr($colss,0,-1);
				                    
									$data_colss = explode('|',$colss);
								   	$tot_colss = count($data_colss);
				                    $campos = '';
				                    
				                    
				                    
									for($i=0; $i<$tot_colss; $i++){							
										$contador = $i+1;
									
										if($data_colss[$i] == 'fecha_registro' or $data_colss[$i] == 'id' or $data_colss[$i] == 'fecha_actualizado' ){
	
											$camp.= '
											<input class="col-sm-8 form-control" disabled id="field_'.$op.'_'.$contador.'" type="hidden" value="" placeholder="">
										<div class="row form-group col-sm-12 no-show">
											<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4" style="text-align:left;"> '.strtoupper($data_colss[$i]).' </label>
											
										</div>	
											';
											
										}elseif( $data_colss[$i] == 'estado' ){
	
											$camp.= '
											
										<div class="row form-group col-sm-12">
											<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4" style="text-align:left;"> '.strtoupper($data_colss[$i]).' </label>
											<input class="col-sm-8 form-control" disabled id="field_'.$op.'_'.$contador.'" type="text" value="0" placeholder="">
										</div>	
											';
											
										}else{
											$camp.= '
										<div class="row form-group col-sm-12">
											<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4" style="text-align:left;"> '.strtoupper($data_colss[$i]).' </label>
											<input class="col-sm-8 form-control" id="field_'.$op.'_'.$contador.'" type="text" value="" placeholder="">
										</div>	
											';												
										}
																										
									}


									$campos = '									
									<input type="hidden" value="'.$tot_colss.'" id="total_campos_form" >
									<input type="hidden" value="'.$op.'" id="table_op" >
									<input type="hidden" value="'.$clave.'" id="table_name" >' .$camp;
												
								/////////////								

								//$campos = '<div class="text-primary col-md-12" style="text-align:center;"> <p class="text-muted"> Formulario no disponible </p></div>'; 
								
								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;
								
							}	             
	             
	             }// qyery padre
?>





<div class="col-12" style="height: 559px;">
	<div class="p-1 "> </div>
				
				<div class="row border-right">
					
				
					<div class="col-md-12" style="max-height: 559px; height: 100%; border: 0px solid #c30;  overflow:hidden; overflow-y: hidden; overflow-x: hidden;">
						
						
						<div class="p-2 row border-bottom col-md-12">
							<form action="<?php echo $urlb ?>" method="post" name="pagina_reg">
							<span class="text-muted">Catálogo:</span> <?php echo($select_opts); ?>
							
							
							<button type="submit" value="1" name="modal" class="btn btn-outline-primary"> <i class="fa fa-plus-circle"></i> Agregar Registro</a>
							
						</div>
						</form>
					
					<div class="col-sm-12 bg-light" style="  border: 0px solid #c40;">
						<?php 								
						
						$campo_buscar = crea_campo_buscar_md('table_'.$op); 					
						echo $campo_buscar; 
						
						?>
					</div>
													
							<div class="col-sm-12 row <?php echo $tam_col_tab;?> bg-light" style=" height: 500px; border: 0px solid #c40; overflow: scroll; overflow-x: auto; overflow-y: auto; padding: 10px 15px;">
								
								<?php 
								echo $table_com ; ?>
								
							</div>
							
						
					</div>
				</div>
				







<!------   Modal Agregar Registro ------>
<select onchange="submit(this.value)" ></select>

<div id="nuevo_registro" class="hold_general" style="border: 0px solid #c30; z-index: 9999; height: 100%; width: 100%; display:<?php echo $display; ?>; ">
	<div class="degrade_modal"></div>
		
	<div class="pestana_edita"> 
		<span> <a onclick="toggle('nuevo_registro');" href="#"> <span class="claro"> <i class="fas fa-times"></i> </span> </a> </span> </div>
		
		<div class="col-lg-8 body_edita semi-transparent"  style="overflow-y:hidden ; overflow-x: hidden; margin-top: 30px;  ">
			<div class="p-2 border-bottom text-success">
				<?php echo strtoupper($title_tabla); ?> 
			</div>
			
					
					<div class="col-md-12 grid-margin " style="text-align: center; padding:10px 20px; border-radius: 3px; height: 500px; overflow: scroll; overflow-x: hidden; overflow-y:auto; border-left: 0px solid #ccc;" >
						
						
									<div class="blockquote rounded" style=" padding:20px 0 0 0; margin-bottom: 5px; ">
										
										
										<div class="col-md-12">
											
											<?php echo $campos; ?>
										</div>																
												
										<div class="border-top bg-light " style="margin: 10px 0 0 0; text-align:center; padding: 10px 0px;">
											<?php echo $btn_form ?>
										</div>										
									</div>						
						
						
					</div>
					

		</div>
</div>	

</div> <!--- Scrollble ---->

