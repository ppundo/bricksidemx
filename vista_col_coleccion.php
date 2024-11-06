<?php
$pagina = $_GET['element'];

if(isset($pagina)== TRUE){
                  $docs = get_pag($pagina);

}else{
                  $docs= 'empty.php';
}

$btn = $_POST['btn_comb'];
if(isset($btn)== TRUE){

$disp_tabla = '';
                  // opciones de cada aspecto a evaluar
                  
                  //$max_tipo_serie = 5; 
                  //$max_edo_serie = 5;
                  //$max_tipo_dona = 2;
                  //$max_pago = 3; 
                  //$max_perfil = 6; 
                  //$max_tipo_vista = 2;
                  //$max_sel_user = 2;
                  $no= 0;

                  $max_tipo_serie = get_total_reg('tipo_serie');
                  $max_edo_serie = get_total_reg('estado_serie');
                  $max_perfil = get_total_reg('perfiles');

                 // var_dump($max_perfil);
                  
                  for($i=1; $i<= $max_tipo_serie; $i++){
                  $lbl_i = get_lbl_tabla('tipo_serie',$i);
                  
                  
                                    
                                    for($j=1; $j<= $max_edo_serie; $j++){
                                    $lbl_j = get_lbl_tabla('estado_serie',$j);
                                                      
                                                      for($k=1; $k<= $max_perfil; $k++){
                                                      $lbl_k = get_lbl_tabla('perfiles',$k);
                                                                        
                                                                       
                                                       $no = $no+1;                                                                                                                                               
                                                       $codigob = getLetraByPosition($i).getLetraByPosition($j).getLetraByPosition($k);                                                                                               
                                                       $estado = get_permiso_coleccion_grid($codigob);
                                                      
                                                      //var_dump($codigob);
                                                                                                                                                
                                                      if($estado==1){
                                                      
                                                         $lbl = '<label class="col-form-label" > <span class="text-primary " >  <i class="fa fa-toggle-on"></i> Mostrar Serie </span>  </label> '; 
                                                      }elseif($estado==0){
                                                      
                                                         $lbl = ' <label class="col-form-label"> <span class="text-muted" >  <i class="fa fa-toggle-off"></i> Ocultar Serie </span>  </label> ';
                                                      }elseif($estado==3){
                                                         $lbl = '<label class="col-form-label"> <span class="text-premium" >   <i class="fa fa-bookmark"></i> Donativo </span>  </label> ';
                                                      }elseif($estado < 0){
                                                         $lbl = ' <label class="col-form-label" > <span class="text-clear" >  <i class="fa fa-ban"></i> No Registrado </span> </label>';
                                                      }
                                                                                                                                                
                                                                                                                                              
                                    $tabla .= ' <tr >
                                                                                                                                                                                    <td class="text-muted" > '.$no.' </td>
                                                                                                                                                                                    <td class="text-muted" > '.$codigob.' <a href="#" id="'.$codigob.'" onclick="copy_code_vista_mosaico(this.id);" > <i class="fa-solid fa-magnifying-glass"></i> </a> </td>
                                                                                                                                                                                    <td class="text-muted" > '.$lbl.'</td>
                                                                                                                                                                                    <td class="text-muted" > 
                                                                                                                                                                                                      
                                                                                                                                                                                    <button type="button" onclick="toggle(\'div_'.$codigob.'\')" class="form-control btn btn-outline-primary"> <i class="fa fa-eye"></i></button>
                                                                                                                                                                                                      <div class="col-sm-12" id="div_'.$codigob.'" style="display:none;">
                                    <span class="text-clear" style="font-size:0.8em;">                                                                                           '.$lbl_i.'<br>'.'                                                                                                                      '.$lbl_j.'<br>'.'
                                          '.$lbl_k.'<br>'.'
                                    </span>
                   </div>
     </td>
       </tr> '; 
                                                                                                                                                
                  }
                                                                                                            
                                    }	
                                                      }	
                                                                                          
                  
                  $campo_buscar = crea_campo_buscar_cust('vistas',6);

}else{
                  $disp_tabla = 'no-show';
}




$list_temas = '<option value="X" selected >Elije...</option>'.generaListTiposerie(0);
$list_series ='<option value="X" selected >Elije...</option>'.generaListEstadoSerie(0);
$list_perfil ='<option value="X" selected >Elije...</option>'.generaListPerfilesCode(0);

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>



    <div class="col-md">
                    
        <div class="card-body" style="padding: 0px;">
                        
            <h5 class="p-3 title_sec"> Colecciones (Mosaico)
	            <span class=" col-md-4  text-clear col-form-label" style="font-size: 12px;" id="code_series_b"></span>
            </h5>
                        
            <div class="row" style="border:0px solid #a50;">
 	
                <div class="col-4 border-right " style="padding-top: 10px; border: 0px solid #c30;" >

	                <div class="col-md" style="padding: 0px;">
                        
                        <div class="col-12 form-group" style="padding: 0px; text-align:center;">	                        
                            
                        <div class="input-group" style="padding: 0px; margin-bottom:5px;">
		                    
                                <div class="input-group-prepend bg-head">
                                    <span class="input-group-text text-ligth"><i class="fa-solid fa-magnifying-glass"></i></span>
                                </div>
                            
                                <input type="text" class="col-sm-12 form-control" onblur="decode_series(this.value)" id="code_series_e" value="" placeholder="Buscar Clave Registro" >
            
		                    </div>
                            <form name="form_comb" action="<?php  echo $actual_link; ?>" method="post">
                                <button type="submit" class="btn btn-inverse-primary btn-block"  name="btn_comb" title="Ver todas opciones"> <i class="fa-solid fa-diagram-project"></i> Ver Todo</button>
                            </form>
	                    </div>	
                                                     

           
                        <div class="form-group row col-12 border-bottom border-top bg-head" style="padding: 0px; margin-left: 0px;">			                       
		                    <span class="col-6" style="font-size: 12px; " id="resultado_val_colect"></span>
		                    <span class="col-6 " id="resultado_valb_colect" style=""> </span>
	                    </div>
	
                    </div>
                          
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="text-muted col-sm-4 col-form-label">Tipo de Serie</label>
                        
                        <div class="col-sm-8">
                            <select class="form-control" id="select_col_1" onchange="valida_select_colec(this.id);">
								<?php echo $list_temas; ?>
							</select>	
                        </div>
                    </div>

                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="text-muted col-sm-4 col-form-label">Estado Serie</label>
                            <div class="col-sm-8">
                              		<select class="form-control" disabled="" id="select_col_2" onchange="valida_select_colec(this.id);">
										<?php echo $list_series; ?>										
									</select>			
                            </div>
                          </div>


                          
                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="text-muted col-sm-4 col-form-label">Perfil Usuario</label>
                            <div class="col-sm-8">
                              	<select class="form-control" disabled="" id="select_col_3" onchange="valida_select_colec(this.id);">
										<?php echo $list_perfil; ?>
									</select>	
                            </div>
                          </div>                                                           
                        
		                    <input type="hidden" class="form-control" id="code_series">
		                    <input type="hidden" class="form-control" id="config_colection" value="B">
            </div>
                       
                       
        <div class="col-md <?php echo $disp_tabla; ?>" style="padding:0px;">		
            
        <div class="card-body" style="padding: 0px; height: 100%;  border: 0px solid #cd0; ">
                
            <h5 class="col-md-12 p-1 subtitle_sec">
                Permisos Registrados 
                <span class="col-md-4  text-clear col-form-label" style="font-size: 12px;"></span>
            </h5>
                                                           
            <?php echo $campo_buscar; ?>
                                                           
            <div style=" height: 385px; overflow: scroll; overflow-x: hidden; overflow-y: auto;">
                                                                     
                <table class="table table-striped table-bordered" id="vistas">
                    <thead>
                        <tr>
                            <th class="thead_content">No</th>
                            <th class="thead_content"> Código</th>
                            <th class="thead_content">Estado</th>
                            <th class="thead_content">Acciones</th>
                        </tr>
                    </thead>
                                                                        
                    <tbody>
                        <?php echo $tabla; ?>
                    </tbody>
                                                                                               
                </table>
                                                                             
            </div>
        </div>
    </div>
                       
                       
                      </div>
                  </div>
  
