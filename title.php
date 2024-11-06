<?php 
	
	$debug = 0; 

		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			if ($dbh->connect_error) {
			    die("Connection failed: " . $dbh->connect_error);
			}

	$menu = $_GET["mnu"];
	$serie = $_GET['ref'];
	$todas = $_GET['all'];
	$access = $_GET['access'];
	$obj = $_GET['obj'];
	
	//var_dump(isset($menu));
	
	if(isset($menu) == TRUE and isset($serie)== FALSE and isset($todas)== TRUE and isset($access)==FALSE){ // Todas las Figuras
		
        if($debug == 1){
            echo ('1010');
            
        }else{
            
        }
		
	$cve = $_GET['cve'];
	
			if($cve == 1){
		
				$title = 'Minifiguras '; 
				
				/////// Complemetos
				
				$item = $user.';'.$clave_lego;
				//$total_collect = busca_info_coleccion($item); 
				$num = busca_info_coleccion($item);
				
				$admin_tools = "";
				$barra_status = ' <li><a href="#">Tienes:  <span id="total_serie_label"> '.$num.' minifiguras </a></li>
		                      <li class="" ><a href="#"> <span id="conteo"></span> </a></li>';
							  
				$op_generales = ''; 
				
				///////////////////
						
			}elseif($cve == 2){
		
				$title = 'Sets '; 
				
			
			
				/////// Complemetos
				
				
				$admin_tools = "";
				$barra_status = ' <li><a href="#">Tienes:  <span id="total_serie_label"> '.$num.' sets </a></li>
		                      <li class="" ><a href="#"> <span id="conteo_sets"></span> </a></li>';
							  
				//$op_generales = ''; 
				
				///////////////////		
			}

		
		
		
	}elseif(isset($menu)== TRUE and isset($serie)== TRUE and isset($todas)== FALSE and isset($access)==FALSE ) { // una serie en especifico 

		//$display_vista_btn = 'display: block;';
        // debug flag
        if($debug == 1){
            echo ('1100');
            
        }else{
            
        }
	
		if($menu== md5('sets')){
		///// ICO GRID 
		$display_vista_btn = 'display: inline-block;'; 
		$mnu= $_GET['mnu'];
		$ref = $_GET['ref'];
		$cve = $_GET['cve'];
		$thema= $_GET['thema'];
		
		$home = $link_site.'?mnu=';
		
        $op_generalesc .= '<a href="'.$home.$mnu.'&ref='.$ref.'&cve='.$cve.'&thema='.$thema.'&lista=1" class="btn btn-outline-secondary bar_itm_op"><i class="fa-solid fa-clipboard-list"></i> Lista </a>'; 

        /*
		$ico_vista_grid = '
		<div class="btn-group" role="group" aria-label="">
		<span class="btn btn-inverse-secondary btn_sm_custom text-muted" > Opciones: </span>
			<a href="'.$home.$mnu.'&ref='.$ref.'&cve='.$cve.'&thema='.$thema.'&lista=1" class="btn btn-inverse-secondary btn_sm_custom "><i class="fa fa-list"></i> Lista  </a>
			
		</div>
		'; 	  
        */
	
		}else{
			$display_vista_btn = 'display: none;'; 
		}	
	
	/////////
	
		$cve = $_GET['cve'];
		
				
			      //informacion de acceso a la bd
			// Check connection


				$qa = "SELECT * FROM series WHERE clave_lego = '$serie';";

//echo $qa;
			    $resulta= $dbh->query($qa);
			    if ($resulta->num_rows > 0) {
	    	    
                        $rowa= $resulta->fetch_assoc();
                        
                        $serie_color = $rowa['color'];
                        $serie_nombre = $rowa['nombre'];
                        $clave_lego = $rowa['clave_lego'];
                        $title = '<b class="text-success">'.strtoupper($rowa['nombre']).'</b>';
	                        
				}else{
					$title = '';
				//	echo 'No hay registros que seleccionar';
				}

				

		/////// Complemetos
		
		$item = $user.';'.$clave_lego;
		$total_collect = busca_info_coleccion($item);
		$num = get_total_minifig($clave_lego);
		
		if($cve==1){
		
			if($total_collect == $num){
				$ico = '<i class="fa fa-trophy" ></i>';
				$class = 'active_star';
			}else{
				$ico = ''; 
				$class = 'diactive_star';
			}
		
		$filtros = '
					<li style="float: right; ">	<a href="#"  onclick="toggle(\'filters\');" class="text-neutral" style="" > 
						  <i class="fa fa-filter"></i> Ver Filtros </a>
					</li>
		
		';

        
		$admin_tools = "";

		$op_generales .= '<a href="index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6&all=1&cve=1" alt="Ver todas las figuras" class="btn btn-outline-secondary"> 
								<i class="fa fa-cubes"></i> Todas las figuras </a>'; 
								
		$barra_status = ' <li class=""><a href="#">Clave LEGO: <b>'. $clave_lego.'</b> </a></li>
				                      <li><a href="#" class="'.$class.'" >'.$ico.' Tienes:  <b><span id="total_serie_label">'.$total_collect.' </span></b> de <span id="tot_fig">'.$num.'</span> minifiguras </a></li>
				                      <li class="" ><a href="#"> <span id="conteo"></span> </a></li>'; 
		$barra_status .= $filtros;  


        if($menu== md5('shelf') and isset($serie)==TRUE ){
            
        $id_config = 1; 
        $config_barra = get_estado_config($id_config,$GLOBALS['user']); 

        if($config_barra==1){
            $btn_barra = '<button class="btn btn-outline-primary" type="button" onclick="estado_barra_col(1);"><i class="fa-solid fa-toggle-on"></i></button>';
        }else{
            $btn_barra = '<button class="btn btn-outline-secondary text-head" type="button" onclick="estado_barra_col(1);"><i class="fa-solid fa-toggle-off"></i></button>';
        }

       //var_dump($GLOBALS['user']);

            $div_op_general .= '
            <div class="col-md-12 form-group ">
                
                        '.$btn_barra.'
               
            </div>
            ';
        }
				                      
		}elseif($cve==2){
			
			$tema = $_GET['ref'];
			$menu = $_GET['mnu'];
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			      //informacion de acceso a la bd
			// Check connection
					if ($dbh->connect_error) {
					    die("Connection failed: " . $dbh->connect_error);
					}

				$qa = "SELECT * FROM temas_sets WHERE id= $tema ;";

//echo $qa;
			    $resulta= $dbh->query($qa);
			    if ($resulta->num_rows > 0) {
	    	    
                        $rowa= $resulta->fetch_assoc();
                        $title = '<span class="" style="font-size: 18px; "> <i class="fas fa-angle-right"></i> </span>'.strtoupper($rowa['nombre']);
	                        
				}else{
					$title = '';
				//	echo 'No hay registros que seleccionar';
				}			
			
			
			////////// botones 
			
		$barra_status = ' <li class="" ><a href="#"> <span id="conteo"></span> </a></li>'; 
				                      

			//$op_generales .= '<a href="#" onclick=" toggle(\'nuevo_set\') "  class="btn btn-outline-secondary"> <i class="fa fa-plus-circle"></i> Agregar Set </a>'; 
			/*$op_generales .= '<a href="index.php?mnu='.$menu.'&all=1&cve=2"  class="btn btn-outline-secondary"> 
								<i class="fa fa-cubes"></i> Todos los Sets </a>'; */
											
			$barra_status = ''; 
			$admin_tools = "";
			
			
			

			
		}
		
		//$set_theme = $rowa['nombre'];
		///////////////////
		
		
	}elseif(isset($menu)== TRUE and isset($serie)== FALSE and isset($todas)==FALSE and isset($access)==FALSE ) { // Pagina administrativa
	
		// debug flag
		if($debug == 1){
			echo ('1000');
		}else{
			
		}

	  
		if($menu== md5('todas_minifig')){
			
			//$item = $user.';'.$clave_lego;
			//$total_collect = busca_info_coleccion($item);

            $div_op_general .= '';

			//$num = get_total_minifig($clave_lego);
			$admin_tools = '';
			$barra_status = '';
			
			

					$mnu= $_GET['mnu'];
					$cve = $_GET['cve'];
					$home = $link_site.'?mnu=';
                    
						
				    $data_series = get_series_activas(); 
				    $series_act = explode('-', $data_series);

                    $op_generalesc .= '<a href="'.$home.$mnu.'&cve='.$cve.'&lista=1" class="btn btn-inverse-secondary "><i class="fa-solid fa-clipboard-list"></i> Lista Minifiguras </a>'; 
                    $div_op_general .= '';
				
					for($i=0; $i< count($series_act); $i++){
						
						if($series_act[$i] != '' or $series_act[$i]!= NULL){
						
							$item = $user.';'.$series_act[$i];						
							$total_collect = busca_info_coleccion($item);												
							$gran_tot = ($gran_tot + $total_collect);
							
                            // busca total de figuras

                            $total_serie = get_total_minifig($series_act[$i]);
                            $gran_tot_fig = $gran_tot_fig + $total_serie;
						}
						
					}
				
				//var_dump($series_activas); 
						
	
				
				$barra_status = ' <li><a href="#">Tienes:  <span id="total_serie_label"> '.$gran_tot.' de '.$gran_tot_fig.' minifiguras </a></li>
			                      <li class="" ><a href="#"> <span id="conteo"></span> </a></li>';

			
			
		}elseif($menu== md5('shelf') or $menu== md5('sets') ){
		///// ICO GRID 
		
       

		$mnu= $_GET['mnu'];
		$home = $link_site.'?mnu='.$mnu;
		
		$ops = genera_select_columnas('0');
		$opsb = genera_btn_columnas('0');
		

        $div_op_general .= '
        <div class="col-md-12 form-group">
                   
            <select class="col-md-12 form-control" onchange="" >
                '.$ops.'
            </select>
    
        </div>
        ';
       
      
	
		}elseif($menu== md5('todos_sets') or $menu== md5('sets') ){
		///// ICO GRID 
		
        $ops = genera_select_columnas('0');

        $div_op_general .= '
        <div class="col-md-12 form-group">
               
            <select class="col-md-12 form-control" onchange="" >
                '.$ops.'
            </select>
    
        </div>

        <div class="col-md-12 form-group">
            <label class=""> Filtros </label>         
            <select class="col-md-12 form-control" onchange="" >
                '.$ops.'
            </select>

        </div>
        ';
		

				$mnu= $_GET['mnu'];
				$cve = $_GET['cve'];
				
				$home = $link_site.'?mnu='.$mnu;

                $modal_link = $link_site.'?mnu='.$mnu.'&cve='.$cve.'&mod=1'; 

				$op_generalesc .= '<a href="'.$home.'&cve='.$cve.'&lista=1" class="btn btn-inverse-secondary bar_itm_op"><i class="fa-solid fa-clipboard-list"></i> Lista </a>'; 
				$op_generalesc .=  '<a href="'.$modal_link.'" class="bar_itm_op btn btn-outline-secondary " ><i class="fa fa-link"></i></a>';

                
				//$filtros = '<a href="#" onclick="toggle(\'filtros\')" class="btn btn-inverse-secondary btn_sm_custom "><i class="fa fa-filter"></i> Filtros  </a>';
				

                /*
				$ico_vista_grid = '
				<div class="btn-group" role="group" aria-label="">
				<span class="btn btn-outline-secondary btn_sm_custom text-muted" > Mostrar: </span>
					<a href="'.$home.$mnu.'&cve='.$cve.'&lista=1" class="btn btn-inverse-secondary btn_sm_custom "><i class="fa fa-bars"></i> Lista  </a>
					'.$filtros.'
				</div> 
				'; 	 
                */


				//$div_op_general .= $filtros;
                // boton para generar link. 
	
				$mnu = $_GET['mnu'];
				$cve = $_GET['cve'];
							
				$id_user_b = $GLOBALS['user'];
				$estado_link = get_estatus_link($id_user_b);
				
	
		
		
		}elseif($menu == md5('coleccion_user')){		
		
            $div_op_general .= '';

			//	$btn_holder = '<div id="btn_holder">Hola mundo</div>';
				$op_generalesb = $btn_holder;
		

				$mnu_drop = '<button style="display: '.$class_ops.'; " class="btn btn-secondary dropdown text-neutral" onclick="toggle(\'ops\');" > Opciones  <i class="fas fa-angle-down"></i> </button>
				
					<div id="ops" class="dropdown dropdown_ops" onmouseout="toggle(\'ops\'); " >
					
					'.$op_generalesb.'
				
					</div>
				
				';
				
                

		}else{
			
		}



		///////////////////
	
	}elseif(isset($menu)== FALSE and isset($serie)== FALSE and isset($todas)==FALSE and isset($access)==FALSE ) { //Dashboard
	// debug flag
	if($debug == 1){
		echo ('0000');
	}else{
		
	}
	
	/////////
		$title = '<span><i class="fa fa-th-large"></i> </span> MINIFIGURAS'; 
		// $admin_tools = ""; 
		//$op_generales = ''; 
	
		/////// Complemetos
		
		
		$admin_tools = "";
		$barra_status = '';
					  
		$op_generales = '<a href="index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6&all=1&cve=1" class="btn btn-outline-secondary"> 
								<i class="fa fa-cubes"></i> Todas lass figuras
								</a>'; 
		
		///////////////////
	
	}elseif(isset($menu)== FALSE && isset($serie)== FALSE && isset($todas)==FALSE && isset($access)==TRUE ) { //Dashboard
			// debug flag
	if($debug == 1){
		echo ('0001');
	}else{
		
	}
	
	/////////
		
		
		
			if($access==1){
				
						$title = 'Entrar'; 
						//$admin_tools = ""; 
						//$op_generales = ''; 
						//$doc = 'login.php';
						/////// Complemetos
						
						
						$admin_tools = "";
						$barra_status = '';
									  
						$op_generales = ''; 
		
			}else if($access==2){
						$title = 'Crear Cuenta'; 
						//$admin_tools = ""; 
						//$op_generales = ''; 
						//$doc = 'register.html';
						/////// Complemetos
						
						
						$admin_tools = "";
						$barra_status = '';
									  
						$op_generales = '';
									
			}else if($access==3){
						$title = 'Restablecer Contraseña'; 
						//$admin_tools = ""; 
						//$op_generales = ''; 
						//$doc = 'recuperapass.php';
						/////// Complemetos
						
						
						$admin_tools = "";
						$barra_status = '';
									  
						$op_generales = ''; 			
			}else{
				
						$title = 'Entrar'; 
						//$admin_tools = ""; 
						//$op_generales = ''; 
						//$doc = 'login.php';
						/////// Complemetos
						
						
						$admin_tools = "";
						$barra_status = '';
									  
						$op_generales = ''; 
				
			}

		///////////////////
	
	}else{

		$title = 'Entrar'; 
	
	
		/////// Complemetos
		
		
		$admin_tools = "";
		$barra_status = '';				  
		$op_generales = ''; 

	}

////////////////////////////////////

if($cve =! 0 ){
// busca botones nivel 3

	// debug flag
	if($debug == 1){
		//echo ('999');
	}else{
		
	}
	
	/////////






//---------------------- Opciones Para la barra de menus
$resultab = ''; 
				$qa = "SELECT * FROM menus WHERE cve = '$menu';";
				//echo($qa).'<br>'; 
			    $resulta= $dbh->query($qa);
			    if ($resulta->num_rows > 0) {
	    	    
                        $rowa= $resulta->fetch_assoc();
                        $id = $rowa['id'];
                        
                        if(isset($serie) == FALSE){
	                        if(isset($obj)==TRUE ){
		                        $add_title = ': <b>'.$_GET['obj'].'</b>';
	                        }else{
		                        $add_title =''; 
	                        }
                        $title = '<span style="font-size: 18px; "> <i class="fa fa-'.$rowa['icon'].'"></i> </span>'.strtoupper($rowa['title']);
                        }
                        
                        $set_theme = $rowa['title'];
                        //echo($id).'<br>'; 
                        // busca menu hijos en nivel 3.
                        	$qb = "SELECT * FROM menus WHERE mnu_padre = $id and nivel in (3,5) and estado = 1 order by orden asc;";
                        //	echo($qb).'<br>';
						    $resultb = $dbh->query($qb);
						    
						   // echo($resultb->num_rows).'<br>'; 
						    if ($resultb->num_rows > 0) {
				    	    
			                        while($rowb = $resultb->fetch_assoc()){
						            
						            if($rowb['tipo_menu']== 1){ // boton para mostrar un div
							            
							            $perfil = $GLOBALS['user_perfil'];
										//$permiso = valida_permiso_perfil($rowb['id'],$perfil);
										$permiso = get_permiso_pagina($rowb['id'],$perfil);
										
										if($permiso==1){

											$op_generalesb .='
											<a href="#"  onclick="toggle(\''.$rowb['link'].'\');" class="dropdown-item text-neutral" style="display: block; width: 100%;  " > 
											<i class="fa fa-'.$rowb['icon'].'"></i> '.$rowb['title'].' 
											</a>'; 	


											$op_generalesc .='
											<a href="#"  onclick="toggle(\''.$rowb['link'].'\');" class="btn btn-inverse-secondary" style="margin-left:2px;" > 
												<i class="fa fa-'.$rowb['icon'].'"></i> '.$rowb['title'].' 
											</a>'; 	
											
										}else{
											$op_generalesb .= '';
											$op_generalesc .= '';
										}
							            
						          
									}else if($rowb['tipo_menu']== 4){ // boton para mostrar un div
							            
							            $perfil = $GLOBALS['user_perfil'];
										//$permiso = valida_permiso_perfil($rowb['id'],$perfil);
										$permiso = get_permiso_pagina($rowb['id'],$perfil);
										
										if($permiso==1){
	

												if($rowb['id']==113){
													$page =get_pag_info($rowb['cve']);
                                                    $data_pag = explode('|',$page);
                                                    $pag = $data_pag[0];

												}if($rowb['id']==114){
													$pageb = get_pag_info($rowb['cve']);
                                                    $data_pagb = explode('|',$pageb);
                                                    $pagb = $data_pagb[0];
												}
											
											
										}else{

											if($rowb['id']==113 ){
												$pag = 'empty.php';
											}elseif($rowb['id']==114){
												$pagb = 'empty.php';
											}else{

												$op_generalesb .= '';
												$op_generalesc .= '';
											}
										}
							            
						          
							            
						            }else if($rowb['tipo_menu']== 0){ // boton que te lleva a una pagina
							            
							            $perfil = $GLOBALS['user_perfil'];
										//$permiso = valida_permiso_perfil($rowb['id'],$perfil);
										$permiso = get_permiso_pagina($rowb['id'],$perfil);
										
										if($permiso==1){
						            
											$op_generales .= '
											<a href="index.php?mnu='.$rowb['cve'].'&cve=2"  class="btn btn-outline-neutral text-neutral"> 
												<i class="fa fa-'.$rowb['icon'].'"></i> '.$rowb['title'].' 
											</a>'; 
											
											$op_generalesb .='
											<a href="index.php?mnu='.$rowb['cve'].'&cve=2" class="dropdown-item text-neutral" style="display: block; width: 100%;  " > 
											<i class="fa fa-'.$rowb['icon'].'"></i> '.$rowb['title'].' 
											</a>'; 

											$op_generalesc .='
											<a href="index.php?mnu='.$rowb['cve'].'&cve=2" class="btn btn-inverse-secondary" style="margin-left:2px;"> 
											<i class="fa fa-'.$rowb['icon'].'"></i> '.$rowb['title'].' 
											</a>'; 
										
										}else{
											$op_generales .= '';
											$op_generalesb .='';
											$op_generalesc .='';
										}
										
									}
						                        
									}//while 
			                        
			                       $class_ops = 'block';
				                        
							}else{
								$op_generales .= '<span></span>';
								$op_generalesb .='';
								$op_generalesc .='';
								
								$class_ops = 'none';
							}
                    //// Mismo lugar distinto nivel



					///
	                        
				}else{
					
					$op_generales .= '<span></span>';
					$class_ops = 'none';
				}
			
			//////
			
		
$mnu_drop = '<button style="display: '.$class_ops.'; " class="btn btn-secondary dropdown text-neutral" onclick="toggle(\'ops\');" > Opciones  <i class="fas fa-angle-down"></i> </button>

	<div id="ops" class="dropdown dropdown_ops" onmouseout="toggle(\'ops\'); " >
	
	'.$op_generalesb.'

	</div>

';

}


if($div_op_general == ''){
    $display_btn = 'display: none;'; 
}else{
    $display_btn = 'display: block;';
}

$menu_bubble= '
<div class="row col-md-12 title_bar_page" role="groupp" style="border:0px solid #c30;">  
   
	<h4 class="page-title text-neutral" id="page_title_custome" style="margin-left:25px; margin-right:25px; "><span style="font-size: 18px; "> '.$title.'</h4>
    '.$op_generalesc.'

	'.$btn_op.'
                
</div>
';





	//// --- BREADCRUMS 

	$current_menu = $_GET['mnu']; 

//var_dump($current_menu);

$breadcrumb = get_info_pags(0,$current_menu);

$data = explode('|', $breadcrumb); 

$mpadre = $data[1];
$final = $data[2];

// obtener info del menu final 


$sec =get_info_mnu_cve($current_menu);
$data_sec = explode('|',$sec);
//var_dump($sec);

//$info_sec = get_info_seccion_menu($data_sec[5]);
//$data_secb = explode('|',$info_sec);

//$seccion = $data_secb[0].' / ';



if($final != ''){
    $breadcrumb_display = strtoupper($seccion.''.$mpadre.' /'.$final); 
    $cadena = '<h5 class="fw-bold" style="font-size:0.9rem; border:0px solid #ccc;"> <span class="text-clear fw-light" style="font-size:0.8rem;">'.$breadcrumb_display.'</span> </h5>';
}else{
    $breadcrumb_display = strtoupper($seccion.' '.$mpadre);
    $cadena = '<h5 class="fw-bold " style="font-size:0.9rem;" >  <span class="text-clear fw-light" style="font-size:0.8rem;">'.$breadcrumb_display.'</span></h5>';
    //$cadena='';
}

//echo $cadena;
	
?>

<div class="col-12" style="margin-bottom: 25px; z-index: 998; margin-top: -24px; ">
    		<?php echo $menu_bubble; ?>
</div>


<div class="row page-title-header" >             
              <!-- Barra inferior del titulo -->
              <div class="col-md-12 border-top" style="border: 0px solid #c45; ">
                
                <div class="row">

	                <div class="col" style="border: 0px solid #f45; <?php echo $display_vista_btn; ?> ">
		                <?php echo $ico_vista_grid; ?>
		                
		                <ul class="quick-links <?php echo $class;  ?>  " >
		                    <?php echo $barra_status.$cadena; ?>
		                </ul>
                        
	                </div>	                

	                <!-- Barra de titulo abajo derecha -->
	                <div class="page-header-toolbar col-md-6" style="border: 0px solid #c45; ">
						<div class="col-sm-11"></div>
										<?php echo $btn_link;?>
						 
	                </div>
	                	                 

                </div>

                <div class="col-md-12" style=""></div>
                
              </div>
</div>

<br>

<div class="col-sm-3 bg-light hold_modal_derecha" id="opciones_pag" style="height:79%; display:none;">

            <h5 class="col-md-12 p-2 title_sec_sm bg-head " style="padding:0px; border-radius:5px 0 0 0;"> 
            
            <i class="fa-solid fa-sliders"></i> <b> Opciones </b>
            
                <div class="btn-group" role="group" style="float:right; border:none;"> 
                    <button type="button" onclick="toggle('opciones_pag')" class=" btn btn-outline-primary  text-clear" style="border:0px solid #ccc;"> 
                        <i class="fa-solid fa-times fa-lg"></i>
                    </button>
                </div> 
             </h5>

		<div class="mb-3 border-bottom bg-muted" style="text-align:center; padding:0px; padding-top:1rem;">
            <div class="btn-group" role="group" style=" border:none;"> 
            
            
                <button type="button" id="btn_op_1" onclick="display_panel(this.id)" class="btn btn-primary sub_op">General</button>
                <button type="button" id="btn_op_2" onclick="display_panel(this.id)" class="btn btn-inverse-primary sub_op">Publico</button>
            
            </div>
        </div>

<!--
		<div class="col-md-12" id="sub_panel_1">
            
            <span class="text-muted">Vista</span>              
                
                    
				<?php // include($pagb); ?>
                         
                             
                
            
        </div>

		<div class="col-md-12 no-show" id="sub_panel_2">
                       
                
                    
					 <?php // include($pag); ?>
                             
                
            
        </div>-->


        <?php  echo $cont; ?>
		

</div>


  