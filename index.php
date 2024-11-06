<?php
	
		require("access.php");
		session_start();

		include("globals.php");
	

		$doc = $_GET['mnu']; 
		
	//var_dump($user);

//////////// --------- Busca Configuraciones Iniciales  ------------ ///////////

		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
		// Check connection
		if ($dbh->connect_error) {
		    die("Connection failed: " . $dbh->connect_error);
		}
		
		$q_user = "SELECT * FROM configuraciones WHERE id_user = '$user'";
		
		$default_css = $GLOBALS['css_inicial'];
   
		    $result= $dbh->query($q_user);
		    if ($result->num_rows > 0) {
		             $row= $result->fetch_assoc();
		             
		            if(strtolower($row['css_figuras']) == ''){
			            $css = $default_css;
			        }else{
				        
				    $estado_css = get_estado_css($row['css_figuras']);
				      
				      //var_dump($row['css_figuras']);  
				        	if($estado_css==0){
					        	$css = $default_css;
					        	
				        	}elseif($estado_css==1){

								$css_value = strtolower($row['css_figuras']); 
								$css = strtolower($row['css_figuras']).'.css';
		                					        	
				        	}
				        
		                
		            }
			                        
			}else{
						$css = $default_css;
			}

	// Determinar si hay una sesion abierte del mismo dia
if($user != 0){
	$valida_sesion = valida_sesion_dia($user);
    $registro_url = registra_url($user);
}



	// Pagina inicial 
			
	if($valida_sesion==0){
		if($row['pagina_inicial']==''){
			$pagina_inicial = 'bienvenida.php';
			$pag_inicial_nom = 'bienvenida';
			$pag_ini_cve = md5('bienvenida');
			$default = $pagina_inicial;
		}else{
			$pagina_inicial = $row['pagina_inicial'].'.php';
			$pag_ini_cve = md5($row['pagina_inicial']);
			$pag_inicial_nom = $row['pagina_inicial'];
			$default = $pagina_inicial;
		}
	}else{
		$default = $valida_sesion;
	}

	// Idioma 
			
		if($row['idioma']==''){
			$u_idioma = 'es';
		}else{
			$u_idioma = $row['idioma'];
		}	
		
	// VISTAS Mosaico Sets y Minifiguras 
	
	if($row['vista_mosaico_minifig']=='' or $row['vista_mosaico_minifig']<= 2 ){
		$vista_m = 3;
	}else{
		$vista_m = $row['vista_mosaico_minifig'];
	}

	if($row['vista_mosaico_sets']=='' or $row['vista_mosaico_sets'] < 2){
		$vista_s = 2;
	}else{
		$vista_s = $row['vista_mosaico_sets'];
	}

	/// 
	
	$GLOBALS['user_vista_m'] = $vista_m;
	$GLOBALS['user_vista_s'] = $vista_s;
	
	$GLOBALS['user_idioma'] = $u_idioma;
	$GLOBALS['user_css_fig'] = $row['css_figuras'];
	$GLOBALS['user_pag_inicial'] = $pagina_inicial;	
	$GLOBALS['user_pag_inicial_cve'] = $pag_ini_cve;
	$GLOBALS['user_pag_inicial_nom'] = $pag_inicial_nom;
	///// --- Pagina Inicial 
	
	//var_dump($GLOBALS['user_pag_inicial']);
		
		if($GLOBALS['user']=="" or $GLOBALS['user']==0 ){
			
			$process = $_GET['set']; 
			
			if($process==0){
				$default = "home.php";
			}else if($process==1){
				$default = "register.html"; 
			}else if($process==3){
				$default = "recuperapass.php";
			}else if($process==4){
				$user_ref = $_GET['parameter'];
				$default = "recuperapass.php";
				$action_reset = 1;
				$GLOBALS['action_reset'] = $action_reset; 
				$GLOBALS['user_ref'] = $user_ref;
			}
			
		}else{
						
			$default = $GLOBALS['user_pag_inicial']	;
		}
		
				//var_dump('<div class="col-lg-12" style="z-index:9999999; text-align:center;">'.$default.'</div>');

/////////////////////////////////////////////////////////////////////////////////

//var_dump($doc);


if($doc==999){
	//$doc= $default;
	$url = $link_site.'?mnu='.$pag_ini_cve;
	header ("Location: ".$url);
	
}elseif($doc=="" or isset($doc)==FALSE ){
	$doc= $default;
}elseif (isset($doc)==TRUE){
	

		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
		// Check connection
		if ($dbh->connect_error) {
		    die("Connection failed: " . $dbh->connect_error);
		}
		$q = "SELECT * FROM menus WHERE cve = '$doc' and estado = 1;";// preparando la instruccion sql
   
		    $result= $dbh->query($q);
		    
		    if ($result->num_rows > 0) {
		        $row= $result->fetch_assoc();
		        $doc = strtolower($row['nombre']).'.php';
		        $display_title= $row['title'];
	        
				$id_doc = $row['id'];
				
				$permiso_doc = get_permiso_pag($id_doc,$user_perfil);
				
				if($permiso_doc==1){
					$doc = strtolower($row['nombre']).'.php';
				}else{
					$doc = 'no_access.php'; 
				}
				
				//var_dump($permiso_doc);
	                        
			}else{
				$doc = $default;
						
			}

}


//////// Resitra la utima URL 






/////////////////////-------------- FUNCIONES 

function get_permiso_pag($id_pag, $id_user){

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

/////////////


function get_estado_css($css){

include("access.php");

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}		
	
	$css_b = strtolower($css);
		
	$qb = "SELECT * FROM css_files_fig where nombre = '$css_b'";// preparando la instruccion sql
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
///////---------------


function registra_url($user){
	
if($user==0 or $user==''){
    $res = 0;
}else{

	//echo 'Hola Mundo';
	$url  = $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	

		include("access.php");
		
		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		
		if ($dbh->connect_error) {
			   die("Connection failed: " . $dbh->connect_error);
		}		
			
			$hoy = date("Y-m-d");
			$hoy_det = date("Y-m-d H:i:s"); 
				
			$qb = "SELECT * FROM page_request_user where id_user = $user and fecha = '$hoy'";// preparando la instruccion sql
			//var_dump($qb);
		
		//var_dump($qb);
				
		    $resultb= $dbh->query($qb);
		    
		    	if ($resultb->num_rows > 0) {
	
					$qb = "UPDATE page_request_user SET url = '$url', fecha_solicitado = '$hoy_det', fecha = '$hoy' where id_user = $user and fecha = '$hoy' ";// preparando la instruccion sql
					 		 
					if (mysqli_query($dbh, $qb)) {								   			
						$res = 1;
					} else {
						 
					}	$res = mysqli_error($dbh);    	
			    	
			    
			    }else{

					$qb = "INSERT INTO page_request_user (id, id_user, fecha, fecha_larga, fecha_solicitado, url, estado )VALUES ('','".$user."','".$hoy."','".$hoy_det."','".$hoy_det."','".$url."',1)";	
					
					if (mysqli_query($dbh, $qb)) {								   			
						$res = 1;
					} else {
						$res = mysqli_error($dbh); 
					}		    
				    
			    }	
    }

	return $res;

	
}

///////////

function valida_sesion_dia($user){
	
	// obtiene los datos de la ultima sesion y pagina solicitada

		include("access.php");
		
		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		
		if ($dbh->connect_error) {
			   die("Connection failed: " . $dbh->connect_error);
		}		
			
			$hoy = date("Y-m-d");
				
			$qb = "SELECT * FROM page_request_user where id_user = $user and fecha = '$hoy'"; // preparando la instruccion sql

		    $resultb= $dbh->query($qb);
		    
		    	$rowb= $resultb->fetch_assoc();
		
		    	if($resultb->num_rows > 0){
			    	$res = $rowb['url'];
			    }else{
				    $res = 0;
			    }	
			    
		return $res;
}

/////

function get_permiso_config_index($id_pag, $id_user){

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




//////
$perfil = $GLOBALS['user_perfil'];
$permiso_elimina = get_permiso_config_index('9', $perfil);

if($permiso_elimina == 1){
	$master = $GLOBALS['user_masterpass'];
}else{
	$master = 'blocked';
}

	?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />

     <meta http-equiv="Expires" content="0" />
     <meta name="google-signin-client_id" content="914903392768-2ejvi5hbpjihbopd33jc1o2h91ov1e96.apps.googleusercontent.com">

    <title>BrickShelf Collector | <?php echo $display_title; ?></title>
    <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <!-- plugins:css 
    
    <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">-->
    
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,500&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100&family=Economica:ital,wght@0,400;0,700;1,400;1,700&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&family=Lalezar&family=Open+Sans+Condensed:ital,wght@0,300;0,700;1,300&family=Open+Sans:wght@300;400;600;800&family=Pathway+Gothic+One&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Assistant:wght@200;300;400;500;600;700;800&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&family=Roboto&family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Share+Tech&family=Share+Tech+Mono&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400;500;600;700&family=Yanone+Kaffeesatz:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cuprum:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Signika:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Cousine:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+128&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Corinthia:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Allura&family=Corinthia:wght@400;700&display=swap" rel="stylesheet">



    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo_1/style.css">
     <!--   End Layout styles -->
    
    
    <!-- ///////////. CSS CUSTOMS -->
    <link rel="stylesheet" href="custom.css">
    <link rel="stylesheet" href="<?php echo $css ; ?>">
    
    <!-- FIN CSS CUSTOMS -->
 
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    
    <!--<script src="https://kit.fontawesome.com/2256b5e998.js" crossorigin="anonymous"></script>-->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="collector.js" > </script>
    <script type="text/javascript" src="functions.js" > </script>
    
    <!--<script type="text/javascript" src="drag_drop.js" > </script>-->

<!-- Custom Scripts -->
<script src="assets/js/confetti.js"></script>
<script src="assets/js/snowstorm.js"></script>
<script src="assets/js/md5.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js" > </script>

	<link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">

</head>

<body class="oculto-impresion " >



<div id="congrats">
	
	     <div class="row w-100" style="text-align: center;">
		 	<div class="col-lg-4 mx-auto" style="border: 0px solid #fff; align-content: center;   ">
			<div class="row" style="margin-top: 30%; align-content: center; text-align: center;  " align="center"   >
					
						<h4 class="festejo" style="text-align: center;"><i class="fa fa-trophy"></i>&nbsp; ¡Oh Yeah!</h4>
						<h3 class="sub_festejo">Has completado una colección más.</h3>
			</div>
		 	</div>
	    </div>
	    
</div>


<input type="hidden" id="user_token" value="<?php echo $master; ?>">
<input type="hidden" id="user_id" value="<?php echo $GLOBALS['user']; ?>">
<input type="hidden" id="user_idioma" value="<?php echo $GLOBALS['user_idioma']; ?>">
<input type="hidden" id="user_pag_inicial" value="<?php echo $GLOBALS['user_pag_inicial']; ?>">
<input type="hidden" id="user_pag_inicial_cve" value="<?php echo $GLOBALS['user_pag_inicial_cve']; ?>">
<input type="hidden" id="user_pag_inicial_nom" value="<?php echo $GLOBALS['pag_inicial_nom']; ?>">
<input type="hidden" id="user_vista_m" value="<?php echo $GLOBALS['user_vista_m']; ?>">
<input type="hidden" id="user_vista_s" value="<?php echo $GLOBALS['user_vista_s'] ?>">

<input type="hidden" id="user_perfil" value="<?php echo $GLOBALS['user_perfil']; ?>">
<input type="hidden" id="duracion_sesion" value="<?php echo $_SESSION['user_lifetime']; ?>">

	  
 <div class="container-scroller">


<?php
	
	
	include ("nav-bar.php");
	
	
	include ("sidebar.php");
	

?>

	
	
		<div id="snackbar"></div>
		
	    	<div class="main-panel">
          	<div class="content-wrapper">
	          <?php 
			          include ("title.php");
		          
		           ?>
	           	<div class="col-12" >
	            <?php  
		           // echo $registro_url; 
		            include ($doc);  
		            
		            ?>
				</div>
	       	</div>
          </div>
	    </div>

	<?php include ("modals.php");  ?> 
	
<script src="assets/js/jquery.snow.js"></script>
<!--<script type="text/javascript" src="assets/js/js.js"></script>-->


	
<script type="text/javascript">
	
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = today.getFullYear(); 
	
	if(mm == 122 ){
		snownow();
	}else{
		snowStorm.stop();
	}

	//alert(mm);
	
	
		
	function desapear(id){
			
			$(id).fadeIn();
			
			$(document).ready(function() {
			    setTimeout(function() {
			        $(id).fadeOut(3000);
			    },5000);
			});
			
			
	}
	

	
  // make some waves.
  
  function wavediv(ids){
 // var ids= '8684';
		  var cant = 29;
		 var divwidth= document.getElementById('ocean_'+ids).clientWidth/cant;
		 //var divwidth=  document.getElementsByClassName('back_color_main')
		
		var ocean = document.getElementById('ocean_'+ids),
		//var ocean =  document.getElementsByClassName('back_color_main'),
		    waveWidth = divwidth,
		    waveCount = cant,
		    docFrag = document.createDocumentFragment();
		
		//alert(divwidth);
		
		for(var i = 0; i < waveCount; i++){
		  var wave = document.createElement("div");
		  wave.className += " wave";
		  docFrag.appendChild(wave);
		  wave.style.left = i * waveWidth + "px";
		  wave.style.webkitAnimationDelay = (i/100) + "s";
		}
		
		ocean.appendChild(docFrag);

}

var tot = document.getElementsByTagName('card').length; 
//alert(tot);

for(j=1; j<=tot ; j++){
//	wavediv(j);
}
//wavediv('1');
//wavediv('2');

</script>

   <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/js/vendor.bundle.addons.js"></script> 
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="assets/js/shared/off-canvas.js"></script>
    <script src="assets/js/shared/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/demo_1/dashboard.js"></script>
    <!-- End custom js for this page-->
 

    
    
 </div> <!-- container Scroller -->
 
 <script> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=550,height=500,scrollbars=NO,resizable=NO,title=Sesiones,location=no,top=80,left=100") 
} 


function getRadioButtonSelectedValue(ctrl){
    for(i=0;i<ctrl.length;i++)	
        if(ctrl[i].checked) return ctrl[i].value;
}


function ventanaCodebar(URL){ 
	var tipocode= getRadioButtonSelectedValue(document.check_barcode.flatRadios);
    //alert(tipocode);

    if(tipocode===undefined){
        tipocode = document.getElementById('flatRadiosb').value;
    }
    //alert(document.getElementById('flatRadios').value);

	var format = '';
    URL = URL+'&format='+tipocode;
    window.open(URL,"ventana1","width=350,height=150,scrollbars=NO,resizable=NO,title=Imprime Código de Barras,location=no,top=80,left=100") 
}

function ventanaCodebarMinifig(URL){

   // var format = '';
    URL = URL+'&format=1';
    window.open(URL,"ventana1","width=350,height=250,scrollbars=NO,resizable=NO,title=Imprime Código de Barras,location=no,top=80,left=100") 

}

</script>
 
<script  language="JavaScript">
    function cerrar() { 
            setTimeout(window.close,3000); 
            }
</script>

<script type="text/javascript">
$(document).ready(function() {
    $("#buscar").keypress(function(e) {
        if (e.which == 13) {
            return false;
            alert('enter');
        }
    });
    
 });



$(document).ready(function() {
    $("#codeForm").submit(function(){
        $.ajax({
            url:'generate_code.php',
            type:'POST',
            data: {formData:$("#content").val(), ecc:$("#ecc").val(), size:$("#size").val()},
            success: function(response) {
                $(".showQRCode").html(response);  
            },
         });
    });
});

/*
$(document).ready(function() {
    $("#screen_fig").click(function(){
        //alert("button");
        html2canvas("#hold_minifig");

    }); 
});
*/



</script>

  </body>
</html>


