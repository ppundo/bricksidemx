<?php
	include("depuring.php");
	
	$horarioVerano = date('I');
	if($horarioVerano==1){
		//date.timezone = "America/Mazatlan"
		date_default_timezone_set('America/Mazatlan');

	}else{
		date_default_timezone_set('America/Mexico_City');
	}
//	include("mailing.php");

	
function busca_item($item){
	
	include("access.php");
	
	$data = explode(";", $item); 
	
	$user_look=$data[1];
	$item_look= $data[0];
	
	
	
	  $dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM coleccion where item = '$item_look' and id_user = $user_look and estado = 1;";// preparando la instruccion sql
   
  // echo $qb;

   
    $resultb= $dbhb->query($qb);
    $row= $resultb->fetch_assoc();
    
    	if ($resultb->num_rows > 0) {
	    	$bandera_item = '1|'.$row['id'].'|'.$row['fecha_registro']; 
	    
	    }else{
		    
		    $bandera_item = '0|0|0000-00-00';
	    }
	
	return $bandera_item; 
	$dbhb->close();
}// funcion

///////////////////////////////////////////////////////////////////////////

function busca_serie($id){ // devuelve el nombre de la serie
	
		include("access.php");
	
	//echo $item;
	
	$data = explode("-",$id); 	
	$serie = $data[0];
	$no_item = $data[1]; 
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM series where clave_lego = '$serie'";// preparando la instruccion sql
   $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
	    	 $dato_encontrado = $row['nombre'];
	    	 	    }else{
		    
		    $dato_encontrado = 'Sin Asociar';
		    
	    }
	
	return $dato_encontrado; 
	$dbh->close();
}



//////////////////////////////////////////////////////////////////
function get_data($item,$index){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	//echo $item;
	
	//$data = explode("-",$item); 	
	//$serie = $data[0];
	//$no_item = $data[1]; 
	
//	echo $serie. ' - '. $no_item;
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM minifiguras where id = $item ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 $tot_fig = $resultb->num_rows;
	    	 	switch($index){
		    	 	
		    	 	case 1:
		    	 	$dato_encontrado = $row['nombre_es'];
		    	 	break; 

		    	 	case 2: 
		    	 	$dato_encontrado = $row['nombre_en'];
		    	 	break; 
		    	 	
		    	 	case 3: 
		    	 	$dato_encontrado = $row['imagen'];
		    	 	break; 
		    	 	
		    	 			    	 	
		    	 	default: 
		    	 	$dato_encontrado = $row['nombre_es'].'/'.$row['nombre_en'].'/'.$row['imagen'].'/'.$row['cve_lego'].'/'.$row['tags'].'/'.$tot_fig;
		    	 	break; 
				}
                        
	    
	    }else{
		    
		    $dato_encontrado = 'Sin Asociar';
		    
	    }
	
	return $dato_encontrado; 
	$dbh->close();
}


/////////////--- Busca info de usuario en la base ////////////////

function busca_user($id){
	
	include("access.php");	
	$id_user = $id;
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM usuarios where id = '$id_user'";// preparando la instruccion sql
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
			 $error = 0 ;
			 $nombre = $row['nombre'];
			 $correo= $row['correo'];
			 $user_name = $row['usuario']; 
			 $foto = $row['foto'];
			 $cve = $row['clave'];
			 $datos_encontrados= $error.'--'.$nombre.'--'.$correo.'--'.$user_name.'--'.$foto.'--'.$cve.'--'.$row['correo_cifrado'].'--'.$row['fecha_activado'];
	    }else{
		    $error = 1 ;
		    $nombre = '';
			$correo= '';
			$user_name = '';
			$foto = '';
			$cve ='';
			$datos_encontrados= $error.'--'.$nombre.'--'.$correo.'--'.$user_name.'--'.$foto.'--'.$cve.'--'.$row['correo_cifrado'];	    
	    }
	    
	return $datos_encontrados; 	
	$dbh->close();
}

/////////////--- Busca info de usuario en la base ////////////////

function busca_user_cifrado($clave){
	
	include("access.php");	
	$id_user = $id;
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM usuarios where correo_cifrado = '$clave' ";// preparando la instruccion sql
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
			 $error = 0 ;
			 $nombre = $row['nombre'];
			 $correo= $row['correo'];
			 $user_name = $row['usuario']; 
			 $foto = $row['foto'];
			 $datos_encontrados= $error.'|'.$nombre.'|'.$correo.'|'.$user_name.'|'.$foto.'|'.$row['id'].'|'.$row['clave'].'|'.$row['fecha_registro'].'|'.$row['fecha_activado'].'|'.$row['fecha_banned'].'|'.$row['estado'].'|'.$row['password'].'|'.$row['id'];
	    }else{
		    $error = 1 ;
		    $nombre = '';
			$correo= '';
			$user_name = '';
			$foto = '';
			$datos_encontrados= $error.'|'.$nombre.'|'.$correo.'|'.$user_name.'|'.$foto.'|'.$row['id'].'|'.$row['clave'].'|'.$row['fecha_registro'];	    
	    }
	    
	return $datos_encontrados; 	
	$dbh->close();
}
///////////////////////////////////////////////////////

function busca_coleccion($item){
	
	include("access.php");
	
	$data = explode(";", $item); 
	$item_look= $data[0];
	$user_look=$data[1];
    $clave_look=$data[2];
	
	
	  $dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM coleccion where item = '$item_look' and id_user = '$user_look' and clave_lego = '$clave_look';";// preparando la instruccion sql
   
  // var_dump($qb.'<br>');

   
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
            $tot = $resultb->num_rows;
	    	$datas = $row['faltantes'].';'.$row['fecha_registro'].';'.$row['estado'].';'.$row['favorito'].';'.$row['id'].';'.$row['id_user'].';'.$row['item'].';'.$row['clave_lego'].';'.$row['no_extra'].';'.$row['mostrar_mkt'].';'.$row['fecha_actualizado'].';'.$row['fecha_fav'].';'.$row['fecha_admin_fav'].';'.$row['fecha_admin_add'].';'.$tot.';'.$row['precio'];  
	    
	    }else{
            $datas= '0|0|0|0|0|0|0|0|0|0|0|0|0'; 
        }
     //   var_dump($datas.'<br>');
	return $datas; 
	$dbhb->close();
}// funcion

//////////////////////////////

function get_all_coleccion_user($id_user){
	
	include("access.php");
		
	
	  $dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM coleccion where id_user = '$id_user' and estado = 1 ;";// preparando la instruccion sql
   
  // echo $qb;

   
    $resultb= $dbhb->query($qb);
    
    
    	if ($resultb->num_rows > 0) {
	    	
	    	$num = 0; 
	    	
	    	while($row= $resultb->fetch_assoc()){
		    $num = $num +1;	
		    
		    $nombre_fig = get_data($row['item'],1);
		    
		    $datas.= '<div class="col-sm-12 p-1 border-bottom " style="text-align:left; " > 
								<span class="text-muted text-sm" >'.$num.'. ['.$row['clave_lego'].'] - '.$nombre_fig.' </span> 
								</div>';
		    
		    }
	    
	    }
	
	return $datas; 
	$dbhb->close();
}// funcion

//////////////////////////////


function busca_info_coleccion($item){ // devuelve total de coleccion de un usuario. Recibe usuario;coleccion
	include("access.php");

	$data = explode(";", $item); 
	
	$id_user=$data[0];
	$id_colection= $data[1];
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

    
	
	$qb = "SELECT * FROM coleccion where id_user = $id_user and estado = 1 and clave_lego = '$id_colection';";// preparando la instruccion sql
  //  var_dump($qb);
	
//	var_dump($qb.'<br>'); 
      
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	//$data = $row['faltantes'].';'.$row['fecha_registro'].';'. $row['estado'];  
	    	$total_colection = $resultb-> num_rows; 
	    
	    }else{
		    $total_colection = 0; 
	    }
	    
	    //var_dump($id_colection.' '.$total_colection.'<br>');
	
	$data = $total_colection;
    $dbhb->close();

	return $data; 
	
	
	
	
}
///// 

function get_user_faltantes($params){
	
	include("access.php");

	$data = explode(';',$params);
	$col_usuario = $data[0]; 
	$minifig = $data[1]; 
	

		
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}
	
	$qb = "SELECT * FROM coleccion where item = '$minifig' and id_user = '$col_usuario' ";// preparando la instruccion sql
	//echo $qb;
      
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	//$data = $row['faltantes'].';'.$row['fecha_registro'].';'. $row['estado'];  
	    	//$total_serie = $resultb-> num_rows; 
			$data = $row['faltantes'];
			
			if($data==""){ // si  el registro de usuario esta vacio, regresa un valor comodin para generar la lista de elementos
				$data = '0.0.0.0.0.0.0.0.0.0.0.0.0.0.0';
			}else{
				$data = $row['faltantes'];
			}
	    }else{ // si no existe el registro de usuario con esa minifigura, regresa un valor comodin ara generar la lista de elementos
		    $data = '0.0.0.0.0.0.0.0.0.0.0.0.0.0.0';
	    }
	
	//$data = $total_serie; 
	return $data; 
	$dbhb->close();

	
	
}
///// 

function get_total_minifig($serie){
	
	include("access.php");

		
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}
	
	$qb = "SELECT * FROM minifiguras where cve_lego = '$serie'";// preparando la instruccion sql
      
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	//$data = $row['faltantes'].';'.$row['fecha_registro'].';'. $row['estado'];  
	    	$total_serie = $resultb-> num_rows; 
	    
	    }
	
	$data = $total_serie; 
	return $data; 
	$dbhb->close();

	
	
}



function obtener_ciudad($ip) {
        
        $default = 'DESCONOCIDA';
 
        $curlopt_useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)';
        
        $url = 'http://www.geoplugin.net/php.gp?ip=' . urlencode($ip);
        $ch = curl_init();
        
        $curl_opt = array(
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_HEADER=> 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_USERAGENT=> $curlopt_useragent,
            CURLOPT_URL=> $url,
            CURLOPT_TIMEOUT=> 1,
            CURLOPT_REFERER=> 'http://' . $_SERVER['HTTP_HOST'],
        );
        
        $curl_info=curl_setopt_array($ch, $curl_opt);
        
        $content = curl_exec($ch);
        
        if (!is_null($curl_info)) {
            $curl_info = curl_getinfo($ch);
        }
        
        curl_close($ch);
        
        if ( preg_match('{<li>City : ([^<]*)</li>}i', $content, $regs) )  {
            $city = $regs[1];
        }
        if ( preg_match('{<li>State/Province : ([^<]*)</li>}i', $content, $regs) )  {
            $state = $regs[1];
        }
 
        if( $city!='' && $state!='' ){
          $location = $city . ', ' . $state;
          return $location;
        }else{
          return $default; 
        }
        
    }
    
    
    /////////////
    
    
    function hexToRgb($hex, $alpha = false) {
   $hex      = str_replace('#', '', $hex);
   $length   = strlen($hex);
   $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
   $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
   $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
   if ( $alpha ) {
      $rgb['a'] = $alpha;
   }
   return $rgb;
   
   //$split_hex_color = str_split( $hex_color, 2 ); 	$rgb1 = hexdec( $split_hex_color[0] ); 	$rgb2 = hexdec( $split_hex_color[1] ); 	$rgb3 = hexdec( $split_hex_color[2] );
}
 
 
 //////////
 
function fromRGB($R, $G, $B)
{

       $R = dechex($R);
       if (strlen($R)<2)
       $R = '0'.$R;

       $G = dechex($G);
       if (strlen($G)<2)
       $G = '0'.$G;

       $B = dechex($B);
       if (strlen($B)<2)
       $B = '0'.$B;

       return '#' . $R . $G . $B;
}

function getMonth($mes){

setlocale(LC_TIME, 'es_ES');
$monthNum  = $mes;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = strftime('%B', $dateObj->getTimestamp());
//echo $monthName;

return $monthName; 
}



function request_sepomex_api($criterio_busqueda){
	
	//$endpoint_sepomex = "http://api-sepomex.hckdrk.mx/query/";
	//$method_sepomex = 'info_cp/';
	//$variable_string = '?type=simplified';
	
	//https://api.copomex.com/query/{metodo}/{busqueda}?={variable}&{token}
	//https://api.copomex.com/query/info_cp/09810?token=pruebas
	
	//https://api.copomex.com/query/info_cp/04420?type=simplified&token=pruebas
	
	$endpoint_sepomex = 'https://api.copomex.com/query/'; 
	$method_sepomex = 'info_cp/'; 
	$variable_string = '?type=simplified';

	$token = '&token=2839a121-dafd-42a3-9a18-10866fc5f2b4';
	//$token = '&token=pruebas';
	$url = $endpoint_sepomex.$method_sepomex.$criterio_busqueda.$variable_string.$token;
	$response = file_get_contents($url);
	
	//var_dump($url);
	
		if($response){
			return $response;
		}else{
			return false;
		}
	
}

////////////////////////////

function formatFecha($fecha){
	
		if($fecha=='' or $fecha==0){
			$fecha = '0000-00-00';
		}
		


		$data = explode('-', $fecha);
	                        
	    	$anio = $data[0]; 
	        $mes = $data[1];
            $dia = $data[2];
			$mes_txt = getMonth($data[1]);
			
			//var_dump($anio);
					
			if($anio=='0000'){
				$f_es = 'Fecha no registrada';				
			}else{

				$mes_txt = substr($mes_txt,0, 3);
				$f_es = $dia.'/'.strtoupper($mes_txt).'/'.$anio;
			}
					
			
	
	return  $f_es; 
	
}


function formatSoloFecha($fecha){
	
	if($fecha=='' or $fecha==0){
		$fecha = '0000-00-00';
	}
	


	$data = explode('-', $fecha);
						
		$anio = $data[0]; 
		$mes = $data[1];
		$dia = $data[2];
		$mes_txt = getMonth($data[1]);
		
		//var_dump($anio);
				
		if($anio=='0000'){
			$f_es = 'Fecha no registrada';				
		}else{

			$mes_txt = substr($mes_txt,0, 3);
			$f_es = $dia.'/'.strtoupper($mes_txt).'/'.$anio;
		}
				
		

return  $f_es; 

}

////////////////////////////

function formatFechaTabla($fecha){

		if($fecha=='' or $fecha==0){
			$fecha = '0000-00-00';
		}
				
		$data = explode('-', $fecha);
	                        
	    	$anio = $data[0]; 
	        $mes = $data[1];
            $dia = $data[2];
			$mes_txt = getMonth($data[1]);
			
			//var_dump($anio);
					
			if($anio=='0000'){
				$f_es = 'Fecha no registrada';				
			}else{

				$mes_txt = substr($mes_txt,0, 3);
				$f_es = $dia.'/'.strtoupper($mes_txt).'<br> <span>'.$anio.'</span>';
			}
					
			
	
	return  $f_es; 
	
}

////////////////////////////

function formatFechaTable($fecha){

		if($fecha=='' or $fecha==0){
			$fecha = '0000-00-00';
		}
				
		$data = explode('-', $fecha);
	                        
	    	$anio = $data[0]; 
	        $mes = $data[1];
            $dia = $data[2];
			$mes_txt = getMonth($data[1]);
					
			//$mes_txt = substr($mes_txt,0, 3);
	                       
	        

			if($anio=='0000'){
				$f_es = 'Fecha No Registrada';				
			}else{

				$mes_txt = substr($mes_txt,0, 3);
				$f_es = '<span class="text-sm">'.$dia.'/'.strtoupper($mes_txt).'/'.$anio.'</span>';			
			}

	
	return  $f_es; 
	
}

////////////////////////////

function formatFechaHora($fecha){
		
		if($fecha=='' or $fecha==0){
			$fecha = '0000-00-00';
		}
		
		$dataa = explode(' ', $fecha);
		$fechab = $dataa[0];
		$horab = $dataa[1];
		
		//var_dump($horab);
		
		$datab = explode(':', $horab);
		$h = $datab[0];
		$m = $datab[1];
		$s = $datab[2];
		
		$data = explode('-', $fechab);
	                        
	    	$anio = $data[0]; 
	        $mes = $data[1];
            $dia = $data[2];
			$mes_txt = getMonth($data[1]);


			if($anio=='0000'){
				$f_es = 'Fecha No Registrada';				
			}else{
				$mes_txt = substr($mes_txt,0, 3);	                       
		        $f_es = '<span class=""> '.$dia.'/'.strtoupper($mes_txt).'/'.$anio .' </span> <span class="">- '.$h.':'.$m.' HRS. </span>';		
			}
					

	
	return  $f_es; 
	
}

////////////////////
function formatFechaHoraTable($fecha){

		if($fecha=='' or $fecha==0){
			$fecha = '0000-00-00';
		}
				
		$dataa = explode(' ', $fecha);
		$fechab = $dataa[0];
		$horab = $dataa[1];
		
		$datab = explode(':', $horab);
		$h = $datab[0];
		$m = $datab[1];
		$s = $datab[2];
		
		$data = explode('-', $fechab);
	                        
	    	$anio = $data[0]; 
	        $mes = $data[1];
            $dia = $data[2];
			$mes_txt = getMonth($data[1]);
					
			if($anio=='0000'){
				$f_es = 'Fecha No Registrada';				
			}else{
				$mes_txt = substr($mes_txt,0, 3);	                       
		        $f_es = '<span class="text-sm"> '.$dia.'/'.strtoupper($mes_txt).'/'.$anio .'</span><br> <span class="text-sm">'.$h.':'.$m.' HRS. </span> ';		
			}


	        
	
	return  $f_es; 
	
}

////////////////////
function getinfogrupo($id){
	
	include("access.php");
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}
	
	$qb = "SELECT * FROM grupos_inventario where id = $id ";// preparando la instruccion sql
	//echo $qb;
      
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$info = $row['nombre'].'|'.$row['fecha_registro'].'|'.$row['id_ubicacion'];	 
			 
	    }elseif($id==99){ // si no existe el registro de usuario con esa minifigura, regresa un valor comodin ara generar la lista de elementos
		    $info = 'Todos Sets |0000-00-00';
	    }else{
            $info = 'Sin Agrupar |0000-00-00';
        }
	
	//$data = $total_serie; 
	return $info; 
	$dbhb->close();
	
}
////////////////////
function getinfoubicacion($id){
	
	include("access.php");
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}
	
	$qb = "SELECT * FROM ubicaciones_usuario where id = $id ";// preparando la instruccion sql
	//echo $qb;
      
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$info = $row['nombre'].'|'.$row['id_user'];	 
			 
	    }else{ // si no existe el registro de usuario con esa minifigura, regresa un valor comodin ara generar la lista de elementos
		    $info = 'Sin Ubicacion|0';
	    }
	
	//$data = $total_serie; 
	return $info; 
	$dbhb->close();
	
}
/////////////


function genera_select_grupo_inventario($id_user,$current){

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}

	
	$qc = "SELECT * FROM grupos_inventario where estado = 1 and id_user = $id_user order by orden";// preparando la instruccion sql
		
		//var_dump($current);
    $resultc= $dbh->query($qc);
    
    	if ($resultc->num_rows > 0) {			
			while($rowc= $resultc->fetch_assoc()){
				
				

					if($current==$rowc['id']){
						$atr .= '<option value="'.$rowc['id'].'" selected > '.$rowc['nombre'].'</option>'; 
					}else{
						/*
						if($current==0){
							$atr .= '<option value="0" > Sin Asignar </option>'; 
						}else{
							$atr .= '<option value="'.$rowc['id'].'" > '.$rowc['nombre'].'</option>'; 
						} */
						$atr .= '<option value="'.$rowc['id'].'" > '.$rowc['nombre'].'</option>'; 
					}			
						
			}	   
	
			$seletct= '
				<select class="form-control" id="grupo">
				<option value="0" > Sin Grupo </option>
					'.$atr.'
				</select>
			';
			 
	    }else{
		    $atr = 'Sin Registros'; 
	    }

	
	
	return $seletct;
}
///////////
function genera_select_estado_pago_transac($current){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}
	
		
		$qc = "SELECT * FROM estado_pago where estado = 1;";// preparando la instruccion sql
			
			//var_dump($current);
		$resultc= $dbh->query($qc);
		
			if ($resultc->num_rows > 0) {			
				while($rowc= $resultc->fetch_assoc()){
					
					
	
						if($current==$rowc['cve']){
							$atr .= '<option value="'.$rowc['cve'].'" selected > '.$rowc['nombre'].'</option>'; 
						}else{

							$atr .= '<option value="'.$rowc['cve'].'" > '.$rowc['nombre'].'</option>'; 
						}			
							
				}	   
		
				$seletct= $atr;
				 
			}else{
				$atr = 'Sin Registros'; 
			}
	
		
		
		return $seletct;
	}
	///////////

function genera_select_edo_perfil($current){

    include("access.php");
    $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
    
    if ($dbh->connect_error) {
           die("Connection failed: " . $dbh->connect_error);
    }
    
        
        $qc = "SELECT * FROM estado_perfil where estado = 1";// preparando la instruccion sql
            
            //var_dump($current);
        $resultc= $dbh->query($qc);
        
            if ($resultc->num_rows > 0) {			
                while($rowc= $resultc->fetch_assoc()){
                    
                    
    
                        if($current==$rowc['clave']){
                            $atr .= '<option value="'.$rowc['clave'].'" selected > '.$rowc['nombre'].'</option>'; 
                        }else{

                            $atr .= '<option value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
                        }			
                            
                }	   
        
                $seletct= $atr;
                 
            }else{
                $atr = 'Sin Registros'; 
            }
    
        
        
        return $seletct;
    }

    ///////////
function genera_select_edo_all($current){

    include("access.php");
    $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
    
    if ($dbh->connect_error) {
           die("Connection failed: " . $dbh->connect_error);
    }
    
        
        $qc = "SELECT * FROM estado_perfil;";// preparando la instruccion sql
            
            //var_dump($current);
        $resultc= $dbh->query($qc);
        
            if ($resultc->num_rows > 0) {			
                while($rowc= $resultc->fetch_assoc()){
					
					if($rowc['nombre']!=''){
                        if($current==$rowc['clave']){
                            $atr .= '<option value="'.$rowc['clave'].'" selected > '.$rowc['nombre'].'</option>'; 
                        }else{

                            $atr .= '<option value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
                        }		
					}	
                            
                }	   
        
                $seletct= $atr;
                 
            }else{
                $atr = 'Sin Registros'; 
				$seletct = $atr;
            }
    
        
        
        return $seletct;
    }
    ///////////
    function genera_select_colores($current){

        include("access.php");
        $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
        
        if ($dbh->connect_error) {
               die("Connection failed: " . $dbh->connect_error);
        }
        
            
            $qc = "SELECT * FROM colores where estado = 1 order by nombre";// preparando la instruccion sql
                
                //var_dump($current);
            $resultc= $dbh->query($qc);
            
                if ($resultc->num_rows > 0) {			
                    while($rowc= $resultc->fetch_assoc()){
                        
                        
        
                            if($current==$rowc['nombre']){
                                $atr .= '<option value="'.$rowc['nombre'].'" selected > '.$rowc['nombre'].'</option>'; 
                            }else{
    
                                $atr .= '<option value="'.$rowc['nombre'].'" > '.$rowc['nombre'].'</option>'; 
                            }			
                                
                    }	   
            
                    $seletct= $atr;
                     
                }else{
                    $atr = 'Sin Registros'; 
                }
        
            
            
            return $seletct;
        }

////////////////////
function genera_select_presentacion($current){

    include("access.php");
    $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
    
    if ($dbh->connect_error) {
           die("Connection failed: " . $dbh->connect_error);
    }
    
        
        $qc = "SELECT * FROM estado_presentacion where estado = 1";// preparando la instruccion sql
            
            //var_dump($current);
        $resultc= $dbh->query($qc);
        
            if ($resultc->num_rows > 0) {			
                while($rowc= $resultc->fetch_assoc()){
                    
                    
    
                        if($current==$rowc['clave']){
                            $atr .= '<option value="'.$rowc['clave'].'" selected > '.$rowc['nombre'].'</option>'; 
                        }else{

                            $atr .= '<option value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
                        }			
                            
                }	   
        
                $seletct= $atr;
                 
            }else{
                $atr = 'Sin Registros'; 
            }
    
        
        
        return $seletct;
    }

////////////////////

function getinfotema($id){
	
	include("access.php");
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}
	
	$qb = "SELECT * FROM temas_sets where id = $id ";// preparando la instruccion sql
	//echo $qb;
      
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$info = $row['nombre'].'|'.$row['color'].'|'.$row['logo'].'|'.$row['estado'].'|'.$row['color_alt'].'|'.$row['fecha_registro'].'|'.$row['fecha_actualizado'].'|'.$row['color_txt'].'|'.$row['color_alt'];	 
			 
	    }else{ // si no existe el registro de usuario con esa minifigura, regresa un valor comodin ara generar la lista de elementos
		    $info = '0|0|0';
	    }
	
	//$data = $total_serie; 
	return $info; 
	$dbhb->close();
	
}

////////////////////

function get_info_tema_foto($foto){
	
	include("access.php");
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}
	
	$qb = "SELECT * FROM temas_sets where logo = '$foto'; ";// preparando la instruccion sql
	//echo $qb;
      
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$info = $row['id'].'|'.$row['nombre'].'|'.$row['color'].'|'.$row['logo'].'|'.$row['estado'].'|'.$row['color_alt'].'|'.$row['fecha_registro'].'|'.$row['fecha_actualizado'];	 
			 
	    }else{ // si no existe el registro de usuario con esa minifigura, regresa un valor comodin ara generar la lista de elementos
		    $info = '0|0|0';
	    }
	
	//$data = $total_serie; 
	return $info; 
	$dbhb->close();
	
}

////////////////////

////////////////////

function getinfosets($id){
	
	include("access.php");
	
	
	$user = $_SESSION['clave_user'];
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}
	
	$qb = "SELECT * FROM sets where id_tema = $id and id_user = $user ";// preparando la instruccion sql
	//echo $qb;
      
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	
	    	$total = $resultb->num_rows; 
	    	//$row= $resultb->fetch_assoc();
	    	
			while($row= $resultb->fetch_assoc()){
				$piezas = $piezas + $row['piezas'];
				$inversion = $inversion + $row['precio'];
                $setscol .= $row['cve_lego'].'|';
			}
	    	
	    	$info = $total.'-'.$piezas.'-'.$inversion.'-'.$setscol;		 
			 
	    }else{ // si no existe el registro de usuario con esa minifigura, regresa un valor comodin ara generar la lista de elementos
		    $info = '0-0-0-0|0';
	    }
	
	//$data = $total_serie; 
	return $info; 
	$dbhb->close();
	
}


function generaListTemas($tema_actual){

	include("access.php");
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}
	
	$q = "SELECT * FROM temas_sets where estado = 1 order by nombre ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbhb->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['id']== $tema_actual){
		                         $opt .= '<option selected value="'.$row['id'].'">'.$row['nombre'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }
	            
	            $sel = $opt;
	
	//$data = $total_serie; 
	return $sel; 
	$dbhb->close();	
	
	
	
}

function listLogo($current){
	
	$carpeta = 'assets/images/logos/';
			
			
			
	
	if (is_dir($carpeta)) { //Comprovamos que sea un carpeta Valido
		if ($dir = opendir($carpeta)) {//Abrimos el carpeta
			$sele .= '<ul>';
				while (($archivo = readdir($dir)) !== false){ //Comenzamos a leer archivo por archivo
					if ($archivo != '.' && $archivo != '..'){ 
						$nuevaRuta = $carpeta.$archivo.'/';
						$sele .=  '<li>'; //Abrimos un elemento de lista 
							if (is_dir($nuevaRuta)) { //Si la ruta que creamos es un carpeta entonces:
								$sele .= '<b>'.$nuevaRuta.'</b>'; //Imprimimos la ruta completa resaltandola en negrita
								//listLogo($nuevaRuta);//Volvemos a llamar a este metodo para que explore ese carpeta.
							} else { //si no es un carpeta:
								$sele .= 'Archivo: '.$archivo; //simplemente imprimimos el nombre del archivo actual
							}
						$sele .= '</li>'; //Cerramos el item actual y se inicia la llamada al siguiente archivo
					}
				}//finaliza 
			$sele .= '</ul>';//Se cierra la lista
			closedir($dir);//Se cierra el archivo
		}
	}else{//Finaliza el If de la linea 12, si no es un carpeta valido, muestra el siguiente mensaje
		$sele = 'No Existe la carpeta';
	}				

			
///////////////		

//$directorio = 'logos/';	
$directorio=opendir($carpeta);
	$datos=array();
		while ($archivo = readdir($directorio)) { 
		  if(($archivo != '.') && ($archivo != '..')){
		     $datos[]=$archivo; 
		  } 
		}
	closedir($directorio);
	
	//var_dump($datos); 
		 //imprimir datos
		 for($i=0;$i<=count($datos);$i++){
			 
			 if($current == $datos[$i]){
				 $opt .= '<option selected value="'.$datos[$i].'">'.$datos[$i].' </option>'; 
			 }else{
				$opt .= '<option value="'.$datos[$i].'">'.$datos[$i].' </option>';  
			 }
		   
		   
		   
		  }
		  
		  $sel = $opt; 
		  
	return  $sel; 
} 

/////

function listar_directorios_ruta($ruta){
	// abrir un directorio y listarlo recursivo
	$sub = $_GET['sub'];

	$mnu = $_GET['mnu'];
	$item = $_GET['item'];
	$element = $_GET['element'];

	if (is_dir($ruta)) {
	   if ($dh = opendir($ruta)) {
		  while (($file = readdir($dh)) !== false) {
			 //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
			 //mostraría tanto archivos como directorios
			 //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
			 if (is_dir($ruta . $file) && $file!="." && $file!=".."){
				//solo si el archivo es un directorio, distinto que "." y ".."
				//$dirs .= "<br>Directorio: $ruta$file";
				
				
				$subfolder = $file;
				//$url = $path_site.'?mnu='.$mnu.'&item='.$item.'&element='.$element.'&sub='.$subfolder;
				/*$dirs .= '<tr> 
							<td colspan="3" >
								<span class="text-muted"> <a class="text-primary" href="'.$url.'" > <i class="fa-solid fa-folder"></i> '.$file.'</a> ['.$files_n.' archivos ]</span> 
							</td>
						</tr>';*/
						if(isset($sub)===true){
							$url = $path_site.'?mnu='.$mnu.'&item='.$item.'&element='.$element;
							$dirs .= '<tr> 
										<td colspan="3" >
											<span class="text-muted"> <a class="text-primary" href="'.$url.'" > <i class="fa-solid fa-rotate-left"></i> Regresar... </a> 
												
											</span> 
										</td>
									</tr>';
						}else{
							$url = $path_site.'?mnu='.$mnu.'&item='.$item.'&element='.$element.'&sub='.$subfolder;
							//$files_n = count($ruta.$file.'/');
							//$files_n = count(glob($ruta.$file.'/',GLOB_BRACE));

							if($file!='bckup'){
								$btn_elimina = '<button class="btn btn-inverse-secondary btn_thin" style="z-index:99; float:right;" type="button" onclick="elimina_dir(this.value);" value="'.$ruta.$file.'" ><i class="fa-regular fa-trash-can"></i></button>
';
							}else{
								$btn_elimina = '';
							}
							$dirs .= '<tr> 
													<td colspan="3" >
													<div class="row">
														<div class="col-md-8">
															<span class="text-muted"> <a class="text-primary" href="'.$url.'" > <i class="fa-regular fa-folder"></i> '.$file.'<br> <span class="text-muted" style="font-size:0.6rem;">'.$ruta.$file.'/</span></a> 
															</span> 
														</div>
														<div class="col-md-4">
														'.$btn_elimina.'
														</div>
													</div>
													</td>
												</tr>';
						}

				listar_directorios_ruta($ruta . $file . "/");
			 }
		  }
	   
		  if(isset($sub)===true){
			$url = $path_site.'?mnu='.$mnu.'&item='.$item.'&element='.$element;
			$dirs .= '<tr> 
						<td colspan="3" >
							<span class="text-muted"> <a class="text-primary" href="'.$url.'" > <i class="fa-solid fa-rotate-left"></i> Regresar... </a></span> 
						</td>
					</tr>';
		}

	   }else{
		$dirs .= '<span class="text-muted"> No hay directorios </span>';
	   }
	   closedir($dh);
	}else{
		$dirs .= '<span class="text-muted"> No hay directorios </span>';
	}
	  // echo "<br>No es ruta valida";
	   return $dirs;
 }

/////

function list_dir_only($dir_raiz){

//$directorio = $dir_raiz;
$dir  = scandir($dir_raiz);

//var_dump($dir_raiz);
$files_n = count($dir);
//var_dump($files_n);
$datos=array();
//$files_n

$i=0;
    while($i<=$files_n){
		if (is_dir($dir_raiz.'/'.$dir[$i])){   
            $datos[]=$dir[$i]; 
			$no_dir = $no_dir+0;
        }else{
			$no_dir= $no_dir +1;
		}
	}

return $no_dir;

}


function list_fotos_minifig($serie){
	
	$carpeta = 'minifig/'.$serie.'/';
			

$directorio=opendir($carpeta);
	$datos=array();
		while ($archivo = readdir($directorio)) { 
		  if(($archivo != '.') && ($archivo != '..') && ($archivo != 'Icon_') && ($archivo != 'minifig.png') && ($archivo != 'minifig.jpg') && ($archivo != '.DS_Store') ){
		     $datos[]=$archivo; 
		  } 
		}
		
	sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
	closedir($directorio);
	
	//var_dump($datos); 
		 //imprimir datos
		 for($i=0;$i<=count($datos);$i++){
			 
			 if($datos[$i] != ""){
				 if($current == $datos[$i]){
					 $opt .= '<option selected value="'.$datos[$i].'">'.$datos[$i].' </option>'; 
				 }else{
					$opt .= '<option value="'.$datos[$i].'">'.$datos[$i].' </option>';  
				 }
			}
		   
		   
		   
		  }
		  
		  $sel = $opt; 
		  
	return  $sel; 
} 



///////////////////
function fotos_minifig($serie){
	
	$carpeta = 'minifig/'.$serie.'/';
			

$directorio=opendir($carpeta);
	$datos=array();
		while ($archivo = readdir($directorio)) { 
		  if(($archivo != '.') && ($archivo != '..') && ($archivo != 'Icon_') && ($archivo != 'minifig.jpg') && ($archivo != 'minifig.png') && ($archivo != '.DS_Store') ){
		    if(is_dir($carpeta.$archivo)==false){
				$datos[]=$archivo; 
			}
			
		  } 
		}
		
		  sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
	closedir($directorio);
	
	//var_dump($datos); 
		 //imprimir datos
		 for($i=0;$i<=count($datos);$i++){
			 
			 if($datos[$i] != ''){
				 $names .= $datos[$i].'--';
			 }	   
		   
		  }
		  
		  
		  
	return  $names; 
} 
///////////////////
function fotos_minifig_url($url){
	
	$carpeta = $url;
			

$directorio=opendir($carpeta);
	$datos=array();
		while ($archivo = readdir($directorio)) { 
		  if(($archivo != '.') && ($archivo != '..') && ($archivo != 'Icon_') && ($archivo != 'minifig.jpg') && ($archivo != 'minifig.png') && ($archivo != '.DS_Store') ){
		    if(is_dir($carpeta.$archivo)==false){
				$datos[]=$archivo; 
			}
			
		  } 
		}
		
		  sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
	closedir($directorio);
	
	//var_dump($datos); 
		 //imprimir datos
		 for($i=0;$i<=count($datos);$i++){
			 
			 if($datos[$i] != ''){
				 $names .= $datos[$i].'--';
			 }	   
		   
		  }
		  
		  
		  
	return  $names; 
} 

///////////////////////

function logos_temas(){
	
	$carpeta = 'assets/images/logos/';
			

$directorio=opendir($carpeta);
	$datos=array();
		while ($archivo = readdir($directorio)) { 
		  if(($archivo != '.') && ($archivo != '..') && ($archivo != 'Icon_') && ($archivo != 'minifig.png') && ($archivo != 'minifig.jpg') && ($archivo != '.DS_Store') ){
		     $datos[]=$archivo; 
		  } 
		}
		
		  sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
	closedir($directorio);
	
	//var_dump($datos); 
		 //imprimir datos
		 for($i=0;$i<=count($datos);$i++){
			 
			 if($datos[$i] != ''){
				 $names .= $datos[$i].'--';
			 }	   
		   
		  }
		  
		  
		  
	return  $names; 
} 


///////////////////////

function get_all_info_serie($serie,$id_fig){
	
	include("access.php");
	

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbh->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}

   $q = "SELECT * FROM minifiguras where cve_lego = '$serie' ";// preparando la instruccion sql
  
   //echo $qb;

    $result= $dbh->query($q);
    
    	if ($result->num_rows > 0) {
	    	
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['id']==$id_fig){
		                        $opt .= '<option value="'.$row['id'].'" selected >'. $row['nombre_es'] .'</option> ';
	                        }else{
		                        $opt .= '<option value="'.$row['id'].'"  >'. $row['nombre_es'] .'</option> ';
	                        }
	                        
	                    }	    	 			    	 	
	    
	    }else{
		    
		    $opt  .= 'Sin Asociar';
		    
	    }
	
	return $opt; 
	$dbh->close();
	
}

//////////////////////////////////




function rand_rgb(){

$blue= rand(0,255);
$red= rand(0,255);
$green= rand(0,255);

	$color_rgb= $red.','.$green.','.$blue;
	return  $color_rgb;
	
}

function labels_admin_fotos_url($url,$permiso_perfil){

	$sub = $_GET['sub'];



	$current_dir= $url; 
	
	$options = fotos_minifig_url($url);

	if($permiso_perfil==0){
		$perfil = $GLOBALS['user_perfil'];
	}else{
		$perfil = 1;
	}
	$permiso_ver_dir = get_permiso_config('35', $perfil);

	if($permiso_ver_dir==1){
		$solo_dir = listar_directorios_ruta($current_dir);
	}else{
		$solo_dir = '';
	}
	
	//var_dump($solo_dir);
				   			
				   			$data_opt = explode('--', $options); 
				   			
				   			for($i=0; $i<= count($data_opt); $i++){
					   			if($data_opt[$i] != ''){
						   		
						   		$num = $i +1;
						   		
						   		if ($num%2==0){
								    $class_row_color = 'bg-light';
								}else{
								    $class_row_color = 'bg-secondary';
								}
						   		
						   			$data_file = explode('.',$data_opt[$i]); 
						   			$nombre = $data_file[0];
						   			$ext = $data_file[1];
						   			
									/*
						   			$caracter = substr($nombre,0,1);
						   			
						   			if($caracter == '_'){
							   			$class= 'inverse-warning';
							   			$classb = 'warning'; 
							   			$ico = 'arrow-circle-up'; 
							   			$ico_lock = '';
							   			
						   			}else{
							   			$btn_elimina = ''; 
							   			$class= '';
							   			$classb = 'light'; 
							   			$ico = 'image'; 
							   			$ico_lock = '<span class="text-clear" ><small><i class="fa fa-lock" ></i></small> </span>'; 
						   			}
						   			*/
						   			
						   			
									$permiso_elimina = get_permiso_config('34', $perfil);

									if($permiso_elimina==1){
										$btn_elimina = '<button class="btn btn-inverse-primary btn_thin" onclick="elimina_foto(\''.$url.$data_opt[$i].'\');" > <i class="fa fa-trash" ></i></button>';
									}else{
										$btn_elimina = '<button class="btn btn-inverse-primary btn_thin" disabled> <i class="fa fa-trash" ></i></button>';
									}

						   			$info_fig = get_data($serie.'-'.$nombre,$index);
						   			$data_fig = explode('/', $info_fig); 
						   			$nombre_es = $data_fig[0];

									$btn_edita = '<button onclick="barmenu(\'imagesedit_1\'); edita_img(\''.$nombre.'.'.$ext.'\')" class="btn btn-inverse-primary btn_thin" > <i class="fa fa-pencil" ></i> </button>';
									$btn_ver = '<button onclick="preview_foto(\''.$serie.'/'.$data_opt[$i].'\'); " class="btn btn-inverse-primary btn_thin" > <i class="fa fa-eye" ></i> </button>';

									if(isset($sub)){
										//$url = 'minifig/'.$clave_lego.'/'.$sub.'/';
										$btn_archiva = '<button onclick="restaura_img(\''.$nombre.'.'.$ext.'\')" class="btn btn-inverse-primary btn_thin" > <i class="fa-solid fa-retweet"></i></button>';

									
									}else{
										//$url = 'minifig/'.$clave_lego.'/';
										$btn_archiva = '<button onclick="archiva_img(\''.$nombre.'.'.$ext.'\')" class="btn btn-inverse-primary btn_thin" > <i class="fa-solid fa-box-archive"></i></button>';

									}
									
	
					   			$labels.= '
								
								
								<tr>
									<td><img src="data:image/png;base64,'.base64_encode(file_get_contents($current_dir.$data_opt[$i])).'" style=" " > </td>
									<td> <span class="text-muted"> '.$data_opt[$i].' '.$ico_lock.'</span>  </td>
									<td>
										<div class="btn-group">
						   				'.$btn_edita.$btn_archiva.$btn_elimina.'
										</div>
										<input type="hidden" id="current_name_'.$nombre.'" value="'.$nombre.'">
										<input type="hidden" id="current_ext_'.$nombre.'" value="'.$ext.'">
		
									</td>
								</tr>
								
					   			';
					   			}					   			
					   			
				   			}

							$table_img = '<table class="table table-striped" > 
											<tbody>
												'.$solo_dir .'
												'.$labels.'
											</tbody>
											</table>';
				   			
				   			return $table_img; 
				   			
	
}


function labels_admin_fotos($serie){

	$current_dir= 'minifig/'.$serie.'/'; 
	
	$options = fotos_minifig($serie);

	$perfil = $GLOBALS['user_perfil'];
	$permiso_ver_dir = get_permiso_config('35', $perfil);

	if($permiso_ver_dir==1){
		$solo_dir = listar_directorios_ruta($current_dir);
	}else{
		$solo_dir = '';
	}
	
	//var_dump($solo_dir);
				   			
				   			$data_opt = explode('--', $options); 
				   			
				   			for($i=0; $i<= count($data_opt); $i++){
					   			if($data_opt[$i] != ''){
						   		
						   		$num = $i +1;
						   		
						   		if ($num%2==0){
								    $class_row_color = 'bg-light';
								}else{
								    $class_row_color = 'bg-secondary';
								}
						   		
						   			$data_file = explode('.',$data_opt[$i]); 
						   			$nombre = $data_file[0];
						   			$ext = $data_file[1];
						   			
									/*
						   			$caracter = substr($nombre,0,1);
						   			
						   			if($caracter == '_'){
							   			$class= 'inverse-warning';
							   			$classb = 'warning'; 
							   			$ico = 'arrow-circle-up'; 
							   			$ico_lock = '';
							   			
						   			}else{
							   			$btn_elimina = ''; 
							   			$class= '';
							   			$classb = 'light'; 
							   			$ico = 'image'; 
							   			$ico_lock = '<span class="text-clear" ><small><i class="fa fa-lock" ></i></small> </span>'; 
						   			}
						   			*/
						   			
						   			
									$permiso_elimina = get_permiso_config('34', $perfil);

									if($permiso_elimina==1){
										$btn_elimina = '<button class="btn btn-inverse-primary btn_thin" onclick="elimina_foto(\''.$serie.'/'.$data_opt[$i].'\');" > <i class="fa fa-trash" ></i></button>';
									}else{
										$btn_elimina = '<button class="btn btn-inverse-primary btn_thin" disabled> <i class="fa fa-trash" ></i></button>';
									}

						   			$info_fig = get_data($serie.'-'.$nombre,$index);
						   			$data_fig = explode('/', $info_fig); 
						   			$nombre_es = $data_fig[0];

									$btn_edita = '<button onclick="edita_img(\''.$nombre.'.'.$ext.'\')" class="btn btn-inverse-primary btn_thin" > <i class="fa fa-pencil" ></i> </button>';
									$btn_ver = '<button onclick="preview_foto(\''.$serie.'/'.$data_opt[$i].'\'); " class="btn btn-inverse-primary btn_thin" > <i class="fa fa-eye" ></i> </button>';
									$btn_archiva = '<button onclick="archiva_img(\''.$nombre.'.'.$ext.'\')" class="btn btn-inverse-primary btn_thin" > <i class="fa-solid fa-box-archive"></i></button>';

									
	
					   			$labels.= '
								
								
								<tr>
									<td><img src="'.$current_dir.$data_opt[$i].'" style=" " > </td>
									<td> <span class="text-muted"> '.$data_opt[$i].' '.$ico_lock.'</span>  </td>
									<td>
										<div class="btn-group">
						   				'.$btn_edita.$btn_archiva.$btn_elimina.'
										</div>
										<input type="hidden" id="current_name_'.$nombre.'" value="'.$nombre.'">
										<input type="hidden" id="current_ext_'.$nombre.'" value="'.$ext.'">
		
									</td>
								</tr>
								
					   			';
					   			}			   			
					   			
				   			}

							$table_img = '<table class="table table-striped" > 
											<tbody>
												<tr> <td >'.$solo_dir .'</td> </tr>
												'.$labels.'
											</tbody>
											</table>';
				   			
				   			return $table_img; 
				   			
	
}

///////////////

function get_series_activas(){
	
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbh->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}	


	//////////////////////////   BUSCA SERIES ACTIVAS   ////////////////////////////////////
	
		$qs = "SELECT * FROM series where estado = 1;";// preparando la instruccion sql
	
		$results= $dbh->query($qs);
	    if ($results->num_rows > 0) {
		
		$tot_reg = $results->num_rows; 
		$tot = 0; 
		
			while($rows= $results->fetch_assoc()){
				
				if($tot == $tot_reg){
					$serie_act .= $rows['clave_lego'];
				}else{
					$serie_act .= $rows['clave_lego'].'-';
				}
							
				$tot = $tot + 1; 
			}
		
		}
	
		// 2. Convierte en un array
		
		//$series = explode('-', $serie_act); 
		
		return $serie_act; 
		
	///////////////////////////////////////////////////////////////////////////////////////////////
	
}



///////////////////////////////////////////////////////////////////////////

function get_info_serie($clave){ // devuelve el nombre de la serie
	
	include("access.php");
	
	//echo $item;
	$clave = strval($clave);

	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM series where clave_lego = '$clave'";// preparando la instruccion sql
   $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();

             $tot=$resultb->num_rows;
	    	 
			$datos = $row['nombre'].'/'.$row['color'].'/'.$row['fecha_lanzamiento'].'/'.$row['estado'].'/'.$row['precio_premium'].'/'.$row['moneda_premium'].'/'.$row['descuento'].'/'.$row['aux'].'/'.$row['premium'].'/'.$row['tipo'].'/'.$row['fecha_registro'].'/'.$row['fecha_actualizado'].'/'.$row['id'].'/'.$row['color_text'].'/'.$row['colorb'].'/'.$tot;
	    
        }else{
		    
		    	$datos = '0/ Sin Información/';
		    
	    }
	    
	   // var_dump($datos);
	
	return $datos; 
	$dbh->close();
}



//////////////////////////////////////////////////////////////////


function get_info_estado_serie($clave){ // devuelve el nombre de la serie
	
	include("access.php");
	
	//echo $item;
	$clave = strval($clave);

	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM estado_serie where clave = '$clave'";// preparando la instruccion sql
   $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
			 	$datos = $row['id'].'/'.$row['icono'].'/'.$row['color'].'/'.$row['nombre'];
	    }else{
		    
		    	$datos = 'Error / Sin Información';
		    
	    }
	    
	   // var_dump($datos);
	
	return $datos; 
	$dbh->close();
}
/////////

function get_info_edo_set($clave){ // devuelve el nombre de la serie
	
	include("access.php");
	
	//echo $item;
//	$clave = strval($clave);

	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM estado_colect_set where clave = $clave";// preparando la instruccion sql
   $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
			 	$datos = $row['id'].'|'.$row['nombre'].'|'.$row['icono'];
	    }else{
		    
		    	$datos = 'Error | Sin Información|fa-times';
		    
	    }
	    
	   // var_dump($datos);
	
	return $datos; 
	$dbh->close();
}
/////////

function get_info_presentacion($clave){ // devuelve el nombre de la serie
	
	include("access.php");
	
	//echo $item;
//	$clave = strval($clave);

	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM estado_presentacion where clave = $clave";// preparando la instruccion sql
   $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
			 	$datos = $row['id'].'|'.$row['nombre'].'|'.$row['icono'];
	    }else{
		    
		    	$datos = 'Error | Sin Información|fa-times';
		    
	    }
	    
	   // var_dump($datos);
	
	return $datos; 
	$dbh->close();
}

//////////////////////////////////////////////////////////////////




	                        
	                        function rand_parpadeo(){
		                        $num_rand = random_int(1,100); 
		                        
		                        if($num_rand <= 20){
			                        $class_parpadeo = 'parpadea4';
			                        
		                        }else if($num_rand >20 and $num_rand <= 40){
			                        $class_parpadeo = 'parpadea6';
			                        
		                        }else if($num_rand >40 and $num_rand <= 60){
			                        $class_parpadeo = 'parpadea8';
			                        
		                        }else if($num_rand >60 and $num_rand <= 80){
			                        $class_parpadeo = 'parpadea10';
			                        
		                        }else if($num_rand >80 and $num_rand <= 100){
			                        $class_parpadeo = 'parpadea12';
			                        
		                        }
		                        
		                        return $class_parpadeo; 
	                       }
	  
///////////////////////////////////////////////////////////////////////////

function get_status_serie($clave){ // devuelve el nombre de la serie
	
	include("access.php");
	
	//echo $item;
	

	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM series where clave_lego = '$clave'";// preparando la instruccion sql
   $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
			 	$estado = $row['estado'];
	    }else{
		    
		    	$estado = 99;
		    
	    }
	
	return $estado; 
	$dbh->close();
}
//////

function get_permiso_serie($clave, $id_user){ // devuelve el nombre de la serie
	
	include("access.php");
	
	//echo $item;
	

	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM permiso_serie where clave_serie = '$clave' and id_user = $id_user";// preparando la instruccion sql

   //var_dump($qb);
   $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
			 	$estado = $row['permiso_asignado'];
	    }else{
		    
		    	$estado = 1;
		    
	    }
	
	return $estado; 
	$dbh->close();
}
	  
///////////////////////

function get_flanzamiento_serie($clave){ // devuelve el nombre de la serie
	
	include("access.php");
	
	//echo $item;
	

	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM series where clave_lego = '$clave'";// preparando la instruccion sql
   $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
			 	$fecha = $row['fecha_lanzamiento'];
	    }else{
		    
		    	$fecha= 99;
		    
	    }
	
	return $fecha; 
	$dbh->close();
}	  


///////////////////


function get_ids_current($referencia){

include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbh->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}	


	//////////////////////////   BUSCA SERIES ACTIVAS   ////////////////////////////////////
	
		$qs = "SELECT * FROM minifiguras where cve_lego = '$referencia' order by no_folleto";// preparando la instruccion sql
	
		$results= $dbh->query($qs);
	    if ($results->num_rows > 0) {
		
		$tot_reg = $results->num_rows; 
		$tot = 0; 
		
			while($rows= $results->fetch_assoc()){
				
					$ids .= $rows['id'].';'.$rows['imagen'].'-';
				
							
				$tot = $tot + 1; 
			}
		
		$idss = substr($ids, 0,-1);
		
		}	
		return $idss; 
	$dbh->close();
}  


/////////////


//////////////////////////////

function get_extras($item){ // devuelve las figuras extras
	include("access.php");

	$data = explode(";", $item); 
	
	$id_user=$data[0];
	$id_minifigura= $data[1];
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}
	
	$qb = "SELECT * FROM coleccion where id_user = '$id_user' and item = '$id_minifigura';";// preparando la instruccion sql
	
//	var_dump($qb.'<br>'); 
      
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['no_extra']; 
	    	
	    
	    }else{
		    $data = 0; 
	    }
	    

	return $data; 
	$dbhb->close();
	
	
	
}
/////     




function get_users_mkt(){
	
include("access.php");
include("globals.php");

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbh->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}	


	//////////////////////////   BUSCA Los usuarios con minifiguras en MKT    //////////////////////////////////// and id_user <> '$user'
	
		$qu = "SELECT * FROM coleccion where no_extra > 0 and mostrar_mkt = 1 and id_user <> '$user' order by id_user;";// preparando la instruccion sql
	
		$results= $dbh->query($qu);
	    if ($results->num_rows > 0) {
		
		$ant_user = '';  
		$tot_reg = $results->num_rows; 
		$tot = 0; 
		$req_user = $_GET['det'];
		
		
		//var_dump($user); 
		
		while($rows= $results->fetch_assoc()){
				
				
				if( intval($rows['id_user']) != $ant_user) {
					
				
					
					$user_info = busca_user($rows['id_user']);
					$data_user = explode('--', $user_info);
					$error = $data_user[0];
					$nombre = $data_user[1];
					$correo = $data_user[2];
					$user_name = $data_user[3];
					$foto = $data_user[4];
					
					if($req_user == intval($rows['id_user'])){
						$class_tarjeta = 'active_card';
					}else{
						$class_tarjeta = 'diactive_card';
					}
					
					$total_extas = get_total_extras($rows['id_user'], 1,0,0); 

					if($total_extas==1){
						$txt_label = 'serie'; 
						
					}else{
						$txt_label = 'series'; 
					}
					
					if($error==1){
						$user_mkt .= '';
						$ant_user = $rows['id_user'];
						$nombre = ''; 
						$correo = ''; 
						$user_name='';
						$foto= ''; 
					}else{
						
						$link = $link_site.'?mnu=bc5986ebbf4dde661f229fd527ad82f4&det='.$rows['id_user']; 
						
						$user_mkt .= '					
							<div id="user_'.$rows['id_user'].'" class="col-md-12 row hold_perfil '.$class_tarjeta.'">
								<div class="foto_perfil">
									<img class="img-sm rounded-circle" src="assets/images/faces/profile/'.$foto.'" alt="profile image">
								</div>
								<div class="hold_info">
									<h5> <strong>@'.$user_name.'</strong>
										<p> <span class="ico_disp">
											<i class="fa fa-circle" ></i></span> 
											'.$total_extas .' '.$txt_label.'
										</p>
									<span class="no-show">'.$req_user.'-'.$rows['id_user'].'</span>
									</h5>
								</div>
								<div class="hold_link" >
											<a href="'.$link.'" class="vertical-align: middle; " >
												<i class="fas fa-chevron-right fa-2x"></i>
											</a>
								</div>
							</div>
						';
						//$user_mkt .= $rows['id_user'].',';
						$ant_user = intval($rows['id_user']);
					
					
					}
					
				}elseif($current_user == $ant_user){
					$user_mkt .= ''; 
					$ant_user = $rows['id_user'];
						$nombre = ''; 
						$correo = ''; 
						$user_name='';
						$foto= ''; 
				}
				
			
							
				$tot = $tot + 1; 
			}
			
			// busca el usuario
		
		}	
		
		return $user_mkt; 
	$dbh->close();
}  



////////////////


function get_series_mkt($user){
	
include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbh->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}	


	//////////////////////////   BUSCA las series en la coleccion de un usuario   ////////////////////////////////////
	
		$qse = "SELECT DISTINCT * FROM coleccion where id_user = '$user' and no_extra > 0 and mostrar_mkt = 1 order by clave_lego;";// preparando la instruccion sql
	
		$results= $dbh->query($qse);
	    if ($results->num_rows > 0) {
		
		$ant_serie = '';  
		$tot_reg = $results->num_rows; 
		$num = 1; 
		$req_user = $_GET['det'];
		$req_serie = $_GET['cve'];
		
		
			while($rows= $results->fetch_assoc()){
				
			if($rows['clave_lego'] != intval($ant_serie)) {
					$serie_info = get_info_serie($rows['clave_lego']);
					$data_serie = explode('/', $serie_info);
					//$error = $data_user[0];
					$nombre = $data_serie[0];
					$color = $data_serie[1];
					$fecha_lan = $data_serie[2];
					$estado = $data_serie[3];


					
					if($req_serie == $rows['clave_lego']){
						$class_tarjeta = 'active_card';
					}else{
						$class_tarjeta = 'diactive_card';
					}					
					
					$total_extas = get_total_extras($rows['id_user'],2, $rows['clave_lego'],$rows['item']); 
					
					if($total_extas==1){
						$txt_label = 'minifigura'; 
						
					}else{
						$txt_label = 'minifiguras'; 
					}
					
					//$gran_tot = $gran_tot + $total_extas; 
					
					if($serie_info==''){
						$user_mkt .= '';
					
						//$nombre = ''; 
						//$correo = ''; 
						//$user_name='';
						//$foto= ''; 
					
					}else{
						
						$link = $link_site.'?mnu=bc5986ebbf4dde661f229fd527ad82f4&det='.trim($rows['id_user']).'&cve='.$rows['clave_lego']; 
						
						$user_mkt .= '					
							<div id="serie_'.$rows['id_user'].'" class="col-md-12 row hold_serie '.$class_tarjeta.'">
								<div class="foto_perfil">
									<div class="img-sm rounded-circle" style="background: rgba('.$color.',0.7); " > <span class="ico_numera">'.$num.'</span></div>
								</div>
								<div class="hold_info">
									<h5> <strong>'.$nombre.'</strong>
										<p> 
											<span >
											'.$rows['clave_lego'].'
											</span>
											<span class="ico_disp" > <i class="fa fa-circle" ></i></span> 
											<span class="">'.$total_extas.' '.$txt_label.'</span>
										</p>
									<span class="no-show">'.$req_user.'-'.$rows['id_user'].'</span>
									</h5>
								</div>
								
								<div class="hold_link" >
											<a href="'.$link.'" class="vertical-align: middle; " >
												<i class="fas fa-chevron-right fa-2x"></i>
											</a>
								</div>
							</div>
						';
						//$user_mkt .= $rows['id_user'].',';
						$ant_serie = $rows['clave_lego'];
						$num = $num + 1; 
					}
				
					
				}elseif($rows['clave_lego'] == $ant_serie){
					$user_mkt .= ''; 
					$ant_user = $rows['id_user'];
						$nombre = ''; 
						$correo = ''; 
						$user_name='';
						$foto= ''; 
				}
							
				
			}
			
			// busca el usuario
		
		}	
		
		return $user_mkt; 
		//return $qs;
	$dbh->close();
}    

////////////////


function get_minifiguras_mkt($cve){

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}	

$cve = $_GET['cve'];
$user = $_GET['det'];


	//////////////////////////   BUSCA las minifiguras en la coleccion de un usuario   ////////////////////////////////////
	
		$qm = "SELECT * FROM coleccion where id_user = '$user' and clave_lego = '$cve' and no_extra > 0 and mostrar_mkt = 1;";// preparando la instruccion sql
	
		$results= $dbh->query($qm);
	    if ($results->num_rows > 0) {
		
		$ant_reg = '';  
		$tot_reg = $results->num_rows; 
		$tot = 0; 
		$req_user = $_GET['det'];
		
			while($rows= $results->fetch_assoc()){
				
								
					$fig_info = get_data($rows['item'],$index);
					$data_fig = explode('/', $fig_info);
					$nombre_es = $data_fig[0];
					$nombre_en = $data_fig[1];
					$imagen= $data_fig[2];
					$cve_lego = $data_fig[3];
									
					$total_extas = ''; 
					$total_extas = get_total_extras($rows['id_user'], 3, $rows['clave_lego'], $rows['item']); 


					if($total_extas==1){
						$txt_label = 'disponible'; 
						
					}else{
						$txt_label = 'disponibles'; 
					}
					
					$mail = '<a href="#"><span class="ico_options" title="Enviar un mail" ><i class="fa fa-envelope" ></i></span></a>';
					$mensaje = '<a href="#"><span class="ico_options" title="Enviar mensaje directo" ><i class="fas fa-inbox"></i></span></a>';
					
					$opciones = $mail.$mensaje; 
									
					if($fig_info==''){
						$user_mkt .= '';
			
						//$nombre = ''; 
						//$correo = ''; 
						//$user_name='';
						//$foto= ''; 
					
					}else{
						
						$link = '#'; 
						
						$user_mkt .= '					
							<div id="serie_'.$rows['id_user'].'" class="col-md-12 row hold_serie">
								<div class="foto_perfil">
									<img class=" ico_imagen" src="minifig/'.$rows['clave_lego'].'/'.$imagen.'.png" alt="profile image">
								</div>
								<div class="hold_info">
									<h4>'.$nombre_es.'
										<p class="text-muted"> 
											
											'.$total_extas.' '.$txt_label.' 
											<span class="ico_disp text-neutral" > <i class="fa fa-circle" ></i></span>  
											<span>
												'.$opciones.'
											</span>
										</p>
									<span class="no-show">'.$req_user.'-'.$rows['id_user'].'</span>
									</h6>
								</div>
								<div class="hold_link" >
								</div>
							</div>
						';
					}
				
				$tot = $tot + 1; 
			}
			
			// busca el usuario
		
		}	
		
		return $user_mkt; 
		//return $qs;
	$dbh->close();
}  


/////////////////////////

function get_total_extras($user, $tipo, $serie, $figura){

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	// 1. por usuario; 1. Por figura
	
	//$cve = $_GET['cve'];
	
	if($tipo == 1){
		
		$qm = "SELECT * FROM coleccion where id_user = '$user' and no_extra > 0 and mostrar_mkt = 1 order by clave_lego;";// preparando la instruccion sql
		
	}elseif( $tipo== 2){
	
		$qm = "SELECT * FROM coleccion where id_user = '$user' and clave_lego = $serie and no_extra > 0 and mostrar_mkt = 1;";// preparando la instruccion sql
	
	}elseif( $tipo== 3){
	
		$qm = "SELECT * FROM coleccion where id_user = '$user' and clave_lego = $serie and item = '$figura' and no_extra > 0 and mostrar_mkt = 1;";// preparando la instruccion sql
	
	}
	$results= $dbh->query($qm);
	    if ($results->num_rows > 0) {
		  
		  $ant_ser = 0; 
			while($row = $results->fetch_assoc()){
			
			
			// tipo 3
				$sum = $sum + $row['no_extra'];
			
			//tipo 1
				if($row['clave_lego'] != intval($ant_ser)){
					$tot_series = $tot_series +1;
				}
				
				$ant_ser = $row['clave_lego']; 
			
			
			// tipo 2
			
				$suma = $suma + $row['no_extra'];
			}			
			
			
			if($tipo==3){
				$total = $sum;
			}elseif($tipo==1){
				$total = $tot_series;
			}elseif($tipo==2){
				$total = $suma;
			}
		  
		}
		return $total; 
		//return $qs;
	$dbh->close();

}

////// Obtiene el estatus de las series opcionales


function get_status_series_opcionales($user){

include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
		
	$qb = "SELECT * FROM configuraciones where id_user = $user";// preparando la instruccion sql

//var_dump($qb); 
/*estado_8909 
estado_71014 
estado_41775 
estado_71361 
estado_71386 
estado_43101 
*/
		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['estado_8909'].'.'.$row['estado_71014'].'.'.$row['estado_41775'].'.'.$row['estado_71361'].'.'.$row['estado_71386'].'.'.$row['estado_43101']; 
	    	
	    
	    }else{
		    $data = '0.0.0.0.0.0'; 
	    }
	    

	return $data; 
	$dbhb->close();
		  


}
///////////////////////////



////// Obtiene el estatus de las series opcionales


function get_status_series_opcional($user, $clave_lego){

include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
		
	$qb = "SELECT * FROM permiso_serie_opcional where id_user = $user and clave_serie = $clave_lego;";// preparando la instruccion sql

		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	//$data = $row['estado_'.trim($clave_lego)]; 
	    	$estado= $row['permiso_asignado'];
	    	
	    
	    }else{
		    $estado = 0; 
	    }
	    
	    		
		
	//	var_dump($debug);

	return $estado; 
	$dbhb->close();
		  


}


function get_status_series_opcional_admin($user, $clave_lego){

include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
		
	$qb = "SELECT * FROM permiso_serie_opcional where id_user = $user and clave_serie = $clave_lego;";// preparando la instruccion sql

		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	//$data = $row['estado_'.trim($clave_lego)]; 
	    	$estado= $row['permiso_admin'];
	    	
	    
	    }else{
		    $estado = 1; 
	    }
	    
	    		
		
	//	var_dump($debug);

	return $estado; 
	$dbhb->close();
		  


}
/////

function get_status_series_admin($user, $clave_lego){

    include("access.php");
    
    $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
    
    if ($dbh->connect_error) {
           die("Connection failed: " . $dbh->connect_error);
    }		
            
        $qb = "SELECT * FROM permiso_serie where id_user = $user and clave_serie = $clave_lego;";// preparando la instruccion sql
    
            
        $resultb= $dbh->query($qb);
        
            if ($resultb->num_rows > 0) {
                $row= $resultb->fetch_assoc();
                
                //$data = $row['estado_'.trim($clave_lego)]; 
                $estado= $row['permiso_admin'];
                
            
            }else{
                $estado = 1; 
            }
            
                    
            
        //	var_dump($debug);
    
        return $estado; 
        $dbhb->close();
              
    
    
    }
    
    ///////////////////////////


function genera_check_series_opcionales($user){

include("access.php");

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}		
		
	$qb = "SELECT * FROM series where tipo = 3 and estado between 1 and 98 order by consecutivo";// preparando la instruccion sql
		$results= $dbh->query($qb);
	    if ($results->num_rows > 0) {
		  
			while($row = $results->fetch_assoc()){
				
				$series_op .= $row['clave_lego'].';';
				
				if($row['estado'] == 0 ){
					$stat = 'disabled=""';
					$view = 'title="Esta colección no puede seleccionarse o no será visible, estará habilitada una vez que él administrador la active."';
					$txt_adv ='Esta colección no puede seleccionarse o no será visible, estará habilitada una vez que él administrador la active.'; 
					$text = 'text-gris'; 
					$ico_info = '<span '.$view.'> <i class="fas fa-info-circle"></i> </span>'; 
					$onchange = '';
					
				}elseif($row['estado'] == 3 ){
					$stat = '';
					$text = 'text-neutral';
					$view = 'title="Esta colección aun no se lanza, estará disponible a partir del '.formatFecha($row['fecha_lanzamiento']).'."';
					$txt_adv = 'Esta colección aun no se lanza, estará disponible a partir del '.formatFecha($row['fecha_lanzamiento']); 
					$ico_info = '<span '.$view.' style="margin-left:10px;" class="text-warning"> <i class="fas fa-bullhorn"></i> </span>';
					$onchange = '';
				}else{
					$stat = '';
					$text = 'text-neutral';
					$view = '';
					$txt_adv = ''; 
					$ico_info = ''; 
					$onchange = '';
				}
				
				$status_user = get_status_series_opcional($user, $row['clave_lego']);
				$status_admin = get_status_series_opcional_admin($user, $row['clave_lego']);
				
				if($status_admin==1){ // permitido
					
					$per_icon = 'user'; 
				
					if($status_user==1){
						$val = 'checked=""';
						$stat = '';
						$text = 'text-neutral';
						$onchange = 'save_perfil_opcionales(\''.$user.'\');';
					
					}elseif($status_user==0){
						$val = ''; 
						$stat = '';
						$text = 'text-neutral';
						
						
						if($row['estado']==3){
							$onchange = '';
							$onchange = 'save_perfil_opcionales(\''.$user.'\');';
						}else{
							$onchange = 'save_perfil_opcionales(\''.$user.'\');';
						}
					}
					
					
				
				}elseif($status_admin==0){ // no permitido
					
					$text = 'text-gris';
					$stat = 'disabled=""';
					$view = 'title="Esta colección ha sido bloqueada para su perfil."';
					$ico_info .= '<span '.$view.'> <i class="fas fa-ban"></i> </span>'; 
					$val = ''; 
					$per_icon = 'user-slash'; 
					$onchange = '';

				}


				
				if($status_user != -1){
				
				$forms .= '
					<div class="form-check form-check-flat border-bottom " style="padding-bottom:5px; padding-top:3px;" >
						<label class="form-check-label '.$text.'">
							<input type="checkbox" '.$stat.' class="form-check-input " onchange="'.$onchange.'" id="serie_'.$row['clave_lego'].'" value="1" '.$val.'> 
								Ver Serie '.$row['clave_lego'].' - '.$row['nombre'].''.$ico_info .' 
						</label>							
				    </div>
				';
				
				$formas .= '
				<tr>
					<td class="text-muted" style="width:10%;" >
					 
					
							<div class="form-check form-check-flat">
                              <label class="form-check-label">
                                <input type="checkbox" '.$stat.' class="form-check-input" onchange="'.$onchange.'" value="1" '.$val.' id="serie_'.$row['clave_lego'].'" > 
                                	<i class="input-helper"></i>
                               </label>
                            </div>
					
					</td>
					
					
					<td class="text-muted border-left border-right" style="width:20%;"> '.$row['clave_lego'].' </td>
					<td class="text-muted" style="width:30px;"> '.$ico_info .'</td>
					<td class="text-muted">'.$row['nombre'].' </td>
					
				</tr>
				'; 
				
				}
				
			  
			}
		}
		
		//$campo_buscar = crea_campo_buscar('coleccion_opcional'); 
		$campo_buscar = crea_campo_buscar_cust('coleccion_opcional',6);
			
		$table_formas = $campo_buscar .'
		
			 <table class="col-sm-8 table table-striped" id="coleccion_opcional" border= "0" >
			 <thead>
				                        <tr>
				                          <th class="thead_content" style=""> Ver </th>
				                          <th class="thead_content" style=""> Clave</th>
				                          <th colspan="2" class="thead_content" style="text-align:left"> Nombre </th>
				                        </tr>			 	
			 </thead>
			 	<tbody>
			 		'.$formas.'
			 	</tbody>	
			 </table>'; 
		
		//$forms = $forms.'<input type="hidden" id="current_series_op" value="'.$series_op.'" >';
		$forms = $table_formas.'<input type="hidden" id="current_series_op" value="'.$series_op.'" >';
		
		return $forms; 
		//return $qs;
	$dbh->close();


}

///////////////////////////

function genera_check_series_opcionales_admin($user){

include("access.php");

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}		
		
	$qb = "SELECT * FROM series where tipo = 3 and estado between 1 and 98 order by fecha_lanzamiento";// preparando la instruccion sql
		$results= $dbh->query($qb);
	    if ($results->num_rows > 0) {
		  
			while($row = $results->fetch_assoc()){
				
				$series_op .= $row['clave_lego'].';';
				
				if($row['estado'] != 1 ){
					$stat = 'disabled=""';
					$view = 'title="Esta colección no puede seleccionarse o no será visible, estará habilitada una vez que el administrador la active."';
					$txt_adv ='Esta colección no puede seleccionarse o no será visible, estará habilitada una vez que el administrador la active.'; 
					$text = 'text-gris'; 
					$ico_info = '<span '.$view.'> <i class="fas fa-info-circle"></i> </span>'; 
					$fx = '';
					 
				}elseif($row['estado'] == 3 ){
					$stat = '';
					$text = 'text-neutral';
					$view = '';
					$txt_adv = ''; 
					$ico_info = ''; 
					$fx = 'onchange="save_opcionales(\''.$user.'\');"';
				}else{
					$stat = '';
					$text = 'text-neutral';
					$view = '';
					$txt_adv = ''; 
					$ico_info = ''; 
					$fx = 'onchange="save_opcionales(\''.$user.'\');"';
				}
				
				//
				$status_user = get_status_series_opcional($user, $row['clave_lego']);
				$status_admin = get_status_series_opcional_admin($user, $row['clave_lego']);
				
				if($status_admin==1){ // permitido
					
					$per_icon = 'user';
					$btn_style='btn-secondary text-primary';
				
					if($status_user==1){
						$val = 'checked=""';
						$stat = '';
						$text = 'text-neutral';
						$ico_user_select = 'fa fa-square-check';
						
					}elseif($status_user==0){
						$val = ''; 
						$stat = '';
						$text = 'text-neutral';
						$ico_user_select = 'far fa-square'; 
					}
				
				}elseif($status_admin==0){ // no permitido
					
					$text = 'text-gris';
					$stat = 'disabled=""';
					$view = 'title="Esta colección ha sido bloqueada para su perfil."';
					$ico_info .= '<span '.$view.'> <i class="fas fa-ban"></i> </span>'; 
					$btn_style='btn-outline-secondary text-primary';
					
					$val = ''; 
					$per_icon = 'user-slash'; 
					$ico_user_select = 'far fa-square'; 

				}
				
				
				

				
				if($status_user != -1){
				

	
	
					$forms .= '
					<div class="form-check form-check-flat border-bottom " style="padding-bottom:5px; padding-top:5px;" >
						
						
						<input type="hidden" '.$stat.' class="" '.$fx.' id="chkk_serie_'.$row['clave_lego'].'_'.$user.'" value="'.$status_admin.'" '.$val.'> 
							
						<div class="row" >
							<span class="text-secondary" title="Solo el usuario puede seleccionar la serie."  style="padding:2px 3px; font-size:18px; text-align:center; width:10%"> 	
							<i class="'.$ico_user_select .'"></i></span>
													
							
							<button class="btn '.$btn_style.' " id="'.$row['clave_lego'].'_'.$user.'" onclick="valida_permiso(this.id);" 
							style="padding:0px 2px; font-size:11px; text-align:center; width:10%; " value="'.$status_admin.'" > 	<i class="fa fa-'.$per_icon.'"></i></button>
							
							<span style="font-size:13px; margin-left:3px; margin-top:5px;  " class="'.$text.'" > '.$row['clave_lego'].' - '.$row['nombre'].' '.$ico_info .'</span>
						</div>
													
				    </div>
				';
							
				
				}
				
			  
			}
		}
		
		$forms = $forms.'<input type="hidden" id="current_series_op_'.$user.'" value="'.$series_op.'" >';
		
		return $forms; 
		//return $qs;
	$dbh->close();


}




///////////////////////////// 

function get_tipo_serie($clave_lego){

include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
		
	$qb = "SELECT * FROM series where clave_lego = '$clave_lego'";// preparando la instruccion sql

		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['tipo']; 
	    	
	    
	    }else{
		    $data = '0'; 
	    }
	    

	return $data; 
	$dbhb->close();
		  


}
///////////////////////////  


function labels_admin_logos(){
	
	$options = logos_temas();
				   			
				   			$data_opt = explode('--', $options); 
				   			
				   			for($i=0; $i<= count($data_opt); $i++){
					   			if($data_opt[$i] != ''){
						   			
						   			$data_file = explode('.',$data_opt[$i]); 
						   			$nombre = $data_file[0];
						   			$ext = $data_file[1];
						   			
						   			$caracter = substr($nombre, -1);
						   			
						   			if($caracter == '_'){
							   			$class= 'inverse-warning';
							   			$classb = 'warning'; 
							   			$btn_elimina = '<button class="btn btn-'.$classb.' float-right text-neutral" onclick="elimina_logo(\''.$data_opt[$i].'\');" > <i class="fa fa-trash" ></i></button>';
							   			$ico = 'arrow-circle-up'; 
							   			$ico_lock = '';
							   			
						   			}else{
							   			$btn_elimina = ''; 
							   			$class= '';
							   			$classb = 'light'; 
							   			$ico = 'image'; 
							   			$ico_lock = '<span class="text-clear" ><small><i class="fa fa-lock" ></i></small> </span>'; 
						   			}
						   			
						   			
						   			// Extrae el nombre de la figura basado en el SKU
						   			$info_fig = get_data($serie.'-'.$nombre,$index);
						   			$data_fig = explode('/', $info_fig); 
						   			$nombre_es = $data_fig[0];
	
					   			$labels .= '
					   			<div class="btn-group " role="group" style="display: block; " >
                            
						   			<span class="btn btn-'.$class.'" id="" onclick="preview_logo(\''.$data_opt[$i].'\'); " >
						   			<span class="" "> <i class="fa fa-'.$ico.'" ></i> '.$ico_lock.' '.$data_opt[$i].'  </span>  
						   			<span class="text-neutral"></span>
						   			</span>
						   			</span>
						   			
						   			
						   			<button onclick="preview_logo(\''.$data_opt[$i].'\'); " class="btn btn-'.$classb.' float-right text-neutral" > <i class="fa fa-eye" ></i> </button>
						   			'.$btn_elimina.'
						   			
					   			</div>
					   			';
					   			}					   			
					   			
				   			}
				   			
				   			return $labels; 
	
}

////////////////////

function generaListPaginas(){

	include("access.php");
	
	
	$current_pag_inicial = $GLOBALS['user_pag_inicial_nom']; 
	$perfil_user = $GLOBALS['user_perfil'];
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	
		$q = "SELECT * FROM menus where nivel <= 2 and estado = 1 order by orden ";// preparando la instruccion sql
		

	
	//var_dump($q);
//	$q = "SELECT * FROM menus where nivel <= 2 and estado = 1 order by orden ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row = $result->fetch_assoc()){
	                        
	                        	//$permit = valida_permiso_perfil($row['id'],$perfil_user);
	                        	$permit = get_permiso_pagina($row['id'],$perfil_user); // id pag, id user
	                        	
	                        	if($permit==1){

		                        	if($row['nombre'] == $current_pag_inicial){
										$opt .= '<option selected value="'.$row['nombre'].'">'. $row['id'].'. '.$row['title'].'</option>';
									}else{
			                         	$opt .= '<option value="'.$row['nombre'].'">'.$row['id'].'. '.$row['title'].'</option>';
			                        }
		                        	                        	
	                        	}else{
		                        	$opt .='';
	                        	}
	                        
	                        

	                    }
	            }
	
	//$data = $total_serie; 
	return $opt; 
	$dbhb->close();	
	
	
	
}
/////////////////////////////
function generaListPaginas_principal(){

	include("access.php");
	
	
	$current_pag_inicial = $GLOBALS['user_pag_inicial_nom']; 
	$perfil_user = $GLOBALS['user_perfil'];
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	
		$q = "SELECT * FROM menus where nivel = 1 and mnu_padre = 0 and estado = 1 order by orden ";// preparando la instruccion sql
		

	
	//var_dump($q);
//	$q = "SELECT * FROM menus where nivel <= 2 and estado = 1 order by orden ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row = $result->fetch_assoc()){
	                        
	                        	//$permit = valida_permiso_perfil($row['id'],$perfil_user);
	                        	$permit = get_permiso_pagina($row['id'],$perfil_user); // id pag, id user
	                        	
	                        	if($permit==1){

		                        	if($row['nombre'] == $current_pag_inicial){
										$opt .= '<option selected value="'.$row['nombre'].'">'. $row['id'].'. '.$row['title'].'</option>';
									}else{
			                         	$opt .= '<option value="'.$row['nombre'].'">'.$row['id'].'. '.$row['title'].'</option>';
			                        }
		                        	                        	
	                        	}else{
		                        	$opt .='';
	                        	}
	                        
	                        

	                    }
	            }
	
	//$data = $total_serie; 
	return $opt; 
	$dbhb->close();	
	
	
	
}
///////////////////////

function generaListIdiomas(){

	include("access.php");
	
	
	$current_idioma = $GLOBALS['user_idioma']; 
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM idiomas where estado = 1 ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row = $result->fetch_assoc()){
	                        	if($row['cve_idioma'] == $current_idioma){
									$opt .= '<option selected value="'.$row['cve_idioma'].'">'. $row['nombre'].'</option>';
								}else{
		                         	$opt .= '<option value="'.$row['cve_idioma'].'">'.$row['nombre'].'</option>';
		                        }
	                    }
	            }
	
	//$data = $total_serie; 
	return $opt; 
	$dbhb->close();	
	
	
	
}
////////////////////

function generaListVistas($seccion){

	include("access.php");
	
	
	 
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	if($seccion == 1){
		$current_vista_m = $GLOBALS['user_vista_m'];
	}else{
		$current_vista_s = $GLOBALS['user_vista_s'];
	}
	
	$q = "SELECT * FROM vistas_mosaico where estado = 1 ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row = $result->fetch_assoc()){
	                        

							if($seccion == 1){

	                        	if($row['tam_col'] == $current_vista_m ){
									$opt .= '<option selected value="'.$row['tam_col'].'">'. $row['nombre'].'</option>';
								}else{
		                         	$opt .= '<option value="'.$row['tam_col'].'">'.$row['nombre'].'</option>';
		                        }
		                        								
							}else{
	                        	if($row['tam_col'] == $current_vista_s ){
									$opt .= '<option selected value="'.$row['tam_col'].'">'. $row['nombre'].'</option>';
								}else{
		                         	$opt .= '<option value="'.$row['tam_col'].'">'.$row['nombre'].'</option>';
		                        }								
							}	                        

	                    }
	            }
	
	//$data = $total_serie; 
	return $opt; 
	$dbhb->close();	
	
	
	
}

///////////////////////

function quita_acento($cadena){
	
		$cadena = str_replace(
		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
		array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
		$cadena);
 
		//Reemplazamos la E y e
		$cadena = str_replace(
		array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
		array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
		$cadena);
 
		//Reemplazamos la I y i
		$cadena = str_replace(
		array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
		array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
		$cadena);
 
		//Reemplazamos la O y o
		$cadena = str_replace(
		array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
		array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
		$cadena);
 
		//Reemplazamos la U y u
		$cadena = str_replace(
		array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
		array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
		$cadena);
		
		return $cadena; 
}


////// Obtiene el estatus de las series opcionales


function get_status_custom_series_opcional($user){

include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
		
	$qb = "SELECT * FROM configuraciones where id_user = $user";// preparando la instruccion sql

		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['estado_opcionales']; 
	    	
	    
	    }else{
		    $data = '0'; 
	    }
	    

	return $data; 
	$dbhb->close();
		  


}
///////////////////////////

function get_estado_serie_opcional($serie, $user){
	

include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM series where clave_lego = '$serie'";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	$tipo = $row['tipo']; 
	    }else{
		    $tipo = 0; 
	    }
	    
	    
	    if($tipo == 3){ //si la serie es opcional
		    
		///// Busca las series opcionales en las preferencias del usuario
		
			$qp = "SELECT * FROM configuraciones where id_user = $user";// preparando la instruccion sql
			$resultp= $dbh->query($qp);
	    
	    	if ($resultp->num_rows > 0) {
		    	$rowp= $resultp->fetch_assoc();
		    	$opcionales = $rowp['estado_opcionales']; 
		    }else{
			    $opcionales = '0-0;'; 
		    }
		    
		    $data_opcionales = explode(';', $opcionales);
		    $tamanio_opcionales = count($data_opcionales);
		    
		    if($tamanio_opcionales > 1){ 
			  //  $visible = 0;
			    for($i=0;$i< $tamanio_opcionales; $i++){
					$data_op_cust = explode('-', $data_opcionales[$i]);
					$cust_serie = $data_op_cust[0];
					$cust_edo = $data_op_cust[1];


					if($serie == $cust_serie){
						                        
						if($cust_edo==1){
							$visible = $visible + 1;
						}else if($cust_edo==0){
							$visible = $visible + 0;
						}
						                        
					}else{
						$visible = $visible + 0; 				                        
					}				    
			    }
	///
	
		    
		    }else{
			    $visible = 0;
		    }
		
		/////	    
		    
	    }elseif($tipo==1){ // si la serie es consecutiva
		    
		    //evalua que tipo de serie es para ver si se muestra
		    if($row['estado']==0){ // oculto
			    $visible = 0;
		    }elseif($row['estado']==1){ // visible
			    $visible = 1;
		    }elseif($row['estado']==2){ // borrador 
			    $visible = 0;
		    }elseif($row['estado']==3){ // teaser
			    $visible = 0;
		    }else{
				$visible = 0;
			}
		    
	    }elseif($tipo==2){ // si la serie es tematica
		    //$visible = 1;

		    //evalua que tipo de serie es para ver si se muestra
		    if($row['estado']==0){ // oculto
			    $visible = 0;
		    }elseif($row['estado']==1){ // visible
			    $visible = 1;
		    }elseif($row['estado']==2){ // borrador 
			    $visible = 0;
		    }elseif($row['estado']==3){ // teaser
			    $visible = 0;
		    }else{
				$visible = 0;
			}
		    
	    }else{ // si la serie es otro tipo (incluyendo 0: no se encontraron registros)
		  //  $visible = 0;
		    
		    //evalua que tipo de serie es para ver si se muestra
		    if($row['estado']==0){ // oculto
			    $visible = 0;
		    }elseif($row['estado']==1){ // visible
			    $visible = 1;
		    }elseif($row['estado']==2){ // borrador 
			    $visible = 0;
		    }elseif($row['estado']==3){ // teaser
			    $visible = 0;
		    }else{
				$visible = 0;
			}
	    }

	
	
	
	
	return $visible; 
	$dbhb->close();
	
	
	
	
}



function rrmdir($src) {
    $dir = opendir($src);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            $full = $src . '/' . $file;
            if ( is_dir($full) ) {
                rrmdir($full);
            }
            else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    rmdir($src);
}


function get_users_serie($serie){

include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM coleccion where clave_lego = $serie and estado = 1 GROUP BY id_user order by id_user";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	
	    	$ant = ''; 
	    	$current = ''; 
	    	
	    	$tot = $resultb->num_rows;
			while($row= $resultb->fetch_assoc()){


			$item = $row['id_user'].';'.$row['clave_lego'];
			$total_fig = busca_info_coleccion($item);
							
				$current = $row['id_user'];
				//$id_user = $row['id_user'];
				
				if($tot== 1){
					$txt_label = 'Figura';
					
				}else{
					$txt_label = 'Figuras';
				}
				
				if($ant != $current){
				
					$data_user = busca_user($row['id_user']); 													
					$info = explode('--', $data_user); 
					$error =  $info[0];
					$nombre = $info[1];
					$correo = $info[2];
					$username = $info[3];
					$foto = $info[4];
													
					if($username!= ''){
						//$usuarios .= '<span class="text-muted border-bottom" style="display: block; clear:both; margin: 1px 0px;  " >
						//	<i class="fa fa-user" ></i> '.$username.' 
						//	</span>';
							
						$link = $link_site.'?mnu=2e14b8f9a6750c809f85780adef0dfc0&obj='.$row['clave_lego'].'&mdl=1&cmd=1&q='.$row['id_user'];
						$usuarios .= '
							<div id="user_'.$row['id_user'].'" class="col-sm-12 row hold_perfil border'.$class_tarjeta.'">
								<div class="foto_perfil">
									<img class="img-sm rounded-circle" src="assets/images/faces/profile/'.$foto.'" alt="profile image">
								</div>
								<div class="hold_info_sm">
									<h5 class="text-muted" > <strong>@'.$username.'</strong>
										<p> <span class="ico_disp">
											<i class="fa fa-circle" ></i></span> 
											<span class="text-muted">'.$total_fig .' '.$txt_label.'</span>
										</p>
									<span class="no-show">'.$req_user.'-'.$row['id_user'].'</span>
									</h5>
								</div>
								<div class="hold_link " >
											<a href="'.$link.'" class="text-mutted " >
												<i class="fas fa-chevron-right "></i>
											</a>
								</div>
							</div>
						';
					}
					
					$ant = $current;
				}else{
					$usuarios .= '';
					$ant = $current;
				}
									
			}
	    	 
	    	 $query = '<div id="user_'.$row['id_user'].'" class="col-sm-12 row hold_perfil border'.$class_tarjeta.'">'.$qb.'</div>';
			 
	    }else{ // si no existe el registro de usuario con esa minifigura, regresa un valor comodin ara generar la lista de elementos
		    $usuarios .= '
		    <div class="col-md-12 row hold_serie" style="margin-left: 10px; ">
		    <span class="text-muted " style="display: block; clear:both; margin: 1px 0px;  " > Ningún coleccionista ha registrado figuras de esta serie. </span>
		    </div>
		    ';
	    }

 return $usuarios;
}


/////////////////////


function get_coleccion_user($serie, $user){
	
	
	include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM coleccion where clave_lego = $serie and id_user = $user and estado = 1;";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	   
	    	$num = 0; 
	    	$tot = $resultb->num_rows;
			while($row= $resultb->fetch_assoc()){
			

				$num= $num+ 1;
					$fig_info = get_data($row['item'],$index);
					$data_fig = explode('/', $fig_info);
					$nombre_es = $data_fig[0];
					$nombre_en = $data_fig[1];
					$imagen= $data_fig[2];
					$cve_lego = $data_fig[3];

					$fecha = formatFecha($row['fecha_registro']);
						$coleccion .= '					
							<div id="serie_'.$row['id_user'].'" class="col-md-12 row hold_serie" style="  ">
								
								<div class="foto_perfil" style="width:20%;"> 
								<span class="text-muted" style="width: 5%; margin-right:10px;  ">'.$num.'</span>
									<img class=" ico_imagen" style="left:22px; margin-top: 5px; max-height: 45px;" src="minifig/'.$row['clave_lego'].'/'.$imagen.'.png" alt="'.$nombre_es.'">
								</div>
								<div class="hold_info">
									<h4 class="text-muted" style="font-size: 16px; "> <b>'.$nombre_es.'</b>
										<p class="text-muted "> 
											
											<span class="text-neutral" > <i class="fa fa-calendar"></i> </span>  
											<span>
												'.$fecha.'
											</span>
										</p>
									<span class="no-show"> </span>
									</h4>
								</div>

								<div class="hold_link" >
								</div>
							</div>
						';			
			}
		
		 $coleccion .= $coleccion . '<div clas="col-md-12" style="height:20px;"></div>';	
		}else{
				if($user==''){
                    $coleccion = '
                    <div class="col-md-12 p-2 center " style="margin-left: 10px; ">
                    <span> Seleciona un usuario </span><br> <span>'.$qb.'</span>
                    </div>
                    ';
                }else{
                    $coleccion = '
                    <div class="col-md-12 p-2 center " style="margin-left: 10px; ">
                    <span> Este Coleccionista no ha registrado figuras de esta serie. </span><br> <span>'.$qb.'</span>
                    </div>
                    ';
                }

		}
	return $coleccion;
}


//// function 

function get_status_premium($serie){

include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
		
	$qb = "SELECT * FROM series where clave_lego  = '$serie' ";// preparando la instruccion sql
	
	//var_dump($qb);

		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['premium']; 
	    	
	    
	    }else{
		    $data = '0'; 
	    }
	    

	return $data; 
	$dbhb->close();	
	
	
}

/////////////////


function get_status_pago($serie, $id_user){
	
include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
		
	$qb = "SELECT * FROM transactions where clave_lego = $serie and estado = 1 and id_user = $id_user ";// preparando la instruccion sql

//var_dump($qb);
		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['estado_pago']; 
	    	
	    
	    }else{
		    $data = '0'; 
	    }
	    

	return $data; 
	$dbh->close();		
	
}




function form_paypal($cve,$precio,$moneda){
	
switch($cve){
	
	
	default:

	$form ='

	<div id="smart-button-container">
      <div style="text-align: center;">
        <div id="paypal-button-container"></div>
      </div>
    </div>
  <script src="https://www.paypal.com/sdk/js?client-id=AcvAbVNK76MwfgWp1Eb72Fy-9DMo2Ee6Q4vx_50Vup17UVtznB8uDHe_y801MiycA0wwv78g_bvD9H3o&enable-funding=venmo&currency='.$moneda.'" data-sdk-integration-source="button-factory"></script>
  <script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: \'rect\',
          color: \'blue\',
          layout: \'horizontal\',
          label: \'donate\',
          
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"Donativo Serie Premium - '.$cve.'","amount":{"currency_code":"'.$moneda.'","value":'.$precio.',"breakdown":{"item_total":{"currency_code":"'.$moneda.'","value":'.$precio.'}}},"items":[{"name":"'.$cve.'","unit_amount":{"currency_code":"'.$moneda.'","value":'.$precio.'},"quantity":"1","category":"DONATION"}]}]
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            
            // Full available details
           // console.log(\'Capture result\', orderData, JSON.stringify(orderData, null, 2));
            
            decode_result_paypal(orderData);

            // Show a success message within this page, e.g.
          // const element = document.getElementById(\'paypal-button-container\');
          // element.innerHTML = \'\';
          // element.innerHTML = \'<h3>!Gracias, espera un momento!</h3>\';

            // Or go to another URL:  actions.redirect(\'thank_you.html\');
             actions.redirect(\'http://shelf.bricksidemx.com/collector/index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6&ref='.$cve.'&cve=1\');
            
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render(\'#paypal-button-container\');
    }
    initPayPalButton();
  </script>
  
    ';
    
    break;

}

	return $form;
}




//////

function genera_recibos($id_user){
	
include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		

$current = ''; 
$ant = '';
		
	$qb = "SELECT * FROM recibos where id_user = $id_user and estado_recibo < 90 order by nombre_prod, id asc ";// preparando la instruccion sql

//var_dump($qb);
		$n=0;
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
			while($row= $resultb->fetch_assoc()){
				
				$n = $n+1;
				$data_color = get_info_serie($row['nombre_prod']);
	                        
	            $data = explode('/', $data_color);
	                        
	            $nombre_serie = $data[0];
	            $color_serie = $data[1];
	            $fecha_serie = $data[2];
	            $precio_serie = $data[4];
	            $moneda_serie = $data[5];
						
						$current = $row['nombre_prod'];
						//$ant = $row['nombre_prod'];
						
				if($current != $ant){
					$reciboss .= '<hr>';
				}
						
						$fecha = formatFechaHoraTable($row['fecha_venta']);
						
						if($row['estado_recibo'] == 1){
							$ico_estado = '<span class="text-success" style="margin-top:15px;"> <i class="fas fa-receipt"></i></span>'; 
							
							$hover = '';
							$info = '<span class="text-neutral" > <i class="fa fa-calendar"></i> '.$fecha.'</span> ';
							
						}elseif($row['estado_recibo'] == 0){
							$ico_estado = '<span class="text-danger" style="margin-top:15px;"> <i class="fas fa-receipt"></i></span>'; 
							
							$hover = '';
							 
							$info = '<span class="text-danger"> Cancelado </span>';
						}elseif($row['estado_recibo'] == 2){
							$ico_estado = '<span class="text-warning" style="margin-top:15px;"> <i class="fas fa-receipt"></i></span>'; 
							
							$hover = '';
							 
							$info = '<span class="text-danger"> Pendiente </span>';
						}elseif($row['estado_recibo'] == 3){
							
							$ico_estado = '<span class="text-info" style="margin-top:15px;"> <i class="fas fa-receipt"></i></span>'; 
							$hover = '';
							$info = '<span class="text-info"> Devuelto </span>';
						}
						
						$url= $link_site.'modal_detalle_recibo.php?qry='.$row['id'].'&res='.$GLOBALS['user'];
						$venatana_detalle = 'javascript:ventanaSecundaria(\''.$url.'\')';


						$btn_archivar = '<button type="button" onclick="archivar_recibo(\''.$row['id'].'\');" class="btn btn-inverse-primary btn_thin"> <i class="fa-solid fa-box-archive"></i> </button>'; 
						
						//<a href="'.$link_site.'?mnu=9019cbe4458150159d9cc2f1cd473cf1&ma=4&mb=42&mdl=1&cmd=1&qry='.$row['id'].'" style="z-index: 1000;"> Ver detalles </a> 

						
						$reciboss .= '					
							<div id="recibo_'.$row['id'].'" class="col-md-12 row hold_serie" style="  ">
								
								'.$hover.'
								
								<div class="foto_perfil" style="width:20%; margin-top:20px;"> 
									<span class="text-muted no-show" style="width: 5%; margin-right:10px;  ">'.$row['id'].'</span>
									<span> '.$ico_estado.'</span>
								</div>
								
								<div class="hold_info" style="width:80%;">
									<h4 style="font-size: 16px; " class="text-muted"> <b>'.$nombre_serie.'</b>
										<p class="text-muted "> 
											<span> '.$row['descripcion_prod'].'</span><br>
											 
											<span style="font-size:10px; ">
												'.$info.' - <a href="'.$venatana_detalle.'" style="z-index: 1000;"> Ver detalles </a> 
											</span><br>
											<span style="font-size:10px; ">'.$row['id_recibo'].'</span>
										</p>
									<span class="no-show"> </span>
									</h4>
								</div>
								<div class="hold_link" >
								</div>
							</div>
						';	

						$recibos .='
							<tr>
								<td> <span class="text-muted" style="font-size:0.8rem;">'.$n.'</span> </td>
								<td> 
								<span style="font-size:0.8rem; " class="text-muted"> <b>'.$nombre_serie.'</b> </span> <br>
								<span style="font-size:0.6rem; " class="text-muted"> '.$row['descripcion_prod'].'</span> <br>
									
									<span class="text-muted" style="font-size:0.6rem">'.$row['id'].' | </span> 									
									<span class="text-muted" style="font-size:0.6rem">'.$row['id_recibo'].'</span>
									<a class="text-primary" href="'.$venatana_detalle.'" style="font-size:0.5rem;"> Detalles </a>
								
								</td>
								<td>
									<span class="text-muted" style="font-size:0.7rem;; "> $'.$row['precio_prod'].' '.$row['moneda_prod'].'</span>
								</td>
								<td>
									'.$info.'
								</td>
								<td>  '.$btn_archivar.'</td>
							</tr>
						'; 
						
						$ant = $row['nombre_prod'];
						$current = '';
						

				
				 
				
				
				//$current = ''; 
			
			}    	
	    
	    }else{
		   $recibos = '<span class="col-md-12 text-muted" ><i class="far fa-sad-tear" > </i> No hay recibos registrados </span>'; 
	    }
	    
		$tabla = '
		<table class="table table-striped">
						<thead>
							<tr>
								<th class="thead_content" colspan="2">No Recibo </th>
								<th class="thead_content" > Cantidad</th>
								<th class="thead_content" > Estado</th>
								
								<th class="thead_content"> Opciones </th>
							</tr>
						</thead> 
						<tbody>'.$recibos.'
						</tbody>

						<tfooter>
						</tfooter>
					</table>';

	return $tabla; 
	$dbhb->close();		
	
}


///////////


function get_recibo($id_recibo,$id_user){

include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
		
	$qb = "SELECT * FROM recibos where id = $id_recibo and id_user = $id_user ";// preparando la instruccion sql

	
		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	//id, id_recibo, id_user, id_venta, fecha_venta, cantidad_prod, nombre_prod, descripcion_prod, precio_prod, moneda_prod, nombre_comp, correo_comp, telefono_comp, id_pago, estado_recibo 
	    	$data = '1;'.$row['id'].';'.$row['id_recibo'].';'.$row['id_user'].';'.$row['id_venta'].';'.formatFecha($row['fecha_venta']).';'.$row['cantidad_prod'].';'.$row['nombre_prod'].';'.$row['descripcion_prod'].';'.$row['precio_prod'].';'.$row['moneda_prod'].';'.$row['nombre_comp'].';'.$row['correo_comp'].';'.$row['telefono_comp'].';'.$row['id_pago'].';'.$row['estado_recibo']; 
	    	
	    
	    }else{
		    $data = '0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0'; 
	    }
	    
//var_dump($qb);

	return $data; 
	$dbhb->close();		
	
}


//// Comprueba Imagen 

function comprueba_image($imagen,$tipo){
	
	
	switch ($tipo){
		
		case 'portada':
		
		//comprueba imagen para pprtada minimal 
		$file = 'assets/images/portada_serie/'.$imagen.'.jpg';
								
			if(file_exists($file)) {
								       //echo "The file exists";
				$foto = $imagen.'.jpg';
			} else {
									
				if(file_exists('assets/images/portada_serie/'.$imagen.'.jpeg')){
										//echo "The file exists";
				$foto= $imagen.'.jpeg';
			}else{
								    //echo "The file does not exist";
								    	//$foto_portada = '0.png';	
				if(file_exists('assets/images/portada_serie/'.$imagen.'.png')){
												//echo "The file exists";
					$foto= $imagen.'.png';
				}else{
										    //echo "The file does not exist";
					$foto = '0.png';			
				}								    	
								    			
			}
		}		                    
		                    /////			
		case 'set':
		
		//comprueba imagen para pprtada minimal 
		$path_serie= 'assets/images/sets/'; 
		
        $file = $path_serie.$imagen.'.webp';
								
			if(file_exists($file)) {
								       //echo "The file exists";
				$foto = $imagen.'.webp';
			} else {
									
				if(file_exists($path_serie.$imagen.'.jpeg')){
										//echo "The file exists";
				$foto= $imagen.'.jpeg';
			    
                }else{
                    
                    if(file_exists($path_serie.$imagen.'.png')){
                                                    //echo "The file exists";
                        $foto= $imagen.'.png';
                    }else{
                                                //echo "The file does not exist";
                        if(file_exists($path_serie.$imagen.'.jpg')){
                                                        //echo "The file exists";
                            $foto= $imagen.'.jpg';
                        }else{
                                                    //echo "The file does not exist";
                            $foto = 'noimage.png';			
                        }				
                    }								    	
								    			
			}
		}			
		
		
		break;
		
		default:
		
		break; 	
	}

		return $foto;
}


//////////

function get_balance($serie){
include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
	/// ULTIMOS MOVIMIENTOS 	
	$qb = "SELECT * FROM recibos where nombre_prod = '$serie' order by fecha_venta desc  ";// preparando la instruccion sql

//var_dump($qb);
		
    $resultb= $dbh->query($qb);
	$n = 0; 
    
    	if ($resultb->num_rows > 0) {
			while($row= $resultb->fetch_assoc()){
				 $n = $n+1;
				if($count < 10){
					
					$user_info = busca_user($row['id_user']);
					$data_user = explode('--', $user_info);
					$error = $data_user[0];
					$nombre = $data_user[1];
					$correo = $data_user[2];
					$user_name = $data_user[3];
					$foto = $data_user[4];
					
					$movv .= '

					<div class="d-flex py-2 border-bottom">
                      <div class="wrapper">
                        <small class="text-muted"> '.formatFecha($row['fecha_venta']).' '.$row['id_recibo'].'</small>
                        <p class=" text-gray mb-0 text-small">'.$row['descripcion_prod'].'</p>
                        <small class="text-muted ml-auto"> de: @'.$user_name.'</small>
                      </div>
                      
                      <small class="text-muted ml-auto" style="width:55%; text-align:right;  height: 30px; float:right; border:0px solid #c30;">
                      $ '.money_format('%(#10n',$row['precio_prod']).' '.$row['moneda_prod'].'</small>
                      
                    </div>					
					';

					$mov.='
						<tr>
							<td> 
								<span class="text-primary" style="font-size:0.7rem"> '.$n.'. <b>'.$row['descripcion_prod'].'</b> </span><br>								
								<span class="text-muted" style="font-size:0.6rem">'.$row['id_recibo'].'</span><br>								
								<span class="text-muted" style="font-size:0.6rem">'.formatFechaHora($row['fecha_venta']).' |  </span> 								<span class="text-muted" style="font-size:0.6rem"> @'.$user_name.' </span>
							</td>							
							<td> <span class="text-muted" style="font-size:0.7rem" >  $ '.money_format('%(#10n',$row['precio_prod']).' '.$row['moneda_prod'].' </span> </td>
							
						</tr>
					
					';
					}else{
						$mov.='';
					}
									
				$count = $count +1;				
			}    	
	    
	    }else{
		    $mov = '<div class=""> 
		    <div class="wrapper">
		    	<span class="text-muted text-sm" >No hay recibos registrados </span>
		    </div>
		    </div>'; 
	    }
	    	
		$table = '
			<table class="table table-striped">
				<thead>
				</thead>

				<tbody>
				'.$mov.'
				</tbody>

				<tfooter>
				</tfooter>
			</table>
		'; 

	


	$today_month = date('m');
	$today_com = date('Y-m'.'-1');
	$today = date('Y-m-d');
	
	$qb = "SELECT * FROM recibos where nombre_prod = '$serie' and fecha_venta between '$today_com' and '$today' order by fecha_venta";// preparando la instruccion sql

//var_dump($qb);
		
    $result= $dbh->query($qb);
    
    	if ($result->num_rows > 0) {
			
			

			$aprovados = 0; 
			$cancel = 0; 
			$ingreso = 0;
						
			while($row= $result->fetch_assoc()){
			
				$total_mov = $result->num_rows;
				
				if($row['estado_recibo']==1){
					$aprovados = $aprovados + 1;
					$ingreso = $ingreso + $row['precio_prod'];
				}elseif($row['estado_recibo']==0){
					$cancel = $cancel +1;
					$ingreso_desc = $ingreso_desc - $row['precio_prod'];
				}
			}
				
				    
	    }else{
		    $recibos = '<span class="col-md-12 text-muted center" ><i class="far fa-sad-tear" > </i> No hay recibos registrados </span>'; 
	    }


	/// Balance Acumulado
	
	$today_month = date('m');
	$today_com = '1980-01-01';
	$today = date('Y-m-d');
	
	$qc = "SELECT * FROM recibos where nombre_prod = '$serie' order by fecha_venta";// preparando la instruccion sql

//var_dump($qb);
		
    $resultc= $dbh->query($qc);
    
    	if ($resultc->num_rows > 0) {
			
			$total_mov_acum = $resultc->num_rows;
			$aprovados_acum = 0; 
			$cancel_acum = 0; 
			$ingreso_acum = 0;
			
			while($rowc= $resultc->fetch_assoc()){
				if($rowc['estado_recibo']==1){
					$aprovados_acum = $aprovados_acum + 1;
					$ingreso_acum = $ingreso_acum + $rowc['precio_prod'];
				
				}elseif($rowc['estado_recibo']==0){
					$cancel_acum = $cancel_acum +1;
					$ingreso_desc_acum = ($ingreso_desc_acum - $rowc['precio_prod']);
				}
			}
				
				    
	    }else{
		    $recibos = '<span class="col-md-12 text-muted center" ><i class="far fa-sad-tear" > </i> No hay recibos registrados </span>'; 
	    }	    
	    
	
	
	$hoy = date('Y-m-d');
	$inicio_mes = date('Y-m'.'-1');
	$hoy_format = date('d-m-Y');
	// comprueba si la serie es premium
	
	/// Balance Mensual	
	$mes_current = date('m');


	for($i=0; $i<12; $i++){
		$mes_real = ($i+1);
		if($mes_current==$mes_real){
			$select_m = 'selected';
		}else{
			$select_m = '';
		}
		$mes_txt = getMonth($mes_real);
		$opt .='<option '.$select_m.' value="'.($mes_real).'"> '.strtoupper($mes_txt).'</option>';
	}

	$anio_current = date('Y');
	$anio_inicio = 2021;
	$total_anios = ($anio_current-$anio_inicio);

	for($j=0 ; $j<=$total_anios; $j++){
		$anio = $anio_inicio+$j;
		if($anio_current == $anio){
			$select = 'selected'; 
		}else{
			$select = ''; 
		}

		$op_anio .='<option '.$select.' value="'.$anio.'"> '.$anio.'</option>';
	}
	
	$panels = '
	<input type="hidden" value="'.$serie.'" id="serie_balance">
				<div class="row" style="margin:0px; padding:0px;">
					<div class="col-md-4" style=" height: 450px; padding:0px;" >
					
						<div id="hold_movimientos" class="col-12 " style="margin:0px; padding:0px; height: 467px; ">

						<div class="p-1 col-md-12  border-bottom bg-subtitle">
							<div class="col-sm-12 text-primary">
								<i class="fa-solid fa-chart-line"></i> Movimientos
							</div>
						</div>

						<div class="col-12 tool_bar" style="heigh:60px;">
							<div class="row ">
								
								<label class="col-6 text-muted" style="font-size:0.6rem;"> 
									<select id="anio_mov_1" onchange="genera_balance_mensual(1);" class="form-control">
									'.$op_anio.'
									</select>
								</label>
							
								<label class="col-6 text-muted" style="font-size:0.6rem;"> 
									<select id="mes_mov_1" onchange="genera_balance_mensual(1);"  class="form-control">'.$opt.'</select>
								</label>
							</div>
						</div>

								<div class="col-12" id="table_movs" style="margin:0px; padding:0px;height: 430px; overflow:scroll; scroll-y:auto; scroll-x:none;">							
								'.$table.'
								</div>	
						</div>
					
					</div>
					
					<div class="col-md-4 border-left" style="margin:0px; padding:0px; height: 490px; background:rgba(255,255,255,0.95);" >
						
						<div class="p-1 col-md-12  border-bottom bg-subtitle">
							<div class="col-sm-12 text-primary">
								<i class="fa-solid fa-scale-balanced"></i> Balance Mensual
							</div>
						</div>
						
						<div class="col-12 tool_bar" style="heigh:60px;">
							<div class="row ">
								
								<label class="col-6 text-muted" style="font-size:0.6rem;"> 
									<select id="anio_mov_2" onchange="genera_balance_mensual(2);" class="form-control">
									'.$op_anio.'
									</select>
								</label>
							
								<label class="col-6 text-muted" style="font-size:0.6rem;"> 
									<select id="mes_mov_2" onchange="genera_balance_mensual(2);"  class="form-control">'.$opt.'</select>
								</label>
							</div>
						</div>
						
							
						<div class="col-md-12 row border-bottom" id="rango_fechas" style="margin:0px; padding:20px 0px;">

							<div class="row col-md-6 " style="margin-left:5px;padding:0px;">
								<span class="col-1 text-muted text-small label_thin"> Del: </span>
								<span class="col-10 text-muted text-small label_thin"> '.formatFecha($inicio_mes).' </span>
							</div>	

							<div class="row col-md-6  " style="margin:0px;padding:0px;">
								<span class="col-1 text-muted text-small label_thin"> Al:</span>
								<span class="col-10 text-muted text-small label_thin"> '.formatFecha($hoy).' </span>
							</div>	
						</div>
								
						<div class="col-md-12 row " id="tots_balance" style="margin:10px 0px; padding:0px;">	
						
							<div class="col-md-6">
								<span class="col-md-12 text-muted text-small label_thin"> Ingreso :</span>
								<span class="col-md-12 text-small label_thin"> 
									<span class="text-success" style="font-size:1rem"> $'.money_format('%(#10n',$ingreso).'</span>
								</span>
							</div>
							
							<div class="col-md-6 ">
								<span class="col-md-12 text-muted text-small label_thin"> Devuelto:</span>
								<span class="col-md-12 text-small label_thin"> 
									<span class="text-danger" style="font-size:1rem"> $'.money_format('%(#10n',$ingreso_desc).'</span>
								</span>
							</div>								

						</div>	

						<div class="p-1 col-md-12  border-bottom bg-subtitle" style="margin-top:30px;">
							<div class="col-sm-12 text-primary" style="font-size:0.9rem;">
								<i class="fa fa-donate"></i> Resumen
							</div>
						</div>	

						<div class="col-md-10 row" id="movs" style="margin:0px; padding:0px;">
							
							<div class="row col-md-12 label_thin" style="margin:0px; padding:0px;">
								<span class="col-sm-9 text-primary text-small label_thin"> Movimientos:</span>
								<span class="col-sm-2 text-small label_thin">'.$total_mov.'</span>
							</div>	

							<div class="row col-md-12 border-top " style="margin:0px; padding:0px;">
								<span class="col-sm-9 text-muted text-small label_thin"> Aprobados:</span>
								<span class="col-sm-2 text-small label_thin">'.$aprovados.'</span>
							</div>																
									
							<div class="row col-md-12 border-top " style="margin:0px; padding:0px;">
								<span class="col-sm-9 text-muted text-small label_thin"> Cancelados:</span>
								<span class="col-sm-2 text-small label_thin">'.$cancel.'</span>
							</div>	
							

						</div>						
					</div>

					<div class="col-md-4 border-left" style="padding:0px; margin:0px; height: 490px; background:rgba(255,255,255,0.95);" >
						
						<div class="p-1 col-12 border-bottom bg-subtitle " style="margin:0px; padding:0px; ">
							<div class="col-12 text-primary">
								<i class="fa-solid fa-scale-balanced"></i> Balance Acumulado
							</div>
						</div>							
						
							
						<div class="col-md-12 row border-bottom" style="margin:0px; padding:0px; margin:0px; padding:20px 0px;">

							<div class="col-md-12 " style="margin:0px; padding:0px;">
								<label class="col-md-12 text-muted text-small label_thin"> Al:</label>
								<label class="col-md-12 text-small label_thin"> '.formatFecha($hoy).' </label>
							</div>	

						</div>
						
					
								
						<div class="col-md-12 row " style="margin:10px; padding:0px;">	
								
							<div class="col-md-6 ">
								<label class="col-md-12 text-muted text-small label_thin"> Total:</label>
								<label class="col-md-12 text-small label_thin"> 
									<span class="text-success" style="font-size:1rem">$'. money_format('%(#10n',$ingreso_acum).'</span> 
								</label>
							</div>
							
							<div class="col-md-6 ">
								<label class="col-md-12 text-muted text-small label_thin"> Devuelto:</label>
								<label class="col-md-12 text-small label_thin"> 
									<span class="text-danger" style="font-size:1rem">$'.money_format('%(#10n',$ingreso_desc_acum).'</span> 
								</label>
							</div>								

						</div>	


						<div class="p-1 col-md-12  border-bottom bg-subtitle" style="margin-top:30px;">
							<div class="col-sm-12 text-primary" style="font-size:0.9rem;">
								 <i class="fa fa-chart-pie"></i> Resumen
							</div>
						</div>	

						<div class="col-md-12 row " style="margin:0px; padding:0px;">
							
							<div class="row col-md-10 label_thin" style="margin:0px; padding:0px;">
								<span class="col-sm-9 text-primary text-small label_thin"> Movimientos:</span>
								<span class="col-sm-2 text-small label_thin">'.$total_mov_acum.'</span>
							</div>	

							<div class="row col-md-10 border-top " style="margin:0px; padding:0px;">
								<span class="col-sm-9 text-muted text-small label_thin"> Aprobados:</span>
								<span class="col-sm-2 text-small label_thin">'.$aprovados_acum.'</span>
							</div>																
									
							<div class="row col-md-10 border-top " style="margin:0px; padding:0px;">
								<span class="col-sm-9 text-muted text-small label_thin"> Cancelados:</span>
								<span class="col-sm-2 text-small label_thin">'.$cancel_acum.'</span>
							</div>	
							

						</div>						
					</div>		
				</div>
	'; 
	

	return $panels;
	
}


// function 

function get_month($date){
		
		
		$data = explode('-', $date);
	                        
	    $anio = $data[0]; 
	    $mes = $data[1];
	    $dia = $data[2];
		//$mes_txt = getMonth($data[1]);
							
		//$mes_txt = substr($mes_txt,0, 3);
	                        
	    //$fecha_es = strtoupper($mes_txt).' '.$anio;
	    
	    return $mes; 
	
	
}



function genera_select_moneda($id, $current, $id_serie){

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}

	
	if($id == 999 or $id == 'a'){

	$seletct= '
		<select id="s_moneda_'.$id.'" >
		
			<option value="" > Error </option>
		</select>
	';

		
	}else{


	$qc = "SELECT * FROM moneda where estado = 1";// preparando la instruccion sql
		
    $resultc= $dbh->query($qc);
    
    	if ($resultc->num_rows > 0) {			
			while($rowc= $resultc->fetch_assoc()){
				
				if($current == $rowc['clave']){
					
					$atr .= '<option selected value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
				}else{
					$atr .= '<option value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
				}

		
			}	   
			
			$seletct= '
				<select class="col-md-4 form-control" id="s_moneda_'.$id.'" onchange="quick_edit(\'1-'.$id_serie.'\')" >
				<option value="XXX" > Elije... </option>
					'.$atr.'
				</select>
			';
			 
	    }else{
		    $recibos = 'Sin Registros'; 
	    }

	}
	
	return $seletct;
}

////////////////


function genera_ops_moneda($current){

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}



	$qc = "SELECT * FROM moneda where estado = 1";// preparando la instruccion sql
		
    $resultc= $dbh->query($qc);
    
    	if ($resultc->num_rows > 0) {			
			while($rowc= $resultc->fetch_assoc()){
				
				if($current == $rowc['clave']){
					
					$atr .= '<option selected value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
				}else{
					$atr .= '<option value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
				}

		
			}	   
						 
	    }else{
		    $atr = '<option value="99" > Error </option>'; 
	    }

	
	return $atr;
}

////////////////////////

function get_ico_tipo_serie($tipo){

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}



	$qc = "SELECT * FROM tipo_serie where estado = 1 and clave = $tipo";// preparando la instruccion sql
		
    $resultc= $dbh->query($qc);
    
    	if ($resultc->num_rows > 0) {			
			$rowc= $resultc->fetch_assoc();
				
				$atr = $rowc['icono'].'|'.$rowc['nombre'].'|'.$rowc['color'];
		
		   
						 
	    }else{
		    $atr = 'fas fa-times'.'|'.'Sin Nombre | gris'; 
	    }

	
	return $atr;
		
}

//////////////////////////////

function genera_ops_tipo_serie($current){

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}



	$qc = "SELECT * FROM tipo_serie where estado = 1";// preparando la instruccion sql
		
    $resultc= $dbh->query($qc);
    
    	if ($resultc->num_rows > 0) {			
			while($rowc= $resultc->fetch_assoc()){
				
				if($current == $rowc['clave']){
					
					$atr .= '<option selected value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
				}else{
					$atr .= '<option value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
				}

		
			}	   
						 
	    }else{
		    $atr = '<option value="99" > Error </option>'; 
	    }

	
	return $atr;
}


//////////////////////////////

function genera_ops_estado_serie($current){
	//genera_ops_estado_ini_serie;

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}



	$qc = "SELECT * FROM estado_serie where estado = 1";// preparando la instruccion sql
		
    $resultc= $dbh->query($qc);
    
    	if ($resultc->num_rows > 0) {			
			while($rowc= $resultc->fetch_assoc()){
				
				if($current == $rowc['clave']){
					
					$atr .= '<option selected value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
				}else{
					$atr .= '<option value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
				}

		
			}	   
						 
	    }else{
		    $atr = '<option value="99" > Error </option>'; 
	    }

	
	return $atr;
}

//////////////////////////////


//////////////////////////////


function genera_ops_estado_ini_serie($current){

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}



	$qc = "SELECT * FROM estado_inicial_serie where estado = 1";// preparando la instruccion sql
		
    $resultc= $dbh->query($qc);
    
    	if ($resultc->num_rows > 0) {			
			while($rowc= $resultc->fetch_assoc()){
				
				if($current == $rowc['clave']){
					
					$atr .= '<option selected value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
				}else{
					$atr .= '<option value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
				}

		
			}	   
						 
	    }else{
		    $atr = '<option value="99" > Error </option>'; 
	    }

	
	return $atr;
}

//////////////////////////////

function resizeImage($original_image_data, $original_width, $original_height, $new_width, $new_height)
{
    $dst_img = ImageCreateTrueColor($new_width, $new_height);
    imagecolortransparent($dst_img, imagecolorallocate($dst_img, 0, 0, 0));
    imagecopyresampled($dst_img, $original_image_data, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
    return $dst_img;
}


//////////////


function createImageFromSource($source, $type)
{
    // JPG 
    if (preg_match('/jpg|jpeg/', $type))  $data = imagecreatefromjpeg($source);
    // PNG
    if (preg_match('/png/', $type))  $data = imagecreatefrompng($source);
    // GIF
    if (preg_match('/gif/', $type))  $data = imagecreatefromgif($source);
    
    return $data;
}


///////////////

function genera_select_origen($id, $current, $id_set){

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}

	
	$qc = "SELECT * FROM origen_set_cat where estado = 1";// preparando la instruccion sql
		
    $resultc= $dbh->query($qc);
    
    	if ($resultc->num_rows > 0) {			
			while($rowc= $resultc->fetch_assoc()){
				
				$atr .= '<option value="'.$rowc['id'].'" > '.$rowc['descripcion'].'</option>'; 
						
			}	   
			
			$seletct= '
				
					'.$atr.'
				
			';
			 
	    }else{
		    $atr = 'Sin Registros'; 
	    }

	
	
	return $seletct;
}

/////////


function generaListOrigen($origen_actual){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM origen_set_cat where estado = 1 ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['id']== $origen_actual){
		                         $opt .= '<option selected value="'.$row['id'].'">'.$row['descripcion'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$row['id'].'">'.$row['descripcion'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }


						$seletct= '<option value="0"> Elije... </option> '.$opt;
	            
	         //   $sel = $seletct;
	            
	          //  var_dump($sel);
	
	//$data = $total_serie; 
	return $seletct; 
	$dbhb->close();	
	
	
	
}



function genera_select_perfil($perfil){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM perfiles";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['estado']==0){
		                        $atr = 'disabled';
	                        }else{
		                        $atr = '';
	                        }
	                        
	                        if($row['cve_perfil']== $perfil){
		                         $opt .= '<option selected '.$atr.' value="'.$row['cve_perfil'].'">'.$row['nombre'].'</option>';
	                        }else{
		                        $opt .= '<option '.$atr.' value="'.$row['cve_perfil'].'">'.$row['nombre'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }


						$seletct= '<option value="99"> Elije... </option> '.$opt;
	            
	         //   $sel = $seletct;
	            
	          //  var_dump($sel);
	
	//$data = $total_serie; 
	return $seletct; 
	$dbhb->close();		
	
}
//////////////


function genera_select_perfil_permisos($perfil){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM perfiles";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['estado']==0){
		                        $atr = '';
	                        }else{
		                        $atr = '';
	                        }
	                        
	                        if($row['cve_perfil']== $perfil){
		                         $opt .= '<option selected '.$atr.' value="'.$row['cve_perfil'].'">'.$row['nombre'].'</option>';
	                        }else{
		                        $opt .= '<option '.$atr.' value="'.$row['cve_perfil'].'">'.$row['nombre'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }


						$seletct= '<option value="99"> Elije... </option> '.$opt;
	            
	         //   $sel = $seletct;
	            
	          //  var_dump($sel);
	
	//$data = $total_serie; 
	return $seletct; 
	$dbhb->close();		
	
}


//////

function get_info_perfil($id_perfil){

	include("access.php");

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}		
		
	$qb = "SELECT * FROM perfiles where cve_perfil = $id_perfil ";
	
		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['id'].';'.$row['nombre'].';'.$row['nombre_corto'].';'.$row['cve_perfil'].';'.$row['icono'].';'.$row['estado'].';'.$row['color'].';'.$row['fecha_registro'].';'.$row['fecha_actualizado']; 
	    	
	    
	    }else{
		    $data = '0;0;0;0;0;0'; 
	    }
	    
//var_dump($qb);

	return $data; 
	$dbhb->close();		
	
}
///////
function get_info_perfil_id($id_perfil){

	include("access.php");

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}		
		
	$qb = "SELECT * FROM perfiles where id = $id_perfil ";
	
		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['id'].';'.$row['nombre'].';'.$row['nombre_corto'].';'.$row['cve_perfil'].';'.$row['icono'].';'.$row['estado'].';'.$row['color']; 
	    	
	    
	    }else{
		    $data = '0;0;0;0;0;0'; 
	    }
	    
//var_dump($qb);

	return $data; 
	$dbhb->close();		
	
}
///////////////////////////

function get_info_user($id_user){

	include("access.php");

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}		
		
	$qb = "SELECT * FROM personal where id_user = $id_user ";
	
		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	//id, id_recibo, id_user, id_venta, fecha_venta, cantidad_prod, nombre_prod, descripcion_prod, precio_prod, moneda_prod, nombre_comp, correo_comp, telefono_comp, id_pago, estado_recibo 
	    	$data = $row['fecha_nac'].';'.$row['dir_estado'].';'.$row['dir_calle'].';'.$row['dir_no_ext'].';'.$row['dir_no_int'].';'.$row['dir_col'].';'.$row['dir_mun_del'].';'.$row['dir_extra'].';'.$row['dir_cp'].';'.$row['nombre'].';'.$row['apellido'].';'.$row['fecha_nac']; 
	    	
	    
	    }else{
		    $data = '0;0;0;0;0;0;0;0;0'; 
	    }
	    
//var_dump($qb);

	return $data; 
	$dbhb->close();	


}


//////

function genera_sugerencias($id_user){
	
include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		

$current = ''; 
$ant = '';

		
	$qb = "SELECT * FROM sugerencias where id_user = $id_user and estado < 90 and archivado = 0 order by fecha_envio asc ";// preparando la instruccion sql

//var_dump($qb);
		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	
	    	$totalsug = $resultb->num_rows ;	    	
			while($row= $resultb->fetch_assoc()){
				
			
		
				$current = $row['id'];
						//$ant = $row['nombre_prod'];
						
				if($current != $ant){
					$recibos .= '<hr>';
				}
						
						$fecha = formatFecha($row['fecha_envio']);
						$ico = 'fa-comment-dots'; 
						
						
					$data_edo_sug = get_data_estado_sug($row['estado']);

					$data_sug = explode(';', $data_edo_sug);
					$nombre_sug = $data_sug[0];
					$icono_sug = $data_sug[1];
					$color_sug = $data_sug[2];
					$avance_sug = $data_sug[3];
					$comentario_sug = $data_sug[4];
					
					$ico_estado = '<span class="text-'.$color_sug.'" style="margin-top:15px;"> <i class="fa '.$ico.'"></i></span>'; 
					$info = '<span class="text-'.$color_sug.'"> '.$nombre_sug.' </span>';
					$barra = '							
							<div class="progress">
                              <div class="progress-bar bg-'.$color_sug.'" role="progressbar" style="width:'.$avance_sug.'%" aria-valuenow="'.$avance_sug.'" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
							
							';
						


///// Estadistico 

				if($row['estado']> 0 and $row['estado'] <= 4 ){
					$sum_act = $sum_act +1;
					$btns = '<button class="col-md-12 btn btn-outline-primary btn-sm" onclick="edit_sug(\'1-'.$row['id'].'-2\')" > Cancelar </button> ';
				}else{
					$sum_act = $sum_act+0;
				}

				if($row['estado'] == 0 ){
					$sum_cancel = $sum_cancel +1;
					$btns = '<button class="col-md-12 btn btn-outline-primary btn-sm" onclick="edit_sug(\'1-'.$row['id'].'-1\')" >Archivar Sugerencia</button>';
					
				}else{
					$sum_cancel = $sum_cancel+0;
				}				

				if($row['estado'] == 5 ){
					$sum_res = $sum_res +1;
					$btns = '<button class="col-md-12 btn btn-outline-primary btn-sm" onclick="edit_sug(\'1-'.$row['id'].'-1\')" >Archivar Sugerencia</button>';
				}else{
					$sum_res = $sum_res+0;
				}	

				if($row['estado'] == 6 ){
					$sum_des = $sum_des +1;
					$btns = '<button class="col-md-12 btn btn-outline-primary btn-sm" onclick="edit_sug(\'1-'.$row['id'].'-1\')" >Archivar Sugerencia</button>';
				}else{
					$sum_des = $sum_des+0;
				}

/////
						
						if( $comentario_sug == 1 ){
							$fechar = formatFechaHora($row['fecha_respuesta']);
					
						
						if($row['respuesta'] != ''){
							
							$pos = strpos($row['respuesta'],'|');
							//var_dump($pos);
							
							if($pos === FALSE){
								
								$elem = explode('--', $row['respuesta']);
								$coment = $elem[0];
								$fecha_r = formatFechaHora($elem[1]);
								
									$li = '
									      <li class="timeline-item">
					                        <p class="timeline-content text-muted">'.$coment.'</p>
					                        <p class="event-time text-primary">'.$fecha_r.'</p>
					                      </li>
									
									';
								
								$conv = ' <ul class="timeline"> '.$li.' </ul> '; 
								
							}elseif($pos > 0){
								
								$data_res = explode('|', $row['respuesta']);
								$itera = count($data_res);
								$li = '';
									for($i=0;$i<= count($data_res);$i++){
										
										$length_itr = strlen($data_res[$i]);
										
										if($length_itr > 5){
										
										$elem = explode('--', $data_res[$i]);
										$coment = $elem[0];
										$fecha_r = formatFechaHora($elem[1]);
																			
											$li .= '
											      <li class="timeline-item">
							                        <p class="timeline-content text-sm text-muted">'.$coment.'</p>
							                        <p class="event-time text-sm text-primary">'.$fecha_r.'</p>
							                      </li>
											
											';
										}
									}	
								
								$conv = ' <ul class="timeline"> '.$li.' </ul> '; 
														
							}
						}
							
							$res = '
								<div class="border bg-light col-md-12 grid-margin" style="padding:5px 10px;">
																
									<div class="col-md-12" style="margin-top:15px;">
										<span class="text-muted text-sm" >'.$conv.'</span>
									</div>
									
									<span class="text-muted" style="font-size:10px;"> <b>@ADMIN_BS_COLLECTOR</b> </span>
									
									<p class="col-md-12" >
										<div>'.$btns.'</div>									
									</p>
								</div>
							';
														
							//<button class="col-md-12 btn btn-outline-primary btn-sm" onclick="edit_sug(\'1-'.$row['id'].'\')" >Archivar Sugerencia</button>
							
						}else{
							$res= '
								<div class="border bg-light col-md-12" style="padding:5px 10px;">
								<p class="col-md-12" style="margin:0px;" >
								'.$btns.'
									
								</p>
								</div>						
							'; 

						}
						
						
						$recibos .= '					
							
							<div id="sug_'.$row['id'].'" class="col-md-12 row hold_serie border " style="padding:0px;  ">

								<div class="col-md-12 border-bottom center" style="padding:5px;">
									<span class="text-primary" style="font-size:0.9rem; margin-left:20px;"> Folio: '.$row['folio'].'</span> 
									<span > '.$ico_estado.'</span>
								</div>

								<div class="col-md-12 border-bottom " style="margin-top:5px; padding-bottom:10px;">
									<div class="row">
										<div class="col-md-4 text-muted center" style="font-size:0.5rem;">ENVIADA</div>
										<div class="col-md-4 text-muted center" style="font-size:0.5rem;">EN REVISION</div>
										<div class="col-md-4 text-muted center" style="font-size:0.5rem;">RESULTADO</div>
									</div>
									'.$barra.'
								
								</div>

								
								<div class="col-md-12 border-bottom" style="padding:0px; margin-bottom:0px;">
									<div class="hold_info " style="width:95%; margin-left:15px; margin-bottom:5px; ">
										<span class="text-muted" style="font-size:0.9rem;"><b> '.$row['tipo'].' Serie '.$row['cve_lego'].'</b></span><br>
										<span class="text-muted" style="font-size:0.7rem;" >Enviado: '.$fecha.'</span><br>
										<a href="#" onclick="toggle(\'detalle_'.$row['id'].'\');" class="text-primary" style="font-size:0.7rem;" >Ver detalles</a>
									</div>
								</div>
											
								<div id="detalle_'.$row['id'].'" class="col-md-12 bg-muted" style="padding:0px; margin-bottom:0px; display:none;">
									
									<div class="col-md-8 bg-light" style="margin: 5px auto; height:50px; border:1px solid #d3d3d3; overflow:scroll; overflow-x:hidden; overflow-y:hidden;">
										<span class="text-muted" style="font-size:12px;">'. $row['detalles'].'</span>
										<div class="gradient_up_blanco" style="position:absolute; height: 70%; width:100%;left:0px; right:0px; bottom:0px; z-index:99; border:0px solid #c40; "></div>
									</div>

									'.$res.'
								</div>
											
								<div class="hold_link" >
								</div>
								
								
								
							</div>
						';	
						
						$ant = $row['id'];
						$current = '';
						

				
				 
				
				
				//$current = ''; 
			
			} // while
			
			$btn_mas = '<a href="#" class="col-md-12 btn btn-outline-primary no-show"  >Ver Todos los Recibos </a>'; 
			
			$recibos = '
			<div class="col-sm-12 ">
				<div class="row  ">
					<span class="col-sm-3  text-primary text-sm "> '.$sum_act.'  <i class="fa fa-circle"></i> </span>					
					<span class="col-sm-3  text-success text-sm">  '.$sum_res.'   <i class="fa fa-check-circle"></i> </span>
					<span class="col-sm-3  text-mutted text-sm"> '.$sum_cancel.'  <i class="fa fa-times"></i> </span>
					<span class="col-sm-3  text-danger text-sm">  '.$sum_des.'   <i class="fa fa-times-circle"></i> </span>
				</div
				
				
				
			 </div>'.$btn_mas.$recibos; 
			   	
	    
	    }else{
		    $recibos = '<span class="col-md-12 text-muted" ><i class="far fa-sad-tear" > </i> Aun no has enviado alguna sugerencia</span>'; 
	    }
	    

	return $recibos; 
	$dbhb->close();		
	
}


//////////////////////////////////


function genera_select_edo_sug($current){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM estado_sug where estado = 1 ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['cve']!=999){
		                        //$est = 'disabled'; 
	                        
	                        
		                        if($row['cve']== $current){
			                         $opt .= '<option selected disabled value="'.$row['cve'].'">'.$row['nombre'].'</option>';
		                        }else{
			                        $opt .= '<option '.$est.' value="'.$row['cve'].'">'.$row['nombre'].'</option>';
		                        }
		                    }
	                        
	                    }
	            }else{
		            
	            }


						$seletct= '<option value="XX"> Elije... </option> '.$opt;
	            
	         //   $sel = $seletct;
	            
	          //  var_dump($sel);
	
	//$data = $total_serie; 
	return $seletct; 
	$dbhb->close();		
	
}


///////////


function genera_select_edo_recibo($current){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM estado_recibo where estado = 1 ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['cve']== $current){
		                         $opt .= '<option selected disabled value="'.$row['cve'].'">'.$row['nombre'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$row['cve'].'">'.$row['nombre'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }


						$seletct= '<option value="XX"> Elije... </option> '.$opt;
	            
	         //   $sel = $seletct;
	            
	          //  var_dump($sel);
	
	//$data = $total_serie; 
	return $seletct; 
	$dbhb->close();		
	
}


//////////////


function get_data_estado_sug($estado){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbh->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM estado_sug where cve =$estado";// preparando la instruccion sql

	$resultb= $dbh->query($q);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['nombre'].';'.$row['icono'].';'.$row['color'].';'.$row['avance'].';'.$row['comentario'];
	    
	    }else{
		    
		    $data = '0;0;0;0;0';
	    }
	
	return $data; 
	$dbhb->close();	
	
}


function genera_select_descuento($id, $current,$id_serie){

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}

	
	if($id == 0 or $id == ''){

	$seletct= '
		<select id="s_descuento_'.$id.'" >
		
			<option value="" > Error </option>
		</select>
	';

		
	}else{


	$qc = "SELECT * FROM descuentos where estado = 1 order by cve asc";// preparando la instruccion sql
		
    $resultc= $dbh->query($qc);
    
    	if ($resultc->num_rows > 0) {			
			while($rowc= $resultc->fetch_assoc()){
				
				if($current == $rowc['cve']){
					
					$atr .= '<option selected value="'.$rowc['cve'].'" > '.$rowc['descripcion'].'</option>'; 
				}else{
					$atr .= '<option value="'.$rowc['cve'].'" > '.$rowc['descripcion'].'</option>'; 
				}

		
			}	   
			
			$seletct= '
				<select class="col-md-12 form-control form-control-lg" id="s_desc_'.$id.'" onchange="quick_edit(\'1-'.$id_serie.'\')" >
				<option value="XX" > Elije... </option>
					'.$atr.'
				</select>
			';
			 
	    }else{
	$seletct= '
		<select class="col-md-12 form-control form-control-lg " id="s_descuento_'.$id.'" >
		
			<option value="XX" > Sin Registros </option>
		</select>
	';
	    }

	}
	
	return $seletct;
}


//////////////////////////////



function get_reg_tabla($tabla){
	
include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}

// obtiene el numero de campos de la tabla

			$qcol="SHOW COLUMNS FROM $tabla";
			    
			   // $output=mysqli_query($dbh,$qcol);
			    $resultcol= $dbh->query($qcol);
			
		    
			 if ($resultcol->num_rows > 0) {
			    while($rowc= $resultcol->fetch_assoc()){			       
				       $cols .= $rowc['Field'].';';			       
			    }
		    }
		    
		    $data_cols = explode(';',$cols);
		    $tot_cols = count($data_cols);
		    
//////////
	
	if($tabla == ''){

	$info = '000/0/0/0/0';
	
	}else{


	$qc = "SELECT * FROM ".$tabla." order by id asc";// preparando la instruccion sql
		
    $resultc= $dbh->query($qc);
    
    	if ($resultc->num_rows > 0) {			
			
			while($row= $resultc->fetch_assoc()){
				
			for($i=0; $i<$tot_cols; $i++){
				
				$last = ($tot_cols-1);
				
				if($i==$last){
					$info = substr($info,0,-2);
					$info .= $row[$data_cols[$i]].'|';
				}else{
					$info .= $row[$data_cols[$i]].'--';
				}
				
				
			}
			
			
			
			//	$info .= substr($info,0,-2);
			//	$info .= ';';
				
			/*	
				switch($tabla){
					case 'moneda':
					
					$info .= $row['id'].'--'.$row['clave'].'--'.$row['nombre'].'--'.$row['valor'].'--'.$row['estado'].'--'.$row['fecha_registro'].'--'.$row['simbolo'].';';
					
					break;

					case 'estado_sug':
					
					$info .= $row['id'].'--'.$row['cve'].'--'.$row['nombre'].'--'.$row['icono'].'--'.$row['color'].'--'.$row['estado'].'--'.$row['avance'].'--'.$row['comentario'].';';
					break;
					
					case 'perfiles':
					$info .= $row['id'].'--'.$row['cve_perfil'].'--'.$row['nombre'].'--'.$row['estado'].'--'.$row['nombre_corto'].'--'.$row['icono'].'--'.$row['fecha_registro'].';';
					break;
					
					case 'descuentos':
					$info .= $row['id'].'--'.$row['cve'].'--'.$row['descripcion'].'--'.$row['estado'].';';
					break;
					
					case 'estado_recibo':
					$info .= $row['id'].'--'.$row['cve'].'--'.$row['nombre'].'--'.$row['icono'].'--'.$row['color'].'--'.$row['estado'].';';
					break;
					
					case 'idiomas':
					$info .= $row['id'].'--'.$row['nombre'].'--'.$row['cve_idioma'].'--'.$row['estado'].';';
					break;
					
					case 'origen_set_cat':
					$info .= $row['id'].'--'.$row['descripcion'].'--'.$row['clave'].'--'.$row['estado'].';';
					break;	

					case 'vistas_mosaico':
					$info .= $row['id'].'--'.$row['cve'].'--'.$row['nombre'].'--'.$row['estado'].'--'.$row['tam_col'].';';
					break;						

					case 'conf_catalogos':
					$info .= $row['id'].'--'.$row['clave'].'--'.$row['nombre'].'--'.$row['estado'].';';
					break;	

					case 'css_files_fig':
					$info .= $row['id'].'--'.$row['nombre'].'--'.$row['estado'].';';
					break;						
													
					default:
						$info .= '0--0--0--0--0;';
					break;
				}
				*/
		
			}	// while    
			
			 
			// var_dump($info);
			 
	    }else{
			$info = '00/0/0/0/0';
	    }

	}
	
	return $info;	
	
	
}


////////////////


function get_info_tabla($id){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbh->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM conf_catalogos where id =$id";// preparando la instruccion sql

	$resultb= $dbh->query($q);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['clave'].'|'.$row['nombre'].'|'.$row['icono'];
	    
	    }else{
		    
		    $data = '0|0|0';
	    }
	
	return $data; 
	$dbhb->close();	
	
}


/////////////////


function get_cols_tabla($tabla){
	
include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}

// obtiene el numero de campos de la tabla

			$qcol="SHOW COLUMNS FROM $tabla";
			    
			   // $output=mysqli_query($dbh,$qcol);
			    $resultcol= $dbh->query($qcol);
			
		    
			 if ($resultcol->num_rows > 0) {
			    while($rowc= $resultcol->fetch_assoc()){			       
				       $cols .= $rowc['Field'].'|';			       
			    }
		    }
		    
		  
		  return $cols;
		    
//////////

}


////// 


function genera_csv_minifig($id_tema, $user_id){
include("globals.php");
include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}

								
								$hoy = date("Y-m-d s");
								$hoy_format = str_replace('-', '', $hoy);
								$hoy_format = str_replace(' ', '_', $hoy_format);
								$hoy_format = str_replace(':', '', $hoy_format);
																
								$filename = 'csv_files/'.$user_id.'/'.'minifiguras_all_'.$hoy_format.'.csv';
								
								$qcol="select * from coleccion where id_user = $user_id and estado = 1 order by clave_lego";
			
/// Comprueba que la carpeta exista
								
								$path_dir = 'csv_files/'.$user_id.'/';
								$comp_dir = is_dir($path_dir);
								
								if($comp_dir == false){
									mkdir($path_dir, 0777);
								}		
								
								eliminar_directorio($path_dir);
								

							// obtiene info del usuario
							$data_u = busca_user($user_id);
							$data_user = explode('--', $data_u);
								$error = $data_user[0];
								$nombre = $data_user[1];
								$correo = $data_user[2];
								$user_name = $data_user[3];
								$foto = $data_user[4];
								$perfil = $data_user[5];
							
							////


			    $resultcol= $dbh->query($qcol);
			
		    
			 if ($resultcol->num_rows > 0) {

				    $delimiter = ","; 
				    $no = 1;
				    
				     
				    // Create a file pointer 
				    $f = fopen($filename, 'w'); 
				     
				    // Set column headers 
				    if($perfil==1){
					    $fields = array('No','Serie', 'Clave','Nombre Figura','Extras','Fecha de Registro','Imagen'); 
				    }else{
					    $fields = array('No','Serie', 'Clave','Nombre Figura','Extras','Fecha de Registro'); 
					}
				    				    
						fputcsv($f, $fields, $delimiter); 


						while($rowc= $resultcol->fetch_assoc()){	
							
							$info_serie = get_info_serie($rowc['clave_lego']);
							
							$data_info_serie = explode('/', $info_serie);
							$nombre_serie = $data_info_serie[0];
							
							$nom_fig = get_data($rowc['item'],1);
							$pic = get_data($rowc['item'],3);
							
						if($perfil==1){
					    	$foto = $path_site.'minifig/'.$rowc['clave_lego'].'/'.$pic.'.png';
					    	
							$lineData = array($no, $nombre_serie, $rowc['clave_lego'], $nom_fig, $rowc['no_extra'], $rowc['fecha_registro'], $foto); 
				    	}else{							
							$lineData = array($no, $nombre_serie, $rowc['clave_lego'], $nom_fig, $rowc['no_extra'], $rowc['fecha_registro']);
				    	}

					        fputcsv($f, $lineData, $delimiter); 				      				       
				       		 $no = $no +1;
			    		}
							// Move back to beginning of file 
					fseek($f, 0); 
     
		    }
		   return $filename;
		   fclose($f);
		  exit; 
	
}


//////// ////////////////

function genera_csv($id_tema, $user_id){
include("globals.php");
include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}

if($id_tema==999){
								$hoy = date("Y-m-d s");
								$hoy_format = str_replace('-', '', $hoy);
								$hoy_format = str_replace(' ', '_', $hoy_format);
								$hoy_format = str_replace(':', '', $hoy_format);
	
								$filename = 'csv_files/'.$user_id.'/'.'sets_all_'.$hoy_format.'.csv';
								$qcol="select * from sets where id_user = $user_id";
	
}elseif($id_tema==888){
								$info_tema = getinfotema($id_tema);
								$data_tema = explode('|', $info_tema);
								$nom_tema = strtolower($data_tema[0]);
								
								$nom_tema= str_replace(' ', '_', $nom_tema);
								
								$hoy = date("Y-m-d s");
								$hoy_format = str_replace('-', '', $hoy);
								$hoy_format = str_replace(' ', '_', $hoy_format);
								$hoy_format = str_replace(':', '', $hoy_format);
																
								$filename = 'csv_files/'.$user_id.'/'.'sets_'.$nom_tema.'_'.$hoy_format.'.csv';
								$qcol="select * from coleccion where id_tema = $id_tema and id_user = $user_id";
			
}else{
								$info_tema = getinfotema($id_tema);
								$data_tema = explode('|', $info_tema);
								$nom_tema = strtolower($data_tema[0]);
								
								$nom_tema= str_replace(' ', '_', $nom_tema);
								
								$hoy = date("Y-m-d s");
								$hoy_format = str_replace('-', '', $hoy);
								$hoy_format = str_replace(' ', '_', $hoy_format);
								$hoy_format = str_replace(':', '', $hoy_format);
																
								$filename = 'csv_files/'.$user_id.'/'.'sets_'.$nom_tema.'_'.$hoy_format.'.csv';
								
								$qcol="select * from sets where id_tema = $id_tema and id_user = $user_id";
			
}
/// Comprueba que la carpeta exista
								
								$path_dir = 'csv_files/'.$user_id.'/';
								$comp_dir = is_dir($path_dir);
								
								if($comp_dir == false){
									mkdir($path_dir, 0777);
								}		
								
								eliminar_directorio($path_dir);
								

							// obtiene info del usuario
							$data_u = busca_user($user_id);
							$data_user = explode('--', $data_u);
								$error = $data_user[0];
								$nombre = $data_user[1];
								$correo = $data_user[2];
								$user_name = $data_user[3];
								$foto = $data_user[4];
								$perfil = $data_user[5];
								
							
							////
/////

			$len_user = strlen($user_id);

				if($len_user==1){
					$nvo_user_id = '0'.$user_id;
				}else{
					$nvo_user_id = $user_id;
				}


			$len_id_serie = strlen($id_tema);
			//var_dump($len_id_serie);

				if($len_id_serie==1){
					$nvo_serie_id = '00'.$id_tema;
				}elseif($len_id_serie==2){
					$nvo_serie_id = '0'.$id_tema;
				}else{
					$nvo_serie_id = $id_tema;
				}

			//$info_tema = getinfotema($id_tema);



/////
			    $resultcol= $dbh->query($qcol);
			
		    
			 if ($resultcol->num_rows > 0) {

				    $delimiter = ","; 
				    $no = 1;
				    
				     
				    // Create a file pointer 
				    $f = fopen($filename, 'w'); 
				     
				    // Set column headers 
				    if($perfil==1){
					    $fields = array('No','Clave LEGO', 'Nombre','Tema', 'Piezas','Precio','Fecha de Registro','Barcode','Imagen'); 
				    }else{
					    $fields = array('No','Clave LEGO', 'Nombre','Tema', 'Piezas','Precio','Fecha de Registro','Barcode'); 
				    }
				    
				    fputcsv($f, $fields, $delimiter); 


						while($rowc= $resultcol->fetch_assoc()){		
							
							
							// Obtiene nombe del tema 
							$data = getinfotema($rowc['id_tema']); 
	                      
							$datab = explode('|', $data);
							
							$s_nombre = $datab[0];
							$s_color = $datab[1];
							$s_logo = $datab[2];
							/// 

			$len_cve = strlen($rowc['cve_lego']);
			//var_dump($len_id_serie);

				if($len_cve==5){
					$nvo_cve = 'BS0'.$rowc['cve_lego'];
				}elseif($len_cve==4){
					$nvo_cve = 'BS00'.$rowc['cve_lego'];
				}elseif($len_cve==3){
					$nvo_cve = 'BS000'.$rowc['cve_lego'];
				}else{
					$nvo_cve= 'BS'.$rowc['cve_lego'];
				}


				//$code_barcode = $nvo_cve.$nvo_serie_id.$nvo_user_id;

				$code_barcode = genera_barcode_codigo($rowc['cve_lego'],1,$user_id);
			//	var_dump($code_barcode);

		

				    if($perfil==1){
					    $foto = $path_site.'assets/images/sets/'.$rowc['item_foto'];
					    $lineData = array($no, $rowc['cve_lego'], $rowc['nombre'], $s_nombre, $rowc['piezas'], $rowc['precio'], $rowc['fecha_add'], $code_barcode, $foto); 
				    }else{
					    $lineData = array($no, $rowc['cve_lego'], $rowc['nombre'], $s_nombre, $rowc['piezas'], $rowc['precio'], $rowc['fecha_add'], $code_barcode);
				    }
 
							
							
					        
					         
					        fputcsv($f, $lineData, $delimiter); 				      				       
				       		 $no = $no +1;
			    		}
							// Move back to beginning of file 
					fseek($f, 0); 
     
		    }
		   return $filename;
		   fclose($f);
		  exit; 

}
///////////

function genera_csv_sets_grupo($id_grupo, $user_id){

include("globals.php");
include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}

// info grupo

$info_gpo = getinfogrupo($id_grupo);
$data_gpo = explode('|', $info_gpo);
$nombre_grupo = $data_gpo[0];

$nom_gpo= str_replace(' ','_', $nombre_grupo);
$nom_gpo = strtolower($nom_gpo);
							
								$hoy = date("Y-m-d s");
								$hoy_format = str_replace('-', '', $hoy);
								$hoy_format = str_replace(' ', '_', $hoy_format);
								$hoy_format = str_replace(':', '', $hoy_format);
																
								$filename = 'csv_files/'.$user_id.'/'.'sets_'.$nom_gpo.'_'.$hoy_format.'.csv';
								
								
								//var_dump($qcol);
			

/// Comprueba que la carpeta exista
								
								$path_dir = 'csv_files/'.$user_id.'/';
								$comp_dir = is_dir($path_dir);
								
								if($comp_dir == false){
									mkdir($path_dir, 0777);
								}		
								
								eliminar_directorio($path_dir);
								

							// obtiene info del usuario
							$data_u = busca_user($user_id);
							$data_user = explode('--', $data_u);
								$error = $data_user[0];
								$nombre = $data_user[1];
								$correo = $data_user[2];
								$user_name = $data_user[3];
								$foto = $data_user[4];
								$perfil = $data_user[5];
								
							
							////


				    // Create a file pointer 
				    $f = fopen($filename, 'w'); 
				     
				    // Set column headers 
				    if($perfil==1){
					    $fields = array('No','Clave LEGO', 'Nombre','Tema', 'Piezas','Precio', 'Estado Set','Presentacion', 'Grupo', 'Fecha de Registro','Codigo','Imagen'); 
				    }else{
					    $fields = array('No','Clave LEGO', 'Nombre','Tema', 'Piezas','Precio', 'Estado Set','Presentacion', 'Grupo', 'Fecha de Registro','Codigo'); 
				    }

				    $delimiter = ","; 

					fputcsv($f, $fields, $delimiter);

                    if($id_grupo==99){
                        $qm = ''; 
                    }else{
                            
                        $qm =' and grupo ='.$id_grupo;
                    }

				$qcol="select * from sets where id_user = $user_id".$qm;
			    
			    $resultcol= $dbh->query($qcol);
			
		    
			 if ($resultcol->num_rows > 0) {

				    
				    $no = 1;
				    
						while($rowc= $resultcol->fetch_assoc()){		
							
							
							// Obtiene nombe del tema 
							$data = getinfotema($rowc['id_tema']); 
	                      
							$datab = explode('|', $data);
							
							$s_nombre = $datab[0];
							$s_color = $datab[1];
							$s_logo = $datab[2];
							/// 


							$info_edo_set= get_info_estado_setcol($rowc['set_edo']); 
							$data_setedo= explode('|',$info_edo_set);
							$nombre_setedo = $data_setedo[1];	

				$code_barcode = genera_barcode_codigo($rowc['cve_lego'],1,$user_id);
			//	var_dump($code_barcode);

			$info_presentacion = get_info_presentacion($rowc['id_presentacion']);
            $data_presentacion = explode('|',$info_presentacion);
            $nombre_pres = $data_presentacion[1];
            $ico_pres = $data_presentacion[2];

							

							if($perfil==1){
								
								$foto = $path_site.'assets/images/sets/'.$rowc['cve_lego'].'.webp';
                                $current = $no+1;
                                //$img = 'data:image/png;base64,'.base64_encode(file_get_contents($foto));
                                $fn_exc= '=imagen("'.$foto.'")';
                               // src="data:image/png;base64,'.base64_encode(file_get_contents($url_foto)).'"
											    
								$lineData = array($no, $rowc['cve_lego'], $rowc['nombre'], $s_nombre, $rowc['piezas'], $rowc['precio'],$nombre_setedo,$nombre_pres, $nombre_grupo, $rowc['fecha_add'], $code_barcode,$fn_exc); 
							}else{
								
								$lineData = array($no, $rowc['cve_lego'], $rowc['nombre'], $s_nombre, $rowc['piezas'], $rowc['precio'],$nombre_setedo,$nombre_pres, $nombre_grupo, $rowc['fecha_add'], $code_barcode);
							
							}
 
							
							fputcsv($f, $lineData, $delimiter); 				      				       
							$no = $no +1;
							    		
			    		}// While

							// Move back to beginning of file 
					fseek($f, 0); 
     
		    }else{ // consulta 
		    	$filename = $qcol; 
		    }

		    fclose($f);
		   return $filename;
		   
		  exit; 

}

///////////


function eliminar_directorio($dir){
	$result = false;
		
		if ($handle = opendir($dir)){
			$result = true;
				
				while ((($file=readdir($handle))!==false) && ($result)){
					if ($file!='.' && $file!='..'){
						if (is_dir($dir.'/'.$file)){
							$result = eliminar_directorio($dir.'/'.$file);
						} else {
							$result = unlink($dir.'/'.$file);
						}
					}
				}
			closedir($handle);

			if ($result){
				//$result = rmdir($dir);
			}
		}
return $result;
}

///////////////////

function genera_grid_permisos($codigo_permisos){
	

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}
	
//$menus = get_cols_tabla('menus');

	$q = "SELECT * FROM menus where mnu_padre = 0 or mnu_padre > 700 order by mnu_padre desc";// preparando la instruccion sql

    $result= $dbh->query($q);
    
    	if ($result->num_rows > 0) {			
			
			while($row= $result->fetch_assoc()){
				
				///// revisa los permisos guardados 
				
				$perm = substr($codigo_permisos, 0,-1);
				
				$data_permisos = explode(';', $perm); // array
				
				$edo = 0; 
				for($i=0; $i<= count($data_permisos); $i++){
					
					$data_mnu = explode('-', $data_permisos[$i]);
					$id_mnu = $data_mnu[0];
					$estado = $data_mnu[1];
					
					if($row['id']==$id_mnu){
						$edo = $edo + 	$estado; 
					}else{
						$edo = $edo + 0;
					}
					
				}
				
				if($edo==1){
					$chk = 'checked= "" ';
				}else{
					$chk = '';
				}
				
				//
				
				$color_r = rand_color();
				$hijo = get_mnu_hijo($row['id'], $codigo_permisos, $color_r);
								
				//<i class="mdi mdi-compass icon-sm text-danger __web-inspector-hide-shortcut__"></i>
				
				if($hijo==''){
					$ico = '<a class="text-light "  style="font-size:10px;" ></a>'; 
					$line = '1px';
				}else{
					$ico = '<a class="" style="font-size:0.8 rem; color:rgba('.$color_r.',0.3); " onclick="toggle(\'group_'.$row['id'].'\');">
								<i class="fa-solid fa-square-plus"></i>
							</a>'; 
					$line = '0px';
				}

                if($row['nivel']==5){
                    $ico_mnu = '<span class="text-muted" style="font-size:0.7rem;"><i class="fa-solid fa-sliders"></i></span>';
                }else{
                    $ico_mnu='';
                }
	    	
		    	$data .= '
		    	<tr style="height: 20px; background:rgba(200,200,200,0.0);">
		    	<td class="border-bottomm" style="width:40px; height:20px; "> 
						'.$ico.' 
		    	</td>
		    	
		    	<td class="border-bottomm" style="height:15px; padding-left:3px; "> 
			    	
					<div class="form-check-flat" style="padding-bottom:3px; padding-top:3px; margin-bottom: 0px; margin-top: 0px; " >
			    		
		                <input type="checkbox" id="'.$row['id'].'" data-titulo="'.$row['title'].'"  data-padre="'.$row['mnu_padre'].'"  '.$chk.' onchange="code_permisos(\''.$row['id'].'\');" class="form-check-input" > 
		                
		                <span class="col-1 text-muted" style="font-size:0.7rem; padding:1px 2px; background:rgba(163,183,196, 0.4); margin-right:2px;" >'.$row['id'].'</span> 

                        <span class="text-muted" title="'.$row['link'].'" style="font-size:0.8rem;" > '.$ico_mnu.' '.$row['title'].' 
						</span>							 
		                
			    	</div>

		    	</td>
		    	<td style="height:20px; " ></td>
		    	</tr>';
	    
				$data .= '<tr>
                <td colspan="3"> 
                <div  style="margin-left:5px; border-left:1px solid rgba('.$color_r.',0.3);">'.get_mnu_hijo($row['id'], $codigo_permisos, $color_r).'</div> </td></tr>';
				
	    	}
	    
	    }

 $menus = '
 		<table class="col-md-12" border= "0" style="" >

 			<tbody>
 			'.$data.'
 			</tbody>
 		
 		</table>';
	
return $menus;

	
}


///////////

function get_mnu_hijo($id_padre, $permisos, $color_papa){

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}
	
//$menus = get_cols_tabla('menus');

	$qh = "SELECT * FROM menus where mnu_padre = $id_padre order by title";// preparando la instruccion sql

    $resulth= $dbh->query($qh);
    
    	if ($resulth->num_rows > 0) {	
	    	$tot_reg = 	$resulth->num_rows;	
	    	$num = 0;
			
			while($rowh= $resulth->fetch_assoc()){
				$nom = $nom +1;

				///// revisa los permisos guardados 
				
				$perm = substr($permisos, 0,-1);
				
				$data_permisos = explode(';', $perm); // array
				
				$edo = 0; 
				for($i=0; $i<= count($data_permisos); $i++){
					
					$data_mnu = explode('-', $data_permisos[$i]);
					$id_mnu = $data_mnu[0];
					$estado = $data_mnu[1];
					
					if($rowh['id']==$id_mnu){
						$edo = $edo + 	$estado; 
					}else{
						$edo = $edo + 0;
					}
					
				}
				
				if($edo==1){
					$chk = 'checked= ""';
				}else{
					$chk = '';
				}
				
				//
					
				$color_r = rand_color();
				
				$hijo = get_mnu_hijo($rowh['id'], $permisos, $color_r);
				
				if($hijo==''){
					$ico = '<a class="" style="font-size:0.8rem; z-index:99999; color:rgba('.$color_papa.',0.8);" onclick="toggle(\'group_'.$rowh['id'].'\');">
					<span style="0.8rem;"><i class="fa-solid fa-caret-right"></i></span> </a>'; 
					$line = '0px';
				}else{
					$ico = '<a class="" style="font-size:0.9rem; z-index:99999; color:rgba('.$color_r.',0.8);" onclick="toggle(\'group_'.$rowh['id'].'\');">
                                <i class="fa-regular fa-square-plus"></i>
                            </a>'; 
					
					$line = '0px';
				}
				
                if($tot_reg == $nom){
                    $border_abajo = '';

                }else{
                    $border_abajo = 'border-left: 1px solid rgba('.$color_papa.',0.9)';
                    
                }

                if($rowh['nivel']==5){
                    $ico_mnu = '<span class=""  style="border-radius:3px; text-align:center font-size:0.5rem; width: 3%; padding:2px 5px 1px 5px; background:rgba(163,183,196, 0.6); margin-right:2px;" ><i class="fa-solid fa-sliders"></i></span>';
                }else{
                    $ico_mnu='';
                }
					    	
		    	$datah .= '
		    	<tr class="col-sm-12" style="height: 20px; " >
			    	
			    				    	
			    	<td class="" style="width:35px; border:0px solid #ccc;" >
			    	
			    		<div  style="position:absolute; top:0px; height: 50%; width: 30px; border-bottom:1px solid rgba('.$color_papa.',0.9); border-left:1px solid rgba('.$color_papa.',0.9); " onclick="toggle(\'group_'.$rowh['id'].'\');" >
			    		</div>

			    		<div  style="position:absolute; top:50%; height: 50%; width: 3px%; border-top: 0px solid rgba('.$color_papa.',0.9); '.$border_abajo.' " onclick="toggle(\'group_'.$rowh['id'].'\');" >
			    		</div>
			    					    	
			    	</td>

			    	<td style="width:15px; text-align:right; border:0px solid #ccc;" > 
			    		'.$ico.'
			    	</td>
			    			    	
			    	<td style="border:0px solid #ccc; height:20px; padding-left:3px;">
				    	
				    	<div class="form-check-flat " style=" padding-bottom:5px; padding-top:5px; margin-bottom: 0px; margin-top: 0px;" >
			                <input type="checkbox" id="'.$rowh['id'].'"  data-titulo="'.$rowh['title'].'" data-padre="'.$id_padre.'" '.$chk.' onchange="code_permisos(\''.$rowh['id'].'\');" class="" >

			                <span class="col-1 text-muted" style="border-radius:3px; font-size:0.7rem; padding:1px 2px; background:rgba(163,183,196, 0.4); margin-right:2px;" >'.$rowh['id'].' </span> 

                            <span class="text-muted" style="font-size:0.8rem;" > '. $ico_mnu.' '.$rowh['title'].'</span>
				    	</div>			    	
			    	
			    	</td>
			    	

		    	</tr>
		    	
		    	';    	
		    	
		    	$datah .= '<tr><td colspan="3" style="margin-left:2px; border-left: 1px solid  rgba('.$color_papa.',0.9); " >'.get_mnu_hijo($rowh['id'], $permisos, $color_r).'</td></tr>';
				//$datah .= get_mnu_hijo($rowh['id']);
	    	
	    	}//while
				$menush = '
			 		<table id="group_'.$id_padre.'" class="col-md-12 table-cust"  border="0" style="display:block; width:100%; margin-left:10px;  " > 			
			 			'.$datah.'
			 		</table>';		    
			 	
	    }else{
		    $menush = '';
	    }

	
return $menush;

	
}

///////

function rand_color(){

$blue= rand(20,200);
$red= rand(20,200);
$green= rand(20,200);

	$color_rgb= $red.','.$green.','.$blue;
	return  $color_rgb;
	
}

//////////////

function valida_permiso_perfil($id_menu,$perfil){

//var_dump($perfil);

include("access.php");
$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbhb->connect_error) {
	   die("Connection failed: " . $dbhb->connect_error);
}
	

	$qb = "SELECT * FROM permisos_perfil where id_perfil = $perfil";// preparando la instruccion sql
    $resultb = $dbhb->query($qb);
    
    	if($resultb->num_rows > 0){
	    	$row= $resultb->fetch_assoc();
	    	
	    	$cve_permisos = $row['permisos'];
	    	$cve_permisos = substr($cve_permisos,0,-1);
	    	$data_cve_per = explode(';', $cve_permisos);
	    	
	    	for($i=0;$i<= count($data_cve_per);$i++){
					$data_mnu = explode('-', $data_cve_per[$i]);
					$id_mnu = $data_mnu[0];
					$estado = $data_mnu[1];
					
					if($id_menu==$id_mnu){
						$per_bus = $estado;
					}else{
						$per_no_bus = 0;
					}	
	    	}
	    	
	    	$bandera_item = $per_bus;  
	    
	    }else{
		    
		    $bandera_item = 0;
	    }
	
	return $bandera_item; 
	$dbhb->close();
	
}


///////////

function genera_select_tipo_menu($current){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM menus_tipo where estado = 1 ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['clave']== $current){
		                         $opt .= '<option selected disabled value="'.$row['clave'].'">'.$row['id'].'. '.$row['titulo'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$row['clave'].'">'.$row['id'].'. '.$row['titulo'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }


						$seletct= '<option value="999"> Elije... </option> '.$opt;
	            
	         //   $sel = $seletct;
	            
	          //  var_dump($sel);
	
	//$data = $total_serie; 
	return $seletct; 
	$dbhb->close();		
	
}

///////////

function genera_select_posicion_menu($current){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM menus_ubicacion where estado = 1 ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['clave']== $current){
		                         $opt .= '<option selected disabled value="'.$row['clave'].'">'.$row['titulo'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$row['clave'].'">'.$row['titulo'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }


						$seletct= '<option value="999"> Elije... </option> '.$opt;
	            
	         //   $sel = $seletct;
	            
	          //  var_dump($sel);
	
	//$data = $total_serie; 
	return $seletct; 
	$dbhb->close();		
	
}


/////////////////


function get_menu_hijo($id, $nivel){
	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	

	
$qb = "SELECT * FROM menus WHERE mnu_padre= $id order by orden asc ";// preparando la instruccion sql
							$resultb= $dbh->query($qb);
							if ($resultb->num_rows > 0) { // Si la consulta trae registro, cambia el estado
					while($rowb= $resultb->fetch_assoc()){
						
						

$mpa = $_GET['mpa'];
$mpb = $_GET['mpb'];
$mpc = $_GET['mpc'];
$mpd = $_GET['mpd'];

$vara='mpa';
$varb='mpb';
$varc='mpc';
$vard='mpd';


$bg_active = 'bg-primary'; 
$bg_inactive = 'bg-secondary'; 

	if($nivel==1){
		
		
		
		$url = $vara.'='.$mpa;
	}elseif($nivel==2){
		$url = $vara.'='.$mpa.'&'.$varb.'='.$rowb['id'];

					if($mpb== $rowb['id']){
						$bg_color = $bg_active;
						$text = 'text-light';
					}else{
						$bg_color = $bg_inactive;
						$text = 'text-muted';
					}

		
	}elseif($nivel==3){
		$url = $vara.'='.$mpa.'&'.$varb.'='.$mpb.'&'.$varc.'='.$rowb['id'];

					if($mpc== $rowb['id']){
						$bg_color = $bg_active;
						$text = 'text-light';
					}else{
						$bg_color = $bg_inactive;
						$text = 'text-muted';
					}	


	}elseif($nivel==4){
		$url = $vara.'='.$mpa.'&'.$varb.'='.$mpb.'&'.$varc.'='.$mpc.'&'.$vard.'='.$rowb['id'];	
		

					if($mpd== $rowb['id']){
						$bg_color = $bg_active;
						$text = 'text-light';
					}else{
						$bg_color = $bg_inactive;
						$text = 'text-muted';
					}		
		
	}
	
	//$url = $vara.'='.$mpa.'&'.$varb.'='.$mpb.'&'.$varc.'='.$mpc.'&'.$vard.'='.$mpd;							
					$sub = get_numero_hijos($rowb['id']);
					if($sub >0 ){

						$link_h = '
						<a  class="'.$text.' mnu_btnb btn-inverse-light" href="'.$link_site.'?mnu=81ca0b7c951be89184c130d2860a5b00&'.$url.'" >
												<i class="fa fa-chevron-right"></i>
											</a>';	
											$dots = '...';				
					}else{
						$link_h = '';	
						$dots = '';					
					}
														
		
									if($rowb['nivel']>=0){
										$posicion = '										
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Posición</label>
											<div class="col-sm-9">
												
												<!--<select class="form-control" id="nivel_'.$rowb['id'].'" >
												<option value="0">Elije...</option>
												<option value="3">Botón en título</option>
												<option value="2">Submenu</option>
												</select>-->
												
												
											<select class="form-control" id="nivel_'.$rowb['id'].'" >
												
												'.genera_select_posicion_menu($rowb['nivel']).'
												
												
												
											</select>												
												
											</div>
										</div>';
									}
								
					$estado = $rowb['estado'];
					
					if($estado==1){
					$btn_estado = '<a  class="btn btn-inverse-secondary text-neutral" onclick="estado_menu(\''.$rowb['id'].'\')" ><i class="fa fa-toggle-off"></i> </a>';
					$ico_estado = '<span class="'.$text.' mnu_btn"  onclick="estado_menu(\''.$rowb['id'].'\')" ><i class="fa fa-eye"></i></span>'; 
					}else{
					$btn_estado = '<a  class="btn btn-inverse-secondary text-neutral" onclick="estado_menu(\''.$rowb['id'].'\')" ><i class="fa fa-toggle-on"></i> </a>';
					$ico_estado = '<span class="'.$text.' mnu_btn"  onclick="estado_menu(\''.$rowb['id'].'\')" ><i class="fa fa-eye-slash"></i></span>'; 	
					}


					$perfil = $GLOBALS['user_perfil'];
					$permiso_elimina = get_permiso_config('8', $perfil);
								 
					//var_dump($perfil);
								 
					if($permiso_elimina==1){
						$btn_eliminar='<a  class="btn btn-inverse-secondary text-neutral" onclick="elimina_menu(\''.$rowb['id'].'\')"><i class="fa fa-trash"></i></a>'; 								 
					}else{
					    $btn_eliminar='<a  class="btn btn-secondary text-muted" ><i class="fa fa-trash"></i> </a> '; 
					}
					

							if($rowb['color']==''){
								//$color_txt = '255,255,255'; 
								$color_bg = fromRGB('255', '255', '255');
							}else{

							$data_coltxt = explode(',',$rowb['color']); 
	                        
	                        $r = $data_coltxt[0];
	                        $g = $data_coltxt[1];
	                        $b = $data_coltxt[2];
	                        
	                        //$color_t = 


								$color_bg = fromRGB($r, $g, $b); 
							}

						$menu .= '
									<div class="blockquote rounded" style="padding: 0px; margin-left:10px; margin-bottom:5px;  ">
									<div class="bullet_menu_l2"></div>
									
									<div class="'.$bg_color.' '.$text.'" style="padding: 5px 0 5px 10px; margin-bottom:0px; " >
									
										<h6 style="margin-bottom: 0; font-size: 12px;">
										<span style="margin-right: 3px; "><i class="fa fa-'.$rowb['icon'].'"></i></span> 
										'.$rowb['title'].''.$dots.'
											
											'.$link_h.'
											
											<a  class="'.$text.' mnu_btn" onclick="toggle(\''.'s_'.$rowb['id'].'\')" >
												<i class="fa fa-angle-down"></i>
											</a>
											
											'.$ico_estado.'
	
										</h6> 


									</div>
									
									<div class="" style="padding:0px; display:none; " id="s_'.$rowb['id'].'" >
										
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">ID</label>
											<div class="col-sm-9">
												<input disabled class="form-control" type="text" value= "'.$rowb['id'].'">
												<input  type="hidden" id="id_'.$rowb['id'].'" value= "'.$rowb['id'].'">
											</div>
										</div>	

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Nombre</label>
											<div class="col-sm-9">
												<input class="form-control" id="title_'.$rowb['id'].'" type="text" value= "'.$rowb['title'].'">
																								
											</div>
										</div>
																
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Clave</label>
											<div class="col-sm-9">
											<input class="form-control" type="text" id="cve_'.$rowb['id'].'" value= "'.$rowb['cve'].'">
											</div>
										</div>

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-2 col-form-label">Icon</label>											
											<label class="col-sm-2 col-form-label text-muted"><i class="fa fa-'.$rowb['icon'].'"></i></label>
											
											<div class="row col-sm-8">
											<input class="form-control" type="text" id="icon_'.$rowb['id'].'" value= "'.$rowb['icon'].'">
											</div>
										</div>


										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Tipo</label>
											<div class="col-sm-9">
											
											<select class="form-control" id="tipo_'.$rowb['id'].'" >
											'.genera_select_tipo_menu($rowb['tipo_menu']).'
											</select>
											
											</div>
										</div>	

																			
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Archivo</label>
											<div class="col-sm-9">
											<input class="form-control" type="text" id="file_'.$rowb['id'].'" value= "'.$rowb['link'].'">
											</div>
										</div>

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Anidado</label>
											<div class="col-sm-9">
											
											<select class="form-control" id="id_padre_'.$rowb['id'].'" >
												<option value="999">Elije...</option>
												<option value="9999">Sin Clasificar</option> 
												<option value="0">Barra Lateral</option>
												<option value="99">Op. Perfil</option> 
												'.dropmenupadre($rowb['mnu_padre']).'
											</select>
											
											<input  type="hidden" id="id_padre_original_'.$rowb['id'].'" value= "'.$rowb['mnu_padre'].'">
											</div>
										</div>	
															
										'.$posicion.'

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Orden</label>
											<div class="col-sm-9">
											
											<input class="form-control" type="number" id="orden_'.$rowb['id'].'" value= "'.$rowb['orden'].'">
											</div>
										</div>


										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Color</label>
											<div class="col-sm-9">
											
											<input class="form-control" type="color" id="color_'.$rowb['id'].'" value= "'.$color_bg.'">
											</div>
										</div>
																								
										<div class="border-top bg-light " style="margin: 10px 0 0 0; text-align:center; padding: 10px 0px;">
											<a  class="btn btn-outline-secondary text-neutral" onclick="save_menu(\''.$rowb['id'].'\')" ><i class="fa fa-save"></i> </a>
											'.$btn_eliminar.'
											'.$btn_estado.'
										</div>	
										
									</div>
									
								 </div>
								 '; 
								 
								// $menu .= getmnuchild($rowb['id']);
								 
								 $menu .= ''; 
								}
							 
							}else{
								$menu = '
									<div class="bg-light text-neutral" style="padding: 5px 0 5px 10px; margin-bottom:0px; " >
									
										<h6 style="margin-bottom: 0; font-size: 12px;"> 				
										Este menu no tiene Opciones
										</h6> 

									</div>
								'; 
							}
							
							return $menu;
	
}
/////////////////////////

function get_menu_hijo_nvo($id_current){
	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	
$nivel = 2;
	
$qb = "SELECT * FROM menus WHERE mnu_padre= $id_current order by orden asc ";// preparando la instruccion sql
							$resultb= $dbh->query($qb);
							if ($resultb->num_rows > 0) { // Si la consulta trae registro, cambia el estado
					while($rowb= $resultb->fetch_assoc()){
						
						

$mpa = $_GET['mpa'];
$mpb = $_GET['mpb'];
$mpc = $_GET['mpc'];
$mpd = $_GET['mpd'];

$vara='mpa';
$varb='mpb';
$varc='mpc';
$vard='mpd';


$bg_active = 'bg-primary'; 
$bg_inactive = 'bg-secondary'; 

	if($nivel==1){
		
		
		
		$url = $vara.'='.$mpa;
	}elseif($nivel==2){
		$url = $vara.'='.$mpa.'&'.$varb.'='.$rowb['id'];

					if($mpb== $rowb['id']){
						$bg_color = $bg_active;
						$text = 'text-light';
					}else{
						$bg_color = $bg_inactive;
						$text = 'text-muted';
					}

		
	}elseif($nivel==3){
		$url = $vara.'='.$mpa.'&'.$varb.'='.$mpb.'&'.$varc.'='.$rowb['id'];

					if($mpc== $rowb['id']){
						$bg_color = $bg_active;
						$text = 'text-light';
					}else{
						$bg_color = $bg_inactive;
						$text = 'text-muted';
					}	


	}elseif($nivel==4){
		$url = $vara.'='.$mpa.'&'.$varb.'='.$mpb.'&'.$varc.'='.$mpc.'&'.$vard.'='.$rowb['id'];	
		
					if($mpd== $rowb['id']){
						$bg_color = $bg_active;
						$text = 'text-light';
					}else{
						$bg_color = $bg_inactive;
						$text = 'text-primary';
					}		
		
	}
							
					$sub = get_numero_hijos($rowb['id']);
					if($sub >0 ){

						$link_h = '
						<a  class=" mnu_btnb btn-outline-primary" href="'.$link_site.'?mnu=81ca0b7c951be89184c130d2860a5b00&'.$url.'" >
												<i class="fa fa-chevron-right"></i>
											</a>';	
											$dots = '...';				
					}else{
						$link_h = '<span style="width:28px; height:100%; float:right; backgrund:rgba(250,250,250,0.9);">&nbsp;</span>';	
						$dots = '';					
					}
														
		
									if($rowb['nivel']>=0){
										$posicion = '										
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Posición</label>
											<div class="col-sm-9">
												
												<!--<select class="form-control" id="nivel_'.$rowb['id'].'" >
												<option value="0">Elije...</option>
												<option value="3">Botón en título</option>
												<option value="2">Submenu</option>
												</select>-->
												
												
											<select class="form-control" id="nivel_'.$rowb['id'].'" >
												
												'.genera_select_posicion_menu($rowb['nivel']).'
												
												
												
											</select>												
												
											</div>
										</div>';
									}
								
					$estado = $rowb['estado'];
					
					if($estado==1){
					    $btn_estado = '<a  class="btn btn-inverse-secondary text-neutral" onclick="estado_menu(\''.$rowb['id'].'\')" ><i class="fa fa-toggle-off"></i> </a>';
					    $ico_estado = '<span class="'.$text.' mnu_btn"  onclick="estado_menu(\''.$rowb['id'].'\')" ><i class="fa fa-eye"></i></span>';

                        $bg_color = ' bg-head ';
                        $text = 'text-primary';
					}else{
					    $btn_estado = '<a  class="btn btn-inverse-secondary text-neutral" onclick="estado_menu(\''.$rowb['id'].'\')" ><i class="fa fa-toggle-on"></i> </a>';
					    $ico_estado = '<span class="'.$text.' mnu_btn"  onclick="estado_menu(\''.$rowb['id'].'\')" ><i class="fa fa-eye-slash"></i></span>'; 

                        $bg_color = ' bg-muted ';
                        $text = 'text-clear';	
					}


					$perfil = $GLOBALS['user_perfil'];
					$permiso_elimina = get_permiso_config('8', $perfil);
								 
					//var_dump($perfil);
								 
					if($permiso_elimina==1){
						$btn_eliminar='<a  class="btn btn-outline-secondary text-neutral" onclick="elimina_menu(\''.$rowb['id'].'\')"><i class="fa fa-trash"></i></a>'; 								 
					}else{
					    $btn_eliminar='<a  class="btn btn-secondary text-muted" ><i class="fa fa-trash"></i> </a> '; 
					}
					

							if($rowb['color']==''){
								//$color_txt = '255,255,255'; 
								$color_bg = fromRGB('255', '255', '255');
							}else{

							$data_coltxt = explode(',',$rowb['color']); 
	                        
	                        $r = $data_coltxt[0];
	                        $g = $data_coltxt[1];
	                        $b = $data_coltxt[2];
	                        
	                        //$color_t = 


								$color_bg = fromRGB($r, $g, $b); 
							}

                                if($rowb['nivel']==5){
                                    $ico_mnu = '<span class="text-muted" style="border-radius:3px; font-size:0.7rem; padding:2px 3px; background:rgba(200,200,200,0.7);"><i class="fa-solid fa-sliders"></i></span>';
                                }else{
                                    $ico_mnu='';
                                }

						$menu .= '
									<div class="blockquote rounded" style="padding: 0px; margin-left:10px; margin-bottom:5px;  ">
									<div class="bullet_menu_l2"></div>
									
									<div class="'.$bg_color.' '.$text.'" style="padding: 5px 0 5px 10px; margin-bottom:0px; " >
									
										<h6 style="margin-bottom: 0; font-size: 12px;">
										<span style="margin-right: 3px; "><i class="fa fa-'.$rowb['icon'].'"></i></span>
                                        '.$ico_mnu.' 
										'.$rowb['title'].''.$dots.'
											
											'.$link_h.'
											
											<a  class="'.$text.' mnu_btn" onclick="edit_mnu(\''.$rowb['id'].'\')" >
												<span class="'.$text.'" ><i class="fa fa-pencil"></i></span>
											</a>
										</h6> 


									</div>
									
									<div class="" style="padding:0px; display:none; " id="s_'.$rowb['id'].'" >								
										
									</div>
									
								 </div>
								 '; 
								 
								// $menu .= getmnuchild($rowb['id']);
								 
								 $menu .= ''; 
								}
							 
							}else{
								$menu = '
									<div class="bg-light text-neutral" style="padding: 5px 0 5px 10px; margin-bottom:0px; " >
									
										<h6 style="margin-bottom: 0; font-size: 12px;"> 				
										Este menu no tiene Opciones
										</h6> 

									</div>
								'; 
							}
							
if(isset($mpb)){
    $info_mnu = get_info_mnu($mpb);
    $data = explode('|',$info_mnu);
    
    $id_padre = $data[1];
}else{
    $info_mnu = get_info_mnu($mpa);
    $data = explode('|',$info_mnu);
    
    $id_padre = $data[1];
}


if($id_padre!=0){

//    echo 'A-'.$id_padre;

    $mnu = $_GET['mnu'];
     $url = '?mnu='.$mnu.'&mpa='.$id_padre;

        $reg = '
                                <div class="blockquote rounded border" style="padding: 0px; margin-left:10px; margin-bottom:5px; border:0px solid #ccc;  ">
									<div class="bullet_menu_l2"></div>
                                    
                                    <div class="" style="padding: 5px 0 5px 10px; margin-bottom:0px; " >									
                                        <a class="text-primary" href="'.$link_site.$url.'">
                                            <h6 style="margin-bottom: 0; font-size: 12px;"> <i class="fa-solid fa-circle-arrow-left"></i> Anterior... </h6> 
                                        </a>


									</div>
                                </div>
        
        ';

}else{
  //  echo 'B-'.$id_padre;
    $url = '';
    $reg ='';
}



                              	



							return $reg.$menu;
	
}


/////////////

	function dropmenupadre($id_padre){
	
	require("access.php");
		$dbh= new mysqli($dbserver,$dbuser,$dbpwd, $dbname);
		//var_dump($dbpwd);
					
		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}
				
										
		$q = "SELECT * FROM menus WHERE nivel <= 3";// preparando la instruccion sql							   
		$result= $dbh->query($q);
							    
		if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
				
				//var_dump($id_padre);
				
				while($row= $result->fetch_assoc()){
					

					
					if($id_padre == $row['id']){
						$opt .= '<option selected value="'.$row['id'].'"> '.$ident.' '.$row['id'].'. '.$row['title'].' </option>';
						
					}else{
						$opt .= '<option value="'.$row['id'].'"> '.$ident.' '.$row['id'].'. '.$row['title'].' </option>';
						
					}
				
					
				}
					
		$drop = $opt;
		return $drop;
		}
	}
/////////


function get_numero_hijos($id){
	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	

	
$qb = "SELECT * FROM menus WHERE mnu_padre= $id ";// preparando la instruccion sql
							$resultb= $dbh->query($qb);
							
							if ($resultb->num_rows > 0) { // Si la consulta trae registro, cambia el estado
								$no_hijos = $resultb->num_rows;
							 
							}else{
								$no_hijos = 0;
							}
							
							return $no_hijos;
	
}

/////

	function getmenu($tipo){

	require("access.php");
		$dbh= new mysqli($dbserver,$dbuser,$dbpwd, $dbname);
		//var_dump($dbpwd);
					
		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}
		
		if($tipo == 1){
			
			$id_menu = 0;
			//$menu .= '<a>Test</a>'; 
			
			$ops = '
				<option value="999">Elije...</option>
				<option value="9999">Sin Clasificar</option> 
				<option value="0" selected >Barra Lateral</option>
				<option value="777" >Op. Perfil</option> 
			
			'; 
			
		}else if( $tipo == 2){
			$id_menu = 777;


			$ops = '
				<option value="999">Elije...</option>
				<option value="9999">Sin Clasificar</option> 
				<option value="0"  >Barra Lateral</option>
				<option value="777" selected >Op. Perfil</option> 
			
			'; 
			 
		}else if( $tipo == 3){
			$id_menu = 9999;

			$ops = '
				<option value="999">Elije...</option>
				<option value="9999" selected >Sin Clasificar</option> 
				<option value="0"  >Barra Lateral</option>
				<option value="777"  >Op. Perfil</option> 
			
			'; 
			
		}
		
					
										
		$q = "SELECT * FROM menus WHERE mnu_padre= $id_menu and nivel < 2 order by orden asc";// preparando la instruccion sql
		
		//echo $q;
							   
		$result= $dbh->query($q);
							    
			if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
				
				
				while($row= $result->fetch_assoc()){
					$id= $row['id'];
					
					
					$sub = get_numero_hijos($row['id']);
					if($sub >0 ){

						$link_h = '
						<a  class="mnu_btnb btn-inverse-primary" href="'.$link_site.'?mnu=81ca0b7c951be89184c130d2860a5b00&mpa='.$row['id'].'" >
							<i class="fa fa-chevron-right"></i>
						</a>';	
						
						$dots = '...';				
					}else{
						$link_h = '';	
						$dots = '';					
					}
					
					
					$estado = $row['estado'];
					
					if($estado==1){
					$btn_estado = '<a  class="btn btn-inverse-secondary text-neutral" onclick="estado_menu(\''.$row['id'].'\')" ><i class="fa fa-toggle-off"></i></a>';
					$ico_estado = '<span class="text-primary mnu_btn" onclick="estado_menu(\''.$row['id'].'\')"><i class="fa fa-eye"></i></span>';
					}else{
					$btn_estado = '<a  class="btn btn-inverse-secondary text-neutral" onclick="estado_menu(\''.$row['id'].'\')" ><i class="fa fa-toggle-on"></i> </a>';
					$ico_estado = '<span class="text-primary mnu_btn" onclick="estado_menu(\''.$row['id'].'\')"><i class="fa fa-eye-slash"></i></span>';	
					}

					$perfil = $GLOBALS['user_perfil'];
					$permiso_elimina = get_permiso_config('8', $perfil);
								 
					//var_dump($perfil);
								 
					if($permiso_elimina==1){
						$btn_eliminar='<a  class="btn btn-inverse-secondary text-neutral" onclick="elimina_menu(\''.$row['id'].'\')"><i class="fa fa-trash"></i></a>'; 								 
					}else{
					    $btn_eliminar='<a  class="btn btn-secondary text-muted" ><i class="fa fa-trash"></i> </a> '; 
					}

							if($row['color']==''){
								//$color_txt = '255,255,255'; 
								$color_bg = fromRGB('255', '255', '255');
							}else{

							$data_coltxt = explode(',',$row['color']); 
	                        
	                        $r = $data_coltxt[0];
	                        $g = $data_coltxt[1];
	                        $b = $data_coltxt[2];
	                        
	                        //$color_t = 


								$color_bg = fromRGB($r, $g, $b); 
							}
									
										$posicion = '										
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Posición</label>
											<div class="col-sm-9">

												<select class="form-control" id="nivel_'.$row['id'].'" >												
													'.genera_select_posicion_menu($row['nivel']).'
												</select>
											
											</div>
										</div>';
									
					
					$menu .= '<div class="blockquote rounded" style="padding: 0px;  margin-bottom: 5px; ">
								
                                <div class="bg-head text-primary " style="padding: 5px 0 5px 10px; margin-bottom:0px; " >
									
									<h6 class="mnu_bar" style="margin-bottom: 0; font-size: 12px;">
									<span style="margin-right: 3px; "><i class="fa fa-'.$row['icon'].'"></i></span> 
									'.$row['title'].''.$dots.'

										'.$link_h.'							

										<a  class="text-primary mnu_btn" onclick="toggle(\''.'d_'.$row['id'].'\')" >
											<i class="fa fa-angle-down"></i>
										</a>
										
										'.$ico_estado.'


									</h6> 
								</div>
								<div class="col-md-12" style="padding:0px; display:none;" id="icons_'.$row['id'].'" >
                                    <span class=""> test</span>
                                </div>
									<div class="" style="padding:0px; display:none; " id="d_'.$row['id'].'" >
										
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">ID</label>
											<div class="col-sm-9">
												<input disabled class="form-control" type="text" value= "'.$row['id'].'">
												<inputtype="hidden" id="id_'.$row['id'].'" value= "'.$row['id'].'">
											</div>
										</div>	

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Nombre</label>
											<div class="col-sm-9">
												<input class="form-control" id="title_'.$row['id'].'" type="text" value= "'.$row['title'].'">
																								
											</div>
										</div>
										
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Clave</label>
											<div class="col-sm-9">
											<input class="form-control" type="text" id="cve_'.$row['id'].'" value= "'.$row['cve'].'">
											</div>
										</div>

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Icon <i class="fa fa-'.$row['icon'].'"></i>
											</label>
											
											<div class="row col-sm-9">
											<input class="form-control" type="text" id="icon_'.$row['id'].'" value= "'.$row['icon'].'">
											</div>
										</div>

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Tipo</label>
											<div class="col-sm-9">
											
											<select class="form-control" id="tipo_'.$row['id'].'" >
											'.genera_select_tipo_menu($row['tipo_menu']).'
											</select>
											
											
											</div>
										</div>	
																

																


										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Archivo</label>
											<div class="col-sm-9">
											
											<input class="form-control" type="text" id="file_'.$row['id'].'" value= "'.$row['link'].'">
											</div>
										</div>
										
										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">NodoP</label>
											<div class="col-sm-9">
											
											<select class="form-control" id="id_padre_'.$row['id'].'" >
												'.$ops.'
												'.dropmenupadre($row['mnu_padre']).'
											</select>
											
											<input  type="hidden" id="id_padre_original_'.$row['id'].'" value= "'.$row['mnu_padre'].'">
											</div>
										</div>	
										
										'.$posicion.'
										

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Orden</label>
											<div class="col-sm-9">
											
											<input class="form-control" type="number" id="orden_'.$row['id'].'" value= "'.$row['orden'].'">
											</div>
										</div>

										<div class="form-group row no_padding_bottom">
											<label class="col-sm-3 col-form-label">Color</label>
											<div class="col-sm-9">
											
											<input class="form-control" type="color" id="color_'.$row['id'].'" value="'.$color_bg.'">
											</div>
										</div>

										<div class="border-top bg-light " style="margin: 10px 0 0 0; text-align:center; padding: 10px 0px;">
											<a  class="btn btn-inverse-secondary text-neutral" onclick="save_menu(\''.$row['id'].'\')" ><i class="fa fa-save"></i></a>
											'.$btn_eliminar.'
											'.$btn_estado.'
										</div>										
									</div>
									

								
							 </div> '; 
							 
					/// Busca los Menus Hijos
					
							
							$menu_t = $menu;
				}
			}else{
				$menu_t = '<p class="text-neutral" >No hay menus sin clasificar</p>'; 
			}
		
		
		// var_dump($menu);
		return $menu_t;
	}
////////////////

function get_menu_nvo($tipo){

	require("access.php");
		$dbh= new mysqli($dbserver,$dbuser,$dbpwd, $dbname);
		//var_dump($dbpwd);
					
		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}
		

        $mnu = $_GET['mnu'];

		if($tipo == 1){
			
			$id_menu = 0;
			//$menu .= '<a>Test</a>'; 
			
			$ops = '
				<option value="999">Elije...</option>
				<option value="9999">Sin Clasificar</option> 
				<option value="0" selected >Barra Lateral</option>
				<option value="777" >Op. Perfil</option> 
			
			'; 
			
		}else if( $tipo == 2){
			$id_menu = 777;


			$ops = '
				<option value="999">Elije...</option>
				<option value="9999">Sin Clasificar</option> 
				<option value="0"  >Barra Lateral</option>
				<option value="777" selected >Op. Perfil</option> 
			
			'; 
			 
		}else if( $tipo == 3){
			$id_menu = 9999;

			$ops = '
				<option value="999">Elije...</option>
				<option value="9999" selected >Sin Clasificar</option> 
				<option value="0"  >Barra Lateral</option>
				<option value="777"  >Op. Perfil</option> 
			
			'; 
			
		}
		
					
										
		$q = "SELECT * FROM menus WHERE mnu_padre= $id_menu and nivel < 2 order by orden asc";// preparando la instruccion sql
		
		//echo $q;
							   
		$result= $dbh->query($q);
							    
			if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
				
				
				while($row= $result->fetch_assoc()){
					$id= $row['id'];
					
					
					$sub = get_numero_hijos($row['id']);
					if($sub >0 ){

						$link_h = '
						<a  class="mnu_btnb btn-outline-primary" href="'.$link_site.'?mnu='.$mnu.'&mpa='.$row['id'].'" >
							<i class="fa fa-chevron-right"></i>
						</a>';	
						
						$dots = '...';				
					}else{
						$link_h = '<span style="width:28px; height:100%; float:right; backgrund:rgba(250,250,250,0.9);">&nbsp;</span>';	
						$dots = '';					
					}
					

					$perfil = $GLOBALS['user_perfil'];
					$permiso_elimina = get_permiso_config('8', $perfil);
								 
					//var_dump($perfil);
								 
					if($permiso_elimina==1){
						$btn_eliminar='<a  class="btn btn-inverse-primary text-neutral" onclick="elimina_menu(\''.$row['id'].'\')"><i class="fa fa-trash"></i></a>'; 								 
					}else{
					    $btn_eliminar='<a  class="btn btn-secondary text-muted" ><i class="fa fa-trash"></i> </a> '; 
					}

							if($row['color']==''){
								//$color_txt = '255,255,255'; 
								$color_bg = fromRGB('255', '255', '255');
							}else{

							$data_coltxt = explode(',',$row['color']); 
	                        
	                        $r = $data_coltxt[0];
	                        $g = $data_coltxt[1];
	                        $b = $data_coltxt[2];
	                        
	                        //$color_t = 


								$color_bg = fromRGB($r, $g, $b); 
							}
									
                    if($row['estado']==1){
                        $bg = ' bg-head ';
                        $text = ' text-primary';  
                    }else{
                        $bg = ' bg-muted ';
                        $text = ' text-clear';                         
                    }
									
					
					$menu .= '<div class="blockquote rounded" style="padding: 0px;  margin-bottom: 5px; ">
								
                                <div class="'.$bg.' '.$text.' text-primary " style="padding: 5px 0 5px 10px; margin-bottom:0px; " >
									
									<h6 class="'.$text.' mnu_bar_" style="margin-bottom: 0; font-size: 12px;">
									<span style="margin-right: 3px; "><i class="fa fa-'.$row['icon'].'"></i></span> 
									'.$row['title'].''.$dots.'

										'.$link_h.'							

                                    <a  class="text-primary mnu_btn" onclick="edit_mnu(\''.$row['id'].'\')" >
                                       <span class="'.$text.'"> <i class="fa fa-pencil"></i></span>
                                    </a>
									</h6> 
								</div>
							 </div> '; 
							 
					/// Busca los Menus Hijos
					
							
							$menu_t = $menu;
				}
			}else{
				$menu_t = '<p class="text-neutral" >No hay menus sin clasificar</p>'; 
			}
		
		
		// var_dump($menu);
		return $menu_t;
	}
//////////////////////////////////////////////

	function getmenu_opcion($id_menu){

	require("access.php");
		$dbh= new mysqli($dbserver,$dbuser,$dbpwd, $dbname);
		//var_dump($dbpwd);
					
		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}
		

		$mnu = $_GET['mnu'];
										
		$q = "SELECT * FROM menus WHERE mnu_padre= $id_menu and nivel = 1 and estado=1 order by orden asc";// preparando la instruccion sql
		
		//echo $q;
							   
		$result= $dbh->query($q);
							    
							    
			if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
				
				
				while($row= $result->fetch_assoc()){
					
					
					

						$link_h = '
						<a  class="mnu_btnb text-primary" href="'.$link_site.'?mnu='.$row['cve'].'&op='.$row['id'].'" style="margin-top:0px;" >
							<i class="fa fa-caret-right"></i>
						</a>';						
					

					
					$menu .= '<a href="'.$link_site.'?mnu='.$row['cve'].'&op='.$row['id'].'" class="text-primary grid-margin-md ">
								        <div class="col-md-12 p-1 " style="border-bottom: 1px solid #ccc; border-left: 0px solid #aaa;">
								             <span class="mb-2" style="font-size:14px;"> 
								             	<span style="margin-right: 3px; width:25%; "><i class="fa fa-'.$row['icon'].'"></i></span> 
											 	<span class="text-primary"> '.$row['title'].'...</span>
								             </span>
								             '.$link_h .'
								         </div> 
								        
					</a> '; 
							 
					/// Busca los Menus Hijos
					
							
							$menu_t = $menu;
				}
			}else{
				$menu_t = '<p class="text-neutral" >No hay opciones disponibles</p>'; 
			}
		
		
		// var_dump($menu);
		return $menu_t;
	}

///////////////////

	function getmenu_opcion_frame($id_menu_padre,$user_cifrado){

	require("access.php");
		$dbh= new mysqli($dbserver,$dbuser,$dbpwd, $dbname);
		//var_dump($dbpwd);
					
		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}
		

		$mnu = $_GET['mnu'];
										
		$q = "SELECT * FROM menus WHERE mnu_padre= $id_menu_padre and nivel = 1 and estado=1 order by orden asc";// preparando la instruccion sql
		
		//echo $q;
							   
		$result= $dbh->query($q);
							    
							    
			if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
				
				$num = 0;
				while($row= $result->fetch_assoc()){
                  
                  if (($num % 2) == 0) {
                    //Es un número par
                   // echo 'Es un número par';
                    $bg_op = 'bg-head-low'; 
                    $text_op = 'text-muted';
                  } else {
                    $bg_op = 'bg-light';
                    $text_op = 'text-muted';
                    //Es un número impar
                   // echo 'Es un número impar';
                  }
					
					$sub = substr($row['nombre'], 0,7);
					$suba = substr($row['nombre'], 0,8);
					
					if($row['tipo_menu']==3){
						$url = $link_site.'?mnu='.$mnu.'&item='.$user_cifrado.'&element='.$row['id']; 
					}elseif($sub== 'submenu'){	

						if($id_menu_padre==9666666666){
							$url = $link_site.'?mnu='.$mnu.'&item='.$_GET['item'].'&element='.$_GET['element'].'&fig='.$_POST['serie_select']; 
						}else{
							$url = $link_site.'?mnu='.$mnu.'&item='.$user_cifrado.'&element='.$row['mnu_padre'].'&element_sub='.$row['cve']; 
						}

					}elseif($suba== 'user_col'){				
						$url = $link_site.'?mnu='.$mnu.'&item='.$user_cifrado.'&element='.$row['cve'].'&obj=1';  
					}elseif($row['mnu_padre']==47){
						$url = $link_site.'?mnu='.$mnu.'&element='.$row['cve']; 
					}else{				
						$url = $link_site.'?mnu='.$mnu.'&item='.$user_cifrado.'&element='.$row['cve']; 
					}
					

						if($num==0 and $row['tipo_menu']==3){
							$border= ''; 
						}else{
							$border= ''; 
						} 
					
					
					if($id_menu == $row['id']){
						
						$status_menu = 'text-secondary';
						
					}else if($id_menu_padre==86){
						$status_menu = 'text-muted';
					}else{
						$status_menu = 'text-muted';
					}
					
					
					if($GLOBALS['color_txt']==''){
						//$status_menu=
					}else{
						$status_menu = ''; 
					}
					
					
					$long = strlen($row['title']);
					
					if($long > 10){
						//$title = substr($row['title'], 0, 8).'...';
						//$data_title = explode(' ',$row['title'] );
						//$title = $data_title[0].'...';
						$title = $row['title'];
						
					}else{
						$title = $row['title'];
					}
					
					if($id_menu_padre==47 or $id_menu_padre==51 or $id_menu_padre==78){
						$col  = '';
					}else{
						
						$col  = '';
					}
					
					$permisop= get_permiso_pagina($row['id'],$GLOBALS['user_perfil']); // id de la pag, id del perfil de ususrio
					//var_dump($GLOBALS['user_perfil']);
					
					//echo $GLOBALS['user_perfil'];
					
						if($permisop ==1){
						
							$id_bus = $_GET['element']; 
							$code_sub = $_GET['element_sub'];

							
							if($id_bus== $row['id']){
								 $bg_op = '';
								 //$color_bg = 'rgba('.$row['color'].',0.4);';
								 $color_bg = 'rgba(163, 183, 196,0.2);'; 
								 $color_code= '163,183,196'; 
							}else{
								 $bg_op = 'bg-light';
								 $color_bg = '';
							
								$data_papa = get_info_mnu($id_menu_padre);
								$data_p = explode('|',$data_papa);
								//$color_p = $data_p[0];
								$color_p = '163,183,196'; 

								if($code_sub== $row['cve']){
									 $bg_op = '';
									 //$color_bg = 'rgba('.$color_p.',0.2);';
									 $color_bg = 'rgba(163, 183, 196,0.2);'; 
									 $color_code= $color_p;
								}else{
									 $bg_op = 'bg-light';
									 $color_bg = '';
									 $color_code= $color_p;
								}	

							}						



							$menu .= '<a href="'.$url.'" class="menu_lateral border-bottom '.$text_op.'" style="padding-left:0px; padding-right:0px; padding-top:0px; padding-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; margin-bottom:0px; border-bottom:1px solid #ccc; color:'.$GLOBALS['color_txt'].'; " id="mnu_'.$row['id'].'">

										<div class="row col-md-12  '.$bg_op.' '.$border.'" style="background: '.$color_bg.'; border-left:2px solid rgba('.$color_code.',1); font-size:0.8em; margin:0px 0px; margin-left:0px; padding:12px 0px 12px 10px; padding-right:0px; border-bottom:1px solid rgba(200,200,200,0.6); " title="'.$row['title'].'">

										    <span class="col-1" style="margin:0px 15px 0px 0px; padding:0px 5px; width:25px; font-size:1.1em;"> <i class="fa fa-'.$row['icon'].'"></i></span> 

											<span class="col-9 " style="padding:0px; font-size:1.1em;"> '.$title.'</span>
											
											<span class="'.$col.' text-head"  style="padding:0px; float:right; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
										</div> 
									</a> '; 
								 
		
						}else{
							$menu .= '';
	
						}				/// Busca los Menus Hijos
					
							
							$menu_t = $menu;
							$num = $num +1;
				}// while
			
			}else{ // si hay registros 
				$menu_t = '
				
				<a href="#" class="text-muted " style="padding-left:0px; margin-left:0px; height:90%;">
								        <div class="row col-md-12 '.$border.'" style="font-size:0.6em; margin:5px 0px; margin-left:0px; padding:10px 0px;">
								             
								             	<span class="col-sm-2 "  style=" font-size:1.3em; "><i class="fa-solid fa-magnifying-glass"></i></span> 
											 	<span class="col-sm-10 text-muted" style="font-size:1.3em;"> No hay opciones disponibles.</span>
								             
								             
								        </div> 
								        
					</a>
				
				'; 
			}
		
		
		// var_dump($menu);
		return $menu_t;
	}


/////////////////
function get_temporal_serie(){
	
	$mnu = $_GET['mnu'];
	$cve = $_GET['cve'];
	$step = $_GET['step'];
	
	if($step==0 or $step==''){
		$step=1;
	}

//mnu=725e7f1bcf91833a5f84dfee286b1147&cve=2&step=1#

	require("access.php");
		$dbh= new mysqli($dbserver,$dbuser,$dbpwd, $dbname);
		//var_dump($dbpwd);
					
		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}
		

					
										
		$q = "SELECT * FROM series WHERE estado = 99";// preparando la instruccion sql
		
		//echo $q;
							   
		$result= $dbh->query($q);
							    
			if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
				
				while($row= $result->fetch_assoc()){
					
					$card .= '<a class="dropdown-item" href="'.$link_site.'?mnu='.$mnu.'&cve='.$cve.'&step='.$step.'&resume='.$row['clave_lego'].'">
					'.$row['nombre'].' - '.$row['clave_lego'].'</a>	 '; 
				
				}
					
			}else{
				$card = 'X';	
			}	

			$card = '<a class="dropdown-item" href="'.$link_site.'?mnu='.$mnu.'&cve='.$cve.'&step=1&resume=0"> Serie Nueva </a>	'.$card;
	
	return $card;
	
}
	
	
	
function get_info_temp($cve,$step){

	switch($step){
		
		case 1: 
		break; 
		
		case 2: 

				include("access.php");
				
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			      //informacion de acceso a la bd
				// Check connection
				if ($dbhb->connect_error) {
				    die("Connection failed: " . $dbh->connect_error);
				}
				
			
				
				$qb = "SELECT * FROM temporal_serie WHERE clave = '$cve' and estado = 1 ";// preparando la instruccion sql
					
					$resultb= $dbh->query($qb);
										
										if ($resultb->num_rows > 0) { // Si la consulta trae registro, cambia el estado
											$row= $resultb->fetch_assoc();
											
											 if($step==1){
												 $content = $row['step1'];
											 
											 }elseif($step==2){
												 
												 $content = $row['step2'];
												// var_dump($content);
												 
												 if($content==''){													 
													 //busca en la base de datos las figuras; 
													$content =  get_name_minifiguras($cve);
													
													 
												 }												 
											 }elseif($step==3){
												 $content = $row['step3'];
											 
											 }elseif($step==4){
												 $content = $row['step4'];
											 }
										 
										}else{
											
											$content =  get_name_minifiguras($cve);
                                           // $contect = '0,0,0,0';
										}
										
					return $content;	

		break; 
		
		case 3: 
		
		$count = 0;
		$carpeta = 'minifig/'.$cve.'/';
			
				if (is_dir($carpeta)) { //Comprovamos que sea un carpeta Valido
					if ($dir = opendir($carpeta)) {//Abrimos el carpeta
						
							while (($archivo = readdir($dir)) !== false){ //Comenzamos a leer archivo por archivo
								if ($archivo != '.' && $archivo != '..'){ 
									
									$count = $count+1; 
									
									$nuevaRuta = $carpeta.$archivo;
									$sele .=  '<li>'; //Abrimos un elemento de lista 
										if (is_dir($nuevaRuta)) { //Si la ruta que creamos es un carpeta entonces:
											$sele .= '<b>'.$nuevaRuta.'</b>'; //Imprimimos la ruta completa resaltandola en negrita
											//listLogo($nuevaRuta);//Volvemos a llamar a este metodo para que explore ese carpeta.
										} else { //si no es un carpeta:
											$sele .= 'Archivo: '.$archivo; //simplemente imprimimos el nombre del archivo actual
											$file .= $carpeta.$archivo.'|';
										}
									$sele .= '</li>'; //Cerramos el item actual y se inicia la llamada al siguiente archivo
								}
							}//finaliza 
						$sele .= '</ul>';//Se cierra la lista
						closedir($dir);//Se cierra el archivo
					}
					
					$val = $count.'//'.$file;
				}else{//Finaliza el If de la linea 12, si no es un carpeta valido, muestra el siguiente mensaje
					$val = '0//'.$file;
				}		
		
				return $val;
		
		break; 
		
		case 4: 

				include("access.php");
				
				$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			      //informacion de acceso a la bd
				// Check connection
				if ($dbhb->connect_error) {
				    die("Connection failed: " . $dbh->connect_error);
				}
								
				$qb = "SELECT * FROM minifiguras WHERE cve_lego = '$cve' and estado = 1 ";// preparando la instruccion sql
					
					$resultb= $dbh->query($qb);
										
										if ($resultb->num_rows > 0) { // Si la consulta trae registro, cambia el estado
											while($row= $resultb->fetch_assoc()){
											
											
												$content .= $row['imagen'].'|';
											}
										 
										}else{
											
											$content .= '';
										}
										
					return $content;	


		break; 
		
		default: 
		
		break; 
	}


	


}


//////


function get_name_minifiguras($cve){

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}	


	//////////////////////////   BUSCA las minifiguras en la coleccion de un usuario   ////////////////////////////////////
	
		$qm = "SELECT * FROM minifiguras where cve_lego = '$cve';";// preparando la instruccion sql
	
		$results= $dbh->query($qm);
	    if ($results->num_rows > 0) {
		
		
			while($rows= $results->fetch_assoc()){
				$tot = $tot + 1; 
				
				$fig .= '1,'.$rows['nombre_es'].','.$rows['nombre_en'].','.$rows['imagen'].','.$rows['id'].';';
				
			}
			
			// busca el usuario
		
		}else{
			$fig = '0,Error en querys;';
		}
		
		return $fig; 
		//return $qs;
	$dbh->close();
}  


//////////////

function get_info_minifiguras_extra($cve, $usuario){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		  //informacion de acceso a la bd
	// Check connection
	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}	
	
	
		//////////////////////////   BUSCA las minifiguras en la coleccion de un usuario   ////////////////////////////////////
		
			$qm = "SELECT * FROM coleccion where clave_lego = $cve and id_user = $usuario and no_extra > 0;";// preparando la instruccion sql
		
			$results= $dbh->query($qm);
			if ($results->num_rows > 0) {
			
			
				while($rows= $results->fetch_assoc()){
					//$tot = $tot + 1; 
					
					$fig .= $rows['item'].','.$rows['id'].','.$rows['no_extra'].';';
					
				}
				
				// busca el usuario
			
			}else{
				$fig = '0,0,0;';
			}
			
			//var_dump($qm);
			return $fig; 
			//return $qs;
		$dbh->close();
	}  
	
	
	//////////////


function genera_select_columnas($current){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM vistas_mosaico where estado = 1 ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['clave']== $current){
		                         $opt .= '<option selected disabled value="'.$row['cve'].'">'.$row['nombre'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$row['cve'].'">'.$row['nombre'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }


						$seletct= '<option value="999"> Elije... </option> '.$opt;
	            
	         //   $sel = $seletct;
	            
	          //  var_dump($sel);
	
	//$data = $total_serie; 
	return $seletct; 
	$dbhb->close();		
	
}


//////


function genera_btn_columnas($current){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}

	$mnu= $_GET['mnu'];
	$home = 'index.php?mnu=';
		
	$q = "SELECT * FROM vistas_mosaico where estado = 1 order by nombre ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['cve']== $current){
		                         $opt .= '<a href="'.$home.$mnu.'&vista='.$row['tam_col'].'" class="btn btn-inverse-secondary btn_sm_custom "><i class="fa '.$row['icono'].'"></i>  </a>';
	                        }else{
		                        $opt .= '<a href="'.$home.$mnu.'&vista='.$row['tam_col'].'" class="btn btn-inverse-secondary btn_sm_custom text-muted"><i class="fas '.$row['icono'].'"></i> </a>';
	                        }
	                        
	                    }
	            }else{
		            
	            }

	            
	         //   $sel = $seletct;
	            
	          //  var_dump($sel);
	
	//$data = $total_serie; 
	return $opt; 
	$dbhb->close();		
	
}


/////// 


/////////////--- Busca info de usuario en la base por CORREO ////////////////

function busca_user_correo($correo){
	
	include("access.php");	
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM usuarios where correo = '$correo'";// preparando la instruccion sql
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
			 $error = 0 ;
			 $nombre = $row['nombre'];
			 $correo= $row['correo'];
			 $user_name = $row['usuario']; 
			 $foto = $row['foto'];
			 $cve = $row['clave'];
			 $id = $row['id'];
			 $datos_encontrados= $error.'--'.$nombre.'--'.$correo.'--'.$user_name.'--'.$foto.'--'.$cve.'--'.$id;
	    }else{
		    $error = 1 ;
		    $nombre = '';
			$correo= '';
			$user_name = '';
			$foto = '';
			$cve ='';
			$id = '';
			$datos_encontrados= $error.'--'.$nombre.'--'.$correo.'--'.$user_name.'--'.$foto.'--'.$cve.'--'.$id;		    
	    }
	    
	return $datos_encontrados; 	
	$dbh->close();
}



//////////////////////////////////////////////////////////////////
function get_lbl_estado($estado){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM estado_usuario where clave = $estado ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
	    	 if($row['color']=='success'){
		    	 $txt = 'light';
	    	 }else{
		    	 $txt = '';
	    	 }
	    	 
	    	 	$lbl = '<span id="s_edo_'.$row['id'].'" class="badge  text-'.$row['color'].'" style="font-size:12px;"> 
	    	 	<i class="'.$row['icono'].'" style="width: 20px; display:inline-block;" ></i> '.$row['nombre'].' 
	    	 	</span>';                       
	    
	    }else{
		    
		    $lbl = 'Sin Estado';
		    
	    }
	
	return $lbl; 
	$dbh->close();
}
/////////

function get_lbl_estado_pago($estado){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM estado_pago where cve = $estado ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
	    	 if($row['color']=='success'){
		    	 $txt = 'light';
	    	 }else{
		    	 $txt = '';
	    	 }
	    	 
	    	 	$lbl = '<span id="s_edo_'.$row['id'].'" class="badge  text-'.$row['color'].'" style="font-size:12px;"> 
	    	 	<i class="'.$row['icono'].'" style="width: 20px; display:inline-block;" ></i> '.$row['nombre'].' 
	    	 	</span>';                       
	    
	    }else{
		    
		    $lbl = 'Sin Estado';
		    
	    }
	
	return $lbl; 
	$dbh->close();
}

//////////////////////////////////////////////////////////////////
function get_lbl_estado_serie($estado){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM estado_serie where clave = $estado ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
	    	 
	    	 	$lbl = '<span id="s_edo_'.$row['id'].'" class="badge  text-'.$row['color'].'" title="'.$row['descripcion'].'" style="font-size:12px;"> 
	    	 	<i class="'.$row['icono'].'" style="width: 30px; display:inline-block;" ></i> '.$row['nombre'].' 
	    	 	</span>';         
	    	 	
	    	 	//$lbl = '<span class="theme_color ico_estado" title="Modo Público"> <i class=" fa fa-eye " ></i> </span>';              
	    
	    }else{
		    
		    $lbl = 'Sin Estado';
		    
	    }
	
	return $lbl; 
	$dbh->close();
}

//////////////////////////////////////////////////////////////////
function get_lbl_estado_perfil($estado){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM estado_perfil where clave = $estado ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
	    	 
	    	 	$lbl = '<span id="s_edo_'.$row['id'].'" class="badge  text-'.$row['color'].'" title="'.$row['descripcion'].'" style="font-size:12px;"> 
	    	 	<i class="'.$row['icono'].'" style="width: 30px; display:inline-block;" ></i> '.$row['nombre'].' 
	    	 	</span>';         
	    	 	
	    	 	//$lbl = '<span class="theme_color ico_estado" title="Modo Público"> <i class=" fa fa-eye " ></i> </span>';              
	    
	    }else{
		    
		    $lbl = 'Sin Estado';
		    
	    }
	
	return $lbl; 
	$dbh->close();
}

//////////////////////////////////////////////////////////////////
function get_lbl_estado_set($estado){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM estado_set where clave = $estado ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
	    	 
	    	 	$lbl = '<span id="s_edo_'.$row['id'].'" class="badge  text-'.$row['color'].'" style="font-size:14px;"> 
	    	 	<i class="'.$row['icono'].'" style="width: 30px; display:inline-block;" ></i> '.$row['nombre'].' 
	    	 	</span>';         
	    	 	
	    	 	//$lbl = '<span class="theme_color ico_estado" title="Modo Público"> <i class=" fa fa-eye " ></i> </span>';              
	    
	    }else{
		    
		    $lbl = 'Sin Estado';
		    
	    }
	
	return $lbl; 
	$dbh->close();
}

//////////////////////////////////////////////////////////////////
function get_lbl_estado_recibo($estado){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM estado_recibo where cve = $estado ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
	    	 
	    	 	$lbl = '<span id="s_edo_'.$row['id'].'" class="badge  text-'.$row['color'].'" style="font-size:14px;"> 
	    	 	<i class="'.$row['icono'].'" style="width: 30px; display:inline-block;" ></i> '.$row['nombre'].' 
	    	 	</span>';         
	    	 	
	    	 	//$lbl = '<span class="theme_color ico_estado" title="Modo Público"> <i class=" fa fa-eye " ></i> </span>';              
	    
	    }else{
		    
		    $lbl = 'Sin Estado';
		    
	    }
	
	return $lbl; 
	$dbh->close();
}
//////////////////////////////////////////////////////////////////
function get_lbl_estado_presentacion($estado){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM estado_presentacion where clave = $estado ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
	    	 if($row['color']=='success'){
		    	 $txt = 'light';
	    	 }else{
		    	 $txt = 'muted';
	    	 }
	    	 
	    	 	$lbl = '<span id="s_edo_'.$row['id'].'" class="badge  text-'.$row['color'].'" style="font-size:0.8rem;"> 
	    	 	<i class="'.$row['icono'].'" style="width: 20px; display:inline-block;" ></i> '.strtoupper($row['nombre']).' 
	    	 	</span>';                       
	    
	    }else{
		    
		    $lbl = 'No especificado';
		    
	    }
	
	return $lbl; 
	$dbh->close();
}

/////////
function activa_cta_nva($token){
	include('access.php');
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
			
				if ($dbh->connect_error) {
					die("Connection failed: " . $dbh->connect_error);
				}
								
								// comprueba si ya existe el registro
								$q = "SELECT * FROM usuarios WHERE correo_cifrado = '$token' ";// preparando la instruccion sql
								
								//var_dump($q);
							    $result= $dbh->query($q);
							    
							    if ($result->num_rows > 0) { // Si la consulta trae registro, cambia el estado
									$row= $result->fetch_assoc();
								
									$estado = $row['estado']; 
									$usuario = $row['usuario'];
									$id = $row['id'];
									
									$hoy = date("Y-m-d H:i:s");
				 
								 	if($estado == 98){ 
					 	
							 			$qb = "UPDATE usuarios SET estado = 1, fecha_activado = '$hoy' where id= $id ";// preparando la instruccion sql
							 			
										if (mysqli_query($dbh, $qb)) {
											
											$res = 1; //exito 
										} else {
											$res = 2; // error actialoizacion; 
										}
									}else if($estado==1){
										$res = 4;
										
									}else if($estado==99){
										$res = 5;
									}else if($estado==0){
										$res = 6;
									}
								
								}else{
									$res = 0; //no existe
								}
								
								return $res;
								
}


//////////////////////////////////////////////////////////////////
function get_pag($pag_code){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	//var_dump($pag_code);
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM menus where cve ='$pag_code' ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
	    	 
	    	 	$lbl = $row['link'];         
	    	 	            
	    
	    }else{
		    
		    $lbl = 'empty.php';
		    
	    }
	
	return $lbl; 
	$dbh->close();
}
//////////////////////////////////////////////////////////////////
function get_pag_info($pag_code){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	//var_dump($pag_code);
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM menus where cve ='$pag_code' ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
	    	 
	    	 	$lbl = $row['link'].'|'.$row['id'];         
	    	 	            
	    
	    }else{
		    
		    $lbl = 'empty.php|0';
		    
	    }
	
	return $lbl; 
	$dbh->close();
}

/////////////////////
function get_total_coleccion_user($serie, $user){
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM coleccion where clave_lego = $serie and id_user = $user and estado = 1;";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
			
			$coleccion = $resultb->num_rows;
			
		}else{
					
			$coleccion = 0;
		}
	return $coleccion;
}

////////////////////

function registra_session($id_user){
include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

					$ip =  $_SERVER['REMOTE_ADDR'];

					$meta_dir = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
					$latitud = $meta_dir['geoplugin_latitude'];
					$longitud = $meta_dir['geoplugin_longitude'];
					$ciudad = $meta_dir['geoplugin_city'];
					$region = $meta_dir['geoplugin_region'];
					$pais = $meta_dir['geoplugin_countryName'];
						
					$hoy = date("Y-m-d H:i:s");
//					$url  = $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



					$ua=getBrowser();
					$yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
					
					$browser = $ua['name'];
					$disp = $ua['platform'];					
					/// comprueba si el usuario existe ne la base de dtos 
					
					
						if ($dbh->connect_error) {
							  die("Connection failed: " . $dbh->connect_error);
						}
						
			 		$q = "SELECT * FROM session_user WHERE id_user = $id_user and ip_address = '$ip';";
			 		$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) {

						$qe = "UPDATE session_user SET fecha = '$hoy', ciudad = '$ciudad', pais = '$pais', navegador = '$browser', dispositivo = '$disp' where id_user = $id_user and ip_address = '$ip'";// preparando la instruccion sql
						
						if (mysqli_query($dbh, $qe)) {
							$res =  1; 
						} else {
					    	$res = 0; 
					    }					    

					
					}else{
						
						$qb = "INSERT INTO session_user (id, id_user, ip_address, fecha, ciudad, pais, navegador, dispositivo, estado ) VALUES ('',".$id_user.", '".$ip."', '".$hoy."', '".$ciudad."','".$pais."', '".$browser."', '".$disp."', 1)";
						// preparando la instruccion sql
						
						   if (mysqli_query($dbh, $qb)) {
								$res = 2; 
							} else {
								$res = 3; 
						    }
						    
						   // var_dump($qb);
					}	
	return $res;
	
}
/////////////////////


function get_data_session_user($id_user){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM session_user where id_user = $id_user and estado = 1 order by fecha desc;";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
			
			$coleccion = $row['ip_address'].'|'.$row['fecha'].'|'.$row['ciudad'].'|'.$row['pais'].'|'.$qb;
			
		}else{
					
			$coleccion = '0|0000-00-00 00:00:00|0|0|'.$qb;
		}
	return $coleccion;	
	
	
}
/////////////////////////////


function valida_sesion($id_user, $ip){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM session_user where id_user = '$id_user' and ip_address = '$ip';";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
			
			$coleccion = 1;
			
		}else{
					
			$coleccion = 0;
		}
	return $coleccion;	
	
	
}
/////////////////////////////


function get_data_sesions_user($id_us){
	
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
	
	$ip =  $_SERVER['REMOTE_ADDR'];
		// determina que tipo de serie es	
		$qb = "SELECT * FROM session_user where id_user = '$id_us' and estado = 1 order by fecha desc;";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$num = 0;
			while($row= $resultb->fetch_assoc()){
				$num = $num +1;
				
				if($row['navegador'] == ''){
					$nav = 'Desconocido'; 
				}else{
					$nav = strtoupper($row['navegador']);
				}

				if($row['dispositivo'] == ''){
					$disp = 'Desconocido'; 
				}else{
					$disp = strtoupper($row['dispositivo']);
				}


				if($row['ciudad'] == ''){
					$ciudad = 'Desconocido'; 
				}else{
					$ciudad= strtoupper($row['ciudad']);
				}
				
				if($row['ip_address']==$ip){
					$bg_circle = 'bg-success'; 
					$txt_circle = 'text-white'; 
				}else{
					$bg_circle = 'bg-muted';
					$txt_circle = 'text-muted'; 
				}
				
				$coleccion .= '
	                        <div class="d-flex py-2 border-bottom">
	                          <span class="img-sm rounded-circle '.$bg_circle.' '.$txt_circle.'  text-avatar">'.$num.'</span>
	                          <div class="wrapper ml-2">
	                            <p class="mb-n1 font-weight-semibold">'.$row['ip_address'].'</p>
	                            <small>'.$ciudad.', '.$row['pais'].' / '.$nav.', '. $disp.'</small>
	                          </div>
	                          <small class="text-muted ml-auto">'.formatFechaHora($row['fecha']).'</small>
	                        </div>
				';


			}
			
	    		    	
			
			//$coleccion = $row['ip'].'|'.$row['fecha'].'|'.$row['ciudad'].'|'.$row['pais'];
			
		}else{
					
			$coleccion = '
			<div class="col-md-12" style="text-align:center; margin-top: 1%;">
			<h1 class="text-muted" style="font-size: 120px;">;(</h1> <br> <span > No información disponible para este usuario</span>
			</div>';
		}
	return $coleccion;	
		
	
}


////////

function generateRandomString($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrtuvwxyzABCDEFGHIJKLMNOPQRTUVWXYZ!#ç$%';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
} 

//////////////////////////////

function get_estatus_link($id_user){
	
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM token_user where id_user = '$id_user';";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
			
			$coleccion = $row['estado'].';'.$row['token'].';'.$row['token_anterior'];
			
		}else{
					
			$coleccion = '2;0;0';
		}
	return $coleccion;	
	
	
	
}
///////////


function get_info_link($id_user){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM token_user where id_user = '$id_user';";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
			
			$coleccion = $row['token'];
			
		}else{
					
			$coleccion = 'x';
		}
	return $coleccion;		
	
}

function get_info_token($token){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM token_user where token = '$token';";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
			
			$res = $row['id_user'];
			
		}else{
					
			$res = 0;
		}
	return $res;		
	
}


//////////////////////


function make_mail($contenido_mail){
	
	$head = '<head>
	<style type="text/css" title="x-apple-mail-formatting"></style>
    <meta name="viewport" content="width = 375, initial-scale = -1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <title></title>
    <style>

    @media only screen and (max-device-width: 700px) {
      .table-wrapper {
        margin-top: 0px !important;
        border-radius: 0px !important;
      }

      .header {
        border-radius: 0px !important;
      }
    }
    </style>
  </head>'; 
	
	$cuerpo = ' 
	<body style="-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;font-size:100%;line-height:1.6">

    <table style="background: #F5F6F7;" width="100%" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td>
          <!-- body -->

          <table cellpadding="0" cellspacing="0" class="table-wrapper" style="margin:auto;margin-top:50px;border-radius:7px;-webkit-border-radius:7px;-moz-border-radius:7px;max-width:700px !important;box-shadow:0 8px 20px #e3e7ea !important;-webkit-box-shadow:0 8px 20px #e3e7ea !important;-moz-box-shadow:0 8px 20px #e3e7ea !important;box-shadow: 0 8px 20px #e3e7ea !important; -webkit-box-shadow: 0 8px 20px #e3e7ea !important; -moz-box-shadow: 0 8px 20px #e3e7ea !important;">
            <tbody><tr>

              <!-- Brand Header -->
                <td class="container" bgcolor="#FFFFFF" style="display:block !important;margin:0 auto !important;clear:both !important">
                  <img src="'.$path_site.'/assets/images/head_mail_color.png" style="max-width:100%">
               </td>
            </tr>
            <tr>
              <td class="container content" bgcolor="#FFFFFF" style="padding:35px 40px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;display:block !important;margin:0 auto !important;clear:both !important">

                <!-- content -->

                <div class="content-box" style="max-width:600px;margin:0 auto;display:block"> 
<!-- Content -->

<div class="header-title">

  '.$contenido_mail.'
  

                </div>
                <!-- /content -->
              </td>

              <td>
              </td>
            </tr>
          </tbody></table>

          <!-- /body -->'; 
	
	$footer = '
	<div class="footer" style="padding-top:30px;padding-bottom:55px;width:100%;text-align:center;clear:both !important">

            <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0;font-size:12px;color:#666;margin-top:0px">BrickSideMx Community - The BrickShelf Collector</p>

            <p class="social-icons" style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0;font-size:12px;color:#666;padding-top:5px">

              <a href="https://www.facebook.com/bricksidemx" style="color:#1EA69A;word-wrap:break-word;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;font-weight:800;color:#999;color:#049075 !important"><img width="25" src="https://cdn2.hubspot.net/hubfs/677576/email-fb.png" style="max-width:100%"></a>

              <a href="https://twitter.com/bricksidemx" style="color:#1EA69A;word-wrap:break-word;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;font-weight:800;color:#999;color:#049075 !important"><img width="25" src="https://cdn2.hubspot.net/hubfs/677576/email-twitter.png" style="max-width:100%"></a>

              <a href="https://www.instagram.com/bricksidemx" style="color:#1EA69A;word-wrap:break-word;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;font-weight:800;color:#999;color:#049075 !important"><img width="25" src="https://cdn2.hubspot.net/hubfs/677576/email-insta.png" style="max-width:100%"></a>

             

            </p>
          </div>
        </td>
      </tr>
    </tbody></table>
</body>

	'; 
	
	$mail_estructure = $head.$cuerpo.$footer; 
	return $mail_estructure;
}



function mail_me($info){
	
	$mail_admin = 'admin@bricksidemx.com'; 
	
	$dataw = explode(';', $info);
	
	$tipo_mail = $dataw[0]; 
	$user_to = $dataw[1];
	$email_user = $dataw[2]; 
	$pass = $dataw[3];
	
	
	$hoy = date("d-m-Y h:i:s A"); 

	$ip =  $_SERVER['REMOTE_ADDR']; 
						//$ip = '187.189.79.167'; 
						
	$meta_dir = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
	$latitud = $meta_dir['geoplugin_latitude'];
	$longitud = $meta_dir['geoplugin_longitude'];
	$ciudad = $meta_dir['geoplugin_city'];
	$region = $meta_dir['geoplugin_region'];
	$pais = $meta_dir['geoplugin_countryName'];

	$ua=getBrowser();
	$yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
	
	$browser = $ua['name'];
	$disp = $ua['platform'];
	
	
	$pie = '

 <hr style="border-top: 5px solid #e7eeef; ">
<p class="no-top-margin" style="font-weight:normal; padding:0; font-family:&quot; Helvetica Neue &quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; line-height:1.7; margin-bottom:1.3em; font-size:15px; color:#47505E; font-size:16px; font-size:14px; margin-top:0; margin-top:0px; margin-bottom:0">
				    </p>
				    
				   
				    <p style="font-weight:normal; padding:0; font-family:&quot; Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; line-height:1.7; margin-bottom:1.3em; font-size:10px; color:#47505E; font-size:16px; margin-bottom:0; text-align:center;">
				
				   
				        ¿Tienes dudas?<br>
				        
				        <span>Escr&iacute;benos a: </span><a href="mailto:hola@bricksidemx.com"> hola@bricksidemx.com</a>
				
				      </p>
				       
				      <h3 style="text-align: center; color: #00856f;" > Equipo BRICKSIDEMX COLLECTOR</h3>    
				    </p>
	
	';
	///////////---------------------////////////
	
	switch($tipo_mail){
		
		
		case 1: // NOtificacion de Registros al owner
		
							
						$subject_custom = '[Nuevo Registro] '. strtoupper($user_to); 
						$message_custom .= 
						'<ul class="list" style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E">
			
			  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Email: <a href="mailto:" dir="ltr" x-apple-data-detectors="true" x-apple-data-detectors-type="link" x-apple-data-detectors-result="0">'.$email_user.'</a></li>
			
			  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Fecha: '.$hoy.'</li>
			
			  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Localización*: '.$ciudad.', '.$region.' en '.$pais.'</li>
			  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Coordenadas*: '.$latitud.', '.$longitud.'</li>
			
			  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Dirección IP: '.$ip.'</li>
			
			</ul>	';
						$email_destino = $mail_admin; 
		
		break; 
		
		
		case 2: // password Erroneo
						
						$subject_custom = '[Intentento de Acceso] Alerta de Seguridad BrickShelf Collector'; 
						//$message_custom = $hoy.' <br> Se ha registrado un intento de inicio de sesión desde la ubicación: '.$ciudad.', '.$region.' en '.$pais.' <br>';
						//$message_custom .= 'El siguiente pass se ha utilizado: <b>'.$pass.'</b>';
						
						$title_message = '<h1 style="font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;margin-bottom:15px;color:#47505E;margin:0px 0 10px;line-height:1.2;font-weight:200;font-size:28px;font-weight:bold;margin-bottom:30px">
						Nuevo Intento de Inicio de Sesión desde '.$region.'</h1>
				</div>'; 
						
						$message_custom = '
						<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0">
				
				 ¿Fuiste tu? Detectamos que alguien ha intentado entrar a tu cuenta:
				</p>
				
				<ul class="list" style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E">
				
				  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Email: <a href="mailto:" dir="ltr" x-apple-data-detectors="true" x-apple-data-detectors-type="link" x-apple-data-detectors-result="0">'.$email_user.'</a></li>
				
				  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Fecha: '.$hoy.'</li>
				
				  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Localización*: '.$ciudad.', '.$region.' en '.$pais.'</li>
				  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Coordenadas*: '.$latitud.', '.$longitud.'</li>
				
				  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Dirección IP: '.$ip.'</li>
				  <li style="margin-left:5px;list-style-position:inside;line-height:2.5">Clave Utilizada: '.$pass.'</li>
				
				</ul>	
					
						';
					
							$foo = '
							
									  <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em; font-size:12px; color:#47505E; margin-bottom:0;"><strong> Si has sido tu, ignora este mensaje, de lo contrario te recomendamos cambiar tu contraseña.</strong></p>
									  
				   <footer>
				    <p style="font-weight:normal; padding:0; font-family:&quot; Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; line-height:1.7; margin-bottom:1.3em; font-size:12px; color:#47505E;  margin-bottom:0; ">
				
				      <strong>
				        ¿Por qué enviamos esto?
				      </strong>
				      
				      <ul>
				      <li>Queremos mantenerlo informado sobre acciones importantes en su cuenta.</li>
				      
				      <li>No Respondas a este correo electrónico.</li>
				      </ul>
				      
				      <br>   
				      <small style="font-size:10px">
				        *La localización es aproximada y determinada por la dirección IP, si se usa un proxy, vpn esta puede no ser precisa.
				      </small>
				      
				    </p>
				    
 

'.$pie.'


				    </footer>
				    ';
						
						
						$email_destino = $email_user;
		
		break; 
		
		case 3: 
		
						$parameter = md5($email_user);
						$linkw = $GLOBALS['link_site'].'?set=4&parameter='.$parameter;
						$subject_custom = '[Cambio de Contraseña] BrickShelf Collector'; 
						//$message_custom = $hoy.' <br> Se ha registrado un intento de inicio de sesión desde la ubicación: '.$ciudad.', '.$region.' en '.$pais.' <br>';
						//$message_custom .= 'El siguiente pass se ha utilizado: <b>'.$pass.'</b>';
						
						$title_message = '<h1 style="font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;margin-bottom:15px;color:#47505E;margin:0px 0 10px;line-height:1.2;font-weight:200;font-size:28px;font-weight:bold;margin-bottom:30px">
						Solicitud para Cambiar Contraseña </h1>
				</div>'; 
						
						$message_custom = '
						<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0">
				
				 Se ha solicitado cambiar la contraseña de tu cuenta, al realizar este proceso también podrás reactivarla. 
				</p>
				
				<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0">
				
				Para continuar sigue el siguiente link: 
				<br>
				
				<p style="text-align:center;" >
				 <a style="background-color:#00856f;border:1px solid #00856f;border-radius:5px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:50px;text-align:center;text-decoration:none;padding:0 20px; text-align:center;" href="'.$linkw.'"> Restablecer contraseña</a> 
				</p>
				
				<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em; font-size:15px; color:#47505E; margin-bottom:0;"> En caso que este no funcione copia y pega el siguiente link en tu navegador: </p>
				
				'.$linkw.'
				
				</p>
				<br>
				
				';	
				
						$foo = '
						  <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em; font-size:12px; color:#47505E; margin-bottom:0;"><strong> Si has sido tu, ignora este mensaje, de lo contrario escribenos a: soporte@bricksidemx.com.</strong></p>
						  
				<footer>
				    
				    <p style="font-weight:normal; padding:0; font-family:&quot; Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; line-height:1.7; margin-bottom:1.3em; font-size:15px; color:#47505E; font-size:16px; margin-bottom:0; font-size:14px">
				
				      <strong>  ¿Por qué enviamos esto?</strong>
				      
				      <br> 
				      <url>     
				<li>Queremos mantenerlo informado sobre acciones importantes en su cuenta.</li>
				<li>No Respondas a este correo electrónico.</li>
				      </ul>
				      
				      <br>   
				      <small style="font-size:10px">
				        *La localización es aproximada y determinada por la dirección IP, si se usa un proxy, vpn esta puede no ser precisa.
				      </small>
				    </p>


					 '.$pie.' </footer>
				    
				    ';
				    	
						
						$email_destino = $email_user;
		
		break; 
		
		
		case 4: // Notificacion de Bienvenida al usuario

						$enlacew= $GLOBALS['link_site'].'/'.$GLOBALS['login_page'].'?token='.md5($email_user);
				
						$subject_custom = 'Bienvenido '.strtoupper($user_to).' a '.$GLOBALS['name_site']; 
					
						$title_message = '<h1 style="font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;margin-bottom:15px;color:#47505E;margin:0px 0 10px;font-weight:200;font-size:28px;font-weight:bold;margin-bottom:30px;"> 
						¡Bienvenido '.strtoupper($user_to).'! </h1>
				</div>'; 
						
						$message_custom = '
				
							<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0">
							
							 Estamos emocionados de tenerte en la comunidad <strong>BrickSide Mx</strong>, en este sitio tendr&aacute;s un coleccionador para registrar las las minifiguras y sets de LEGO<span style="font-size: 10px;">&reg;</span>.
							 </p>
							
							<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0; ">
										 Para activar tu cuenta haz click en el siguiente enlace: 
										 <br><br>
										 <p style="text-align:center;">
										 <a style="background-color:#00856f;border:1px solid #00856f;border-radius:5px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:50px;text-align:center;text-decoration:none;padding:0 20px;" href="'.$GLOBALS['path_site'].'/resetpass.php" style="text-align: center;" href="'.$enlacew.'"> Activa tu cuenta </a>
										 <br><br>
										 ò
										 <br><br>
										 
										 Copia y pega esta dirección en tu navegador: <br>
										 
										 <a style="text-align:center; font-size:12px;" href="'.$enlacew.'"> '.$enlacew.' </a>
										 </p>
							 </p>
							<br>
					  <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0; ">  Recuerda:  
						
						<ul>
						<li style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0" > No reenvies este correo</li>
						<li style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0"> No respondas a este correo</li>
						<li style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0" > Este correo es valido por 24 horas.</li>
						</ul>
					
					</p>
								
									';		
									
						$foo = '
				    
				    <footer> '.$pie.'  </footer>
				    ';
						
						$email_destino = $email_user;
		
		
		break; 
		
		case 5:  // Notificacion de Inicio de sesion 
						
						$hoy = date("D M j G:i:s T Y");
						
												
						$subject_custom = 'Alguien inició sesión con tu Cuenta BrickShelf Collector'; 
					
						$title_message = '<h1 style="font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;margin-bottom:15px;color:#47505E;margin:0px 0 10px;line-height:1.2;font-weight:200;font-size:28px;font-weight:bold;margin-bottom:30px">
						¡Bienvenido '.strtoupper($user_to).'!</h1>
				</div>'; 
						
						$message_custom = '
				
							<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0">
							
							Hola, '.$user_to.'. 
							<br> Parece que alguien inició sesión con tu Cuenta BRICKSHELF COLLECTOR usando '.$browser.' desde un nuevo dispositivo:
							 ('.strtoupper($disp).') en '.$ciudad.', '.$pais.' el '.$hoy.' desde '.$ip.'
							<br><br>
							Si acabas de empezar a usar un nuevo dispositivo, no te preocupes: tu cuenta está a salvo.
							<br><br>
							Si no crees haber sido tú quien inició sesión, haz clic en el vínculo siguiente para restablecer tu contraseña.
							<br><br>

			<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0; text-align: center;">
				
										<a style="background-color:#00856f;border:1px solid #00856f;border-radius:5px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:50px;text-align:center;text-decoration:none;padding:0 20px;" href="'.$path_site.'resetpass.php" style="text-align: center;"> Cambiar Contraseña </a>
										
			</p>
			</p>						

					
					';		
									
		$foo = '
			<footer>

				<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0">  Recuerda:  </p>
						
						<ul>
						<li style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:16px;margin-bottom:0" > No respondas a este correo</li>
						</ul>
						
					
										    
						'.$pie.'
				
			</footer>
				    
				    
				    ';
						
		$email_destino = $email_user;
						
		break; 
		
		default: 
		break; 
		
	}//switch
	
	//var_dump($message_custom);
	
	$contenido_case = $title_message.$message_custom.$foo;
	$mail_listo = make_mail($contenido_case); 

    $from = "noreply@bricksidemx.com";
    $to = $email_destino;
    $subject = $subject_custom;
    $messagew = $mail_listo;
    
    $headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	//$headers .= 'Bcc:'.$mail_admin . "\r\n";

//dirección del remitente 
	$headers .= "From: BrickShelf Collector <noreply@bricksidemx.com>\r\n"; 
    
	
    mail($to,$subject,$messagew, $headers);
  //  echo $meta;
	
}

function getBrowser(){
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }elseif (preg_match('/macintosh/i', $u_agent)) {
        $platform = 'mac OS';
    }elseif (preg_match('/iPhone OS|iPhone|CriOS| OS 15_/i', $u_agent)) {
        $platform = 'iphone';
    }elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
   
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
        $bname = 'IE';
        $ub = "MSIE";
    }elseif(preg_match('/Firefox/i',$u_agent)){
        $bname = 'Firefox';
        $ub = "Firefox";
    }elseif(preg_match('/Chrome/i',$u_agent)){
        $bname = 'Chrome';
        $ub = "Chrome";
    }elseif(preg_match('/Safari/i',$u_agent)){
        $bname = 'Safari';
        $ub = "Safari";
    }elseif(preg_match('/Opera/i',$u_agent)){
        $bname = 'Opera';
        $ub = "Opera";
    }elseif(preg_match('/Netscape/i',$u_agent)){
        $bname = 'Netscape';
        $ub = "Netscape";
    }
   
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
   
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
   
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
   
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
    
   
}

// now try it


/////////////


function get_estatus_vista($codigo){
	
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM acceso_serie where clave = '$codigo';";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
			
			$coleccion = $row['estado_definido'];
			
		}else{
					
			$coleccion = '0';
		}
	
	return $coleccion;		
	
}


function get_info_status_vista($estado){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM estado_vista_serie where clave = $estado;";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
			
			$coleccion = $row['clave'].'|'.$row['titulo'].'|'.$row['fecha_actualizado'];
			
		}else{
					
			$coleccion = '999|0|0';
		}
	
	return $coleccion;	
	
	
}



function crea_lbl_vista($estado){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM estado_vista_serie where clave = $estado;";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
			
			//$coleccion = $row['clave'].'|'.$row['titulo'].'|'.$row['fecha_actualizado'];
				
					$lbl = '<label class="col-form-label"> <span class="text-'.$row['color'].'" > <i class="'.$row['icono'].'"></i> '.$row['titulo'].' </span>  </label>';
				
				
			
		}else{
					
					$lbl = '<label class="col-form-label"> <span class="text-muted" > <i class="fa fa-ban"></i> No Registrado </span>  </label>';
		}
	

	
	
	return $lbl;	
	
	
}

////

function rand_me(){
	$numa = rand(0,50);
	//echo $num .'-';
	$numb= rand(-50,0);
	//echo $numb .'=';
//	$numa =$num;
	$numr = round((($numa*25)/8)-(8/$numb)*6);
	
	return $numr;
}

function image_back($id){

	if($id >=0 and $id < 10){
		$back='assets/images/legoa.jpg';
	}elseif($id >= 10 and $id < 20){
		$back='assets/images/legob.jpg';
	}elseif($id >= 20 and $id < 40 ){
		$back='assets/images/legoc.jpg';
	}elseif($id >= 40 and $id < 60){
		$back='assets/images/legod.jpg';
	}elseif($id >= 60 and $id < 80){
		$back='assets/images/legoe.jpg';
	}elseif($id >= 80 and $id < 100){
		$back='assets/images/legof.jpg';
	}elseif($id >= 100 and $id < 120){
		$back='assets/images/legog.jpg';
	}elseif($id >= 120 and $id < 140){
		$back='assets/images/legoh.jpg';
	}else{
		$back='assets/images/legoi.jpg';
	}
	
	return $back;
}


//////////////////////


function get_permiso_pagina($id_pag, $id_user){

include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
	$css_b = strtolower($css);
		
	$qb = "SELECT * from permisos_pagina where id_recurso = $id_pag and id_perfil = $id_user and tipo = 1; ";// preparando la instruccion sql
	//var_dump($qb);

//var_dump($qb);
		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['estado']; 
	    	
	    
	    }else{
		    $data = '0'; 
	    }
	    

	return $data; 
	$dbhb->close();	
		
}
//////////

function get_permiso_config($id_pag, $id_user){

include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
	//$css_b = strtolower($css);
		
	$qb = "SELECT * from permisos_pagina where id_recurso = $id_pag and id_perfil = $id_user and tipo = 2; ";// preparando la instruccion sql
	
	//var_dump($qb);

//var_dump($qb);
		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['estado']; 
	    	
	    
	    }else{
		    $data = '0'; 
	    }
	    

	return $data; 
	$dbhb->close();	
		
}

///// 

function get_profile_config($id_user){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
	
		$qb = "SELECT * FROM opciones where estado = 1 order by seccion_padre ;";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$ultimo = 0;
	    	$actual = 0; 
	    	$num = 0; 
			
			while($row= $resultb->fetch_assoc()){
				$num = $num +1;
				$actual = $row['seccion_padre'];
				
				$estado_permiso = get_permiso_config($row['id'],$id_user);
				
				if($estado_permiso==1){
					$chk = 'checked'; 
				}else{
					$chk = '';
				}
								
				if($ultimo != $actual ){
					
					if($num == 1){
						$sep = ''; 
					  }else{
						  $sep = '<hr style="padding:2px 0px; margin:5px 0px;" >'; 
					  }
					  $nom = get_info_seccion($row['seccion_padre']);
					 $title = '<span class="col-1 text-primary" style="font-size:0.7rem;">'.$num.'. </span>
					 	<span class="col-sm-12 text-primary" style="font-size:0.7rem;">'.strtoupper($nom).'</span>';
					 
				}else{
					$num = $num-1;
					$sep = '';
					$title = '';
				}
				
				
				//$url = $GLOBALS['link_site'].'?mnu='.$_GET['mnu'].'&cve='.$_GET['cve'];
				
				$option .= $sep. $title.' 
				
			<div class="row" style="margin-left:20px; border-bottom: 1px dashed rgba(150,150,150,0.4);" >
					
				<div class="col-9 "  >
					<input type="checkbox" style="" id="'.$row['id'].'" value="'.$row['id'].'" data-titulo="'.$row['id'].'" '.$chk.' class="form-check-input" >  
					
					<span class="text-muted" style="width:3%; border-radius:3px; font-size:0.7rem; padding:1px 2px; background:rgba(163,183,196, 0.4); margin-right:2px;" >'.$row['id'].'</span>   
					
					<span class="text-muted" style="font-size:0.9rem;" >'.$row['titulo'].'</span> 
				</div> 
					
					
				<a class="col-1 text-primary" style="font-size:0.9rem; " value="'.$row['id'].'" href="#" onclick="elimina_conf('.$row['id'].')" > 
                    <i class="fa-regular fa-circle-xmark"></i> 
                </a>
				
				<a class="col-1 text-primary" style="font-size:0.9rem; " value="'.$row['id'].'" href="#" onclick="edita_conf('.$row['id'].')" > 
                    <i class="fa-solid fa-square-pen"></i>
                </a>
				
			</div>
				';
				
				$ultimo = $row['seccion_padre'];
				$actual = 0;
			

			}
		}else{
					$option = ''; 
			
		}
	
	
	
	
	/*
	$conf = '
	
	<div class="row" style="font-size: 14px;" >


		<div class="col-md-10 form-check-flat border-right  " style="padding-bottom:3px; padding-top:3px; margin-bottom: 0px; margin-top: 0px; " >
		<h6> Minifiguras</h6>
			
			<label class="form-check-label" style="margin-left:20px;">
				<input type="checkbox" id="" data-titulo=""  data-padre=""   onchange="" class="form-check-input" > 
				<span class="text-muted" style="" > Vista Dev. Minifiguras </span>
				<i class="input-helper"></i>
			</label>
			
			<label class="form-check-label" style="margin-left:20px;">
				<input type="checkbox" id="" data-titulo=""  data-padre=""   onchange="" class="form-check-input" > 
				<span class="text-muted" style="" > Eliminar Minifiguras</span>
				<i class="input-helper"></i>
			</label>
			<label class="form-check-label" style="margin-left:20px;">
				<input type="checkbox" id="" data-titulo=""  data-padre=""   onchange="" class="form-check-input" > 
				<span class="text-muted" style="" > Eliminar Series</span>
				<i class="input-helper"></i>
			</label>
					<hr>
		<h6> Sets</h6>



			<label class="form-check-label" style="margin-left:20px;">
				<input type="checkbox" id="" data-titulo=""  data-padre=""   onchange="" class="form-check-input" > 
				<span class="text-muted" style="" > Eliminar Temas Sets</span>
				<i class="input-helper"></i>
			</label>
			<hr>
		<h6> Usuarios </h6>
			
			<label class="form-check-label" style="margin-left:20px;">
				<input type="checkbox" id="" data-titulo=""  data-padre=""   onchange="" class="form-check-input" > 
				<span class="text-muted" style="" > Eliminar Usuarios</span>
				<i class="input-helper"></i>
			</label>

			<label class="form-check-label" style="margin-left:20px;">
				<input type="checkbox" id="" data-titulo=""  data-padre=""   onchange="" class="form-check-input" > 
				<span class="text-muted" style="" > Eliminar Recibos</span>
				<i class="input-helper"></i>
			</label>

			<label class="form-check-label" style="margin-left:20px;">
				<input type="checkbox" id="" data-titulo=""  data-padre=""   onchange="" class="form-check-input" > 
				<span class="text-muted" style="" > Eliminar Sugerencias</span>
				<i class="input-helper"></i>
			</label>
			
			<hr>

		<h6> Sistema</h6>
			<label class="form-check-label" style="margin-left:20px;">
				<input type="checkbox" id="" data-titulo=""  data-padre=""   onchange="" class="form-check-input" > 
				<span class="text-muted" style="" > Eliminar Menús</span>
				<i class="input-helper"></i>
			</label>
		
			
		
		<hr>
		
		<h6>Permisos de Administrador</h6>
			<label class="form-check-label" style="margin-left:20px;">
				<input type="checkbox" id="" data-titulo=""  data-padre=""   onchange="" class="form-check-input" > 
				<span class="text-muted" style="" > Contraseña Maestra </span>
				<i class="input-helper"></i>
			</label>
		</div>
		
		<br>
	
			
	'; 
	*/
	
	
	$conf = '	
	<div class="row" style="" >
		<div class="col-md-12 form-check-flat " style="padding-bottom:3px; padding-top:3px; margin-bottom: 0px; margin-top: 0px; " >
		<form id="f2" name ="f2" >
			'.$option.'
		</form>
			<input type="hidden" id="code_config" value="" >
		</div>
	</div>
	
	'; 
	
	return $conf;
	
}


////////////

function get_info_seccion($id){

include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
	$css_b = strtolower($css);
		
	$qb = "SELECT * from seccion where clave = $id ";// preparando la instruccion sql
	//var_dump($qb);

//var_dump($qb);
		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['titulo']; 
	    	
	    
	    }else{
		    $data = 'No encontrado'; 
	    }
	    

	return $data; 
	$dbhb->close();	
		
}

////////
function get_total_secciones(){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}		
		
		$css_b = strtolower($css);
			
		$qb = "SELECT * from seccion;";// preparando la instruccion sql
		//var_dump($qb);
	
	//var_dump($qb);
			
		$resultb= $dbh->query($qb);
		
			if ($resultb->num_rows > 0) {
				//$row= $resultb->fetch_assoc();
				
				$data = $resultb->num_rows;
				
			
			}else{
				$data = 0; 
			}
			
	
		return $data; 
		$dbhb->close();	
			
	}

///////
function image_back_minifig($id){

	if($id >=0 and $id < 10){
		$back='minifig/minifig-a.png';
	}elseif($id >= 10 and $id < 20){
		$back='minifig/minifig-d.png';
	}elseif($id >= 20 and $id < 40 ){
		$back='minifig/minifig-a.png';
	}elseif($id >= 40 and $id < 60){
		$back='minifig/minifig-a.png';
	}elseif($id >= 60 and $id < 80){
		$back='minifig/minifig-d.png';
	}elseif($id >= 80 and $id < 100){
		$back='minifig/minifig-a.png';
	}elseif($id >= 100 and $id < 120){
		$back='minifig/minifig-d.png';
	}elseif($id >= 120 and $id < 140){
		$back='minifig/minifig-a.png';
	}else{
		$back='minifig/minifig-d.png';
	}
	
	return $back;
}


////////////////////////////


function list_set_foto($current){
	
	$carpeta = 'assets/images/sets/';
			
		if (is_dir($carpeta)) { //Comprovamos que sea un carpeta Valido
		if ($dir = opendir($carpeta)) {//Abrimos el carpeta
			$sele .= '<ul>';
				while (($archivo = readdir($dir)) !== false){ //Comenzamos a leer archivo por archivo
					if ($archivo != '.' && $archivo != '..'){ 
						$nuevaRuta = $carpeta.$archivo.'/';
						$sele .=  '<li>'; //Abrimos un elemento de lista 
							if (is_dir($nuevaRuta)) { //Si la ruta que creamos es un carpeta entonces:
								$sele .= '<b>'.$nuevaRuta.'</b>'; //Imprimimos la ruta completa resaltandola en negrita
								//listLogo($nuevaRuta);//Volvemos a llamar a este metodo para que explore ese carpeta.
							} else { //si no es un carpeta:
								$sele .= 'Archivo: '.$archivo; //simplemente imprimimos el nombre del archivo actual
								$datos[]=$archivo; 
							}
						$sele .= '</li>'; //Cerramos el item actual y se inicia la llamada al siguiente archivo
					}
				}//finaliza 
			$sele .= '</ul>';//Se cierra la lista
			closedir($dir);//Se cierra el archivo
		}
	}else{//Finaliza el If de la linea 12, si no es un carpeta valido, muestra el siguiente mensaje
		$sele = 'No Existe la carpeta';
	}			
			
			
///////////////		

//$directorio = 'logos/';	
/*
	$directorio=opendir($carpeta);
		$datos=array();
			while ($archivo = readdir($directorio)) { 
			  if(($archivo != '.') && ($archivo != '..')){
			     $datos[]=$archivo; 
			  } 
			}
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
		closedir($directorio);
	*/
	
	
	//var_dump($datos); 
		 //imprimir datos
		 rsort($datos);
		 for($i=0;$i<=count($datos);$i++){

			$findme = '.'; 
			$pos = strpos($datos[$i], $findme);
			 
			if($datos[$i] != ''){
				if($datos[$i] != 'noimage.jpg' && $datos[$i] != 'noimage.png'  && $datos[$i] != '.DS_Store' ){
					
                    
					//var_dump($datos[$i]);
					
					$data_search = explode('.', $datos[$i]);
					$nombre = $data_search[0];
					$ext = $data_search[1];
					
					$nombre_set = get_info_sets_foto($datos[$i]);
					
					$data_nombre_set = explode('|', $nombre_set);
					$ico= $data_nombre_set[0];

                    if($data_nombre_set[1]!=''){
                        $nombre_set_b = strtolower($data_nombre_set[1]);
                        $tema = strtolower($data_nombre_set[2]);
                        //$url_set = $carpeta.$datos[$i];
						$bandera_def = 1;
                    }else{
                        $nombre_set_b = 'No Definido';
						$bandera_def = 0;
                        $tema = 'Sin tema';
                       // $url_set = $carpeta.$datos[$i];
                    }
					
					
					$color = $data_nombre_set[3];
					$f_rec = $data_nombre_set[9];


					$archivo_img = 'assets/images/sets/'.$datos[$i];
					$timestamp = filectime($archivo_img);
                    $size = filesize($archivo_img);
                    $f_size = ($size/1000); // kb
					$date_creation = date("Y-m-d", $timestamp);
					//echo $date; // 21 Septiembre 2016 17:07	
					//$hoy = date("Y-m-d H:i:s");

					// busca ambos formatos

						$file_alt = 'assets/images/sets/'.$datos[$i];
						//var_dump($file_alt);
							
							if(file_exists($file_alt)){
								$flag_otroformat = 1;
								$bnt_otherf = '<button class="btn btn-outline-primary btn_thin" style="padding:2px 5px;" type="button"  onclick="display_img(this.value)"  value="'.$datos[$i].'" ><i class=" fa fa-eye"></i> 	 </button> '; 

							}else{
								$flag_otroformat = 0;
							}

						$file_name = $nombre.'.webp';
						$file_webp = 'assets/images/sets/'.$file_name;
						
							if(file_exists($file_webp)){
									$flag_webpformat = 1;
									$bnt_webpf = '<button class="btn btn-outline-primary btn_thin" style="padding:2px 5px;" type="button"  onclick="display_img(this.value)"  value="'.$file_name.'" ><i class=" fa fa-eye"></i> 	 </button> '; 

							}else{
									$flag_webpformat = 0;
							}
				
							$tag_search = '';
                       /*
                        if($flag_otroformat==1 and $flag_webpformat==1 ){
                            if($ext!='webp'){
                                $ico_webp = '<span class="text-success"><i class="fa-solid fa-file-circle-check" style="margin-right:3px;"></i>WEBP</span>';
                            }else{
                                $ico_webp = '';
                            }
                        }else{
                            $ico_webp = '';
                        }
*/
						if($flag_otroformat==1 and $flag_webpformat==1){
                            
                            if($ext!='webp'){
                                $ico_webp = '<span class="text-success"><i class="fa-solid fa-file-circle-check" style="margin-right:3px;"></i>WEBP</span>';
                                $flag_disp_foto = 0;
                            }else{
                                $ico_webp = '';
                                $flag_disp_foto = 1;
                            }

							$btn_convert = ''; 
							$tag_search .= '';
							
						}else{
							if($ext!='webp'){

							$btn_convert = '<button class="btn btn-outline-primary btn_thin" style="padding:2px 5px;" type="button" id="btn_'.$nombre.'" value="'.$archivo_img.'"  onclick="convierte_webp(this.value);"><i class="fa-solid fa-retweet"></i></button> 
							'; 
								$tag_search .= ' <span>convertir</span> ';
                                $ico_webp = '';
                                $flag_disp_foto = 1;

							}else{
								$btn_convert = ''; 
								$tag_search .= '';
                                $ico_webp = '';
                                $flag_disp_foto = 0;
							}
							
						}
							
                        if($flag_disp_foto == 1){
							
							
							if($bandera_def == 0){
								$n = $n+1;
								
								$url_foto = 'assets/images/sets/'.$datos[$i];
	
								$btn_edita = '<button value="'.$datos[$i].'" onclick="edit_img_set(this.value)" class="btn btn-inverse-primary btn_thin" > <i class="fa fa-pencil" ></i> </button>';
								$btn_ver = '<button class="btn btn-inverse-primary btn_thin" style="padding:2px 5px;" type="button"  onclick="display_img(this.value)"  value="'.$datos[$i].'" ><i class=" fa fa-eye"></i> 	 </button> 
	'; 
								$renglon_no.= '
								
								<tr>
									<td> <span class="text-muted" style="font-size:0.8em;">'.$n.'</span></td>
									<td class="text-muted" style="font-size:0.7em;"> 
										<span '.$color.',0.8);padding: 0px 2px;" onclick="display_img(this.title)" data-custom="'.$nombre_set_b.'" id="'.$nombre.'" title="'.$datos[$i].'" > 
											 <i class="fa fa-image"></i> '.$datos[$i].'
										</span>   
									</td>
									
									<td class="text-muted" style="font-size:0.7em; width:50px;"> 
										<span class="text-muted" style="font-size:0.6rem">'.substr(strtoupper($nombre_set_b),0,28).'</span> <br>
										<span class="text-muted" style="font-size:0.5rem;">'.strtoupper($tema).'</span> <br>
										<span class="text-muted" style="font-size:0.5rem;">'.formatFecha($date_creation).' | '. round($f_size,2).' KB</span>
									</td>							
									
									<td class="text-muted" style="font-size:0.7em;">
	
										<div class="btn-group">
											'.$btn_edita.$btn_ver.'
											'.$btn_convert .' '.$ico_webp.'
										</div>
	
										<span style="display:none;"> '.$tag_search.' </span>
										
										<div class="no-show">
											<img class="no-show" src="data:image/png;base64,'.base64_encode(file_get_contents($url_foto)).'"  id="img_'.$nombre.'"/>
											
											</div>
									</td>
								</tr>
								
								';

							}else{
								$nn = $nn+1;
                            $url_foto = 'assets/images/sets/'.$datos[$i];

							$btn_edita = '<button value="'.$datos[$i].'" onclick="edit_img_set(this.value)" class="btn btn-inverse-primary btn_thin" > <i class="fa fa-pencil" ></i> </button>';
							$btn_ver = '<button class="btn btn-inverse-primary btn_thin" style="padding:2px 5px;" type="button"  onclick="display_img(this.value)"  value="'.$datos[$i].'" ><i class=" fa fa-eye"></i> 	 </button> 
'; 
							$renglon.= '
							
							<tr>
								<td> <span class="text-muted" style="font-size:0.8em;">'.$nn.'.</span></td>
								<td class="text-muted" style="font-size:0.7em;"> 
									<span '.$color.',0.8);padding: 0px 2px;" onclick="display_img(this.title)" data-custom="'.$nombre_set_b.'" id="'.$nombre.'" title="'.$datos[$i].'" > 
                                         <i class="fa fa-image"></i> '.$datos[$i].'
                                    </span>   
								</td>
								
								<td class="text-muted" style="font-size:0.7em; width:50px;"> 
									<span class="text-muted" style="font-size:0.6rem">'.substr(strtoupper($nombre_set_b),0,28).'</span> <br>
									<span class="text-muted" style="font-size:0.5rem;">'.strtoupper($tema).'</span> <br>
									<span class="text-muted" style="font-size:0.5rem;">'.formatFecha($date_creation).' | '. round($f_size,2).' KB</span>
                                </td>							
								
                                <td class="text-muted" style="font-size:0.7em;">

									<div class="btn-group">
										'.$btn_edita.$btn_ver.'
										'.$btn_convert .' '.$ico_webp.'
									</div>

									<span style="display:none;"> '.$tag_search.' </span>
                                    
                                    <div class="no-show">
                                        <img class="no-show" src="data:image/png;base64,'.base64_encode(file_get_contents($url_foto)).'"  id="img_'.$nombre.'"/>
                                        
                                        </div>
                                </td>
							</tr>
							
							';
							}
                        }else{
                            $renglon.= '';
							$renglon_no.= '';
                        }
				}
				
			}
			
		  } // for 

                  
	$campo_buscar = crea_campo_buscar_cust('sets_fotos',12);
	$campo_buscar_no = crea_campo_buscar_cust('sets_fotos_no',12);  
	//echo $campo_buscar; 
	
			  
		  
		  $opt = 
		 '
		<div class="col-md-12 mnu_bar center " style="margin-bottom:10px;">
			<div class=" btn-group-bar" role="group"  style="margin-bottom:-5px;"> 
				<button id="imagesetop_1" type="button" onclick="barmenu(this.id)" class="btn btn-primary btn_menubar_lg btn_menubar_active imagesetop imagesetop_lg"> Registrados ('.$nn.') </button>
				<button id="imagesetop_2" type="button" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar_lg imagesetop imagesetop_lg"> No Registrado ('.$n.')</button>
			</div>
		</div>

		 <div id="div_imagesetop_1" class="col-md-12" style="height:430px; overflow: scroll; overflow-y: auto; overflow-x: hidden;">
		 		'.$campo_buscar.'

			<table  class="sortable table table-striped" id="sets_fotos" style="padding:2px; " >
				<thead>
					<tr>
					<th class="bg-head"> No</th>
					<th class="bg-head"> Imagen</th>
					<th class="bg-head"> Serie</th>
					<th class="bg-head"> Ver</th>
					</tr>
				</thead>
				
				<tbody>
					'.$renglon.'
				</tbody>
			</table>
		</div>
		
		<div id="div_imagesetop_2" class="col-md-12" style="display:none; height:430px; overflow: scroll; overflow-y: auto; overflow-x: hidden;">
			'.$campo_buscar_no.'
			<table  class="sortable table table-striped" id="sets_fotos_no" style="padding:2px; " >
				<thead>
					<tr>
					<th class="bg-head"> No</th>
					<th class="bg-head"> Imagen</th>
					<th class="bg-head"> Serie</th>
					<th class="bg-head"> Ver</th>
					</tr>
				</thead>
				
				<tbody>
					'.$renglon_no.'
				</tbody>
			</table>
		</div>
		  ';
		  
		  $sel = $opt; 
		  
	return  $sel; 
} 


//////////////////

function get_info_sets_foto($cve){
	
	include("access.php");
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

	$qb = "SELECT * FROM sets where cve_lego = '$cve' group by cve_lego order by fecha_add desc";// preparando la instruccion sql
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	//$data = $row['nombre']; 
	    					$data = getinfotema($row['id_tema']); 
	                      
							$datab = explode('|', $data);
							
							$s_nombre = $datab[0];
							$s_color = $datab[1];
							$s_logo = $datab[2];
							
							$list_temas = '<option value="0" selected >Elije...</option>'.generaListTemas($row['id_tema']);
	    	
	    $data = '<span class="text-success"> <i class="fa fa-check-circle"></i></span>'.'|'.$row['nombre'].'|'.$s_nombre.'|'.$s_color.'|'.$row['piezas'].'|'.$row['precio'].'|'.$row['no_minifig'].'|'.$list_temas.'|'.$row['anio_public'].'|'.$row['fecha_add'];
	    	
	    }else{
		//    $data = 'No encontrado'; 
		    $data = '<span class="text-warning"> <i class="fa fa-times-circle"></i> </span>';
	    }
	
	//$data = $total_serie; 
	return $data; 
	$dbhb->close();
	
}

///////


function valida_foto_tipo($foto,$tipo){
	
    //	var_dump($foto.'-'.$tipo);
        
        
        if($tipo==1){
            $path = $GLOBALS['path_sets'];
            $no_foto = 'noimage.png'; 
        }elseif($tipo==2){
            $path = $GLOBALS['path_logos'];
            $no_foto = 'noimage.png'; 
        }elseif($tipo==3){
            $path = $GLOBALS['path_portada'];
            $no_foto = '0000.png'; 
        }elseif($tipo==4){
            $path = $GLOBALS['path_folleto'];
            $no_foto = 'sheet0.png'; 
        }elseif($tipo==5){
            $path = $GLOBALS['path_caja'];
            $no_foto = 'caja0.png'; 
        }elseif($tipo==6){
            $path = $GLOBALS['path_empaque'];
            $no_foto = 'empaque0.png'; 
        }elseif($tipo==7){
            $path = $GLOBALS['path_fondo'];
            $no_foto = 'noimage.png'; 
        }
        
        //var_dump($tipo);
        
    
                                    if(file_exists($path.$foto.'.webp')) {
                                           
                                           $foto_enc = $foto.'.webp';
                                           
                                    } else {
                                        
                                        if(file_exists($path.$foto.'.jpeg')){
                                            //echo "The file exists";
                                            $foto_enc = $foto.'.jpeg';
                                            
                                        }else{
                                        //echo "The file does not exist";
                                            //$foto_portada = '0.png';	
                                                if(file_exists($path.$foto.'.png')){
                                                    
                                                    $foto_enc = $foto.'.png';
                                                    
                                                }else{
                                                //echo "The file does not exist";
                                                    //$foto_enc = $no_foto;
    
                                                        if(file_exists($path.$foto.'.jpg')){
                                                    
                                                            $foto_enc = $foto.'.jpg';
                                                            
                                                        }else{
                                                        //echo "The file does not exist";
                                                            $foto_enc = $no_foto;		
                                                        }
                                                }								    	
                                                    
                                        }
                                    }		
                                    
            //var_dump($path.$foto_enc);		
            
        
        return $path.$foto_enc;
        
    }

//////

function valida_foto_tipo_adv($foto,$tipo){
	
//	var_dump($foto.'-'.$tipo);
	
	
	if($tipo==1){
		$path = $GLOBALS['path_sets'];
		$no_foto = 'noimage.png';
        $img_tipo = 'set';
	}elseif($tipo==2){
		$path = $GLOBALS['path_logos'];
		$no_foto = 'noimage.png'; 
        $img_tipo = 'logos ';
	}elseif($tipo==3){
		$path = $GLOBALS['path_portada'];
		$no_foto = '0000.png'; 
        $img_tipo = 'portada';
	}elseif($tipo==4){
		$path = $GLOBALS['path_folleto'];
		$no_foto = 'sheet0.png'; 
        $img_tipo = 'set';
	}elseif($tipo==5){
		$path = $GLOBALS['path_caja'];
		$no_foto = 'caja0.png'; 
        $img_tipo = 'set';
	}elseif($tipo==6){
		$path = $GLOBALS['path_empaque'];
		$no_foto = 'empaque0.png'; 
        $img_tipo = 'set';
	}elseif($tipo==7){
		$path = $GLOBALS['path_fondo'];
		$no_foto = 'noimage.png'; 
        $img_tipo = 'set';
	}
	
	//var_dump($tipo);
	

    $image_set_existente = comprueba_image($foto,$img_tipo);
   // var_dump($image_set_existente);

    $data_image = explode('.',$image_set_existente);
    $img = $data_image[0];
    $ext= $data_image[1];

    if($img != 'noimage'){

        if($ext=='webp'){
            $foto_enc = $foto.'.webp';
        }else{

            $img_url = $path.$image_set_existente;
            //var_dump($img_url);

            //$file_folleto_b = convert_to_webp_url_gral($img_url);
			$file_folleto_b = webpConvert2($img_url);
            // var_dump($file_folleto_b);


            $data_url = explode('/', $file_folleto_b);
            $ultimo = (count($data_url)-1);
            
            $foto_enc = $data_url[$ultimo];
         

        }
    }else{
        $foto_enc = $no_foto;
    }

   // var_dump($foto_enc);

    if(file_exists($path.$foto_enc)) {
								       
        $foto_enc = $foto_enc;
        
    } else {
        $foto_enc = $image_set_existente;
       // $foto_enc = $path.$no_foto;
    }
    /*
                            if(file_exists($path.$foto.'.webp')){
                                                                        
                                $foto_enc = $foto.'.webp';
                                
                            }else{
								if(file_exists($path.$foto.'.jpg')) {
								       
								       $foto_enc = $foto.'.jpg';
								       
								} else {
									
									if(file_exists($path.$foto.'.jpeg')){
										//echo "The file exists";
										$foto_enc = $foto.'.jpeg';
										
									}else{
								    //echo "The file does not exist";
								    	//$foto_portada = '0.png';	
											if(file_exists($path.$foto.'.png')){
												
												$foto_enc = $foto.'.png';
												
											}else{
												$foto_enc = $no_foto;		
											}
                                                 
											}								    	
								    			
									}
								}	
    */	
								
		//var_dump($path.$foto_enc);		
		
	
	return $path.$foto_enc;
	
}



function generaListPerfiles($actual){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM perfiles where estado = 1 order by cve_perfil ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        $code = getLetraByPosition($row['id']);
	                        
	                        if($row['id']== $actual){
		                         $opt .= '<option selected value="'.$code.'">'.$row['nombre'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$code.'">'.$row['nombre'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }
	            
	            $sel = $opt;
	
	//$data = $total_serie; 
	return $sel; 
	$dbhb->close();	
		
}
//////

function generaSelectCupones($actual){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM cupones where estado < 51 ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        $code = getLetraByPosition($row['id']);
	                        
	                        if($row['id']== $actual){
		                         $opt .= '<option selected value="'.$row['id'].'">'.$row['titulo'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$row['id'].'">'.$row['titulo'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }
	            
	            $sel = $opt;
	
	//$data = $total_serie; 
	return $sel; 
	$dbhb->close();	
		
}

function getLetraByPosition($index){
    #Crea un array con las letras de la A a la Z
    $alphabet = range('A', 'Y');
    #Seteamos la posición restando 1 porque los índices comienzan en 0
    $pos=$index-1;
    #Retornamos la letra, o NULL, si $index desborda el array
    #Para evitar que true sea tratado como índice 1, controlamos con is_bool también
    return ( !empty($alphabet[$pos]) && !is_bool($index) ) ? $alphabet[$pos] : 'Z';
}



function generaListTiposerie($tema_actual){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM tipo_serie where estado = 1 ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        $code = getLetraByPosition($row['id']);
	                        
	                        if($row['id']== $tema_actual){
		                         $opt .= '<option selected value="'.$code.'">'.$row['nombre'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$code.'">'.$row['nombre'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }
	            
	            $sel = $opt;
	
	//$data = $total_serie; 
	return $sel; 
	$dbhb->close();	
	
	
	
}


function generaListPermisoVistaSerie($tema_actual){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM estado_vista_serie where estado = 1 ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                       // $code = getLetraByPosition($row['id']);
	                        
	                        if($row['id']== $tema_actual){
		                         $opt .= '<option selected value="'.$row['clave'].'">'.$row['titulo'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$row['clave'].'">'.$row['titulo'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }
	            
	            $sel = $opt;
	
	//$data = $total_serie; 
	return $sel; 
	$dbhb->close();	
	
	
	
}



function generaListEstadoSerie($tema_actual){
	
	$deb = 0;

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM estado_serie where estado = 1 ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        $code = getLetraByPosition($row['id']);
	                        
	                        if($deb==1){
	                        	$debug = ' - ID:'.$row['id'].' - CVE:'.$row['clave'].' -CODE:'.$code;
	                        }else{
		                        $debug='';
	                        }
	                        
	                        if($row['id']== $tema_actual){
		                         $opt .= '<option selected value="'.$code.'">'.$row['nombre'].$debug.'</option>';
	                        }else{
		                        $opt .= '<option value="'.$code.'">'.$row['nombre'].$debug.'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }
	            
	            $sel = $opt;
	
	//$data = $total_serie; 
	return $sel; 
	$dbhb->close();	
	
	
	
}



function generaListPerfilesCode($tema_actual){
	$deb = 0;

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM perfiles";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                       $code = getLetraByPosition($row['id']);
                          
                          if($row['estado']==1){
                            $estados = '';
                            $clase = '';
                          }else{
                            $estados = 'disabled';
                            $clase='text-clear bd-muted';
                          }
	                        
	                        if($deb==1){
	                        	$debug = ' - ID:'.$row['id'].' - CVE:'.$row['cve_perfil'].' -CODE:'.$code;
	                        }else{
		                        $debug='';
	                        }
	                        	                        	
		                         $opt .= '<option '.$estados.'  value="'.$code.'" class="'.$clase.'">'.$row['nombre'].$debug.' </option>';
	                        
	                        
	                    }
	            }else{
		            
	            }
	            
	            $sel = $opt;
	
	//$data = $total_serie; 
	return $sel; 
	$dbhb->close();	
	
}

function generaListEstadoUserOpcional($actual){
	$deb = 0;

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM estado_user_serie_opcional  ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        $code = getLetraByPosition($row['id']);
	                        
	                        if($deb==1){
	                        	$debug = ' - ID:'.$row['id'].' - CVE:'.$row['clave'].' -CODE:'.$code;
	                        }else{
		                        $debug='';
	                        }
	                        
	                        if($row['id']==$actual){
		                         $opt .= '<option selected value="'.$code.'">'.$row['nombre'].$debug.' </option>';
	                        }else{
		                         $opt .= '<option  value="'.$code.'">'.$row['nombre'].$debug.' </option>';
	                        }
	                        	                        	
		                        
	                        
	                        
	                    }
	            }else{
		            
	            }
	            
	            $sel = $opt;
	
	//$data = $total_serie; 
	return $sel; 
	$dbhb->close();	
	
}


function get_permiso_coleccion($codigo){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM acceso_serie where clave = '$codigo';";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
			
			$coleccion = $row['estado_definido'];
			
		}else{
					
			$coleccion = '0';
		}
	
	return $coleccion;	
	//return $qb;
		
}

/////////

function get_permiso_coleccion_grid($codigo){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM acceso_serie where clave = '$codigo';";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
	
		if ($resultb->num_rows > 0) {
			$row= $resultb->fetch_assoc();
			
			$coleccion = $row['estado_definido'];
			
		}else{
					
			$coleccion = '-1';
		}
	
	return $coleccion;	
	//return $qb;
		
}

/////

function save_serie_opcional($id_user, $data_serie){
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);


					$data = explode('-', $data_serie);
					$serie = $data[0];
					$permiso = $data[1];
						
					$hoy = date("Y-m-d H:i:s");
				
					
						if ($dbh->connect_error) {
							  die("Connection failed: " . $dbh->connect_error);
						}
						
			 		$q = "SELECT * FROM permiso_serie_opcional WHERE id_user = $id_user and clave_serie = $serie;";
			 		$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) {

						$qe = "UPDATE permiso_serie_opcional SET permiso_asignado = $permiso, fecha_actualizado = '$hoy' where id_user = $id_user and clave_serie = $serie";// preparando la instruccion sql
						
						if (mysqli_query($dbh, $qe)) {
							$res =  1; 
						} else {
					    	$res = 0; 
					    }					    

					
					}else{
						
			$qb = "INSERT INTO permiso_serie_opcional (id, id_user, clave_serie, permiso_asignado, permiso_admin, estado, fecha_registro, fecha_actualizado ) VALUES ('',".$id_user.", ".$serie.", ".$permiso.",1, 1,'".$hoy."', '".$hoy."')";
						// preparando la instruccion sql
						
						   if (mysqli_query($dbh, $qb)) {
								$res = 2; 
							} else {
								$res = 3; 
						    }
						    
						   // var_dump($qb);
					}	
	return $res;
	
}

function save_serie_opcional_admin($id_user, $data_serie){
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);


					$data = explode('-', $data_serie);
					$serie = $data[0];
					$permiso = $data[1];
						
					$hoy = date("Y-m-d H:i:s");
				
					
						if ($dbh->connect_error) {
							  die("Connection failed: " . $dbh->connect_error);
						}
						
			 		$q = "SELECT * FROM permiso_serie_opcional WHERE id_user = $id_user and clave_serie = $serie;";
			 		$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) {

						$qe = "UPDATE permiso_serie_opcional SET  permiso_asignado = $permiso, permiso_admin = $permiso, fecha_actualizado = '$hoy' where id_user = $id_user and clave_serie = $serie";// preparando la instruccion sql
						
						if (mysqli_query($dbh, $qe)) {
							$res =  1; 
						} else {
					    	$res = 0; 
					    }					    

					
					}else{
						
			$qb = "INSERT INTO permiso_serie_opcional (id, id_user, clave_serie, permiso_asignado, permiso_admin, estado, fecha_registro, fecha_actualizado ) VALUES ('',".$id_user.", ".$serie.", 0, ".$permiso.", 1,'".$hoy."', '".$hoy."')";
						// preparando la instruccion sql
						
						   if (mysqli_query($dbh, $qb)) {
								$res = 2; 
							} else {
								$res = 0; 
						    }
						    
						   // var_dump($qb);
					}	
	return $res;
	
}

//////////


function get_id_perfil($cve_user){

	include("access.php");

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}		
		
	$qb = "SELECT * FROM perfiles where cve_perfil = $cve_user ";
	
		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	//id, id_recibo, id_user, id_venta, fecha_venta, cantidad_prod, nombre_prod, descripcion_prod, precio_prod, moneda_prod, nombre_comp, correo_comp, telefono_comp, id_pago, estado_recibo 
	    	$data = $row['id']; 
	    	
	    
	    }else{
		    
		    $data = '0'; 
	    }
	    
//var_dump($qb);

	return $data; 
	$dbhb->close();		
	
}


/////////


function genera_check_series_premium_admin_perfil($user_id){
	//var_dump($user_id);

include("access.php");

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}		
		$no = 0; 
	$qb = "SELECT * FROM series where premium = 1 and estado between 1 and 98 order by fecha_lanzamiento";// preparando la instruccion sql
		$results= $dbh->query($qb);
	    if ($results->num_rows > 0) {
		  
			while($row = $results->fetch_assoc()){
				
				$no = $no +1;
				$estado_pago = get_status_pago($row['clave_lego'], $user_id);
				$permiso_pago = get_permiso_pago($row['clave_lego'], $user_id);
				
				$info_pago = get_info_permiso_pago($row['clave_lego'], $user_id);
				
				//var_dump($info_pago);
				
					$data_info_pago = explode('|', $info_pago);
					$fecha_reg = $data_info_pago[0];
					$fecha_actualiza = formatFechaHoraTable($data_info_pago[1]);
					$id_user_asignante = $data_info_pago[2];
					
				if($id_user_asignante != 0){
					
				$info_user_asignante = busca_user($id_user_asignante);
					$data_user_a = explode('--', $info_user_asignante);
				
					$user_name_asignante = $data_user_a[3];
				}else{
					$user_name_asignante = '<span class="text-clear" >Sin Asignar</span>';
				}
				
				//$permit = get_permiso_config(19,$user_id);
				//var_dump($permit);
		
				
				// integrar el estatus de permiso de pago.
				// 1. pago excento 
				// 0. debe realizar pago
				
				if($permiso_pago==0){
				
					if($estado_pago==0){
						$per_icon = 'unlock';
						$edo_icon = 'credit-card'; 
						$label_pago = 'Exentar pago';
						$btn_style='btn-neon ';
						$fx = 'valida_pago(this.id);';
						$estado_permiso = 'Pago Requerido';
						$color_status = 'text-muted';
						
					}else{
						$label_pago =  'Ver Recibo'; 
						$per_icon = 'receipt'; 
						$edo_icon = 'receipt';
						$btn_style='btn-outline-secondary';
						$fx='';
						$estado_permiso = 'Pagado';
						$color_status = 'text-clear';
					}
					
					$fecha_dummy = '0000-00-00 00:00:00'; 
					
					$fecha_actualiza = '<span class="text-clear"> <i class="fa-solid fa-minus"></i> </span>';
					$user_name_asignante = '<span class="text-clear"> <i class="fa-solid fa-minus"></i> </span>';
					
				}else{

					
						$label_pago =  'Requerir Pago'; 
						$per_icon = 'credit-card'; 
						$edo_icon = 'unlock'; 
						$btn_style='btn-outline-neon ';
						$fx = 'valida_pago(this.id);';
						$estado_permiso = 'Pago Exento';
						$color_status = 'text-success';
						
						$fecha_actualiza = formatFechaHoraTable($data_info_pago[1]);
						$user_name_asignante = $data_user_a[3];
								
				}
				

				$status = '<span class="col-md-3 '.$color_status.'" style="font-size:12px; margin-top:5px; margin-right:10px;" ><i class="fa fa-'.$edo_icon.'" ></i> '.$estado_permiso.' </span>';
	
					$forms .= '
					<div class="form-check form-check-flat border-bottom " style="padding-bottom:5px; padding-top:5px; " >
						
						
						<input type="hidden" '.$stat.' class="" id="chkk_serie_'.$row['clave_lego'].'_'.$user_id.'" value="'.$status_admin.'" '.$val.'> 
						
						<div class="row " role="group" >
							'.$status.'
							<div class="col-sm-3">
								
								<button type="button" class="btn '.$btn_style.' btn-sm " id="'.$row['clave_lego'].'_'.$user_id.'" onclick="'.$fx.'" style="padding:5px 10px; font-size:11px; text-align:left;  " value="'.$estado_pago.'" > 	<i class="fa fa-'.$per_icon.'"></i> '.$label_pago.'</button>
							</div>
												
							<span style="font-size:12px; margin-left:15px; margin-top:5px;  " class="col-sm-4 text-muted" > '.$row['clave_lego'].' - '.$row['nombre'].' '.$ico_info .'</span>
						</div>
													
				    </div>
				';
							
				
				$rows_table .= '
				
					<tr class="text-muted">
						<td class="text-muted" > '.$no.' </td>
						<td class="text-muted"> '.$row['nombre'].' </td>
						<td class="text-muted"> '.$row['clave_lego'].' </td>
						<td class="text-muted"> '.$status.' </td>
						<td class="text-muted"> '.$fecha_actualiza.' </td>
						<td class="text-muted"> '.$user_name_asignante.' </td>
						<td> <button type="button" class="btn '.$btn_style.' btn-sm " id="'.$row['clave_lego'].'_'.$user_id.'" onclick="'.$fx.'" style="padding:5px 10px; font-size:11px; text-align:left;  " value="'.$estado_pago.'" > 	<i class="fa fa-'.$per_icon.'"></i> '.$label_pago.'</button> </td>
					</tr>
				'; 
				
			  
			}
		}
		
		
		//$campo_buscar = crea_campo_buscar('premium');
		$campo_buscar = crea_campo_buscar_cust('series_premium',3); 
		$forms = '
		
				                				
					<table id="series_premium" class="table table-striped table-bordered" style="background: #fff;">
                      <thead >
                        <tr>
                        	<th class="thead_content" > No  </th>
							<th class="thead_content" > Colección </th>
							<th class="thead_content" > Clave </th>
							<th class="thead_content" > Estado </th>
							<th class="thead_content" > Fecha Permiso </th>
							<th class="thead_content" > Asignado por: </th>
							<th class="thead_content" > Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
					  		'.$rows_table.'
                      </tbody>
                      <tfooter >
                        <tr>
                        	<th class="thead_content" > No  </th>
							<th class="thead_content" > Colección </th>
							<th class="thead_content" > Clave </th>
							<th class="thead_content" > Estado </th>
							<th class="thead_content" > Fecha Permiso </th>
							<th class="thead_content" > Asignado por: </th>
							<th class="thead_content" > Opciones</th>
                        </tr>
                      </tfooter>                      
                      
                      
                    </table>
		
		
		';
		
		return $campo_buscar.$forms; 
		//return $qs;
	$dbh->close();


}


///////////////////////////

function genera_check_series_opcionales_admin_perfil($user){

include("access.php");

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}		
	$no = 0; 
	
		
	$qb = "SELECT * FROM series where tipo = 3 and estado between 1 and 98 order by fecha_lanzamiento";// preparando la instruccion sql
		$results= $dbh->query($qb);
	    if ($results->num_rows > 0) {
		  
			while($row = $results->fetch_assoc()){
				$no = $no +1;
				
				$series_op .= $row['clave_lego'].';';
				
				if($row['estado'] != 1 ){
					$stat = 'disabled=""';
					$view = 'title="Esta colección no puede seleccionarse o no será visible, estará habilitada una vez que el administrador la active."';
					$txt_adv ='Esta colección no puede seleccionarse o no será visible, estará habilitada una vez que el administrador la active.'; 
					$text = 'text-gris'; 
					$ico_info = '<span '.$view.'> <i class="fas fa-info-circle"></i> </span>'; 
					$fx = '';
					 
				}elseif($row['estado'] == 3 ){
					$stat = '';
					$text = 'text-neutral';
					$view = '';
					$txt_adv = ''; 
					$ico_info = ''; 
					$fx = 'onclick="valida_opcionales(this.id);"';
				}else{
					$stat = '';
					$text = 'text-neutral';
					$view = '';
					$txt_adv = ''; 
					$ico_info = ''; 
					$fx = 'onclick="valida_opcionales(this.id);"';
				}
				
				//
				$status_user = get_status_series_opcional($user, $row['clave_lego']);
				$status_admin = get_status_series_opcional_admin($user, $row['clave_lego']);		

////


				$info_pago = get_info_permiso_opcional($row['clave_lego'], $user);
			//	var_dump($info_pago);
				
					$data_info_pago = explode('|', $info_pago);
					$fecha_reg = $data_info_pago[0];
					$fecha_actualiza = formatFechaHoraTable($data_info_pago[1]);
					$id_user_asignante = $data_info_pago[2]; 
					

					$info_user_asignante = busca_user($id_user_asignante);
				if($id_user_asignante != 0){
					
				
					$data_user_a = explode('--', $info_user_asignante);
				
					$user_name_asignante = $data_user_a[3];
				}else{
					$user_name_asignante = '<span class="text-clear" >Sin Asignar</span>';
				}					
///////////////////////

				if($status_admin==1){ // permitido
					
					$per_icon = 'fa-solid fa-user-slash';
					$lbl_btn = 'Bloquear';  
					$btn_style='btn-inverse-danger';
				
					if($status_user==1){
						$val = 'checked=""';
						$stat = '';
						$text = 'text-muted';
						$ico_user_select = 'fa-solid fa-user-check';
						$label_status = '<span class="text-success" style="font-size:12px; margin-top:5px; margin-right:10px;" ><i class="'.$ico_user_select.'"></i> Activa</span>'; 
						$color_status = 'text-success';
						
					}elseif($status_user==0){
						$val = ''; 
						$stat = '';
						$text = 'text-muted';
						$ico_user_select = 'fa-solid fa-user-xmark';
						$label_status = '<span class="text-clear" style="font-size:12px; margin-top:5px; margin-right:10px;"> <i class="'.$ico_user_select.'"></i> No Activa</span>';
						$color_status = 'text-muted';
					}
					
					$fecha_actualiza = '<span class="text-clear"> <i class="fa-solid fa-minus"></i> </span> ';
					$user_name_asignante = '<span class="text-clear"> <i class="fa-solid fa-minus"></i> </span> ';
				
				}elseif($status_admin==0){ // no permitido
					
					$text = 'text-muted';
					$stat = 'disabled=""';
					$view = 'title="Esta colección ha sido bloqueada para su perfil."';
					$ico_info .= '<span '.$view.'> <i class="fas fa-ban"></i> </span>'; 
					$btn_style='btn-inverse-primary';
					
					$val = ''; 
					$per_icon = 'fa-solid fa-user'; 
					$lbl_btn = 'Permitir';  
					$ico_user_select = 'fa-solid fa-ban'; 
					$label_status = '<span class="text-danger" style="font-size:12px; margin-top:5px; margin-right:10px;"> <i class="'.$ico_user_select.'"></i> Restringida </span>'; 
					$color_status = 'text-clear';
					
					$fecha_actualiza = formatFechaHoraTable($data_info_pago[1]);
					$user_name_asignante = $data_user_a[3];

				}


                // Obtiene informacion del usuario admin  (perfil)

                $info_user = busca_user($GLOBALS['user']);
                $data_user = explode('--',$info_user);
                $error = $data_user[0];
                $nombre = $data_user[1];
                $correo = $data_user[2];
                $user_nameb = $data_user[3];
                $foto = $data_user[4];
                $perfil_user = $data_user[5];

                ///// etiqueta Tipo 

	                        $ico_tipo_serie = get_ico_tipo_serie($row['tipo']);
	                        
	                        $data_ico = explode('|', $ico_tipo_serie);
	                        $icono_s = $data_ico[0];
	                        $nombre_s = $data_ico[1];
	                        $color_s = $data_ico[2];

                            $tipo = '<span class="text-'.$color_s.'" style="font-size:0.6rem;" title="'.$nombre_s.'" > '.strtoupper($nombre_s).' </span>';

                            
                ////

                //// Premium 
                if($row['premium']==1){
                    $ico_premium = '<span class="ico_premium" title="Serie Premium" style="font-size:1rem;" > <i class="fa-solid fa-bookmark"></i>  </span>';
                }else{
                    $ico_premium = ''; 
                }

                /////////
                

                $id_estado = get_info_estado_serie($row['estado']);
			    $data_estado = explode('/', $id_estado);
                $ico_edo = $data_estado[1];
                $nombre_edo ='<span class="" title="" style="font-size:0.6rem;" > '. strtoupper($data_estado[3]).'</span>';


                ////////

				
				$chk_serie = '<input type="checkbox" class="form-control" id="chk_'.$row['clave_lego'].'" onclick="select_series();" value="'.$row['clave_lego'].'" /> ';

                $permiso_restringe = get_permiso_config('33',$perfil_user);

                if($permiso_restringe==1){

                            $btn_rest_b = '
                            
                            <button type="button" class="btn '.$btn_style.' " id="'.$row['clave_lego'].'_'.$user.'" '.$fx.' '.$permiso_restringe.'
							style="font-size:11px; text-align:center; padding:5px 10px;" value="'.$status_admin.'" > 	
							<i class="'.$per_icon.'"></i> '.$lbl_btn.' </button>
                            '; 
                }else{

                            $btn_rest_b = '
                            
                            <button type="button" class="btn '.$btn_style.' " disabled id="'.$row['clave_lego'].'_'.$user.' '.$permiso_restringe.' " 
							style="font-size:11px; text-align:center; padding:5px 10px;" value="'.$status_admin.'" > 	
							<i class="'.$per_icon.'"></i> '.$lbl_btn.' </button>
                            '; 
                }				

				
				if($status_user != -1){
					
	
					$forms .= '
					<div class="form-check form-check-flat border-bottom " style="padding-bottom:5px; padding-top:5px;" >
						
						
						<input type="hidden" '.$stat.' class=""  id="chkk_serie_'.$row['clave_lego'].'_'.$user.'" value="'.$status_admin.'" '.$val.'> 
							
						<div class="row" >
							<span class="col-md-4 text-muted" title="Solo el usuario puede seleccionar la serie."  style="padding:2px 3px; font-size:14px; text-align:left; width:10%"> 	
							<i class="'.$ico_user_select .' '.$color_status.'"></i> <span class="'.$color_status.'" style="margin-left:3px; margin-top:5px;  " >'.$label_status.'</span>
							</span>
													
							<div class="col-sm-3 btn-group" role="group">						
                                '.$btn_rest_b.'
                            </div>
							
							<span style="font-size:13px; margin-left:3px; margin-top:5px;  " class="col-sm-4 '.$text.'" > '.$row['clave_lego'].' - '.$row['nombre'].' '.$ico_info .'</span>
						</div>
													
				    </div>
				';

		/*
          <button class="btn '.$btn_style.' " id="'.$row['clave_lego'].'_'.$user.'" '.$fx.' 
							style="font-size:11px; text-align:center; padding:5px 10px;" value="'.$status_admin.'" > 	
							<i class="fa fa-'.$per_icon.'"></i> '.$lbl_btn.' </button>
        */					
				
				}

				$link_detalle = $link_site.'?mnu=edab7083e4d6a72dda1675d0b4878ee3&item='.$row['clave_lego'].'&element=d048a1ffc387b756bc18622e4ca06531&q='.$user;
				$link_cve = '<a class="" style="font-size:0.6rem;" title="Ver Detalles Coleccion" target="_blank" href="'.$link_detalle.'"> Ver Coleccion </a>'; 
				
				$data_coleccion = $user.';'.$row['clave_lego']; 
				$total_coleccion = busca_info_coleccion($data_coleccion);

				$rows_table .= '
				
					<tr class="text-muted">
                    
                        <td class="text-muted center"> '.$chk_serie.' </td>
						<td class="text-muted center"> '.$no.' </td>
                        <td class="text-muted center"> '.$row['clave_lego'].' </td>
						<td class="text-muted"> 
                            <div class="row">
                                <div class="col-sm-2">'.$ico_premium.'</div>
                                <div class="col-sm-6">
									'.$row['nombre'].' <br> 
									'.$tipo.' <span style="font-size:0.6rem;"> | </span> '.$nombre_edo.' <br>
									<span class="text-muted" style="font-size:0.6rem;">'.$total_coleccion .' figs. | </span>  '.$link_cve.'
								</div>
							</div> 
                        </td>
						<td class="text-muted center"> '.$label_status.' </td>
						<td class="text-muted center"> '.$fecha_actualiza.' </td>
						<td class="text-muted center"> '.$user_name_asignante.' </td>
						<td class="text-muted center"> '.$btn_rest_b.' </td>
					</tr>
				'; 
								
			  
			}
		}
		
	//	$forms = $forms.'<input type="hidden" id="current_series_op_conf_'.$user.'" value="'.$series_op.'" >';
	
	 	//$campo_buscar = crea_campo_buscar('opcionales');
		 $campo_buscar = crea_campo_buscar_cust('series_opcionales',3); 

		$forms = '
                    <input type="hidden" id="current_series_op_conf_'.$user.'" value="'.$series_op.'" />
				                				
					<table id="series_opcionales" class="table table-striped" style="background: #fff;">
                      <thead >
                        <tr>
                            <th class="thead_content" > <input type="checkbox" class="" id="99" onclick="select_series(this.id);" value="99" /> </th>
                        	<th class="thead_content" > No  </th>
                            <th class="thead_content" > Clave </th>
							<th class="thead_content" > Colección </th>							
							<th class="thead_content" > Estado </th>
							<th class="thead_content" > Fecha Restricción </th>
							<th class="thead_content" > Restringida por: </th>
							<th class="thead_content" > Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
					  		'.$rows_table.'
                      </tbody>
                      <tfooter >
                        <tr>
                            <th class="thead_content" >  </th>
                        	<th class="thead_content" > No  </th>
                            <th class="thead_content" > Clave </th>
							<th class="thead_content" > Colección </th>
							<th class="thead_content" > Estado </th>
							<th class="thead_content" > Fecha Restricción </th>
							<th class="thead_content" > Restringida por: </th>
							<th class="thead_content" > Opciones</th>
                        </tr>
                      </tfooter>                      
                      
                      
                    </table>
		
		
		';
				
		return $campo_buscar.$forms;
		
		//return $qs;
	$dbh->close();


}


/////////////////

///////////////////////////

function genera_check_series_admin_perfil($user){ // check series normal

include("access.php");

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}		
	$no = 0; 
	
		
    //$qb = "Select * FROM series WHERE tipo < 3 ORDER BY fecha_lanzamiento";
    $qb = "Select * FROM series WHERE tipo not in (select tipo from series where tipo = 3) ";
    //Select * FROM series WHERE tipo not in (select tipo from series where tipo = 3)
		$results= $dbh->query($qb);
	    if ($results->num_rows > 0) {
		  
			while($row = $results->fetch_assoc()){
				$no = $no +1;
				
				$series_op .= $row['clave_lego'].';';
				/*
				if($row['estado'] != 1 ){
					$stat = 'disabled=""';
					$view = 'title="Esta colección no puede seleccionarse o no será visible, estará habilitada una vez que el administrador la active."';
					$txt_adv ='Esta colección no puede seleccionarse o no será visible, estará habilitada una vez que el administrador la active.'; 
					$text = 'text-gris'; 
					$ico_info = '<span '.$view.'> <i class="fas fa-info-circle"></i> </span>'; 
					$fx = '';
					 
				}elseif($row['estado'] == 3 ){
					$stat = '';
					$text = 'text-neutral';
					$view = '';
					$txt_adv = ''; 
					$ico_info = ''; 
					$fx = 'onclick="valida_coleccion(this.id);"';
				}else{
					$stat = '';
					$text = 'text-neutral';
					$view = '';
					$txt_adv = ''; 
					$ico_info = ''; 
					$fx = 'onclick="valida_coleccion(this.id);"';
				}
				*/
					$stat = '';
					$text = 'text-neutral';
					$view = '';
					$txt_adv = ''; 
					$ico_info = ''; 
					$fx = 'onclick="valida_coleccion(this.id);"';

             //   $status_user = get_status_series_opcional($user, $row['clave_lego']);
                $status_user = 1; 
				//$status_admin = get_status_series_opcional_admin($user, $row['clave_lego']);
                $status_admin = get_status_series_admin($user, $row['clave_lego']);
			
				$info_pago = get_info_permiso($row['clave_lego'], $user);
			//	var_dump($info_pago);
				
					$data_info_pago = explode('|', $info_pago);
					$fecha_reg = $data_info_pago[0];
					$fecha_actualiza = formatFechaHoraTable($data_info_pago[1]);
					$id_user_asignante = $data_info_pago[2]; 
					$info_user_asignante = busca_user($id_user_asignante);

				if($id_user_asignante != 0){
					$data_user_a = explode('--', $info_user_asignante);
					$user_name_asignante = $data_user_a[3];
				}else{
					$user_name_asignante = '<span class="text-clear" >Sin Asignar</span>';
				}					
///////////////////////

				if($status_admin==1){ // permitido
					
					$per_icon = 'fa-solid fa-user-slash';
					$lbl_btn = 'Bloquear';  
					$btn_style='btn-inverse-danger';
				
					if($status_user==1){
						$val = 'checked=""';
						$stat = '';
						$text = 'text-muted';
						$ico_user_select = 'fa-solid fa-user-check';
						$label_status = '<span class="text-success" style="font-size:12px; margin-top:5px; margin-right:10px;" ><i class="'.$ico_user_select.'"></i> Permitida </span>'; 
						$color_status = 'text-success';
						
					}elseif($status_user==0){
						$val = ''; 
						$stat = '';
						$text = 'text-muted';
						$ico_user_select = 'fa-solid fa-user-xmark';
						$label_status = '<span class="text-clear" style="font-size:12px; margin-top:5px; margin-right:10px;"> <i class="'.$ico_user_select.'"></i> Serie No Seleccionada</span>';
						$color_status = 'text-muted';
					}
					
					$fecha_actualiza = '<span class="text-clear"> <i class="fa-solid fa-minus"></i> </span> ';
					$user_name_asignante = '<span class="text-clear"> <i class="fa-solid fa-minus"></i> </span> ';
				
				}elseif($status_admin==0){ // no permitido
					
					$text = 'text-muted';
					$stat = 'disabled=""';
					$view = 'title="Esta colección ha sido bloqueada para su perfil."';
					$ico_info .= '<span '.$view.'> <i class="fas fa-ban"></i> </span>'; 
					$btn_style='btn-inverse-primary text-primary';
					
					$val = ''; 
					$per_icon = 'fa-solid fa-user'; 
					$lbl_btn = 'Permitir';  
					$ico_user_select = 'fa-solid fa-ban'; 
					$label_status = '<span class="text-danger" style="font-size:12px; margin-top:5px; margin-right:10px;"> <i class="'.$ico_user_select.'"></i> Bloqueada</span>'; 
					$color_status = 'text-clear';
					
					$fecha_actualiza = formatFechaHoraTable($data_info_pago[1]);
					$user_name_asignante = $data_user_a[3];

				}

                

                // Obtiene informacion del usuario admin  (perfil)

                $info_user = busca_user($GLOBALS['user']);
                $data_user = explode('--',$info_user);
                $error = $data_user[0];
                $nombre = $data_user[1];
                $correo = $data_user[2];
                $user_nameb = $data_user[3];
                $foto = $data_user[4];
                $perfil_user = $data_user[5];

                ///// etiqueta Tipo 

	                        $ico_tipo_serie = get_ico_tipo_serie($row['tipo']);
	                        
	                        $data_ico = explode('|', $ico_tipo_serie);
	                        $icono_s = $data_ico[0];
	                        $nombre_s = $data_ico[1];
	                        $color_s = $data_ico[2];

                            $tipo = '<span class="text-'.$color_s.'" style="font-size:0.6rem;" title="'.$nombre_s.'" > '.strtoupper($nombre_s).' </span>';

                            
                ////

                //// Premium 
                if($row['premium']==1){
                    $ico_premium = '<span class="ico_premium" title="Serie Premium" style="font-size:1rem;" > <i class="fa-solid fa-bookmark"></i>  </span>';
                }else{
                    $ico_premium = ''; 
                }

                /////////
                

                $id_estado = get_info_estado_serie($row['estado']);
			    $data_estado = explode('/', $id_estado);
                $ico_edo = $data_estado[1];
                $nombre_edo ='<span class="" title="" style="font-size:0.6rem;" > '. strtoupper($data_estado[3]).'</span>';


                ////////

                 $chk_serie = '<input type="checkbox" class="form-control chk_colecciones" id="chk_'.$row['clave_lego'].'"  value="'.$row['clave_lego'].'" /> ';
               

                $permiso_restringe = get_permiso_config('32',$perfil_user);

                if($permiso_restringe==1){

                            $btn_rest_b = '
                            
                            <button type="button" class="btn '.$btn_style.' " id="'.$row['clave_lego'].'_'.$user.'" '.$fx.' '.$permiso_restringe.'
							style="font-size:11px; text-align:center; padding:5px 10px;" value="'.$status_admin.'" > 	
							<i class="'.$per_icon.'"></i> '.$lbl_btn.' </button>
                            '; 
                }else{

                            $btn_rest_b = '
                            
                            <button type="button" class="btn '.$btn_style.' " disabled id="'.$row['clave_lego'].'_'.$user.' '.$permiso_restringe.' " 
							style="font-size:11px; text-align:center; padding:5px 10px;" value="'.$status_admin.'" > 	
							<i class="'.$per_icon.'"></i> '.$lbl_btn.' </button>
                            '; 
                }

				
				if($status_user != -1){
					
	
					$forms .= '
					<div class="form-check form-check-flat border-bottom " style="padding-bottom:5px; padding-top:5px;" >
						
						
						<input type="hidden" '.$stat.' class=""  id="chkk_serie_'.$row['clave_lego'].'_'.$user.'" value="'.$status_admin.'" '.$val.'> 
							
						<div class="row" >
							<span class="col-md-4 text-muted" title="Solo el usuario puede seleccionar la serie."  style="padding:2px 3px; font-size:14px; text-align:left; width:10%"> 	
							<i class="'.$ico_user_select .' '.$color_status.'"></i> <span class="'.$color_status.'" style="margin-left:3px; margin-top:5px;  " >'.$label_status.'</span>
							</span>
													
							<div class="col-sm-3 btn-group">
							'.$btn_rest_b.'
							</div>
							
							<span style="font-size:13px; margin-left:3px; margin-top:5px;  " class="col-sm-4 '.$text.'" > '.$row['clave_lego'].' - '.$row['nombre'].' '.$ico_info .'</span>
						</div>
													
				    </div>
				';
							
				
				}

				$link_detalle = $link_site.'?mnu=edab7083e4d6a72dda1675d0b4878ee3&item='.$row['clave_lego'].'&element=d048a1ffc387b756bc18622e4ca06531&q='.$user;
				$link_cve = '<a class="" style="font-size:0.6rem;" title="Ver Detalles Coleccion" target="_blank" href="'.$link_detalle.'"> Ver Coleccion </a>'; 
				
				$data_coleccion = $user.';'.$row['clave_lego']; 
				$total_coleccion = busca_info_coleccion($data_coleccion);

				$rows_table .= '
				
					<tr class="text-muted">
                        <td class="text-muted center" > '.$chk_serie.' </td>
						<td class="text-muted center" > '.$no.' </td>
                        <td class="text-muted center"> '.$row['clave_lego'].'  </td>
						<td class="text-muted"> 
                            <div class="row">
                                <div class="col-sm-2">'.$ico_premium.'</div>
                                <div class="col-sm-6">
									'.$row['nombre'].' <br> 
									'.$tipo.' <span style="font-size:0.6rem;"> | </span> '.$nombre_edo.' <br>
									<span class="text-muted" style="font-size:0.6rem;">'.$total_coleccion .' figs. | </span>  '.$link_cve.'
								</div>
                            </div> 
                        
                        </td>
						<td class="text-muted center"> '.$label_status.' </td>
						<td class="text-muted center"> '.$fecha_actualiza.' </td>
						<td class="text-muted center"> '.$user_name_asignante.' </td>
						<td class="text-muted center"> '.$btn_rest_b.' </td> 
					</tr>
				'; 
								
			  
			}
		}
		
	//	$forms = $forms.'<input type="hidden" id="current_series_op_conf_'.$user.'" value="'.$series_op.'" >';
	
	 	//$campo_buscar = crea_campo_buscar('series_reg');
		 $campo_buscar = crea_campo_buscar_cust('series_reg',3); 

		$forms = '
		
				    <input type="hidden" class="col-md-3 form-control" id="user_series_selected" value="" />
                    <input type="hidden" class="col-md-3 form-control"  id="all_series" value="'.$series_op.'" />
                    

					<table id="series_reg" class="table table-striped" style="background: #fff;">
                      <thead >
                        <tr>
                            <th class="thead_content"  > <input type="checkbox" onclick="select_all_checks(\'colecciones\');" class="" id="chk_all_colecciones" value="99" /> </th>
                        	<th class="thead_content"  > No  </th>
                            <th class="thead_content" > Clave </th>
							<th class="thead_content" > Coleccion </th>							
							<th class="thead_content" > Estado </th>
							<th class="thead_content" > Fecha Restricción </th>
							<th class="thead_content" > Restringida por: </th>
							<th class="thead_content" > Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
					  		'.$rows_table.'
                      </tbody>
                      <tfooter >
                        <tr>
                            <th class="thead_content"  >  </th>
                        	<th class="thead_content" > No  </th>
                            <th class="thead_content" > Clave </th>
							<th class="thead_content" > Colección </th>							
							<th class="thead_content" > Estado </th>
							<th class="thead_content" > Fecha Restricción </th>
							<th class="thead_content" > Restringida por: </th>
							<th class="thead_content" > Opciones</th>
                        </tr>
                      </tfooter>                      
                      
                      
                    </table>
		
		
		';


				
		return $campo_buscar.$forms;
		
		//return $qs;
	$dbh->close();


}


/////////////////



function get_permiso_pago($serie, $id_user){
	
include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
		
	$qb = "SELECT * FROM permiso_serie_premium where clave_serie = $serie and id_user = $id_user ";// preparando la instruccion sql

//var_dump($qb);
		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['permiso_admin']; 
	    	
	    
	    }else{
		    $data = '0'; 
	    }
	    

	return $data; 
	$dbhb->close();		
	
}


///////////

function get_info_permiso_pago($serie, $id_user){
	
include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
		
	$qb = "SELECT * FROM permiso_serie_premium where clave_serie = $serie and id_user = $id_user ";// preparando la instruccion sql

//var_dump($qb);
		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['fecha_registro'].'|'.$row['fecha_actualizado'].'|'.$row['id_user_permiso']; 
	    	
	    
	    }else{
		    $data = '0000-00-00 00:00:00|0000-00-00 00:00:00|0'; 
	    }
	    

	return $data; 
	$dbhb->close();		
	
}

///////////

function get_info_permiso_opcional($serie, $id_user){
	
include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
		
	$qb = "SELECT * FROM permiso_serie_opcional where clave_serie = $serie and id_user = $id_user ";// preparando la instruccion sql

//var_dump($qb);
		
    $resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
	    	$data = $row['fecha_registro'].'|'.$row['fecha_actualizado_restriccion'].'|'.$row['id_user_permiso']; 
	    	
	    
	    }else{
		    $data = '0000-00-00 00:00:00|0000-00-00 00:00:00|0'; 
	    }
	    

	return $data; 
	$dbhb->close();		
	
}

///////////

function get_info_permiso($serie, $id_user){
	
    include("access.php");
    
    $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
    
    if ($dbh->connect_error) {
           die("Connection failed: " . $dbh->connect_error);
    }		
            
        $qb = "SELECT * FROM permiso_serie where clave_serie = $serie and id_user = $id_user ";// preparando la instruccion sql
    
    //var_dump($qb);
            
        $resultb= $dbh->query($qb);
        
            if ($resultb->num_rows > 0) {
                $row= $resultb->fetch_assoc();
                
                $data = $row['fecha_registro'].'|'.$row['fecha_actualizado_restriccion'].'|'.$row['id_user_permiso']; 
                
            
            }else{
                $data = '0000-00-00 00:00:00|0000-00-00 00:00:00|0'; 
            }
            
    
        return $data; 
        $dbhb->close();		
        
    }


function registra_token_historial($id_user, $token){
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						
					$hoy = date("Y-m-d H:i:s");
				
					
						if ($dbh->connect_error) {
							  die("Connection failed: " . $dbh->connect_error);
						}
						
			 		$q = "SELECT * FROM token_historial WHERE id_user = $id_user and token = '$token';";
			 		$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) {

						$res = 2;  // ya existe.			    

					
					}else{
						
			$qb = "INSERT INTO token_historial (id, id_user, token, fecha_registro ) VALUES ('',".$id_user.", '".$token."', '".$hoy."')";
						// preparando la instruccion sql
						
						   if (mysqli_query($dbh, $qb)) {
								$res = 1; // registro exitosos
							} else {
								$res = 0;  //error
						    }
						    
						  
					}	
	return $res;
	
}
///////////////////////////

function genera_select_series_all($current){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM series where estado = 1 order by consecutivo;";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['clave_lego']== $current){
		                         $opt .= '<option selected disabled value="'.$row['clave_lego'].'">'.$row['clave_lego'].' - '.$row['nombre'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$row['clave_lego'].'">'.$row['clave_lego'].' - '.$row['nombre'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }


						$seletct= '<option value="999"> Elije... </option>'.$opt_add.$opt;
	            
	         //   $sel = $seletct;
	            
	          //  var_dump($sel);
	
	//$data = $total_serie; 
	return $seletct; 
	$dbhb->close();		
}

///////////////////////

function genera_select_series($current){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM series where premium = 1";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['clave_lego']== $current){
		                         $opt .= '<option selected disabled value="'.$row['clave_lego'].'">'.$row['clave_lego'].' - '.$row['nombre'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$row['clave_lego'].'">'.$row['clave_lego'].' - '.$row['nombre'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }

  if($current == 99){
    $opt_add = '<option value="99" selected > Todas las Series </option>';
  }else{
    $opt_add = '<option value="99" > Todas las Series </option>';
  }

						$seletct= '<option value="999"> Elije... </option>'.$opt_add.$opt;
	            
	         //   $sel = $seletct;
	            
	          //  var_dump($sel);
	
	//$data = $total_serie; 
	return $seletct; 
	$dbhb->close();		
}

function genera_select_usuarios($current){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM usuarios where estado = 1;";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['id']== $current){
		                         $opt .= '<option selected disabled value="'.$row['id'].'">'.$row['usuario'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$row['id'].'">'.$row['usuario'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }

    if($current == 99){
    $opt_add = '<option value="99" selected> Todos los Usuarios  </option>';
  }else{
    $opt_add = '<option value="99"> Todos los Usuarios  </option>';
  }

						$seletct= '<option value="999"> Elije... </option>'.$opt_add.$opt;
	            
	         //   $sel = $seletct;
	            
	          //  var_dump($sel);
	
	//$data = $total_serie; 
	return $seletct; 
	$dbhb->close();		
}

function genera_select_dcto($current){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM descuentos where estado = 1 order by cve asc;";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['cve']== $current){
		                         $opt .= '<option selected disabled value="'.$row['cve'].'">'.$row['descripcion'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$row['cve'].'">'.$row['descripcion'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            
	            }


						$seletct= '<option value="999"> Elije... </option> '.$opt;
	            
	         //   $sel = $seletct;
	            
	          //  var_dump($sel);
	
	//$data = $total_serie; 
	return $seletct; 
	$dbhb->close();		
}


function get_lbl_estado_cupon($estado){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM estado_cupon where clave = $estado ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
	    	 
	    	 	$lbl = '
				<span id="c_edo_'.$row['id'].'" class="badge text-'.$row['color'].'" title="'.$row['nombre'].'" style="font-size:0.8rem;"> 
	    	 	<span style="margin-right:3px;" ><i class="'.$row['icono'].'"></i> </span>'.$row['nombre'].' 
	    	 	</span>';         
	    	 	
	    	 	//$lbl = '<span class="theme_color ico_estado" title="Modo Público"> <i class=" fa fa-eye " ></i> </span>';              
	    
	    }else{
		    
		    $lbl = 'Sin Estado';
		    
	    }
	
	return $lbl; 
	$dbh->close();
}
////

function get_lbl_estado_cupon_uso($estado){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM estado_cupon where clave = $estado ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
	    	 
	    	 	$lbl = '<span id="c_edo_'.$row['id'].'" class="badge  text-'.$row['color'].'" title="'.$row['nombre_uso'].'" style="font-size:12px;"> 
	    	 	<i class="'.$row['icono_uso'].'" style="display:inline-block; margin-right:5px;" ></i> '.$row['nombre_uso'].' 
	    	 	</span>';         
	    	 	
	    	 	//$lbl = '<span class="theme_color ico_estado" title="Modo Público"> <i class=" fa fa-eye " ></i> </span>';              
	    
	    }else{
		    
		    $lbl = 'Sin Estado';
		    
	    }
	
	return $lbl; 
	$dbh->close();
}

/////

function compara_fechas($fecha_inicio, $fecha_fin){	

$hoy = date("Y-m-d");
	
	if( $fecha_inicio <= $hoy){
		if( $fecha_fin >= $hoy){
			$res = 1;
		}else{
			$res = 0;
		}
		
	}elseif( $fecha_comparar == $hoy){
		$res = 1; // vigente 
	}elseif( $fecha_inicio > $hoy){
		$res = 2; // vigente 
	}else{
		$res= 0; // no vigente
	}
	
	//var_dump($res);
	//var_dump($hoy .' vs '. $fecha_comparar .'='.$res.' <br>');
	return $res;
	
}



function valida_fechas($fecha_inicio, $fecha_fin){	

$data_ini = explode(' ',$fecha_inicio);
$fini_b = $data_ini[0];

$data_fin = explode(' ',$fecha_fin);
$ffin_b = $data_fin[0];


$hoy = date("Y-m-d");
	
	if( $fini_b <= $hoy){
		if( $fecha_fin >= $hoy){
			$res = 1;
		}else{
			$res = 0;
		}
		
		
	}else{
		$res = 0;
	}
	
}




function genera_barra_vigencia($fecha_inicio, $fecha_fin,$tipo){	

$hoy = date("Y-m-d");
	
if($hoy<$fecha_inicio){
$porc = -1;
}else{

$dias = (strtotime($fecha_inicio)-strtotime($fecha_fin))/86400;
$dias = abs($dias); 
$dias = floor($dias);

$dias_act = (strtotime($fecha_inicio)-strtotime($hoy))/86400;
$dias_act = abs($dias_act); 
$dias_act = floor($dias_act);

$porc = ($dias_act*100) / $dias;
}



if($tipo == 2){
	
	if($porc>=0 && $porc <= 25){
		$bg_color = 'bg-neutralb'; 
		$text_color = 'text-light'; 
	}elseif($porc>25 && $porc<=50 ){
		$bg_color = 'bg-neutralb'; 
		$text_color = 'text-light';
	}elseif($porc>50 && $porc <= 75 ){
		$bg_color = 'bg-neutralb'; 
		$text_color = 'text-light';
	}elseif($porc>75 && $porc <=100 ){
		$bg_color = 'bg-neutralb'; 
		$text_color = 'text-light';
	}elseif($porc>100){
		$bg_color = 'bg-head';
		$txt_color = 'text-light';
	}
	
	$font_size = '0.8rem; ';
	
}else{

	if($porc>=0 && $porc <= 25){
		$bg_color = 'bg-verde'; 
		$text_color = 'text-muted'; 
	}elseif($porc>25 && $porc<=50 ){
		$bg_color = 'bg-warning';
		$text_color = 'text-muted';
	}elseif($porc>50 && $porc <= 75 ){
		$bg_color = 'bg-naranja';
		$text_color = 'text-muted';
	}elseif($porc>75 && $porc <=100 ){
		$bg_color = 'bg-rojo';
		$text_color = 'text-muted';
	}elseif($porc>100){
		$bg_color = 'bg-head';
		$txt_color = 'text-warning';
	}
	
	$font_size = '0.8rem; ';

	if($porc < 0){
		$estadis = '';
	}elseif($porc >=0 and $porc <=100){
		$estadis = '<span class="'.$text_color.'" style="margin-bottom:2px; font-size:'.$font_size.';">'.$dias_act.' de '.$dias.' días | '.round($porc,2).'% </span><br>
'; 
	}elseif($porc >= 100){
		$estadis = '<span> '.$dias.' dias activo | 100% </span>';
	}


}
  
  $dif = $dias - $dias_act; 
 // var_dump($dif);
  

							if($porc < 0){
															
								if($dif==0){
								$lbl = 'A partir del: <b>'.formatFecha($fecha_inicio).'</b>';   
								}else{
								$lbl = 'Termina en '.$dif.' dias. <b>'.formatFecha($fecha_fin).'</b>';
								}

							$barra = $estadis.'
							
							<span class="'.$text_color.'" style="margin-bottom:2px; font-size:'.$font_size.'; ">'.$lbl.'</span>
							';
							
							}elseif($porc >=0 and $porc <=100){
								
								  if($dif==0){
									$lbl = 'Termina hoy: <b>'.formatFecha($fecha_fin).'</b>';   
								  }else{
									 $lbl = 'Termina en '.$dif.' dias. <b>'.formatFecha($fecha_fin).'</b>';
								  }
  
								$barra = $estadis.'
								<div class="progress">
	                              <div class="progress-bar '.$bg_color.'" role="progressbar" style="width: '.$porc.'%" aria-valuenow="'.$porc.'" aria-valuemin="0" aria-valuemax="100"></div>
	                            </div>
                                <span class="'.$text_color.'" style="margin-bottom:2px; font-size:'.$font_size.'; ">'.$lbl.'</span>
                                ';
                            }elseif($porc >= 100){
	                            
	          
								$barra = $estadis.'
								<div class="progress">
	                              <div class="progress-bar '.$bg_color.'" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
	                            </div>
                                <span class="'.$text_color.'" style="margin-bottom:2px; font-size:'.$font_size.';">Terminó el '.formatFecha($fecha_fin).'</span>
								';
                            }

	//var_dump($hoy .' vs '. $fecha_comparar .'='.$res.' <br>');
	return $barra;
	
}

//////////////////////////////

function genera_ops_estado_cupon($current){
	//genera_ops_estado_ini_serie;

include("access.php");
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}


if($current==98){
	$query = ' where clave = 986'; 
}elseif($current==99){
	$query = ' where clave between 1 and 98';
}elseif($current==0){
	$query = ' where clave = 98';
}else{
	$query = ' where clave > 95';
}
	//$qc = "SELECT * FROM estado_cupon".$query.";";// preparando la instruccion sql
	$qc = "SELECT * FROM estado_cupon;";// 
		
    $resultc= $dbh->query($qc);
    
    	if ($resultc->num_rows > 0) {			
			while($rowc= $resultc->fetch_assoc()){
				
				if($current == $rowc['clave']){
					
					$atr .= '<option selected value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
				}else{
					$atr .= '<option value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
				}

		
			}	   
						 
	    }else{
		    $atr = ''; 
	    }

	$ops = '<option value="999" >Elija una opcion </option>'.$atr;
	
	return $ops;
}


function valida_vigencia_cupon($cupon, $serie_sol,$id_user_sol){

	//date_default_timezone_set('America/Mexico_City');

	include("access.php");
//	include("globals.php");
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM cupones where titulo = '$cupon';";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
	    	 // Valida fechas (1) 
	    	 	$usuario = $row['id_user']; 
	    	 	$fini = $row['fecha_inicio'];
	    	 	$ffin = $row['fecha_fin'];
	    	 	$serie = $row['clave_serie'];
	    	 	$estado = $row['estado'];
	    	 	
	    	 	//var_dump($usuario);
	    	 	$duplicado = valida_cupon_duplicado($id_user_sol,$serie_sol);
	    	 
			 	$res_fechas = compara_fechas($fini, $ffin);

				 //$hoy = date("Y-m-d H:i:s");
				 //$horarioVerano = date('I');
				 //var_dump($hoy);
				
			 
					 if($estado > 0 and $estado< 98){
					 
							 if($res_fechas==1){
				
							 	$id_user_sesion = $id_user_sol;	
							 			 	
									 	if($row['id_user']==$id_user_sesion or $row['id_user']=='99'){				 	
										 	
										 	if($row['clave_serie']==$serie_sol or $row['clave_serie']=='99'){
										 		if($duplicado==1){
											 		$res = 11;
										 		}else{
											 		$res = 1;
										 		}
										 		
										 		
										 	}else{
											 	$res = 4;		
										 	}
									 	
									 	
									 	}else{
										 	$res = 3;
									 	}
							 					 
							 }elseif($res_fechas==2){
									$res = 12;
							 }else{
								 $res=0;
							 }
					
					}else{
					    
					    $res = 5;
					}
			    
		}else{
		    
		    $res = 2;
		    
	    }
	
	return $res; 
	$dbh->close();	
	
	
}

///////////

function valida_uso_cupon($cupon, $serie_sol,$id_user){

	include("access.php");
//	include("globals.php");
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}


	$info_cupon = get_info_cupon($cupon);
	$data_cup = explode('|', $info_cupon); 
	$id_cupon = $data_cup[0];
	$serie_cupon = $data_cup[1];
	$id_user_cupon = $data_cup[2];
	$usos_cupon = $data_cup[3];
	$descuento =  $data_cup[7];


   $qb = "SELECT * FROM uso_cupon where id_cupon = $id_cupon and id_user = $id_user;";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	// $row= $resultb->fetch_assoc();
	    	 
	    	 $cant = $resultb->num_rows;
	    	 
	    	while($row = $resultb->fetch_assoc()){
		    	
		    	/*
		    	if($id_user_cupon== $row['id_user'] or $id_user_cupon==99){
			    	if($id_user == $row['id_user']){
				    	$usos= $usos +1;
				    	$debug = 'B';
			    	}
			    	$debug = 'A';
		    	}else{
			    	$usos = 0;
			    	$debug = 'C';
		    	}
		    	*/
		  	}
	    	 
	    	// debugme($info_cupon);
	    	 
		  	if($cant >= $usos_cupon){
			  	$val_usos = 0;
		  	}else{
			  	$val_usos = 1;
		  	}
	    	 // valida que los usos sean correcto
	    	 // valida que si ha sido usado
	    	 
			    
		}else{
		    
		    $val_usos = 1; // es valido por que no se encuentra registro por lo queno se ha usado. 
		    
	    }
	    
	   $res = $val_usos;
	// $res = $usos_cupon;
	
	return $res; 
	$dbh->close();	
	
	
}

///////////////////////////////////////////////////////////////////////////

function get_info_cupon($clave){ // devuelve el nombre de la serie
	
	include("access.php");
	
	//echo $item;
	$clave = strval($clave);

	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM cupones where titulo = '$clave'";// preparando la instruccion sql
   $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
			 	$datos = $row['id'].'|'.$row['clave_serie'].'|'.$row['id_user'].'|'.$row['no_usos'].'|'.$row['fecha_inicio'].'|'.$row['fecha_fin'].'|'.$row['estado'].'|'.$row['descuento'];
	    }else{
		    
		    	$datos = '0|0|0|0';
		    
	    }
	    
	   // var_dump($datos);
	
	return $datos; 
	$dbh->close();
}

///////////////////////////////////////////////////////////////////////////

function get_info_cupon_id($id_cupon){ // devuelve el nombre de la serie
	
	include("access.php");
	
	//echo $item;
	$clave = strval($clave);

	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM cupones where id = $id_cupon";// preparando la instruccion sql
   $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
			 	$datos = $row['id'].'|'.$row['clave_serie'].'|'.$row['id_user'].'|'.$row['no_usos'].'|'.$row['fecha_inicio'].'|'.$row['fecha_fin'].'|'.$row['estado'].'|'.$row['descuento'].'|'.$row['titulo'];
	    }else{
		    
		    	$datos = '0|0|0|0';
		    
	    }
	    
	   // var_dump($datos);
	
	return $datos; 
	$dbh->close();
}

//////////////////////////

function get_mnu_lateral_hijos($mnu_padre){ // devuelve el nombre de la serie
	
	include("access.php");
	
	//echo $item;
	$clave = strval($clave);

	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}


  $qb = "SELECT * FROM menus WHERE estado = 1 and mnu_padre = $mnu_padre and nivel < 88 and nivel < 3;";// preparando la instruccion sql
					//echo($qb);
					   
								    $resultb= $dbh->query($qb);
								    if ($resultb->num_rows > 0) {
									    $num_hijos = $resultb->num_rows; 
									    //var_dump ($num_hijos);
									 //console.log($num_hijos);
									 
									 //   $num = 1; 
					                        while($rowb = $resultb->fetch_assoc()){
						                        
						                        $tamanio_cve = strlen($rowb['cve']); 
						                        if($tamanio_cve > 10 ){
							                        $url_param ='?mnu='.$rowb['cve']; 
						                        }else{
							                        $url_param ='';
						                        }
						                        //1f6503307f1eb3ea66a6be2c6ae4fae6
						                         
						                         $perfil_b = $GLOBALS['user_perfil'];
						                         //$permiso = valida_permiso_perfil($rowb['id'],$perfil);
						                          $permiso = get_permiso_pagina($rowb['id'],$perfil_b);
						                        // var_dump('<br><br>'.$perfil_b.' - '.$permiso.' - '.$rowb['title']);
                                              
						                         if($permiso==1){

							                        $menus .= '<li class="nav-item">
													            <a class="nav-link" href="index.php'.$url_param.'"> '.$rowb['title'].' </a>
													           </li>
							                        '; 
							                         
						                         }else{
							                        $menus.= '';
						                         }

                                              $permiso = 0;
						                        
											}//while 
										
									}else{
										$sub_mnu .= ""; 
									}									                   
	                        
					                        if($num_hijos>0){						                        
						                        $sub_mnu .= '
						                        <div class="collapse" id="'.$rowa['nombre'].'">
									                <ul class="nav flex-column sub-menu">
										                '.$menus.'
									                  
									                </ul>
									              </div>
						                        ';           
					                        }else{
						                        $sub_mnu .= ""; 
						                        $menus = ''; 
					                        }
	
	                        
	                        /// Fin Menu Hijos
	                        
	                        // Construye menus laterales
	                        if($num_hijos>0){

								$perfil_b = $GLOBALS['user_perfil'];
						      //  $permiso = valida_permiso_perfil($rowa['id'],$perfil);
						        $permiso = get_permiso_pagina($rowa['id'],$perfil_b);
                              
                               //var_dump('<br><br>'.$perfil_b.' - '.$permiso.' - '.$title);
						        
						        if($permiso==1){
			                        $mnu_p .= '
									<li class="nav-item  ">
						              <a class="nav-link" data-toggle="collapse" href="#'.$rowa['nombre'].'" aria-expanded="false" aria-controls="'.$rowa['nombre'].'">
						                <i class="menu-icon typcn typcn-document-add"></i>
						                <span class="menu-title">'.$title.'</span>
						                <i class="menu-arrow"></i>
						              </a>					         
							                '.$sub_mnu.'
							        </li>
			                        '; 
			                    }else{
				                        $mnu_p .= '';
			                    }
	                        
	                        }else{
		                        
		                        if($id==0){
			                         $url_paramb =''; 
		                        }else{
			                         $url_paramb ='?mnu='.$cve; 
		                        }

								$perfil_b = $GLOBALS['user_perfil'];
						        //$permiso = valida_permiso_perfil($rowa['id'],$perfil);
						        $permiso = get_permiso_pagina($rowa['id'],$perfil_b);
						        
						        if($permiso==1){
						        	                        
									$mnu_p .= '
									    <li class="nav-item ">
							              <a class="nav-link" href="index.php'.$url_paramb.'">
							                <i class="menu-icon typcn typcn-shopping-bag"></i>
							                <span class="menu-title"> '.$title.' </span>
							              </a>
							            </li>
									';
			                    }else{
				                    $mnu_p .= '';
			                    }
	                        
							}

	
	return $datos; 
	$dbh->close();
}


///////////




function registra_uso_cupon($id_user,$id_cupon,$clave_serie){
	
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						
					$hoy = date("Y-m-d H:i:s");
					$hoyb = date("Y-m-d");
				
					
						if ($dbh->connect_error) {
							  die("Connection failed: " . $dbh->connect_error);
						}
						
		//	 $q = "SELECT * FROM uso_cupon WHERE id_user = $id_user and id_cupon = $id_cupon and fecha_registro like '$hoyb%' ;";
			$q = "SELECT * FROM uso_cupon WHERE id_user = $id_user and id_cupon = $id_cupon and clave_serie = $clave_serie ;";

			 		$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) {
					    $row= $result->fetch_assoc();

/*
						if($clave_serie==$row['clave_serie']){
							$res= 3;
						}else{
							$res = 2; 
						}
						 // ya existe hoy.			    
*/
					$res=2;
					
					}else{
						
			$qb = "INSERT INTO uso_cupon (id, id_user, id_cupon, clave_serie, usos, estado, fecha_registro ) VALUES ('',".$id_user.", '".$id_cupon."', ".$clave_serie.", 1,1,'".$hoy."')";
						// preparando la instruccion sql
						
						   if (mysqli_query($dbh, $qb)) {
								$res = 1; // registro exitosos
							} else {
								$res = 0;  //error
						    }
						    
						  
					}	
	return $res;
	
	
}

function debugme($valor){
	
	var_dump($valor);
}



function valida_cupon_activo($cve_serie, $id_user){
	
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						
	$hoy = date("Y-m-d H:i:s");
				
					
	if ($dbh->connect_error) {
	  die("Connection failed: " . $dbh->connect_error);
	}
						
	$q = "SELECT * FROM uso_cupon WHERE clave_serie = $cve_serie and id_user = $id_user and estado = 1;";

	//var_dump($q);
	
		$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) {
					    $row= $result->fetch_assoc();

						$id_dato = $row['id_cupon']; 
						
						$info_cup= get_info_cupon_id($id_dato);
	//$row['id'].'|'.$row['clave_serie'].'|'.$row['id_user'].'|'.$row['no_usos'].'|'.$row['fecha_inicio'].'|'.$row['fecha_fin'].'|'.$row['estado'].'|'.$row['descuento'].'|'.$row['titulo'];
	
						
						//var_dump($info_cup);
						
						$data_cup = explode('|', $info_cup);
						
						$id_cupon = $data_cup[0];
						$serie_cupon = $data_cup[1];
						$id_user_cupon = $data_cup[2];
						$usos_cupon = $data_cup[3];
						$fini = $data_cup[4];
						$ffin = $data_cup[5];
						$descuento = $data_cup[7];
						$titulo = $data_cup[8];
						
						
					
					//$res_val_vig = valida_fechas($fini, $ffin); 
					$res_val_vig = valida_vigencia_cupon($titulo, $serie_cupon, $id_user_cupon);
						
						if($res_val_vig==1){
							$res = '1|'.$titulo.'|'.$descuento.'|'.$fini.'|'.$ffin.'|'.$row['id'];
						}else{
							$res = '0|'.$res_val_vig.'|'.$titulo.'||';
						}
						
						
					
					}else{
						
						$res = '0||||';
						    
						  
					}	
	return $res;
	
}



////////////////


function get_cupones_activos($id_user){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						
	$hoy = date("Y-m-d H:i:s");
				
					
	if ($dbh->connect_error) {
	  die("Connection failed: " . $dbh->connect_error);
	}
						
	$q = "SELECT * FROM uso_cupon WHERE id_user = $id_user and estado = 1 and estado < 90 group by id_cupon;";

	//var_dump($q);
	$numb = 0; 
		$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) {
					  //  $row= $result->fetch_assoc();
					  // $no_usado = $result->num_rows;
					   
					   while($row = $result->fetch_assoc()){		   
						  
						   
						   $numb = $numb+1;
						   
						   $id_cupon = $row['id_cupon'];
						
						$info_cup= get_info_cupon_id($id_cupon);
						
						//var_dump($info_cup);
						
						$data_cup = explode('|', $info_cup);
						
						$id_cupon = $data_cup[0];
						$serie_cupon = $data_cup[1];
						$id_user_cupon = $data_cup[2];
						$usos_cupon = $data_cup[3];
						$descuento = $data_cup[7];
						$titulo = $data_cup[8];
						$fini = $data_cup[4];
						$ffin = $data_cup[5];


						if($row['clave_serie'] == 99){
							$color_serie = '91,187,182'; //rand_rgb();// '200,200,200';
							$color_serieb = '231,231,231'; //rand_rgb();// '200,200,200';
							$color_txt = '30,30,30';
							$nombre_serie = 'Cualquier serie'; 
							$clave_serie = '';
							$usos = 'Válido para '.$row['no_usos'].' series';
						}else{
							$color_serie = $data[1];
							$nombre_serie = $data[0];
							$clave_serie = $row['clave_serie'];
							$usos = '';
							$color_txt = $data[13];
						}
						
		$data_ini = explode(' ', $fini);
		$fecha_ini = $data_ini[0];

		$data_fin = explode(' ', $ffin);
		$fecha_fin = $data_fin[0];	
					
						$barra = genera_barra_vigencia($fecha_ini,$fecha_fin,2);
						
						$lista_cupones_aplicados = get_cupones_activosb($id_user, $id_cupon);
						
						$data_lista = explode('|', $lista_cupones_aplicados);
						$ops = $data_lista[0];
						$no_reg = $data_lista[1];
						   
						   //<span class="text-muted" > '.$barra.'</span>  
						   
							$tarjetas .= '	
				
				<div class="col-md-6" style="margin-bottom:5px;"  >  
					
					<div class="col-sm-12 '.$numb.'" style="border-radius:5px; padding: 3px; clear:both; z-index:90; background:rgba(200,204,206,1); background: linear-gradient(90deg, rgba(148,190,188,1) 0%, rgba(231,231,231,1) 98%)"  >                      
						
						<div class="card-body border" style="border-radius:5px; padding:15px; border:1px solid #232323;" >
	                    	
	                    	<div class="row">
	                    		<div class="col-sm-8">
			                    	<h4 class="title_card_mosaicob" style="font-size:2rem; color:rgba(3,126,140,0.6);" > <b>'.strtoupper($titulo).'</b> </h4>
			                    	<p class="" style="margin-bottom:0px; color: rgba(50,50,50,0.9);">
			                    		<span class="" > Uso: '.$no_reg.' de '.$usos_cupon.' </span> 
			                    	</p>
									<a class="text-clear btn btn-inverse-secondary" style="font-size:0.9rem; " href="#" onclick="toggle(\'details_'.$row['id'].'\');" > Ver Detalles</a>
								</div>
								
								<div class="col-sm-4 no-show"> 
									<button type="button" class="btn btn-inverse-secondary btn-sm" style="font-size:0.9rem;" onclick="toggle(\'details_'.$row['id'].'\');" > Detalles</button>
								</div>
								
							</div>
						</div>
					</div>
		            
		            <div id="details_'.$row['id'].'" class="col-md-12 bg-head border " style="display:none; border-radius: 5px; margin-top: -15px; padding-top:30px; padding-bottom:5px; z-index:60;">

								<table class="table ">				     
				                      
				                      <tbody >
				                      	'.$ops.'
				                      </tbody>

				                </table>	
				                
					</div>
								
				</div>
							
							'; 
							
							if($numb == 5){
								$numb = 0;
							}
							 
						}			
					
					}else{
						
					$tarjetas = '';    
						  
					}	
	return $tarjetas;
	
		
}

/////////////////


function get_cupones_activosb($id_user, $id_cupon){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						
	$hoy = date("Y-m-d H:i:s");
				
					
	if ($dbh->connect_error) {
	  die("Connection failed: " . $dbh->connect_error);
	}
						
	$q = "SELECT * FROM uso_cupon WHERE id_user = $id_user and id_cupon = $id_cupon and estado < 1000;";

	//var_dump($q);
	$numb = 0; 
		$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) {
					    
					     $no_usado = $result->num_rows;
					  //  $row= $result->fetch_assoc();
					   while($row = $result->fetch_assoc()){
						   
						   $numb = $numb+1;
						   
						   $id_cupon = $row['id_cupon'];
						   
						   
						   $data_color = get_info_serie($row['clave_serie']);
	                        
	                        $data = explode('/', $data_color);
	                        
	                        $nombre_serie = $data[0];
	                        $color_serie = $data[1];
	                        $fecha_serie = $data[2];
                            $edo_serie = $data[3];
	                        $precio_serie = $data[4];
	                        $moneda_serie = $data[5];
	                        $desc_serie = $data[6];
						
							$data_f = explode(' ', $row['fecha_registro']);
							$fecha = $data_f[0];
		
							if($row['estado']==999){


						$ops .= '
							<tr>
								<td class="" style="font-size:0.7em; padding:1px 2px;  "> 
										<span class="text-clear"  > <i class="fa-solid fa-clipboard-check"></i> '.$nombre_serie.' </span>
								</td>
								
								<td class="" style="font-size:0.7em; padding:1px; " > 
									<span class="text-clear"  >'.formatFechaHora($row['fecha_registro']).' 
										 </span> <span class="text-danger"><i class="fa fa-ban" title="Este cupón fue eliminado, por lo que no será aplicado"></i> </span> <br>
										
								</td>
							</tr>

						
						';								
						
							}else{
								
							
							
						$ops .= '
							<tr>
								<td class="text-muted " style="font-size:0.7em; padding:1px 2px; "> <i class="fa-solid fa-clipboard-check"></i> '.$nombre_serie.'</td>
								<td class="text-muted " style="font-size:0.7em; padding:1px;" > '.formatFechaHora($row['fecha_registro']).'</td>
								</tr>
						
						';
						}
							 
						}			
					
					}else{
						
						$ops .= '
							<tr>
								<td colspan="3"> No hay resultados </td>
							</tr>
						
						';    
						  
					}	
	return $ops.'|'.$no_usado;
	
		
}


/////////

function get_cupones_disponibles($id_user){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						
	$hoy = date("Y-m-d H:i:s");
				
					
	if ($dbh->connect_error) {
	  die("Connection failed: " . $dbh->connect_error);
	}

	//SELECT * FROM alumno WHERE alumno.id IN (SELECT alumno_id FROM aprobadas WHERE  materia_id = 'MATEMATICAS') AND alumno.id IN (SELECT alumno_id FROM aprobadas WHERE materia_id = 'LENGUA')
//Select * from cupones where id_user = $id_user and estado < 50
//select * from cupones where id_user = 99 and estado < 50

	$q = "SELECT * FROM cupones WHERE id_user = $id_user or id_user = 99;";
	//$q = "SELECT * FROM cupones WHERE id_user in (Select * from cupones where id_user = $id_user and estado < 50) and (select * from cupones where id_user = 99)";

	//var_dump($q);
	$numb = 0; 
		$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) {
					  //  $row= $result->fetch_assoc();
					  // $no_usado = $result->num_rows;
					   
					   while($row = $result->fetch_assoc()){		   
						  
						   if($row['estado']<50){
						   
						   //<span class="text-muted" > '.$barra.'</span>  
	
	
		$data_ini = explode(' ',$row['fecha_inicio']);
		$fecha_ini = $data_ini[0];

		$data_fin = explode(' ',$row['fecha_fin']);
		$fecha_fin = $data_fin[0];	
						   
		
		$data_uso = get_cupones_activosb($id_user, $row['id']);
		
		$data_b = explode('|', $data_uso);
		
		$usos_user = $data_b[1];
		
		$viegncia = valida_vigencia_cupon($row['titulo'], $row['clave_serie'] ,$id_user);

		//var_dump($viegncia);


		
		
		$duplicado = valida_cupon_duplicado($id_user,$row['clave_serie']);
	    
		$data_color = get_info_serie($row['clave_serie']);
	    $data = explode('/', $data_color);
	                        
	    $nombre_serie = $data[0];
	    $color_serie = $data[1];
	    $fecha_serie = $data[2];
        $edo_serie = $data[3];
	    $precio_serie = $data[4];
	    $moneda_serie = $data[5];
	    $desc_serie = $data[6];
		$color_serieb = $data[14];
		$color_txt = $data[13];

		$barra = genera_barra_vigencia($fecha_ini,$fecha_fin,2);

/*	$row['nombre'].'/'.
	$row['color'].'/'.
	$row['fecha_lanzamiento'].'/'.
	$row['estado'].'/'.
	$row['precio_premium'].'/'.
	$row['moneda_premium'].'/'.
	$row['descuento'].'/'.
	$row['aux'].'/'.
	$row['premium'].'/'.
	$row['tipo'].'/'.
	$row['fecha_registro'].'/'.
	$row['fecha_actualizado'].'/'.
	$row['id'].'/'.
	$row['color_text'].'/'.
	$row['colorb'].'/'.
	$tot;
	*/
	                
	if($row['clave_serie'] == 99){
		$color_serie = '91,187,182'; //rand_rgb();// '200,200,200';
		$color_serieb = '231,231,231'; //rand_rgb();// '200,200,200';
		$color_txt = '30,30,30';
		$nombre_serie = 'Cualquier serie'; 
		$clave_serie = '';
		$usos = 'Válido para '.$row['no_usos'].' series';
	}else{
		$color_serie = $data[1];
		$nombre_serie = $data[0];
		$clave_serie = $row['clave_serie'];
		$usos = '';
		$color_txt = $data[13];
	}
	                        		
					if($usos_user==$row['no_usos']){
						$tarjetas .= '';
					}else{
				
							if($viegncia==1 ){
									if($duplicado==0){
										$tarjetas .= '					
										<div class="col-md-6 " style="margin-bottom:5px; position:flex;"  >  
											
											<div class="col-sm-12 " style="border-radius:5px; padding: 3px; clear:both; z-index:90; background:rgba('.$color_serie.',1); background: linear-gradient(90deg, rgba('.$color_serie.',1) 0%, rgba('.$color_serieb.',1) 98%);"  >                      
												
												<div class="card-body border " style="border-radius:5px; padding:15px;" >
							                    
													<div class="no-show" style="z-index:99; position:absolute; width:50%; top:0px; right:0px; height:100%; background: url(\'assets/images/portada_serie/'.$row['clave_serie'].'.png\'); "></div>

							                    	<div class="row">
							                    		<div class="col-sm-12">
									                    	<h4 class="title_card_mosaicob" style="color:rgba('.$color_txt.',0.7); font-size:2rem;" > <b>'.strtoupper($row['titulo']).'</b> </h4>
									                    	
									                    	<p class="" style="margin-bottom:0px; opacity:60%; color:rgba('.$color_txt.',0.8); ">
									                    		<span class="" style="text-size:0.7rem;" >'.$nombre_serie.' &bull; '.$clave_serie.' &bull; <span class="" > ( - '.$row['descuento'].'%) <br>
																	'.$usos.'
																</span> 

									                    	</p>
									                    	<hr class="text-light bg-light" style="opacity:30%; margin: 0.4rem;" >
									                    	<span class="" style="margin-bottom:0px;">
									                    		<span class="" style="color:rgba('.$color_serie.',0.8); " > '.$barra.'</span> 
									                    	</span>
														</div>
														
														
														
													</div>
												</div>
											</div>		           
															
										</div>	'; 
								}else{
									$tarjetas .= '';
								}
							
							}else{
								$tarjetas .= '';
							}
					}
							
					
				} 
						}			
					
					}else{
						
										$tarjetas .= '					
											';    
						  
					}	
	return $tarjetas;
	
		
}

////////


function valida_cupon_duplicado($id_user, $clave_serie){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
						
	$hoy = date("Y-m-d H:i:s");
				
					
	if ($dbh->connect_error) {
	  die("Connection failed: " . $dbh->connect_error);
	}
						
	$q = "SELECT * FROM uso_cupon WHERE id_user = $id_user and clave_serie = $clave_serie and estado = 1;";

	//var_dump($q);
	$numb = 0; 
		$result= $dbh->query($q);
				    
				    if ($result->num_rows > 0) {
					    
					    // $no_usado = $result->num_rows;
					  //  $row= $result->fetch_assoc();
			
					  	$res = 1;
					
					}else{
						
						$res = 0;
						  
					}	
	return $res;
	
		
}




//////////////


function get_recibos_user($id_usuario){
	
	$user_admin = $GLOBALS['user'];
	
	//////////////// Encuentra las facturas de cada usuario
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		      //informacion de acceso a la bd
		// Check connection
			if ($dbh->connect_error) {
		    	die("Connection failed: " . $dbh->connect_error);
			}


//Select * from recibos, 
		
              $qr = "select * from recibos where id_user = $id_usuario order by nombre_prod, fecha_venta desc;";// preparando la instruccion sql

   
			    $result= $dbh->query($qr);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
					$num_no = 1; 
                        while($row= $result->fetch_assoc()){
	                        
					$user_info = busca_user($id_usuario);
					$data_user = explode('--', $user_info);
					$error = $data_user[0];
					$nombre = $data_user[1];
					$correo = $data_user[2];
					$user_nameb = $data_user[3];
					$foto = $data_user[4];	
					
					
					$data_color = get_info_serie($row['nombre_prod']);
	                        
	                $data = explode('/', $data_color);
	                        
	                $nombre_serie = $data[0];
	                $color_serie = $data[1];
	                $fecha_serie = $data[2];
	                $precio_serie = $data[4];
					//var_dump($user_info);
					// Directorio
					
					$data_fecha = explode('-', $row['fecha_venta']);
					$anio = $data_fecha[0];
					$mes = $data_fecha[1];
					$dia = $data_fecha[2];
					
					$name_file = $row['id_recibo'].'_'.$row['fecha_venta'].'_'.$row['id_user'].'.txt';
					$path_log = 'logs/transactions/'.$anio.'/'.$mes.'/'.$name_file;
					
								if(file_exists($path_log)) {

					$btn_log = '<a class="btn btn-outline-secondary btn_thin text-neutral" title="Ver Log" target="_new" href="'.$path_log.'" > 
	                       <i class="fas fa-file-code"></i> </a> ';
	                       
								} else {

					$btn_log = '<span class="btn btn-secondary btn_thin text-clear" title="Ver Log" href="#" > 
	                       <i class="far fa-file-code"></i> </span> ';
	                       									
								}

					$edo = get_lbl_estado_recibo($row['estado_recibo']);
					
					if($row['estado_recibo']==1){
						
						//$edo = '<span class="theme_color ico_estado" title="Actual"> <i class=" fas fa-circle " ></i> </span>';
						
						$btn_estado='
	                <button class="btn btn-outline-secondary btn_thin" title="Cambiar a Cancelado" onclick="edit_recibo(\'1-'.$row['id'].'\')" > 
	                       <i class="far fa-circle"></i> </button> '; 						
						
					}elseif($row['estado_recibo']==0){
						//$edo = '<span class="text-danger ico_estado" title="Cancelado"> <i class=" far fa-circle" ></i> </span>';
	                $btn_estado='
	                <button class="btn btn-outline-secondary btn_thin" title="Cambiar a Activo" onclick="edit_recibo(\'1-'.$row['id'].'\')" > 
	                       <i class="fas fa-circle"></i> </button> '; 						
						
					}elseif($row['estado_recibo']==2){
						//$edo = '<span class="text-warning ico_estado" title="Pendiente"> <i class=" fa fa-adjust " ></i> </span>';
						
	                $btn_estado='
	                <button class="btn btn-outline-secondary btn_thin" title="Cambiar Activo" onclick="edit_recibo(\'1-'.$row['id'].'\')" > 
	                       <i class="fas fa-circle"></i> </button> '; 
					}elseif($row['estado_recibo']==3){
						//$edo = '<span class="text-info ico_estado" title="Devuelto"> <i class="fas fa-retweet"></i> </span>';
						
	                $btn_estado='
	                <button class="btn btn-outline-secondary btn_thin" title="Cambiar Activo" onclick="edit_recibo(\'1-'.$row['id'].'\')" > 
	                       <i class="fas fa-circle"></i> </button> '; 
					}elseif($row['estado_recibo']==99){
						//$edo = '<span class="text-muted ico_estado" title="Eliminado: Los usuarios ya no veran este recibo."> <i class="far fa-trash-alt"></i> </span>';
						
	                $btn_estado='
	                <button class="btn btn-outline-secondary btn_thin" title="Cambiar Activo" onclick="edit_recibo(\'1-'.$row['id'].'\')" > 
	                       <i class="fas fa-circle"></i> </button> '; 
					}                           


								 $permiso_elimina = get_permiso_config('6', $GLOBALS['user_perfil']);
								 //$qb = "SELECT * from permisos_pagina where id_recurso = $id_pag and id_perfil = $id_user and tipo = 2; ";// preparando la instruccion sql
								 //var_dump($user_admin);
								 
								// var_dump($perfil);
								 
								 if($permiso_elimina==1){
								 	if($row['estado_recibo']==99){

					                $btn_eliminar='
					                <button class="btn btn-outline-secondary disabled text-diactive btn_thin" title="Eliminar" > 
					                       <i class="fas fa-trash"></i> </button> '; 
									 	
								 	}else{

					                $btn_eliminar='
					                <button class="btn btn-outline-secondary btn_thin" title="Eliminar" onclick="edit_recibo(\'2-'.$row['id'].'\')" > 
					                       <i class="fas fa-trash"></i> </button> '; 									 	
								 	}
								 
								 }else{

					                $btn_eliminar='
					                <button class="btn btn-outline-secondary disabled text-diactive btn_thin" title="Eliminar" > 
					                       <i class="fas fa-trash"></i> </button> '; 

																 
								 }
	

	                
	                $select_edo = '<select class="form-control form-control-sm" id="chk_edo_recibo_'.$row['id'].'" onchange="edit_recibo(\'1-'.$row['id'].'\')" name="chk_edo_recibo" value="" >'. genera_select_edo_recibo($row['estado_recibo']).'</select>';
	                
	                
	                
	                $options =$select_edo.$btn_log.$btn_eliminar ; 
	                
	                
	               // $data_time = explode(' ',$row['hora_venta']);
	                //$fecha_b = $data_time[0];
	                //$hora_b = $data_time[1];
	                    if($row['estado_recibo']==0 or $row['estado_recibo']==99 or $row['estado_recibo']==98){
	                        $filas_no .= '
	                        	
	                        	<tr>
	                        		<td>
	                        			<span class="text-muted" >'.$num_no.'</span>
	                        		</td>
									<td class="center">
	                        			<span class="code_cust" >'.$row['id'].'</span>
	                        		</td>
									<td >
										<span class="text-primary" style="font-size:0.9rem;">'.$nombre_serie.' - '.$row['nombre_prod'].'</span><br>
	                        			<span class="text-muted" style="font-size:0.6rem;> <span class="text-muted text-small">'.$row['id_recibo'].'</span>
	                        			<input type="hidden" id="id_recibo_'.$row['id'].'" value="'.$row['id_recibo'].'">
	                        		</td>
	                        		

	                        		<td>
	                        			<span class="text-muted" style="text-align:center; font-size:14px;">'.formatFechaHoraTable($row['fecha_venta']).'</span>
	                        		</td>         
	                        		
	                        		<td>
	                        			<span class="text-muted"> $ '.money_format('%(#10n',$row['precio_prod']).' '.$row['moneda_prod'].'</span>
	                        		</td>
	                        		
	                        		                 		
	                        		<td class="center" style="text-align:center; ">
	                        			<span class="text-muted"> '.$edo.'</span>
	                        		</td>
	                        			                        			                        		
	                        		<td>
	                        		
	                        		
	                        			<div class="btn-group" role="group" aria-label="">
											'.$options.'
										</div> 
	                        		
	                        			
	                        		</td>	 
	                              		
	                        	</tr>
	                        ';  

							$num_no= $num_no+1;
						} else{

					
	                        $filas .= '
	                        	
	                        	<tr>
	                        		<td>
	                        			<span class="text-muted" >'.$num.'</span>
	                        		</td>
									<td class="center">
	                        			<code class="code_cust" >'.$row['id'].'</code>
	                        		</td>	                        	
	                        		<td>
										<span class="text-primary" style="font-size:0.9rem;">'.$nombre_serie.' - '.$row['nombre_prod'].'</span><br>
	                        			<span class="text-muted" style="font-size:0.6rem;> <span class="text-muted text-small">'.$row['id_recibo'].'</span>
	                        			<input type="hidden" id="id_recibo_'.$row['id'].'" value="'.$row['id_recibo'].'">
	                        		</td>
	                        		

	                        		<td>
	                        			<span class="text-muted" style="text-align:center; font-size:14px;">'.formatFechaHoraTable($row['fecha_venta']).'</span>
	                        		</td>         
	                        		
	                        		<td>
	                        			<span class="text-muted"> $ '.money_format('%(#10n',$row['precio_prod']).' '.$row['moneda_prod'].'</span>
	                        		</td>
	                        		
	                        		                 		
	                        		<td class="center" style="text-align:center; ">
	                        			<span class="text-muted"> '.$edo.'</span>
	                        		</td>
	                        			                        			                        		
	                        		<td>
	                        		
	                        		
	                        			<div class="btn-group" role="group" aria-label="">
											'.$options.'
										</div> 
	                        		
	                        			
	                        		</td>	 
	                              		
	                        	</tr>
	                        ';                   
	                        
	                        
	                        $num= $num+1;
	                        
							}
	                        
	                    }// while 
	                    
	                }else{

							$filas .= '
	                        	
							<tr>
							<td class="center " colspan="7">
								<span class="text-muted">Sin Registros</span>
							</td>
							</tr>
	                        		';


							$filas_no .= '
	                        	
							<tr>
							<td class="center " colspan="7">
								<span class="text-muted">Sin Registros</span>
							</td>
							</tr>
	                        		';
	                        			                
	                }
	                
	              //  $campo_buscar = crea_campo_buscar('admin_recibos'); 
					$campo_buscar = crea_campo_buscar_cust('admin_recibos',3); 
					$campo_buscar_no = crea_campo_buscar_cust('admin_recibos_no',3); 
		   	  		  	
    		   	  	$tables = '
    		   	  	<h4 class="col-md-12  p-2 title_sec" > Recibos de <b> '.$user_nameb.'</b> </h4>
				  		
						<div class="col-md-12 mnu_bar center "> 
							<div class="btn-group-bar" style="margin-bottom:-5px;">
								<button id="recibosopc_1" type="button" class="btn btn-primary recibosopc" onclick="barmenu(this.id);" > Activos </button>
								<button id="recibosopc_2" type="button" class="btn btn-inverse-primary recibosopc" onclick="barmenu(this.id);"> Historial </button>
							</div>
						</div>


						<div id="div_recibosopc_1" class="col-md-12" style="margin-top:10px; height:420px; overflow-x: hidden; overflow-y:auto;">
		   	  		  	
		   	  		  	'. $campo_buscar.'
		   	  		  			<table class="table table-striped " id="admin_recibos" >
				                      <thead>
				                        <tr>
				                          <th class="thead_content" style=""> No</th>
										  <th class="thead_content" style=""> ID</th>
				                          <th class="thead_content" style=""> Recibo </th>
				                          <th class="thead_content" style=""> Fecha </th>
				                          <th class="thead_content" style=""> Precio </th>
				                          <th class="thead_content" style=""> Estado</th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$filas.'
				                      
				                      <tfooter>
				                        <tr>
				                          <th class="thead_content" style=""> No </th>
										  <th class="thead_content" style=""> ID</th>
				                          <th class="thead_content" style=""> Recibo </th>
				                          <th class="thead_content" style=""> Fecha </th>
				                          <th class="thead_content" style=""> Precio </th>
				                          <th class="thead_content" style=""> Estado</th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </tfooter>				                      
				                      
				                </table>
						</div>

						<div id="div_recibosopc_2" class="col-md-12 no-show" style="margin-top:10px; height:420px; overflow-x: hidden; overflow-y:auto;">
		   	  		  	
		   	  		  	'. $campo_buscar_no.'
		   	  		  			<table class="table table-striped " id="admin_recibos_no" >
				                      <thead>
				                        <tr>
				                          <th class="thead_content" style=""> No</th>
										  <th class="thead_content" style=""> ID</th>
				                          <th class="thead_content" style=""> Recibo </th>
				                          <th class="thead_content" style=""> Fecha </th>
				                          <th class="thead_content" style=""> Precio </th>
				                          <th class="thead_content" style=""> Estado</th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$filas_no.'
				                      
				                      <tfooter>
				                        <tr>
				                          <th class="thead_content" style=""> No </th>
										  <th class="thead_content" style=""> ID</th>
				                          <th class="thead_content" style=""> Recibo </th>
				                          <th class="thead_content" style=""> Fecha </th>
				                          <th class="thead_content" style=""> Precio </th>
				                          <th class="thead_content" style=""> Estado</th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </tfooter>				                      
				                      
				                </table>
						</div>
		   	  		  	'; 		                    
	            


	   
	   return $tables;
	   
	 //  return '1234';
	
}
///////

function get_access_info_user($id_usuario){
	
	$user_admin = $GLOBALS['user'];
	
	//////////////// Encuentra las facturas de cada usuario
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		      //informacion de acceso a la bd
		// Check connection
			if ($dbh->connect_error) {
		    	die("Connection failed: " . $dbh->connect_error);
			}


//Select * from recibos, 
		
              $qr = "select * from session_user where id_user = $id_usuario order by fecha desc;";// preparando la instruccion sql

   
			    $result= $dbh->query($qr);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
                        while($row= $result->fetch_assoc()){
	                        
					$user_info = busca_user($id_usuario);
					$data_user = explode('--', $user_info);
					$error = $data_user[0];
					$nombre = $data_user[1];
					$correo = $data_user[2];
					$user_nameb = $data_user[3];
					$foto = $data_user[4];	
					

								 $permiso_elimina = get_permiso_config('27', $GLOBALS['user_perfil']);
								 //$qb = "SELECT * from permisos_pagina where id_recurso = $id_pag and id_perfil = $id_user and tipo = 2; ";// preparando la instruccion sql
								 //var_dump($user_admin);
								 
								// var_dump($perfil);
								 
								 if($permiso_elimina==1){
								 	if($row['estado']==99){

					                $btn_eliminar='
					                <button class="btn btn-outline-secondary disabled text-diactive btn_thin" title="Eliminar" > 
					                       <i class="fas fa-trash"></i> </button> '; 
									 	
								 	}else{

					                $btn_eliminar='
					                <button class="btn btn-outline-secondary btn_thin" title="Eliminar" onclick="elimina_reg(\'1-'.$row['id'].'\')" > 
					                       <i class="fas fa-trash"></i> </button> '; 									 	
								 	}
								 
								 }else{

					                $btn_eliminar='
					                <button class="btn btn-outline-secondary disabled text-diactive btn_thin" title="Eliminar" > 
					                       <i class="fas fa-trash"></i> </button> '; 																 
								 }
	            
                            if(strtoupper($row['dispositivo'])=='MAC OS'){
                                $ico = '<i class="fa-solid fa-laptop"></i>';
                            }elseif(strtoupper($row['dispositivo'])=='IPHONE'){
                                $ico = '<i class="fa-solid fa-mobile-screen"></i>';
                            }elseif(strtoupper($row['dispositivo'])=='WINDOWS'){
                                $ico = '<i class="fa-solid fa-laptop"></i>';
                            }else{
                                $ico = '<i class="fa-solid fa-mobile-screen-button"></i>';
                            }

                             if($row['estado']==0){

                                     $btn_edo ='
                                     <button class="btn btn-outline-primary btn_thin" title="Activar" onclick="actualiza_reg(\'1-'.$row['id'].'\')" > 
					                       <i class="fa-solid fa-toggle-on"></i> </button> ';

                                     $edo_edo = '<span class="text-clear" style="font-size:1.3rem;"><i class="fa-solid fa-toggle-off"></i></span>';
                                 }else{
                                     $btn_edo ='
                                     <button class="btn btn-outline-secondary btn_thin" title="Desactivar" onclick="actualiza_reg(\'1-'.$row['id'].'\')" > 
					                       <i class="fa-solid fa-toggle-off"></i> </button> ';

                                     $edo_edo = '<span class="text-success" style="font-size:1.3rem;"><i class="fa-solid fa-toggle-on"></i></span>';
                                 }
	                        
                             $options =$btn_edo.$btn_eliminar ; 

	                        $filas .= '
	                        	
	                        	<tr>
	                        		<td>
	                        			<span class="text-muted" >'.$num.'</span>
	                        		</td>

	                        		<td >
	                        			<span class="text-muted"> <span class="text-muted text-small">'.$row['id'].'</span>
	                        			<input type="hidden" id="id_log_'.$row['id'].'" value="'.$row['id'].'">
	                        		</td>
	                        	

	                        		<td>
	                        			<span class="text-muted"> '.$row['ip_address'].'</span> <br> <span class="text-muted" style="font-size:0.6rem;"> <i class="fa-solid fa-location-dot"></i> '.strtoupper($row['ciudad']).', '.strtoupper($row['pais']).' </span>
	                        		</td>         
	                        		
	                        		<td>
	                        			<span class="text-muted" style="font-size:0.8rem;"> '.$ico.' '.strtoupper($row['navegador'].' / '.$row['dispositivo']).'</span>
	                        		</td>       

	                        		<td>
	                        			<span class="text-muted" style="text-align:center; font-size:14px;">'.formatFechaHoraTable($row['fecha']).'</span>
	                        		</td>                 		
	                        		                 		
	                        		<td class="center" style="text-align:center; ">
	                        			 '.$edo_edo.'
	                        		</td>
	                        			                        			                        		
	                        		<td>
	                        		
	                        		
	                        			<div class="btn-group" role="group" aria-label="">
											'.$options.'
										</div> 
	                        		
	                        			
	                        		</td>	 
	                              		
	                        	</tr>
	                        ';                   
	                        
	                        
	                        $num= $num+1;
	                        
                       
	                        
	                    }// while 
	                    
	                }else{

							$filas .= '
	                        	
							<tr>
							<td class="center " colspan="7">
								<span class="text-muted">Sin Registros</span>
							</td>
							</tr>
	                        		';
	                        			                
	                }
		   	  		  	
    		   	  	$tables = '
		   	  		  	
		   	  		  			<table class="table table-striped " id="admin_accesos" >
				                      <thead>
				                        <tr>
				                          <th class="thead_content" style=""> No</th>
				                          <th class="thead_content" style=""> ID </th>
				                          <th class="thead_content" style=""> IP </th>
                                          <th class="thead_content" style=""> Dispositivo </th>
                                          <th class="thead_content" style=""> Fecha </th>
                                          <th class="thead_content" style=""> Estado </th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$filas.'
				                      
				                      <tfooter>
				                        <tr>
				                          <th class="thead_content" style=""> No</th>
				                          <th class="thead_content" style=""> ID </th>
				                          <th class="thead_content" style=""> IP </th>				                          
                                          <th class="thead_content" style=""> Dispositivo </th>
                                          <th class="thead_content" style=""> Fecha </th>
                                          <th class="thead_content" style=""> Estado </th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </tfooter>				                      
				                      
				                </table>	   	  		  	
		   	  		
		   	  		  	'; 		                    
	            


	   
	   return $tables;
	   
	 //  return '1234';
	
}
/////////////////////////

function get_historial_info_user($id_usuario){
	
	$user_admin = $GLOBALS['user'];
	
	//////////////// Encuentra las facturas de cada usuario
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		      //informacion de acceso a la bd
		// Check connection
			if ($dbh->connect_error) {
		    	die("Connection failed: " . $dbh->connect_error);
			}


//Select * from recibos, 
		
              $qr = "select * from page_request_user where id_user = $id_usuario order by fecha desc;";// preparando la instruccion sql

   
			    $result= $dbh->query($qr);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
                        while($row= $result->fetch_assoc()){
	                        
					$user_info = busca_user($id_usuario);
					$data_user = explode('--', $user_info);
					$error = $data_user[0];
					$nombre = $data_user[1];
					$correo = $data_user[2];
					$user_nameb = $data_user[3];
					$foto = $data_user[4];	
					
								 $permiso_elimina = get_permiso_config('28', $GLOBALS['user_perfil']);
								 //$qb = "SELECT * from permisos_pagina where id_recurso = $id_pag and id_perfil = $id_user and tipo = 2; ";// preparando la instruccion sql
								 //var_dump($user_admin);
								 
								// var_dump($perfil);
								 
								 if($permiso_elimina==1){
								 	if($row['estado']==99){

					                $btn_eliminar='
					                <button class="btn btn-outline-secondary disabled text-diactive btn_thin" title="Eliminar" > 
					                       <i class="fas fa-trash"></i> </button> '; 
									 	
								 	}else{

					                $btn_eliminar='
					                <button class="btn btn-outline-secondary btn_thin" title="Eliminar" onclick="elimina_reg(\'2-'.$row['id'].'\')" > 
					                       <i class="fas fa-trash"></i> </button> '; 									 	
								 	}
								 
								 }else{

					                $btn_eliminar='
					                <button class="btn btn-outline-secondary disabled text-diactive btn_thin" title="Eliminar" > 
					                       <i class="fas fa-trash"></i> </button> '; 

																 
								 }

                                 if($row['estado']==0){

                                     $btn_edo ='
                                    <button class="btn btn-outline-primary btn_thin" title="Activar" onclick="actualiza_reg(\'2-'.$row['id'].'\')" > 
					                <i class="fa-solid fa-toggle-on"></i> </button> ';
                                     $edo_edo = '<span class="text-clear" style="font-size:1.3rem;"><i class="fa-solid fa-toggle-off"></i></span>';
                                
                                }else{

                                     $btn_edo ='
                                     <button class="btn btn-outline-secondary btn_thin" title="Desactivar" onclick="actualiza_reg(\'2-'.$row['id'].'\')" > 
					                       <i class="fa-solid fa-toggle-off"></i> </button> ';

                                     $edo_edo = '<span class="text-success" style="font-size:1.3rem;"><i class="fa-solid fa-toggle-on"></i></span>';
                                 }
	
	                
	                        $options =$btn_edo.$btn_eliminar ; 
	                

                            $info_url = explode('&',$row['url']);
                            $url_base = $info_url[0];

                            $info_url_main = explode('=',$info_url[0]);
                            $url_main = $info_url_main[1];

                            $info_sub_url = get_info_mnu_cve($url_main); 
                            $data_info = explode('|',$info_sub_url);
                            $page = $data_info[1];

							//<a class="text-primary no-show" href="'.$row['url'].'" target="_new" style="font-size:0.6rem;"> '.$url_base.'...</span>
	                        
	                        $filas .= '
	                        	
	                        	<tr >
	                        		<td  class="center" >
	                        			<span class="text-muted" >'.$num.'</span>
	                        		</td>

	                        		<td class="center" >
	                        			<span class="text-muted">  <code>'.$row['id'].'</code> </span>
	                        			
	                        		</td>  

	                        		<td>
                                        <a class="btn btn-inverse-primary text-primary" href="'.$row['url'].'" target="_new" style="font-size:0.8rem; margin-right:5px;"> 
                                        <span style="margin-right:5px;">'.$page.'</span> <i class="fa-solid fa-arrow-up-right-from-square"></i> </a>
                                        
										
	                        			
	                        		</td>  

	                        		<td class="center">
	                        			<span class="text-muted" style="text-align:center; font-size:14px;">'.formatFechaHoraTable($row['fecha_solicitado']).'</span>
	                        		</td> 
                                    <td class="center" style="text-align:center;" >                	
	                        			        '. $edo_edo .'   
                                    </td>          			                        		
	                        		<td class="center">
	                        			<div class="btn-group" role="group" aria-label="">
											'.$options.'
										</div> 
	                        		</td>	 
	                              		
	                        	</tr>
	                        ';                   
	                        $num= $num+1;
	                    }// while 
	                    
	                }else{

							$filas .= '	                        	
							<tr>
							<td class="center " colspan="6">
								<span class="text-muted">Sin Registros</span>
							</td>
							</tr>
	                        		';
	                        			                
	                }
	                
    		   	  	$tables = '
    		   	  
		   	  		  			<table class="table table-striped " id="admin_historial" >
				                      <thead>
				                        <tr>
				                          <th class="thead_content" style=""> No</th>
				                          <th class="thead_content" style=""> ID </th>
                                          <th class="thead_content" style=""> URL </th>
				                          <th class="thead_content" style=""> Fecha </th>
                                          <th class="thead_content" style=""> Estado </th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </thead>				                      
				                                '.$filas.'				                      
				                      <tfooter>
				                        <tr>
				                          <th class="thead_content" style=""> No</th>
				                          <th class="thead_content" style=""> ID </th>
                                          <th class="thead_content" style=""> URL </th>
				                          <th class="thead_content" style=""> Fecha </th>
                                          <th class="thead_content" style=""> Estado </th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </tfooter>
				                </table>	   	  		  	
		   	  		  	'; 		                    
	            
	   return $tables;
	   
	 //  return '1234';
	
}

////////////


function get_sugerencias_user($id_usuario){

	//var_dump($id_usuario);

	$user_admin = $GLOBALS['user'];
	
	//////////////// Encuentra las facturas de cada usuario
	include("access.php");
	
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		      //informacion de acceso a la bd
		// Check connection
			if ($dbh->connect_error) {
		    	die("Connection failed: " . $dbh->connect_error);
			}


			$user_info = busca_user($id_usuario);
			$data_user = explode('--', $user_info);
			$error = $data_user[0];
			$nombre = $data_user[1];
			$correo = $data_user[2];
			$user_nameb = $data_user[3];
			$foto = $data_user[4];

              $qr = "Select * from sugerencias where id_user = $id_usuario order by estado asc;";// preparando la instruccion sql

   
			    $result= $dbh->query($qr);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
					$numb = 1;
					$numc = 1;

                        while($row= $result->fetch_assoc()){
	                        

					
					
					/*$data_color = get_info_serie($row['nombre_prod']);
	                        
	                $data = explode('/', $data_color);
	                        
	                $nombre_serie = $data[0];
	                $color_serie = $data[1];
	                $fecha_serie = $data[2];
	                $precio_serie = $data[4];
					
					*///var_dump($user_info);
					
					// Directorio
					
					$data_fecha = explode('-', $row['fecha_envio']);
					$anio = $data_fecha[0];
					$mes = $data_fecha[1];
					$dia = $data_fecha[2];
					
					$data_edo_sug = get_data_estado_sug($row['estado']);

					$data_sug = explode(';', $data_edo_sug);
					$nombre_sug = $data_sug[0];
					$icono_sug = $data_sug[1];
					$color_sug = $data_sug[2];
					$avance_sug = $data_sug[3];
					
					
					$lbl_estado = crea_lbl_sugerencia($row['estado']);
					
					if($row['archivado']==1){
						$edo = '
						<div class="row">
						<span class="col-md-2 bubble_text bg-secondary text-muted" title="Archivado" style=""> <i class="fa fa-archive" ></i> </span> 
						<span class="left col-md-8 text-'.$color_sug.' ico_estado" title="'.$nombre_sug.'" style="text-align:left;" > <i class="fas '.$icono_sug.'" ></i> '.$nombre_sug.' </span>
						</div>
						';
						

						$btn_archivar='
						<button class="btn btn-primary btn_thin" title="Desarchivar" onclick="edit_sug(\'1-'.$row['id'].'-1\')" > 
	                       <i class="fa-solid fa-file-arrow-up"></i> </button> '; 
	                       
	                      $bg_archivado = 'bg-muted'; 
	                       						
					}else{
						$edo = '
						<div class="row">
						<span class="col-md-2 " style="padding:5px; margin-bottom:15px;">  </span>
						<span class="col-md-8 text-'.$color_sug.' ico_estado" title="'.$nombre_sug.'" style="text-align:left;" > <i class="'.$icono_sug.'" ></i> '.$nombre_sug.' </span>
						</div>
						';
						
						$btn_archivar='
						<button class="btn btn-inverse-primary btn_thin" title="Archivar" onclick="edit_sug(\'1-'.$row['id'].'-1\')" > 
	                       <i class="fa-solid fa-file-arrow-down"></i> </button> '; 
	                       
	                       $bg_archivado = ''; 
					}


								 $permiso_elimina = get_permiso_config('7', $GLOBALS['user_perfil']);
								 
								// var_dump($perfil);
								 
								 if($permiso_elimina==1){
                    					if($row['estado']==99){
                    	                	$btn_eliminar='
                    	                <button class="btn btn-inverse-primary btn_thin text-muted" disabled title="Eliminar" onclick="edit_sug(\'2-'.$row['id'].'\')" > 
                    	                       <i class="fas fa-trash"></i> </button> '; 						
                    					}else{
                    	                	$btn_eliminar='
                    	                <button class="btn btn-inverse-primary btn_thin" title="Eliminar" onclick="edit_sug(\'2-'.$row['id'].'\')" > 
                    	                       <i class="fas fa-trash"></i> </button> '; 						
                    					}
							 
								 }else{

								 $btn_eliminar='
	                <button class="btn btn-secondary btn_thin text-muted" disabled title="Eliminar"  > 
	                       <i class="fas fa-trash"></i> </button> '; 					               

																 
								 }



					

					
					$btn_guardar = '
						<button class="btn btn-inverse-primary btn_thin" title="Guardar" onclick="edit_sug(\'3-'.$row['id'].'\')" > 
	                       <i class="fas fa-save"></i> </button> '; 
					
					                      	                       
	                $btn_edita='
	                <button class="btn btn-inverse-primary btn_thin" title="Editar" onclick="toggleb(\'row_'.$row['id'].'\')" > 
	                       <i class="fa fa-pencil"></i> </button> '; 
	                					

	                
	                $select_edo = '<select class="col-sm-8 form-control" id="estado_sug_'.$row['id'].'">'.genera_select_edo_sug($row['estado']).'</select>' ;
	                
	                
	                
	                
	                $options = '
	                <div class="btn-group" role="group" aria-label="">'.$btn_archivar.'</div>&nbsp;&nbsp;&nbsp;<div class="btn-group" role="group" aria-label="">'.$btn_eliminar.'</div>'; 
	                
	                
	                $data_time = explode(' ',$row['fecha_completa']);
	                $fecha_b = $data_time[0];
	                $hora_b = $data_time[1];


// Comentaios

						if($row['respuesta'] != ''){
							
							$pos = strpos($row['respuesta'],'|');
							//var_dump($pos);
							
							if($pos === FALSE){
								
								$elem = explode('--', $row['respuesta']);
								$coment = $elem[0];
								$fecha_r = formatFechaHora($elem[1]);
								
									$li = '
									      <li class="col-sm-6 timeline-item">
					                        <p class="timeline-content text-sm text-muted" style="display: flex;">'.$coment.'</p>
					                        <p class="event-time text-primary">'.$fecha_r.'</p>
					                      </li>
									
									';
								
								$conv = ' <ul class="timeline"> '.$li.' </ul> '; 
								
							}elseif($pos > 0){
								
								$data_res = explode('|', $row['respuesta']);
								$itera = count($data_res);
								$li = '';
								
									for($i=0;$i<= count($data_res);$i++){
										
										$length_itr = strlen($data_res[$i]);
										
										if($length_itr > 5){
										
										$elem = explode('--', $data_res[$i]);
										$coment = $elem[0];
										$fecha_r = formatFechaHora($elem[1]);
																			
											$li .= '
											      <li class="timeline-item">
							                        <p class="timeline-content text-sm text-muted" >'.$coment.'</p>
							                        <p class="event-time text-mc text-primary">'.$fecha_r.'</p>
							                      </li>
											
											';
										}
									}	
								
								$conv = ' <ul class="timeline"> '.$li.' </ul> '; 
														
							}
						}

///////	                        
							//$link = $link_site.
							$mnu = '4d426a17cee6f137538a4c607d550ae8'; 
							$url = $link_site.'?mnu='.$mnu.'&item='.$row['id'];
							$urlb =  $link_site.'?mnu=4d426a17cee6f137538a4c607d550ae8';
							
							$btn_detalles = '
	                        	<form action="'.$urlb.'" method="post" > 
	                        		<input type="hidden" name="id_sugerencia" value="'.$row['id'].'">
	                        		<button type="submit" target="_new" class="btn btn-outline-secondary" value="" >'.$row['folio'].'</button 
	                        	</form>							
							
							
							'; 

								$btn_a = '<a href="'.$url.'" class="text-primary"> 
	                        				<span class="text-small">'.$row['folio'].' <i class="fa-solid fa-arrow-up-right-from-square"></i> </span>             				
	                        			</a>';
	                       
	                        if($row['estado']==2){
								
								$filas_no .= '

	                        	
	                        	<tr class="">
	                        		<td class="center">
	                        			'.$numb.'
	                        		</td>
									<td class="center">
	                        			<code class="code_cust" >'.$row['id'].'</code>
	                        		</td>	
	                        		                       	
	                        		<td class="center" >
	                        			'.$btn_a.'

										</td>
	                        		

	                        		<td class="center">
	                        			<span class="text-muted">'.formatFechaHoraTable($row['fecha_completa']).'</span>
	                        		</td>

	                        		<td class="center">
	                        			<span class="text-muted text-small">'.$row['cve_lego'].'</span>
	                        		</td> 
	                        			                        		                 		
	                        		<td class="center" style="text-align:center; ">
	                        			<span class="text-muted"> '.$lbl_estado.'</span>
	                        		</td>
	                        			                        			                        		
	                        		<td class="center"> 
	                        			'.$options.'
	                        		</td>	 
	                              		
	                        	</tr>
	                        ';    
							$numb= $numb+1;
							}elseif($row['estado']==0 or $row['estado']==6 or $row['estado']==99 ){

								$filas_hist .= '

	                        	
	                        	<tr class="">
	                        		<td class="center">
	                        			'.$numc.'
	                        		</td>	
									<td class="center">
	                        			<code class="code_cust" >'.$row['id'].'</code>
	                        		</td>	 
	                        		                       	
	                        		<td class="center" >
	                        			'.$btn_a.'

										</td>
	                        		

	                        		<td class="center">
	                        			<span class="text-muted">'.formatFechaHoraTable($row['fecha_completa']).'</span>
	                        		</td>

	                        		<td class="center">
	                        			<span class="text-muted text-small">'.$row['cve_lego'].'</span>
	                        		</td> 
	                        			                        		                 		
	                        		<td class="center" style="text-align:center; ">
	                        			<span class="text-muted"> '.$lbl_estado.'</span>
	                        		</td>
	                        			                        			                        		
	                        		<td class="center"> 
	                        			'.$options.'
	                        		</td>	 
	                              		
	                        	</tr>
	                        ';  
							$numc= $numc+1;
							}else{

							$filas .= '

	                        	
	                        	<tr class="">
	                        		<td class="center">
	                        			'.$num.'
	                        		</td>	 
									<td class="center">
	                        			<code class="code_cust" >'.$row['id'].'</code>
	                        		</td>	
	                        		                       	
	                        		<td class="center" >
	                        			'.$btn_a.'

										</td>
	                        		

	                        		<td class="center">
	                        			<span class="text-muted">'.formatFechaHoraTable($row['fecha_completa']).'</span>
	                        		</td>

	                        		<td class="center">
	                        			<span class="text-muted text-small">'.$row['cve_lego'].'</span>
	                        		</td> 
	                        			                        		                 		
	                        		<td class="center" style="text-align:center; ">
	                        			<span class="text-muted"> '.$lbl_estado.'</span>
	                        		</td>
	                        			                        			                        		
	                        		<td class="center"> 
	                        			'.$options.'
	                        		</td>	 
	                              		
	                        	</tr>
	                        ';                   
	                        
	                        
	                        $num= $num+1;
	                        
							}
	                        
	                    }// while 
	                   
	                }else{

							$filas .= '
	                        	
	                        	<tr>
	                        		<td class="center " colspan="6">
	                        			<span class="text-muted">Sin Registros</span>
	                        		</td>
	                        		</tr>
	                        		';

									$filas_no .= '
	                        	
									<tr>
										<td class="center " colspan="6">
											<span class="text-muted">Sin Registros</span>
										</td>
										</tr>
										';
	                        			                
	                }
	                   
		   	  		  	//$campo_buscar = crea_campo_buscar('admin_sugerencias'); 
						$campo_buscar = crea_campo_buscar_cust('admin_sugerencias',3);
						$campo_buscar_rec = crea_campo_buscar_cust('admin_sugerencias_rec',3);
						$campo_buscar_hist = crea_campo_buscar_cust('admin_sugerencias_hist',3);
			
		   	  		  	
    		   	  	$tables = '
    		

    		   	  <h4 class="col-md-12  p-2 title_sec" > Sugerencias de <b> '.$user_nameb.'</b> </h4>
				  		
				  	<div class="col-md-12 mnu_bar center "> 
						<div class="btn-group-bar" style="margin-bottom:-5px;">
							<button id="sugopc_1" type="button" class="btn btn-primary sugopc" onclick="barmenu(this.id);" > Recientes </button>
							<button id="sugopc_2" type="button" class="btn btn-inverse-primary sugopc" onclick="barmenu(this.id);"> Seguimiento </button>
							<button id="sugopc_3" type="button" class="btn btn-inverse-primary sugopc" onclick="barmenu(this.id);"> Historial </button>
						</div>
					</div>


						<div id="div_sugopc_1" class="col-md-12" style="margin-top:10px; height:420px; overflow-x: hidden; overflow-y:auto;">
		   	  		  	
		   	  		  		'.$campo_buscar_rec.'
		   	  		  			<table class="table table-striped " id="admin_sugerencias_rec" >
				                      <thead>
				                        <tr>
				                          <th class="thead_content" style=""> No</th>
										  <th class="thead_content" style=""> ID</th>
				                          <th class="thead_content" style=""> Recibo </th>
				                          <th class="thead_content" style=""> Fecha </th>
				                          <th class="thead_content" style=""> Serie </th>
				                          <th class="thead_content" style=""> Estado</th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$filas_no.'
				                      
				                      <tfooter>
				                        <tr>
				                          <th class="thead_content" style=""> No </th>
										   <th class="thead_content" style=""> ID</th>
				                          <th class="thead_content" style=""> Recibo </th>
				                          <th class="thead_content" style=""> Fecha </th>
				                          <th class="thead_content" style=""> Serie </th>
				                          <th class="thead_content" style=""> Estado</th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </tfooter>				                      
				                      
				                </table>	
						</div>

						<div id="div_sugopc_2" class="col-md-12 no-show" style="margin-top:10px; height:420px; overflow-x: hidden; overflow-y:auto;">
		   	  		  	
		   	  		  		'.$campo_buscar.'
		   	  		  			<table class="table table-striped " id="admin_sugerencias" >
				                      <thead>
				                        <tr>
				                          <th class="thead_content" style=""> No</th>
										   <th class="thead_content" style=""> ID</th>
				                          <th class="thead_content" style=""> Recibo </th>
				                          <th class="thead_content" style=""> Fecha </th>
				                          <th class="thead_content" style=""> Serie </th>
				                          <th class="thead_content" style=""> Estado</th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$filas.'
				                      
				                      <tfooter>
				                        <tr>
				                          <th class="thead_content" style=""> No </th>
										   <th class="thead_content" style=""> ID</th>
				                          <th class="thead_content" style=""> Recibo </th>
				                          <th class="thead_content" style=""> Fecha </th>
				                          <th class="thead_content" style=""> Serie </th>
				                          <th class="thead_content" style=""> Estado</th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </tfooter>				                      
				                      
				                </table>	
						</div>   	  		  	

						<div id="div_sugopc_3" class="col-md-12 no-show" style="margin-top:10px; height:420px; overflow-x: hidden; overflow-y:auto;">
		   	  		  	
		   	  		  		'.$campo_buscar_hist.'
		   	  		  			<table class="table table-striped " id="admin_sugerencias_hist" >
				                      <thead>
				                        <tr>
				                          <th class="thead_content" style=""> No</th>
										   <th class="thead_content" style=""> ID</th>
				                          <th class="thead_content" style=""> Recibo </th>
				                          <th class="thead_content" style=""> Fecha </th>
				                          <th class="thead_content" style=""> Serie </th>
				                          <th class="thead_content" style=""> Estado</th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      '.$filas_hist.'
				                      
				                      <tfooter>
				                        <tr>
				                          <th class="thead_content" style=""> No </th>
										   <th class="thead_content" style=""> ID</th>
				                          <th class="thead_content" style=""> Recibo </th>
				                          <th class="thead_content" style=""> Fecha </th>
				                          <th class="thead_content" style=""> Serie </th>
				                          <th class="thead_content" style=""> Estado</th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </tfooter>				                      
				                      
				                </table>	
						</div> 

						
		   	  		  	'; 	   	  		  
		   	  		  		   	  		  	       
	                    
return $tables;

}



/////////////--- Busca info de usuario en la base ////////////////

function get_info_sugerencia($id_sugerencia){
	
	include("access.php");	
	$id_user = $id;
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM sugerencias where id = $id_sugerencia; ";// preparando la instruccion sql
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
			 $error = 0 ;
			 $datos_encontrados= $error.'|'.$row['id_user'].'|'.$row['fecha_envio'].'|'.$row['cve_lego'].'|'.$row['id_tema'].'|'.$row['tipo'].'|'.$row['detalles'].'|'.$row['estado'].'|'.$row['fecha_completa'].'|'.$row['fecha_respuesta'].'|'.$row['folio'].'|'.$row['archivado'].'|'.$row['id'];
			 
	    }else{
		    $error = 1 ;
		   	$datos_encontrados= $error.'|'.$nombre.'|'.$correo.'|'.$user_name.'|'.$foto.'|'.$row['id'].'|'.$row['clave'].'|'.$row['fecha_registro'];	    
	    }
	    
	return $datos_encontrados; 	
	$dbh->close();
}
///////////////////////////////////////////////////////

function get_resp_sugerencia($id_sugerencia){
	
	include("access.php");	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM sugerencias where id = $id_sugerencia; ";// preparando la instruccion sql
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
			 $error = 0 ;
			 $datos_encontrados= $row['respuesta'];
			 
	    }else{
		    $error = 1 ;
		   	$datos_encontrados= $error;	    
	    }
	    
	return $datos_encontrados; 	
	$dbh->close();
}
///////////////////////////////////////////////////////

function crea_lbl_sugerencia($estado){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM estado_sug where cve = $estado;";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
			
			//$coleccion = $row['clave'].'|'.$row['titulo'].'|'.$row['fecha_actualizado'];
				
					$lbl = '<label class="col-form-label"> <span class="text-'.$row['color'].'" > <i class="'.$row['icono'].'"></i> '.$row['nombre'].' </span>  </label>';
				
				
			
		}else{
					
					$lbl = '<label class="col-form-label"> <span class="text-muted" > <i class="fa fa-ban"></i> No Registrado </span>  </label>';
		}
	

	
	
	return $lbl;	
	
	
}


function crea_campo_buscar($id_tabla){
	
	
	
	$pos = strpos($id_tabla,'_');
	
	//var_dump($pos);
	
	if($pos > 0){
		$nomb = substr_replace('_',' ', $id_tabla);
	}else{
		$nomb =  $id_tabla;
	}
	
	$campo= '
	
						<div class=" form-group">
                          <div class="input-group">
                            <div class="input-group-prepend bg-head">
                              <span class="input-group-text text-ligth"><i class="fa-solid fa-magnifying-glass"></i></span>
                            </div>
                           <input type="text" class="col-sm-3 form-control" id="campo_buscar" value="" placeholder="Buscar Registro" onkeyup="search_table(\''.$id_tabla.'\')" >

                          </div>
                        </div>
	
	';
	
	return $campo;
	
}

///////////////
function crea_campo_buscar_colecciones($id_tabla){
	
	
	
	$pos = strpos($id_tabla,'_');
	
	//var_dump($pos);
	
	if($pos > 0){
		$nomb = substr_replace('_',' ', $id_tabla);
	}else{
		$nomb =  $id_tabla;
	}
	
	$campo= '
	
						
                          <div class="input-group">
                            <div class="input-group-prepend bg-head">
                              <span class="input-group-text text-ligth"><i class="fa-solid fa-magnifying-glass"></i></span>
                            </div>
                           <input type="text" class="col-sm-12 form-control" id="campo_buscar" value="" placeholder="Buscar Registro" onkeyup="search_table(\''.$id_tabla.'\')" >

                          </div>
                        
	
	';
	
	return $campo;
	
}

///////////////
function crea_campo_buscar_md($id_tabla){
	
	
	
	$pos = strpos($id_tabla,'_');
	
	//var_dump($pos);
	
	if($pos > 0){
		$nomb = substr_replace('_',' ', $id_tabla);
	}else{
		$nomb =  $id_tabla;
	}
	
	$campo= '
						  <div class="input-group">
							<div class="input-group-prepend bg-head">
							  <span class="input-group-text text-ligth"><i class="fa-solid fa-magnifying-glass"></i></span>
							</div>
						   <input type="text" class="col-sm-6 form-control" id="campo_buscar" value="" placeholder="Buscar Registro" onkeyup="search_table(\''.$id_tabla.'\')" >
						  </div>
	';
	
	return $campo;
	
}
////////

function crea_campo_buscar_cust($id_tabla,$tamanio){
	
	
	
	$pos = strpos($id_tabla,'_');
	
	//var_dump($pos);
	
	if($pos > 0){
		$nomb = substr_replace('_',' ', $id_tabla);
	}else{
		$nomb =  $id_tabla;
	}
	
	$campo= '
						<div class=" form-group">
						  <div class="input-group">
							<div class="input-group-prepend bg-head">
							  <span class="input-group-text text-ligth"><i class="fa-solid fa-magnifying-glass"></i></span>
							</div>
						   <input type="text" class="col-sm-'.$tamanio.' form-control" id="campo_buscar_'.$id_tabla.'" value="" placeholder="Buscar Registro" onkeyup="search_table(\''.$id_tabla.'\')" >
						  </div>
						  </div>
	';
	
	return $campo;
	
}
////////


function get_users_serie_nvo($serie){

include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM coleccion where clave_lego = $serie and estado = 1 GROUP BY id_user order by id_user";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	
	    	$ant = ''; 
	    	$current = ''; 
	    	
	    	$tot = $resultb->num_rows;
			while($row= $resultb->fetch_assoc()){


			$item = $row['id_user'].';'.$row['clave_lego'];
			$total_fig = busca_info_coleccion($item);
							
				$current = $row['id_user'];
				//$id_user = $row['id_user'];
				
				if($tot== 1){
					$txt_label = 'Fig';
					
				}else{
					$txt_label = 'Figs';
				}
				
				if($ant != $current){
				
					$data_user = busca_user($row['id_user']); 													
					$info = explode('--', $data_user); 
					$error =  $info[0];
					$nombre = $info[1];
					$correo = $info[2];
					$username = $info[3];
					$foto = $info[4];
													
					if($username!= ''){
						//$usuarios .= '<span class="text-muted border-bottom" style="display: block; clear:both; margin: 1px 0px;  " >
						//	<i class="fa fa-user" ></i> '.$username.' 
						//	</span>';
						$mnu = $_GET['mnu'];
						$item = $_GET['item'];
						$element = $_GET['element'];
							
						$link = $link_site.'?mnu='.$mnu.'&item='.$item.'&element='.$element.'&q='.$row['id_user'];
						
                        $usuarios .= '
						<a href="'.$link.'" >
							<div id="user_'.$row['id_user'].'" style="padding-top:0px;" class="col-12 row side_menu '.$class_tarjeta.'" >
								
								<div class="col-md-8 hold_info_sm">
									<span class="text-muted" style="font-size:0.9rem;" > @'.$username.'</span><br>
									<span class="text-muted" style="font-size:0.7rem;">'.$total_fig .' '.$txt_label.'</span><br>
                                        					
								</div>

								<div class="col-md-2 hold_link " >
											<a href="'.$link.'" class="text-primary ">
												<i class="fas fa-chevron-right "></i>
											</a>
								</div>
							</div>
							</a>
						';

                        $usuariosb.='
                        
                        <a href="'.$link.'" class="menu_lateral border-bottom text-muted" style="padding-left:0px; padding-right:0px; padding-top:0px; padding-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; margin-bottom:0px; border-bottom:1px solid #ccc; color:#4d3400; " >

										<div class="row col-md-12  bg-light " style="background:  border-left:3px solid rgba(200,200,200,1); font-size:0.8em; margin:0px 0px; margin-left:0px; padding:14px 0px 14px 10px; padding-right:0px; border-bottom:1px solid rgba(200,200,200,0.6); " title="Conf. Gral. Colección">
										   	<span class="col-9 " style="font-size:0.7rem;"><i class="fa-solid fa-user"></i> '.$username.' </span> <br>
                                            <span class="text-muted">'.$total_fig .' '.$txt_label.'</span><br>
											<span class="col-2 text-head" style="float:right; right:-15px; font-size:1em; "><i class="fa-solid fa-chevron-right"></i></span> 
										</div> 
						</a>
                        
                        ';
					}
					
					$ant = $current;
				}else{
					$usuarios .= '';
					$ant = $current;
				}
									
			}
	    	 
	    	 $query = '<div id="user_'.$row['id_user'].'" class="col-sm-12 row hold_perfil border'.$class_tarjeta.'">'.$qb.'</div>';
			 
	    }else{ // si no existe el registro de usuario con esa minifigura, regresa un valor comodin ara generar la lista de elementos

            

            $usuarios .= '
		    <div class="col-md-12 row hold_serie" style="margin-left: 10px; ">
		    <span class="text-muted " style="display: block; clear:both; margin: 1px 0px;  " > Ningún coleccionista ha registrado figuras de esta serie. </span>
		    </div>
		    ';
	    }

 return $usuarios;
}

//////

function get_coleccion_user_nvo($serie, $user){
	
	
	include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
		// determina que tipo de serie es	
		//$qb = "SELECT * FROM coleccion where clave_lego = $serie and id_user = $user;";// preparando la instruccion sql
        $qb = "SELECT * FROM minifiguras where cve_lego = $serie;";

       // var_dump($qb);
		$resultb= $dbh->query($qb);
    
    	if ($resultb->num_rows > 0) {
	   
	    	$num = 0; 
	    	$tot_minifig = $resultb->num_rows;
            $item_col = $user.';'.$serie;
            $total_celeccion = busca_info_coleccion($item_col);

            //var_dump($tot_minifig);
		
            while($row= $resultb->fetch_assoc()){
			
                
				$num= $num+ 1;

                // cruce con coleccion

                $info_item = $row['id'].';'.$user.';'.$serie; 
                //var_dump($id_item);
	                        
                $data_col = get_info_item_coleccion($info_item); 
                //echo($data);
                $data_coleccion = explode(';', $data_col); 
                
                $faltantes = $data_coleccion[0]; 
                $fecha_registro = $data_coleccion[1];
                $estado_col = $data_coleccion[2]; 
                $favorito = $data_coleccion[3];
                $id_col = $data_coleccion[4];
                $id_user = $data_coleccion[5];
                $item = $data_coleccion[6];
                $clave_lego_reg = $data_coleccion[7];
                $no_extra = $data_coleccion[8];
                $mostrat_mkt = $data_coleccion[9];
                $fecha_actualizado = $data_coleccion[10];
                $fecha_fav = $data_coleccion[11];
                $fecha_admin_fav = $data_coleccion[12];
                $fecha_admin_add = $data_coleccion[13];
                //$total_col_user = $data_coleccion[14];

				$nombre_es = $row['nombre_es'];
                $nombre_en = $row['nombre_en'];
                $imagen= $row['imagen'];
                $cve_lego = $row['cve_lego'];
                //$total_minifig = $tot;

                /// Informacion de la serie 
                $data_serie = get_info_serie($serie);
                $info_serie = explode('/',$data_serie);

                $color = $info_serie[1];
                $color_b = $info_serie[14];
                $color_txt = $info_serie[13];

				$format='.webp';
                $path_imagen = 'minifig/'.$serie.'/'.$imagen.$format;
                //var_dump($path_imagen);

                                
                                    if(file_exists($path_imagen)) {							
                                        
                                        $foto = $path_imagen;	                                   
                                             
                                           
                                    } else {
                                        $format='.png';
                                        $path_imagen = 'minifig/'.$serie.'/'.$imagen.$format;
                                        $img_webp = convert_to_webp_url($path_imagen);
                                        
                                        $foto = $img_webp;
                                        
                                    }
            
            if($row['id']==$item){



                if($favorito==1){
                    $fav = '<span  id="ico_fav_'.$item.';'.$user.'" style="color: rgba('.$color.',1); font-size: 0.9rem; "> <i class="fa-solid fa-heart"></i> </span>';
                }else{
                    $fav = '<span id="ico_fav_'.$item.';'.$user.'" style="font-size: 0.9rem" > <i class="fa-regular fa-heart"></i></span> ';
                }

                if($estado_col==1){
                    $ico_edo = '<span id="ico_edo_'.$item.';'.$user.'" style="color: rgba('.$color_b.',1);" > <i class="fa-solid fa-circle-check"></i> </span>';
                }else{
                    $ico_edo = '<span class="text-muted"  id="ico_edo_'.$item.';'.$user.'" > <i class="fa-regular fa-circle-xmark"></i> </span> ';
                }


                $fecha = formatFechaHora($fecha_registro);
                $fechab = formatFechaHora($fecha_actualizado);
                $fecha_fav = formatFechaHora($fecha_fav);

                $fecha_admin_fav = formatFechaHora($fecha_admin_fav);
                $fecha_admin_add = formatFechaHora($fecha_admin_add);

                $color_main = $color;

                if($num == 1){
                    $class_last ='card_ini';
                    $style= ' 
                    border-radius: 0; 
                    border-top: 1px solid rgba('.$color_main.',0.6); 
                    border-right: 1px solid rgba('.$color_main.',0.6); ';

                }elseif($num != 1 and $num != $tot ){
                    $class_last ='card_mid';
                    $style= ' 
                    border-right: 1px solid rgba('.$color_main.',0.6); 
                    border-top: 1px solid rgba('.$color_main.',0.6); ';

                }elseif($num==$tot){
                    $class_last ='card_fin';
                    $style= ' 
                    border-radius: 0 0 5px 5px; 
                    border-bottom: 1px solid rgba('.$color_main.',0.6);
                    border-right: 1px solid rgba('.$color_main.',0.6); 
                    border-top: 1px solid rgba('.$color_main.',0.6); ';
                }

                $b = (1/($tot+2));
                $c = ($num *$b);
                $d = number_format((1-$c),2);

                $grad = ($num / 10);
                $complement = 1-$grad;

                // administrar Favoritos
                $permiso_admin_fav  = get_permiso_config('30', $GLOBALS['user_perfil']);

                if($permiso_admin_fav==1){

                    if($favorito==1){
                        $btn_fav_admin = '
                        <button type="button" onclick="edita_fav_admin(\''.$item.';'.$user.'\')" style="" class="btn btn-inverse-danger btn_thin " id="ico_fav_'.$item.';'.$user.'"> 
                             <i class="fa-solid fa-heart-circle-xmark"></i> 
                        </button>
                        ';
                    }else{
                        $btn_fav_admin = '
                        <button type="button" onclick="edita_fav_admin(\''.$item.';'.$user.'\')" style=" " class="btn btn-inverse-primary btn_thin " > 
                            <i class="fa-solid fa-heart-circle-plus"></i> 
                        </button>
                        ';
                    }
                }else{

                    $btn_fav_admin = ' ';

                }

                // quitar fig de la colleccion
                $permiso_admin_fig  = get_permiso_config('31', $GLOBALS['user_perfil']);

                if($permiso_admin_fig ==1){

                    if($estado_col==1){
                        $btn_fig_admin = '
                        <button type="button" onclick="select_fig_admin(\''.$item.';'.$user.'\')" style="" class="btn btn-inverse-danger btn_thin " id="ico_fav_'.$item.';'.$user.'"> 
                             <i class="fa-solid fa-person-circle-minus"></i>
                        </button>
                        ';
                    }else{

                        $btn_fig_admin = '
                        <button type="button" onclick="select_fig_admin(\''.$item.';'.$user.'\')" style=" " class="btn btn-inverse-primary btn_thin " > 
                            <i class="fa-solid fa-person-circle-plus"></i>
                        </button>
                        ';
                    }
                }else{

                        $btn_fig_admin = ' ';

                }



                    $coleccion .= '	
                    
                    <tr>
                        <td class="text-muted">'.$num.'  </td>
                        <td class="text-muted">                             
                            <img class="zoom" style=" height: 35px; max-width:20px;" src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'" alt="'.$nombre_es.'">
                        </td>

                        <td class="text-muted">
						
                            <div class="row">
                                    
                                    <div class="col-md-1" style="height:100%;">'.$ico_edo.' </div>

                                    <div class="col-md-8">
										<span style="font-size:0.8rem;"> <b>'.substr($nombre_es,0,20).' </b> </span>  <br>
                                        <span style="font-size:0.6rem;"> No. Fig.: '.$row['id'].' </span>  |
                                        <span style="font-size:0.6rem;"> Id Col.: '.$id_col.' </span>                                        
                                    </div>

                                    <div class="col-md-1" style="height:100%;"> '.$fav.' </div>
                                   
                            </div>
                         </td>



                        <td class="text-muted ">
                            <span style="font-size:0.6rem;"> <i class="fa-solid fa-heart-circle-xmark"></i> '.$fecha_admin_fav.' </span> <br>
                            <span style="font-size:0.6rem;"> <i class="fa-regular fa-circle-xmark"></i> '.$fecha_admin_add.' </span> <br>
                        </td>

                        <td class="text-muted"> 
                            <span style="font-size:0.6rem;"> <i class="fa-solid fa-clipboard-check"></i> '.$fecha.' </span> <br>
                            <span style="font-size:0.6rem;"> <i class="fa-solid fa-arrows-rotate"></i> '.$fechab.' </span> <br>
                            <span style="font-size:0.6rem;"> <i class="fa-solid fa-heart"></i> '.$fecha_fav.' </span> 
                            
                        </td>
                        <td class="text-muted"> 
                            <div class="btn-group" role="group" style=" border:none;">                                               
                            '.$btn_fav_admin .$btn_fig_admin.'
                            </div>
                        </td>
                    </tr>


                    ';	
	
			}else{

				$ico_edo = '<span class="text-muted" > <i class="fa-regular fa-circle-xmark"></i> </span> ';

                
            $coleccion .= '	                        
                <tr>
                    <td class="text-muted">'.$num.'  </td>

                    <td class="text-muted">                             
                        <img class="zoom" style=" height: 35px; max-width:20px;" src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'" alt="'.$nombre_es.'">
                    </td>

                    <td class="text-muted">
                        <div class="row">
                            
								<div class="col-sm-1 " style="height:100%;"  >'.$ico_edo.' </div>

                                <div class="col-sm-3" "> 
                                    <span style="font-size:0.8rem;"> <b>'.substr($nombre_es,0,20).'</b> </span> <br>
                                    <span style="font-size:0.6rem;"> No. Fig: '.$row['id'].' </span>  |
                                        <span style="font-size:0.6rem;"> Id Col.: No Registrado </span> 
                                </div>
                                
                        </div>
                    </td>
                    <td class="text-muted " colspan="3" >
                        <span style="font-size:0.8rem;"> El usuario <b class="" style="color:rgba('.$color_txt.',0.9);" >no ha agregado</b> esta figura </span> 
                    </td>
                </tr>
                ';	
            }
            }
		}else{

            if($user==''){
                $col = '
                <div class="col-md-12 p-2 center " style="margin-left: 10px; margin-top:30px; ">
                <span class="text-muted"> Seleciona un usuario </span><br> 
                <span class="no-show">'.$qb.'</span>
                </div>
                ';
            }else{
                $col= '
                <div class="col-md-12 p-2 center " style="margin-left: 10px; margin-top:30px;  ">
                <span class="text-muted"> Este usuario no ha registrado figuras de esta serie. </span><br> 
                <span class="no-show">'.$qb.'</span>
                </div>
                ';
            }	

		}

 

        $data_user = busca_user($user); 													
        $info = explode('--', $data_user); 
        $error =  $info[0];
        $nombre = $info[1];
        $correo = $info[2];
        $username = $info[3];
        $foto = $info[4];

        $head= '<h5 class="col-md-12 p-2 subtitle_sec" style="border: 1px solid rgba('.$color_main.',0.8); border-radius:5px 5px 0 0; background: rgba('.$color_main.',0.8); color: rgba('.$color_txt.',0.6); ">
        Colección de <b>@'.$username.'</b>
        </h5>
        
        '; 

        $head= '
        <h5 class="col-md-12 p-2 title_sec" style="">
        Colección de <b>@'.$username.'</b> 
        </h5>
        <div class="p-2 subtitle_sec "> <span> Total: '.$total_celeccion.' de '.$tot_minifig.' </span> </div>
		<input type="hidden" id="color_serie_admin" value="'.$color.'" />

        <div style="overflow: auto; overflow-y: auto; overflow-x: hidden; height:350px; padding:3px;" >
        <table id="colectors" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        	<th class="thead_content"> No  </th>
							<th class="thead_content" colspan="2" > Figura </th>
                            <th class="thead_content"> Eventos Admin </th>
							<th class="thead_content"> Eventos User </th>
                            <th class="thead_content"> Opciones </th>
                        </tr>
                      </thead>

                        <tbody>
                        '.$coleccion.'
                        </tbody>
            </table>
            </div> ';

	return $head.$col;
}


////////////////////

function generaListFilterColeccion($actual){

	include("access.php");
	
	
	 
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	
	$q = "SELECT * FROM filter_field_coleccion where estado = 1 order by orden desc ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row = $result->fetch_assoc()){
	                        

	                        	if($row['cve'] == $actual ){
									$opt .= '<option selected value="'.$row['cve'].'">'. $row['titulo'].'</option>';
								}else{
		                         	$opt .= '<option value="'.$row['cve'].'">'.$row['titulo'].'</option>';
		                        }
		                        								
							                     

	                    }
	            }
	
	//$data = $total_serie; 
	return $opt; 
	$dbhb->close();	
	
	
	
}

///////////////////////

////////////////////////////


function list_logos_foto($current){
	
	$carpeta = 'assets/images/logos/';
			
		if (is_dir($carpeta)) { //Comprovamos que sea un carpeta Valido
		if ($dir = opendir($carpeta)) {//Abrimos el carpeta
			$sele .= '<ul>';
				while (($archivo = readdir($dir)) !== false){ //Comenzamos a leer archivo por archivo
					if ($archivo != '.' && $archivo != '..'){ 
						$nuevaRuta = $carpeta.$archivo.'/';
						$sele .=  '<li>'; //Abrimos un elemento de lista 
							if (is_dir($nuevaRuta)) { //Si la ruta que creamos es un carpeta entonces:
								$sele .= '<b>'.$nuevaRuta.'</b>'; //Imprimimos la ruta completa resaltandola en negrita
								//listLogo($nuevaRuta);//Volvemos a llamar a este metodo para que explore ese carpeta.
							} else { //si no es un carpeta:
								$sele .= 'Archivo: '.$archivo; //simplemente imprimimos el nombre del archivo actual
								$datos[]=$archivo; 
							}
						$sele .= '</li>'; //Cerramos el item actual y se inicia la llamada al siguiente archivo
					}
				}//finaliza 
			$sele .= '</ul>';//Se cierra la lista
			closedir($dir);//Se cierra el archivo
		}
	}else{//Finaliza el If de la linea 12, si no es un carpeta valido, muestra el siguiente mensaje
		$sele = 'No Existe la carpeta';
	}			
			
			
///////////////		

//$directorio = 'logos/';	
/*
	$directorio=opendir($carpeta);
		$datos=array();
			while ($archivo = readdir($directorio)) { 
			  if(($archivo != '.') && ($archivo != '..')){
			     $datos[]=$archivo; 
			  } 
			}
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
		closedir($directorio);
	*/
	
	
	//var_dump($datos); 
		 //imprimir datos
		 for($i=0;$i<=count($datos);$i++){
			 
			if($datos[$i] != ''){
				if($datos[$i] != 'noimage.jpg' && $datos[$i] != 'noimage.png'){
					
					//var_dump($datos[$i]);
					
					$data_search = explode('.', $datos[$i]);
					$nombre = $data_search[0];
					$ext = $data_search[1];
					
					
					$nombre_set = get_info_tema_foto($datos[$i]);
					/*
						$info = 
						$row['id'].'|'.
						$row['nombre'].'|'.
						$row['color'].'|'.
						$row['logo'].'|'.
						$row['estado'].'|'.
						$row['color_alt'].'|'.
						$row['fecha_registro'].'|'.
						$row['fecha_actualizado'];
					*/
					
					$data_nombre_set = explode('|', $nombre_set);
					
					$ico= $data_nombre_set[0];
					$nombre_set_b = strtolower($data_nombre_set[1]);
					$f_rec = $data_nombre_set[6];
					
							
							$renglon .= '
							
							<tr>
								
								
								<td class="text-muted" style="font-size:0.7em;"> 
									<span '.$color.',0.8);padding: 0px 2px;" onclick="display_img(this.title)" data-custom="'.$nombre_set_b.'" id="'.$nombre.'" title="'.$datos[$i].'" > <i class="fa fa-image"></i> '.$datos[$i].'</span>   
								</td>
								
								<td class="text-muted" style="font-size:0.7em;"> '.formatFechaHora($f_rec).'</td>								
								<td class="text-muted" style="font-size:0.7em;"> 
									<button class="btn btn-outline-primary btn_thin" style="padding:2px 5px;" type="button"  onclick="display_logo(this.value)"  value="'.$datos[$i].'" ><i class=" fa fa-eye"></i> 	 </button> 
										</td>
							</tr>
							
							';
				}
				
			}
			
		  } // for 

                  
	
	//echo $campo_buscar; 
	
			  
		  
		  $opt = '

	  	<table  class="sortable table table-striped" id="logo_fotos" style="padding:2px; " >
	  	<thead >
	  		<tr>
	  		<th class="thead_content"> Imagen</th>
	  		<th class="thead_content">Fecha</th>
	  		<th class="thead_content"> Ver</th>
	  		</tr>
	  	</thead>
	  		<tbody>
	  		'.$renglon.'
	  		</tbody>
	  	</table>
	  

		  ';
		  
		  $sel = $opt; 
		  
	return  $sel; 
} 

//////////

function getListSecciones(){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM seccion where estado = 1; ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                      //  $code = getLetraByPosition($row['id']);
	                        
	                        if($row['id']== $actual){
		                         $opt .= '<option selected value="'.$row['clave'].'">'.$row['titulo'].'</option>';
	                        }else{
		                        $opt .= '<option value="'.$row['clave'].'">'.$row['titulo'].'</option>';
	                        }
	                        
	                    }
	            }else{
		            $opt .= '<option value="0"> Sin opciones </option>';
	            }
	            
	            $sel = $opt;
	
	//$data = $total_serie; 
	return $sel; 
	$dbhb->close();	
		
}

//////////////////////////////////////////////////////////////////
function get_all_data_minifig($item){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM minifiguras where id = $item ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 $tot_fig = $resultb->num_rows;
	    	 
		    	 	$dato_encontrado = $row['nombre_es'].' / '.$row['nombre_en'].'/'.$row['cve_lego'].'/'.$row['imagen'].'/'.$row['tags'].'/'.$row['estado'].'/'.$row['no_folleto'].'/'.$row['piezas'].'/'.$row['fecha_registro'].'/'.$row['fecha_actualizado'].'/'.$tot_fig;

	    }else{
		    
		    		$dato_encontrado = '0/0/0';
		    
	    }
	
	return $dato_encontrado; 
	$dbh->close();
}


//////////////////////////////////////////////////////////////////
function get_all_extras_minifig($item){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM minifiguras where cve_lego = '$item' ";// preparando la instruccion sql
  

   $result= $dbhb->query($qb);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        $total = $result->num_rows;
	                        
		                         $dato_encontrado .= '
		                         
		                         <div class="no-show">
		                        <input type="hidden" value="1" id="extras-'.$row['id'].'">
			                   	<textarea class="form-control no-show" id="piezas-chk-'.$row['id'].'" rows="2"> </textarea>
				                <input type="hidden" value="'.$row['nombre_es'].'" id="item-'.$row['id'].'">
				                <input type="hidden" value="'.$row['estado'].'" id="estado-'.$row['id'].'">
				                <input type="hidden" value="'.$row['no_folleto'].'" id="numero-'.$row['id'].'">
				                <input type="hidden" value="'.$row['no_folleto'].'" id="index-'.$row['id'].'">
				                <input type="hidden" value="'.$row['id'].'" id="id-'.$row['id'].'">
				                <input type="hidden" value="'.$row['cve_lego'].'-'.$no_folleto.'" id="sku-'.$row['id'].'">
				                <input type="hidden" value="Serie 1-'.$row['cve_lego'].'" id="serie-'.$row['id'].'">
				                <input type="hidden" value="Serie 1" id="serie-nombre-'.$row['id'].'">
				                <input type="hidden" value="'.$row['cve_serie'].'" id="clave-'.$row['id'].'">
				                <input type="hidden" value="'.$row['nombre_es'].'" id="nombre_es-'.$row['id'].'">
				                <input type="hidden" value="'.$row['nombre_en'].'" id="nombre_en-'.$row['id'].'">
				                <input type="hidden" value="minifig/'.$row['cve_lego'].'/'.$row['imagen'].'.png" id="url-'.$row['id'].'">
				                <input type="hidden" value="'.$row['piezas'].'" id="faltantes-'.$row['id'].'">
				                <input type="hidden" value="'.$row['fecha_registro'].'" id="fecha-'.$row['id'].'">
				                <input type="hidden" value="'.$row['no_folleto'].'" id="folleto-'.$row['id'].'">
				                <input type="hidden" value="'.$row['tags'].'" id="tags-'.$row['id'].'">
								<input type="hidden" value="'.$row['piezas'].'" id="pieces-'.$row['id'].'">
								<input type="hidden" value="'.$row['estado'].'" id="status-coleccion-'.$row['id'].'">
								<input type="hidden" value="" id="ids-current-'.$row['id'].'">
								<input type="hidden" value="'.$total.'" id="total-fig-'.$row['id'].'">
								<input type="hidden" value="" id="total-general-'.$row['id'].'">
								</div>
					  	                         
		                         ';
	                       
	                        
	                    }
	            }else{
		            $dato_encontrado = '0';
	            }
	
	return $dato_encontrado; 
	$dbh->close();
}

/////

function get_total_reg($tabla){
	
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM ".$tabla." where estado = 1;";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
	
		if ($resultb->num_rows > 0) {
			$row= $resultb->fetch_assoc();
			
			$coleccion = $resultb->num_rows;
			
		}else{
					
			$coleccion = 0;
		}
	
	return $coleccion;	
	//return $qb;
}


//////


function get_lbl_tabla($tabla,$id){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}		
	
		// determina que tipo de serie es	
		$qb = "SELECT * FROM ".$tabla." where id = $id;";// preparando la instruccion sql
		$resultb= $dbh->query($qb);
	
		if ($resultb->num_rows > 0) {
			$row= $resultb->fetch_assoc();
			
			$res =  $row['nombre'];
			
		}else{
					
			$res =  'NULL';
		}
	
	return $res;	
	//return $qb;

}


function get_info_mnu($id){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	//var_dump($pag_code);
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM menus where id = $id ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	  
	    	 
	    	 	$lbl = $row['color'].'|'.$row['mnu_padre'].'|'.$row['title'].'|'.$row['icon'].'|'.$row['nombre'].'|'.$row['link'].'|'.$row['cve'].'|'.$row['estado'].'|'.$row['nivel'].'|'.$row['orden'].'|'.$row['tipo_menu'].'|'.$row['display_title'].'|'.$id;         
	    	 	            
	    
	    }else{
		    
		    $lbl = '200,200,200|0|0|0|0|0|0|0|0|0|0';
		    
	    }
	
	return $lbl; 
	$dbh->close();
}

//////


function get_favoritos_serie($serie,$user){

	include("access.php");
	
	
	  $dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM coleccion where clave_lego = $serie and id_user = $user and favorito = 1;";// preparando la instruccion sql
   
  // echo $qb;

   
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	
	    	$bandera_item = $resultb->num_rows;  
	    
	    }else{
		    
		    $bandera_item = '-';
	    }
	
	return $bandera_item; 
	//return $qb;

	$dbhb->close();

}

//////////////


function genera_barcode_codigo($clave_lego,$formato,$user_id){

	include("access.php");
	include("globals.php");

	//$user_id = $GLOBALS['user'];



	$len_user = strlen($user_id);

				if($len_user==1){
					$nvo_user_id = '0'.$user_id;
				}else{
					$nvo_user_id = $user_id;
				}
	
	
	  $dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}


	$qset = "SELECT * FROM sets where id_user = $user_id and estado = 1 and cve_lego = $clave_lego";
	//var_dump($qset);
	
	$result= $dbhb->query($qset);
    if ($result->num_rows > 0) {
    
	$rowb= $result->fetch_assoc();	  
                       
			$len_id_serie = strlen($rowb['id_tema']);

				if($len_id_serie==1){
					$nvo_serie_id = '00'.$rowb['id_tema'];
				}elseif($len_id_serie==2){
					$nvo_serie_id = '0'.$rowb['id_tema'];
				}else{
					$nvo_serie_id = $rowb['id_tema'];
				}

				$tema_info = getinfotema($rowb['id_tema']);

				$data_tema = explode('|', $tema_info);

				$nombre_tema = $data_tema[0];


			$len_cve = strlen($rowb['cve_lego']);
			//var_dump($len_id_serie);

				if($len_cve==5){
					$nvo_cve = '0'.$rowb['cve_lego'];
				}elseif($len_cve==4){
					$nvo_cve = '00'.$rowb['cve_lego'];
				}elseif($len_cve==3){
					$nvo_cve = '000'.$rowb['cve_lego'];
				}else{
					$nvo_cve= $rowb['cve_lego'];
				}



				if($formato==0){
					$codigo = $nvo_cve.''.$nvo_serie_id.''.$nvo_user_id;
				}elseif($formato==1){
					$codigo = '*'.$nvo_cve.''.$nvo_serie_id.''.$nvo_user_id.'*';
				}else{
					$codigo = '*'.$nvo_cve.''.$nvo_serie_id.''.$nvo_user_id.'*';
				}

				

	

	}else{
		$codigo = 'error: '.$qset;
	}
return $codigo;
}
///////

function genera_barcode_codigo_minifig($clave_minifig,$formato,$user_id){


	include("globals.php");

	//$user_id = $GLOBALS['user'];

	$data_code = explode('-',$clave_minifig); 
	$clave_lego = $data_code[0];
	$no_folleto = $data_code[1];

	$len_user = strlen($user_id);

				if($len_user==1){
					$nvo_user_id = '0'.$user_id;
				}else{
					$nvo_user_id = $user_id;
				}
	
	$len_id_serie = strlen($no_folleto);

				if($len_id_serie==1){
					$nvo_folleto = '0'.$no_folleto;
				}elseif($len_id_serie==2){
					$nvo_folleto = $no_folleto;
				}

	$len_cve = strlen($clave_lego);
				//var_dump($len_id_serie);
	
					if($len_cve==5){
						$nvo_cve = '0'.$clave_lego;
					}elseif($len_cve==4){
						$nvo_cve = '00'.$clave_lego;
					}elseif($len_cve==3){
						$nvo_cve = '000'.$clave_lego;
					}else{
						$nvo_cve= $clave_lego;
					}
	
	
	
					if($formato==0){
						$codigo = $nvo_cve.''.$nvo_folleto.''.$nvo_user_id;
					}elseif($formato==1){
						$codigo = '*'.$nvo_cve.''.$nvo_folleto.''.$nvo_user_id.'*';
					}else{
						$codigo = '*'.$nvo_cve.''.$nvo_folleto.''.$nvo_user_id.'*';
					}


return $codigo;
}

///////////////

function genera_barcode_label_clavelego($clave_lego,$formato,$user_id){

	include("globals.php");

	include("access.php");
	

	//$user_id = $GLOBALS['user'];
	//var_dump($u);

	$len_user = strlen($user_id);

				if($len_user==1){
					$nvo_user_id = '0'.$user_id;
				}else{
					$nvo_user_id = $user_id;
				}
	
	
	  $dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}


	$qset = "SELECT * FROM sets where id_user = $user_id and estado = 1 and cve_lego = $clave_lego";
	//var_dump($qset);
	
	$result= $dbhb->query($qset);
    if ($result->num_rows > 0) {
    
	$rowb= $result->fetch_assoc();	  
                       
			$len_id_serie = strlen($rowb['id_tema']);

				if($len_id_serie==1){
					$nvo_serie_id = '00'.$rowb['id_tema'];
				}elseif($len_id_serie==2){
					$nvo_serie_id = '0'.$rowb['id_tema'];
				}else{
					$nvo_serie_id = $rowb['id_tema'];
				}

				$tema_info = getinfotema($rowb['id_tema']);

				$data_tema = explode('|', $tema_info);

				$nombre_tema = $data_tema[0];


			$len_cve = strlen($rowb['cve_lego']);
			//var_dump($len_id_serie);

				if($len_cve==5){
					$nvo_cve = '0'.$rowb['cve_lego'];
				}elseif($len_cve==4){
					$nvo_cve = '00'.$rowb['cve_lego'];
				}elseif($len_cve==3){
					$nvo_cve = '000'.$rowb['cve_lego'];
				}else{
					$nvo_cve= $rowb['cve_lego'];
				}

				$codigo = '*'.$nvo_cve.''.$nvo_serie_id.''.$nvo_user_id.'*';

				//$barcode = $codigo;


				$grupo_info = getinfogrupo($rowb['grupo']);
				$data_grupo = explode('|', $grupo_info);

				$nombre_grupo = $data_grupo[0];
                
				$hoy = formatFechaHora(date("Y-m-d H:i:s"));
                //$hoy = formatSoloFecha(date("Y-m-d"));

                $url_print=$GLOBALS['path_site'].'modal_barcode.php?'.'cve='.$user_id.'&codebar='.$rowb['cve_lego'];

				$width = '250px'; 
				$fecha_imp = ''.$hoy.' '; 
                $flbl = '- F'.$formato;

				$info_edo_set= get_info_estado_setcol($rowb['set_edo']); 
				$data_setedo= explode('|',$info_edo_set);
				
				if($rowb['set_edo']==0){
					$ico_edoset = '<i class="fa-solid fa-circle"></i>';
				}else{
					$ico_edoset = '<i class="fa-regular fa-circle"></i>';
				}
				//$nombre_setedo = ' - '.strtoupper($data_setedo[1]).$rowb['set_edo'];	
				$nombre_setedo = $rowb['set_edo'];

		switch($formato){

		//corta 
		case 1: 

$codigob = genera_barcode_codigo($rowb['cve_lego'],0,$rowb['id_user']);
$data_cad = $rowb['cve_lego'].'|'.$rowb['nombre'].'|'.$nombre_tema.'|'.$nombre_grupo.'|'.$codigob.'|'.$url_print;   

                 $tam_nom = strlen($rowb['nombre']);
                $caract = 27;
                if($tam_nom > $caract ){
                    $ext = '...';
                    $name = substr(strtoupper($rowb['nombre']),0,$caract).$ext;
                }else{
                    $ext = ''; 
                    $name=strtoupper($rowb['nombre']);
                }

$barcode = '
    <div style="width:'.$width.';" class="center" id="lbl_'.$rowb['cve_lego'].'" >
        
        <div class="barcode_holder" style="border:0px solid #ccc; margin-bottom:-8px;">
            <span style="font-size: 0.6rem; ">'.strtoupper($GLOBALS['sitio_web']).'</span> 
            <span style="font-size: 0.6rem; " id="nombre_set_barcode" > | '.substr(strtoupper($nombre_tema),0,20).'</span> 
            <br><br>
                                                                    
            <span style=" " class="barcode_set" id="barcode_set"> 
                '.$codigo.'
            </span> 
            <br>
            
            <span style="font-size: 0.8rem; inline-height:9px;" id="n_set_barcode" >'.$name.'
                <span id="total_'.$codigob.'"></span> 
            </span>
            
        </div>
        <span class="col-md-12" style="font-size:0.7rem; text-align:left; line-height: 0.5rem; padding: 0px 0px 1px 0px; ">'.$fecha_imp.' '.$flbl.''.$nombre_setedo .'</span>
    </div>					                    
	
	<input type="hidden" value="'.$data_cad.'" id="param_'.$codigob.'">
    <input type="hidden" value="'.$data_cad.'" id="paramcve_'.$rowb['cve_lego'].'">
	<input type="hidden" value="'.$codigob.'" id="code_'.$rowb['cve_lego'].'">
    <input type="hidden" value="'.$data_cad.'" id="codebox_'.$rowb['codebar_box'].'">	
';

		break; 

case 2: // 2lineas

		
		$codigob = genera_barcode_codigo($rowb['cve_lego'],0,$rowb['id_user']);
        $data_cad = $rowb['cve_lego'].'|'.$rowb['nombre'].'|'.$nombre_tema.'|'.$nombre_grupo.'|'.$codigob.'|'.$url_print;
                
                $tam_nom = strlen($rowb['nombre']);
                $caract = 27;
                if($tam_nom > $caract ){
                    $ext = '...';
                    $name = substr(strtoupper($rowb['nombre']),0,$caract).$ext;
                }else{
                    $ext = ''; 
                    $name=strtoupper($rowb['nombre']);
                }

	$barcode = '
<div style="width:'.$width.'; margin-top:10px;" class="center" id="lbl_'.$rowb['cve_lego'].'">
	<div class="barcode_holder" style="border:0px solid #ccc; margin-bottom:-8px;"> 
		<span style="font-size: 0.6rem; display:block;"> '.strtoupper($GLOBALS['sitio_web']).'</span> 
        <span style="font-size: 0.6rem; display:block;" id="nombre_set_barcode" >  
          		<b> '.substr(strtoupper($nombre_tema),0,15).' </b>
       		</span> 
		<span style="font-size: 0.9em; line-height:4em; display:block;" class="barcode_set_sm" id="barcode_set">
	          '.$codigo.'
	    </span> 

		<span style="font-size: 0.8em; line-height:0.2em; margin-top:-10px;" id="nombre_set_barcode" > 
			'.$name.' <span id="total_'.$codigob.'"></span> 
		</span>
	</div>
    <span class="col-md-12" style="margin-top:-15px;font-size:0.7rem; text-align:left; line-height: 0.5rem; padding: 0px 0px 1px 0px; ">'.$fecha_imp.' '.$flbl.''.$nombre_setedo .' </span>
</div>

	<input type="hidden" value="'.$data_cad.'" id="param_'.$codigob.'">
    <input type="hidden" value="'.$data_cad.'" id="paramcve_'.$rowb['cve_lego'].'">
	<input type="hidden" value="'.$codigob.'" id="code_'.$rowb['cve_lego'].'">
    <input type="hidden" value="'.$data_cad.'" id="codebox_'.$rowb['codebar_box'].'">

	'; 

		break;
		

		case 3: // logo

		
		$codigob = genera_barcode_codigo($rowb['cve_lego'],0,$rowb['id_user']);
        $data_cad = $rowb['cve_lego'].'|'.$rowb['nombre'].'|'.$nombre_tema.'|'.$nombre_grupo.'|'.$codigob.'|'.$url_print;
		$logo_lbl = $GLOBALS['logo_lbl'];

                 $tam_nom = strlen($rowb['nombre']);
                $caract = 27;
                if($tam_nom > $caract ){
                    $ext = '...';
                    $name = substr(strtoupper($rowb['nombre']),0,$caract).$ext;
                }else{
                    $ext = ''; 
                    $name=strtoupper($rowb['nombre']);
                }

$barcode = '
<div style="width:'.$width.';" class="center" id="lbl_'.$rowb['cve_lego'].'" >
	<div class="barcode_holder" style="border:0px solid #ccc; margin-bottom:-20px;">
		
        <img src="'.$logo_lbl.'" class="logo_lbl" style="height:30px;">

		<span style="font-size: 0.6rem; display:block; margin-top:2px;">'.strtoupper($GLOBALS['sitio_web']).' | <b>'.substr(strtoupper($nombre_tema),0,15).'</b> 
															
		<span style="display:block; line-height:1rem; margin-top:20px; " class="barcode_set" id="barcode_set"> 
			 '.$codigo.'
		</span>

		<span style="font-size:0.8rem; display:block; margin-top:25px;" id="n_set_barcode" >
			'.$name.' <span id="total_'.$codigob.'"></span> 
		</span>
			
	</div>

    <span style="font-size:0.7rem; display:block; margin-top:15px;">'.$fecha_imp.' '.$flbl.''.$nombre_setedo .'</span>
</div>				                    

	<input type="hidden" value="'.$data_cad.'" id="param_'.$codigob.'">
    <input type="hidden" value="'.$data_cad.'" id="paramcve_'.$rowb['cve_lego'].'">
	<input type="hidden" value="'.$codigob.'" id="code_'.$rowb['cve_lego'].'">
    <input type="hidden" value="'.$data_cad.'" id="codebox_'.$rowb['codebar_box'].'">
';


		break;

case 4: // QR

$codigo = genera_barcode_codigo($rowb['cve_lego'],0,$rowb['id_user']);

// valida que el archivo exista 

$nombre_fichero = 'assets/images/qr_sets/'.$codigo.'.webp';

if (file_exists($nombre_fichero)) {

    $codigo_qr = '<img src="data:image/webp;base64,'.base64_encode(file_get_contents($nombre_fichero)).'" class="qr_img" name="current" />'; 

} else {

    $nombre_fichero_png = 'assets/images/qr_sets/'.$codigo.'.png';
    
    if (file_exists($nombre_fichero_png)) {
            $qr_webp = convert_to_webp($codigo);
    }else{
        $qr_png= genera_qrcode_set($codigo);
        $qr_webp = convert_to_webp($codigo);
    }
    
//src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'"

    $codigo_qr = '<img src="data:image/webp;base64,'.base64_encode(file_get_contents($qr_webp)).'" name="nuevo" class="qr_img"  />'; 
}



$codigob = genera_barcode_codigo($rowb['cve_lego'],0,$rowb['id_user']);
$data_cad = $rowb['cve_lego'].'|'.$rowb['nombre'].'|'.$nombre_tema.'|'.$nombre_grupo.'|'.$codigo.'|'.$url_print;
                 
                 $tam_nom = strlen($rowb['nombre']);
                $caract = 15;
                if($tam_nom > $caract ){
                    $ext = '...';
                    $name = substr(strtoupper($rowb['nombre']),0,$caract).$ext;
                }else{
                    $ext = ''; 
                    $name=strtoupper($rowb['nombre']);
                }

$barcode= '
<div style="width:'.$width.'; margin-top:20px;" class="col-md-12 center" id="lbl_'.$rowb['cve_lego'].'" >
	<div class="row barcode_holder" style="border:0px solid #ccc; " >
															
		<span class="" style="display:flex; position:relative; float:left;"> 
			'.$codigo_qr.' 
		</span>

		<div style="display: flex; float:left; width:58%; position:relative; margin-top:5px; text-align:left;">
			<span style="font-size: 11px; ">'.strtoupper($GLOBALS['sitio_web']).' <br>
			<span style="font-size: 11px; " > '.substr(strtoupper($nombre_tema),0,15).' <br>
			<span style="font-size: 11px; " > '.$codigo.'  -  '. $rowb['cve_lego'].' <br>
			<span style="font-size: 0.8rem; clear:both; display:block; "  >'.$name.'
				<span id="total_'.$codigob.'"></span>
			</span>
		</div>
	</div>

    <div class="col-md-12" style="padding:0px; margin-bottom:5px;">
        <span style="font-size:0.7rem; text-align:left; line-height: 0.5rem; padding: 0px 0px 1px 0px; display:block; ">'.$fecha_imp.' '.$flbl.''.$nombre_setedo .'</span>
    </div>
</div>	

	<input type="hidden" value="'.$data_cad.'" id="param_'.$codigob.'">
    <input type="hidden" value="'.$data_cad.'" id="paramcve_'.$rowb['cve_lego'].'">
	<input type="hidden" value="'.$codigob.'" id="code_'.$rowb['cve_lego'].'">
    <input type="hidden" value="'.$data_cad.'" id="codebox_'.$rowb['codebar_box'].'">

'; 

		break;

case 5: // Delgada



$codigob = genera_barcode_codigo($rowb['cve_lego'],0,$rowb['id_user']);
$data_cad = $rowb['cve_lego'].'|'.$rowb['nombre'].'|'.$nombre_tema.'|'.$nombre_grupo.'|'.$codigob.'|'.$url_print;

                 $tam_nom = strlen($rowb['nombre']);
                $caract = 27;
                if($tam_nom > $caract ){
                    $ext = '...';
                    $name = substr(strtoupper($rowb['nombre']),0,$caract).$ext;
                }else{
                    $ext = ''; 
                    $name=strtoupper($rowb['nombre']);
                }

$barcode= '
<div style="width:'.$width.';padding:0px; margin-top:30px;" class="col-md-12 center" id="lbl_'.$rowb['cve_lego'].'" >
	
    <div class="barcode_holder" style="border:0px solid #ccc; margin-bottom:-10px;">
		
        <span style="font-size:0.6rem; line-height:0.6rem;  display:block;margin-top:10px;">'.strtoupper($GLOBALS['sitio_web']).'</span>
        <span style="font-size: 0.8rem; line-height: 0.6rem;  margin-top:5px; display:block;" id="n_set_barcode" > '.$name.' <span id="total_'.$codigob.'"></span></span>																	
		
        <span style="display:block; margin-bottom:-29px; " class="barcode_set_thin_b" id="barcode_set_thin"> 
			 '.$codigo.'
		</span> 
        
        
	</div>

    <div class="col-md-12" style="padding:0px 0px; margin-bottom:5px;">
        <span style="font-size:0.7rem; text-align:left; line-height: 0.6rem; padding: 0px 0px 1px 0px;">'.$fecha_imp.' '.$flbl.''.$nombre_setedo .'</span>
    </div>
</div>			                    

	<input type="hidden" value="'.$data_cad.'" id="param_'.$codigob.'">
    <input type="hidden" value="'.$data_cad.'" id="paramcve_'.$rowb['cve_lego'].'">
	<input type="hidden" value="'.$codigob.'" id="code_'.$rowb['cve_lego'].'">
    <input type="hidden" value="'.$data_cad.'" id="codebox_'.$rowb['codebar_box'].'">
';
break;

case 6: // publico - set

	//$codigo = genera_barcode_codigo($rowb['cve_lego'],1,$rowb['id_user']);
	$codigob = genera_barcode_codigo($rowb['cve_lego'],0,$rowb['id_user']);
	// valida que el archivo exista 
	
	$nombre_fichero = 'assets/images/qr_sets/public_url/public_'.$codigob.'.webp';
	
	if (file_exists($nombre_fichero)) {
	
		$codigo_qr = '<img id="qr_public_'.$rowb['cve_lego'].'" style="height:90px;" src="data:image/webp;base64,'.base64_encode(file_get_contents($nombre_fichero)).'" class="qr_img_lg" name="current" />'; 
	
	} else {
	
		$nombre_fichero_png = 'assets/images/qr_sets/public_url/public_'.$codigob.'.png';
		
		if (file_exists($nombre_fichero_png)) {
				$qr_webp = convert_to_webp_url_gral($nombre_fichero_png);
		}else{

			$url_ext = $path_site.'public.php?mnu=7ebec37c9512e433ed508847c24ba1b1&item='.$codigob;

			$qr_png= genera_qrcode_public_set($url_ext,$codigob);
			$qr_webp = convert_to_webp_url_gral($qr_png);
		}
		
	//src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'"
	
		$codigo_qr = '<img style="height:90px;" id="qr_public_'.$rowb['cve_lego'].'" src="data:image/webp;base64,'.base64_encode(file_get_contents($qr_webp)).'" name="nuevo" class="qr_img_lg"  />'; 
	}
	
	
	$data_cad = $rowb['cve_lego'].'|'.$rowb['nombre'].'|'.$nombre_tema.'|'.$nombre_grupo.'|'.$codigob.'|'.$url_print;

                 $tam_nom = strlen($rowb['nombre']);
                $caract = 15;
                if($tam_nom > $caract ){
                    $ext = '...';
                    $name = substr(strtoupper($rowb['nombre']),0,$caract).$ext;
                }else{
                    $ext = ''; 
                    $name=strtoupper($rowb['nombre']);
                }

	$barcode= '
	<div style="width:'.$width.'; mergin-left:-20px; margin-top:3px;" class="col-md-12" id="lbl_'.$rowb['cve_lego'].'" >
		<div class="row barcode_holder" style="border:0px solid #ccc; " >
																
			<span class="" style="display:flex;  position:relative; float:left;"> 
				'.$codigo_qr.' 
			</span>
	
			<div style="display: flex; float:left; width:58%; position:relative; margin-top:8px; text-align:left;">
				<span style="font-size: 0.65rem; ">
                '.strtoupper($GLOBALS['sitio_web']).' <br>
				'.strtoupper($nombre_tema).' <br>
				'.$rowb['cve_lego'].' - '.$codigob.' <br>
				'.$name.' <span id="total_'.$codigob.'"></span>
                </span>
				
			</div>
			
		</div>

        	<div class="" style="padding:0px 2px; margin-bottom:6px; margin-top:-10px;">
				<span style="font-size:0.4rem; text-align:left; float:left; margin:2px 0px; "> &nbsp; </span><br>
				<span class="barcode_set_thin_b" style="line-height: 0.75rem; font-size: 2.1rem; float:left; margin:-2px 0px;"> '.$codigo.'</span><br>
                <span style="font-size:0.7rem; text-align:left; float: left; padding: 0px 0px 1px 0px; margin-top:-15px;">'.$fecha_imp.' '.$flbl.''.$nombre_setedo .'</span>
			</div>

	</div>	
	
		<input type="hidden" value="'.$data_cad.'" id="param_'.$codigob.'">
        <input type="hidden" value="'.$data_cad.'" id="paramcve_'.$rowb['cve_lego'].'">
		<input type="hidden" value="'.$codigob.'" id="code_'.$rowb['cve_lego'].'">
        <input type="hidden" value="'.$data_cad.'" id="codebox_'.$rowb['codebar_box'].'">
	
	'; 

break;

case 7: // QR - publico

    $codigo = genera_barcode_codigo($rowb['cve_lego'],0,$rowb['id_user']);
    
    // valida que el archivo exista 
    
    //$nombre_fichero = 'assets/images/qr_sets/'.$codigo.'.webp';
    $nombre_fichero = 'assets/images/qr_sets/public_url/public_'.$codigo.'.webp';
    
    if (file_exists($nombre_fichero)) {
    
        $codigo_qr = '<img style="height:90px;" class="qr_img_gral" src="data:image/webp;base64,'.base64_encode(file_get_contents($nombre_fichero)).'" name="current" />'; 
    
    } else {
    
       // $nombre_fichero_png = 'assets/images/qr_sets/'.$codigo.'.png';
        $nombre_fichero_png  = 'assets/images/qr_sets/public_url/public_'.$codigo.'.png';
        
        if (file_exists($nombre_fichero_png)) {
                $qr_webp = convert_to_webp($codigo);
        }else{
            $qr_png= genera_qrcode_set($codigo);
            $qr_webp = convert_to_webp($codigo);
        }
        
    //src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'"
    
        $codigo_qr = '<img style="height:90px;" class="qr_img_gral" src="data:image/webp;base64,'.base64_encode(file_get_contents($qr_webp)).'" name="nuevo"   />'; 
    }
    
    
    
    $codigob = genera_barcode_codigo($rowb['cve_lego'],0,$rowb['id_user']);
    $data_cad = $rowb['cve_lego'].'|'.$rowb['nombre'].'|'.$nombre_tema.'|'.$nombre_grupo.'|'.$codigo.'|'.$url_print;
    
                 $tam_nom = strlen($rowb['nombre']);
                $caract = 39;
                if($tam_nom > $caract ){
                    $ext = '...';
                    $name = substr(strtoupper($rowb['nombre']),0,$caract).$ext;
                }else{
                    $ext = ''; 
                    $name=strtoupper($rowb['nombre']);
                }

    $barcode= '
    <div style="width: '.$width.'; margin-top:15px;" class="col-md-12 center" id="lbl_'.$rowb['cve_lego'].'" >
        <div class="row barcode_holder" style="border:0px solid #ccc; " >
                                                                
            <span class="" style="display:flex; position:relative; float:left;"> 
                '.$codigo_qr.' 
            </span>
    
            <div style="display: flex; float:left; width:58%; position:relative; margin-top:6px; text-align:left;">
                <span style="font-size: 1rem; float:left; display:block; width:100%; " ><b>'. $rowb['cve_lego'].'</b>
                <span style="font-size: 0.8rem; clear:both; display:block; width:100%; "  >'.$name.'
                    <span id="total_'.$codigob.'"></span>
                </span>
            </div>
        </div>
    
        <div class="col-md-12" style="padding:0px; margin-bottom:5px;">
            <span style="font-size:0.7rem; text-align:left; line-height: 0.5rem; padding: 0px 0px 1px 0px; display:block; ">'.$fecha_imp.$flbl.''.$nombre_setedo .' </span>
        </div>
    </div>	
    
        <input type="hidden" value="'.$data_cad.'" id="param_'.$codigob.'">
        <input type="hidden" value="'.$data_cad.'" id="paramcve_'.$rowb['cve_lego'].'">
        <input type="hidden" value="'.$codigob.'" id="code_'.$rowb['cve_lego'].'">
        <input type="hidden" value="'.$data_cad.'" id="codebox_'.$rowb['codebar_box'].'">
    
    '; 
    
            break;

case 8: // publico set reduced

                //$codigo = genera_barcode_codigo($rowb['cve_lego'],1,$rowb['id_user']);
                $codigob = genera_barcode_codigo($rowb['cve_lego'],0,$rowb['id_user']);
                // valida que el archivo exista 
                
                $nombre_fichero = 'assets/images/qr_sets/public_url/public_'.$codigob.'.webp';
                
                if (file_exists($nombre_fichero)) {
                
                    $codigo_qr = '<img style="height:90px; z-index:98;" class="qr_img_gral" id="qr_public_'.$rowb['cve_lego'].'" src="data:image/webp;base64,'.base64_encode(file_get_contents($nombre_fichero)).'" name="current" />'; 
                
                } else {
                
                    $nombre_fichero_png = 'assets/images/qr_sets/public_url/public_'.$codigob.'.png';
                    
                    if (file_exists($nombre_fichero_png)) {
                            $qr_webp = convert_to_webp_url_gral($nombre_fichero_png);
                    }else{
            
                        $url_ext = $path_site.'public.php?mnu=7ebec37c9512e433ed508847c24ba1b1&item='.$codigob;
            
                        $qr_png= genera_qrcode_public_set($url_ext,$codigob);
                        $qr_webp = convert_to_webp_url_gral($qr_png);
                    }
                    
                //src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'"
                
                    $codigo_qr = '<img style="height:90px; z-index:98;" class="qr_img_gral" src="data:image/webp;base64,'.base64_encode(file_get_contents($qr_webp)).'" name="nuevo" />'; 
                }
                
                
                $data_cad = $rowb['cve_lego'].'|'.$rowb['nombre'].'|'.$nombre_tema.'|'.$nombre_grupo.'|'.$codigob.'|'.$url_print;
                $tam_nom = strlen($rowb['nombre']);

                $caract = 27;
                if($tam_nom > $caract ){
                    $ext = '...';
                    $name = substr(strtoupper($rowb['nombre']),0,$caract).$ext;
                }else{
                    $ext = ''; 
                    $name=strtoupper($rowb['nombre']);
                }

            
                $barcode= '
                <div  class="col-md-12" id="lbl_'.$rowb['cve_lego'].'" >
                    <div class="row barcode_holder" style="border:0px solid #ccc; " >
                                                                            
                        <span class="" style="display:flex; position:relative; float:left; z-index:98;"> 
                            '.$codigo_qr.' 
                        </span>
                
                        <div style="display: flex; float:left; width:58%; position:relative; margin-top:8px; text-align:left;">
                            <span style="font-size: 1rem; float:left; display:block; width:100%;  "> <b>'. $rowb['cve_lego'].' </b>
							<span style="font-size: 0.7rem; float:left; display:block; width:100%; text-decoration:  ">'.$codigob.'
                            <span style="font-size: 0.7rem; float:left; display:block; width:100%;  ">'.$name.'
                        </div>
                        
                    </div>
            
                <div class="" style="padding:0px 2px; margin-bottom:8px; margin-top:8px; margin-left:0px; z-index:999;">
                    <span class="barcode_set_thin_b" style="line-height: 0.9rem; font-size: 2.1rem; float:left; margin:2px 0px;"> '.$codigo.'</span><br>
                    <span style="font-size:0.7rem; text-align:left; float: left; padding: 0px 0px 1px 0px; margin-top:-8px;">'.$fecha_imp.''.$flbl.''.$nombre_setedo .'</span>
                </div>

            
                </div>	
                
                    <input type="hidden" value="'.$data_cad.'" id="param_'.$codigob.'">
                    <input type="hidden" value="'.$data_cad.'" id="paramcve_'.$rowb['cve_lego'].'">
                    <input type="hidden" value="'.$codigob.'" id="code_'.$rowb['cve_lego'].'">
                     <input type="hidden" value="'.$data_cad.'" id="codebox_'.$rowb['codebar_box'].'">
                
                '; 
            
break;

case 9: // publico set reduced

    //$codigo = genera_barcode_codigo($rowb['cve_lego'],1,$rowb['id_user']);
    $codigob = genera_barcode_codigo($rowb['cve_lego'],0,$rowb['id_user']);
    // valida que el archivo exista 
    
    $nombre_fichero = 'assets/images/qr_sets/public_url/public_'.$codigob.'.webp';
    
    if (file_exists($nombre_fichero)) {
    
        $codigo_qr = '<img style="height:90px;" class="qr_img_gral" id="qr_public_'.$rowb['cve_lego'].'" src="data:image/webp;base64,'.base64_encode(file_get_contents($nombre_fichero)).'" name="current" />'; 
    
    } else {
    
        $nombre_fichero_png = 'assets/images/qr_sets/public_url/public_'.$codigob.'.png';
        
        if (file_exists($nombre_fichero_png)) {
                $qr_webp = convert_to_webp_url_gral($nombre_fichero_png);
        }else{

            $url_ext = $path_site.'public.php?mnu=7ebec37c9512e433ed508847c24ba1b1&item='.$codigob;

            $qr_png= genera_qrcode_public_set($url_ext,$codigob);
            $qr_webp = convert_to_webp_url_gral($qr_png);
        }
        
    //src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'"
    
        $codigo_qr = '<img style="height:90px;" class="qr_img_gral" src="data:image/webp;base64,'.base64_encode(file_get_contents($qr_webp)).'" name="nuevo" />'; 
    }

    $tam_nom = strlen($rowb['nombre']);
    $caract = 29;
    if($tam_nom > $caract ){
        $ext = '...';
        $name = substr(strtoupper($rowb['nombre']),0,$caract).$ext;
    }else{
        $ext = ''; 
        $name=strtoupper($rowb['nombre']);
    }
    
    $data_cad = $rowb['cve_lego'].'|'.$rowb['nombre'].'|'.$nombre_tema.'|'.$nombre_grupo.'|'.$codigob.'|'.$url_print.'|'.$rowb['codebar_box'];

    $barcode= '
    <div  class="col-md-12" id="lbl_'.$rowb['cve_lego'].'" >
        <div class="row barcode_holder" style="border:0px solid #ccc; " >
                                                                
            <span class="" style="display:flex; position:relative; float:left;"> 
                '.$codigo_qr.' 
            </span>
    
            <div style="display: flex; float:left; width:58%; position:relative; margin-top:8px; text-align:left;">
                <span style="font-size: 1.0rem; float:left; display:block; width:100%;"> <b>'. $rowb['cve_lego'].' </b> 
                <span style="font-size: 0.6rem; float:left; display:block; width:100%;">'. substr(strtoupper($nombre_tema),0,20).'                     
                <span style="font-size: 0.7rem; float:left; display:block; width:100%;">'.$name.'</span>
            </div>
            
        </div>

        <div class="" style="padding:0px 2px; margin-bottom:8px; margin-top:8px; margin-left:0px;">
            <span class="barcode_set_thin_b" style="line-height: 0.9rem; font-size: 2.1rem; float:left; margin:2px 0px;"> '.$codigo.'</span><br>
            <span style="font-size:0.7rem; text-align:left; float: left; padding: 0px 0px 1px 0px; margin-top:-8px;">'.$fecha_imp.''.$flbl.''.$nombre_setedo .'</span>
        </div>


    </div>	
    
        <input type="hidden" value="'.$data_cad.'" id="param_'.$codigob.'">
        <input type="hidden" value="'.$data_cad.'" id="paramcve_'.$rowb['cve_lego'].'">
        <input type="hidden" value="'.$codigob.'" id="code_'.$rowb['cve_lego'].'">
        <input type="hidden" value="'.$data_cad.'" id="codebox_'.$rowb['codebar_box'].'">
    
    '; 

break;

		default: //larga

$data_cad = $rowb['cve_lego'].'|'.$rowb['nombre'].'|'.$nombre_tema.'|'.$nombre_grupo.'|'.$codigo.'|'.$url_print;
$codigob = genera_barcode_codigo($rowb['cve_lego'],0,$rowb['id_user']);

$barcode = 'No Definido';

		break;

		}

return $barcode;

	}
}
///////////////////////////////////////////////////////////////////////

function genera_barcode_label_grupo($id_grupo,$user_id){

	include("globals.php");
	include("access.php");
	
    
	
	  $dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}


	$qset = "SELECT * FROM grupos_inventario where id = $id_grupo and id_user = $user_id";
	//var_dump($qset);
	
	$result= $dbhb->query($qset);
    if ($result->num_rows > 0) {
    
	$rowb= $result->fetch_assoc();	  
                       

                $info_user =  busca_user($user_id);
				$data_user = explode('--', $info_user);
                $username = $data_user[3];
                //$barcode = $codigo;


				$grupo_info = getinfogrupo($id_grupo);
				$data_grupo = explode('|', $grupo_info);

				$nombre_grupo = $data_grupo[0];
                
                $hoy = formatFechaHora(date("Y-m-d H:i:s"));

               // $url_print=$GLOBALS['path_site'].'modal_barcode.php?'.'codebar='.$id_grupo.'&cve='.$user_id;

				$width = '250px'; 
				$fecha_imp = ''.$hoy ; 

                $formato = 1;
		
        switch($formato){

        case 1: // 

                    $nombre_fichero = 'assets/images/qr_grupo/gpo_'.$id_grupo.'.webp';
                
                if (file_exists($nombre_fichero)) {
                
                    $codigo_qr = '<img style="height:90px;" class="qr_gpo_gral" id="qr_gpo_'.$rowb['id_user'].'" src="data:image/webp;base64,'.base64_encode(file_get_contents($nombre_fichero)).'" name="current" />'; 
                
                } else {
                
                    $nombre_fichero_png = 'assets/images/qr_grupo/gpo_'.$id_grupo.'.png';
                    
                    if (file_exists($nombre_fichero_png)) {
                            $qr_webp = convert_to_webp_url_gral($nombre_fichero_png);
                    }else{
            
                        // https://bricksidemx.com/collector/?mnu=61a892b8d073f99d98af5de82be351e7&cve=2&gpo=6
                        $url_ext = $path_site.'?mnu=61a892b8d073f99d98af5de82be351e7&cve='.$user_id.'&gpo='.$id_grupo;
            
                        $qr_png= genera_qrcode_public_set($url_ext,$id_grupo);
                        $qr_webp = convert_to_webp_url_gral($qr_png);
                    }
                    
                //src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'"
                
                    $codigo_qr = '<img style="height:90px;" class="qr_gpo_gral" src="data:image/webp;base64,'.base64_encode(file_get_contents($qr_webp)).'" name="nuevo" />'; 
                }
                
            
                $barcode= '
                <div  class="col-md-12" id="lbl_" style="margin-top:20px;" >
                    <div class="row barcode_holder" style="border:0px solid #ccc; " >
                                                                            
                        <span class="" style="display:flex; position:relative; float:left;"> 
                            '.$codigo_qr.' 
                        </span>
                
                        <div style="display: flex; float:left; width:58%; position:relative; margin-top:2px; text-align:left;">
                            <span style="font-size: 1.5rem; float:left; display:block; width:100%; clear:both;  "> <b>'.strtoupper($nombre_grupo).' 
							</b> 
                            <span style="font-size: 0.9rem; float:left; display:block; width:100%; clear:both; margin-top:-3px; ">@'.$username.' <br>
                            <span style="font-size: 0.6rem; float:left; display:block; width:100%; clear:both; ">'.strtoupper($GLOBALS['sitio_web']).'
                            <span style="font-size: 0.6rem; float:left; display:block; width:100%; clear:both; "> '. $fecha_imp.'
                            </span>                 
                        </div>
                        
                    </div>
                        
                </div>	
            
                
                '; 
            
        break;


		default: //larga

$data_cad = $rowb['cve_lego'].'|'.$rowb['nombre'].'|'.$nombre_tema.'|'.$nombre_grupo.'|'.$codigo.'|'.$url_print;
$codigob = genera_barcode_codigo($rowb['cve_lego'],0,$rowb['id_user']);

$barcode = 'No Definido';

		break;

		}



	}else{
        
        $barcode = '<span class="col-sm-12"> Grupo no encontrado </span> <div class="no-show">'.$qset.'</div>';
    }

    return $barcode;
}

///////////////////////////////////////////////////////////////////////

function genera_barcode_label_minifig($id_minifig,$user_id){

	include("globals.php");
	include("access.php");
	
    
	
	$info_min = get_all_data_minifig($id_minifig);
	$data_min = explode('/',$info_min);
	//$clave_lego = $row['cve_lego'];
	//$fecha_add = formatFechaHora($row['fecha_registro']);
	//$dato_encontrado = $row['nombre_es'].' / '.$row['nombre_en'].'/'.$row['cve_lego'].'/'.$row['imagen'].'/'.$row['tags'].'/'.$row['estado'].'/'.$row['no_folleto'].'/'.$row['piezas'].'/'.$row['fecha_registro'].'/'.$row['fecha_actualizado'].'/'.$tot_fig;

	

	$nombre_es = $data_min[0];
	$nombre_en = $data_min[1];
	$clave_lego = $data_min[2];
	$no_folleto = $data_min[6];

	$img = $data_min[3];

	//var_dump($data_min[0]);

	if($data_min[0]!='' || $data_min[0]!=0 ){

     $formato = '';
		
        switch($formato){

        default: // 

		$hoy = formatFechaHora(date("Y-m-d H:i:s"));
		 $width = '250px'; 
		 $fecha_imp = ''.$hoy ; 

			$clave_min = $clave_lego.'-'.$no_folleto;
			//var_dump($clave_min);
			$codigob = genera_barcode_codigo_minifig($clave_min,1,$user_id);
			$logo_lbl = $GLOBALS['logo_lbl'];

			$info_serie = get_info_serie($clave_lego);
			
			$data_serie = explode('/',$info_serie);
			$nombre_serie = $data_serie[0];
	
	
	$barcode = '
	<div style="width:'.$width.';" class="center" id="lbl_'.$id_minifig.'" >
		<div class="barcode_holder" style="border:0px solid #ccc; margin-top:5px;">
			
		<img src="'.$logo_lbl.'" class="logo_lbl" style="height:25px;">
		<span style="font-size: 0.6rem; display:block; margin-top:3px;">'.strtoupper($GLOBALS['sitio_web']).' </span> 
		<span style="font-size: 0.8rem; display:block; margin-top:5px;">'.substr(strtoupper($nombre_serie),0,35).'</span>
		
		

        <span style="display:block; margin-top:-8px;" class="barcode_set_thin_b" id="barcode_set_thin"> 
			 '.$codigob.'
		</span>
		<span style="font-size:1rem; display:block; margin-top:-23px;" id="n_set_barcode" >'.substr(strtoupper($nombre_es),0,25).'</span>	

	
		
		</div>
	
		<div class="no-show">'.$codigob.'</div>
	</div>				                    
	
	';
            
        break;

		}
	}else{
		$barcode = '<span style="font-size:1rem; display:block;" >Minifigura no encontrada</span>';
	}

    return $barcode;
}

//////////

function genera_barcode_label($codigo_barras,$tipo){

	/*
	include("globals.php");

$data_codee = explode('.', $codigo_barras);
$barcode_code = $data_codee[0];
$nombre = $data_codee[1];
$tema = $data_codee[2];


$tema_data = getinfotema($tema);

$dta_t = explode('|',$tema_data);
$nombre_tema = $dta_t[0];


	switch($tipo){

		//corta 
		case 1: 

	$barcode = '	
	<div class="barcode_holder center" style="border:0px solid #ccc;"> 
		<span style="font-size: 9.5px; line-height:1.9em; display:block; "> '.strtoupper($GLOBALS['sitio_web']).'</span> 
        	<span style="font-size: 9.5px; line-height:0.9em; display:block;" id="nombre_set_barcode" >  
          		<b> '.strtoupper($nombre_tema).' </b>
       		</span> 

		<span style="font-size: 0.8em; line-height:4.5em; display:block;" class="barcode_set_sm" id="barcode_set">
	          '.$barcode_code.'
	    </span> 

		<span style="font-size: 0.6em; line-height:0.9em;" id="nombre_set_barcode" > '.strtoupper($nombre).'</span> 
	</div>
	'; 

		break; 

		case 2: //larga

$barcode = '

<div class="barcode_holder center" style="border:1px solid #ccc;" >
	<span style="font-size: 9.5px; inline-height: 11px;">'.strtoupper($GLOBALS['sitio_web']).'</span> 
	<span style="font-size: 9.5px; inline-height:9px;" id="nombre_set_barcode" > | <b>'. strtoupper($nombre_tema).'</b></span> 
	<br><br>
															
	<span style=" " class="barcode_set" id="barcode_set"> 

		'.$barcode_code.'

	</span> 
	<br>
	
	<span style="font-size: 9.5px; inline-height:9px;" id="n_set_barcode" >'.strtoupper($nombre).'</span>
		
</div>		
';
		break;

		case 3: //logo

$barcode = '

<div class="barcode_holder center" style="border:1px solid #ccc;" >
<img src="assets/images/logo_codebar.webp" style="height:20px; " >
	<span style="font-size: 9.5px; inline-height: 11px;">'.strtoupper($GLOBALS['sitio_web']).'</span> 
	<span style="font-size: 9.5px; inline-height:9px;" id="nombre_set_barcode" > | <b>'. strtoupper($nombre_tema).'</b></span> 
	<br><br>
															
	<span style=" " class="barcode_set" id="barcode_set"> 

		'.$barcode_code.'

	</span> 
	<br>
	
	<span style="font-size: 9.5px; inline-height:9px;" id="n_set_barcode" >'.strtoupper($nombre).'</span>
		
</div>		
';
		break;

		case 4:

			$barcode= '
			<div class="barcode_holder center" style="border:1px solid #ccc;" >
	<span style="font-size: 9.5px; inline-height: 11px;">'.strtoupper($GLOBALS['sitio_web']).'</span> 
	<span style="font-size: 9.5px; inline-height:9px;" id="nombre_set_barcode" > | <b>'. strtoupper($nombre_tema).'</b></span> 
	<br><br>
															
	<span style=" " class="barcode_set" id="barcode_set"> 

		'.genera_qrcode_set($barcode_code).'

	</span> 
	<br>
	
	<span style="font-size: 9.5px; inline-height:9px;" id="n_set_barcode" >'.strtoupper($nombre).'</span>
		
</div>	'; 

		break;

		default: //larga

$barcode = '

<div class="barcode_holder center" style="border:1px solid #ccc;" >
	<span style="font-size: 9.5px; inline-height: 11px;">'.strtoupper($GLOBALS['sitio_web']).'</span> 
	<span style="font-size: 9.5px; inline-height:9px;" id="nombre_set_barcode" > | <b>'. strtoupper($nombre_tema).'</b></span> 
	<br><br>
															
	<span style=" " class="barcode_set" id="barcode_set"> 

		'.$barcode_code.'

	</span> 
	<br>
	
	<span style="font-size: 9.5px; inline-height:9px;" id="n_set_barcode" >'.strtoupper($nombre).'</span>
		
</div>		
';
		break;

	}

return $barcode;

*/
}


/*

<div class="form-radio form-radio-flat">
                        <label class="form-check-label">
                            <span class="text-muted" style="margin-right:10px;"> <i class="fa-solid fa-barcode"></i></span>
                        <input type="radio" class="form-check-input"  name="flatRadios" id="op2" value="2" <?php echo $select_largo; ?> >  Largo <i class="input-helper"></i></label>
                    </div>
*/

function genera_radiobtn_tipocodigo($action, $current_format){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM tipo_codebar order by id asc";// preparando la instruccion sql
	//echo $qb;
      
                $current_page = $_GET['mnu'];
               // var_dump($current_page);

			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
        while($row= $result->fetch_assoc()){


			switch($action){

	            case 1:       
	                        if($row['clave'] == 1){
	                        	$chk = 'checked';
	                        }else{
	                        	$chk = '';
	                        }

	                        if($row['estado']==0){
	                        	$disabled = 'disabled';
	                        }else{
	                        	$disabled = '';
	                        }

                        if($current_page == '2dae777ac4242728452133f21de5f6a4'){
                           
                           if($row['id'] != 4){

                        	$opt .='
					            <div class="form-radio form-radio-flat">
                                    <label class="form-check-label">
                                        <span class="text-muted" style="margin-right:10px;"> <i class="'.$row['icono'].'"></i></span>
                                        <input type="radio" class="form-check-input" '.$disabled.' '.$chk.' name="flatRadios" id="op'.$row['id'].'" value="'.$row['clave'].'">  '.$row['nombre'].'<i class="input-helper"></i></label>
                                </div>

                        	';
                            }else{
                            
                            $opt .='
					            <div class="form-radio form-radio-flat">
                                    <label class="form-check-label">
                                        <span class="text-muted" style="margin-right:10px;"> <i class="'.$row['icono'].'"></i></span>
                                        <input type="radio" class="form-check-input" disabled '.$chk.' name="flatRadios" id="op'.$row['id'].'" value="'.$row['clave'].'">  '.$row['nombre'].'<i class="input-helper"></i></label>
                                </div>

                        	';
                            }
                        }else{
                        	$opt .='

					            <div class="form-radio form-radio-flat">
                                    <label class="form-check-label">
                                        <span class="text-muted" style="margin-right:10px;"> <i class="'.$row['icono'].'"></i></span>
                                        <input type="radio" class="form-check-input" '.$disabled.' '.$chk.' name="flatRadios" id="op'.$row['id'].'" value="'.$row['clave'].'">  '.$row['nombre'].'<i class="input-helper"></i></label>
                                </div>

                        	';                            
                        }

                break;

                case 2:
	                       

	                        	if($current_format==$row['clave']){
									$chk = 'checked';
								}else{
									$chk = '';
								}

							if($row['estado']==0){
	                        	$disabled = 'disabled';
	                        }else{
	                        	$disabled = '';
	                        }

                         if($current_page == '2dae777ac4242728452133f21de5f6a4' or $current_page=='c00639c9aae3f1af607dc360c571802e'){
                           
                           if($row['id'] != 49){

                        	$opt .='

					<div class="form-radio form-radio-flat">
                        <label class="form-check-label">
                            <span class="text-muted" style="margin-right:10px;"> <i class="'.$row['icono'].'"></i></span>
                        <input type="radio"  onchange="this.form.submit()" '.$disabled.' class="form-check-input" '.$chk.' name="flatRadios" id="fop'.$row['id'].'" value="'.$row['clave'].'">  '.$row['nombre'].'<i class="input-helper"></i></label>
                    </div>';
                           }
                         }


                break;

                default:
	                        if($row['clave'] == 1){
	                        	$chk = 'checked';
	                        }else{
	                        	$chk = '';
	                        }

	                        if($row['estado']==0){
	                        	$disabled = 'disabled';
	                        }else{
	                        	$disabled = '';
	                        }


                        	$opt .='

					<div class="form-radio form-radio-flat">
                        <label class="form-check-label">
                            <span class="text-muted" style="margin-right:10px;"> <i class="'.$row['icono'].'"></i></span>
                        <input type="radio" class="form-check-input" '.$disabled.' '.$chk.' name="flatRadios" id="sop'.$row['id'].'" value="'.$row['clave'].'">  '.$row['nombre'].'<i class="input-helper"></i></label>
                    </div>

                        	';

                break;
	                        
	                        
	        }
	    }
	            }else{
		            $opt ='';
	            }
			            
	
	return $opt; 
	$dbhb->close();

}



function genera_select_tipo_codigo($current){

	include("access.php");
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbh->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}
	
	$q = "SELECT * FROM tipo_codebar ";// preparando la instruccion sql
	//echo $qb;
      
			    $result= $dbh->query($q);
			    if ($result->num_rows > 0) {
				    
				    $num = 1; 
				    
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['estado']==1){
	                        	if($current==$row['clave']){
	                        		$opt .= '<option selected value="'.$row['clave'].'">'.$row['nombre'].'</option>';
	                        	}else{
	                        		$opt .= '<option value="'.$row['clave'].'">'.$row['nombre'].'</option>';
	                        	}
		                        
	                        }else{
	                        	 $opt .= '<option disabled value="0">'.$row['nombre'].'</option>';
	                        }
	                        
	                        
	                    }
	            }else{
		            
	            }


						$seletct= '
						<select id="flatRadiosb" name="flatRadios" class="form-control" onchange="this.form.submit()" >
							<option value="0"> Elije... </option> 
							'.$opt.'
						</select>
						';

	            
	         //   $sel = $seletct;
	            
	          //  var_dump($sel);
	
	//$data = $total_serie; 
	return $seletct; 
	$dbh->close();		
	
}


function genera_qrcode_coleccion($content,$cve_user_serie){

	include("qrlibrary/qrlib.php");

$file = 'assets/images/qr_coleccion/col_'.$cve_user_serie.'.png';

QRcode::png($content,$file,QR_ECLEVEL_L,5,2);

//	$qr_png = '<img src="'.$file.'" style="height:83px; opacity: 0.7;" class="qrcode_lbl" name="nuevo" />';

	return $file;

}


function genera_qrcode_set($codigo){

	include("qrlibrary/qrlib.php");

$file = 'assets/images/qr_sets/'.$codigo.'.png';

QRcode::png($codigo,$file,QR_ECLEVEL_L,5,2);

//	$qr_png = '<img src="'.$file.'" style="height:83px; opacity: 0.7;" class="qrcode_lbl" name="nuevo" />';

	return $file;

}

function genera_qrcode_invitacion($content,$folio){

	include("qrlibrary/qrlib.php");

$file = 'assets/images/qr_invitacion/'.$folio.'.png';

QRcode::png($content,$file,QR_ECLEVEL_L,5,2);

	return $file;

}

function genera_qrcode_public_set($content,$codigo){

	include("qrlibrary/qrlib.php");
    include("globals.php");

    $len = strlen($codigo);
    if($len > 4){
        $file = 'assets/images/qr_sets/public_url/public_'.$codigo.'.png';
    }else{

        $file = 'assets/images/qr_grupo/gpo_'.$codigo.'.png';
    }


if(file_exists($file)) {

} else {
	QRcode::png($content,$file,QR_ECLEVEL_L,5,5);
}

//	$qr_png = '<img src="'.$file.'" style="height:83px; opacity: 0.7;" class="qrcode_lbl" name="nuevo" />';

	return $file;

}

function genera_qrcode_public_collect($content,$token){

	include("qrlibrary/qrlib.php");
    include("globals.php");

	$id_user = get_info_token($token);

  
        $file = 'assets/images/qr_sets/public_url/collect/public_collect_'.$id_user.'_'.$token.'.png';
       // $nombre_fichero_png = 'assets/images/qr_sets/public_url/public_collect_'.$token.'.png';

	QRcode::png($content,$file,QR_ECLEVEL_L,5,5);


	return $file;

}

function convert_to_webp($codigo){

    // Image
$dir = 'assets/images/qr_sets/';
$name = $codigo.'.png';
$newName = $codigo.'.webp';

// Create and save
$img = imagecreatefrompng($dir . $name);
    imagepalettetotruecolor($img);
    imagealphablending($img, true);
    imagesavealpha($img, true);
    imagewebp($img, $dir . $newName, 100);
    imagedestroy($img);


return $dir.$newName;

}


function convert_to_webp_url($url_imagen){

$data_url = explode('/', $url_imagen);
$ultimo = (count($data_url)-1);
$img_name = $data_url[$ultimo];

$data_img = explode('.',$img_name);
$nombre = $data_img[0];
$ext = $data_img[1];

for($i=0 ; $i < count($data_url)-1; $i++){
    $url_final .= $data_url[$i].'/';
}

//$nombre = $url_final;

    // Image
$dir = $url_final;
$name = $nombre.'.png';
$newName = '_'.$nombre.'.webp';

// Create and save
$img = imagecreatefrompng($dir . $name);
    imagepalettetotruecolor($img);
    imagealphablending($img, true);
    imagesavealpha($img, true);
    imagewebp($img, $dir . $newName, 100);
    imagedestroy($img);


return $dir.$newName;


//return $nombre;

}
//////////////

function convert_to_webp_url_gral($url_imagen){

    $data_url = explode('/', $url_imagen);
    $ultimo = (count($data_url)-1);
    $img_name = $data_url[$ultimo];
    
    $data_img = explode('.',$img_name);
    $nombre = $data_img[0];
    $ext = $data_img[1];
    
    for($i=0 ; $i < count($data_url)-1; $i++){
        $url_final .= $data_url[$i].'/';
    }
    
    //$nombre = $url_final;

    //var_dump($url_final);
    
        // Image
    $dir = $url_final;
    $name = $nombre.'.'.$ext;
    $newName = $nombre.'.webp';
    
    // Create and save
    $img = imagecreatefrompng($dir . $name);
        imagepalettetotruecolor($img);
        imagealphablending($img, true);
        imagesavealpha($img, true);
        imagewebp($img, $dir . $newName, 100);
        imagedestroy($img);
    
    
    return $dir.$newName;
    
    
    //return $nombre;
    
    }



function get_info_pags($id_mnu,$clave_mnu){
	
	require("access.php");
		$dbh= new mysqli($dbserver,$dbuser,$dbpwd, $dbname);
		//var_dump($dbpwd);
					
		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}
				
		if($id_mnu!=0){

			$query = " id = $id_mnu";

		}else{

			$query = " cve = '$clave_mnu'";
		}
					
		//$query = "cve = '$clave_mnu'";

		$q = "SELECT * FROM menus WHERE estado = 1 and ".$query."; ";// preparando la instruccion sql	
		//$q = "SELECT * FROM usuarios WHERE ".$query." and password='$password'";


		$result= $dbh->query($q);

		if ($result->num_rows > 0) {
	    	$row= $result->fetch_assoc(); 


	    	$nombre = $row['title'];

	    	if($row['mnu_padre']!= 0){
	    		$mnu_padre = get_info_pags($row['mnu_padre'],0);
	    	}else{
	    		$mnu_padre = '';
	    	}

	    	   $res = $mnu_padre.'|'.$nombre;
	    
	    }else{
		    
		    $res = '--'.$q;
	    }   
		
		//$res = ' <h4 class="fw-bold py-3 mb-4"> <span class="text-muted fw-light">'. $mnu_padre .'/ </span>'. $nombre .'</h4>';	 
		return $res;
}

///////

function get_info_mnu_cve($cve){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	//var_dump($pag_code);
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM menus where cve = '$cve' ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	 
	    	 
	    	 	$lbl = $row['color'].'|'.$row['title'].'|'.$row['icon'].'|'.$row['mnu_padre'].'|'.$row['id'].'|'.$row['seccion'];         
	    	 	            
	    
	    }else{
		    
		    $lbl = 'x|x|x|'.$qb.'|'.$qb;
		    
	    }
	
	return $lbl; 
	$dbh->close();
}

///////////////

function get_info_seccion_menu($id){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	//var_dump($pag_code);
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM seccion_mnu where clave = $id ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();

	    	 	$lbl = $row['titulo'].'|'.$row['title'];   
	    }else{
		    
		    $lbl = 'X|X';
		    
	    }
	
	return $lbl; 
	$dbh->close();
}

//////

function convertImageToWebp($inputFile, $outputFile, $quality = 100): void{
    $fileType = exif_imagetype($inputFile);

    switch ($fileType) {
        case IMAGETYPE_GIF:
            $image = imagecreatefromgif($inputFile);
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
            break;
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($inputFile);
            break;
        case IMAGETYPE_PNG:
            $image = imagecreatefrompng($inputFile);
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
            break;
        case IMAGETYPE_WEBP:
            rename($inputFile, $outputFile);
            return;
        default:
            return;
    }

    imagewebp($image, $outputFile, $quality);

    imagedestroy($image);
}

//////

function webpConvert2($file, $compression_quality = 70)
{
    // check if file exists
    if (!file_exists($file)) {
        return false;
    }
    $file_type = exif_imagetype($file);
    //https://www.php.net/manual/en/function.exif-imagetype.php
    //exif_imagetype($file);
    // 1    IMAGETYPE_GIF
    // 2    IMAGETYPE_JPEG
    // 3    IMAGETYPE_PNG
    // 6    IMAGETYPE_BMP
    // 15   IMAGETYPE_WBMP
    // 16   IMAGETYPE_XBM
   
	//
	$data_url_fin = explode("/", $file);

	//$ante = count($data_url_fin)-1;
	for($i=0 ; $i<count($data_url_fin)-1 ; $i++){
		$url_fin .= $data_url_fin[$i].'/'; 
	}

	// Nombre el archivo
	$data_url = explode('/', $file);
    $ultimo = (count($data_url)-1);
    $img_name = $data_url[$ultimo];

	$data_name = explode('.',$img_name);
	$fname= $data_name[0];
	$fext = $data_name[1];
	//$f_name = count($data_url_fin);


	$output_file = $url_fin.$fname.'.webp';

    if (file_exists($output_file)) {
        return $output_file;
    }
    if (function_exists('imagewebp')) {
        switch ($file_type) {
            case '1': //IMAGETYPE_GIF
                $image = imagecreatefromgif($file);
                break;
            case '2': //IMAGETYPE_JPEG
                $image = imagecreatefromjpeg($file);
                break;
            case '3': //IMAGETYPE_PNG
                    $image = imagecreatefrompng($file);
                    imagepalettetotruecolor($image);
                    imagealphablending($image, true);
                    imagesavealpha($image, true);
					//imagewebp($img, $dir . $newName, 100);

                    break;
            case '6': // IMAGETYPE_BMP
                $image = imagecreatefrombmp($file);
                break;
            case '15': //IMAGETYPE_Webp
               return false;
                break;
            case '16': //IMAGETYPE_XBM
                $image = imagecreatefromxbm($file);
                break;
            default:
                return false;
        }
        // Save the image
        $result = imagewebp($image, $output_file, $compression_quality);
        if (false === $result) {
            return false;
        }
        // Free up memory
        imagedestroy($image);
        return $output_file;
    } elseif (class_exists('Imagick')) {
        $image = new Imagick();
        $image->readImage($file);
        if ($file_type === "3") {
            $image->setImageFormat('webp');
            $image->setImageCompressionQuality($compression_quality);
            $image->setOption('webp:lossless', 'true');
        }
        $image->writeImage($output_file);
        return $output_file;
    }
    return false;
}

////

function genera_select_ubicacion($id_user,$current){

	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}
	
		
		$qc = "SELECT * FROM ubicaciones_usuario where estado = 1 and id_user = $id_user and tipo = 1;";// preparando la instruccion sql
			
			//var_dump($current);
		$resultc= $dbh->query($qc);
		
			if ($resultc->num_rows > 0) {			
				while($rowc= $resultc->fetch_assoc()){
					
					
	
						if($current==$rowc['id']){
							$atr .= '<option value="'.$rowc['id'].'" selected > '.$rowc['nombre'].'</option>'; 
						}else{

							$atr .= '<option value="'.$rowc['id'].'" > '.$rowc['nombre'].'</option>'; 
						}
					
					
							
				}	   
				

				 
			}else{
				$atr = '<option value="0" > Sin Registros </option>'; 
			}
	

		
		return '<option value="0" > Sin Ubicacion </option>'.$atr;
	}

    ///////

    function get_ubicaciones_inventario($user){
        	include("access.php");
		
	
	  $dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
        if ($dbhb->connect_error) {
            die("Connection failed: " . $dbhb->connect_error);
        }

  // $qb = "SELECT * FROM coleccion where id_user = '$id_user' and estado = 1 ;";// preparando la instruccion sql
   $qb = "SELECT * FROM ubicaciones_usuario where estado = 1 and id_user = $user and tipo = 1;";
   
 // echo $qb;

   
    $resultb= $dbhb->query($qb);
    
    
    	if ($resultb->num_rows > 0) {
	    	
	    	$num = 0; 
	    	
	    	while($row= $resultb->fetch_assoc()){
		    
		    $datas.= '<div class="col-sm-12 p-1 border-bottom bg-muted " style="text-align:left; " > 
								<span class="text-muted " > 
                                    <span style="margin:1px 5px;"> <i class="fa-solid fa-location-dot"></i> </span> <span style="font-size:0.8em;"> '.$row['nombre'].'  </span>
                                </span> 
                                <button id="'.$row['id'].'" onclick="elimina_ubicacion(this.id)" class=" btn btn-muted text-muted" style="border:0px solid #ccc; float:right;" ><i class="fa-regular fa-trash-can"></i></button>
								</div>';
		    
		    }
	    
	    }else{
            $datas.= '<div class="col-sm-12 p-1 border-bottom " style="text-align:left; " > 
								<span class="text-muted " > No hay Ubicaciones </span> 
								</div>';
        }
	
	return $datas; 
	$dbhb->close();

    }


    function get_info_ubic($id){

		include("access.php");
	
		$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		  //informacion de acceso a la bd
		// Check connection
		if ($dbhb->connect_error) {
			die("Connection failed: " . $dbhb->connect_error);
		}
		
		$qb = "SELECT * FROM ubicaciones_usuario where id = $id; ";// preparando la instruccion sql
		//echo $qb;
		  
		$resultb= $dbhb->query($qb);
		
			if ($resultb->num_rows > 0) {
				$row= $resultb->fetch_assoc();
				
				$info = $row['nombre'].'|'.$row['fecha_agregado'];	 
				 
			}else{ // si no existe el registro de usuario con esa minifigura, regresa un valor comodin ara generar la lista de elementos
				$info = '0|0|0';
			}
		
		//$data = $total_serie; 
		return $info; 
		$dbhb->close();

    }

	function get_select_set_coleccion(){

		include("access.php");
		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		
		if ($dbh->connect_error) {
			   die("Connection failed: " . $dbh->connect_error);
		}
		
			
			//$qc = "SELECT * FROM ubicaciones_usuario where estado = 1 and id_user = $id_user and tipo = 1;";
			$qc = "SELECT * FROM sets where estado = 1 GROUP BY cve_lego;";
			// preparando la instruccion sql
				
				//var_dump($current);
			$resultc= $dbh->query($qc);
			
				if ($resultc->num_rows > 0) {			
					while($rowc= $resultc->fetch_assoc()){

						$path_foto_set = 'assets/images/sets/';
						$file = $path_foto_set.$rowc['cve_lego'].'.webp';


								
								if(file_exists($file)) {
									   $bandera_foto_set = 1;
								} else {
									
									if(file_exists($path_foto_set.$rowc['cve_lego'].'.jpg')){
										$bandera_foto_set = 1;
									}else{
									
										if(file_exists($path_foto_set.$rowc['cve_lego'].'.jpeg')){
											$bandera_foto_set = 1;
										}else{
												if(file_exists($path_foto_set.$rowc['cve_lego'].'.png')){
													$bandera_foto_set = 1;
												}else{
													$bandera_foto_set = 0;		
												}								    	
											}
									}
								}
						
								if($bandera_foto_set==0){
									$atr .= '<option value="'.$rowc['cve_lego'].'" > '.$rowc['cve_lego'].'</option>'; 
									$no = $no +1;
								}
						
					
							
					}	   
					 
				}else{
					$atr = '<option value="0" > Sin Registros </option>'; 
				}
		
				if($no == 0){
					$atrr = '<option value="0" > Sin Fotos Faltates </option>';
				}else{
					$atrr = '<option value="0" > Elija uno... </option>'.$atr;
				}
			
			return $atrr;


	}


    function get_estado_config($id_conf, $id_user){

		include("access.php");
		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		
		if ($dbh->connect_error) {
			   die("Connection failed: " . $dbh->connect_error);
		}

		$qb = "SELECT * FROM usuario_configuraciones where id_user = $id_user and id_config = $id_conf";// preparando la instruccion sql
		//echo $qb;
		  
		$resultb= $dbh->query($qb);
		
			if ($resultb->num_rows > 0) {
				$row= $resultb->fetch_assoc();
				
				$info = $row['valor']; 
				 
			}else{ 
                $info = '0';
			}
		

		return $info; 
		$dbh->close();


    }


	function get_last_page($id_user){

		include("access.php");
		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		
		if ($dbh->connect_error) {
			   die("Connection failed: " . $dbh->connect_error);
		}

		$qb = "SELECT * FROM page_request_user where id_user = $id_user order by fecha_solicitado desc";// preparando la instruccion sql
		//echo $qb;
		  
		$resultb= $dbh->query($qb);
		
			if ($resultb->num_rows > 0) {
				$row= $resultb->fetch_assoc();
				
				$info = $row['url']; 
				 
			}else{ 
                $info = 'index.php';
			}
		

		return $info; 
		$dbh->close();

	}

	function get_detalle_ubic($id_ubic){

		include("access.php");
		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		
		if ($dbh->connect_error) {
			   die("Connection failed: " . $dbh->connect_error);
		}

		$qb = "SELECT * FROM ubicaciones_usuario where id = $id_ubic";// preparando la instruccion sql
		//echo $qb;
		  
		$resultb= $dbh->query($qb);
		
			if ($resultb->num_rows > 0) {
				$row= $resultb->fetch_assoc();
				
				$info = '<span class="text-muted"> <i class="fa-solid fa-location-dot"></i> '.$row['nombre'].'</span>'; 
				 
			}else{ 
                $info = '<span> Sin ubicación </span>';
			}
		

		return $info; 
		$dbh->close();

	}



	////////////

	function genera_barcode_label_sim($dn,$formato){

		include("globals.php");
	
		include("access.php");
		
		
		
		  $dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
		if ($dbhb->connect_error) {
			die("Connection failed: " . $dbhb->connect_error);
		}
	
	
		$qset = "SELECT * FROM sim where dn = $dn";
		//var_dump($qset);
		
		$result= $dbhb->query($qset);
		if ($result->num_rows > 0) {
		
		$rowb= $result->fetch_assoc();	  
						   
				
	
switch($formato){
	
		case 1: // QR
		
		$barcode= '
		<div style="width: 230px; margin-top:5px;" class="col-md-12 center" >
			<div class="row barcode_holder" style="border:0px solid #ccc; " >
																		
				<div style="display: flex; text-align:left;">
					<span style="font-size: 1.3rem; line-height: 1.3rem; "><b>'.$rowb['dn'].'</b> <br>
					<span style="font-size: 1rem; line-height: 1rem; ">'.$rowb['imsi'].' <br>
					<span style="font-size: 0.9rem; line-height: 0.8rem;" > '.strtoupper($rowb['sistema']).' <br>
					<span style="font-size: 0.9rem; line-height: 0.8rem;" > '.strtoupper($rowb['plan']).' <br>
					<span style="font-size: 0.9rem; line-height: 0.8rem;" > '.strtoupper($rowb['status']).' <br>
					<span style="font-size: 0.9rem; line-height: 0.8rem;" > '.$rowb['sim_serie'].' <br>
					
				</div>
			</div>
		

		</div>	
		
		
		'; 
	
			break;
	
			default: //larga
				$barcode = 'No Definido'.$qset;
	
			break;
	
			}
	
	return $barcode;
	
		}
	}
	///////////////////////////////////////////////////////////////////////


	function get_info_estado_setcol($id){

		include("access.php");
		
		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		  //informacion de acceso a la bd
		// Check connection
		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}
		
		$q = "SELECT * FROM estado_colect_set where clave =$id";// preparando la instruccion sql
	
		$resultb= $dbh->query($q);
		
			if ($resultb->num_rows > 0) {
				$row= $resultb->fetch_assoc();
				
				$data = $row['id'].'|'.$row['nombre'].'|'.$row['fecha_registro'];
			
			}else{
				
				$data = '0|0|0';
			}
		
		return $data; 
		$dbh->close();	
		
	}


    function get_menus_modales($id_padre,$nivel){


        include("access.php");
        $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

        if ($dbh->connect_error) {
            die("Connection failed: " . $dbh->connect_error);
        }

            $qh = "SELECT * FROM menus where mnu_padre = $id_padre and nivel = $nivel";// preparando la instruccion sql

            $resulth= $dbh->query($qh);
            
                if ($resulth->num_rows > 0) {	
                    $tot_reg = 	$resulth->num_rows;	
                    $num = 0;
                    
                    while($rowh= $resulth->fetch_assoc()){
                        $res .= '1|'.$rowh['id'].'|'.$rowh['title'].'|'.$rowh['link'].'|'.$rowh['cve'].'||';
                    }
                }else{
                    $res = '0|xxx||';
                }

                return $res;
    }


    function get_total_submenus($current_menu,$nivel){


        include("access.php");
        $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

        if ($dbh->connect_error) {
            die("Connection failed: " . $dbh->connect_error);
        }

            $qh = "SELECT * FROM menus where mnu_padre = $current_menu and nivel = $nivel";// preparando la instruccion sql

            $resulth= $dbh->query($qh); 
            
			if ($resulth->num_rows > 0) {
				$row= $resulth->fetch_assoc();
				
				$tot_res = $resulth->num_rows;
			
			}else{
				
				$tot_res = 0;
			}

        return $tot_res;  
        $dbh->close();

    }


function get_info_conf($id){ // devuelve NOmbre, Nombre imagen 0 ambos
	
	include("access.php");
	
	//var_dump($pag_code);
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

//id, titulo, seccion_padre, estado, fecha_registro, fecha_actualizado
   $qb = "SELECT * FROM opciones where id = $id ";// preparando la instruccion sql
  
   //echo $qb;

    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	 $row= $resultb->fetch_assoc();
	    	  
	    	 
	    	 	$lbl = $row['titulo'].'|'.$row['seccion_padre'].'|'.$row['estado'].'|'.$row['fecha_registro'];         
	    	 	            
	    
	    }else{
		    
		    $lbl = '0|0|0|0|0|0|0|0|0|0|0';
		    
	    }
	
	return $lbl; 
	$dbh->close();
}

//////
function get_info_item_coleccion($item){
	
	include("access.php");
	
	$data = explode(";", $item); 
	$item_look= $data[0];
	$user_look=$data[1];
    $clave_look=$data[2];
	
	
	  $dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}

   $qb = "SELECT * FROM coleccion where item = '$item_look' and id_user = '$user_look' and clave_lego = '$clave_look';";// preparando la instruccion sql
   
   //var_dump($qb.'<br>');

   
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	$row= $resultb->fetch_assoc();
	    	
            $tot = $resultb->num_rows;
	    	$datas = $row['faltantes'].';'.$row['fecha_registro'].';'.$row['estado'].';'.$row['favorito'].';'.$row['id'].';'.$row['id_user'].';'.$row['item'].';'.$row['clave_lego'].';'.$row['no_extra'].';'.$row['mostrar_mkt'].';'.$row['fecha_actualizado'].';'.$row['fecha_fav'].';'.$row['fecha_admin_fav'].';'.$row['fecha_admin_add'].';'.$tot;  
	    
	    }else{
            $datas= '0|0|0|0|0|0|0|0|0|0|0|0|0'; 
        }
       // var_dump($datas.'<br>');
	return $datas; 
	$dbhb->close();
}// funcion



/////////


function crea_grid_series(){

	include("access.php");
	
	  $dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbh->connect_error) {
	    die("Connection failed: " . $dbh->connect_error);
	}

    $user_perfil = $GLOBALS['user_perfil'];
    $user = $GLOBALS['user'];


//   $q = "SELECT * FROM series WHERE estado = 1;";// preparando la instruccion sql
$q = "SELECT * FROM series order by fecha_lanzamiento asc;";// preparando la instruccion sql
// $q = "SELECT * FROM series order by tipo desc;";// preparando la instruccion sql

 
    $result= $dbh->query($q);
    if ($result->num_rows > 0) {
	    
		
	    $num = 1; 
	    $tot = 0;
	    
	    $current = ''; 
	    $last = ''; 
	    
	    
                    while($row= $result->fetch_assoc()){

                        $permiso_ver_serie = get_permiso_serie($row['clave_lego'],$GLOBALS['user']);

                       

                        if($permiso_ver_serie == 1){
	                         
	                         $params = $GLOBALS['user'].';'.$row['clave_lego'];
	                         $estado_serie = $row['estado'];
	                         
	                         $current = $row['clave_lego'];
	                  
	                //numero mostrado 
	                if($estado_serie ==0 and $user_perfil != 1){
		                         $num = $num - 1; 
		                         
	                }elseif($estado_serie ==2 and $user_perfil != 1){
		                	$num = $num - 1; 
	                }else{
	                         
                            // var_dump($params);
	                         $total_user = busca_info_coleccion($params);

	                         	if($total_user==""){
		                         	$total_user= 0; 
	                         	}
	                         $total_serie = get_total_minifig($row['clave_lego']);
	                         
	                         if($total_serie==$total_user){
		                         $class_colect = 'active_trophy';
		                         $estado_col = ' completa tengo '; 
		                         $color_cont = ' badge-warning- '; 
		                         $ico_minimal = '<span class="trophy_minimal parpadea" style="margin-right: 3px; font-size:9px; "> <i class="fa fa-trophy"></i></span>';
		                         //$class_cover = ' hover_imagen_complete ';
	                         }else{
		                         $class_colect = 'diactive_trophy';
		                         $estado_col = 'incompleta falta ';
		                         $color_cont = ' badge-secondary- '; 
		                         //$class_cover = ' hover_imagen_main ';
		                         $ico_minimal = '<span class="parpadeab" style="margin-right: 3px; font-size:9px;"> <i class="fa fa-circle"></i></span>';
	                         }
	                         
	                         if($row['tipo']==1){
		                         $class_cover = '  ';
		                        $tipo = ' consecutiva '; 
	                         }elseif($row['tipo']==2) {
		                         $class_cover = ' tematica ';
		                         $tipo = ' tematica ';
	                         }elseif($row['tipo']== 3) {
		                         $class_cover = ' opcional ';
		                         $tipo = ' opcional ';
	                         }
	                         
	                         

	                    // para hacer el efecto de nivel de color completado
							 $paso = (97/ $total_serie); 
	                         $h = $total_user * $paso;
	                         
	                         $faltan = 'faltan '.($total_serie - $total_user); 	                
	                    
							 $color = $row['color'];
                             $colorb = $row['colorb'];
							 
							 $data = explode(',', $color); 
							 $r= $data[0];
							 $g= $data[1];
							 $b= $data[2];
	                    
			                    if($r == 255 and $g==255 and $b==255){
				                    $color_alt = '230,230,230';
			                    }else{
				                    $color_alt = $color;
			                    }

						////// Verifica si el usuario ha decidido activar la vista, solo aplica si son series opcionales

	                      $status_user = ''; 
	                      $tipo_s = get_tipo_serie($row['clave_lego']);	


			                    $id_perfil_db = get_info_perfil($user_perfil);
			                    $data_per = explode(';', $id_perfil_db);
			                    $id_real = $data_per[0];
			                    
			                    /// 
			                    
			                    $id_estado = get_info_estado_serie($row['estado']);
			                    $data_estado = explode('/', $id_estado);
			                    $id_estado_real = $data_estado[0];
			                    
			                    
			                    // codigos de permiso
			                    
			                    $code_user = getLetraByPosition($id_real);
			                    $code_estado_serie = getLetraByPosition($id_estado_real);
			                   // $code_status_user = getLetraByPosition($status_user);
			                    $code_tipo_serie = getLetraByPosition($tipo_s);

								$code_colect = $code_tipo_serie.$code_estado_serie.$code_user;
								
								
								
	                      if($tipo_s ==3){ 
		                      
		                      $status_user = get_status_series_opcional($user, $row['clave_lego']); // obtiene el permiso de tabla permiso_serie_opcional
		                      
		                      //var_dump('<div style="position:relative; z-index:99999;">'.$row['clave_lego'].'-'.$status_user.'</div>');
		                      
		                      if($status_user==1){
			                      $bandera_tarjetas = get_permiso_coleccion($code_colect);                                                                           
		                      }else{
			                      $bandera_tarjetas = 0;
		                      }
		                      
	                      }else{
			                   
			                   	
	                   
	                   			$bandera_tarjetas = get_permiso_coleccion($code_colect);
							}	
								
						////
						
							$data_color = get_info_serie($row['clave_lego']);
	                        
	                        $data = explode('/', $data_color);
	                        
	                        $nombre_serie = $data[0];
	                        $color_serie = $data[1];
	                        $fecha_serie = $data[2];
	                        $precio_serie = $data[4];
	                        $moneda_serie = $data[5];
	                        $desc_serie = $data[6];						
	                   
	                   
	                    $search = strtolower($row['nombre']).' '.strtolower($row['clave_lego']).' '.$estado_col.' '.$faltan.' '.$tipo.'';
	                    
	                   //var_dump($row['clave_lego'].'-'. $code_colect.'-'. $bandera_tarjetas.'<br>');
	                   $debug =$code_colect. ' - '.$bandera_tarjetas.' - '.$row['clave_lego'].' - '.$nombre_serie.'<br>';
	                   
			                         $deb = $GLOBALS['deb'];
			                         
			                         if($deb == 1){
				                                       	
			               	
			 	                        if($last != $current){
					                        
					                        $list .= $debug;
					                        
				                        }else{
					                        
					                        $list .= '';
				                        }
				                        
			                         }else{
				                         $debug_card= '';
				                         $list = '';
			                         }	                  
	                  
	                  
	                  		                
		                if($bandera_tarjetas==0){
			               $tarjetas_ini .='';
			               //$tot = $tot - 1;
		                       
	                    }elseif($bandera_tarjetas==1){
		                    
		                    $tot = $tot + 1;
		                    
                    
		                    //para pprtada minimal 
		                    
		                    $foto_portada = valida_foto_tipo($row['clave_lego'],3);
		                    
		                    
		                    /////// determina la proporcion de la foto 
		                    
		                    $path_final_portada = $foto_portada;
		                    
		                    
								$imagenb = getimagesize($path_final_portada);    //Sacamos la información
								 $anchob = $imagenb[0];              //Ancho
								 $altob = $imagenb[1];
								 
								 $proporcion = round(floatval(($anchob / $altob)),1);
								        
		                    $style_image = '';
		                    
		                    $debug_im = $ancho.'-'.$alto;
		                   // var_dump($ancho);
		                   
		                   ///// vista del grid
		        			  $vista_grid = $_GET['vista'];
		        			  
		        			  if($vista_grid==''){
			        			 $tamanio_card = $GLOBALS['user_vista_m'];
		        			  }else{
			                    
			                    $tamanio_card = $vista_grid;
			                    
			             
				               }
				            
				            if($vista_grid==3){	 // vista en grid	                   
		                   
			                    if($proporcion <= 1.2 ){ 
				                    $style_image = 'max-height: 150px; max-width:100px; margin-right:5px; '.$proporcion; 
			                    }elseif($proporcion > 1.2 and $proporcion < 2){
				                    $style_image = 'max-height: 65%; max-width: 60%; margin-right:5px; '.$proporcion;
			                    }else{
				                    $style_image = 'max-height: 70%; max-width: 75%; margin-right:5px; '.$proporcion;
			                    }
			                    
			                    $align_vista = ''; 
			                    
		                    }elseif($vista_grid==12){ // vista en lista

			                    if($proporcion <= 1.2 ){
				                    $style_image = 'max-height: 50%; max-width:9%; margin-right:5px; '.$proporcion; 
			                    }elseif($proporcion > 1.2 and $proporcion < 2){
				                    $style_image = 'max-height: 65%; max-width: 14%; margin-right:5px; '.$proporcion;
			                    }else{
				                    $style_image = 'max-height: 40%; max-width: 20%; margin-right:5px; '.$proporcion;
			                    }
			                    
			                    $align_vista = 'align-left-row'; 		                    
		                    }elseif($vista_grid==6){ // vista en lista

			                    if($proporcion <= 1.2 ){
				                    $style_image = 'max-height: 100px; margin-right:5px; 3-'.$proporcion; 
			                    }elseif($proporcion > 1.2 and $proporcion < 2){
				                    $style_image = 'max-height: 100px; margin-right:5px; 3-'.$proporcion;
			                    }else{
				                    $style_image = 'max-height: 100px; margin-right:5px; 3-'.$proporcion;
			                    }
			                    
			                    $align_vista = 'align-left-row'; 		                    
		                    }
		                    
		                    $style_image= '';
		                    
		                    ///////
	                     
	                     $path_imagen = 'assets/images/backgrounds/'.$row['clave_lego'].'.png';
	             	            
	             	            if(file_exists($path_imagen)) {
								       //echo "The file exists";
								       $bg = $row['clave_lego'].'.png';
								       $min = '0.6'; 
								       $max = '1'; 
								} else {
								       //echo "The file does not exist";
								       $bg = 'default.png';
								       $min = '0.5'; 
								       $max = '1'; 								       
								}
	                     
	                /// Favoritos

		        	$tot_fav = get_favoritos_serie($row['clave_lego'],$GLOBALS['user']);
                   // var_dump('<div class="col-md-12" style="position:relative; z-index:99999; top: 50%;">'.$tot_fav.'</div>');

		        	if($tot_fav!=0){

$favs='<span class="" style="font-size:0.7rem; margin-right:2px; color:rgba(200,200,200,0.7); border-left: 2px solid rgba(100,100,100,0.9); padding-left: 10px;" >
								<i class="fa-solid fa-heart" ></i> 
							</span>
							<span class="" style="font-size:0.7rem; color:rgba(250,250,250,0.6);" >'.$tot_fav.' </span> '; 
		        	}else{
$favs= '';
		        	}

		        	

		        ///               
	                     
	                    if($user_perfil==1){ // Si es ADMIN 
		                     
		                     if($row['estado'] == 0){ // oculto
			                     $title_estado = 'oculto'; 
			                     $ico_mant = '<span class="ico_hide" title="(Estado: 0) OCULTO: Los usuarios no pueden ver esta serie en el mosaico de colecciones." > 
			                     					<i class="fas fa-eye-slash"></i>
								 					</span>';
			                     $css_mant = 'display:block; ';
			                     $class_mant = '';
			                     $link_access = '
				                     <a class="text_link" href="index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6&ref='.$row['clave_lego'].'&cve=1">
										<span id="" class="subname_main"> '.$row['clave_lego'].'</span> 
										<span class="ico_link"><i class="fas fa-chevron-circle-right"></i> </span>
									</a>
			                     ';			                     
			                     $trofeo = '
									<div class="imagen_main"> 
										<span class="star_collection_main">
					                		<h1 class="'.$class_colect.'" "> <i class="fas fa-trophy"></i> </h1>
											<span class="badge '.$color_cont.' text-neutral " style="font-size: 14px; "> <b>'.$total_user.'</b> de '.$total_serie.'</span>
										</span>
										
					                </div>	
			                     ';
			                     $align_trofeo = 'align-left-max';
			                     $css_grayscale = 'filter: grayscale(100%);';
			                     $css_barra_ico = '';
			      $conteo = '<span class="subname_main conteo_minimal"> '.$ico_minimal.'<b>'.$total_user.'</b> / '.$total_serie.'  '.$favs.'</span>';
			                      			                     		                     
		                     }elseif($row['estado'] == 1){ //No es visible
			                     $title_estado = 'visible'; 
			                     $ico_mant = '';
			                     $class_mant = '';
			                     $css_mant = 'display:block;';
			                     $link_access = '
				                     <a class="text_link" href="index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6&ref='.$row['clave_lego'].'&cve=1">
										<span id="" class="subname_main">
											'.$row['clave_lego'].'
										</span> 
										<span class="ico_link"><i class="fas fa-chevron-circle-right"></i> </span>
									</a>
			                     '; 
			                     		                     
			                     $trofeo = '
									<div class="imagen_main"> 
										<span class="star_collection_main">
					                		<h1 class="'.$class_colect.'" "> <i class="fas fa-trophy"></i> </h1>
											<span class="badge '.$color_cont.' text-neutral " style="font-size: 14px; "> <b>'.$total_user.'</b> de '.$total_serie.'</span>
										</span>
										
					                </div>	
			                     ';
			                     $align_trofeo = 'align-left-max';
			                     $css_grayscale = 'filter: grayscale(0%);';
			                     $css_barra_ico = 'no-show';
			    $conteo = '<span class="subname_main conteo_minimal"> '.$ico_minimal.'<b>'.$total_user.'</b> / '.$total_serie.'  '.$favs.' </span>';
			                     			                     			                     		                     
		                     }elseif($row['estado'] == 2){ ///////////// Borrador ( Rosa)
							 	$title_estado = 'borrador'; 
			                    $css_mant = 'display:block;';
			                    $ico_mant = '<span class="ico_mant" title="(Estado: 2) BORRADOR: Los usuarios no pueden acceder ni verla en el mosaico de colecciones. Solo el perfil ADMINISTRADOR puede visualizarla. " > <i class="fas fa-eraser"></i> </span>';
			                    $class_mant = ''; 
			                     $link_access = '
				                     <a class="text_link" href="index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6&ref='.$row['clave_lego'].'&cve=1">
										<span id="" class="subname_main"> '.$row['clave_lego'].'</span> 
										<span class="ico_link"><i class="fas fa-chevron-circle-right"></i> </span>
									</a>
			                     ';
			                     
			                     $trofeo = '
									<div class="imagen_main"> 
										<span class="star_collection_main">
					                		<h1 class="'.$class_colect.'" "> <i class="fas fa-trophy"></i> </h1>
											<span class="badge '.$color_cont.' text-neutral " style="font-size: 14px; "> <b>'.$total_user.'</b> de '.$total_serie.'</span>
										</span>
										
					                </div>	
			                     ';
			                     $align_trofeo = 'align-left-max';
			                     
			                     $css_grayscale = 'filter: grayscale(0%);';
			                     $css_barra_ico = '';
			   
                                 $conteo = '<span class="subname_main conteo_minimal"> '.$ico_minimal.'<b>'.$total_user.'</b> / '.$total_serie.'  '.$favs.'</span>';
			                     			                     			                     		                    			                     
		                     }elseif($row['estado'] == 3){ ////////////// Teaser (Rojo)
			                     $title_estado = 'teaser'; 
			                    $css_mant = 'display:block;';
			                    $ico_mant = '<span class="ico_teaser" title="(Estado: 3) TEASER: Los usuarios pueden ver la tarjeta pero no acceder a la colección hasta su fecha de lanzamiento." > <i class="fas fa-bullhorn"></i> </span>';
			                    $class_mant = '';
			                     $link_access = '
				                     <a class="text_link" href="index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6&ref='.$row['clave_lego'].'&cve=1">
										<span id="" class="subname_main"> '.$row['clave_lego'].'</span> 
										<span class="ico_link"><i class="fas fa-chevron-circle-right"></i> </span>
									</a>
									
			                     ';
			                     $trofeo = '
									<div class="imagen_main"> 
										<span class="star_collection_main">
					                		<h1 class="'.$class_colect.'" "> <i class="fas fa-trophy"></i> </h1>
											<span class="badge '.$color_cont.' text-neutral " style="font-size: 14px; "> <b>'.$total_user.'</b> de '.$total_serie.'</span>
										</span>
										
					                </div>	
			                     ';
			                     $align_trofeo = 'align-left-max';
			                     $css_grayscale = 'filter: grayscale(0%);';
			                     $css_barra_ico = '';
			     $conteo = '<span class="subname_main conteo_minimal"> '.$ico_minimal.'<b>'.$total_user.'</b> / '.$total_serie.'  '.$favs.'</span>';
			                     			                     		                               			                     
		                    }elseif($row['estado'] == 4){ //// TEST ROsa
							 	$title_estado = 'test'; 
			                    $css_mant = 'display:block;';
			                    $ico_mant = '<span class="ico_test" title="(Estado: 4) TEST: Los usuarios no pueden acceder ni verla en el mosaico de colecciones. Solo el perfil ADMINISTRADOR puede visualizarla. " > <i class="fas fa-band-aid"></i></span>';
			                    $class_mant = ''; 
			                     $link_access = '
				                     <a class="text_link" href="index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6&ref='.$row['clave_lego'].'&cve=1">
										<span id="" class="subname_main"> '.$row['clave_lego'].'</span> 
										<span class="ico_link"><i class="fas fa-chevron-circle-right"></i> </span>
									</a>
			                     ';
			                     
			                     $trofeo = '
									<div class="imagen_main"> 
										<span class="star_collection_main">
					                		<h1 class="'.$class_colect.'" "> <i class="fas fa-trophy"></i> </h1>
											<span class="badge '.$color_cont.' text-neutral " style="font-size: 14px; "> <b>'.$total_user.'</b> de '.$total_serie.'</span>
										</span>
										
					                </div>	
			                     ';
			                     $align_trofeo = 'align-left-max';
			                     
			                     $css_grayscale = 'filter: grayscale(0%);';
			                     $css_barra_ico = '';
			     $conteo = '<span class="subname_main conteo_minimal"> '.$ico_minimal.'<b>'.$total_user.'</b> / '.$total_serie.' '.$favs.'</span>';
			                     			                     			                     		                    			                     
		                     } // estado
		                     
		                     
	        }else if($user_perfil !=1){
		                     		                  
		                     if($row['estado'] == 0){
			                     $title_estado = 'oculto'; 
			                     $ico_mant = '';
			                     $css_mant = ' display:none; ';
			                     $class_mant = 'no-show';
			                     $link_access = '
				                     <a class="text_link" href="index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6&ref='.$row['clave_lego'].'&cve=1">
										<span id="" class="subname_main"> '.$row['clave_lego'].'</span> 
										<span class="ico_link"><i class="fas fa-chevron-circle-right"></i> </span>
									</a>
			                     '; 
			                     $align_trofeo = 'align-left-max';
			                     
			                     $trofeo = '
									<div class="imagen_main"> 
										<span class="star_collection_main">
					                		<h1 class="'.$class_colect.'" "> <i class="fas fa-trophy"></i> </h1>
											<span class="badge '.$color_cont.' text-neutral " style="font-size: 14px; "> <b>'.$total_user.'</b> de '.$total_serie.'</span>
										</span>
										
					                </div>	
			                     ';
			                    $align_trofeo = 'align-left-max';
			                    $css_barra_ico = '';
			                    $conteo = '<span class="subname_main conteo_minimal"> '.$ico_minimal.'<b>'.$total_user.'</b> / '.$total_serie.'  '.$favs.'</span>';
			                     			                     			   			                     		                     
		                     }elseif($row['estado'] == 1){
			                     $title_estado = 'visible'; 
			                     $ico_mant = '';
								 $css_mant = 'display:block;';
			                     $class_mant = '';
			                     $link_access = '
				                     <a class="text_link" href="index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6&ref='.$row['clave_lego'].'&cve=1">
										<span id="" class="subname_main">  '.$row['clave_lego'].' <i class="fa-solid fa-angle-right"></i> </span> 										
									</a>
			                     '; 
			                     
			                     $trofeo = '
									<div class="imagen_main"> 
										<span class="star_collection_main">
					                		<h1 class="'.$class_colect.'" "> <i class="fas fa-trophy"></i> </h1>
											<span class="badge '.$color_cont.' text-neutral " style="font-size: 14px; "> <b>'.$total_user.'</b> de '.$total_serie.'</span>
										</span>
										
					                </div>	
			                     ';
			                     $align_trofeo = 'align-left-max';
			                     $css_barra_ico = 'no-show';
			                    $conteo = '<span class="subname_main conteo_minimal"> '.$ico_minimal.'<b>'.$total_user.'</b> / '.$total_serie.'  '.$favs.'</span>';
			                     			                     			                     			                     
		                     }elseif($row['estado'] == 2){
			                     $title_estado = 'borrador'; 
			                     $css_mant = 'display:none;';
			                     $ico_mant = '';
			                     $class_mant = 'no-show';
			                     $link_access = '
				                     <a class="text_link" href="index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6&ref='.$row['clave_lego'].'&cve=1">
										<span id="" class="subname_main"> 
											'.$row['clave_lego'].'
										</span> 
										<span class="ico_link"><i class="fas fa-chevron-circle-right"></i> </span>
									</a>
			                     ';

			                     $trofeo = '
									<div class="imagen_main"> 
										<span class="star_collection_main">
					                		<h1 class="'.$class_colect.'" "> <i class="fas fa-trophy"></i> </h1>
											<span class="badge '.$color_cont.' text-neutral " style="font-size: 14px; "> <b>'.$total_user.'</b> de '.$total_serie.'</span>
										</span>
										
					                </div>	
			                     ';
			                     
			                     $align_trofeo = 'align-left-max';
			                     $css_barra_ico = '';
			                    $conteo = '<span class="subname_main conteo_minimal"> '.$ico_minimal.'<b>'.$total_user.'</b> / '.$total_serie.'  '.$favs.'</span>';
			                     			                     
			                     			   
		                     }elseif($row['estado'] == 3){
			                     $title_estado = 'teaser'; 
			                     $css_mant = 'display:block;';
			                     $ico_mant = '<span class="ico_teaser" title="PROXIMAMENTE" > <i class="fas fa-bullhorn"></i>  </span>';
			                     $class_mant = '';	
			                     $f_lan = formatFecha($row['fecha_lanzamiento']);
			                     
			                     $f_hoy = date("Y-m-d");
			                     
			                     $trofeo = '';
			                     $align_trofeo = 'align-left-min'; 
			                     $css_barra_ico = '';
			                     $conteo = '';
			                     
			                    if($row['fecha_lanzamiento'] > $f_hoy){
				                     $link_access = '
				                     <span class="text-left">
									 <span id="" class="" style="color:rgba(250,250,250,0.6); font-size: 0.9rem;"> 	'.$row['clave_lego'].' </span> <br>
				                     <span class=""  style="color:rgba(250,250,250,0.6); font-size: 0.9rem; letter-spacing: 2px; ">PROXIMAMENTE</span> <br>
				                     <span class="bubble_text_bg">'.$f_lan.'</span>
				                     </span>
				                     ';
				                     
				                     $debug = 'A'; 
				                     
				                     
			                 	}elseif($row['estado'] == 4){
				                     $title_estado = 'prueba'; 
				                     $css_mant = 'display:none;';
				                     $ico_mant = '';
				                     $class_mant = 'no-show';
				                     $link_access = '
					                     <a class="text_link" href="index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6&ref='.$row['clave_lego'].'&cve=1">
											<span id="" class="subname_main"> 
												'.$row['clave_lego'].'
											</span> 
											<span class="ico_link"><i class="fas fa-chevron-circle-right"></i> </span>
										</a>
				                     ';
	
				                     $trofeo = '
										<div class="imagen_main"> 
											<span class="star_collection_main">
						                		<h1 class="'.$class_colect.'" "> <i class="fas fa-trophy"></i> </h1>
												<span class="badge '.$color_cont.' text-neutral " style="font-size: 14px; "> <b>'.$total_user.'</b> de '.$total_serie.'</span>
											</span>
											
						                </div>	
				                     ';
				                     
				                     $align_trofeo = 'align-left-max';
				                     $css_barra_ico = '';
				$conteo = '<span class="subname_main conteo_minimal"> '.$ico_minimal.'<b>'.$total_user.'</b> / '.$total_serie.'  '.$favs.'</span>';
				                     			                     
			                     	$debug = 'B';	   
		                     	}else{

				                     $link_access = '
					                     <a class="text_link" href="index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6&ref='.$row['clave_lego'].'&cve=1">
											<span id="" class="subname_main"> '.$row['clave_lego'].'</span> 
											<span class="ico_link"><i class="fas fa-chevron-circle-right"></i> </span>
										</a>
				                     ';

				 $conteo = '<span class="subname_main conteo_minimal"> '.$ico_minimal.'<b>'.$total_user.'</b> / '.$total_serie.'  '.$favs.'</span>';
				                     $debug = 'C';
			                     				                     
			                     }
			                     
			                     			                     
		                     }// Estado 
		                    
		                    		                   
		                               
	                     }
	                     
	                     //var_dump($f_hoy);
	                     
	                        $parp_ant = $class_parp; 
	                        // Funcion apara parpadeo de imagen
	                        
	                        $class_parp = rand_parpadeo(); 
	                        
	                        
	                        if($class_parp == $parp_ant ){
		                        $class_parp = rand_parpadeo(); 
	                        }
		                     
		                     
		                    
		                    if($tipo_s == 3 ){ 
			                
			                
			                $ico_coleccion = '<span class="ico_col_personal" title="(Tipo 3) COLECCIÓN OPCIONAL: Ésta es una serie puedes o no visualizarla. Modifica esta opción desde el Menú: Mi Cuenta > Configuraciones." > '.$GLOBALS['ico_select_coleccion'].' </span>';
			                
			                
			                
		                    }else{
			                    $ico_coleccion = ''; 
			                     
		                    }
		                    
		                    
		                    if($tipo_s == 4 or $tipo_s == 5 ){			                     
		                        $link_access = '
				                     <a class="text_link" href="index.php?mnu=1f6503307f1eb3ea66a6be2c6ae4fae6&ref='.$row['clave_lego'].'&cve=1">
										<span id="" class="subname_main"> 
											Ver Colección
										</span> 
										<span class="ico_link"><i class="fas fa-chevron-circle-right"></i> </span>
									</a>
				                     ';
				            
				             }
		                    ////////////. PREMIUM ///////////// //////-----------------  PREMIUM 
		                    

								 
		                    
		                    if($row['premium'] == 0){
			                    $ico_premium ='';
			                    $class_blocked = 'unblocked';
			                    $search_premium = ''; 
			                    $ribbon = ''; 
			                  //  $per_temporal = '';
			                    $banner_premium = '<div  class="col-sm-6 " style="z-index:999; height:30px; border-radius: 0px 0px 0px 3px; " >  </div>'; 
			                    
			                    $ribbon_premium = '<div  class="col-sm-12 text-light " style="font-size: 0.8em; z-index:999; text-align:center; border-radius: 0px 0px 0px 3px; background: linear-gradient(53deg, rgba(34,170,195,0) 0%, rgba(45,253,198,0) 100%); " > &nbsp;  </div>'; 
			                    
			                    
		                    }elseif($row['premium'] == 1){
		
								
								if($row['descuento']==0){
					                
					                $ribbon = '';
								}else{
					                //$ico_premium = '<span class="ico_premium_desc" title="Serie Premium con Descuento" > <i class="fas fa-bookmark"></i>  </span>';
					                $ribbon = '<div class="col-sm-3 ribbon_dec bg-danger text-light text-sm"><b>[ - '.$row['descuento'].'% ]</b></div>';
								}
								
								$ico_premium = '<span class="ico_premium" title="Serie Premium" > <i class="fas fa-bookmark"></i>  </span>';								
								$status_pago = get_status_pago($row['clave_lego'], $user);
																			 

								$permiso_pago = get_permiso_pago($row['clave_lego'], $user);
								
								if($permiso_pago==1){
									
									$class_blocked = 'unblocked';
									$ribbon = '';
									
									 $ico_exento = '<span class="ico_exento" title="Serie Exenta de Pago" > <i class="fa-solid fa-unlock"></i> </span>'; 

								}else{									
								
									 
									if($status_pago == 1){
										
										$class_blocked = 'unblocked';										
										$ico_exento = '<span class="ico_exento" title="Serie Exenta de Pago" > <i class="fa-solid fa-unlock"></i> </span>'; 
									//	$per_temporal = '';
									}else{
										$class_blocked = 'blocked';
									//	$per_temporal = '';
										$ico_exento = '<span class="ico_exento" title="Requiere Pago" > <i class="fa-solid fa-credit-card"></i> </span>'; 
									}	
																
								}

								$banner_premium = '<div  class="col-sm-6" >'.$ico_premium.''.$ico_exento.' </div>'; 
		                    
		                    }
		                    
		                    /////////////////// -- Termina Premium ----- ////////////
	               
							$tam_nom = strlen($row['nombre']);
							if($tam_nom>= 15){
								$size= '22px; line-height: 28px; '; 
								
							}else{
								$size= '28px'; 
							}
	               
		                    ////////////////////////
		        
				$banner_coleccion = '
				<div  class="col-sm-6 " style=" " > '.$ico_mant.''.$ico_coleccion.' 
				<div id="debug_code_'.$row['clave_lego'].'" class="no-show" style="font-size:0.8em; float:right; margin-top:5px; color:rgba(250,250,250,0.5);  "> '.$code_colect.'</div>
				</div>'; 
							
				
				if($tipo_s == 1 ){
					$bg_banner = '
					background:rgba('.$color.', 0.0);
					background:linear-gradient(90deg, rgba(10,10,10, 0.0) 0%, rgba('.$color.', 0.0)  50%, rgba(10,10,10, 0.0) 100%); 
					border-top:1px solid rgba('.$color.', 0.0);
					'; 
					//background:linear-gradient(90deg, rgba('.$color.', 0.4) 0%, rgba(10,10,10, 0.1)  50%, rgba('.$color.', 0.4) 100%);
				}else if($tipo_s != 1 ){

					$bg_banner = '
					background:rgba('.$color.', 0.3);
					background:linear-gradient(90deg, rgba(10,10,10, 0.1) 0%, rgba('.$color.', 0.4)  50%, rgba(10,10,10, 0.1) 100%); 
					border-top:1px solid rgba('.$color.', 0.2);
					'; 

				}

		        $banners= '
		        		<div class="row col-sm-12 " style="z-index:999; margin-left: 0px; padding: 0; border-radius: 0 0 3px 3px;  height:60%; '.$bg_banner.' ">

							'.$banner_premium.'
							'.$banner_coleccion.'
							
						</div> 
		        '; 


		                    		                    		                    
		        $search = '-'.strtoupper($row['nombre']).'- -'.$row['nombre'].'- -'.strtolower($row['nombre']).'- -'.$row['clave_lego'].'- -'.$estado_col.'- -'.$faltan.'- -'.$tipo.'- -'.$title_estado.'- -'.$search_premium.'- ';

				$div_list = '<div class="border ; " style="background: rgba(23,23,23,0.9); left:2%; position: absolute; z-index:999999932499; color:#fff; "> '.$list.' </div>'; 



	                     
	            $tarjetas_ini .= '
	          
	          
				<card class="col-md-'.$tamanio_card.' grid-margin stretch-card '.$class_mant.'" style="'.$css_mant.'" id="s-'.$row['clave_lego'].'" searchable="'.$search.'" >
               
              
                              
	                <div class="card shelf_card" style="border: 0px solid rgba(200,200,200,0.9); border: 1px solid rgba(200,200,200, 0.8); border-radius:5px; background: #fff; " >
	                 	
	                 	 
	                 	'.$per_temporal.'
	                 	<div id="animation-arrow" class=" animate"></div>
	                 	
	                 	<div class="num_card"> '.$tot.'  </div>
	                 	
	                 	<div class="hover_imagen_main '.$class_cover.'"  > 	</div>                  	
		                 	
		                 	<div class="hold_bg_conf">
					          
					          <div class="bg_imagen_portada">
					           
					          	<div class="back_color_main degrade color_hover" style="z-index: 811;  
                                  background:linear-gradient(155deg, rgba('.$color.', 0.5) 55%, rgba('.$colorb.', 0.9) 100%); "  ></div>
					          	<div class="back_color_main degrade" style="z-index: 88;" >
					          	
					          	
					          	
						            <div class="item_dec stat" > <span class="parpadeab text"> '.$ico_collect_stat.' </span> </div>
						                <div class="hover_imagen" '.$fx_coleccion.'  >
						                <div class="item_dec dec_a" ></div>
						                <div class="item_dec dec_b" ></div>
						                <div class="item_dec dec_c" ></div>
						                <div class="item_dec dec_d" ></div>
						                <div class="item_dec dec_e" ></div>
										
					                </div>					          	
					          	</div>
					          	
					          	
					          	<div class="back_color_main imagen_serie" style="z-index: 79; border:0px solid #c30;" >
					          		

					          		<img class="image_portada '.$class_blocked.' '.$class_parp.'" style="z-index:75; '.$style_image.' " src="data:image/png;base64,'.base64_encode(file_get_contents($path_final_portada)).'"  >
					          	</div>
					          	
					          </div> 
					           
					           
					          <div class="bg_color_degradado">
				                   <div class="back_color_main bg_theme" style="z-index: 79; background: url(\'assets/images/backgrounds/'.$bg.'\'); height:'.$h.'%; " ></div>
						           
						           <div class="back_color_main" style="background:linear-gradient(155deg, rgba('.$color.', '.$min.') 30%, rgba('.$color_alt.', '.$max.') 100%); height:'.$h.'%;  border-top: 1px solid rgba('.$color_alt.',0.8);  " ></div>
					          </div>
			                
			                </div>
		                
	           
	           '.$trofeo.'
		              
		                <input type="hidden" value="'.$tipo_s.'" id="tipo">
		                <input type="hidden" value="'.$status_user.'" id="status_user">
                
                
						<div class="card-body card_body_main '.$align_trofeo.' '.$align_vista.'" >
						
							'.$ribbon.' 
						
	                    	<h4 class="card-title card_title_main title_card_mosaico " onclick="toggle(\'debug_code_'.$row['clave_lego'].'\')" 
	                    		style="font-size: '.$size.'; color: rgba('.$color.', 0.8); "> '.$row['nombre'].'  </h4>
							
							'.$link_access.' 
							'.$conteo.'  

							
							
							
	                    </div>
					   
							'.$banners.'
						
							<div class="debug no-show" >
							'.$tipo_s.' '.$ico_coleccion.'
							</div>
					</div>
				</card>'.$div_list; 
	                    
	                    }// IF ESTADO SERIE 
	                    
	                    }
	                    
	                                        
	                    $num = $num +1;

                    }else{ // permiso ver serie
                        $tarjetas_ini .= '';
                    }

	                    }//while 
	                    

							$last = $current; 
	                        $current = ''; 


	                    }

						//$tarjetas_ini = $herraminetas . $tarjetas_ini;
    
    //$GLOBALS['tarjetas_ini'];

    return $tarjetas_ini;

    $dbh->close();

}


function get_cards_minifigure_s($serie,$view){

	$user_idiom = $GLOBALS['user_idioma']; 
	$user = $_SESSION['clave_user'];
	
	include("access.php");
	
	
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	  //informacion de acceso a la bd
	
	if ($dbh->connect_error) {// Check connection
		die("Connection failed: " . $dbh->connect_error);
	}	
	
	
	 
	
	if($serie==1){ // si la funcion manda a llamar a todas las minifiguras
	  
		  if( $GLOBALS['user_perfil'] == 1 ){
		
			$debug = 1;  // debug para cuando se sellecciona todas las minififuras	
				
			if($debug==1){
				$qmi = "SELECT * FROM minifiguras where cve_lego like '710%' ;";// testing 
			}else{
				$qmi = "SELECT * FROM minifiguras order by cve_lego;";// real
			}
						
			  
		  }else if( $GLOBALS['user_perfil'] != 1){
			  
			  $qmi = "SELECT * FROM minifiguras where estado = 1;";// preparando la instruccion sql
		  }else{
			  $qmi = "SELECT * FROM minifiguras where estado = 1;";// preparando la instruccion sql
		  }
			//$q = "SELECT * FROM minifiguras;";// preparando la instruccion sql
	
	
	//////////////////////////   BUSCA SERIES ACTIVAS   ////////////////////////////////////
	
		  if( $GLOBALS['user_perfil'] == 1 ){
			  
			  $qss = "SELECT * FROM series where estado > 1;";// preparando la instruccion sql
							
		  }else if( $GLOBALS['user_perfil'] != 1){
			  
			  $qss = "SELECT * FROM series where estado = 1 or estado = 2;";// preparando la instruccion sql
		  }
			  
		$results= $dbh->query($qss);
		if ($results->num_rows > 0) {
		
		$tot_reg = $results->num_rows; 
		$tot = 0; 
		
			while($rows= $results->fetch_assoc()){
				
				if($tot == $tot_reg){
					$serie_act .= $rows['clave_lego'];
				}else{
					$serie_act .= $rows['clave_lego'].'-';
				}
							
				$tot = $tot + 1; 
			}
		
		}
	
		// 2. Convierte en un array
		
		$series = explode('-', $serie_act); 
	
	
	 //////////////////////////   BUSCA SERIES OPCIONALES ////////////////////////////////////
	
		  $qop = "SELECT * FROM series where tipo = 3;";// preparando la instruccion sql
	
		$resultop= $dbh->query($qop);
		if ($resultop->num_rows > 0) {
		
		$tot_reg = $resultop->num_rows; 
		$tot = 0; 
		
			while($rowop= $resultop->fetch_assoc()){
				
				if($tot == $tot_reg){
					$serie_op .= $rowop['clave_lego'];
				}else{
					$serie_op .= $rowop['clave_lego'].'-';
				}
							
				$tot = $tot + 1; 
			}
		
		}
	
		// 2. Convierte en un array
		$series_op = explode('-', $serie_op); 
		
	
	 
	}else{ // una serie especifica
	
		$order_q = 'order by no_folleto';
		  
		$qmi = "SELECT * FROM minifiguras where cve_lego = $serie $order_q";// preparando la instruccion sql
		
		$class_clave =""; 
		$clave_lego = $_GET['ref']; 
	}
	
		//info Serie
		$data_color = get_info_serie($_GET['ref']);
							
		$data = explode('/', $data_color);
		
		$nombre_serie = $data[0];
		$color_serie = $data[1];
		$fecha_serie = $data[2];
		$edo_serie = $data[3];
		$precio_serie = $data[4];
		$moneda_serie = $data[5];
		$desc_serie = $data[6];
		$colorb_serie = $data[14];
	
	// termina info serie
	
	$result= $dbh->query($qmi);
	if ($result->num_rows > 0) {
		
		$css_user = $GLOBALS['user_css_fig'];
		$num = 0;
		$total_collect = 0; 
		$cadena = '';
		
		$total_serie_elem = $result->num_rows;
		
		$current = ''; 
		$last = ''; 
	
		
			while($row= $result->fetch_assoc()){
				
				if($moneda_serie=='XXX'){
					$moneda_serie = 'USD';
				}
				
				$current = $row['cve_lego'];
							
							
							$cadena='';
							  // Checa si la serie es premium
							  
							  $premium = get_status_premium($row['cve_lego']);          
													
							  // checa si se ha registrado el pago
							  
							  $pago = get_status_pago($row['cve_lego'], $user); 
							  
							//// Determina si es visible las series opcionales
							//$estado_custom = get_estado_serie_opcional($row['cve_lego'], $user);
							
							// Nueva funcion sobre tabla y no codigo de configuracion.
							$estado_custom = get_status_series_opcional($user,$row['cve_lego']);
							
							$tipo_s = get_tipo_serie($row['cve_lego']);	
							
							// sca el estado de la serie
								// saca la clave de la serie 
								$estado_serie = get_info_serie($row['cve_lego']);
								$data_s = explode('/', $estado_serie);
								$estado_r = $data_s[3];
								$color_col  = $data_s[1];
								$color_text = $data_s[13];
								//var_dump($estado_serie);
								
								// busca el estado en el catalogo								
							
								$id_estado = get_info_estado_serie($estado_r);
								$data_estado = explode('/', $id_estado);
								$code_estado_serie = getLetraByPosition($data_estado[0]);
							
							
							/// forma el codigo para determinar el permiso
							
							$code_tipo_serie = getLetraByPosition($tipo_s);
							
							if($premium==1){
								$code_premium = getLetraByPosition(1);
							}else{
								$code_premium = getLetraByPosition(2);
							}
	
	
							$permiso_pago = get_permiso_pago($row['cve_lego'], $user);
							
	
							if($pago==0){
								//$code_pago = getLetraByPosition(2);
								
								
								if($permiso_pago==1){
									$code_pago = getLetraByPosition(3);
								}else{
									
									$code_pago = getLetraByPosition(2);
												//$code_pago = getLetraByPosition(2);					
								}	
															
							}else{
								
								if($permiso_pago==1){
									$code_pago = getLetraByPosition(3);
								}else{
									
									$code_pago = getLetraByPosition($pago);
												//$code_pago = getLetraByPosition(2);
																	
								}
	
	
							}
							
							//var_dump($code_pago);
							
							$perfil_usuario = get_id_perfil($GLOBALS['user_perfil']);
							//var_dump($perfil_usuario);
	
							if($perfil_usuario==0){
								$code_perfil = getLetraByPosition(2);
							}else{
								$code_perfil = getLetraByPosition($perfil_usuario);
							}	
							
							if($serie==1){
								$code_serie = getLetraByPosition(1);
							}else{
								$code_serie = getLetraByPosition(2);
							}
							
							if($estado_custom ==0){
								$code_estado_opcional = getLetraByPosition(2);
							}else{
								$code_estado_opcional = getLetraByPosition($estado_custom);
							}							
								
							
							
							$code_serie_acceso = $code_tipo_serie.$code_estado_serie.$code_premium.$code_pago.$code_perfil.$code_serie.$code_estado_opcional;
							
							//$bandera_serie = get_estatus_vista($code_serie_acceso);
						  
						  /// Valida si ya es fecha de realese                          
						  if($edo_serie == 3){
							$hoy = date("Y-m-d");
							$f_release = $fecha_serie;
							
							if($hoy >= $f_release){
							  $vigencia =1;
							}else{
							  $vigencia =0;
							}
						   // $vigencia = compara_fechas($hoy,$f_release);
							
						   // var_dump($vigencia);
							
							if($vigencia == 1 ){
							  $bandera_serie = 1;
							}else{
							  $bandera_serie = get_estatus_vista($code_serie_acceso);
							}
							
						  }else{
							$bandera_serie = get_estatus_vista($code_serie_acceso);
						  }
						
						  
							$debug =$code_serie_acceso . ' - '.$bandera_serie.' - '.$row['cve_lego'].' - '.$nombre_serie.' - Vigencia:'.$vigencia.'<br>';
	
	
	
						 
						 $deb = $GLOBALS['deb'];
					   // $deb = 1;
						 
						 if($deb == 1){
							 $debug_card= '<div class="text-light" style="position:absolute; background: rgba(10,10,10,0.7); width:100%; height:100%; top:0px; left:0px; z-index:100000; border-radius:5px; ">
						<span class="col-sm-12"> 
							<span> Clave: '.$row['cve_lego'].' </span> <br>
							<span> Código Vista:  '.$code_serie_acceso.' </span><br>
							<span> Bandera Vista:  '.$bandera_serie.' </span>
						</span>
				   </div>';
				   
				   
							 if($last != $current){
								
								$list .= $debug;
								
							}else{
								
								$list .= '';
							}
							
						 }else{
							 $debug_card= '';
							 $list = '';
						 }
						   
						 //  var_dump($cadena);
							 if($bandera_serie == 0 and $serie != 1){
								 
								 $grid_body ='
	
	
										  <div class="col-md-12 center grid-margin">
										 
											 <h1 class=" text-muted" style="font-size: 90px;" onclick="toggle(\'code_deb\')" >										 	
												 <i class="em em-no_entry" aria-role="presentation" aria-label="NO ENTRY"></i>
											</h1>
								
											<br>
	
											<h3 class="page-title text-primary">¡Opps!</h3>
											
											<span class="subtitle_sec_w text-neutral center" style="font-size:24px; "> 												 
												No tienes permisos para visualizar esta colección.
											</span>
										</div>							 	
								 
								 
								 
										<div class="col-lg-12 text-clear " style="text-align:center;" >                          	
							
											   <div id="code_deb" class="" style="display:none;">  '.$debug.' </div>
										</div>' ;
	
	
									
						   }else if($bandera_serie == 4 and $serie != 1){
	
	
								 $grid_body ='
										
										 <div class="col-md-12 center grid-margin">
										 
											 <h1 class=" text-muted" style="font-size: 90px;" onclick="toggle(\'code_deb\')" >						 								
											 
												 <i class="em em-hourglass" aria-role="presentation" aria-label="HOURGLASS"></i>
	
											</h1>
								
											<br>
	
											<h3 class="page-title text-primary">Esta colección aún no se estrena</h3>
											
											<span class="subtitle_sec_w text-neutral center" style="font-size:24px; "> 
												 
												Para ver esta <b>Colección</b> espera la fecha de estreno. <br> ¡Tambien estamos anciosos! 
											</span>
										</div>							 	
								 
								 
								 
										<div class="col-lg-12 text-clear " style="text-align:center;" >                          	
							
											   <div id="code_deb" class="" style="display:none;">  '.$debug.' </div>
										</div>' ;
	
							
						   }else if($bandera_serie == 2 and $serie != 1){
								 
								 $grid_body ='
	
	
										  <div class="col-md-12 center grid-margin">
										 
											 <h1 class=" text-muted" style="font-size: 90px;" onclick="toggle(\'code_deb\')" >						 								
											 
												 <i class="em em-clipboard" aria-role="presentation" aria-label="CLIPBOARD"></i>
	
											</h1>
								
											<br>
	
											<h3 class="page-title text-primary">Modifica la configuración</h3>
											
											<span class="subtitle_sec_w text-neutral center" style="font-size:24px; "> 
												 
												Para ver esta <b>Colección Opcional</b> selecciónala desde tu perfil.
											</span>
										</div>							 	
								 
								 
								 
										<div class="col-lg-12 text-clear " style="text-align:center;" >                          	
							
											   <div id="code_deb" class="" style="display:none;">  '.$debug.' </div>
										</div>' ;
	
	
										
							
						   }else if($bandera_serie == 3 and $view == 1 ){
							   
						   /// valida si hay cupones activos. 
							
							//$valida_cupon_act = valida_cupon_activo($row['cve_lego']);    
							$valida_cupon_act = valida_cupon_activo($row['cve_lego'], $GLOBALS['user']);
							//var_dump($valida_cupon_act);
							
							$dta_cupon = explode('|', $valida_cupon_act);
							//$res = '1|'.$titulo.'|'.$descuento.'|'.$fini.'|'.$ffin;
							
							$estado_cup = $dta_cupon[0];
							$cupon = $dta_cupon[1];
							$desc_cup = $dta_cupon[2];
							$fini_c = $dta_cupon[3];
							$ffin_c = $dta_cupon[4];
							$id_uso_cupon = $dta_cupon[5];
							
						   
							//////////                   
							
							if($desc_serie==0){
								
								
								if($estado_cup == 1){
									
									$porcent = ($desc_cup/100);
									$mont_desc = ($precio_serie * $porcent );
									$precio_final =round(($precio_serie - $mont_desc),2);
									$btn_quitar_cupon = '
									
										<button type="button" class="btn btn-outline-primary  btn_thin" value="'.$id_uso_cupon.'" style="margin-top:10px;font-size:0.7rem" onclick="elimina_cupon_uso(\''.$id_uso_cupon.'\');" > <i class="fa-solid fa-eraser"></i> </button>
										'; 
									
								 $banner_desc = '
								 
								<div class="col-sm-12 " style=" width:100%; margin: 3px auto; padding: 15px; background: rgba(20,20,20, 0.4); border-radius:3px; "> 
									<span class="elegant_title" style="margin-top:30px;" > Serie Premium </span>
									
								
								</div>';
									
									$lbl_precio = '<label class="col-sm-8 text-muted">Donativo Serie Premium </label>
									<label class="col-sm-4 text-muted">$ '.$precio_serie.' '.strtoupper($moneda_serie).'</label>
	';
									
									 $lbl_cupon_act = '
			<div class="col-sm-8 text-success">Cupón: '.strtoupper($cupon).' <span class="text-danger">(-'.$desc_cup.'%)</div> 

			<div class="col-sm-4 text-danger">$ '.$mont_desc.' '.strtoupper($moneda_serie).' '.$btn_quitar_cupon.' </div> 
	'; 	                    
							
								}else{
									
								
								$precio_final = $precio_serie;
								
								 $banner_desc = '
								 
								<div class="col-sm-12 " style=" width:100%; margin: 3px auto; padding: 15px; background: rgba(20,20,20, 0.4); border-radius:3px; "> 
									<span class="elegant_title" style="margin-top:30px;" > Serie Premium </span>
									
								
								</div>';
	
									$lbl_precio = '<label class="col-md-8 text-muted">Donativo Serie Premium </label>
									<label class="col-sm-4 text-muted">$ '.$precio_serie.' '.strtoupper($moneda_serie).'</label>
	';
									
									 $lbl_cupon_act = ''; 
								
								}
							
							}else{
								
								if($desc_serie != 0){
								
								$porcent = ($desc_serie/100);
								$mont_desc = ($precio_serie * $porcent );
								$precio_final =round(($precio_serie - $mont_desc),2);
								
								$banner_desc = '
								<div class="col-sm-12 " style=" width:100%;  margin: 3px auto; padding: 15px; background: rgba(20,20,20, 0.4); border-radius:3px;"> 
									<span class="elegant_title "> Serie Premium 
																
									<span class="text-light" style="" > [ - '.$desc_serie.'% ]</span> 
									<span>'.$cadena.'</span>
								</span>
								</div>';
							
								}
							}
							
						
							//comprueba imagen para portada minimal 
								$file = 'assets/images/portada_serie/'.$row['cve_lego'].'.jpg';
	
	
								
								if(file_exists($file)) {
									   //echo "The file exists";
									   $foto_portada = $row['cve_lego'].'.jpg';
								} else {
									
									if(file_exists('assets/images/portada_serie/'.$row['cve_lego'].'.jpeg')){
										//echo "The file exists";
										$foto_portada= $row['cve_lego'].'.jpeg';
									}else{
									//echo "The file does not exist";
										//$foto_portada = '0.png';	
											if(file_exists('assets/images/portada_serie/'.$row['cve_lego'].'.png')){
												//echo "The file exists";
												$foto_portada= $row['cve_lego'].'.png';
											}else{
											//echo "The file does not exist";
												$foto_portada = '00.png';			
											}								    	
												
									}
								}		                    
							/////	                        
	
							/////// determina la proporcion de la foto 
							
							$path_final_portada = 'assets/images/portada_serie/'.$foto_portada;
							
							
								$imagenb = getimagesize($path_final_portada);    //Sacamos la información
								 $anchob = $imagenb[0];              //Ancho
								 $altob = $imagenb[1];
								 
								 $proporcion = round(floatval(($anchob / $altob)),1);
										
							$style_image = '';
							
							$debug_im = $ancho.'-'.$alto;
						   // var_dump($ancho);
							if($proporcion <= 1.2 ){
								$style_image = 'max-height: 150px; max-width:100px; '; 
							}elseif($proporcion > 1.2 and $proporcion < 2){
								$style_image = 'max-height: 80%; max-width: 95%;';
							}else{
								$style_image = 'max-height: 80%; max-width: 95%;';
							}
							
							
							/// valida si hay cupones activos. 
							
							
							// 	$res = '1|'.$titulo.'|'.$descuento.'|'.$fini.'|'.$ffin;
	
							
							///////                        
							   
	$grid_body ='
	
		
		<div class="col-md-12 row center ">    
			
			<div class="col-md-5 "  style="height:500px; display:block;" > 
				
					<card class="col-md-12 grid-margin stretch-card " style="height:45%;"  >
						<div class="card shelf_card" style="border: 0px solid rgba(200,200,200,0.9); border: 1px solid rgba(200,200,200, 0.8); border-radius:5px; background: #fff; " >
							 
	
								 <div class="hold_bg_conf" style="width:100%; border-radius:10px;">
								  <div class="bg_color_degradado" style="display:block;"> 
									  <div class="back_color_main degrade" style="z-index: 88;" ></div>
									 
									<div class="back_color_main" style="background:linear-gradient(155deg, rgba('.$color_serie.', 0.7) 30%, rgba('.$colorb_serie.',0.6) 100%); height:100%; width:100%;" ></div>
									   
									<div class="col-sm-12 back_color_main imagen_serie" style="z-index: 79; " >
									   <img class="image_portada " style="'.$style_image.'" src="'.$path_final_portada.'"  >									   		
									</div>
									   
									
									<div id="animation-arrow" class=" animate"></div>
									
								</div>
								
						</div>
							
				  
						<div class="card-body card_body_main " style="margin-left:0px; text-align:center; border:0px solid #c40; " >
							<h4 class="card-title card_title_main title_card_mosaico text-light ">
								<b>'.$nombre_serie.' </b>	                    		 
							</h4>
								
							<span style="margin-top:30px;" class="">'.$banner_desc.'</span> 
							
							
						<div class=" center" style="position: absolute; bottom:5px; left:5px;">
							
								<span class="col-sm-1" style="z-index:999; font-size:0.8em;  color:rgba(250,250,250,0.4);" >
									<i class="fa-solid fa-code"></i>
								</span>
								
								<span id="code_serie" class="center" style=" font-size:0.8em;  color:rgba(250,250,250,0.4);" >'.$code_serie_acceso.' </span>
								 
						</div>
						
						</div>
					</card>				
			</div>
		</div>
		
		<div class="col-sm-1 row " >
		</div>
				
		<div class="col-md-6 row " >
	
			 
	
			<div class="col-lg-12 stretch-card" style="text-align:left; padding:5px;">
				<div class="card">
				  <div class="card-body" style="padding-bottom: 10px;">
					<h4 class="card-title border-bottom"> <span class="text-success">PAGO ÚNICO s</span> </h4>
					
						<div class="row">
							'.$lbl_precio.'	
						</div>
	
						 <div class="row " style="border:1px solid #f40;">
							'.$lbl_cupon_act.' 
							<input type="hidden" id="perfil_elimina" value="0" />
						</div>
	
						<div class="row">
									<label class="col-md-6 lbl-form-control text-muted">Cupón: </label>
									<input type="text" class="col-md-4 form-control border" id="cupon_serie" value="" placeholder="Introduce Código" >
									<button class="btn btn-secondary" onclick="valida_cupon();"> Agregar</button>
						</div>
								
						<div class="col-md-12" style="padding:10px;" id="res_valida_cupon" >  </div>
	
						 <div class="row border-top " style="margin-top:20px; padding-top:15px;">
							<label class="col-sm-8"> <h4>Total</h4> </label><label class="col-sm-4"> <h4>$ '.$precio_final.' '.strtoupper($moneda_serie).'</h4></label>
						</div>
										  
				  </div>
				</div>
			  </div>
			  
				
	
				
				<div class="col-md-12 " id="paypal_col" style="display:block; float;right; text-align:right;">
				
				<input type="hidden" value= "'.$user.'" id="user_premium" >
				<input type="hidden" value= "'.$row['cve_lego'].'" id="serie_premium" >
	
						<span class="col-md-12">
								'.form_paypal($row['cve_lego'],$precio_final,$moneda_serie).'
						</span>
				
				</div>
				
	
						
		
		</div>		
	
				'; 
										 
							   
							   
						   
						   }elseif($bandera_serie > 0){ // 
	
								//info Serie
		$data_color = get_info_serie($_GET['ref']);
							
		$data = explode('/', $data_color);
		
		$nombre_serie = $data[0];
		$color_serie = $data[1];
		$fecha_serie = $data[2];
		$edo_serie = $data[3];
		$precio_serie = $data[4];
		$moneda_serie = $data[5];
		$desc_serie = $data[6];
		$colorb_serie = $data[14];
	
	// termina info serie
							
							$num = $num + 1;
							$index = $num-1;
	
						
						// Formato estandar es Webp
	
							   $dir= 'minifig/'.$row['cve_lego'];
							   $num_webp = count( glob($dir.'/{*.webp,*.WEBP}',GLOB_BRACE));
	
							   $total_minifig_serie = get_total_minifig($row['cve_lego']);
	
							   //var_dump($num_webp);
	
	
								$format= '.webp';
								   $imagen = $row['imagen'];
								$path_imagen = 'minifig/'.$row['cve_lego'].'/'.$imagen.$format;
	
							   if(file_exists($path_imagen)){
								   
								$foto = $path_imagen;
								//var_dump($row['cve_lego'].'- Existe;');
							   }else{
	
								   $num_png = count( glob($dir.'/{*.png,*.PNG}',GLOB_BRACE));
								   //var_dump($num_png);
	
								   if($num_png>0){
									   $format= ".png";
									   $imagen = $row['imagen'];
									 $path_imagen = 'minifig/'.$row['cve_lego'].'/'.$imagen.$format;
	
										if(file_exists($path_imagen)) {
											   //echo "The file exists";
											   $foto = $path_imagen;
	
											   //convierte a webp
											   $img_webp = convert_to_webp_url($path_imagen);
												 $foto = $img_webp;
											  // var_dump($img_webp);
											   //  var_dump($row['cve_lego'].'-Conversion;');
											   
										} else {
											   //echo "The file does not exist";
	
	
	
	
												$val = rand_me();
												$foto = image_back_minifig($val);
												//var_dump($row['cve_lego'].'-NO existe;');
												
											  // $foto = 'minifig/minifig.png';
										}	
								   }
	
	
	
							   }
	
							
							// cruce con coleccion
							$id_item_search = $row['id'].';'.$user.';'.$row['cve_lego']; 
							
							$datab = busca_coleccion($id_item_search ); 
							//echo($data);
							$data_coleccion = explode(';', $datab); 
							
							$faltantes = $data_coleccion[0]; 
							$fecha_reg = $data_coleccion[1];
							$estado_coleccion = $data_coleccion[2]; 
							$fav = $data_coleccion[3];
							$id_reg_col = $data_coleccion[4]; 
	
							
							if($estado_coleccion==0 or $estado_coleccion == ""){
								$class_coleccion = 'no-show';
							}else{
								$class_coleccion = ""; 
							}                     
							
							/// Ico favorito
							$id_item = $row['id'].';'.$user;
	
							if($fav==0){
								$ico_fav = '<button type="button" onclick="edita_fav(\''.$id_item.'\')" style="position::absolute; top: 1px; right:1px; " class="btn btn-icons btn-outline-secondary btn-rounded " id="ico_fav_'.$id_item.'"> 
											<span > 
												<i class="fa-regular fa-heart"></i> 
											</span> 
											</button> <br>'; 
	
								$search_fav = '';
							}else{
								$ico_fav = '<button type="button" onclick="edita_fav(\''.$id_item.'\')" style="position::absolute; top: 1px; right:1px; " class="btn btn-icons btn-outline-secondary btn-rounded " id="ico_fav_'.$id_item.'"> 
										<span class="" style="color: rgba('.$color_serie.',0.9);" > 
											<i class="fa-solid fa-heart"></i> 
										</span>  
									</button> <br>'; 
								$search_fav = 'favorito';
	
							}
							
						
							//////////////////////////
							
							//////////////// Nombre //////////
							
						   $largo_title = strlen($row['nombre_'.$user_idiom]); 
							if($largo_title <= 20){
							   $fontsize = '24px';
							   $class_tamfont = 'txt_large'; 
							   $param = 'nomcorto';
							   }else{
							   $fontsize = '20px';
							   $class_tamfont = 'txt_small'; 
							   $param = 'nomlargo';
						   }
							
							/////////////////////
							
	
							$parp_ant = $class_parp; 
							// Funcion apara parpadeo de imagen
							
							$class_parp = rand_parpadeo(); 
							
							
							if($class_parp == $parp_ant ){
								$class_parp = rand_parpadeo(); 
							}
							
							/////// Determin funcion para editar fig 
							
							if($GLOBALS['user'] == 1){ // admin
								$fx_edita = 'edita_toggle(1)'; 
							}elseif($GLOBALS['user']==0){
								$fx_edita = 'edita_toggle(2)'; 
							}
							
							
							/////////////
							/////////// Tipo de serie 
							
							$tipo_serie = get_tipo_serie($row['cve_lego']);
							if($tipo_serie == 1){
								$label_tipo = 'consecutiva'; 
							}else if($tipo_serie == 2){
								$label_tipo = 'tematica';
							}elseif ($tipo_serie == 3){
								$label_tipo = 'opcional';
							}
							
							
							/////////////
							$item_buscado = busca_item($id_item);
							
							$data_itemb = explode('|',$item_buscado);
							$estado_itm = $data_itemb[0];
							$id_itm_coleccion = $data_itemb[1];
							$fecha_coleccion = $data_itemb[2];
												 
							/// $view : 1. Coleccion ; 2. Edita serie; 3. Todas
							
							//var_dump($view);
							
							switch ($view){
								
								case 1: //Shelf
									$fx_coleccion = ' onclick="item_select(\''.$row['id'].'\');" '; 
									$class_edita = ''; 
									$tamanio_card =3;
									$no_show_class = '';
									$tam_letra ='';
									$margin = 'margin: 5px 0 5px 0px; ';
									$bg_name = 'background: rgba(200,200,200,0.0); '; 
									$bg_hover = ''; 
									$fx_todas = '';
									$fx_select ='';
									$ico_add = ''; 
								
									if($estado_itm ==1){
										$value_item = 1; 
										$class_item = 'active_image';
										$class_star = 'active_star';
										$total_collect = $total_collect + 1; 
										$item_collected= $item_collected . $row['id'].';';
										$tag_status ="tengo";
										$estado_coleccion = 1;
										
										$ico_star = '<i  class="fa fa-star "> </i>';
										
										$ico_collect_stat = '<span style="color: rgba(64, 235, 52,0.7);"><i class="far fa-dot-circle  "></i> [found...] '; 
										
										$ico_coleccion_add = 'fa-solid fa-circle-minus';
										$color_ico  = '250,250,250';
	
										$num_current = $num_current  + 1;
	
										 
	
									}else{
										$value_item = 0; 
										$class_item = '';
										$class_star = 'ico-option diactive_star'; 
										$tag_status ="faltan";
										$ico_star = '<i  class="fa fa-star "> </i>';
										$ico_collect_stat = '<span style="color: rgba(255, 0, 0,0.7);"> <i class="fa fa-dot-circle  "></i> [missing...] </span>'; 
										$estado_coleccion = 0;
										
										$ico_coleccion_add = 'fa-solid fa-circle-plus';
										$color_ico  = $color_text;
										$num_current  = $num_current + 0;
									} 
									
								
								$cve_act = $row['cve_lego'];
								
	
								
								if($cve_act != $cve_ant){
								
									if($css_user == 'tech'){
										$css .= '
	
										.bubble_text{
											 background: rgba(122,222,255,0.2);
											 '.$border.';
											 color: rgba(0,0,0,0.5); 
										 }'; 
										
									}else{
										
										$css.='
										.bubble_text_'.$row['cve_lego'].'{
											 background: rgba('.$color_serie.',0.6);
											 color: rgba('.$color_text.',0.9);
											 '.$border.';
										 }
										';
									
									}
	
								 
								 }
								 $cve_ant = $cve_act; 
								 
								 $option_edita='';
											  
								break; 
								
								case 2: // edita Serie
								
										$rgba = rand_rgb(); 
										$class_edita = ' no-show '; 
										$fx_coleccion = ''; 
										$class_star .= ' no-show';
										$fx_todas = '';
										$fx_select = '';
										$class_item = 'active_image';
										$tamanio_card =3;
										$no_show_class = ' no-show ';
										$tam_letra = 'font-size: 12px; '; 
										$margin = 'margin: 2px 0 5px 0px; ';
										$bg_name = 'background: rgba(255,255,255,0.0); border-radius: 3px; padding: 2px 3px; ';
										$bg_hover = 'background: rgba('.$rgba.',0.6); width: 0%;'; 
	
	
								$perfil = $GLOBALS['user_perfil'];
								 $permiso_elimina = get_permiso_config('2', $perfil);
								 
								 if($permiso_elimina==1){
	
									$btn_elimina = '
										<span class="ico-option '.$class_sesion.'"  onclick="busca_item_colecciones(\''.$row['id'].'\'); " >
											<i class="fas fa-trash" ></i>
										</span>'; 									 
								 }else{
	
									$btn_elimina = '';
	
																 
								 }
	
								$admin_tools = $btn_elimina;
										
					
					$option_edita='
					<span class="ico-option '.$class_sesion.'"  onclick="'.$fx_todas.' edita(\''.$row['id'].'\'); crea_piezas(\''.$row['id'].'\'); '.$fx_edita.' '.$fx_select.'  " > 
						 <i class="fas fa-pencil-alt" ></i>
					</span>
					';
								
								break; 
								
								case 3: // Todas las figuras
								
									$fx_coleccion = ' onclick="item_select(\''.$row['id'].'\');" '; 
									$class_edita = ''; 
									$tamanio_card =3;
									$no_show_class = '';
									$tam_letra ='';
									$margin = 'margin: 2px 0 5px 5px; ';
									$bg_name = 'background: rgba(200,200,200,0.0); '; 
									$bg_hover = ''; 
									$fx_select = 'genera_select_todas(\''.$row['id'].'\');';
									
								
									if($estado_itm ==1){
										$value_item = 1; 
										$class_item = 'active_image';
										$class_star = 'active_star';
										$total_collect = $total_collect + 1; 
										$item_collected= $item_collected . $row['id'].';';
										$tag_status ="tengo";
										$estado_coleccion = 1;
										
										$ico_star = '<i  class="fa fa-star "> </i>';
										
										$ico_collect_stat = '<span style="color: rgba(64, 235, 52,0.7);"><i class="far fa-dot-circle  "></i> [found...] '; 
									}else{
										$value_item = 0; 
										$class_item = '';
										$class_star = 'ico-option diactive_star'; 
										$tag_status ="faltan";
										$ico_star = '<i  class="fa fa-star "> </i>';
										$ico_collect_stat = '<span style="color: rgba(255, 0, 0,0.7);"> <i class="fa fa-dot-circle  "></i> [missing...] </span>'; 
										$estado_coleccion = 0;
									} 
									
								
								$cve_act = $row['cve_lego'];
								
								if($cve_act != $cve_ant){
								
									if($css_user == 'tech'){
										$css .= '
	
										.bubble_text{
											 background: rgba(122,222,255,0.2);
											 '.$border.';
											 color: rgba(0,0,0,0.5); 
										 }'; 
										
									}else{
										
										$css.='
										.bubble_text_'.$row['cve_lego'].'{
											 background: rgba('.$color_serie.',0.6);
											 color: rgba('.$color_text.',0.9);
											 '.$border.';
										 }
										';
									
									}
	
								 
								 }
								 $cve_ant = $cve_act; 
								 
								 
								 // TODAS 
								 
								 $fx_todas = 'pasa_serie(\''.$row['id'].'\');';
								 $ids = get_ids_current($row['cve_lego']);
								 $todas_minifig = $result->num_rows;
	
								 $option_edita='';
								 
								break; 
								
								default: 
									$class_edita = ''; 
									$fx_coleccion = '';
									$tamanio_card = 3; 
									$bg_hover = ''; 
									$fx_todas = ''; 
									$option_edita='';
								break;
							}
	
								// get Extras
								$item = $user.';'.$row['id'];
								$extra = get_extras($item);
								
								/////
																				 
							if( $row['estado'] == 1){
								$btn_estado = '<i class="fas fa-toggle-on"></i>'; 
								$class_edo = "btn_activo"; 
								$alt_btn = "Presiona para ocultar esta Minifigura";
							   // $ico_coleccion = 'fa-solid fa-circle-plus';
								
							}else{
								$btn_estado = '<i class="fas fa-toggle-off"></i>'; 
								$class_edo ="ico-option";
								$alt_btn = "Presiona para mostrar esta Minifigura";
								//$ico_coleccion = 'fa-solid fa-circle-minus';
								
							}
	
								// Valida que exista la imagen webp
	
						
							
							$id_item_general = $row['cve_lego'].'-'.$row['imagen'];
							$nombre_serie = busca_serie($id_item_general);
							$total_figs = get_total_minifig($row['cve_lego']);
							
							$tags = str_replace(", ", "- -", strtolower($row['tags']));
							$tags = str_replace(",", "- -", strtolower($row['tags'])); 
						   // $tags = str_replace(" ", "-", $tags);
							//$tags = str_replace("-","- -",$tags);
							
							$nom = str_replace(",", "- -", strtolower($row['nombre_es']));
							//$nom = str_replace(" ", "-", $nom);
							//$nom = str_replace("-","- -",$nom);
	
							$nomb = str_replace(",", "- -", strtolower($row['nombre_en']));
							//$nomb = str_replace(" ", "-", $nomb);
							//$nomb = str_replace("-","- -",$nomb);
							
	
							$nom = quita_acento($nom);
							
							// Comprueba que exista folleto
							
							$path_folleto = 'assets/images/sheet/';
							$file_folleto = $path_folleto.$serie_img.'.jpg';
								
								if(file_exists($file_folleto)){
									//echo "The file exists";
									$foto_folleto = $path_folleto.$serie_img.'.jpg';
								} else {
									
									if(file_exists($path_folleto.$serie_img.'.png')){
										//echo "The file exists";
										$foto_folleto= $path_folleto.$serie_img.'.png';
									}else{
									//echo "The file does not exist";
										$foto_folleto = 'assets/images/noimage.png';			
									}
							
								}
		
		//////
		
																
							$search= '-'.$row['id'].'- -'.$nom.'- -'.$nomb.'- -'.$num.'- -'.strtolower($nombre_serie).'- -'.$tags.'- -'.$tag_status.'- -'.$param.'- -'.$label_tipo.'- -'.$search_fav.'-';
							 
							$mnu = $_GET['mnu']; 
							$ref = $_GET['ref']; 
							$cve = $_GET['cve']; 
							
	///INFO DEBUG
	if($debub==1){
	$code_show = '<span id="codev_'.$row['id'].'"  class="text-clear" style="position: absolute; font-size:9px;">
	ID-COL:'.$row['id'].'<br>
	'.$code_serie_acceso.' <br>
	'.formatFechaHora($fecha_coleccion).'
	</span>';
	}else{
	$code_show = '<span id="codev_'.$row['id'].'" class="text-clear" style="position: absolute; font-size:9px; display:none;">
	ID-COL:'.$id_itm_coleccion .'<br>
	ID-ITM:'.$row['id'].'<br>
	'.$code_serie_acceso.' <br>
	'.formatFechaHora($fecha_coleccion).'
	</span>';
	}
							
							
							echo '<script type="text/javascript">
							
							</script>';
							 
							$grid_body .= '
										 
			  <card class="col-md-'.$tamanio_card.' grid-margin stretch-card" id="holdcard-'.$row['id'].'" searchable="'.$search.'" >
			   
				   
			   
				<div class="card card_figura" id="card-'.$row['id'].'" >
				<div class="back-color" style="'.$bg_hover.' " > </div>
				
				'.$debug_card.'
				
				
				
				<div class="item_dec stat" > <span class="parpadeab text"> '.$ico_collect_stat.' </span> </div>
					<div class="hover_imagen" '.$fx_coleccion.'  onmouseover="toggle(\'ico_add_minifig_'.$row['id'].'\');"  onmouseout="toggle(\'ico_add_minifig_'.$row['id'].'\')" >
					<div class="item_dec dec_a" ></div>
					<div class="item_dec dec_b" ></div>
					<div class="item_dec dec_c" ></div>
					<div class="item_dec dec_d" ></div>
					<div class="item_dec dec_e" ></div>
				
				</div>                
				
				<div class="imagen" style="width:38%; flex-grow:1;" > 
				
					<div style="border:0px solid #c4d;" class="picture_hold" onmouseover="toggle(\'ico_add_minifig_'.$row['id'].'\');"  onmouseout="toggle(\'ico_add_minifig_'.$row['id'].'\')"  >
						
						<div id="ico_add_minifig_'.$row['id'].'" style="position:absolute; width:50%; height:50%; top:35%; background:rgba(23,23,23,0.0); z-index:1110; text-align:center; margin-left:50%; left:-25%; display:none;" '.$fx_coleccion.' > 
							
							<span class="" id="ico_add_'.$row['id'].'" style="margin-top:50%; top:50%; color: rgba('.$color_ico.',0.9); " >
								<i class="fa-solid '.$ico_coleccion_add.' fa-2x"></i> 
							</span>
						</div>
						
						
						<img id="'.$row['id'].'" '.$fx_coleccion.' src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'" class="picture '.$class_parp.' '.$class_item.'" style="'.$margin.' padding:1px; "  >
	
					</div>
	
					<div class="table_fig"></div>
				
				</div>
				
				  <div class="card-body-figura">
				  
					  <div class="hold_options "  >
							  
							  <div style="position:absolute; top:2%; right:5%; z-index:999; ">
								  '.$ico_fav.' 
							  </div>
	
							  <span class="numero_item" style=""> 
								  <span class=" prompt_item"> 
									  itm: <span class="parpadea" >_</span> 
								  </span>
	
								  <span class="num_itm_big"  > '.$num.' </span>
	
							  </span>
	
							'.$option_edita.'
							'.$admin_tools.'
					  </div>
				  
				 
				  
				  <div class="variables no-show">
				   <textarea class="form-control no-show" id="piezas-chk-'.$row['id'].'" rows="2"> '.$check_piezas.'</textarea>
					  <input type="hidden" value="'.$row['nombre_es'].'" 	id="item-'.$row['id'].'" >
					  <input type="hidden" value="'.$value_item.'" 			id="estado-'.$row['id'].'" >
					  <input type="hidden" value="'.$num.'" 				id="numero-'.$row['id'].'" >
					  <input type="hidden" value="'.$index.'" 				id="index-'.$row['id'].'" >
					  <input type="hidden" value="'.$row['id'].'" 			id="id-'.$row['id'].'" >
					  <input type="hidden" value="'.$row['cve_lego'].'-'.$row['imagen'].'" id="sku-'.$row['id'].'" >
					  <input type="hidden" value="'.$nombre_serie.'-'.$row['cve_lego'].'" id="serie-'.$row['id'].'" >
					  <input type="hidden" value="'.$nombre_serie.'" 		id="serie-nombre-'.$row['id'].'" >
					  <input type="hidden" value="'.$row['cve_lego'].'" 	id="clave-'.$row['id'].'" >
					  <input type="hidden" value="'.trim($row['nombre_es']).'" id="nombre_es-'.$row['id'].'" >
					  <input type="hidden" value="'.trim($row['nombre_en']).'" id="nombre_en-'.$row['id'].'" >
					  <input type="hidden" value="'.$path_imagen.'" 		id="url-'.$row['id'].'" >
					  <input type="hidden" value="'.$faltantes.'" 			id="faltantes-'.$row['id'].'" >
					  <input type="hidden" value="'.$fecha_reg.'" 			id="fecha-'.$row['id'].'" >
					  <input type="hidden" value="'.$row['fecha_registro'].'" 			id="fechahora-'.$row['id'].'" >
					  <input type="hidden" value="'.$row['no_folleto'].'" 	id="folleto-'.$row['id'].'" >
					  <input type="hidden" value="'.$row['tags'].'" 		id="tags-'.$row['id'].'" >
					  <input type="hidden" value="'.$row['piezas'].'" 		id="pieces-'.$row['id'].'" >
					  <input type="hidden" value="'.$extra.'" 				id="extras-'.$row['id'].'" >
					  <input type="hidden" value="'.$estado_coleccion.'" 	id="status-coleccion-'.$row['id'].'" >
					  <input type="hidden" value="'.$ids.'" 				id="ids-current-'.$row['id'].'" >
					  <input type="hidden" value="'.$total_figs.'" 			id="total-fig-'.$row['id'].'" >
					  <input type="hidden" value="'.$todas_minifig.'" 		id="total-general-'.$row['id'].'" >
					  <input type="hidden" value="'.$color_serie.'" 		id="color-'.$row['id'].'" >
					   <input type="hidden" value="'.$colorb_serie.'" 		id="colorb-'.$row['id'].'" >
				  </div>
				  
					<h4 class="card-title-figura" style="'.$bg_name.'" >
						<span class="'.$class_tamfont.' " style="color: rgba('.$color_text.',0.9); color: rgba(50,50,50,0.8);"  id="lblname-'.$row['id'].'" >'.ucwords($row['nombre_'.$user_idiom]).' </span>  
					</h4>
					
	
					
					
					
					<div class="media">
					  <div class="media-body">
					  
						<p class="card-text">
						
						<span class="'.$no_show_class.'" >
						<span class="bubble_text  bubble_text_'.$row['cve_lego'].'" onclick="toggle(\'codev_'.$row['id'].'\')" >'.$nombre_serie.'</span>
						<span class="bubble_text  bubble_text_'.$row['cve_lego'].' " style="margin-left: 3px;" >'.$row['cve_lego'].'</span> 
						<span class="no-show bubble_text  bubble_text_'.$row['cve_lego'].' " style="margin-left: 3px;" >'.$class_parp.'</span> 
	
	
	
						<br>
							'.$code_show.'
						</span>                     
							
						</p>
						
					  </div>
					</div>
				  </div>
				</div>
			  </card>
			  ';
							
	
							
							}
							
							$last = $current; 
							$current = ''; 
	
							$data_color = get_info_serie($row['cve_lego']);
							
							$data = explode('/', $data_color);
							
							$nombre_serie = $data[0];
							$color_serie = $data[1];
							$fecha_serie = $data[2];
							$precio_serie = $data[4];
							$moneda_serie = $data[5];
							$desc_serie = $data[6];
							$colortxt_serie = $data[13];
							$colorb_serie = $data[14];    
						   }
						
						echo '<style>'.$css.'</style>';
						
						
							
	}else{
	//	echo 'No hay registros que mostrar.';
	//	include("inicio.php"); 
	//$grid_body = '<h3> No hay minifiguras para esta opción </h3>';
	//$progressbar
	}
	
	
	// Progress Info 
	if($serie!=1){ // solo se ejecuta si se llama a una sola serie
	
	$porcent = ($num_current*100)/$num;
	$total_serie = $num;
	
	$width_porcent = 100/$num;
	
	for($i=0;$i<$num; $i++){
	
		if($i == 0){
				$round= 'border-radius: 10px 0 0 10px; '; 
		}else{
			$round= ''; 
		}
	
		if($i< $num_current){
			$bck_color = ' background: linear-gradient(90deg, rgba('.$color_serie.',1) 35%, rgba('.$color_serie.',1) 100%); ';
		}else{
			$bck_color = ' background: rgba('.$colorb_serie.',0.1); ';
		}
		
		$cuenta = $i+1;
	
		$txt_barra ='<div class="" style="width:100%; font-size:12px;  color: rgba('.$color_text.',0.9); margin: 0px 10px; float: right;"> '.$cuenta.' </div>';
		
		$barra.= '<div class="seccion-barra" style="'.$round.' text-align:right; border-left:1px solid rgba('.$color_serie.',0.5); border-right:1px solid rgba('.$colorb_serie.',0.5); margin-top:2px; '.$bck_color.' height:20px; width:'.$width_porcent.'%";  >'.$txt_barra.'</div>';
	}
	
	$hold_barra = '<div class="row hold-barra" id="hold_barra_serie" style="border:0px solid #c30; "> '.$barra.'</div>';
	
	if($num_current == $num){
		$color_copa = 'background: rgba('.$color_serie.',1); ' ; 
	}else{
		$color_copa = 'background: rgba('.$colorb_serie.',0.1); ' ; 
	}
	
	$id_config = 1; 
		$config_barra = get_estado_config($id_config,$GLOBALS['user']); 
	
		if($config_barra==1){
			$display_barra = 'display: flex; '; 
		}else{
			$display_barra = 'display: none; '; 
		}
	
	$div_list = '<div class="border ; " style="background: rgba(23,23,23,0.9); left:0%; position:absolute; z-index:999999932499; color:#fff; "> 
					<div style="height: 400px: overflow:auto; scroll-y:hidden">'.$list.'</div>
					
					</div>'; 
	
	// Valida QR de la serie 
	$cve_user_serie = $serie.'_'.$user; 
	$nombre_fichero = 'assets/images/qr_coleccion/col_'.$cve_user_serie.'.webp';
	
	if (file_exists($nombre_fichero)) {
	
	$codigo_qr = '<img style="height:70px;" class="qr_col_gral" id="qr_public_'.$serie.'" src="data:image/webp;base64,'.base64_encode(file_get_contents($nombre_fichero)).'" name="current" />'; 
	
	} else {
	
	$nombre_fichero_png = 'assets/images/qr_coleccion/col_'.$cve_user_serie.'.png';
	
	if (file_exists($nombre_fichero_png)) {
			$qr_webp = convert_to_webp_url_gral($nombre_fichero_png);
	}else{
	
	$path_site = $GLOBALS['path_site']; 
	
		$url_ext = $path_site.'public.php?mnu=ad6051826fd849981914ccaddb7e5107&item='.$serie;
	
		//$qr_png= genera_qrcode_public_set($url_ext,$codigob);
		$qr_png = genera_qrcode_coleccion($url_ext,$cve_user_serie);
		//genera_qrcode_coleccion($content,$cve_user_serie){
		$qr_webp = convert_to_webp_url_gral($qr_png);
	}
	
	//src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'"
	
	$codigo_qr = '<img style="height:70px;" class="qr_col_gral" id="qr_public_'.$serie.'" src="data:image/webp;base64,'.base64_encode(file_get_contents($qr_webp)).'" name="nuevo" />'; 
	}
	
	//
	
	
	
	
	$space = '
	<div style="width: 100%; position: relative; height: 30px; margin: 0px; display: block; background: rgba(28,75,234,0.0);"></div>
	
							<div class="col-lg-12 text-clear no-show" style="text-align:center;" >
								<span onclick="toggle(\'toggle_code\')">
								<i class="fa fa-eye"></i>
								</span>
							
								<div id="toggle_code" class="no-show">
									'.$debug.'
								</div>
							</div>'.$div_list;
	
	
	$progressbar = '
	<div class="row">
	<div class="col-md-10 margin-grid border-bottom" id="hold_coleccion" style="'.$display_barra.' background: rgba(160,160,160,0.08);" >
		<div class="col-md-11 bg-muted" style="display: block; padding: 5px 5px 8px 10px; text-align: center; border-radius: 25px; width: 100%; margin:27px 40px 27px 40px; padding: 5px 22px; border-bottom:1px solid #ddd; ">
				'.$hold_barra.'
		<div id="hold_copa">
				<div class="circle-award" style="border: 0px solid #ccc; text-align:center; vertical-align:middle; z-index:997; background:#ddd; position: absolute; right: -25px; top: -13px; padding:15px; width:60px; height:60px; border-radius:30px; font-size:30px; color: #aaa; ">
	
					<button type="button"  style="border: 0px solid #ccc; text-align:center; vertical-align:middle; z-index:997; '.$color_copa.' position: absolute; left: 0px; top:0px; padding:15px; width:60px; height:60px; border-radius:30px; font-size:30px; color: #aaa; " class="btn btn-icons btn-outline-secondary btn-rounded "> 
						<span class="" style="margin-left:0px; margin-top:-11px; color: rgba('.$color_text.',0.9);"> 
							<i class="fa-solid fa-award"></i> 
						</span>  
					</button>
			</div>
		</div>
	
					<div class=""  >
						<input type="hidden" id="total_serie_fig" value="'.$total_serie.'">
						<input type="hidden" id="total_current" value="'.$num_current.'">
						<input type="hidden" id="color_serie" value="'.$color_serie.'">
						<input type="hidden" id="colorb_serie" value="'.$colorb_serie.'">
						<input type="hidden" id="colortxt_serie" value="'.$colortxt_serie.'">
						
					</div> 
		</div>
	
		<div class="col-md-12" style="height:30px;"> </div>
	</div>
	
	<div class="col-md-2 margin-grid border-bottom" style="'.$display_barra.' " >
		<div style="margin-top:8px;">'.$codigo_qr.'</div>
	</div>
	</div>
	 ';                
	}
	return $progressbar.$space.$grid_body;
	
	}

///////////

function genera_csv_minifig_extra($id_grupo,$user_id){

	include("globals.php");
	include("access.php");
	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
	if ($dbh->connect_error) {
		   die("Connection failed: " . $dbh->connect_error);
	}
	
	// info grupo							
		$hoy = date("Y-m-d s");
		$hoy_format = str_replace('-', '', $hoy);
		$hoy_format = str_replace(' ', '_', $hoy_format);
		$hoy_format = str_replace(':', '', $hoy_format);

		if($id_grupo == 999){
			$name_serie = 'all';
			$query = ''; 
		}else{
			$name_serie = $id_grupo;
			$query = ' and clave_lego = '.$id_grupo; 
		}
																
		$filename = 'csv_files/'.$user_id.'/'.'minifig_extra_'.$name_serie.'_'.$hoy_format.'.csv';

		$qcol="select * from coleccion where id_user = $user_id and no_extra > 0 ".$query." order by clave_lego";

		$path_dir = 'csv_files/'.$user_id.'/';
								$comp_dir = is_dir($path_dir);
								
								if($comp_dir == false){
									mkdir($path_dir, 0777);
								}		
								
								eliminar_directorio($path_dir);
								

							// obtiene info del usuario
							$data_u = busca_user($user_id);
							$data_user = explode('--', $data_u);
								$error = $data_user[0];
								$nombre = $data_user[1];
								$correo = $data_user[2];
								$user_name = $data_user[3];
								$foto = $data_user[4];
								$perfil = $data_user[5];
							
							////


			    $resultcol= $dbh->query($qcol);
			
		    
			 if ($resultcol->num_rows > 0) {

				    $delimiter = ","; 
				    $no = 1;
				    
				     
				    // Create a file pointer 
				    $f = fopen($filename, 'w'); 
				     
				    // Set column headers 
				    if($perfil==1){
					    $fields = array('No','Serie', 'Clave','Nombre Figura','Extras','Fecha de Registro','Imagen'); 
				    }else{
					    $fields = array('No','Serie', 'Clave','Nombre Figura','Extras','Fecha de Registro'); 
					}
				    				    
						fputcsv($f, $fields, $delimiter); 


						while($rowc= $resultcol->fetch_assoc()){	
							
							$info_serie = get_info_serie($rowc['clave_lego']);
							
							$data_info_serie = explode('/', $info_serie);
							$nombre_serie = $data_info_serie[0];
							
							$nom_fig = get_data($rowc['item'],1);
							$pic = get_data($rowc['item'],3);
							
						if($perfil==1){
					    	$foto = $path_site.'minifig/'.$rowc['clave_lego'].'/'.$pic.'.png';
					    	
							$lineData = array($no, $nombre_serie, $rowc['clave_lego'], $nom_fig, $rowc['no_extra'], $rowc['fecha_registro'], $foto); 
				    	}else{							
							$lineData = array($no, $nombre_serie, $rowc['clave_lego'], $nom_fig, $rowc['no_extra'], $rowc['fecha_registro']);
				    	}

					        fputcsv($f, $lineData, $delimiter); 				      				       
				       		 $no = $no +1;
			    		}
							// Move back to beginning of file 
					fseek($f, 0); 
     
		    }
		   return $filename;
		   fclose($f);
		  exit; 
	}

////

function elimina_caracteres_especiales($cadena_original){

	$nueva_cadena = str_replace(array('-', '|', '?', ';', '@','\'','*'), array(' ', ' ', ' ', ' ',' ','',''), $cadena_original);

	return $nueva_cadena;
}

/////////////////

function get_impresiones($clave_lego,$id_user){
	include("access.php");
	
	
	$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
	// Check connection
	if ($dbhb->connect_error) {
	    die("Connection failed: " . $dbhb->connect_error);
	}
	
	$qb = "SELECT * FROM impresion_etiqueta_set where id_user = $id_user and clave_lego = '$clave_lego' order by no_imp desc;";
	//$qb = "SELECT * FROM impresion_etiqueta_set et INNER JOIN  where id_user = $id_user and clave_lego = '$clave_lego' order by no_imp desc;"; // preparando la instruccion sql
	//echo $qb;
      
    $resultb= $dbhb->query($qb);
    
    	if ($resultb->num_rows > 0) {
	    	
	    	$row= $resultb->fetch_assoc();

	    	$info = $row['no_imp'];	 
			 
	    }else{ // 
		    $info = '0';
	    }
	
	//$data = $total_serie; 
	return $info; 
	$dbhb->close();

}


///////////////////////////

function genera_sets_admin_perfil($user){ // check series normal

	include("access.php");
	
		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		
		if ($dbh->connect_error) {
			   die("Connection failed: " . $dbh->connect_error);
		}		
		$no = 0; 
		
			
		//$qb = "Select * FROM series WHERE tipo < 3 ORDER BY fecha_lanzamiento";
		$qb = "Select * FROM sets WHERE id_user = $user order by fecha_add desc ";
		//Select * FROM series WHERE tipo not in (select tipo from series where tipo = 3)
			$results= $dbh->query($qb);
			if ($results->num_rows > 0) {
			  
				while($row = $results->fetch_assoc()){
					$no = $no +1;
					
				
	
					// Obtiene informacion del usuario admin  (perfil)
	
					$info_user = busca_user($user);
					$data_user = explode('--',$info_user);
					$error = $data_user[0];
					$nombre = $data_user[1];
					$correo = $data_user[2];
					$user_nameb = $data_user[3];
					$foto = $data_user[4];
					$perfil_user = $data_user[5];
	
				
					$data = getinfotema($row['id_tema']); 
	                      
					$datab = explode('|', $data);
					
					$s_nombre = $datab[0];
					$s_color = $datab[1];
					$s_logo = $datab[2];
	
	
					////////
	
					 $chk_serie = '<input type="checkbox" class="chk_colecciones" id="chk_'.$row['cve_lego'].'"  value="'.$row['clave_lego'].'" /> ';
				   
	
					$permiso_restringe = get_permiso_config('32',$perfil_user);
	
					if($permiso_restringe==1){
	
								$btn_rest_b = '
								
								<button type="button" class="btn '.$btn_style.' " id="'.$row['clave_lego'].'_'.$user.'" '.$fx.' '.$permiso_restringe.'
								style="font-size:11px; text-align:center; padding:5px 10px;" value="'.$status_admin.'" > 	
								<i class="'.$per_icon.'"></i> '.$lbl_btn.' </button>
								'; 
					}else{
	
								$btn_rest_b = '
								
								<button type="button" class="btn '.$btn_style.' " disabled id="'.$row['clave_lego'].'_'.$user.' '.$permiso_restringe.' " 
								style="font-size:11px; text-align:center; padding:5px 10px;" value="'.$status_admin.'" > 	
								<i class="'.$per_icon.'"></i> '.$lbl_btn.' </button>
								'; 
					}
	
					
					if($status_user != -1){
						
		
						$forms .= '
						<div class="form-check form-check-flat border-bottom " style="padding-bottom:5px; padding-top:5px;" >
							
							
							<input type="hidden" '.$stat.' class=""  id="chkk_serie_'.$row['clave_lego'].'_'.$user.'" value="'.$status_admin.'" '.$val.'> 
								
							<div class="row" >
								<span class="col-md-4 text-muted" title="Solo el usuario puede seleccionar la serie."  style="padding:2px 3px; font-size:14px; text-align:left; width:10%"> 	
								<i class="'.$ico_user_select .' '.$color_status.'"></i> <span class="'.$color_status.'" style="margin-left:3px; margin-top:5px;  " >'.$label_status.'</span>
								</span>
														
								<div class="col-sm-3 btn-group">
								'.$btn_rest_b.'
								</div>
								
								<span style="font-size:13px; margin-left:3px; margin-top:5px;  " class="col-sm-4 '.$text.'" > '.$row['clave_lego'].' - '.$row['nombre'].' '.$ico_info .'</span>
							</div>
														
						</div>
					';
								
					
					}
	
			$path_img = 'assets/images/sets/';
            $img_set = $path_img.$row['cve_lego'].'.webp';
            $img_prev = '<img class="zoom" id="img_set_'.$row['cve_lego'].'" src="data:image/png;base64,'.base64_encode(file_get_contents($img_set)).'" style="width: 35px; " />';

					$len_name = strlen($row['nombre']); 
					$len_permited = 25;

					if($len_name >$len_permited){
						$nom = substr($row['nombre'],0,$len_permited).'...';
					}else{
						$nom = $row['nombre'];
					}
	
					$fecha_actualiza = '<span style="font-size:0.7rem;">'.formatFechaHora($row['fecha_add']).'</span>';
		    
			$info_grupo = getinfogrupo($row['grupo']);
            $data_grupo = explode('|',$info_grupo);
            $nom_gpo = $data_grupo[0];

            if($row['grupo']!=0){
                $ico= '<span class="text-primary" >  '.$nom_gpo.'</span>'; 
            }else{
                $ico= '<span class="text-muted"> '.$nom_gpo.'</span>'; 
            }

            $info_gpo = '  <span class="text-muted" style="font-size: 0.6rem; padding:3px 2px;border-top:0px solid #ccc "> | '.$ico.' </span>';

			$no_impresiones = get_impresiones($row['cve_lego'],$user);

			if($no_impresiones==0){
        	$imp = '<span class="text-clear" style="margin-right:3px; font-size:0.7rem;"><i class="fa-solid fa-print"></i> </span>
        		<span id="cant_'.$row['cve_lego'].'" class="text-clear">'.$no_impresiones.'</span>';
    		}else{
        		$imp = '<span class="text-muted" style="margin-right:3px; font-size:0.7rem;"><i class="fa-solid fa-print"></i> </span>
        			<span id="cant_'.$row['cve_lego'].'" class="text-muted"> '.$no_impresiones.'</span>';
    		}

					$rows_table .= '
					
						<tr class="text-muted">
							<td class="text-muted center" > '.$chk_serie.' </td>
							<td class="text-muted center" > '.$no.' </td>
							<td class="text-muted center"> '.$row['cve_lego'].'  </td>
							<td class="text-muted"> 
								<div class="row">
									<div class="col-sm-3">'.$img_prev.'</div>
									<div class="col-sm-6">
										'.$nom.' <br>
										<span class="text-muted" style="font-size:0.7rem;">'.$s_nombre.'</span> '.$info_gpo.'
									</div>
								</div> 
							
							</td>
							<td class="text-muted center"> '.$fecha_actualiza.' </td>
							<td class="text-muted center">  '.$imp.'</td>
							
						</tr>
					'; 
									
				  
				}
			}else{
				$rows_table .= '<tr class="text-muted center">
					<td colspan="6"> <span class="text-muted"> Sin Registros</span> </td>
				</tr>';
			}
			
		//	$forms = $forms.'<input type="hidden" id="current_series_op_conf_'.$user.'" value="'.$series_op.'" >';
		
			 //$campo_buscar = crea_campo_buscar('series_reg');
			 $campo_buscar = crea_campo_buscar_cust('series_reg',3); 
	
			$forms = '
			
						<input type="hidden" class="col-md-3 form-control" id="user_series_selected" value="" />
						<input type="hidden" class="col-md-3 form-control"  id="all_series" value="'.$series_op.'" />
						
	
						<table id="series_reg" class="table table-striped" style="background: #fff;">
						  <thead >
							<tr>
								<th class="thead_content"  > 
									<input type="checkbox" onclick="select_all_checks(\'colecciones\');" class="" id="chk_all_colecciones" value="99" > 
								</th>
								<th class="thead_content"  > No  </th>
								<th class="thead_content" > Clave </th>
								<th class="thead_content" > Coleccion </th>							
								<th class="thead_content" > Agregado </th>
								<th class="thead_content" > Imp. </th>
								
							</tr>
						  </thead>
						  <tbody>
								  '.$rows_table.'
						  </tbody>
						  <tfooter >
							<tr>
								<th class="thead_content"  >  </th>
								<th class="thead_content" > No  </th>
								<th class="thead_content" > Clave </th>
								<th class="thead_content" > Colección </th>							
								<th class="thead_content" > Estado </th>
								<th class="thead_content" > Imp. </th>
								
							</tr>
						  </tfooter>                      
						  
						  
						</table>
			
			
			';
	
	
					
			return $campo_buscar.$forms;
			
			//return $qs;
		$dbh->close();
	
	
	}

	function genera_select_edo_col($current){

		include("access.php");
		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		
		if ($dbh->connect_error) {
			   die("Connection failed: " . $dbh->connect_error);
		}
		
			
			$qc = "SELECT * FROM estado_colect_set where estado = 1";// preparando la instruccion sql
				
				//var_dump($current);
			$resultc= $dbh->query($qc);
			
				if ($resultc->num_rows > 0) {			
					while($rowc= $resultc->fetch_assoc()){
						
						
		
							if($current==$rowc['clave']){
								$atr .= '<option value="'.$rowc['clave'].'" selected > '.$rowc['nombre'].'</option>'; 
							}else{
	
								$atr .= '<option value="'.$rowc['clave'].'" > '.$rowc['nombre'].'</option>'; 
							}			
								
					}	   
			
					$seletct= $atr;
					 
				}else{
					$atr = 'Sin Registros'; 
				}
		
			
			
			return $seletct;
		}

	function generafolioinv(){

		$hoy = date('Ymd');

		$clave = $hoy;
		$rand = random_int(1,100);

		$len_rand= strlen($rand);
		//var_dump($len_id_serie);

			if($len_rand==1){
				$num_rand = '00'.$rand;
			}elseif($len_rand==2){
				$num_rand = '0'.$rand;
			}else{
				$num_rand = $rand;
			}

		

		return $clave.$num_rand.'-'.$rand;

	}


	function valida_consec($num){

		include("access.php");
		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		
		if ($dbh->connect_error) {
			   die("Connection failed: " . $dbh->connect_error);
		}
		
			
			$qc = "SELECT * FROM invitaciones where consecutivo = $num";// preparando la instruccion sql
				
				//var_dump($current);
			$resultc= $dbh->query($qc);
			
				if ($resultc->num_rows > 0) {
					$res = 1;					 
				}else{
					$res = 0; 
				}
			
			return $res;

	}
	

	function crear_invitacion($id_invitacion,$formato){
		include("access.php");
	
	
		$dbhb= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		  //informacion de acceso a la bd
		// Check connection
		if ($dbhb->connect_error) {
			die("Connection failed: " . $dbhb->connect_error);
		}
		
		$qb = "SELECT * FROM invitaciones where id = $id_invitacion;";
		//$qb = "SELECT * FROM impresion_etiqueta_set et INNER JOIN  where id_user = $id_user and clave_lego = '$clave_lego' order by no_imp desc;"; // preparando la instruccion sql
		//echo $qb;
		  
		$resultb= $dbhb->query($qb);
		
			if ($resultb->num_rows > 0) {				
				$row= $resultb->fetch_assoc();

				$info_cupon = get_info_cupon_id($row['id_cupon']);
                         $data_cupon = explode('|',$info_cupon);
                         $title = $data_cupon[8];

						 		$nombre_fichero = 'assets/images/qr_invitacion/'.$folio.'.webp';
		
								if (file_exists($nombre_fichero)) {
									$url = $GLOBALS['path_site'].'assets/images/qr_invitacion/'.$row['folio'].'.webp';
								}else{
									$url = $GLOBALS['path_site'].'assets/images/qr_invitacion/qr_site.png';
								}
						 
						 
						 //src="data:image/png;base64,'.base64_encode(file_get_contents($url)).'"

						 if($formato =='XL'){
							$txt_body = '1.5rem';
							$txt_note = '1.5rem'; 
							$txt_cursive = '9.5rem';
							$line_cuersive = '9.8rem'; 
							$height_cuersive='-13%'; 
							$left_cursive = '18%';
							$txt_head = '1.8rem'; 
						 }else{
							$txt_body = '1rem'; 
							$txt_note = '0.8rem'; 
							$txt_cursive = '5.5rem';
							$line_cuersive = '6.5rem';
							$height_cuersive='-34%';
							$left_cursive = '22%';
							$txt_head = '0.9rem'; 
						 }
	
				$info = '
				
				<div class="" id="hold_invitacion" style="width:97%; padding: 0px; margin:0px auto;  background:rgba(255,255,255,1);">
					<input type="hidden" id="name_invitacion" value="INV_'.$row['folio'].'" >
                        <div class="row">
                            <div class="col-6 " style="border-right:0px dotted #ccc;">
                                <div class="col-12 " style="padding:5px; text-align:left; font-family:\'Montserrat\'; font-weight:200; margin-left:10px; font-size:'.$txt_head.'; "> ACCESO EXCLUSIVO
								</div>
                                
								<div class="col-12 center">
                                    <h3 class="text-success" style="font-size:'.$txt_cursive.'; line-height:'.$line_cursive.'; font-family:cursive_title; padding:10px; font-weight:500;">Gracias</h3>									                                        
                                </div>

								<div class="col-12 center" style="margin-top:'.$height_cuersive.'; margin-left: '.$left_cursive .'; ">
                                    <h3 class="text-success" style="font-size:'.$txt_body.'; line-height:'.$txt_body.'; font-family:\'Montserrat\'; padding:10px; font-weight:500;"> por tu compra </h3>									                                        
                                </div>

                                  <div class="col-12 center" style="margin-top:15%;">
                                    <p style="font-size:'.$txt_body.'; line-height:'.$txt_body.'; font-family:\'Montserrat\'; ">
									Te regalamos un cupón para canjear en una colección</p>
                                  </div>
                                  <div class="col-12 center" style="font-size:'.$txt_body.'; margin-top:10px; margin-bottom:30px;">
                                   CÓDIGO: 
								   <span style="font-size:'.$txt_body.'; font-family:\'Montserrat\'; font-weight:600; ">'.strtoupper($title).'</span>
                                  </div>

                            </div>
                            <div class="col-6">
                                <div class="col-12" style="padding:5px; text-align:right;"> <span class="text-muted" style="margin-right:10px;">FOLIO:</span><br> 
								 <code style="margin-right:10px; font-size:'.$txt_head.';">
								 '.$row['folio'].'</code></div>
                                <div class="col-12" style="text-align:center; margin-top:10px;">
                                    <img class="col-12" src="data:image/png;base64,'.base64_encode(file_get_contents($url)).'" style="width:45%; margin:0px auto; margin:5%;" >
                                </div>
                                <div class="col-12 center">
                                
                                <p style="padding: 5px 15px; text-align:center; font-size:'.$txt_note.'; line-height:'.$txt_note.'; font-family:\'Montserrat\';">Escanea, registrate y prueba la version de escritorio beta.</p>
                                
                                  </div>
                            
                                
                            </div>
                        </div>
                        <div class="col-12 bg-success text-light center border" style="padding:5px; font-family:\'Montserrat\'; font-weight:600;"> 
						'.$GLOBALS['sitio_web'].'
						</div>
                    </div>
				
				';
				 
			}else{ // 
				$info = '<div class="col-12 center">
                                
                                <p style="padding: 5px 15px; text-align:center; font-size:1.5rem; line-height: 1.6rem; font-family:\'Montserrat\';"> Invitacion no encontrada </p>
                                
                                  </div>';
			}
		
		//$data = $total_serie; 
		return $info; 
		$dbhb->close();

	}
	////////////////////

	function admin_fotos_qr_inv($url,$permiso_perfil){
		include("globals.php");

		$sub = $_GET['sub'];
	
		$current_dir= $url; 
		
		$options = fotos_minifig_url($url);
	
		if($permiso_perfil==0){
			$perfil = $GLOBALS['user_perfil'];
		}else{
			$perfil = 1;
		}
		$permiso_ver_dir = get_permiso_config('40', $perfil);
	
		if($permiso_ver_dir==1){
			$solo_dir = listar_directorios_ruta($current_dir);
		}else{
			$solo_dir = '';
		}
		
		//var_dump($solo_dir);
								   
								   $data_opt = explode('--', $options); 
								   
								   for($i=0; $i<= count($data_opt); $i++){
									   if($data_opt[$i] != ''){
									   
									   $num = $i +1;
									   
									   if ($num%2==0){
										$class_row_color = 'bg-light';
									}else{
										$class_row_color = 'bg-secondary';
									}
									   
										   $data_file = explode('.',$data_opt[$i]); 
										   $nombre = $data_file[0];
										   $ext = $data_file[1];
										   
										   
										$permiso_elimina = get_permiso_config('41', $perfil);
	
										if($permiso_elimina==1){
											$btn_elimina = '<button class="btn btn-inverse-primary btn_thin" onclick="elimina_foto(\''.$url.$data_opt[$i].'\');" > '.$ico_global_elimina.'</button>';
										}else{
											$btn_elimina = '<button class="btn btn-inverse-primary btn_thin" disabled> 
											'.$ico_global_elimina.'
											</button>';
										}
	
										   $info_fig = get_data($serie.'-'.$nombre,$index);
										   $data_fig = explode('/', $info_fig); 
										   $nombre_es = $data_fig[0];
	
										$btn_edita = '<button onclick="barmenu(\'imagesedit_1\'); edita_img(\''.$nombre.'.'.$ext.'\')" class="btn btn-inverse-primary btn_thin" > '.$ico_global_edit.' </button>';

										$btn_ver = '<button onclick="preview_foto(\''.$serie.'/'.$data_opt[$i].'\'); " class="btn btn-inverse-primary btn_thin" > <i class="fa fa-eye" ></i> </button>';
	
										if(isset($sub)){
											//$url = 'minifig/'.$clave_lego.'/'.$sub.'/';
											$btn_archiva = '<button onclick="restaura_img(\''.$nombre.'.'.$ext.'\')" class="btn btn-inverse-primary btn_thin" > <i class="fa-solid fa-retweet"></i></button>';
	
										
										}else{
											//$url = 'minifig/'.$clave_lego.'/';
											$btn_archiva = '<button onclick="archiva_img(\''.$nombre.'.'.$ext.'\')" class="btn btn-inverse-primary btn_thin" > <i class="fa-solid fa-box-archive"></i></button>';
	
										}
										
		
									   $labels.= '
									
									
									<tr>
									
										<td style="text-align:center;"> <span class="text-muted"> '.$num.'.</span>  </td>
										<td> <span class="text-muted"> '.$data_opt[$i].' '.$ico_lock.'</span>  </td>
										<td>
											<div class="btn-group">
											   '.$btn_edita.$btn_archiva.$btn_elimina.'
											</div>
											<input type="hidden" id="current_name_'.$nombre.'" value="'.$nombre.'">
											<input type="hidden" id="current_ext_'.$nombre.'" value="'.$ext.'">
			
										</td>
									</tr>
									
									   ';
									   }					   			
									   
								   }
	
								$table_img = '<table class="table table-striped" > 
												<tbody>
													'.$solo_dir .'
													'.$labels.'
												</tbody>
												</table>';
								   
								   return $table_img; 
								   
		
	}

	function get_stats_mensual($serie,$mensualidad,$tipo){

		include("access.php");
	

		$data = explode('-',$mensualidad);
		$mes = $data[0];
		$anio = $data[1];

		$mes_current = date('m');
		if($mes == $mes_current){
			$dias_mes = date('d');
		}else{
			$dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
		}

		//$dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
		$fecha_min = $anio.'-'.$mes.'-'.'1 00:00:00';
		$fecha_max = $anio.'-'.$mes.'-'.$dias_mes.' 23:59:59';
	
		//echo '13900|1|'.$dias_mes.'||';
		
	
		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}
	
		$qc = "SELECT * FROM recibos where nombre_prod = '$serie' and (fecha_venta BETWEEN '$fecha_min' and '$fecha_max');";// preparando la instruccion sql
		//var_dump($qc);
		$total_mov = 0;
			//var_dump($current);
		$resultc= $dbh->query($qc);
		
			if ($resultc->num_rows > 0) {	
				$total_mov = $resultc->num_rows;
				$aprovados = 0; 
				$cancel = 0;
				$total_cash = 0; 

				while($rowc= $resultc->fetch_assoc()){
					
					if($tipo==1){
							$n = $n+1;
							$user_info = busca_user($rowc['id_user']);
								$data_user = explode('--', $user_info);
								$error = $data_user[0];
								$nombre = $data_user[1];
								$correo = $data_user[2];
								$user_name = $data_user[3];
								$foto = $data_user[4];
	
								

								if($rowc['estado_recibo']==1){
									//$aprovados = $aprovados + 1;
									//$ingreso = $ingreso + $rowc['precio_prod'];
									$total_cash = $total_cash + $rowc['precio_prod'];
								}elseif($row['estado_recibo']==0 or $row['estado_recibo']==3){
									//$cancel = $cancel +1;
									//$ingreso_desc = $ingreso_desc - $rowc['precio_prod'];
									$total_cash = $total_cash - $rowc['precio_prod'];
								}

								
	
							$mov.='
							<tr>
								<td> 
									<span class="text-primary" style="font-size:0.7rem"> '.$n.'. ['.$rowc['id'].'] <b>'.$rowc['descripcion_prod'].'</b> </span>
									<br>
									<span class="text-muted" style="font-size:0.6rem">'.$rowc['id_recibo'].'</span><br>
									<span class="text-muted" style="font-size:0.6rem">'.$rowc['id_venta'].'</span>
								</td>				

								<td>
									<span class="text-muted" style="font-size:0.8rem"> @'.$user_name.' </span><br>
									<span class="text-muted" style="font-size:0.6rem"> '.$rowc['nombre_comp'].' </span><br>
									<span class="text-muted" style="font-size:0.6rem"> '.substr($rowc['correo_comp'],0,45).'</span>
									
								</td>

								<td>
									<span class="text-muted" style="font-size:0.8rem">'.formatFechaHoraTable($rowc['fecha_venta']).' </span>
								</td>

								<td> 
									<span class="text-muted" style="font-size:0.8rem" >  $ '.money_format('%(#10n',$rowc['precio_prod']).' '.$rowc['moneda_prod'].' </span> 
								</td>
								
							</tr>';
	
					}elseif($tipo==2){
						
						
						if($rowc['estado_recibo']==1){
							$aprovados = $aprovados + 1;
							$ingreso = $ingreso + $rowc['precio_prod'];
						}elseif($row['estado_recibo']==0 or $row['estado_recibo']==3){
							$cancel = $cancel +1;
							$ingreso_desc = $ingreso_desc - $rowc['precio_prod'];
						}

						if($rowc['estado_recibo']==1){
							$total_cash = $total_cash + $rowc['precio_prod'];
						}elseif($rowc['estado_recibo']==0 or $rowc['estado_recibo']==3){
							$total_cash = $total_cash - $rowc['precio_prod'];
						}

						if($total_cash < 0){
							$color_cta = 'text-danger '; 
						}elseif($total_cash > 0){
							$color_cta = 'text-success '; 
						}elseif($total_cash == 0 or $total_cash == ''){
							$color_cta = 'text-muted '; 
						}

						//var_dump($color_cta);
	
					}elseif($tipo==3){
						
							
						if($rowc['estado_recibo']==1){
							$aprovados = $aprovados + 1;
							$ingreso = $ingreso + $rowc['precio_prod'];
						}elseif($row['estado_recibo']==0){
							$cancel = $cancel +1;
							$ingreso_desc = $ingreso_desc - $rowc['precio_prod'];
						}
	
					}						
							
				}	   
		
			}else{
				$mov = '<tr>
						<td colspan="2">  
						<span class="text-muted">No hay movimientos para el periodo indicado</span>
						</td>
						</tr>'; 
			}
	
			if($tipo==1){
					$table = '
	
					<table class="table table-striped">
						<thead>
						</thead>
	
						<tbody>
						'.$mov.'
						</tbody>
	
						<tfooter>
						</tfooter>
					</table>
				'; 
	
				//echo '13900|1|'.$table.'||';
			}elseif($tipo==2){
	
				$f_min = $anio.'-'.$mes.'-'.'1';
				$f_max = $anio.'-'.$mes.'-'.$dias_mes;
	
				$table .= '
						<div class="row col-md-6 " style="margin-left:5px;padding:0px;">
							<span class="col-1 text-muted text-small label_thin"> Del: </span>
							<span class="col-10 text-muted text-small label_thin"> <b>'.formatFecha($f_min).'</b> '.$color_cta.' </span>
						</div>	
	
						<div class="row col-md-6  " style="margin:0px;padding:0px;">
							<span class="col-1 text-muted text-small label_thin"> Al:</span>
							<span class="col-10 text-muted text-small label_thin"> <b>'.formatFecha($f_max).'</b> </span>
						</div>	
				';
	
				$table .= '
							¿ 
							<div class="col-4 border-right">
								<div class="wrapper pr-5">
									<h5 class="text-muted mb-0">Ingreso</h5>
									<div class="d-flex align-items-center">
										<h4 class="text-muted font-weight-semibold mb-0"> $'.money_format('%(#10n',$ingreso).'</h4>
									</div>
								</div>
							</div>

							<div class="col-4">
								<div class="wrapper pr-5">
									<h5 class="text-muted mb-0">Devoluciones</h5>
									<div class="d-flex align-items-center">
										<h4 class="text-muted font-weight-semibold mb-0"> $'.money_format('%(#10n',$ingreso_desc).'</h4>
									</div>
								</div>
							</div>

							<div class="col-4">
								<div class="wrapper pr-5">
									<h5 class="text-muted mb-0">Ingreso Neto</h5>
									<div class="d-flex align-items-center">
										<h4 class="'.$color_cta.' font-weight-semibold mb-0"> $'.money_format('%(#10n',$total_cash).'</h4>
									</div>
								</div>
							</div>
				'; 
	
				$table .='
								¿ 
							<div class="row " style="margin:10px 0px;">

								<div class="col-md-4">
									<div class="wrapper pr-5">
										<h5 class="text-muted mb-0">Aprovados</h5>
										<div class="d-flex align-items-center">
											<h4 class="text-muted font-weight-semibold mb-0"> '.$aprovados.'</h4>
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="wrapper pr-5">
										<h5 class="text-muted mb-0">Devoluciones</h5>
										<div class="d-flex align-items-center">
											<h4 class="text-muted font-weight-semibold mb-0"> '.$cancel.'</h4>
										</div>
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="wrapper pr-5">
										<h5 class="text-muted mb-0">Movimientos</h5>
										<div class="d-flex align-items-center">
											<h4 class="text-muted font-weight-semibold mb-0"> '.$total_mov.'</h4>
										</div>
									</div>
								</div>

							</div>

				';
				
			//echo '14000|1|'.$table.'||';
			}elseif($tipo==3){

				$f_min = $anio.'-'.$mes.'-'.'1';
				$f_max = $anio.'-'.$mes.'-'.$dias_mes;
	
				$table .= '
						<div class="row col-md-6 " style="margin-left:5px;padding:0px;">
							<span class="col-1 text-muted text-small label_thin"> Del: </span>
							<span class="col-10 text-muted text-small label_thin"> <b>'.formatFecha($f_min).'</b> </span>
						</div>	
	
						<div class="row col-md-6  " style="margin:0px;padding:0px;">
							<span class="col-1 text-muted text-small label_thin"> Al:</span>
							<span class="col-10 text-muted text-small label_thin"> <b>'.formatFecha($f_max).'</b> </span>
						</div>	
				';
	
				$table .= '
							¿ 
							<div class="col-6 border-right">
								<div class="wrapper pr-5">
									<h5 class="text-muted mb-0">Ingreso</h5>
									<div class="d-flex align-items-center">
										<h4 class="text-success font-weight-semibold mb-0"> $'.money_format('%(#10n',$ingreso).'</h4>
									</div>
								</div>
							</div>

							<div class="col-6">
								<div class="wrapper pr-5">
									<h5 class="text-muted mb-0">Devoluciones</h5>
									<div class="d-flex align-items-center">
										<h4 class="text-danger font-weight-semibold mb-0"> $'.money_format('%(#10n',$ingreso_desc).'</h4>
									</div>
								</div>
							</div>
				'; 
	
				$table .='
								¿ 
							<div class="row " style="margin:10px 0px;">

								<div class="col-md-4">
									<div class="wrapper pr-5">
										<h5 class="text-muted mb-0">Movimientos</h5>
										<div class="d-flex align-items-center">
											<h4 class="text-muted font-weight-semibold mb-0"> '.$total_mov.'</h4>
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="wrapper pr-5">
										<h5 class="text-muted mb-0">Aprovados</h5>
										<div class="d-flex align-items-center">
											<h4 class="text-muted font-weight-semibold mb-0"> '.$aprovados.'</h4>
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="wrapper pr-5">
										<h5 class="text-muted mb-0">Devoluciones</h5>
										<div class="d-flex align-items-center">
											<h4 class="text-muted font-weight-semibold mb-0"> '.$cancel.'</h4>
										</div>
									</div>
								</div>

							</div>

				';
			}

			return $table;

	}

	function get_transac_mensual($serie,$mensualidad,$tipo){

		include("access.php");
		include("globals.php");
	

		$data = explode('-',$mensualidad);
		$mes = $data[0];
		$anio = $data[1];
		$user_per = $data[2];

		$mes_current = date('m');
		if($mes == $mes_current){
			$dias_mes = date('d');
		}else{
			$dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
		}

		//$dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
		$fecha_min = $anio.'-'.$mes.'-'.'1 00:00:00';
		$fecha_max = $anio.'-'.$mes.'-'.$dias_mes.' 23:59:59';
	
		//echo '13900|1|'.$dias_mes.'||';
		
	
		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
	
		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}
	
		$qc = "SELECT * FROM transactions where clave_lego = $serie and (h_pago BETWEEN '$fecha_min' and '$fecha_max');";// preparando la instruccion sql
		//var_dump($qc);
		$total_mov = 0;
			//var_dump($current);
		$resultc= $dbh->query($qc);
		
			if ($resultc->num_rows > 0) {	
				$total_mov = $resultc->num_rows;
				$aprovados = 0; 
				$cancel = 0;

				while($rowc= $resultc->fetch_assoc()){
					
						if($tipo==3){
							$n = $n+1;
							$user_info = busca_user($rowc['id_user']);
								$data_user = explode('--', $user_info);
								$error = $data_user[0];
								$nombre = $data_user[1];
								$correo = $data_user[2];
								$user = $data_user[3];
								$foto = $data_user[4];
								$perfil = $data_user[5];

								if($user==''){
									$user_name = '<span class="text-clear" style="font-size:0.8rem">@userNotFound</span>';
								}else{
									$user_name = '<span class="text-muted" style="font-size:0.8rem">@'.$data_user[3].'</span>';
								}
	
								//$estado = get_lbl_estado_recibo($rowc['estado']);

								if($rowc['estado']==1){
									$estado = '<span class="text-success"><i class="fa-solid fa-toggle-on"></i> </span>';
									$btn_edo = '<button type="button" class="btn btn-inverse-primary btn_thin"><i class="fa-solid fa-toggle-off"></i></button>'; 
								}else{
									$estado = '<span class="text-success"><i class="fa-solid fa-toggle-off"></i> </span>';
									$btn_edo = '<button type="button" class="btn btn-inverse-primary btn_thin"><i class="fa-solid fa-toggle-on"></i></button>'; 
								}

								

								

								$permiso_select_edo = get_permiso_config('43', $user_per);

								if($permiso_select_edo==1){
									$sele_transac = '<select class="form-control" id="edo_pago_transac">
										<option value="0" > Elija... </option>'.genera_select_estado_pago_transac($rowc['estado_pago']).'
										</select>';
								}else{
									$sele_transac =  get_lbl_estado_pago($rowc['estado_pago']);
								}

								$permiso_elim_transac = get_permiso_config('42', $user_per);
								if($permiso_elim_transac==1){
									$btn_eliminar = '<button type="button" class="btn btn-inverse-primary btn_thin"> '.$ico_global_elimina.'</button>';
								}else{
									$btn_eliminar = '<button type="button" disabled class="btn btn-inverse-primary btn_thin">
								'.$ico_global_elimina.'</button>';
								}
								
								$id_rec=busca_id_recibo_transac($rowc['id_recibo']);
//$id_rec = 0;
								if($id_rec ==1){
									$ico_rev_transac = '<span class="text-success"><i class="fa-solid fa-file-circle-check"></i> Recibo </span>'; 
								}else{
									$ico_rev_transac = '<span class="text-danger"><i class="fa-solid fa-file-circle-xmark"></i> Sin Recibo</span>'; 
								}
								
	
							$mov.='
							<tr>
								<td> 
									<span class="text-primary" style="font-size:0.7rem"> '.$n.'. <b>'.$rowc['clave_lego'].'</b> </span>
									
								</td>
								<td>
									<span class="text-muted" style="font-size:0.7rem">'.$rowc['id_recibo'].'</span><br>
									<span class="text-muted" style="font-size:0.6rem"> '.$ico_rev_transac.' </span>
																		
								</td>			

								<td>
									 '.$user_name.'
																		
								</td>

								<td>
									<span class="text-muted" style="font-size:0.8rem">'.formatFechaHoraTable($rowc['h_pago']).' </span>
								</td>

								<td> 
									'.$estado.' 
								</td>

								<td> 
									<span class="text-muted" style="font-size:0.8rem">'.$sele_transac.' </span>
								</td>
								<td>
									<div class="btn-group" role="group">
										'.$btn_edo.$btn_eliminar.'
									</div>
								</td>
								
							</tr>';
						}						
							
				}	   
		
			}else{
				$mov = '<tr>
						<td colspan="2">  
						<span class="text-muted">No hay transacciones para el periodo indicado</span>
						</td>
						</tr>'; 
			}
	
			if($tipo==3){

				$f_min = $anio.'-'.$mes.'-'.'1';
				$f_max = $anio.'-'.$mes.'-'.$dias_mes;

					$table = '
						<div class="row col-md-6 " style="margin-left:5px;padding:0px;">
							<span class="col-1 text-muted text-small label_thin"> Del: </span>
							<span class="col-10 text-muted text-small label_thin"> <b>'.formatFecha($f_min).'</b> </span>
						</div>	
	
						<div class="row col-md-6  " style="margin:0px;padding:0px;">
							<span class="col-1 text-muted text-small label_thin"> Al:</span>
							<span class="col-10 text-muted text-small label_thin"> <b>'.formatFecha($f_max).'</b> </span>
						</div>	
					
					¿

	
					<table class="table table-striped">
						<thead>
						</thead>
	
						<tbody>
						'.$mov.'
						</tbody>
	
						<tfooter>
						</tfooter>
					</table>
				'; 
	
				//echo '13900|1|'.$table.'||';
			}
			
			return $table;
	}



	function registra_transaccion_cupon($id_user,$id_cupon,$clave_serie){
	
		include("access.php");
		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
							
						$hoy = date("Y-m-d H:i:s");
						$hoyb = date("Y-m-d");
					
						
							if ($dbh->connect_error) {
								  die("Connection failed: " . $dbh->connect_error);
							}
							
			//	 $q = "SELECT * FROM uso_cupon WHERE id_user = $id_user and id_cupon = $id_cupon and fecha_registro like '$hoyb%' ;";
				$q = "SELECT * FROM transactions WHERE id_user = $id_user and id_cupon = $id_cupon and clave_lego = $clave_serie ;";
	
						 $result= $dbh->query($q);
						
						if ($result->num_rows > 0) {
							$row= $result->fetch_assoc();
	
						$res=2;
						
						}else{
							
							$info_cupon = get_info_cupon_id($id_cupon);
							$data_cup = explode('|', $info_cupon); 
							$id_cupon = $data_cup[0];
							$serie_cupon = $data_cup[1];
							$id_user_cupon = $data_cup[2];
							$usos_cupon = $data_cup[3];
							$descuento =  $data_cup[7];
							$title  = $data_cup[8];

							$hoy_fecha = date('Y-m-d');
							$hoy_hora = date("Y-m-d H:i:s");;
				//$qb = "INSERT INTO uso_cupon (id, id_user, id_cupon, clave_serie, usos, estado, fecha_registro ) VALUES ('',".$id_user.", '".$id_cupon."', ".$clave_serie.", 1,1,'".$hoy."')";

				$qb = "INSERT into transactions (id, id_user, f_pago, estado_pago, estado, clave_lego, id_recibo, h_pago, id_cupon) VALUES ('', $id_user, '$hoy_fecha',1,1,$clave_serie, '$title', '$hoy_hora', $id_cupon)";
							// preparando la instruccion sql
							
							   if (mysqli_query($dbh, $qb)) {
									$res = 1; // registro exitosos
								} else {
									$res = 0;  //error
								}
								
							  
						}	

		return $res;
		
		
	}


	function busca_id_recibo_transac($id_recibo){
		include("access.php");

		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}		
				
			$qb = "SELECT * FROM recibos where id_recibo = '$id_recibo';";// preparando la instruccion sql
	
			$resultb= $dbh->query($qb);
			
				if ($resultb->num_rows > 0) {
					$row= $resultb->fetch_assoc();
					
					$res = 1;
					
				
				}else{
					$res = 0;
				}
				
		//var_dump($qb);

			return $res; 
			$dbhb->close();

			}
?>