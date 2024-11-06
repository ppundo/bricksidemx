function save_perfil(id){
	
	var id_user = id; 
	
	var nombre = document.getElementById('nombre').value; 
	var apellido = document.getElementById('apellido').value;
	var f_nac = document.getElementById('f_nac').value; 
	var usuario = document.getElementById('usuario').value; 
	var pass = document.getElementById('p_pass').value; 
	var pass_verifica = document.getElementById('p_pass_verifica').value; 
	var contrasenia; 
	var idioma_p = document.getElementById('idioma_p').value;
	var vista_fig = document.getElementById('vista_fig').value; 
	var pagina_inicial = document.getElementById('pagina_inicial_p').value; 
	var idioma_u ;
	
	var vista_m = document.getElementById('vista_m_p').value;
	var vista_s = document.getElementById('vista_s_p').value;
	
	
	if( pass.length >0 && pass_verifica.length > 0 ){
		
		if( pass != pass_verifica ){
			alert('La contraseña nueva no coincide');
			contrasenia = "X"; 
		}else{
			contrasenia = pass_verifica;
		}
		
	}else{
		contrasenia = "X"; 
	}

	if(vista_m == 'XX'){
		vista_m= '2';
	}else{
		vista_m = document.getElementById('vista_m_p').value;
	}	

	if(vista_s == 'XX'){
		vista_s= '2';
	}else{
		vista_s = document.getElementById('vista_s_p').value;
	}
	
	if(idioma_p == 'XX'){
		idioma_u = 'es';
	}else{
		idioma_u = document.getElementById('idioma_p').value;
	}

	if(pagina_inicial == 'XX'){
		pag_inicial = 'bienvenida';
	}else{
		pag_inicial = document.getElementById('pagina_inicial_p').value; 
	}

// valida que el usuario no sea un correo o tenga caracteres. 

    const caracteres_no_per = ["@","$"];
    var caracter_user = '';
    var bandera_guarda; 
    var acum = 0;
    
    for(i=0; i<=caracteres_no_per.length; i++){
	    caracter_user = usuario.search("'"+caracteres_no_per[i]+"'");
	   // alert(caracteres_no_per[i]+'-'+caracter_user);
	    
	    if(caracter_user > 0){
		    acum = acum + caracter_user;
	    }else{
		    acum = acum + 0;
	    }
    }
	
	
	//alert(usuario.search(caracteres_no_per[i]));

	if(acum > 0){
		alert('El nombre de uausario tienen caracteres no permitidos o es un correo electronico. No use cualquiera de los siguientes caracteres: "@", "/", "-" , "#", "|".');
		bandera_guarda = 0;
	}else{
		//alert(caracter_user);
		//return 0;
		bandera_guarda = 1;
	}
		
	if(nombre==""){
		nombre = document.getElementById('nombre').value; 
	}else if(apellido==""){
		apellido = document.getElementById('apellido').value;
	}else if(usuario==""){
		usuario = document.getElementById('usuario').value; 
	}else{
	

	var code = '';
	
	//// Busca las series opcionales
	
	var s_opcionales = document.getElementById('current_series_op').value;
	
	var data_opcionales = s_opcionales.split(';');
	
		for(i=0;i< data_opcionales.length; i++){
			if(data_opcionales[i] != ''){
				
				if(document.getElementById('serie_'+data_opcionales[i]).checked){
							 // alert('checkbox esta seleccionado');
					code = code + '1.' ; 
							  
				}else{
							//alert('checkbox no esta seleccionado');
					code = code + '0.' ; 
				}			
				
			}
			
		}
	
///alert(code);
		if (bandera_guarda==1 ){
					var url = 'save_minifigures.php';
					var method = 'POST';
					var params = 'id_user='+ id_user;
						params += '&nombre='+ nombre;
						params += '&apellido='+ apellido;
						params += '&f_nac='+ f_nac;
						params += '&usuario='+ usuario;
						params += '&pass_new='+ contrasenia;
						params += '&code_series='+ code;
						params += '&series_op='+ s_opcionales;
						params += '&idioma_p='+ idioma_u;
						params += '&vista_fig='+ vista_fig;
						params += '&pagina_inicial='+ pag_inicial;
						params += '&vista_m='+ vista_m;
						params += '&vista_s='+ vista_s;
						params += '&action=23';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	
					
					
		}
		
	}
	
	
}



<tr id="user_'.$rowb['id'].'" style="display:none;">
	                        	<td colspan="6" style="padding-top:0px;">

	                        	<div class="row">
	                        	
									<div class="p-2 col-md-12 border-bottom bg-light " style="border:0px solid #c30; padding:0 10px 10px 0px; margin-bottom:0 px;">
										<label class="col-sm-1 col-form-label text-muted" >Nombre:</label> 
										
										<span class="col-md-6 text-muted border " style="padding: 3px 10px; border-radius:5px;" > 
											<i class="fa fa-user"></i>  '.$rowb['nombre'].' 
										</span>
										
										<span class="text-muted border " style="padding: 3px 10px; border-radius:5px; margin-left:10px; ">
										Miembro desde: <b>'.formatFecha($rowb['fecha_registro']).'</b> 
										</span>
										
									</div>

		                        	<div class="col-md-3" style="border:0px solid #c30; padding: 0px 0px 1px 0px;">
										<label class="col-md-12 col-form-label p-2 titlel-sec text-muted" >Información Personal:</label>
									
										<div class="">	                        		
		                        			<label class="col-md-4 col-form-label text-muted" >Fecha Nac.:</label>
		                        			<span class="col-md-8 text-muted" > '.$fnacc.' </span> 

										</div>
										
										<div class="">
		                        			<label class="col-md-4 col-form-label text-muted" >Dirección:</label>
		                        			<span class="col-md-8 text-muted" >
		                        			<button class="btn btn-sm col-md-4 '.$btn_style.' " '.$estado_btn_dir.' style="font-size:12px; padding: 3px 10px;" onclick="toggle(\'dir_'.$rowb['id'].'\')" > Ver Dirección</button>
		                        			</span>
											
										</div>										
										<br>
		                        		<div class="" id="dir_'.$rowb['id'].'" style="display:none" >
		                        			<span>'.$direccion.'</span>
		                        		</div>
		                        	
		                        	</div>
		                        	
	
	                        	
		                        	<div class="col-md-3 border-left" style=" padding: 0px 0px 1px 0px; border:0px solid #c30;">
									<label class="col-md-12 col-form-label p-2 titlel-sec" >Configuracion:</label>
									
										<div style="margin: 2px 5px auto 5px;">                        		
			                        		
			                        		<div class="" >
			                        			<label class="col-md-3 col-form-label text-muted" >Perfil </label>
			                        		
												<select class="col-md-8 form-control" id="user_perfil_'.$rowb['id'].'">
													'.genera_select_perfil($rowb['clave']).'
												</select>
												
			                        			
											</div>
											
											<div class="">	                        		
			                        			<label class="col-md-3 col-form-label text-muted" >Correo:</label>
			                        			<input class="col-md-8 form-control" id="user_correo_'.$rowb['id'].'" type="text" value="'.$rowb['correo'].'"  >
	
											</div>
	
											<div class="">	                        		
			                        			<label class="col-md-3 col-form-label text-muted" >Usuario:</label>
			                        			<input class="col-md-8 form-control" id="user_username_'.$rowb['id'].'" type="text" value="'.$rowb['usuario'].'" >
	
											</div>		                        		
	
											<div class="" >	                        		
			                        			<label class="col-md-3 col-form-label text-muted" >Estado:</label>
												<span class="col-md-8 text-muted">'.$edo.' </span>
											</div>	
	
											<div class="" >	                        		
			                        			<label class="col-md-3 col-form-label text-muted" >Activado:</label>
												<span class="col-md-8 text-muted"> '.formatFechaHora($rowb['fecha_activado']).'</span>
											</div>
											</div>									
		                        	</div>
	
	
		                        	<div class="col-md-6 border-left" style="padding: 0px 2px 1px 3px; border:0px solid #c30;">		                        		
		                        		<label class="col-md-12 col-form-label p-2  titlel-sec" >Informacion de Acceso:</label>
		                        		
		                        		<div class="row col-md-12">
		                        			<label class="col-md-4 text-muted col-form-label " >Contraseña: </label> 
		                        			<span class="col-sm-2 col-form-label text-primary">'.$edo_pass.'</span>
												
										</div>
																			
										
										<div class="">	                        		
		                        			<label class="col-md-4 col-form-label text-muted" >Actividad:</label>
		                        			<a href="javascript:ventanaSecundaria(\''.$url.'\')" class="btn btn-secondary text-primary"> Ver detalles</a>
										</div>											

										<div class="">	                        		
		                        			<label class="col-md-4 col-form-label text-muted" >Ultima sesión: </label>
		                        			<span class="col-md-12 text-sm text-primary">'.$tiempo.'<span> 
										</div>			                        		
																		
		                        	</div>
		                        	
		                        	
		                        	
		                        	<!--<div class="col-md-3 border-left no-show" style="border:0px solid #c30; padding:0px 1px 3px 1px;">
		                        			
		                        			<label class="col-md-12 col-form-label p-2 titlel-sec" >Colecciones Opcionales:</label>
		                        			<div class="col-md-12 " style="height: 90%; overflow: auto; overflow-x: hidden; " id="check_admin_'.$rowb['id'].'">
												'.$chk_col_op.'
		                        			</div>
											
											<input type="hidden" value="" id="val_opcionales_'.$rowb['id'].'" >
											<input type="hidden" value="" id="per_opcionales_'.$rowb['id'].'" >
		                        	
		                        	</div>-->
		                        	
		                        	
	                        	</div>	                    	

	                        	
	                        	</td>
	                        </tr>
