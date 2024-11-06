
<?php
	
	
	$dbserver = 'localhost';      //127.0.0.1:3306 ó localhost
  $dbuser = 'dignirdn_admdtv';      //root ó breddfor_root dignific_admin
  $dbpwd = 'Dignifica2020';        //vacío ó F8DsNVSu5R
  $dbname = 'dignific_webpage';       //breddfdb ó breddfor_breddfdb
  
		$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
if ($dbh->connect_error) {
    die("Connection failed: " . $dbh->connect_error);
}

  $tipo_informe = $_GET['ref']; 
  
   
  
   $q = "SELECT * FROM pager where tipo = $tipo_informe order by referencia;";// preparando la instruccion sql

   
    $result= $dbh->query($q);
    if ($result->num_rows > 0) {
	    
	    $num = 1; 
                        while($row= $result->fetch_assoc()){
	                        
	                        if($row['estado']==1){
		                        $label = '<i class="fas fa-circle" style="color: #30b855;"></i>';
		                        $btn_binario_activo = '
		                        <button type="submit" class="btn btn-icons btn-inverse-secondary" form="add_new" value="0" > 
		                        <i class="fa fa-eye-slash"></i> 
		                        </button>';
	                        }else{
		                        $label = '<i class="fas fa-circle" style="color: #787878;"></i>';
		                        
		                        $btn_binario_activo = '
		                        <button type="submit" class="btn btn-icons btn-inverse-secondary" form="add_new" value="1" > 
		                        <i class="fas fa-eye"></i> 
		                        </button>';
	                        }
	                        
	                        
	                        
	                        $table_body .= '
	                        
	                        <tr>
                          <td class="py-1"> '.$num.' </td>
                          <td> '.$row['titulo'].' </td>
                          <td> '.$row['referencia'].' </td>
                          <td> '.$row['programa'].' </td>
                          <td> <a  class="btn btn-outline-info" href="http://dignificatuvida.org.mx/informes/pager/?ref='.$row['referencia'].'" target="_new"> Ver Informe</a> </td>
                          <td> <a class="btn btn-outline-primary btn-fw" href="http://dignificatuvida.org.mx/informes/pager/'.$row['referencia'].'/'.$row['referencia'].'.pdf " target="_new"> <i class="mdi mdi-file-document"></i> Ver PDF</a> </td>
                          
                           <td>   '.$label.' </td>
                           
                           
                           <td>   
                                <form id="add_new" name="add_new" method="post">
                           		<input type="hidden" value="'.$row['id'].'" id="id" >
                           		<input type="hidden" value="" id="id" >
                           		<button type="submit" class="btn btn-icons btn-inverse-secondary" form="add_new" value="" > <i class="fa fa-trash"></i> </button>
                           		<button type="submit" class="btn btn-icons btn-inverse-secondary" form="add_new" value="" > <i class="fas fa-edit"></i> </button>
                           		'.$btn_binario_activo.'
                                </form>
                           </td>
                        </tr>
	                        
	                        ';
	                        
	                        $num = $num + 1;
	                        
	                        };
                        
	                        
	}else{
		echo 'No hay registros que mostrar.';
	}
	$dbh->close();
	
?>


                <div class="card">
                  <div class="card-body">



<h4 class="card-title">Informes Publicados </h4>
                    
<p class="card-description"> Enlista todos los informes disponibles en la página, según el programa. </p>

<table class="table table-striped">
                      <thead>
                        <tr>
                          <th> No</th>
                          <th> Titulo </th>
                          <th> Referencia </th>
                          <th> Programa </th>
                          <th> Link </th>
                          <th> Documento </th>
                          <th> Estado </th>
                          <th> Opciones </th>
                        </tr>
                      </thead>
                      <tbody> <?php echo $table_body; ?>
                      </tbody>
                    </table>
                    
                  </div>
                </div>
                
                
<div id="hover" class="hover_modal">	
	<div id="btn_close_informe" class="hold_btn_close">
		<i class="fa fa-times btn-modal"  ></i> 
	</div>  
	     
	        
<div class="col-md-6 grid-margin stretch-card" id="add_informe" style="">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Agregar Informe</h4>
                    <p class="card-description"> Llenar los siguientes campos, previo a subir los documentos: archivo PDF e imágenes. La carpeta en servidor debe llamarse igual que la referencia que se establece en el campo indicado</p>
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputEmail3">Título del Documento</label>
                        <input type="text" class="form-control" id="titulo" placeholder="Titulo">
                      </div>                    
	                    
	                    
                      <div class="form-group">
                        <label for="exampleInputName1">Programa</label>
                        <select class="form-control form-control-lg" id="exampleFormControlSelect1">
                        <option >- Selecciona -</option>
                        <option value="1">Mochila Completa</option>
                        <option value="2">Bred</option>
                        <option value="3">Sembrando Metas</option>
                        <option value="4">Legal</option>
                        <option value="5">Otro</option>
                      </select>                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Palabra de Referencia</label>
                        <input type="text" class="form-control" id="referencia" placeholder="Referencia">
                      </div>
                                            <button type="submit" class="btn btn-success mr-2">Agregar</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
</div>

