<?php

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}
///////////////// 


$formato = $_POST['flatRadios'];

if(isset($formato)== FALSE or $formato == 0){
	$formatob = 1; 
	$select_corto = '';
	$select_largo = 'checked';

}else{
	$formatob = $_POST['flatRadios'];

	if($formato==1){
		$select_corto = 'checked';
		$select_largo = '';
	}else{
		$select_corto = '';
		$select_largo = 'checked';
	}


}




$user_id = $GLOBALS['user'];

/////// 

	$qset = "SELECT * FROM sets where id_user = $user_id and estado = 1 $order_q order by nombre asc ";// preparando la instruccion sql
	//echo $qset; 
	
	
	    $result= $dbh->query($qset);
	  //  var_dump($result); 
    if ($result->num_rows > 0) {
	  
	//echo   $result->num_rows; 
	





	    $tarjetas_ini = ""; 

                        while($rowb= $result->fetch_assoc()){
	                        
			
                        $lbl_barcodeb = genera_barcode_label_clavelego($rowb['cve_lego'],$formatob,$user_id);

						$todos_sets .= $rowb['cve_lego'].';';
						//var_dump($todos_sets); 
	                     
								
								$tarjetas_ini .= '
				<card class="col-sm-4 stretch-card lbl_main" id="set-'.$rowb['cve_lego'].'" searchable=" '.$rowb['cve_lego'].' '.$nvo_cve.''.$nvo_serie_id.''.$nvo_user_id.' '.strtolower($nombre_tema).' '.strtolower($rowb['nombre']).'" style="  margin-bottom:2px; box-shadow:none; " >
					<div class="card shelf_card" style="border: 1px solid rgba(200,200,200,0.9); border-radius:5px; background: #fff; " >

								
						'. $lbl_barcodeb.'
						
										                    
					</div>									
				</card>  
								'; 
								
							
							$num = $num +1;
	                    }// while
	                   
	                
	                   
		}else{ // resultados del query 
			$tarjetas_ini = '
			
			<div class="col-lg-12 center" style="margin-top:10%;">
				<span class="text-neutral"> Sin sets en la colección</span>
			</div>
			';
		}

/////

if($user_id != 0){
//	echo 'Hola mundo';

$display = 'Hola Mundo';
$display = $tarjetas_ini;
}elseif ($user_id==0){

//echo '<div class="scrollable" style="height:100%;" >'.$tarjetas_ini.'</div> hola mundo ';
	$display = 'Adios Mundo';
	$display = $tarjetas_ini;
}

 
 $todos_sets = substr($todos_sets,0,-1);

//https://bricksidemx.com/collector/public.php?mnu=cd5f90d1197d987d093045dd1c50e22a&token=JpW8bmDw2Df9fCmANvnZXylB


$perfil_user = $GLOBALS['user_perfil'];
$permiso_public =  get_permiso_pagina(121,$perfil_user);

if($permiso_public==1){
    $token = get_info_link($user_id);
    $url_ext = $path_site.'public.php?mnu=2dae777ac4242728452133f21de5f6a4&token='.$token;

    $btn_ext = ' <a class="btn btn-inverse-primary text-primary" href="'. $url_ext.'" target="_new" style="float: right;"> 
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                    ';
}else{
    $btn_ext = '';
}



/////

$mnu = $_GET['mnu'];
$cve = $_GET['cve'];



$current_url = $GLOBALS['path_site'].'index.php?mnu='.$mnu.'&cve='.$cve;

 $sitio_web = $GLOBALS['sitio_web'];
 $logo_lbl = $GLOBALS['logo_lbl'];

?>
        
           
            <div class="row oculto-impresion" style="height:490px;">
              	
                  <div class="col-md-3 oculto-impresion bg-light " style="padding:0px;  ">              		
              		
                <div class="mnu_bar bg-head">
                    <div class="btn-group-bar">
                        <button type="button" onclick="toggle_panel(1);" class="btn btn-inverse-primary btn_menubar_sm mnuadmin_sm"><i class="fa-solid fa-filter"></i></button>
                        <button type="button" onclick="toggle_panel(2);" class="btn btn-inverse-primary btn_menubar_sm mnuadmin_sm"><i class="fa-solid fa-tags"></i></button>
                    </div>
                </div>

                <div class="bg-light" style="overflow:auto; overflow-y:auto; overflow-x:hidden;">

                    <input type="hidden" id="mode_panel" value="v">
                    <input type="hidden" id="title_web" value="<?php echo $sitio_web; ?>">
                    <input type="hidden" id="logo_lbl" value="<?php echo $logo_lbl; ?>">
                    
                        <!-- Panel 1-->
                    <div class="col-md-12 border panel" id="panel_1" style="padding: 0px; display:block;">
	              	    <div class="col-md-12 p-2  subtitle_sec"> <b> Sets </b> </div>
		              	<input type="hidden" value="<?php echo $todos_sets; ?>" id="todos_sets" name="">
		              	
		              	<p class="col-sm-12 text-muted col-form-label" style="font-size:0.7rem; ">Introduzca la lista de sets a buscar, ocupe un renglón para cada uno.</p>

		              	<textarea class="col-md-12 border" id="sets_custom" cols="" rows="4" onkeyup="filtrar_sets_unicos();" ></textarea> 

                          <div class="col-md-12 p-2  subtitle_sec"><b> Cantidad </b> </div>
						<div id="form_cant" style="height: 200px; overflow: scroll; overflow-x: hidden; overflow-y: auto;" > </div>

					 </div> <!-- fin panel 1-->

                     <!-- Panel 2-->
                     <div class="col-md-12 border panel" id="panel_2" style="padding: 0px; display:none;">
                        <div class="col-md-12 p-2  subtitle_sec"> <b> Formato del Código </b> 

		              	</div>		              	
		              	
			            <div class="col-md-12 border" id="formato_codigo" style="" >
			              	<form  name="check_barcode" id="flatRadios" method="post" action="<?php echo $current_url;?>">
								<div class="form-group">
		                            <?php echo genera_radiobtn_tipocodigo(2,$formato); ?>
		                         </div>
		                    </form>
		                </div>
                     </div><!-- fin panel 2-->

							

					<div class="col-md-2 no-show" id="new_labels"> </div>					
				</div>
                </div>                
             
                <div class="col-sm-9 grid-margin bg-light" id="card_body" style=" overflow: hidden; height:500px;">	   
                
                <h5 class="col-md-12 p-2 title_sec gb-head " style="margin-bottom:10px;"> Etiquetas 

                	<!--<a class="btn btn-outline-primary text-primary" href="<?php echo $url_ext; ?>" target="_new" style="float: right;"> 
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>-->
                    <?php echo $btn_ext; ?>
                </h5> 
                    <div style=" overflow:scroll; overflow-x: hidden; overflow-y: auto; height:430px;">       
	                 <?php echo $display; ?>	
                     </div>                 
                </div>
            </div>