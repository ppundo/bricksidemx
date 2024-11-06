<?php
include("check_access.php");

$mnu = $_GET['mnu'];
$cve = $_GET['cve'];
$lista = $_GET['lst'];
$gpo = $_GET['gpo'];



$current_url = $GLOBALS['link_site'].'?mnu='.$mnu.'&cve='.$cve.'&gpo='.$gpo;

//$user = $GLOBALS['user'];

$formato = $_POST['flatRadios'];

if(isset($formato)== FALSE or $formato == 0){
    $format = 1; 

}else{
    $format = $_POST['flatRadios'];

}

//////////////// Encuentra las facturas de cada usuario
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
              //informacion de acceso a la bd
        // Check connection
            if ($dbh->connect_error) {
                die("Connection failed: " . $dbh->connect_error);
            }



$select_ubic = genera_select_ubicacion($user,$current);
//Select * from recibos, 
        
              $qrr = "Select * from grupos_inventario where estado = 1 and id_user = $user order by orden;";// preparando la instruccion sql
              

                $resultr= $dbh->query($qrr);
                if ($resultr->num_rows > 0) {
                    
                   // $users .= ' <div class="p-1 text-muted border-bottom margin-grid center" style="text-align:center;"> <span> <i class="fa fa-users"></i> </span>Usuarios</div><br>';
                    
                        while($rowr= $resultr->fetch_assoc()){

                            $path = $path_site.'?mnu='.$mnu.'&cve='.$cve.'&gpo='.$rowr['id'];
                            $url_list = $path_site.'?mnu='.$mnu.'&cve='.$cve.'&gpo='.$rowr['id'].'&lst=1';
                            $url_print_gpo=$path_site.'modal_barcode.php?'.'&cve='.$user.'&codebar='.$rowr['id'];

                           // if($rowr['id_ubicacion']!=0 and $rowr['id_ubicacion']!= 'X'){

                            if($rowr['id_ubicacion']!=0 and $rowr['id_ubicacion']!= 'X'){
                                $loc = get_info_ubic($rowr['id_ubicacion']);
                                $data_loc = explode('|',$loc);
                                $title_loc = '<span class="text-clear btn btn-muted" style="font-size:0.9rem; padding:0.4rem; "><i style="margin-right:3px;" class="fa-solid fa-location-dot"></i>'.$data_loc[0].'</span>';
                                 $lbl_loc = '<span class="" style="font-size:0.7rem; ">'.$data_loc[0].'</span>';
                            }else{
                            
                                $title_loc = '<span class="text-clear btn btn-muted" style="font-size:0.9rem; padding:0.4rem; "><i style="margin-right:3px;" class="fa-solid fa-location-dot"></i> <i class="fa-solid fa-ellipsis"></i></span>';
                                
                            }
                    

                            $res .= '

                <div class="text-muted" style="padding:0px; margin:0px; color:#4d0034; " >
                                        
                                        <div class="row col-md-12  bg-head-low  " style="border-bottom:1px solid rgba(190,190,190,0.5); font-size:0.8em; margin:0px 0px; margin-left:0px; padding:10px 0px 8px 0px; padding-right:0px; " title="">

                                                <span class="col-1 text-primary " style=" font-size:1.1em; "> <i class="fa-solid fa-box-archive"></i> </span> 
                                                
                                                <a href="'.$path.'" class="col text-primary"  style="font-size:1.1em;"> '.$rowr['nombre'].' </a>

                                                <input type="hidden" id="gpo_orig_'.$rowr['id'].'" value="'.$rowr['id'].'" >
                                                <input type="hidden" id="title_'.$rowr['id'].'" value="'.$rowr['nombre'].'" >
                                                <input type="hidden" id="orden_'.$rowr['id'].'" value="'.$rowr['orden'].'" >
                                                <input type="hidden" id="ubic_'.$rowr['id'].'" value="'.$rowr['id_ubicacion'].'" >
                                            
                                        </div> 


                    </div>

                             ';               
                        }
                        
                }else{

                        $res = '<span class="text-clear" style="margin-left:40px;" >No hay mas grupos</span>';

                }
// grupo para los sets que no estan asignados
$pathb = $path_site.'?mnu='.$mnu.'&cve='.$cve.'&gpo=0';
$patht = $path_site.'?mnu='.$mnu.'&cve='.$cve.'&gpo=99';

// Todos los sets 
$res_no = '

                             <div class="border-bottom text-muted" style=" color:#4d0034; " >
                                                     
                                                     <div class="row col-md-12" style="border-bottom:0px solid rgba(190,190,190,0.5); font-size:0.8em; margin:0px 0px; margin-left:0px; padding:10px 0px 8px 0px; padding-right:0px; " title="">
             
                                                             <span class="col-1 text-muted " style=" font-size:1.1em; "> <i class="fa-solid fa-boxes-stacked"></i> </span> 
                                                             
                                                             <a href="'.$patht.'" class="col text-muted"  style="font-size:1.1em;"> Todos Los Sets </a>
             
                                                             <input type="hidden" id="gpo_orig_99" value="99" >
                                                             <input type="hidden" id="title_99" value="Todos los Sets" >
                                                             <input type="hidden" id="orden_99 value="99" >
                                                                    
             
                                                     </div> 
            
                                 </div>
             
                                          ';  
// sets no agrupados
$res_no .= '

                <div class="border-bottom text-muted" style="padding-left:0px; padding-right:0px; padding-top:0px; padding-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; margin-bottom:0px; color:#4d0034; " >
                                        
                                        <div class="row col-md-12 " style="border-bottom:0px solid rgba(190,190,190,0.5); font-size:0.8em; margin:0px 0px; margin-left:0px; padding:10px 0px 8px 0px; padding-right:0px; " title="">

                                                <span class="col-1 text-muted " style=" font-size:1.1em; "> <i class="fa-solid fa-cubes-stacked"></i> </span> 
                                                
                                                <a href="'.$pathb.'" class="col text-muted"  style="font-size:1.1em;"> Sin Agrupar </a>

                                                <input type="hidden" id="gpo_orig_0" value="0" >
                                                <input type="hidden" id="title_0" value="Sin Agrupar" >
                                                <input type="hidden" id="orden_0 value="0" >                                           

                                        </div> 
                    </div>

                             ';  

$btn_grupo = ''; 

/////// Obtiene los sets 

if($gpo == 0){
    $qs = "Select * from sets where id_user = $user order by grupo;";// preparando la instruccion sql
}elseif($gpo==99){
    $qs = "Select * from sets where id_user = $user order by grupo;";// preparando la instruccion sql
}else{
    $qs = "Select * from sets where id_user = $user and grupo != $gpo order by grupo;";// preparando la instruccion sql
}

                
              

                $resultr= $dbh->query($qs);
                if ($resultr->num_rows > 0) {
                    
                    $n = 0;

                        while($rows= $resultr->fetch_assoc()){
                            $n= $n+1;

                            $info_grupo = getinfogrupo($rows['grupo']);
                            $data_grupo = explode('|',$info_grupo);
                            $nom_gpo = $data_grupo[0];

                            $code_barcode = genera_barcode_codigo($rows['cve_lego'],0,$user);
                    
                             $ress .= ' <option  class="text-muted " style="border-bottom: 1px solid #f3f3f3; padding:5px;" value="'.$rows['id'].'" >'.$n.'. <span class="col-sm-1">'.$rows['cve_lego'].'</span> - <span class="col-sm-3"> '.$rows['nombre'].'</span> - <span class="text-clear">[ '.$nom_gpo.' ]</span> </option> ';

                             $sets_id .= '<input type="hidden" id="'.$rows['cve_lego'].'" value="'.$rows['id'].'" >'; 
                             $sets_name .= '<input type="hidden" id="name_'.$rows['cve_lego'].'" value="'.$rows['nombre'].'" >';
                             
                             $sets_id_c .= '<input type="hidden" id="'.$code_barcode.'" value="'.$rows['id'].'" >'; 
                             $sets_name_c .= '<input type="hidden" id="name_'.$code_barcode.'" value="'.$rows['nombre'].'" >';  

                        }
                        
                }else{

                        $ress = '<option value="99" > No existen sets sin agrupar </option> ';

                }

                // obtiene todos los sets con o sin grupo asignado

//////---- Obtiene los SETS de los grupos -------//////


if(isset($gpo)){

//////////////// 
if($gpo==99){
    $query = ''; 
}else{
    $query = 'grupo = '.$gpo.' and '; 
}

$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
              //informacion de acceso a la bd
        // Check connection
            if ($dbh->connect_error) {
                die("Connection failed: " . $dbh->connect_error);
            }

        
              $q = "Select * from sets where ".$query." id_user = $user order by fecha_add desc;";// preparando la instruccion sql
              
                $nn = 0; 
                $resultr= $dbh->query($q);
                if ($resultr->num_rows > 0) {
                    
                    


while($row= $resultr->fetch_assoc()){
    
   
    $nn = $nn+1;

     
    $codigo_barcode = genera_barcode_codigo($row['cve_lego'],$format,$GLOBALS['user']);
    $codigo_barcodeb = genera_barcode_codigo($row['cve_lego'],0,$GLOBALS['user']);
    //$codigo_barcodeb = genera_barcode_codigo($row['cve_lego'],0,$GLOBALS['user']);

    $list .= '<p>'.$nn.'. '.$row['cve_lego'].'<tab>'.$row['nombre'].'<tab>'.$codigo_barcode.'</p>'; 

    //$url_print=$GLOBALS['path_site'].'modal_barcode.php?'.'codebar='.$codigo_barcode.'.'.$row['nombre'].'.'.$row['id_tema'];

    $url_print=$GLOBALS['path_site'].'modal_barcode.php?'.'cve='.$GLOBALS['user'].'&codebar='.$row['cve_lego'];
    //https://bricksidemx.com/collector/modal_barcode.php?cve=2&codebar=10309&format=undefined

    $url_public = $GLOBALS['path_site'].'public.php?mnu=7ebec37c9512e433ed508847c24ba1b1&item='.$codigo_barcodeb;
https://bricksidemx.com/collector/public.php?mnu=7ebec37c9512e433ed508847c24ba1b1&item=02101900102

        if($gpo!=99){
            if($row['grupo']==0){
                $btn_sacar = '
                <button type="button" disabled  title="Quitar del Grupo"  class=" btn btn-inverse-primary btn-thin " > 
                    <i class="fa-solid fa-trash-arrow-up"></i>
                </button>';
                $btn_sacar ='';
                
            }else{
                $btn_sacar = '
                    <button type="button" id="'.$row['id'].'" title="Quitar del Grupo" onclick="elimina_item_grupo(this.id)" class=" btn btn-inverse-primary btn_thin " > 
                        <i class="fa-solid fa-trash-arrow-up"></i>
                    </button>

                ';
                
            }
            $info_gpo='';

            $path_img = 'assets/images/sets/';
            $img_set = $path_img.$row['cve_lego'].'.webp';
            $img_prev = '<img class="zoom" id="img_set_'.$row['cve_lego'].'" src="data:image/png;base64,'.base64_encode(file_get_contents($img_set)).'" style="width: 35px; " />';
    
        }else{

            $btn_img = '<span ></span>'; 
            //$btn_sacar = '';

           
            //////
            $info_tema = getinfotema($row['id_tema']);
            $data_tema= explode('|',$info_tema);
            $nom_tema = $data_tema[0];

            $info_grupo = getinfogrupo($row['grupo']);
            $data_grupo = explode('|',$info_grupo);
            $nom_gpo = $data_grupo[0];

            if($row['grupo']!=0){
                $ico= '<span class="text-primary" >  '.$nom_gpo.'</span>'; 
            }else{
                $ico= '<span class="text-muted"> '.$nom_gpo.'</span>'; 
            }

            $info_gpo = '  <span class="text-muted" style="font-size: 0.6rem; padding:3px 2px;border-top:0px solid #ccc "> | '.$ico.' </span>';
        
            $path_img = 'assets/images/sets/';
            $img_set = $path_img.$row['cve_lego'].'.webp';
            $img_prev = '<img class="zoom" id="img_set_'.$row['cve_lego'].'" src="data:image/png;base64,'.base64_encode(file_get_contents($img_set)).'" style="width: 35px; " />';
        }


          $select_codebar = genera_select_tipo_codigo(0);

          $tam = strlen($row['nombre']);

          $len_name=30;

          if($tam > $len_name){
            $extra = '...';
            $falt = $tam-$len_name;
            $falt = '[ '.$falt.' ]';
          }else{
            $extra = '';
            $falt = '';
          }

          if($tam<= 10){
            $index_f = 'small -S';
          }elseif($tam>10 and $tam <= 20){
            $index_f = 'medium -M';
          }elseif($tam>20 and $tam <= 30){
            $index_f = 'large -L';
          }elseif($tam>30 and $tam <= 40){
            $index_f = 'extralarge -XL';
          }elseif($tam>40){
            $index_f = 'enormous -XXL';
          }

            $set_edo = $row['set_edo'];

            if($set_edo==1){
                $index_f .= ' Completo '; 
            }else{
                $index_f .= ' Incompleto '; 
            }

            $info_presentacion = get_info_presentacion($row['id_presentacion']);
            $data_presentacion = explode('|',$info_presentacion);
            $nombre_pres = $data_presentacion[1];
            $ico_pres = $data_presentacion[2];

            $index_f .= ' '.$nombre_pres;

            $form_name = 'form_'.$gpo; 

            $check = '<input type="checkbox"  value="" title="Set: '.$row['cve_lego'].'-'.$row['id'].'" name="serie_'.$row['id'].'" id="serie_'.$row['id'].'" >'; 
            //https://bricksidemx.com/collector/modal_barcode.php?cve=2&codebar=40529&format=1

            $btn_print_lbl_ext = '<a class="btn btn-inverse-primary btn_thin" target="_blank" href="'.$url_print.'"> <i class="fa-solid fa-arrow-up-right-from-square"></i> </a>
            ';

            $perfil = $GLOBALS['user_perfil'];
            $permiso_link= get_permiso_config('29', $perfil);

            if($permiso_link==1){
                $cve = $_GET['cve'];
                $link_lbl_pint = $GLOBALS['path_site'].'modal_barcode.php?cve='.$cve .'&format=1&codebar='.$row['cve_lego'];
                
               // $link_code = '<a class="text-primary" href="'.$link_lbl_pint.'" target="_blank" > '.$codigo_barcode.' <i class="fa-solid fa-arrow-up-right-from-square"></i> </a>';
                $link_code = '<a class="text-primary" href="'.$url_public.'" target="_blank" > '.$codigo_barcodeb.' <i class="fa-solid fa-arrow-up-right-from-square"></i> </a>';

                $link_printt = '<a class="text-primary" href="'.$link_lbl_pint.'" target="_blank" > '.$row['cve_lego'].' <i class="fa-solid fa-arrow-up-right-from-square"></i> </a>';
                $link_print = $row['cve_lego']; 

            }else{
                $link_code = '<span class="text-muted"> '.$codigo_barcodeb.'</span>';
                $link_print = $row['cve_lego']; 
            }

            if($row['codebar_box']==''){
                $code_box = '<span class="text-clear" style="font-size:0.6rem;"> Sin Código De Caja </span>';
            }else{
                $code_box = '<span class="text-muted" style="font-size:0.6rem;"> <i class="fa-solid fa-box-open"></i> '.$row['codebar_box'].'</span>';
            }
                
           $btn_lbl = '<button type="button" id="btn_'.$row['id'].'" title="Imprimir" onclick="javascript:ventanaCodebar(\''.$url_print.'\'); cerrar();" class=" btn btn-outline-primary btn_thin" > <i class="fa-solid fa-barcode"></i> </button> ';
            
            $info = $GLOBALS['user'].'-'.$row['cve_lego'];

            $btn_ver = '<button type="button" class="btn btn-outline-primary btn_thin" onclick="ver_code_set(\''.$info.'\')" > <i class="fa-solid fa-eye"></i> </button>';
                    
                                            
                             $sets .= '
                             
                                <tr>
                                
                                     <td class="center"> <span class="text-muted">'.$nn.'</span> </td>
                                    <td> '.$img_prev.'</td>
                                    <td> <span class="text-muted"> '.$link_print.'</span></td>
                                    <td> 
                                        <div class="row">

                                            <div class="col-md-1" style="height:100%; vertical-align:middle;"> 
                                                <span class="text-muted" style="font-size:0.9rem;" title="'.$nombre_pres.'" > <i class="fa-solid '.$ico_pres.'"></i> </span><br>
                                                
                                            </div>

                                            <div class="col-md-10 ">
                                                <span class="text-muted" style="margin-bottom:2px; font-size:0.8rem;">'.substr($row['nombre'],0,$len_name).''.$extra.'
                                                    <span class="text-clear no-show" style="font-size:0.7rem;">'.$falt.'</span>
                                                </span> <br> 
                                                <span class="text-muted" style="font-size:0.6rem;">'.$nom_tema.'  </span>'.$info_gpo .' 
                                            </div>

                                        </div>
                                    
                                    </td>
                                    <td>
                                           
                                                <span class="text-muted" style="font-size:0.7rem;" > Agregado: '.formatFechaHora($row['fecha_add']).'</span><br>
                                                <span class="text-muted" style="font-size:0.7rem;" > Agrupado: '.formatFechaHora($row['fecha_grupo']).'</span>
                                            
                                    </td>
                                        

                                    
                                    <td> '.$link_code.'<br> '.$code_box.' </td>
                                    
                                    
                                    <td>

                                    <div class="btn-group" role="group" aria-label="" > 
                                    '.$buton_lbl.$btn_sacar.$btn_sacarr.' 
                                    </div>
                                    <span class="no-show">'.$index_f.'</span>
                                    
                                    </td>
                                    
                                </tr>
                                        ';
                            
              
                        
                        }// while 

//$busca = crea_campo_buscar('table_sets_gpo');
$busca = crea_campo_buscar_cust('table_sets_gpo',3); 

                    $table = '
                    <form name="'.$form_name.'" >
                    <table id="table_sets_gpo" class="table table-striped"> 
                    
                                <thead>
                                    <tr>
                                        <th class="thead_content text-head">No</th>
                                        <th class="thead_content text-head" > <span><i class="fa-regular fa-image"></i></span> </th>
                                        <th class="thead_content text-head">Clave </th>
                                        <th class="thead_content text-head" style="width:70px;">Nombre </th>                                        
                                        <th class="thead_content text-head">Fechas</th>  
                                        <th class="thead_content text-head">Código</th>                                    
                                        <th class="thead_content text-head">Opciones</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    
                                    '.$sets.' 
                                    
                                </tbody>
                                
                                <tfooter>
                                    <tr>
                                    <th class="thead_content text-head">No</th>
                                        <th class="thead_content text-head" > <span><i class="fa-regular fa-image"></i></span> </th>
                                        <th class="thead_content text-head">Clave </th>
                                        <th class="thead_content text-head" style="width:70px;">Nombre </th>                                        
                                        <th class="thead_content text-head">Fechas</th>  
                                        <th class="thead_content text-head">Código</th>                                   
                                        <th class="thead_content text-head">Opciones</th>
                                    </tr>
                                </tfooter>
                            </table>
                            </form>'; 

                        
                }else{

                        $table = '<h5 class="col-md-12 p-3 text-clear center " style="margin-top:30px;" > Selecciona un grupo del panel lateral </h5>';

                }

                                   $qb = "Select * from grupos_inventario where id_user = $user and id = $gpo";
                                  
                              //    var_dump($qb);

                                    $resulta= $dbh->query($qb);
                                    
                                    if($resulta->num_rows > 0) {
                                        $row= $resulta->fetch_assoc();

                                            $nombreg = $row['nombre'];
                                            $url_print_gpo=$path_site.'modal_barcode.php?'.'&cve='.$user.'&codebar='.$row['id'];

                                            /*
                                             <button type="button" id="'.$row['id'].'" onclick="javascript:ventanaCodebar(\''.$url_print_gpo.'\');" class="btn btn-inverse-primary" style="border:0px solid #ccc;"> <i class="fa-solid fa-barcode"></i>
                                                </button>
                                                */
                                            $buttons_gpo =  '
                                                <input type="hidden" id="nombre_grupo_'.$row['id'].'" class="form-control text-clear" style="margin:5px 0px;" value="'.$row['nombre'].'" placeholder="Nombre ">

                                               
                                            
                                                <button type="button" id="'.$row['id'].'" onclick="gpo_opt(\''.$row['id'].'\'); toggle(\'opciones\')" class=" btn btn-inverse-primary " style="border:0px solid #ccc;"> <i class="fa-solid fa-pencil"></i>
                                                </button>
                                               
                                                <button type="button" id="'.$row['id'].'" onclick="gpolist(\''.$row['id'].'\')" class=" btn btn-inverse-primary " style="border:0px solid #ccc;"> <i class="fa-solid fa-circle-plus"></i>
                                                </button>


                                                <button type="button" id="btn_csv_'.$row['id'].'" onclick="genera_csv_grupo('.$row['id'].');" class=" btn btn-inverse-primary" style="border:0px solid #ccc;"> 
                                                    <i class="fa-solid fa-file-csv"></i>
                                                </button>

                                                <button type="button" id="'.$row['id'].'" onclick="elimina_grupo(this.id)" class=" btn btn-inverse-primary" style="border:0px solid #ccc;"> <i class="fa-solid fa-trash"></i>
                                                </button>
                                            '; 

                                        
                                            if($row['id_ubicacion']!=0 and $row['id_ubicacion']!= 'X'){
                                                $loc = get_info_ubic($row['id_ubicacion']);
                                                $data_loc = explode('|',$loc);
                                                $title_loc = '<span class="text-clear btn btn-muted" style="font-size:0.9rem; padding:0.4rem; "><i style="margin-right:3px;" class="fa-solid fa-location-dot"></i>'.$data_loc[0].'</span>';
                                                 $lbl_loc = '<span class="" style="font-size:0.7rem; ">'.$data_loc[0].'</span>';
                                            }else{
                                            
                                                $title_loc = '<span class="text-clear btn btn-muted" style="font-size:0.9rem; padding:0.4rem; "><i style="margin-right:3px;" class="fa-solid fa-location-dot"></i> <i class="fa-solid fa-ellipsis"></i></span>';
                                               // $title_loc ='';
                                            }


                                    
                                    }else{
                                        
                                        if($gpo == 0){
                                            $nombreg = 'SETS SIN AGRUPAR';
                                            $buttons_gpo = '
                                                <button type="button" id="btn_csv_0" onclick="genera_csv_grupo(0);" class=" btn btn-inverse-primary" style="border:0px solid #ccc;"> 
                                                    <i class="fa-solid fa-file-csv"></i>
                                                </button>
                                            '; 
                                        }elseif($gpo==99){
                                            $nombreg = 'TODOS LOS SETS';
                                            $buttons_gpo = '
                                                <button type="button" id="btn_csv_99" onclick="genera_csv_grupo(99);" class=" btn btn-inverse-primary" style="border:0px solid #ccc;"> 
                                                    <i class="fa-solid fa-file-csv"></i>
                                                </button>
                                            '; 
                                        }else{
                                            $nombreg = '';
                                            $buttons_gpo = '';

                                            $token = get_info_link($user_id);
                                            
                                            
                                        }
                                    }   

//////////////////////------------------------//////////////////////
$url_ext_imp = $path_site.'public.php?mnu=455ddbb163fef3534ac3e81d2b985ecc&token='.$token.'&sub='.$user;
$btn_central_imp = '
<form method="post" action="'.$url_ext_imp.'" target="_blank" >
<button type="submit" class="btn btn-inverse-primary" style="float: right;" > <i class="fa-solid fa-print"></i> Central </button>
<input type="hidden" name="id_user" id="id_user" value="'.$user.'">
</form>
';

}else{

    $table = '<div class="col-md-12 center" style="margin-top:30px;"> 
                    <span class="text-muted" style="font-size:1rem; margin-top:30px;"> Selecciona un grupo </span> 
            </div>';
}// isset 




?>




<input type="hidden" id="current_gpo" value="50<?php echo $gpo; ?>" />

    <div class="row" >
               
        <div class="col-md-2 bg-light border-right left_panel_shadow" style="height: 99%; padding:0px;" >
            <h5 class="col-md-12 p-2 title_sec " ><span style="margin-left:10px;"> Grupos </span>
            
                <div class="btn-group" role="group" style="float:right; border:none;"> 
                    <button type="button" id="" onclick="toggle('opciones'); toggle('nuevo_grupo')" class=" btn btn-outline-muted  text-clear" style="border:0px solid #ccc;"> <i class="fa-solid fa-plus-circle"></i></button>
                </div>
            </h5>

            <div class="col-md-12 content p-1" style="height: 460px; overflow-x: hidden; overflow-y: auto; ">
                <div style="overflow: auto; overflow-x: hidden; overflow-y:auto;">
                    <?php echo $res_no.$res; ?>
                </div>
             </div>

        </div>


<!-- Panel Central -->



<div class="col-md bg-light border-right" style=" height:525px;"> 
            
            <div class="row" style="margin-bottom:10px;">
                <h5 class="col-md-5 p-2 title_sec  "> &nbsp; <?php echo $nombreg; ?> </h5>
                
                <div class="col-md-6 p-2 title_sec border-left" style="text-align:center; float:right;" id="ops"> 
                    <div class="btn-group" role="group" style=" border:none;"> 
                        <?php echo $buttons_gpo.$btn_central_imp; ?>
                    </div>
                    <?php echo $title_loc; ?>
                </div>

                <div class="col-md-1 p-2 title_sec" style="text-align:right;" >
                    <div class="btn-group" role="group" style=" border:none;"> 
                        <button type="button" onclick="toggle('opciones')" class="btn btn-inverse-primary btn_thin "> <i class="fa-solid fa-sliders"></i> </button> 

                    </div>
                </div>

            </div>



            
            <div id="current_sets" class="col-md-12 " style="padding:0px; margin:0px; ">
            <?php echo $busca; ?>
                    <div style="height: 400px; overflow-x: hidden; overflow-y: auto; z-index: 9999;">
                        <?php echo $table; ?>
                    </div>
            </div>


                
<!-- Modal Central -->

        
        <!-- Lista Imprimir sets -->
        <div class="" >
            <div id="list_setss" class="bg-muted modal_grupos" style="display: none; z-index: 10000; " >
            <?php echo $list; ?>
            </div>
        </div>
        
        <!-- Agregar sets -->
    

                <div id="add_sets" class="col-md-12 bg-light modal_grupos" style="border-radius: 5px 5px 0 0; height:auto; display: none; z-index: 10000; padding:0px; padding-bottom:10px; margin:5px; border:1px solid #ccc; position: absolute; top: 10px;" >

                <h5 class="col-md-12 p-2 title_sec_sm bg-head " style="padding:0px; border-radius:5px 0 0 0;"> 
            
                        <i class="fa-solid fa-sliders"></i> <b> Agregar Sets al grupo</b>
                
                        <div class="btn-group" role="group" style="float:right; border:none;"> 
                            <button type="button" onclick="toggle('add_sets')" class=" btn btn-outline-primary  text-clear" style="border:0px solid #ccc;"> 
                                <i class="fa-solid fa-times fa-lg"></i>
                            </button>
                        </div> 
                </h5> 

                <div class="p-1 border-bottom center bg-light" style="padding: 10px 0 0 5px;">  
                    <div class="row">
				        <div class="col-md-6"> 
				            <span id="new_minifigure_status"  style=" border-radius: 5px;" ></span>
				        </div>
                        
                        <div class="col-md-6">                                 
                            <div class="btn-group" role="group" aria-label="" style="float:right; " >   
                                <button type="button" class="btn btn-thin btn-outline-primary" title="Captura Masiva" onclick="list_modal();"><i class="fa-solid fa-clipboard-list"></i></button>
                                <button type="button" class="btn btn-thin btn-outline-primary" onclick="save_items_gpo();"><i class="fa fa-save"></i></button>
                            </div>  
                        </div>
                    </div>
                </div>
  

                    <div class="row bg-light" style="margin-left:0px; margin-right: 0px;">
                            
                            <div class="col-md-6">
                                <label id="destino" style="margin-top:10px;" class="text-muted form-label">Origen: <b> <span id="desti"></span> </b></label>
                                
                                <div id="autolist_sets" >
                                    <select id="select1" class="col-md-12 form-control" style="height:250px;" multiple="multiple"> <?php echo $ress; ?> </select>
                                    <button type="button" id="add" class="btn btn-outline-primary btn-block"> Agregar <i class="fa-solid fa-angle-right"></i> </button>
                                </div>

                                <div id="manuallist_sets" class="no-show" >
                                    <textarea class="col-md-12 form-control" id="list_manual" onkeyup="process_list_gpo();" style="height: 250px;"></textarea>
                                </div>

                                <div class="no-show">
                                    <?php echo $sets_id.$sets_name.$sets_id_c.$sets_name_c; ?>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <label id="destino" style="margin-top:10px;" class="text-muted">Destino: <b> <span id="dest"></span> </b></label>
                                
                                    <select id="select2" class="col-md-12 form-control" style="height:250px;" multiple="multiple">  </select>
                                    <button type="button" id="remove" class="btn btn-outline-primary btn-block"> <i class="fa-solid fa-angle-left"></i> Quitar </button>
                                


                            </div>

                            <input type="hidden" id="gpo_dest" value="" name="">
                    </div>
                    
                    
                </div>
            </div><!-- fin modal -->

        
<!-- FIN Panel Central -->

<!-- panel opciones -->
        <div >
        
        <div class="" style="position:absolute; right:0px; z-index:9998; top:-2%; text-align:right; padding:30px 0 30px 30px;">  
            <button type="button" onclick="toggle('opciones')" class="btn btn-inverse-primary " style="border:0px solid #ccc; padding:15px;"> 
                <i class="fa-solid fa-sliders fa-xl"></i>
            </button> 
        </div>

        <div class="col-md-6 bg-light hold_modal_derecha" id="opciones" style="display: none; height:80%; top:3%; " >
            
        <h5 class="col-md-12 p-2 bg-head title_sec_sm " style="border-radius:5px 0 0 0;"> 
                <span class="text-clear" style="margin-right:15px;" ><i class="fa-solid fa-grip-vertical"></i> </span>
                <span class="" style="margin-right:5px;"><i class="fa-solid fa-sliders"></i> </span>
                <b>Opciones</b>
            
                <div class="btn-group" role="group" style="float:right; border:none;"> 
                    <button type="button" onclick="toggle('opciones')" class=" btn btn-outline-primary text-clear" style="border:0px solid #ccc;"> 
                        <i class="fa-solid fa-times fa-lg"></i>
                    </button>
                </div> 
             </h5>

        <div class="mb-3 border-bottom bg-muted" style="text-align:center; padding:0px; padding-top:1rem;">
            <div class="btn-group-bar" role="group" style=" border:none;"> 
                <button type="button" id="subbop_1" onclick="barmenu(this.id)" class="btn btn-primary btn_menubar_lg subbop subbop_lg">Código de barras</button>
                <button type="button" id="subbop_2" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar_lg subbop subbop_lg">Grupos</button>
                <button type="button" id="subbop_3" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar_lg subbop subbop_lg">Ubicaciones</button>

            </div>
        </div>
 
    <div class="row col-md">

        <div class="col-md-12" id="div_subbop_1">
            <div class="col-md-12 content p-1">  
            <span class="text-muted">Formato Codigo de barras</span>              
                <div class="form-group col-md-12" style="height: 40%; overflow-x: hidden; overflow-y:auto;">
                    <form name="check_barcode" id="flatRadios" method="post" action="<?php echo $current_url;?>" >   

                        <?php 


                      //  echo genera_radiobtn_tipocodigo(1,0); 
                        //echo genera_select_tipo_codigo($formato);
                        echo genera_select_tipo_codigo($formato); 

                        ?>
                        </form>          
                </div>
            </div>
        </div>

        
        <div class="col-md-12 no-show" id="div_subbop_2"> 
            <div class="row">
                <div class="col-3">

                    <div id="subbopgpo_1" class="row col-md-12 side_menu subbopgpo" style="background: rgba(163, 183, 196, 0.4); color: rgb(22, 82, 115);" onclick="sidemenu(this.id);">

                        <span class="col-9 text-muted" style="font-size:0.7rem; "> 
                            <span class=""> </span> Nuevo Grupo 
                        </span>

                        <span class="col-1 text-head" style="text-align:right; float:right; right:-15px; font-size:1em; ">
                                <i class="fa-solid fa-chevron-right"></i>
                        </span>
                    
                    </div>

                    <div id="subbopgpo_2" class="row col-md-12 side_menu subbopgpo" style="background: rgba(163, 183, 196, 0.4); color: rgb(22, 82, 115);" onclick="sidemenu(this.id);">

                        <span class="col-9 text-muted" style="font-size:0.7rem; "> 
                            <span class=""> </span> Editar Grupo 
                        </span>

                        <span class="col-1 text-head" style="text-align:right; float:right; right:-15px; font-size:1em; ">
                                <i class="fa-solid fa-chevron-right"></i>
                        </span>

                    </div>

                </div>

                <div class="col-6">
<!-- -->
                    <div id="div_subbopgpo_1" class="col-md-12 group-control grid-margin border-bottom" style="padding-bottom:10px; ">
                        <div class="col-md-12 p-2  subtitle_sec" style="text-align:left; margin-bottom: 10px;"> 
                            <i class="fa-regular fa-square-plus "></i> Agregar Grupo
                            <button type="button" value="" class=" btn btn-outline-primary " style="float:right; margin-right:10px;" onclick="save_grupo();"> <i class="fa fa-save"></i> </button> 
                        </div> 

                        <label class="col-md-3 col-form-label text-muted lbl_form_sm">Etiqueta:</label>
                        <input class="col-md-8 form-control" id="new_nombre_grupo" type="text" value="">

                        <label class="col-md-3 col-form-label text-muted lbl_form_sm">Ubicaci&oacute;n</label>

                        <select class="col-md-8 form-control" id="new_loc">
                            <option value="X" > Elija Una... </option>
                            <?php echo $select_ubic; ?>
                        </select>
                    </div>

                    <div id="div_subbopgpo_2" class="col-md-12 group-control grid-margin border-bottom no-show" style="padding-bottom:10px; ">
                        <div class="col-md-12 p-2  subtitle_sec" style="text-align:left; margin-bottom: 10px;"> 
                            <i class="fa-regular fa-square-plus "></i> Editar Grupo
                            <button type="button" value="" class=" btn btn-outline-primary " style="float:right; margin-right:10px;" onclick="save_edit_grupo();"> <i class="fa fa-save"></i> </button> 
                        </div> 


                        <label class="col-md-3 col-form-label text-muted lbl_form_sm ">Nombre</label>
                        <input class="col-md-8 form-control" id="title_nvo" type="text" value="">

                        <label class="col-md-3 col-form-label text-muted lbl_form_sm">Orden</label>
                        <input class="col-md-8 form-control" id="orden_nvo" type="text" value="">

                        <label class="col-md-3 col-form-label text-muted lbl_form_sm">Ubicaci&oacute;n</label>

                        <select class="col-md-8 form-control" id="ubi_nvo">
                            <option value="0" > Elija Una... </option>
                            <?php echo $select_ubic; ?>
                        </select>

                        <input type="hidden" id="gpo_origen" value="" >
                    </div>
<!-- -->
                </div>
            
            </div>              
           
        <div class="p-2 no-show">
            <div class="btn-group" role="group" style=" border:none;"> 
                <button type="button" id="sub_btn_op_1" onclick="sub_display_panel(this.id)" class="btn btn-secondary subbopgpo">Nuevo Grupo</button>
                <button type="button" id="sub_btn_op_2" onclick="sub_display_panel(this.id)" class="btn btn-inverse-secondary subb_op_gpo">Editar Grupo</button>
            </div>
        </div>



        </div>

        <div class="col-md-12 no-show" id="div_subbop_3" style="padding:0px;">
                          
             <div class="col-md-12 content ">    
                <div class="row">

                    <div class="form-group col-md-4">
                        <h5 class="p-2 text-muted"> Ubicaciones</h5>
                        <div>
                        <?php echo get_ubicaciones_inventario($user); ?>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-8 border-left">
                        <div class="col-md-12 p-2  subtitle_sec" style="text-align:left; margin-bottom: 10px;"> 
                            <i class="fa-regular fa-square-plus "></i> Agregar Ubicación
                            <button type="button" value="" class=" btn btn-outline-primary " style="float:right; margin-right:10px;" onclick="save_ubicacion();"> 
                                <i class="fa fa-save"></i>
                            </button> 
                        </div>

                        <label class="col-md-3 col-form-label text-muted lbl_form_sm ">Nombre</label>
                        <input class="col-md-8 form-control" id="new_nombre_ubi" type="text" value="">
                                                  
                    </div>
                </div>


            </div>
        </div>

    </div>



 <script type="text/javascript">  
  $().ready(function() {  
   $('#add').click(function() {  
    return !$('#select1 option:selected').remove().appendTo('#select2');  
   });  
   $('#remove').click(function() {  
    return !$('#select2 option:selected').remove().appendTo('#select1');  
   });  
  });  
 </script> 

 <?php 
	
	


	  ?>