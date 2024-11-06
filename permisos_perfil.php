<?php

include("check_access.php");

//var_dump($_POST['perfil_select']);


//var_dump(isset($perfil_edit));


////////////////
$perfil_edit = $_GET['per'];

if(isset($perfil_edit)==TRUE){

		if($perfil_edit == 0 or $perfil_edit==''){
			
			$card_disp = 'block';
			$per_bus = 99;
			$select_per = 99; 
			
		}else{
			$card_disp = 'block';
			$per_bus = $perfil_edit;
			$select_per = $perfil_edit; 
		}
}else{
	$per_bus = 98;
	$select_per = 98; 
}


//var_dump($perfil_edit);
//var_dump($fx_per);

$fx_per = 'permisos_perfil('.$per_bus.')'; 

?>

<body onload="<?php echo $fx_per; ?>">
	
		<div class="col-md-12 " style="padding: 10px 3px 3px 3px; margin-left: 10px; margin-bottom:10px; margin-left:27px; " >

				<div class="row col-md-12 " style="background:rgba(163, 183, 196, 0.4);">
					
					<label class="col-sm-1 col-form-label">
						<span class="text-muted card-title">Perfil</span>
					</label>
			
							
					<select class="col-md-2 form-control col-form-label " style="margin-top: 2px;" onchange="permisos_perfil(this.value);" name="per" id="perfil_permisos">
						<?php echo genera_select_perfil_permisos($select_per); ?>
					</select> &nbsp;
					
					<div class="btn-group" role="group" id="btn_edo_perfil">
						
					 
			
					 <!--<button class="btn btn-outline-secondary" type="button" onclick="save_permisos();" ><i class="fas fa-save"></i> </button>-->
					</div>
				</div>
		
		</div>

		
		

<div class="scrollable" style="overflow-y:<?php echo $scroll;  ?>; display: <?php echo $card_disp; ?> ; padding: 0px 30px; border: 0px solid #c40; background: transparent;"> 

<!-- card 1 -->
<div class="row">


<?php 
	
	$correo_cifrado = $_GET['item'];
	//var_dump($correo_cifrado);
		
	$info_user = busca_user_cifrado($correo_cifrado);

	//$datos_encontrados= $error.'-'.$nombre.'-'.$correo.'-'.$user_name.'-'.$foto.'-'.$row['id'];	

	$data_userb = explode('|', $info_user);
	$error = $data_userb[0];
	$nombre = $data_userb[1];
	$correo = $data_userb[2];
	$userb = $data_userb[3];
	$foto = $data_userb[4];
	$id_user = $data_userb[5];

	if($nombre==''){
		$name= strtoupper($data_userb[3]);
	}else{
		$name= $data_userb[1];
	}

	$pagina = $_GET['element'];

	if(isset($pagina)== TRUE){
		$doc = get_pag($pagina);
		$chk_col_op = genera_check_series_opcionales_admin_perfil($id_user);
		$chk_col_premium = genera_check_series_premium_admin_perfil($id_user);

	}else{
		$doc= 'empty.php';
	}


$secciones = '<option value="999"> Elija una sección </option>'.getListSecciones();

?>


	
		<div class="col-md-4 border-right  bg-light " style="height: 480px; padding:0px;" >
		
			<h5 class="col-md-12 p-2 title_sec " > Páginas </h5>
			
			            
				    <div class="p-1 col-md-12 transparent " id="show_pag" style="overflow-y: auto; overflow-x: hidden;">  
						<form name="f1">
								<div class="" id="show_permisos" style="height: 390px; overflow-x: hidden; overflow-y: auto;">	</div>							
						</form>					        
					</div>
			
		</div>
	
	
		<div class="col-md-4 border-right  bg-light " style="height: 480px; padding:0px;" >
		
			<h5 class="col-md-12 p-2 title_sec " > Configuraciones	</h5>			
			            
				    <div class="p-1 col-md-12 "   style="overflow: scroll; overflow-y: auto; overflow-x: hidden;">  
						
								<div class="" id="show_conf" style="height: 390px; overflow: scroll; overflow-x: hidden; overflow-y: auto;">	
									
								</div>							
										        
					</div>
			<input type="hidden" class="col-md-6" id="code_permisos_perfil" value="">
		</div>	
 
		
		<div class="col-md-4 border-right  bg-light " style="height: 480px; padding:0px;" >

        <h5 class="col-md-12 p-2 title_sec "> Opciones </h5>

			<div class="mnu_bar" >                               
                <div class=" btn-group-bar" role="group">								
                    <button type="button" id="secconfig_1" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar secconfig" style="width: 120px;"> Config </button>
                    <button type="button" id="secconfig_2" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar secconfig" style="width: 120px;"> Sección </button>
                </div>
			</div>

			<div id="div_secconfig_1" style="display: none;">
				<label class="col-md-12 p-2  subtitle_sec" style="text-align:left;"> 
					<i class="fa-regular fa-square-plus"></i> Agregar Opción
					<button type="button" value="" style="float:right; margin-right:10px;" class="btn btn-outline-primary" onclick="save_configuracion();"> <i class="fa fa-save"></i> </button>
				</label> 


					<div class="group-control">	                        		
						<label class="col-md-3 col-form-label text-muted lbl_form_sm" >Etiqueta:</label>
						<input class="col-md-8 form-control" id="nombre_conf" type="text" value="" >
					</div>	


					<div class="control-group">	                        		
						<label class="col-md-3 col-form-label text-muted lbl_form_sm" >Sección:</label>
						
						<select class="col-md-8 form-control" id="seccion_conf">
							<?php echo $secciones; ?>
						</select>
					</div>
			</div>
			

			<div id="div_secconfig_2" style="display: none;">
				<label class="col-md-12 p-2  subtitle_sec" style="text-align:left;"> 
					<i class="fa-regular fa-square-plus"></i> Agregar Sección 
					<button type="button" value="" style="float:right; margin-right:10px;" class="btn btn-outline-primary" onclick="save_seccion();"> <i class="fa fa-save"></i> </button>
				</label> 

			
				<div class="group-control">	                        		
			    	<label class="col-md-3 col-form-label text-muted lbl_form_sm" >Etiqueta:</label>
			        <input class="col-md-8 form-control" id="nombre_seccion" type="text" value="" >
				</div>	

			</div>
									
		</div>
		
 

</div> <!-- Row -->            
        </div>


</body>