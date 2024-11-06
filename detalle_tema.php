<?php 
	
$id_tema = $_GET['item'];
//$id_sugerencia= $_POST['id_sugerencia'];
//$respuesta = $_POST['respuesta_formato'];


$info_tema = getinfotema($id_tema);
// $info = $row['nombre'].'-'.$row['color'].'-'.$row['logo'].'-'.$row['estado'].'-'.$row['color_alt'].'-'.$row['fecha_registro'].'-'.$row['fecha_actualizado'];

$data_tema = explode('|',$info_tema);


		$nombre_tema = $data_tema[0]; 
		$color_tema  = $data_tema[1];
		$logo_tema = $data_tema[2];
		$estado_tema = $data_tema[3];
		$color_alt = $data_tema[4];
		$freg = $data_tema[5];
		$fact = $data_tema[6];
		$color_txt = $data_tema[7];
		
		$url_logo = $path_logos.$logo_tema;

$logo_temab = '

<div class="col-sm-12 hold_logo_set " style="text-align:center;">
	<img id="pre-logo" style="max-height: 250px; max-width: 350px; width:auto; margin:10px; padding:15px 35px; background: rgba('.$color_tema.',0.9); background:linear-gradient(155deg, rgba('.$color_tema.',0.9 ) 60%, rgba('.$color_alt.',0.7) 100%); border-radius:50px; " src="'.$url_logo.'" class="col-md-12">
</div>

';	


$barra = '

	<div class="progress" style="height: 30px;" >
        <div class="progress-bar" role="progressbar" style=" width: 100%; background:linear-gradient(155deg, rgba('.$color_tema.',0.9 ) 60%, rgba('.$color_alt.',0.7) 100%); border-radius:50px; "" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"> <span style="color: rgba('.$color_txt.',0.9);"> COLOR TEXTO  </span> </div>
    </div>

'; 




$edo = get_lbl_estado_set($estado_tema);

	                        $data = explode(',',$color_tema); 
	                        
	                        $r = $data[0];
	                        $g = $data[1];
	                        $b = $data[2];
	                        
	                        $color = fromRGB($r, $g, $b);
	                        
	                        $datab = explode(',',$color_alt); 
	                        
	                        $rb = trim($datab[0]);
	                        $gb = trim($datab[1]);
	                        $bb = trim($datab[2]);
	                        
	                        $colorb = fromRGB($rb, $gb, $bb);

						// ------------ color de texto 

						 if($color_txt==''){
						 	$color_t = '100,100,100';
						 }else{
						 	$color_t = $color_txt;
						 }

	                        $datac = explode(',',$color_t); 
	                        
	                        $rc = $datac[0];
	                        $gc = $datac[1];
	                        $bc = $datac[2];

	                        $colorc = fromRGB($rc, $gc, $bc);


	                        
	                        $logo = listLogo($logo_tema);
	                        
$edita_logo = '
<label class="col-md-2 grid" >Logo</label>
<select id="tema_logo_'.$id_tema.'" onchange="preview(\''.$id_tema.'\');" class="col-md-4 form-control" > 
											<option value="0">Elije...</option> 
												'.$logo.' 
											</select>
                                            <br><br>

<div class="col-sm-6 p-4 hold_logo_set border " style=" height:100%; background:url(\'assets/images/bg_pattern_30.png\') repeat-y; text-align:center;">
	<img id="pre-logo-'.$id_tema.'" style="max-height: 250px; max-width:90%; width:auto; margin:2px 10px; padding:20px 35px; background: rgba('.$color_tema.',0.9); background:linear-gradient(155deg, rgba('.$color_tema.',0.9 ) 60%, rgba('.$color_alt.',0.7) 100%); border-radius:5px; " src="'.$url_logo.'" >
</div>


';

$edita_nombre= '

    <div class="col-sm-12" >
        <label class="col-form-label">Color de Fondo:</label>
        
        <div style="padding: 10px; text-align: center; border-radius: 5px; width: 100%; margin:10px 10px 10px 0; background: linear-gradient(90deg, rgba('.$color_tema.',1) 35%, rgba('.$color_alt.',1) 100%);" >
            <span style="letter-spacing: 10px; color: rgba('.$color_t.',0.8);"> ABCDEFGHIJKLMNOPQRSTUVWXYZ</span>
        </div>
        
    </div>

    <div class="row">
		<div class="col-sm-6 form-group" style="padding: 3px 25px;">	
			<div class="row">
                <input class="border" style="margin-left:10px; padding:5px; height:40px; width:40px; " id="tema_color_'.$id_tema.'" type="color" value="'.$color.'" onchange="quick_edit_tema(\'1-'.$id_tema.'\')"  >
                <div class="col-sm-6">
					<span style="font-size: 0.7em;" class="text-muted"> RGB ('.$color_tema.') </span><br>												
					<span style="font-size: 0.7em;" class="text-muted"> HEX '.$color.' </span>
				</div>

			</div>
		</div>
										
		
        <div class="col-sm-6 form-group" style="padding: 3px 25px;">
            <div class="row">
                <input class="border" style="margin-left:10px; padding:5px; height:40px; width:40px; " id="tema_color_b_'.$id_tema.'" type="color" value="'.$colorb.'" onchange="quick_edit_tema(\'1-'.$id_tema.'\')" >
			    <div class="col-sm-6">
					<span style="font-size: 0.7em;" class="text-muted"> RGB ('.$color_alt.') </span><br>
					<span style="font-size: 0.7em;" class="text-muted"> HEX '.$colorb.' </span>
				</div>
			</div>										
		</div>
</div>

										<div class="col-sm-12 form-group border-top">
                                            <label class="col-form-label">Nombre Tema:</label>
                                               <div class="row">
                                                
                                                    <div class="col-md-6">
                                                        <div class="row  ">	                        		
                                                           
                                                            <input style="margin-left:10px;" class="col-md-8 form-control" id="tema_nombre_'.$id_tema.'" type="text" value="'.$nombre_tema.'" onblur="quick_edit_tema(\'1-'.$id_tema.'\')" >
                                                        </div>                                                
                                                    </div>

                                                    <div class="col-md-6">                        		
                                                        <div class="row">
                                                        
                                                            <input class="border" style="margin-left:10px; padding:5px; border-radius:5px; height:40px; width:40px; " id="tema_color_txt_'.$id_tema.'" type="color" value="'.$colorc.'" onchange="quick_edit_tema(\'1-'.$id_tema.'\')" >

                                                            <div class="col-sm-6">
                                                                <span style="font-size: 0.7em;" class="text-muted"> RGB ('.$color_txt.') </span><br>												
                                                                <span style="font-size: 0.7em;" class="text-muted"> HEX '.$colorc.' </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
										</div>	

                                        <!------ -->






                      		
		                        		
';

	                        if($estado_tema==1){
		                       
		                       // $edo = '<span id="s_edo_'.$rowb['id'].'" class="theme_color" style="font-size: 22px;"> <i class=" fa fa-eye " ></i> </span>';
		                        $btn_edita = '<button '.$hab_btn.' class="btn btn-inverse-primary" onclick="quick_edit_tema(\'2-'.$id_tema.'\')" > <i class="fa fa-eye-slash" ></i> </button>'; 
	                        }elseif($estado_tema==0){
		                       // $edo = '<span class="theme_gris" style="font-size: 22px;"> <i class=" fa fa-eye-slash" ></i> </span>';
		                        $btn_edita = '<button '.$hab_btn.' class="btn btn-inverse-primary"  onclick="quick_edit_tema(\'2-'.$id_tema.'\')" > <i class="fa fa-eye" ></i> </button>'; 
	                        }
	                        
	                        $btn_save = '<button class="btn btn-inverse-primary " onclick="quick_edit_tema(\'1-'.$id_tema.'\')" > <i class="fa fa-save" ></i> </button>';
	                        
	                        $ops = $btn_edita.$btn_save;

?>

<div class="scrollable" style="overflow: hidden;">

	<div class="row " style="margin-top: 0px; height: 100%;">
	
		<div class="col-md-4 border-right  bg-light " style="height: 559px;" >		
			
			<div class="row">
				<div class="col-md-12 border-bottom">
				    <div class="row ">
    				    <div class="col-sm-7">
        					<h4 class="p-3 card-title-col text-muted " style="padding-bottom: 0px;"> 
        						<i class="fa-solid fa-tag"></i> <?php echo $nombre_tema;?> 
        					</h4>				        
    				    </div>
    				    
    				    <div class="col-sm-5" style="text-align:right; padding-top:15px;">
    				        <span style="margin-top:13px;  font-size: 14px; background: rgba(150,150,150,0.2); padding: 5px 20px; border-radius: 5px;" class="text-clear"> 
                                <?php echo $edo; ?>
                            </span>				
                        </div>
                    </div>
                    
                    <div class="card-body" style="padding-top:0px; padding-bottom:0px;">
    					<span class="text-clear" style="font-size: 14px;"><i class="fa fa-calendar"></i> <?php echo formatFechaHora($freg); ?></span> <br> 
					    <span class="text-clear" style="font-size: 14px;"><i class="fa-solid fa-retweet"></i> <?php echo formatFechaHora($fact); ?></span> <br>
					</div>
					
					<?php echo $logo_temab; ?>
				</div>
				
				<div class="col-md-12 ">
					
					<?php echo $color_title; ?>

					
				</div>

			</div>
		
		</div>
		
		
					
			
			
		<div class="col-md-8 " style=" padding: 0px;">
			
				<h4 class="p-2 title_sec" > 
					Edita Tema

				</h4>

				<div class="tool_bar" style="margin:0px; padding:0px;">
						<div class="btn-group" role="group" > <?php echo $ops; ?></div>
				</div>

		<div style="height: 470px; overflow-x: hidden;">
			<div class="card-body-col " style="padding-top: 20px;">
	
					<div class="col-md-12 border-bottom">						
						<?php echo $edita_nombre; ?>
					</div>
				
			</div>

			<div class="card-body-col" style="">	
					<div class="col-md-12 ">						
						<?php echo $edita_logo; ?>
					</div>
				
			</div>
        </div>
			
		</div>
		
			
		<div class="col-md-4" style="height: 559px; overflow-x: hidden; ">
			
				<h4 class="p-3 card-title text-muted"> </h4>
				
							<div class="col-md-12" style="width: 99%; overflow:scroll; overflow-x: hidden; overflow-y: auto; padding:15px;">
		                        				
		                       		                        				
		                    </div>
				
			
		</div>
	
	
	</div> <!-- row -->
</div>
