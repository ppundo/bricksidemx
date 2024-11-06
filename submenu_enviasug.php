
<?php
	
?>	
			
<div class="col-md-12" style="padding:0px; ">
<h4 class="col-md-12 p-2 title_sec grid-margin" >Enviar Sugerencias</h4>

	<div class="col-md-12 " style="margin-top:10px;">
 
				<div class="col row">	
					<div class="col-md-12">
							
							<div class="row col-md-12 form-group ">
								<div class="row ">
									<label class="text-muted col-form-label col-sm-6"> Clave LEGO </label>
									<input autocapitalize="sentences" autocomplete="off"  autocorrect="on" maxlength="50" name="Clave Lego" placeholder="Clave LEGO" spellcheck="true" type="text" dir="auto" data-focusable="true" id="clave_sug" class="form-control col-sm-6 " value="">
								</div>
							</div> 

							<div class="row col-md-12 form-group ">
								<div class="row ">
									<label class="text-muted col-form-label col-sm-6"> Tema</label>
									
										<select id="tema_sug"  class="col-md-6 form-control" > 
												<option value="XX">Elije...</option> 
												<?php echo generaListTemas($a); ?> 
										</select>
									
								</div>
							</div> 
							
							<div class="row col-md-12 form-group ">
								<div class="row ">
									<label class="text-muted col-form-label col-sm-6"> Tipo </label>
									<select class="form-control col-sm-6 " id="tipo_sug" >
										<option value="XX">Elije...</option>
										<option value="Minifiguras" > Minifiguras </option>
										<option value="Piezas" > Piezas de colección </option>
										<option value="Placas" > Placas Conmemorativas</option>
										<option value="Otro">Otro</option>
									</select>
								</div>
							</div> 
							
							<div class="col-md-12 ">
								<div class="row ">
									<label class="text-muted col-form-label col-sm-6"> Mas Detalles </label>
									<textarea  autocapitalize="sentences" autocomplete="off"  autocorrect="on" maxlength="300" name="detalles_sug" placeholder="Clave LEGO" spellcheck="true" type="text" dir="auto" data-focusable="true" id="detalles_sug" class="form-control col-sm-12 " value=""> </textarea>
									<small class="text-muted"> Escribe mas detalles de la colección, si esta relacionada con alguna película o programa. Cantidad de elementos, si es reciente o de ediciones pasadas.</small>
								</div>
							</div> 	
<br>
							<a class="btn btn-primary text-light " onclick="save_sugest();"><i class="fa fa-paper-plane"></i> Enviar </a>
																			
					</div>
					
					<div class="col-md-12 no-show ">
							<p>
								<hr>
								<span class="text-success" style="font-size: 18px;">¡GRACIAS POR ESCRIBIRNOS!</span> <br>
								<p class="text-muted">Analizaremos tu sugerencia con base a la información que nos proporciones, una vez que evaluemos te notificaremos sobre el resultado. </p>
								
								<p class="text-muted">Revisa Avances en el apartado de Colecciones desde tu Perfil. Recuerda que puedes tener solo <?php echo $sug_activas?> sugerencias activas simultaneamente. </p>
							</p>
							<p class="text-muted"> Recuerda que por ahora solo consideraremos productos oficiales de LEGO. </p>
							
							
					</div>
				</div>			
    			
    			
    			
    			
    			</div>


</div>
