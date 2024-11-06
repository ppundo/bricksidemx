

<?php

include('minifigures.php');
// $modal =$_GET['mdl']; 
// $obj =$_GET['obj']; 
 $id_user = $_GET['res']; 
 $id_recibo = $_GET['qry'];
 
	// var_dump($id_recibo);
	// if($id_recibo != 0){
		 	$info_recibo = get_recibo($id_recibo,$id_user);
		 	//var_dump($info_recibo);
		 	
		 	$data_rec = explode(';', $info_recibo);
	 
	

						$error=$data_rec[0];
						$id=$data_rec[1];
						$id_recibo=$data_rec[2];
						$id_user=$data_rec[3];
						$id_venta=$data_rec[4];
						$fecha_venta=$data_rec[5];
						$cantidad_prod=$data_rec[6];
						$nombre_prod=$data_rec[7];
						$descripcion_prod=$data_rec[8];
						$precio_prod=$data_rec[9];
						$moneda_prod=$data_rec[10];
						$nombre_comp=$data_rec[11];
						$correo_comp=$data_rec[12];
						$telefono_comp=$data_rec[13];
						$id_pago=$data_rec[14];
						$estado_recibo=$data_rec[15];
						
						 
	 
				if($error == 0){
					$display_info = 'block';
					$card = '
					<div class="card-body" style="display:block; text-align: center;">
						<div class="col-md-12" > 
							<span class="text-muted" > <i class="fa fa-receipt fa-3x" > </i> </span> <br><br>
							<h4 class="text-muted"> El recibo no ha sido encontrado </h4> 
						</div>
					</div>
					';
				}else{
					$display_info = 'block';
					$card = ''; 
					
					if($estado_recibo == 1 ){
						
						$estado_rec = '<span class="text-success"><i class="fa fa-circle"></i> Actual </span> ';
						
					}elseif($estado_recibo == 0 ){
						$estado_rec = '<span class="text-danger"><i class="fa fa-ban"></i> Cancelado </span> ';
						
					}elseif($estado_recibo == 2 ){
						$estado_rec = '<span class="text-warning"><i class="fa fa-adjust"></i> Pendiente </span> ';
						
					}elseif($estado_recibo == 3 ){
						$estado_rec = '<span class="text-info"><i class="fa fa-retweet"></i> Devuelto </span> ';
						
					}
					
					
				}

	
		$title = '<i class="fa fa-receipt"> </i> Detalle del Recibo'; 
		$scroll = 'hidden';
		$display = 'block'; 
	
	 


	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />

     <meta http-equiv="Expires" content="0" />
     <meta name="google-signin-client_id" content="914903392768-2ejvi5hbpjihbopd33jc1o2h91ov1e96.apps.googleusercontent.com">

    <title>BrickShelf Collector | Detalle Recibo </title>
    <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    
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
    <link rel="stylesheet" href="minimal.css">
    
    <!-- FIN CSS CUSTOMS -->
 
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    
    <!--<script src="https://kit.fontawesome.com/2256b5e998.js" crossorigin="anonymous"></script>-->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="collector.js" > </script>
    <script type="text/javascript" src="functions.js" > </script>
    <!--<script type="text/javascript" src="drag_drop.js" > </script>-->

<!-- Custom Scripts -->

	<link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
</head>

<body>
<div id="detalles_recibo"  style="border: 0px solid #c30; z-index: 9999; height: 100%; width: 100%; display: block; ">

				
			<div class="p-2 border-bottom bg-light">
				<?php echo $title; ?>
			</div>
			
			<?php echo $card; ?>
			<div class="card-body" >
				
				
					<div class="col-md-4" style="padding:5px 20px; border-radius: 3px;  overflow: scroll; overflow-x: hidden; overflow-y:auto; border-left: 1px solid #ccc;"  >
			
								
							<div class="p-3 row col-md-12  ">
								<div class=" col-sm-12 text-primary">
									<i class="fa fa-user"></i> Suscriptor 
								</div>
	
							</div>	
								
							<div class="col-md-12 border">	
								<div class=" border-bottom">
									<label class="col-sm-12 text-muted text-small"> Nombre:</label>
									<label class="col-sm-12 text-medium"> <?php echo $nombre_comp;?>  </label>
								</div>

								<div class=" border-bottom">
									<label class="col-md-12 text-muted text-small"> Correo:</label>
									<label class="col-md-12 text-medium text-small"> <?php echo $correo_comp;?>  </label>
								</div>
								
								<div class=" ">
									<label class="col-md-12 text-muted text-small"> Teléfono:</label>
									<label class="col-md-12 text-medium"> <?php echo $telefono_comp; ?>  </label>
								</div>
									
													
							</div>
					
					</div>
					
					<div class="col-md-8 bg-secondary" style="padding:5px 20px; border-radius: 3px;  overflow: scroll; overflow-x: hidden; overflow-y:auto; border-left: 1px solid #ccc;" >
						
						
							
							<div class="p-3 row col-md-12  ">
								<div class=" col-sm-12 text-primary">
									<i class="fas fa-paypal"></i> Info Transacción PAYPAL
								</div>
	
								<div class=" col-sm-4">
									<span class=""> <?php echo $estado_rec; ?></span>
								</div>
							</div>							
						
							
								<div class="col-md-12 row ">

									<div class="col-md-6 border-right">
										<label class=" text-muted text-small"> ID Recibo:</label>
										<label class="text-medium"> <?php echo $id_recibo; ?> </label>
									</div>	

									<div class="col-md-6 ">
										<label class=" text-muted text-small"> Fecha:</label>
										<label class=" text-medium"> <?php echo $fecha_venta; ?> </label>
									</div>	
								</div>
								<hr>
								
								<div class="col-md-12 row ">
										
									<div class="col-md-4 border-right">
										<label class="text-muted text-small"> Cantidad:</label>
										<label class=" text-medium"> <?php echo $cantidad_prod;?>  </label>
									</div>
									<div class="col-md-4 border-right">
										<label class=" text-muted text-small"> Importe:</label>
										<label class="text-medium"> $ <?php echo $precio_prod;?>  </label>
									</div>
									<div class="col-md-4 border-right">
										<label class=" text-muted text-small"> Moneda:</label>
										<label class=" text-medium"> <?php echo $moneda_prod; ?>  </label>
									</div>								

								</div>			

								<hr>


								<div class="col-md-12 row border-bottom">

									<div class="col-md-12 ">
										<label class="text-muted text-small"> Descripción :</label>
										<label class=" text-medium"> <?php echo $descripcion_prod; ?>  </label>
									</div>	

									<div class="col-md-6 border-right ">
										<label class=" text-muted text-small"> ID Venta:</label>
										<label class="text-medium"> <?php echo $id_venta;?>  </label>
									</div>																	
									<div class="col-md-6 ">
										<label class=" text-muted text-small"> Autorización:</label>
										<label class=" text-medium"> <?php echo $id_pago;?>  </label>
									</div>	
									
								</div>	
				
			</div>
		</div>
</div>			
</body>
</html>
<!------   --> 
