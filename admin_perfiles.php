<?php 

// Comprueba que exista una sesion iniciada
include("check_access.php");
		
////////////////
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		      //informacion de acceso a la bd
		// Check connection
			if ($dbh->connect_error) {
		    	die("Connection failed: " . $dbh->connect_error);
			}
			
              $qb = "SELECT * FROM perfiles;";// preparando la instruccion sql

   
			    $resultb= $dbh->query($qb);
			    if ($resultb->num_rows > 0) {
				    
				    $num = 1; 
                        while($rowb= $resultb->fetch_assoc()){
	                        
	                        $perfilb = '<label class="badge badge-secondary bg-muted ">  
	                        				<span class="text-'.$rowb['color'].'" style="font-size: 14px;"> 
	                        					<i class="fas '.$rowb['icono'].'" style="width: 20px; display:inline-block;" ></i>  
	                        				</span> 
	                        				<span class="text-'.$rowb['color'].'">'.$rowb['nombre'].'</span>
										</label> ';
	                        //////

	                        
	                        $edo = get_lbl_estado_perfil($rowb['estado']);



							$perfil = $GLOBALS['user_perfil'];
							$permiso_elimina = get_permiso_config('21', $perfil);
								 
							if($permiso_elimina==1){

							$btn_elimina = '
							<button class="btn btn-inverse-primary btn_thin" type="button" onclick="quick_edit_user(\'4-'.$rowb['id'].'\')" > <i class="fa fa-trash" ></i> </button>
							';
							 									 
								 }else{

							$btn_elimina = '';

																 
								 }
								 

	                        
	                        if($rowb['estado']==1){
                                $btn_edita = '<button '.$hab_btn.' class="btn btn-inverse-primary btn_thin" title="DESACTIVAR" onclick="cambia_estado_perfil(\''.$rowb['cve_perfil'].'\')" > <i class="fa fa-toggle-off" ></i> </button>'; 
                                $fecha_banned = '';
                                $f_display = formatFecha($rowb['fecha_registro']);
	                        }elseif($rowb['estado']==0){
		                        $btn_edita = '<button '.$hab_btn.' class="btn btn-inverse-primary btn_thin" title="ACTIVAR"  onclick="cambia_estado_perfil(\''.$rowb['cve_perfil'].'\')" > <i class="fa fa-toggle-on" ></i> </button>'; 
                                $fecha_banned = ''; 
                                $f_display = formatFecha($rowb['fecha_registro']);
		                        
	                        }

                            
                            $action = $GLOBALS['link_site'].'?mnu=a649d92abf6f4048ecb6fe951669cf70&per='.$rowb['cve_perfil'];

	                        //$action = 'https://bricksidemx.com/collector/index.php?mnu=a649d92abf6f4048ecb6fe951669cf70&per='.$rowb['cve_perfil'];

	                        $btn_permisos = '<button type="submit" class="btn btn-inverse-primary btn_thin" title="Validar Permisos de Perfil" > <i class="fa-solid fa-user-lock"></i> </button>'; 
	                        
                            $mnu = '44ae6f3f9a657420d90d723aec0480f0'; 
							$url_d = $link_site.'?mnu='.$mnu.'&item='.$rowb['cve_perfil'];
                            
                            $btn_edit = '<a class="btn btn-inverse-primary text-light btn_thin" style="font-size:0.8rem;" href="'.$url_d.'">  '.$ico_global_edit.' </a>';


	                        $options = '
	                           	<div class="btn-group" role="group" aria-label="">
	                           		<form action="'.$action.'" target="_blank" method="post" > 
	                           		'.$btn_permisos.'
									
	                           		</form>
									
									'.$btn_edita.'
									'.$btn_edit.'
	                        		</div>
	                        	
		                        	<div class="btn-group" role="group" aria-label="" style="margin-left:10px;" >		                        	
		                        		
		                        		'.$btn_elimina.'
                                        
		                        	</div>';



	                       if($rowb['color']== ""){
	                       		$color_ico = 'muted';
	                       }else{
	                       		$color_ico = $rowb['color'];
	                       }

	                        
	                        $filas .= '
	                        
	                        <tr>
	                        
	                        <td style="text-align: center;"> <span class="text-muted" > '.$rowb['id'].' </span> </td>
	                        
	                     
	                        <td style="text-align: center;"> <span class="text-muted" >'.$rowb['cve_perfil'].' </span> </td>
	                     
	                        <td>  '.$perfilb.'     </td>
	                         
	                        <td> <span class="text-muted"> '.$rowb['nombre_corto'].'</span> </td>

	                        <td style="text-align: left;">
	                        			<span class="text-'.$color_ico.' btn bg-muted btn-icons btn-rounded" > <i class="fa fa-'.$rowb['icono'].'"></i> </span>  &nbsp;
	                        			<span class="text-'.$color_ico.'" >'.$rowb['icono'].' </span> 
	                        </td>

	                        <td style="text-align: center;"> <span class="text-muted"> '.formatFechaHoraTable($rowb['fecha_registro']).' </span> </td>
	                        <td style="text-align: center;"> <span class="text-muted">'.formatFechaHoraTable($rowb['fecha_actualizado']).' </span> </td>
	                        <td style="text-align: center;"> '.$edo.' </td>
	                        
	                        <td>
	                        
			                      '.$options.'
			                       
							</td>
							
	                        </tr>
	                        
	                        
	                      							
	                        '; 
	                        $num = $num + 1;
						}
				}
	
                $ops_perfil_edo = genera_select_edo_perfil($estado);

?>


<div class="col-lg-12" style="margin-top:10px;padding:0px;">
                    <?php
                        //echo $campo_buscar = crea_campo_buscar('admin_perfiles'); 
                        echo $campo_buscar = crea_campo_buscar_cust('admin_perfiles',3); 
                    ?>
</div>


				                				
					<table id="admin_perfiles" class="table table-striped " style="background: #fff;">
                      <thead >
                        <tr>
                        	<th class="thead_content" > ID </th>
                        	<th class="thead_content" > Clave </th>
													<th class="thead_content" > Nombre</th>
													<th class="thead_content" > Nombre Corto </th>
													<th class="thead_content" > Icono </th>
													<th class="thead_content" > Fecha Reg </th>
													<th class="thead_content" > Fecha Act. </th>
													<th class="thead_content" > Estado </th>
													<th class="thead_content" > Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php echo $filas; ?>
                      </tbody>
                      <tfooter >
                        <tr>
                        	<th class="thead_content" > ID </th>
                        	<th class="thead_content" > Clave </th>
													<th class="thead_content" > Nombre</th>
													<th class="thead_content" > Nombre Corto </th>
													<th class="thead_content" > Icono </th>
													<th class="thead_content" > Fecha Reg </th>
													<th class="thead_content" > Fecha Act. </th>
													<th class="thead_content" > Estado </th>
													<th class="thead_content" > Opciones</th>
                        </tr>
                      </tfooter>                      
                      
                      
                    </table>

                    

                   
                    

                    
                    
                    
                    
                    

<!-- ////////////////////////// Nuevo Perfil //////////////////////////// -->

<div id="nuevo_perfil" class="hold_set_edita" style="display:none; " >
	
	
	<div class=" col-lg-12 body_modal semi-transparent " style="min-height: auto;  margin-top: 20px; margin-bottom: 10px; width: 80%; padding:0px;">
	
	<h5 class="col-md-12 p-2 title_sec_sm bg-head " style="padding:0px; border-radius:5px 0 0 0;"> 
            
            <i class="fa-solid fa-sliders"></i> <b> Nuevo Perfil</b>
    
            <div class="btn-group" role="group" style="float:right; border:none;"> 
                <button type="button" onclick="toggle('nuevo_perfil')" class=" btn btn-outline-primary  text-clear" style="border:0px solid #ccc;"> 
                    <i class="fa-solid fa-times fa-lg"></i>
                </button>
            </div> 
     </h5> 


			<div class="p-1 border-bottom center " style="padding: 10px 0 0 5px;">  
                <div class="row">
				<div class="col-md-6"> 
				<span id="new_minifigure_status"  style=" border-radius: 5px;" ></span>
				</div>
                    <div class="col-md-6">                                 
                            <div class="btn-group" role="group" aria-label="" style="float:right; " >   
								<button type="button" class="btn btn-inverse-primary" onclick="save_new_perfil();" > <i class="fas fa-save"></i>  </button>
                            </div>  
                    </div>
                </div>
            </div>


		<div class="content-wrapper" style="background: #fff; "  >
	   		<div class="col-lg-12">				            
				            
				<div class="row">
	   			<div class="col-md-4 grid-margin border-right " >	
				    <form name="form_up_minifigure" method="post" action="?" id="form_up_minifigure" enctype="multipart/form-data">   			
								
								<div class="form-group row compacted">
				                    <label for="edita_index" class="col-sm-4 col-form-label"> Clave</label>
				                    <div class="col-sm-6">
				                        <input type="number" name="new_user_nombre" class="form-control" value="" id="new_perfil_clave" placeholder="">
				                    </div>
				                </div>
			
								<div class="form-group row compacted">
				                    <label for="edita_id" class="col-sm-4 col-form-label">Nombre</label>
				                    <div class="col-sm-6">
				                        <input type="text" class="form-control" id="new_perfil_nombre" placeholder="Nombre">
				                    </div>
				                </div>

								<div class="form-group row compacted">
				                    <label for="edita_id" class="col-sm-4 col-form-label">Nombre Corto</label>
				                    <div class="col-sm-6">
				                        <input type="text" class="form-control" id="new_perfil_corto" placeholder="Nombre Corto">
				                    </div>
				                </div>			                        						  


					            
								<div class="form-group row compacted ">
					                <label for="edita_sku" class="col-sm-4 col-form-label">Icono</label>
					                   	<div class="col-sm-6">
					                            <input type="text"  class="form-control" id="new_perfil_icono" placeholder="fa-nombre">
					                    </div>
					            </div>

								<div class="form-group row compacted ">
					                <label for="new_perfil_estado" class="col-sm-4 col-form-label">Estado</label>
					                   	<div class="col-sm-6">
					                            <select id="new_perfil_estado" class="form-control">
						                            <option value="0"> Elija...</option>
						                            <?php echo $ops_perfil_edo; ?>
					                            </select>
					                    </div>
					            </div>

                                <div class="form-group row compacted no-show">
					                <label for="edita_sku" class="col-sm-4 col-form-label">Permisos Pag</label>
					                   	<div class="col-sm-6">
                                           <input type="hidden" class="form-control" disabled id="code_permiso" value="" />
					                    </div>
					            </div>

                                <div class="form-group row compacted no-show">
					                <label for="edita_sku" class="col-sm-4 col-form-label">Permisos Conf</label>
					                   	<div class="col-sm-6">
                                           <input type="hidden" class="form-control" disabled id="code_permiso_conf" value="" />
					                    </div>
					            </div>				            				                    
				</div>

                <div class="col-md grid-margin " >

								<div class="form-group row compacted ">
					                <label for="new_perfil_estado" class="col-sm-6 col-form-label text-muted">Copiar Permisos</label>
					                   	<div class="col-sm-6">
					                            <select id="new_perfil_copy" class="form-control" onchange="busca_permisos_perfil(this.value);">						                           				                            
						                            <?php echo genera_select_perfil_permisos($select_per); ?>
                                                    <option value="98"><b> Asignar Manualmente </b></option>
					                            </select>
					                    </div>
					            </div> 

                                <div id="permisos_perfil" class="form-group compacted " style="display:none;" >
                                        <div class="row">
                                            <label for="new_perfil_estado" class="col-sm-6 col-form-label text-muted">Permisos página encontrados</label>
					                        <label for="new_perfil_estado" class="col-sm-6 col-form-label text-muted">Permisos configs encontrados</label> 
                                        </div>	
                                        <div class="col-md-12 row" id="current_permisos" style="height:20%; overflow-x:hidden; overflow-y:auto;">
                                           <select id="select_permisos_current" class="col-md-6 form-control" style="width:100%; height:150px;" multiple="multiple"> </select>
                                           <select id="select_permisos_conf_current" class="col-md-6 form-control" style="width:100%; height:150px;" multiple="multiple"> </select>
                                        </div>
                                        
                                </div>            
                                
                </div><!-- col-md-6-->
				
				
				</div>
				
			</div>
	   	</div>
	</div>