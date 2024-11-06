<?php 
// crea el list para los css disponibles 
$current_css_fig = $GLOBALS['user_css_fig']; 
//var_dump($current_css_fig); 

include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbh->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}	


	//////////////////////////   BUSCA SERIES ACTIVAS   ////////////////////////////////////
	
		$qs = "SELECT * FROM css_files_fig where estado = 1;";// preparando la instruccion sql
	
		$results= $dbh->query($qs);
	    if ($results->num_rows > 0) {
		
		$tot_reg = $results->num_rows; 
		$tot = 0; 
		
			while($rows= $results->fetch_assoc()){
				
				if($rows['nombre'] == $current_css_fig){
					$opt .= '<option selected value="'.$rows['nombre'].'">'. strtoupper($rows['nombre']).'</option>';
				}else{
					if($current_css_fig=='' && $rows['nombre'] == 'default'){
						$opt .= '<option selected value="'.$rows['nombre'].'">'. strtoupper($rows['nombre']).'</option>';
					}else{
						$opt .= '<option value="'.$rows['nombre'].'">'. strtoupper($rows['nombre']).'</option>';
					}
					
				}
							
				$tot = $tot + 1; 
			}
		
		
		$select_css = '
		
	<select class="form-control col-sm-8 grid-margin-md" name="vista_fig" id="vista_fig" onchange="save_perfil_appear(\''.$GLOBALS['user'].'\');" >
	<option value="XX">Elija una...</option>
	'.$opt.'
	</select>		
		
		';
		
		}	

		/*
									<div class="col-md-8 form-group no-show">
								<label class=" col-form-label"> Tema Minifiguras  </label>
								
								<div class="row border-bottom ">
									<p class="text-muted col-sm-4 col-form-label">Tema</p>
									<?php echo $select_css;  ?>
								</div>

							</div>
		*/

?>

<div class="col-md-12" style="padding:0px; ">
<h4 class="col-md-12 p-2 title_sec grid-margin" >Apariencia</h4>

	<div class="col-md-12 " style="margin-top:10px;">
	

							
							<div class="col-md-8 form-group">
								<label class="col-form-label"> Vista del Mosaico </label>
								
								<div class="row ">
									<p class="text-muted col-sm-4 col-form-label">Minifiguras</p>
									<select class="form-control col-sm-8" id="vista_m_p" onchange="save_perfil_appear('<?php echo $GLOBALS['user']?>');" >
										<option value="XX">Elija una...</option>
										 <?php echo generaListVistas(1);  ?>
										
									</select>
								</div>

								<div class="row border-bottom">
									<label class="text-muted col-sm-4 col-form-label">Sets</label>
									<select id="vista_s_p" class="form-control col-sm-8 grid-margin-md" onchange="save_perfil_appear('<?php echo $GLOBALS['user']?>');">
										<option value="XX">Elija una...</option>
										<?php echo generaListVistas(2);  ?>
									</select>
								</div>
								
							</div>
							
</div>
</div>