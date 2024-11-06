<?php 
	
// Comprueba que exista una sesion iniciada
include("check_access.php");


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
$perfil_cve = $data_userb[6];
$fecha_reg = $data_userb[7];
$fecha_act = $data_userb[8];
$fecha_ban = $data_userb[9];
$estado = $data_userb[10];
$pass = $data_userb[11];

				
				
				if(isset($correo_cifrado)== TRUE){
					
					$table_recibos = get_access_info_user($id_user);
				}	
				

                     
?>



	
		<div class="col-md-12" >

        <h5 class="col-md-12  p-3 title_sec" > Historial de Acceso </h5>

                <div style="margin-top: 10px;">
                    <?php 
                        //echo $campo_buscar = crea_campo_buscar('admin_accesos'); 
                        echo $campo_buscar = crea_campo_buscar_cust('admin_accesos',3); 
                    ?>
                </div>
		
            <div style="height: 399px; overflow-x: hidden; overflow-y:auto; padding: 0px;">
		        <?php  echo $table_recibos;    ?>
            </div>
        		
		</div>
	
	
	
