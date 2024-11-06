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
	var params = '&param='+param;
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
	
	var url = 'save_minifigures.php';
	var method = 'POST';
	var params = 'item='+id;
	params += '&user_idioma='+ document.getElementById('user_idioma').value;
	params += '&id_user='+ document.getElementById('user').value;
	params += '&values='+ document.getElementById('edita_nombre_es').value+';'+ document.getElementById('edita_nombre_en').value;
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
		}else{
			nvo_estado = 0;
		}
		
		document.getElementById('status-coleccion-'+id).value = nvo_estado; 
		
		////////////////
		
		save_minifigures(id);
		
		adecuaciones(id);
		 		
	}
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
			document.getElementById('star-'+id).style.color = "#ffb703";
			//document.getElementById('star-edita').style.color = "#ffb703";
			//document.getElementById("star-edita").className =document.getElementById("star-edita").className.replace( /(?:^|\s) diactive_star (?!\S)/g , '' );
			//document.getElementById("star-edita").className += " active_star ";
			document.getElementById('hover_collect').style.display="none" ; 

			var tot_fig = parseInt(document.getElementById('tot_fig').innerHTML);
			
			if(total_serie==tot_fig){
				sound(4);
				confetti.start(3000);
				show_congrats();
			}
			
			
		}else{
			// restalo al total de minifiguras. DESACTIVADO
			total_serie = document.getElementById('total_serie').value; 
			total_serie = parseInt(total_serie) - 1; 
			document.getElementById('total_serie').value = total_serie; 
			document.getElementById('estado-'+id).value = 0;
			document.getElementById('total_serie_label').innerHTML= total_serie;
			elem.style.filter = 'opacity(40%) grayscale(100%) blur(0px)';
			document.getElementById('star-'+id).style.color = "#c9c9c9";
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
						document.getElementById('conteo').innerHTML = '<b>'+num_res + '</b> figuras encontradas.';
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

	//alert(last_editado); 
	//var sku = document.getElementById('edita_sku').value; 
	//document.getElementById('tags-'+sku).value = document.getElementById('edita_tags').value;
	//document.getElementById('nombrees-'+sku).value = document.getElementById('edita_nombre_es').value; 
	//document.getElementById('nombreen-'+sku).value = document.getElementById('edita_nombre_en').value; 
	//document.getElementById('pieces-'+sku).value = document.getElementById('edita_piezas').value; 
	
	var id_minifig = document.getElementById('edita_id').value; 
	
	//alert(perfil);
	//alert(last_editado);
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
	
	//alert('Error'); 	
	}
	
	
	//save_faltantes(); 
	//save_names(id_minifig);
	//save_tags(id_minifig);
	//save_pieces(id_minifig);
	//save_foto_minifig(id_minifig); 
	//save_more_info_minifig(id_minifig);
	//save_extras(id_minifig); 
	

	
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
		result  = xhr.responseText;  // tipo accion, estado, mensaje, id, mensaje error. : (100,0-1, texto , 8834-01, mensaje)
		resultb = xhr.responseText;			
	 	  
    	data = result.split('|');
		accion = data[0]; // 100: cambio nombre, 200: Agregar eliminar tags; 300: agregar o quitar coleccion. 
		estado = data[1]; // 0: error; 1: exito; 
		figura = data[2]; // el nombre de la minifigura. 
		serie = data[3];
		error = data[4];
		var mensaje;
		
		var es="";  
		var en=""; 
		
//	alert(result+' Acción: '+accion);
							       
		if(error == "" ){       

		}else if(error != ""){
				 mensaje = error;

 		}// mensaje 
							       		       					      							       
 		console.log(mensaje);
	
		if(mensaje != ""){
			var len = mensaje.length;
			
			if(len >= 20){			
				document.getElementById(container_id).innerHTML = mensaje;
				desapear(document.getElementById(container_id));
			}else{
				
			}
		}
	
							       
	}else { // waiting for result 
		document.getElementById(container_id).innerHTML = loading_text;
	}
		
}
	xhr.open(method, url, true);
	xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xhr.send(params);
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

return fecha_format;
}

///////////////////////////////////////////////

function valida_step(step) {
	
	var clave = document.getElementById('no_add').value;
	var total_field = document.getElementById('figuras_add').value;
	var nombres_fig = document.getElementById('nombres_fig_add').value;
	
	switch(step){
		
		case 1: 
		break; 
		
		case 2: 
		break;
		
		case 3: 
			
			if(clave==0 || clave==''){
				display_message('El campo <b>CLAVE LEGO</b> es requerido.');
				
			}else if(total_field==0 || total_field ==''){
				display_message('El campo <b>TOTAL DE FIGURAS</b> es requerido.');
				
			}
		
		
		
		break; 
		
		case 4: 
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
	
	var ruta = 'minifig/'+serie+'/'+nva_foto; 
	
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
		
		var url = 'save_minifigures.php';
		var method = 'POST';
		var params = 'nombre_serie='+ nombre_serie;
		params += '&clave_serie='+ clave_serie;
		params += '&fecha_serie='+ fecha_serie;
		params += '&color_serie='+ color_rgb;
		params += '&estado_serie='+ estado_serie;
		params += '&nombresfig_serie='+ nombresfig_serie;
		params += '&total_serie='+ total_serie;
		params += '&tipo_serie='+ tipo_serie;
		params += '&precio_serie='+ precio_serie;
		params += '&moneda_serie='+ moneda_serie;
		params += '&premium='+ premium;
		params += '&asign_serie='+ asign_serie;
		params += '&action=13';
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
			
			var color_rgb = hexToRgb(color).r +','+ hexToRgb(color).g +','+ hexToRgb(color).b;
			//alert(color_rgb);
			
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
				params += '&action=15';
				params += '&val='+color_rgb;
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

		case '4': // Eliminar
		
	var val_master = get_masterpass();
		 
		if (val_master == 0) {
			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
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
		break;
		
		case '5': // Actualizacion de correo, perfil , etc.
		
	var val_master = get_masterpass();
		 
		if (val_master == 0) {
			txte = '<span class="text-danger"> <i class="fa fa-times" ></i> La contraseña Maestra no coincide, intente de nuevo. </span>';
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
		
				 		
	}

//	alert(action+' item: '+ reg);
	
	//prompt("Please enter your name:")
	
}


function get_masterpass(){
	
	var master_token = document.getElementById('user_token').value; 
	var resultado_master ;
	var master = prompt("Introduzca la Contraseña Maestra:", "");
		 
		 var master_code = MD5(master); 
		 
		if (master_code == null || master_code == "") {
			
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
	var nombre = document.getElementById('nombre').value;
	var apellido = document.getElementById('apellido').value;
	var f_nac = document.getElementById('f_nac').value;
	
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


  function mostrarContrasena(id){
      var tipo = document.getElementById(id);
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }
  
  
  function save_menu(id){
	  
	  var clave = document.getElementById('cve_'+id).value; 
	  var file = document.getElementById('file_'+id).value;
	  var id_padre = document.getElementById('id_padre_'+id).value;
	  var title = document.getElementById('title_'+id).value;
	  var id_p_o = document.getElementById('id_padre_original_'+id).value;
	  var nivel = document.getElementById('nivel_'+id).value;
	  
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
			var logo= document.getElementById('tema_logo_'+reg).value;
			
			var color_rgb = hexToRgb(color).r +','+ hexToRgb(color).g +','+ hexToRgb(color).b;
			var color_rgb_b = hexToRgb(colorb).r +','+ hexToRgb(colorb).g +','+ hexToRgb(colorb).b;
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
	
	document.getElementById('new_set_foto').value = name_set + '.jpg'; 
	
}


function save_new_set(){
	
			var id_user = document.getElementById('user_id').value;  
			var cve = document.getElementById('new_set_cve').value;
			var nombre = document.getElementById('new_set_nombre').value;
			var tema = document.getElementById('new_set_tema').value ;
			var piezas = document.getElementById('new_set_piezas').value; 	
			var precio = document.getElementById('new_set_precio').value;
			var anio = document.getElementById('new_set_anio').value;
			//var id = document.getElementById('new_set_id').value;
			var foto = document.getElementById('new_set_foto').value;
			var aniob; 
			var fotob; 
			var piezasb; 
			var preciob;
			var men;
			var container = 'new_set_status'; 
			
			//alert(tema);

			
			//var barra_status = document.getElementById('new_set_status'); 
			if(cve == ''){
			
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Ingresa la CLAVE LEGO para el set. </span>'; 
				document.getElementById(container).innerHTML = men;
				desapear(document.getElementById(container));
				
			}else if( nombre== '' ){
				
				men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-times"> </i> Ingresa un NOMBRE para el set. </span>'; 
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
	
try{
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
											document.getElementById('new_set_foto').value = datos;
											document.getElementById('prev_image').innerHTML = msj;
											document.getElementById(btn_id).innerHTML = ready;
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
											document.getElementById('display_image_set').innerHTML = msj;
											document.getElementById(btn_id).innerHTML = ready;
											//var msje = 'Imagen cargada con exito, ahora puede guardar el set';
											//display_message(msje);
											men = '<span style="border:0px solid #ccc; padding: 0px 10px;  "> <i class="fa fa-check"> </i> Imagen cargada con exito, ahora puede guardar el set. </span>'; 
											document.getElementById(container).innerHTML = men;
											desapear(document.getElementById(container));
											
										}else if(estado==1){
											document.getElementById(btn_id).innerHTML = ready;
											document.getElementById('display_image_set').innerHTML = '';
											document.getElementById('display_image_set').innerHTML = msj;
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
					
		}catch(err) {
		  alert(err.message);
		}		
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
		//alert('hola!');		
		// toma la informacion de la figura
		
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
		var folleto = document.getElementById('folleto-'+id).value; 
		var extras = document.getElementById('extras-'+id).value;  

		/// preoara tgas de busqueda para desplegarlos
		// p.replace('dog', 'monkey')
		tags = tags.replace(' ','');
		var data_tags = tags.split(',');
		//data_tags = data_tags.replace(' ', '');
		
		var cont_tags = '';
		
		for(i=0; i< data_tags.length; i++){
			if(data_tags[i] != '' && data_tags[i] != ' '){
				cont_tags += '<span class="bubble_text_md bg-secondary" style="display:inline-block;  "> <span class="tag_label"><i class="fas fa-circle"></i></span> '+data_tags[i]+'</span>';  
			}
		}
		//////////////
		
		
		if(piezas.length<=1){
			piezas = 'cabeza, torso, pies, brazo derecho, brazo izquierdo, cabello/gorro';
			
		}else{
			piezas = document.getElementById('pieces-'+id).value; 
		}
		
		
		//
		//var data = id.split('-');
		
		//var clave= data[0];
		
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
		
		
		/// Comprueba imagen folleto 
		
				var image_folleto = '';
				var url_folleto = '';
				var url_folleto_no = '';
				var res_exist ='';
				
				url_folleto = 'assets/images/sheet/'+clave+'.jpg';
				url_folleto_no = 'assets/images/noimage.png';
		
				
				res_exist = imageExists(url_folleto);
				
				//alert(url_folleto+'-'+res_exist);
				
				if (res_exist == true){
					image_folleto = '<img id="folleto" style="max-width: 90%; max-height:90%; display:none;  "  src="'+url_folleto+'" class="" >';
				}else{
					image_folleto = '<img id="folleto" style="max-width: 90%; max-height:90%; display:none;  "  src="'+url_folleto_no+'" class="" >';
				}
		
				//var image_folleto = '<img id="folleto" style="width: 200px; display:none;  "  src="'+url_folleto+'" class="" >';
		
		///
			
		// inserta la info en la platilla de edicion 
		
		var idioma = document.getElementById('user_idioma').value;
		var nombre_title; 
		
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
		}else{
			lbl_fecha = format_fecha(fecha);
		}
		
		document.getElementById('title_nombre').innerHTML = nombre_title; 
		document.getElementById('edita_serie').value = serie;
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
		//document.getElementById('image_holder_c').innerHTML =image;
		document.getElementById('edita_index').value = index_item;
		document.getElementById('edita_id').value = id_item;
		//document.getElementById('edita_faltantes').value = faltantes;
		document.getElementById('edita_fecha').value = fecha;
		document.getElementById('lbl_fecha').innerHTML = lbl_fecha;
		document.getElementById('edita_extras').value = extras;
		document.getElementById('hold_tags').innerHTML = cont_tags;
		
		var ico_estado =""; 
		var ico_colected = "";
		var clase = ""; 
		//alert(estado);
		
		if(estado==1){
			
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
		/* 
		var cell = ''; 
		var estado = ''; 
		var id= ''; 
		var current = 0; 
		var cant = ''; 
		
		for(i=0; i< 12; i++){
			current = i+1; 
			if(folleto == current){
				estado = '';
				id = 'id= "edita_extra"';
				cant = '';
			}else{
				estado = 'disabled';
				id= ''; 
				cant = '-';
			}
		
		cell += '<div class="minigrid_cell"> <input type="number" '+estado+' min="0" max="10" class="form-control" '+id+' placeholder="'+cant+'"> </div>';
		}
		////// */
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
		
		
		
		image = path+foto_figure+'.png';
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
		
		document.getElementById('disp_image_minifig').src = path + foto_nva; 
		
		
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
		var url = document.getElementById('url-'+id).value; 
		var faltantes = document.getElementById('faltantes-'+id).value;
		var fecha = document.getElementById('fecha-'+id).value; 
		var folleto = document.getElementById('folleto-'+id).value;
		var extras = document.getElementById('extras-'+id).value; 
		
		/// preoara tgas de busqueda para desplegarlos
		tags = tags.replace(' ','');
		var data_tags = tags.split(',');
		//data_tags = data_tags.replace(' ', '');
		
		var cont_tags = '';
		
		for(i=0; i< data_tags.length; i++){
			if(data_tags[i] != '' && data_tags[i] != ' ' ){
				cont_tags += '<span class="bubble_text_md bg-secondary" style="display:inline-block; font-size: 12px;"> <span class="tag_label "><i class="fas fa-circle"></i></span> '+data_tags[i]+'</span>'; 
			}
		}
		//////////////
		
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
		var image_folleto = '<img id="folleto" style="max-width: 90%; max-height:90%; display:none;" src="'+url_folleto+'"  >';
			
		// inserta la info en la platilla de edicion 
		
		///// determina idioma 
	var nombre; 
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
		}else{
			lbl_fecha = format_fecha(fecha);
		}
				
		document.getElementById('title_nombre').innerHTML = nombre;
		document.getElementById('edita_serie').value = serie;
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
		//document.getElementById('image_holder_c').innerHTML =image;
		document.getElementById('edita_index').value = index_item;
		document.getElementById('edita_id').value = id_item;
		//document.getElementById('edita_faltantes').value = faltantes;
		document.getElementById('edita_fecha').value = fecha;
		document.getElementById('lbl_fecha').innerHTML = lbl_fecha;
		document.getElementById('edita_extras').value = extras;
		document.getElementById('hold_tags').innerHTML = cont_tags;
		
		var ico_estado =""; 
		var ico_colected = "";
		var clase = ""; 
		//alert(estado);
		
		if(estado==1){
			
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
	
	var title = document.getElementById('mnu_'+img).getAttribute('title');
	
	document.getElementById('display_'+img).style.display = 'block'; 
	document.getElementById('file_'+img).style.display = 'block'; 
	document.getElementById('display_min_'+img).style.display = 'block'; 
	
	document.getElementById('title_nombre_image').innerHTML =  title.toUpperCase() ; 
	document.getElementById('title_file').innerHTML = title.toUpperCase() ; 
	
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
	}

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



function permisos_perfil(){
	
	var perfil = document.getElementById('perfil_permisos').value; 
	
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
	document.getElementById('show_permisos_perfil').innerHTML= '<br><h4 class="card-title text-primary">Resúmen</h4> <p>Los siguientes '+no+' permisos serán otorgados:</p><p>'+chks_name+'</p>';
	
}


////

function save_permisos(){

		 var code = ''; 
		 var tam = ''; 
		 var per = '';
		 
		 code = document.getElementById('code_permisos_perfil').value; 
		 perfil = document.getElementById('perfil_permisos').value;
		 
		 	 
		 tam = code.length;
		 
		 if(tam == 0){
			 alert('Seleccione las secciones para las que este perfil tendra acceso.');
			 
		 }else{
	 
				var url = 'save_minifigures.php';
				var method = 'POST';
				var params = 'code='+code;
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