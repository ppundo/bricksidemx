<?php

$user = $_GET['user'];

$select_ubic = genera_select_ubicacion($user,$current);
?>            
        
        <div class="col-md-12">
            <div id="nuevo_grupo" class="group-control grid-margin border-bottom" style="padding-bottom:10px; ">	

                    <div class="col-md-12 p-2  subtitle_sec" style="text-align:left; margin-bottom: 10px;"> 
                        <i class="fa-regular fa-square-plus "></i> Agregar Grupo
                        <button type="button" value="" class=" btn btn-outline-primary " style="float:right; margin-right:10px;" onclick="save_grupo();"> <i class="fa fa-save"></i> </button> 
                    </div> 

			    	<label class="col-md-3 col-form-label text-muted lbl_form_sm">Etiqueta:</label>
			        <input class="col-md-8 form-control" id="new_nombre_grupo" type="text" value="">

                    <label class="col-md-3 col-form-label text-muted lbl_form_sm">Ubicaci&oacute;n</label>
                
                    <select class="col-md-8 form-control" id="new_loc">
                        <option value="X" > Elija Una... </option>
                        <?php echo $select_ubic; ?>
                    </select>
			</div>

            <div id="edita_grupo" class="group-control grid-margin border-bottom" style="padding-bottom:10px; ">
                <div class="col-md-12 p-2  subtitle_sec" style="text-align:left; margin-bottom: 10px;"> 
                        <i class="fa-regular fa-square-plus "></i> Editar Grupo
                        <button type="button" value="" class=" btn btn-outline-primary " style="float:right; margin-right:10px;" onclick="save_edit_grupo();"> <i class="fa fa-save"></i> </button> 
                    </div> 
            
            
                <label class="col-md-3 col-form-label text-muted lbl_form_sm ">Nombre</label>
                <input class="col-md-8 form-control" id="title_nvo" type="text" value="">
            
                <label class="col-md-3 col-form-label text-muted lbl_form_sm">Orden</label>
                <input class="col-md-8 form-control" id="orden_nvo" type="text" value="">

                <label class="col-md-3 col-form-label text-muted lbl_form_sm">Ubicaci&oacute;n</label>
                
                    <select class="col-md-8 form-control" id="ubi_nvo">
                        <option value="0" > Elija Una... </option>
                        <?php echo $select_ubic; ?>
                    </select>

                <input type="hidden" id="gpo_origen" value="" >

            </div>
        </div>