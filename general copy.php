
<?php 
	
include("check_access.php");


	$url = 'http://shelf.bricksidemx.com/collector/index.php?mnu=958153f1b8b96ec4c4eb2147429105d9';
	
	$op = $_GET['op'];

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
		
              $qrr = "Select * from conf_catalogos order by id asc;";// preparando la instruccion sql
              

			    $resultr= $dbh->query($qrr);
			    if ($resultr->num_rows > 0) {
				    
// onclick="toggle_tr(\''.$rowr['id'].'\')"
				    
                        while($rowr= $resultr->fetch_assoc()){
					

	                        $users .= '<a href="http://shelf.bricksidemx.com/collector/index.php?mnu=958153f1b8b96ec4c4eb2147429105d9&op='.$rowr['id'].'">
								        <div class="col-md-12 p-1 border-bottom" style="border-top: 0px solid #ccc;">
								             <span class="mb-2" style="font-size:14px;"> <span class="text-primary"> </span> <span class="text-muted"> '.$rowr['nombre'].'</span></span>
								             <input type="hidden" id="val_bus_'.$rowr['id'].'" value="-card_'.$rowr['id'].'-" >
								        </div> 
								        </a>
								        ';

	                    
	                    //// Buscra los registros de cada tabla
	                    
	                    $registros = ''; 
	                    $celdas = ''; 
	                    $rows_t = '';
	                    
	                    $tbody = '';
	                    	$registros = get_reg_tabla($rowr['clave']);
	                    	
	                    	//var_dump($registros);
							$data_reg = explode(';', $registros);
							
							//echo count('No reg: '.$data_reg.'<br>');
							
							for($i=0;$i < count($data_reg)-1; $i++){
								
								$data_reg_sub = explode('--', $data_reg[$i]);
								
								$limit_cel = count($data_reg_sub);
								
								for($j=0; $j < $limit_cel ; $j++){
									

										
										switch($rowr['clave']){
										
										case 'moneda':

																				
											if($j==0){
												$celdas .= '
												<td> '.$data_reg_sub[$j].'  
													<input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="hidden" value="'.$data_reg_sub[$j].'">
												</td>';
											}elseif($j==4){
																						
												if($data_reg_sub[$j]==0){
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-secondary"><i class="fa fa-toggle-off fa-md"></i></span> </a>';
												}else{
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-success"><i class="fa fa-toggle-on fa-md"></i></span> </a>';
												}

												$celdas .= '
												<td>  '.$ico_edo.'
												<input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="hidden" value="'.$data_reg_sub[$j].'">
												</td>';	
											
											}else{
												$celdas .= '<td> <input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="text" value="'.$data_reg_sub[$j].'"> </td>';
											}
											
											
								$btn_save = '<button class="btn btn-outline-secondary btn-thin text-muted" onclick="save_mnu_cat(\'1-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <i class="fa fa-save"></i> </button>';
								
								$btn_del = '<button class="btn btn-outline-secondary btn-thin text-muted" onclick="save_mnu_cat(\'2-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')"> <i class="fa fa-trash"></i> </button>';
											
										break;

										
										case 'estado_sug':
										
										$campos_.$$rowr['clave'] = 'Hola Mundo 2';
										
											if($j==0 or $j==1 ){
												$celdas .= '
												<td> '.$data_reg_sub[$j].' 
												<input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="hidden" value="'.$data_reg_sub[$j].'">
												</td>';
											}elseif($j==5){
																						
												if($data_reg_sub[$j]==0){
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-secondary"><i class="fa fa-toggle-off fa-md"></i></span> </a>';
												}else{
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-success"><i class="fa fa-toggle-on fa-md"></i></span> </a>';
												}

												$celdas .= '
												<td>  '.$ico_edo.'
												<input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="hidden" value="'.$data_reg_sub[$j].'">
												</td>';	
											
											}elseif($j==6){
												
											
											$celdas .= '<td> <input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="number" value="'.$data_reg_sub[$j].'"> </td>';
											
											}elseif($j==7){
																						
												if($data_reg_sub[$j]==0){
													
													$ico_edo_c = '<a href="#" onclick="save_mnu_cat(\'3-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-disabled"><i class="fa fa-toggle-off fa-md"></i></span> </a>';
												}else{
													
													$ico_edo_c = '<a href="#" onclick="save_mnu_cat(\'3-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-primary"><i class="fa fa-toggle-on fa-md"></i></span> </a>';
												}

												$celdas .= '
												<td>  '.$ico_edo_c.'
												<input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="hidden" value="'.$data_reg_sub[$j].'">
												</td>';	
											
											}else{
												$celdas .= '<td> <input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="text" value="'.$data_reg_sub[$j].'"> </td>';
											}
											
								$btn_save = '<button class="btn btn-outline-secondary btn-thin text-muted" onclick="save_mnu_cat(\'1-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <i class="fa fa-save"></i> </button>';
								
								$btn_del = '<button class="btn btn-outline-secondary btn-thin text-muted" onclick="save_mnu_cat(\'2-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')"> <i class="fa fa-trash"></i> </button>';
								
								
											
										break;	
																									
										case 'perfiles':
										
											if($j==0){
												$celdas .= '<td> '.$data_reg_sub[$j].'
													<input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="hidden" value="'.$data_reg_sub[$j].'">
												 </td>';
											}elseif($j==3){
																						
												if($data_reg_sub[$j]==0){
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-disabled"><i class="fa fa-toggle-off fa-md"></i></span> </a>';
												}else{
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-success"><i class="fa fa-toggle-on fa-md"></i></span> </a>';
												}

												$celdas .= '
												<td>  '.$ico_edo.'
												<input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="hidden" value="'.$data_reg_sub[$j].'">
												</td>';	
											
											}else{
												$celdas .= '<td> <input id="'.$rowr['clave'].'-'.$j.'" class="form-control" type="text" value="'.$data_reg_sub[$j].'"> </td>';
											}
											
										break;

										case 'descuentos':
										
											if($j==0){
												$celdas .= '<td> '.$data_reg_sub[$j].' </td>';
											}elseif($j==3){  // estado
																						
												if($data_reg_sub[$j]==0){
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-secondary"><i class="fa fa-toggle-off fa-md"></i></span> </a>';
												}else{
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-success"><i class="fa fa-toggle-on fa-md"></i></span> </a>';
												}

												$celdas .= '
												<td>  '.$ico_edo.'
												<input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="hidden" value="'.$data_reg_sub[$j].'">
												</td>';	
											
											}else{
												$celdas .= '<td> <input class="form-control" type="text" value="'.$data_reg_sub[$j].'"> </td>';
											}
										break;


										case 'estado_recibo':
										
											if($j==0){
												$celdas .= '<td> '.$data_reg_sub[$j].' </td>';
											}elseif($j==5){
																						
												if($data_reg_sub[$j]==0){
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-secondary"><i class="fa fa-toggle-off fa-md"></i></span> </a>';
												}else{
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-success"><i class="fa fa-toggle-on fa-md"></i></span> </a>';
												}

												$celdas .= '
												<td>  '.$ico_edo.'
												<input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="hidden" value="'.$data_reg_sub[$j].'">
												</td>';	
											
											}else{
												$celdas .= '<td> <input class="form-control" type="text" value="'.$data_reg_sub[$j].'"> </td>';
											}
											
										break;
																														
										case 'idiomas':
										
											if($j==0 or $j==2){
												$celdas .= '<td> '.$data_reg_sub[$j].' </td>';
											}elseif($j==3){
																						
												if($data_reg_sub[$j]==0){
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-secondary"><i class="fa fa-toggle-off fa-md"></i></span> </a>';
												}else{
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-success"><i class="fa fa-toggle-on fa-md"></i></span> </a>';
												}

												$celdas .= '
												<td>  '.$ico_edo.'
												<input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="hidden" value="'.$data_reg_sub[$j].'">
												</td>';	
											
											}else{
												$celdas .= '<td> <input class="form-control" type="text" value="'.$data_reg_sub[$j].'"> </td>';
											}
										break;

										case 'origen_set_cat':
										
											if($j==0){
												$celdas .= '<td> '.$data_reg_sub[$j].' </td>';
											}elseif($j==3){
																						
												if($data_reg_sub[$j]==0){
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-secondary"><i class="fa fa-toggle-off fa-md"></i></span> </a>';
												}else{
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-success"><i class="fa fa-toggle-on fa-md"></i></span> </a>';
												}

												$celdas .= '
												<td>  '.$ico_edo.'
												<input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="hidden" value="'.$data_reg_sub[$j].'">
												</td>';	
											
											}else{
												$celdas .= '<td> <input class="form-control" type="text" value="'.$data_reg_sub[$j].'"> </td>';
											}
										break;

										case 'vistas_mosaico':
										
											if($j==0){
												$celdas .= '<td> '.$data_reg_sub[$j].' </td>';
											}elseif($j==3){
																						
												if($data_reg_sub[$j]==0){
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-secondary"><i class="fa fa-toggle-off fa-md"></i></span> </a>';
												}else{
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-success"><i class="fa fa-toggle-on fa-md"></i></span> </a>';
												}

												$celdas .= '
												<td>  '.$ico_edo.'
												<input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="hidden" value="'.$data_reg_sub[$j].'">
												</td>';	
											
											}else{
												$celdas .= '<td> <input class="form-control" type="text" value="'.$data_reg_sub[$j].'"> </td>';
											}
										break;

										case 'conf_catalogos':
										
											if($j==0 or $j==1){
												$celdas .= '<td> <span class="text-muted" >'.$data_reg_sub[$j].' </span> 
												<input class="form-control" type="hidden" value="'.$data_reg_sub[$j].'"> 
												</td>';
											}elseif($j==3){
																						
												if($data_reg_sub[$j]==0){
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-secondary"><i class="fa fa-toggle-off fa-md"></i></span> </a>';
												}else{
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-success"><i class="fa fa-toggle-on fa-md"></i></span> </a>';
												}

												$celdas .= '
												<td>  <span class="text-muted" >'.$ico_edo.'</span>
												<input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="hidden" value="'.$data_reg_sub[$j].'">
												</td>';	
											
											}else{
												$celdas .= '<td> <input class="form-control" type="text" value="'.$data_reg_sub[$j].'"> </td>';
											}
										break;
																														

										case 'css_files_fig':
										
											if($j==0){
												$celdas .= '<td> '.$data_reg_sub[$j].' </td>';
											}elseif($j==2){
																						
												if($data_reg_sub[$j]==0){
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-secondary"><i class="fa fa-toggle-off fa-md"></i></span> </a>';
												}else{
													
													$ico_edo = '<a href="#" onclick="save_mnu_cat(\'4-'.$rowr['clave'].'-'.$data_reg_sub[0].'\')" > <span class="text-success"><i class="fa fa-toggle-on fa-md"></i></span> </a>';
												}

												$celdas .= '
												<td>  '.$ico_edo.'
												<input class="form-control" id="'.$rowr['clave'].'-'.$j.'" type="hidden" value="'.$data_reg_sub[$j].'">
												</td>';	
											
											}else{
												$celdas .= '<td> <input class="form-control" type="text" value="'.$data_reg_sub[$j].'"> </td>';
											}
											
										break;
																				
										default:
										
										
											if($j==0){
												$celdas .= '<td> '.$data_reg_sub[$j].' </td>';
											}else{
												$celdas .= '<td> <input class="form-control" type="text" value="'.$data_reg_sub[$j].'"> </td>';
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
							
							//// crea el formulario 
							

							
							///
							
	                    
	                    if($rowr['id']== $op){
		                    $disp = 'block';
		                    $title_tabla = $rowr['nombre']; 
		                    $fields = $campos_.$$rowr['clave'];
		                    
	                    }else{
		                    $disp = 'none';
	                    }
	                    
	                    //////////// crea la tabla 
	                    
	                    switch($rowr['clave']){
		                    case 'moneda': 
		                    
		                   
		                    
		                    $table_com .= '
		                    <cardr class="grid-margin" style="display:'.$disp.';" searchable="-card_'.$rowr['id'].'-" id="card_'.$rowr['id'].'">
		                    <table class="table table-striped " >
				                      <thead>
				                        <tr>
				                          <th class="text-light" style="background: #13423b;"> ID </th>
				                          <th class="text-light" style="background: #13423b;"> Clave </th>
				                          <th class="text-light" style="background: #13423b;"> Nombre </th>
				                          <th class="text-light" style="background: #13423b;"> Valor</th>
				                          <th class="text-light" style="background: #13423b;"> Estado </th>
				                          <th class="text-light" style="background: #13423b;"> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$tbody.'
				            </table>	
				            </cardr>	                    
		                    '; 
		                    
		                    
		                    
		                    
		                    
		                    
		                    break; 

		                    case 'estado_sug': 
		                    $table_com .= '
		                    <cardr class="grid-margin" style="display:'.$disp.';" searchable="-card_'.$rowr['id'].'-" id="card_'.$rowr['id'].'">
		                    <table class="table table-striped " >
				                      <thead>
				                        <tr>
				                          <th class="text-light" style="background: #13423b;"> ID </th>
				                          <th class="text-light" style="background: #13423b;"> Clave </th>
				                          <th class="text-light" style="background: #13423b;"> Nombre </th>
				                          <th class="text-light" style="background: #13423b;"> Icono</th>
				                          <th class="text-light" style="background: #13423b;"> Color </th>
				                          <th class="text-light" style="background: #13423b;"> Estado </th>
				                          <th class="text-light" style="background: #13423b;"> Avance</th>
				                          <th class="text-light" style="background: #13423b;"> Coment. </th>
				                          <th class="text-light" style="background: #13423b;"> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$tbody.'
				            </table>	
				            </cardr>	                    
		                    '; 

		                    
		                    		                    
		                    break;

		                    case 'perfiles': 
		                    
		                    
		                    $table_com .= '
		                    <cardr class="grid-margin" style="display:'.$disp.';" searchable="-card_'.$rowr['id'].'-" id="card_'.$rowr['id'].'">
		                    <table class="table table-striped " >
				                      <thead>
				                        <tr>
				                          <th class="text-light" style="background: #13423b;"> ID 		</th>
				                          <th class="text-light" style="background: #13423b;"> Clave 	</th>
				                          <th class="text-light" style="background: #13423b;"> Nombre 	</th>
				                          <th class="text-light" style="background: #13423b;"> Estado 	</th>
				                          <th class="text-light" style="background: #13423b;"> Nombre Corto</th>
				                          <th class="text-light" style="background: #13423b;"> Icono	</th>
				                          <th class="text-light" style="background: #13423b;"> Opciones	</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$tbody.'
				            </table>	
				            </cardr>	                    
		                    '; 
		                    
		                    break;

		                    case 'descuentos': 
		                    
		                    
		                    $table_com .= '
		                    <cardr class="grid-margin" style="display:'.$disp.';" searchable="-card_'.$rowr['id'].'-" id="card_'.$rowr['id'].'">
		                    <table class="table table-striped " >
				                      <thead>
				                        <tr>
				                          <th class="text-light" style="background: #13423b;"> ID </th>
				                          <th class="text-light" style="background: #13423b;"> Porcentaje </th>
				                          <th class="text-light" style="background: #13423b;"> Etiqueta </th>
				                          <th class="text-light" style="background: #13423b;"> Estado </th>
				                          <th class="text-light" style="background: #13423b;"> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$tbody.'
				            </table>	
				            </cardr>	                    
		                    '; 
		                    
		                    break;

		                    case 'estado_recibo': 
		                    
		                    
		                    $table_com .= '
		                    <cardr class="grid-margin" style="display:'.$disp.';" searchable="-card_'.$rowr['id'].'-" id="card_'.$rowr['id'].'">
		                    <table class="table table-striped " >
				                      <thead>
				                        <tr>
				                          <th class="text-light" style="background: #13423b;"> ID </th>
				                          <th class="text-light" style="background: #13423b;"> Clave </th>
				                          <th class="text-light" style="background: #13423b;"> Etiqueta </th>
				                          <th class="text-light" style="background: #13423b;"> Icono</th>
				                          <th class="text-light" style="background: #13423b;"> Color </th>
				                          <th class="text-light" style="background: #13423b;"> Estado</th>
				                          <th class="text-light" style="background: #13423b;"> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$tbody.'
				            </table>	
				            </cardr>	                    
		                    '; 
		                    
		                    break;
		                    
		                    case 'idiomas': 
		                    
		                    
		                    $table_com .= '
		                    <cardr class="grid-margin" style="display:'.$disp.';" searchable="-card_'.$rowr['id'].'-" id="card_'.$rowr['id'].'">
		                    <table class="table table-striped " >
				                      <thead>
				                        <tr>
				                          <th class="text-light" style="background: #13423b;"> ID </th>
				                          <th class="text-light" style="background: #13423b;"> Nombre</th>
				                          <th class="text-light" style="background: #13423b;"> COD. ISO 639-1</th>
				                          <th class="text-light" style="background: #13423b;"> Estado </th>
				                          <th class="text-light" style="background: #13423b;"> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$tbody.'
				            </table>	
				            </cardr>	                    
		                    '; 
		                    
		                    break;		                    

		                    case 'origen_set_cat': 
		                    
		                    
		                    $table_com .= '
		                    <cardr class="grid-margin" style="display:'.$disp.';" searchable="-card_'.$rowr['id'].'-" id="card_'.$rowr['id'].'">
		                    <table class="table table-striped " >
				                      <thead>
				                        <tr>
				                          <th class="text-light" style="background: #13423b;"> ID </th>
				                          <th class="text-light" style="background: #13423b;"> Descripción </th>
				                          <th class="text-light" style="background: #13423b;"> Clave </th>
				                          <th class="text-light" style="background: #13423b;"> Estado </th>
				                          <th class="text-light" style="background: #13423b;"> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$tbody.'
				            </table>	
				            </cardr>	                    
		                    '; 
		                    
		                    break;

		                    case 'vistas_mosaico': 
		                    
		                    
		                    $table_com .= '
		                    <cardr class="grid-margin" style="display:'.$disp.';" searchable="-card_'.$rowr['id'].'-" id="card_'.$rowr['id'].'">
		                    <table class="table table-striped " >
				                      <thead>
				                        <tr>
				                          <th class="text-light" style="background: #13423b;"> ID </th>
				                          <th class="text-light" style="background: #13423b;"> Clave </th>
				                          <th class="text-light" style="background: #13423b;"> Nombre </th>
				                          <th class="text-light" style="background: #13423b;"> Estado </th>
				                          <th class="text-light" style="background: #13423b;"> Tamaño </th>
				                          <th class="text-light" style="background: #13423b;"> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$tbody.'
				            </table>	
				            </cardr>	                    
		                    '; 
		                    
		                    break;

		                    case 'conf_catalogos': 
		                    
		                    
		                    $table_com .= '
		                    <cardr class="grid-margin" style="display:'.$disp.';" searchable="-card_'.$rowr['id'].'-" id="card_'.$rowr['id'].'">
		                    <table class="table table-striped " >
				                      <thead>
				                        <tr>
				                          <th class="text-light" style="background: #13423b;"> ID </th>
				                          <th class="text-light" style="background: #13423b;"> Tabla  </th>
				                          <th class="text-light" style="background: #13423b;"> Nombre </th>
				                          <th class="text-light" style="background: #13423b;"> Estado </th>
				                          <th class="text-light" style="background: #13423b;"> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$tbody.'
				            </table>	
				            </cardr>	                    
		                    '; 
		                    
		                    break;		                    

		                    case 'css_files_fig': 
		                    
		                    
		                    $table_com .= '
		                    
		                    <cardr class="grid-margin" style="display:'.$disp.';" searchable="-card_'.$rowr['id'].'-" id="card_'.$rowr['id'].'">
		                    
		                    <table class="table table-striped " >
				                      <thead>
				                        <tr>
				                          <th class="text-light" style="background: #13423b;"> ID </th>
				                          <th class="text-light" style="background: #13423b;"> Nombre CSS </th>
				                          <th class="text-light" style="background: #13423b;"> Estado </th>
				                          <th class="text-light" style="background: #13423b;"> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$tbody.'
				            </table>	
				            </cardr>	                    
		                    '; 
		                    
		                    break;	
		                    		                    	                    		                    		                    		                    		                    
		                    default: 

		                    $table_com .= '
		                    <cardr class="grid-margin" style="display:'.$disp.';" searchable="-card_'.$rowr['id'].'-" id="card_'.$rowr['id'].'">
		                    <table class="table table-striped " >
				                      <thead>
				                        <tr>
				                          <th class="text-light" style="background: #13423b;">  </th>
				                          <th class="text-light" style="background: #13423b;"> </th>
				                          <th class="text-light" style="background: #13423b;"> </th>
				                          <th class="text-light" style="background: #13423b;">  </th>
				                          <th class="text-light" style="background: #13423b;">  </th>
				                          <th class="text-light" style="background: #13423b;"> </th>
				                        </tr>
				                      </thead>
				                      
				                      '.$tbody.'
				            </table>
				            </cardr>		                    
		                    '; 
		                    
		                   

		                    break;
	                    } 
	                    
	                    
		   	  		  	
	   	  		  

	                    	            
	             }// while Fila padre
	             
							switch($op) {
								
								case 1: // moneda
								
								$tam_col_form = 4;
								$tam_col_tab = 8;
								
									$campos = '
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Clave</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-1" type="text" value="" placeholder="Clave Moneda ">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Nombre</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-1" type="text" value="" placeholder="nombre">
									</div>
									

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Valor</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-1" type="number" value="" placeholder="Valor">
									</div>
									
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break; 

								case 2: //estado_sug
								
								$tam_col_form = 3;
								$tam_col_tab = 9;
								
									$campos = '
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Clave</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-1" type="text" value="" placeholder="Clave Moneda ">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Nombre</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-2" type="text" value="" placeholder="nombre">
									</div>
									

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Icono </label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-3" type="text" value="" placeholder="fa-example">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Color</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-4" type="text" value="" placeholder="predefined">
									</div>									

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Avance</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-5" type="number" value="" placeholder="Avance">
									</div>
									
									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Req. Coment</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-6" type="number" max-number="1" value="" placeholder=" 1 / 0 ">
									</div>
									
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break; 

								case 3: // perfiles
								
								$tam_col_form = 4;
								$tam_col_tab = 8;
								
									$campos = '
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Clave</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-1" type="number" value="" placeholder="Clave Perfil">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Nombre</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-2" type="text" value="" placeholder="Nombre">
									</div>
									

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Nom Corto</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-3" type="number" value="" placeholder="Nombre Corto">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Icono </label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-4" type="text" value="" placeholder="fa-example">
									</div>									
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;
								

								case 4: // descuentos
								
								$tam_col_form = 4;
								$tam_col_tab = 8;
								
									$campos = '
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Porcentaje </label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-1" type="number" value="" placeholder="sin %">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Etiqueta</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-2" type="text" value="" placeholder="Etiqueta">
									</div>
									

								
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;
								
								case 5: // estado_recibo 
								
								$tam_col_form = 4;
								$tam_col_tab = 8;
								
									$campos = '
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Clave</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-1" type="number" value="" placeholder="Clave">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Etiqueta</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-2" type="text" value="" placeholder="Etiqueta">
									</div>
									

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Icono</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-3" type="text" value="" placeholder="fa-example">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Color </label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-4" type="text" value="" placeholder="predefinido">
									</div>									
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;
								

								case 6: // idiomas
								
								$tam_col_form = 6;
								$tam_col_tab = 6;
								
									$campos = '
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Nombre </label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-1" type="text" value="" placeholder="Nombre">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Código</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-2" type="text" value="" placeholder="COD. ISO 639-1">
									</div>
									

								
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;
								
								case 7: // Origen del set
								
								$tam_col_form = 5;
								$tam_col_tab = 7;
								
									$campos = '
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Descripción </label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-1" type="text" value="" placeholder="Descripción">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Clave</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-2" type="number" value="" placeholder="Clave">
									</div>
									

								
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;

								case 8: // vistas_mosaico
								
								$tam_col_form = 4;
								$tam_col_tab = 8;
								
									$campos = '
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Clave</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-1" type="number" value="" placeholder="Clave">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Etiqueta</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-2" type="text" value="" placeholder="Etiqueta">
									</div>
									

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Tamaño</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-3" type="number" value="" placeholder="Tamaño Columna">
									</div>
								
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;


								case 9: // Origen del set
								
								$tam_col_form = 4;
								$tam_col_tab = 8;
								
									$campos = '
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> CSS  </label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-1" type="text" value="" placeholder="Nombre del archivo CSS sin extensión.">
									</div>
								
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;
								
								
								case 10: // Conf Catalogos
								
								$tam_col_form = 4;
								$tam_col_tab = 8;
								
									$campos = '
									<div class="row form-group col-sm-12 ">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Tabla </label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-1" type="text" value="" placeholder="Nombre de la tabla en BD">
									</div>

									<div class="row form-group col-sm-12">
										<label for="fiel_'.$rowr['clave'].'-1" class="col-form-label col-sm-4"> Clave</label>
										<input class="col-sm-8 form-control" id="fiel_'.$rowr['clave'].'-2" type="text" value="" placeholder=" Título">
									</div>
									

								
									';

								$btn_form = '<a  class="btn btn-outline-secondary text-neutral" onclick="add_reg(\''.$op.'\')" ><i class="fa fa-save"></i> Agregar </a>';
								
								break;																																															
																
								default:

								$tam_col_form = 4;
								$tam_col_tab = 8;
								
								$campos = '<div class="text-primary col-md-12" style="text-align:center;"> <p class="text-muted"> Formulario no disponible </p></div>'; 
								
								$btn_form ='';
								
								break;
								
							}	             
	             
	             }// qyery padre
?>


<div class="scrollable" style="overflow-x: hidden; overflow-y: hidden; "  >

		
			
			
			<div id="pestanas" class="row col-lg-12">
				<a class="col-md-2 text-muted" href="<?php echo $url.'&op=1'; ?>"> <div class="pes bg-light"><h5>Catálogos</h5></div></a> 
				<a class="col-md-2 text-muted" href="<?php echo $url.'&op=2'; ?>"> <div class="pes bg-secondary "><h5>Menu 2</h5></div></a> 
				<a class="col-md-2 text-muted" href="<?php echo $url.'&op=3'; ?>"> <div class="pes bg-secondary "><h5>Menu 3</h5></div></a>
			</div>


<div class="col-12 border">
	<div class="p-1 "> </div>
				
		<div class="row border-right">
			<div class="col-md-2 border-right;" style="max-height: 500x; height: 500px; border-right: 1px solid #ccc;  overflow: scroll; overflow-y: auto; overflow-x: hidden;">
						<?php echo $users; ?>
				</div>
				
				<div class="col-md-10" style="max-height: 500px; height: 500px;  overflow: scroll; overflow-y: auto; overflow-x: hidden;">
					<div class="row"> 
						
						<div class="col-sm-<?php echo $tam_col_form;?>">
							
							<div class="p-2 border-bottom " ><h5 class="text-success"> <?php echo strtoupper($title_tabla); ?></h5> </div>

							<div class="blockquote rounded" style="padding: 0px;  margin-bottom: 5px; ">
								<div class="bg-secondary grid-margin" style="padding: 5px 0 5px 10px;" >
									
									<h6 style="margin-bottom: 0;">
									<span style="margin-right: 3px; "><i class="fa fa-plus-circle"></i></span> 
									Agregar
									

										<a  class="btn btn-outline-secondary " onclick="toggle('m_new')" style="float:right; margin-top:-5px; ">
											<i class="fa fa-angle-down"></i>
										</a>

									</h6> 
								</div>
								
								<div class="col-md-12">
									<?php echo $campos; ?>
								</div>																
										
								<div class="border-top bg-light " style="margin: 10px 0 0 0; text-align:center; padding: 10px 0px;">
									<?php echo $btn_form ?>
								</div>										
							</div>
									

							</div>
							
							<div class="col-sm-<?php echo $tam_col_tab;?>">
								<?php echo $table_com ; ?>
							</div>
							
						</div>
					</div>
				</div>
				

	</div>


</div>
