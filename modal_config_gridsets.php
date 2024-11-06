		<?php
		$ops = genera_select_columnas('0');
	
		

        $div_op_general = '
        <div class="col-md-12 form-group">
                   
            <select class="col-md-12 form-control" onchange="" >
                '.$ops.'
            </select>
    
        </div>
        ';
        
        
        echo $div_op_general;
        ?> 
        
        