	    <!-- histo 2 --------------------------------------->
    	<td>
	    	<?php 
	    	
	    		echo ($i + 1);
	    		
	    	?>
	    </td>

	    <td>
	    	
	    	<?php 
	    	
	    		echo $keys_2[$i];
	    	
	    	?>
	    	
    	</td>

    	<td>
	    
    	   	<?php 
	    	
	    		echo $histo_2[$keys_2[$i]];
	    	
	    	?>
	    	
    	</td>

    	<td>

	      	<?php 
	    	
	      		if ($total_2 > 0) {
	      		
	      			echo round($histo_2[$keys_2[$i]] / $total_2 * 100, 4);
// 	      			echo $histo_1[$keys_1[$i]] / $total_1;
// 					echo "data";
	      		
	      		} else {
	      		
	      			echo "0";
	      			
	      		}//if ($total_1 > 0)
	      		
	      		
// 	    		echo $histo_1[$keys_1[$i]] / $total_1;
	    	
	    	?>
	    
    	</td>
	    
<!-- 	    <td> -->

	    	<?php 

// 		    	if ($total_2 > 0) {
		    		 
// 		    		$ratio_sum_2 += $histo_2[$keys_2[$i]] / $total_2;
		    		
// 		    		echo round($ratio_sum_2 * 100, 4);
// // 		    		echo $ratio_sum_2;
		    		 
// 		    	} else {
		    		 
// 		    		echo "0";
		    	
// 		    	}//if ($total_2 > 0)
		    	
	    	
// 	    	?>
	    
<!-- 	    </td> -->
