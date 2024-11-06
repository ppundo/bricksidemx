<?php
	
//include('minifigures.php');
	
$info_userb = busca_user($GLOBALS['user']);

//var_dump($user);

$data_userb = explode('--', $info_userb);

$error = $data_userb[0];
$nombre = $data_userb[1];
$correo = $data_userb[2];
$userb = $data_userb[3];
$foto = $data_userb[4];
$id_user = $data_userb[5];
	
$user_sesion_correo = $correo;
	
	?>
<div class="col-md-12" style="padding:0px; ">
<h4 class="col-md-12 p-2 title_sec grid-margin" >Cuenta</h4>

	<div class="col-md-12 " style="margin-top:10px;">
					
		<div class="row col-md-12 form-group  ">								
			<label class="text-muted col-form-label col-sm-3">Usuario </label>
								
				<div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" autocomplete="off" autocorrect="on" maxlength="50" name="Usuario" placeholder=" Usuario" spellcheck="true" type="text" dir="auto" id="usuario" data-focusable="true" onblur="save_perfil_user(<?php echo $GLOBALS['user']?>);" class="form-control col-sm-12" value="<?php echo $userb;?>">
                    </div>
                </div>
                        
		</div>

							
		<div class="row col-md-12 form-group  ">
			<label class="text-muted col-form-label col-sm-3">Correo </label>
			<label class="col-form-label col-sm-6 text-gris"> <?php echo $user_sesion_correo; ?> <span class="text-gris" title="No es posible cambiar tu correo electrónico"> <i class="fa fa-ban"></i></span> </label>
			<small class="col-md-12 text-info no-show">Esta información no es posible modificarla.</small>													
		</div>	
							
	</div>
</div>