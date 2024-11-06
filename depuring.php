<?php

function get_cards_minifigures($serie,$view){

$user_idiom = $GLOBALS['user_idioma']; 
$user = $_SESSION['clave_user'];

include("access.php");


$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
  //informacion de acceso a la bd

if ($dbh->connect_error) {// Check connection
    die("Connection failed: " . $dbh->connect_error);
}	


 

if($serie==1){ // si la funcion manda a llamar a todas las minifiguras
  
      if( $GLOBALS['user_perfil'] == 1 ){
    
        $debug = 1;  // debug para cuando se sellecciona todas las minififuras	
            
        if($debug==1){
            $qmi = "SELECT * FROM minifiguras where cve_lego like '710%' ;";// testing 
        }else{
            $qmi = "SELECT * FROM minifiguras order by cve_lego;";// real
        }
                    
          
      }else if( $GLOBALS['user_perfil'] != 1){
          
          $qmi = "SELECT * FROM minifiguras where estado = 1;";// preparando la instruccion sql
      }else{
          $qmi = "SELECT * FROM minifiguras where estado = 1;";// preparando la instruccion sql
      }
        //$q = "SELECT * FROM minifiguras;";// preparando la instruccion sql


//////////////////////////   BUSCA SERIES ACTIVAS   ////////////////////////////////////

      if( $GLOBALS['user_perfil'] == 1 ){
          
          $qss = "SELECT * FROM series where estado > 1;";// preparando la instruccion sql
                        
      }else if( $GLOBALS['user_perfil'] != 1){
          
          $qss = "SELECT * FROM series where estado = 1 or estado = 2;";// preparando la instruccion sql
      }
          
    $results= $dbh->query($qss);
    if ($results->num_rows > 0) {
    
    $tot_reg = $results->num_rows; 
    $tot = 0; 
    
        while($rows= $results->fetch_assoc()){
            
            if($tot == $tot_reg){
                $serie_act .= $rows['clave_lego'];
            }else{
                $serie_act .= $rows['clave_lego'].'-';
            }
                        
            $tot = $tot + 1; 
        }
    
    }

    // 2. Convierte en un array
    
    $series = explode('-', $serie_act); 


 //////////////////////////   BUSCA SERIES OPCIONALES ////////////////////////////////////

      $qop = "SELECT * FROM series where tipo = 3;";// preparando la instruccion sql

    $resultop= $dbh->query($qop);
    if ($resultop->num_rows > 0) {
    
    $tot_reg = $resultop->num_rows; 
    $tot = 0; 
    
        while($rowop= $resultop->fetch_assoc()){
            
            if($tot == $tot_reg){
                $serie_op .= $rowop['clave_lego'];
            }else{
                $serie_op .= $rowop['clave_lego'].'-';
            }
                        
            $tot = $tot + 1; 
        }
    
    }

    // 2. Convierte en un array
    $series_op = explode('-', $serie_op); 
    

 
}else{ // una serie especifica

    $order_q = 'order by no_folleto';
      
    $qmi = "SELECT * FROM minifiguras where cve_lego = $serie $order_q";// preparando la instruccion sql
    
    $class_clave =""; 
    $clave_lego = $_GET['ref']; 
}

    //info Serie
    $data_color = get_info_serie($_GET['ref']);
                        
    $data = explode('/', $data_color);
    
    $nombre_serie = $data[0];
    $color_serie = $data[1];
    $fecha_serie = $data[2];
    $edo_serie = $data[3];
    $precio_serie = $data[4];
    $moneda_serie = $data[5];
    $desc_serie = $data[6];
    $colorb_serie = $data[14];

// termina info serie

$result= $dbh->query($qmi);
if ($result->num_rows > 0) {
    
    $css_user = $GLOBALS['user_css_fig'];
    $num = 0;
    $total_collect = 0; 
    $cadena = '';
    
    $total_serie_elem = $result->num_rows;
    
    $current = ''; 
    $last = ''; 

    
        while($row= $result->fetch_assoc()){
            
            if($moneda_serie=='XXX'){
                $moneda_serie = 'USD';
            }
            
            $current = $row['cve_lego'];
                        
                        
                        $cadena='';
                          // Checa si la serie es premium
                          
                          $premium = get_status_premium($row['cve_lego']);          
                                                
                          // checa si se ha registrado el pago
                          
                          $pago = get_status_pago($row['cve_lego'], $user); 
                          
                        //// Determina si es visible las series opcionales
                        //$estado_custom = get_estado_serie_opcional($row['cve_lego'], $user);
                        
                        // Nueva funcion sobre tabla y no codigo de configuracion.
                        $estado_custom = get_status_series_opcional($user,$row['cve_lego']);
                        
                        $tipo_s = get_tipo_serie($row['cve_lego']);	
                        
                        // sca el estado de la serie
                            // saca la clave de la serie 
                            $estado_serie = get_info_serie($row['cve_lego']);
                            $data_s = explode('/', $estado_serie);
                            $estado_r = $data_s[3];
                            $color_col  = $data_s[1];
                            $color_text = $data_s[13];
                            //var_dump($estado_serie);
                            
                            // busca el estado en el catalogo								
                        
                            $id_estado = get_info_estado_serie($estado_r);
                            $data_estado = explode('/', $id_estado);
                            $code_estado_serie = getLetraByPosition($data_estado[0]);
                        
                        
                        /// forma el codigo para determinar el permiso
                        
                        $code_tipo_serie = getLetraByPosition($tipo_s);
                        
                        if($premium==1){
                            $code_premium = getLetraByPosition(1);
                        }else{
                            $code_premium = getLetraByPosition(2);
                        }


                        $permiso_pago = get_permiso_pago($row['cve_lego'], $user);
                        

                        if($pago==0){
                            //$code_pago = getLetraByPosition(2);
                            
                            
                            if($permiso_pago==1){
                                $code_pago = getLetraByPosition(3);
                            }else{
                                
                                $code_pago = getLetraByPosition(2);
                                            //$code_pago = getLetraByPosition(2);					
                            }	
                                                        
                        }else{
                            
                            if($permiso_pago==1){
                                $code_pago = getLetraByPosition(3);
                            }else{
                                
                                $code_pago = getLetraByPosition($pago);
                                            //$code_pago = getLetraByPosition(2);
                                                                
                            }


                        }
                        
                        //var_dump($code_pago);
                        
                        $perfil_usuario = get_id_perfil($GLOBALS['user_perfil']);
                        //var_dump($perfil_usuario);

                        if($perfil_usuario==0){
                            $code_perfil = getLetraByPosition(2);
                        }else{
                            $code_perfil = getLetraByPosition($perfil_usuario);
                        }	
                        
                        if($serie==1){
                            $code_serie = getLetraByPosition(1);
                        }else{
                            $code_serie = getLetraByPosition(2);
                        }
                        
                        if($estado_custom ==0){
                            $code_estado_opcional = getLetraByPosition(2);
                        }else{
                            $code_estado_opcional = getLetraByPosition($estado_custom);
                        }							
                            
                        
                        
                        $code_serie_acceso = $code_tipo_serie.$code_estado_serie.$code_premium.$code_pago.$code_perfil.$code_serie.$code_estado_opcional;
                        
                        //$bandera_serie = get_estatus_vista($code_serie_acceso);
                      
                      /// Valida si ya es fecha de realese                          
                      if($edo_serie == 3){
                        $hoy = date("Y-m-d");
                        $f_release = $fecha_serie;
                        
                        if($hoy >= $f_release){
                          $vigencia =1;
                        }else{
                          $vigencia =0;
                        }
                       // $vigencia = compara_fechas($hoy,$f_release);
                        
                       // var_dump($vigencia);
                        
                        if($vigencia == 1 ){
                          $bandera_serie = 1;
                        }else{
                          $bandera_serie = get_estatus_vista($code_serie_acceso);
                        }
                        
                      }else{
                        $bandera_serie = get_estatus_vista($code_serie_acceso);
                      }
                    
                      
                        $debug =$code_serie_acceso . ' - '.$bandera_serie.' - '.$row['cve_lego'].' - '.$nombre_serie.' - Vigencia:'.$vigencia.'<br>';



                     
                     $deb = $GLOBALS['deb'];
                   // $deb = 1;
                     
                     if($deb == 1){
                         $debug_card= '<div class="text-light" style="position:absolute; background: rgba(10,10,10,0.7); width:100%; height:100%; top:0px; left:0px; z-index:100000; border-radius:5px; ">
                    <span class="col-sm-12"> 
                        <span> Clave: '.$row['cve_lego'].' </span> <br>
                        <span> Código Vista:  '.$code_serie_acceso.' </span><br>
                        <span> Bandera Vista:  '.$bandera_serie.' </span>
                    </span>
               </div>';
               
               
                         if($last != $current){
                            
                            $list .= $debug;
                            
                        }else{
                            
                            $list .= '';
                        }
                        
                     }else{
                         $debug_card= '';
                         $list = '';
                     }
                       
                     //  var_dump($cadena);
                         if($bandera_serie == 0 and $serie != 1){
                             
                             $grid_body ='


                                      <div class="col-md-12 center grid-margin">
                                     
                                         <h1 class=" text-muted" style="font-size: 90px;" onclick="toggle(\'code_deb\')" >										 	
                                             <i class="em em-no_entry" aria-role="presentation" aria-label="NO ENTRY"></i>
                                        </h1>
                            
                                        <br>

                                        <h3 class="page-title text-primary">¡Opps!</h3>
                                        
                                        <span class="subtitle_sec_w text-neutral center" style="font-size:24px; "> 												 
                                            No tienes permisos para visualizar esta colección.
                                        </span>
                                    </div>							 	
                             
                             
                             
                                    <div class="col-lg-12 text-clear " style="text-align:center;" >                          	
                        
                                           <div id="code_deb" class="" style="display:none;">  '.$debug.' </div>
                                    </div>' ;


                                
                       }else if($bandera_serie == 4 and $serie != 1){


                             $grid_body ='
                                    
                                     <div class="col-md-12 center grid-margin">
                                     
                                         <h1 class=" text-muted" style="font-size: 90px;" onclick="toggle(\'code_deb\')" >						 								
                                         
                                             <i class="em em-hourglass" aria-role="presentation" aria-label="HOURGLASS"></i>

                                        </h1>
                            
                                        <br>

                                        <h3 class="page-title text-primary">Esta colección aún no se estrena</h3>
                                        
                                        <span class="subtitle_sec_w text-neutral center" style="font-size:24px; "> 
                                             
                                            Para ver esta <b>Colección</b> espera la fecha de estreno. <br> ¡Tambien estamos anciosos! 
                                        </span>
                                    </div>							 	
                             
                             
                             
                                    <div class="col-lg-12 text-clear " style="text-align:center;" >                          	
                        
                                           <div id="code_deb" class="" style="display:none;">  '.$debug.' </div>
                                    </div>' ;

                        
                       }else if($bandera_serie == 2 and $serie != 1){
                             
                             $grid_body ='


                                      <div class="col-md-12 center grid-margin">
                                     
                                         <h1 class=" text-muted" style="font-size: 90px;" onclick="toggle(\'code_deb\')" >						 								
                                         
                                             <i class="em em-clipboard" aria-role="presentation" aria-label="CLIPBOARD"></i>

                                        </h1>
                            
                                        <br>

                                        <h3 class="page-title text-primary">Modifica la configuración</h3>
                                        
                                        <span class="subtitle_sec_w text-neutral center" style="font-size:24px; "> 
                                             
                                            Para ver esta <b>Colección Opcional</b> selecciónala desde tu perfil.
                                        </span>
                                    </div>							 	
                             
                             
                             
                                    <div class="col-lg-12 text-clear " style="text-align:center;" >                          	
                        
                                           <div id="code_deb" class="" style="display:none;">  '.$debug.' </div>
                                    </div>' ;


                                    
                        
                       }else if($bandera_serie == 3 and $view == 1 ){
                           
                       /// valida si hay cupones activos. 
                        
                        //$valida_cupon_act = valida_cupon_activo($row['cve_lego']);    
                        $valida_cupon_act = valida_cupon_activo($row['cve_lego'], $GLOBALS['user']);
                        //var_dump($valida_cupon_act);
                        
                        $dta_cupon = explode('|', $valida_cupon_act);
                        //$res = '1|'.$titulo.'|'.$descuento.'|'.$fini.'|'.$ffin;
                        
                        $estado_cup = $dta_cupon[0];
                        $cupon = $dta_cupon[1];
                        $desc_cup = $dta_cupon[2];
                        $fini_c = $dta_cupon[3];
                        $ffin_c = $dta_cupon[4];
                        $id_uso_cupon = $dta_cupon[5];
                        
                       
                        //////////                   
                        
                        if($desc_serie==0){
                            
                            
                            if($estado_cup == 1){
                                
                                $porcent = ($desc_cup/100);
                                $mont_desc = ($precio_serie * $porcent );
                                $precio_final =round(($precio_serie - $mont_desc),2);
                                $btn_quitar_cupon = '
                                
                                    <button class="btn btn-outline-primary  btn_thin" value="'.$id_uso_cupon.'" style="font-size:0.7rem" onclick="elimina_cupon_uso(\''.$id_uso_cupon.'\');" > <i class="fa-solid fa-eraser"></i> </button>
                                    '; 
                                
                             $banner_desc = '
                             
                            <div class="col-sm-12 " style=" width:100%; margin: 3px auto; padding: 15px; background: rgba(20,20,20, 0.4); border-radius:3px; "> 
                                <span class="elegant_title" style="margin-top:30px;" > Serie Premium </span>
                                
                            
                            </div>';
                                
                                $lbl_precio = '<label class="col-sm-8 text-muted">Donativo Serie Premium </label>
                                <label class="col-sm-4 text-muted">$ '.$precio_serie.' '.strtoupper($moneda_serie).'</label>
';
                                
                                 $lbl_cupon_act = '
        <div class="col-sm-8 text-success">Cupón: '.strtoupper($cupon).' <span class="text-danger">(-'.$desc_cup.'%)</span> </div>
        <div class="col-sm-4 text-danger">$ '.$mont_desc.' '.strtoupper($moneda_serie).' '.$btn_quitar_cupon.' </div> 
'; 	                    
                        
                            }else{
                                
                            
                            $precio_final = $precio_serie;
                            
                             $banner_desc = '
                             
                            <div class="col-sm-12 " style=" width:100%; margin: 3px auto; padding: 15px; background: rgba(20,20,20, 0.4); border-radius:3px; "> 
                                <span class="elegant_title" style="margin-top:30px;" > Serie Premium </span>
                                
                            
                            </div>';

                                $lbl_precio = '<label class="col-md-8 text-muted">Donativo Serie Premium </label>
                                <label class="col-sm-4 text-muted">$ '.$precio_serie.' '.strtoupper($moneda_serie).'</label>
';
                                
                                 $lbl_cupon_act = ''; 
                            
                            }
                        
                        }else{
                            
                            if($desc_serie != 0){
                            
                            $porcent = ($desc_serie/100);
                            $mont_desc = ($precio_serie * $porcent );
                            $precio_final =round(($precio_serie - $mont_desc),2);
                            
                            $banner_desc = '
                            <div class="col-sm-12 " style=" width:100%;  margin: 3px auto; padding: 15px; background: rgba(20,20,20, 0.4); border-radius:3px;"> 
                                <span class="elegant_title "> Serie Premium 
                                                            
                                <span class="text-light" style="" > [ - '.$desc_serie.'% ]</span> 
                                <span>'.$cadena.'</span>
                            </span>
                            </div>';
                        
                            }
                        }
                        
                    
                        //comprueba imagen para portada minimal 
                            $file = 'assets/images/portada_serie/'.$row['cve_lego'].'.jpg';


                            
                            if(file_exists($file)) {
                                   //echo "The file exists";
                                   $foto_portada = $row['cve_lego'].'.jpg';
                            } else {
                                
                                if(file_exists('assets/images/portada_serie/'.$row['cve_lego'].'.jpeg')){
                                    //echo "The file exists";
                                    $foto_portada= $row['cve_lego'].'.jpeg';
                                }else{
                                //echo "The file does not exist";
                                    //$foto_portada = '0.png';	
                                        if(file_exists('assets/images/portada_serie/'.$row['cve_lego'].'.png')){
                                            //echo "The file exists";
                                            $foto_portada= $row['cve_lego'].'.png';
                                        }else{
                                        //echo "The file does not exist";
                                            $foto_portada = '00.png';			
                                        }								    	
                                            
                                }
                            }		                    
                        /////	                        

                        /////// determina la proporcion de la foto 
                        
                        $path_final_portada = 'assets/images/portada_serie/'.$foto_portada;
                        
                        
                            $imagenb = getimagesize($path_final_portada);    //Sacamos la información
                             $anchob = $imagenb[0];              //Ancho
                             $altob = $imagenb[1];
                             
                             $proporcion = round(floatval(($anchob / $altob)),1);
                                    
                        $style_image = '';
                        
                        $debug_im = $ancho.'-'.$alto;
                       // var_dump($ancho);
                        if($proporcion <= 1.2 ){
                            $style_image = 'max-height: 150px; max-width:100px; '; 
                        }elseif($proporcion > 1.2 and $proporcion < 2){
                            $style_image = 'max-height: 80%; max-width: 95%;';
                        }else{
                            $style_image = 'max-height: 80%; max-width: 95%;';
                        }
                        
                        
                        /// valida si hay cupones activos. 
                        
                        
                        // 	$res = '1|'.$titulo.'|'.$descuento.'|'.$fini.'|'.$ffin;

                        
                        ///////                        
                           
$grid_body ='

    
    <div class="col-md-12 row center ">    
        
        <div class="col-md-5 "  style="height:500px; display:block;" > 
            
                <card class="col-md-12 grid-margin stretch-card " style="height:45%;"  >
                    <div class="card shelf_card" style="border: 0px solid rgba(200,200,200,0.9); border: 1px solid rgba(200,200,200, 0.8); border-radius:5px; background: #fff; " >
                         

                             <div class="hold_bg_conf" style="width:100%; border-radius:10px;">
                              <div class="bg_color_degradado" style="display:block;"> 
                                  <div class="back_color_main degrade" style="z-index: 88;" ></div>
                                 
                                <div class="back_color_main" style="background:linear-gradient(155deg, rgba('.$color_serie.', 0.7) 30%, rgba('.$colorb_serie.',0.6) 100%); height:100%; width:100%;" ></div>
                                   
                                <div class="col-sm-12 back_color_main imagen_serie" style="z-index: 79; " >
                                   <img class="image_portada " style="'.$style_image.'" src="'.$path_final_portada.'"  >									   		
                                </div>
                                   
                                
                                <div id="animation-arrow" class=" animate"></div>
                                
                            </div>
                            
                    </div>
                        
              
                    <div class="card-body card_body_main " style="margin-left:0px; text-align:center; border:0px solid #c40; " >
                        <h4 class="card-title card_title_main title_card_mosaico text-light ">
                            <b>'.$nombre_serie.' </b>	                    		 
                        </h4>
                            
                        <span style="margin-top:30px;" class="">'.$banner_desc.'</span> 
                        
                        
                    <div class=" center" style="position: absolute; bottom:5px; left:5px;">
                        
                            <span class="col-sm-1" style="z-index:999; font-size:0.8em;  color:rgba(250,250,250,0.4);" >
                                <i class="fa-solid fa-code"></i>
                            </span>
                            
                            <span id="code_serie" class="center" style=" font-size:0.8em;  color:rgba(250,250,250,0.4);" >'.$code_serie_acceso.' </span>
                             
                    </div>
                    
                    </div>
                </card>				
        </div>
    </div>
    
    <div class="col-sm-1 row " >
    </div>
            
    <div class="col-md-6 row " >

         

        <div class="col-lg-12 stretch-card" style="text-align:left; padding:5px;">
            <div class="card">
              <div class="card-body" style="padding-bottom: 10px;">
                <h4 class="card-title border-bottom"> <span class="text-success">PAGO ÚNICO</span> </h4>
                
                    <div class="row">
                        '.$lbl_precio.'	
                    </div>

                     <div class="row">
                        '.$lbl_cupon_act.'
                        <input type="hidden" id="perfil_elimina" value="0" />
                    </div>

                    <div class="row" style="margin-top:15px;">
                                <label class="col-md-6 lbl-form-control text-muted">Cupón: </label>
                                <input type="text" class="col-md-4 form-control border" id="cupon_serie" value="" placeholder="Introduce Código" >
                                <button class="btn btn-secondary" onclick="valida_cupon();"> Agregar</button>
                    </div>
                            
                    <div class="col-md-12" style="padding:10px;" id="res_valida_cupon" >  </div>

                     <div class="row border-top " style="margin-top:20px; padding-top:15px;">
                        <label class="col-sm-8"> <h4>Total</h4> </label><label class="col-sm-4"> <h4>$ '.$precio_final.' '.strtoupper($moneda_serie).'</h4></label>
                    </div>
                                      
              </div>
            </div>
          </div>
          
            

            
            <div class="col-md-12 " id="paypal_col" style="display:block; float;right; text-align:right;">
            
            <input type="hidden" value= "'.$user.'" id="user_premium" >
            <input type="hidden" value= "'.$row['cve_lego'].'" id="serie_premium" >

                    <span class="col-md-12">
                            '.form_paypal($row['cve_lego'],$precio_final,$moneda_serie).'
                    </span>
            
            </div>
            

                    
    
    </div>		

            '; 
                                     
                           
                           
                       
                       }elseif($bandera_serie > 0){ // 

                            //info Serie
    $data_color = get_info_serie($_GET['ref']);
                        
    $data = explode('/', $data_color);
    
    $nombre_serie = $data[0];
    $color_serie = $data[1];
    $fecha_serie = $data[2];
    $edo_serie = $data[3];
    $precio_serie = $data[4];
    $moneda_serie = $data[5];
    $desc_serie = $data[6];
    $colorb_serie = $data[14];

// termina info serie
                        
                        $num = $num + 1;
                        $index = $num-1;

                    
                    // Formato estandar es Webp

                           $dir= 'minifig/'.$row['cve_lego'];
                           $num_webp = count( glob($dir.'/{*.webp,*.WEBP}',GLOB_BRACE));

                           $total_minifig_serie = get_total_minifig($row['cve_lego']);

                           //var_dump($num_webp);


                            $format= '.webp';
                               $imagen = $row['imagen'];
                            $path_imagen = 'minifig/'.$row['cve_lego'].'/'.$imagen.$format;

                           if(file_exists($path_imagen)){
                               
                            $foto = $path_imagen;
                            //var_dump($row['cve_lego'].'- Existe;');
                           }else{

                               $num_png = count( glob($dir.'/{*.png,*.PNG}',GLOB_BRACE));
                               //var_dump($num_png);

                               if($num_png>0){
                                   $format= ".png";
                                   $imagen = $row['imagen'];
                                 $path_imagen = 'minifig/'.$row['cve_lego'].'/'.$imagen.$format;

                                    if(file_exists($path_imagen)) {
                                           //echo "The file exists";
                                           $foto = $path_imagen;

                                           //convierte a webp
                                           $img_webp = convert_to_webp_url($path_imagen);
                                             $foto = $img_webp;
                                          // var_dump($img_webp);
                                           //  var_dump($row['cve_lego'].'-Conversion;');
                                           
                                    } else {
                                           //echo "The file does not exist";




                                            $val = rand_me();
                                            $foto = image_back_minifig($val);
                                            //var_dump($row['cve_lego'].'-NO existe;');
                                            
                                          // $foto = 'minifig/minifig.png';
                                    }	
                               }



                           }

                        
                        // cruce con coleccion
                        $id_item_search = $row['id'].';'.$user.';'.$row['cve_lego']; 
                        
                        $datab = busca_coleccion($id_item_search ); 
                        //echo($data);
                        $data_coleccion = explode(';', $datab); 
                        
                        $faltantes = $data_coleccion[0]; 
                        $fecha_reg = $data_coleccion[1];
                        $estado_coleccion = $data_coleccion[2]; 
                        $fav = $data_coleccion[3];
                        $id_reg_col = $data_coleccion[4]; 

                        
                        if($estado_coleccion==0 or $estado_coleccion == ""){
                            $class_coleccion = 'no-show';
                        }else{
                            $class_coleccion = ""; 
                        }                     
                        
                        /// Ico favorito
                        $id_item = $row['id'].';'.$user;

                        if($fav==0){
                            $ico_fav = '<button type="button" onclick="edita_fav(\''.$id_item.'\')" style="position::absolute; top: 1px; right:1px; " class="btn btn-icons btn-outline-secondary btn-rounded " id="ico_fav_'.$id_item.'"> 
                                        <span > 
                                            <i class="fa-regular fa-heart"></i> 
                                        </span> 
                                        </button> <br>'; 

                            $search_fav = '';
                        }else{
                            $ico_fav = '<button type="button" onclick="edita_fav(\''.$id_item.'\')" style="position::absolute; top: 1px; right:1px; " class="btn btn-icons btn-outline-secondary btn-rounded " id="ico_fav_'.$id_item.'"> 
                                    <span class="" style="color: rgba('.$color_serie.',0.9);" > 
                                        <i class="fa-solid fa-heart"></i> 
                                    </span>  
                                </button> <br>'; 
                            $search_fav = 'favorito';

                        }
                        
                    
                        //////////////////////////
                        
                        //////////////// Nombre //////////
                        
                       $largo_title = strlen($row['nombre_'.$user_idiom]); 
                        if($largo_title <= 20){
                           $fontsize = '24px';
                           $class_tamfont = 'txt_large'; 
                           $param = 'nomcorto';
                           }else{
                           $fontsize = '20px';
                           $class_tamfont = 'txt_small'; 
                           $param = 'nomlargo';
                       }
                        
                        /////////////////////
                        

                        $parp_ant = $class_parp; 
                        // Funcion apara parpadeo de imagen
                        
                        $class_parp = rand_parpadeo(); 
                        
                        
                        if($class_parp == $parp_ant ){
                            $class_parp = rand_parpadeo(); 
                        }
                        
                        /////// Determin funcion para editar fig 
                        
                        if($GLOBALS['user'] == 1){ // admin
                            $fx_edita = 'edita_toggle(1)'; 
                        }elseif($GLOBALS['user']==0){
                            $fx_edita = 'edita_toggle(2)'; 
                        }
                        
                        
                        /////////////
                        /////////// Tipo de serie 
                        
                        $tipo_serie = get_tipo_serie($row['cve_lego']);
                        if($tipo_serie == 1){
                            $label_tipo = 'consecutiva'; 
                        }else if($tipo_serie == 2){
                            $label_tipo = 'tematica';
                        }elseif ($tipo_serie == 3){
                            $label_tipo = 'opcional';
                        }
                        
                        
                        /////////////
                        $item_buscado = busca_item($id_item);
                        
                        $data_itemb = explode('|',$item_buscado);
                        $estado_itm = $data_itemb[0];
                        $id_itm_coleccion = $data_itemb[1];
                        $fecha_coleccion = $data_itemb[2];
                                             
                        /// $view : 1. Coleccion ; 2. Edita serie; 3. Todas
                        
                        //var_dump($view);
                        
                        switch ($view){
                            
                            case 1: //Shelf
                                $fx_coleccion = ' onclick="item_select(\''.$row['id'].'\');" '; 
                                $class_edita = ''; 
                                $tamanio_card =3;
                                $no_show_class = '';
                                $tam_letra ='';
                                $margin = 'margin: 5px 0 5px 0px; ';
                                $bg_name = 'background: rgba(200,200,200,0.0); '; 
                                $bg_hover = ''; 
                                $fx_todas = '';
                                $fx_select ='';
                                $ico_add = ''; 
                            
                                if($estado_itm ==1){
                                    $value_item = 1; 
                                    $class_item = 'active_image';
                                    $class_star = 'active_star';
                                    $total_collect = $total_collect + 1; 
                                    $item_collected= $item_collected . $row['id'].';';
                                    $tag_status ="tengo";
                                    $estado_coleccion = 1;
                                    
                                    $ico_star = '<i  class="fa fa-star "> </i>';
                                    
                                    $ico_collect_stat = '<span style="color: rgba(64, 235, 52,0.7);"><i class="far fa-dot-circle  "></i> [found...] '; 
                                    
                                    $ico_coleccion_add = 'fa-solid fa-circle-minus';
                                    $color_ico  = '250,250,250';

                                    $num_current = $num_current  + 1;

                                     

                                }else{
                                    $value_item = 0; 
                                    $class_item = '';
                                    $class_star = 'ico-option diactive_star'; 
                                    $tag_status ="faltan";
                                    $ico_star = '<i  class="fa fa-star "> </i>';
                                    $ico_collect_stat = '<span style="color: rgba(255, 0, 0,0.7);"> <i class="fa fa-dot-circle  "></i> [missing...] </span>'; 
                                    $estado_coleccion = 0;
                                    
                                    $ico_coleccion_add = 'fa-solid fa-circle-plus';
                                    $color_ico  = $color_text;
                                    $num_current  = $num_current + 0;
                                } 
                                
                            
                            $cve_act = $row['cve_lego'];
                            

                            
                            if($cve_act != $cve_ant){
                            
                                if($css_user == 'tech'){
                                    $css .= '

                                    .bubble_text{
                                         background: rgba(122,222,255,0.2);
                                         '.$border.';
                                         color: rgba(0,0,0,0.5); 
                                     }'; 
                                    
                                }else{
                                    
                                    $css.='
                                    .bubble_text_'.$row['cve_lego'].'{
                                         background: rgba('.$color_serie.',0.6);
                                         color: rgba('.$color_text.',0.9);
                                         '.$border.';
                                     }
                                    ';
                                
                                }

                             
                             }
                             $cve_ant = $cve_act; 
                             
                             $option_edita='';
                                          
                            break; 
                            
                            case 2: // edita Serie
                            
                                    $rgba = rand_rgb(); 
                                    $class_edita = ' no-show '; 
                                    $fx_coleccion = ''; 
                                    $class_star .= ' no-show';
                                    $fx_todas = '';
                                    $fx_select = '';
                                    $class_item = 'active_image';
                                    $tamanio_card =3;
                                    $no_show_class = ' no-show ';
                                    $tam_letra = 'font-size: 12px; '; 
                                    $margin = 'margin: 2px 0 5px 0px; ';
                                    $bg_name = 'background: rgba(255,255,255,0.0); border-radius: 3px; padding: 2px 3px; ';
                                    $bg_hover = 'background: rgba('.$rgba.',0.6); width: 0%;'; 


                            $perfil = $GLOBALS['user_perfil'];
                             $permiso_elimina = get_permiso_config('2', $perfil);
                             
                             if($permiso_elimina==1){

                                $btn_elimina = '
                                    <span class="ico-option '.$class_sesion.'"  onclick="busca_item_colecciones(\''.$row['id'].'\'); " >
                                        <i class="fas fa-trash" ></i>
                                    </span>'; 									 
                             }else{

                                $btn_elimina = '';

                                                             
                             }

                            $admin_tools = $btn_elimina;
                                    
                
                $option_edita='
                <span class="ico-option '.$class_sesion.'"  onclick="'.$fx_todas.' edita(\''.$row['id'].'\'); crea_piezas(\''.$row['id'].'\'); '.$fx_edita.' '.$fx_select.'  " > 
                     <i class="fas fa-pencil-alt" ></i>
                </span>
                ';
                            
                            break; 
                            
                            case 3: // Todas las figuras
                            
                                $fx_coleccion = ' onclick="item_select(\''.$row['id'].'\');" '; 
                                $class_edita = ''; 
                                $tamanio_card =3;
                                $no_show_class = '';
                                $tam_letra ='';
                                $margin = 'margin: 2px 0 5px 5px; ';
                                $bg_name = 'background: rgba(200,200,200,0.0); '; 
                                $bg_hover = ''; 
                                $fx_select = 'genera_select_todas(\''.$row['id'].'\');';
                                
                            
                                if($estado_itm ==1){
                                    $value_item = 1; 
                                    $class_item = 'active_image';
                                    $class_star = 'active_star';
                                    $total_collect = $total_collect + 1; 
                                    $item_collected= $item_collected . $row['id'].';';
                                    $tag_status ="tengo";
                                    $estado_coleccion = 1;
                                    
                                    $ico_star = '<i  class="fa fa-star "> </i>';
                                    
                                    $ico_collect_stat = '<span style="color: rgba(64, 235, 52,0.7);"><i class="far fa-dot-circle  "></i> [found...] '; 
                                }else{
                                    $value_item = 0; 
                                    $class_item = '';
                                    $class_star = 'ico-option diactive_star'; 
                                    $tag_status ="faltan";
                                    $ico_star = '<i  class="fa fa-star "> </i>';
                                    $ico_collect_stat = '<span style="color: rgba(255, 0, 0,0.7);"> <i class="fa fa-dot-circle  "></i> [missing...] </span>'; 
                                    $estado_coleccion = 0;
                                } 
                                
                            
                            $cve_act = $row['cve_lego'];
                            
                            if($cve_act != $cve_ant){
                            
                                if($css_user == 'tech'){
                                    $css .= '

                                    .bubble_text{
                                         background: rgba(122,222,255,0.2);
                                         '.$border.';
                                         color: rgba(0,0,0,0.5); 
                                     }'; 
                                    
                                }else{
                                    
                                    $css.='
                                    .bubble_text_'.$row['cve_lego'].'{
                                         background: rgba('.$color_serie.',0.6);
                                         color: rgba('.$color_text.',0.9);
                                         '.$border.';
                                     }
                                    ';
                                
                                }

                             
                             }
                             $cve_ant = $cve_act; 
                             
                             
                             // TODAS 
                             
                             $fx_todas = 'pasa_serie(\''.$row['id'].'\');';
                             $ids = get_ids_current($row['cve_lego']);
                             $todas_minifig = $result->num_rows;

                             $option_edita='';
                             
                            break; 
                            
                            default: 
                                $class_edita = ''; 
                                $fx_coleccion = '';
                                $tamanio_card = 3; 
                                $bg_hover = ''; 
                                $fx_todas = ''; 
                                $option_edita='';
                            break;
                        }

                            // get Extras
                            $item = $user.';'.$row['id'];
                            $extra = get_extras($item);
                            
                            /////
                                                                             
                        if( $row['estado'] == 1){
                            $btn_estado = '<i class="fas fa-toggle-on"></i>'; 
                            $class_edo = "btn_activo"; 
                            $alt_btn = "Presiona para ocultar esta Minifigura";
                           // $ico_coleccion = 'fa-solid fa-circle-plus';
                            
                        }else{
                            $btn_estado = '<i class="fas fa-toggle-off"></i>'; 
                            $class_edo ="ico-option";
                            $alt_btn = "Presiona para mostrar esta Minifigura";
                            //$ico_coleccion = 'fa-solid fa-circle-minus';
                            
                        }

                            // Valida que exista la imagen webp

                    
                        
                        $id_item_general = $row['cve_lego'].'-'.$row['imagen'];
                        $nombre_serie = busca_serie($id_item_general);
                        $total_figs = get_total_minifig($row['cve_lego']);
                        
                        $tags = str_replace(", ", "- -", strtolower($row['tags']));
                        $tags = str_replace(",", "- -", strtolower($row['tags'])); 
                       // $tags = str_replace(" ", "-", $tags);
                        //$tags = str_replace("-","- -",$tags);
                        
                        $nom = str_replace(",", "- -", strtolower($row['nombre_es']));
                        //$nom = str_replace(" ", "-", $nom);
                        //$nom = str_replace("-","- -",$nom);

                        $nomb = str_replace(",", "- -", strtolower($row['nombre_en']));
                        //$nomb = str_replace(" ", "-", $nomb);
                        //$nomb = str_replace("-","- -",$nomb);
                        

                        $nom = quita_acento($nom);
                        
                        // Comprueba que exista folleto
                        
                        $path_folleto = 'assets/images/sheet/';
                        $file_folleto = $path_folleto.$serie_img.'.jpg';
                            
                            if(file_exists($file_folleto)){
                                //echo "The file exists";
                                $foto_folleto = $path_folleto.$serie_img.'.jpg';
                            } else {
                                
                                if(file_exists($path_folleto.$serie_img.'.png')){
                                    //echo "The file exists";
                                    $foto_folleto= $path_folleto.$serie_img.'.png';
                                }else{
                                //echo "The file does not exist";
                                    $foto_folleto = 'assets/images/noimage.png';			
                                }
                        
                            }
    
    //////
    
                                                            
                        $search= '-'.$row['id'].'- -'.$nom.'- -'.$nomb.'- -'.$num.'- -'.strtolower($nombre_serie).'- -'.$tags.'- -'.$tag_status.'- -'.$param.'- -'.$label_tipo.'- -'.$search_fav.'-';
                         
                        $mnu = $_GET['mnu']; 
                        $ref = $_GET['ref']; 
                        $cve = $_GET['cve']; 
                        
///INFO DEBUG
if($debub==1){
$code_show = '<span id="codev_'.$row['id'].'"  class="text-clear" style="position: absolute; font-size:9px;">
ID-COL:'.$row['id'].'<br>
'.$code_serie_acceso.' <br>
'.formatFechaHora($fecha_coleccion).'
</span>';
}else{
$code_show = '<span id="codev_'.$row['id'].'" class="text-clear" style="position: absolute; font-size:9px; display:none;">
ID-COL:'.$id_itm_coleccion .'<br>
ID-ITM:'.$row['id'].'<br>
'.$code_serie_acceso.' <br>
'.formatFechaHora($fecha_coleccion).'
</span>';
}
                        
                        
                        echo '<script type="text/javascript">
                        
                        </script>';
                         
                        $grid_body .= '
                                     
          <card class="col-md-'.$tamanio_card.' grid-margin stretch-card" id="holdcard-'.$row['id'].'" searchable="'.$search.'" >
           
               
           
            <div class="card card_figura" id="card-'.$row['id'].'" >
            <div class="back-color" style="'.$bg_hover.' " > </div>
            
            '.$debug_card.'
            
            
            
            <div class="item_dec stat" > <span class="parpadeab text"> '.$ico_collect_stat.' </span> </div>
                <div class="hover_imagen" '.$fx_coleccion.'  onmouseover="toggle(\'ico_add_minifig_'.$row['id'].'\');"  onmouseout="toggle(\'ico_add_minifig_'.$row['id'].'\')" >
                <div class="item_dec dec_a" ></div>
                <div class="item_dec dec_b" ></div>
                <div class="item_dec dec_c" ></div>
                <div class="item_dec dec_d" ></div>
                <div class="item_dec dec_e" ></div>
            
            </div>                
            
            <div class="imagen" style="width:38%; flex-grow:1;" > 
            
                <div style="border:0px solid #c4d;" class="picture_hold" onmouseover="toggle(\'ico_add_minifig_'.$row['id'].'\');"  onmouseout="toggle(\'ico_add_minifig_'.$row['id'].'\')"  >
                    
                    <div id="ico_add_minifig_'.$row['id'].'" style="position:absolute; width:50%; height:50%; top:35%; background:rgba(23,23,23,0.0); z-index:1110; text-align:center; margin-left:50%; left:-25%; display:none;" '.$fx_coleccion.' > 
                        
                        <span class="" id="ico_add_'.$row['id'].'" style="margin-top:50%; top:50%; color: rgba('.$color_ico.',0.9); " >
                            <i class="fa-solid '.$ico_coleccion_add.' fa-2x"></i> 
                        </span>
                    </div>
                    
                    
                    <img id="'.$row['id'].'" '.$fx_coleccion.' src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'" class="picture '.$class_parp.' '.$class_item.'" style="'.$margin.' padding:1px; "  >

                </div>

                <div class="table_fig"></div>
            
            </div>
            
              <div class="card-body-figura">
              
                  <div class="hold_options "  >
                          
                          <div style="position:absolute; top:2%; right:5%; z-index:999; ">
                              '.$ico_fav.' 
                          </div>

                          <span class="numero_item" style=""> 
                              <span class=" prompt_item"> 
                                  itm: <span class="parpadea" >_</span> 
                              </span>

                              <span class="num_itm_big"  > '.$num.' </span>

                          </span>

                        '.$option_edita.'
                        '.$admin_tools.'
                  </div>
              
             
              
              <div class="variables no-show">
               <textarea class="form-control no-show" id="piezas-chk-'.$row['id'].'" rows="2"> '.$check_piezas.'</textarea>
                  <input type="hidden" value="'.$row['nombre_es'].'" 	id="item-'.$row['id'].'" >
                  <input type="hidden" value="'.$value_item.'" 			id="estado-'.$row['id'].'" >
                  <input type="hidden" value="'.$num.'" 				id="numero-'.$row['id'].'" >
                  <input type="hidden" value="'.$index.'" 				id="index-'.$row['id'].'" >
                  <input type="hidden" value="'.$row['id'].'" 			id="id-'.$row['id'].'" >
                  <input type="hidden" value="'.$row['cve_lego'].'-'.$row['imagen'].'" id="sku-'.$row['id'].'" >
                  <input type="hidden" value="'.$nombre_serie.'-'.$row['cve_lego'].'" id="serie-'.$row['id'].'" >
                  <input type="hidden" value="'.$nombre_serie.'" 		id="serie-nombre-'.$row['id'].'" >
                  <input type="hidden" value="'.$row['cve_lego'].'" 	id="clave-'.$row['id'].'" >
                  <input type="hidden" value="'.trim($row['nombre_es']).'" id="nombre_es-'.$row['id'].'" >
                  <input type="hidden" value="'.trim($row['nombre_en']).'" id="nombre_en-'.$row['id'].'" >
                  <input type="hidden" value="'.$path_imagen.'" 		id="url-'.$row['id'].'" >
                  <input type="hidden" value="'.$faltantes.'" 			id="faltantes-'.$row['id'].'" >
                  <input type="hidden" value="'.$fecha_reg.'" 			id="fecha-'.$row['id'].'" >
                  <input type="hidden" value="'.$row['fecha_registro'].'" 			id="fechahora-'.$row['id'].'" >
                  <input type="hidden" value="'.$row['no_folleto'].'" 	id="folleto-'.$row['id'].'" >
                  <input type="hidden" value="'.$row['tags'].'" 		id="tags-'.$row['id'].'" >
                  <input type="hidden" value="'.$row['piezas'].'" 		id="pieces-'.$row['id'].'" >
                  <input type="hidden" value="'.$extra.'" 				id="extras-'.$row['id'].'" >
                  <input type="hidden" value="'.$estado_coleccion.'" 	id="status-coleccion-'.$row['id'].'" >
                  <input type="hidden" value="'.$ids.'" 				id="ids-current-'.$row['id'].'" >
                  <input type="hidden" value="'.$total_figs.'" 			id="total-fig-'.$row['id'].'" >
                  <input type="hidden" value="'.$todas_minifig.'" 		id="total-general-'.$row['id'].'" >
                  <input type="hidden" value="'.$color_serie.'" 		id="color-'.$row['id'].'" >
                   <input type="hidden" value="'.$colorb_serie.'" 		id="colorb-'.$row['id'].'" >
              </div>
              
                <h4 class="card-title-figura" style="'.$bg_name.'" >
                    <span class="'.$class_tamfont.' " style="color: rgba('.$color_text.',0.9); color: rgba(50,50,50,0.8);"  id="lblname-'.$row['id'].'" >'.ucwords($row['nombre_'.$user_idiom]).' </span>  
                </h4>
                

                
                
                
                <div class="media">
                  <div class="media-body">
                  
                    <p class="card-text">
                    
                    <span class="'.$no_show_class.'" >
                    <span class="bubble_text  bubble_text_'.$row['cve_lego'].'" onclick="toggle(\'codev_'.$row['id'].'\')" >'.$nombre_serie.'</span>
                    <span class="bubble_text  bubble_text_'.$row['cve_lego'].' " style="margin-left: 3px;" >'.$row['cve_lego'].'</span> 
                    <span class="no-show bubble_text  bubble_text_'.$row['cve_lego'].' " style="margin-left: 3px;" >'.$class_parp.'</span> 



                    <br>
                        '.$code_show.'
                    </span>                     
                        
                    </p>
                    
                  </div>
                </div>
              </div>
            </div>
          </card>
          ';
                        

                        
                        }
                        
                        $last = $current; 
                        $current = ''; 

                        $data_color = get_info_serie($row['cve_lego']);
                        
                        $data = explode('/', $data_color);
                        
                        $nombre_serie = $data[0];
                        $color_serie = $data[1];
                        $fecha_serie = $data[2];
                        $precio_serie = $data[4];
                        $moneda_serie = $data[5];
                        $desc_serie = $data[6];
                        $colortxt_serie = $data[13];
                        $colorb_serie = $data[14];    
                       }
                    
                    echo '<style>'.$css.'</style>';
                    
                    
                        
}else{
//	echo 'No hay registros que mostrar.';
//	include("inicio.php"); 
//$grid_body = '<h3> No hay minifiguras para esta opción </h3>';
//$progressbar
}


// Progress Info 
if($serie!=1){ // solo se ejecuta si se llama a una sola serie

$porcent = ($num_current*100)/$num;
$total_serie = $num;

$width_porcent = 100/$num;

for($i=0;$i<$num; $i++){

    if($i == 0){
            $round= 'border-radius: 10px 0 0 10px; '; 
    }else{
        $round= ''; 
    }

    if($i< $num_current){
        $bck_color = ' background: linear-gradient(90deg, rgba('.$color_serie.',1) 35%, rgba('.$color_serie.',1) 100%); ';
    }else{
        $bck_color = ' background: rgba('.$colorb_serie.',0.1); ';
    }
    
    $cuenta = $i+1;

    $txt_barra ='<div class="" style="width:100%; font-size:12px;  color: rgba('.$color_text.',0.9); margin: 0px 10px; float: right;"> '.$cuenta.' </div>';
    
    $barra.= '<div class="seccion-barra" style="'.$round.' text-align:right; border-left:1px solid rgba('.$color_serie.',0.5); border-right:1px solid rgba('.$colorb_serie.',0.5); margin-top:2px; '.$bck_color.' height:20px; width:'.$width_porcent.'%";  >'.$txt_barra.'</div>';
}

$hold_barra = '<div class="row hold-barra" id="hold_barra_serie" style="border:0px solid #c30; "> '.$barra.'</div>';

if($num_current == $num){
    $color_copa = 'background: rgba('.$color_serie.',1); ' ; 
}else{
    $color_copa = 'background: rgba('.$colorb_serie.',0.1); ' ; 
}

$id_config = 1; 
    $config_barra = get_estado_config($id_config,$GLOBALS['user']); 

    if($config_barra==1){
        $display_barra = 'display: flex; '; 
    }else{
        $display_barra = 'display: none; '; 
    }

$div_list = '<div class="border ; " style="background: rgba(23,23,23,0.9); left:0%; position:absolute; z-index:999999932499; color:#fff; "> 
                <div style="height: 400px: overflow:auto; scroll-y:hidden">'.$list.'</div>
                
                </div>'; 

// Valida QR de la serie 
$cve_user_serie = $serie.'_'.$user; 
$nombre_fichero = 'assets/images/qr_coleccion/col_'.$cve_user_serie.'.webp';

if (file_exists($nombre_fichero)) {

$codigo_qr = '<img style="height:70px;" class="qr_col_gral" id="qr_public_'.$serie.'" src="data:image/webp;base64,'.base64_encode(file_get_contents($nombre_fichero)).'" name="current" />'; 

} else {

$nombre_fichero_png = 'assets/images/qr_coleccion/col_'.$cve_user_serie.'.png';

if (file_exists($nombre_fichero_png)) {
        $qr_webp = convert_to_webp_url_gral($nombre_fichero_png);
}else{

$path_site = $GLOBALS['path_site']; 

    $url_ext = $path_site.'public.php?mnu=ad6051826fd849981914ccaddb7e5107&item='.$serie;

    //$qr_png= genera_qrcode_public_set($url_ext,$codigob);
    $qr_png = genera_qrcode_coleccion($url_ext,$cve_user_serie);
    //genera_qrcode_coleccion($content,$cve_user_serie){
    $qr_webp = convert_to_webp_url_gral($qr_png);
}

//src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'"

$codigo_qr = '<img style="height:70px;" class="qr_col_gral" id="qr_public_'.$serie.'" src="data:image/webp;base64,'.base64_encode(file_get_contents($qr_webp)).'" name="nuevo" />'; 
}

//




$space = '
<div style="width: 100%; position: relative; height: 30px; margin: 0px; display: block; background: rgba(28,75,234,0.0);"></div>

                        <div class="col-lg-12 text-clear no-show" style="text-align:center;" >
                            <span onclick="toggle(\'toggle_code\')">
                            <i class="fa fa-eye"></i>
                            </span>
                        
                            <div id="toggle_code" class="no-show">
                                '.$debug.'
                            </div>
                        </div>'.$div_list;


$progressbar = '
<div class="row">
<div class="col-md-10 margin-grid border-bottom" id="hold_coleccion" style="'.$display_barra.' background: rgba(160,160,160,0.08);" >
    <div class="col-md-11 bg-muted" style="display: block; padding: 5px 5px 8px 10px; text-align: center; border-radius: 25px; width: 100%; margin:27px 40px 27px 40px; padding: 5px 22px; border-bottom:1px solid #ddd; ">
            '.$hold_barra.'
    <div id="hold_copa">
            <div class="circle-award" style="border: 0px solid #ccc; text-align:center; vertical-align:middle; z-index:997; background:#ddd; position: absolute; right: -25px; top: -13px; padding:15px; width:60px; height:60px; border-radius:30px; font-size:30px; color: #aaa; ">

                <button type="button"  style="border: 0px solid #ccc; text-align:center; vertical-align:middle; z-index:997; '.$color_copa.' position: absolute; left: 0px; top:0px; padding:15px; width:60px; height:60px; border-radius:30px; font-size:30px; color: #aaa; " class="btn btn-icons btn-outline-secondary btn-rounded "> 
                    <span class="" style="margin-left:0px; margin-top:-11px; color: rgba('.$color_text.',0.9);"> 
                        <i class="fa-solid fa-award"></i> 
                    </span>  
                </button>
        </div>
    </div>

                <div class=""  >
                    <input type="hidden" id="total_serie_fig" value="'.$total_serie.'">
                    <input type="hidden" id="total_current" value="'.$num_current.'">
                    <input type="hidden" id="color_serie" value="'.$color_serie.'">
                    <input type="hidden" id="colorb_serie" value="'.$colorb_serie.'">
                    <input type="hidden" id="colortxt_serie" value="'.$colortxt_serie.'">
                    
                </div> 
    </div>

    <div class="col-md-12" style="height:30px;"> </div>
</div>

<div class="col-md-2 margin-grid border-bottom" style="'.$display_barra.' " >
    <div style="margin-top:8px;">'.$codigo_qr.'</div>
</div>
</div>
 ';                
}
return $progressbar.$space.$grid_body;

}

?>