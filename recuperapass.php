
<?php
	
	//include('minifigures.php');
	//		$GLOBALS['action_reset'] = $action_reset; 
	//		$GLOBALS['user_ref'] = $user_ref;
		
	$accion = $GLOBALS['action_reset']; 
	
	
	
	if($accion==1){ // Activa y resetea contraseña
		
		$user_ref = $GLOBALS['user_ref']; 
		
		if($user_ref != "" or $user_ref != 0 ){
			
				$title_form ='Restablece Contraseña';
						//$datos_encontrados= $error.'-'.$nombre.'-'.$correo.'-'.$user_name.'-'.$foto;
				$data = explode('-', busca_user_cifrado($user_ref));
				
				$error = $data[0];
				$correo = $data[2];
				
				if($error==1){
					$error_message = '
                  <label class="badge-danger" style="border-radius: 5px; padding: 5px;" >Un error de identificación ha ocurrido, reinicie el proceso para re establecer su contraseña.</label> ';
				}else{
				
				$campo_pass = '
				 <div class="form-group">
		                    <div class="input-group minimalist">
		                      <input id="reset_pass" type="password" autocomplete="off" class="form-control minimalist" placeholder="contraseña">
		                    </div>
		                    
		                  </div>
		                  <div class="form-group">
		                    <div class="input-group minimalist">
		                      <input  id="reset_pass_confirm" type="password" autocomplete="off" class="form-control minimalist" placeholder="confirma contraseña">
		                    </div>
		                  </div>
				
				'; 
				
				$button_reset = '<button class="btn btn-secondary submit-btn btn-block" type="button" onclick="active_account();">Actualizar Contraseña</button>'; 
				
				$status_fiel = "disabled";
				$error_message="";
				}
		}else{
			header('Location: index.php');
			
		}
		
	}else{
		
		$campo_pass = ''; 
		$button_reset = '<button class="btn btn-secondary submit-btn btn-block" type="button" onclick="recupera_pass();">Restablecer Contraseña</button>'; 
		$title_form ='¿Has olvidado tu contraseña?';
		$correo= "";
		$status_fiel = "";
	}
	
	
	?>


            <div class="col-lg-4 mx-auto bg_inicio">
              <h2 class="text-center mb-4 theme-title"> <?php echo $title_form ?></h2>
              <div class="auto-form-wrapper" style="padding: 15px;">
                
                <div class="form-group text-center" id="error_display" >
                <?php echo $error_message ?>
                </div>
                  
                  <div class="form-group">
                    <div class="input-group minimalist">
                      <input id="recupera_email" autocomplete="off" <?php echo $status_fiel; ?> type="email" class="form-control minimalist" placeholder="correo@dominio.com" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" value="<?php echo $correo; ?>">
                      
                      
                    </div>
                  </div>
                  
                  <?php echo $campo_pass ?>
                
                  <div class="form-group">
                   <?php echo $button_reset ?> 
                  </div>
                  
                  <div class="text-block text-center my-3">
                    <span class="text-small font-weight-semibold"> Ya tienes una cuenta ?</span>
                    <a href="index.php?set=0&access=1" class="link-theme text-small"> Entrar </a>
                  </div>
                
              </div>
            </div>
          