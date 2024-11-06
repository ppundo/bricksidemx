<?php
	//include('access.php');
	require_once("sesion.class.php");
	
	
	$clave_serie = $_REQUEST['no_add'];
	$total_figuras = $_REQUEST['figuras_add'];
	$files = $_FILES;
	$extensions= array("jpeg","jpg","png","JPG","JPEG","PNG");
	//$total_imagenes = $_REQUEST['imagenes'];
	
	$path = 'minifig/'.$clave_serie.'/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
	$message = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
	$cantidad= count($_FILES['imagenes']['name']);
	$bandera_exist = 0;
	$bandera_oversize= 0; 
	
	if($cantidad != $total_figuras){
			$message = '<span class="btn-outline-danger bubble_msg">El total de imágenes adjuntas no coincide con el campo "Total de figuras"</span>';
			$params = '1'.';'.'1'.';'.$message.';'.'x';
	}else{
	
			//Comprueba que exista el directorio si no es asi, lo crea.
				$existe_dir = is_dir($path);
				if($existe_dir==FALSE){
					mkdir($path, 0777);
					$message .= 'Directorio creado: <code>'.$path.'</code><br><br>'; 
				}
			/////////////
	

				for ($i=0; $i<$cantidad; $i++){
					
					$errors= array();
				    $file_name = $_FILES['imagenes']['name'];
				    $file_size =$_FILES['imagenes']['size'];
				    $file_tmp =$_FILES['imagenes']['tmp_name'];
				    $file_type=$_FILES['imagenes']['type'];
					//$file_ext=strtolower(explode('.',$_FILES['imagenes']['name'][$i]));	
					
				// Comprobando que los archivos sean del formato permitido
				
				
				// accion, estado (1,0), mensaje, parametros; 
					    
				    if ($_FILES['imagenes']['type'][$i]=='image/png' || $_FILES['imagenes']['type'][$i]=='image/jpeg' || $_FILES['imagenes']['type'][$i]=='image/jpg'){
				
						// Comprueba que el archivo no exista
						$comprueba_file = file_exists($path .$_FILES["imagenes"]["name"][$i]);
						if($comprueba_file == TRUE){
							
							$message .= '<span class="btn-outline-danger bubble_msg"> La imagen '.$_FILES["imagenes"]["name"][$i].' ya existe en el directorio.</span><br>';
							$bandera_exist .= 1; 
							
							$params = '1'.';'.'1'.';'.$message.';'.'x';
							
						}elseif( $_FILES['imagenes']['size'][$i] > 4000000) {
						
							$message .= '<span class="btn-outline-danger bubble_msg">El tamaño de la imagen: <b>'.$_FILES["imagenes"]["name"][$i].'</b>, supera los 400KB permitidos.</span><br>';
							$bandera_oversize .= 1; 
							
							$params = '2'.';'.'1'.';'.$message.';'.'x';
        			
        				}else{
							
							//$data = explode('.', $file_name);
							$file_name = basename($_FILES["imagenes"]["name"][$i]);
							list($base,$extension) = explode('.',$file_name);
							$base_b= $i+1;
							$new_name = implode('.',($base_b,$extension));
							
							move_uploaded_file($_FILES["imagenes"]["tmp_name"][$i], $path.$new_name);
							chmod($path.$new_name, 0777);
							//move_uploaded_file($file_tmp,"images/".$file_name);
					 		//$validar=true;
					 		$message .= '<img src="'.$path.$new_name.'"  class="result_image" >';
					 		
					 		$result .= $_FILES["imagenes"]["name"][$i].',';
					 		
					 		$params = '3'.';'.'0'.';'.$message.';'.$result;
						}
						//Subimos el fichero al servidor

					
					}else {
						$message .= '<span class="btn-outline-danger bubble_msg">error</span>';
						$params = '4'.';'.'1'.';'.$message.';'.'x';
					}
				}
					
	}
	
	echo $params;
//	$mensage = $cantidad;
	// Regresamos los mensajes generados al cliente



?>