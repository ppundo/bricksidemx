

<?php
include("minifigures.php");
include("globals.php");


$formato = $_POST['flatRadios'];
$orden = $_POST['ordena_lbl'];


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
//////////////////

if($orden==1){
    $query = 'order by nombre asc';
}elseif($orden==2){
    $query = 'order by id_tema asc';
}elseif($orden==3){
     $query = 'order by cve_lego asc';    
}else{
     $query = 'order by id asc';
}




$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}
///////////////// 

	$token = $_GET['token'];

		$q = "SELECT * FROM token_user WHERE token = '$token' and estado = 1;";// preparando la instruccion sql

    $result= $dbh->query($q);
    if ($result->num_rows > 0) {
        
         
        $row= $result->fetch_assoc();
       
        $user_id = $row['id_user'];
        
        $user_info = busca_user($user_id);
        $data_user = explode('--', $user_info);
        
        $nombre = $data_user[1];
        $lbl_barcodeb ="";
        
        
	                        
	}else{
		$user_id = 0;
	}



$tarjetas_ini = "";

/////// 

	$qc = "SELECT * FROM sets where id_user = $user_id and estado = 1 ".$query.";";// preparando la instruccion 
	//var_dump($qset);

	$resultc= $dbh->query($qc);

    	if ($resultc->num_rows > 0) {
			
			while($rowb= $resultc->fetch_assoc()){
	                        
	    		$lbl_barcodeb = genera_barcode_label_clavelego($rowb['cve_lego'],$formatob,$user_id);	

					$todos_sets .= $rowb['cve_lego'].';';
						//var_dump($todos_sets); 
	                     
					$tarjetas_ini .= ' 
					
					<card class="col-sm-4 stretch-card center " id="set-'.$rowb['cve_lego'].'" searchable="'.$rowb['cve_lego'].'" style=" width:40%; margin-bottom:2px; box-shadow:none; " >
												
						<div class="card shelf_card " style=" border: 1px solid rgba(200,200,200,0.9); border-radius:5px; background: #fff; " >

						'.$lbl_barcodeb.'	
																					                    
						</div>									
					</card>'; 

		$num = $num +1;
	        }// while
	                   
	                
	                   
		}else{ // resultados del query 
			$tarjetas_ini = '
			
			<div class="col-lg-12 center" >
			<span class="text-neutral"> Sin sets en la colección </span>
			</div>
			';
		}

/////

if($user_id != 0){
//	echo 'Hola mundo';

//$display = 'Hola Mundo';
$display = $tarjetas_ini;
}elseif ($user_id==0){

//echo '<div class="scrollable" style="height:100%;" >'.$tarjetas_ini.'</div> hola mundo ';
	//$display = 'Adios Mundo';
	$display = $tarjetas_ini;
}

 
 $todos_sets = substr($todos_sets,0,-1);

$mnu = $_GET['mnu'];
$cve = $_GET['cve'];
$token= $_GET['token'];

 $current_url = $GLOBALS['path_site'].'public.php?mnu='.$mnu.'&token='.$token;

 $sitio_web = $GLOBALS['sitio_web'];
 $logo_lbl = $GLOBALS['logo_lbl'];

?>

             
                
              	<div class="col-md-12 oculto-impresion grid-margin " style="">
              		
              		<div class="row">	              		
                        <input type="hidden" id="mode_panel" value="h">
                        <input type="hidden" id="title_web" value="<?php echo $sitio_web; ?>">
                        <input type="hidden" id="logo_lbl" value="<?php echo $logo_lbl; ?>">
	              		
	              		<div class="col-md-3 border" style="padding:0px;">
	              			<div class="col-md-12 p-2  subtitle_sec"> Sets</div>
		              		<input type="hidden" value="<?php echo $todos_sets; ?>" id="todos_sets" name="">		              		
		              		<textarea class="col-md-12 border" style="height:auto;" id="sets_custom" onkeyup="filtrar_sets_unicos();" cols="" rows="5" ></textarea> <br>
		              		
						</div>

	              		<div class="col-md-2 border" style="padding:0px;">
	              			<div class="col-md-12 p-2  subtitle_sec"> Opciones</div>
		
						
		              	
				              	<form name="check_barcode" id="flatRadios" method="post" action="<?php echo $current_url;?>">
				              	<div class="col-md-12 " >

									<div class="form-group">
                                        <span class="col-sm-12 text-muted col-form-label" style="font-size:0.7rem; ">Formato del Código:</span>
			                           <?php echo genera_select_tipo_codigo($formato); ?>

			                        
                                        <span class="col-sm-12 text-muted col-form-label" style="font-size:0.7rem; ">Ordenar por:</span>
			                          
                                            <select class="form-control" name="ordena_lbl" onchange="this.form.submit()" id="ordena_lbl">
                                            <option value="0" selected >Elije...</option>
                                            <option value="1">Nombre</option>
                                            <option value="2">Tema</option>
                                            <option value="3">Clave</option>
                                            <option value="4">Codigo</option>
                                            </select>

			                          </div> 
			                      </div>
			                  </form>

						</div>

						<div class="col-sm-7 border" style="padding:0px;" >
							<div class="col-md-12 p-2  subtitle_sec"> Cantidad</div>
							<div id="form_cant" style="height: 150px; overflow: scroll; overflow-x: hidden; overflow-y: auto;" ></div>
						</div>

                        <div class="col-md-4 no-show" id="new_labels"></div>
					</div>
                </div>

                <hr class="oculto-impresion">
                
              
                <div class="card-body" id="card_body">	                  
	                 <?php echo $display; ?>	                 
                </div>

<script>
        function getRadioButtonSelectedValue(ctrl){
    for(i=0;i<ctrl.length;i++)	
        if(ctrl[i].checked) return ctrl[i].value;
}


function ventanaCodebar_(URL){ 
	var tipocode= getRadioButtonSelectedValue(document.check_barcode.flatRadios);
	var format = '';

    if(tipocode===undefined){
        tipocode = document.getElementById('flatRadiosb').value;
    }


URL = URL+'&format='+tipocode;

   window.open(URL,"ventana1","width=250,height=150,scrollbars=NO,resizable=NO,title=Imprime Código de Barras,location=no,top=80,left=100") 
} 


</script>         
             
       

<!--
            <div class="row">
              	<div class="col-md-3 oculto-impresion grid-margin bg-light " style="padding:10px; 0px;">              		
              		
                    <input type="hidden" id="mode_panel" value="v">
                    
                    <div class="col-md-12 border" style="padding: 0px;">
	              	    <div class="col-md-12 p-2  subtitle_sec"> <b> Sets </b> </div>
		              	<input type="hidden" value="<?php echo $todos_sets; ?>" id="todos_sets" name="">
		              	<textarea class="col-md-12 border" id="sets_custom" cols="" rows="6" onkeyup="filtrar_sets();" ></textarea> 
					 </div> 

					<hr>		
					<div class="col-sm-12 border"style="padding: 0px; margin-top:10px;">
						<div class="col-md-12 p-2  subtitle_sec"><b> Cantidad </b> </div>
						<div id="form_cant" style="height: 200px; overflow: scroll; overflow-x: hidden; overflow-y: auto;" > </div>
					</div>

					<div class="col-md-2 no-show" id="new_labels"> </div>					
				</div>              
             
                <div class="col-sm-9" id="card_body" style="margin-top:10px;">	                  
	                 <?php echo $display; ?>	                 
                </div>
            </div>
            -->
              

