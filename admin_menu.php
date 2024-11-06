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

<div class="row bg-light" style="height: 480px;">

<div class="col-md-3 border-right left_panel_shadow" style="padding: 0px;" >

	<h5 class="col-md-12 p-2 title_sec "> Seccion </h5>

	<div class="mnu_bar" > 	
		<div class=" btn-group-bar" role="group"  style="margin-bottom: 2px;"> 
								
			<button id="mnuadmin_1" type="button" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar_md mnuadmin mnuadmin_md bnt_mnubar_active"> Lateral </button>
			<button id="mnuadmin_2" type="button" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar_md mnuadmin mnuadmin_md "> Pefil </button>
								
		</div>
	</div>

	<div class="" style="height: 390px; overflow-y:auto; overflow-x: hidden;">
			
			<div id="div_mnuadmin_1" class="col-md-12" >
				<?PHP echo get_menu_nvo(1); ?>
			</div>
		
			<div id="div_mnuadmin_2" class="col-md-12" style="display: none;"  >
				<?PHP echo get_menu_nvo(2); ?>
			</div>
	</div>
</div>

<div class="col-md-3 border-right left_panel_shadow" style="padding: 0px;;" >
	<h2 class="col-md-12 p-2 title_sec bg-head-light" style="margin-bottom:10px;" > Submenu </h2>
	
    <div class="" style="height: 390px; overflow-y:auto; overflow-x: hidden; padding: 5px 15px;">
	<?php

    $mpa=$_GET['mpa'];
    $mpb=$_GET['mpb'];

    function get_path_mnus($id_mnu){
        
        $itr = $itr+1;

        $info_mnu = get_info_mnu($id_mnu);
        $data = explode('|',$info_mnu);

        $padre_mnu = $data[1];
        $nombre_mnu = $data[2];
        $ico_mnu = $data[3];



        if($padre_mnu>=0){
                if($padre_mnu!=0){
                    $path_final .= '<a href="#" style="color:rgba(100,100,100,0.6);" class="text-muted">'.strtoupper(get_path_mnus($padre_mnu)).'/ </a> <a href="#" style="color:rgba(100,100,100,0.6);" class="text-primary" style="">'.strtoupper($nombre_mnu).'</a> /'; 
                }else{
                    $path_final .= '<span class="text-primary">'.strtoupper($nombre_mnu).'</span> ';
                }
        }else{
            $path_final= 'Error'; 
        }

        $path_final = str_replace('//','/',$path_final);
       // $path_final = str_replace('/','<i class="fa-solid fa-angle-right"></i>',$path_final);

        return $path_final;
    }


    if(isset($mpa) and isset($mpb)){

        $info_mnu = get_info_mnu($mpb);
        $data = explode('|',$info_mnu);

        $padre_mnu = $data[1];
        $nombre_mnu = $data[2];
        $ico_mnu = $data[3];

        $title = '<h2 class="col-md-12 p-3 title_sec " > <i class="fa-solid fa-'.$ico_mnu.'"></i> '.$nombre_mnu.'</h2>';
        $mnu_hijo = get_menu_hijo_nvo($mpb);

        
            $main_menu = '
                            <div class="blockquote rounded" style="padding: 0px;  margin-bottom: 20px; border:0px solid #ccc; ">
								
                                <div class="" style="padding: 5px 10px 5px 10px; margin-bottom:0px; " >
									
									<h6 class="mnu_bar_ text-muted" style="margin-bottom: 0; font-size: 0.7rem;">
									 <i class="fa-solid fa-folder-tree"></i> &nbsp;'.get_path_mnus($mpb).'
									</h6> 
								</div>
							 </div> 
    ';

    }else{

        
        $info_mnu = get_info_mnu($mpa);
        $data = explode('|',$info_mnu);


        $nombre_mnu = $data[2];
        $ico_mnu = $data[3];

        $title = '<h2 class="col-md-12 p-3 title_sec " > <i class="fa-solid fa-'.$ico_mnu.'"></i> '.$nombre_mnu.'</h2>';
        $mnu_hijo = get_menu_hijo_nvo($mpa);

            $main_menu = '
                            <div class="blockquote rounded" style="padding: 0px; margin-bottom: 20px; border:0px solid #ccc; ">
								
                                <div class="text-primary" style="padding: 5px 10px 5px 10px; margin-bottom:0px; " >
									
									<h6 class="mnu_bar_ text-muted" style="margin-bottom: 0; font-size: 0.7rem;">
									    <i class="fa-solid fa-folder-tree"></i> &nbsp;'.get_path_mnus($mpa).'
									</h6> 
								</div>
							 </div> 
            ';
    }

    echo $main_menu;
    echo $mnu_hijo;

	//	$id_papa = $_GET['mpa'];
	//	echo get_menu_hijo($id_papa, 2);
	?>
		</div>
</div>


<div class="col-md " style="overflow:none; padding:0px;" >
	<h5 class="col-md-12 p-2 title_sec " > Editar </h5>


<?php

$mpa = $_GET['mpa'];


					$perfil = $GLOBALS['user_perfil'];
					
                    $permiso_elimina = get_permiso_config('8', $perfil);
								 
					//var_dump($perfil);

					if($estado==1){
					    $btn_estado = '<a  class="btn btn-outline-secondary text-neutral" onclick="estado_menu(\''.$row['id'].'\')" ><i class="fa fa-toggle-off"></i></a>';
					    $ico_estado = '<span class="text-primary mnu_btn" onclick="estado_menu(\''.$row['id'].'\')"><i class="fa fa-eye"></i></span>';
					}else{
					    $btn_estado = '<a  class="btn btn-outline-secondary text-neutral" onclick="estado_menu(\''.$row['id'].'\')" ><i class="fa fa-toggle-on"></i> </a>';
					    $ico_estado = '<span class="text-primary mnu_btn" onclick="estado_menu(\''.$row['id'].'\')"><i class="fa fa-eye-slash"></i></span>';	
					}

					if($permiso_elimina==1){
						$btn_eliminar='<a  class="btn btn-outline-secondary text-neutral" onclick="elimina_menu(\''.$rowb['id'].'\')"><i class="fa fa-trash"></i></a>'; 								 
					}else{
					    $btn_eliminar='<a  class="btn btn-secondary text-muted" ><i class="fa fa-trash"></i> </a> '; 
					}


echo '
										<div class="" style="margin: 0px 0 0 0; text-align:center; padding:0px; ">
											
                                            <div class="tool_bar">

                                                <div class="btn-group" role="group">                
                                                    <div id="btn_edo"></div>                                                
                                                    <div id="btn_save"></div>
                                                    
                                                </div>

                                                <div class="btn-group" role="group">
                                                    <div id="btn_eliminar"></div>
                                                </div>

                                                <input type="hidden" id="permiso_elimina" value="'.$permiso_elimina.'">
                                            </div>
										
										</div>

                                    <div class="col-lg " style="height: 350px; overflow-y:auto; overflow-x: hidden;">

                                        <div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">ID</label>
											<div class="col-sm-9">
												<input disabled class="form-control" id="id_mnub" type="text" value= "">
												<input type="hidden" id="id_mnu" value= "">
											</div>
										</div>	

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Nombre</label>
											<div class="col-sm-9">
												<input class="form-control" id="title_mnu" type="text" value="">
																								
											</div>
										</div>
																
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Clave</label>
											<div class="col-sm-9">
											<input class="form-control" type="text" id="cve_mnu" value="">
											</div>
										</div>

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Icon <span class="text-muted" id="ico_mnu"></span></label>												
											<div class="col-sm-9">
											<input class="form-control" type="text" id="icon_mnu" value="">
											</div>
										</div>


										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Tipo</label>
											<div class="col-sm-9" id="select_tipo_mnu">
											</div>
										</div>	

																			
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Archivo</label>
											<div class="col-sm-9">
											<input class="form-control" type="text" id="file_mnu" value= "">
											</div>
										</div>

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Anidado</label>
											<div class="col-sm-9" id="select_padre_mnu">											
											<input  type="hidden" id="id_padre_original_mnu" value= "">
											</div>
										</div>	
										
                                        <div id="select_pos">
                                        </div>


										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Orden</label>
											<div class="col-sm-9">
											
											<input class="form-control" type="number" id="orden_mnu" value= "">
											</div>
										</div>


										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Color</label>
											<div class="col-sm-9">
											
											<input class="form-control" type="color" id="color_mnu" value= "">
											</div>
										</div>

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Grupo Menú</label>
											<div class="col-sm-9">
											
											<input class="form-control" type="number" id="grupo_mnu" value="0"><br>
                                            <span class="text-muted" style="font-size: 0.7rem; line-height:0.6rem;" >Los menus con el mismo numero seran mostrados en el mismo menu desplegable.</span>
											</div>
										</div>

                                     </div>
																								

';

?>

	
</div>
 


</div> <!-- row -->

<!-- Modal 1 -->
<div id="nuevo_menu" class="hold_general" style="border: 0px solid #c30; z-index: 999999999999999; height: 100%; width: 100%; display:  <?php echo $display; ?>; ">
	<div class="degrade_modal"></div>
				
		<div class="col-lg-6 body_edita semi-transparent"  style="overflow-y:hidden ; overflow-x: hidden; margin-top: 30px; padding:0px; ">
			
            <h5 class="col-md-12 p-2 title_sec_sm bg-head " style="padding:0px; border-radius:5px 0 0 0;"> 
            
                    <i class="fa-solid fa-sliders"></i> <b> Nuevo Menú </b>
            
                    <div class="btn-group" role="group" style="float:right; border:none;"> 
                        <button type="button" onclick="toggle('nuevo_menu')" class=" btn btn-outline-primary  text-clear" style="border:0px solid #ccc;"> 
                            <i class="fa-solid fa-times fa-lg"></i>
                        </button>
                    </div> 
             </h5>     
            
            <div class="p-2 border-bottom ">
			    <button style="margin-left: 20px;" class="btn btn-inverse-primary" onclick="crear_menu()" >
					<i class="fa fa-save"></i> </button>
			
			</div>
			
			<div class="card-body" style="padding:5px;">
				
				<div class="row ">
					<div class="col-md-18" style="margin:1px auto;">

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
				</div>
				


				
								
		
				
			</div>
		</div>
			

<!------   --> 




