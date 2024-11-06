<?php 

include('minifigures.php');

$token = $_GET['token'];
	
	if(isset($_GET['token'])){
		
		$res_cta = activa_cta_nva($token);
	}else{
		$res_cta = 3; 
	}
	
	
	if($res_cta==1){
		$msg = '<span style="color:#232323"> ¡Gracias por Confirmar su cuenta, Ahora puedes ingresar!</span>';
	}else if($res_cta==0){
		$msg = '<span style="color:#232323"> Cuenta No encontrada: No se ha podido activar su cuenta por que no existe</span>';
	}else if($res_cta==2){
		$msg = '<span style="color:#232323"> Cuenta No encontrada: Hubo un error al activar su cuenta inténtelo mas tarde. </span>';
	}else if($res_cta==3){
		$msg = '';
	}else if($res_cta==4){
		$msg = '<span style="color:#232323"> Cuenta Activa: Esta cuenta ya había sido activada. </span>';
	}else if($res_cta==5){
		$msg = '<span style="color:#232323"> Cuenta BLOQUEADA: No es posible activarla. </span>';
	}else if($res_cta==6){
		$msg = '<span style="color:#232323"> Cuenta Desactivada: Cambie contraseña para activarla. </span>';
	}



////



$num = rand_me();

$back = image_back($num);

//var_dump($num);
//var_dump($back);

	?>


<!doctype html>
<html>
<head>

    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>	
    <script src="assets/js/snowstorm.js"></script>
	    
	    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

     <meta http-equiv="Expires" content="0" />

    <title>BrickShelf Collector | Login <?php echo $name_site; ?></title>
    <!-- plugins:css 
    

    
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,500&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100&family=Economica:ital,wght@0,400;0,700;1,400;1,700&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&family=Lalezar&family=Open+Sans+Condensed:ital,wght@0,300;0,700;1,300&family=Open+Sans:wght@300;400;600;800&family=Pathway+Gothic+One&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Assistant:wght@200;300;400;500;600;700;800&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&family=Roboto&family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Share+Tech&family=Share+Tech+Mono&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400;500;600;700&family=Yanone+Kaffeesatz:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cuprum:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Signika:wght@300;400;500;600;700&display=swap" rel="stylesheet">


     <!--   End Layout styles -->
    
    
    <!-- ///////////. CSS CUSTOMS -->
    <link rel="stylesheet" href="login.css">
    
    <!-- FIN CSS CUSTOMS -->
 
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    



 <script type="text/javascript">

/*global $, document, window, setTimeout, navigator, console, location*/
$(document).ready(function () {
  "use strict";

  var usernameError = true,
    emailError = false,
    passwordError = true,
    passConfirm = true;

  // Detect browser for css purpose
  if (navigator.userAgent.toLowerCase().indexOf("firefox") > -1) {
    $(".form form label").addClass("fontSwitch");
  }

  // Label effect
  $("input").focus(function () {
    $(this).siblings("label").addClass("active");
  });

  // Form validation
  $("input").blur(function () {
    // User Name
    if ($(this).hasClass("name")) {
      if ($(this).val().length === 0) {
        $(this)
          .siblings("span.error")
          .text("Escribe tu nombre de usuario")
          .fadeIn()
          .parent(".form-group")
          .addClass("hasError");
        usernameError = true;
      } else if ($(this).val().length > 1 && $(this).val().length <= 6) {
        $(this)
          .siblings("span.error")
          .text("Al menos 6 caracteres")
          .fadeIn()
          .parent(".form-group")
          .addClass("hasError");
        usernameError = true;
      } else {
        $(this)
          .siblings(".error")
          .text("")
          .fadeOut()
          .parent(".form-group")
          .removeClass("hasError");
        usernameError = false;
      }
    }
    // Email
   if ($(this).hasClass("email")) {
      if ($(this).val().length == "") {
        $(this)
          .siblings("span.error")
          .text("Escribe tu correo")
          .fadeIn()
          .parent(".form-group")
          .addClass("hasError");
        emailError = true;
      } else {
        $(this)
          .siblings(".error")
          .text("")
          .fadeOut()
          .parent(".form-group")
          .removeClass("hasError");
        emailError = false;
      }
    }

    // PassWord
    if ($(this).hasClass("pass")) {
      if ($(this).val().length < 8) {
        $(this)
          .siblings("span.error")
          .text("Al menos 8 caracteres")
          .fadeIn()
          .parent(".form-group")
          .addClass("hasError");
        passwordError = true;
      } else {
        $(this)
          .siblings(".error")
          .text("")
          .fadeOut()
          .parent(".form-group")
          .removeClass("hasError");
        passwordError = false;
      }
    }

    // PassWord confirmation
    if ($(".pass").val() !== $(".passConfirm").val()) {
      $(".passConfirm")
        .siblings(".error")
        .text("No coinciden las contraseñas")
        .fadeIn()
        .parent(".form-group")
        .addClass("hasError");
      passConfirm = false;
    } else {
      $(".passConfirm")
        .siblings(".error")
        .text("")
        .fadeOut()
        .parent(".form-group")
        .removeClass("hasError");
      passConfirm = false;
    }

    // label effect
    if ($(this).val().length > 0) {
      $(this).siblings("label").addClass("active");
    } else {
      $(this).siblings("label").removeClass("active");
    }
  });

  // form switch
  $("a.switch").click(function (e) {
    $(this).toggleClass("active");
    e.preventDefault();

    if ($("a.switch").hasClass("active")) {
      $(this)
        .parents(".form-peice")
        .addClass("switched")
        .siblings(".form-peice")
        .removeClass("switched");
    } else {
      $(this)
        .parents(".form-peice")
        .removeClass("switched")
        .siblings(".form-peice")
        .addClass("switched");
    }
  });

 
  // Reload page
  $("a.profile").on("click", function () {
    location.reload(false);
  });
  
});



FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});

function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}


</script>

<script src="https://demos.9lessons.info/ajaxLoginServer/js/jquery.ui.shake.js"></script>
<script src="assets/js/md5.js"></script>

<script>
$(document).ready(function(){

	$('#entrar').click(function(){
	var username=$("#user").val();
	var password=$("#pass").val();
	var dataString = 'username='+username+'&password='+password;
		if($.trim(username).length>0 && $.trim(password).length>0){
			
		//alert(dataString);
				$.ajax({
					type: "POST",
					url: "ajaxLogin.php",
					data: dataString,
					cache: false,
					beforeSend: function(){ $("#entrar").val('Accediendo...');},
					success: function(data){
				
							var info = data.split('|');
							var edo = info[0];
							var extra = info[1];
                            var id_user = info[2];
                            var last_url = info[3];
							
								if(edo==1){
									//$("body").load("home.php").hide().fadeIn(1500).delay(6000);
									//or
									if(extra==1){
										window.location.href = last_url;
                                        //alert(id_user);

									}else if(extra==0){
										$("#error").html("<span style='color:#cc0000'>IMPORTANTE:</span> Cuenta desactivada, cambie contraseña para reactivarla. ");
										$("#entrar").val('Entrar');
									}else if(extra==4){
										$("#error").html("<span style='color:#cc0000'>Error:</span> Lo sentimo, tu cuenta ha sido desactivada por no cumplir con nuestras reglas de la comunidad. "	);
										$("#entrar").val('Entrar');
									}else if(extra==98){
										$("#error").html("<span style='color:#cc0000'>IMPORTANTE:</span> Cuenta desactivada, cambie contraseña para reactivarla. ");
										$("#entrar").val('Entrar');
									}else{
										$("#error").html(data);
									}
																		//window.location.href = "home.php";
									//$("#error").html(data);
								}else if(edo==2){
									//$("body").load("home.php").hide().fadeIn(1500).delay(6000);
									//or
									if(extra==0){
										$("#error").html("<span style='color:#cc0000'>IMPORTANTE:</span> Usa tu correo electrónico para iniciar sesión. ");
										$("#entrar").val('Entrar');
									}else{
										$("#error").html(data);
									}
																		//window.location.href = "home.php";
									//$("#error").html(data);
								}else if(edo==3){
									//$("body").load("home.php").hide().fadeIn(1500).delay(6000);
									//or
									if(extra==0){
										$("#error").html("<span style='color:#cc0000'> test </span>");
										$("#entrar").val('Entrar');
									}else{
										$("#error").html(extra);
									}
																		//window.location.href = "home.php";
									//$("#error").html(data);
								}else{
									
									if(extra==0){
										
										var user_reset = document.getElementById('user').value;
										$("#error").html("<span style='color:#cc0000'>Error:</span> Cuenta desactivada, cambie contraseña para reactivarla. ");
										$("#entrar").val('Entrar');
										window.location.href = "resetpass.php?user="+user_reset;
									}else if(extra==98){
										$("#error").html("<span style='color:#cc0000'>Cuenta inactiva:</span> Verifique su correo, siga las instrucciones enviadas al mail o restablezca su contraseña."	);
										$("#entrar").val('Entrar');
									}else if(extra==1){
										$("#error").html("<span style='color:#cc0000'>Error:</span> Usuario o contraseña incorrecta, intente de nuevo."	);
										$("#entrar").val('Entrar');
									}else if(extra==4){
										$("#error").html("<span style='color:#cc0000'>Error:</span> Lo sentimo, tu cuenta ha sido desactivada por no cumplir con nuestras reglas de la comunidad. No es posible Usar esta cuenta."	);
										$("#entrar").val('Entrar');
									}else{
										$("#error").html(data);
									}
									
									//Shake animation effect.
									$('#box').shake();
									//$("#error").html(data);
									//$("#entrar").val('Entrar');
									//$("#error").html("<span style='color:#cc0000'>Error: Usuario o contraseña Incorrectos.</span> "+extra);
								}
							}
				});
		}
	return false;
	});

});

///// Registro 


$(document).ready(function(){

	$('#registro').click(function(){
	var username=$("#user_new").val();
	var password=$("#password_new").val();
	var email=$("#email_new").val();
	var passcon=$("#passwordcon_new").val();
	
	var dataString = 'username='+username+'&password='+password+'&email='+email+'&passwordcon='+passcon;
		if($.trim(username).length>0 && $.trim(password).length>0 && $.trim(email).length>0){
			
		//alert(dataString);
				$.ajax({
					type: "POST",
					url: "ajaxRegister.php",
					data: dataString,
					cache: false,
					beforeSend: function(){ $("#registro").val('Enviando...');},
					success: function(datab){
				
				//alert(datab);
							var info = datab.split('/');
							var edo = info[0];
							var extra = info[1];
							
								if(edo==1){
									//$("body").load("home.php").hide().fadeIn(1500).delay(6000);
									//or
									if(extra==1){
										$("#errorb").html("<span style='color:#cc0000'> Tu cuenta a sido registrada, aciva tu cuenta siguiendo las instrucciones enviadas a tu mail.</span>");
										$("#registro").val('Registrar');
										//$("#registro").style.disabled;
									}
									window.location.href = "login.php";
									//$("#error").html(data);
								}else if(edo==0){
									
									if(extra==2){
										
										//var user_reset = document.getElementById('user').value;
										$("#errorb").html("<span style='color:#cc0000'>Error:</span> El correo ya se encuentra registrado");
										$("#registro").val('Registrar');
										//window.location.href = "resetpass.php?user="+user_reset;
										
									}else if(extra==3){
										
										$("#errorb").html("<span style='color:#cc0000'>Error:</span> Lo sentimo, tu cuenta ha sido bloqueada permanentemente."	);
										$("#registro").val('Registrar');
									
									}else{
										
										//alert(extra);
										
										//$("#errorb").html(extra);
										$("#registro").val('Registrar');
									}
									
									//Shake animation effect.
									$('#boxb').shake();
									//$("#entrar").val('Entrar');
									//$("#error").html("<span style='color:#cc0000'>Error: Usuario o contraseña Incorrectos.</span> "+extra);
								}else{
									//$("#errorb").html(datab);
								}//
							}
				});
		}
	return false;
	});

});

</script>

</head>

<body style="background: url(<?php echo $back;?>) -10%; background-size: cover;">
	
	<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v12.0&appId=693976141784406&autoLogAppEvents=1" nonce="zmU59r0R"></script>


	
	<div id="snackbar"></div>
	
	<div class="degrade_modal"></div>
<div class="container">

	
   <section id="formHolder">

      <div class="row">

         <!-- Brand Box -->
         <div class="col-sm-6 brand">
            <a href="#" class="logo">BRICKSIDEMX <span>.</span></a>

            <div class="heading">
               <h2>BRiCK SHELF</h2>
               <p>Collector</p>
            </div>

            <div class="success-msg">
               <p>Bienvenido! Ahora eres un miembro</p>
               <a href="#" class="profile">Tu Perfil</a>
            </div>
         </div>



         <!-- Form Box -->
         <div class="col-sm-6 form">



	            <div class="form-group text-center text-muted" id="message_display" >
               
                </div>
                
               

            <!-- Login Form -->
            <div  class="login form-peice ">
	            
	             
	            
               <form class="login-form" method="post">
	             
	             <div id="box">  
	                  
	                  <div class="form-group">
	                     <div id="error" style="font-size: 14px; font-weight: 400; text-transform: uppercase; "> <?php echo $msg; ?></div>
	                  </div>
		               
	                  <div class="form-group">
	                     <label for="loginemail text-muted">email / user </label>
	                     <input type="text" name="user" id="user" required>
	                  </div>
	
	                  <div class="form-group">
	                     <label for="loginPassword">contraseña</label>
	                     <input type="password" name="pass" id="pass" required>
	                  </div>
	             </div>


					
                  <div class="CTA">
                     <input type="submit" id="entrar" value="Entrar">
                     <a href="#" class="switch">Soy Nuevo</a>
                  </div>
 
                   <div class="CTA">
                     <a href="resetpass.php" class="link">Recuperar Contraseña</a>
                  </div>                
                  
               </form>
            </div><!-- End Login Form -->


            <!-- Signup Form -->
            <div class="signup form-peice switched">


               <form class="signup-form" action="#" method="post">
                <div id="boxb">  
	                
				<div class="form-group">
					<div id="errorb" style="font-size: 14px; font-weight: 300; text-transform: uppercase; "></div>
				</div>	               
	                
                  <div class="form-group">
                     <label for="name">Usuario</label>
                     <input type="text" name="user_new" id="user_new" class="name">
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="email">Correo Electrónico </label>
                     <input type="email" name="email_new" id="email_new" class="email">
                     <span class="error"></span>
                  </div>


                  <div class="form-group">
                     <label for="password">Contraseña</label>
                     <input type="password" name="password_new" id="password_new" class="pass">
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="passwordCon">Confirma Contraseña</label>
                     <input type="password" name="passwordcon_new" id="passwordcon_new" class="passConfirm">
                     <span class="error"></span>
                  </div>
                </div>
                  <div class="CTA">
                     <input type="submit" value="Registrarme" id="registro">
                     <a href="#" class="switch">Tengo una Cuenta</a>
                  </div>
               </form>
            </div><!-- End Signup Form -->
 
       
            
            
         </div>
      </div>

   </section>


   <footer>
      <p style="color: rgba(20,20,20,0.9);">
         Site made by: <a href="http://ah.bluenibble.com" style="color: rgba(20,120,20,0.9);" target="_blank">ppundo</a>
      </p>
   </footer>

</div>

<script type="text/javascript">
	
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = today.getFullYear(); 
	
	if(mm == 12 ){
		snownow();
	}else{
		snowStorm.stop();
	}
</script>

</body>
</html>
