
<?php 
	
$correo_cifrado = $_GET['item'];
//var_dump($correo_cifrado);
	
$info_user = busca_user_cifrado($correo_cifrado);

//$datos_encontrados= $error.'-'.$nombre.'-'.$correo.'-'.$user_name.'-'.$foto.'-'.$row['id'];	

$data_userb = explode('|', $info_user);
$error = $data_userb[0];
$nombre = $data_userb[1];
$correo = $data_userb[2];
$userb = $data_userb[3];
$foto = $data_userb[4];
$id_user = $data_userb[5];


$pagina = $_GET['element'];

if(isset($pagina)== TRUE){
	$doc = get_pag($pagina);

}else{
	$doc= 'empty.php';
}

//var_dump($info_user);


?>

<div class="scrollable" style="overflow: hidden;">
	<div class="row " style="margin: 0px; padding:0px; height: 100%;">

			<div class="col-2 border-right left_panel_shadow " style="height: 559px; padding:0px; margin:0px;">
				<?PHP echo getmenu_opcion_frame(134,$correo_cifrado); ?>							
			</div>

		<div class="col-10 " style="height: 559px; padding: 0px; margin:0px; ">
				<?php  
					//echo($doc);
					include($doc);
				?>
		</div>
	</div> <!-- row -->
</div>