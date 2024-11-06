
<?php
	
	$permit = get_permiso_config(9,$GLOBALS['user_perfil']); 
	
	//var_dump($permit);
	
	if($permit==1){
		
		$adv = '<div class="col-md-12 p-2  bg-warning center text-sm"> <i class="fa-solid fa-triangle-exclamation"></i> Si actualizas este dato, deberás reiniciar sesión.</div>
'; 

		$master = '
					
					<div class="row col-md-12 form-group  ">								
						<label class="text-muted col-form-label col-sm-6">Contraseña Maestra </label>								
						<input  autocomplete="off" type="password"  maxlength="50" name="displayName" placeholder="Escribe contraseña maestra" spellcheck="true" id="masterpass"  type="text" dir="auto" data-focusable="true" class="form-control col-sm-6" onblur="save_perfil_masterpass(<?php echo $user; ?>);" value="">
					</div>			
		'; 
		
		$master_conf = '
					<div class="row col-md-12 form-group  ">								
						<label class="text-muted col-form-label col-sm-6">Confirma Contraseña </label>		
						<input autocapitalize="sentences" autocomplete="off" type="password" autocorrect="on" maxlength="50" name="displayName" placeholder="Repite contraseña maestra" spellcheck="true" id="masterpass_verifica" type="text" onblur="save_perfil_masterpass(<?php echo $user; ?>);" dir="auto" data-focusable="true" class="form-control col-sm-6" value="">								
					</div>		
		';

$req = '
							<div class=" col-md-12">
								<p class="title-card" style="font-size: 0.8em;">
									<span class="text-muted">Requerimientos de seguridad:</span> <br>
									<span id="reqm_a" class="text-clear"> <i class="fa-regular fa-circle-check"></i> Mínimo 8 caracteres</span><br>
									<span id="reqm_b" class="text-clear"> <i class="fa-regular fa-circle-check"></i> Deben Coincidir</span><br>
									<span id="reqm_c" class="text-clear"> <i class="fa-regular fa-circle-check"></i> Una Mayúscula</span><br>
									<span id="reqm_d" class="text-clear"> <i class="fa-regular fa-circle-check"></i> Un Número</span><br>
									<span id="reqm_e" class="text-clear"> <i class="fa-regular fa-circle-check"></i> Un Caracter Especial</span>
									
								</p>
							</div>

';
		
	}else{
		$master = '

				<div class="row col-md-12 form-group center  ">								
						<label class="text-muted col-form-label col-sm-12" style="margin-top:50px;"> No tiene permiso para acceder a esta opción.<br><br> 
						<span class="text-gris">Ponte en contacto con el administrador del sistema.</span>
						 </label>
				</div>
		
		';
		
		$master_conf='';
		$req = '';
	}
	
?>


<div class="col-md-12" style="padding:0px; ">
<h4 class="col-md-12 p-2 title_sec grid-margin" >Contraseña Maestra</h4>

	<?php echo $adv; ?>

	<div class="col-md-8 " style="margin-top:10px;">

		<?php echo $master.$master_conf.$req; ?>
	</div>		
</div>			
								
		
							
