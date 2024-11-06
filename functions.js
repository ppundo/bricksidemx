function check_user(act){
	// iniciamos el proceso
	var param; 
	if(act == 1){
		param = document.getElementById('usuario_new').value;
	}else if(act==2){
		param = document.getElementById('email').value;
	}
	
	//alert(param);
	
	var url = 'save_minifigures.php';
	var method = 'POST';
	var params = 'act='+act;
	params += '&param='+param;
	params += '&action=51';
	var container_id = 'snackbar';
	var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>' ;
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text) ;	
}

function valida_user() {
	
	var user_name = document.getElementById('user').value;
	var user_key = document.getElementById('pass').value;
	var keep_sesion; 

if (document.getElementById('mantener').checked) { 
	keep_sesion = 1;
}else{
	keep_sesion = 0;
    //
}

//alert(keep_sesion);
//console.log(keep_sesion);
	//alert(user_name);
	// iniciamos el proceso
	var url = 'save_minifigures.php';
	var method = 'POST';
	var params = 'username='+ user_name;
	params += '&key='+ user_key;
	params += '&mantener='+ keep_sesion;
	params += '&action=4';	
	var container_id = 'snackbar';
	var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>' ;
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text) ;
}
///////////////////////////////////////////////

function save_sugest(){
	
	var id = document.getElementById('user_id').value; 
	var cve = document.getElementById('clave_sug').value;
	var tema = document.getElementById('tema_sug').value;
	var tipo = document.getElementById('tipo_sug').value;
	var detalles = document.getElementById('detalles_sug').value;

tam_det = detalles.length;

	if(cve==''){
		alert('Ingresa la Clave de por lo menos un set que incluya el elemento a coleccionar');
	}else if(tema=='XX'){
		alert('Selecciona un Tema');
	}else if(tipo=='XX'){
		alert('Selecciona un Tipo');
	}else if(tam_det < 30){
		alert('Regalanos mas detalles de tu sugerencia');
	}else{
	
		var url = 'save_minifigures.php';
		var method = 'POST';
		var params = 'user='+id;
		params += '&cve='+cve;
		params += '&tema='+tema;
		params += '&tipo='+tipo;
		params += '&detalles='+detalles;
		params += '&action=55';
		var container_id = 'snackbar';
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>' ;
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text) ;
	}
	
}

//////////////////
function save_minifigures(id) {
	// iniciamos el proceso
	var idioma = document.getElementById('user_idioma').value;
	
	//alert(id);
	var url = 'save_minifigures.php';
	var method = 'POST';
	var params = 'item='+id;
	params += '&idioma='+ idioma;
	params += '&id_user='+ document.getElementById('user').value;
	params += '&action=1';
	var container_id = 'snackbar';
	var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>' ;
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text) ;
}

///////////////////////////////////////////////
function save_pieces(id) {
	// iniciamos el proceso
	//
	document.getElementById('pieces-'+id).value = document.getElementById('edita_piezas').value;
	
	var url = 'save_minifigures.php';
	var method = 'POST';
	var params = 'item='+id;
	params += '&id_user='+ document.getElementById('user').value;
	params += '&values='+ document.getElementById('edita_piezas').value;
	params += '&action=6';
	var container_id = 'snackbar' ;
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>' ;
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text) ;
}
///////////////////////////////////////////////
function save_tags(id) {
	// iniciamos el proceso
	var url = 'save_minifigures.php';
	var method = 'POST';
	var params = 'item='+id;
	params += '&id_user='+ document.getElementById('user').value;
	params += '&values='+ document.getElementById('edita_tags').value;
	params += '&action=2';
	var container_id = 'snackbar' ;
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>' ;
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text) ;
}
///////////////////////////////////////////////
function save_more_info_minifig(id) {
	// iniciamos el proceso
	var url = 'save_minifigures.php';
	var method = 'POST';
	var params = 'item='+id;
	params += '&id_user='+ document.getElementById('user').value;
	params += '&values='+ document.getElementById('edita_folleto').value+';';
	params += '&action=37';
	var container_id = 'snackbar' ;
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>' ;
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text) ;
}




function save_extras(id) {
	// iniciamos el proceso
	
	var status_minifig_coleccion = document.getElementById('status-coleccion-'+id).value;
	
	if(status_minifig_coleccion == 0){
		
		//alert('Para poder registrar figuras extras, agrega la figura a tu coleccion.');
		compartir = 0;
	}
		
		var cant = document.getElementById('edita_extras').value;
		
		if( parseInt(cant) <= 0){
				//alert('No es posible registar esa cantidad de figuras extras. Elija una cantidad mayor.'+cant);
				compartir = 0;
		}
		
		
		document.getElementById('extras-'+id).value = cant; 
		
				var compartir = 0; 
				
				var isChecked = document.getElementById('edita_compartir').checked;
				if(isChecked){
				  //alert('checkbox esta seleccionado');
				  	compartir = 1; 
				  
				}else{
				//alert('checkbox no esta seleccionado');
					compartir = 0; 
				}
				
				if(cant = 0){
					compartir = 0; 
				}else{
					compartir = 1; 
				}
			
			//alert(compartir); 
			
			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'item='+id;
			params += '&id_user='+ document.getElementById('user').value;
			params += '&extras='+ document.getElementById('edita_extras').value;
			params += '&compartir='+ compartir;
			params += '&action=43';
			var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>' ;
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text) ;
		
	
}
/////////////////////////////////////////////////

function save_names(id) {
	
	//alert(document.getElementById('edita_nombre_es').value+';'+ document.getElementById('edita_nombre_en').value); 
	
	//var sku = document.getElementById('edita_sku').value;
	// iniciamos el proceso
	
	document.getElementById('nombre_es-'+id).value = document.getElementById('edita_nombre_es').value; 
	document.getElementById('nombre_en-'+id).value = document.getElementById('edita_nombre_en').value; 

	//alert('ok');
	
	var url = 'save_minifigures.php';
	var method = 'POST';
	var params = 'item='+id;
	params += '&user_idioma='+ document.getElementById('user_idioma').value;
	params += '&id_user='+ document.getElementById('user').value;
	params += '&values='+ document.getElementById('edita_nombre_es').value+'|'+ document.getElementById('edita_nombre_en').value;
	params += '&action=3';
	var container_id = 'snackbar' ;
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text) ;
}
///////////////////////////////////////////////

function save_foto_minifig(id) {
	//alert(id); 
	var foto_nva = document.getElementById('edita_foto').value;
	var foto_actual = document.getElementById('edita_url').value;
	var foto_save = ""; 
	
	var data = foto_actual.split('/');
	var foto_current = data[2];
	
	if(foto_nva=='X'){
		//alert('Seleccion auna imagen nueva');
		 foto_save = foto_current;
	}else{
		 foto_save = document.getElementById('edita_foto').value;
	}
	
	//alert(id);
	
	//alert(foto_save); 
	//alert(document.getElementById('edita_foto').value);
	// iniciamos el proceso
	var url = 'save_minifigures.php';
	var method = 'POST';
	var params = 'item='+id;
	//params += '&id_user='+ document.getElementById('user').value;
	params += '&foto='+ foto_save; 
	//params += '&values='+ document.getElementById('nombrees-'+id).value+';'+ document.getElementById('nombreen-'+id).value;
	params += '&action=36';
	var container_id = 'snackbar' ;
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text) ;
	
	
}
///////////////////////////////////////////////


function register_user() {
	// iniciamos el proceso
	
	var correo = document.getElementById('email').value; 
	var usuario = document.getElementById('usuario_new').value; 
	var pass = document.getElementById('pass').value; 
	var conf_pass = document.getElementById('pass_confirm').value;
	var profile_foto = document.getElementById('profile_url').value;
	
	if(usuario == ""){
		alert('Indique un nombre de usuario');
	}else if(pass == ""){
		alert('Indique una contraseña');
		
	}else if(correo==""){
		alert('Indique un correo valido');
	
	}else if(pass != conf_pass){
		alert('La contraseña no coincide'); 
				
	}else{
	
		var url = 'save_minifigures.php';
		var method = 'POST';
		var params = 'usuario='+usuario;
		params += '&contrasena='+ pass;
		params += '&profile_foto='+ profile_foto;
		params += '&action=5&correo='+correo;
		var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text) ;
	
	}
}
///////////////////////////////////////////////

function toggle(id){
	
	if (document.getElementById){ //se obtiene el id
		var ele = document.getElementById(id); //se define la variable "el" igual a nuestro div
	ele.style.display = (ele.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
	}
}

function toggle_inline(id){
	
	if (document.getElementById){ //se obtiene el id
		var ele = document.getElementById(id); //se define la variable "el" igual a nuestro div
	ele.style.display = (ele.style.display == 'none') ? 'inline-block' : 'none'; //damos un atributo display:none que oculta el div
	}
}
///////////////////////////////////////////////

function toggle_vis(id){
	
	if (document.getElementById){ //se obtiene el id
		var ele = document.getElementById(id); //se define la variable "el" igual a nuestro div
	ele.style.visibility = (ele.style.visibility == 'hidden') ? 'visible' : 'hidden'; //damos un atributo display:none que oculta el div
	}
}
///////////////////////////////////////////////

function toggle_tr(id){

	
		num_cards = document.getElementsByTagName('cardr'); // obtengo el total de cards
		var num_res = 0; 

					var val_buscado = document.getElementById('val_bus_'+id).value;
						//alert(val_buscado);

						//oculta a todos las cards 


						for(n=0;n< num_cards.length ;n++){ // barro cada card para ocultarlo
							var atributos = document.getElementsByTagName('cardr')[n].getAttribute('searchable');
							var id= document.getElementsByTagName('cardr')[n].getAttribute('id');
							var res_bus = atributos.indexOf(val_buscado);
								
								if(res_bus == -1){

									$('#' + id).fadeOut(100);

								}else if(res_bus != -1 ){
									$('#' + id).fadeIn(100);
									//num_res = document.getElementsByTagName('card').length;
									//num_res += 1; 
									
									//var sh = sh +' '+ res_bus + ',';
								}
						}


	
}
///////////////////////////////////////////////

function toggleb(id){
	
	if (document.getElementById){ //se obtiene el id
		var ele = document.getElementById(id); //se define la variable "el" igual a nuestro div
	ele.style.display = (ele.style.display == 'none') ? 'table-row' : 'none'; //damos un atributo display:none que oculta el div
	}
}
///////////////////////////////////////////////
function item_select(id){
	
	var user= document.getElementById('user').value; 
	
	if(user==0 ){
		//alert('Para poder guardar tu colección deberás iniciar sesión o registrarte.'); 
		container_id = 'snackbar';
		mensaje = 'Para poder guardar esta figura en tu colección <b>inicia sesión</b> o <b>registrate</b>.';
		document.getElementById(container_id).innerHTML = mensaje;
		desapear(document.getElementById(container_id));
		
	}else{
	
		if (document.getElementById){ 

			var elem = document.getElementById(id); 

			//elem.style.filter = (elem.style.filter == 'grayscale(1%)') ? 'grayscale(100%)' : 'grayscale(1%)';
			elem.style.filter = (elem.style.filter == 'opacity(100%) grayscale(1%) blur(0px)') ? 'opacity(40%) grayscale(100%) blur(0px)' : 'opacity(100%) grayscale(1%) blur(0px)';

		}
		
		//////////// cambia estado en la coleccion
		var nvo_estado; 
		var estado = document.getElementById('status-coleccion-'+id).value;
		
		if(estado== 0){
			nvo_estado = 1; 
			document.getElementById('holdcard-'+id).classList.add('act');
		}else{
			nvo_estado = 0;
			document.getElementById('holdcard-'+id).classList.add('inact');
		}
		
		document.getElementById('status-coleccion-'+id).value = nvo_estado; 
		
		////////////////
		
		save_minifigures(id);
		
		adecuaciones(id);
		 		
	}

	//// CREA LA BARRA DE AVANCE

		// Determina total de figuras
			var num_cards = document.getElementsByTagName('card'); // obtengo el total de cards
			//alert(num_cards.length);

}
	
	////////////////////////////////////////
	
	function adecuaciones(id){
		
		var elem = document.getElementById(id);
		
		///// Cambia los estados y el total de minifiguras total.
		var estado_item= ""; 
		var total_serie = 0; 
			estado_item = document.getElementById('estado-'+id).value; 
		
		if(estado_item==0){
			// sumalo al total de minifiguras. ACTIVADO
			total_serie = document.getElementById('total_serie').value; 
			total_serie = parseInt(total_serie) + 1; 
			document.getElementById('total_serie').value = total_serie;
			document.getElementById('estado-'+id).value= 1;
			document.getElementById('total_serie_label').innerHTML= total_serie; 
			elem.style.filter = 'opacity(100%) grayscale(1%) blur(0px)';
			//document.getElementById('star-'+id).style.color = "#ffb703";
			//document.getElementById('star-edita').style.color = "#ffb703";
			//document.getElementById("star-edita").className =document.getElementById("star-edita").className.replace( /(?:^|\s) diactive_star (?!\S)/g , '' );
			//document.getElementById("star-edita").className += " active_star ";
			document.getElementById('hover_collect').style.display="none" ; 

			var tot_fig = parseInt(document.getElementById('tot_fig').innerHTML);
			
			if(total_serie==tot_fig){
				//sound(4);
				//confetti.start(3000);
				//show_congrats();
			}
			
			
		}else{
			// restalo al total de minifiguras. DESACTIVADO
			total_serie = document.getElementById('total_serie').value; 
			total_serie = parseInt(total_serie) - 1; 
			document.getElementById('total_serie').value = total_serie; 
			document.getElementById('estado-'+id).value = 0;
			document.getElementById('total_serie_label').innerHTML= total_serie;
			elem.style.filter = 'opacity(40%) grayscale(100%) blur(0px)';
			//document.getElementById('star-'+id).style.color = "#c9c9c9";
			//document.getElementById('star-edita').style.color = "#c9c9c9";
			//document.getElementById("star-edita").className =document.getElementById("star-edita").className.replace( /(?:^|\s) active_star (?!\S)/g , '' );
			//document.getElementById("star-edita").className += " diactive_star ";
			document.getElementById('hover_collect').style.display="block" ;

 
		}
		
		
	}
	///////////////////////////////////////////////////
	
	function drag_drop(){
	
		num_cards = document.getElementsByTagName('card'); // obtengo el total de cards
		var num_res = 0; 
/*
						for(n=0;n< num_cards.length ;n++){ 
							$('#card_' + n).fadeIn();
						}
*/
					var val_buscado = document.getElementById('buscar').value;
					//	alert(val_buscado);

						//oculta a todos las cards 


						for(n=0;n< num_cards.length ;n++){ // barro cada card para ocultarlo
							var atributos = document.getElementsByTagName('card')[n].getAttribute('searchable');
							var id= document.getElementsByTagName('card')[n].getAttribute('id');
							var res_bus = atributos.indexOf(val_buscado);
								
								if(res_bus == -1){

									$('#' + id).fadeOut(100);
								}else if(res_bus != -1 ){
									$('#' + id).fadeIn(100);
									//num_res = document.getElementsByTagName('card').length;
									num_res += 1; 
									
									//var sh = sh +' '+ res_bus + ',';
								}
						}
							//document.getElementById('sbus').innerHTML=val_buscado;
							//alert(sh);
						//enlista();
						//document.getElementById('conteo').innerHTML = '<b>'+num_res + '</b> figuras encontradas.';
	}

//////////////////////////////////

function crea_piezas(id){
	
//	alert(id);

document.getElementById('hold_faltantes').innerHTML = ""; 
	// iniciamos el proceso
	var url = 'save_minifigures.php';
	var method = 'POST';
	var params = 'item='+id;
	params += '&id_user='+ document.getElementById('user').value;
	params += '&values=x';
	params += '&action=7';
	var container_id = 'snackbar' ;
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i> Recopilando...';
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text) ;

}

//////////////////////////////////

function save_edita(perfil){
	
	var last_editado = document.getElementById('last_edited').value; 
	
	var id_minifig = document.getElementById('edita_id').value; 
		
		if(perfil == 1){
			
			//alert(id_minifig);
			
			if(last_editado == 'nombrees'){
				save_names(id_minifig);
			}else if(last_editado == 'nombreen'){
				save_names(id_minifig);
			}else if(last_editado == 'tags'){
				save_tags(id_minifig);
			}else if(last_editado == 'piezas'){
				save_pieces(id_minifig);
			}else if(last_editado == 'no_folleto'){
				save_more_info_minifig(id_minifig); 
			}else if(last_editado == 'extras'){
				save_extras(id_minifig); 
			}else{
				
			save_faltantes(); 
			save_foto_minifig(id_minifig); 
			}
			
			
		}else{
			save_faltantes(); 
			save_extras(id_minifig); 
		}
}


function save_faltantes(){

var faltantes = document.getElementById('faltantes_code').value; 

	// iniciamos el proceso
	var url = 'save_minifigures.php';
	var method = 'POST';
	var params = 'item='+ document.getElementById('edita_id').value;;
	params += '&values=' + faltantes;
	params += '&action=8';
	params += '&id_user='+ document.getElementById('user').value;
	var container_id = 'snackbar';
	var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>' ;
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text) ;
	
	
}	


////////////////////////////////////////////////////

function show_message() {
  // Get the snackbar DIV
  var x = document.getElementById("snackbar");

  // Add the "show" class to DIV
  x.className = "show";

  // After 3 seconds, remove the show class from DIV
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

function show_congrats() {
  // Get the snackbar DIV
  var x = document.getElementById("congrats");

  // Add the "show" class to DIV
  x.className = "show";

  // After 3 seconds, remove the show class from DIV
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

////////////////////////////////////////////

function genera_faltantes(chk){
	
	var x = document.getElementById('faltantes_code').value; 
	
	var data = x.split('.');
	var new_code ="";
	var count = 0; 
	//busca el valor de check en el array y cambia el bool
	for(i=0; i <= data.length; i++) {
		if( data[i] !== undefined ){
			//alert(data[i]+'|');
			count += 1; 
			
			if(i == chk ){
			  if(data[i] == 1){
				  new_code += '0.';
			   }else{
				  new_code += '1.';
			   }	
			}else{
			  if(data[i] == 1){
				  new_code += '1.';
			   }else{
				  new_code += '0.';
			   }
			}
			
			
		}
		
	} 
	
	
	var no_separadores = count-1;
	var total = count + no_separadores; 
	var new_cad = new_code.substr(0,total);
	//concatena el valor de cada array para desplegarla como una cadena (0.0.0.0.0.0.0) . 
	
	
	//document.getElementById('faltantes_code').value = ""; 
	document.getElementById('faltantes_code').value = new_cad;
	
	
}
////////////////////////////////////////////////

function genera_add_images(){
	
	var container_id = 'statusbar'; 
	var mensaje; 
	var data; 
	var no_figuras; 
	var form_fig = "";
	var nombre_fig; 
	var nombre_es;
	var nombre_en;
	
	
	document.getElementById('carga_images_add').innerHTML = ""; 
	
	var nombres = document.getElementById('nombres_fig_add').value; 
	
	// comprueba el ultimo caracter 
		var ultimo = nombres.trim().substr(-1,1); 
		
		if(ultimo==";"){
			
			tamano = nombres.length; 
			nombres = nombres.substr(0, tamano -1);
			//alert(nombres); 
			
		}
		
	////// 
	if(nombres==""){
		
		
		mensaje = '<span class="text-danger"><i class="fa fa-times" ></i> Ingrese los nombres de los personajes / figuras separados por ";"</span>'; 
		document.getElementById('carga_images_add').innerHTML = "";
		document.getElementById(container_id).innerHTML = mensaje;
		desapear(document.getElementById(container_id));
		
	}else{
		
		data = nombres.split(';'); 
		no_figuras = document.getElementById('figuras_add').value; 
		
		if(no_figuras != data.length ) {
		
			mensaje = '<span class="text-danger"><i class="fa fa-times" ></i> El total de nombres no coincide con el total de figuras indicado.</span>'; 
			document.getElementById(container_id).innerHTML = mensaje;
			desapear(document.getElementById(container_id));
			document.getElementById('carga_images_add').innerHTML = "";  
		}else{
			
			for(i=0; i <= data.length ; i++){
				if(data[i] != undefined ){
					
					nombres_fig = data[i].split(','); 
					
					if(nombres_fig[0] != undefined ){
						nombre_es = nombres_fig[0];
					}else{
						nombre_es = "";
					}
					
					if(nombres_fig[1] != undefined){
						nombre_en = nombres_fig[1];
						separator = " / ";
					}else{
						nombre_en = "";
						separator = "";
					}
					
					
					
					var cons = i+1;
					form_fig += '<div class="form-group ">   \
			                            <label for="imagen_'+i+'" > '+cons+'. <b>'+nombre_es+separator+nombre_en+'</b> <br></label> \
			                            <input type="file" class="form-control" accept="image/x-png, image/jpg" name="imagen_'+i+'" id="imagen_'+i+'" placeholder="url"> </div><hr>';  
					
				} // if 
				
			}// for 
			document.getElementById('carga_images_add').innerHTML = form_fig; 
			toggle('imagenes_div');
			toggle('add_serie_btns');
		}// else 
		
		
		
	}// else 
	
}



///////////////////////////////////////////////
function hexToRgb(hex) {
  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  return result ? {
    r: parseInt(result[1], 16),
    g: parseInt(result[2], 16),
    b: parseInt(result[3], 16)
  } : null;
}


function recupera_pass() {
	// iniciamos el proceso
	
	var correo = document.getElementById('recupera_email').value; 
	
		
	if(correo==""){
		
		//alert('Indique un correo valido');
		container_id = 'snackbar';
		mensaje = 'Indique un correo valido.';
		document.getElementById(container_id).innerHTML = mensaje;
		desapear(document.getElementById(container_id));
	
	}else{
		
		datos ='0'+';'+correo  ; 
		toggle_account(datos); 
	
		var url = 'save_minifigures.php';
		var method = 'POST';
		var params = 'correo='+correo;
		params += '&action=9';
		var container_id = 'snackbar' ;
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text) ;
	
	}
}
///////////////////////////////////////////////

function active_account(){
	
	var correo = document.getElementById('recupera_email').value;
	var pass = document.getElementById('reset_pass').value; 
	var pass_v = document.getElementById('reset_pass_confirm').value; 
	
	if(pass != pass_v){
		document.getElementById('error_display').innerHTML = '<label class="badge-danger" style="border-radius: 5px; padding: 5px;" > La contraseña no coincide </label> '
	}else{
		
		var url = 'save_minifigures.php';
		var method = 'POST';
		var params = 'correo='+correo;
		params += '&key='+ pass;
		params += '&action=10';
		var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text) ;

		
	}

}


///////////////////////////////////////////////

function toggle_account(parameters){ // parameters = (1;correo) tipo de mov: 1. activa, 0 desactiva; 
	var data = parameters.split(';');
	
	var accion = data[0];
	var correo_code = data[1];
	
		var url = 'save_minifigures.php';
		var method = 'POST';
		var params = 'correo='+correo_code;
		params += '&accion='+ accion;
		params += '&action=11';
		var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text) ;
	
	
}


function check_sesion(usuario){
	
	//alert('check sesion');
	
	if(usuario == 0 && usuario == ""){
		location.replace("index.php?set=0");
	}
	
} 

////////////////////////////////
	function step(div){
	
		document.getElementById('step-1').style.display = 'none';
		document.getElementById('step-2').style.display  = 'none';
		document.getElementById('step-3').style.display  = 'none';
		document.getElementById('step-4').style.display  = 'none';
				
		
		document.getElementById('step-'+div).style.display = 'block';
		
		valida_step(div);

	}

////////////////////////////////


function save_images(){
	
		var serie_code = document.getElementById('no_add').value;
		var total_fig = document.getElementById('figuras_add').value; 
		
		
			if(serie_code==""){
			
					txt_display= 'Introduzca el campo: Clave LEGO'; 
					display_message(txt_display);
					step(1);
			
			}else if(total_fig==0){
		
					txt_display= 'Introduzca el valor para el campo Total de Figuras'; 
					display_message(txt_display);
					step(1);
		
			}else{
	
					var loading = '<i class="fa fa-spinner fa-pulse fa-fw"></i> Subiendo Imágenes...';
					var ready = 'Subir Imagenes';
					//var archivos = document.getElementById("imagenes");
					//var archivo = archivos.files; //Obtenemos los archivos seleccionados en el imput
					//var archivos = new FormData();
					
					//alert(archivo);
					/*
					for(i=0; i<archivo.length; i++){
						archivos.append('imagenes'+i,archivo[i]); //Añadimos cada archivo a el arreglo con un indice direfente
					}
					*/
					
					document.getElementById('btn_upload').innerHTML = loading;
					
					var myForm = document.getElementById('update_image_form');
					var formData = new FormData(myForm);
					
							$.ajax({
								url:'upload.php', //Url a donde la enviaremos
								type:'POST', //Metodo que usaremos
								contentType:false, //Debe estar en false para que pase el objeto sin procesar
								data: formData, //Le pasamos el objeto que creamos con los archivos
								processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
								cache:false //Para que el formulario no guarde cache
							}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
								//MensajeFinal(msg)
								
								
								//alert (msg);
								
								var data = msg.split(';');
								var act = data[0];
								var estado = data[1];
								var msj = data[2];
								var datos = data[3];
								
								
								
								if(estado==0){
									document.getElementById('res_upload_images').value = datos;
									
									document.getElementById('btn_upload').innerHTML = ready;
									document.getElementById("upload_form").style.display = "block";
									var msje = 'Imagenes cargadas con Exito. Ahora puede guardar el formulario.';
									display_message(msje);
									
								}else if(estado==1){
									document.getElementById("upload_form").style.display = "block";
									document.getElementById('btn_upload').innerHTML = ready;
								}
								
									document.getElementById("result_upload").style.display="block";
									document.getElementById("result_upload").innerHTML = msj;
								 
								//display_message(msj);
								//step(4);
							});
					/*
					var url = 'save_minifigures.php';
					var method = 'POST';
					var params = 'archivos='+archivos;
					params += '&serie='+ serie_code;
					params += '&no_fig='+ total_fig;
					params += '&action=12';
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);
					*/
					
					
			}
	
}

///////////////////////////////////////////////

function edita_toggle(div){
	
		document.getElementById('edita_opcion_1').style.display = 'none';
		document.getElementById('edita_opcion_2').style.display  = 'none';
		document.getElementById('edita_opcion_3').style.display  = 'none';
		document.getElementById('edita_opcion_4').style.display  = 'none';
		document.getElementById('edita_opcion_5').style.display  = 'none';
	
		document.getElementById('edita_opcion_'+div).style.display = 'block';
}

///////////////////////////////////////////////

function format_fecha(fecha){
	
	var data = fecha.split('-');
	
	var dia = data[2]; 
	var mes = parseInt(data[1]); 
	var anio = data[0];

	if(anio != '0000'){
		
		var month_txt = new Array();
		  month_txt[1] = "Enero";
		  month_txt[2] = "Febrero";
		  month_txt[3] = "Marzo";
		  month_txt[4] = "Abril";
		  month_txt[5] = "Mayo";
		  month_txt[6] = "Junio";
		  month_txt[7] = "Julio";
		  month_txt[8] = "Agosto";
		  month_txt[9] = "Septiembre";
		  month_txt[10] = "Octubre";
		  month_txt[11] = "Noviembre";
		  month_txt[12] = "Diciembre";
		  
		var fecha_format = dia + ' ' + month_txt[mes] + ' ' +anio;
	}else{
		var fecha_format = 'Fecha No Definida';
	}

return fecha_format;
}

///////////////////////////////////////////////

///////////////////////////////////////////////

function format_fecha_hora(fecha){
	var fecha_format = ''; 

	 var data_f = fecha.split(' ');


// fecha
	var data = data_f[0].split('-');
	
	var dia = data[2]; 
	var mes = parseInt(data[1]); 
	var anio = data[0];

	if(anio != '0000'){
		
		var month_txt = new Array();
		  month_txt[1] = "Enero";
		  month_txt[2] = "Febrero";
		  month_txt[3] = "Marzo";
		  month_txt[4] = "Abril";
		  month_txt[5] = "Mayo";
		  month_txt[6] = "Junio";
		  month_txt[7] = "Julio";
		  month_txt[8] = "Agosto";
		  month_txt[9] = "Septiembre";
		  month_txt[10] = "Octubre";
		  month_txt[11] = "Noviembre";
		  month_txt[12] = "Diciembre";
		  
		fecha_format = dia + ' ' + month_txt[mes] + ' ' +anio + ' @ '+ data_f[1] ;
	}else{
		fecha_format = 'Fecha No Definida';
	}

// hora 



return fecha_format;
}

///////////////////////////////////////////////

function valida_step(step) {
	
	var clave = document.getElementById('no_add').value;
	var total_field = document.getElementById('figuras_add').value;
	var nombres_fig = document.getElementById('nombres_fig_add').value;
	var fields = ''; 
	var num = 0;

	
	switch(step){
		
		case 1: 
		document.getElementById('current_serie').value = clave;
		break; 
		
		case 2: 
		document.getElementById('current_serie').value = clave;

        //var current_s = document.getElementById('current_serie').value;

        
        
		for(i=0;i<total_field;i++){
			num = i+1;

			
			fields += '\
			<div class="row " style="margin:1px 0px;"> \
			    <label class="col-md-1 col-form-label text-muted lbl_form_sm"> '+num+':</label> \
			    <input class="col-sm-4 form-control field_es" id="nom_es_'+num+'" onblur="process_names_field();" placeholder="Nombre en Español" type="text" value=""> &nbsp; \
				<input class="col-sm-4 form-control field_en" id="nom_us_'+num+'" onblur="process_names_field();" placeholder="Nombre en Inglés" type="text" value=""> \
			</div> \
			'; 
		
        
        }


		document.getElementById('fields_figs').innerHTML = fields;

		break;
		
		case 3: 
		document.getElementById('current_serie').value = clave;
			
			if(clave==0 || clave==''){
				display_message('El campo <b>CLAVE LEGO</b> es requerido.');
				
			}else if(total_field==0 || total_field ==''){
				display_message('El campo <b>TOTAL DE FIGURAS</b> es requerido.');
				
			}
		
		
		
		break; 
		
		case 4: 
		document.getElementById('current_serie').value = clave;
		var total_nombres = nombres_fig.length;
		//alert(total_nombres);
		
			if(clave==0 || clave==''){
				display_message('El campo <b>CLAVE LEGO</b> es requerido.');
				
			}else if(total_nombres < 30 ){
				display_message('El campo <b>PERSONAJES</b> debe cotener al menos 10 nombres.');
			}else{
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'serie='+ clave;
				params += '&action=12';
				var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text) ;
					
			}	
				
				break; 
				
				default: 
				break;
			
	}
	
}
///////////////////////////////////////////////

function display_message(mensaje){
	
		container_id = 'snackbar';
		document.getElementById(container_id).innerHTML = mensaje;
		desapear(document.getElementById(container_id));
	
}
///////////////////////////////////////////////

function cambia_foto(id){
	var vals="";
	var count = 0; 
	var nva_foto = document.getElementById('fig_'+id).value;
	var serie = document.getElementById('no_add').value;
	
	var  ruta = '';

if(nva_foto == '0.png'){
	ruta = 'minifig/minifig-d.png'; 
	document.getElementById('img_'+id).src = ruta;
}else if(nva_foto == '99.png'){
	ruta = 'minifig/minifig-a.png'; 
	document.getElementById('img_'+id).src = ruta;
}else{

	ruta = 'minifig/'+serie+'/'+nva_foto; 
	document.getElementById('img_'+id).src = ruta;
	
	var controls = document.getElementsByTagName('card');
	
	//alert(controls.length);
	
		for(i=0; i < controls.length; i++){
			vals += document.getElementById('fig_'+i).value + ';';
			if( document.getElementById('fig_'+i).value != 0 ){
				count += 1;
			}
		}
		document.getElementById('name_asign').value= vals;
	
		if(count == controls.length){
			document.getElementById("guarda_serie").disabled = false;
		}else{
			document.getElementById("guarda_serie").disabled = true;
		}
}

}

///////////////////////////////////////////////

function cambia_foto_edita(id){
	var vals="";
	var count = 0; 
	var nva_foto = document.getElementById('fig_edita_'+id).value;
	var serie = document.getElementById('serie_edita_'+id).value;
	
	var ruta = 'minifig/'+serie+'/'+nva_foto; 
	
	document.getElementById('img_edita_'+id).src = ruta;
	
	var controls = document.getElementsByTagName('card');
	
	//alert(controls.length);
	/*
		for(i=0; i < controls.length; i++){
			vals += document.getElementById('fig_'+i).value + ';';
			if( document.getElementById('fig_'+i).value != 0 ){
				count += 1;
			}
		}
		document.getElementById('name_asign').value= vals;
	
		if(count == controls.length){
			document.getElementById("guarda_serie").disabled = false;
		}else{
			document.getElementById("guarda_serie").disabled = true;
		}
		*/
}

///////////////////////////////////////////////

function save_serie(){
	
	var nombre_serie = document.getElementById('nombre_add').value; 
	var clave_serie = document.getElementById('no_add').value;
	var total_serie = document.getElementById('figuras_add').value;
	var fecha_serie = document.getElementById('fecha_add').value;
	var color_serie = document.getElementById('color_add').value;
	var estado_serie = document.getElementById('estado_add').value;
	var moneda_serie = document.getElementById('moneda_add').value;
	var precio_serie = document.getElementById('precio_add').value;
	var color_rgb = hexToRgb(color_serie).r +','+ hexToRgb(color_serie).g +','+ hexToRgb(color_serie).b;
	
	
	var nombresfig_serie = document.getElementById('nombres_fig_add').value;
	var tipo_serie = document.getElementById('tipo_add').value;
	var asign_serie = document.getElementById('name_asign').value;
	var premium; 
	
	if (document.getElementById('premium_add').checked){
	//alert('checkbox1 esta seleccionado');
		premium = 1; 
	}else{
		premium = 0;
	}
	
	if(nombre_serie==""){
		
		display_message( 'El campo <b>NOMBRE SERIE</b> es requerido.' );
		
	}else if(clave_serie=='' || clave_serie==0){
		
		display_message( 'El campo <b>CLAVE LEGO</b> es requerido.' );
		
	}else if( total_serie =='' || total_serie ==0){
		
		display_message( 'El campo <b>TOTAL DE FIGURAS</b> es requerido.' );
		
	}else if( color_serie ==''){
		
		display_message( 'El campo <b>TOTAL DE FIGURAS</b> es requerido.' );
		
	}else if( nombresfig_serie =='' || nombresfig_serie.length < 30){
		
		display_message( 'El campo <b>FIGURAS</b> es requerido.' );
		
	}else if( tipo_serie ==''){
		
		display_message( 'El campo <b>TIPO SERIE</b> es requerido' );
		
	}else{
	
		if( moneda_serie == 'X'){
		
			moneda_serie = 'USD'; 
		}
		
		if( precio_serie == 0){
			
			precio_serie = 5.00; 
			
		}
		
		// Guarda Serie (TABLA SERIES)
			//var res_reg_serie = pre_save_serie();
		
		// Guarda Minifiguras (TABLA MINIFIGURAS)
			//var res_reg_minifig = pre_save_minifig();
		// Actualiza minifiguras con las fotos
			pre_save_fotos();
		

		var url = 'save_minifigures.php';
		var method = 'POST';
		var params = 'nombre_serie='+ nombre_serie;
		params += '&clave_serie='+ clave_serie;
		params += '&action=98';
		var container_id = 'snackbar' ;
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text) ;
		

	}
	
}




function display_info(){
	var op=0;
	
	op = document.getElementById('accion_marketplace').value;
	//alert(op);
	switch(op){
		
		case '0': 
			descripcion = 'Selecciona una opcion de la lista';
		break; 
		
		case '1':
			descripcion = '<h1>Venta</h1>.<p> Obten un beneficio económico, publicando esta figura en el Marcketplace. </p><p>Opcion Premium</p>'; 
		break; 
		
		case '2': 
			descripcion = '<h1>Intercambio</h1>.<p> Puedes pactar con otro usuario un intercambio de minifiguras que cada uno considere equivalente. Con este opcion no obtienes un beneficio económico. </p> <p>Opcion Premium</p>'; 
		break; 
		
		case '3':
			descripcion = '<h1>Subasta</h1>.<p>¡Ofrece tu minifigura al mejor postor!<br> Ofrece un precio base por un tiempo determinado, y escoge la mejor oferta. </p> <p>Opcion Premium</p>' ; 
		break; 
		
		
	}
	
	document.getElementById('exp_accion').innerHTML = descripcion; 
	
}

///////////

function quick_edit(params){
	
	var data = params.split('-');
	var action = data[0];
	var reg = data[1];
	
	
	switch (action){
		
		case '1': // Guardar serie
			
			
			var fecha= document.getElementById('s_flanzamiento_'+reg).value;
			var nombre= document.getElementById('s_nombre_'+reg).value;
			var color= document.getElementById('s_color_'+reg).value;
			var tipo= document.getElementById('s_tipo_'+reg).value;
			var precio= document.getElementById('s_precio_'+reg).value;
			var moneda= document.getElementById('s_moneda_'+reg).value;
			var descuento= document.getElementById('s_desc_'+reg).value;
			var color_txt= document.getElementById('s_color_txt_'+reg).value;
			var colorb= document.getElementById('s_colorb_'+reg).value;
			
			//alert(color_txt);
			
			var color_rgb = hexToRgb(color).r +','+ hexToRgb(color).g +','+ hexToRgb(color).b;
			var color_rgb_txt = hexToRgb(color_txt).r +','+ hexToRgb(color_txt).g +','+ hexToRgb(color_txt).b;
			var colorb_rgb = hexToRgb(colorb).r +','+ hexToRgb(colorb).g +','+ hexToRgb(colorb).b;
			//alert(color_rgb_txt);
			


			//alert(tipo);
			
			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'item_id='+ reg;
				params += '&flanzamiento='+ fecha;
				params += '&nombre='+ nombre;
				params += '&tipo='+ tipo;
				params += '&precio='+ precio;
				params += '&moneda='+ moneda;
				params += '&desc='+ descuento;
				params += '&color_txt='+ color_rgb_txt;
				params += '&action=15';
				params += '&val='+color_rgb;
				params += '&colorb='+colorb_rgb;
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
			
		break; 
		
		case '2': // Act ó desact serie

			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'item_id='+ reg;
				params += '&estado=0';
				params += '&action=14';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);			
		
	
				
		break; 
		
		case '3': // Eliminar serie
		 
		if(confirm('Confirma que ¿Desea eliminar la SERIE y las MINIFIGURAS asociadas?')){

		var val_master = get_masterpass();		 
				
				if (val_master == 0) {
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
				    	display_message(txte); 
				}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
				}else if (val_master==1) { 	//txt = "Hello " + person + "! How are you today?";
				  	
					  	var serie = document.getElementById('s_serie_'+reg).value;
					  	//alert(serie);
					  	
						var url = 'save_minifigures.php';
						var method = 'POST';
						var params = 'item_id='+ reg;
							params += '&action=16';
							params += '&serie='+serie;		
						var container_id = 'snackbar' ;
						var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
						// llamamos ajax function
						ajax (url, method, params, container_id, loading_text);	
					
					
				}
		}
		
		break;
		
		case '4': // Modo mantenimiento
		  	
			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'item_id='+ reg;
				params += '&estado=2';	
				params += '&action=14';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
		
		break; 
		case '5': // Modo mantenimiento
		  	
			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'item_id='+ reg;
				params += '&estado=3';	
				params += '&action=14';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
		
		break;
		case '6': // Modo Premium (Paga)
		  	
			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'item_id='+ reg;
				params += '&estado=3';	
				params += '&action=47';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
		
		break; 
		case '7': // Modo Draft (estado 99) 
		  	
			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'item_id='+ reg;
				params += '&estado=99';	
				params += '&action=14';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
		
		break; 
					
	}

//	alert(action+' item: '+ reg);
	
	//prompt("Please enter your name:")
	
}

///////////

function quick_edit_user(params){
	
	var data = params.split('-');
	var action = data[0];
	var reg = data[1];
	//var extra = data[2];
	
	
	switch (action){
		
		case '1': // cambia perfil
		
			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'item_id='+ reg;
				params += '&action=17';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
			
		break; 
		
		case '2': // Act ó desact usuario

			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'item_id='+ reg;
				params += '&action=18';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);			
		
	
				
		break; 
		
		case '3': // Reset Pass
		
			var val_master = get_masterpass();
		 
		if (val_master == 0) {
			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La Contraseña Maestra no coincide, intente de nuevo. </span>';
		    	display_message(txte); 
		}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
		}else if (val_master==1) { 	//txt = "Hello " + person + "! How are you today?";

			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'item_id='+ reg;
				params += '&action=19';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
		}
			
		break; 

		case '4': // Eliminar Perfil
		
		var confirma = confirm('¿Confirmas que deseas eliminar este usuario y todos sus colecciones?'); 

			if (confirma == true) {

				var val_master = get_masterpass();
		 
				if (val_master == 0) {
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
						display_message(txte); 
				}else if (val_master==2) { 
							txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
							display_message(txte); 
				}else if (val_master==1) { 	//txt = "Hello " + person + "! How are you today?";
		
					var url = 'save_minifigures.php';
					var method = 'POST';
					var params = 'item_id='+ reg;
						params += '&action=20';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);					
			
				}
			}
		break;
		
		case '5': // Actualizacion de correo, perfil , etc.
		
	var val_master = get_masterpass();
		 
		if (val_master == 0) {
			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
		    	display_message(txte); 
		}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
		}else if (val_master==1) { 	//txt = "Hello " + person + "! How are you today?";
			
			
			var perfil = document.getElementById('user_perfil_'+reg).value;
			var correo = document.getElementById('user_correo_'+reg).value;
			var user = document.getElementById('user_username_'+reg).value;
			
			if(perfil==99){
				txte = '<span class="text-danger"> <i class="fa fa-times" ></i> El nuevo perfil seleccionado no es valido, elija una opción distinta. </span>';
		    	display_message(txte); 
			}else{
		  	
		  	
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'item_id='+ reg;
					params += '&perfil='+perfil;
					params += '&correo='+correo;
					params += '&user='+user;
					params += '&action=54';		
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
			
			
			}
			
		}
		break; 

		case '6': // bannea usuario

			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'item_id='+ reg;
				params += '&action=70';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);			
		
	
				
		break; 		

		case '7': // notificacion activacion 

			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'item_id='+ reg;
				params += '&action=71';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);			
		
	
				
		break; 	
		default:
		break;
				 		
	}
	
}


function get_masterpass(){
	
	var master_token = document.getElementById('user_token').value; 
	var resultado_master ;
	var master = prompt("Introduzca la Contraseña Maestra:", "");
		 
		 var master_code = MD5(master); 
		 
		
		if (master_token == 'blocked') {
			
			resultado_master = 2; 
			
		}else if (master_code == null || master_code == "") {
			
			resultado_master = 0; 
			
		}else if(master_code != master_token){
			
			resultado_master = 0; 
			
		}else if (master_code == master_token) {
			resultado_master = 1;
		}
		
		return resultado_master;
	
}

////////////////

function get_dir_sepomex(){
	 var cp_buscar = document.getElementById('dir_cp').value; 
	 
	 var cp_largo = cp_buscar.length; 
	 
	 if( cp_largo >= 5 ){

			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'cp='+ cp_buscar;
				params += '&action=21';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	

	 }
	 
	 
	
	
}

/////////////////

function save_direccion(){
	
	var id_user = document.getElementById('dir_id_user').value;
	var calle = document.getElementById('dir_calle').value;
	var no_int = document.getElementById('dir_no_int').value;
	var no_ext = document.getElementById('dir_no_ext').value;
	var cp = document.getElementById('dir_cp').value;
	var colonia = document.getElementById('dir_colonia').value;
	var delegacion = document.getElementById('dir_del').value;
	var estado = document.getElementById('dir_estado').value;
	//var nombre = document.getElementById('nombre').value;
	//var apellido = document.getElementById('apellido').value;
	//var f_nac = document.getElementById('f_nac').value;
	
	if(calle== ""){
		display_message('Ingresa Nombre de la calle');
	}else if( no_ext=="" ){
		display_message('Ingresa No Exterior');
	}else if( cp=="" ){
		display_message('Ingresa Código Postal');
	}else if( colonia == "X" ){
		display_message('Elije una Colonia');
	}else{
		
		
			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id_user='+ id_user;
				params += '&calle='+ calle;
				params += '&no_int='+ no_int;
				params += '&no_ext='+ no_ext;
				params += '&cp='+ cp;
				params += '&colonia='+ colonia;
				params += '&delegacion='+ delegacion;
				params += '&estado='+ estado;
				params += '&action=22';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
		
		
		
	}
}

/////////////////


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


  function mostrarContrasena(id){
      var tipo = document.getElementById(id);
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }
  
  
  function save_menu_bk(id){
	  
	  var clave = document.getElementById('cve_'+id).value; 
	  var file = document.getElementById('file_'+id).value;
	  var id_padre = document.getElementById('id_padre_'+id).value;
	  var title = document.getElementById('title_'+id).value;
	  var id_p_o = document.getElementById('id_padre_original_'+id).value;
	  var nivel = document.getElementById('nivel_'+id).value;
	  var icono = document.getElementById('icon_'+id).value;
	  var orden = document.getElementById('orden_'+id).value;
	  var color = document.getElementById('color_'+id).value;
	  var tipo = document.getElementById('tipo_'+id).value;

	  var color_rgb = hexToRgb(color).r +','+ hexToRgb(color).g +','+ hexToRgb(color).b;

	  if(id_padre==999){
		 // alert('Seleccione un Nodo Padre');
		  		id_p = id_p_o; 
	  }else{
	  
	  			id_p = id_padre;
	  			
			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;
				params += '&clave='+ clave;
				params += '&file='+ file;
				params += '&title='+ title;
				params += '&id_padre='+ id_p;
				params += '&nivel='+ nivel;
				params += '&icono='+ icono;
				params += '&orden='+ orden;
				params += '&tipo='+ tipo;
				params += '&color='+ color_rgb;
				params += '&action=25';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
	}
  }
  
  function save_menu(id){
	  
	var clave = document.getElementById('cve_mnu').value; 
	var file = document.getElementById('file_mnu').value;
	var id_padre = document.getElementById('id_padre_mnu').value;
	var title = document.getElementById('title_mnu').value;
	//var id_p_o = 0;
	var nivel = document.getElementById('nivel_mnu').value;
	var icono = document.getElementById('icon_mnu').value;
	var orden = document.getElementById('orden_mnu').value;
	var color = document.getElementById('color_mnu').value;
	var tipo = document.getElementById('tipo_mnu').value;
	var id_p = 0;

	var color_rgb = hexToRgb(color).r +','+ hexToRgb(color).g +','+ hexToRgb(color).b;

	if(id_padre==999){
	   // alert('Seleccione un Nodo Padre');
				id_p = 0;
	}else{
	
				id_p = id_padre;
				
		  var url = 'save_minifigures.php';
		  var method = 'POST';
		  var params = 'id='+ id;
			  params += '&clave='+ clave;
			  params += '&file='+ file;
			  params += '&title='+ title;
			  params += '&id_padre='+ id_p;
			  params += '&nivel='+ nivel;
			  params += '&icono='+ icono;
			  params += '&orden='+ orden;
			  params += '&tipo='+ tipo;
			  params += '&color='+ color_rgb;
			  params += '&action=25';		
		  var container_id = 'snackbar' ;
		  var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		  // llamamos ajax function
		  ajax (url, method, params, container_id, loading_text);	
  }
}
  
    function crear_menu(id){
	  
	 // var clave = document.getElementById('cve_new').value; 
	  
	  var padre = document.getElementById('padre_new').value;
	  var tipo = document.getElementById('tipo_new').value;
	  var title = document.getElementById('title_new').value;
	  var nivel = document.getElementById('nivel_new').value;
	  var file = '';
	  var link = '';
	 
	if(tipo == 0){
		file = document.getElementById('file_new').value;
		link = file +'.php';
	}else if(tipo == 1){
		file = document.getElementById('fx_new').value;
		link = file;
	}else if(tipo == 2){
		file = document.getElementById('btn_new').value;
		link = file;
	}else if(tipo == 3){
		file = document.getElementById('link_new').value;
		link = file;
	}
	 
	 
	  
	if(file==""){
		 alert('Introduzca el nombre de archivo, sin extensión');
	}else if(padre== 999 ){
	  	alert('Seleccione un NodoP');
	}else if(title==""){
		  alert('Introduzca in Titulo para el menu');
	}else{
		  
		  	 var cve = MD5(file);
			 var nombre = file; 
	 
	  				  			
			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;
				params += '&clave='+ cve;
				params += '&link='+ link;
				params += '&nombre='+ nombre;
				params += '&file='+file;
				params += '&title='+title;
				params += '&nivel='+nivel;
				params += '&tipo='+tipo;
				params += '&id_padre='+padre;				
				params += '&action=26';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
	}
  }
  ///////////////////////////
  
  function actualiza_foto(data_foto){
	  
	  var data = data_foto.split(';');
	  
	  var id= data[0];
	  var foto = data[1];
	  
			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;
				params += '&foto='+ foto;				
				params += '&action=52';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);		  
	  
	  
  }
  /////////////////////////////////////
  
  
  function estado_menu(id){
	  
	 		var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;				
				params += '&action=27';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
	  
  }
  
    function elimina_menu(id){
	  
	  
	  var val_master = get_masterpass();
		 
		if (val_master == 0) {
			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
		    	display_message(txte); 
		}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
		}else if (val_master==1) {
			
	 		var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;				
				params += '&action=28';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
		}
	  
  }


function toy(){
	
	var tot = 10; 
	var res = ''; 
	
	for(j=0;j<tot; j++){
		for(i=0;i<tot; i++){
			res += '*'; 
			
			
		}
		res+= '<br>';
	}
	
	document.getElementById('res').innerHTML += res; 
}


function sound(tipo){
	if(tipo==1){

		var audio = new Audio('media/success.mp3');
		audio.play();
	}else if(tipo==2){

		var audio = new Audio('media/adv.mp3');
		audio.play();
	}else if(tipo==3){
		var audio = new Audio('media/error.mp3');
		audio.play();
	}else if(tipo==4){
		var audio = new Audio('media/ta-da.mp3');
		audio.play();
	}else if(tipo==5){
		var audio = new Audio('media/trash.mp3');
		audio.play();
	}else if(tipo==6){
		var audio = new Audio('media/pop.mp3');
		audio.play(); 
	}else if(tipo==7){
		var audio = new Audio('media/in.mp3');
		audio.play(); 
	}else if(tipo==8){
		var audio = new Audio('media/out.mp3');
		audio.play(); 
	}
}

function snownow(){
	snowStorm.snowColor = '#e1e1e1';   // blue-ish snow!?
	snowStorm.flakesMaxActive = 1000;    // show more snow on screen at once
	snowStorm.useTwinkleEffect = false
	snowStorm.followMouse = false;
	snowStorm.freezeOnBlur = true;
	snowStorm.snowCharacter = '•';
	snowStorm.snowStick = true;
}

function getSetInfo(id){
	
			var id_user = document.getElementById('user_id').value; 

	 		var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;
				params += '&user_id='+ id_user;				
				params += '&action=29';		
			var container_id = 'snackbar';
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	

}


function save_set(){
	
	//alert(id); 
	
			var id_user = document.getElementById('user_id').value;  
			var cve = document.getElementById('set_cve').value;
			var nombre = document.getElementById('set_nombre').value;
			var tema = document.getElementById('set_tema').value ;
			var piezas = document.getElementById('set_piezas').value; 	
			var precio = document.getElementById('set_precio').value;
			var anio = document.getElementById('set_anio').value;
			var id = document.getElementById('set_id').value;
			var foto = document.getElementById('set_foto').value;
			var origen = document.getElementById('set_origen').value;
			var minifigs = document.getElementById('set_minifig').value;
			var cantidad = document.getElementById('set_cantidad').value;
			var edo_col= document.getElementById('set_edo_col').value;
			var edo_presenta = document.getElementById('set_presentacion').value;
			var codebar_box = document.getElementById('set_codebar_box').value;
			
			//alert(tema);
			
			
			var data_tem = tema.split('--');
			var id_tema = data_tem[0];
			var foto_tema = data_tem[1];
			
	 		var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;
				params += '&id_user='+ id_user;	
				params += '&cve='+ cve;	
				params += '&nombre='+ nombre;
				params += '&tema='+ tema;
				params += '&piezas='+ piezas;
				params += '&precio='+ precio;
				params += '&anio='+ anio;
				params += '&foto='+ foto;
				params += '&origen='+ origen;
				params += '&minifigs='+ minifigs;
				params += '&cantidad='+ cantidad;
				params += '&edo_col='+ edo_col;
				params += '&edo_presenta='+ edo_presenta;
				params += '&codebar_box='+ codebar_box;
				params += '&action=30';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
		
	
}


function quick_edit_tema(params){
	
	var data = params.split('-');
	var action = data[0];
	var reg = data[1];
	//var extra = data[2];
	
	
	switch (action){
		
		case '1': // Guardar Tema	
		
			var nombre= document.getElementById('tema_nombre_'+reg).value;
			var color= document.getElementById('tema_color_'+reg).value;
			var colorb= document.getElementById('tema_color_b_'+reg).value;
			var colorc= document.getElementById('tema_color_txt_'+reg).value;
			var logo= document.getElementById('tema_logo_'+reg).value;
			
			var color_rgb = hexToRgb(color).r +','+ hexToRgb(color).g +','+ hexToRgb(color).b;
			var color_rgb_b = hexToRgb(colorb).r +','+ hexToRgb(colorb).g +','+ hexToRgb(colorb).b;
			var color_rgb_c = hexToRgb(colorc).r +','+ hexToRgb(colorc).g +','+ hexToRgb(colorc).b;
			//alert(color_rgb);
			
			if(logo == 0){
				display_message('Selecciona un logo valido');
			}else{
			
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'item_id='+ reg;
					params += '&nombre='+ nombre;
					params += '&logo='+ logo;
					params += '&action=33'; //15
					params += '&val='+color_rgb;
					params += '&valb='+color_rgb_b;
					params += '&valc='+color_rgb_c;
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
			}
			
		break; 
		
		case '2': // Act ó desact 

			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'item_id='+ reg;
				params += '&action=31';		// 18
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);			
				
		break; 
		
		case '3': // Reset Pass
		break; 

		case '4': // Eliminar
		
			var val_master = get_masterpass();
		

			if (val_master == 0) {
				txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
			    	display_message(txte); 
			}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
			}else if (val_master==1) { 	//txt = "Hello " + person + "! How are you today?";
			  	
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'item_id='+ reg;
					params += '&action=32';		//20
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
				
			}
			
		break; 		
	}

}


function gen_foto_name(){

	var name_set = document.getElementById('new_set_cve').value; 
	
	document.getElementById('new_set_foto').value = name_set + '.png'; 
	
}


function save_new_set(){
	
			var id_user = document.getElementById('user_id').value;  
			var cve = document.getElementById('new_set_cve').value;
			var nombre = document.getElementById('new_set_nombre').value;
			var tema = document.getElementById('new_set_tema').value ;
			var piezas = document.getElementById('new_set_piezas').value; 	
			var precio = document.getElementById('new_set_precio').value;
			var anio = document.getElementById('new_set_anio').value;
			var minifig = document.getElementById('new_set_minifig').value;
			var foto = document.getElementById('new_set_foto').value;
			var cantidad = document.getElementById('new_set_cantidad').value;
			var estado_col_set = document.getElementById('new_estado_col').value;
			var origen = document.getElementById('nvo_origen').value;
			var codebar_box = document.getElementById('new_set_codebar_box').value;
			var aniob; 
			var fotob; 
			var piezasb; 
			var preciob;
			var minifigb;
			var men;
			var container = 'new_set_status'; 
			
			var nom_len = nombre.length;
			//alert(tema);

				origen = 0;
			
			//var barra_status = document.getElementById('new_set_status'); 
			if(cve == ''){
			
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Ingresa la CLAVE LEGO para el set. </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
				
			}else if( nombre== '' || nom_len < 3 ){
				
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Ingresa un NOMBRE valido para el set. </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
				
			}else if( tema== 0 ){
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Selecciona un TEMA para el set.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
			}else if( foto== '' ){
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Carga un archivo PNG / JPG  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
			}else if( estado_col_set==99 ){
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Seleccione estado  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
			}else{
				
			if(anio ==''){
				aniob = '0000';
			}else{
				aniob = document.getElementById('new_set_anio').value;
			}
			
			if(foto == '' ){
				fotob = 'cover_logo.png'; 
			}else{
				fotob = document.getElementById('new_set_foto').value;
			}

			if(piezas == '' ){
				piezasb = 0; 
			}else{
				piezasb = document.getElementById('new_set_piezas').value;
			}

			if(precio == '' ){
				preciob = 0; 
			}else{
				preciob = document.getElementById('new_set_precio').value;
			}


			if(minifig == '' ){
				minifigb = 0; 
			}else{
				minifigb = document.getElementById('new_set_minifig').value;
			}
			
			var data_tem = tema.split('--');
			var id_tema = data_tem[0];
			var foto_tema = data_tem[1];
			
	 		var url = 'save_minifigures.php';
			var method = 'POST';
			//var params = 'id='+ id;
			var params = 'id_user='+ id_user;	
				params += '&cve='+ cve;	
				params += '&nombre='+ nombre;
				params += '&tema='+ id_tema;
				params += '&piezas='+ piezasb;
				params += '&precio='+ preciob;
				params += '&anio='+ aniob;
				params += '&foto='+ fotob;
				params += '&figs='+ minifigb;
				params += '&origen='+ origen;
				params += '&cantidad='+ cantidad;
				params += '&estado_set='+estado_col_set
				params += '&codebar_box'+codebar_box
				params += '&action=34';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
	
	}
	
}


function elimina_set(id){
	
	var id_user = document.getElementById('user_id').value;
	var id_final; 
	
	//alert(foto);
	
	if(id==""){
		id_final = document.getElementById('set_id').value; 
	}else{
		id_final = id; 
	}
	
	var fotoe = document.getElementById('foto_set_'+id_final).value;
	//alert(fotoe); 
	
			var confirma = confirm('¿Confirmas que deseas eliminar este set?'); 
		//alert(confirma); 
	
	
			//var val_master = get_masterpass();
			 
			if (confirma == true) {
			 	//txt = "Hello " + person + "! How are you today?";
			  	
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'item_id='+ id_final;
					params += '&id_user=' + id_user;		//32
					params += '&fotoe='+fotoe; 
					params += '&action=35';		//32
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
				
			}

}


function save_foto(tipo){ 
	
	/* 
		1. perfil / 
		2. Nuevo Set / 
		3. tema logo / 
		4. edita set / 
		5. Nva Minifigura /
		6. Nva Minifigura /
		7. Nva Minifigura /
		8. Portada Serie / 
		9. Folleto Serie/ 
		10. Caja Serie/ 
		11. Empaque Serie / 
		12. fondo Serie
		
		*/
	
//try{
	var form ; 
	var btn_id; 
	var cve; 
	var bandera_sube; 
	var image_nva; 
	var container ; 
	var men; 
	var id_user;
	
	switch(tipo){
		
		case 1: 

			 form = 'form_up_perfil';
			 btn_id = 'btn_up_foto_perfil';
			 container = 'snackbar'; 
			
			 id_user = document.getElementById('id_user_perfil').value;
			 image_nva = document.getElementById('foto_perfil').value;
			 
			if(image_nva == ""){
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Cargue un archivo JPG / PNG.  </span>'; 
				document.getElementById(container).innerHTML = men;
			
				desapear(document.getElementById(container));
				bandera_sube = 0;
			}else{
				bandera_sube = 1;
				//alert('A');
			}
			
		break; 
		
		case 2: 
		
        document.getElementById('display_imgs').innerHTML = '<div class="col-md-12 center"><span class="text-primary" style="font-size:1rem; margin-top:20px;"> <i class="fa-solid  fa-spinner fa-spin-pulse"></i> Actualizando...</span></div>';


			 form = 'form_up_set';
			 btn_id = 'btn_up_foto';
			 container = 'new_set_status'; 
			
			 cve = document.getElementById('new_set_cve').value;
			 image_nva = document.getElementById('foto').value;
			 
			if(cve == ""){		 
				
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Ingresa la CLAVE LEGO del set.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container)); 
				
				//alert('Ingrese la clave del Set');
				document.getElementById('new_set_cve').focus(); 
				bandera_sube = 0;
				
			}else if(image_nva == ""){
				// alert('Cargue un archivo JPG / PNG');
				//document.getElementById('set_cve').focus(); 
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Cargue un archivo JPG / PNG.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
				bandera_sube = 0;
			}else{
				bandera_sube = 1;
			}
			//alert('Sube set');
		break; 

		case 22:  
		
        document.getElementById('display_imgs').innerHTML = '<div class="col-md-12 center"><span class="text-primary" style="font-size:1rem; margin-top:20px;"> <i class="fa-solid  fa-spinner fa-spin-pulse"></i> Actualizando...</span></div>';


		form = 'form_up_set_n';
		btn_id = 'btn_up_foto_n';
		container = 'new_set_status'; 
	   
		//cve = document.getElementById('new_set_cve_n').value;
		image_nva = document.getElementById('foto_n').value;

		var nom = ''; 
		var data_nom = image_nva.split('\\');

		var real = parseInt(data_nom.length-1);

		nom = data_nom[real];

		var data_foto = nom.split('.');
		cve= data_foto[0];
		var ext = data_foto[1];

		cve= cve.replace(' ','');

		document.getElementById('new_set_cve_n').value= cve;

		//cve='';
		
	   if(cve == ""){		 
		   
		   men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Ingresa la CLAVE LEGO del set.  </span>'; 
		   document.getElementById(container).innerHTML = men;
		   desapear(document.getElementById(container)); 
		   
		   //alert('Ingrese la clave del Set');
		   //document.getElementById('new_set_cve').focus(); 
		   bandera_sube = 0;
		   
	   }else if(image_nva == ""){
		   // alert('Cargue un archivo JPG / PNG');
		   //document.getElementById('set_cve').focus(); 
		   men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Cargue un archivo </span>'; 
		   document.getElementById(container).innerHTML = men;
		   desapear(document.getElementById(container));
		   bandera_sube = 0;
	   }else{
		   bandera_sube = 1;
	   }
	   //alert('Sube set');
   		break; 

		case 3:
			 form = 'form_up_tema_set';
			 btn_id = 'btn_up_foto_tema';
			 container = 'new_tema_status'; 
			
			 var nombre = document.getElementById('new_tema_set_nombre').value;
			 image_nva = document.getElementById('foto_tema').value;
			 
			if(nombre == ""){
				
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Ingresa el nombre del Tema </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container)); 				
				//alert('Ingrese la clave del Set');
				document.getElementById('new_tema_set_nombre').focus();
				bandera_sube = 0;
				
			}else if(image_nva == ""){
				// alert('Cargue un archivo JPG / PNG');
				//document.getElementById('set_cve').focus(); 
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Seleccione el logo del tema en formato JPG / PNG.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
				bandera_sube = 0;
			}else{
				bandera_sube = 1;
			}
			//alert('Sube set');		
		break; 
		
		case 4:

			form = 'form_up_set_edita'; //form_up_set_edita
			btn_id = 'btn_up_foto_edita';
			container = 'set_status';
			
			cve = document.getElementById('set_cve').value;
			image_nva = document.getElementById('foto_edita').value;
			
			if(cve == ""){
				
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Ingresa la CLAVE LEGO del set.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container)); 				
				//alert('Ingrese la clave del Set');
				document.getElementById('set_cve').focus();
				bandera_sube = 0;
				
			}else if(image_nva == ""){
				//alert('Cargue un archivo JPG / PNG');
				//document.getElementById('set_cve').focus(); 
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Cargue un archivo JPG / PNG.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
				bandera_sube = 0;
			}else{
				bandera_sube = 1;
			}
			
			
		break; 
		case 5:

			form = 'form_up_minifigure'; //form_up_set_edita
			btn_id = 'btn_up_foto_minifigure';
			container = 'new_minifigure_status';
			
			cve = document.getElementById('new_minifigure_cve').value;
			image_nva = document.getElementById('foto_minifigure').value;
			
			if(cve == ""){
				
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-warning"> <i class="fa fa-times"> </i> Ingresa la CLAVE LEGO del set.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container)); 				
				//alert('Ingrese la clave del Set');
				document.getElementById('set_cve').focus();
				bandera_sube = 0;
				
			}else if(image_nva == ""){
				//alert('Cargue un archivo JPG / PNG');
				//document.getElementById('set_cve').focus(); 
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-warning"> <i class="fa fa-times"> </i> Cargue un archivo JPG / PNG.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
				bandera_sube = 0;
			}else{
				bandera_sube = 1;
			}
			
			
		break;

		case 6:

			form = 'form_up_minifig'; //form_up_set_edita
			btn_id = 'btn_up_foto_minifig';
			container = 'admin_minifigure_status';
			
			cve = document.getElementById('serie_minifig').value;
			image_nva = document.getElementById('foto_minifig').value;
			
			if(cve == ""){
				
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-warning"> <i class="fa fa-times"> </i> No se ha especificado una serie </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container)); 				
				//alert('Ingrese la clave del Set');
				document.getElementById('set_cve').focus();
				bandera_sube = 0;
				
			}else if(image_nva == ""){
				//alert('Cargue un archivo JPG / PNG');
				//document.getElementById('set_cve').focus(); 
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-warning"> <i class="fa fa-times"> </i> Seleccione un archivo JPG / PNG.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
				bandera_sube = 0;
			}else{
				bandera_sube = 1;
			}
			
		break;	

		case 7:
			 form = 'form_up_logo';
			 btn_id = 'btn_up_foto_logo';
			 container = 'admin_logo_status'; 
			
			 //var nombre = document.getElementById('new_tema_set_nombre').value;
			 image_nva = document.getElementById('foto_logo').value;
			 
			if(image_nva == ""){
				// alert('Cargue un archivo JPG / PNG');
				//document.getElementById('set_cve').focus(); 
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Seleccione el logo del tema en formato JPG / PNG.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
				bandera_sube = 0;
			}else{
				bandera_sube = 1;
			}
			//alert('Sube set');		
		break; 
		
		case 8: // portada

			form = 'form_up_portada'; //form_up_set_edita
			btn_id = 'btn_up_foto_portada';
			container = 'images_serie_status';
			
			cve = document.getElementById('imagenes_serie').value;
			image_nva = document.getElementById('foto_portada').value;
			
			if(cve == ""){
				
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-warning"> <i class="fa fa-times"> </i> No se ha especificado una serie </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container)); 				
				//alert('Ingrese la clave del Set');
				bandera_sube = 0;
				
			}else if(image_nva == ""){
				//alert('Cargue un archivo JPG / PNG');
				//document.getElementById('set_cve').focus(); 
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-warning"> <i class="fa fa-times"> </i> Seleccione un archivo JPG / PNG.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
				bandera_sube = 0;
			}else{
				bandera_sube = 1;
			}
				
		break; 
		case 9: // folleto

			form = 'form_up_folleto'; //form_up_set_edita
			btn_id = 'btn_up_foto_folleto';
			container = 'images_serie_status';
			
			cve = document.getElementById('imagenes_serie').value;
			image_nva = document.getElementById('foto_folleto').value;
			
			//alert(image_nva);
			
			if(cve == ""){
				
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-warning"> <i class="fa fa-times"> </i> No se ha especificado una serie </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container)); 				
				//alert('Ingrese la clave del Set');
				bandera_sube = 0;
				
			}else if(image_nva == ""){
				//alert('Cargue un archivo JPG / PNG');
				//document.getElementById('set_cve').focus(); 
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-warning"> <i class="fa fa-times"> </i> Seleccione un archivo JPG / PNG.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
				bandera_sube = 0;
			}else{
				bandera_sube = 1;
			}
				
		break; 
		
		case 10: // caja

			form = 'form_up_caja'; //form_up_set_edita
			btn_id = 'btn_up_foto_caja';
			container = 'images_serie_status';
			
			cve = document.getElementById('imagenes_serie').value;
			image_nva = document.getElementById('foto_caja').value;
			
			if(cve == ""){
				
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-warning"> <i class="fa fa-times"> </i> No se ha especificado una serie </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container)); 				
				//alert('Ingrese la clave del Set');
				bandera_sube = 0;
				
			}else if(image_nva == ""){
				//alert('Cargue un archivo JPG / PNG');
				//document.getElementById('set_cve').focus(); 
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-warning"> <i class="fa fa-times"> </i> Seleccione un archivo JPG / PNG.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
				bandera_sube = 0;
			}else{
				bandera_sube = 1;
			}
				
		break; 

		case 11: // Empaque

			form = 'form_up_empaque'; //form_up_set_edita
			btn_id = 'btn_up_foto_empaque';
			container = 'images_serie_status';
			
			cve = document.getElementById('imagenes_serie').value;
			image_nva = document.getElementById('foto_empaque').value;
			
			if(cve == ""){
				
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-warning"> <i class="fa fa-times"> </i> No se ha especificado una serie </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container)); 				
				//alert('Ingrese la clave del Set');
				bandera_sube = 0;
				
			}else if(image_nva == ""){
				//alert('Cargue un archivo JPG / PNG');
				//document.getElementById('set_cve').focus(); 
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-warning"> <i class="fa fa-times"> </i> Seleccione un archivo JPG / PNG.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
				bandera_sube = 0;
			}else{
				bandera_sube = 1;
			}
				
		break; 		
		case 12: // fondo

			form = 'form_up_fondo'; //form_up_set_edita
			btn_id = 'btn_up_foto_fondo';
			container = 'images_serie_status';
			
			cve = document.getElementById('imagenes_serie').value;
			image_nva = document.getElementById('foto_fondo').value;
			
			if(cve == ""){
				
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-warning"> <i class="fa fa-times"> </i> No se ha especificado una serie </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container)); 				
				//alert('Ingrese la clave del Set');
				bandera_sube = 0;
				
			}else if(image_nva == ""){
				//alert('Cargue un archivo JPG / PNG');
				//document.getElementById('set_cve').focus(); 
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-warning"> <i class="fa fa-times"> </i> Seleccione un archivo JPG / PNG.  </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
				bandera_sube = 0;
			}else{
				bandera_sube = 1;
			}
				
		break;
									
		default:  
		break;
	}
	
	
	//
				if(bandera_sube==1){
					var loading = '<i class="fa fa-spinner fa-fw"></i> Cargando... ';
					var ready = '<i class="fa fa-arrow-circle-up"></i> Subir';
					
					document.getElementById(btn_id).innerHTML = loading;
					
					var myForm = document.getElementById(form);
					//alert(form);
					var formData = new FormData(myForm);
					
					//alert(form);
							$.ajax({
								url:'upload_general.php', //Url a donde la enviaremos
								type:'POST', //Metodo que usaremos
								contentType:false, //Debe estar en false para que pase el objeto sin procesar
								data: formData, //Le pasamos el objeto que creamos con los archivos
								processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
								cache:false //Para que el formulario no guarde cache
							}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
								//MensajeFinal(msg)
								
								//alert(msg); 
								//alert (msg);
								
								var data = msg.split(';');
								var act = data[0];
								var estado = data[1];
								var msj = data[2];
								var datos = data[3];
								var tipo = parseInt(data[4]);
								
								var cover = ' <div class="col-lg-12 cover_image border" ></div>'; 
								switch(tipo){
									
									case 1: 
									
									//3;0;<img src="assets/images/faces/profile/face2_.png"  class="result_image_set" style="height:200px" >;face2_.png;1
									
										container = 'snackbar';
										if(estado==0){
											//document.getElementById('new_minifigure_foto').value = datos;
											//document.getElementById('prev_image_minifig').innerHTML = msj;
											document.getElementById(btn_id).innerHTML = ready;
											//var msje = 'Imagen de perfil cargada con éxito.';
											//display_message(msje);
											//var men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-check"> </i> Imagen cargada con exito. </span>'; 
											//document.getElementById(container).innerHTML = men;
																					
											//desapear(document.getElementById(container));
											
											var id_user_res = document.getElementById('id_user_perfil').value;
											//alert(id_user_res);
											
											var datos_res = id_user_res +';'+ datos;
											actualiza_foto(datos_res);
											
										}else if(estado==1){
											document.getElementById(btn_id).innerHTML = ready;
										}									
									break; 
									
									case 2:
									
										container = 'new_set_status';
										
										if(estado==0){
											//document.getElementById('new_set_foto').value = datos;
											//document.getElementById('prev_image').innerHTML = msj;
											document.getElementById('display_image_set_admin').innerHTML = msj;
											
											//document.getElementById(btn_id).innerHTML = ready;
											//var msje = 'Imagen cargada con exito, ahora puede guardar el nuevo set';
											
											men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-check"> </i> Imagen cargada con exito, ahora puede guardar el nuevo set  </span>'; 
											document.getElementById(container).innerHTML = men;
											desapear(document.getElementById(container));
				
											//display_message(msje);
											
										}else if(estado==1){
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('prev_image').innerHTML = '';
											document.getElementById('prev_image').innerHTML = msj;
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('new_set_foto').value = datos;
											
											
										}

                                        document.getElementById(btn_id).innerHTML = 'Subir';
                                        document.getElementById('foto').value = '';
										document.getElementById('foto_name_edit').disabled = false;
										document.getElementById('foto_name_edit').value = datos;
                                        document.getElementById('new_set_cve').value = 0;
                                        
										
										//location.reload(1000);
                                        lista_fotos_sets();
											
									break; 
									case 22:
									
										container = 'new_set_status';
										
										if(estado==0){
											//document.getElementById('new_set_foto').value = datos;
											//document.getElementById('prev_image').innerHTML = msj;
											document.getElementById('display_image_set_admin').innerHTML = msj;
											
											//document.getElementById(btn_id).innerHTML = ready;
											//var msje = 'Imagen cargada con exito, ahora puede guardar el nuevo set';
											
											men = '<span class="text-success" style="font-size:0.8rem; border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-check"> </i> Imagen cargada con éxito </span>'; 
											document.getElementById(container).innerHTML = men;
											desapear(document.getElementById(container));
				
											//display_message(msje);
											
										}else if(estado==1){
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('prev_image').innerHTML = '';
											document.getElementById('prev_image').innerHTML = msj;
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('new_set_foto_n').value = '';
											
										}
										document.getElementById(btn_id).innerHTML = 'Subir';
										document.getElementById('foto_n').value = '';
										document.getElementById('foto_name_edit').value = datos;
										document.getElementById('foto_name_edit').disabled = false;

                                        // Carga nuevamente la lista de imagenes

                                        lista_fotos_sets();
										
										//location.reload(1000);
											
									break; 									
									case 3:
										container = 'new_tema_status';
										
										if(estado==0){
											document.getElementById('new_tema_set_logo').value = datos;
											document.getElementById('prev_image_tema').innerHTML = msj;
											document.getElementById(btn_id).innerHTML = ready;
											//var msje = 'Imagen cargada con exito, ahora puede guardar el nuevo set';
											
											men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-check"> </i> Imagen cargada con exito, ahora puede guardar el nuevo tema </span>'; 
											document.getElementById(container).innerHTML = men;
											desapear(document.getElementById(container));
				
											//display_message(msje);
											
										}else if(estado==1){
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('prev_image_tema').innerHTML = '';
											document.getElementById('prev_image_tema').innerHTML = msj;
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('new_tema_foto').value = datos;
										}
										
									break; 
									
									case 4: // imagen de set
									
										container = 'set_status';
										if(estado==0){
											document.getElementById('set_foto').value = datos;
											document.getElementById('display_image_set').innerHTML = cover + msj;
											document.getElementById(btn_id).innerHTML = ready;
											//var msje = 'Imagen cargada con exito, ahora puede guardar el set';
											//display_message(msje);
											men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-check"> </i> Imagen cargada con exito, ahora puede guardar el set. </span>'; 
											document.getElementById(container).innerHTML = men;
											desapear(document.getElementById(container));
											
										}else if(estado==1){
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('display_image_set').innerHTML = '';
											document.getElementById('display_image_set').innerHTML = cover+ msj;
											document.getElementById('set_foto').value = datos;
										}
										
									break; 

									case 5: //nueva minifigura
									
										container = 'new_minifigure_status';
										if(estado==0){
											document.getElementById('new_minifigure_foto').value = datos;
											document.getElementById('prev_image_minifig').innerHTML = msj;
											document.getElementById(btn_id).innerHTML = ready;
											//var msje = 'Imagen cargada con exito, ahora puede guardar el set';
											//display_message(msje);
											men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-check"> </i> Imagen cargada con exito. </span>'; 
											document.getElementById(container).innerHTML = men;
											desapear(document.getElementById(container));
											
										}else if(estado==1){
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('prev_image_minifig').innerHTML = '';
											document.getElementById('prev_image_minifig').innerHTML = msj;
											document.getElementById('new_minifigure_foto').value = datos;
										}
									break; 

									case 6: //administra imagenes minifig
									
										container = 'admin_minifigure_status';
										if(estado==0){
											//document.getElementById('new_minifigure_foto').value = datos;
											document.getElementById('prev_image_minifig_admin').innerHTML = msj;
											document.getElementById(btn_id).innerHTML = ready;
											//var msje = 'Imagen cargada con exito, ahora puede guardar el set';
											//display_message(msje);
											men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-check"> </i> Imagen cargada con exito. </span>'; 
											document.getElementById(container).innerHTML = men;
											desapear(document.getElementById(container));
											
											document.getElementById('foto_minifig').value = '';
											document.getElementById('hold_subir_imagen').style.display = 'none';
										}else if(estado==1){
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('prev_image_minifig_admin').innerHTML = '';
											document.getElementById('prev_image_minifig_admin').innerHTML = msj;
											//document.getElementById('new_minifigure_foto').value = datos;
										}
										
										var series = document.getElementById('serie_fotos_admin').value;
										get_list_fotos(series);
										
									break; 									

									case 7: //administra imagenes minifig
									
										container = 'admin_logo_status';
										if(estado==0){
											//document.getElementById('new_minifigure_foto').value = datos;
											document.getElementById('prev_image_logo_admin').innerHTML = msj;
											document.getElementById(btn_id).innerHTML = ready;
											//var msje = 'Imagen cargada con exito, ahora puede guardar el set';
											//display_message(msje);
											men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-check"> </i> Logo cargado con exito. </span>'; 
											document.getElementById(container).innerHTML = men;
											desapear(document.getElementById(container));
											
										}else if(estado==1){
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('prev_image_logo_admin').innerHTML = '';
											document.getElementById('prev_image_logo_admin').innerHTML = msj;
											//document.getElementById('new_minifigure_foto').value = datos;
										}
										
										//var series = document.getElementById('serie_fotos_admin').value;
										get_list_logos();
										
									break; 
									case 8:
										container = 'images_serie_status';
										if(estado==0){
											//document.getElementById('prev_image_caja').value = datos;
											document.getElementById('display_1').innerHTML = msj;
											document.getElementById(btn_id).innerHTML = ready;
											//var msje = 'Imagen cargada con exito, ahora puede guardar el set';
											//display_message(msje);
											men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-check"> </i> Imagen cargada con exito. </span>'; 
											document.getElementById(container).innerHTML = men;
											desapear(document.getElementById(container));
											
										}else if(estado==1){
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('display_1').innerHTML = '';
											document.getElementById('display_1').innerHTML = msj;
											//document.getElementById('set_foto').value = datos;
										}									
									break; 
									
									case 9:
										container = 'images_serie_status';
										if(estado==0){
											//document.getElementById('prev_image_caja').value = datos;
											document.getElementById('display_2').innerHTML = msj;
											document.getElementById(btn_id).innerHTML = ready;
											//var msje = 'Imagen cargada con exito, ahora puede guardar el set';
											//display_message(msje);
											men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-check"> </i> Imagen cargada con exito. </span>'; 
											document.getElementById(container).innerHTML = men;
											desapear(document.getElementById(container));
											
										}else if(estado==1){
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('display_2').innerHTML = '';
											document.getElementById('display_2').innerHTML = msj;
											//document.getElementById('set_foto').value = datos;
										}									
									break; 
																		
									case 10:
										container = 'images_serie_status';
										if(estado==0){
											//document.getElementById('prev_image_caja').value = datos;
											document.getElementById('display_3').innerHTML = msj;
											document.getElementById(btn_id).innerHTML = ready;
											//var msje = 'Imagen cargada con exito, ahora puede guardar el set';
											//display_message(msje);
											men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-check"> </i> Imagen cargada con exito. </span>'; 
											document.getElementById(container).innerHTML = men;
											desapear(document.getElementById(container));
											
										}else if(estado==1){
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('display_3').innerHTML = '';
											document.getElementById('display_3').innerHTML = msj;
											//document.getElementById('set_foto').value = datos;
										}									
									break; 
									case 11:
										container = 'images_serie_status';
										if(estado==0){
											//document.getElementById('prev_image_caja').value = datos;
											document.getElementById('display_4').innerHTML = msj;
											document.getElementById('display_min_4').innerHTML = msj;
											
											document.getElementById(btn_id).innerHTML = ready;
											//var msje = 'Imagen cargada con exito, ahora puede guardar el set';
											//display_message(msje);
											men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-check"> </i> Imagen cargada con exito. </span>'; 
											document.getElementById(container).innerHTML = men;
											desapear(document.getElementById(container));
											
										}else if(estado==1){
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('display_4').innerHTML = '';
											document.getElementById('display_4').innerHTML = msj;
											//document.getElementById('set_foto').value = datos;
										}									
									break; 																											
									case 12:
										container = 'images_serie_status';
										if(estado==0){
											//document.getElementById('prev_image_caja').value = datos;
											document.getElementById('display_5').innerHTML = msj;
											document.getElementById(btn_id).innerHTML = ready;
											//var msje = 'Imagen cargada con exito, ahora puede guardar el set';
											//display_message(msje);
											men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-check"> </i> Imagen cargada con exito. </span>'; 
											document.getElementById(container).innerHTML = men;
											desapear(document.getElementById(container));
											
										}else if(estado==1){
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('display_5').innerHTML = '';
											document.getElementById('display_5').innerHTML = msj;
											//document.getElementById('set_foto').value = datos;
										}									
									break; 
									
									default: 
									break; 
																		
								}
								

								 

							});
	
					}
					
		//}catch(err) {
	//	  alert(err.message);
	//	}		
}


////////////////////

function ImageExist(url) 
{
   var img = new Image();
   img.src = url;
   return img.height != 0;
}


function imageExists(image_url){

    var http = new XMLHttpRequest();

    http.open('HEAD', image_url, false);
    http.send();

    return http.status != 404;

}

/////

function edita(id){
		
		
		var estado = document.getElementById('estado-'+id).value; 
		var numero = document.getElementById('numero-'+id).value; 
		var id_item= document.getElementById('id-'+id).value;  
		var index_item = document.getElementById('index-'+id).value;  
		var nombre_es = document.getElementById('nombre_es-'+id).value;  
		var nombre_en = document.getElementById('nombre_en-'+id).value; 
		var tags = document.getElementById('tags-'+id).value; 
		var piezas = document.getElementById('pieces-'+id).value; 
		var sku = document.getElementById('sku-'+id).value;  
		var serie = document.getElementById('serie-'+id).value;
		var serie_nombre = document.getElementById('serie-nombre-'+id).value;
		var clave = document.getElementById('clave-'+id).value;
		var url = document.getElementById('url-'+id).value; 
		var faltantes = document.getElementById('faltantes-'+id).value;
		var fecha = document.getElementById('fecha-'+id).value;
		var fechahora = document.getElementById('fechahora-'+id).value; 
		var folleto = document.getElementById('folleto-'+id).value; 
		var extras = document.getElementById('extras-'+id).value;  
		var estadob = document.getElementById('status-coleccion-'+id).value;

//alert(estadob);

		/// preoara tgas de busqueda para desplegarlos
		// p.replace('dog', 'monkey')
		tags = tags.replace(' ','');
		var data_tags = tags.split(',');
		//data_tags = data_tags.replace(' ', '');
		
		var cont_tags = '';
		
		for(i=0; i< data_tags.length; i++){
			if(data_tags[i] != '' && data_tags[i] != ' '){
				cont_tags += '<span class="card-price" style="display:inline-block;  "> '+data_tags[i]+'</span>';  
			}
		}
		//////////////
		
		//--Verifica URl de la Imagen
		
			var data = url.split('/');
			
			if(data[2]=='0.png'){
				url = 'minifig/minifig-d.png'; 
			}else if(data[2]=='99.png'){
				url = 'minifig/minifig-a.png';
			}else{
				url = document.getElementById('url-'+id).value; 
			}
		
		//////
		if(piezas.length<=1){
			piezas = 'cabeza, torso, pies, brazo derecho, brazo izquierdo, cabello/gorro';
			
		}else{
			piezas = document.getElementById('pieces-'+id).value; 
		}
		
		
		
		/// Consulta Extras 
		
		var grid = genera_grid_extra(folleto);
		document.getElementById('hold_grid_extras').innerHTML = grid;
		
		////
		
		
		
		//determina la posicion y tamaño de la imagen
		
		var foto=new Image();
		foto.src= url;
		var tam = foto.size; 
		//var tam;
		//var tam;  
	//	document.images[0].src=foto.src;
		var ancho=foto.width;
		var alto=foto.height;
		var posicion; 
		var pos; 
		
		if(ancho > alto ){
			posicion = 'h';
			pos = 'max-height:90%; max-width: 90%; ';
			
		}else if(ancho < alto){
			posicion = 'v';
			pos = 'max-height:90%; max-width: 90%; '; 
		}else if(ancho == alto){
			posicion = 's';
			pos = 'max-height:90%; max-width: 90%;'; 
		}
		
		var datab = url.split('/');
		var file = datab[2];
		
		document.getElementById('edita_foto_h').innerHTML= ancho;
		document.getElementById('edita_foto_v').innerHTML= alto;
		document.getElementById('edita_foto_nombre').innerHTML= file;
		document.getElementById('edita_foto_p').innerHTML= tam; 
		document.getElementById('foto_actual').innerHTML= file;
		
		
		
		///////////////////////////////
		//alert(posicion); 
		
		
		var image = '<img id="pic-'+sku+'" src="'+url+'" class="picture_o" style=" '+pos+' "  >'; 
		//src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'"
		
		
		/// Comprueba imagen folleto 
		
				var image_folleto = '';
				var url_folleto = '';
				var url_folleto_no = '';
				var res_exist ='';
				
				url_folleto = 'assets/images/sheet/'+clave+'.jpg';
				url_folleto_no = 'assets/images/noimage.png';
		
				//url_folleto = 'assets/images/sheet/'+clave+'.jpg';
				res_exist = imageExists(url_folleto);
				
				//alert(url_folleto+'-'+res_exist);
				
				if (res_exist == true){
					image_folleto = '<img id="folleto" src="'+url_folleto+'" class="folleto_display zoom" >';
				}else{
					
					url_folleto = 'assets/images/sheet/'+clave+'.jpeg';
					res_exist = imageExists(url_folleto);
					
						if (res_exist == true){
							image_folleto = '<img id="folleto" src="'+url_folleto+'" class="folleto_display zoom" >';
						}else{

							url_folleto = 'assets/images/sheet/'+clave+'.png';
							res_exist = imageExists(url_folleto);
							
								if (res_exist == true){
									image_folleto = '<img id="folleto" src="'+url_folleto+'" class="folleto_display zoom" >';
								}else{
								
									image_folleto = '<img id="folleto" src="'+url_folleto_no+'" class="folleto_display" >';
								}	

//							image_folleto = '<img id="folleto" style="max-width: 90%; max-height:90%; display:none;  "  src="'+url_folleto_no+'" class="" >';
						}				
				
					//image_folleto = '<img id="folleto" style="max-width: 90%; max-height:90%; display:none;  "  src="'+url_folleto_no+'" class="" >';
				}
		
				//var image_folleto = '<img id="folleto" style="width: 200px; display:none;  "  src="'+url_folleto+'" class="" >';
		
		///
			
		// inserta la info en la platilla de edicion 
		
		var idioma = document.getElementById('user_idioma').value;
		var nombre_title=''; 
		var fecha_hora='';
		
		if(idioma == 'es'){
			nombre_title = nombre_es;
		}else if(idioma == 'en'){
			nombre_title = nombre_en;
		}else{
			nombre_title = nombre_es;
		}
		
		
		/// Fecha 
		var lbl_fecha='';
		if(fecha == '' || fecha == undefined){
			lbl_fecha = 'Sin Fecha de Registro';
			fecha_hora = format_fecha_hora(fechahora);
		}else{
			lbl_fecha = format_fecha_hora(fecha);

			fecha_hora = format_fecha_hora(fechahora);
		}
		
		document.getElementById('title_nombre').innerHTML = nombre_title; 
		document.getElementById('edita_serie').value = serie_nombre;
		document.getElementById('edita_sku').value = sku;
		document.getElementById('edita_sku_b').innerHTML = '<span class="bubble_text_lg bg-secondary">'+serie_nombre+'</span>'+' '+'<span class="bubble_text_lg bg-secondary">'+clave+'</span>';
		document.getElementById('edita_nombre_es').value = nombre_es;
		document.getElementById('edita_nombre_en').value = nombre_en;
		document.getElementById('edita_tags').value = tags;
		document.getElementById('edita_piezas').value = piezas;
		document.getElementById('edita_url').value = url;
		document.getElementById('image_holder').innerHTML =image;
		document.getElementById('disp_image_minifig').src =url;
		
		document.getElementById('folleto_holder').innerHTML =image_folleto;
		document.getElementById('edita_folleto').value =folleto;
		document.getElementById('edita_folleto_db').value =folleto;
		//document.getElementById('image_holder_c').innerHTML =image;
		document.getElementById('edita_index').value = index_item;
		document.getElementById('edita_id').value = id_item;
		//document.getElementById('edita_faltantes').value = faltantes;
		document.getElementById('edita_fecha').value = fecha;
		document.getElementById('lbl_fecha').innerHTML = lbl_fecha;
		document.getElementById('edita_fecha_db').value = fecha_hora;

		document.getElementById('edita_extras').value = extras;
		document.getElementById('hold_tags').innerHTML = cont_tags;

		
		var ico_estado =""; 
		var ico_colected = "";
		var clase = ""; 
		//alert(estado);
		
		if(estadob==1){
			
			clase = "active_star"; 
			ico_estado = '<span class="btn_activo ico_edita_option text-light" style="font-weight: 200;"> <i class="fas fa-toggle-on"></i>  </span>';
			
									   		
			
			document.getElementById('hover_collect').style.display="none" ; 
			
		}else{
			clase = "ico-option"; 
		      ico_estado = ' <span class="ico-option ico_edita_option" style="font-weight: 200;"> <i class="fas fa-toggle-off"></i>  </span> ';
		      document.getElementById('hover_collect').style.display="block" ; 
		}
		
	
		ico_colected = '<button type="button" id="star-edita_" onclick="item_select(\''+id+'\')" class="btn btn-outline-primary" > <i class="fas fa-star"></i> Agregar </button>';
		
		boton_add = '<button type="submit" class="btn btn-success mr-2" onclick="item_select(\''+id+'\');"> <i class="fas fa-plus-circle"></i> Agregar</button>';
		
	
		// Despliega Resultados
		
		document.getElementById('btn_add').innerHTML = boton_add;
		document.getElementById('ico_estado').innerHTML = ico_colected;
		
		/// Muestra el menu inicial al editar la minifigura de acuerdo al perfil
		
		var user_profile = document.getElementById('user_perfil').value;
		
		if (user_profile==1){
			edita_toggle(1);
		}else{
			edita_toggle(2);
		}
		
		toggle('edit_info');
		//crea_piezas(id_item);
		
	} 
	
	
	function genera_grid_extra(folleto){
		
		
		// Crea el grid de extras. 
		var cell = ''; 
		var estado = ''; 
		var id= ''; 
		var current = 0; 
		var cant = ''; 
		var t_serie = document.getElementById('tserie').value;
		var serie_act = document.getElementById('serie_act').value;
		var image;
		var imagen;  
		var data_ids; 
		var full;
		var btn;
		var class_input;
		var ids = document.getElementById('ids_current').value;
		var extras; 
		var user_perfil = document.getElementById('user_perfil').value; 
		var class_image ; 
		
		data_ids = ids.split('-');
		
		//
		
		var path = 'minifig/'+serie_act+'/';
		
		
		for(i=0; i<t_serie; i++){
			current = i+1; 
			
			if(folleto == current){
				estado = '';
				id = 'id="edita_extras"';
				cant = '';
				class_input= ''; 
				full = '';
				class_image = 'active_image'; 
				
			}else{
				estado = 'disabled';
				id= ''; 
				cant = '';
				class_input= ''; 
				//full = '<div class="empty_div"> <span class="text-clear"><i class="fa fa-mouse-pointer" ></i></span> </div>';
				full = ''; 
				class_image = 'diactive_image';
			}
		
		imagen = data_ids[i].split(';');
		
		var id_figure = imagen[0];
		var foto_figure = imagen[1];
		
		if(imagen[0] != '' ){
			btn = 'onclick="edita(\''+id_figure+'\'); toggle(\'edit_info\'); "';
		}
		
		
		
		image = path+foto_figure+'.webp';
		
		//alert('extras-'+id_figure);
		extras = document.getElementById('extras-'+id_figure).value; 
		
		
		
		// <a href="#" class="btn btn-outline-secondary" ><img src="'+image+'" class="ico_image"></a> \
		cell += ' \
		<div class="form-group row minigrid_cell "> \
		<label class="col-sm-2 col-form-label lbl_num"> &nbsp; </label> \
		<div clas="col-sm-4" style="margin-left:15px; " > \
		<a href="#" '+btn+' class=" btn-outline-secondary" ><img src="'+image+'" class="ico_image '+class_image+' "> </a> \
		'+full+' \
		<input type="number" '+estado+' min="1" max="10" style="width:60px;" onfocus="editado();" aria-label="extras" onblur="save_edita('+user_perfil+');" value="'+extras+'" class="form-control '+class_input+'" '+id+' placeholder="'+cant+'"> \
		</div> \
		</div>';
			
			
		}
		
		return cell; 
		//////
		
		
	}
	
	
	function cambia_foto_minifig(){
		//alert(sku); 
		var serie = document.getElementById('serie_lego').value;
		var path = 'minifig/'+serie+'/';		
		var foto_nva = document.getElementById('edita_foto').value; 
		var foto_pos= ''; 
		
		if(foto_nva=='0.png'){
			
			foto_pos= 'minifig/minifig-a.png';
			
		}else{
			foto_pos = path + foto_nva; 
		}
		
		document.getElementById('disp_image_minifig').src = foto_pos; 
		
		
	}

	function cambia_foto_tema(){
		//alert(sku); 
		//var serie = document.getElementById('set_tema').value;
		var path = 'assets/images/logos/';		
		var foto_nva = document.getElementById('new_set_tema').value; 
		
		var data_tema = foto_nva.split('--');
		var id_tema = data_tema[0];
		var foto_tema = data_tema[1];
		
		document.getElementById('show_tema').src = path + foto_tema; 
		
		
	}	
	
	
	
	function edita_item(id){
		//alert('hola!');		
		// toma la informacion de la figura
		
		//alert('estado-'+id);
		
		var estado = document.getElementById('estado-'+id).value; 
		var numero = document.getElementById('numero-'+id).value; 
		var id_item= document.getElementById('id-'+id).value;  
		var index_item = document.getElementById('index-'+id).value;  
		var nombre_es = document.getElementById('nombre_es-'+id).value;  
		var nombre_en = document.getElementById('nombre_en-'+id).value; 
		var tags = document.getElementById('tags-'+id).value; 
		var piezas = document.getElementById('pieces-'+id).value; 
		var sku = document.getElementById('sku-'+id).value;  
		var serie = document.getElementById('serie-'+id).value;
		var serie_nombre = document.getElementById('serie-nombre-'+id).value;
		var serie_nombreb = document.getElementById('serie-nombre').value;
		var url = document.getElementById('url-'+id).value; 
		var faltantes = document.getElementById('faltantes-'+id).value;
		var fecha = document.getElementById('fecha-'+id).value;
		var fechahora = document.getElementById('fechahora-'+id).value; 
		var folleto = document.getElementById('folleto-'+id).value;
		var extras = document.getElementById('extras-'+id).value;
		var estadob = document.getElementById('status-coleccion-'+id).value;
		
		/// preoara tgas de busqueda para desplegarlos
		tags = tags.replace(' ','');
		var data_tags = tags.split(',');
		//data_tags = data_tags.replace(' ', '');
		
		var cont_tags = '';
		
		for(i=0; i< data_tags.length; i++){
			if(data_tags[i] != '' && data_tags[i] != ' ' ){
				cont_tags += '<span class="card-price" style=""> '+data_tags[i]+'</span>'; 
			}
		}
		
		//////////////
		//--Verifica URl de la Imagen
		
			var data = url.split('/');
			
			if(data[2]=='0.png'){
				url = 'minifig/minifig-d.png'; 
			}else if(data[2]=='99.png'){
				url = 'minifig/minifig-a.png';
			}else{
				url = document.getElementById('url-'+id).value; 
				data_nvo = url.split('.');
				url = data_nvo[0]+'.webp';

			}
		
		//////
				
		//var grid = genera_grid_extra(folleto);
		
		var grid = genera_grid_extra(folleto);
		document.getElementById('hold_grid_extras').innerHTML = grid;
		
		if(piezas.length<=1){
			piezas = 'cabeza, torso, pies, brazo derecho, brazo izquierdo, cabello/gorro';
			
		}else{
			piezas = document.getElementById('pieces-'+id).value; 
		}
		
		//
		var data = sku.split('-');
		
		var clave= data[0];
		
		var url_folleto = 'assets/images/sheet/'+clave+'.jpg'; 
		var url_folleto_no = 'assets/images/noimage.png';
		var res_exist ='';
		
		//
		res_exist = imageExists(url_folleto);

				if (res_exist == true){
					image_folleto = '<img id="folleto" style="max-width: 90%; max-height:90%; display:none;  "  src="'+url_folleto+'" class="" >';
				}else{
					
					url_folleto = 'assets/images/sheet/'+clave+'.jpeg';
					res_exist = imageExists(url_folleto);
					
						if (res_exist == true){
							image_folleto = '<img id="folleto" style="max-width: 90%; max-height:90%; display:none;  "  src="'+url_folleto+'" class="" >';
						}else{

							url_folleto = 'assets/images/sheet/'+clave+'.png';
							res_exist = imageExists(url_folleto);
							
								if (res_exist == true){
									image_folleto = '<img id="folleto" style="max-width: 90%; max-height:90%; display:none;  "  src="'+url_folleto+'" class="" >';
								}else{
								
									image_folleto = '<img id="folleto" style="max-width: 90%; max-height:90%; display:none;  "  src="'+url_folleto_no+'" class="" >';
								}	

//							image_folleto = '<img id="folleto" style="max-width: 90%; max-height:90%; display:none;  "  src="'+url_folleto_no+'" class="" >';
						}				
				
					//image_folleto = '<img id="folleto" style="max-width: 90%; max-height:90%; display:none;  "  src="'+url_folleto_no+'" class="" >';
				}
				
		
		/////
		
				//determina la posicion y tamaño de la imagen
		
		var foto=new Image();
		foto.src= url;
	//	document.images[0].src=foto.src;
		var ancho=foto.width;
		var alto=foto.height;
		var peso = foto.size; 
		var posicion; 
		var pos; 
		
		if(ancho > alto ){
			posicion = 'h';
			pos = ' max-height:90%; max-width: 90%;';
			
		}else if(ancho< alto){
			posicion = 'v';
			pos = ' max-height:90%; max-width: 90%;'; 
		}else if(ancho == alto){
			posicion = 's';
			pos = ' max-height:90%; max-width: 90%; '; 
		}
		
		var datab = url.split('/');
		var file = datab[2];
		
		document.getElementById('edita_foto_h').innerHTML= ancho;
		document.getElementById('edita_foto_v').innerHTML= alto;
		document.getElementById('edita_foto_p').innerHTML= peso;
		document.getElementById('edita_foto_nombre').innerHTML= file;
		
		///////////////////////////////
		var image = '<img id="pic-'+sku+'" src="'+url+'" class="picture_o" style=" '+pos+'"  >'; 
		//var image = '<img id="pic-'+sku+'" src="'+url+'" class="picture_o " >'; 
	//	var image_folleto = '<img id="folleto" style="max-width: 90%; max-height:90%; display:none;" src="'+url_folleto+'"  >';
			
		// inserta la info en la platilla de edicion 
		
		///// determina idioma 
	var nombre; 
	var fecha_hora ='';
	 var len = document.getElementById('user_idioma').value;
	 
	 if(len == 'es'){
	 		nombre = nombre_es; 
		}else{
			nombre = nombre_en;
		}
		/////

		/// Fecha 
		var lbl_fecha='';
		if(fecha == '' || fecha == undefined || fecha== 'undefined undefined'){
			lbl_fecha = 'Sin Fecha de Registro';
			fecha_hora = format_fecha_hora(fechahora); 
		}else{
			lbl_fecha = format_fecha(fecha);
			fecha_hora = format_fecha_hora(fechahora);
		}
				
		document.getElementById('title_nombre').innerHTML = nombre;
		document.getElementById('edita_serie').value = serie_nombre;
		document.getElementById('edita_sku').value = sku;
		//document.getElementById('edita_sku_b').innerHTML = '<span class="bubble_text_lg bg-secondary">'+serie_nombre+'</span>'+' '+'<span class="bubble_text_lg bg-secondary">'+clave+'</span>';
		document.getElementById('edita_sku_b').innerHTML = '<span class="bubble_text_lg bg-secondary">'+serie_nombreb+'</span>'+' '+'<span class="bubble_text_lg bg-secondary">'+clave+'</span>';
		document.getElementById('edita_nombre_es').value = nombre_es;
		document.getElementById('edita_nombre_en').value = nombre_en;
		document.getElementById('edita_tags').value = tags;
		document.getElementById('edita_piezas').value = piezas;
		document.getElementById('edita_url').value = url;
		document.getElementById('image_holder').innerHTML =image;
		document.getElementById('disp_image_minifig').src =url;
		
		document.getElementById('folleto_holder').innerHTML =image_folleto;
		document.getElementById('edita_folleto').value =folleto;
		//document.getElementById('image_holder_c').innerHTML =image;
		document.getElementById('edita_index').value = index_item;
		document.getElementById('edita_id').value = id_item;
		//document.getElementById('edita_faltantes').value = faltantes;
		document.getElementById('edita_fecha').value = fecha;
		document.getElementById('lbl_fecha').innerHTML = lbl_fecha;
		document.getElementById('edita_extras').value = extras;
		document.getElementById('hold_tags').innerHTML = cont_tags;

		document.getElementById('edita_folleto_db').value =folleto;
		document.getElementById('edita_fecha_db').value = fecha_hora;
		
		var ico_estado =""; 
		var ico_colected = "";
		var clase = ""; 
		
		//alert(estado);
		
		if(estadob==1){
			
			clase = "active_star"; 
			ico_estado = '<span class="btn_activo ico_edita_option text-light" style="font-weight: 200;"> <i class="fas fa-toggle-on"></i>  </span>';
			document.getElementById('hover_collect').style.display="none" ; 
			
		}else{
			clase = "ico-option"; 
		    ico_estado = ' <span class="ico-option ico_edita_option" style="font-weight: 200;"> <i class="fas fa-toggle-off"></i>  </span> ';
		    document.getElementById('hover_collect').style.display="block" ; 
		}
		
	
		ico_colected = '<button type="button" id="star-edita_" onclick="item_select(\''+id+'\')" class="btn btn-outline-primary" > <i class="fas fa-star"></i> Agregar </button>';
		
		boton_add = '<button type="submit" class="btn btn-success mr-2" onclick="item_select(\''+id+'\');"> <i class="fas fa-plus-circle"></i> Agregar</button>';
		
		//ico_estado = '<span class="btn_activo" style="font-weight: 200;"> <i class="fas fa-toggle-on fa-2x"></i>  </span>';
		
		document.getElementById('btn_add').innerHTML = boton_add;
		document.getElementById('ico_estado').innerHTML = ico_colected;
		
		crea_piezas(id);
		
	} 
	
	
	function cambia_minifig(){
		
		var item = document.getElementById('select_minifig').value;
		//alert(item);
		edita_item(item);  
		
	}
	
	/////////////////////////////////////
	
	function save_new_minifigura(){
		
		var serie = document.getElementById('new_minifigure_cve').value;
		var nombre_es = document.getElementById('new_minifigure_nombrees').value;   
		var nombre_en = document.getElementById('new_minifigure_nombreen').value; 
		var foto = document.getElementById('new_minifigure_foto').value; 
		var tags = document.getElementById('new_minifigure_tags').value;
		var container = 'new_minifigure_status';
		var men; 
		var id; 
		
		if(serie == ""){
			
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-light bg-warning"> <i class="fa fa-times"> </i> Ingresa la CLAVE LEGO de la minifigura. </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
			
			//new_minifigure_status
			
		}else if(nombre_es == ""){
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-light bg-warning"> <i class="fa fa-times"> </i> Ingresa Nombre en Español de la minifigura. </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));			
		
		}else if(nombre_en == ""){
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-light bg-warning"> <i class="fa fa-times"> </i> Ingresa Nombre en Inglés de la minifigura. </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));			
		
		}else if(foto == ""){
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;" class="text-light bg-warning"> <i class="fa fa-times"> </i> Suba una Foto para la nueva Minifigura. </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));			
		}	
		
		// iniciamos el proceso
		var url = 'save_minifigures.php';
		var method = 'POST';
		var params = 'item='+id;
		params += '&serie='+serie;
		params += '&nombre_es='+nombre_es;
		params += '&nombre_en='+nombre_en;
		params += '&foto='+foto;
		params += '&tags='+tags;
		params += '&id_user='+document.getElementById('user').value;
		params += '&action=38';
		var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>' ;
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text) ;		
		
		
	}
/////////////////////


function busca_item_colecciones(id){
	
	//var data = sku.split('-');
	//var serie = data[0];
	//var foto = data[1];
	
	var id = document.getElementById('id-'+id).value; 
	
	//alert(id); 
	
		 	var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;					
				params += '&action=41';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
	
}
	
/////////////////////	
	
	    function elimina_item(id){
	  
	  
	  var val_master = get_masterpass();
	  
	//  var registros = busca_item_colecciones(id);
		 
		if (val_master == 0) {
			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
		    	display_message(txte); 
		}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
		}else if (val_master==1) {
			
	 		var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;				
				params += '&action=39';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
		}
	  
  }
  
  
  ////////////////
  
  
  function preview_foto(foto){
	  
	  var path = 'minifig/'+foto; 
	  
	  document.getElementById('prev_foto').src = path; 
	  
  }
 
   ////////////////
  
  
  function preview_logo(foto){
	  
	  var path = 'assets/images/logos/'+foto; 
	  
	  document.getElementById('prev_logo').src = path; 
	  
  }
  
  function elimina_foto(foto){
	  
	  var id; 
	  var val_master = get_masterpass();
		 
		if (val_master == 0) {
			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
		    	display_message(txte); 
		}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
		}else if (val_master==1) { 

	 		var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;				
				params += '&action=40';
				params += '&archivo='+foto;
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
		}
			
	  
  }
  
  /////////////
  
   function elimina_logo(foto){
	  
	  var id; 
	  var val_master = get_masterpass();
		 
		if (val_master == 0) {
			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
		    	display_message(txte); 
		}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
		}else if (val_master==1) { 

	 		var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;				
				params += '&action=44';
				params += '&archivo='+foto;
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
		}
			
	  
  }
   /////////////
  
   
  function menu_col(menu){
	  
	 var total_op = 4; 
	 
	 for (i=1; i<= total_op; i++){
	 		document.getElementById('mnu_col_'+i).style.display = 'none';
		} 
	  
	  var vare = document.getElementById('mnu_col_'+menu).title;
	  document.getElementById('title_sub').innerHTML = vare;
	  document.getElementById('mnu_col_'+menu).style.display = 'block';
  }
  
  //////// 
  /////////////
  
   
  function menu_perfil(menu){
	  
	 var total_op = 9; 
	 
	 for (i=1; i<= total_op; i++){
	 		document.getElementById('mnu_perfil_'+i).style.display = 'none';
	 		console.log(i)+'/n';
		} 
	  var vare = document.getElementById('mnu_perfil_'+menu).title;
	  document.getElementById('desc_op').innerHTML = vare;	  
	  document.getElementById('mnu_perfil_'+menu).style.display = 'block';
	  
  }
  
  ////////
  
  function get_list_fotos(serie){
	  var id; 
	  
	  	 	var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;				
				params += '&action=42';
				params += '&serie='+serie;
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
	  
  }
 
 /////
 
   function get_list_logos(){
	  var id; 
	  
	  	 	var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;				
				params += '&action=45';
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
	  
  } 
  
  ////////// Ribbons
  
  
  const ribbons = document.querySelectorAll(".ribbon");
ribbons.forEach((ribbon) => {
  ribbon.addEventListener('click', (e) => {
     let target = e.target;
    while (target !== ribbon) {
      target = target.parentNode;
    }
    const types = ['', 'slant-up', 'slant-down', 'up', 'down', 'check'];
    const type = types[Math.floor(Math.random() * types.length)];
    target.className = `ribbon ${type}`;
  });
});



/////////////


function cambia_tipo_menu(){
	
	var selec = document.getElementById('tipo_new').value; 
	var clave = ''; 
	//alert(selec); 
	
	if(selec == 0){
		document.getElementById('file_menu').style.display= 'block';
		document.getElementById('fx_menu').style.display= 'none';
		document.getElementById('btn_menu').style.display= 'none';
		document.getElementById('link_menu').style.display= 'none';
		
		
	}else if(selec == 1){
		document.getElementById('fx_menu').style.display= 'block';		
		document.getElementById('btn_menu').style.display= 'none';
		document.getElementById('link_menu').style.display= 'none';
		document.getElementById('file_menu').style.display= 'none';
	}else if(selec == 2){
		
		document.getElementById('btn_menu').style.display= 'block';
		document.getElementById('file_menu').style.display= 'none';
		document.getElementById('fx_menu').style.display= 'none';
		document.getElementById('link_menu').style.display= 'none';
	}else if(selec == 3){
		
		document.getElementById('link_menu').style.display= 'block';
		document.getElementById('fx_menu').style.display= 'none';
		document.getElementById('btn_menu').style.display= 'none';
		document.getElementById('file_menu').style.display= 'none';		
	}else if(selec == '999'){
		document.getElementById('fx_menu').style.display= 'none';
		document.getElementById('btn_menu').style.display= 'none';
		document.getElementById('link_menu').style.display= 'none';
		document.getElementById('file_menu').style.display= 'none';		
	}
	
}

function pasa_serie(id_item){

	var clave = document.getElementById('clave-'+id_item).value; 
	var ids = document.getElementById('ids-current-'+id_item).value;
	var total_serie = document.getElementById('total-fig-'+id_item).value; 
	
	document.getElementById('serie_act').value = clave;
	document.getElementById('ids_current').value = ids;
	document.getElementById('tserie').value = total_serie;
	
}

/////////////////////////

function genera_select_todas(id){
	
	
	 
		  	var serie = document.getElementById('clave-'+id).value; 
		  	//alert(serie);
		  	
		  	var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;
				params += '&serie='+serie;			
				params += '&action=46';
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
	
	
}

function update_piezas(){
	
	var id_fig = document.getElementById('edita_id').value; 
	
	crea_piezas(id_fig);
	
}

function editado(){
	
	var focusedElement = document.activeElement;
	//alert(focusedElement.id); 
	
	var element = focusedElement.ariaLabel; 
	
	document.getElementById('last_edited').value = element; 
	
}


function toggle_images(img){
	
	var total_img = 5; 
	
	for(i=1;i<= total_img; i++){
		document.getElementById('display_'+i).style.display = 'none'; 
		document.getElementById('file_'+i).style.display = 'none';
		document.getElementById('display_min_'+i).style.display = 'none'; 
		
	}
	
	//var title = document.getElementById('mnu_'+img).getAttribute('title');
	
	document.getElementById('display_'+img).style.display = 'block'; 
	document.getElementById('file_'+img).style.display = 'block'; 
	document.getElementById('display_min_'+img).style.display = 'block'; 
	
	//document.getElementById('title_nombre_image').innerHTML =  title.toUpperCase(); 
	//document.getElementById('title_file').innerHTML = title.toUpperCase(); 
	
}

function toggle_ops(op){
	
	var total_img = 3; 
	
	for(i=1;i<= total_img; i++){
		document.getElementById('opc_img_'+i).style.display = 'none'; 
		//document.getElementById('file_'+i).style.display = 'none';
		//document.getElementById('display_min_'+i).style.display = 'none'; 
		
	}
	
	//var title = document.getElementById('mnu_'+img).getAttribute('title');
	
	document.getElementById('opc_img_'+op).style.display = 'block'; 
	//document.getElementById('file_'+img).style.display = 'block'; 
	//document.getElementById('display_min_'+img).style.display = 'block'; 
	
	//document.getElementById('title_nombre_image').innerHTML =  title.toUpperCase(); 
	//document.getElementById('title_file').innerHTML = title.toUpperCase(); 
	
}

function toggle_ops_canvas(op){
	
	//var total_img = 3; 
	var total_img = document.getElementsByClassName('canvas_op');
	//alert(total_img.length);
	
	for(i=1;i<= total_img.length; i++){
		document.getElementById('opc_img_'+i).style.display = 'none';
		document.getElementById('btn_ops_'+i).style.backgroundColor='rgba(33,150,243,0.2)';
        document.getElementById('btn_ops_'+i).style.color='#165273';
		
	}

	document.getElementById('opc_img_'+op).style.display = 'block';
	document.getElementById('btn_ops_'+op).style.backgroundColor='#165273';
	document.getElementById('btn_ops_'+op).style.color='#fff';
	
}
////

function toggle_img_set(op){
	
	//var total_img = 3; 
	var total_img = document.getElementsByClassName('image_set_op');
	//alert(total_img.length);
	
	for(i=1;i<= total_img.length; i++){
		document.getElementById('opc_imgset_'+i).style.display = 'none';
		document.getElementById('btn_imgset_'+i).style.backgroundColor='rgba(33,150,243,0.2)';
        document.getElementById('btn_imgset_'+i).style.color='#165273';
		
	}

	document.getElementById('opc_imgset_'+op).style.display = 'block';
	document.getElementById('btn_imgset_'+op).style.backgroundColor='#165273';
	document.getElementById('btn_imgset_'+op).style.color='#fff';
	
}
////

function toggle_ops_cupones(op){
	
	//var total_img = 3; 
	var total_img = document.getElementsByClassName('cupones_op');
	//alert(total_img.length);
	
	for(i=1;i<= total_img.length; i++){
		document.getElementById('opc_cupones_'+i).style.display = 'none';
		document.getElementById('btn_cops_'+i).style.backgroundColor='rgba(33,150,243,0.2)';
        document.getElementById('btn_cops_'+i).style.color='#165273';
		
	}

	document.getElementById('opc_cupones_'+op).style.display = 'block';
	document.getElementById('btn_cops_'+op).style.backgroundColor='#165273';
	document.getElementById('btn_cops_'+op).style.color='#fff';
	
}
////

function toggle_op_minifig(op){
	
	var total_imgs = 2; 
	//var total_imgs = document.getElementsByClassName('minifig_menu');
	//alert(total_img);
	
	for(i=1;i<= total_imgs; i++){
		document.getElementById('op_fig_'+i).style.display = 'none'; 		
	}
	
	document.getElementById('op_fig_'+op).style.display = 'block'; 

	
}

function decode_result_paypal(orderData){
	
	var result = JSON.stringify(orderData, null, 2);
	
	var res = JSON.parse(result);
	
	var stat = res.status;
	var id_recibo = res.id;
		
	// info producto 
	var prod_descripcion = res.purchase_units[0].description;
	var prod_nombre = res.purchase_units[0].items[0].name;
	
	//info transaccion
	var moneda = res.purchase_units[0].amount.currency_code;
	var importe = res.purchase_units[0].amount.value;
	var id_venta = res.purchase_units[0].soft_descriptor;
	var id_pago = res.purchase_units[0].payments.captures[0].id;
	
	// info del comprador
	var nombre_comp = res.payer.name.given_name +' '+res.payer.name.middle_name+' '+res.payer.name.surname;
	var correo_comp = res.payer.email_address;
	//var tel_comp = res.payer.phone.phone_number.national_number;
	
	//alert(result);
	//console.log(nombre_prod);
	console.log(result);
	
	//var cantidad = res.items.unite_amount.value; 
	//document.getElementById('debug_premium').innerHTML = result;
	
	if(stat == 'COMPLETED'){
		
	//	alert('A');

	var user_prem = document.getElementById('user_premium').value; 
	var serie_prem = document.getElementById('serie_premium').value;
	var cupon = document.getElementById('cupon_serie').value;
		
			var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'serie='+serie_prem;
				params += '&id_user='+user_prem;
				params += '&id_recibo='+id_recibo;
				params += '&prod_descripcion='+prod_descripcion;
				params += '&prod_nombre='+prod_nombre;
				params += '&moneda='+moneda;
				params += '&importe='+importe;
				params += '&id_venta='+id_venta;
				params += '&id_pago='+id_pago;
				params += '&nombre_comp='+nombre_comp;
				params += '&correo_comp='+correo_comp;
				params += '&transaction='+result;
				params += '&cupon='+cupon;
				params += '&action=48';
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
	
	
	
	}else{
		
		txt_display= 'Transaccion no completada, Verifique sus datos o intente mas tarde'; 
		display_message(txt_display);
	
	}
	
	
	//console.log('Estatus: '+stat);
	
	//alert(result);
	
}




///////////

function edit_recibo(params){
	
	var data = params.split('-');
	var action = data[0];
	var reg = data[1];
	
	
	switch (action){
		
		case '1': // Estado Recibo
			
			var estado = document.getElementById('chk_edo_recibo_'+reg).value;
			var id_recibo = document.getElementById('id_recibo_'+reg).value;
			
			if(estado==99){
				alert('Elija un estado de recibo para actualizarlo');
			}else{
			//alert(estado);
			
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'item_id='+ reg;
					params += '&estado='+ estado;
					params += '&id_recibo='+id_recibo;
					params += '&action=49';
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
			
			}
			
		break; 
		
		case '2': // Elimina Recibo 

		var id_recibo = document.getElementById('id_recibo_'+reg).value;

		if(confirm('Confirma que ¿Desea eliminar el recibo '+id_recibo+'?')){

				var val_master = get_masterpass();		 
				if (val_master == 0) {
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
				    	display_message(txte); 
				}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
				}else if (val_master==1) { 	//txt = "Hello " + person + "! How are you today?";
				  					  	
						var url = 'save_minifigures.php';
						var method = 'POST';
						var params = 'item_id='+reg;
							params += '&id_recibo='+id_recibo;
							params += '&action=50';	
						var container_id = 'snackbar' ;
						var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
						// llamamos ajax function
						ajax (url, method, params, container_id, loading_text);	
					
					
				}
		}	
		break; 
		
		default:
		
		alert('Seleccione una opcion');
		break; 			
	}

//	alert(action+' item: '+ reg);
	
	//prompt("Please enter your name:")
	
}



function save_new_tema(){
	
	var nombre = document.getElementById('new_tema_set_nombre').value; 
	var color = document.getElementById('new_tema_set_color').value;
	var logo = document.getElementById('new_tema_set_logo').value;
	var color_rgb = hexToRgb(color).r +','+ hexToRgb(color).g +','+ hexToRgb(color).b;
	var reg = document.getElementById('new_tema_set_color').value;
	
	if(nombre==''){
		
		alert('Introduzca Nombre del Tema');
		
	}else if(color == ''){
		alert('Seleccione un Color');
	
	}else if(logo == ''){
		alert('Carge una imagen para usarse como LOGO');
	
	}else{
		
		var url = 'save_minifigures.php';
		var method = 'POST';
		var params = 'item_id='+reg;
		params += '&nombre='+nombre;
		params += '&color='+color_rgb;
		params += '&logo='+logo;
		params += '&action=53';	
		var container_id = 'snackbar' ;
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text);	
	
	
	
	}	
}



function preview(id){
	

	var logo = document.getElementById('tema_logo_'+id).value; 
	var path = 'assets/images/logos/'+logo;
	
	document.getElementById('pre-logo-'+id).src = path; 
	
	
}


///////////

function edit_sug(params){
	
//	alert(params);
	
	var data = params.split('-');
	var action = data[0];
	var reg = data[1];
	var act = data[2];
	
	
	switch (action){
		
		case '1': // Archiva Sugerencia / cancela Sugerencia 
		
			
			
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'id='+ reg;
					params += '&act='+act;
					params += '&action=56';
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
			
		
			
		break; 
		
		case '2': // Elimina Recibo 

		var id_sug = document.getElementById('id_sug_'+reg).value;

		if(confirm('Confirma que ¿Desea eliminar la sugerencia '+id_sug+'?')){

				var val_master = get_masterpass();		 
				if (val_master == 0) {
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
				    	display_message(txte); 
				}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
				}else if (val_master==1) { 	//txt = "Hello " + person + "! How are you today?";
				  					  	
						var url = 'save_minifigures.php';
						var method = 'POST';
						var params = 'item_id='+reg;
							params += '&id_sug='+id_sug;
							params += '&action=57';	
						var container_id = 'snackbar' ;
						var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
						// llamamos ajax function
						ajax (url, method, params, container_id, loading_text);	
					
					
				}
		}	
		break;
		
		case '3': // Elimina Recibo 
			var estado_sug = document.getElementById('estado_sug_'+reg).value;
			var respuesta_sug = document.getElementById('respuesta_sug_'+reg).value;
			
			var tam_res= respuesta_sug.length;
		
			if(estado_sug == 0 && tam_res < 1){
				alert('El estado CANCELADO, requiere una respuesta.');
				
			}else if(estado_sug == 3 && tam_res < 1){
				alert('El estado PENDIENTE, requiere una respuesta.');
				
			}else if(estado_sug == 5 && tam_res < 1){
				alert('El estado CONSIDERADO, requiere una respuesta.');
				
			}else if(estado_sug == 6 && tam_res < 1){
				alert('El estado DESCARTADO, requiere una respuesta.');
				
			}else{

				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'id='+ reg;
					params += '&estado='+estado_sug;
					params += '&respuesta='+respuesta_sug;
					params += '&action=58';
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);		
			}	
		
		break;
		
		default:
		
		alert('Seleccione una opcion');
		break; 			
	}

//	alert(action+' item: '+ reg);
	
	//prompt("Please enter your name:")
	
}


/////// 
function add_reg(op){
	
	var opt = document.getElementById('table_op').value;
	
	if(opt == 0 ||  op==0){
		
		mensaje = 'Error: Opción Invalida, seleccione un menu para poder agregar registros. ';
		display_message(mensaje);
		
	}else{
	
		var tabla = document.getElementById('table_name').value;
		var tota_cam = document.getElementById('total_campos_form').value;
		var vals = '';
		//var i= 1;
		
		//var total_logico = tota_cam-1;
		
		for(i=1;i<=tota_cam;i++){
			
			if(i != 0){
				vals += document.getElementById('field_'+op+'_'+i).value + ';';
			}
		}
		
		//alert(vals);

				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'var='+ vals;
					params += '&op='+op;
					params += '&tabla='+tabla;
					params += '&action=59';
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
	
	}
	
}// func


////////////////


function save_mnu_cat(action){
	
	//alert(action);
	
	var new_estado;
	var vals = '';
	var data_id;
	var fila; 
	var seccion;
	var campo; 
	var name; 
	var inputs; 
	var count; 
	var reg ;
	
	
	var data = action.split('--');
	var menu = data[0];
	var id = data[1];
	
	switch(menu){
		
		case '1': // guardar Registro

					data_id = id.split('-');
						
					fila = data_id[0];
					seccion = data_id[1];
					campo = data_id[2];

					name = fila+'-'+seccion;
					inputs = $('input[name^='+name+']');
			        count = inputs.length;
			         // alert(count);
			         //var i=1;
			         
			         for(i=0 ; i < count ; i++){
				         
				         reg = document.getElementById(fila+'-'+seccion+'-'+i).value;
				         
				         if(reg ==''){
					         
					         vals += '0'+';';
				         }else{
				         
				         	vals += document.getElementById(fila+'-'+seccion+'-'+i).value+';';
				         }
				         
				         

				         
			         }
			         
					// alert(vals);
					 
						var url = 'save_minifigures.php';
						var method = 'POST';
						var params = 'tabla='+seccion;
							params += '&id='+fila;
							params += '&vals='+vals;
							params += '&action=63';
						var container_id = 'snackbar' ;
						var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
						// llamamos ajax function
						ajax (url, method, params, container_id, loading_text);	
						
			         //alert(vals);
		
		break; 

		case '2': // Borrar Reistro

						var data_id = id.split('-');
						
						var fila = data_id[0];
						var seccion = data_id[1];
						var campo = data_id[2];

		if(confirm('Confirma que ¿Desea eliminar el registro '+fila+' de la tabla '+seccion+'?')){

				var val_master = get_masterpass();		 
				if (val_master == 0) {
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
				    	display_message(txte); 
				}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
				}else if (val_master==1) { 	//txt = "Hello " + person + "! How are you today?";
				  					  	

										
						var url = 'save_minifigures.php';
						var method = 'POST';
						var params = 'tabla='+seccion;
							params += '&id='+fila;
							params += '&action=62';
						var container_id = 'snackbar' ;
						var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
						// llamamos ajax function
						ajax (url, method, params, container_id, loading_text);	
					
					
				}
		}			
		
		break; 
		
		case '3': // Cambia Estado Campo Comentario (SUG_ESTADO)

			var data_id = id.split('-');
			
			var fila = data_id[0];
			var seccion = data_id[1];
			var campo = data_id[2];
			
			var estado_curent = document.getElementById(id).value; 
			
			if(estado_curent==0){
				new_estado = 1;
			}else{
				new_estado = 0;
			}
			
			//alert(seccion);
			
			
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'tabla='+seccion;
					params += '&id='+fila;
					params += '&estado='+new_estado;
					params += '&action=61';
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	

		
		break; 
		
		case '4': // Cambia Estado 
		//	alert(action);
			var data_id = id.split('-');
			
			var fila = data_id[0];
			var seccion = data_id[1];
			var campo = data_id[2];
			
			var estado_curent = document.getElementById(id).value; 
			
			if(estado_curent==0){
				new_estado = 1;
			}else{
				new_estado = 0;
			}
			
			//alert(seccion);
			
			
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'tabla='+seccion;
					params += '&id='+fila;
					params += '&estado='+new_estado;
					params += '&action=60';
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
							
			
		break; 
				
		default:
		break; 
		
	}
	
	/**/
}

function genera_csv(tipo){
	
	
	if(tipo ==1){
	var id_user = document.getElementById('csv_user').value;
	var tema = document.getElementById('csv_tema').value;
	
	}else if(tipo==2){
	
	var	id_user = document.getElementById('user_id').value;
	var tema = 999;
	
	}else if(tipo==3){
	
	var	id_user = document.getElementById('user_id').value;
	var tema = 888;
	
    }else if(tipo==4){  // Lista de Sets segun el grupo

    var	id_user = document.getElementById('user_id').value;
    var tema = document.getElementById('current_gpo').value;
    

    }

//alert(id_user);
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'id_user='+id_user;
					params += '&tema='+tema;
					params += '&action=64';
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
	
}

function genera_csv_grupo(grupo){
	
	
	

    var	id_user = document.getElementById('user_id').value;
    var grupo_list = grupo;
    

 //alert(grupo_list);

//alert(id_user);
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'id_user='+id_user;
					params += '&grupo='+grupo;
					params += '&action=101';
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
	
}



function permisos_perfil(valor){
	
	var perfil = 0;
	
	if (valor==98){
		perfil = 0;
		document.getElementById('perfil_permisos').value = 0;
	}else{
		perfil = document.getElementById('perfil_permisos').value; 
	}
	
	
	
	if(perfil==99){
		alert('Selecciona un Perfil');
	}else{

				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'perfil='+perfil;
					params += '&action=65';
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);			
		
		
	}
	
	
}



/////


function code_permisos(chk){
	
	var total_chk = document.f1.elements.length;
	var chks = '';
	var chks_name = '';
	var chks_d = '';
	var chks_b = '';
	var edo_chk = '' ;
	var i= 1;
	var no = 0;
	var nob = 0;
	var padrea; 
	var hijoa; 
	var estado_chk;
	
	      //es mnu padre 
	      // padrea = document.getElementById(chk).dataset.padre;
	       padrea = document.getElementById(chk).id;
	       estado_chk = document.getElementById(chk).checked;
	       
	       hijoa = document.getElementById(chk).dataset.padre;
	   //  alert(estado_chk);
	       

   	for (j=0 ;j < total_chk ;j++){
      if(document.f1.elements[j].dataset.padre == padrea ){
      	
      	if(estado_chk == true){
	      	document.f1.elements[j].checked=1;
      	}else{
	      	document.f1.elements[j].checked=0;
      	}
      }
	}

	      //

   	for (i=0 ;i < total_chk ;i++){
      if(document.f1.elements[i].type == "checkbox"){
      

	  	nob = nob +1;

	      if(document.f1.elements[i].checked==true){
		      no = no +1;
		      edo_chk = 1;
		      chks_name +='<div class="col-sm-12 border-bottom"><span class="ico-permiso">'+parseInt(nob)+'.</span><span class=""> '+ document.f1.elements[i].dataset.titulo +'</span></div> ';
		      
	      }else{
		      chks_name +='<div class="col-sm-12 border-bottom"><span class="ico-permiso">'+parseInt(nob)+'.</span> <span class="tachado">'+ document.f1.elements[i].dataset.titulo +'</span></div> ';
		      edo_chk = 0;
	      }
	      
		      chks_d += document.f1.elements[i].id + '-'+ edo_chk+';';
		      chks_b += edo_chk+'.';
		      
		      
		      chks += i+'. '+document.f1.elements[i].id + '-'+ edo_chk +'; <br>';
	      
      }
         
	}
	
	var carac = chks_d.length;
	
	//alert(code_per);
	document.getElementById('code_permisos_perfil').value = chks_d;
	//document.getElementById('show_permisos_perfil').innerHTML= '<br><p>Los siguientes '+no+' permisos serán otorgados:</p><p>'+chks_name+'</p>';
	
	//code_config(1);
}


function code_config(){
	
	var total_chk = document.f2.elements.length;
	var chks = '';
	var chks_name = '';
	var chks_d = '';
	var chks_b = '';
	var edo_chk = '' ;
	var i= 1;
	var no = 0;
	var nob = 0;
	var padrea; 
	var hijoa; 
	var estado_chk;
	

	      //

   	for (i=0 ;i < total_chk ;i++){
      if(document.f2.elements[i].type == "checkbox"){
      

	  	nob = nob +1;

	      if(document.f2.elements[i].checked==true){
		      no = no +1;
		      edo_chk = 1;
		     
		      
	      }else{
		    
		      edo_chk = 0;
	      }
	      
		      chks_d += document.f2.elements[i].id + '-'+ edo_chk+';';
		      chks_b += edo_chk+'.';
		      chks += i+'. '+document.f2.elements[i].id + '-'+ edo_chk +'; <br>';
	      
      }
         
	}
	
	return chks_d;
	
	//document.getElementById('code_config').value = chks_d;
	
}


////

function save_permisos(){

		 var code = ''; 
		 var tam = ''; 
		 var per = '';
		 
		 code = document.getElementById('code_permisos_perfil').value; 
		 perfil = document.getElementById('perfil_permisos').value;
		 
		 var codigo_config = code_config();
		 //alert(codigo_config);
		 	 
		 tam = code.length;
		 if(perfil == 99){
			 alert('Seleccione un perfil para guardar.');
		 }else if(tam == 0){
			 alert('Seleccione las secciones para las que este perfil tendra acceso.');
			 
		 }else{
	 
		// alert(code);
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'code='+code;
					params += '&code_config='+codigo_config;
					params += '&id_perfil='+perfil;
					params += '&action=66';
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);		
	 
 		}
 
 //alert(code);

	
}

/////////////////

function cambia_estado_perfil(perfil){
	

				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'id_perfil='+perfil;
					params += '&action=67';
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
	
}



function pre_save_serie(){
//	alert('ok');
	
	var nombre_serie = document.getElementById('nombre_add').value; 
	var clave_serie = document.getElementById('no_add').value;
	var total_serie = document.getElementById('figuras_add').value;
	var fecha_serie = document.getElementById('fecha_add').value;
	var color_serie = document.getElementById('color_add').value;
	var estado_serie = document.getElementById('estado_add').value;
	var moneda_serie = document.getElementById('moneda_add').value;
	var precio_serie = document.getElementById('precio_add').value;
	var color_rgb = hexToRgb(color_serie).r +','+ hexToRgb(color_serie).g +','+ hexToRgb(color_serie).b;
	
	
	var tipo_serie = document.getElementById('tipo_add').value;
	var premium; 
	var moneda_s;
	var precio_s;
	
	
	if (document.getElementById('premium_add').checked){
		premium = 1; 
	}else{
		premium = 0;
	}
	
    if(precio_serie==''){
        precio_serie = 0; 
    }else{
        precio_serie = document.getElementById('precio_add').value;
    }
	
	if(clave_serie == ''){
		document.getElementById('no_add').style.border = '1px solid red';
		display_message( 'El campo <b>CLAVE LEGO</b> es requerido.' );
		
		
	}else if(total_serie == '' || total_serie == 0){
		document.getElementById('figuras_add').style.border = '1px solid red';
		display_message( 'El campo <b>TOTAL DE FIGURAS</b> es requerido y debe ser distinto a CERO.');

	}else if(nombre_serie == ''){
		document.getElementById('nombre_add').style.border = '1px solid red';
		display_message( 'El campo <b>NOMBRE SERIE</b> es requerido.' );
		
	}else{
		
		if(moneda_serie == "X"){
		//alert('no selecciona moneda');
			moneda_s = 'USD';
		}
		
		
		var url = 'save_minifigures.php';
		var method = 'POST';
		var params = 'nombre_serie='+ nombre_serie;
		params += '&clave_serie='+ clave_serie;
		params += '&fecha_serie='+ fecha_serie;
		params += '&color_serie='+ color_rgb;
		params += '&estado_serie='+ estado_serie;
		params += '&total_serie='+ total_serie;
		params += '&tipo_serie='+ tipo_serie;
		params += '&precio_serie='+ precio_serie;
		params += '&moneda_serie='+ moneda_s;
		params += '&premium='+ premium;
		params += '&action=68';
		var container_id = 'snackbar' ;
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text) ;
	}
	
}



function draft_serie(step){
	
	var user_id = document.getElementById('user_id').value;
	var clave_serie = document.getElementById('no_add').value;
	var nombresfig_serie;

	switch(step){
		
		case 1: 
		break; 
		
		case 2: 
		
			var nombresfig_serie = document.getElementById('nombres_fig_add').value;
			
			if(nombresfig_serie =='' || nombresfig_serie.length < 30){
				display_message( 'El campo <b>FIGURAS</b> es requerido.');
			}else{
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'clave_serie='+ clave_serie;
				params += '&user='+ user_id;
				params += '&nombresfig_serie='+ nombresfig_serie;
				params += '&action=69';
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);			
			}
			
		break; 
		
		
		case 3: 
		
		break; 
		
		case 4: 
		break;
		
		default: 
		break; 
		
	}

}

//////////

function cambia_estado(id){
	
	var estado = document.getElementById('s_estado_'+id).value;
	//alert(estado);
	
	switch(estado){
		
		case '0': //Ocultar
		
			quick_edit(2+'-'+id);
		
		break;
		
		case '1': // ver 
		
			quick_edit(2+'-'+id);
				
		break; 

		case '2': // borrador

			quick_edit(4+'-'+id);
			
		break; 
		
		case '3': //teaser
			quick_edit(5+'-'+id);
		break; 
		
		case '4': //testing
		break; 
		
		case '5': 
		break; 		

		case '6': 
		break;
		
		case '7': 
		break; 

		case '99': // draft serie Add 
			quick_edit(7+'-'+id);
		break; 
		 	
		default:
		break;	
		
	}
	
}


////


function genera_enlace(id_user){

var current_token = document.getElementById('token_user_current').value;

				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'id_user='+ id_user;
				params += '&current_token='+ current_token;
				params += '&action=72';
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);			

	
}

////


function block_token(id_user){

	var current_token = document.getElementById('token_user_current').value;
	
					var url = 'save_minifigures.php';
					var method = 'POST';
					var params = 'id_user='+ id_user;
						params += '&current_token='+ current_token;
						params += '&action=135';
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);			
	
		
	}

/////

function getlink() {
	var aux = document.createElement("input");
	aux.setAttribute("value",window.location.href);
	document.body.appendChild(aux);
	aux.select();
	document.execCommand("copy");
	document.body.removeChild(aux);
}

function reload_w(php){
	location.reload(php);
}

/////

function save_opcionales(id_user){

		/*
			var val_master = get_masterpass();		 
				if (val_master == 0) {
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
				    	display_message(txte); 
				    	
				}else if (val_master==1) { 	//txt = "Hello " + person + "! How are you today?";
		*/

				//// Busca las series opcionales
					var code='';
					var s_opcionales = document.getElementById('current_series_op_'+id_user).value;
				
				//alert(s_opcionales);
					
					var data_opcionales = s_opcionales.split(';');
					
						for(i=0;i< data_opcionales.length; i++){
							if(data_opcionales[i] != ''){
								
								if(document.getElementById('chkk_serie_'+data_opcionales[i]+'_'+id_user).checked){
											 // alert('checkbox esta seleccionado');
									code = code + '1.' ; 
											  
								}else{
											//alert('checkbox no esta seleccionado');
									code = code + '0.' ; 
								}			
								
							}
							
						}	
				
						document.getElementById('val_opcionales_'+id_user).value = code;
						
				//alert(code);
							var url = 'save_minifigures.php';
							var method = 'POST';
							var params = 'id_user='+ id_user;				
								params += '&code_series='+code;
								params += '&series_op='+s_opcionales;
								params += '&action=73';		
							var container_id = 'snackbar' ;
							var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
							// llamamos ajax function
							ajax (url, method, params, container_id, loading_text);	
				//}
			
}


function valida_permiso(id_user){

//alert(id_user);

var data_rec = id_user.split('_');

var serie_select = data_rec[0];
var id_user_select = data_rec[1];


				//// Busca las series opcionales
					var code='';
					var s_opcionales = document.getElementById('current_series_op_'+id_user_select).value;
				
				//alert(s_opcionales);
					
					var data_opcionales = s_opcionales.split(';');
					
						for(i=0;i< data_opcionales.length; i++){
							if(data_opcionales[i] != ''){
								
								
								if(data_opcionales[i]== serie_select ){
									var current_val = document.getElementById(data_opcionales[i]+'_'+id_user_select).value;
									
									if(current_val == 1){
										code = code + '0.' ;
									}else{
										code = code + '1.' ; 
									}
									
								}else{
									code = code + document.getElementById(data_opcionales[i]+'_'+id_user_select).value+'.';
								}
								
								//code = code + document.getElementById(data_opcionales[i]+'_'+id_user_select).value+'.';			
								
							}
							
						}	
				
						document.getElementById('per_opcionales_'+id_user_select).value = code;
						
				//alert(code);
				
							var url = 'save_minifigures.php';
							var method = 'POST';
							var params = 'id_user='+ id_user_select;				
								params += '&code_series='+code;
								params += '&series_op='+s_opcionales;
								params += '&action=74';		
							var container_id = 'snackbar' ;
							var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
							// llamamos ajax function
							ajax (url, method, params, container_id, loading_text);	
							
				//}
			
}


function valida_select_serie(id_origen){
	
	var opt_def = '<select class="form-control" id="select_2"> <option value="0">Seleccione un tipo de Serie</option>';
	
	var selection = document.getElementById(id_origen).value;
	
	var data_sel = id_origen.length;
	
	var select = id_origen.substr(data_sel-1,1);
	
	var res0 = '';
	var res1 = '';
	var res2 = '';
	var res3 = '';
	var res4 = '';
	var res5 = '';
	var res6 = '';
	var code = '';
	var code0 = '';
	var code1 = ''; 
	var code2 = ''; 
	var code3 = ''; 
	var code4 = '';
	var code5 = ''; 
	
	// -------- Selects ---- //

				var option_sel_2 = ' <select enabled class="form-control"  id="select_2"> \
				<option value="X" >Elije...</option> \
				<option value="A" >Serie Premium</option> \
				<option value="B" >Serie Sin Costo </option> \
				</select> ';

				var option_sel_3 = ' <select enabled class="form-control"  id="select_3"> \
				<option value="X" >Elije...</option> \
				<option value="A" >Pagado</option> \
				<option value="B" >No pagado </option> \
				</select> ';
	
				var option_sel_4 = ' <select enabled class="form-control"  id="select_4"> \
				<option value="X" >Elije...</option> \
				<option value="E" >Administrador</option> \
				<option value="F" > Coleccionista </option> \
				</select> ';

				var option_sel_5 = ' <select enabled class="form-control"  id="select_5"> \
				<option value="X" >Elije...</option> \
				<option value="A" > Todas las Figuras</option> \
				<option value="B" > Serie Específica </option> \
				</select> ';				

				var option_sel_6= ' <select enabled class="form-control"  id="select_6"> \
				<option value="X" >Elije...</option> \
				<option value="A" >Activada por Usuario</option> \
				<option value="B" >No Activada </option> \
				</select> ';


				
///-----------////	
	//alert(selection);
	
	switch (select){
		
		case '0': // Tipo de Serie
		
			if(selection=='x'){
				alert('Seleccione una opcion');
			}else{

                var current = document.getElementById('select_0').value;      
			
				document.getElementById('code_vista').value = genera_code_minifig();
				document.getElementById('code_minifig').innerHTML = genera_code_minifig();
				document.getElementById('code_minifig_e').value = genera_code_minifig();
				
				if(document.getElementById('select_1').value != 'X' && document.getElementById('select_2').value != 'X' && document.getElementById('select_3').value !='X' && document.getElementById('select_4').value !='X' && document.getElementById('select_5').value !='X' && document.getElementById('select_6').value != 'X'){
						get_estado_validacion(genera_code_minifig());				
				}	
			}	 
			 
		break;

		case '1': //Estado Serie
		
			if(selection=='x'){
				alert('Seleccione una opcion');
			}else{
              
              // Validacion de combos.
							
				document.getElementById('code_vista').value = genera_code_minifig();
				document.getElementById('code_minifig').innerHTML = genera_code_minifig();
				document.getElementById('code_minifig_e').value = genera_code_minifig();
				
				if(document.getElementById('select_1').value != 'X' && document.getElementById('select_2').value != 'X' && document.getElementById('select_3').value !='X' && document.getElementById('select_4').value !='X' && document.getElementById('select_5').value !='X' && document.getElementById('select_6').value != 'X'){
                    get_estado_validacion(genera_code_minifig());				
				}
			}	 
			 
		break;
		
		
		case '2': // Tipo Donativo
		
			if(selection=='x'){
				alert('Seleccione una opcion');
			}else{
			///
            // a) Selecciona la unica opcion de combo siguiente
                            // Obtiene el valor seleccionado
              var current = document.getElementById('select_2').value;
             
              if(current== 'B'){
            // a) Selecciona la unica opcion de combo siguiente
                document.getElementById('select_3').value = "B";
                //document.getElementById('select_3').disabled = true;
                
                document.getElementById('select_6').value = "B";
               // document.getElementById('select_6').disabled = true;
              
              //
              }else{
                
                document.getElementById('select_3').disabled = false;
               // document.getElementById('select_3').value = "X";
                
                document.getElementById('select_6').disabled = false;
               // document.getElementById('select_6').value = "X";
              }
              
              //
				document.getElementById('code_vista').value = genera_code_minifig();
				document.getElementById('code_minifig').innerHTML = genera_code_minifig();
				document.getElementById('code_minifig_e').value = genera_code_minifig();
				
				if(document.getElementById('select_1').value != 'X' && document.getElementById('select_2').value != 'X' && document.getElementById('select_3').value !='X' && document.getElementById('select_4').value !='X' && document.getElementById('select_5').value !='X' && document.getElementById('select_6').value != 'X'){
                    get_estado_validacion(genera_code_minifig());				
				}		 
			 }
			 
		break;

		case '3':		

			if(selection=='x'){
				alert('Seleccione una opcion');
			}else{
				
				document.getElementById('code_vista').value = genera_code_minifig();
				document.getElementById('code_minifig').innerHTML = genera_code_minifig();
				document.getElementById('code_minifig_e').value = genera_code_minifig();
				
				if(document.getElementById('select_1').value != 'X' && document.getElementById('select_2').value != 'X' && document.getElementById('select_3').value !='X' && document.getElementById('select_4').value !='X' && document.getElementById('select_5').value !='X' && document.getElementById('select_6').value != 'X'){
                    get_estado_validacion(genera_code_minifig());				
				}			
			}	
			
		break; 

		case '4':		

			if(selection=='x'){
				alert('Seleccione una opcion');
			}else{
				
				document.getElementById('code_vista').value = genera_code_minifig();
				document.getElementById('code_minifig').innerHTML = genera_code_minifig();
				document.getElementById('code_minifig_e').value = genera_code_minifig();
				
				if(document.getElementById('select_1').value != 'X' && document.getElementById('select_2').value != 'X' && document.getElementById('select_3').value !='X' && document.getElementById('select_4').value !='X' && document.getElementById('select_5').value !='X' && document.getElementById('select_6').value != 'X'){
                    get_estado_validacion(genera_code_minifig());				
				}
								
			}	
			
		break; 				

		case '5':		

			if(selection=='x'){
				alert('Seleccione una opcion');
			}else{
				
				document.getElementById('code_vista').value = genera_code_minifig();
				document.getElementById('code_minifig').innerHTML = genera_code_minifig();
				document.getElementById('code_minifig_e').value = genera_code_minifig();
				
				if(document.getElementById('select_1').value != 'X' && document.getElementById('select_2').value != 'X' && document.getElementById('select_3').value !='X' && document.getElementById('select_4').value !='X' && document.getElementById('select_5').value !='X' && document.getElementById('select_6').value != 'X'){
                    get_estado_validacion(genera_code_minifig());				
				}
				
			}	
			
		break; 	
		
		case '6':		

			if(selection=='x'){
				alert('Seleccione una opcion');
			}else{
		
				document.getElementById('code_vista').value = genera_code_minifig();
				document.getElementById('code_minifig').innerHTML = genera_code_minifig();
				document.getElementById('code_minifig_e').value = genera_code_minifig();
				
				if(document.getElementById('select_1').value != 'X' && document.getElementById('select_2').value != 'X' && document.getElementById('select_3').value !='X' && document.getElementById('select_4').value !='X' && document.getElementById('select_5').value !='X' && document.getElementById('select_6').value != 'X'){
                    get_estado_validacion(genera_code_minifig());				
				}
				
			}	
			
		break; 	

		
				
		default: 
		break; 
		
		
	}
	

	
	//alert(select);
	
	
}

function get_estado_validacion(codigo){
	
							var url = 'save_minifigures.php';
							var method = 'POST';
							var params = 'code='+ codigo;	
								params += '&action=75';		
							var container_id = 'snackbar' ;
							var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
							// llamamos ajax function
							ajax (url, method, params, container_id, loading_text);	
	
	
}

function get_estado_validacion_colect(codigo){
	
							var url = 'save_minifigures.php';
							var method = 'POST';
							var params = 'code='+ codigo;	
								params += '&action=79';		
							var container_id = 'snackbar' ;
							var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
							// llamamos ajax function
							ajax (url, method, params, container_id, loading_text);	
	
	
}

function guarda_op_vista(){

			var vista_code = document.getElementById('code_vista').value;
			var vista = document.getElementById('select_nvo').value;
			
			var s0 = document.getElementById('select_0').value;
			var s1 = document.getElementById('select_1').value;
			var s2 = document.getElementById('select_2').value;
			var s3 = document.getElementById('select_3').value;
			var s4 = document.getElementById('select_4').value;
			var s5 = document.getElementById('select_5').value;
			var s6 = document.getElementById('select_6').value;
			
			if(s0=='X' || s1=='X' || s2=='X' || s3=='X' || s4=='X' || s5=='X' || s6=='X' ){
				alert('Seleccione una nueva vista');
			}else if(vista_code.length != 7){
				alert('Falta dato, seleccione una opcion para cada lista');
			}else{

				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'vista_code='+ vista_code;
					params += '&option='+ vista;
					params += '&action=76';		
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
			}
	
}


function guarda_op_vista_colect(){

			var vista_code = document.getElementById('code_series').value;
			var vista = document.getElementById('select_nvo_colect').value;
			
			if(vista=='X'){
				alert('Seleccione una nueva vista');
			}else{

				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'vista_code='+ vista_code;
					params += '&option='+ vista;
					params += '&action=80';		
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
			}
	
}



function valida_nombre_set(clave){
	
	if(clave==""){
		
	}else{

		//alert('ok');
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'clave_set='+ clave;
					params += '&action=77';		
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
		
	}
	
}



function display_img(img){
	
	var btn = '';
	var per = document.getElementById('permiso_elimina_set').value;
	var per_edita = document.getElementById('permiso_edita_set').value;
	var btn_save = '';
	
	if(per==0){
		btn = '<button class="btn btn-inverse-secondary text-muted " disabled  ><i class="fa fa-trash"></i> </button> '; 
	}else{
		btn = '<button class="btn btn-inverse-secondary text-muted" value="'+img+'" onclick="elimina_foto_set(this.value)" ><i class="fa fa-trash"></i> </button> '; 
	}

	var data_img = img.split('.');
	var name = data_img[0];
	var ext = data_img[1];
	var btn_convert= '';
	var url_img_set = 'assets/images/sets/'+img;


	if(ext!='webp'){
		btn_convert = '<button class="btn btn-inverse-secondary btn-thin" type="button" id="'+url_img_set+'" onclick="convierte_webp(this.id);" title="Convertir Imagen" ><i class="fa-solid fa-arrows-rotate"></i> WEBP</button>'; 
	}else{
		btn_convert = '';
	}

	// Despliega imagen 

	var img_ori = document.getElementById('img_'+name);
	var img_url = img_ori.getAttribute("src");
   
   var img_fin = '<img id="img_'+cve+'" src="'+img_url+'" class="result_image_set zoom" style="max-height:90%; max-width:90%;" >';

   //document.getElementById('display_image_set').innerHTML = img_fin;

	//var img_existemte = '';
	
	var image = '\
	<div class="text-primary" ><span id="nombre_foto_edit"></span></div> \
	'+img_fin; 

	/*

	var image = '<div class="col-lg-12 cover_image zoom"> </div> \
					<div class="text-primary" ><span id="nombre_foto_edit"></span></div> \
					<img src="'+url_img_set+'" class="result_image_set" style="max-height:400px; max-width:95%;  ">'; 
					*/
	////////


	var btn_add = '<button class="btn btn-outline-primary " value="" onclick="toggle(\'upload_new_imagen\')" ><i class="fa fa-plus"></i> </button>';
					
					
	
	
					document.getElementById('display_image_set_admin').innerHTML = image;
		//document.getElementById('title_img').innerHTML = img;
		
		
	
	
	
	if(per_edita==0){
		//foto_name_edit
		document.getElementById("foto_name_edit").disabled = true;
		document.getElementById('foto_name_edit').value = img;
		btn_save = '<button type="button" class="btn btn-secondary text-clear" value="" disabled ><i class="fa fa-save"></i> </button>';  
	}else{
		document.getElementById("foto_name_edit").disabled = false;
		document.getElementById('foto_name_edit').value = img;
		btn_save = '<button type="button" class="btn btn-inverse-secondary text-muted" value="" onclick="toggle(\'\')" ><i class="fa fa-save"></i> </button>'; 
	}	
	
	
			var data_nom = img.split('.');
			var cve = data_nom[0];
	
		var val_nom = document.getElementById(cve).dataset.custom;
		document.getElementById('nombre_foto_edit').innerHTML = cve +' - '+ val_nom.toUpperCase();
		
		document.getElementById('btn_img').innerHTML = btn+btn_save;
		//document.getElementById('btn_plus').innerHTML = btn_convert;
}

/////////////////////////

function edit_img_set(img){
	
	var btn = '';
	var per = document.getElementById('permiso_elimina_set').value;
	var per_edita = document.getElementById('permiso_edita_set').value;
	var btn_save = '';
	
	if(per==0){
		btn = '<button class="btn btn-inverse-secondary text-muted " disabled  ><i class="fa fa-trash"></i> </button> '; 
	}else{
		btn = '<button class="btn btn-inverse-primary" value="'+img+'" onclick="elimina_foto_set(this.value)" ><i class="fa fa-trash"></i> </button> '; 
	}

	var data_img = img.split('.');
	var name = data_img[0];
	var ext = data_img[1];
	var btn_convert= '';
	var url_img_set = 'assets/images/sets/'+img;


	if(ext!='webp'){
		btn_convert = '<button class="btn btn-inverse-secondary btn-thin" type="button" id="'+url_img_set+'" onclick="convierte_webp(this.id);" title="Convertir Imagen" ><i class="fa-solid fa-arrows-rotate"></i> WEBP</button>'; 
	}else{
		btn_convert = '';
	}

	// Despliega imagen 

	var img_ori = document.getElementById('img_'+name);
	var img_url = img_ori.getAttribute("src");
   
   var img_fin = '<img id="img_'+cve+'" src="'+img_url+'" class="result_image_set zoom" style="max-height:90%; max-width:90%;" >';
	
	var image = '\
	<div class="text-primary" ><span id="nombre_foto_edit"></span></div> \
	'+img_fin; 

    var btn_add = '<button class="btn btn-outline-primary " value="" onclick="toggle(\'upload_new_imagen\')" ><i class="fa fa-plus"></i> </button>';
					
    document.getElementById('display_image_set_admin').innerHTML = image;

	if(per_edita==0){
		//foto_name_edit
		document.getElementById("foto_name_edit").disabled = true;
		document.getElementById('foto_name_edit').value = img;
		btn_save = '<button type="button" class="btn btn-secondary text-clear" value="" disabled ><i class="fa fa-save"></i> </button>';  
	}else{
        var data = img.split('.');
        var nombre = data[0];
        var ext = data[1];

		document.getElementById("foto_name_edit").disabled = false;

		document.getElementById('foto_name_edit').value = nombre;
        document.getElementById('foto_ext_edit').value = ext;
        document.getElementById('nombre_set_actual').value = nombre;

		btn_save = '<button type="button" class="btn btn-inverse-primary" value="" onclick="cambia_nombre_img_set()" ><i class="fa fa-save"></i> </button>'; 
	}	
	
	
			var data_nom = img.split('.');
			var cve = data_nom[0];
	
		var val_nom = document.getElementById(cve).dataset.custom;
		document.getElementById('nombre_foto_edit').innerHTML = cve +' - '+ val_nom.toUpperCase();
		
		document.getElementById('btn_img').innerHTML = btn+btn_save;
		//document.getElementById('btn_plus').innerHTML = btn_convert;
}

///////////////////


function display_logo(img){
	
	var btn = '';
	var per = document.getElementById('permiso_elimina_set').value;
	var per_edita = document.getElementById('permiso_edita_set').value;
	var btn_save = '';

   // alert(per_edita);
	
	if(per==0){
		btn = '<button type="button" class="btn btn-secondary text-muted " disabled value="'+img+'"  ><i class="fa fa-trash"></i> </button> '; 
	}else{
		btn = '<button type="button" class="btn btn-outline-primary " value="'+img+'" onclick="elimina_foto_set(this.value)" ><i class="fa fa-trash"></i> </button> '; 
	}


	
	var image = '<div class="col-lg-12 cover_image zoom"> </div> \
					<div class="text-primary" ><span id="nombre_foto_edit"></span></div> \
					<img src="assets/images/logos/'+img+'" class="result_image_set" style="max-height:400px; max-width:95%;  ">'; 
					
	var btn_add = '<button class="btn btn-outline-primary " value="" onclick="toggle(\'upload_new_imagen\')" ><i class="fa fa-plus"></i> </button>';		
	
		document.getElementById('display_image_set_admin').innerHTML = image;
		//document.getElementById('title_img').innerHTML = img;

	
	if(per_edita==0){
		//foto_name_edit
		document.getElementById("foto_name_edit").disabled = true;
		document.getElementById('foto_name_edit').value = img;
		btn_save = '<button type="button" class="btn btn-secondary text-muted " value="" disabled ><i class="fa fa-save"></i> </button>';  
	}else if(per_edita==1){
		document.getElementById("foto_name_edit").disabled = false;
		document.getElementById('foto_name_edit').value = img;
		btn_save = '<button type="button" class="btn btn-inverse-primary " value="" onclick="toggle(\'\')" ><i class="fa fa-save"></i> </button>'; 
	}	
	
	
			var data_nom = img.split('.');
			var cve = data_nom[0];
	
		var val_nom = document.getElementById(cve).dataset.custom;
		document.getElementById('nombre_foto_edit').innerHTML = cve +' - '+ val_nom.toUpperCase();
		
		document.getElementById('btn_img').innerHTML = btn+btn_save;
		document.getElementById('btn_plus').innerHTML = btn_add;
}


//////////////////////

function elimina_foto_set(foto){

//alert(foto);

		if(confirm('Confirma que ¿Desea eliminar esta foto?')){

				var val_master = get_masterpass();		 
				if (val_master == 0) {
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
				    	display_message(txte); 
				}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
				}else if (val_master==1) { 	//txt = "Hello " + person + "! How are you today?";
				  					  	
						var url = 'save_minifigures.php';
						var method = 'POST';
						var params = 'foto='+foto;
							params += '&action=78';	
						var container_id = 'snackbar' ;
						var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
						// llamamos ajax function
						ajax (url, method, params, container_id, loading_text);	
					
					
				}
		}	
	
}


function valida_select_colec(current){
	
	//alert(current);
	
	var data = current.split('_');
	var obj = '';
	var valor = '';
	
	var num = data[2]; 
	//alert(num);
	
	switch(num){
		
		case '1':

			valor = document.getElementById(current).value;
			
			if (valor != 'X'){

						obj = data[0]+'_'+data[1]+'_'+'2';
						document.getElementById(obj).disabled = false;
						document.getElementById('code_series').value= genera_code_colec();
						document.getElementById('code_series_b').innerHTML= genera_code_colec();
				
				if(document.getElementById('select_col_2').value != 'X' && document.getElementById('select_col_3').value !='X'){
						get_estado_validacion_colect(genera_code_colec());				
				}
				
			}else{
				alert('Selecciona un Tipo de Serie');
			}

		break
		
		case '2':

			valor = document.getElementById(current).value;
			
			if (valor != 'X'){
				
				obj = data[0]+'_'+data[1]+'_'+'3';				
				document.getElementById(obj).disabled = false;
				document.getElementById('code_series').value= genera_code_colec();
				document.getElementById('code_series_b').innerHTML= genera_code_colec();
				
				if(document.getElementById('select_col_2').value != 'X' && document.getElementById('select_col_3').value !='X'){
						get_estado_validacion_colect(genera_code_colec());				
				}
				
			}else{
				alert('Selecciona un Estado de Serie');
			}
			

		break; 

/*
		case '3':

			valor = document.getElementById(current).value;
			
			if (valor != 'X'){
				
				obj = data[0]+'_'+data[1]+'_'+'4';				
				document.getElementById(obj).disabled = false;
				document.getElementById('code_series').value= genera_code_colec();
				document.getElementById('code_series_b').innerHTML= genera_code_colec();
				
				if(document.getElementById('select_col_2').value != 'X' && document.getElementById('select_col_3').value !='X' && document.getElementById('select_col_4').value !='X'){
						get_estado_validacion_colect(genera_code_colec());				
				}
				
			}else{
				alert('Selecciona un Estado de Serie');
			}
			

		break; 
		*/
			
		case '3':
		
			valor = document.getElementById(current).value;
			
			if (valor != 'X'){
				
				//obj = data[0]+'_'+data[1]+'_'+'4';
				
				//alert(obj);
				
				document.getElementById('code_series').value= genera_code_colec();
				document.getElementById('code_series_b').innerHTML= genera_code_colec();
				get_estado_validacion_colect(genera_code_colec());
				
			}else{
				alert('Selecciona un Estado de Serie');
			}
			

			
		break;
		
		default: 
		break; 
		
		
	}
	

	
}

function genera_code_minifig(){
	
		
			//var tipo= document.getElementById('config_colection').value;
			var val = document.getElementById('select_0').value;
			var val_x = document.getElementById('select_1').value;
			var val_a = document.getElementById('select_2').value;
			var val_b = document.getElementById('select_3').value;
			var val_c = document.getElementById('select_4').value;
			var val_d = document.getElementById('select_5').value;
			var val_e = document.getElementById('select_6').value;
			
			var code = val + val_x + val_a + val_b + val_c + val_d + val_e;
			
			//document.getElementById('code_series').value= code;
			
			return code;
	
	
}

function genera_code_colec(){
	
		
			var tipo= document.getElementById('config_colection').value;
			var val_a = document.getElementById('select_col_1').value;
			var val_b = document.getElementById('select_col_2').value;
			var val_c = document.getElementById('select_col_3').value;
			//var val_d = document.getElementById('select_col_4').value;
			
			var code = val_a + val_b + val_c;
			
			//document.getElementById('code_series').value= code;
			
			return code;
	
	
}


function inter_minifig(){
	
	
	var status_text = document.getElementById('code_minifig_e').style.display; 
	
	//alert(status_text);
	
	
	if(status_text == 'none'){
		document.getElementById('code_minifig').style.display = 'inline-block';
		document.getElementById('code_minifig_e').style.display = 'none';
		
	}else if(status_text == 'block' || status_text == 'inline-block'){
		document.getElementById('code_minifig').style.display = 'none';
		document.getElementById('code_minifig_e').style.display = 'inline-block';
	}
	
	
}

function decode_minifig(code){
	
	var len = code.length; 
	
	if(len==7){
	
	data1 = code.substr(0, 1);
	data2 = code.substr(1, 1);
	data3 = code.substr(2, 1);
	data4 = code.substr(3, 1);
	data5 = code.substr(4, 1);
	data6 = code.substr(5, 1);
	data7 = code.substr(6, 1);
	
	document.getElementById('select_0').value = data1.toUpperCase();
	document.getElementById('select_1').value = data2.toUpperCase();
	document.getElementById('select_2').value = data3.toUpperCase();
	document.getElementById('select_3').value = data4.toUpperCase();
	document.getElementById('select_4').value = data5.toUpperCase();
	document.getElementById('select_5').value = data6.toUpperCase();
	document.getElementById('select_6').value = data7.toUpperCase();
	
	//alert(data1);
	valida_select_serie('select_0');
	
	}else{
		alert('Error: El codigo es incorrecto');
	}
	
}


function inter_series(){
	
	
	var status_text = document.getElementById('code_series_e').style.display; 
	
	//alert(status_text);
	
	
	if(status_text == 'none'){
		document.getElementById('code_series_b').style.display = 'inline-block';
		document.getElementById('code_series_e').style.display = 'none';
		
	}else if(status_text == 'block' || status_text == 'inline-block'){
		document.getElementById('code_series_b').style.display = 'none';
		document.getElementById('code_series_e').style.display = 'inline-block';
	}
	
	
}


function decode_series(code){
	
	var len = code.length; 
	
	
	
	if(len==3){
	
	data1 = code.substr(0, 1);
	data2 = code.substr(1, 1);
	data3 = code.substr(2, 1);
	
	
	document.getElementById('select_col_1').value = data1.toUpperCase();
	document.getElementById('select_col_2').value = data2.toUpperCase();
	document.getElementById('select_col_3').value = data3.toUpperCase();
	
	//alert(data1);
	valida_select_colec('select_col_1');
	valida_select_colec('select_col_2');
	}
	
}


function valida_pago(data_serie){

var data = data_serie.split('_');
var serie = data[0];
var id_user = data[1];
var id_admin = document.getElementById('user_id').value;
//alert(data_serie);

var current_val = document.getElementById(data_serie).value;


		

				var val_master = get_masterpass();		 
				if (val_master == 0) {
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
				    	display_message(txte); 
				}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
				}else if (val_master==1) { 	//txt = "Hello " + person + "! How are you today?";
				  					  	
						var url = 'save_minifigures.php';
						var method = 'POST';
						var params = 'id_user='+id_user;
							params += '&serie='+ serie;
							params += '&id_admin='+ id_admin;
							params += '&current_val='+ current_val;
							params += '&action=81';	
						var container_id = 'snackbar' ;
						var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
						// llamamos ajax function
						ajax (url, method, params, container_id, loading_text);	
					
					
				}
		
		
			
}


function valida_opcionales(data_serie){

var data = data_serie.split('_');
var serie = data[0];
var id_user = data[1];

var id_admin = document.getElementById('user_id').value;

//alert(id_admin);

var current_val = document.getElementById(data_serie).value;


				var val_master = get_masterpass();		 
				if (val_master == 0) {
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
				    	display_message(txte); 
				}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
				}else if (val_master==1) { 	//txt = "Hello " + person + "! How are you today?";
				  					  	
						var url = 'save_minifigures.php';
						var method = 'POST';
						var params = 'id_user='+id_user;
							params += '&serie='+ serie;
							params += '&id_admin='+id_admin;
							params += '&current_val='+ current_val;
							params += '&action=83';	
						var container_id = 'snackbar' ;
						var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
						// llamamos ajax function
						ajax (url, method, params, container_id, loading_text);	
					
					
				}
			
}
//////////

function valida_coleccion(data_serie){

    var data = data_serie.split('_');
    var serie = data[0];
    var id_user = data[1];
    
    var id_admin = document.getElementById('user_id').value;
    
    //alert(id_admin);
    
    var current_val = document.getElementById(data_serie).value;
    
    
                    var val_master = get_masterpass();		 
                    if (val_master == 0) {
                        txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
                            display_message(txte); 
                    }else if (val_master==2) { 
                        txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
                        display_message(txte); 
                    }else if (val_master==1) { 	//txt = "Hello " + person + "! How are you today?";
                                                
                            var url = 'save_minifigures.php';
                            var method = 'POST';
                            var params = 'id_user='+id_user;
                                params += '&serie='+ serie;
                                params += '&id_admin='+id_admin;
                                params += '&current_val='+ current_val;
                                params += '&action=117';	
                            var container_id = 'snackbar' ;
                            var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
                            // llamamos ajax function
                            ajax (url, method, params, container_id, loading_text);	
                        
                        
                    }
                
    }
    //////////

function save_perfil_nvo(id){
	
	var id_user = id; 
	
	var nombre = document.getElementById('nombre').value; 
	var apellido = document.getElementById('apellido').value;
	var f_nac = document.getElementById('f_nac').value; 
	//var usuario = document.getElementById('usuario').value; 
	//var pass = document.getElementById('p_pass').value; 
	//var pass_verifica = document.getElementById('p_pass_verifica').value; 
	//var contrasenia; 
	//var idioma_p = document.getElementById('idioma_p').value;
	//var vista_fig = document.getElementById('vista_fig').value; 
	//var pagina_inicial = document.getElementById('pagina_inicial_p').value; 
	//var idioma_u ;
	
	//var vista_m = document.getElementById('vista_m_p').value;
	//var vista_s = document.getElementById('vista_s_p').value;
	
	


// valida que el usuario no sea un correo o tenga caracteres. 

    const caracteres_no_per = ["@","$","!","?","¿","!",";",":","/","-","#"];
    var caracter_user = '';
    var bandera_guarda; 
    var acum = 0;
    
    for(i=0; i<=caracteres_no_per.length; i++){
	    caracter_user = nombre.search("'"+caracteres_no_per[i]+"'");
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
		
	

	var code = '';
	
	
///alert(code);
		if (bandera_guarda==1 ){
					var url = 'save_minifigures.php';
					var method = 'POST';
					var params = 'id_user='+ id_user;
						params += '&nombre='+ nombre;
						params += '&apellido='+ apellido;
						params += '&f_nac='+ f_nac;
						params += '&sec_perfil=1';
						params += '&action=84';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	
					
					
		}
	
	
}


function save_perfil_user(id){
	
	var id_user = id; 
	
	//var nombre = document.getElementById('nombre').value; 
	//var apellido = document.getElementById('apellido').value;
	//var f_nac = document.getElementById('f_nac').value; 
	var usuario = document.getElementById('usuario').value; 
	//var pass = document.getElementById('p_pass').value; 
	//var pass_verifica = document.getElementById('p_pass_verifica').value; 
	//var contrasenia; 
	//var idioma_p = document.getElementById('idioma_p').value;
	//var vista_fig = document.getElementById('vista_fig').value; 
	//var pagina_inicial = document.getElementById('pagina_inicial_p').value; 
	//var idioma_u ;
	
	//var vista_m = document.getElementById('vista_m_p').value;
	//var vista_s = document.getElementById('vista_s_p').value;
	
	


// valida que el usuario no sea un correo o tenga caracteres. 

    const caracteres_no_per = ["@","$","!","?","¿","!",";",":","/","-","#"];
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
		alert('El usuario tienen caracteres no permitidos o es un correo electronico. No use cualquiera de los siguientes caracteres: "@", "/", "-" , "#", "|".');
		bandera_guarda = 0;
	}else{
		//alert(caracter_user);
		//return 0;
		bandera_guarda = 1;
	}
		
	

	var code = '';
	
	
///alert(code);
		if (bandera_guarda==1 ){
					var url = 'save_minifigures.php';
					var method = 'POST';
					var params = 'id_user='+ id_user;
						params += '&usuario='+ usuario;
						params += '&sec_perfil=2';
						params += '&action=84';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	
					
					
		}
	
	
}




function save_perfil_pass(id){
	
	var id_user = id; 
	
	//var nombre = document.getElementById('nombre').value; 
	//var apellido = document.getElementById('apellido').value;
	//var f_nac = document.getElementById('f_nac').value; 
	//var usuario = document.getElementById('usuario').value; 
	var pass = document.getElementById('p_pass').value; 
	var pass_verifica = document.getElementById('p_pass_verifica').value; 
	var contrasenia = '';
	var bandera_guarda = ''; 
	//var idioma_p = document.getElementById('idioma_p').value;
	//var vista_fig = document.getElementById('vista_fig').value; 
	//var pagina_inicial = document.getElementById('pagina_inicial_p').value; 
	//var idioma_u ;
	
	//var vista_m = document.getElementById('vista_m_p').value;
	//var vista_s = document.getElementById('vista_s_p').value;
	var sum = 0;
	
	var pas_len = pass_verifica.length;
	
	if( pass.length >0 && pass_verifica.length > 0 ){
		
		if (pas_len <=7){
			//alert('La contraseña debe ser de mínimo 8 caracteres');
			document.getElementById('req_a').className = "";
			document.getElementById('req_a').className += " text-danger";
			sum = sum +0;
		}else{
			document.getElementById('req_a').className = "";
			document.getElementById('req_a').className += " text-success";
			sum = sum +1;
		}
		
		if( pass != pass_verifica ){
			//alert('La contraseña nueva no coincide');
			contrasenia = "X";
			document.getElementById('req_b').className = "";
			document.getElementById('req_b').className += " text-danger";
			sum = sum +0;

		}else{
			contrasenia = pass_verifica;
			document.getElementById('req_b').className = "";
			document.getElementById('req_b').className += " text-success";
			sum = sum +1

		}
		
		if ( pass_verifica.match(/[A-Z]/) ) {

			document.getElementById('req_c').className = "";
			document.getElementById('req_c').className += " text-success";
			sum = sum +1;
						
		}else{
				
			document.getElementById('req_c').className = "";
			document.getElementById('req_c').className += " text-danger";
			sum = sum +0;
						
		}

		if ( pass_verifica.match(/\d/) ) {

			document.getElementById('req_d').className = "";
			document.getElementById('req_d').className += " text-success";
			sum = sum +1;
						
		}else{
				
			document.getElementById('req_d').className = "";
			document.getElementById('req_d').className += " text-danger";
			sum = sum +0;
						
		}
		
		 
		//var valida_caracteres = valida_cadena_pass(pass_verifica);
		//alert(valida_caracteres);
		
	}else{
		contrasenia = "X"; 
		document.getElementById('req_a').className = "";
		document.getElementById('req_b').className = "";
		document.getElementById('req_c').className = "";
		document.getElementById('req_d').className = "";
		document.getElementById('req_e').className = "";
		document.getElementById('req_f').className = "";

		document.getElementById('req_a').className = " text-clear";
		document.getElementById('req_b').className = " text-clear";
		document.getElementById('req_c').className = " text-clear";
		document.getElementById('req_d').className = " text-clear";
		document.getElementById('req_e').className = " text-clear";
		document.getElementById('req_f').className = " text-clear";
	}		


	if (sum >= 4 && contrasenia != 'X'){
		bandera_guarda = 1;
	}else{
		bandera_guarda=0;
	}
	
	//alert(sum);
	
///alert(code);
		if (bandera_guarda==1 ){
			
					var url = 'save_minifigures.php';
					var method = 'POST';
					var params = 'id_user='+ id_user;
						params += '&pass_new='+ contrasenia;
						params += '&sec_perfil=3';
						params += '&action=84';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	
					
					
		}
	
	
}

function save_perfil_masterpass(id){
	
	var id_user = id; 
	
	//var nombre = document.getElementById('nombre').value; 
	//var apellido = document.getElementById('apellido').value;
	//var f_nac = document.getElementById('f_nac').value; 
	//var usuario = document.getElementById('usuario').value; 
	var pass = document.getElementById('masterpass').value; 
	var pass_verifica = document.getElementById('masterpass_verifica').value; 
	var contrasenia = '';
	var bandera_guarda = ''; 
	//var idioma_p = document.getElementById('idioma_p').value;
	//var vista_fig = document.getElementById('vista_fig').value; 
	//var pagina_inicial = document.getElementById('pagina_inicial_p').value; 
	//var idioma_u ;
	
	//var vista_m = document.getElementById('vista_m_p').value;
	//var vista_s = document.getElementById('vista_s_p').value;
	var sum = 0;
	
	var pas_len = pass_verifica.length;
	
	if( pass.length >0 && pass_verifica.length > 0 ){
		
		if (pas_len <=7){
			//alert('La contraseña debe ser de mínimo 8 caracteres');
			document.getElementById('reqm_a').className = "";
			document.getElementById('reqm_a').className += " text-danger";
			sum = sum +0;
		}else{
			document.getElementById('reqm_a').className = "";
			document.getElementById('reqm_a').className += " text-success";
			sum = sum +1;
		}
		
		if( pass != pass_verifica ){
			//alert('La contraseña nueva no coincide');
			contrasenia = "X";
			document.getElementById('reqm_b').className = "";
			document.getElementById('reqm_b').className += " text-danger";
			sum = sum +0;

		}else{
			contrasenia = pass_verifica;
			document.getElementById('reqm_b').className = "";
			document.getElementById('reqm_b').className += " text-success";
			sum = sum +1

		}
		
	}else{
		contrasenia = "X"; 
		document.getElementById('reqm_a').className = "";
		document.getElementById('reqm_b').className = "";
		document.getElementById('reqm_c').className = "";
		document.getElementById('reqm_d').className = "";
		document.getElementById('reqm_e').className = "";

		document.getElementById('reqm_a').className = " text-clear";
		document.getElementById('reqm_b').className = " text-clear";
		document.getElementById('reqm_c').className = " text-clear";
		document.getElementById('reqm_d').className = " text-clear";
		document.getElementById('reqm_e').className = " text-clear";
	}		


	if (sum >= 2 && contrasenia != 'X'){
		bandera_guarda = 1;
	}else{
		bandera_guarda =0;
	}
	
	//alert(id_user);
	
///alert(code);
		if (bandera_guarda==1 ){
			
					var url = 'save_minifigures.php';
					var method = 'POST';
					var params = 'id_user='+ id_user;
						params += '&pass_new='+ contrasenia;
						params += '&sec_perfil=4';
						params += '&action=84';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	
					
					
		}
	
	
}


function save_perfil_general(id){
	
	var id_user = id; 
	
	//var nombre = document.getElementById('nombre').value; 
	//var apellido = document.getElementById('apellido').value;
	//var f_nac = document.getElementById('f_nac').value; 
	//var usuario = document.getElementById('usuario').value; 
	//var pass = document.getElementById('p_pass').value; 
	//var pass_verifica = document.getElementById('p_pass_verifica').value; 
	//var contrasenia; 
	var idioma_p = document.getElementById('idioma_p').value;
	//var vista_fig = document.getElementById('vista_fig').value; 
	var pagina_inicial = document.getElementById('pagina_inicial_p').value; 
	//var idioma_u ;
	
	//var vista_m = document.getElementById('vista_m_p').value;
	//var vista_s = document.getElementById('vista_s_p').value;
	
	
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
	
	
///alert(code);
	
					var url = 'save_minifigures.php';
					var method = 'POST';
					var params = 'id_user='+ id_user;
						params += '&sec_perfil=5';
						params += '&idioma_p='+ idioma_u;
						params += '&pagina_inicial='+ pag_inicial;
						params += '&action=84';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	
					
					
		
	
	
}


function save_perfil_appear(id){
	
	var id_user = id; 
	
	//var nombre = document.getElementById('nombre').value; 
	//var apellido = document.getElementById('apellido').value;
	//var f_nac = document.getElementById('f_nac').value; 
	//var usuario = document.getElementById('usuario').value; 
	//var pass = document.getElementById('p_pass').value; 
	//var pass_verifica = document.getElementById('p_pass_verifica').value; 
	//var contrasenia; 
	//var idioma_p = document.getElementById('idioma_p').value;
	var vista_fig = document.getElementById('vista_fig').value; 
	//var pagina_inicial = document.getElementById('pagina_inicial_p').value; 
	//var idioma_u ;
	
	var vista_m = document.getElementById('vista_m_p').value;
	var vista_s = document.getElementById('vista_s_p').value;
	
	
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

	if(vista_fig == 'XX'){
		vista_f= 'default';
	}else{
		vista_f = document.getElementById('vista_fig').value;
	}
	
	
///alert(code);
	
					var url = 'save_minifigures.php';
					var method = 'POST';
					var params = 'id_user='+ id_user;
						params += '&sec_perfil=6';
						params += '&vista_f='+ vista_f;
						params += '&vista_m='+ vista_m;
						params += '&vista_s='+ vista_s;
						params += '&action=84';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	
					
					
		
	
	
}


function save_perfil_opcionales(id){
	
	var id_user = id; 
	
	//var nombre = document.getElementById('nombre').value; 
	//var apellido = document.getElementById('apellido').value;
	//var f_nac = document.getElementById('f_nac').value; 
	//var usuario = document.getElementById('usuario').value; 
	//var pass = document.getElementById('p_pass').value; 
	//var pass_verifica = document.getElementById('p_pass_verifica').value; 
	//var contrasenia; 
	//var idioma_p = document.getElementById('idioma_p').value;
	//var vista_fig = document.getElementById('vista_fig').value; 
	//var pagina_inicial = document.getElementById('pagina_inicial_p').value; 
	//var idioma_u ;
	
	//var vista_m = document.getElementById('vista_m_p').value;
	//var vista_s = document.getElementById('vista_s_p').value;
	
	
var code = '';
	
	//// Busca las series opcionales
	
	var s_opcionales = document.getElementById('current_series_op').value;
	
	var data_opcionales = s_opcionales.split(';');
	
		for(i=0;i< data_opcionales.length; i++){
			if(data_opcionales[i] != ''){
				
				if(document.getElementById('serie_'+data_opcionales[i]).checked){
							 // alert('checkbox esta seleccionado');
					code = code + '1.'; 
							  
				}else{
							//alert('checkbox no esta seleccionado');
					code = code + '0.'; 
				}			
				
			}
			
		}

	
	
///alert(code);
	
					var url = 'save_minifigures.php';
					var method = 'POST';
					var params = 'id_user='+ id_user;
						params += '&sec_perfil=7';
						params += '&code_series='+code;
						params += '&series_op='+ s_opcionales;
						params += '&action=84';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	
					
					
		
	
	
}


function valida_cadena_pass(strings){
	
	//var strings = 'this iS a TeSt 523 Now!'; 
	var i=0; 
	var character=''; 
	
	while (i <= strings.length){ 
		character = strings.charAt(i); 
				if (!isNaN(character * 1)){ 
					alert('character is numeric'); 
					var num = num+1;
				}
				if (character == character.toUpperCase()) { 
					alert ('upper case true'); 
					var upper = upper +1;
				} 
			
				if (character == character.toLowerCase()){ 
					alert ('lower case true'); 
					var lower = lower+1
				} 
			
		i++; 
		}

	var res = num + '-' + upper+ '-' +lower;
	return res;
}


///////////////////////////


function save_cupon(edita){

	
	if(edita != 0){

		var nombre = document.getElementById('cupon_nvo_nombre_'+edita).value;
		var usuario = document.getElementById('cupon_nvo_usuario_'+edita).value;
		var usos = document.getElementById('cupon_nvo_usos_'+edita ).value;
		var f_ini = document.getElementById('cupon_nvo_fini_'+edita).value;
		var f_fin = document.getElementById('cupon_nvo_ffin_'+edita).value;
		var descuento = document.getElementById('cupon_nvo_descuento_'+edita).value;
		var serie = document.getElementById('cupon_nvo_serie_'+edita).value;
		var estado = document.getElementById('cupon_nvo_estado_'+edita).value;
		var id_registro = document.getElementById('id_registro_'+edita).value;
		
	}else{
		
		var nombre = document.getElementById('cupon_nvo_nombre').value;
		var usuario = document.getElementById('cupon_nvo_usuario').value;
		var usos = document.getElementById('cupon_nvo_usos').value;
		var f_ini = document.getElementById('cupon_nvo_fini').value;
		var f_fin = document.getElementById('cupon_nvo_ffin').value;
		var descuento = document.getElementById('cupon_nvo_descuento').value;
		var serie = document.getElementById('cupon_nvo_serie').value;
		var estado = document.getElementById('cupon_nvo_estado').value;
		var id_registro = document.getElementById('id_registro').value;
			
	}
	
		var bandera_actualiza = document.getElementById('bandera_actualiza').value;
	

//alert(f_ini);

	if(nombre== ''){
		txt_display= 'Introduce un código para el cupón'; 
		display_message(txt_display);
	
	}else if(usuario=='999'){
		txt_display= 'Selecciona a quién le aplicará el cupón'; 
		display_message(txt_display);		
	}else if(serie=='999'){
		txt_display= 'Selecciona una serie a la que aplicará este cupón'; 
		display_message(txt_display);		
	}else if(usos==0){
		txt_display= 'El mínimo de usos es 1'; 
		display_message(txt_display);		
	}else if(f_ini=='' || f_fin== ''){
		txt_display= 'Selecciona una fecha de inicio o fin válida.'; 
		display_message(txt_display);		
	}else if(descuento=='999'){
		txt_display= 'Selecciona una descuento válido'; 
		display_message(txt_display);		
	}else{
		
		
		
					var url = 'save_minifigures.php';
					var method = 'POST';
					var params = 'nombre='+ nombre;
						params += '&usuario='+usuario;
						params += '&usos='+usos;
						params += '&f_ini='+ f_ini;
						params += '&f_fin='+ f_fin;
						params += '&descuento='+descuento;
						params += '&serie='+serie;
						params += '&estado='+estado;
						params += '&bandera='+bandera_actualiza;
						params += '&id_reg='+id_registro
						params += '&action=85';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	
						
		
		
		
	}

}


function valida_fechas_cupon(){
	
	var f_ini = document.getElementById('cupon_nvo_fini').value;
	var f_fin = document.getElementById('cupon_nvo_ffin').value;
	
	
	if(f_fin< f_ini){
		alert('La fecha final no puede establecerse antes de la fecha de inicio');
	}
	
}


function valida_cupon(){
	
	var codigo = document.getElementById('cupon_serie').value;
	var serie_sol = document.getElementById('serie_premium').value;
	var id_user_sol = document.getElementById('user_id').value;
					
					var url = 'save_minifigures.php';
					var method = 'POST';
					var params = 'codigo='+ codigo;
						params += '&serie_solicitada='+serie_sol;
						params += '&id_user_solicitado='+id_user_sol;				
						params += '&action=86';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	
}


  function cambia_estado_cupon(id){
	  
	 		var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;				
				params += '&action=87';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
	  
  }
  
  ///////////
 function elimina_cupon_uso(id){
	  
	  var user_elim = document.getElementById('perfil_elimina').value;
	 /* var val_master = get_masterpass();
		 
		if (val_master == 0) {
			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
		    	display_message(txte); 
		}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
		}else if (val_master==1) {
			*/
	 		var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;
				params += '&user_elimina='+user_elim;				
				params += '&action=88';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
		//}
	  
  }
///////////////////////////

  ///////////
  function elimina_def_cupon_uso(id){
	  
	var user_elim = document.getElementById('perfil_elimina').value;
    
	var val_master = get_masterpass();
	   
	  if (val_master == 0) {
		  txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
			  display_message(txte); 
	  }else if (val_master==2) { 
				  txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
				  display_message(txte); 
	  }else if (val_master==1) {
		  
		   var url = 'save_minifigures.php';
		  var method = 'POST';
		  var params = 'id='+ id;
			  params += '&user_elimina='+user_elim;				
			  params += '&action=118';		
		  var container_id = 'snackbar' ;
		  var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		  // llamamos ajax function
		  ajax (url, method, params, container_id, loading_text);	
	  }
	
}
///////////////////////////

 function elimina_cupon(id){
	  
	  
	  var val_master = get_masterpass();
		 
		if (val_master == 0) {
			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
		    	display_message(txte); 
		}else if (val_master==2) { 
					txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
					display_message(txte); 
		}else if (val_master==1) {
			
	 		var url = 'save_minifigures.php';
			var method = 'POST';
			var params = 'id='+ id;				
				params += '&action=89';		
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
		}
	  
  }
///////////////////////////

function elimina_def_cupon(id){
	  
	  
	var val_master = get_masterpass();
	   
	  if (val_master == 0) {
		  txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
			  display_message(txte); 
	  }else if (val_master==2) { 
				  txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
				  display_message(txte); 
	  }else if (val_master==1) {
		  
		   var url = 'save_minifigures.php';
		  var method = 'POST';
		  var params = 'id='+ id;				
			  params += '&action=119';		
		  var container_id = 'snackbar' ;
		  var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		  // llamamos ajax function
		  ajax (url, method, params, container_id, loading_text);	
	  }
	
}
///////////////////////////


function search_table(table) {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("campo_buscar"+"_"+table);
  filter = input.value.toUpperCase();
  table = document.getElementById(table);
  tr = table.getElementsByTagName("tr");
  th = table.getElementsByTagName("th");

  // Loop through all table rows, and hide those who don't match the search query
 /* for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
  */
  
  
	 	for (i = 1; i < tr.length; i++) {
	            tr[i].style.display = "none";
	            for(var j=0; j<th.length; j++){
					td = tr[i].getElementsByTagName("td")[j];      
					if (td) {
						if (td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1){
							tr[i].style.display = "";
							break;
	            		}
	        		}
	    		}
		}
  
}

//////////////

function save_configuracion(){
	
	var titulo = document.getElementById('nombre_conf').value;
	var seccion = document.getElementById('seccion_conf').value;
 

	if(seccion == 999){
		alert('Elija una seccion');
	}else{
					
					var url = 'save_minifigures.php';
					var method = 'POST';
					var	params = '&titulo='+titulo;
						params += '&seccion='+seccion;				
						params += '&action=90';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	
	}	
	
}


//////////////

function elimina_conf(id){
	
	//var titulo = document.getElementById('nombre_conf').value;
	//var seccion = document.getElementById('seccion_conf').value;
 

  var val_master = get_masterpass();
		 
		if (val_master == 0) {
			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
		    	display_message(txte); 
		}else if (val_master==1) { 
					
					var url = 'save_minifigures.php';
					var method = 'POST';
					var	params = '&id_conf='+id;			
						params += '&action=91';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	
	}	
	
}


function copy_code_vista(code){
	
	document.getElementById('code_minifig_e').value = code;
	decode_minifig(code);
	
}


function copy_code_vista_mosaico(code){
	
	document.getElementById('code_series_e').value = code;
	decode_series(code);
	
}


function standar_digitos(numero){

 var len = numero.length; 
var num_res = '';

	if(len==1){
		num_res = '00'+numero;
	}else if(len==2){
		num_res = '0'+numero;
	}else{
		num_res = numero;
	}


	return num_res;


}


function standar_digitos_tema(numero){

 var len = numero.length; 
var num_res = '';

	if(len==1){
		num_res = '00000'+numero;
	}else if(len==2){
		num_res = '0000'+numero;
	}else if(len==3){
		num_res = '000'+numero;
	}else if(len==4){
		num_res = '00'+numero;
	}else if(len==5){
		num_res = '0'+numero;
	}else{
		num_res = numero;
	}


	return num_res;


}

function standar_digitos_user(numero){

 var len = numero.length; 
var num_res = '';

	if(len==1){
		num_res = '0'+numero;
	}else{
		num_res = numero;
	}


	return num_res;


}


function filtrar_sets(){

	/// Deja visibles las etiquetas existentes.

	var tsets = document.getElementById('todos_sets').value;
	var set_cont = ''; 


//--------------// Evalua cantidad y caracteres en la caja de texto

var set_custom = document.getElementById('sets_custom').value;
	
    
	//alert(tsets);
	var data_todos = tsets.split(';');
	var cont =0;
	var form = '';
	var nombre_code = ''; 
    var data_sets = '';
    var grupo_code = '';

    var code_set = ''; 
    var code_tema = ''; 
    var code_user = ''; 

	//oculta todos

		for(i=0; i< data_todos.length ; i++){
	
			if(data_todos[i]!=''){
				document.getElementById('set-'+data_todos[i]).style.display = 'none'; 
			}
		}

	//

// PRoceso los sets especificos

	var sets = document.getElementById('sets_custom').value;

if(sets==''){ // si el campo sets especificos esta vacio

	//muestra todos

		for(i=0; i< data_todos.length ; i++){
	
			if(data_todos[i]!=''){
				document.getElementById('set-'+data_todos[i]).style.display = 'block'; 
			}
		} 

// Elimina la tabla existente (en caso de una nueva busqueda)
        document.getElementById('form_cant').innerHTML = '';

}else{


	sets.trim();
	//sets =  sets.replace(/(\r\n|\n|\r)/gm, "");

	var ultimo_c = sets.slice(-1);
	
	//alert(ultimo_c);

	if(ultimo_c=='\n'){

		var leng = sets.length-1;
		sets = sets.substring(0,leng);
	}

	//alert(sets);

	// data_sets = sets.split("\n").join("");
	data_sets = sets.split('\n');
//	data_sets = sets.split(/\r\n|\r|\n/,-1);

		for(j=0;j< data_sets.length;j++){
		
			
				cont = valida_clave_setbarcode(data_sets[j]);
					//cont = data_sets[j].trim();
					
		                    if ( $("#set-"+cont).length > 0 ) {
		                    // hacer algo aquí si el elemento existe
		                        document.getElementById('set-'+cont).style.display = 'block';
		                    }

		}

//// Quita los duplicados
    var act = 0; 
    var ant = 0; 
    var cad = '';
    const unicos = [];

    for(l=0; l< data_sets.length ; l++ ){

            //const elemento = data_sets[l];

            elemento = valida_clave_setbarcode(data_sets[l]);
            
            if (!unicos.includes(data_sets[l])) {
                unicos.push(elemento); 
            }

    }

////// genera un formulario para poder imprimir mas de una etiqueta. 
    var mode_panel = document.getElementById('mode_panel').value;


if(mode_panel=='v'){
		for(k=0; k< unicos.length ; k++){

                cont = unicos[k].trim();
             if(unicos[k].length > 0){
                if ( $("#set-"+cont).length > 0 ){
			            nombre_code = document.getElementById('nomcode_'+unicos[k]).value;
                        tema_code = document.getElementById('temacode_'+unicos[k]).value;
                     //   grupo_code = document.getElementById('grupocode_'+unicos[k]).value;
			            //document.getElementById('set-'+data_todos[i]).style.display = 'none';

                    form += '<tr> \
                    <td style="" ><label class=" col-form-label text-neutral">'+unicos[k]+'</label></td> \
                    <td style="width: 150px;" > <input class=" form-control" id="form_'+unicos[k]+'" type="number"  value="1" min="1" onchange="genera_codebar(this.id)" ></td> '; 
                }else{

                    form += '<tr><td style="" ><label class=" col-form-label text-danger">'+unicos[k]+'</label></td> \
                    <td class="" style="width: 150px;" > <label class=" col-form-label text-danger"> NO ENCONTRADO </label> </td> '; 

                }
            }

		}
}else{
		for(k=0; k< unicos.length ; k++){

                cont = unicos[k].trim();

            if(unicos[k].length > 0){
                if ( $("#set-"+cont).length > 0 ){
			            nombre_code = document.getElementById('nomcode_'+unicos[k]).value;
                        tema_code = document.getElementById('temacode_'+unicos[k]).value;
                        grupo_code = document.getElementById('grupocode_'+unicos[k]).value;
			            //document.getElementById('set-'+data_todos[i]).style.display = 'none';

                    form += '<tr><td style="" ><label class=" col-form-label text-neutral">'+unicos[k]+'</label></td> \
                    <td style=""><label class=" col-form-label text-neutral">'+nombre_code+'</label></td> \
                    <td style=""><label class=" col-form-label text-neutral">'+tema_code+'</label></td> \
                    <td style=""><label class=" col-form-label text-neutral">'+grupo_code+'</label></td> \
                    <td style="width: 100px;" > <input class=" form-control" id="form_'+unicos[k]+'" type="number"  value="1" min="1" onchange="genera_codebar(this.id)" ></td> '; 
                }else{

                    form += '<tr><td style="" ><label class=" col-form-label text-danger">'+unicos[k]+'</label></td> \
                    <td style=""><label class=" col-form-label text-danger"> NO ENCONTRADO </label></td> \
                    <td class="" style=""><label class=" col-form-label text-danger"> --- </label></td> \
                    <td style=""><label class=" col-form-label text-danger"> --- </label></td> \
                    <td class="" style="width: 100px;" > <label class=" col-form-label text-danger"> --- </label> </td> '; 

                }
            }

		}
}

		var table = '<table class="table table-striped" > '+form+' </table>';

		document.getElementById('form_cant').innerHTML = table;


	}
}
///////


function filtrar_sets_unicos(){

// A)  Busca todos los sets de la coleccion y lo oculta
	var tsets = document.getElementById('todos_sets').value;
	var data_todos = tsets.split(';');

	var form = '';
	var nombre_code = ''; 
    var data_sets = '';
    var grupo_code = '';

    var code_set = ''; 
    var code_tema = ''; 
    var code_user = ''; 
   // var data_res;

		for(i=0; i< data_todos.length ; i++){
	
			if(data_todos[i]!=''){
				document.getElementById('set-'+data_todos[i]).style.display = 'none'; 
			}
		}
	//console.log(tsets); 

// B) selecciona todas las lineas en el text area 
	 var scan_sets = document.getElementById('sets_custom').value;

	 // Convierte en un array los elementos escaneados 

	 var data_sets = scan_sets.split(/\r\n|\r|\n/, -1); // para hacerlos unicos 


	 // busca los elementos unicos. 

	  let result = data_sets.filter((item,index)=>{
    		return data_sets.indexOf(item) === index;
  		})
	 

	 // cuenta cuantos elemento repetidos hay
	
	var data_sets_rep = scan_sets.split(/\r\n|\r|\n/, -1); // para contar los repetidos
		data_sets_rep = data_sets_rep.filter(Boolean); // elimina elementos vacios


// C) Procesa los codigod y las tablas

if(scan_sets==''){ // si el campo sets especificos esta vacio
	
		for(i=0; i< data_todos.length ; i++){//muestra todos	
			if(data_todos[i]!=''){
				document.getElementById('set-'+data_todos[i]).style.display = 'block'; 
			}
		} 
        document.getElementById('form_cant').innerHTML = ''; // Elimina la tabla existente (en caso de una nueva busqueda)

}else{ // si hay una busqueda

		// Hace visible los codigos en el area correspondiente
		for(j=0;j< result.length;j++){
			
			cont = valida_clave_setbarcode(result[j]);
					
		    if ( $("#set-"+cont).length > 0 ) {
		        document.getElementById('set-'+cont).style.display = 'block';
		    }

		}

		// Genera la tabla de sets:

		var mode_panel = document.getElementById('mode_panel').value;


		switch (mode_panel){

		case 'v':

			var resultado = [];
	 		var scan_s = document.getElementById('sets_custom').value;
	 		var data_s = scan_s.split(/\r\n|\r|\n/, -1); // para hacerlos unicos 
	 		var sub = ''; 
	 		var clave_l = '';
	 		var data_set = '';
	 		var info_set = '';
	 		var nom_form = '';


			data_s.forEach( el => (resultado[el] = resultado[el] + 1 || 1));

			//console.log(resultado);
			//console.log(result);

			// OKK ---- Object.keys(resultado).forEach(key => console.log(key, resultado[key]));
			//var fields = ''; 
			Object.keys(resultado).forEach(function(key) {
						
                console.log(key);

                if(key.length==11){
                    info_set = document.getElementById('param_'+key).value;
                }else if(key.length<=6){
                    info_set = document.getElementById('paramcve_'+key).value;
                }else if(key.length==12){
					info_set = document.getElementById('codebox_'+key).value;
				}
				
				if(key.length==12 && info_set == ''){
					alert('No se encontro registro, prueba con Clave Lego o Codigo de inventario');
				}else{

				data_set = info_set.split('|');

				//console.log('info_set+'\'');

				nom_form = 'form_'+data_set[0];

                    form += '<tr> \
                    <td style="" ><span class=" col-form-label text-neutral">'+key+'</span><br> \
                    	<span style="font-size:9px;">'+data_set[1]+'</span> <br> \
                    	<span style="font-size:9px;"> Grupo: '+data_set[3]+'</span> \
                    </td> \
                    <td> \
                    <button type="button" id="btn_" title="Imprimir" onclick="javascript:ventanaCodebar(\''+data_set[5]+'\');" class=" btn btn-outline-primary" > \
                                                    <i class="fa-solid fa-barcode"></i>\
                                        </button> \
                    </td> \
                    <td style="width:80px;" > <input class=" form-control" id="form_'+data_set[0]+'" type="number"  value="'+resultado[key]+'" min="1" onchange="genera_codebar(this.id)" ></td> '; 
				}
	         });


		break;

		
		case 'h':
			//console.log('horizontal');

			var resultado = [];
	 		var scan_s = document.getElementById('sets_custom').value;
	 		var data_s = scan_s.split(/\r\n|\r|\n/, -1); // para hacerlos unicos 
	 		var sub = ''; 
	 		var clave_l = '';
	 		var data_set = '';
	 		var info_set = '';
	 		var nom_form = '';


			data_s.forEach( el => (resultado[el] = resultado[el] + 1 || 1));

			//console.log(resultado);
			//console.log(result);

			// OKK ---- Object.keys(resultado).forEach(key => console.log(key, resultado[key]));
			//var fields = ''; 
			Object.keys(resultado).forEach(function(key) {
				
				/*
                if(key.length>6){
                    info_set = document.getElementById('param_'+key).value;
                }else{
                    info_set = document.getElementById('paramcve_'+key).value;
                }*/

					if(key.length==11){
						info_set = document.getElementById('param_'+key).value;
					}else if(key.length<=6){
						info_set = document.getElementById('paramcve_'+key).value;
					}else if(key.length==12){
						info_set = document.getElementById('codebox_'+key).value;
					}

				data_set = info_set.split('|');

				nom_form = 'form_'+data_set[0];

				form += '<tr><td style="" ><span class=" col-form-label text-neutral">'+key+'</span></td> \
	                    <td style=""><span class=" col-form-label text-neutral">'+data_set[1]+'</span></td> \
	                    <td style=""><span class=" col-form-label text-neutral">'+data_set[2]+'</span></td> \
	                    <td style=""><span class=" col-form-label text-neutral">'+data_set[3]+'</span></td> \
                        <td> \
                        <button type="button" id="btn_" title="Imprimir" onclick="javascript:ventanaCodebar_(\''+data_set[5]+'\');" class=" btn btn-outline-primary" > \
                                                        <i class="fa-solid fa-barcode"></i>\
                                            </button> \
                        </td> \
	                    <td style="width: 100px;" > <input class=" form-control" id="form_'+data_set[0]+'" type="number"  value="'+resultado[key]+'" min="1" onchange="genera_codebar(this.id)" ></td>';
	         });


		break;
		
		default:
		break;


		}

			var table = '<table class="table table-striped" > '+form+' </table>';
			document.getElementById('form_cant').innerHTML = table;

			Object.keys(resultado).forEach(function(key) {

				info_setb = document.getElementById('param_'+key).value;
				data_setb = info_setb.split('|');

				//console.log('info_set+'\'');

				nom_formb = 'form_'+data_setb[0];
			 	genera_codebar(nom_formb);
			});

}

} // end function


///////

function valida_clave_setbarcode(clave){

var code_set = 0; 
var code_set_ini = '';
var code_set_dob = ''; 

		if(clave.length == 11){ // se ingreso una clave de barra
			code_set = clave.substring(0,6);
			code_set_ini = clave.substring(0,1);
			code_set_dob = clave.substring(0,2);

							if(code_set_ini == '0'){
								

								if(code_set_dob == '00'){
									code_set = code_set.substring(2,6);
								}else{
									code_set = code_set.substring(1,6);
								}

							}else{
								code_set = code_set.substring(0,6);
							}
			
		}else if(clave.length == 12){

			var code_set_org = document.getElementById('codebox_'+clave).value;
			if(code_set_org!=''){
				var info_set = code_set_org.split('|');
				code_set = info_set[0];
			}else{
				alert('Codigo de caja no registrado, intenta conla clave');
			}

		}else{
			code_set = clave;
		}

		return code_set;
}
///////

function genera_codebar(id){

	var cant = document.getElementById(id).value;
    cant = cant-1;
    var cant_act = document.getElementById(id).value;

        if(cant_act >0 ){
                
                var info = id.split('_');
                var clave = info[1].trim();
                var current = '';
                
                var card = ''; 
                var new_itms = '';
                var copia = '';
                var orig ='';
                var no_real = 0;

                orig = document.getElementById('lbl_'+clave);
                //orig = orig.toString();

                for(i=0 ; i<cant ; i++){
                    
                    //tot = '<b>(1 DE '+cant_act+')</b>';
                    
                    copia = orig.cloneNode(true);
                    card += ' \
                        \
                    <card class="col-sm-4 stretch-card lbl_child" id="set-'+clave+'-'+i+'" searchable="'+clave+'"  style=" width:40%; margin-bottom:2px; box-shadow:none; " > \
                        <div class="card shelf_card" style="border: 1px solid rgba(200,200,200,0.9); border-radius:5px; background: #fff; " > \
                    '+copia.outerHTML+'<div></card>';

                    new_itms += 'set-'+clave+'-'+i+';';

                }

                //Quita las etiquetas

                for(m=0;m <= cant_act; m++){
                    $('#'+'set-'+clave+'-'+m).remove();        
                }
                
                document.getElementById('new_labels').innerHTML = '';
                document.getElementById('new_labels').innerHTML = card;
                
                // despliega los nuevos 
                var data_items = new_itms.split(';');
                
                if(data_items!= ''){
                    for(i=0; i<= data_items.length ; i++){
                        $('#'+data_items[i]).appendTo( "#card_body" );
                    }
                }

              //  contador_lbl(id);

            
        
        }else{
            //contador_lbl(id);
        }
        //contador_lbl(id);
}

function contador_lbl(id){
        // Inserta el No de etiqueta
        var cant_nvo = document.getElementById(id).value;
    
        var existentes = document.getElementsByClassName('lbl_child');
        var total_card = existentes.length;
      //  alert(total_card);
}

///////

	function genera_codeba_bkup(id){

		var cant = document.getElementById(id).value;
		cant = cant-1; 
		var info = id.split('_');
		var clave = info[1].trim();

		var cant_real = document.getElementById(id).value;

		var format = getRadiobtnSelectedValue(document.radiopublic.flatRadios);
		
			if(format== null ){
				format = document.getElementById('flatRadios').value;
			}

		//alert(format);

		var codigo_code = document.getElementById('code_'+clave).value;
		
		//var nombre_code = document.getElementById('nomcode_'+clave).value; 
		//var tema_code = document.getElementById('temacode_'+clave).value; 
		var formato = '';

		var card = ''; 
		var new_itms = '';

/// Datos Globales 

		var sitio_web = document.getElementById('title_web').value; 
			sitio_web = sitio_web.toUpperCase();
		var logo_lbl = '';

//// lee todos la datos desde la cadena parametros

		//alert(clave);

		var params = document.getElementById('param_'+codigo_code).value;
		var data_params = params.split('|');

		var clave_lego = data_params[0];
		var nom_set = data_params[1].toUpperCase();
		var nom_tema = data_params[2].toUpperCase();
		var grupo = data_params[3];
		var codigo = data_params[4];
		//var codigo_barra = '*'+codigo+'*';

		var cant_act = document.getElementById(id).value;
		var tot = '';



for(i=1; i<= cant ; i++){

	var num = i+1;

			tot = '<b>(1 DE '+cant_act+')</b>';

			if(cant_act>1){
				document.getElementById('total_'+codigo).innerHTML = tot;
			}else if(cant_act <= 1 ){
				document.getElementById('total_'+codigo).innerHTML = '';
			}

switch(format){

case '1':

		card += ' \
				\
		<card class="col-sm-4 stretch-card " id="set-'+clave+'-'+i+'" searchable="'+clave+'"  style=" width:40%; margin-bottom:2px; box-shadow:none; " > \
			<div class="card shelf_card" style="border: 1px solid rgba(200,200,200,0.9); border-radius:5px; background: #fff; " > \
				<div style="width: 230px;" class="center"> \
				<div class="barcode_holder"> \
				\
					<span style="font-size: 9.5px; inline-height: 11px;"> '+sitio_web+' </span> \
					<span style="font-size: 9.5px; inline-height:9px;" id="nombre_set_barcode" > | <b>'+nom_tema+'</b></span> <br><br> \
					<span class="barcode_set" id="barcode_set">'+codigo+'</span> <br>\
					<span style="font-size: 9.5px; inline-height: 9px;" id="nombre_set_barcode" >'+nom_set+'</span> \
					<span style="font-size: 9.5px; inline-height: 9px;" id="nombre_set_barcode" > <b>('+num+' DE '+cant_real+')<b> </span> \
					<span class="no-show" style="font-size: 9px; inline-height: 9px;" id="nombre_set_barcode" >(SET-'+clave+'-'+i+') </span> \
				</div> \
				</div> \
			</div> \
		</card> \
								'; 

		 new_itms += 'set-'+clave+'-'+i+';'; 

break;

case '2':

		card += ' \
				\
		<card class="col-sm-4 stretch-card " id="set-'+clave+'-'+i+'" searchable="'+clave+'"  style=" width:40%; margin-bottom:2px; box-shadow:none; " > \
			<div class="card shelf_card" style="border: 1px solid rgba(200,200,200,0.9); border-radius:5px; background: #fff; " > \
				<div style="width: 230px;" class="center"> \
				<div class="barcode_holder"> \
				\
				<span style="font-size: 9.5px; line-height:1.9em; display:block; "> '+sitio_web+' </span> \
        			<span style="font-size: 9.5px; line-height:0.9em; display:block;" id="nombre_set_barcode" >  \
          			<b> '+nom_tema+' </b> \
       				</span> \
\
					<span style="font-size: 0.8em; line-height:4.5em; display:block;" class="barcode_set_sm" id="barcode_set"> \
	          		'+codigo+' \
	    			</span> \
\
				<span style="font-size: 0.6em; line-height:0.9em;" id="nombre_set_barcode" > '+nom_set+' </span> \
				<span style="font-size: 9.5px; inline-height: 9px;" id="nombre_set_barcodeb" > <b>('+num+' DE '+cant_real+')</b> </span> \
				<span class="no-show" style="font-size: 9px; inline-height: 9px;" id="nombre_set_barcode" >(SET-'+clave+'-'+i+') </span> \
				\
				</div> \
				</div> \
			</div> \
		</card> \
								'; 

		 new_itms += 'set-'+clave+'-'+i+';'; 


break;

case '3':

	logo_lbl = document.getElementById('logo_lbl').value;

	card += ' \
	\
	<card class="col-sm-4 stretch-card " id="set-'+clave+'-'+i+'" searchable="'+clave+'"  style=" width:40%; margin-bottom:2px; box-shadow:none; " > \
		<div class="card shelf_card" style="border: 1px solid rgba(200,200,200,0.9); border-radius:5px; background: #fff; " > \
			<div style="width: 230px;" class="center"> \
				<div class="barcode_holder center" style="border:0px solid #ccc;">\
					<img src="'+logo_lbl+'" class="logo_lbl" ><br>\
					<span style="font-size: 9.5px; inline-height: 0.8em;"> '+sitio_web+' </span> \
					<span style="font-size: 9.5px; inline-height: 0.8em;" id="nombre_set_barcode" > | <b>'+nom_tema+'</b></span> \
											<br><br>\
					<span style="display:block;" class="barcode_set" id="barcode_set"> '+codigo+' </span> \
					 \
					<span style="font-size: 9.5px; inline-height:9px; display:block; margin-top:20px;" id="n_set_barcode" >'+nom_set+' <b> ('+num+' DE '+cant_real+')</b> </span> \
					<span class="no-show" style="font-size: 9px; inline-height: 9px;" id="nombre_set_barcode" >(SET-'+clave+'-'+i+') </span> \
						\
				</div>\
			</div>\
		</div> \
	</card> \
	';

	new_itms += 'set-'+clave+'-'+i+';';

break;

case '4': // QR 

	card += ' \
	<card class="col-sm-4 stretch-card " id="set-'+clave+'-'+i+'" searchable="'+clave+'"  style=" width:40%; margin-bottom:2px; box-shadow:none; " > \
		<div class="card shelf_card" style="border: 1px solid rgba(200,200,200,0.9); border-radius:5px; background: #fff; " > \
			<div style="width: 230px;" class="center" > \
				<div class="barcode_holder" style="border:0px solid #ccc; " > \
			\
					<span class="" style="display:flex; position:relative; float:left;"> \
						<img src="assets/images/qr_sets/'+codigo+'.webp" class="qr_img" name="nuevo" /> \
					</span> \
					\
					<div style="display: flex; float:left; width:60%; position:relative; margin-top:5px; text-align:left;">\
						<span style="font-size: 11px; ">'+sitio_web+' <br>\
						<span style="font-size: 11px; " > '+nom_tema+' <br>\
						<span style="font-size: 11px; " > '+codigo+'  -  '+clave_lego+' <br>\
						<span style="font-size: 9px; clear:both; display:block; "> '+nom_set+' <b>('+num+' DE '+cant_real+')</b></span>\
			\
						<span class="no-show" style="font-size: 9px; inline-height: 9px;" id="nombre_set_barcode" >(SET-'+clave+'-'+i+') </span> \
					</div>\
				</div> \
			</div>\
		</div> \
	</card> \
	';

	new_itms += 'set-'+clave+'-'+i+';';

break;

	default:

		card += ' \
				\
		<card class="col-sm-4 stretch-card " id="set-'+clave+'-'+i+'" searchable="'+clave+'"  style=" width:40%; margin-bottom:2px; box-shadow:none; " > \
			<div class="card shelf_card" style="border: 1px solid rgba(200,200,200,0.9); border-radius:5px; background: #fff; " > \
				<div style="width: 230px;" class="center"> \
				<div class="barcode_holder center"> \
				\
					<span style="font-size: 9.5px; inline-height: 11px;"> '+sitio_web+' </span> \
					<span style="font-size: 9.5px; inline-height:9px;" id="nombre_set_barcode" > | <b>'+nom_tema+'</b></span> <br><br> \
					<span class="barcode_set" id="barcode_set">'+codigo+'</span> <br>\
					<span style="font-size: 9.5px; inline-height: 9px;" id="nombre_set_barcode" >'+nom_set+'</span> \
					<span style="font-size: 9.5px; inline-height: 9px;" id="nombre_set_barcode" > <b>('+num+' DE '+cant+')</b> </span> \
					<span class="no-show" style="font-size: 9px; inline-height: 9px;" id="nombre_set_barcode" >(SET-'+clave+'-'+i+') </span> \
				</div> \
				</div> \
			</div> \
		</card> \
								'; 

		 new_itms += 'set-'+clave+'-'+i+';'; 
	break;
	}


	//var t = document.getElementById('card_body');

	//t.appendTo('#set-'+clave+'-'+i).fadeIn()


	}
		




/// elimina los previos



for(m=0;m <= cant_act; m++){
	$('#'+'set-'+clave+'-'+m).remove();
	//set-'+clave+'-'+i+'

}

//document.getElementById('new_labels').innerHTML = new_itms; 


///

	document.getElementById('new_labels').innerHTML = card;

// desliegalos nuevos 
var data_items = new_itms.split(';');

if(data_items!= ''){
	for(i=0; i<= data_items.length ; i++){
		$('#'+data_items[i]).appendTo( "#card_body" );


	}
}

		

		//alert(id);


	}



	function sidemenu(id){ // menus laterales secundarios

		//Ejm. nombre_1

		var data = id.split('_');
		var nom = data[0];
		var num = data[1];

		var menus = document.getElementsByClassName(nom);

		for(i=1;i<=menus.length;i++){

			document.getElementById('div_'+nom+'_'+i).style.display='none';
			document.getElementById(nom+'_'+i).style.background='rgba(163, 183, 196, 0.1)';
			document.getElementById(nom+'_'+i).style.color='#6c757d '; 

		}

		document.getElementById('div_'+id).style.display='block';
		document.getElementById(nom+'_'+num).style.background='rgba(163, 183, 196, 0.4)';
		document.getElementById(nom+'_'+num).style.color='#165273'; 

	}

	function barmenu(id){ // menus de opcione

		//Ejm. nombre_1

		var data = id.split('_');
		var nom = data[0];
		var num = data[1];
		
		var menus = document.getElementsByClassName(nom);
		var small = document.getElementsByClassName(nom+'_sm');
		var large = document.getElementsByClassName(nom+'_lg');
		var med = document.getElementsByClassName(nom+'_md');

		for(i=1;i<=menus.length;i++){

			if(small.length >0){
				document.getElementById(nom+'_'+i).style.width = '60px';
			}else if(large.length >0){
				document.getElementById(nom+'_'+i).style.width = '165px';
			}else if(med.length >0){
				document.getElementById(nom+'_'+i).style.width = '77px';
			}else{
				document.getElementById(nom+'_'+i).style.width = '120px';
			}

			if(menus.length==1){
				document.getElementById(nom+'_'+i).style.borderRadius = '5px 5px 0px 0px';
			}else{
				if(i==1){
					document.getElementById(nom+'_'+i).style.borderRadius = '5px 0px 0px 0px';
				}else if(i==menus.length){
					document.getElementById(nom+'_'+i).style.borderRadius = '0px 5px 0px 0px';

				}else{
					document.getElementById(nom+'_'+i).style.borderRadius = '0px 0px 0px 0px';
				}
			}

			document.getElementById('div_'+nom+'_'+i).style.display='none';
			//document.getElementById(nom+'_'+i).style.backgroundColor='rgba(33, 150, 243, 0.2)';
			//document.getElementById(nom+'_'+i).style.backgroundColor='rgba(230, 230, 230, 0.2)';
			document.getElementById(nom+'_'+i).style.backgroundColor=' rgba(108, 117, 125, 0.05)';
			//document.getElementById(nom+'_'+i).style.color=' rgba(33, 150, 243, 0.8)';
			document.getElementById(nom+'_'+i).style.color=' rgba(150, 150, 150, 0.8)';
			document.getElementById(nom+'_'+i).style.border = '0px solid #ccc';
			document.getElementById(nom+'_'+i).style.borderRight = '1px solid rgba(155, 155, 155, 0.2)';

		}

		document.getElementById('div_'+id).style.display='block';
		//document.getElementById(nom+'_'+num).style.backgroundColor='#165273';
		document.getElementById(nom+'_'+num).style.background='rgba(33, 150, 243, 0.2)';
		document.getElementById(nom+'_'+num).style.color=' rgba(33, 150, 243, 0.8)';
		//document.getElementById(nom+'_'+num).style.color='#fff';
		
	}


	function imprSelec(div) {
	  var ficha = document.getElementById(div);
	  var ventimp = window.open(' ', 'popimpr');
	  ventimp.document.write( ficha.innerHTML );
	  ventimp.document.close();
	  ventimp.print( );
	  ventimp.close();
	}


	function save_grupo(){
		
		var nombre = document.getElementById('new_nombre_grupo').value;
		var id_user = document.getElementById('user_id').value; 


//alert(id_user);
		if(nombre==''){

			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Introduce una etiqueta </span>';
		    	display_message(txte); 
		}else{


					var url = 'save_minifigures.php';
					var method = 'POST';
					var	params = 'title='+nombre;
						params += '&id_u='+id_user;		
						params += '&action=92';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	



		}
	}


function elimina_grupo(id){
	
	//var titulo = document.getElementById('nombre_conf').value;
	//var seccion = document.getElementById('seccion_conf').value;
 

  //var val_master = get_masterpass();
		 
		var confirma = confirm('¿Confirmas que deseas eliminar este grupo?'); 

			 
			if (confirma == true) {
					
					var url = 'save_minifigures.php';
					var method = 'POST';
					var	params = 'id_conf='+id;			
						params += '&action=93';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	
	}	
	
}

function gpolist(id_grupo){

	document.getElementById('gpo_dest').value= ''; 

	document.getElementById('gpo_dest').value= id_grupo;
	document.getElementById('dest').innerHTML= document.getElementById('title_'+id_grupo).value; 


	var edo_div = document.getElementById('current_sets').style.display; 

	if(edo_div == 'block'){
		document.getElementById('current_sets').style.display = 'none';
		document.getElementById('add_sets').style.display = 'block';
	}else{
		document.getElementById('current_sets').style.display = 'block';
		document.getElementById('add_sets').style.display = 'none';
	}

	

}




function save_items_gpo(){
	//alert('hola');
	var itemList = document.getElementById('select2');
	var collection = itemList.selectedOptions;
	var itm= '';
	var gpo_dest = document.getElementById('gpo_dest').value;
	var id_user = document.getElementById('user_id').value; 

	if( collection.length==0){
		alert('Agregue Sets a la lista');
	}else{

		for(i=0; i< collection.length; i++){

			itm += collection[i].value+';'; 
		}

					var url = 'save_minifigures.php';
					var method = 'POST';
					var	params = '&id_user='+id_user;
						params += '&itm='+itm;
						params += '&grupo='+gpo_dest;					
						params += '&action=94';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);		

	}

	//alert(itm);
}

function elimina_item_grupo(id_item){

    var confirma = confirm('¿Confirmas que deseas quitar este item del grupo?'); 

			 
			if (confirma == true) {
               
                    var id_user = document.getElementById('user_id').value; 

                	var url = 'save_minifigures.php';
					var method = 'POST';
					var	params = '&id_user='+id_user;
						params += '&itm='+id_item;				
						params += '&action=95';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	

            }


}

function gpo_opt(id_gpo){

    var edo_div = document.getElementById('gpo_opc_2').style.display; 

    if(edo_div=='none'){
        document.getElementById('gpo_opc_2').style.display = 'block'; 
        
    }else{
        document.getElementById('gpo_opc_2').style.display = 'none';
         
    }

   //alert(edo_div);

    var gpo_origenb = document.getElementById('gpo_orig_'+id_gpo).value;
    var nombre_gpo = document.getElementById('title_'+id_gpo).value;
    var orden_gpo = document.getElementById('orden_'+id_gpo).value;
	var ubi_gpo = document.getElementById('ubic_'+id_gpo).value;

    document.getElementById('gpo_origen').value = gpo_origenb;
    document.getElementById('title_nvo').value = nombre_gpo;
    document.getElementById('orden_nvo').value = orden_gpo;
	document.getElementById('ubi_nvo').value = ubi_gpo;

}

function pre_save_minifig(){
    
    process_names();

	var clave_serie = document.getElementById('no_add').value;	
	var nombresfig_serie = document.getElementById('nombres_fig_add').value;

    var cap_figs = document.getElementById('nombres_fig_add').value;

    var data_figs = cap_figs.split(';');
    var n = 0;

        for(i=0; i< data_figs.length; i++){

            if(data_figs[i].trim() != ''){
                n= n+1;
            }
        }
    var data_figs_final = (data_figs.length-1);

    
      //  alert(data_figs_final);
    

    var tot_def = document.getElementById('figuras_add').value;


    if(n != tot_def){

        var falt = ((tot_def-data_figs_final)-1);

        txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Falta definir figuras </span>';
		    	display_message(txte); 

    }else{
        step(3);

	nombresfig_serie =  nombresfig_serie.replace('&','');

		var url = 'save_minifigures.php';
		var method = 'POST';
		var params = 'clave_serie='+clave_serie;			
			params += '&nombresfig_serie='+nombresfig_serie;			
			params += '&action=96';
		var container_id = 'snackbar';
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		//alert(params);
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text);

    }

}

function pre_save_fotos(){

	var clave_serie = document.getElementById('no_add').value;	
	var nombresfig_serie = document.getElementById('nombres_fig_add').value;
	var asign_serie = document.getElementById('name_asign').value;

	nombresfig_serie =  nombresfig_serie.replace('&','');

		var url = 'save_minifigures.php';
		var method = 'POST';
		var params = 'clave_serie='+clave_serie;			
			params += '&nombresfig_serie='+nombresfig_serie;
			params += '&asign_serie='+ asign_serie;			
			params += '&action=97';
		var container_id = 'snackbar';
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		//alert(params);
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text);



}

function process_names(){

	var nombresfig_serie = document.getElementById('nombres_fig_add').value;
	var data = ''; 
	var data_nm = ''; 
	var n_e = ''; 
	var n_s = '';
	var cont = ''; 
	var n = 0;
    var total_serie = 0;

        
        total_serie = document.getElementById('figuras_add').value;

        for(j=0;j< total_serie; j++){
            m = j+1;

            document.getElementById('nom_es_'+m).value = '';
            document.getElementById('nom_us_'+m).value = '';

        }
        

    
    if(nombresfig_serie.length > 20){
     
        data = nombresfig_serie.split(';');

        for(i=0; i< data.length ; i++){

            n = i+1;

            if(data[i]!=''){
                
                data_nm = data[i].split(',');

                if(data_nm[0].trim() != '' && data_nm[1].trim() != ''){
                    n_e = data_nm[0].trim();
                    n_s= data_nm[1].trim();


                    if(n_e != 'Error en query' && n_e != 'undefined' && n_s != 'Error en query' && n_s != 'undefined'){

                        cont += '<span class="col-sm-8 bg-muted text-muted">'+n+'. [ES]. <span class="col-md-3">'+n_e+'</span> - [EN]. <span class="col-md-3">'+n_s+'</span></span><br>';

                        document.getElementById('nom_es_'+n).value = n_e;
                        document.getElementById('nom_us_'+n).value = n_s;
                    }
                }

            }

        }

        document.getElementById('name_summary').innerHTML= cont;
        document.getElementById('nombres_fig_add').value = nombresfig_serie.replace('&','');

    }

}

function process_names_field(){

	var nombresfig_serie = document.getElementById('nombres_fig_add').value;
	var data = ''; 
	var data_nm = ''; 
	var n_e = ''; 
	var n_s = '';
	var cont = ''; 
	var n = 0;

	data = nombresfig_serie.split(';');

	for(i=0; i< data.length ; i++){

		n = i+1;

		if(data[i]!= ''){
			
			data_nm = data[i].split(',');
			n_e = data_nm[0].replace('&','');
			n_s= data_nm[1].replace('&','');

			cont += '<span class="col-sm-8 bg-muted text-muted">'+n+'. [ES].'+n_e+' - [EN].'+n_s+'</span><br>';
		}

	}

	document.getElementById('name_summary').innerHTML= cont;
	document.getElementById('nombres_fig_add').value = nombresfig_serie.replace('&','');



}


function list_modal(){

	var setsb = ''; 

	var edo_auto = document.getElementById('manuallist_sets').style.display;

	if( edo_auto =='none'){
		document.getElementById('manuallist_sets').style.display = 'block';
		document.getElementById('autolist_sets').style.display = 'none';
		document.getElementById('remove').style.display = 'none';
		
	}else{
		document.getElementById('manuallist_sets').style.display = 'none';
		document.getElementById('autolist_sets').style.display = 'block';
		document.getElementById('remove').style.display = 'block';
	}


}

function process_list_gpo(){

	var itms = document.getElementById('list_manual').value;
	var data_itm = itms.split('\n');
	var options = ''; 
	var n = 0;

	//alert(itms);

	for(i=0; i<data_itm.length ; i++){

		//alert(data_itm[i]);

		if(data_itm[i]!= ''){

			n = n+1
			//alert(data_itm[i]);
			if (document.getElementById(data_itm[i]) !== null){

			setsb = document.getElementById(data_itm[i]).value;
			setsn = document.getElementById('name_'+data_itm[i]).value;

				options += ' <option  class="text-muted " selected style="border-bottom: 1px solid #f3f3f3; padding:5px;" value="'+setsb+'" >'+n+'. '+data_itm[i]+' - '+setsn+'</option> ';
			}else{
				//n= n-1;
				options += '';
			}
		}


	}

	document.getElementById('select2').innerHTML = options;


}

function save_edit_grupo(){

	var new_name = document.getElementById('title_nvo').value;
	var new_orden = document.getElementById('orden_nvo').value;
	var id_user = document.getElementById('user_id').value;
	var id_item = document.getElementById('gpo_origen').value;
	var new_ubi = document.getElementById('ubi_nvo').value;

		if(new_name==''){
			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Introduce un nombre </span>';
		    	display_message(txte); 
		}else if(new_orden==''){

			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Introduce el orden del grupo </span>';
		    	display_message(txte); 

		}else if(new_ubi=='X'){

			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Elije una ubicacion </span>';
		    	display_message(txte); 

		}else{
					var url = 'save_minifigures.php';
					var method = 'POST';
					var	params = 'new_name='+new_name;
						params += '&new_orden='+new_orden;
						params += '&id_user='+id_user;
						params += '&itm='+id_item;
						params += '&new_ubi='+new_ubi;	
						params += '&action=99';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	
		}

}


function copiarAlPortapapeles(id_elemento) {

	alert(id_elemento);

  var aux = document.createElement("input");
  aux.setAttribute("value", document.getElementById(id_elemento).value);
  document.body.appendChild(aux);
  aux.select();
  document.execCommand("copy");
  document.body.removeChild(aux);
}



function edita_fav(id_reg){
	
	//var user= document.getElementById('user').value; 
   // alert(id_reg);

	var data_id = id_reg.split(';');
	var id_fig = data_id[0];
	var user = data_id[1];
	var serie = document.getElementById('serie_act').value;

	
	if(user==0 ){
		alert('Para poder guardar tu colección deberás iniciar sesión o registrarte.'); 
		
	}else{
//alert('ok');
					var url = 'save_minifigures.php';
					var method = 'POST';
					var	params = 'user='+user;
						params += '&registro='+id_fig;
						params += '&serie='+serie;
						params += '&action=100';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	

		 		
	}
}


function actualiza_barra(){

	var current = document.getElementById('total_current').value;
	var total_serie = document.getElementById('total_serie_fig').value;
	var color = document.getElementById('color_serie').value;
	var colorb = document.getElementById('colorb_serie').value;
	var colortxt = document.getElementById('colortxt_serie').value;
	var bck_color ='';
	var color_copa = '';

   //console.log(total_serie);

	var barra = ''; 
	var round = '';
	var cuenta = 0;
	var txt_barra = '';
// determina el ancho de cada barra

	var width_porcent = (100/total_serie);

	// genera las barras 

	for(i=0;i<total_serie;i++){

		if(i == 0){
                round= 'border-radius: 10px 0 0 10px; '; 
        }else{
            	round= ''; 
        }

        if(i<current){
            bck_color = ' background: linear-gradient(90deg, rgba('+color+',1) 35%, rgba('+color+',1) 100%); ';
        }else{

            bck_color = ' background: rgba('+colorb+',0.1);';
        }

        cuenta = i+1;

        txt_barra ='<div class="" style="width:100%; font-size:12px;  color: rgba('+colortxt+',0.9); margin: 0px 10px; float: right;"> '+cuenta+' </div>';

		barra += '<div class="seccion-barra" style="'+round+' text-align:right; border-left:1px solid rgba('+color+',0.5); border-right:1px solid rgba('+colorb+',0.5); margin-top:2px; '+bck_color+' height:20px; width:'+width_porcent+'%";>'+txt_barra+'</div>';

	}





	if(current==total_serie){
		color_copa = 'background: rgba('+color+',1); ' ; 
	}else{
		color_copa = 'background: rgba('+colorb+',0.1); ' ; 
	}
	//document.getElementById('hold_barra_serie').innerHTML='';
	

var copa = '<div class="circle-award" style="border: 0px solid #ccc; text-align:center; vertical-align:middle; z-index:997; background:#ddd; position: absolute; right: -25px; top: -13px; padding:15px; width:60px; height:60px; border-radius:30px; font-size:30px; color: #aaa; ">\
\
	        <button type="button"  style="border: 0px solid #ccc; text-align:center; vertical-align:middle; z-index:997; '+color_copa+' position: absolute; left: 0px; top:0px; padding:15px; width:60px; height:60px; border-radius:30px; font-size:30px; color: #aaa; " class="btn btn-icons btn-outline-secondary btn-rounded "> \
		        <span class="" style="margin-left:0px; margin-top:-11px; color: rgba('+colortxt+',0.9);"> \
		            <i class="fa-solid fa-award"></i> \
		        </span> \
		    </button>\
	       </div>';

	       document.getElementById('hold_barra_serie').innerHTML= barra;
	       document.getElementById('hold_copa').innerHTML= copa;

	//$porcent = ($num_current*100)/$num;
	//$total_serie = $num;

	//$width_porcent = 100/$num;

// <input type="hidden" id="total_serie" value="16">
// <input type="hidden" id="total_current" value="14">
// <input type="hidden" id="color_serie" value="242,203,7">
// <input type="hidden" id="colorb_serie" value="242,215,120">
                    
   //
   //var cur_serie = getElementById('total_current').value;
   //var color = getElementById('color_serie').value;
   //var colorb = getElementById('colorb_serie').value;
         
//console.log(total);



}


/////// 

function getRadiobtnSelectedValue(ctrl){
    for(i=0;i<ctrl.length;i++)	
        if(ctrl[i].checked) return ctrl[i].value;
}


function save_ubicacion(){
		
	var nombre = document.getElementById('new_nombre_ubi').value;
	var id_user = document.getElementById('user_id').value; 


//alert(id_user);
	if(nombre==''){

		txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Introduce una etiqueta </span>';
			display_message(txte); 
	}else{


				var url = 'save_minifigures.php';
				var method = 'POST';
				var	params = 'title='+nombre;
					params += '&id_u='+id_user;		
					params += '&action=102';		
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	



	}
}


function elimina_ubicacion(id){

//var titulo = document.getElementById('nombre_conf').value;
//var seccion = document.getElementById('seccion_conf').value;


//var val_master = get_masterpass();
	 
	var confirma = confirm('¿Confirmas que deseas eliminar esta ubicación?'); 

		 
		if (confirma == true) {
				
				var url = 'save_minifigures.php';
				var method = 'POST';
				var	params = 'id_conf='+id;			
					params += '&action=103';		
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
}	

}


function valida_img(){

	var set = document.getElementById('new_set_cve').value;

	if(set == 0){
		document.getElementById('carga_img').style.display='none';
	}else{
		document.getElementById('carga_img').style.display='block';
	}

}


function convierte_webp(url_set){

	if(url_set==''){
		//txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Selecciona un set</span>';
		//display_message(txte); 
        alert('Selecciona un set');

	}else{

		//txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Procesando</span>';
		//display_message(txte); 
			//alert(url_set);

		var url = 'save_minifigures.php';
		var method = 'POST';
		var	params = 'set='+url_set;
			params += '&tipo=1';		
			params += '&action=104';		
		var container_id = 'snackbar';
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text);	

	}
}

function toggle_img(img){

	var tot_op = document.getElementsByClassName('img_sub_op');

	for(i=1;i<=tot_op.length;i++){

		//alert('side_dive_'+i);

		document.getElementById('img_op_'+i).style.display='none';
		//document.getElementById('btn_op_'+i).style.background='rgba(33, 150, 243, 0.2)';
		//document.getElementById('btn_op_'+i).style.color='#165273';
		//document.getElementById('sub_panel_'+i).style.background='rgba(163, 183, 196, 0.1)'; 

	}

	document.getElementById('img_op_'+img).style.display='block';
}

function estado_barra_col(id_config){

	var id_user = document.getElementById('user_id').value;

	if(id_config==0){
		//txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Selecciona un set</span>';
		//display_message(txte); 
        alert('Error: Sin Referencia');

	}else{

		//txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Procesando</span>';
		//display_message(txte); 
			//alert(url_set);

		var url = 'save_minifigures.php';
		var method = 'POST';
		var	params = 'id_config='+id_config;
			params += '&id_user='+id_user;
			params += '&action=105';		
		var container_id = 'snackbar';
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text);	

	}

}

function toggle_panel(panel){

	var tot_op = document.getElementsByClassName('panel');

	for(i=1;i<=tot_op.length;i++){

		//alert('side_dive_'+i);

		document.getElementById('panel_'+i).style.display='none';
		//document.getElementById('btn_op_'+i).style.background='rgba(33, 150, 243, 0.2)';
		//document.getElementById('btn_op_'+i).style.color='#165273';
		//document.getElementById('sub_panel_'+i).style.background='rgba(163, 183, 196, 0.1)'; 

	}

	document.getElementById('panel_'+panel).style.display='block';
}

/////////

function toggle_tablas(tabla){
    var tot_op = document.getElementsByClassName('op_tablas');
    //console.log(tot_op);

    for(i=0;i<tot_op.length;i++){

		//alert('tabla_'+i);
       // console.log('table_'+i);

		document.getElementById('table_'+i).style.display='none';
		
        document.getElementById('op_'+i).style.background='rgba(250,250,250,0.9)';
		//document.getElementById('btn_op_'+i).style.color='#165273';
		//document.getElementById('sub_panel_'+i).style.background='rgba(163, 183, 196, 0.1)'; 

	}
    document.getElementById('table_'+tabla).style.display='block';
    document.getElementById('op_'+tabla).style.background='rgba(33, 150, 243, 0.2)';
}

//////////


function selecciona_all_chk(forma){
	
	//console.log(forma);
	var total_chk = document.forma.elements.length;
	
	
	       
	//alert(total_chk);


      //if(document.f1.elements[j].dataset.padre == padrea ){
}

function save_seccion(){

	var title = document.getElementById('nombre_seccion').value;
	//alert(title);

	if(title==""){
		txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Nombre de Seccion Inválido </span>';
			display_message(txte); 
	}else{
		var url = 'save_minifigures.php';
		var method = 'POST';
		var	params = 'title='+title;
			params += '&action=106';		
		var container_id = 'snackbar';
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text);	
	}

}

function edit_mnu(id_mnu){

	//alert(id_mnu);

       // var permiso_eliminar 
	
		var url = 'save_minifigures.php';
		var method = 'POST';
		var	params = 'id_mnu='+id_mnu;
			params += '&action=107';		
		var container_id = 'snackbar';
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text);	
	

}

function lista_fotos_sets(){


		var url = 'save_minifigures.php';
		var method = 'POST';
		var	params = 'user=0';
			params += '&action=108';		
		var container_id = 'snackbar';
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text);	

}

function modal_page(page_code){
	
    var cve = '';
	
    if(page_code == '' ){

            cve="79d0442db7beede17d680cdd2186df35";
    }else{

        cve = page_code;

        var url = 'save_minifigures.php';
        var method = 'POST';
        var	params = 'clave_pag='+cve;
            params += '&action=109';		
        var container_id = 'snackbar';
        var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
        // llamamos ajax function
        ajax (url, method, params, container_id, loading_text);	
    }

}

function test_frame(){

	document.getElementById('div_other_page').innerHTML = 'Voila!';

}

function actualiza_reg(data){
	// data = (id_accion-id_reg)

	var data_reg  = data.split('-');
	
	var accion = data_reg[0];
	var id_reg = data_reg[1];
	var tabla= ''; 

	if(accion==1){
		//tabla = 'page_request_user';
		tabla = 'session_user'; 
	}else if(accion==2){		
		
		//tabla = 'session_user'; 
		tabla = 'page_request_user';
	}

	if(accion !=0 ){

		var url = 'save_minifigures.php';
		var method = 'POST';
		var	params = 'id_reg='+id_reg;
			params += '&tabla='+tabla;
			params += '&action=110';		
		var container_id = 'snackbar';
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text);	
	}

}

function elimina_reg(data){
	// data = (id_accion-id_reg)

	var data_reg  = data.split('-');
	var perfil_user = document.getElementById('user_perfil').value;
	
	var accion = data_reg[0];
	var id_reg = data_reg[1];
	var tabla= ''; 
	var accion_elimina = 0;

	if(accion==1){
		//tabla = 'page_request_user';
		tabla = 'session_user'; 
	}else if(accion==2){		
		
		//tabla = 'session_user'; 
		tabla = 'page_request_user';
	}

		if(perfil_user==1){
			accion_elimina = 0;
		}else{
			accion_elimina = 99;
		}


	if(accion !=0 ){

		var url = 'save_minifigures.php';
		var method = 'POST';
		var	params = 'id_reg='+id_reg;
			params += '&tabla='+tabla;
			params += '&accion_per='+accion_elimina;
			params += '&action=111';		
		var container_id = 'snackbar';
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text);	
	}

}

function display_panel(id_btn){

	var tot_op = document.getElementsByClassName('subb_op');

	for(i=1;i<=tot_op.length;i++){

		//alert('side_dive_'+i);

		document.getElementById('sub_panel_'+i).style.display='none';
		document.getElementById('btn_op_'+i).style.background='rgba(33, 150, 243, 0.2)';
		document.getElementById('btn_op_'+i).style.color='#165273';
		//document.getElementById('sub_panel_'+i).style.background='rgba(163, 183, 196, 0.1)'; 

	}

	var data = id_btn.split('_');
	//alert(data[1]);

	document.getElementById('sub_panel_'+data[2]).style.display='block';
	document.getElementById(id_btn).style.background='#165273';
	document.getElementById(id_btn).style.color='#fff';


}
////////
function sub_display_panel(id_btn){

	var tot_op = document.getElementsByClassName('subb_op_gpo');

	for(i=1;i<=tot_op.length;i++){

		//alert('side_dive_'+i);

		document.getElementById('gpo_opc_'+i).style.display='none';
		document.getElementById('sub_btn_op_'+i).style.background='rgba(33, 150, 243, 0.2)';
		document.getElementById('sub_btn_op_'+i).style.color='#165273';
		//document.getElementById('sub_panel_'+i).style.background='rgba(163, 183, 196, 0.1)'; 

	}

	var data = id_btn.split('_');
	//alert(data[1]);

	document.getElementById('gpo_opc_'+data[3]).style.display='block';
	document.getElementById(id_btn).style.background='#165273';
	document.getElementById(id_btn).style.color='#fff';


}
////////


function op_captura(div){
    var tot_op = document.getElementsByClassName('op_cap');
    //console.log(tot_op);

    for(i=1;i<=tot_op.length;i++){

		//alert('tabla_'+i);
       // console.log('table_'+i);

		document.getElementById('div_captura_'+i).style.display='none';
		
        document.getElementById('op_cap_'+i).style.background='rgba(33, 150, 243, 0.2)';
		document.getElementById('op_cap_'+i).style.color='#165273';

	}

    document.getElementById('div_captura_'+div).style.display='block';
    document.getElementById('op_cap_'+div).style.background='#165273';
	document.getElementById('op_cap_'+div).style.color='#fff';


}

function busca_permisos_perfil(cve_perfil){

 //   alert(cve_perfil);
    

    var permisos = '';

    if(cve_perfil==98){
        permisos = '';
        document.getElementById('permisos_perfil').style.display= 'none';
    }else if(cve_perfil==99){
        alert('Selecciona una opcion valida');
        document.getElementById('permisos_perfil').style.display= 'none';

    }else{
        permisos = '';
        document.getElementById('permisos_perfil').style.display= 'block'; 
    }

    var url = 'save_minifigures.php';
    var method = 'POST';
    var	params = 'perfil='+cve_perfil;
        params += '&action=112';		
    var container_id = 'snackbar';
    var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
    // llamamos ajax function
    ajax (url, method, params, container_id, loading_text);	

}

function save_new_perfil(){

    var clave = document.getElementById('new_perfil_clave').value;
    var nombre = document.getElementById('new_perfil_nombre').value;
    var nombre_cto = document.getElementById('new_perfil_corto').value;
    var icono = document.getElementById('new_perfil_icono').value;
    var edo = document.getElementById('new_perfil_estado').value;
    var permisos = document.getElementById('code_permiso').value;
    var permisos_conf = document.getElementById('code_permiso_conf').value;

    

    if(clave==0 || clave == ''){
        txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Introduzca un numero de clave diferente de cero </span>';
			display_message(txte); 
    }else if(nombre==''){
        txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Nombre No Valido </span>';
			display_message(txte); 

    }else if(nombre_cto == ''){
        txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Nombre Corto Inválido </span>';
			display_message(txte); 

    }else if(edo==0){
        txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Seleccione un estado </span>';
			display_message(txte); 

    }else{

      //  alert(permisos);
        var url = 'save_minifigures.php';
        var method = 'POST';
        var	params = 'clave='+clave;
            params += '&nombre='+nombre;
            params += '&nombre_cto='+nombre_cto;
            params += '&icono='+icono;
            params += '&edo='+edo;
            params += '&permisos='+permisos;
            params += '&permisos_conf='+permisos_conf;
            params += '&action=113';		
        var container_id = 'snackbar';
        var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
        // llamamos ajax function
        ajax (url, method, params, container_id, loading_text);	


    }

}

function save_det_perfil(){

    var clave = document.getElementById('perfil_clave').value;
    var nombre = document.getElementById('perfil_nombre').value;
    var nombre_cto = document.getElementById('perfil_nombre_cto').value;
    var icono = document.getElementById('perfil_icono').value;
    var edo = document.getElementById('perfil_estado').value;
    var color = document.getElementById('perfil_color').value;
    var id= document.getElementById('perfil_id').value;

    var url = 'save_minifigures.php';
    var method = 'POST';
    var	params = 'clave='+clave;
        params += '&nombre='+nombre;
        params += '&nombre_cto='+nombre_cto;
        params += '&icono='+icono;
        params += '&edo='+edo;
        params += '&color='+color;
        params += '&id='+id;
        params += '&action=114';		
    var container_id = 'snackbar';
    var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
    // llamamos ajax function
    ajax (url, method, params, container_id, loading_text);	

}

function toggle_images_col(id){

    var menus = document.getElementsByClassName('subb_op');

    //alert (menus.length);

    for(i=1; i<=menus.length; i++){

        document.getElementById('div_images_'+i).style.display='none';       
        document.getElementById('bttn_op_'+i).style.backgroundColor='rgba(33, 150, 243, 0.2)';
        document.getElementById('bttn_op_'+i).style.color='#165273';
		
    }


    document.getElementById('div_images_'+id).style.display='block';
    document.getElementById('bttn_op_'+id).style.backgroundColor='#165273';
    document.getElementById('bttn_op_'+id).style.color='#fff';
}

function toggle_perfil_opc(id){

    var menus = document.getElementsByClassName('perfil_submenu');

    for(i=1; i<=menus.length; i++){

        document.getElementById('div_perfil_'+i).style.display='none';       
        document.getElementById('bttn_op_'+i).style.backgroundColor='rgba(163, 183, 196, 0.1)';
       // document.getElementById('bttn_op_'+i).style.color='#165273';
	   //background: rgba(163, 183, 196, 0.1); color: rgb(108, 117, 125);
		
    }

    document.getElementById('div_perfil_'+id).style.display='block';
    document.getElementById('bttn_op_'+id).style.backgroundColor='rgba(163, 183, 196, 0.4)';
   // document.getElementById('bttn_op_'+id).style.color='#fff';
}

function toggle_sug_opc(id){

    var menus = document.getElementsByClassName('opc_sug');

    for(i=1; i<=menus.length; i++){

        document.getElementById('div_sug_'+i).style.display='none';       
        document.getElementById('bttn_sug_'+i).style.backgroundColor='rgba(33, 150, 243, 0.2)';
        document.getElementById('bttn_sug_'+i).style.color='#165273';
		
    }

    document.getElementById('div_sug_'+id).style.display='block';
    document.getElementById('bttn_sug_'+id).style.backgroundColor='#165273';
    document.getElementById('bttn_sug_'+id).style.color='#fff';

}

function toggle_rec_opc(id){

    var menus = document.getElementsByClassName('opc_rec');

    for(i=1; i<=menus.length; i++){

        document.getElementById('div_rec_'+i).style.display='none';       
        document.getElementById('bttn_rec_'+i).style.backgroundColor='rgba(33, 150, 243, 0.2)';
        document.getElementById('bttn_rec_'+i).style.color='#165273';
		
    }

    document.getElementById('div_rec_'+id).style.display='block';
    document.getElementById('bttn_rec_'+id).style.backgroundColor='#165273';
    document.getElementById('bttn_rec_'+id).style.color='#fff';

}

function select_fig_admin(data){

   // alert(data);
    var data_item = data.split(';');
    var id_item = data_item[0];
    var id_user = data_item[1];
	
	//var user= document.getElementById('user').value; 
	
	if(id_user==0 ){
		//alert('Para poder guardar tu colección deberás iniciar sesión o registrarte.'); 
		
        txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Usuario no encontrado </span>';
		display_message(txte); 

		
	}else{
 			
        var url = 'save_minifigures.php';
        var method = 'POST';
        var params = 'id_item='+id_item;
        params += '&id_user='+id_user;
        params += '&action=115';
        var container_id = 'snackbar';
        var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>' ;
        // llamamos ajax function
        ajax (url, method, params, container_id, loading_text) ;

		 		
	}
}

function edita_fav_admin(id_reg){
	
	//var user= document.getElementById('user').value; 
   // alert(id_reg);

	var data_id = id_reg.split(';');
	var id_fig = data_id[0];
	var user = data_id[1];

	
	if(user==0 ){
		alert('Para poder guardar tu colección deberás iniciar sesión o registrarte.'); 
		
	}else{
//alert('ok');
					var url = 'save_minifigures.php';
					var method = 'POST';
					var	params = 'user='+user;
						params += '&registro='+id_fig;
						params += '&action=116';		
					var container_id = 'snackbar' ;
					var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
					// llamamos ajax function
					ajax (url, method, params, container_id, loading_text);	

		 		
	}
}


function edita_img(img){

var info = img.split('.');


//var current_ext = document.getElementById('current_ext_'+img).value;
//var current_name = document.getElementById('current_name_'+img).value;

var current_ext = info[1];
var current_name = info[0];


document.getElementById('nvo_nombre').value = current_name;
document.getElementById('current_ext_img').value = '.'+current_ext;
document.getElementById('current_nombre').value = current_name;

}

function cambia_nombre_img(){

var nuevo_name = document.getElementById('nvo_nombre').value;
var current_name = document.getElementById('current_nombre').value;
var ext = document.getElementById('current_ext_img').value;
var serie = document.getElementById('current_serie').value;

    if(nuevo_name==''){
        txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Introduzca un nombre valido </span>';
            display_message(txte); 


    }else{
        var url = 'save_minifigures.php';
        var method = 'POST';
        var	params = 'nvo_nombre='+nuevo_name;
            params += '&current_nombre='+current_name;
            params += '&current_ext='+ext;
            params += '&serie='+serie;
            params += '&action=120';		
        var container_id = 'snackbar' ;
        var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
        // llamamos ajax function
        ajax (url, method, params, container_id, loading_text);	
    }

}
//////////////

function cambia_nombre_img_set(){

    var nuevo_name = document.getElementById('foto_name_edit').value;
    var current_name = document.getElementById('nombre_set_actual').value;
    var ext = document.getElementById('foto_ext_edit').value;
   // var set = document.getElementById('current_serie').value;

   document.getElementById('display_imgs').innerHTML = '<div class="col-md-12 center"><span class="text-primary" style="font-size:1rem; margin-top:20px;"> <i class="fa-solid  fa-spinner fa-spin-pulse"></i> Actualizando...</span></div>';

    
        if(nuevo_name==''){
            txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Introduzca un nombre valido </span>';
                display_message(txte); 
    
    
        }else{
            var url = 'save_minifigures.php';
            var method = 'POST';
            var	params = 'nvo_nombre='+nuevo_name;
                params += '&current_nombre='+current_name;
                params += '&current_ext='+ext;
                params += '&action=131';		
            var container_id = 'snackbar' ;
            var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
            // llamamos ajax function
            ajax (url, method, params, container_id, loading_text);	
        }
    
    }

/////////
function elimina_dir(path){

	var confirma = confirm('Confirma eliminar directorio y contenido?');

	if(confirma==true){

		var url = 'save_minifigures.php';
		var method = 'POST';
		var	params = 'ruta='+path;
			params += '&action=121';		
		var container_id = 'snackbar' ;
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text);	
	}

}

function crear_dir(){

	var path = document.getElementById('nvo_dir').value;
	var dir = document.getElementById('nvo_dir_nombre').value;

	if(dir == ''){
		alert('Introduzca un nombre valido');
	}else{



		var url = 'save_minifigures.php';
		var method = 'POST';
		var	params = 'ruta='+path;
			params += '&nombre_dir='+dir;
			params += '&action=122';		
		var container_id = 'snackbar' ;
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text);	

	}

}

function archiva_img(archivo){

	var path_current = document.getElementById('nvo_dir').value;
	//var dir_bk = 'bckup';

	var confirma = confirm('¿Confirma mover la imagen?');

	if(confirma==true){

		var url = 'save_minifigures.php';
		var method = 'POST';
		var	params = 'ruta='+path_current;
			params += '&archivo='+archivo;
			params += '&action=123';		
		var container_id = 'snackbar' ;
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text);	
	}


}

function restaura_img(archivo){

	var path_current = document.getElementById('nvo_dir').value;
	//var dir_bk = 'bckup';

	var confirma = confirm('¿Confirma restaurar la imagen?');

	if(confirma==true){

		var url = 'save_minifigures.php';
		var method = 'POST';
		var	params = 'ruta='+path_current;
			params += '&archivo='+archivo;
			params += '&action=124';		
		var container_id = 'snackbar' ;
		var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		// llamamos ajax function
		ajax (url, method, params, container_id, loading_text);	
	}


}

function save_minifig_extras(data_minifig){

	var data = data_minifig.split('-');
	var user = data[0];
	var id_minifig = data[1];
	var total_minifig = document.getElementById(data_minifig).value;
	var precio = document.getElementById('precio_'+data_minifig).value;

	//alert(total_minifig);

	var url = 'save_minifigures.php';
	var method = 'POST';
	var	params = 'user='+user;
		params += '&id_minifig='+id_minifig;
		params += '&total_minifig='+total_minifig;
		params += '&precio='+precio;
		params += '&action=125';		
	var container_id = 'snackbar' ;
	var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text);	

}

function ver_code(params){

	var data = params.split('-');
	var user = data[0];
	var id_minifig = data[1];

	var url = 'save_minifigures.php';
	var method = 'POST';
	var	params = 'user='+user;
		params += '&id_minifig='+id_minifig;
		params += '&action=126';		
	var container_id = 'snackbar' ;
	var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text);	

}

function genera_csv_minifig(serie){
	

    var	id_user = document.getElementById('user_id').value;
    var serie_list = serie;
    

 //alert(id_user);

//alert(id_user);
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'id_user='+id_user;
					params += '&serie='+serie_list;
					params += '&action=127';
				var container_id = 'snackbar' ;
				var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
				// llamamos ajax function
				ajax (url, method, params, container_id, loading_text);	
	
}

function ver_code_set(params){

	var data = params.split('-');
	var user = data[0];
	var set = data[1];
	var formato = document.getElementById('flatRadiosb').value;
	var format = 0;

	

	if(formato==0){
		format = 1;
	}else{
		format = document.getElementById('flatRadiosb').value;
	}

	//alert(user+'/'+set+'/'+format);

	var url = 'save_minifigures.php';
	var method = 'POST';
	var	params = 'user='+user;
		params += '&set='+set;
		params += '&format='+format;
		params += '&action=128';		
	var container_id = 'snackbar' ;
	var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text);	

}

function get_minifig_canvas(id_min){

//	var data = params.split('-');
//	var user = data[0];
	var id_minifig = id_min;

	var url = 'save_minifigures.php';
	var method = 'POST';
	var	params = '&id_minifig='+id_minifig;
		params += '&action=129';		
	var container_id = 'snackbar' ;
	var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text);	

}

function genera_minifig_extra(){

	var total_img = document.getElementsByClassName('chk_extra');
	var user = document.getElementById('user_id').value;
	var values ='';
	var checks = '';
	var miCheckbox = ''; 
	var miCheckboxb = '';
	var tot = 0;

	for(i=0; i< total_img.length; i++){
		values += document.getElementsByClassName('chk_extra')[i].id+';';
	}

		var data_val = values.split(';');
	
		for(j=0;j<data_val.length;j++){
			if(data_val[j]!= ''){
				
				//console.log(data_val[j]);
				miCheckbox = document.getElementById(data_val[j]).value;
				miCheckboxb = document.getElementById(data_val[j]);
				if (miCheckboxb.checked) {
					tot = tot+1;
					//console.log('¡Checkbox seleccionado!');
					checks += miCheckbox +'|';
				} else {
					checks += '';//console.log('Checkbox no seleccionado.');
				}		
			}	

		}

	
		if(tot>4){
			alert('Solo puedes seleccionar hasta 4 minifiguras');
		}else{

			var url = 'save_minifigures.php';
			var method = 'POST';
			var	params = '&ids_minifig='+checks;
				params += '&user='+user;
				params += '&action=130';	
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	


		}


	//console.log(values);
	//console.log(checks);


}

function edita_dir_opc(){
    var fields = document.getElementsByClassName('fiel_dir');
    var values = ''; 
    var val = '';

	for(i=0; i< fields.length; i++){
		values += document.getElementsByClassName('fiel_dir')[i].id+';';

	}

    var data_fields = values.split(';');

    for(j=0;j<data_fields.length;j++){
        if(data_fields[j]!= ''){
            
            if(j<100){
                document.getElementById(data_fields[j]).disabled=false;
            }else{
                document.getElementById(data_fields[j]).disabled=true;
            }
        }	

    } 

    //alert(values);
}

function reg_impresion(item){
	//alert(item);
	var formato = document.getElementById('flatRadiosb').value;
	var formato_def = 0;
	
	if(formato==0){
		formato_def = 1;
	}else{
		formato_def = document.getElementById('flatRadiosb').value;
	}

	var url = 'save_minifigures.php';
			var method = 'POST';
			var	params = '&item='+item;
				params += '&formato='+formato_def;
				params += '&action=132';	
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
}

function save_edit_perfil(){

	//alert(item);
	var id = document.getElementById('id_perfil').value;
	var clave = document.getElementById('clave_perfil').value;
	var nombre = document.getElementById('nombre_perfil').value;
	var nombre_cto = document.getElementById('nombre_cto_perfil').value;
	var icono = document.getElementById('icono_perfil').value;
	var estado = document.getElementById('estado_perfil').value;
	var color = document.getElementById('color_perfil').value;
	
	//var formato_def = 0;
	
	if(estado==99){
		alert('Seleccione un estado');
	}else{

	var url = 'save_minifigures.php';
			var method = 'POST';
			var	params = '&id='+id;
				params += '&clave='+clave;
				params += '&nombre='+nombre;
				params += '&nombre_cto='+nombre_cto;
				params += '&icono='+icono;
				params += '&estado='+estado;
				params += '&color='+color;
				params += '&action=133';	
			var container_id = 'snackbar' ;
			var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
			// llamamos ajax function
			ajax (url, method, params, container_id, loading_text);	
	}
	
}

function actualiza_user_foto(foto_perfil){
	
	
	var user = document.getElementById('user_id').value;

	var url = 'save_minifigures.php';
	var method = 'POST';
	var	params = '&id_user='+user;
		params += '&foto='+foto_perfil;
		params += '&action=134';	
	var container_id = 'snackbar' ;
	var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text);	


}

function save_invitacion(){
	
	var folio = document.getElementById('inv_folio').value;
	var correo= document.getElementById('inv_correo').value;
	var cupon = document.getElementById('inv_cupon').value;
	var clave_folio = document.getElementById('clave_folio').value;
	var key_clave = document.getElementById('key_clave_folio').value;
	var consecutivo = document.getElementById('consecutivo_folio').value;
	var qr = 0;

	if(document.getElementById('genera_qr').checked) { 
		qr = 1;
	}else{
		qr = 0;
		//
	}
	//alert(folio);

	if(cupon==99){
		alert('Seleccione un Cupon');
	}else{
	var url = 'save_minifigures.php';
	var method = 'POST';
	var	params = '&folio='+folio;
		params += '&correo='+correo;
		params += '&cupon='+cupon;
		params += '&clave_folio='+clave_folio;
		params += '&key_clave='+key_clave;
		params += '&consecutivo='+consecutivo;
		params += '&gen_qr='+qr;
		params += '&action=136';	
	var container_id = 'snackbar' ;
	var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text);	
	}


}

function genera_invitacion(id_invitacion){

	var url = 'save_minifigures.php';
	var method = 'POST';
	var	params = '&id_invitacion='+id_invitacion;
		params += '&action=137';	
	var container_id = 'snackbar' ;
	var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text);	

}


function elimina_inv(info_inv){
	  
	var data_inv = info_inv.split('-');
	var id = data_inv[0];
	var folio = data_inv[1];
	  
	var val_master = get_masterpass();
	   
	  if (val_master == 0) {
		  txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
			  display_message(txte); 
	  }else if (val_master==2) { 
				  txte = '<span class="text-danger"> <i class="fa fa-times" ></i> Esta opcion no esta permitida para tu perfil. </span>';
				  display_message(txte); 
	  }else if (val_master==1) {
		  
		   var url = 'save_minifigures.php';
		  var method = 'POST';
		  var params = 'id='+ id;
		  	  params += '&folio='+folio;				
			  params += '&action=138';		
		  var container_id = 'snackbar' ;
		  var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
		  // llamamos ajax function
		  ajax (url, method, params, container_id, loading_text);	
	  }
	
}

function genera_balance_mensual(tipo){
	var mes = document.getElementById('mes_mov_'+tipo).value;
	var anio = document.getElementById('anio_mov_'+tipo).value;
	var serie = document.getElementById('serie_balance').value;
	var perfil =  document.getElementById('user_perfil').value;

	//alert(perfil);

	var url = 'save_minifigures.php';
	var method = 'POST';
	var params = 'mes='+ mes;
		params += '&anio='+anio;
		params += '&serie='+serie;
		params += '&tipo='+tipo;
		params += '&user_perfil='+perfil;	
		params += '&action=139';		
	var container_id = 'snackbar' ;
	var loading_text = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
	// llamamos ajax function
	ajax (url, method, params, container_id, loading_text);	
}

function all_balance(){
	genera_balance_mensual(1);
	
}