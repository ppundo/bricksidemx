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


		

	
	
		

?>
<div class="scrollable bg-light">

<div class="row " style="height: 559px;">

<div class="col-md-3 border-right " >

	<h5 class="col-md-12 p-3 title_sec " >Sección</h5>

	<div class="col-md-12 stretch-card" >
			
			<div class="col-md-12 semi-transparent" id="lateral" style="overflow-y: auto; overflow-x: hidden;">
				<div class="p-3  border-bottom ">
				    <h4 class="card-title">
				        <span class="col-sm-12 card-title-fig mb-0 " style="float: left;" id="title_nombre">
				        	<span class="" >Barra Lateral</span>
		                	<a class="mnu_btn" href="#" onclick="toggle('b_barra')" ><i class="fa fa-chevron-down"></i></a>
		                </span> 
		            </h4>
		        </div>
		        
		        <div id="b_barra" class="card-body" style="padding: 15px 3px 15px 3px; display: block; ">
			        <?PHP echo getmenu(1); ?>
		        </div>
		        
			</div>
			
	
			
	</div>
	
	<div class="col-md-12 grid-margin stretch-card" >
		
				<div class="col-md-12 semi-transparent" id="lateral" style="overflow-y: auto; overflow-x: hidden;">
				<div class="p-3  border-bottom " >
				    <h4 class="card-title">
				        <span class="col-sm-12 card-title-fig mb-0 " style="float: left;" id="title_nombre">
				        	<span class="" >Perfil</span>
		                	<a class="mnu_btn" href="#" onclick="toggle('b_perfil')" ><i class="fa fa-chevron-down"></i></a>
		                </span> 
		            </h4>
		         </div> 
		        
		        <div id="b_perfil" class="card-body" style="padding: 15px 3px 15px 3px; display: block; ">
			            <?PHP echo getmenu(2); ?>
		        </div>
		        
			</div>
	</div>
</div>

<div class="col-md-3 border-right" >
	<h5 class="col-md-12 p-3 title_sec " >Sub Menus</h5>
	
	<?php
		$id_papa = $_GET['mpa'];
		echo get_menu_hijo($id_papa, 2);
	?>
		
</div>

<div class="col-md-3 border-right" >
	<h5 class="col-md-12 p-3 title_sec " >Opciones </h5>

	<?php
		$id_papa = $_GET['mpb'];
		echo get_menu_hijo($id_papa, 3);
	?>
	
</div>
 
<div class="col-md-3 " >
	<h5 class="col-md-12 p-3 title_sec " >Opciones</h5>
	<?php
		$id_papa = $_GET['mpc'];
		echo get_menu_hijo($id_papa, 4);
	?>
</div>

</div> <!-- row -->

<!-- Modal 1 -->
<div id="nuevo_menu" class="hold_general" style="border: 0px solid #c30; z-index: 9999; height: 100%; width: 100%; display:  <?php echo $display; ?>; ">
	<div class="degrade_modal"></div>
		
	<div class="pestana_edita"> 
		<span> <a onclick="toggle('nuevo_menu');" href="index.php?mnu=81ca0b7c951be89184c130d2860a5b00&obj=&mdl=0"> <span class="claro"> <i class="fas fa-times"></i> </span> </a> </span> </div>
		
		<div class="col-lg-8 body_edita semi-transparent"  style="overflow-y:hidden ; overflow-x: hidden; margin-top: 30px;  ">
			<div class="p-2 border-bottom ">
				<span>Nuevo Menú</span>
			
			
			<a style="margin-left: 20px;" class="btn btn-outline-secondary text-neutral" onclick="crear_menu()" ><i class="fa fa-save"></i> Guardar</a>
			
			</div>
			
			<div class="card-body">
				
				<div class="row">
					<div class="col-md-6">

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-4 col-form-label">Etiqueta</label>
											
											<div class="col-sm-8">
												<input class="form-control" id="title_new" type="text" value= "">												
											</div>
											
											<label class="col-sm-12 col-form-label text-neutral no-show">Ingresa el título que aparecerá en la etiqueta</label>
										</div>
						

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-4 col-form-label">Tipo</label>
											
											<div class="col-sm-8">
												<select class="form-control" id="tipo_new" onchange="cambia_tipo_menu();">
													<?php echo genera_select_tipo_menu(9999); ?>
													<!--
													<option value="X">Elija...</option>
													<option value="0">Sección</option>
													<option value="1">Función</option>
													-->
												</select>
																								
											</div>
										</div>


										<div class="form-group row no_padding_bottom " style="background: rgba(220,220,220, 0.9); padding-top: 10px; "  id="file_menu">
										
											<label class="col-sm-4 col-form-label" style="float: left;" style="border: 0px solid #cd0;">Archivo</label>
											
											<div class="col-sm-8" style="float: left;">
												<input class="form-control" type="text" id="file_new" value= "" placeholder="Nombre del archivo PHP sin extensión">
											</div> 
											
											<label class="col-sm-12 col-form-label text-neutral text-sm">Ingresa el nombre del archivo, sin extensión</label>
										</div>

										<div class="form-group row no_padding_bottom no-show" style="background: rgba(220,220,220, 0.9); padding-top: 10px;"  id="fx_menu">
											
											<label class="col-sm-4 col-form-label" style="float: left;" >Función </label>
											
											<div class="col-sm-8" style="float: left;">
												<input class="form-control" type="text" id="fx_new" value="" placeholder="Nombre de la funcion JS">
											</div> 
											
											<label class="col-sm-12 col-form-label text-neutral text-sm">Ingresa el nombre de la función JS definida para este menu.</label>
										</div>	

										<div class="form-group row no_padding_bottom no-show" style="background: rgba(220,220,220, 0.9); padding-top: 10px;"  id="btn_menu">
											
											<label class="col-sm-4 col-form-label" style="float: left;" >Botón </label>
											
											<div class="col-sm-8" style="float: left;">
												<input class="form-control" type="text" id="btn_new" value="" placeholder="">
											</div> 
											
											<label class="col-sm-12 col-form-label text-neutral text-sm">Ingresa el nombre de la función JS definida para este menu.</label>
										</div>	

										<div class="form-group row no_padding_bottom no-show" style="background: rgba(220,220,220, 0.9); padding-top: 10px;"  id="link_menu">
											
											<label class="col-sm-4 col-form-label" style="float: left;" >Link </label>
											
											<div class="col-sm-8" style="float: left;">
												<input class="form-control" type="text" id="link_new" value="" placeholder="Enlace">
											</div> 
											
											<label class="col-sm-12 col-form-label text-neutral text-sm">Ingresa la url, esta se pondra en el atributo HREF del tag <<aa>a>.</label>
										</div>																			

										<div class="form-group row no_padding_bottom"  >
											<label class="col-sm-4 col-form-label">Posición</label>
											<div class="col-sm-8">
											
											<select class="form-control" id="nivel_new"  >
												
												<?php echo genera_select_posicion_menu(9999); ?>
												
												<!--<option value="999">Elije...</option> 
												<option value="99">Menu Perfil</option>
												<option value="0">Barra Lateral</option>
												<option  value="88">Barra de Titulo</option>
												-->
												
											</select>
											
											</div>
										</div>


										<div class="form-group row no_padding_bottom" >
											<label class="col-sm-4 col-form-label">Submenu de: </label>
											<div class="col-sm-8">
											
											<select class="form-control" id="padre_new" >
												<option value="999">Elije...</option>
												<option value="9999">Sin Clasificar</option> 
												<option value="99">Op. Perfil</option> 
												<option value="0">Barra Lateral</option> 
												<?php echo dropmenupadre(0); ?>
											</select>
											
											</div>
										</div>
					</div>

					<div class="col-md-6">
						
					</div>
				</div>
				


				
								
		
				
			</div>
		</div>
			

<!------   --> 


</div> <!-- Scrollable -->

