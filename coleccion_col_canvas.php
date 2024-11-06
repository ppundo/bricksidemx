
<?php

$clave_lego = $_GET['item'];
$sub = $_GET['sub'];

if(isset($clave_lego)){
   // $url = 'minifig/'.$clave_lego.'/'.$sub.'/';

    $info = get_name_minifiguras($clave_lego);
    $data = explode(';',$info);

    for($i=0;$i< count($data); $i++){
        $data_reg = explode(',',$data[$i]);
       // for($j=0; $j< count($data_reg);$j++){
       $nn = $i+1;
            if($data[$i]!=''){
            $minifig .= '
                <div class="row col-md-12 border-bottom bg-muted" style="border-bottom:0px solid rgba(190,190,190,0.5); font-size:0.8em; margin:0px 0px; margin-left:10px; padding:8px 0px 8px 0px;" title="">
                
                <span class="col-1 text-primary " style=" font-size:1.1em; "> '.$nn.'. </span>  
                <span class="col-1 text-primary " style=" font-size:1.1em; "> <i class="fa-solid fa-child"></i> </span> 
                                                             
                    <a href="#" onclick="get_minifig_canvas(\''.$data_reg[4].'\')"; class="text-primary" style="font-size:0.8rem;"> '.substr($data_reg[1],0,20).' </a>
                </div>'; 
            }

      //  }
    }

    //$fig .= '1,'.$rows['nombre_es'].','.$rows['nombre_en'].','.$rows['imagen'].','.$rows['id'].';';

}else{
    //$url = 'minifig/'.$clave_lego.'/';

}

$permiso_guardar = get_permiso_config('37', $GLOBALS['user_perfil']);
// var_dump($permiso_guardar);

       if($permiso_guardar==1){
           $btn_dwl_mnu = '<button type="button" id="screen_fig" class="minifig_menu btn btn-inverse-primary"> <i class="fa-solid fa-download"></i> </button>';
           $btn_dwl_mnu_combo = '<button type="button" id="screen_combo" class="minifig_menu btn btn-inverse-primary"> <i class="fa-solid fa-download"></i> </button>';
       
        }else{
           $btn_guardar = '';
           $btn_dwl_mnu = '';
           $btn_dwl_mnu_combo='';
       }

// ------------------------  Genera imagenes extras 

if(isset($clave_lego)){
    $info_cole = get_info_minifiguras_extra($clave_lego, $GLOBALS['user']);

   // var_dump($info_cole);
    $data_cole = explode(';',$info_cole);
    $nnn = 0;
   // var_dump(count($data_cole));

    for($j=0; $j< count($data_cole); $j++){
        $data_reg_cole = explode(',',$data_cole[$j]);
            //$fig .= $rows['item'].','.$rows['id'].';';
       if($data_reg_cole[0]==0){
        //$nn = $i+1;
       // $minifig_cole .= 'No se han registrado minifiguras extra '.$data_reg_cole[1].$nn; 
       }else{

       // $minifig_cole .= $data_reg_cole[0].';';
       $fig_info = get_data($data_reg_cole[0],$index);
       $data_fig = explode('/', $fig_info);
       $nombre_es = $data_fig[0];
       $nombre_en = $data_fig[1];
       $imagen= $data_fig[2];
       $cve_lego = $data_fig[3];
        
       $nnn = $j+1;

            if($data_cole[$j]!=''){
            $minifig_cole .= '

                <div class="form-check form-check-flat" style="padding-left:1px;">
					<span class="text-muted" style="font-size:0.7rem;"> '.$nnn.'. </span>
					<input class="chk_extra " id="chk_extra_'.$data_reg_cole[0].'" value="'.$data_reg_cole[0].'" onchange="genera_minifig_extra();" type="checkbox"> 
                    <span class="text-muted" style="font-size:0.7rem;">'.substr($nombre_es ,0,15).' ['.$data_reg_cole[2].']</span> 
                    <input type="hidden" value="'.$data_reg_cole[0].'">
				</div>

                '; 
            }
                
        }
      //  }
    }

}

///// empaque
$empaque = valida_foto_tipo($clave_lego,6);
//$ruta_env = 'assets/images/empaque/'.$empaque; 
$img_emp = '<img src="'.$empaque.'" style=" max-width:288px; height:305px; margin:10px auto;" id="img_'.$id_minifig.'" > ';


?>
	

    <div class="col-md-12" style="padding:0px; ">
        <h4 class="col-md-12 p-2 title_sec"> Canvas de Imagenes </h4>
                 
                                     <!-- barra de herramientas -->
                <div class="mnu_bar center " style=" margin-bottom:0px;">	
                    <div class="btn-group-bar" role="group" style="">
                        
                        <button id="canvasop_1" type="button" onclick="barmenu(this.id)" class="btn btn-primary btn_menubar canvasop" style="border-radius:3px 0px 0px 3px;"> <i class="fa-solid fa-child"></i> Minifiguras </button>
                        <button id="canvasop_2" type="button" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar canvasop"> <i class="fa-solid fa-paintbrush"></i> Canva </button>
                                    
                    </div>
                </div>

                
         <div class="col-md-12 row" style="margin-left:0px; margin-top:0px; padding:0px; border:0px solid #c40; ">
             
                <div class="col-md-12 " id="list_minifig_img" style="margin-left:0px; padding:0px; height:100%; width:100%; border:0px solid #a34; z-index:999999; " id="hold_labels_images" >
                            
                            <div id="div_canvasop_1" style="margin-left:0px; display:block; border:0px solid #134; ">
                                <div class="row">
                                    
                                    <div class="col-md-3 border-right" style="margin: 0px; padding:5px; height:431px; overflow: scroll; overflow-x: hidden; overflow-y: auto;"><!-- minifigs-->
                                       
                                            <?php echo $minifig; ?>
                                        
                                    </div>

                                    <div class="col-md" style="padding: 0px;"><!--imgen-->
                                        <div class="tool_bar" style="">
                                            <?php echo $btn_dwl_mnu; ?> 
                                        </div>
                                        <div class="" style="height: 360px; overflow:scroll; overflow-x:hidden; overflow-y:auto; ">
                                            <div class="" style="width: 510px; margin:20px auto; height:510px;"  id="show_img_card"> </div>
                                            <input type="hidden" id="name_card" value="" >
                                        </div>
                                    </div>
                                </div>
                                
                            </div><!-- opc_img_1-->


                            <div id="div_canvasop_2" style="display:none;">
                            <div class="row">
                                    <div class="col-md-2 border-right" style="padding:5px; margin:0px; height:431px; overflow: scroll; overflow-x: hidden; overflow-y: auto;"><!-- minifigs-->
                                    <?php echo $minifig_cole; ?>
                                    </div>

                                    <div class="col-md" style="padding: 0px;"><!--imgen-->
                                        <div class="tool_bar" style="">
                                            <?php echo $btn_dwl_mnu_combo; ?>
                                            <div class="col-md-4 text-muted" style="float:right; margin-top:5px; font-size:0.8rem;" >Precio de venta sugerido: <span class="text-muted" id="precio_sug"></span></div>
                                        </div>

                                        <div id="hold_serie" class="col-md-12 row border center" style="height:510px; z-index:999; padding:5px; background:rgba(255,255,255,1); margin:10px; overflow: scroll; overflow-x: hidden; overflow-y: auto;">

                                            <div style="left:0px; top:0px; position:absolute; width: 100%; height:100%; background: url('assets/images/bg_pattern_30.png') repeat;"></div>
                                            <div class="col-md-3" style="margin-top:10%; z-index:999;">
                                                <?php echo $img_emp; ?>
                                            </div>

                                            <div class="col-md" style="margin-top:10%;">
                                                
                                                <h5 class="col-md-12 p-3 title_sec left" id="title_combo" style="font-weight:800;"></h5>
                                                <div class="row" id="show_img_cards"></div>
                                                <input type="hidden" id="name_combo_cards" value="" >
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div><!-- opc_img_2-->

                </div>                   
                                                                             
           

             
         </div>
         
     </div>

     <script type="text/javascript">
        function capture() {
    const captureElement = document.querySelector('#hold_minifig') // Select the element you want to capture. Select the <body> element to capture full page.
    var name = document.getElementById('name_card').value+'.png';
    html2canvas(captureElement)
        .then(canvas => {
            canvas.style.display = 'none';
            document.body.appendChild(canvas);
            return canvas;
        })
        .then(canvas => {
            const image = canvas.toDataURL('image/png');
            const a = document.createElement('a');
            a.setAttribute('download', name);
            a.setAttribute('href', image);
            a.click();
            canvas.remove();
        })
}

function capture_serie() {
    const captureElement = document.querySelector('#hold_serie') // Select the element you want to capture. Select the <body> element to capture full page.
    var name = document.getElementById('name_combo_cards').value+'.png';
    html2canvas(captureElement)
        .then(canvas => {
            canvas.style.display = 'none';
            document.body.appendChild(canvas);
            return canvas;
        })
        .then(canvas => {
            const image = canvas.toDataURL('image/png');
            const a = document.createElement('a');
            a.setAttribute('download', name);
            a.setAttribute('href', image);
            a.click();
            canvas.remove();
        })
}

const btn = document.querySelector('#screen_fig');
const btn_combo = document.querySelector('#screen_combo');
btn.addEventListener('click', capture);
btn_combo.addEventListener('click', capture_serie);

     </script>