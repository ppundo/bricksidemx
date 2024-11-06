<?php 

require_once('minifigures.php');

$current_menu = $_GET['mnu']; 

//var_dump($current_menu);

$breadcrumb = get_info_pags(0,$current_menu);

$data = explode('|', $breadcrumb); 

$mpadre = $data[1];
$final = $data[2];

// obtener info del menu final 


$sec =get_info_mnu_cve($current_menu);
$data_sec = explode('|',$sec);
//var_dump($sec);

//$info_sec = get_info_seccion_menu($data_sec[5]);
//$data_secb = explode('|',$info_sec);

//$seccion = $data_secb[0].' / ';

if($final != ''){
    $cadena = '<h5 class="fw-bold py-1 mb-4" style="border:0px solid #ccc;"> <span class="text-muted fw-light">'.$seccion.''.$mpadre.' /</span> '.$final.'</h5>';
}else{
    $cadena = '<h5 class="fw-bold py-1 mb-4">  <span class="text-muted fw-light">'.$seccion.'</span>'.$mpadre.'</h5>';
}

echo $cadena;


?>