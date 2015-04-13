	  <!-- histo Other --------------------------------------->
		<td>
	    	<?php 
	    	
	    		echo ($i + 1);
	    		
	    	?>
	    </td>

	    <td>
	    	
	    	<?php 
	    	
// 	    		echo "data";
	    		echo $keys_Other[$i];
	    	
	    	?>
	    	
    	</td>

    	    	<td>
	    
    	   	<?php 
	    	
	    		echo $histo_Other[$keys_Other[$i]];
	    	
	    	?>
	    	
    	</td>

    	<td>

	      	<?php 
	    	
	      		if ($total_Other > 0) {
	      		
	      			echo round($histo_Other[$keys_Other[$i]] / $total_Other * 100, 4);
// 	      			echo $histo_1[$keys_1[$i]] / $total_1;
// 					echo "data";
	      		
	      		} else {
	      		
	      			echo "0";
	      			
	      		}//if ($total_1 > 0)
	      		
	      		
// 	    		echo $histo_1[$keys_1[$i]] / $total_1;
	    	
	    	?>
	    
    	</td>
    	
