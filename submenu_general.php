
<div class="col-md-12" style="padding:0px; ">
<h4 class="col-md-12 p-2 title_sec grid-margin" >Configuración General</h4>

	<div class="col-md-12 " style="margin-top:10px;">
							
							<div class="col-md-10 form-group  ">
								<label class="col-form-label">Idioma Inicial </label>
								
								<div class="row border-bottom ">
									<p class="col-sm-4 col-form-label text-muted">Idioma: </p>
									    	
									    	<select class="form-control col-sm-8 grid-margin-md" name="idioma_p" onchange="save_perfil_general(<?php echo $GLOBALS['user']?>);" id="idioma_p" >
										    	<option value="XX">Elija una...</option>
										    	<?php echo generaListIdiomas(); ?>
									    	</select>

								</div>

							</div>
							
							<div class="col-md-10 form-group ">
								<label class="col-form-label"> Página Inicial  </label>
								
								<div class="row border-bottom">
									<p class="col-sm-4 col-form-label text-muted">Página: </p>
									    	
									    	<select class="form-control col-sm-8 grid-margin-md" onchange="save_perfil_general('<?php echo $GLOBALS['user']?>');" name="pagina_inicial_p" id="pagina_inicial_p" >
										    	<option value="XX">Elija una...</option>
										    	 <?php echo generaListPaginas_principal();  ?>
									    	</select>

								</div>

							</div>
</div>
</div>