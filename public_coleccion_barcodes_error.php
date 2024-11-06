

<?php
include("minifigures.php");
include("globals.php");

	$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);

if ($dbh->connect_error) {
	   die("Connection failed: " . $dbh->connect_error);
}
///////////////// 

	$token = $_GET['token'];
		if ($dbh->connect_error) {
		    die("Connection failed: " . $dbh->connect_error);
		}
		$q = "SELECT * FROM token_user WHERE token = '$token' and estado = 1;";// preparando la instruccion sql

    $result= $dbh->query($q);
    if ($result->num_rows > 0) {
        
         
        $row= $result->fetch_assoc();
       
        $user_id = $row['id_user'];
        
        $user_info = busca_user($user_id);
        $data_user = explode('--', $user_info);
        
        $nombre = $data_user[1];
                               
	}else{
		$user_id = 0;
	}




/////// 

	$qset = "SELECT * FROM sets where id_user = $user_id and estado = 1 order by id_tema;";// preparando la instruccion sql
	//echo $qset; 
	
	
	    $result= $dbh->query($qset);
	  //  var_dump($result); 
    if ($result->num_rows > 0) {

	    $tarjetas_ini = ""; 

          while($rowb= $result->fetch_assoc()){
	                        
			$lbl_barcode = genera_barcode_label_clavelego($rowb['cve_lego'],2);
			//var_dump($len_id_serie);
		

						$todos_sets .= $rowb['cve_lego'].';';
						//var_dump($todos_sets); 
	                     
								$tarjetas_ini .= '
								<card class="col-sm-4 stretch-card " id="set-'.$rowb['cve_lego'].'" searchable="'.$rowb['cve_lego'].'" style=" width:40%; margin-bottom:2px; box-shadow:none; " >
									<div class="card shelf_card" style="border: 1px solid rgba(200,200,200,0.9); border-radius:5px; background: #fff; " >

										'.$lbl_barcode.'														



															
								<input type="hidden" value="'.$nvo_cve.''.$nvo_serie_id.''.$nvo_user_id.'" id="code_'.$rowb['cve_lego'].'">
								<input type="hidden" value="'. strtoupper(substr($rowb['nombre'], 0,35)).'</span>" id="nomcode_'.$rowb['cve_lego'].'">
								<input type="hidden" value="'. strtoupper($nombre_tema).'</span>" id="temacode_'.$rowb['cve_lego'].'">		
																		                    
									</div>									
								</card>
								'; 
								
								

	                    
							
							$num = $num +1;
	                    }// while
	                   
	                
	                   
		}else{ // resultados del query 
			$tarjetas_ini = '
			
			<div class="col-lg-12 center" >
			<span class="text-neutral"> No es posible mostrar esta página. </span>
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

 
?>

             
                
              	<div class="col-md-12 oculto-impresion grid-margin " style="">
              		
              		<div class="row">	              		
                        <input type="hidden" id="mode_panel" value="h">
	              		
	              		<div class="col-md-3 border" style="padding:0px;">
	              			<div class="col-md-12 p-2  subtitle_sec"> Sets</div>
		              		<input type="hidden" value="<?php echo $todos_sets; ?>" id="todos_sets" name="">		              		
		              		<textarea class="col-md-12 border" id="sets_custom" onkeyup="filtrar_sets();" cols="" rows="5" ></textarea> <br>
		              		<input class=" btn btn-block btn-inverse-primary" type="button" value="Filtrar" name="" onclick="filtrar_sets();">
						</div>
										
						<div class="col-sm-9 border" style="padding:0px;" >
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
              

