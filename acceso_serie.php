<?php 
	include("check_access.php");
	// $tipo: 1. Lateral, 2. Perfil

 $modal =$_GET['mdl']; 
 $obj =$_GET['obj']; 
 
 if($modal==1){
	 $display = 'block;'; 
 }else{
  $display = 'none;';
 }



$perfiles = ' <option value="X" >Elije...</option>'.generaListPerfiles(0);

	
	
	function getmnuchild($id){
		
	require("access.php");
		$dbh= new mysqli($dbserver,$dbuser,$dbpwd, $dbname);
		//var_dump($dbpwd);
					
		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}
		
		$qb = "SELECT * FROM menus WHERE mnu_padre= $id and nivel = 3";// preparando la instruccion sql
							$resultb= $dbh->query($qb);
							if ($resultb->num_rows > 0) { // Si la consulta trae registro, cambia el estado
								while($rowb= $resultb->fetch_assoc()){
									
									if($rowb['nivel']>=0){
										$posicion = '										
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Posición</label>
											<div class="col-sm-9">
												<input class="form-control" type="text" id="nivel_'.$rowb['id'].'" value= "'.$rowb['nivel'].'">
												
												<!--<select>
												<option value="0">Elije...</option>
												<option value="3">Botón en título</option>
												<option value="2">Submenu</option>
												</select>-->
												
												<select class="form-control" id="nivel_'.$rowb['id'].'" >												
													'.genera_select_posicion_menu($rowb['nivel']).'
												</select>
											
											</div>
										</div>';
									}
									
					$estado = $rowb['estado'];
					
			if($estado==1){
				$btn_estado = '<a  class="btn btn-outline-secondary text-neutral" onclick="estado_menu(\''.$rowb['id'].'\')" ><i class="fa fa-toggle-off"></i> </a>';
				$ico_estado = '<span class="mnu_btn" onclick="estado_menu(\''.$rowb['id'].'\')"><i class="fa fa-eye"></i></span>'; 
			}else{
				$btn_estado = '<a  class="btn btn-outline-secondary text-neutral" onclick="estado_menu(\''.$rowb['id'].'\')" ><i class="fa fa-toggle-on"></i> </a>';
				$ico_estado = '<span class="mnu_btn" onclick="estado_menu(\''.$rowb['id'].'\')"><i class="fa fa-eye-slash"></i></span>'; 	
			}
					
						$submenu .= '
									<div class="blockquote rounded" style="padding: 0px; margin-left:25px; ">
									<div class="bullet_menu_l3"></div>
									
									<div class="bg-light" style="padding: 5px 0 5px 10px; margin-bottom:0px; " >
										<h6 style="margin-bottom: 0; font-size: 12px;">
										<span style="margin-right: 3px; "><i class="fa fa-'.$rowb['icon'].'"></i></span> 
										'.$rowb['title'].'
										 
										
											<a  class="mnu_btn" onclick="toggle(\''.'s_'.$rowb['id'].'\')" >
												<i class="fa fa-angle-down"></i>
											</a>
											'.$ico_estado.'
	
										</h6> 
									</div>
									
									<div class="" style="padding:0px; display:none; " id="s_'.$rowb['id'].'" >
										
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">ID</label>
											<div class="col-sm-9">
												<input disabled  class="form-control" type="text" value= "'.$rowb['id'].'">
												<input id="id_'.$rowb['id'].'" type="hidden" value= "'.$rowb['id'].'">
												
											</div>
										</div>	
										
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Nombre</label>
											<div class="col-sm-9">
												<input class="form-control" id="title_'.$rowb['id'].'" type="text" value= "'.$rowb['title'].'">
																								
											</div>
										</div>
																				
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Clave</label>
											<div class="col-sm-9">
											<input class="form-control" type="text" id="cve_'.$rowb['id'].'" value= "'.$rowb['cve'].'">
											</div>
										</div>
									
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Archivo</label>
											<div class="col-sm-9">
												<input class="form-control" type="text" id="file_'.$rowb['id'].'" value= "'.$rowb['link'].'">
											</div>
										</div>


										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Icono</label>
											<div class="col-sm-9">
												<input class="form-control" type="text" id="file_'.$rowb['id'].'" value= "'.$rowb['icon'].'">
											</div>
										</div>
										
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">NodoP:</label>
											<div class="col-sm-9">
											
											<select class="form-control" id="id_padre_'.$rowb['id'].'" >
												<option value="999">Elije...</option>
												<option value="9999">Sin Clasificar</option> 
												<option value="99">Op. Perfil</option> 
												<option value="0">Barra Lateral</option> 
												'.dropmenupadre($rowb['mnu_padre']).'
											</select>
											
											
												<input  type="hidden" id="id_padre_original_'.$rowb['id'].'" value= "'.$rowb['mnu_padre'].'">
											</div>
										</div>									


										'.$posicion.'
										
										<div class="border-top bg-light " style="margin: 10px 0 0 0; text-align:center; padding: 10px 0px;">
											<a  class="btn btn-outline-secondary text-neutral" onclick="save_menu(\''.$rowb['id'].'\')" ><i class="fa fa-save"></i> </a>
											<a  class="btn btn-outline-secondary text-neutral" onclick="elimina_menu(\''.$rowb['id'].'\')"><i class="fa fa-trash"></i> </a>
											'.$btn_estado.'
										</div>	
									</div>
									
								 </div>
								 '; 
								}
							 
							}else{
								$submenu .= ""; 
							}
							return $submenu;
		
	}
	
	
	//----- ---/
	
	$list_temas = '<option value="X" selected >Elije...</option>'.generaListTiposerie(0);
	$list_series ='<option value="X" selected >Elije...</option>'.generaListEstadoSerie(0);
	$list_perfil ='<option value="X" selected >Elije...</option>'.generaListPerfilesCode(0);
	$list_opcionales ='<option value="X" selected >Elije...</option>'.generaListEstadoUserOpcional(0);

	$list_permisos_serie = '<option value="X" >Elije...</option>'.generaListPermisoVistaSerie(0);
	
	//var_dump($list_permisos_serie);
/* 
	<select class="col-sm-6 form-control" style="margin-right:5px; margin-left:5px; "  id="select_nvo"> \
				<option value="X" >Elije...</option> \
				<option value="0" >No Mostrar Serie</option> \
				<option value="1" >Mostrar Serie</option> \
				<option value="3" >Donativo </option>
*/

?>

<!--<input type="text" id="current_permisos_vista" value="<?php $list_permisos_serie; ?>">-->
<textarea class="no-show" id="current_permisos_vista"><?php echo $list_permisos_serie; ?></textarea>



				<div class="col-5 stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title text-azul">Minifiguras
	                        <span class=" col-md-4  text-clear col-form-label " style="font-size: 12px;" id="code_minifig"></span>
	                        <input type="text" class="col-md-4 text-clear form-control border" style="display: none;" onblur="decode_minifig(this.value)" value="" id="code_minifig_e">
	                        <button type="button" class="btn btn-outline-secondary" onclick="toggle('code_minifig_e'); inter_minifig();"><i class="fa fa-pencil"></i></span>
	                        

                        </h4>
                        
						<div class="form-group row col-12 border-bottom bg-head" >
		                        
		                        		<span class="col-6" style="font-size: 12px; " id="resultado_val"></span>
		                        		<span class=" col-6 " id="resultado_valb" style="text-align: right; float: right;"> </span>
	                    </div>
                        <p class="card-description">  </p>
                        
                          
                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-4 col-form-label">Tipo de Serie</label>
                            <div class="col-sm-6">
                              		<select class="form-control" id="select_0" onchange="valida_select_serie(this.id);">
										<?php echo $list_temas; ?>
									</select>		
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-4 col-form-label">Estado Serie</label>
                            <div class="col-sm-6">
                              		<select class="form-control" id="select_1" onchange="valida_select_serie(this.id);">
							  			<?php echo $list_series; ?>			
									</select>		
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-4 col-form-label">Tipo Donativo</label>
                            <div class="col-sm-6">
								<select class="form-control" id="select_2" onchange="valida_select_serie(this.id);">
									<option value="x">Elija...</option>
									<option value="A">Serie Premium</option>
									<option value="B">Serie Regular</option>
								</select>			
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-4 col-form-label">Pago</label>
                            <div class="col-sm-6">
                              		<select class="form-control" id="select_3" onchange="valida_select_serie(this.id);">
										<option value="X" >Elije...</option> 
										<option value="A" >Pagado</option> 
										<option value="B" >Sin Pago  </option>
										<option value="C" >Excento de Pago </option> 
									</select>		
                            </div>
                          </div>  
                          
                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-4 col-form-label">Perfil Usuario</label>
                            <div class="col-sm-6">
                              		
									<select class="form-control"  id="select_4" onchange="valida_select_serie(this.id);">
										<?php echo $list_perfil; ?>
									</select>	
                            </div>
                          </div>
 
                           <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-4 col-form-label">Tipo de Vista</label>
                            <div class="col-sm-6">
                              			    
								<select  class="form-control" id="select_5" onchange="valida_select_serie(this.id);">
									<option value="X" >Elije...</option> 
									<option value="A" > Todas las Figuras</option> 
									<option value="B" > Serie Específica </option> 
								</select>	            
		
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-4 col-form-label">Selección Usuario</label>
                            <div class="col-sm-6">
                              		<select  class="form-control" id="select_6" onchange="valida_select_serie(this.id);">
										<option value="X" >Elije...</option> 
										<option value="A" >Seleccionada por Usuario</option> 
										<option value="B" >No Activada </option>
									</select>		
                            </div>
                          </div>                                                                                           
                        
						  <textarea class="no-show"  id="per_act" > <?php echo $perfiles; ?> </textarea>
						  <input type="text" class="form-control" id="code_vista">
						  <input type="text" class="form-control" id="config_colection_minifig" value="A">
                      </div>
                    </div>
                  </div>


				<div class="col-5 stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title text-azul"> Colecciones (Mosaico)
	                        <span class=" col-md-4  text-clear col-form-label" style="font-size: 12px;" id="code_series_b"></span>
	                        <input type="text" class="col-md-4 text-clear form-control border" style="display: none;" onblur="decode_series(this.value)" value="" id="code_series_e">
	                        <button type="button" class="btn btn-outline-secondary" onclick="toggle('code_series_e'); inter_series();"><i class="fa fa-pencil"></i></span>                     

                        </h4>
                        
						<div class="form-group row col-12 border-bottom bg-head" >
		                        
		                        		<span class="col-6" style="font-size: 12px; " id="resultado_val_colect"></span>
		                        		<span class=" col-6 " id="resultado_valb_colect" style="text-align: right; float: right;"> </span>
	                    </div>
                        <p class="card-description">  </p>
                        
                          
                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Tipo de Serie</label>
                            <div class="col-sm-9">
                              		<select class="form-control" id="select_col_1" onchange="valida_select_colec(this.id);">
										<?php echo $list_temas; ?>
									</select>	
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Estado Serie</label>
                            <div class="col-sm-9">
                              		<select class="form-control" disabled="" id="select_col_2" onchange="valida_select_colec(this.id);">
										<?php echo $list_series; ?>										
									</select>			
                            </div>
                          </div>


                          
                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Perfil Usuario</label>
                            <div class="col-sm-9">
                              		
									<select class="form-control" disabled="" id="select_col_3" onchange="valida_select_colec(this.id);">
										<?php echo $list_perfil; ?>
									</select>	
                            </div>
                          </div>                                                           
                        
						  <input type="hidden" class="form-control" id="code_series">
						  <input type="hidden" class="form-control" id="config_colection" value="B">
                      </div>
                    </div>
                  </div>







