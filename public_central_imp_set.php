<?php 
include("minifigures.php");
include("globals.php");

$id_user = $_GET['sub'];
$format = $_GET['flatRadios'];
$target= $_GET['target'];
$btn = $_GET['btn'];



if($format===NULL){
   $format=1;
}

if(isset($target)==true){
   // var_dump($id_user);
   // var_dump($format);
   // var_dump($target);
   // $lbl_barcode = genera_barcode_label_clavelego($target,$format,$id_user);
    
}




$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
              //informacion de acceso a la bd
        // Check connection
            if ($dbh->connect_error) {
                die("Connection failed: " . $dbh->connect_error);
            }

        
              $q = "Select * from sets where id_user = $id_user order by fecha_add desc;";
              //$q = "Select * from sets sets INNER JOIN impresion_etiqueta_set impresiones ON sets.id_user = impresiones.id_user where sets.id_user = $id_user order by no_imp"; // preparando la instruccion sql
             //var_dump($q);
                $nn = 0; 
                $resultr= $dbh->query($q);
                if ($resultr->num_rows > 0) {
                    
                    


while($row= $resultr->fetch_assoc()){
    
   
    $nn = $nn+1;

     
  //  $codigo_barcode = genera_barcode_codigo($row['cve_lego'],$format,$id_user);
    $codigo_barcodeb = genera_barcode_codigo($row['cve_lego'],0,$id_user);

   $no_impresiones = get_impresiones($row['cve_lego'],$id_user);
 // $no_impresiones = $row['no_imp'];

    if($no_impresiones==0){
        $imp = '<span class="text-clear" style="margin-right:3px; font-size:0.7rem;"><i class="fa-solid fa-print"></i> </span>
        <span id="cant_'.$row['cve_lego'].'" class="text-clear">'.$no_impresiones.'</span>';
    }else{
        $imp = '<span class="text-muted" style="margin-right:3px; font-size:0.7rem;"><i class="fa-solid fa-print"></i> </span>
        <span id="cant_'.$row['cve_lego'].'" class="text-muted"> '.$no_impresiones.'</span>';
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

          $mnu = $_GET['mnu'];
          $token = $_GET['token'];

          $url_print=$GLOBALS['path_site'].'public.php?'.'mnu='.$mnu.'&token='.$token.'&sub='.$id_user.'&target='.$row['cve_lego'];

          $current_url = $GLOBALS['path_site'].'public.php?mnu='.$mnu.'&token='.$token.'&sub='.$id_user.'&target='.$row['cve_lego'];
          $url_print_or=$GLOBALS['path_site'].'modal_barcode.php?'.'cve='.$id_user.'&codebar='.$row['cve_lego'];

                
           $buton_lbl = '<button type="button" id="btn_'.$row['cve_lego'].'-'.$id_user.'" value="'.$row['cve_lego'].'-'.$id_user.'" title="Imprimir" onclick="reg_impresion(this.value);" class=" btn btn-inverse-primary btn_thin" > 
                                            <i class="fa-solid fa-print"></i> </button> ';                                        

    $buton_lbl_mod = '<button type="button" id="btn_'.$row['id'].'" value="'.$row['cve_lego'].'-'.$id_user.'" title="Imprimir" onclick="javascript:ventanaCodebar(\''.$url_print_or.'\'); reg_impresion(this.value);" class=" btn btn-inverse-primary btn_thin" > <i class="fa-solid fa-print"></i> </button> ';                                            
                                            
                             $sets .= '
                             
                                <tr>                                    
                                    <td class="center"> <span class="text-muted" style="font-size:0.7rem; ">'.$nn.'</span> </td>
                                    <td> <span class="text-muted" style="font-size:0.7rem;"> '.$row['cve_lego'].'</span></td>
                                    <td> 
                                       
                                        <span class="text-muted" style="font-size:0.7rem;">'.substr($row['nombre'],0,$len_name).' </span>
                                    </td> 
                                    <td class="center">
                                        '.$imp.'
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="" > 
                                            '.$buton_lbl_mod.' 
                                            </div>
                                        
                                    
                                    </td>
                                    
                                </tr>
                                        ';
                            
              
                        
                        }// while 

//$busca = crea_campo_buscar('table_sets_gpo');
$busca = crea_campo_buscar_cust('table_sets_gpo',12); 

                    $table = '
                    
                    <table id="table_sets_gpo" class="table table-striped"> 
                    
                                <thead>
                                    <tr>                                    
                                        <th class="thead_content text-head" style="font-size:0.6rem"> <span><i class="fa-regular fa-image"></i></span> </th>
                                        <th class="thead_content text-head" style="font-size:0.6rem">Clave </th>
                                        <th class="thead_content text-head" style="font-size:0.6rem">Nombre </th>
                                        <th class="thead_content text-head" style="font-size:0.6rem">No Imp</th> 
                                        <th class="thead_content text-head" style="font-size:0.6rem">Codigo</th>
                                         
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    
                                    '.$sets.' 
                                    
                                </tbody>
                                
                                <tfooter>
                                    <tr>
                                        <th class="thead_content text-head" style="font-size:0.6rem"> <span><i class="fa-regular fa-image"></i></span> </th>
                                        <th class="thead_content text-head" style="font-size:0.6rem">Clave </th>
                                        <th class="thead_content text-head" style="font-size:0.6rem">Nombre </th>
                                        <th class="thead_content text-head" style="font-size:0.6rem">No Imp</th> 
                                        <th class="thead_content text-head" style="font-size:0.6rem">Codigo</th>    
                                    </tr>
                                </tfooter>
                            </table>'; 

                        
                }else{

                        $table = '<h5 class="col-md-12 p-3 text-clear center " style="margin-top:30px;" > Selecciona un grupo del panel lateral </h5>';

                }
///////////////// 

?>

<div class="row ">
    <div class="col-md-4 oculto-impresion border" style="height:580px; background:rgba(230,230,230,0.2); padding:0px; margin-left:10px; border-radius:5px;">
        
        <div class="grid-margin oculto-impresion" style="padding:0px;">
        <h4 class="col-md-12 p-2 subtitle_sec"> Formato </h4>
           <div class="col-md-12">
           <form name="check_barcode" id="flatRadios" method="post" action="<?php echo $current_url;?>">
                <?php echo genera_select_tipo_codigo($formato); ?>
           </form>
           </div>
         
        </div>

        <h4 class="col-md-12 p-2 subtitle_sec"> Inventario </h4>
        <div class="col-md-12">
        <?php echo $busca; ?>
        </div>
        <div class="oculto-impresion" style="height: 330px; overflow:scroll; overflow-x:hidden; overflow-y:auto; ;">
        <div class="col-md-12">
                <?php echo $table; ?>
        </div>
        </div>
    </div>

    <div class="col-md-4">
        
               <div id="display_lbl"></div>
    </div>

</div>

<script>
function ventanaCodebarCentral(URL){ 
	var tipocode= 0;
    tipocode = document.getElementById('flatRadiosb').value;
    if(tipocode=='' || tipocode==0){
        tipocode = 1; 
    }else{
        tipocode = document.getElementById('flatRadiosb').value;
    }

    //alert(document.getElementById('flatRadios').value);

	var format = '';
    URL = URL+'&format='+tipocode;
   // window.open(URL,"ventana1","width=350,height=150,scrollbars=NO,resizable=NO,title=Imprime Código de Barras,location=no,top=80,left=100") 
}

function ventanaCodebar(URL){ 
	//var tipocode= getRadioButtonSelectedValue(document.check_barcode.flatRadios);
    var tipocode = tipocode = document.getElementById('flatRadiosb').value;

    if(tipocode===undefined){
        tipocode = document.getElementById('flatRadiosb').value;
    }
    //alert(document.getElementById('flatRadios').value);

	var format = '';
    URL = URL+'&format='+tipocode;
    window.open(URL,"ventana1","width=350,height=150,scrollbars=NO,resizable=NO,title=Imprime Código de Barras,location=no,top=80,left=100") 
}

</script>

<?php

if(isset($target)==TRUE){
   
   
    $imp = '
    
<script language="JavaScript">
  window.print();
</script>
    ';
}
?>