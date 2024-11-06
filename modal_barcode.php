<?php 

include('minifigures.php');	


$codigo = $_GET['codebar'];
$user_id = $_GET['cve'];
$format = $_GET['format'];
$item = $_GET['item'];


//$lbl_barcode = genera_barcode_label($codigo,2);
//var_dump($codigo);



if(isset($item)==true){
    $lbl_barcode = genera_barcode_label_minifig($item,$user_id);
    $title= 'Etiqueta Minifigura';
}else{

    $tam = strlen($codigo);

    if($tam > 3){

        if($format==0){
            $format_final = 1;
        }else{
            $format_final = $_GET['format'];
        }

        $lbl_barcode = genera_barcode_label_clavelego($codigo,$format_final,$user_id);
        $title= 'Etiqueta Set';
    }else{
        $lbl_barcode = genera_barcode_label_grupo($codigo,$user_id);
        $title= 'Etiqueta Grupo';
    }
}




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
