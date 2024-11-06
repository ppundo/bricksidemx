<?php
	
$perfil_user = $GLOBALS['user_perfil'];
$user = $_SESSION['clave_user'];		

	if($user==0 or $user==""){
			
		echo '<meta http-equiv = "refresh" content = "0; url = http://shelf.bricksidemx.com/collector/index.php?access=1" />';
			
	}else{
		

	
	


?>
<div class="row ">
	<div class="col-sm-3 col-fix">
		<div class="p-2 border-bottom" style=" padding-bottom: 15px; ">
			<h4 class="card-title" style="padding-bottom: 5px;" >
				<a href="#" ><span class="card-title-fig mb-0 text-success" style="float: left;" id="title_nombre">
					<span>
					<i class="fa fa-user"></i> Usuarios
					</span>
				</a>
						                   
			</h4>
			<span id="serie_act">
				<?php 
			$ser = $_GET['det'];
			
					$user_info = busca_user($ser);
					$data_user = explode('--', $user_info);
					$error = $data_user[0];
					$nombre = $data_user[1];
					$correo = $data_user[2];
					$user_name = $data_user[3];
					$foto = $data_user[4];
			
			if(isset($ser)== TRUE){
				
				//echo '<span class="text-light bubble_text_lg bg-neutral">Usuario: '.$user_name.'</span>';
				
						echo '
						<span class="text-light bubble_text_lg bg-neutral"> 
						<a class="text-light" href="http://shelf.bricksidemx.com/collector/index.php?mnu=bc5986ebbf4dde661f229fd527ad82f4&current='.$user.'" >
						<i class="fa fa-times" ></i> '.$user_name.'
						</a>
						</span>';
				
			}else{
				echo '<span class="text-light bubble_text_lg"></span>'; 
			}					
					
				?>
			</span>			
			</div>
			
		<div class="scrollable" id="mkt_users">
			<div>
				
				<?php echo get_users_mkt();  ?>
				
				
			</div>
		</div>
	</div>
	
	<div class="col-sm-3 col-fix">
		<div class="p-2 border-bottom" style="text-align: left; " >
			<h4 class="card-title" style="padding-bottom: 5px;" >
				<a href="#" ><span class="card-title-fig mb-0 text-success" style="float: left;" id="title_nombre">
					<span>
					<i class="fa fa-box-open"></i> Series
					</span>
				</a>						                   
			</h4>
			<span id="serie_act">
				<?php 
			$ser = $_GET['cve'];
			$user = $_GET['det'];
			if(isset($ser)== TRUE){
				
				echo '<span class="text-light bubble_text_lg bg-neutral"> 
						<a class="text-light" href="http://shelf.bricksidemx.com/collector/index.php?mnu=bc5986ebbf4dde661f229fd527ad82f4&det='.$user.'" >
						<i class="fa fa-times" ></i> '.$ser.'
						</a>
						</span>';
				
			}else{
				echo '<span class="text-light bubble_text_lg "></span>';
			}					
					
				?>
			</span>
			</div>
		<div class="scrollable" id="mkt_series">
			
			<?php 
			
			
			$req_id = $_GET['det'];
			
			if(isset($req_id)== TRUE){
				
				echo get_series_mkt($req_id); 
				
			}
			
				
			?>
			
		</div>	
	</div>
	
	<div class="col-sm-3 col-fix">
		<div class="p-2 border-bottom" style="padding: 10px 5px;">
			<h4 class="card-title" style="padding-bottom: 5px;" >
				<a href="#" ><span class="card-title-fig mb-0 text-success" style="float: left;" id="title_nombre">
					<span>
					<i class="fa fa-child"></i> Minifiguras
					</span>
				</a>	                   
			</h4>
			<span id="serie_act">
				<?php 
					
						echo '<span class="text-light bubble_text_lg "></span>';
									
					
				?>
			</span>
		</div>
		<div class="scrollable" id="mkt_minifig">
			
			
			<?php 
			
			
			$req_cve = $_GET['cve'];
			
			if(isset($req_cve)== TRUE){
				
				echo get_minifiguras_mkt($req_cve); 
				
			}
			
				
			?>
			
			
		</div>
	</div>

</div>

<?php } ?>