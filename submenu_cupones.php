
<?php
	

$activos = get_cupones_activos($GLOBALS['user']);
$disponibles = get_cupones_disponibles($GLOBALS['user']);
	
?>



<div class="col-md-12" style="padding:0px; ">
<h4 class="col-md-12 p-2 title_sec grid-margin" >Mis Cupones</h4>

	<div class="col-md-12 " style="margin-top:10px; padding:0px;">

            <div class="col-md-12 border-left border-right border-bottom bg-muted center " style="padding: 5px 10px; width:95%; margin:10px auto;">								
                    <div class="btn-group" role="group" style="margin-bottom:-6px;">
                        
                        <button id="btn_cops_1" type="button" onclick="toggle_ops_cupones('1')" class="btn btn-primary cupones_op" style="border-radius:3px 0px 0px 3px;"> <i class="fa-solid fa-ticket"></i>Usados </button>
                        <button id="btn_cops_2" type="button" onclick="toggle_ops_cupones('2')" class="btn btn-inverse-primary cupones_op"> <i class="fa-solid fa-ticket"></i>Disponibles </button>
                        <button id="btn_cops_3" type="button" onclick="toggle_ops_cupones('3')" class="btn btn-inverse-primary cupones_op"> <i class="fa-solid fa-ticket"></i> Vencidos </button>

                    </div>
            </div>

        <div clss="" style="height: 430px; overflow: scroll; overflow-x: hidden; overflow-y: auto;">

			<div id="opc_cupones_1" class="col-md-12" style=" padding:0px;">			
                <div style="padding: 0px 2px;">
                    <?php echo $activos; ?>
                </div>
			</div>

			<div id="opc_cupones_2" class="col-md-12" style="padding:0px; display:none;">
                <div style="padding: 0px 2px;">
				<?php echo $disponibles; ?>
                </div>
			</div>

            <div id="opc_cupones_3" class="col-md-12" style="padding:0px; display:none;">
                <div style="padding: 0px 2px;">
				    
                </div>
			</div>

        </div>
    </div>
			
	
