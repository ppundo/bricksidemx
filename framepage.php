<?php

require("access.php");

include("minifigures.php");


$mnu = $_GET['mnu'];


if(isset($mnu)){

		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
		// Check connection
		if ($dbh->connect_error) {
		    die("Connection failed: " . $dbh->connect_error);
		}
		$q = "SELECT * FROM menus WHERE cve = '$mnu' and estado = 1;";// preparando la instruccion sql
   
		    $result= $dbh->query($q);
		    
		    if ($result->num_rows > 0) {
		        $row= $result->fetch_assoc();
		        $doc = strtolower($row['nombre']).'.php';
		        //$display_title= $row['title'];
	        
				//$id_doc = $row['id'];
				
				//$permiso_doc = get_permiso_pag($id_doc,$user_perfil);
				
                /*
				if($permiso_doc==1){
					$doc = strtolower($row['nombre']).'.php';
				}else{
					$doc = 'no_access.php'; 
				}*/
				
				//var_dump($permiso_doc);
	                        
			}else{
				$doc = 'no_access.php';
						
			}

}else{
   $doc = 'no_access.php'; 
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

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+128&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

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

	<link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">

</head>

<body >

<!--

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
-->

	  

	    
	            <?php  
		           // echo $registro_url; 
		            include ($doc);  
		            
		            ?>
	     

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
	var format = '';
    URL = URL+'&format='+tipocode;
    window.open(URL,"ventana1","width=350,height=150,scrollbars=NO,resizable=NO,title=Imprime Código de Barras,location=no,top=80,left=100") 
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
</script>

  </body>
</html>


