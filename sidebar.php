<?php
include('access.php');

/*
$dbserver = 'localhost';      //127.0.0.1:3306 ó localhost
  $dbuser = 'redconsu_bsmxweb';      //root ó breddfor_root dignific_admin
  $dbpwd = 'ufA6whETZd5L';        //vacío ó F8DsNVSu5R
  $dbname = 'redconsu_bsmx_collect';       //breddfdb ó breddfor_breddfdb
*/
//$parp = rand_parpadeo();
//var_dump('<br><br> -p'.$parp);
 
$dbh= new mysqli($dbserver, $dbuser,$dbpwd, $dbname);
      //informacion de acceso a la bd
// Check connection
if ($dbh->connect_error) {
    die("Connection failed1: " . $dbh->connect_error);
} 

	//$user_admin = $GLOBALS['user_perfil']; 
	
	
	
	if($user_perfil==1){
		$query_admin = 'and profile_permission <= 1'; 
	}else{
		$class = 'hidden';
		$query_admin = 'and profile_permission <= 1'; 
	}
              
              // MEnus nivel 0 
              
                $qa = "SELECT * FROM menus WHERE estado = 1 and mnu_padre = 0 ".$query_admin." order by orden asc;";// preparando la instruccion sql

  // var_dump($qa); 
			    $resulta= $dbh->query($qa);
			    if ($resulta->num_rows > 0) {
				    
				    $num = 1; 
                        while($rowa= $resulta->fetch_assoc()){
	                        $num_hijos= 0; 
	                        $menus=""; 
	                        $sub_mnu= '';
	                        $url_param = ''; 
	                        
	                        $title = $rowa['title'];
	                        $id= $rowa['id'];
	                        $php = $rowa['link'];
	                        $cve = $rowa['cve'];
	                        $nombre_mnu = $rowa['nombre'];
	                        
                          /// Busca Menu Hijos 
                          
       
                        
					              $qb = "SELECT * FROM menus WHERE estado = 1 and mnu_padre = $id and nivel < 88 and nivel < 3;";// preparando la instruccion sql
					//echo($qb);
					   
								    $resultb= $dbh->query($qb);
								    if ($resultb->num_rows > 0) {
									    $num_hijos = $resultb->num_rows; 
									    //var_dump ($num_hijos);
									 //console.log($num_hijos);
									 
									 //   $num = 1; 
					                        while($rowb = $resultb->fetch_assoc()){
						                        
						                        $tamanio_cve = strlen($rowb['cve']); 
						                        if($tamanio_cve > 10 ){
							                        $url_param ='?mnu='.$rowb['cve']; 
						                        }else{
							                        $url_param ='';
						                        }
						                        //1f6503307f1eb3ea66a6be2c6ae4fae6
						                         
						                         $perfil_b = $GLOBALS['user_perfil'];
						                         //$permiso = valida_permiso_perfil($rowb['id'],$perfil);
						                          $permiso = get_permiso_pagina($rowb['id'],$perfil_b);
						                        // var_dump('<br><br>'.$perfil_b.' - '.$permiso.' - '.$rowb['title']);
                                              
						                         if($permiso==1){

							                        $menus .= '<li class="nav-item level 1">
													            <a class="nav-link" href="index.php'.$url_param.'"> '.$rowb['title'].' </a>
													           </li>
							                        '; 
							                         
						                         }else{
							                        $menus.= '';
						                         }

                                              $permiso = 0;
						                        
											}//while 
										
									}else{
										$sub_mnu .= ""; 
									}		
																                   
	                        
					                        if($num_hijos>0){						                        
						                        $sub_mnu .= '
						                        <div class="collapse lvl2" aria-expanded="false" id="mnu_padre_'.$rowa['id'].'">
									                <ul class="nav flex-column sub-menu">
										                '.$menus.'
									                  
									                </ul>
									              </div>
						                        ';           
					                        }else{
						                        $sub_mnu .= ""; 
						                        $menus = ''; 
					                        }
	
	                        
	                        /// Fin Menu Hijos
	                        
	                        
	                        // Construye menus laterales
	                        if($num_hijos>0){

								$perfil_b = $GLOBALS['user_perfil'];
						      //  $permiso = valida_permiso_perfil($rowa['id'],$perfil);
						        $permiso = get_permiso_pagina($rowa['id'],$perfil_b);
                              
                               //var_dump('<br><br>'.$perfil_b.' - '.$permiso.' - '.$title);
						        
						        if($permiso==1){
			                        $mnu_p .= '
									<li class="nav-item  ">
						              <a class="nav-link collapsed" data-toggle="collapse" href="#mnu_padre_'.$rowa['id'].'" aria-expanded="false" aria-controls="mnu_padre_'.$rowa['id'].'">
						                <i class="menu-icon typcn typcn-document-add"></i>
						                <span class="menu-title">'.$title.'</span>
						                <i class="menu-arrow"></i>
						              </a>					         
							                '.$sub_mnu.$menus_hijo.'
							        </li>
			                        '; 
			                    }else{
				                        $mnu_p .= '';
			                    }
	                        
	                        }else{
		                        
		                        if($id==0){
			                         $url_paramb =''; 
		                        }else{
			                         $url_paramb ='?mnu='.$cve; 
		                        }

								$perfil_b = $GLOBALS['user_perfil'];
						        //$permiso = valida_permiso_perfil($rowa['id'],$perfil);
						        $permiso = get_permiso_pagina($rowa['id'],$perfil_b);
						        
						        if($permiso==1){
						        	                        
									$mnu_p .= '
									    <li class="nav-item ">
							              <a class="nav-link" href="index.php'.$url_paramb.'">
							                <i class="menu-icon typcn typcn-shopping-bag"></i>
							                <span class="menu-title"> '.$title.' </span>
							              </a>
							            </li>
									';
			                    }else{
				                    $mnu_p .= '';
			                    }
	                        
							}
							
						}// while
					}
              
              

             
//// ---------------  Crea el Grid de Series para mostrar
	

	      
	      
	  ?>
      
      
      <!-- partial SIDEBAR -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
	          

            
            <?php echo $mnu_p;  ?> 
            
          
            
          </ul>
        </nav>