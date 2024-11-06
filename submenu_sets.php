
	<?php 

require("access.php");
include("globals.php");

$id_user_b = $_GET['user'];
// $_GET

//$id_user_b = 1;

				$estado_link = get_estatus_link($id_user_b);
				
				$modal_link = $link_site.'?mnu='.$mnu.'&cve='.$cve.'&mod=1'; 
				
				if($estado_link==0 or $estado_link==2){
					
					$link = '
					
						<button style="" onclick="genera_enlace(\''.$id_user_b.'\');"  class="btn btn-icons btn-rounded btn-inverse-secondary"> 
							<i class="fa fa-toggle-off fa-md"></i> 
						</button>

						
						<input type="hidden"  id="url_user" class="form-control text-primary" style="border-radius:5px; background: transparent; width: 50%; margin-top:2px; " ></input>
						<input type="hidden" id="token_user_current" class="form-control text-primary" value="0" >
					';
					
					$token_field= '';
					$disp_link = 'none';
					
					$nlace = '';
					
					$btn_link = '
					<div class="col-md-12 row ">
						<label class="text-muted col-form-label" style=""> <i class="fa fa-user"></i> </label> 
						
						<a class="" href="#" onclick="genera_enlace(\''.$id_user_b.'\');" style="float:right; margin:6px 10px;" > 
							<span class="text-secondary"><i class="fa fa-toggle-off fa-md"></i></span>
						</a> 
						
						<input type="hidden" id="token_user_current" class="form-control text-primary" value="0" >
						
						<span class="text-primary" id="link_ext" style="margin:6px 10px;"> </span>
					</div>
					
					<a href="'.$modal_link.'" style="float:right; margin:6px 10px;" ><i class="fa fa-link"  ></i></a>
					 ';
					 
					 $url = '';
					 
				}elseif($estado_link==1){

					$token = get_info_link($id_user_b);
					$pag = md5('public_coleccion');
					$url = $link_site_public.'mnu='.$pag.'&token='.$token;
					
					$disp_link = 'block'; 
					
					$link = '
					
						<button style="" onclick="genera_enlace(\''.$id_user_b.'\');"  class="btn btn-outline-secondary"> 
							<span class="text-success"> <i class="fa fa-toggle-on fa-md"></i> </span>
						</button>	
						
					';

					$token_field = '<input type="text" autocomplete="off" readonly id="token_user" class="col-md-12 form-control text-primary" value="'.$token.'" style="background: transparent; margin-top:10px; " >
                    <input type="hidden" id="token_user_current" class="form-control text-primary" value="'.$token.'" >
                    '; 
					
					$nlace = '


						<a style="padding: 7px 10px; font-size: 18px;" target="_new" href="'.$url.'" class="btn btn-outline-secondary btn-md text-primary"> 
							<i class="fa fa-external-link-square-alt"></i> 
						</a>					
					'; 
					
					

					
					$btn_link = '
					<div class="col-md-12 row ">
						<label class="text-muted col-form-label" style=""> <i class="fa fa-user-check"></i> </label>					
					
						<a class="" href="#" onclick="genera_enlace(\''.$id_user_b.'\');" style="float:right; margin:6px 10px;" >
							<span class="text-success"><i class="fa fa-toggle-on fa-md"></i></span> 
						</a> 
						
						<input type="text" autocomplete="off" id="url_user" class="form-control text-primary" value="'.$url.'" style=" background: transparent; margin-top:2px; " >
						
						<input type="hidden" id="token_user_current" class="form-control text-primary" value="'.$token.'" >
						
						<span class="text-primary" id="link_ext" style="margin:6px 10px;">
							<a href="#" class="text-primary"> <i class="fas fa-copy"></i> </a>
						</span>
												
						<span class="text-primary" id="link_ext" style="margin:6px 10px;">
							<a target="_new" href="'.$url.'" class="text-primary"> <i class="fas fa-external-link-square-alt"></i> </a>
						</span>
					</div>
					
					<a href="'.$modal_link.'" style="float:right; margin:6px 10px;" ><i class="fa fa-link"  ></i></a>
					';
				
					$id_user_b = $GLOBALS['user'];
					/// QR de la iat publica
						$nombre_fichero = 'assets/images/qr_sets/public_url/collect/public_collect_'.$id_user_b.'_'.$token.'.webp';
						
						if (file_exists($nombre_fichero)) {
						
							$codigo_qr = '<img id="qr_public_'.$rowb['cve_lego'].'" style="height:130px;" src="data:image/webp;base64,'.base64_encode(file_get_contents($nombre_fichero)).'" class="qr_img_lg" name="current" />'; 
						
						} else {
						
							$nombre_fichero_png = 'assets/images/qr_sets/public_url/collect/public_collect_'.$id_user_b.'_'.$token.'.png';
							
							if (file_exists($nombre_fichero_png)) {
									$qr_webp = convert_to_webp_url_gral($nombre_fichero_png);
							}else{

							//  https://bricksidemx.com/collector/public.php?mnu=cd5f90d1197d987d093045dd1c50e22a&token=5Mvwozq8x2qmINHXEVVVNKWi
								$url_ext = $path_site.'public.php?mnu=cd5f90d1197d987d093045dd1c50e22a&token='.$token;

								$qr_png= genera_qrcode_public_collect($url_ext,$token);
								$qr_webp = convert_to_webp_url_gral($qr_png);
							}
							
						//src="data:image/png;base64,'.base64_encode(file_get_contents($foto)).'"
						
							$codigo_qr = '<img style="height:130px;" id="qr_public_'.$rowb['cve_lego'].'" src="data:image/webp;base64,'.base64_encode(file_get_contents($qr_webp)).'" name="nuevo" class="qr_img_lg"  />'; 
						}
					}
	?>

<div class="col-md-12" style="padding:0px; ">
<h4 class="col-md-12 p-2 title_sec grid-margin" >Link Coleccion </h4>

	<div class="col-md-12 " style="margin-top:10px;">
                
                  <div class="row col-md-12  " style="margin-bottom:0px; ">
                        <span class=" text-muted " style="margin-right:20px;" > Compartir</span>
                        <div class=" " >   <?php echo $link; ?></div>
                  </div>     
				  
				  <?php echo $token_field; ?>
                
              </div>

                <hr>

           <div class="col-md-12 grid-margin" style="margin-top: 10px; ">
                <div class="row col-md-12 " style="margin-bottom:0px;">
                    
                    <span class="text-muted"   style="margin-right:20px;"> Enlace </span>
                    
                    <div class=" btn-group " role="group">
                        	<a class="btn btn-outline-secondary text-primary" onclick="copiarAlPortapapeles('url_user')" style="padding: 7px 10px; font-size: 18px;" > 
                                <i class="fa-solid fa-copy"></i>
                            </a>
             				<?php echo $nlace; ?>
                    </div>

                    <input id="url_user" type="text" style="border-radius: 5px; padding: 0 5px; margin-top:10px;" readonly class="form-control col-md-12 txt_link text-primary " value="<?php echo $url; ?>"> 
                </div>
            </div>
                
                 


                <hr>

                <div class="col-md-12 grid-margin" style="margin-top: 10px; ">
					<?php echo $codigo_qr; ?>
                </div>
</div>

		

		<script>
function copyClipboard(element) {
  var $bridge = $("<input>");
  $("body").append($bridge);
  $bridge.val($(element).text()).select();
  document.execCommand("copy");
  $bridge.remove();
}
</script>
