<?php
	

$ops_serie = genera_select_series($current);

$ops_user = genera_select_usuarios($current);

$ops_dcto = genera_select_dcto($current);
$hoy = date('d/m/Y');
//var_dump($hoy);
?>
	
	<h4 class="col-md-12 p-2 title_sec"> Nuevo Cupón</h4>

	<div class="tool_bar">
		<button class="btn btn-inverse-primary " style="height: 30px; margin-left: 30px;" onclick="save_cupon(0)"> <?php echo $ico_global_save ?></button>	
	</div>


	<div class="col-sm-12 row " style="border: 0px solid #c30; z-index: 999; margin-top: 20px; height: 430px; overflow: scroll;  overflow-y: auto; overflow-x: hidden; "  >
				
				<div class="col-md-3 " style="height: 380px;">
							
							<div class="col-md-12 grid-margin-md ">								
								<div class="row ">
									<label class="text-muted col-form-label col-md-12 lbl_form_sm"> Código </label>
									<input autocapitalize="sentences" autocomplete="off"  autocorrect="on" maxlength="50" name="displayName" placeholder="Nombre Cupon" spellcheck="true" type="text" dir="auto" data-focusable="true"  id="cupon_nvo_nombre" class="form-control " value="">
								</div>

							</div>
							
							<div class="col-md-12 grid-margin-md ">								
								<div class="row ">
									<label class="text-muted col-form-label col-md-12 lbl_form_sm"> Serie </label>																	
									<select class=" form-control" id="cupon_nvo_serie">
										<?php echo $ops_serie; ?>
									</select>
								</div>

							</div>
							
							<div class="col-md-12 grid-margin-md ">								
								<div class="row ">
									<label class="text-muted col-form-label col-md-12 lbl_form_sm"> Usuario Destino</label>
									<select class=" form-control" id="cupon_nvo_usuario">
										<?php echo $ops_user; ?>
									</select>
								</div>

							</div>

							<div class="col-md-12 grid-margin-md ">								
								<div class="row ">
									<label class="text-muted col-form-label col-md-12 lbl_form_sm"> ¿Cuántas veces pondrá aplicarlo el usuario?</label>
									<input autocapitalize="sentences" autocomplete="off"  autocorrect="on" maxlength="50" name="displayName" placeholder="No " spellcheck="true" type="number" dir="auto" data-focusable="true"  id="cupon_nvo_usos" class="form-control " value="1">
								</div>

							</div>
							
				</div>
				<div class="col-md-3" style="height: 380px;">

							<div class="col-md-12 grid-margin-md ">								
								<div class="row ">
									<label class="text-muted col-form-label col-md-12 lbl_form_sm"> Fecha de inicio </label>
									<input id="cupon_nvo_fini" autocapitalize="sentences" autocomplete="off"  autocorrect="off" maxlength="50" name="displayName" placeholder="Código Postal" spellcheck="true" type="date" dir="auto"  data-focusable="true" class="form-control "  value="<?php echo $hoy;?>">
								</div>

							</div>

							<div class="col-md-12 grid-margin-md ">								
								<div class="row ">
									<label class="text-muted col-form-label col-md-12 lbl_form_sm" onblur="valida_fechas_cupon();"> Fecha de final</label>
									<input id="cupon_nvo_ffin" autocapitalize="sentences" autocomplete="off"  autocorrect="off" maxlength="50" name="displayName" placeholder="Código Postal" spellcheck="true" type="date" dir="auto"  data-focusable="true" class="form-control "  value="">
								</div>

							</div>

							<div class="col-md-12 grid-margin-md ">
								
								<div class="row ">
									<label class="text-muted col-form-label col-md-12 lbl_form_sm"> Porcentaje de Descuento </label>
									<select class=" form-control" id="cupon_nvo_descuento">
										<?php echo $ops_dcto; ?>
									</select>
								</div>

							</div>	

							<div class="col-md-12 grid-margin-md ">								
								<div class="row ">
									<label class="text-muted col-form-label col-md-12 lbl_form_sm"> ¿Limite de usos del cupon? <br>
										<span style="font-size:0.6rem;">Dejar en cero para no definir limite</span>
									</label>
									<input autocapitalize="sentences" autocomplete="off"  autocorrect="on" maxlength="50" name="displayName" placeholder="Ejm. 20 " spellcheck="true" type="number" dir="auto" data-focusable="true"  id="cupon_nvo_limite" class="form-control " value="0">
								</div>

							</div>

							<input id="cupon_nvo_estado" type="hidden"   value="1">	
							<input id="id_registro" type="hidden"   value="0">
							<input id="bandera_actualiza" type="hidden"   value="0">

	</div>
	