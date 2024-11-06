<?php 
	
// Comprueba que exista una sesion iniciada
include("check_access.php");


$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
		      //informacion de acceso a la bd
		// Check connection
			if ($dbh->connect_error) {
		    	die("Connection failed: " . $dbh->connect_error);
			}
			
              $qb = "SELECT * FROM invitaciones order by fecha_registro desc";// preparando la instruccion sql

   
			    $resultb= $dbh->query($qb);
			    if ($resultb->num_rows > 0) {
				    
				    $no = 1; 
                        while($rowb= $resultb->fetch_assoc()){

                            $url_qr = 'assets/images/qr_invitacion/'.$rowb['folio'].'.webp'; 
                            if (file_exists($url_qr)) {
                                $qr_ico = '<span class="text-success" style="font-size:0.9rem;"><i class="fa-solid fa-qrcode"></i></span>';
                            }else{
                                $qr_ico = '<span class="text-clear" style="font-size:0.9rem;"> <i class="fa-solid fa-qrcode"></i> </span>';
                            }

	                                       	 								                  
                         if($rowb['correo']==''){
                            $mail = '<span class="text-clear" style="font-size:0.7rem;"> NO REGISTRADO</span>'; 
                            $btn_mail = '<button class="btn btn-inverse-secondary btn_thin" id="'.$rowb['id'].'">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>'; 

                         }else{
                            $mail = '<span class="text-muted" style="font-size:0.8rem;">'.$rowb['correo'].'</span>';
                            $btn_mail = '<button class="btn btn-inverse-primary btn_thin" id="'.$rowb['id'].'">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>'; 
                         }
                          
                         $info_cupon = get_info_cupon_id($rowb['id_cupon']);
                         $data_cupon = explode('|',$info_cupon);
                         $title = '<span style="font-size:0.9rem;">'.strtolower($data_cupon[8]).'</span>';
                         //$datos = $row['id'].'|'.$row['clave_serie'].'|'.$row['id_user'].'|'.$row['no_usos'].'|'.$row['fecha_inicio'].'|'.$row['fecha_fin'].'|'.$row['estado'].'|'.$row['descuento'].'|'.$row['titulo'];

                         $btn_genera = '<button class="btn btn-inverse-primary btn_thin" id="'.$rowb['id'].'" onclick="genera_invitacion(this.id);"><i class="fa-solid fa-envelope-open-text"></i></button>';

                         $url_print = $GLOBALS['path_site'].'public.php?mnu=c6c39fdb7b4dba0cb46ffee2d50a4015&ref='.$rowb['id']; 


									$permiso_elimina = get_permiso_config('38', $perfil);

									if($permiso_elimina==1){
										$btn_elimina = '<button class="btn btn-inverse-primary btn_thin" onclick="elimina_inv(\''.$rowb['id'].'-'.$rowb['folio'].'\');" > '.$ico_global_elimina.' </button>';
									}else{
										$btn_elimina = '<button class="btn btn-inverse-primary btn_thin" disabled> '.$ico_global_elimina.'</button>';
									}

                                    $btn_print = '<a href="'.$url_print.'" target="_blank" id="" class="btn btn-inverse-primary btn_thin">
                            <i class="fa-solid fa-print"></i>
                        </a>'; 

	                        $filas .= '
	                        <tr> 	                        	                     
	                        	
	                        	<td style="text-align:center;"> <span class="text-muted" > '.$no.'</span> </td>

								<td style="text-align:center;">
                                    <span class="text-muted" style="font-size:0.8rem;" >  '.$rowb['folio'].'</span>
                                </td>

                                <td style="text-align:center;"> <span style="font-size:0.8rem;" > '.$qr_ico.' </span> </td>

                                <td style="text-align:center;"> 
                                    <span class="text-muted" >'.$mail.'</span>                                
                                </td>

								<td style="text-align:center;"> <span class="text-muted" >'.$title.'</span></td>

                                <td style="text-align:center;">                                     
                                    <span class="text-muted" style="font-size:0.8rem;" >'.formatFechaHoraTable($rowb['fecha_registro']).'</span>
                                </td>

		                        <td>
			                          <div class="btn-group " role="group" aria-label="">
				                      '.$btn_genera.$btn_mail.$btn_print.'
				                      </div> 
				                      <div class="btn-group " role="group" aria-label="">
				                      '.$btn_elimina.'
				                      </div> 
								</td>
							
	                        </tr>
	                        
	                       
                        
	                        '; 
	                        $num = $num + 1;
	                        $no = $no + 1;
						}
						
						$table = '
	
								<table id="cupones" class="table table-striped table-bordered">
				                      <thead>
				                        <tr>
					                      <th class="thead_content" style=""> No </th>
										  <th class="thead_content" style=""> Folio </th>
                                          <th class="thead_content" style="center"> QR </th>
                                          <th class="thead_content" style=""> Correo </th>
										  <th class="thead_content" style=""> Cupón</th>
                                          <th class="thead_content" style=""> Fecha creado</th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </thead>
				                      
				                      <tbody >
				                      	'.$filas.'
				                      </tbody>

				                      <tfooter>
				                        <tr>
					                      <th class="thead_content" style=""> No </th>
										  <th class="thead_content" style=""> Folio </th>
                                           <th class="thead_content" style=""> QR </th>
                                          <th class="thead_content" style=""> Correo </th>
										  <th class="thead_content" style=""> Cupón</th>
                                          <th class="thead_content" style=""> Fecha creado</th>
				                          <th class="thead_content" style=""> Opciones</th>
				                        </tr>
				                      </tfooter>

				                </table>					
						
						';
                        $campo_buscar = crea_campo_buscar_cust('cupones',6); 
					
					}else{
						$table = '<div class="col-md-12 center text-muted"> <h4>Aún no hay invitaciones</h4> </div>';
                        $campo_buscar = '';
					}




?>


<div class="col-md-12 row ">
	<h4 class="col-md-12 p-2 title_sec"> Administrar Invitaciones </h4>
</div>  

<input id="bandera_actualiza" type="hidden" value="1">

<div class="row" style="padding: 0px; margin:0px;">
    <div class="col-12 border-right" style="padding: 0px; margin:0px;">
        <div class="col-6" style="margin-top:10px;">
                <?php
                
                    //echo $campo_buscar = crea_campo_buscar('cupones'); 
                    echo $campo_buscar;
                ?>
        </div>  

        <div class="col-10" style="height: 480px; overflow-y:auto; overflow-x:hidden;">
            <?php		
                
                echo $table;
            ?>
        </div>
    </div>

    <div class="col3 no-show " style="padding: 0px; margin:0px;">
                    <div class="tool_bar" >
                        <div class="btn-group " role="group" aria-label="">
                        <button type="button" id="screen_inv" class="btn btn-inverse-primary"> <i class="fa-solid fa-download"></i> </button>
                        
                        </div>
                    </div>

        <div id="despliega_invitacion" class="col-12" style="margin-top:10px; height:480px; padding:0px; background:rgba(23,45,230,0.0);">
                    <div id="hold_invitacion" class="border" style="width:97%;padding: 0px; margin:0px; background:rgba(255,255,255,1);">
                        <div class="row">
                            <div class="col-6 ">
                                <div class="col-12 " style="padding:5px; text-align:left; font-family:'Montserrat'; font-weight:200; margin-left:10px;"> ACCESO EXCLUSIVO</div>
                                  <div class="col-12 center">
                                        <span class="text-success" style="font-size:5.5rem; font-family:cursive_title; padding:10px; font-weight:600;">Gracias</span><br>
                                        <span class="text-success" style="font-size:1.1rem; font-family:'Montserrat'; margin-top:-10px; position:fixed; margin-top:-50px; margin-left:-25px; ">por tu compra</span>
                                  </div>
                                  <div class="col-12 center">
                                    <p style="font-size:0.9rem; line-height:1rem; font-family:'Montserrat'; ">Te regalamos un cupón para canjear en una colección</p>
                                  </div>
                                  <div class="col-12 center" style="margin-top:10px; margin-bottom:30px;">
                                    <span style="font-size:1.2rem; font-family:'Montserrat'; font-weight:600; ">CUPON</span>
                                  </div>

                            </div>
                            <div class="col-6">
                                <div class="col-12" style="padding:5px; text-align:right;"> <code style="margin-right:10px; font-size:1rem;">FOLIO</code></div>
                                <div class="col-12" style="text-align:center; margin-top:10px;">
                                    <img class="col-12" src="assets/images/qr_invitacion/qr_site.png" style="width:195px; margin:0px auto;" >
                                </div>
                                <div class="col-12 center">
                                
                                <p style="padding: 5px 15px; text-align:center; font-size:0.8rem; line-height:0.9rem; font-family:'Montserrat';">Escanea, registrate y prueba la version de escritorio beta.</p>
                                
                                  </div>
                            
                                
                            </div>
                        </div>
                        <div class="col-12 bg-success text-light center" style="padding:5px; font-family:'Montserrat'; font-weight:600;"> <?php echo $GLOBALS['sitio_web'];?></div>
                    </div>
            
        </div>
    </div>
</div>


<script type="text/javascript">
function capture_inv() {
    const captureElement = document.querySelector('#hold_invitacion') // Select the element you want to capture. Select the <body> element to capture full page.
    var name = document.getElementById('name_invitacion').value+'.png';
    html2canvas(captureElement)
        .then(canvas => {
            canvas.style.display = 'none';
            document.body.appendChild(canvas);
            return canvas;
        })
        .then(canvas => {
            const image = canvas.toDataURL('image/png');
            const a = document.createElement('a');
            a.setAttribute('download', name);
            a.setAttribute('href', image);
            a.click();
            canvas.remove();
        })
}

const btn = document.querySelector('#screen_inv');
btn.addEventListener('click', capture_inv);
</script>