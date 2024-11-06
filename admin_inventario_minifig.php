<?php
include("check_access.php");

$mnu = $_GET['mnu'];
$cve = $_GET['cve'];
$user = $GLOBALS['user'];



$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
              //informacion de acceso a la bd
        // Check connection
            if ($dbh->connect_error) {
                die("Connection failed: " . $dbh->connect_error);
            }

    $qs = "Select * from coleccion where id_user = $user group by clave_lego ;";// preparando la instruccion sql

    //var_dump($qs);

                $resultr= $dbh->query($qs);
                if ($resultr->num_rows > 0) {
                    
                    $n = 0;

                        while($rows= $resultr->fetch_assoc()){
                            $n= $n+1;

                            $patht = $path_site.'index.php?mnu='.$mnu.'&cve='.$cve.'&item='.$rows['clave_lego'];

                            $info_serie = get_info_serie($rows['clave_lego']);
                            //var_dump($info_serie);
                            
                            $data_serie = explode('/',$info_serie);
                            $nombre_serie = $data_serie[0];
                    
                             $res .= ' 

                             <tr>
                                <td>
                                    <span class="text-primary " style=" font-size:1.1em; "> <i class="fa-solid fa-boxes-stacked"></i> </span> 
                                     <a href="'.$patht.'" class="col text-primary"  style="font-size:0.7rem;"> '.strtoupper($rows['clave_lego'].' - '.$nombre_serie).' </a>
                                </td>
                             </tr>

                                ';

                                 // botones para csv



                        }
                        
                }else{

                        $res .= '';

                }
                $path_all = $path_site.'index.php?mnu='.$mnu.'&cve='.$cve.'&item=999';

                $campo_buscar_inv = crea_campo_buscar_cust('col_inventario',12);
                

                $res_all ='     
                            <tr>
                            <td>
                                <span class="text-primary " style=" font-size:1.1em; "> <i class="fa-solid fa-boxes-stacked"></i> </span> 
                                <a href="'.$path_all.'" class="col text-primary"  style="font-size:0.8rem;"> Mi inventario </a>
                            </td>
                            </tr>'; 

                            

                                 $ress = '<table id="col_inventario" class="table table-striped sortable ">
                                 <thead>
                                    <th class="bg-head no-show"> </th>
                                 </thead>
                                 <tbody>
                                 '.$res_all.$res.'
                                 </tbody>
                                 </table>';

//////////////////////////////////////////////////////////////////////////

    $serie = $_GET['item'];

    if(isset($serie)==TRUE){

        if($serie == 999){
            $qa = "Select * from coleccion where id_user = $user and no_extra > 0 and estado = 1;";// preparando la instruccion sql
            $numero_serie = '';
            $nombre_serie = 'Todo Mi inventario';

        }else{
            $info_serie = get_info_serie($serie);
            $data_serie = explode('/',$info_serie);
            $nombre_serie = ' - '.$data_serie[0];

            $qa = "Select * from coleccion where id_user = $user and clave_lego = $serie and estado = 1;";// preparando la instruccion sql
            $numero_serie = $serie;
            
        }
        
        ////// boton de Lista 
        if($serie > 0 and $serie<999 ){
            $nombreg = 'SETS SIN AGRUPAR';
            $buttons_gpo = '
                <button type="button" id="btn_csv_0" onclick="genera_csv_minifig(0);" class=" btn btn-inverse-primary" style="border:0px solid #ccc;"> 
                    <i class="fa-solid fa-file-csv"></i> Exportar
                </button>
            '; 
        }elseif($serie==999){
            $nombreg = 'TODOS LOS SETS';
            $buttons_gpo = '
                <button type="button" id="btn_csv_999" onclick="genera_csv_minifig(999);" class=" btn btn-inverse-primary btn_thin" style="border:0px solid #ccc;"> 
                    <i class="fa-solid fa-file-csv"></i> Exportar
                </button>
            '; 
        }else{
            $nombreg = '';
            $buttons_gpo = '
                <button type="button" id="btn_csv_999" onclick="genera_csv_minifig('.$serie.');" class=" btn btn-inverse-primary btn_thin" style="border:0px solid #ccc;"> 
                    <i class="fa-solid fa-file-csv"></i> Exportar
                </button>
            '; 
        }
        //var_dump($qs);
    
                    $resultr= $dbh->query($qa);
                    if ($resultr->num_rows > 0) {
                        
                        $n = 0;
    
                            while($row= $resultr->fetch_assoc()){
                                $n= $n+1;
    
                              //  $patht = $path_site.'index.php?mnu='.$mnu.'&cve='.$cve.'&item='.$row['clave_lego'];
                              $info_min = get_all_data_minifig($row['item']);
                              $data_min = explode('/',$info_min);
                              $fecha_add = formatFechaHora($row['fecha_registro']);
                              //$dato_encontrado = $row['nombre_es'].' / '.$row['nombre_en'].'/'.$row['cve_lego'].'/'.$row['imagen'].'/'.$row['tags'].'/'.$row['estado'].'/'.$row['no_folleto'].'/'.$row['piezas'].'/'.$row['fecha_registro'].'/'.$row['fecha_actualizado'].'/'.$tot_fig;

                              $nombre_es = $data_min[0];
                              $nombre_en = $data_min[1];
                              $img = $data_min[3];
                              $no_folleto = $data_min[6];
                              $serie_disp = $data_min[2];
    
                                if($nombre_es==$nombre_en){
                                    $nom = $nombre_es;
                                }else{
                                    $nom =substr($nombre_es.' / '.$nombre_en,0,25).'...';
                                }

                                $url_img = 'minifig/'.$row['clave_lego'].'/'.$img.'.webp';

                              $url_print = $GLOBALS['path_site'].'modal_barcode.php?'.'cve='.$GLOBALS['user'].'&item='.$row['item'];

                              $info = $GLOBALS['user'].'-'.$row['item'];

                              $btn_ver = '<button type="button" class="btn btn-inverse-primary btn_thin" onclick="ver_code(\''.$info.'\'); toggle_op_minifig(\'1\');" > <i class="fa-solid fa-eye"></i> </button>';
                              $btn_guardar = '<button type="button" class="btn btn-inverse-primary btn_thin" onclick="save_minifig_extras(\''.$url_print.'\')" > <i class="fa-solid fa-save"></i> </button>';


                              $permiso_guardar = get_permiso_config('37', $GLOBALS['user_perfil']);
                             // var_dump($permiso_guardar);

                                    if($permiso_guardar==1){
                                        $btn_dwl_mnu = '<button type="button" id="screen_fig" class="minifig_menu btn btn-outline-primary btn_thin"> <i class="fa-solid fa-download"></i> </button>';
                                    }else{
                                        $btn_guardar = '';
                                        $btn_dwl_mnu = '';
                                    }

                              $clave_min = $row['clave_lego'].'-'.$no_folleto;
                              $codigob = genera_barcode_codigo_minifig($clave_min,1,$user);
                              $valida_img = '';

                              if (file_exists($url_img)) {
                                $image_src = $url_img;
                              }else{
                                $url_img_noimage = 'minifig/minifig.png';
                                $image_src = $url_img_noimage; 
                              }

                                 $regs .= ' 
    
                                    <tr>
                                        <td> <span class="text-muted">'.$n.'</span> </td>
                                        <td> <img src="data:image/png;base64,'.base64_encode(file_get_contents($image_src)).'" style="width:35px; "> </td>
                                        <td> 
                                            <span class="text-muted" style="font-size:0.9rem;"> '.$nom.' </span> <br>
                                            <span class="text-muted" style="font-size:0.6rem;"> Agregado el: '.$fecha_add.'</span><br>
                                            <span class="text-muted" style="font-size:0.6rem;"> '.$serie_disp.' | No Folleto: '.$no_folleto.'</span> 
                                            
                                        </td>
                                        <td> 
                                            <input type="number" class="form-control" id="'.$user.'-'.$row['item'].'" onblur="save_minifig_extras(this.id)" value="'.$row['no_extra'].'" /> 
                                            <span class="no-show">'.$codigob.'</span>
                                        </td>

                                        <td> 
                                            $ <input type="number" min="160" step="10" class="form-control" id="precio_'.$user.'-'.$row['item'].'" onblur="save_minifig_extras(\''.$user.'-'.$row['item'].'\')" value="'.$row['precio'].'" /> 
                                            <span class="no-show">'.$codigob.'</span>
                                        </td>
                                        
                                        <td>
                                            

                                            <div class="btn-group" role="group" aria-label="" > 
                                                <button type="button" id="btn_'.$row['item'].'" title="Imprimir" onclick="javascript:ventanaCodebarMinifig(\''.$url_print.'\'); cerrar();" class=" btn btn-inverse-primary btn_thin" > 
                                                <i class="fa-solid fa-barcode"></i> </button>
                                                
                                                '.$btn_ver.'
                                            </div>

                                            
                                        
                                        </td>
                                    </tr>

                                    ';
    
                            }
                            
                    }
                   // $busca = crea_campo_buscar('table_minifigs',6);
                    $busca = crea_campo_buscar_cust('table_minifigs',6); 
                    //$campo_buscar = crea_campo_buscar_cust('colecciones_inventario',12);

                    $table = '
                        <table class="table table-striped" id="table_minifigs" >
                            
                            <thead>
                                <tr>
                                    <th class="thead_content text-head">No</td>
                                    <th class="thead_content text-head" colspan="2" >Figura</td>
                                    <th class="thead_content text-head" >Extras</td>
                                    <th class="thead_content text-head" >Precio</td>
                                    <th class="thead_content text-head" >Opciones</td>
                                </tr>
                            </thead>
                            
                            <tbody>
                            '.$regs.'
                            </tbody>

                            <tfooter>
                                <tr>
                                    <th class="thead_content text-head">No</td>
                                    <th class="thead_content text-head" colspan="2" >Figura</td>
                                    <th class="thead_content text-head" >Extras</td>
                                    <th class="thead_content text-head" >Precio</td>
                                    <th class="thead_content text-head" >Opciones</td>
                                </tr>
                            </fotter>

                        </table>
                    ';

        
    }


?>






    <div class="row" >
        
        <div class="col-md-2 bg-light border-right left_panel_shadow" style="height: 100%; padding:0px;" >
            <h5 class="col-md-12 p-2 title_sec " ><span style="margin-left:10px;"> Colecciones </span></h5>

            <div class="col-md-12 content p-1" style="padding:0px; height: 475px; overflow-x: hidden; overflow-y: auto; ">
                <?php echo $campo_buscar_inv; ?>

                <div style="overflow: auto; overflow-x: hidden; overflow-y:auto;">
                    <?php echo $ress; ?>
                </div>
             </div>

        </div>


<!-- Panel Central -->



<div class="col-md bg-light border-right" style="padding:0px; height:525px; "> 
            
            <div class="row" style="margin:0px; padding:0px;">
                <h5 class="col-md p-2 title_sec  "> &nbsp; <?php echo $numero_serie.$nombre_serie; ?> </h5>
                
                <div class="col-md-6 p-2 title_sec " style="float:left; " id="ops"> 
                    <div class="btn-group" role="group" style=" border:none;"> 
                        <?php echo $buttons_gpo; ?>
                    </div>
                    
                </div>


            </div>



            <div class="row" style="margin:0px; padding:0px;">
            
                <div id="current_sets" class="col-md-8 border-right" style="display:block; ">
                        
                        <div class="col-12" style="margin-top:5px; padding:0px;" ><?php echo $busca; ?></div>

                        <div style="height: 400px; overflow-x: hidden; overflow-y: auto; z-index: 9999;">
                            <?php echo $table; ?>
                        </div>
                </div>

                <div id="current_sets" class="col-md" style="height: 450px; margin:0px; padding:0px;  ">

                        <div class="mnu_bar" >                               
                                <div class=" btn-group-bar" role="group">								
                                    <button type="button" id="minifigmnu_1" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar_sm minifigmnu minifigmnu_sm "> <i class="fa-solid fa-barcode"></i> </button>
                                    <button type="button" id="minifigmnu_2" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar_sm minifigmnu minifigmnu_sm"> <i class="fa-solid fa-child"></i> </button>
                                </div>
						</div>

                    <div id="div_minifigmnu_1" class="border-bottom" style="display:none; margin-top:20px;" >
                        <div class="" style="width: 250px; margin:0px auto;" id="show_code">
                        </div>

                    </div>

                    <div id="div_minifigmnu_2" class="border-bottom" style="display:none; margin-top:10px; height:400px;" >
                        <div class="" style="width: 250px; margin:20px auto;"  id="show_img_card"> </div>
                        <input type="hidden" id="name_card" value="" >
                    </div>

                </div>

            </div>

</div>

