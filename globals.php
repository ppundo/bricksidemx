<?php
	
$user = $_SESSION['clave_user'];	// id de bd 	
$user_perfil = $_SESSION['user_profile']; // clave (DB  --> 1 ó 0
$user_masterpass = $_SESSION['user_masterpass'];
$user_idioma = $_SESSION['user_idioma'];
$user_sesion= $_SESSION['user_lifetime'];
		
$GLOBALS['user'] = $user;
$GLOBALS['user_perfil'] = $user_perfil;
$GLOBALS['user_masterpass'] = $user_masterpass;	
$GLOBALS['user_idioma'] = $user_idioma;	
$GLOBALS['user_session'] = $user_sesion;	

$name_site = 'BRICKSHELF COLLECTOR';
$sitio_web = 'www.bricksidemx.com'; 
$path_site = 'https://bricksidemx.com/collector/';
$link_site = $path_site.'index.php';

$GLOBALS['path_site']= $path_site;
$GLOBALS['link_site'] = $link_site;
$GLOBALS['sitio_web'] = $sitio_web;
$GLOBALS['name_site'] = $name_site;

$link_site_public = $path_site.'public.php?';
//echo '<span> cierra globales </span>'; 
//$user_idioma = $GLOBALS['user_idioma'];

//echo '<input type="hidden" name="user" id="user" alt="Usuario" value="'.$user.'" >';

$sug_activas = 2;

////// CONFIGURACIONES INICIALES

$css_inicial = 'default.css';
$GLOBALS['css_inicial'] = $css_inicial;

//var_dump($GLOBALS['user_session']);


// PERMISOS CONFIG 



// Paths Generales 

$path_sets = 'assets/images/sets/';
$path_logos = 'assets/images/logos/';
$path_portada ='assets/images/portada_serie/'; 
$path_folleto = 'assets/images/sheet/';
$path_caja = 'assets/images/caja/';
$path_empaque = 'assets/images/empaque/';
$path_fondo = 'assets/images/backgrounds/';

$ico_global_edit = '<span class="text-primary"> <i class="fa-regular fa-pen-to-square"></i> </span>';
$ico_global_elimina = '<span class=""> <i class="fa-solid fa-trash"></i> </span>';
$ico_global_save = '<span class=""> <i class="fa-solid fa-save"></i> </span>';
/// DeBUG 

$deb = 0;
$GLOBALS['deb'] = $deb;	


//// Iconos

$ico_fav = ''; 
$ico_select_coleccion='<i class="fa-solid fa-star"></i>';

$GLOBALS['ico_select_coleccion'] = $ico_select_coleccion;

///// Login Page

$login_page = 'login.php';
$GLOBALS['login_page'] = $login_page;


////// Codigod de barras 

$logo_lbl = 'assets/images/logo_codebar_osc.webp';
$GLOBALS['logo_lbl'] = $logo_lbl;	

?>