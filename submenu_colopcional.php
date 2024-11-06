<div class="col-md-12" style="padding:0px; ">
<h4 class="col-md-12 p-2 title_sec grid-margin" >Colecciones Opcionales</h4>

	<div class="col-md-12 " style="margin-top:10px;">
        <p class="text-muted" style="font-size: 12px;">Algunas <b>Colecciones Opcionales</b> pueden aparecer deshabilitadas. ¡No te preocupes! tu colección no será modificada y estará intacta una vez que el administrador las active. Te avisaremos cuando esto ocurra.</p>
                                        
        <div class="col-sm-12" style="padding-top: 5px; max-height: 420px; overflow: scroll; overflow-x: hidden; overflow-y:auto; border:0px solid #c30;">	
            <?php 
            echo genera_check_series_opcionales($GLOBALS['user']); 
            ?>
        </div>			
    </div>
</div>