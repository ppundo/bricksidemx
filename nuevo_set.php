<?php

include("minifiguras.php");

include("globals.php");

	$perfil_user = $GLOBALS['user_perfil'];
	$user = $_SESSION['clave_user'];	

//$user = $_SESSION['clave_user'];
//var_dump($user);

	if($user==0 or $user==""){
			
		echo '<meta http-equiv = "refresh" content = "0; url = '.$link_site.'?access=1" />';
			
	}else{
		
		if($user_perfil==0 or $user_perfil==""){
			
			}
/////////////////////////


$user_id = $GLOBALS['user'];
//echo $user_id; 
$user_perfil = $GLOBALS['user_perfil'] ;
$user_masterpass = $GLOBALS['user_masterpass'] ;

$id_tema = $_GET['ref'];
$all_sets = $_GET['alle'];
//var_dump($id_tema); 


///// Vista lista 
$lista = $_GET['lista'];


$qs = "SELECT * FROM temas_sets where estado = 1 order by nombre ;";// preparando la instruccion sql
   
    $results= $dbh->query($qs);
    if ($results->num_rows > 0) {
	    
	    $current_tema= $_GET['thema'];
	    
	    while($rows= $results->fetch_assoc()){
		    
		    if($current_tema== $rows['id']){
			    $stat = ' selected ';
		    }else{
			    $stat = ''; 
		    }
		    
		    $opt_select .= '<option '.$stat.' value="'.$rows['id'].'--'.$rows['logo'].'" >'.$rows['nombre'].'</option>'; 
		    $opt_select_list .= '<option value="'.$rows['id'].'--'.$rows['logo'].'" >'.$rows['nombre'].'</option>';
		    $opt_select_list_edit .= '<option value="'.$rows['id'].'" >'.$rows['nombre'].'</option>';
		}
		$select_tema = '<option value="0">Elije...</option>'.$opt_select; 
	}

///////

?>

<!-- //////////////////////////               NUEVO SET              //////////////////////////// -->

<div id="nuevo_set" class="hold_set_edita" style="">
	<div class="degrade_modal"></div>

	<div class="col-lg-12 body_modal semi-transparent" style="width: 70%;">

		<div class="pestana_edita"> <span class="claro" onclick="toggle('nuevo_set'); "> <i class="fas fa-times"></i></span></div>

		<div class="content-wrapper-thin" style="background: #fff; ">
			<div class="col-lg-12">

				<div class="p-1  border-bottom  " style="padding: 10px 0 0 5px;">
					<h4>
					    <span class="card-title-set text-success " style="float: left;" id="title_nombre">Agregar Set</span>
					                   
				        <div class="btn-group " role="group" aria-label="" style="margin-left: 25px; " >
					                   		
							<a href="#" class="btn btn-outline-neutral" onclick="save_new_set();" > 
								<i class="fas fa-save"></i> 
							</a>
		
		                </div>
                      								                   
					</h4>

				</div>

				<div class="p-1 border-bottom grid-margin bg-light" style="text-align: center; ">
					&nbsp; <span id="new_set_status" class="text-light bg-info" style=" border-radius: 5px;"></span>
				</div>

				<div class="row">

					<div class="col-md-4 grid-margin ">
						<form name="form_up_set" method="post" action="?" id="form_up_set" enctype="multipart/form-data">
							<div class="form-group row compacted">
								<label for="edita_index" class="col-sm-3 col-form-label">Clave</label>
								<div class="col-sm-8">
									<input type="number" name="new_set_cve" onblur="valida_nombre_set(this.value);" class="form-control" id="new_set_cve" placeholder="Clave">
								</div>
							</div>

							<div class="form-group row compacted">
								<label for="edita_id" class="col-sm-3 col-form-label">Nombre</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="new_set_nombre" placeholder="Nombre">
								</div>
							</div>

							<div class="form-group row compacted">
								<label for="edita_serie" class="col-sm-3 col-form-label">Tema</label>
								<div class="col-sm-8">


									<select class="form-control" id="new_set_tema" onchange="cambia_foto_tema(); ">
				                              <?php echo $select_tema;  ?>
			                        </select>


									<!--
			                              <input class="form-control" id="new_set_tema" list="new_set_temab">
			                              <datalist id="new_set_temab">
			                              <?php echo $opt_select_list; ?>
			                              </datalist>
			                              
			                              -->


									<div class="col-sm-12 border" style="text-align:center; background: rgba(127, 127, 127,0.9); padding: 10px; height: 80px; border-radius: 5px; margin-top: 5px; ">
										<img class="prev_foto_minifig_mini" src='' style="max-width: 95%; max-height: 95%; margin-top: 10px;" id="show_tema">
									</div>
								</div>
							</div>
					</div>

					<div class="col-md-4 grid-margin " style="border: 0px solid #c40;">

						<div class="form-group row compacted">
							<label for="edita_imagen" class="col-sm-3 col-form-label">Piezas</label>
							<div class="col-sm-8">
								<input type="number" min="100" class="form-control" id="new_set_piezas" placeholder="Piezas">
							</div>
						</div>

						<!-- $row['nombre'].'-'.$row['piezas'].'-'.$row['cve_lego'].'-'.$row['id_tema'].'-'.$row['precio'].'-'.$row['anio_public']; -->
						<div class="form-group row compacted ">
							<label for="edita_sku" class="col-sm-3 col-form-label">Precio</label>
							<div class="col-sm-8">
								<input type="number" step="0.10" class="form-control" id="new_set_precio" placeholder="Precio">
							</div>
						</div>

						<div class="form-group row compacted ">
							<label for="edita_sku" class="col-sm-3 col-form-label">Origen</label>
							<div class="col-sm-8">
								<?php echo $select_origen;  ?>
							</div>
						</div>

						<div class="form-group row compacted ">
							<label for="edita_sku" class="col-sm-3 col-form-label">Año </label>
							<div class="col-sm-8">
								<input type="number" min="1900" class="form-control" id="new_set_anio" placeholder="año">
							</div>
						</div>

						<div class="form-group row compacted ">
							<label for="edita_sku" class="col-sm-3 col-form-label">No Minifiguras </label>
							<div class="col-sm-8">
								<input type="number" min="0" class="form-control" id="new_set_minifig" placeholder="Minifiguras Incluidas">
							</div>
						</div>

						<div class="form-group row compacted ">
							<label for="edita_sku" class="col-sm-3 col-form-label">Imagen </label>
							<div class="col-sm-8">
								<input type="text" disabled="disabled" class="form-control" id="new_set_foto" placeholder="jpg / png">
								<span class="txt-sm" id="notice_set"> </span>
							</div>
						</div>
					</div>

					<div class="col-md-4 grid-margin ">
						<!--
			                    <div class="form-group row compacted grid-margin ">
			                        <label for="edita_imagen" class="col-sm-6 ">Subir Imagen</label>
			                    	
				                        <input type="file" name="foto" class="col-sm-10 form-control " id="foto" placeholder="Imagen">
				                        <a class="btn btn-primary btn-block  text-light col-sm-10" id="btn_up_foto" onclick="save_foto(2);"> <i class="fa fa-arrow-circle-up"></i> Subir Foto</a>
				                        <input type="hidden" name="user_id" value="<?php echo $user_id?>" >
				                        <input type="hidden" name="tipo" value="2" >
			                    	</form>
			                    </div> 
			                   
			                    
			                    <div id="prev_image" class="row form-group compacted" style=" display: block; border: 0px solid #ccc;  ">
				                   
			                    </div>
			                    -->
					</div>

				</div>

			</div>
		</div>
	</div>

</div>
