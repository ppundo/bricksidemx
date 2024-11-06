<?php 
	
	$cve_serie = $_GET['item'];
//$id_sugerencia= $_POST['id_sugerencia'];
//$respuesta = $_POST['respuesta_formato'];
	

$info_col = get_info_serie($cve_serie);

// $row['nombre'].'/'.$row['color'].'/'.$row['fecha_lanzamiento'].'/'.$row['estado'].'/'.$row['precio_premium'].'/'.$row['moneda_premium'].'/'.$row['descuento'].'/'.$row['aux'].'/'.$row['premium'];tipo


$data_col = explode('/',$info_col);


		$nombre_col = $data_col[0]; 
		$color_col  = $data_col[1];
		$f_lan = $data_col[2];
		$estado_col = $data_col[3];
		$precio = $data_col[4];
		$moneda = $data_col[5];
		$descuento = $data_col[6];
		$premium = $data_col[8];
		$tipo = $data_col[9];
		$f_reg = $data_col[10];
		$f_act = $data_col[11];
	
	/*
	if($premium==1){
		$balance = get_balance($cve_serie);
	}else{
		$balance = '<div class=" card-body col-md-12 text-muted center"> <h5> Esta serie no es Premium </h5> </div>';
	}
		*/
	
	//$balance = get_balance($cve_serie);

		/// Balance Mensual	
		$mes_current = date('m');


		for($i=0; $i<12; $i++){
			$mes_real = ($i+1);
			if($mes_current==$mes_real){
				$select_m = 'selected';
			}else{
				$select_m = '';
			}
			$mes_txt = getMonth($mes_real);
			$opt .='<option '.$select_m.' value="'.($mes_real).'"> '.strtoupper($mes_txt).'</option>';
		}
	
		$anio_current = date('Y');
		$anio_inicio = 2021;
		$total_anios = ($anio_current-$anio_inicio);
	
		for($j=0 ; $j<=$total_anios; $j++){
			$anio = $anio_inicio+$j;
			if($anio_current == $anio){
				$select = 'selected'; 
			}else{
				$select = ''; 
			}
	
			$op_anio .='<option '.$select.' value="'.$anio.'"> '.$anio.'</option>';
		}

		$mensualidad = $mes_current.'-'.$anio_current;

		
	
?>


<div class="col-md-12" style="margin:0px; padding:0px; z-index: 999999;">
		                        			
	
	<h4 class="col-md-12 p-2 title_sec" > Balance de Serie Premium </h4>
	
	<div class="mnu_bar center" style=" padding:0px; padding-top:1rem;">
        <div class="btn-group-bar" role="group" style=" border:none;"> 

		<a href="#" id="balacemnu_1" onclick="barmenu(this.id); genera_balance_mensual(1);" class="btn btn_menubar balacemnu_lg btn_menubar_lg balacemnu btn_menubar_active">
			Movimientos </a>
		<a href="#"  id="balacemnu_2" onclick="barmenu(this.id); genera_balance_mensual(2);" class="btn btn_menubar balacemnu_lg btn_menubar_lg balacemnu">
			Balance Mensual </a>
		<a href="#" type="button" id="balacemnu_3" onclick="barmenu(this.id); genera_balance_mensual(3);" class="btn btn_menubar balacemnu_lg btn_menubar_lg balacemnu">
			Transacciones </a>
		<a href="#" id="balacemnu_4" onclick="barmenu(this.id)" class="btn btn_menubar balacemnu_lg btn_menubar_lg balacemnu">
			Balance Acumulado </a>

            </div>
    </div>

	<div class="col-12 " style="margin:0px; padding:0px; " id="check_admin_conf">
		
		<input type="hidden" value="<?php echo $cve_serie; ?>" id="serie_balance">

			<div class="row" style="margin:0px; padding:0px;">
					
				
			
				<div id="div_balacemnu_1" class="col-md-12" style=" height: 450px; padding:0px; background:rgba(255,255,255,0.95);" >
					
						<div id="hold_movimientos" class="col-12 " style="margin:0px; padding:0px; height: 467px; ">

							<div class="p-1 col-md-12  border-bottom bg-subtitle">
								<div class="col-sm-12 text-primary">
									<i class="fa-solid fa-chart-line"></i> Movimientos
								</div>
							</div>

							<div class="col-12 tool_bar" style="">
								<div class="col-6 row ">
									
									<label class="col-6 text-muted" style="font-size:0.6rem;"> 
										<select id="anio_mov_1" onchange="genera_balance_mensual(1);" class="form-control">
										<?php echo $op_anio; ?>
										</select>
									</label>
								
									<label class="col-6 text-muted" style="font-size:0.6rem;"> 
										<select id="mes_mov_1" onchange="genera_balance_mensual(1);"  class="form-control">
											<?php echo $opt; ?>
										</select>
									</label>
								</div>
							</div>

							<div class="col-8 border-right" id="table_movs" style="margin:0px; padding:0px;height: 430px; overflow:scroll; overflow-y:auto; overflow-x:none;">							
									
							</div>	
						</div>
					
				</div>
					
				
				
				<div id="div_balacemnu_2" class="col-md-12 " style="margin:0px; padding:0px; height: 490px; background:rgba(255,255,255,0.95);" >
						
						<div class="p-1 col-md-12  border-bottom bg-subtitle">
							<div class="col-sm-12 text-primary">
								<i class="fa-solid fa-scale-balanced"></i> Balance Mensual
							</div>
						</div>
						
						<div class="col-12 tool_bar " style="">
							<div class="row col-6">
								
								<label class="col-6 text-muted" style="font-size:0.6rem;"> 
									<select id="anio_mov_2" onchange="genera_balance_mensual(2);" class="form-control">
									<?php echo $op_anio; ?>
									</select>
								</label>
							
								<label class="col-6 text-muted" style="font-size:0.6rem;"> 
									<select id="mes_mov_2" onchange="genera_balance_mensual(2);"  class="form-control"><?php echo $opt; ?></select>
								</label>
							</div>
						</div>
						
							
						<div class="col-md-8 row border-bottom" id="rango_fechas" style="margin:0px; padding:20px 0px;">

							<div class="row col-md-6 " style="margin-left:5px;padding:0px;">
								<span class="col-1 text-muted text-small label_thin"> Del: </span>
								<span class="col-10 text-muted text-small label_thin">  </span>
							</div>	

							<div class="row col-md-6  " style="margin:0px;padding:0px;">
								<span class="col-1 text-muted text-small label_thin"> Al:</span>
								<span class="col-10 text-muted text-small label_thin"> </span>
							</div>	
						</div>
								
						<div class="col-8 row " id="tots_balance" style="margin:10px 0px; padding:0px;">	
						
							<div class="col-md-6">
								<span class="col-md-12 text-muted text-small label_thin"> Ingreso :</span>
								<span class="col-md-12 text-small label_thin"> 
									<span class="text-success" style="font-size:1rem"> </span>
								</span>
							</div>
							
							<div class="col-md-6 ">
								<span class="col-md-12 text-muted text-small label_thin"> Devuelto:</span>
								<span class="col-md-12 text-small label_thin"> 
									<span class="text-danger" style="font-size:1rem"> </span>
								</span>
							</div>
							


						</div>	

						<div class="p-1 col-md-8  border-bottom bg-subtitle" style="margin-top:30px;">
							<div class="col-sm-12 text-primary" style="font-size:0.9rem;">
								<i class="fa fa-donate"></i> Resumen
							</div>
						</div>	

						<div class="col-md-8" id="movs" style="margin:10px 0px; padding:0px;">
						</div>

					</div>

					
				<div id="div_balacemnu_3" class="col-md-12" style="padding:0px; margin:0px; height: 490px; background:rgba(255,255,255,0.95);" >
					<div class="p-1 col-md-12  border-bottom bg-subtitle">
							<div class="col-sm-12 text-primary"> Transacciones
							</div>
						</div>
						
						<div class="col-12 tool_bar " style="">
							<div class="row col-6">
								
								<label class="col-6 text-muted" style="font-size:0.6rem;"> 
									<select id="anio_mov_3" onchange="genera_balance_mensual(3);" class="form-control">
									<?php echo $op_anio; ?>
									</select>
								</label>
							
								<label class="col-6 text-muted" style="font-size:0.6rem;"> 
									<select id="mes_mov_3" onchange="genera_balance_mensual(3);"  class="form-control"><?php echo $opt; ?></select>
								</label>
							</div>
						</div>
						
							
						<div class="col-md-10 row " id="rango_fechasb" style="margin:0px; padding:20px 0px;">

						</div>
								
						<div class="col-10 row " id="tots_balanceb" style="margin:0px; padding:0px;">	
						</div>	
				</div>

					<div id="div_balacemnu_4" class="col-md-12" style="padding:0px; margin:0px; height: 490px; background:rgba(255,255,255,0.95);" >
						
						<div class="p-1 col-12 border-bottom bg-subtitle " style="margin:0px; padding:0px; ">
							<div class="col-12 text-primary">
								<i class="fa-solid fa-scale-balanced"></i> Balance Acumulado
							</div>
						</div>							
						
							
						<div class="col-md-12 row border-bottom" style="margin:0px; padding:0px; margin:0px; padding:20px 0px;">

							<div class="col-md-12 " style="margin:0px; padding:0px;">
								<label class="col-md-12 text-muted text-small label_thin"> Al:</label>
								<label class="col-md-12 text-small label_thin">   </label>
							</div>	

						</div>
						
					
								
						<div class="col-md-12 row " style="margin:10px; padding:0px;">	
								
							<div class="col-md-6 ">
								<label class="col-md-12 text-muted text-small label_thin"> Total:</label>
								<label class="col-md-12 text-small label_thin"> 
									<span class="text-success" style="font-size:1rem"> </span> 
								</label>
							</div>
							
							<div class="col-md-6 ">
								<label class="col-md-12 text-muted text-small label_thin"> Devuelto:</label>
								<label class="col-md-12 text-small label_thin"> 
									<span class="text-danger" style="font-size:1rem">$ </span> 
								</label>
							</div>								

						</div>	


						<div class="p-1 col-md-12  border-bottom bg-subtitle" style="margin-top:30px;">
							<div class="col-sm-12 text-primary" style="font-size:0.9rem;">
								 <i class="fa fa-chart-pie"></i> Resumen
							</div>
						</div>	

						<div class="col-md-12 row " style="margin:0px; padding:0px;">
							
							<div class="row col-md-10 label_thin" style="margin:0px; padding:0px;">
								<span class="col-sm-9 text-primary text-small label_thin"> Movimientos:</span>
								<span class="col-sm-2 text-small label_thin"> </span>
							</div>	

							<div class="row col-md-10 border-top " style="margin:0px; padding:0px;">
								<span class="col-sm-9 text-muted text-small label_thin"> Aprobados:</span>
								<span class="col-sm-2 text-small label_thin"> </span>
							</div>																
									
							<div class="row col-md-10 border-top " style="margin:0px; padding:0px;">
								<span class="col-sm-9 text-muted text-small label_thin"> Cancelados:</span>
								<span class="col-sm-2 text-small label_thin"> </span>
							</div>	
							

						</div>						
					</div>		
				</div>
	</div>
											

		                        	
</div>

<?php 
		echo'
		<script type="text/javascript">
			all_balance();
		</script>

		
		';
?>