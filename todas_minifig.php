
<?php

// limpia el buffer


///// Vista lista 
$lista = $_GET['lista'];

if($lista==1){
	$list_vis = 'display:block;';
	$ancho_panel = 9;
	$ancho_list = 3;
	$ancho_card = 4;
}else{
	$list_vis = 'display:none;';
	$ancho_panel = 12;
	$ancho_list = 10;
	$ancho_card = 3;
}

$debug = 0;

//Verifica si hay una sesion para mostrar la pagina
//include("check_access.php");

//$session_user = check_sesion();


	if($user==0 or $user==""){
			
		echo '<meta http-equiv = "refresh" content = "0; url = '.$link_site.'?access=1" />';
			
	}else{

//$ids = get_ids_current($referencia);
?>

<input type="hidden" name="tuser" id="total_serie" alt="Total  Coleccionados" value="<?php echo $total_collect; ?>" >
<input type="hidden" name="user" id="user" alt="Usuario" value="<?php echo $user;  ?> " >

<input type="hidden" name="tserie" id="tserie" value="" >
<input type="hidden" name="user" id="serie_act"  value="" >
<input type="hidden" name="user" id="ids_current"  value="" >

<div class="scrollable" >

<div id="item_cards" class="row grid-margin" style="display: flex; align-items: stretch;" >
	
	
	<div id="loading_todas" class="loading"> 
		<div class="degrade_modal"></div>
		<div class="col-lg-12 transparent" style="margin-top: 15%; text-align: center; align-content: center; ">
			
			<h3 class="text-light">
				<span class="text-success"> <i class="fas fa-circle-notch fa-spin fa-2x fa-fw"></i>  </span><br>
				Estamos buscando figuras...
				</h3>
		</div>
	</div>
<?php
	
	
	//echo $grid_body;
	$clave_lego = 1;  // 
	$view = 3;
	echo get_cards_minifigures($clave_lego, $view);
	//echo get_cards_minifigures($clave_lego);
	
	$list_sets = get_all_coleccion_user($user);
	
	echo "<script type=\"text/javascript\" > toggle('loading_todas'); drag_drop(); </script>";
	?>
	</div>
</div>





<!-- //////////////////////////               LISTA             //////////////////////////// -->

<div id="lista_set" class="hold_set_edita"  style="<?php echo $list_vis ?> "  >
	<div class="degrade_modal"></div>
	
	<div class=" col-lg-12 body_modal semi-transparent " style="margin-top: 20px; margin-bottom: 10px; width: 40%; padding:0px; height:90%;">
	
    <h5 class="col-md-12 p-2 title_sec_sm bg-head " style="padding:0px; border-radius:5px 0 0 0;"> 
            
            <i class="fa-solid fa-sliders"></i> <b> Tu Coleccion </b>
    
            <div class="btn-group" role="group" style="float:right; border:none;"> 
                <button type="button" onclick="toggle('lista_set')" class=" btn btn-outline-primary  text-clear" style="border:0px solid #ccc;"> 
                    <i class="fa-solid fa-times fa-lg"></i>
                </button>
            </div> 
     </h5>  


            <div class="p-1 border-bottom center " style="padding: 10px 0 0 5px;">  
                <div class="row">
                    <div class="col-md-12">                                 
                            <div class="btn-group" role="group" aria-label="" style="float:left; " >   
                                <span id="res_csv" style="margin:0px auto;"></span>  
                            </div>  
                    </div>
                </div>
            </div>


	   	<div class="content-wrapper-thin" style="background: #fff; "  >
	   		<div class="col-lg-12">

											
				<div class="row">
	   			<div class="col-md-12 grid-margin " style="height: 350px; max-height: 350px; overflow: scroll; overflow-x: hidden; overflow-y: auto;"  >	
				   
				    <?php echo $list_sets; ?>        				                    
				</div>
				
				<div class="col-md-4 grid-margin " style="height: 350px; max-height: 350px; border:0px solid #c30; " >
				</div>
				</div>

				
			</div>
	   	</div>
	</div>
		
</div>



<?php
	

		echo'	
<script type="text/javascript">
	genera_csv(3);	
</script>		
		';
		
	
	
	
	}
	
	
	
	
	?>
            

                


