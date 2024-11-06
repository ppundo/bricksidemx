<?php

$formato = $_POST['flatRadios'];

if(isset($formato)== FALSE or $formato == 0){
    $format = 1; 

}else{
    $format = $_POST['flatRadios'];

}

//var_dump($format);


?>
<div class="col-md-12">
    <form name="check_barcode">   

                        <?php 
                        echo genera_radiobtn_tipocodigo(1,0); 
                        //echo genera_select_tipo_codigo($formato);

                        ?>
    </form>

    <input type="button" onclick="test_frame();" value="Testing" >
    </div>