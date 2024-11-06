<?php 
$mnu = $_GET['mnu'];
$target = $_POST['serie'];
$link = $link_site.'?mnu='.$mnu;


 if(isset($target)==TRUE){

   $selectseries = genera_select_series_all($target);
   

    $figs = get_name_minifiguras($target);
    $tot_figs = get_total_minifig($target);
    $info_serie = get_info_serie($target);

  //  var_dump($figs);

    $data_serie = explode('/',$info_serie);
    $nombre_serie = strtoupper($data_serie[0]);
    $color_serie = $data_serie[1];

    $color_s = 'color: rgba('.$color_serie.',0.8);';

    $data_figs = explode(';',$figs);
  
 //  echo $figs.'<br>';
    
 //   $res = $figs.$tot_figs;
    
    if($tot_figs> 16){
        $height='height: 130px;';
        $heightb='height: 140px;';
    }else{
        $height='height: 160px;';
        $heightb='height: 170px;';
    }
//echo $tot_figs;

if (($tot_figs %2) == 0) { 
    //Es un número par
    $fila_a = $tot_figs/2;
    $fila_b = $tot_figs/2;
    // echo 'Es un número par';
} else {
    $fila_a = $tot_figs-1;
    $fila_a = ($fila_a/2)+1;
    
    $fila_b = $tot_figs-1;
    $fila_b = $fila_b/2;
    //Es un número impar
   // echo 'Es un número impar';
}

//echo $fila_a;
//echo $fila_b;

$pos = 0;

for($i=0;$i<$fila_a; $i++){
    $no = $i+1;
    // Saca la imagen del array origen 
        $data_img = explode(',',$data_figs[$i]);
            $img_origen = $data_img[3];
    // 


  
  /// movimiento vertical   
    $index = 0+$pos;
    $index_d = $fila_a -$pos;
    
    if($i==$index or $i == $index_d){
        $val_margin = $val_margin + ($pos*3);
        $margin = 'margin-top: '. $val_margin.' px; ';
    }else{
      //  $margin = 'margin-top: '. $val_margin.'px; ';
    }
  /////  

    /// Espacio entre imagenes
        if($i==0){
            $style= '';
        }else{
            $style= 'margin-left:-45px;';
        }
    
    if (($i %2) == 0){
         $index= 'z-index: 990;';
    }else{
         $index= 'z-index: 992;';
    }
        /*
        $num_a = rand(1,$fila_a);

        if($num_a==$img){
            $index= 'z-index: 997;';
        }else{
            $index= 'z-index: 996;';
        }
        */

// Valida foto
$patha = 'minifig/'.$target.'/';
$fotoa = $img_origen;
$imgsa .= $img_origen.',';

								if(file_exists($patha.$fotoa.'.webp')) {
								       $foto_enca = $fotoa.'.webp';
								} else {
									if(file_exists($patha.$fotoa.'.jpeg')){
										$foto_enca = $fotoa.'.jpeg';
									}else{
											if(file_exists($patha.$fotoa.'.png')){
												$foto_enca = $fotoa.'.png';
											}else{
										    	if(file_exists($patha.$fotoa.'.jpg')){
                                                    //echo "The file exists";
                                                    $foto_enca = $fotoa.'.jpg';
                                                    
                                                }else{
                                                    $foto_enca = $no_foto;	
                                                }		
											}								    	
									}
								}


////
 $num = (rand(7,9)*10);

 $filter = $num;

    $path_img = 'minifig/'.$target.'/'.$foto_enca;
    $row_a .= '<img class="" src="'.$path_img.'" style="filter: drop-shadow(8px 8px 10px rgba(20,20,20,0.8)); '.$margin.'  '.$height.' '.$style.' '.$index.' " id="'.$target.'_'.$no.'" >';

    $pos = $pos+1;
}
$ini_b = $fila_a+1;

for($j=$fila_a ; $j<$tot_figs; $j++){
        
        
        $no = $j+1;


        // Saca la imagen del array origen 
            $data_imgb = explode(',',$data_figs[$j]);
                $img_origen = $data_imgb[3];

//   var_dump($img_origen);
        // 


        if (($j %2) == 0){
            $index= 'z-index: 990;';
        }else{
            $index= 'z-index: 992;';
        }
   
    
        if($j==$fila_b){
            $style_b= '';
        }else{
            $style_b= 'margin-left:-50px;';
        }

        // Valida foto
        $path = 'minifig/'.$target.'/';
        $foto = $img_origen;
        $imgs .= $img_origen.',';


                                        if(file_exists($path.$foto.'.webp')) {
                                            
                                            $foto_enc = $foto.'.webp';
                                            
                                        } else {
                                            
                                            if(file_exists($path.$foto.'.jpeg')){
                                                //echo "The file exists";
                                                $foto_enc = $foto.'.jpeg';
                                                
                                            }else{
                                            //echo "The file does not exist";
                                                //$foto_portada = '0.png';	
                                                    if(file_exists($path.$foto.'.png')){
                                                        
                                                        
                                                        $foto_enc = $foto.'.png';
                                                        
                                                    }else{
                                                    //echo "The file does not exist";
                                                        if(file_exists($path.$foto.'.jpg')){
                                                            //echo "The file exists";
                                                            $foto_enc = $foto.'.jpg';
                                                            
                                                        }else{
                                                            $foto_enc = $no_foto;	
                                                        }	
                                                    }								    	
                                                        
                                            }
                                        }


        ////

            $path_img = 'minifig/'.$target.'/'.$foto_enc;
            $row_b .= '<img class="" src="'.$path_img.'" style="filter: drop-shadow(8px 8px 10px rgba(20,20,20,0.8));  '.$heightb.' '.$style_b.' '.$index.' " id="'.$target.'_'.$no.'" >';
        }

   //  echo $imgsa.'<br>'.$imgs;

        $res = '
        <div class="col-sm-12 center card-body" style="margin-top: 50px;"  >
            <div class="row col-sm-12 center" style="text-align:center; " >
                    <div style="margin:0px auto;">'.$row_a.'</div>
            </div>

            <div class="row col-sm-12 center" style="text-align:center; margin-top:-65px; z-index:998;">
                    <div style="margin:0px auto;">'.$row_b.'</div>
            </div>

            <div class="center " style="z-index:999; margin-top:40px; "> <h2 style="'.$color_s.'" >'.$nombre_serie.'</h2> </div>
        </div>
        ';

 }else{
     $selectseries = genera_select_series_all(99);
     $res= '<div class="col-md-6 text-muted " style="margin-top:20px;"> Seleccione una serie </div>';
 }

 $select = '<select name="serie" onchange="this.form.submit()" class="col-md-12 form-control col-form-label" style="margin-top:2px;" > '.$selectseries.'</select>'; 

?>



<div class="col-lg-12 tool_bar" > 
    <div class="col-6 row" >
        <label class="col-sm-3 col-form-label"> Colección: </label>
        <form method="post" action="<?php echo $link; ?>">
            <span class="col-sm-6 "> <?php echo $select; ?> </span>
        </form>
    </div>
</div>


    <?php echo $res; ?>
