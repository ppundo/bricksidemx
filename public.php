<?php 

include("access.php");
include("globals.php");

$doc = $_GET['mnu']; 
$default = 'no_access.php';

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
	                        
	}else{
		$doc = $default;
		$display_title= 'Lo Sentimos';
	}	
	



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
    
    <!-- FIN CSS CUSTOMS -->
 
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    
    <script src="https://kit.fontawesome.com/2256b5e998.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="collector.js" > </script>
    <script type="text/javascript" src="functions.js" > </script>

<!-- Custom Scripts -->

<script src="assets/js/md5.js"></script>

<link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">




</head>

<body>
<div id="snackbar"></div>
<div class="col-lg-12 oculto-impresion center border-bottom" style="padding:15px 10px;  margin-bottom: 10px; background: linear-gradient(to top, #00856f, #092b26);" >
    <img class="" style="max-width:10%;" src="https://bricksidemx.com/collector/assets/images/logo.svg" ><br>
    <h5 class="center" style="margin-top:10px; color:rgba(250,250,250,0.6);">  <?php echo $GLOBALS['name_site']; ?></h5>
    <h3 class="text-light" style="margin-top:10px;">  <?php echo strtoupper($display_title); ?></h3>
</div>
	     <div class="col-12" >
            
	            <?php  
                //echo $doc;
                include ($doc);  ?>
				</div>


<script language="JavaScript">
    function desapear(id){
			
			$(id).fadeIn();
			
			$(document).ready(function() {
			    setTimeout(function() {
			        $(id).fadeOut(3000);
			    },5000);
			});
			
			
	}
    </script>
                
</body>
</html>