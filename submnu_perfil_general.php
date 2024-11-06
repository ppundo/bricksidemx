<?php 
$id_perfil = $_GET['item'];

$info_perfil = get_info_perfil($id_perfil);
$data_perfil = explode(';',$info_perfil); 
// $row['id'].';'.$row['nombre'].';'.$row['nombre_corto'].';'.$row['cve_perfil'].';'.$row['icono'].';'.$row['estado'].';'.$row['color']; 
	    	
$id = $data_perfil[0];
$nombre = $data_perfil[1];
$nombre_cto = $data_perfil[2];
$clave = $data_perfil[3];
$icono = $data_perfil[4];
$estado = $data_perfil[5];
$color = $data_perfil[6];
//$row['id'].';'.$row['nombre'].';'.$row['nombre_corto'].';'.$row['cve_perfil'].';'.$row['icono'].';'.$row['estado'].';'.$row['color']; 

$ops_edo = genera_select_edo_all($estado);
$ops_colores = genera_select_colores($color);

$perfil = '
<input type="hidden" id="id_perfil" value="'.$id.'" >

				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend " style="width:130px;">
                            <span class="input-group-text" style="width:100%;"> ID </span>
                        </div>
                        <input type="text" disabled=""  autocomplete="off" autocorrect="on" maxlength="50" name="Id" placeholder="Id" spellcheck="true" type="text" dir="auto" data-focusable="true" class="form-control col-sm-12 fiel_dir" value="'.$id.'">
                    </div>
                </div>

				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend " style="width:130px;">
                            <span class="input-group-text" style="width:100%;"> Clave </span>
                        </div>
                        <input type="text" disabled=""  autocomplete="off" autocorrect="on" maxlength="50" name="Usuario" placeholder="Clave" spellcheck="true" type="text" dir="auto" id="clave_perfil" data-focusable="true" class="form-control col-sm-12 fiel_dir" value="'.$clave.'">
                    </div>
                </div>

				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend center" style="width:130px;" >
                            <span class="input-group-text" style="width:100%;"> Nombre </span>
                        </div>
                        <input type="text"   autocomplete="off" autocorrect="on" maxlength="50" name="Usuario" placeholder="Nombre" spellcheck="true" type="text" onblur="save_edit_perfil();" id="nombre_perfil" data-focusable="true" class="form-control col-sm-12 fiel_dir" value="'.$nombre.'">
                    </div>
                </div>

				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend center" style="width:130px;" >
                            <span class="input-group-text" style="width:100%;"> Nombre Corto </span>
                        </div>
                        <input type="text"  autocomplete="off" autocorrect="on" maxlength="50" name="Usuario" placeholder="Nombre Corto" spellcheck="true" type="text" dir="auto" onblur="save_edit_perfil();" id="nombre_cto_perfil" data-focusable="true" class="form-control col-sm-12 fiel_dir" value="'. $nombre_cto.'">
                    </div>
                </div>

				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend center" style="width:130px;" >
                            <span class="input-group-text" style="width:100%;">  Icono  <span class="text-primary" style="margin-left:15px;"><i class="'.$icono.'"></i> </span> </span>
                        </div>
						
                        <input type="text"   autocomplete="off" autocorrect="on" maxlength="50" name="Usuario" placeholder="Estado" spellcheck="true" type="text" dir="auto" onblur="save_edit_perfil();" id="icono_perfil" data-focusable="true" class="form-control col-sm-12 fiel_dir " value="'. $icono.'">
                    </div>
                </div>

				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend center" style="width:130px;" >
                            <span class="input-group-text" style="width:100%;"> Estado </span>
                        </div>

						<select id="estado_perfil" class="form-control col-sm-12 fiel_dir" onchange="save_edit_perfil();">
							<option value="99">Elije...</option>
							'.$ops_edo.'
						</select>
                        
                    </div>
                </div>

				<div class="form-group">
                    <div class="input-group col-sm-12">
                        <div class="input-group-prepend center" style="width:130px;" >
                            <span class="input-group-text" style="width:100%;">  Color </span>
                        </div>
						
						<select id="color_perfil" class="form-control col-sm-12 fiel_dir" onchange="save_edit_perfil();">
							<option value="99">Elije...</option>
							'.$ops_colores.'
						</select>
                    </div>
                </div>
';


?>

<div class="col-md-12 " style="padding:0px;">
		                        			
	<h4 class="col-md-12  p-3 title_sec">Información General de Perfil </h4>
	
		<div class="col-md-12 tool_bar center no-show " style="padding: 5px 10px;">								
                    <div class=" btn-group" role="group" style="margin-bottom: 2px;">
                        
                        <button id="btn_ops_1" type="button" onclick="toggle_ops('1')" class="btn btn-inverse-primary"> General </button>
                        
                    </div>
        </div>

		<div class="row " style="margin:10px 5px 5px 5px;">
			<div class="col-md-4 " style="padding:0px;">
				<?php echo $perfil; ?>
			</div>

			<div class="col-md-4 " style="padding:0px;">
				<?php //echo $perfilb; ?>
			</div>
		</div>



</div>
