<?php
	
	setlocale (LC_MONETARY, "es_MX.UTF-8"); 
	
	 ?>

<div class="row <?php echo $class_show_statics;  ?> ">
              <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
	                    
                      <div class="col-lg-3 col-md-6">
                        <div class="d-flex">
	                       <div class="wrapper">
		                       <span class="text-secondary"><i class="fa fa-boxes fa-3x"></i></span>
	                       </div>
	                        
                          <div class="wrapper " style="margin-left: 10px; "  >
	                          <h5 class="mb-0 font-weight-medium text-primary">Sets</h5>
                            <h3 class="mb-0 font-weight-semibold"> <?php echo number_format($total_global_sets, 0, '.', ',') ;  ?></h3>
                            <p class="mb-0 text-muted no-show"></p>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            

                          </div>
                        </div>
                      </div>
                      
                      <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">

	                       <div class="wrapper">
		                       <span class="text-secondary"><i class="fa fa-puzzle-piece fa-3x"></i></span>
	                       </div>
	                       
                          <div class="wrapper" style="margin-left: 10px; ">
	                          <h5 class="mb-0 font-weight-medium text-primary">Piezas Totales</h5>
                            <h3 class="mb-0 font-weight-semibold"> <?php echo number_format($total_global_piezas, 0, '.', ',') ;  ?> </h3>
                            
                            <p class="mb-0 text-muted no-show">+138.97(+0.54%)</p>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
	                       <div class="wrapper">
		                       <span class="text-secondary"><i class="fa fa-tag fa-3x"></i></span>
	                       </div>	                        
                          <div class="wrapper" style="margin-left: 10px; ">
	                          <h5 class="mb-0 font-weight-medium text-primary">Temas</h5>
                            <h3 class="mb-0 font-weight-semibold"> <?php echo $total_global_temas;  ?></h3>
                            
                            <p class="mb-0 text-muted no-show">+57.62(+0.76%)</p>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-lg-3 col-md-6 mt-md-0 mt-4 ">
                        <div class="d-flex">
 	                       <div class="wrapper">
		                       <span class="text-secondary"><i class="fa fa-chart-line fa-3x"></i></span>
	                       </div>                         
                          <div class="wrapper" style="margin-left: 10px; ">
	                          <h5 class="mb-0 font-weight-medium text-primary">Inversión</h5>
                            <h3 class="mb-0 font-weight-semibold"><?php echo money_format('%.2n', $total_global_precio);  ?></h3>
                            
                            <p class="mb-0 text-muted no-show">+138.97(+0.54%)</p>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>