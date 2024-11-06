
<?php


    $url = 'assets/images/qr_invitacion/';


    ?>
	

    <div class="col-md-12 bg-light " style="padding:0px; ">
        <h4 class="col-md-12 p-3 title_sec"> Administrar QR Invitaciones </h4>
                 
                        
         <div class="col-md-12 row" style="background:rgba(250,250,250,0.7); padding:0px; height:470px; z-index:99; ">
             
                <div class="col-md-8 border-right "style="border: 0px solid #c30; padding:0px; " >
                    <label class="col-md-12 p-2 subtitle_sec center" style="margin:0px;"> QR Encontrados </label>
                    
                    <div class="card-body" id="list_minifig_img" style=" padding:0px 0px 0px 15px; height:431px; border: 0px solid #c34;overflow: scroll; overflow-x: hidden; overflow-y: auto; " id="hold_labels_images" >
                        <?php
                            
                            $info = admin_fotos_qr_inv($url,0);                    
                            echo $info; 
                        ?>
                    </div>
                                                                             
                </div>
         
         <!-- Panel Imagen -->
             <div class="col-md-4 grid-margin border-right" style="max-height: 400px; padding:0px;" >
                <label class="col-md-12 p-2 subtitle_sec" style="margin:0px;"> Editar Imágen</label>
  
                <!-- barra de herramientas -->
                <div class="mnu_bar " style="padding: 5px 10px;">								
                    <div class=" btn-group-bar" role="group" style="margin-bottom: 2px;"> 
                        
                        <button id="imagesedit_1" type="button" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar_sm imagesedit imagesedit_sm "> <i class="fa-solid fa-pencil"></i> </button>
                        <button id="imagesedit_2" type="button" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar_sm imagesedit imagesedit_sm "> <i class="fa-solid fa-folder-tree"></i> </button>
                        <button id="imagesedit_3" type="button" onclick="barmenu(this.id)" class="btn btn-inverse-primary btn_menubar_sm imagesedit imagesedit_sm"> <i class="fa-solid fa-upload"></i></button>
                                    
                    </div>
                </div>
                    
  
                        <div class="card-body" >

                            <div id="div_imagesedit_1" style="display:block;">
                                <div name="edita_img" class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-muted border-primary">
                                            <span class=" input-group-text bg-transparent" style="width: 120px;"> Nuevo Nombre </span>
                                        </div>
                                        <input type="text" class="form-control col-md-3" id="nvo_nombre" placeholder="Nuevo Nombre" aria-label="Nuevo Nombre" aria-describedby="colored-addon2">
                                        <input type="text" class="form-control col-md-3" disabled id="current_ext_img" placeholder=".ext" aria-label=".ext" aria-describedby="colored-addon2">
                                        <input type="hidden" id="current_nombre" value="" >
                                        <input type="hidden" id="current_serie" value="<?php echo $clave_lego; ?>" >
                                        
                                    </div>                            

                                </div>

                                <div class="form-group">
                                    <button type="button" class="btn btn-primary btn-block" onclick="cambia_nombre_img();" ><i class="fa-solid fa-save"></i> Actualizar </button>
                                </div>
                            </div><!-- opc_img_1-->

                            <div id="div_imagesedit_2" style="display: none;">

                                <div class="input-group">
                                        <div class="input-group-prepend bg-muted border-primary">
                                            <span class=" input-group-text bg-transparent" > <i class="fa-solid fa-folder-tree"></i> </span>
                                        </div>
                                        <input type="text" class="form-control col-md-8" id="nvo_dir" disabled value="<?php echo $url;?>" aria-label="Nuevo Nombre" aria-describedby="colored-addon2">
                                    </div>  


                                    <div class="input-group" style="margin-top:10px;">
                                        <div class="input-group-prepend bg-muted border-primary">
                                            <span class=" input-group-text bg-transparent" > <i class="fa-solid fa-folder-plus"></i></span>
                                        </div>
                                        <input type="text" class="form-control col-md-8" id="nvo_dir_nombre" placeholder="Nueva Carpeta" aria-label="Nueva Carpeta" aria-describedby="colored-addon2">
                                    
                                        <button type="button" class="btn btn-inverse-primary" id="btn_up_foto_minifig" onclick="crear_dir(); "> <i class="fa fa-save"></i> Crear </button>
                                        
                                    </div>    
                            </div><!-- opc_img_2-->

                            <div id="div_imagesedit_3" style="display: none;" >

                                <div id="hold_subir_imagen" style="">
                                    <div class="form-group row compacted grid-margin ">
                                        
                                        <form name="form_up_minifig" method="post" action="?" id="form_up_minifig" enctype="multipart/form-data">  
                                            <input type="file" name="foto_minifig" class="form-control " id="foto_minifig" placeholder="Imagen">
                                            
                                            <div class="form-group" style="margin-top: 15px;;">
                                                <button type="button" class="btn btn-primary btn-block" id="btn_up_foto_minifig" onclick="save_foto(6); "> 
                                                <i class="fa fa-save"></i> Guardar Foto </button>
                                            </div>
                                            <input type="hidden" name="serie_minifig" id="serie_minifig" value="<?php echo $clave_lego;?>" >
                                            <input type="hidden" name="tipo" value="6" >
                                            <input type="hidden" name="user_perfil" id="user_perfil" value="<?php echo $user_per;?>" >
                                        </form>
                                    </div> 
                                    
                                    
                                    <div id="prev_image_minifig_admin" class="row form-group compacted" style=" display: block; border: 0px solid #ccc;  ">
                                        
                                    </div>
                                </div>
                            </div><!-- opc_img_3-->



                        </div><!-- card body-->
                 
            </div>



             <div class="col-md-4 grid-margin " style="padding: 0px;" >

                 
                <div class="col-md">
 

                </div>

             </div>					
             
         </div>
         
     </div>
    

 
