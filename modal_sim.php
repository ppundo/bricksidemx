<?php 

include('minifigures.php');	


$dn = $_GET['dn'];
$format = $_GET['format'];


    $lbl_barcode = genera_barcode_label_sim($dn,$format);


?>

	<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


    <title>BrickShelf Collector | <?php echo $title;?> </title>

        <link rel="stylesheet" href="assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo_1/style.css">

    <!-- ///////////. CSS CUSTOMS -->
    <link rel="stylesheet" href="custom.css">
    
    <!-- FIN CSS CUSTOMS -->
 
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    
    <style type="text/css">
    
    body{
  margin-left: 0px;
  margin-right: 10px;
  margin-top: 0px;
  margin-bottom: 10px;
}

  @page
  {
    margin: 0;
              size: auto;
    }
    
</style>


</head>

<body  >

<div class="" style="border:0px solid #ccc; width:230px;  float: left; margin-top:2px;">
	<?php echo $lbl_barcode; 		?>
</div>


    <script language="JavaScript">
  window.print();
</script>



</body>
</html>
