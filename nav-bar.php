<?php
	include('minifigures.php');
	
	
	
	$user_admin = $GLOBALS['user_perfil']; 
	$user_idioma = $GLOBALS['user_idioma']; 


	                        // obtiene info del perfil
	                        $lbl_perfil = get_info_perfil($user_admin);
	                        
	                        $data_perfil = explode(';', $lbl_perfil);
	                        $id_p = $data_perfil[0];
	                        $nombre_p = $data_perfil[1];
	                        $nom_corto_p = strtoupper($data_perfil[2]);
	                        $clave_p = $data_perfil[3];
	                        $icono_p = $data_perfil[4];
	                        
	                      //  $perfil = '<span class="theme_gris" style="font-size: 22px;"> <i class="fas fa-'.$icono_p.'"></i>  </span> <br>
		                   //     <label class="badge badge-secondary"> '.$nom_corto_p.'</label> ';
	                        //////
	                        

		$label_profile = '<label class="badge badge-theme"> 
		<span class="text-muted" style="font-size: 14px;"> <i class="fas '.$icono_p.'"></i> '. $nom_corto_p.' </span>
		</label>';
			                        	
	/*
	if($user_admin == 1){
		$label_profile = '<label class="badge badge-theme"> 
		<span class="text-muted" style="font-size: 14px;"> <i class="fas fa-user-astronaut"></i> Admin </span>
		</label>';
	}elseif($user_admin == 0){
		$label_profile = '<label class="badge badge-theme"> 
		<span class="text-muted" style="font-size: 14px;"> <i class="fas fa-user"></i> Collector </span>
		</label>';		
	}
	*/

	$info_user = busca_user($user); //nombre, correo,foto
		
		$data= explode('--',$info_user);
		
		$error = $data[0]; 
		$nombre = $data[1];
		$correo = $data[2];
		$user_nama = $data[3];
		$foto = $data[4];
		
	
							$tam_foto = strlen($foto); 
		
						$sub = substr($foto,0,4);
	
							//if($tam_foto>20){
							if($sub == 'http'){
								
								$pic = $foto;
								
							}elseif($foto == ''){
								$pic = 'assets/images/faces/profile/face0.png';
							}else{
													
								
								
										$file_p = 'assets/images/faces/profile/'.$foto;
																	
										if(file_exists($file_p)) {
										       //echo "The file exists";
										       $pic = 'assets/images/faces/profile/'.strtolower($foto);
										       $debug = 'A'; 
										} else {
											
											$pic = 'assets/images/faces/profile/face0.png';	
											$debug = 'B';
										}
							
							}
	
	/*	
		$tam_foto = strlen($foto); 
		
		if($tam_foto>10){
			$pic = $data[4];
		}elseif($foto==''){
			$pic = 'assets/images/faces/profile/face0.png';
		}elseif($tam_foto<10){
			$pic = 'assets/images/faces/profile/'.$foto;
		}else{
			$pic = 'assets/images/faces/profile/face0.png';
		}
	*/	
		$GLOBALS['user_correo']= $correo;
	
	if($user=="" or $user==0 or $error==1){
		
		$main_page = "index.php";
		$title = ''; 
		$class_visible = "no-show";
		
		
		$menu_sesion = '
		 <li class="nav-item dropdown">
	            <a class="nav-link" id="" onclick="signOut();" href="login.php" style="color: #00856f;"> 
	            	 Entrar
	            </a>
	            
	          </li>
	          <li class="nav-item ">| </li>
	          <li class="nav-item dropdown">
	          	 <a class="nav-link" onclick="signOut();" id="" href="login.php" style="color: #00856f;"> 
	            	 Crear Cuenta
	            </a>
	          </li>
		';
		
	}else{
		
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			      //informacion de acceso a la bd
			// Check connection
					if ($dbh->connect_error) {
					    die("Connection failed: " . $dbh->connect_error);
					}

				$qa = "SELECT * FROM menus WHERE mnu_padre = 777 and estado = 1 order by orden asc;";

//echo $qa;
			    $resulta= $dbh->query($qa);
			    if ($resulta->num_rows > 0) {
	    	    
					while($rowa= $resulta->fetch_assoc()){
						
						$perfil = $GLOBALS['user_perfil'];
						//$permiso = valida_permiso_perfil($rowa['id'],$perfil);
						$permiso = get_permiso_pagina($rowa['id'],$perfil);
						
						if($permiso==1){
							$op_perfil .= '<a href="index.php?mnu='.$rowa['cve'].'" class="dropdown-item text-muted">'.strtoupper($rowa['title']).'</a>';
						}else{
							$op_perfil .= '';
						}
						
						
					}
	                        
				}else{
					$title = '';
				//	echo 'No hay registros que seleccionar';
				}
		
		$title = $_GET["mnu"];
		$class_visible = "";
		

		$menu_sesion = '
		            <li class="nav-item dropdown  user-dropdown">
						<a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
							<img class="img-xs rounded-circle" src="'.$pic.'" alt="Profile image"> </a>
              
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
							<div class="dropdown-header text-center">
								<img class="img-md rounded-circle" src="'.$pic.'" alt="Profile image">
								<p class="mb-1 mt-3 font-weight-semibold">@'.strtolower($user_nama).'</p>
								<p class="font-weight-light text-muted mb-0 mt-1" > Idioma: '.strtoupper($user_idioma).'</p>
								<p class="font-weight-light text-muted mb-0 mt-1" >'.$label_profile.'</p>
							</div>
						'.$op_perfil.'
						
						<div class="p-2-footer border-top bg-light " style="margin-top: 5px; text-align:center; padding: 10px 0px;">
                        <a class="btn  btn-outline-secondary"  style="test-align:center; margin-top:10px; " href="cerrarsesion.php"  >Cerrar Sesión</a>	
                         

                        </div>
              </div>
            </li>
		';
	}


    
date_default_timezone_set('America/Mexico_City');
$hora  = date("d-m-Y H:m:s");

$script_tz = date_default_timezone_get();



if (strcmp($script_tz, ini_get('date.timezone'))){
    $notse = 'La zona horaria del script difiere de la zona horaria de la configuracion ini.';
} else {
    $notse =  'La zona horaria del script y la zona horaria de la configuración ini coinciden.';
}

//$note = ini_get('date.timezone');
	?>

<!-- partial:partials/_navbar.html    -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row bg-head" style="border:0px solid #c30;">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="index.php">
            <img src="assets/images/logo.svg" alt="logo" /> </a>
          <a class="navbar-brand brand-logo-mini" href="index.php">
            <img src="assets/images/logo-mini.svg" alt="logo" /> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center"> <?php  ?> 
	        <form class="ml-auto search-form d-none d-md-block" action="?"  >
            <div class="form-group <?php echo $class_visible; ?>">
              <input type="search" autocomplete="off" id="buscar" onKeyUp="drag_drop();" onclick="drag_drop();" class="form-control" placeholder="Buscar">
            </div>
         </form>

          


          
          <ul class="navbar-nav ml-auto">
	                    <?php echo $menu_sesion.$note;?>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>