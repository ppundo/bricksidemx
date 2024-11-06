<?php 
	
function obtenerTablasDeUnaBaseDeDatos($host, $usuario, $pass, $nombreDeLaBaseDeDatos)
{
    try {
        $base_de_datos = new PDO("mysql:host=$host;dbname=$nombreDeLaBaseDeDatos",$usuario, $pass);
    } catch (Exception $e) {
        echo "Ocurrió algo con la base de datos: " . $e->getMessage();
    }

    return $base_de_datos
        ->query("SELECT table_name AS nombre FROM information_schema.tables WHERE table_schema = '$nombreDeLaBaseDeDatos';")
        ->fetchAll(PDO::FETCH_COLUMN);
}

function obtenerColumnasDeUnaTabla($host, $usuario, $pass, $nombreDeLaBaseDeDatos, $nombreDeLaTabla)
{
    try {
        $base_de_datosb = new PDO("mysql:host=$host;dbname=$nombreDeLaBaseDeDatos", $usuario, $pass);
    } catch (Exception $e) {
        echo "Ocurrió algo con la base de datos: " . $e->getMessage();
    }
    return $base_de_datosb
        ->query("SELECT COLUMN_NAME AS columna, COLUMN_TYPE AS tipo FROM information_schema.columns WHERE table_schema = '$nombreDeLaBaseDeDatos' AND table_name = '$nombreDeLaTabla'")
        ->fetchAll(PDO::FETCH_OBJ);
}

$tablas = obtenerTablasDeUnaBaseDeDatos($dbserver, $dbuser,$dbpwd, $dbname);

    for($i=0; $i<=count($tablas);$i++){

        if($tablas[$i]!= ''){
       
        $tablas_name  .= '
            <a href="#" class="text-muted op_tablas" style="padding-left:0px; margin-left:0px;" id="op_'.$i.'" onclick="toggle_tablas(\''.$i.'\')">
                <div class="row col-md-12 border-bottom " style="margin:5px 0px; margin-left:0px; padding:10px 0px;">
                    <span class="col-sm-2 "  style=" font-size:0.8rem; "><i class="fa-solid fa-table"></i></span> 
                    <span class="col-sm-10 text-muted" style="font-size:0.8rem;"> '.$tablas[$i].'</span>
                </div> 
            </a> '; 

        $columnas = '';
        $cols_name = '';
        $columnas = obtenerColumnasDeUnaTabla($dbserver, $dbuser,$dbpwd, $dbname, $tablas[$i]);
        //$j= 0;
        //var_dump($columnas);

        foreach($columnas as $columna){
            
            $cols_name  .= ' <span class="col-md-12 text-muted" style="padding:5px 0px; display:block; font-size: 0.8rem; line-height:1rem; border-bottom:1px solid #fff; border-top:1px solid #eee;"> <i class="fa-solid fa-angle-right"></i> ' . $columna->columna . '</span>';
        //// $j = $j+1;
        }

        $div_name .= '<div class="col-md-12 table_cols" id="table_'.$i.'" style="display:none;" >'.$cols_name.'</div>';
    }

    }



//$res = $tablas_name.$div_name;

    /*
    $tot_col = count($columnas);

    //var_dump($tot_col);
    for($j=0; $j<= $tot_col; $j++){
            $tablas_name .= '<i class="fa-solid fa-caret-right"></i>'.$columnas[$j].'<br>';
    }
    */



                     
?>




<div class="scrollable " style="overflow: hidden;">

	<div class="row " style="margin-top: 0px; height: 100%;">
	
       

		<div class="col-md-3 border-right bg-light left_panel_shadow " style="padding: 0px;" >
            <h5 class="col-md-12 p-3 subtitle_sec bg-light "><span style="margin-left:10px;"> Tablas </span>  </h5>
                
            <div class="col-md" style="height: 439px; overflow:auto;  overflow-x: hidden; ">
                <?php  echo $tablas_name;  ?>
            </div>
		
		</div>
	
		<div class="col-md-3 border-right bg-light" style="padding: 0px;">
            <h5 class="col-md-12 p-3 subtitle_sec bg-light "><span style="margin-left:10px;"> Columnas </span>  </h5>
            <div class="col-md" style="height: 439px; overflow:auto;  overflow-x: hidden; ">
                <?php  echo $div_name;  ?>	
            </div>		
		</div>
	
	
	</div> <!-- row -->
</div>