<?php 
include("minifigures.php");
include("globals.php");

$id_inv = $_GET['ref'];

$inv = crear_invitacion($id_inv,'XL');

if($formato == 'C'){
    

}else{

}

?>

<div class="col-12 center" >
    <div class="row col-12 center " style="margin-bottom:50px; ">
        <div class="col-12 " style="height:580px;">
            <img src="assets/images/brickshelf.webp" style="width:55%; margin-top:10%;" >

            <div class="col-12 center text-muted" style="margin-top:-15px; font-size:1rem; padding:5px; font-family:'Montserrat'; font-weight:200;"> 
                            by
            </div>
            <img src="assets/images/brick_color.png" style="height:80px; " >
        </div>

        <div class="col-6 border no-show" style="height: 300px; text-align:left;">
            <div class="col-12" style="margin-left:10px; margin-top:15%;">
                <p>Instrucciones:</p>
                <p class="col-12 text-muted " style="margin:0px auto; font-size:0.9rem;">
                    1. Dirígete al sitio <br>2. Registrate o incia sesión <br>3. Ingresa al apartado Colecciones <br>4. Selecciona una colección con cobro <br>5. Ingresa el código en el campo CUPÓN <br>6.Paga el valor indicado o continua
                </p>
            </div>
        </div>
    </div>

    <div class="col-12 center" style="height:50%; margin-top:100px;" >
        <?php echo $inv; ?>
        <span class="col-12 center" style="margin-top:-35px;" >
            <p class="col-10 text-muted " style="margin:0px auto; font-size:0.6rem;">
            INTRUCCIONES: 1. Dirígete al sitio, 2. Registrate o incia sesión, 3. Ingresa al apartado Colecciones, 4. Selecciona una colección con cobro, 5. Ingresa el código en el campo CUPÓN, 6.Paga el valor indicado o continua<br>
            *** Cupon valido para un solo uso. *** Invitación intransferible.
            </p>
                - 
        </span>
    </div>
    
</div>