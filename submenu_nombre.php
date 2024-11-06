<?php
	

$info_userb = get_info_user($GLOBALS['user']);
/*
	$row['fecha_nac'].';'.
	$row['dir_estado'].';'.
	$row['dir_calle'].';'.
	$row['dir_no_ext'].';'.
	$row['dir_no_int'].';'.
	$row['dir_col'].';'.
	$row['dir_mun_del'].';'.
	$row['dir_extra'].';'.
	$row['dir_cp'].';'.
	$row['nombre'].';'.
	$row['apellido'].';'.
	$row['fecha_nac'];
	
	*/

//var_dump($user);

$data = explode(';', $info_userb);

$calle = $data [2];
$numero_ext = $data [3];
$colonia = $data [5];
$delegacion = $data [6];
$cp = $data [8];
$estado = $data [1];
$numero_int = $data [4];

$nombre = $data[9];
$apellido = $data[10];
$f_nac = $data[0];


// OTRA INFO 



	
?>




<div class="col-md-12" style="padding:0px; ">
<h4 class="col-md-12 p-2 title_sec grid-margin" >Nombre</h4>

    <div class="col-md" style="margin-top:10px;">
        <input type="hidden" value="<?php echo $GLOBALS['user']; ?>" id="usuario">

        <div class="row col-md-12 form-group  ">
            <label class="text-muted col-form-label col-sm-3">Nombre  </label>
            <input autocapitalize="sentences" autocomplete="off" autocorrect="on" maxlength="50" name="displayName" placeholder="Escribe Nombre" spellcheck="true" type="text" dir="auto" data-focusable="true" onblur="save_perfil_nvo('<?php echo $GLOBALS['user']?>');" id="nombre" class="form-control col-sm-4" value="<?php echo strtoupper($nombre) ?>">								
        </div>

        <div class="row col-md-12 form-group  ">
            <label class="text-muted col-form-label col-sm-3">Apellidos  </label>
            <input autocapitalize="sentences" autocomplete="off" autocorrect="on" maxlength="50" name="displayName" placeholder="Escribe Apellido" spellcheck="true" type="text" dir="auto" data-focusable="true" onblur="save_perfil_nvo('<?php echo $GLOBALS['user']?>');" id="apellido" class="form-control col-sm-4" value="<?php echo strtoupper($apellido) ?>">								
        </div>

        <div class="row col-md-12 form-group  ">
            <label class="text-muted col-form-label col-sm-3">Fecha de Nac.  </label>
            <input autocapitalize="sentences" type="date" autocomplete="off" autocorrect="on" maxlength="50" name="displayName" placeholder="" spellcheck="true" type="text" dir="auto" data-focusable="true" id="f_nac" class="form-control col-sm-4" onchange="save_perfil_nvo('<?php echo $GLOBALS['user']?>');" value="<?php echo $f_nac ?>">					
        </div>
    </div>
</div>
							
							
							