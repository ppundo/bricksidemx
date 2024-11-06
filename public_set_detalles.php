<?php
include("minifigures.php");
include("globals.php");

$set_code= $_GET['item'];



///-- Obtiene usuario
$user_sub = substr($set_code,-2);
$inic= substr($user_sub,0,1);
if($inic == 0){
    $user = substr($user_sub,1);
}else{
    $user = $user_sub;
}
//$user_current = $user;

if($user == 2){
    $user_current = 2;
}else{
    $user_current = $user;
}

$info_user = busca_user($user_current);
$data_user= explode('--',$info_user);
$username = $data_user[3];
//var_dump($info_user);


///-- Obtiene Clave lego
$clave_sub = substr($set_code,0,6);
$ini = substr($clave_sub,0,1);
if($ini == 0){
    $clave = substr($clave_sub,1);
}else{
    $clave = $clave_sub;
}




$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}
///////////////// 
/////// 

$q = "SELECT * FROM sets where cve_lego = $clave and id_user = $user_current";// preparando la instruccion sql

$result= $dbh->query($q);
if ($result->num_rows > 0) { // Si la consulta trae registro, 
    $row= $result->fetch_assoc(); 
    

    $nombre = $row['nombre'];
    $piezas = $row['piezas'];
    $clave = $row['cve_lego'];
    $figuras = $row['no_minifig'];
    $tema = $row['id_tema'];
    $grupo = $row['grupo'];
    $cantidad = $row['cantidad'];
    $f_add = $row['fecha_add'];
    $edo_set = $row['set_edo'];
    $anio_public = $row['anio_public'];


    $lbl_set = genera_barcode_label_clavelego($row['cve_lego'],6,$user);

    $info_tema = getinfotema($tema);
    $data_tema = explode('|',$info_tema);
    $nombre_tema = $data_tema[0];

    $info_gpo = getinfogrupo($grupo);
    $data_gpo = explode('|', $info_gpo);
    $nombre_grupo = $data_gpo[0];
    $ubic = $data_gpo[2];

    // Estado Set 
    $info_edoset = get_info_estado_setcol($edo_set);
    $data_edoset = explode('|',$info_edoset);
    $nombre_edoset = $data_edoset[1];

    

    $locat = get_detalle_ubic($ubic);
                     
    $datas = $row['nombre'].'-'.$row['piezas'].'-'.$row['cve_lego'].'-'.$lista_temas.'-'.$row['precio'].'-'.$row['anio_public'].'-'.$id.'-'.$fotos.'-'.$ruta_foto.'-'.$btn_show.'-'.$list_origen.'-'.$row['no_minifig'].'-'.$row['id_tema'].'-'.$nom_grupo.'-'.$row['cantidad'];
    
    $bandera_show = 1;
                     
}else{
    $bandera_show = 0;
    $data='<h5 class="col-md-12 p-2 bg-muted text-danger center">Clave Incorrecta, no se encontró este set en la colección del usuario.</h5>';
}

$edo_pres = get_lbl_estado_presentacion($row['id_presentacion']);
   // echo $data;
/////


//$foto = valida_foto_tipo($row['item_foto'],1);
//$foto = valida_foto_tipo_adv($row['item_foto'],1);
$imagen = comprueba_image($row['cve_lego'],'set');
$foto = 'assets/images/sets/'.$imagen;
$path = 'data:image/png;base64,'.base64_encode(file_get_contents($foto));



//echo $imagen;
//margin-top:12%; top:-50%; 
if($bandera_show == 1){
?>
<head>
<title> Ficha Set <?php echo $row['cve_lego']; ?></title>
</head>
<div class="col-md-12 center oculto-impresion " style="margin-top:30px;">
    <h3 class="text-muted"> FICHA SET</h3>
</div>

<div class="col-md-12 " style="margin-top:30px;">

    <div class="row">
            <div class="col-lg-6 border center" style="height:auto;" id="">
                <img style="max-height: 400px; max-width:550px;  padding:10px; vertical-align:middle;  " src="<?php echo $path ?>" > 
            </div>

            <div class="col-lg-6 border" id="info_set">
                <h5 class="col-md-12 p-3 center"  style="font-size: 2rem;"><?php echo strtoupper($nombre); ?></h5>
                
                <div class="row border-top border-bottom">

                    <div class="col-sm-3 center border-right" style="padding: 20px 5px 20px 5px;">
                        <span class="text-head" style="font-size:2rem"><i class="fa-solid fa-hashtag"></i></span>
                        <div class="col-sm-12" style="font-size: 1.8rem;"><?php echo strtoupper($clave); ?></div>
                        <div class="col-sm-12 text-muted">Clave</div>
                    </div>

                    <div class="col-sm-3 center border-right" style="padding: 20px 5px 20px 5px;">
                        <span class="text-head" style="font-size:2rem"><i class="fa-solid fa-puzzle-piece"></i></span>
                        <div class="col-sm-12"  style="font-size: 1.8rem;"><?php echo strtoupper($piezas); ?></div>
                        <div class="col-sm-12 text-muted">Piezas</div>
                    </div>

                    <div class="col-sm-3 center border-right" style="padding: 20px 5px 20px 5px;">
                        <span class="text-head" style="font-size:2rem"><i class="fa-solid fa-child"></i></span>
                        <div class="col-sm-12"  style="font-size: 1.8rem;"><?php echo strtoupper($figuras); ?></div>
                        <div class="col-sm-12 text-muted">Minifiguras</div>
                    </div>

                    <div class="col-sm-3 center" style="padding: 20px 5px 20px 5px;">
                        <span class="text-head" style="font-size:2rem"><i class="fa-regular fa-calendar"></i></span>
                        <div class="col-sm-12"  style="font-size: 1.8rem;"><?php echo $anio_public; ?></div>
                        <div class="col-sm-12 text-muted">Año</div>
                    </div>

                </div>

                <div class="row ">
                    
                    <div class="col-md-6 border-right bg-head" style="padding:10px;">
                        <div class="border" style="background:rgba(255,255,255,1);">
                            <?php echo $lbl_set; ?>
                        </div>
                    </div>
                    
                    <div class="col-md-3 row ">
                        
                        <div class="col-md-12 border-bottom" style="vertical-align:middle; padding:1px;">
                            <div class="col-sm-12 text-muted"  style="font-size: 0.8rem; top: 50%; transform: translateY(-50%);">
                            <span class="color-muted" style="font-size:0.6rem;">Tema: </span><br>
                            <span><b> <?php echo strtoupper($nombre_tema); ?> </b></span>
                            </div>
                        </div>

                        <div class="col-md-12 border-bottom" style="vertical-align:middle; padding:1px;">
                            <div class="col-sm-12 text-muted"  style="font-size: 0.8rem;  top: 50%; transform: translateY(-50%);">
                                <span class="color-muted" style="font-size:0.6rem;"> Grupo: </span><br>
                                <span> <b><?php echo strtoupper($nombre_grupo); ?></b> </span>
                            </div>
                        </div>

                        <div class="col-md-12 border-bottom" style="vertical-align:middle; padding:1px;">
                            <div class="col-sm-12 text-muted"  style="font-size: 0.8rem;  top: 50%; transform: translateY(-50%);">
                                <span class="color-muted" style="font-size:0.6rem;"> Cantidad: </span><br>
                                <span> <b><?php echo $cantidad .' - '.strtoupper($nombre_edoset); ?></b> </span>
                                </div>
                        </div>
                        
                    </div>

                    <div class="col-md-3 row border-left">
                        <div class="col-md-12 border-bottom" style="vertical-align:middle; padding:1px;">
                            <div class="col-sm-12 text-muted"  style="font-size: 0.8rem; top: 50%; transform: translateY(-50%);">
                            <span class="color-muted" style="font-size:0.6rem;"> Colección: </span><br> 
                            <span><b> <?php echo '@'.strtolower($username); ?> </b></span>
                            </div>
                        </div>

                        <div class="col-md-12 border-bottom" style="vertical-align:middle; padding:1px;">
                            <div class="col-sm-12 text-muted"  style="font-size: 0.8rem;  top: 50%; transform: translateY(-50%);">
                                <span class="color-muted" style="font-size:0.6rem;"> Ubicación: </span><br> 
                                <span> <b><?php echo strtoupper($locat); ?></b></span>
                            </div>
                        </div>

                        <div class="col-md-12 border-bottom" style="vertical-align:middle; padding:1px;">
                            <div class="col-sm-12 text-muted"  style="font-size: 0.8rem;  top: 50%; transform: translateY(-50%);">
                            <span class="color-muted" style="font-size:0.6rem;"> Presentación: </span><br>
                            <span> <b><?php echo $edo_pres; ?></b></span>
                            </div>
                        </div>


                    </div>

                     <div class="col-lg-12 row ">
                        <div class="col-md-6 border-bottom">
                            <div class="col-sm-12 text-muted"  style="font-size: 0.8rem;  top: 50%; transform: translateY(-50%);">
                            <span class="color-muted" style="font-size:0.6rem;"> Fecha Registro: </span> <br>
                            <span> <b><?php echo formatFechaHora($f_add); ?></b> </span>
                            </div>
                        </div>
                    
                    </div>

                </div>

            </div>
    </div>
</div>

<div class="col-lg-12 center bg-muted p-3 oculto-impresion " style="margin-top: 20px; ">
    <span class="oculto-impresion">Comienza tu colección: </span> <a class="" href="index.php"> Registrate o Inicia Sesión</a><br>
    <a class="oculto-impresion" href="https://<?php echo $GLOBALS['sitio_web']; ?>"> <?php echo $GLOBALS['sitio_web']; ?></a> | <a href="mailto:contacto@bricksidemx.com">contacto@bricksidemx.com</a>
    
</div>

<div class="col-lg-12 center" style="margin-top:15px;">
<h4 class="text-muted">www.bricksidemx.com</h4>
</div>
<?php 
}else{
    echo '<h5 class="col-md-12 p-2 bg-muted text-danger center">Clave Incorrecta, no se encontró este set en la colección del usuario.</h5>';
}
?>
