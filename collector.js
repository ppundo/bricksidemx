

//////////////////////////////////////////////////////////////////////
	function ajax (url, method, params, container_id, loading_text) {
    try { // For: chrome, firefox, safari, opera, yandex, ...
    	xhr = new XMLHttpRequest();
    } catch(e) {
	    try{ // for: IE6+
	    	xhr = new ActiveXObject("Microsoft.XMLHTTP");
	    } catch(e1) { // if not supported or disabled
		    alert("Not supported!");
		}
	}
	
	var result = "";
	var resultb;  
	
xhr.onreadystatechange = function() {
	
	if(xhr.readyState == 4) { // when result is ready
		result  = xhr.responseText;  // tipo accion, estado, mensaje_res_res, id, mensaje_res error. : (100,0-1, texto , 8834-01, mensaje_res)
		resultb = xhr.responseText;		
		
		//alert(xhr.readyState);	
	 	  
    	data_res= result.split('|');
		accion = data_res[0]; // 100: cambio nombre, 200: Agregar eliminar tags; 300: agregar o quitar coleccion. 
		estado = data_res[1]; // 0: error; 1: exito; 
		figura = data_res[2]; // el nombre de la minifigura. 
		serie = data_res[3];
		error = data_res[4];
		extra = data_res[5];
		extrab = data_res[6];
		
		var mensaje_res;
		var debug;
		
		var es="";  
		var en=""; 
		
//	alert(result+' Acción: '+accion);
							       
		if(error == "" ){
			       
			switch(accion){

					case '100': // Cambio nombre

						document.getElementById('lblname-'+serie).innerHTML = figura;
						//document.getElementById('lblsubname-'+serie).innerHTML = en;
						document.getElementById('title_nombre').innerHTML = figura;
						
						var select = ''; 

						if(estado == 1){
							select = '&nbsp; <select class="col-sm-2 form-control" onchange="cambia_minifig();" id="select_minifig" data-custom="modified" ><option value="0">Elije...</option> '+extra+'</select>'; 
							document.getElementById('hold_page_minifig').innerHTML = select;
							
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i> El nombre de <b>'+ es + '</b> se ha actualizado.</span>';
						}							       
								       
					break; 
									       
					case '200': // Modificar TAGS
						
						if(estado == 1){
							
							/*tags = document.getElementById('holdcard-'+serie).getAttribute('searchable');							
							nvo_tags = document.getElementById('tags-'+serie).value; 							
							nvo_tags = nvo_tags.replace(",", "");							
							all_tags = tags+' '+ nvo_tags;  							
							document.getElementById("holdcard-"+serie).setAttribute("searchable", all_tags);
							//document.getElementsByTagName("card")[0].setAttribute("searchable", nvo_tags);							
							
							*/
							document.getElementById('tags-'+serie).value = extrab;
							document.getElementById('field_tags').innerHTML = extra;
							
							tags = document.getElementById('holdcard-'+serie).getAttribute('searchable');							
							nvo_tags = document.getElementById('tags-'+serie).value; 							
							nvo_tags = nvo_tags.replace(",", "- -");							
							all_tags = tags+' '+ nvo_tags;  							
							document.getElementById("holdcard-"+serie).setAttribute("searchable", all_tags);							
							
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Los tags de <b>'+ figura + '</b> se han actualizado.</span>';
							
						}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+ error +'</span>';
    					}
						
				    break; 
								       
					case '300': // agregar o quitar de la coleccion
    
						if( estado==1){ //agregado / activado 
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i> Minifigura <b> '+ figura + '</b> agregada a la colección.</span>';
													
							var tot_fig = document.getElementById('tserie').value;
							
							if(serie == tot_fig){
								sound(4);
								confetti.start(3000);
								show_congrats();
							}
							//sound(7);

                            document.getElementById('ico_add_'+serie).innerHTML = ' <i class="fa-solid fa-circle-minus fa-2x"></i>';

                            //console.log(extra);

                            document.getElementById('total_current').value = extra;

    					}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color"> <i class="fa fa-times "> </i> Se quitó <b> '+ figura + '</b> de la colección.</span>';
							//sound(8);
                             document.getElementById('ico_add_'+serie).innerHTML = ' <i class="fa-solid fa-circle-plus fa-2x"></i>';
                          //   fa-heart-circle-plus
                             //console.log(extra);
                             document.getElementById('total_current').value = extra;
    					}

    						actualiza_barra();
									       
					break; 

					case '400': // Estado de Usuario

							var tiempo_sesion = serie;
							mensaje_res = 'Sesion establecida por '+ tiempo_sesion+' segundos.';


    
						//alert(figura);
						if(estado==1){ //agregado / activado 
							mensaje_res = '<span class="theme_color"> <i class="fa fa-spinner fa-pulse fa-fw"></i> Accediendo...</span>';
							var dr = 'http://shelf.bricksidemx.com/collector/index.php?mnu='+figura;
							//location.reload(dr);
							window.location= dr;
							
    					}else if(estado==0){ // eliminado
							mensaje_resb = '\
							<label class="badge-danger bubble_msg" > \
							<i class="fa fa-times "> </i> \
							Su cuenta ha sido desactivada. Cambie su contraseña para activarla, si ya ha comenzado el proceso, siga las instrucciones enviadas al correo.\
							</label>';
							
							document.getElementById('message_display').innerHTML = mensaje_resb;
							
							mensaje_res  = mensaje_resb;
							
    					}else if(estado==2){ // eliminado
							mensaje_resb = '<label class="badge-danger bubble_msg" >  <i class="fa fa-times "> </i> Usuario o contraseña incorrectos.</label>';
							document.getElementById('message_display').innerHTML = mensaje_resb;
							mensaje_res  = mensaje_resb;
    					}else if(estado==3){ // eliminado
							mensaje_resb = '<label class="text-danger bubble_msg" >  <i class="fa fa-times "> </i> La cuenta de correo no ha sido registrada, cree una cuenta para poder acceder.</label>';
							document.getElementById('message_display').innerHTML = mensaje_resb;
							mensaje_res  = mensaje_resb;
    					}else if(estado==4){ // eliminado
							mensaje_resb = '<label class=" badge-warning bubble_msg" >  <i class="fa fa-times "> </i> Contraseña restablecida por el administrador. Cambie su contraseña para poder acceder. </label>';
							document.getElementById('message_display').innerHTML = mensaje_resb;
							mensaje_res  = mensaje_resb;
    					}else if(estado==5){
	    					
	    					mensaje_resb = '<label class=" badge-warning bubble_msg" >  <i class="fa fa-times "> </i> '+figura+' </label>';
							document.getElementById('message_display').innerHTML = mensaje_resb;
							mensaje_res  = mensaje_resb;
	    				
	    				}
    					
    					
									       
					break; 
					case '500': // alta usuario
						//document.getElementById('error_display').innerHTML = mensaje_res;
					//	alert('Inicio de Sesion:'+estado);
						if( estado==1){ //agregado / activado 
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i> Usuario Registrado, Ahora puede iniciar sesion. </span>';
							location.replace("index.php?set=0?access=1");
							//window.locationf="index.php?set=0";
							
							
    					}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+ error +'</span>';
    					}else if(estado==2){ // eliminado
							mensaje_res = '<span class="theme_color"> <i class="fa fa-times "> </i> La cuenta de correo ya se encuentra registrada.</span>';
    					}
    					
    					
									       
					break; 
					
					case '600': // Modificar TAGS
						
						
						if(estado == 1){
							mensaje_res = '<span class="theme_color"> <i class="fa fa-puzzle-piece"> </i> Las piezas de <b>'+ figura + '</b> se han actualizado.</span>';
						}
						
				    break; 

					case '700': // contruye lista de piezas
					
					
						if(estado == 1){
							
							
							//alert(figura);
							mensaje_res = '';
							document.getElementById('hold_faltantes').innerHTML = figura;
							document.getElementById('faltantes_code').value= serie;
							
						}else if(estado==0){ // eliminado
							mensaje_res = '';
    					}
						
				    break; 
					case '800': // contruye lista de piezas faltantes segun la seleccion.
					
					
						if(estado == 1){
							
							
							//alert(figura);
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i> Se han guardado las piezas faltantes de tu figura <b>'+figura+'</b> .</span>';
							//document.getElementById('hold_faltantes').innerHTML = figura;
							//document.getElementById('faltantes_code').value= serie;
							
						}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+ error +'</span>';
    					}else if(estado==2){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+ error +'</span>';
    					}
						
				    break; 
				    
					case '900': // contruye lista de piezas faltantes segun la seleccion.
					
					
						if(estado == 1){
							
							
							//alert(figura);
							mensaje_resb = '<span class="text-light"> <i class="fa fa-check "> </i> Hemos enviado un correo a: '+figura+' con las instrucciones para cambiar tu contraseña </span>';
							document.getElementById('error_display').innerHTML = mensaje_resb;
							//document.getElementById('faltantes_code').value= serie;
							
						}else if(estado==0){ // eliminado
							mensaje_resb = '<span class="text-light"> <i class="fa fa-check "> </i> Hemos enviado un correo a: '+figura+' con las instrucciones para cambiar tu contraseña </span>';
							document.getElementById('error_display').innerHTML = mensaje_resb;
    					}else if(estado==2){ // eliminado
							mensaje_resb = '<span class="theme_color_error"> <i class="fa fa-times "> </i>  El correo: '+figura+' no se ha registrado.</span>';
							document.getElementById('error_display').innerHTML = mensaje_resb;
    					}
						
				    break; 	
				    
				    case '1000': // contruye lista de piezas faltantes segun la seleccion.
					
					
						if(estado == 0){
							
							
							//alert(figura);
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i> Su cuenta ha sido actualizada, ahora puede accesar, en un momento sera redireccionado.</span>';
							setTimeout(location.replace("index.php?set=0"),5000) ;
							
						}else if(estado==1){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> Ha ocurrido un error: '+error+' </span>';
    					}
						
				    break; 	

				    case '1100': // contruye lista de piezas faltantes segun la seleccion.
					
					
						if(estado == 0){
							
							
							//alert(figura);
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i>OK</span>';
							
						}else if(estado==1){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> NOK </span>';
    					}
						
				    break; 

				    case '1200': // contruye lista de piezas faltantes segun la seleccion.
				    
				

				    
				    var fig =""; 
				    var renglon ="";
				    var list_option ="";
					var list =""; 
					var nom_leng ="";
					var nom_es =""; 
					var nom_en =""; 
					//var guarda_img = [];
					
				    		var ultimo = figura.trim().substr(-1,1); 
		
							if(ultimo==";"){
								
								tamano = figura.length; 
								figura = figura.substr(0, tamano -1);
								//alert(nombres); 
								
							}					
					///////construye un form con la lista de nombres y el resultado del scan de imagenes. 
					
						var nombres_list = (document.getElementById('nombres_fig_add').value).trim();
						var serie_lego = document.getElementById('no_add').value;
						
						ultimo = ''; 
						
						ultimo = nombres_list.trim().substr(-1,1); 
		
							if(ultimo==";"){
								
								tamano = nombres_list.length; 
								nombres_list = nombres_list.substr(0, tamano -1);
								//alert(nombres_list); 
								
							}	
						
						//alert(nombres_list);
						
					if(nombres_list != ""){
							
							fig = nombres_list.split(';');
						
						for(j=0 ; j< fig.length; j++){
							if(fig[j]!= ''){
								if(estado == 0){ // respuesta del scand del directorio
									var enlista = figura.split(';');
									list_option="";
									for(i=0; i<enlista.length ; i++){
										// divide el nombre de la fihura
										
										nom_leng = fig[j].split(',');
										nom_es = nom_leng[0];
										nom_en = nom_leng[1];
										// comprueba que sea una imagen JPG o PNG
										
										data = enlista[i].split('.');
										base = data[0];
										ext = data[1];
										
										// obtiene la lista de imagnes en base de datos para cargarlas como definida 
										
										var curren_images = document.getElementById('current_img_draft').value;
										
										var info_img = curren_images.split('|');
										
										//////
										
										if(ext == 'jpg' || ext == 'png' || ext == 'jpeg' ){
											if( i > 1){
												if(base == info_img[j]){
													list_option += '<option selected value="'+enlista[i]+'"> '+enlista[i]+' </option> '; 
													//foto = '<img id="img_'+j+'" src="minifig/'+serie_lego+'/'+base+'.'+ext+'" class="result_image_b" >';
												}else{
													list_option += '<option value="'+enlista[i]+'"> '+enlista[i]+' </option> '; 
													//foto = '<img id="img_'+j+'" src="minifig/minifig.jpg" class="result_image_b" >';
												}
												
											}
										}
									}
									

									
									lbl = '<label  for="fig_'+j+'" >'+nom_es+'</label>';
									list = '<select value="" onchange="cambia_foto('+j+')" class="form-control" name="fig_'+j+'" id="fig_'+j+'"> \
									<option value="0.png">Elije una Imagen</option> \
									<option value="99.png">Sin Imagen</option> \
									'+list_option+' \
									</select>';

									var foto_act;
									//var foto_act = document.getElementById('fig_'+j).value;
									
									foto = '<img id="img_'+j+'" src="minifig/minifig.png" class="result_image_b" >';
									//foto = '<img id="img_'+j+'" src="minifig/'+serie_lego+'/'+foto_act+'" class="result_image_b" >';
									
																		
									renglon += '<card class="col-md-4 grid-margin stretch-card " id="" > \
							               \
								                <div class="card shelf_card" style="border: 1px solid rgba(200,200,200,0.9); border-radius:4px;"> \
								                 \
										            <div class="hover_imagen_main" style="width: 30%; border: 0px solid #ccc; background:#fff;"> \
											            '+foto+' \
										            </div>  \
								                \
													<div class="card-body card_body_main hold_image_nva_serie" style="margin-left:25%"> \
									                    <h4 class="card_title_main"> \
									                    <span id="">'+lbl+'</span>  \
									                    </h4> \
									                    \
									                    <span class="theme_color">'+list+'</span> \
								                    </div> \
								                    \
							                	</div> \
											</card> \
											'; 
									 
								}else if(estado==1){ // eliminado
									mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+error+'  </span>';
		    					}
		    				}
		    					
						}
						
									// despliega el resultado en el div coorento
									document.getElementById('lista_imagenes').innerHTML = renglon;
									
									//cambia las fotos
									info_img = curren_images.split('|');
									
									for(j=0 ; j< info_img.length; j++){
										//foto_act = document.getElementById('fig_'+j).value;
										cambia_foto(j);
									}
									//////
							
						}else{
							error = 'La lista de Nombres esta vacia';
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+error+'  </span>';
					}	
				  
			
				    break;
				    		    
					case '1300': // contruye lista de piezas faltantes segun la seleccion.
				    

					if(estado==1){
							error = 'La Serie ya se encuentra registrada';
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+error+'  </span>';
						
					}else if(estado==2){
						error = 'La serie '+figura+' se ha regsirado exitosamente';
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
						
					}else if(estado==3){
						error = 'Error en guardar:'+figura;
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+error+'  </span>';
						
					}else if(estado==4){
						error = figura;
							mensaje_res = '<span class="theme_color"> <i class="fa fa-success "> </i> '+error+'  </span>';
					}else if(estado==5){
						error = figura;
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+error+'  </span>';
					}else{
						error = figura;
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+error+'  </span>';
					}
				  
			
				    break;
				    
				    
					case '1400': // activa desactiva serie 			    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Se ha '+serie+' <b>'+figura+'</b>.  </span>';
								location.reload('admin_serie.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
				    break;

					case '1500': // Actualiza serie  
						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Serie Actualizada </span>';
								location.reload('admin_serie.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
						
				    break;

					case '1600': // Elimina usuario		    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Serie Eliminada.  </span>';
								location.reload('admin_user.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
				    break;	
					case '1700': // activa desactiva usuario		    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Se ha asignado el perfil de '+serie+' a: <b>'+figura+'</b>.  </span>';
								location.reload('admin_user.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
				    break;

					case '1800': // activa desactiva usuario		    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Se ha '+serie+' el tema: <b>'+figura+'</b>.  </span>';
								location.reload('admin_user.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
				    break;

					case '1900': // restablecer contraseña de usuario		    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> La contraseña de <b>'+figura+'</b> ha sido restablecida.  </span>';
								location.reload('admin_user.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
				    break;				    

					case '2000': // Elimina perfil	    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Usuario Eliminado. '+figura+'  </span>';
								location.reload();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times"> </i> Usuario Eliminado'+error+'  </span>';
							
						}
				    break;					    

					case '2100': // Elimina usuario		    

						if(estado==1){
								//error = figura ;
								//alert(figura);
								var data = figura.split('--');
								
								var colonia = data[0];
								var municipio = data[1]; 
								var estado = data[2];
								var ciudad = data[3]; 
								
								document.getElementById('div_dir_col').innerHTML = colonia; 
								document.getElementById('dir_del').value = municipio;
								document.getElementById('dir_estado').value = estado;
								
								//mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Usuario Eliminado.  </span>';
								//location.reload('admin_user.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
						
				    break;	

					case '2200': // Elimina usuario		    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Domicilio Actualizado </span>';
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;	
					case '2300': // Elimina usuario		    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Perfil Actualizado '+figura+'</span>';
							//location.reload('perfil.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;					    

					case '2500': //Guarda menu	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Menú Actualizado</span>';
							location.reload('admin_menu.php');
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;	

					case '2600': //Guarda menu	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Menú Agregado</span>';
							location.reload('admin_menu.php');
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;


					case '2700': //Guarda menu	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Menú '+figura +' actualizado</span>';
							location.reload('admin_menu.php');
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;
				    

					case '2800': //Guarda menu	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Menú Eliminado</span>';
							location.reload('admin_menu.php');
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;

					case '2900': //Guarda menu	    

						if(estado==1){
									
									
									//$data = $row['nombre'].'-'.$row['piezas'].'-'.$row['cve_lego'].'-'.$row['piezas'].'-'.$row['precio'].'-'.$row['anio_public'];
									var user_id = document.getElementById('user_id').value;
									var data = figura.split('-');
									
									//alert(user_id);
									
									var cve = data[2];
									var nombre = data[0]; 
									var tema = data[3];
									var piezas = data[1];
									var precio = data[4];
									var anio = data[5];
									var id = data[6];
									var foto = data[7]; 
									var ruta = data[8];
									var btn = data[9];
									var origen = '<select class="form-control" id="set_origen">'+ data[10]+'</select>';
									var minifig = data[11];
									var id_tema = data[12];
									var nom_grupo = data[13];
									var cantidad = data[14];
									var ubic = data[15];
									var edo_col = data[16];
									var edo_presenta = data[17];
									var codebar_box = data[18];

									var add_btn; 
									var url_set_ext = '';
									var ulr_qr_public = '';

									add_btn = '<a class="btn btn-secondary text-neutral btn-block" onclick="toggle(\'sube_foto_edita\');" ><i class="fas fa-exchange-alt"></i>Cambiar Imagen</a>';
									//alert(origen); 
									
									var btn_codebar = '';
									
									var a= ''; 
									var prev = '<img src="'+ruta+'" debug class="result_image_set zoom" style="max-height:230px; max-width:99%;  " >'; //<i class="fas fa-exchange-alt"></i>
									
									//var list = tema.replace('|', '-')
									
									if( anio == '0000'){
										a = 1900;
									}else{
										a= data[5];
									}


									if( precio == 0){
										p = 0.00;
									}else{
										p = data[4];
									}

									var tema_id = standar_digitos(id_tema);
									var user_id_dig =  standar_digitos_user(user_id);
									var cve_dig =  standar_digitos_tema(cve);						

									var cover = ''; 
                                     cover = ''; 

									var url_codebar = 'https://bricksidemx.com/collector/modal_barcode.php?codebar='+cve;

									btn_codebar = '<button type="button" id="test" class="btn btn-secondary col-sm-6 form-control" onclick="javascript:ventanaCodebar(\''+url_codebar+'\')" > Imprimir Etiqueta </button>'; 
									//var cover = ''; 
									
									document.getElementById('set_title').innerHTML = nombre;
									
									document.getElementById('set_cve').value = cve;
									document.getElementById('set_nombre').value = nombre;
									document.getElementById('set_tema').innerHTML = tema;
									document.getElementById('hold_origen').innerHTML = origen;
									document.getElementById('set_piezas').value = piezas; 	
									document.getElementById('set_precio').value = p;
									document.getElementById('set_anio').value =a;
									document.getElementById('set_id').value =id;
									document.getElementById('set_id_d').value =id;
									document.getElementById('set_foto').value =foto;
									document.getElementById('set_minifig').value = minifig;
									document.getElementById('display_image_set').innerHTML =cover + prev;
									document.getElementById('set_cantidad').value =cantidad;
									document.getElementById('set_edo_col').innerHTML = edo_col;
									document.getElementById('set_presentacion').innerHTML = edo_presenta;
									document.getElementById('set_codebar_box').value = codebar_box;
                                    
									

									
									
									//document.getElementById('barcode_set').innerHTML = cve_dig+''+tema_id+''+user_id_dig;
									//document.getElementById('nombre_set_barcode').innerHTML= nombre.toUpperCase();
									//document.getElementById('display_image_set').innerHTML =cover + prev;
                                     var img_ori = document.getElementById('img_set_'+id);
                                     var img_url = img_ori.getAttribute("src");
                                    
                                    var img_fin = '<img id="img_'+cve+'" src="'+img_url+'" class="" style="max-height:230px; max-width:99%;" >';

									document.getElementById('display_image_set').innerHTML = img_fin;
									//document.getElementById('btn_print_barcode').innerHTML = btn_codebar;

									// pasa la etiqueta
									var lbl_origen ='';
									var select_grupo = ''; 

									document.getElementById('lbl_barcode').innerHTML = '';
									document.getElementById('select_grupo').innerHTML = '';
									document.getElementById('select_ubic').innerHTML = '';

									//document.getElementById('set_edo_col').innerHTML = '';
									
									
									lbl_origen = document.getElementById('lbl_'+id).innerHTML;
									document.getElementById('lbl_barcode').innerHTML = lbl_origen;

									//select_grupo = document.getElementById('select_'+id).innerHTML;
									document.getElementById('select_grupo').value = nom_grupo;
									document.getElementById('select_ubic').value = ubic;

									url_set_ext = document.getElementById('url_ext_set_'+id).value;
									
									document.getElementById('url_ext_btn').innerHTML =' \
									<a class="btn btn-outline-primary" form target="_blank" href="'+url_set_ext+'" > <i class="fa-solid fa-eye"></i> Ver ficha set</a> \
									';
									document.getElementById('url_ext_link').innerHTML = '<a class="text-muted" style="display:inline-block; font-size: 12px;" href="'+url_set_ext+'" target="_blank">'+url_set_ext+'</a>';

                                    document.getElementById('set_url_ext').value = url_set_ext;

									var codebar = document.getElementById('code_'+cve).value;

									var img_qr = document.getElementById('qr_public_'+cve).getAttribute("src");
                                     //var img_url = img_ori.getAttribute("src");

									//ulr_qr_public = 'assets/images/qr_sets/public_url/public_'+codebar+'.png';
									document.getElementById('qr_ext_link').innerHTML = '<img id="qr_public_set_'+cve+'" src="'+img_qr+'" class="qr_img_public"  >';

									//document.getElementById('btn_cambia').innerHTML =add_btn;
									
									toggle('edit_set'); 		
									sidemenu('sidemenu_1');					
															
							//mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Menú Eliminado</span>';
							//location.reload('admin_menu.php');
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;				    

					case '3000': //Guarda menu	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Set Actualizado '+figura+'</span>' ;
							location.reload();
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;
				    
					case '3100': // activa desactiva usuario		    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Se ha '+serie+' <b> Tema '+figura+'</b>.  </span>';
								location.reload('admin_user.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
				    break;
				    	
					case '3200': // Elimina Set	    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Serie Eliminada.  </span>';
								location.reload('admin_user.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
				    break;

					case '3300': // activa desactiva serie 
						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Tema Actualizado </span>';
								location.reload('admin_sets.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
						
				    break;
				    	
					case '3400': // activa desactiva serie 
						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> El Set '+figura+' se ha guardado. </span>';
								location.reload('sets.php');
							
						}else if(estado==2){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+figura+'  </span>';
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
						
				    break;
				    				    			    		    		    				    	    		    				    				    			    			case '3500': // Elimina Set	    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Set '+figura+' Eliminado.  </span>';
								location.reload('sets.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
				    break;
				    
					case '3600': // Elimina Set	    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Foto Actualizada  </span>';
								//location.reload();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
				    break;	

					case '3700': // Elimina Set	    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Información Adicional Actualizada  </span>';
								//location.reload();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
				    break;	

					case '3800': // Agrega Minifigura	    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Minifigura Agregada </span>';
								location.reload();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
				    break;				    

					case '3900': // Elimina Minifigura    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Minifigura Eliminada de la Serie '+figura+'</span>';
								location.reload();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
				    break; 

					case '4000': // Elimina Minifigura    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Foto Eliminada </span>';
								location.reload();
								//get_list_l();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> No se ha podido eliminar foto.  </span>';
							
						}
				    break;  

					case '4100': // Elimina Minifigura    

						if(estado==1){
								//error = figura ;
								
								//var button = '<button class="btn btn-danger"> <i class="fa fa-trash"></i> Eliminar </button>'; 
								
								document.getElementById('lista_usuarios').innerHTML = figura; 
								document.getElementById('confirmacion_elimina').style.display= 'block';
								document.getElementById('hold_btn_elimina').innerHTML = serie; 
								
								//series = document.getElementById('serie_fotos_admin').value;
								//get_list_fotos(series); 
								//mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> '+figura+'</span>';
								//location.reload();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> No se ha podido eliminar foto.  </span>';
							
						}
				    break;  
					case '4200': // Elimina Minifigura    

						if(estado==1){
								//error = figura ;
								
								//var button = '<button class="btn btn-danger"> <i class="fa fa-trash"></i> Eliminar </button>'; 
								
								document.getElementById('hold_labels_images').innerHTML = figura; 
								
								//mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> '+figura+'</span>';
								//location.reload();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> No se ha podido visualizar foto.  </span>';
							
						}
				    break;				    

					case '4300': // Elimina Minifigura    

						if(estado==1){
								//error = figura ;
								
								//var button = '<button class="btn btn-danger"> <i class="fa fa-trash"></i> Eliminar </button>'; 
								
								//document.getElementById('hold_labels_images').innerHTML = figura; 
								
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Figura Actualizada!</span>';
								//location.reload();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> No se ha podido actualizar.  </span>';
							
						}
				    break;
				    
					case '4400': // Elimina Minifigura    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Logo Eliminado </span>';
								//location.reload();
								get_list_logos();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> No se ha podido eliminar el logo.  </span>';
							
						}
				    break;
				    
					case '4500': // Elimina Minifigura    

						if(estado==1){
								//error = figura ;
								
								//var button = '<button class="btn btn-danger"> <i class="fa fa-trash"></i> Eliminar </button>'; 
								
								document.getElementById('hold_labels_logos').innerHTML = figura; 
								
								//mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> '+figura+'</span>';
								//location.reload();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> No se ha podido visualizar el logo.  </span>';
							
						}
				    break;					    

					case '4600': // Select para la pagina de todas las figuras    

						if(estado==1){
								//error = figura ;
								//mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Se ha '+serie+' <b>'+figura+'</b>.  </span>';
								//location.reload('admin_serie.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
							//	mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
						
				    break;	

					case '4700': // Select para la pagina de todas las figuras    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Se ha '+serie+' <b>'+figura+'</b>.  </span>';
								location.reload('admin_serie.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
						
				    break;					    

					case '4800': // Select para la pagina de todas las figuras    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> '+serie+' </span>';
								//location.reload('shelf.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
								
								//console.log(error);
							
						}
						
				    break;

					case '4900': // Select para la pagina de todas las figuras    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Se actualizado el estado del recibo '+serie+' </span>';
								location.reload('admin_recibos.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="text-danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
								
								//console.log(error);
							
						}

					case '5000': // Select para la pagina de todas las figuras    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> El recibo '+serie+' se ha eliminado </span>';
								location.reload('admin_recibos.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="text-danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
								
								//console.log(error);
							
						}
												
				    break;				    				    			    				    				    			    				    				    		
				    case '5100': // Select para la pagina de todas las figuras    

						if(estado==1){
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> El usuario/correo ya ha sido registrado. </span>';
								document.getElementById('message_display_reg').innerHTML = mensaje_res;
						}else if(estado==2){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								//mensaje_res = '<span class="text-danger"> <i class="fa fa-times"> </i> Este usuario esta disponible. </span>';
								//document.getElementById('message_display_reg').innerHTML = mensaje_res;
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="text-danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
								document.getElementById('message_display_reg').innerHTML = mensaje_res;
						}
												
				    break;

				    case '5200': // Select para la pagina de todas las figuras    

						if(estado==1){
								//mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i>  </span>';
								//document.getElementById('message_display_reg').innerHTML = mensaje_res;
								//location.reload('perfil.php');
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="text-danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
								//document.getElementById('message_display_reg').innerHTML = mensaje_res;
						}
												
				    break;				    

				    case '5300': // Select para la pagina de todas las figuras    

						if(estado==1){
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Nuevo Tema Registrado </span>';
								//document.getElementById('message_display_reg').innerHTML = mensaje_res;
								location.reload('admin_sets.php');
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="text-danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
								//document.getElementById('message_display_reg').innerHTML = mensaje_res;
						}
												
				    break;	

				    case '5400': // Select para la pagina de todas las figuras    

						if(estado==1){
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Perfil actualizado </span>';
								//document.getElementById('message_display_reg').innerHTML = mensaje_res;
								location.reload('admin_user.php');
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="text-danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
								//document.getElementById('message_display_reg').innerHTML = mensaje_res;
						}
												
				    break;					    				    		        
				    case '5500': // Select para la pagina de todas las figuras    

						if(estado==1){
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Sugerencia Enviada </span>';
								//document.getElementById('message_display_reg').innerHTML = mensaje_res;
								location.reload('http://shelf.bricksidemx.com/collector/index.php?mnu=9019cbe4458150159d9cc2f1cd473cf1&ma=4&mb=41&modsug=0');
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="text-danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
								//document.getElementById('message_display_reg').innerHTML = mensaje_res;
						}else if(estado==2){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="text-danger"> <i class="fa fa-times"> </i> Ya se ha enviado esta sugerencia antes </span>';
								//document.getElementById('message_display_reg').innerHTML = mensaje_res;
						}else if(estado==3){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="text-danger"> <i class="fa fa-times"> </i> Opss! Ya has alcanzado el número máximo de surgerencias activas, espera el resultado de alguna para poder enviarnos más.  </span>';
								//document.getElementById('message_display_reg').innerHTML = mensaje_res;
						}
												
				    break;	

				    case '5600': // Select para la pagina de todas las figuras  
				    
				    //alert(figura+'-'+serie);
				    
				    if(serie == 1 ){

					    if(figura=='1'){
						    txt = 'archivado.';
						    
					    }else{
						    txt = 'desarchivado.';
					    }
					    
				    }else if(serie == 2){

					    txt = 'cancelado.';
						    
					    
				    					    
				    }  
				    


						if(estado==1){
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> La sugerencia se ha '+txt+' </span>';
								location.reload('http://shelf.bricksidemx.com/collector/index.php?mnu=9019cbe4458150159d9cc2f1cd473cf1&ma=4&mb=43');
								
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="text-danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
								//document.getElementById('message_display_reg').innerHTML = mensaje_res;
						}
												
				    break;

					case '5700': // Select para la pagina de todas las figuras    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> La sugerencia '+serie+' se ha eliminado </span>';
								location.reload();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="text-danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
								
								//console.log(error);
							
						}
												
				    break;	

					case '5800': // Select para la pagina de todas las figuras    

						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> La sugerencia actualizada. </span>';
								location.reload();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="text-danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
								
								//console.log(error);
							
						}
												
				    break;	
				    
					case '5900': // alta usuario
						//document.getElementById('error_display').innerHTML = mensaje_res;
					//	alert('Inicio de Sesion:'+estado);
						if( estado==1){ //agregado / activado 
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i> Registro Agregado </span>';
							location.reload('http://shelf.bricksidemx.com/collector/index.php?mnu=958153f1b8b96ec4c4eb2147429105d9&op=2&mod=0');
							//window.locationf="index.php?set=0";
							
							
    					}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+ error +'</span>';
    					}else if(estado==2){ // eliminado
							mensaje_res = '<span class="theme_color"> <i class="fa fa-times "> </i> El Nuevo registro ya existe.</span>';
    					}else if(estado==4){ // eliminado
							mensaje_res = '<span class="theme_color"> <i class="fa fa-envelope "> </i> '+figura+'</span>';
    					}
    					
    					
									       
					break; 							    

					case '6000': // 6100 
					
						//document.getElementById('error_display').innerHTML = mensaje_res;
					//	alert('Inicio de Sesion:'+estado);
						if( estado==1){ //agregado / activado 
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i> Estado Actualizado </span>';
							location.reload('http://shelf.bricksidemx.com/collector/index.php?mnu=958153f1b8b96ec4c4eb2147429105d9&op=2&mod=0');
							//window.locationf="index.php?set=0";
							
							
    					}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+ error +'</span>';
    					}else if(estado==2){ // eliminado
							mensaje_res = '<span class="theme_color"> <i class="fa fa-times "> </i> El registro no existe.</span>';
    					}
    					
    					
									       
					break; 

					case '6200': // alta usuario
						//document.getElementById('error_display').innerHTML = mensaje_res;
					//	alert('Inicio de Sesion:'+estado);
						if( estado==1){ //agregado / activado 
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i> Registro Eliminado </span>';
							location.reload('http://shelf.bricksidemx.com/collector/index.php?mnu=958153f1b8b96ec4c4eb2147429105d9&op=2&mod=0');
							//window.locationf="index.php?set=0";
							
							
    					}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+ error +'</span>';
    					}else if(estado==2){ // eliminado
							mensaje_res = '<span class="theme_color"> <i class="fa fa-times "> </i> El registro no existe.'+figura+'</span>';
    					}
    					
    					
									       
					break; 

					case '6300': // alta usuario
						//document.getElementById('error_display').innerHTML = mensaje_res;
					//	alert('Inicio de Sesion:'+estado);
						if( estado==1){ //agregado / activado 
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i> Registro Actualizado </span>';
							location.reload('http://shelf.bricksidemx.com/collector/index.php?mnu=958153f1b8b96ec4c4eb2147429105d9&op=2&mod=0');
							//window.locationf="index.php?set=0";
							
							
    					}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+ error +'</span>';
    					}else if(estado==2){ // eliminado
							mensaje_res = '<span class="theme_color"> <i class="fa fa-times "> </i> '+figura+'</span>';
    					}
    					
    					
									       
					break; 

					case '6400': // alta usuario
						//document.getElementById('error_display').innerHTML = mensaje_res;
					//	alert('Inicio de Sesion:'+estado);
						if( estado==1){ //agregado / activado 
							
							document.getElementById('res_csv').innerHTML = '<a class="btn btn-inverse-primary" href="'+figura+'"><i class="fa fa-download" ></i> Descargar</a>';
    					}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+ error +'</span>';
    					}else if(estado==2){ // eliminado
							mensaje_res = '<span class="theme_color"> <i class="fa fa-times "> </i> '+figura+'</span>';
    					}
    					
    					
									       
					break; 										


					case '6500': // alta usuario
						//document.getElementById('error_display').innerHTML = mensaje_res;
					//	alert('Inicio de Sesion:'+estado);
						if( estado==1){ //agregado / activado 
							
							
							document.getElementById('show_permisos').innerHTML = figura;
							document.getElementById('show_conf').innerHTML = extra;
							
							document.getElementById('btn_edo_perfil').innerHTML = serie;
							document.getElementById('show_conf').style.display = "block";
							
							//toggle('show_conf');
							code_permisos(1);
							
							
									
    					}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i>  El perfil no existe. </span>';
    					}else if(estado==2){ // eliminado
							mensaje_res = '<span class="theme_color"> <i class="fa fa-times "> </i> '+figura+'</span>';
    					}
    					
    					
									       
					break; 	
					
					case '6600': // alta usuario
					
						if( estado==1){ //agregado / activado 
							
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i> Perfil Actualizado '+figura+' </span>';
							//location.reload();							
									
    					}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+ error +'</span>';
    					}
    					
    					
									       
					break; 


					case '6700': // alta usuario
						//document.getElementById('error_display').innerHTML = mensaje_res;
					//	alert('Inicio de Sesion:'+estado);
						if( estado==1){ //agregado / activado 
							
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i> Estado del Perfil Actualizado </span>';	
							location.reload();						
									
    					}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+ error +'</span>';
    					}
    					
    					
									       
					break; 

					case '6800': // alta usuario
					
						if( estado==1){ //agregado / activado 
							
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i> Guardado Temporal </span>';	
							//location.reload();
							document.getElementById('current_serie').value = figura;
							step(2);					
									
    					}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+ error +'</span>';
    					}
    					
    					
									       
					break; 										

					case '6900': // alta usuario
					
						if( estado==1){ //agregado / activado 
							
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i> Guardado Temporal </span>';	
							//location.reload();
							//step(3);						
									
    					}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+ error +'</span>';
    					}
    					
    					
									       
					break; 

					case '7000': // Actualiza serie  
						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Usuario Bloqueado </span>';
								location.reload('admin_serie.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
						
				    break;

					case '7100': // Actualiza serie  
						
						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> Notificacion Enviada </span>';
								//location.reload('admin_serie.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> '+error+'  </span>';
							
						}
						
				    break;

					case '7200': // Actualiza serie  
						
						if(estado==1){
								//error = figura ;
								mensaje_res = '<span class="theme_color_success"> <i class="fa fa-check "></i> URL Generada </span>';
								//document.getElementById('url_user').value = figura;
								//document.getElementById('link_ext').innerHTML = '<a target="_new" href="'+figura+'"> <i class="fas fa-external-link-square-alt"></i> </a>';

								location.reload();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> URL Desactivada </span>';
								//document.getElementById('url_user').value = figura;
								//document.getElementById('link_ext').innerHTML = '<a target="_new" href="'+figura+'"> <i class="fas fa-external-link-square-alt"></i> </a>';
								location.reload();
						}
						
				    break;			    

					case '7300': // Actualiza Solo colecciones opcionales 	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Serie Opcionales Actualizadas '+figura+'</span>';
							//location.reload('perfil.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;	

					case '7400': // Actualiza Solo colecciones opcionales 	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Permisos de Serie Opcionales Actualizadas </span>';
							//location.reload();
							
							// mand a allmar a la funcion que re hace los checks del administrador

						//	alert(figura);
							
							$.ajax({
							  method: "POST",
							  url: "bypass_php.php",
							  data: { text: '1_'+figura }
							})
							  .done(function( response ) {
								  
								  var data_res = response.split('|');
								  
								  var accion = data_res[0];
								  var id_user = data_res[1];
								  var content = data_res[2];
								  
							    $("#check_admin_"+id_user).html(content);
							  });
							  
							
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;


					case '7500': // Actualiza Solo colecciones opcionales 	   
					
				var options = document.getElementById('current_permisos_vista').value; 
				var option_select = ' <select class="col-sm-12 form-control" style="margin-right:5px;" onchange="guarda_op_vista();" id="select_nvo"> '+options+' </select> ';
				
				
/*
				var option_select = ' <select class="col-sm-6 form-control" style="margin-right:5px; margin-left:5px; "  id="select_nvo"> \
				<option value="X" >Elije...</option> \
				<option value="0" >No Mostrar Serie</option> \
				<option value="1" >Mostrar Serie</option> \
				<option value="3" >Donativo </option> \
				</select> ';
				*/
			
				
				var res = ''; 
				var resb = ''; 
				
				//var lbl = '<label class="col-form-label text-muted " > <i class="fa fa-pencil"></i> </label>'; 
				var lbl = '';
				var btn_save = '<button type="button" class="btn btn-secondary" onclick="guarda_op_vista();" > <i class="fas fa-save" ></i> </button>'; 
				
						if(estado==1){
												
												
							if(figura==1){

								res='<label class="col-form-label" > <span class="text-primary " >  <i class="fa fa-toggle-on"></i> Mostrar Serie </span>  </label>';
								
								resb = '<div class="col-md-12 " id="edita_vista" role="group" > '+lbl+' '+option_select+' </div> ';
								
								document.getElementById('resultado_val').innerHTML = res;
								document.getElementById('resultado_valb').innerHTML = resb;

								
							}else if(figura==0){

								res=' <label class="col-form-label"> <span class="text-muted" >  <i class="fa fa-toggle-off"></i> Ocultar Serie </span>  </label>';
								
								resb = '<div class="col-md-12 " id="edita_vista" role="group" > '+lbl+' '+option_select+' </div> ';
								
								document.getElementById('resultado_val').innerHTML = res;
								document.getElementById('resultado_valb').innerHTML = resb;

								
							}else if(figura==3){

								res='<label class="col-form-label"> <span class="text-premium" >   <i class="fa fa-bookmark"></i> Donativo </span>  </label>';
									
								resb = '<div class="col-md-12 " id="edita_vista" role="group" > '+lbl+' '+option_select+'  </div> ';
								
								document.getElementById('resultado_val').innerHTML = res;
								document.getElementById('resultado_valb').innerHTML = resb;
								
														
							}else if(figura==4){

								res='<label class="col-form-label"> <span class="text-danger" >   <i class="fa fa-triangle-exclamation"></i> Espera Estreno </span>  </label>';
									
								resb = '<div class="col-md-12 " id="edita_vista" role="group" > '+lbl+' '+option_select+'  </div> ';
								
								document.getElementById('resultado_val').innerHTML = res;
								document.getElementById('resultado_valb').innerHTML = resb;
								
														
							}			
							
							
							
						}else if(estado==0){
							
							//error = 'La serie '+figura+' se ha regsirado exitosamente';
							//mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> '+error+'  </span>';


											
							res='<label class="col-form-label" > <span class="text-muted" >  <i class="fa fa-ban"></i> No Registrado </span> </label>';
								
							resb = '<div class="col-md-12 " id="edita_vista" role="group" > '+lbl+' '+option_select+'  </div> ';
							
							document.getElementById('resultado_val').innerHTML = res;
							document.getElementById('resultado_valb').innerHTML = resb;
							
						}
				    break;					    

					case '7600': // Actualiza Solo colecciones opcionales 	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Vista Actualizada </span>';
							document.getElementById('resultado_val').innerHTML = figura;
							//location.reload('perfil.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;				    				    				    				    																			
				    
				    case '7700': // busca la imagen del set nuevo	    

						if(estado==1){
									
							if(figura == 1){
								document.getElementById('notice_set').innerHTML = '<span class="text-success text-sm "><i class="fa fa-circle-check" ></i> &nbsp;Foto Encontrada</span>'; 
								
							}else{
								document.getElementById('notice_set').innerHTML = '<span class="text-danger text-sm"> \
																						<i class="fa fa-times-circle" ></i> &nbsp;Foto No Encontrada \
																						<span class="text-muted"> \
																						<i class="fa fa-circle-info" title="La foto de este set no esta disponible, pronto sera cargada." ></i> \
																						</span></span>'; 

								//notifica_user();
							}
							
		//'<span class="text-success"> <i class="fa fa-check-circle"></i></span>'.'|'.$row['nombre'].'|'.$s_nombre.'|'.$s_color.'|'.$row['piezas'].'|'.$row['precio'].'|'.$row['no_minifig'].'|'.$row['id_tema'].'|'.$row['anio_public'];
							var data_set = extrab.split(';');
							var ico = data_set[0];
							var nombre = data_set[1];
							var color = data_set[3];
							var piezas = data_set[4];
							var precio = data_set[5];
							var no_minifig  = data_set[6];
							var tema = data_set[7];
							var anio = data_set[8];
							
							
							document.getElementById('new_set_nombre').value = nombre;
							document.getElementById('new_set_piezas').value = piezas;
							document.getElementById('new_set_precio').value = precio;
							document.getElementById('new_set_anio').value = anio;
							document.getElementById('new_set_minifig').value = no_minifig;
							//document.getElementById('new_set_tema').value = tema;
							
							
							
							//alert(extrab);
							//console.log(extrab);
							
							document.getElementById('new_set_foto').value = extra;
															
							//mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Vista Actualizada </span>';
							//document.getElementById('new_set_foto').value = figura;
							//location.reload('perfil.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								//mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;	

					case '7800': // Actualiza Solo colecciones opcionales 	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Archivo Eliminado </span>';
							//document.getElementById('resultado_val').innerHTML = figura;
							location.reload();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
							mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> Error al eliminar el archivo </span>';
							
						}
				    break;	

				case '7900': // Actualiza Solo colecciones opcionales 	    

				var option_select = ' <select class="col-sm-12 form-control" onchange="guarda_op_vista_colect();" style="margin-right:5px; margin-left:5px; "  id="select_nvo_colect"> \
				<option value="X" >Elije...</option> \
				<option value="0" >No Mostrar</option> \
				<option value="1" >Mostrar Coleccion</option> \
				</select> ';
				
				var res = ''; 
				var resb = ''; 
				
				//var lbl = '<label class="col-form-label text-muted " onclick="toggle(\'resultado_valb_colect\')"> <i class="fa fa-pencil"></i> </label>'; 
				var lbl = '';
				
				var btn_save = '<button class="btn btn-secondary" onclick="guarda_op_vista_colect();" > <i class="fas fa-save" ></i> </button>'; 
				
						if(estado==1){
												
												
							if(figura==1){

								res='<label class="col-form-label" > <span class="text-primary " > <i class="fa fa-toggle-on"></i> Serie Visible </span>  </label>';
								
								resb = '<div class="col-md-12 " id="edita_vista" role="group" > '+lbl+' '+option_select+'  </div> ';
								
								document.getElementById('resultado_val_colect').innerHTML = res;
								document.getElementById('resultado_valb_colect').innerHTML = resb;

								
							}else if(figura==0){

								res=' <label class="col-form-label"> <span class="text-muted" > <i class="fa fa-toggle-off"></i> Serie Oculta </span>  </label>';
								
								resb = '<div class="col-md-12 " id="edita_vista" role="group" > '+lbl+' '+option_select+'  </div> ';
								
								document.getElementById('resultado_val_colect').innerHTML = res;
								document.getElementById('resultado_valb_colect').innerHTML = resb;

								
							}else if(figura==3){

								res='<label class="col-form-label"> <span class="text-premium" > <i class="fa fa-bookmark"></i> Req. Donativo </span>  </label>';
									
								resb= '<div class="col-md-12 " id="edita_vista" role="group" > '+lbl+' '+option_select+'  </div> ';
								
								document.getElementById('resultado_val_colect').innerHTML = res;
								document.getElementById('resultado_valb_colect').innerHTML = resb;
								
														
							}		
							
							
							
						}else if(estado==0){
							
							//error = 'La serie '+figura+' se ha regsirado exitosamente';
							//mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> '+error+'  </span>';


											
							res='<label class="col-form-label" style="margin-right:5px;" > <span class="text-muted" > <i class="fa fa-ban"></i> No Registrado </span>  </label>';
								
							resb = '<div class="col-md-12 " id="edita_vista" role="group" > '+lbl+' '+option_select+'  </div> ';
							
							document.getElementById('resultado_val_colect').innerHTML = res;
							document.getElementById('resultado_valb_colect').innerHTML = resb;
							
						}
				    break;	
				    
					case '8000': // Actualiza Solo colecciones opcionales 	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Vista de Coleccion Actualizada </span>';
							document.getElementById('resultado_val_colect').innerHTML = figura;
							//location.reload('perfil.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
						
				    break;	
				    
					case '8100': // Actualiza Solo colecciones opcionales 	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Permiso Actualizado </span>';
							document.getElementById('check_admin_premium').innerHTML = figura;
							//location.reload('perfil.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;	
				    				    				    				    
					case '8200': // Actualiza Solo colecciones opcionales 	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Permisos de Serie Opcionales Actualizadas </span>';
							//location.reload();
							
							// mand a allmar a la funcion que re hace los checks del administrador

						//	alert(figura);
							
							$.ajax({
							  method: "POST",
							  url: "bypass_php.php",
							  data: { text: '2_'+figura }
							})
							  .done(function( response ) {
								  
								  var data_res = response.split('|');
								  
								  var accion = data_res[0];
								  var id_user = data_res[1];
								  var content = data_res[2];
								  
							    $("#check_admin_conf").html(content);
							  });
							  
							
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;
				    
					case '8300': // Actualiza Solo colecciones opcionales 	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Permiso Actualizado </span>';
							document.getElementById('check_admin_conf').innerHTML = figura;
							//location.reload('perfil.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;					    

					case '8500': // Actualiza Solo colecciones opcionales 	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Cupon Agregado </span>';
							//document.getElementById('check_admin_conf').innerHTML = figura;
							//location.reload('perfil.php');
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}else if(estado==2){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> El cupón ya existe </span>';
							
						}else if(estado==3){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Cupon Actualizado </span>';
							
						}
						
						location.reload();
				    break;					    				    			    				    

					case '8600': // Actualiza Solo colecciones opcionales 	   
					
					figura= '';
					//alert(estado); 
					document.getElementById('res_valida_cupon').style.display = 'block';

						if(estado==1){
															
							mensaje_dis = '<span class="text-success"> <i class="fa-solid fa-circle-check"></i> Cupón Aplicado '+figura+' </span>';
							
							location.reload();
							
						}else if(estado==0){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_dis = '<span class="text-danger"> <i class="fa-solid fa-circle-xmark"></i> Cupón No Vigente '+figura+' </span>';
							
						}else if(estado==2){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_dis = '<span class="text-danger"> <i class="fa-solid fa-circle-xmark"></i> Cupón No Encontrado '+figura+' </span>';
							
						}else if(estado==3){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_dis = '<span class="text-danger"> <i class="fa-solid fa-circle-xmark"></i> Cupón No válido para su Usuario '+figura+' </span>';
							
						}else if(estado==4){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_dis = '<span class="text-danger"> <i class="fa-solid fa-circle-xmark"></i> Cupón No válido para esta Colección  '+figura+'</span>';
							
						}else if(estado==5){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_dis = '<span class="text-danger"> <i class="fa-solid fa-circle-xmark"></i> Cupón No Disponible '+figura+' </span>';
							
						}else if(estado==6){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_dis = '<span class="text-danger"> <i class="fa-solid fa-circle-xmark"></i> Este cupón ya ha sido utilizado.'+extra+' </span>';
							
						}else if(estado==7){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_dis = '<span class="text-danger"> <i class="fa-solid fa-circle-xmark"></i> Este cupón ya ha sido utilizado para esta serie. Si su cupon es de varios usos, canjealo con otra serie. '+figura+' </span>';
							
						}else if(estado==8){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_dis = '<span class="text-danger"> <i class="fa-solid fa-circle-xmark"></i> Error interno. '+extra+' </span>';
							
						}else if(estado==9){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_dis = '<span class="text-danger"> <i class="fa-solid fa-circle-xmark"></i> Este cupon ya ha sido utilizado las veces permitidas. </span>';
							
						}else if(estado==10){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_dis = '<span class="text-danger"> <i class="fa-solid fa-circle-xmark"></i> Este cupon ya se utilizó para esta serie. </span>';
							
						}else if(estado==11){
								//error = 'La serie '+figura+' se ha regsirado exitosamente';
								mensaje_dis = '<span class="text-danger"> <i class="fa-solid fa-circle-xmark"></i> Esta serie ya cuenta con un cupón activo. </span>';
							
						}else if(estado==12){
							//error = 'La serie '+figura+' se ha regsirado exitosamente';
							mensaje_dis = '<span class="text-danger"> <i class="fa-solid fa-circle-xmark"></i> Este cupon aún no está vigente. Espera hasta la fecha de inicio para usarlo. </span>';
						
					}	else{
							mensaje_dis = estado;
						}
						
						document.getElementById('res_valida_cupon').innerHTML = mensaje_dis;
						desapear(document.getElementById('res_valida_cupon'));
						
				    break;
				    
					case '8700': //Guarda menu	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Cupon actualizado </span>';
							location.reload();
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;

					case '8800': //Guarda menu	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Cupón Bloqueado </span>';
							location.reload();
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;

					case '9000': //Guarda menu	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Registro Actualizado </span>';
							location.reload();
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
							
						}
				    break;

					case '9100': //Guarda menu	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Registro Eliminado </span>';
							location.reload();
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+figura+'  </span>';
							
						}
				    break;

					case '9200': //Guarda menu	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Grupo Guardado </span>';
							location.reload();
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+figura+'  </span>';
							
						}

				    break;

					case '9300': // eliminado    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Registro Eliminado </span>';
							location.reload();
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+figura+'  </span>';
							
						}
				    break;

					case '9400': //Guarda menu	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Registro Actualizado  </span>';
							location.reload();
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+figura+'  </span>';
							
						}
				    break;
					case '9500': //Guarda menu	    

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Elemento Quitado del Grupo </span>';
							location.reload();
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+figura+'  </span>';
							
						}
				    break;


					case '9600': //Guarda minifiguras     

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Guardado Automático [2 de 4]</span>';
							//location.reload();
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+figura+'  </span>';
							
						}
				    break;

					case '9700': //actualiza fotos de minifiguras     

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Guardado Automático [4 de 4]</span>';
							//location.reload();
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+figura+'  </span>';
							
						}
				    break;

					case '9900': //actualiza fotos de minifiguras     

						if(estado==1){
															
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Grupo Actualizado </span>';
							location.reload();
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+figura+'  </span>';
							
						}
				    break;


					case '10000': //actualiza fotos de minifiguras     
						var color = ''; 
						if(estado==1){
															

							if(figura==1){
								
								console.log(serie);
								color = document.getElementById('color-'+extra).value;								
								
								document.getElementById('ico_fav_'+serie).innerHTML= '<span class="" style="color:rgba('+color+',0.8);"> <i class="fa-solid fa-heart"></i> </span>';
								
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Agregado a Favoritos </span>';
							}else if(figura==0){
								console.log(serie);
								document.getElementById('ico_fav_'+serie).innerHTML= '<span class="text-muted"> <i class="fa-regular fa-heart"></i> </span>';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Eliminado de Favoritos</span>';
							}

							
														
						}else if(estado==0){
							
							mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> Quitado de Favoritos   </span>';
							//location.reload();
							
						}else if(estado==2){

							//alert(serie);

							if(figura==1){
								console.log(serie);
								color = document.getElementById('color-'+extra).value;
								document.getElementById('ico_fav_'+serie).innerHTML= '<span class="" style="color:rgba('+color+',0.8);"> <i class="fa-solid fa-heart"></i> </span>';
								
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Agregado a Favoritos </span>';
							
							}else if(figura==0){
								console.log(serie);
								document.getElementById('ico_fav_'+serie).innerHTML= '<span class="text-muted"> <i class="fa-regular fa-heart"></i> </span>';
								mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Eliminado de Favoritos</span>';
							}

							//mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> Agregado a favoritos </span>';
							
						}
				    break;

					case '10100': // alta usuario
						//document.getElementById('error_display').innerHTML = mensaje_res;
					//	alert('Inicio de Sesion:'+estado);
						if( estado==1){ //agregado / activado 

							location.href = figura ;
							mensaje_res = '<span class="theme_color"> <i class="fa fa-times "> </i> Tu archivo ha sido generado y descargado con exito. </span>';
							
							//document.getElementById('res_csv').innerHTML = '<a class="btn btn-outline-primary" href="'+figura+'"><i class="fa fa-download" ></i> Descargar</a>';
    					}else if(estado==0){ // eliminado
							mensaje_res = '<span class="theme_color_error"> <i class="fa fa-times "> </i> '+ error +'</span>';
    					}else if(estado==2){ // eliminado
							mensaje_res = '<span class="theme_color"> <i class="fa fa-times "> </i> '+figura+'</span>';
    					}
    					
    					
									       
					break; 	

					case '10200': //Guarda menu	    

					if(estado==1){
														
						mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Ubicacion Guardada </span>';
						location.reload();
													
					}else if(estado==0){
						
						mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+figura+'  </span>';
						
					}

				break;

				case '10300': // eliminado    

					if(estado==1){
														
						mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Registro Eliminado </span>';
						location.reload();
													
					}else if(estado==0){
						
						mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+figura+'  </span>';
						
					}
				break;

				case '10400': // eliminado    

					if(estado==1){
														
						mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Imagen '+figura+'  convertida con exito. </span>';
						//location.reload();
													
					}else if(estado==0){
						
						mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+figura+'  </span>';
						
					}
				break;
				case '10500': // eliminado    

					if(estado==1){

						if(figura==1){
							document.getElementById('hold_coleccion').style.display= 'flex'; 
							
						}else{
							document.getElementById('hold_coleccion').style.display= 'none'; 
						}
														
						mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Configuracion Actualizada. </span>';
						//location.reload();
						
													
					}else if(estado==0){
						
						mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> Error '+figura+'  </span>';
						
					}
				break;

				case '10600': // eliminado  
					if(estado==1){
															
						mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Seccion agregada </span>';
						location.reload();
													
					}else if(estado==0){
						
						mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> La Seccion ya existe  </span>';
						
					}
				break;

				case '10700': // eliminado    

				if(estado==1){

					console.log(figura);
					var data_mnu = figura.split('&');

					var nombre = data_mnu[4];
					var link = data_mnu[5];
					var cve = data_mnu[6];
					var title = data_mnu[2];
					var mnu_padre = data_mnu[1];
					var icono = data_mnu[3]; 
					var estado = data_mnu[7];
					var nivel = data_mnu[8];
					var orden = data_mnu[9];
					var tipo_menu = data_mnu[10];
					var display_title = data_mnu[11];
					var color = data_mnu[0]; 
					var id=data_mnu[12];
					var date =  data_mnu[13];
					var select_tipo = '<select class="form-control" id="tipo_mnu" >'+data_mnu[14]+'</select>';
					
					var select_padre = ' \
					<select class="form-control" id="id_padre_mnu" > \
					<option value="999">Elije...</option> \
					<option value="9999">Sin Clasificar</option> \
					<option value="0">Barra Lateral</option> \
					<option value="99">Op. Perfil</option> '+data_mnu[15]+'</select>'; 

					var icono_ico = '<i class="fa-solid fa-'+icono+'"></i>'; 
					var btn_edo = ''; 
					var btn_save = ''; 
					var btn_eliminar = ''; 
					var pos = '';

					if(nivel>=0){
						pos = ' \
						<div class="form-group row no_padding_bottom"> \
							<label class="col-sm-3 col-form-label">Posición</label> \
							<div class="col-sm-9"> \
							<select class="form-control" id="nivel_mnu" > \
								'+data_mnu[16]+' \
							</select> \
							</div> \
						</div>';
					}

					if(estado==1){
						btn_edo = '<a  class="btn btn-inverse-primary text-primary" onclick="estado_menu(\''+id+'\')" ><i class="fa fa-toggle-on"></i></a>';
					}else{
						btn_edo = '<a  class="btn btn-inverse-primary text-secondary" onclick="estado_menu(\''+id+'\')" ><i class="fa fa-toggle-off"></i></a>';
					}

					btn_save= ' <a class="btn btn-inverse-primary text-primary" onclick="save_menu(\''+id+'\')" ><i class="fa fa-save"></i> </a>'; 
					
					var permiso_elimina = document.getElementById('permiso_elimina').value;

					if(permiso_elimina==1){
						btn_eliminar = '<a  class="btn btn-inverse-primary text-primary" onclick="elimina_menu(\''+id+'\')"><i class="fa fa-trash"></i></a>'; 								 
					}else{
						btn_eliminar = '<a  class="btn btn-inverse-primary text-secondary" ><i class="fa fa-trash"></i></a>'; 								 
					}
					
					
					document.getElementById('id_mnu').value = id;
					document.getElementById('id_mnub').value = id;
					document.getElementById('title_mnu').value = title;
					document.getElementById('cve_mnu').value = cve;
					document.getElementById('icon_mnu').value = icono;
					document.getElementById('ico_mnu').innerHTML = icono_ico;
					document.getElementById('orden_mnu').value = orden;
					document.getElementById('color_mnu').value = color;
					document.getElementById('file_mnu').value = link;
					document.getElementById('btn_edo').innerHTML = btn_edo;
					document.getElementById('btn_save').innerHTML = btn_save;
					document.getElementById('btn_eliminar').innerHTML = btn_eliminar;
					document.getElementById('select_tipo_mnu').innerHTML = select_tipo;
					document.getElementById('select_padre_mnu').innerHTML = select_padre;
					document.getElementById('select_pos').innerHTML = pos;
					
													
				//	mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Configuracion Actualizada. </span>';
					//location.reload();
					
												
				}else if(estado==0){
					
					mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> Error '+figura+'  </span>';
					
				}
				break;

				case '10800': // 

                if(estado==1){

                    document.getElementById('display_imgs').innerHTML = figura;
                   // mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> Error '+figura+'  </span>';
                }

				break;

                case '10900': // 

                if(estado==1){
                   // alert(figura);

                    
                    document.getElementById('hold_modal_pagina').style.display='block';
                    var pag = 'https://bricksidemx.com/collector/index.php?mnu='+figura;

                    var content = '<?php include("'+figura+'"); ?>'; 

                    document.getElementById('modal_pagina').innerHTML = content;
                   // mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> Error '+figura+'  </span>';
                   
                }

				break;

				case '11000': // actualizacion estado historial o acceso    

					if(estado==1){
														
						mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Registro Actualizado </span>';
						location.reload();
													
					}else if(estado==0){
						
						mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
						
					}
				break;

                case '11200': // actualizacion estado historial o acceso    

                if(estado==1){
                                                    
                    //mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Registro Actualizado </span>';
                    //location.reload();
                    document.getElementById('code_permiso').value= figura;
                    document.getElementById('code_permiso_conf').value= extra;
                    document.getElementById('select_permisos_current').innerHTML= serie;
                    document.getElementById('select_permisos_conf_current').innerHTML= extrab;
                                                
                }else if(estado==0){
                    
                    mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
                    
                }
                break;

                case '11300': // actualizacion estado historial o acceso    

                if(estado==1){
                                                    
                    mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Perfil agregado con exito </span>';
                    location.reload();
                                                
                }else if(estado==0){
                    
                    mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
                    
                }else if(estado==0){
                    
                    mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> Registro duplicado </span>';
                    
                }
            	break;

				case '11400': // actualizacion estado historial o acceso    

				if(estado==1){
													
					mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Registro Actualizado </span>';
					location.reload();
												
				}else if(estado==0){
					
					mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
					
				}
				break;

				case '11500': // actualizacion estado historial o acceso    

				if(estado==1){
													
					mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Figura Actualizada por admin </span>';
					location.reload();
												
				}else if(estado==0){
					
					mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
					
				}
				break;

				case '11600': //actualiza fotos de minifiguras     
				var color = ''; 
					if(estado==1){
														

						if(figura==1){
							
							//console.log(serie);
							color = document.getElementById('color_serie_admin').value;								
							
							document.getElementById('ico_fav_'+serie).innerHTML= '<span class="" style="color:rgba('+color+',0.8);"> <i class="fa-solid fa-heart"></i> </span>';
							
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Favorito agregado por admin </span>';
						}else if(figura==0){
							console.log(serie);
							document.getElementById('ico_fav_'+serie).innerHTML= '<span class="text-muted"> <i class="fa-regular fa-heart"></i> </span>';
							mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Favorito eiminado por admin  </span>';
						}

						
													
					}else if(estado==0){
						
						console.log(serie);
						document.getElementById('ico_fav_'+serie).innerHTML= '<span class="text-muted"> <i class="fa-regular fa-heart"></i> </span>';
						mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Favorito eiminado por admin  </span>';
						
					}
			
					location.reload();
				break;

                case '11700': // Actualiza Solo colecciones opcionales 	    

                if(estado==1){
                                                    
                    mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Permiso Actualizado </span>';
                   // document.getElementById('check_admin_conf').innerHTML = figura;
                    location.reload();
                    
                }else if(estado==0){
                        //error = 'La serie '+figura+' se ha regsirado exitosamente';
                        mensaje_res = '<span class="theme_color"> <i class="fa fa-times"> </i> '+error+'  </span>';
                    
                }
            break;	

			case '11800': //Guarda menu	    

			if(estado==1){
												
				mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Cupón Eliminado</span>';
				location.reload();
											
			}else if(estado==0){
				
				mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
				
			}
			break;

			case '11900': //Guarda menu	    

			if(estado==1){
												
				mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Cupón Eliminado</span>';
				location.reload();
											
			}else if(estado==0){
				
				mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
				
			}
			break;
			
			case '12000': //Guarda menu	    

			if(estado==1){
												
				mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Archivo Renombrado</span>';
				location.reload();
											
			}else if(estado==0){
				
				mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
				
			}
			break;

			case '12100': //Guarda menu	    

			if(estado==1){
												
				mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Carpeta Eliminada </span>';
				location.reload();
											
			}else if(estado==0){
				
				mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
				
			}
			break;

			case '12200': //Guarda menu	    
				if(estado==1){
													
					mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Carpeta Creada </span>';
					location.reload();
												
				}else if(estado==0){
					
					mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> Carpeta No valida o existente  </span>';
					
				}
			break;

			case '12300': //Guarda menu	   
				if(estado==1){
													
					mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Archivo Movido </span>';
					document.getElementById('list_minifig_img').innerHTML = figura;
					//location.reload();
												
				}else if(estado==0){
					
					mensaje_res = '<span class="theme_danger"> <i class="fa fa-check"> </i> Archivo Movido </span>';
					document.getElementById('list_minifig_img').innerHTML = figura;
					//location.reload();
					
				}
			break;

			case '12400': //Guarda menu	   
			if(estado==1){
												
				mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Archivo Movido '+figura+'</span>';
				document.getElementById('list_minifig_img').innerHTML = figura;
											
			}else if(estado==0){
				
				mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> Archivo No movido '+figura+' </span>';
				//location.reload();
				
			}
		break;

		case '12500': //Guarda menu	   
		if(estado==1){
											
			mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Minifigura Actualizada </span>';
			location.reload();
			//document.getElementById('list_minifig_img').innerHTML = figura;
										
		}else if(estado==0){
			
			mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> No actualizado </span>';
			//location.reload();
			
		}
	break;

	case '12600': //Guarda menu	   
	if(estado==1){
										
		//mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Minifigura Actualizada </span>';
		document.getElementById('show_code').innerHTML = figura;
		document.getElementById('show_img_card').innerHTML = serie;
		document.getElementById('name_card').value = extra;
									
	}else if(estado==0){
		
		mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> No actualizado </span>';
		//location.reload();
		
	}
break;


case '12700': //Guarda menu	   
if(estado==1){
									
	location.href = figura ;
	mensaje_res = '<span class="theme_color"> <i class="fa fa-check "> </i> Tu archivo ha sido generado y descargado con exito. </span>';
	
}else if(estado==0){
	
	mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> No actualizado </span>';
	//location.reload();
	
}
break;

case '12800': //Guarda menu	   
if(estado==1){
	
	
	//mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Minifigura Actualizada </span>';
	document.getElementById('show_code_set').innerHTML = figura.replace("-", "|");
								
}else if(estado==0){
	
	mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> No actualizado </span>';
	//location.reload();
	
}
break;

case '12900': //Guarda menu	   
if(estado==1){
									
	//mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Minifigura Actualizada </span>';
	//document.getElementById('show_code').innerHTML = figura;
	document.getElementById('show_img_card').innerHTML = serie;
	document.getElementById('name_card').value = extra;
								
}else if(estado==0){
	
	mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> No actualizado </span>';
	//location.reload();
	
}
break;

case '13000': //Guarda menu	   
if(estado==1){
									
	//mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Minifigura Actualizada </span>';
	//document.getElementById('show_code').innerHTML = figura;
	document.getElementById('show_img_cards').innerHTML = figura;
	document.getElementById('name_combo_cards').value = serie;
	document.getElementById('title_combo').innerHTML = extra;
	document.getElementById('precio_sug').innerHTML = '$ '+extrab+'.00';
	
								
}else if(estado==0){
	
	mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> No actualizado </span>';
	//location.reload();
	
}
break;

case '13100': //Guarda menu	    

if(estado==1){
                                    
    mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Archivo Renombrado</span>';
    lista_fotos_sets();
    ///location.reload();

}else if(estado==0){
    
    mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
    
}
break;
case '13200': //Guarda menu	    

if(estado==1){
                                    
    mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Impresion Registrada </span>';
	document.getElementById('display_lbl').innerHTML = figura.replace("!", '|');
	var data = serie.split('-');
	var clave_lego = data[0];
	var no_imp = data[1];
	document.getElementById('cant_'+clave_lego).innerHTML = no_imp;

    //lista_fotos_sets();
    //location.reload();

}else if(estado==0){
    
    mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
    
}
break;
case '13300': //Guarda menu	    

if(estado==1){
                                    
    mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Perfil Actualizado </span>';
	location.reload();


}else if(estado==0){
    
    mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
    
}
break;

case '13400': //Guarda menu	    

if(estado==1){
                                    
    mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Foto de Perfil Actualizada </span>';
	//var pic = '<img class="img-lg rounded-circle" src="assets/images/faces/profile/'+figura+'" alt="Profile image">	';
	document.getElementById('profile_pic').innerHTML = figura;
	//location.reload();


}else if(estado==0){
    
    mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
    
}
break;

case '13500': //Guarda menu	    

if(estado==1){
                                    
    mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Token actualizado </span>';
	//var pic = '<img class="img-lg rounded-circle" src="assets/images/faces/profile/'+figura+'" alt="Profile image">	';
	//document.getElementById('profile_pic').innerHTML = figura;
	location.reload();


}else if(estado==0){
    
    mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
    
}
break;

case '13600': //Guarda menu	    

if(estado==1){
                                    
    mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Invitación '+figura+' creada </span>';
	document.getElementById('img_qr').innerHTML = serie+'<span class="text-muted">'+extra+'</span>';

}else if(estado==2){
    
    mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> La invitacion ya existe </span>';
    
}else if(estado==0){
    
    mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
    
}
break;

case '13700': //Guarda menu	    

		if(estado==1){
											
			//mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Invitación '+figura+' creada </span>';
			document.getElementById('despliega_invitacion').innerHTML = figura;
			//document.getElementById('name_invitacion').value = 'invitacion_'+serie;

		}else if(estado==0){
			
			mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
			
		}
break;
case '13800': //Guarda menu	    

		if(estado==1){
			mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i> Invitación eliminada </span>';
			location.reload();
		}else if(estado==0){
			mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
		}
break;

case '13900': //Guarda menu	    

		if(estado==1){
			//mensaje_res = '<span class="theme_color"> <i class="fa fa-check"> </i>  </span>';
			document.getElementById('table_movs').innerHTML = figura;

			//location.reload();
		}else if(estado==0){
			mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
		}
break;
case '14000': //Guarda menu	    

		if(estado==1){
			
			var data = figura.split('¿');
			var rango = data[0];
			var tots = data[1];
			var movs = data[2];
			
			document.getElementById('rango_fechas').innerHTML = rango;
			document.getElementById('tots_balance').innerHTML = tots;
			document.getElementById('movs').innerHTML = movs;
			

			//location.reload();
		}else if(estado==2){
			
			var data = figura.split('¿');
			var rango = data[0];
			var tots = data[1];
			var movs = data[2];
			
			document.getElementById('rango_fechasb').innerHTML = rango;
			document.getElementById('tots_balanceb').innerHTML = tots;
			

			//location.reload();
		}else if(estado==0){
			mensaje_res = '<span class="theme_danger"> <i class="fa fa-times"> </i> '+error+'  </span>';
		}
break;
			default: 
			break; 
			}//switch 
							       
			
			
		}else if(error != ""){       
			
				 mensaje_res = error;
				// mensaje_res = 'test error';

 		}// mensaje_res 
							       		       					      							       
 		
	console.log('Mensaje: '+mensaje_res );

		if(mensaje_res != ""){
			var leng = mensaje_res.length;

			//alert(mensaje_res);
			
			if(leng >= 20){			
				document.getElementById(container_id).innerHTML = mensaje_res;
				desapear(document.getElementById(container_id));
			}else{
				
			}
		}
	
	
	//document.getElementById(container_id).innerHTML = mensaje_res;
	//desapear(document.getElementById(container_id));
							       
	}else { // waiting for result 
		document.getElementById(container_id).innerHTML = loading_text;
	}
		
}
	xhr.open(method, url, true);
	xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xhr.send(params);
}


