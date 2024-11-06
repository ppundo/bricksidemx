<!doctype html>
<html>
<head>

    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>	
	    
	    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

     <meta http-equiv="Expires" content="0" />

    <title>BrickShelf Collector</title>
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
    location.reload(true);
  });
  
});


</script>

<script src="https://demos.9lessons.info/ajaxLoginServer/js/jquery.ui.shake.js"></script>
<script src="assets/js/md5.js"></script>

<script>
$(document).ready(function(){

	$('#recuperar').click(function(){
	var username=$("#userr").val();
	var password=$("#passr").val();
	var passwordr=$("#passbr").val();
	var dataString = 'username_res='+username+'&password_res='+password;
		if($.trim(username).length>0 && $.trim(password).length>0){
			
		//alert(dataString);
				$.ajax({
					type: "POST",
					url: "ajaxLogin.php",
					data: dataString,
					cache: false,
					beforeSend: function(){ $("#recuperar").val('Procesando...');},
					success: function(data){
				
							var info = data.split('/');
							var edo = info[0];
							var extra = info[1];
							
								if(edo==1){

                  $("#errorr").html("<span style='color:#232323'>Cuenta "+extra+" activa, ahora puede iniciar sesión.");
                  $("#recuperar").val('Enviar');
								//window.location.href = "loginb..php";
									//$("#error").html(data);
								}else if(edo==0){

                  $("#errorr").html("<span style='color:#232323'> Error: Cuenta no encontrada"+extra);
                  $("#recuperar").val('Enviar');
                }else{
									
									//Shake animation effect.
									$('#boxr').shake();
									$("#recuperar").val('Enviar');
									$("#errorr").html("<span style='color:#cc0000'>Error:</span> "+extra);
								}
							}
				});
		}
	return false;
	});

});
</script>

</head>

<?php 
	
	$user = $_GET['user'];
	
	?>

<body>
	
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



	            <div class="form-group text-center" id="message_display" >
               
                </div>
                
               

            <!-- Login Form -->
            <div  class="login form-peice ">
	            
	             
	            
               <form class="login-form" method="post">
	             
	             <div id="boxr">  
	                  
	                  <div class="form-group">
	                     <div id="errorr" style="font-size: 14px; font-weight: 300; text-transform: uppercase; "></div>
	                  </div>
		               
	                  <div class="form-group">
	                     <label for="loginemail">email / user </label>
	                     <input type="text" name="user" id="userr" value="<?php echo($user); ?>" required>
	                  </div>
	
	                  <div class="form-group">
	                     <label for="loginPassword">contraseña nueva</label>
	                     <input type="password" name="pass" id="passr" required>
	                  </div>

	                  <div class="form-group">
	                     <label for="loginPassword">repite contraseña nueva</label>
	                     <input type="password" name="pass" id="passbr" required>
	                  </div>

	             </div>


                  <div class="CTA">
                     <input type="submit" id="recuperar" value="Enviar">
                     <a href="login.php" class="link">Tengo una cuenta</a>
                  </div>
 
                   <div class="CTA">
                     
                  </div>                
                  
               </form>
            </div><!-- End Login Form -->


            <!-- Signup Form -->
            <div class="signup form-peice switched">
               
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

</body>
</html>
