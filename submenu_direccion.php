   <?php

$user_sesion_correo = $GLOBALS['user_correo'];
$data_dir = get_info_user($GLOBALS['user']);

//$data = $row['fecha_nac'].';'.$row['dir_estado'].';'.$row['dir_calle'].';'.$row['dir_no_ext'].';'.$row['dir_no_int'].';'.$row['dir_col'].';'.$row['dir_mun_del'].';'.$row['dir_extra'].';'.$row['dir_cp']; 

$data = explode(';',$data_dir);

$calle = $data [2];
$numero_ext = $data [3];
$colonia = $data [5];
$delegacion = $data [6];
$cp = $data [8];
$estado = $data [1];
$numero_int = $data [4];

if($numero_ext != "" or $numero_ext != 0){
									$ext = "";
									
								}else{
									$ext = ' Int. '.$numero_int;
								}

	$direccion = '
													
				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend center" style="width:130px;" >
                            <span class="input-group-text" style="width:100%;"> Calle </span>
                        </div>
                        <input type="text" disabled=""  autocomplete="off" autocorrect="on" maxlength="50" name="Usuario" placeholder="Calle" spellcheck="true" type="text" onblur="save_direccion();" id="dir_calle" data-focusable="true" class="form-control col-sm-12 fiel_dir" value="'.$calle.'">
                    </div>
                </div>

				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend center" style="width:130px;" >
                            <span class="input-group-text" style="width:100%;"> No Exterior </span>
                        </div>
                        <input type="text" disabled=""  autocomplete="off" autocorrect="on" maxlength="50" name="Usuario" placeholder="No Ext" spellcheck="true" type="text" dir="auto" onblur="save_direccion();" id="dir_no_ext" data-focusable="true" class="form-control col-sm-12 fiel_dir" value="'. $numero_ext.$ext.'">
                    </div>
                </div>

				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend center" style="width:130px;" >
                            <span class="input-group-text" style="width:100%;"> No Interior </span>
                        </div>
                        <input type="text" disabled=""  autocomplete="off" autocorrect="on" maxlength="50" name="Usuario" placeholder="No Int" spellcheck="true" type="text" dir="auto" onblur="save_direccion();" id="dir_no_int" data-focusable="true" class="form-control col-sm-12 fiel_dir" value="'. $numero.'">
                    </div>
                </div>

				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend " style="width:130px;">
                            <span class="input-group-text" style="width:100%;"> Código Postal </span>
                        </div>
                        <input type="text" disabled=""  autocomplete="off" autocorrect="on" maxlength="50" name="Usuario" placeholder="Código Postal" spellcheck="true" type="text" dir="auto" id="dir_cp" data-focusable="true" class="form-control col-sm-12 fiel_dir" value="'.$cp.'">
                    </div>
                </div>

				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend " style="width:130px;" >
                            <span class="input-group-text" style="width:100%;"> Colonia </span>
                        </div>
                        <input type="text" disabled=""  autocomplete="off" autocorrect="on" maxlength="50" name="Usuario" placeholder="Colonia" spellcheck="true" type="text" dir="auto" id="dir_colonia" data-focusable="true" class="form-control col-sm-12 fiel_dir" value="'.$colonia.'">
                    </div>
                </div>
	
				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend " style="width:130px;" >
                            <span class="input-group-text" style="width:100%"> Delegación </span>
                        </div>
                        <input type="text" disabled=""  autocomplete="off" autocorrect="on" maxlength="50" name="Usuario" placeholder="Delegación" spellcheck="true" type="text" dir="auto" id="dir_del" data-focusable="true" class="form-control col-sm-12 fiel_dir" value="'.$delegacion.'">
                    </div>
                </div>

				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend " style="width:130px;" >
                            <span class="input-group-text" style="width:100%;"> Estado / Provincia </span>
                        </div>
                        <input type="text" disabled="" autocomplete="off" autocorrect="on" maxlength="50" name="Usuario" placeholder="Estado" spellcheck="true" type="text" dir="auto" id="dir_estado" data-focusable="true" class="form-control col-sm-12 fiel_dir" value="'.$estado.'">
                    </div>
                </div>';
								
							
							
					
					


	   ?>

<div class="col-md-12" style="padding:0px; ">
	<h4 class="col-md-12 p-2 title_sec grid-margin" >Dirección</h4>
   
	   	<div class="col-md-12 tool_bar">
		  <button type="button" class="btn btn-inverse-primary" onclick="edita_dir_opc();"  style=""><i class="fa-solid fa-pencil"></i> Editar</a>
		</div>

		<div class="col-md-12 form-group border-bottom " style="margin:15px 0px;">
			<label class="col-md-10 text-muted" ><?php echo $direccion; ?></label>
			<input type="hidden" value="<?php echo $GLOBALS['user']; ?>" id="dir_id_user">
		</div>
		
	
		<button type="submit" class="btn btn-inverse-primary " onclick="save_direccion();">Actualizar Domicilio</button>
	
			
    	
</div>
    	