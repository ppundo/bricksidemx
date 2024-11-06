<?php
	//include('access.php');
	require_once("sesion.class.php");
	include('minifigures.php');
	

	$tipo = $_REQUEST['tipo'];
	$files = $_FILES;
	
	if($tipo == 1){

		$user = $_REQUEST['id_user_perfil'];
		//$cve= $_REQUEST['set_cve'];
		$path = 'assets/images/faces/profile/'; 
		
		// Extension 
		$pathb = $_FILES['foto_perfil']['name'];
		$ext = pathinfo($pathb, PATHINFO_EXTENSION);
		$nuevo_nombre = 'face'.$user.'_.'.$ext;
		$respuesta_tipo = 1;
		//$form_file= 'foto_edita';
		
		//$errors= array();
		$file_name = $nuevo_nombre; 
		$file_size =$_FILES['foto_perfil']['size'];
		$file_tmp =$_FILES['foto_perfil']['tmp_name'];
		$file_type=$_FILES['foto_perfil']['type'];
		
		$ruta = $_FILES['tmp_name'];
		//var_dump($ruta);
		
		$imagen = getimagesize($file_tmp); //Sacamos la información.
		$ancho = $imagen[0]; //Ancho.
		$alto = $imagen[1]; //Alto.

		
		$data_image = createImageFromSource($file_tmp, $file_type);


// resizeImage($original_image_data, $original_width, $original_height, $new_width, $new_height)

$image_resize = resizeImage($data_image, $ancho, $alto,300, 300);
		
	}else if($tipo == 2){
		
		$user = $_REQUEST['user_id'];
		$cve= $_REQUEST['new_set_cve'];
		$path = 'assets/images/sets/';
		
		// Extension 
		$pathb = $_FILES['foto']['name'];
		$ext = pathinfo($pathb, PATHINFO_EXTENSION);
		$nuevo_nombre = $cve.'.'.$ext;
		$respuesta_tipo = 2; 
		//$form_file= 'fotos';
		
		$errors= array();
		$file_name = $nuevo_nombre; 
		$file_size =$_FILES['foto']['size'];
		$file_tmp =$_FILES['foto']['tmp_name'];
		$file_type=$_FILES['foto']['type'];
		
	}else if($tipo == 22){
		
		//$user = $_REQUEST['user_id'];
		$cve= $_REQUEST['new_set_cve_n'];
		$path = 'assets/images/sets/';
		
		// Extension 
		//$cve = $_FILES['foto_n']['name'];
		//$ext = pathinfo($pathb, PATHINFO_EXTENSION);
        $ext = 'webp';
		$nuevo_nombre = $cve.'.'.$ext;
		$respuesta_tipo = 22; 
		//$form_file= 'fotos';
		
		$errors= array();
		$file_name = $nuevo_nombre; 
		$file_size =$_FILES['foto_n']['size'];
		$file_tmp =$_FILES['foto_n']['tmp_name'];
		$file_type=$_FILES['foto_n']['type'];
		
	}else if($tipo == 3){

		$user = $_REQUEST['user_id'];
		$user_perfil = $_REQUEST['user_perfil'];
		//$nombre_tema= $_REQUEST['new_tema_set_nombre'];
		$nombre_tema = trim($_REQUEST['new_tema_set_nombre']);
		$nombre_tema=str_replace(' ', '_', $nombre_tema);
		$nombre_tema=str_replace('-', '_', $nombre_tema);
		$nombre_tema = strtolower($nombre_tema);
		$path = 'assets/images/logos/';
		
		// Extension 
		$pathb = $_FILES['foto_tema']['name'];
		$ext = pathinfo($pathb, PATHINFO_EXTENSION);
		
		if($user_perfil==1){
			$nuevo_nombre = $nombre_tema.'.'.$ext;
		}else{
			$nuevo_nombre = $nombre_tema.'_.'.$ext;
		}
		
		
		$respuesta_tipo = 3; 
		//$form_file= 'fotos';
		
		$errors= array();
		$file_name = $nuevo_nombre; 
		$file_size =$_FILES['foto_tema']['size'];
		$file_tmp =$_FILES['foto_tema']['tmp_name'];
		$file_type=$_FILES['foto_tema']['type'];
				
	}else if($tipo == 4){

		$user = $_REQUEST['user_id_edita'];
		$cve= $_REQUEST['set_cve'];
		$path = 'assets/images/sets/'.$user.'/'; 
		
		// Extension 
		$pathb = $_FILES['foto_edita']['name'];
		$ext = pathinfo($pathb, PATHINFO_EXTENSION);
		$nuevo_nombre = $cve.'.'.$ext;
		$respuesta_tipo = 4;
		//$form_file= 'foto_edita';
		
		//$errors= array();
		$file_name = $nuevo_nombre; 
		$file_size =$_FILES['foto_edita']['size'];
		$file_tmp =$_FILES['foto_edita']['tmp_name'];
		$file_type=$_FILES['foto_edita']['type'];
		
	}else if($tipo == 5){

		$user = $_REQUEST['user_id'];
		$cve= $_REQUEST['new_minifigure_cve'];
		$path = 'minifig/'.$cve.'/';
		
		// Extension 
		$pathb = $_FILES['foto_minifigure']['name'];
		$ext = pathinfo($pathb, PATHINFO_EXTENSION);
		$name = pathinfo($pathb, PATHINFO_FILENAME);
		$nuevo_nombre = $name.'_.'.$ext;
		$respuesta_tipo = 5;
		//$form_file= 'foto_edita';
		
		//$errors= array();
		$file_name = $nuevo_nombre; 
		$file_size =$_FILES['foto_minifigure']['size'];
		$file_tmp =$_FILES['foto_minifigure']['tmp_name'];
		$file_type=$_FILES['foto_minifigure']['type'];
		
	
	}else if($tipo == 6){

		//$user = $_REQUEST['user_id'];
		$cve= $_REQUEST['serie_minifig'];
		$path = 'minifig/'.$cve.'/';
		$user_perfil = $_REQUEST['user_perfil'];
		
		// Extension 
		$pathb = $_FILES['foto_minifig']['name'];
		$ext = pathinfo($pathb, PATHINFO_EXTENSION);
		$name = pathinfo($pathb, PATHINFO_FILENAME);
	//	$nuevo_nombre = $name.'_.'.$ext;
		$respuesta_tipo = 6;

		$name=str_replace(' ', '_', $name);
		$name=str_replace('-', '_', $name);
		$name = strtolower($name);
	
		if($user_perfil==1){
			$nuevo_nombre = $name.'_new.'.$ext;
		}else{
			$nuevo_nombre = $name.'_.'.$ext;
		}	
		
		//$errors= array();
		$file_name = $nuevo_nombre; 
		$file_size =$_FILES['foto_minifig']['size'];
		$file_tmp =$_FILES['foto_minifig']['tmp_name'];
		$file_type=$_FILES['foto_minifig']['type'];
		
	}else if($tipo == 7){

		//$user = $_REQUEST['user_id'];
		//$nombre_tema= $_REQUEST['new_tema_set_nombre'];
		//$nombre_tema=str_replace(' ', '_', $_REQUEST['new_tema_set_nombre']);
		$path = 'assets/images/logos/';
		
		// Extension 
		$pathb = $_FILES['foto_logo']['name'];
		$ext = pathinfo($pathb, PATHINFO_EXTENSION);
		$name = pathinfo($pathb, PATHINFO_FILENAME);
		$nuevo_nombre = $name.'_.'.$ext;
		$respuesta_tipo = 7; 
		//$form_file= 'fotos';
		
		$errors= array();
		$file_name = $nuevo_nombre; 
		$file_size =$_FILES['foto_logo']['size'];
		$file_tmp =$_FILES['foto_logo']['tmp_name'];
		$file_type=$_FILES['foto_logo']['type'];
				
	}else if($tipo == 8){ // Portada

		$path = 'assets/images/portada_serie/';
		$cve= $_REQUEST['serie_portada'];
		
		// Extension 
		$pathb = $_FILES['foto_portada']['name'];
		$ext = pathinfo($pathb, PATHINFO_EXTENSION);
		$name = pathinfo($pathb, PATHINFO_FILENAME);
		$nuevo_nombre = $cve.'.'.$ext;
		$respuesta_tipo = 8; 		
		$errors= array();
		$file_name = $nuevo_nombre; 
		$file_size =$_FILES['foto_portada']['size'];
		$file_tmp =$_FILES['foto_portada']['tmp_name'];
		$file_type=$_FILES['foto_portada']['type'];
				
	}else if($tipo == 9){ // Folleto

		$path = 'assets/images/sheet/';
		$cve= $_REQUEST['serie_folleto'];
		
		// Extension 
		$pathb = $_FILES['foto_folleto']['name'];
		$ext = pathinfo($pathb, PATHINFO_EXTENSION);
		$name = pathinfo($pathb, PATHINFO_FILENAME);
		$nuevo_nombre = $cve.'.'.$ext;
		$respuesta_tipo = 9; 		
		$errors= array();
		$file_name = $nuevo_nombre; 
		$file_size =$_FILES['foto_folleto']['size'];
		$file_tmp =$_FILES['foto_folleto']['tmp_name'];
		$file_type=$_FILES['foto_folleto']['type'];
				
	}else if($tipo == 10){

		$path = 'assets/images/caja/';
		$cve= $_REQUEST['serie_caja'];
		
		// Extension 
		$pathb = $_FILES['foto_caja']['name'];
		$ext = pathinfo($pathb, PATHINFO_EXTENSION);
		$name = pathinfo($pathb, PATHINFO_FILENAME);
		$nuevo_nombre = $cve.'.'.$ext;
		$respuesta_tipo = 10; 		
		$errors= array();
		$file_name = $nuevo_nombre; 
		$file_size =$_FILES['foto_caja']['size'];
		$file_tmp =$_FILES['foto_caja']['tmp_name'];
		$file_type=$_FILES['foto_caja']['type'];
				
	}else if($tipo == 11){

		$path = 'assets/images/empaque/';
		$cve= $_REQUEST['serie_empaque'];
		
		// Extension 
		$pathb = $_FILES['foto_empaque']['name'];
		$ext = pathinfo($pathb, PATHINFO_EXTENSION);
		$name = pathinfo($pathb, PATHINFO_FILENAME);
		$nuevo_nombre = $cve.'.'.$ext;
		$respuesta_tipo = 11; 		
		$errors= array();
		$file_name = $nuevo_nombre; 
		$file_size =$_FILES['foto_empaque']['size'];
		$file_tmp =$_FILES['foto_empaque']['tmp_name'];
		$file_type=$_FILES['foto_empaque']['type'];
				
	}else if($tipo == 12){

		$path = 'assets/images/backgrounds/';
		$cve= $_REQUEST['serie_fondo'];
		
		// Extension 
		$pathb = $_FILES['foto_fondo']['name'];
		$ext = pathinfo($pathb, PATHINFO_EXTENSION);
		$name = pathinfo($pathb, PATHINFO_FILENAME);
		$nuevo_nombre = $cve.'.'.$ext;
		$respuesta_tipo = 12; 		
		$errors= array();
		$file_name = $nuevo_nombre; 
		$file_size =$_FILES['foto_fondo']['size'];
		$file_tmp =$_FILES['foto_fondo']['tmp_name'];
		$file_type=$_FILES['foto_fondo']['type'];
				
	}
	
	
	$message = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
	$bandera_exist = 0;
	$bandera_oversize= 0; 
	
	
			//Comprueba que exista el directorio si no es asi, lo crea.
				$existe_dir = is_dir($path);
				if($existe_dir==FALSE){
					mkdir($path, 0777);
					//$message .= 'Directorio creado: <code>'.$path.'</code><br><br>'; 
				}
			/////////////
	

				
					

					//$file_ext=strtolower(explode('.',$_FILES['foto']['name'][$i]));	
					
				// Comprobando que los archivos sean del formato permitido
				
				
				// accion, estado (1,0), mensaje, parametros; 
					    
				    if ($file_type=='image/png' || $file_type=='image/jpeg' || $file_type=='image/jpg' || $file_type=='image/webp' ){
				
						// Comprueba que el archivo no exista
						$comprueba_file = file_exists($path.$nuevo_nombre);
						
						if($comprueba_file == TRUE){
							/*
							$result = $nuevo_nombre;
							$message = '<span class="btn-outline-danger bubble_msg"> La imagen "'.$nuevo_nombre.'" ya existe en el directorio. </span><br>';						
							$params = '1'.';'.'1'.';'.$message.';'.$result.';'.$respuesta_tipo;
							*/
							move_uploaded_file($file_tmp, $path.$nuevo_nombre);
							chmod($path.$nuevo_nombre, 0777);
					 		$message = '<img src="'.$path.$nuevo_nombre.'"  class="result_image_set" style="height:200px" >';
					 		$result = $nuevo_nombre;
					 		$params = '3'.';'.'0'.';'.$message.';'.$result.';'.$respuesta_tipo; // inde; estado; mensaje; resultado; 							
							
							
						}elseif( $file_size > 4000000) {
						
							$message = '<span class="btn-outline-danger bubble_msg">El tamaño de la imagen: supera los 400KB permitidos.</span><br>';
							//$bandera_oversize .= 1; 
							$result = $nuevo_nombre;
							$params = '2'.';'.'1'.';'.$message.';'.$result.';'.$respuesta_tipo;
        			
        				}else{
							
							//$data = explode('.', $file_name);
							//$file_name = basename($nuevo_nombre);
							//list($base,$extension) = explode('.',$file_name);
							//$base_b= $i+1;
							//$new_name = implode('.',[$nuevo_nombre,$extension]);
							
							move_uploaded_file($file_tmp, $path.$nuevo_nombre);
							chmod($path.$nuevo_nombre, 0777);
							//move_uploaded_file($file_tmp,"images/".$file_name);
					 		//$validar=true;
					 		$message = '<img src="'.$path.$nuevo_nombre.'"  class="result_image_lg" style="" >';
					 		
					 		$result = $nuevo_nombre;
					 		
					 		$params = '3'.';'.'0'.';'.$message.';'.$result.';'.$respuesta_tipo; // inde; estado; mensaje; resultado; 
						}
						//Subimos el fichero al servidor

					
					}else {
						$message .= '<span class="btn-outline-danger bubble_msg"> '.$comprueba_file.'</span>';
						$params = '4'.';'.'1'.';'.$message.';'.'x'.';'.$respuesta_tipo;
					}
				
					
	
	
	echo $params;
	

//	$mensage = $cantidad;
	// Regresamos los mensajes generados al cliente



?>