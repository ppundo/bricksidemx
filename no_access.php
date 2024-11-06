<?php 
	
//	include("check_access.php");
	
	?>

	<div class="col-md-12" style="text-align:center; margin-top: 1%;">
	
		<h1 class="text-muted" style="font-size: 120px;">;(</h1>
								
									<br>
		<span class="col-md-10 text-neutral center" style="font-size:24px; font-weight:300; font-family: 'Open Sans Condensed', sans-serif; "> 
			¡Opps!<br> 
			No tiene permiso para ver esta página. 
			
			<?php 
              //header("Location:".$path_site.$link_site); 
         echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL='.$link_site.'">';
          ?>
		</span>
	
	<div>