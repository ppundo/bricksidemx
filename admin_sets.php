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
			
              $qb = "SELECT * FROM temas_sets order by nombre asc;";// preparando la instruccion sql

   
			    $resultb= $dbh->query($qb);
			    if ($resultb->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($rowb= $resultb->fetch_assoc()){
	                        
	                        //color 
	                        $data = explode(',', $rowb['color']); 
	                        
	                        $r = $data[0];
	                        $g = $data[1];
	                        $b = $data[2];
	                        
	                        $color = fromRGB($r, $g, $b);
	                        
	                        // color b
	                        
	                        $datab = explode(',', $rowb['color_alt']); 
	                        
	                        $rb = trim($datab[0]);
	                        $gb = trim($datab[1]);
	                        $bb = trim($datab[2]);

	                        $colorb = fromRGB($rb, $gb, $bb);

	                        // Color Texto 

	                        if($rowb['color_txt']==''){

	                        	$color_t = '100,100,100'; 
	                        }else{
	                        	$color_t = $rowb['color_txt'];
	                        }

	                        $datac = explode(',', $color_t ); 
	                        
	                        $rc = trim($datac[0]);
	                        $gc = trim($datac[1]);
	                        $bc = trim($datac[2]);

	                        $colorc = fromRGB($rc, $gc, $bc);
	                        
	                        	                        
	                        
	                        if($r < 77 || $g < 70 || $b < 50){
			                    $class_btn = 'btn-outline-light';
			                    $class_text = '';
			                    $border = '0px solid #ccc';
		                    }else{
								$class_btn = 'btn-outline-success'; 
								 $class_text = '';
								 $border = '1px solid #ccc';
							}
	                        
	                       							
							if($user_perfil==1){
							$cve = ""; 
							}else{
								$cve = "";
							}
							
							
							$edo = get_lbl_estado_set($rowb['estado']);
	                        
	                        if($rowb['estado']==1){
		                       
		                       // $edo = '<span id="s_edo_'.$rowb['id'].'" class="theme_color" style="font-size: 22px;"> <i class=" fa fa-eye " ></i> </span>';
		                        $btn_edita = '<button '.$hab_btn.' class="btn btn-inverse-primary btn_thin" onclick="quick_edit_tema(\'2-'.$rowb['id'].'\')" > <i class="fa fa-eye-slash" ></i> </button>'; 
	                        }elseif($rowb['estado']==0){
		                       // $edo = '<span class="theme_gris" style="font-size: 22px;"> <i class=" fa fa-eye-slash" ></i> </span>';
		                        $btn_edita = '<button '.$hab_btn.' class="btn btn-inverse-primary btn_thin"  onclick="quick_edit_tema(\'2-'.$rowb['id'].'\')" > <i class="fa fa-eye" ></i> </button>'; 
	                        }
	                        
	                        $logo = listLogo($rowb['logo']);
	                        
	                        $btn_save = '<button class="btn btn-inverse-primary btn_thin " onclick="quick_edit_tema(\'1-'.$rowb['id'].'\')" > <i class="fa fa-save" ></i> </button>';
	                        $btn_pecil = '<button class="btn btn-inverse-primary btn_thin" onclick="toggleb(\'row_'.$rowb['id'].'\');  " > <i class="fa fa-pencil" ></i> </button> ';   
	                        
	                        //$btn_elimina = '<button class="btn btn-outline-secondary " '.$hab_btn.'  onclick="quick_edit_tema(\'4-'.$rowb['id'].'\')" > <i class="fa fa-trash" ></i> </button>';


								$perfil = $GLOBALS['user_perfil'];
								 $permiso_elimina = get_permiso_config('4', $perfil);
								 
								 if($permiso_elimina==1){

									$btn_elimina = '
									<button class="btn btn-inverse-primary btn_thin" '.$hab_btn.'  onclick="quick_edit_tema(\'4-'.$rowb['id'].'\')" > 
									'.$ico_global_elimina.'  </button>'; 									 
								 }else{

									$btn_elimina = '<button class="btn btn-inverse-primary btn_thin text-muted " disabled > 
									'.$ico_global_elimina.'  </button>'; 

																 
								 }
	                        

	                        

							if($rowb['fecha_registro']=='0000-00-00 00:00:00'){
								$dato = '<span class="text-muted" > - </span>';
							}else{
								$dato = '<span class="text-muted">'.formatFechaHoraTable($rowb['fecha_registro']).'</span>';
							}


							if($rowb['fecha_actualizado']=='0000-00-00 00:00:00'){
								$datob = '<span class="text-muted" > - </span>';
							}else{
								$datob = '<span class="text-muted">'.formatFechaHoraTable($rowb['fecha_actualizado']).'</span>';
							}
							
							$mnu = 'b9c9c58ba5c4a970159f9a5ee44cba96'; 
							$url = $link_site.'?mnu='.$mnu.'&item='.$rowb['id'];
							//b9c9c58ba5c4a970159f9a5ee44cba96
							
	                        $options = '
							<div class="btn-group" role="group" aria-label="">
								<a class="btn btn-inverse-primary btn_thin" style="" href="'.$url.'"> '.$ico_global_edit.'  </a>
								 '.$btn_edita.'
								 </div>
		                          <div class="btn-group" role="group" aria-label="">'.$btn_elimina.'</div>';
								  
								  
	                        $filas .= '
	                        
	                        <tr>
	                        <td style="text-align: center;">
	                        '.$num.'
	                        </td>
	                        
	                        <td style="text-align: center; width:150px;  " > 
								<div class="logo_tema__set" style="background:linear-gradient(155deg, rgba('.$rowb['color'].',0.9 ) 60%, rgba('.$rowb['color_alt'].',0.7) 100%); border-radius: 80px;" > 
									<img class="col-md-12" style=" max-height: 250px; max-width: 500px; border-radius: 0px; width:auto; padding: 5px 25px;" src="assets/images/logos/'.$rowb['logo'].'" > 
								</div>	  
	                         </td>
	                         
							 
							 <td style="text-align: left;"> 
								 
								 
								 <span class="text-muted" style="font-size:1.1em; border: 0px solid #ccc; background: none; " > 
								 '.$rowb['nombre'].' 
								 </span>
							 
							 </td>
							 
	                        <td style="text-align: center;"> 
	                        
								<span id="tema_color_current_'.$rowb['id'].'" class="'.$class_text.'" style="color: rgba('.$color_t.',0.9); padding: 2px 5px; border-radius:3px; background: '.$color.'; border: '.$border.';  " > '.$color.' </span>
	                        	
	                        	<a class="no-show text-neutral" onclick="toggle(\'tema_color_'.$rowb['id'].'\');  " style="padding: 2px 5px; "><i class="fa fa-pencil"></i></a           
	                        
	                        </td>

	                        <td style="text-align: center;"> 
	                        
								<span id="tema_color_current_b_'.$rowb['id'].'" class="'.$class_text.'" style=" color: rgba('.$color_t.',0.9); padding: 2px 5px; border-radius:3px; background: '.$colorb.'; border: '.$border.';  " > '.$colorb.' </span>

	                        </td>	                     
	
	                        <td style="text-align: center;">  '.$datob.' </td>
	                        
	                        <td style="text-align: center;"> '.$edo.' </td>
	                        
	                        <td>
	                        		<span class="no-show" >IdDB '.$rowb['id'].'</span>
									
			                      '.$options.'
							
			                       
							</td>
							
	                        </tr>
							 
							 
										
	                        '; 
	                        $num = $num + 1;
						}
				}
	


?>
<div class="scrollable " style="background: none; border: none;">
     

						 <div class="card-body ">

     <?php               
	//$campo_buscar = crea_campo_buscar('temas_sets'); 
    $campo_buscar = crea_campo_buscar_cust('temas_sets',3);  
	echo $campo_buscar; 
	
	?>  		
								<table id="temas_sets" class="table table-striped ">
			                      <thead >
			                        <tr>
			                          <th class="thead_content" > No</th>
			                          <th class="thead_content" > Logo</th>
			                          <th class="thead_content" > Nombre </th>
			                          <th class="thead_content" > Color </th>
			                          <th class="thead_content" > Color Alterno </th>
			                          <th class="thead_content" > Última Act.</th>
			                          <th class="thead_content" > Estado </th>
			                          <th class="thead_content" > Opciones</th>
			                          
			                        </tr>
			                      </thead>
			                      <tbody>
			                      	<?php echo $filas; ?>
			                      </tbody>
			                   
								  <tfooter >
			                        <tr>
			                          <th class="thead_content" > No</th>
			                          <th class="thead_content" > Logo</th>
			                          <th class="thead_content" > Nombre </th>
			                          <th class="thead_content" > Color </th>
			                          <th class="thead_content" > Color Alterno </th>
			                          <th class="thead_content" > Última Act.</th>
			                          <th class="thead_content" > Estado </th>
			                          <th class="thead_content" > Opciones</th>
			                          
			                        </tr>
			                      </tfooter>			                   
			                    </table>
			                    
						 </div>



                   
                   
                    
</div>             
                    
 <!-- ////////////////////////// Nuevo Tema //////////////////////////// -->

<div id="nuevo_tema_set" class="hold_set_edita" style="display:none; " >
	
	
<div class=" col-lg-12 body_modal semi-transparent " style="min-height: auto;  margin-top: 20px; margin-bottom: 10px; width: 60%; padding:0px;">
	
	<h5 class="col-md-12 p-2 title_sec_sm bg-head " style="padding:0px; border-radius:5px 0 0 0;"> 
            
            <i class="fa-solid fa-sliders"></i> <b> Nuevo Tema</b>
    
            <div class="btn-group" role="group" style="float:right; border:none;"> 
                <button type="button" onclick="toggle('nuevo_tema_set')" class=" btn btn-outline-primary  text-clear" style="border:0px solid #ccc;"> 
                    <i class="fa-solid fa-times fa-lg"></i>
                </button>
            </div> 
     </h5> 

			<div class="p-1 border-bottom center " style="padding: 10px 0 0 5px;">  
                <div class="row">
                    <div class="col-md-6"> 
                        <span id="new_tema_status" class="text-light bg-info" style=" border-radius: 5px;" ></span>
                    </div>
                    
                    <div class="col-md-6">                                 
                            <div class="btn-group" role="group" aria-label="" style="float:right; " >   
								<button type="button" class="btn btn-inverse-primary" onclick="save_new_tema();" > <i class="fas fa-save"></i>  </button>
                            </div>  
                    </div>
                </div>
            </div>

        <div class="content-wrapper" style="background: #fff; "  >
	   		<div class="col-lg-12">

		   				            
				            
				            
				<div class="row">
	   			<div class="col-md-6 grid-margin " >	
				    <form name="form_up_tema_set" method="post" action="?" id="form_up_tema_set" enctype="multipart/form-data">   			

			
								<div class="form-group row compacted">
				                    <label for="edita_id" class="col-sm-3 col-form-label">Nombre</label>
				                    <div class="col-sm-6">
				                        <input type="text" class="form-control" name="new_tema_set_nombre" id="new_tema_set_nombre" placeholder="Nombre">
				                    </div>
				                </div>
			                        						  
	                        
			                    <div class="form-group row compacted">
			                        <label for="edita_imagen" class="col-sm-3 col-form-label">Color</label>
			                    	    <div class="col-sm-6">
			                              <input type="color" min="100"  class="form-control" id="new_tema_set_color" > 
			                            </div>
			                    </div>
			                    
			                    <!-- $row['nombre'].'-'.$row['piezas'].'-'.$row['cve_lego'].'-'.$row['id_tema'].'-'.$row['precio'].'-'.$row['anio_public']; -->
								<div class="form-group row compacted ">
					                <label for="edita_sku" class="col-sm-3 col-form-label">Logo</label>
					                   	<div class="col-sm-6">
					                            <input type="text"  class="form-control" disabled="" id="new_tema_set_logo" placeholder="Logo Tema">
					                    </div>
					            </div>


					           					            				                    
				</div>
				
				
				<div class="col-md-6 grid-margin " >
					
			                    <div class="form-group row compacted grid-margin ">
			                        <label for="edita_imagen" class="col-sm-12 ">Subir Imagen</label>
			                    	
				                        <input type="file" name="foto_tema" class="form-control " id="foto_tema" placeholder="Imagen">
				                        <a class="btn btn-primary btn-block  text-light" id="btn_up_foto_tema" onclick="save_foto(3);"> <i class="fa fa-arrow-circle-up"></i> Subir Foto</a>
				                        <input type="hidden" name="user_id" value="<?php echo $user_id?>" >
				                        <input type="hidden" name="user_perfil" value="<?php echo $user_perfil?>" >
				                        <input type="hidden" name="tipo" value="3" >
			                    	</form>
			                    </div> 
			                   
			                    
			                    <div id="prev_image_tema" class="row form-group compacted" style=" display: block; border: 0px solid #ccc;  ">
				                   
			                    </div>
				</div>
				</div>
				
			</div>
	   	</div>
	</div>
		
</div>


<!-- ////////////////////////// Admin Fotos TEMAS //////////////////////////// -->

<div id="admin_logos" class="hold_set_edita" style="display:none;  " >
	
	
	<div class="main-panel set_panel " style="min-height: auto;  margin-top: 10px; margin-bottom: 10px; width: 90%; float: right;    ">
		<div class="set_pestana_edita" style=" "> <span class="claro" onclick="toggle('admin_logos'); "> <i class="fas fa-times"></i></span></div>
	   	
        
        
        <div class="content-wrapper" style="background: #fff; "  >
	   		<div class="col-lg-12">

		   			        <div class="p-3  border-bottom  " style="padding: 10px 0 0 5px;">
				                   <h4>
					                   <span class="card-title-set text-success " style="float: left;" id="title_minifigure">Administrar Logos</span>
					                   <input type="hidden" id="serie_fotos_admin" value="<?php echo($serie); ?>">
				                   		<div class="btn-group " role="group" aria-label="" style="margin-left: 25px; " >
					                   		
											
		
		                      			</div>
                      								                   
					               </h4>
					               
							</div>
							
	                   		<div class="p-1 border-bottom  bg-light grid-margin"  style="text-align: center; "> 
		                   		&nbsp;  <span id="admin_logo_status"  style=" border-radius: 5px;" >Las imágenes en amarillo, son las únicas que podrán manipularse. </span>
	                   		</div>    
	                   		
	                   		
				<div class="row" style="border: 0px solid #c30; max-height: 50%;  ">
					
					
		   			<div class="col-sm-4 grid-margin "style="max-height: 350px; border: 0px solid #c30;  " >	
			   			
			   			
			   			<?php
				   			
				   			$info = labels_admin_logos();
				   			
				   			

				   			echo '
				   			<div style="height:80%; border: 0px solid #c34; overflow-x: hidden; overflow: scroll; pading: 3px 3px; " id="hold_labels_logos" >
				   			
				   			'.$info.'
				   			</div>
				   			'; 
				   			//echo $labels; 
				   			
				   			?>
	                				            				                    
					</div>
				
				
					<div class="col-md-4 grid-margin " style="max-height: 300px; " >
						
						<label for="edita_imagen" class="col-sm-12 text-muted">Preview de Foto</label>
						
											<div class="card-body" >
												<div class="bg_imagen border">
													<div class="imagen_edita" id="image_holder_">
														<img class="picture_o" style=" max-height: 490px; max-width: 340px; margin-top: 30px;  " src="" id="prev_logo">
													</div> 
													
												</div>
											</div>
						
						
						
<!---- Cierre del DIV ----------- hold_labels_images -->
							
					</div>
					
					<div class="col-md-4 grid-margin" >
						
						<button class="btn btn-outline-secondary btn-block grid-margin" onclick="toggle('hold_subir_logo')"> <i class="fa fa-upload"></i> Subir imagen </button>
						
							<div id="hold_subir_logo" style="display: none; ">
				                    <div class="form-group row compacted grid-margin ">
				                        
				                    	<form name="form_up_logo" method="post" action="?" id="form_up_logo" enctype="multipart/form-data">  
					                        <input type="file" name="foto_logo" class="form-control " id="foto_logo" placeholder="Imagen">
					                        <a class="btn btn-primary btn-block  text-light" id="btn_up_foto_logo" onclick="save_foto(7); "> <i class="fa fa-save"></i> Guardar Foto</a>
					                        <input type="hidden" name="tipo" value="7" >
				                    	</form>
				                    </div> 
				                   
				                    
				                    <div id="prev_image_logo_admin" class="row form-group compacted" style=" display: block; border: 0px solid #ccc;  ">
					                   
				                    </div>
							</div>
					</div>					
					
				</div>
				
			</div>
	   	</div>
	</div>
		
</div>