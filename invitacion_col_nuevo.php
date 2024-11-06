<?php

$select_cupones = generaSelectCupones(0);

$folio = generafolioinv();
$info_folio = explode('-',$folio);
$folio_final = $info_folio[0];
$folio_consecutivo = $info_folio[1];

$hoy_sec = date('s');
$folio_code = md5($folio_final.'-'.$hoy_sec);

$btn_invitaciones = ''; 


?>

<div class="row" style="height: 100%; margin:0px; padding:0px;">

    <div class="col-md-12 border-right left_panel_shadow" style="padding: 0px;" >

        <h4 class="col-md-12 p-2 title_sec "> Nueva Invitación </h4>
            <div class="tool_bar" style="">
                <button type="button" class="btn btn-inverse-primary " onclick="save_invitacion();"> <?php echo $ico_global_save; ?> </button>
                <?php echo $btn_invitaciones; ?> 
            </div>

            <div class="form-group no-show">
                <div class="input-group col-sm-6">
                    <input type="text" class="form-control" id="clave_folio" value="<?php echo $folio_code;?>">
                </div>
            </div>

            <div class="form-group no-show">
                <div class="input-group col-sm-6">
                    <input type="text" class="form-control" id="key_clave_folio" value="<?php echo $folio_final.'-'.$hoy_sec;?>">
                </div>
            </div>

            <div class="form-group no-show">
                <div class="input-group col-sm-6">
                    <input type="text" class="form-control" id="consecutivo_folio" value="<?php echo $folio_consecutivo;?>">
                </div>
            </div>


<div class="row">
        <div class="col-4 border-right" style="margin:10px; height:430px;">
                <div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend center" style="width:130px;" >
                            <span class="input-group-text" style="width:100%;"> Folio </span>
                        </div>
                        <input type="text" disabled=""  autocomplete="off" autocorrect="on" maxlength="50" name="folio" placeholder="Folio" spellcheck="true" type="text"  id="inv_folio" data-focusable="true" class="form-control col-sm-12 fiel_dir" value="<?php echo $folio_final; ?>">
                    </div>
                </div>

				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend center" style="width:130px;" >
                            <span class="input-group-text" style="width:100%;"> Correo (op)</span>
                        </div>
                        <input type="mail"  autocomplete="off" autocorrect="on" maxlength="50" name="Usuario" placeholder="Correo" spellcheck="true" dir="auto"  id="inv_correo" data-focusable="true" class="form-control col-sm-12 fiel_dir" value="">
                    </div>
                </div>

				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend center" style="width:130px;" >
                            <span class="input-group-text" style="width:100%;"> Cupon </span>
                        </div>
                        <select id="inv_cupon" class="form-control col-sm-12 fiel_dir" >
                            <option value="99">Elije...</option>
                            <?php echo $select_cupones; ?>
                        </select>
                        
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend center" style="width:130px;" >
                            <span class="input-group-text" style="width:100%;"> Generar QR </span>
                        </div>
                        <label class="col-form-label center col-2 border">
                            <input type="checkbox" id="genera_qr" value="" style="margin-left:10px;" /> 
                        </label>
                        
                    </div>
                </div>


        </div>

        <div class="col-4" style="margin:10px;">
            <span class="col-12 center" id="img_qr"></span>
        </div>
</div>

    </div>


</div>