
<?php

$set_fotos = get_select_set_coleccion();

$ops = $set_fotos; 


?>

<form name="form_up_set" method="post" action="?" id="form_up_set" enctype="multipart/form-data">
<div class="col-md-12" style="background: rgba(250,250,250,0.8); z-index: 999; border:0px solid #c30; padding:0px 1px 3px 1px; max-height:550px; height: 540px; overflow: scroll; overflow-x:hidden; overflow-y: auto;">
		                        			

	<h4 class="col-md-12 p-3 title_sec" >Imagenes</h4>
		

	<div class="row" >
		<div class="col-md-3 " style="height: 80%; overflow: auto; overflow-x: hidden; padding:0px; " id="check_admin_conf">
			<div class="card-body border-bottom" style="padding: 15px; margin-left:15px;">
            
                <span>Selecciona un set:</span>
                    <select id="new_set_cve" name="new_set_cve" onchange="valida_img();" class="form-control">
                        <?php echo $ops; ?>
                    </select>
                    <input type="hidden" id="new_set_foto" name="tipo" value="2" >


			</div>

            <div class="card-body border-bottom" style="padding: 5px; margin-left:15px;">

                <div class="col-md-12 grid-margin " id="carga_img" style="display: none;">
                    <label for="edita_imagen" class="col-sm-6 ">Subir Imagen</label>
                        <input type="file" name="foto" class="col-sm-10 form-control " id="foto" placeholder="Imagen">
                        
                        <a class="btn btn-primary btn-block  text-light col-sm-10" id="btn_up_foto" onclick="save_foto(2);"> <i class="fa fa-arrow-circle-up"></i> Subir Foto</a>
                                <input type="hidden" name="user_id" value="<?php echo $user_id?>" >
                                <input type="hidden" name="tipo" value="2" >
                            
                </div> 

            </div>

			
		</div>
		
		<div class="col-md-9 border-left" style=" padding: 0px 3px; height: 490px; z-index: 999; overflow: auto; overflow-y: auto; overflow-x: hidden; " id="check_admin_conf">
			<div class="card-body" >
		
            
                <div class="col-lg-12" id="new_set_status"></div>
                <div class="col-lg-12" id="display_image_set_admin"></div>
                                    
                <div id="prev_image" class="row form-group compacted" style=" display: block; border: 0px solid #ccc;  "></div>


			</div>
		</div>
												
	</div>
    </form>
</div>