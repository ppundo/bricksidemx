
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
				    
				    
                        while($rowr= $resultr->fetch_assoc()){
					

	                        $users .= '<a href="http://shelf.bricksidemx.com/collector/index.php?mnu=958153f1b8b96ec4c4eb2147429105d9&op='.$rowr['id'].'">
								        <div class="col-md-12 p-1 border-bottom" style="border-top: 0px solid #ccc;">
								             <h5 class="mb-0  "> <span class="text-primary"> </span> <span class="text-muted"> '.$rowr['nombre'].'</span></h5>
								             <input type="hidden" id="val_bus_'.$rowr['id'].'" value="-card_'.$rowr['id'].'-" >
								        </div> 
								        </a>
								        ';
								        
							$cat_act .= $rowr['id'].'--'.$rowr['clave'].';'; 

	             }// while Fila padre
	}
	
	var_dump($cat_act);
						//separa en un arra el numero de tablas activas;
						$data_cat = explode(';',$cat_act);
						
						
						for($i=0 ; $i< count($data_cat); $i++){
							
							$data_table = explode('--', $data_cat[$i]);
							
							$id_tabla = $data_table[0];
							$nom_table = $data_table[1];
	
							switch($op) {
								
								case 1: // moneda
								
								$reg = get_reg_tabla($nom_table);
								
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
								
						}// for 
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
