<?php
	
	
	
?>


<div class="col-md-12" style="padding:0px; ">
<h4 class="col-md-12 p-2 title_sec grid-margin" >Contraseña</h4>

	<div class="col-md-12 " style="margin-top:10px;">


							<div class="row col-md-12 form-group  ">
								<p class="text-muted">
										Si quieres cambiar tu contraseña actual, llena los siguientes campos, de lo contrario déjalos en blanco.
								
								</p>											
							</div>


							<div class="row col-md-8 form-group  ">
								<label class="text-muted col-form-label col-sm-4">Contraseña </label>
								<input  autocomplete="off" type="password" autocorrect="on" maxlength="50" name="displayName" placeholder="Escribe nueva contraseña" spellcheck="true" id="p_pass"  type="text" dir="auto" data-focusable="true" class="form-control col-sm-6" value="">

								<label class="text-muted col-form-label col-sm-4">Repite Contraseña </label>
								
								<input  autocomplete="off" type="password" autocorrect="on" maxlength="50" name="displayName" placeholder="Repite nueva contraseña" spellcheck="true" id="p_pass_verifica" type="text" onblur="save_perfil_pass('<?php echo $GLOBALS['user'];?>');" dir="auto" data-focusable="true" class="form-control col-sm-6" value="">
													
							</div>	
							
							<div class="row col-md-12 form-group  ">
							<p style="font-size: 0.8em;">
								<span class="text-muted">Requerimientos de seguridad:</span> <br>
								<span id="req_a" class="text-clear"><i class="fa-regular fa-circle-check"></i> Mínimo 8 caracteres</span><br>
								<span id="req_b" class="text-clear"><i class="fa-regular fa-circle-check"></i> Deben coincidir</span><br>
								<span id="req_c" class="text-clear"><i class="fa-regular fa-circle-check"></i> Una mayúscula</span><br>
								<span id="req_d" class="text-clear"><i class="fa-regular fa-circle-check"></i> Un número</span><br>
								<span id="req_e" class="text-clear"><i class="fa-regular fa-circle-check"></i> Un caracter especial</span><br>
								<span id="req_f" class="text-clear"><i class="fa-regular fa-circle-check"></i> Una contraseña que no hayas ocupado antes</span>
								
							</p>
							</div>
</div>
</div>