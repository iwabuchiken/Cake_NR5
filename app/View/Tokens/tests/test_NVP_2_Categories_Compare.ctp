<h1><?php echo __FILE__; ?></h1>

<br>
Usage => e.g. "http://localhost/Cake_NR5/Tokens/test_NVP_2_Categories?cat_id=8,15&history_id=139"
<br>
<br>
<a href="#bottom">Bottom</a><a name="top"></a>
<br>
<br>

<table>
  <tr>
    <th>SN</th>
    <th>form</th>
    <th>histo</th>
    <th>ratio</th>
<!--     <th>cumulative</th> -->
    
    <th>SN</th>
    <th>form</th>
    <th>histo</th>
    <th>ratio</th>
<!--     <th>cumulative</th> -->
    
    <th>SN</th>
    <th>form</th>
    <th>histo</th>
    <th>ratio</th>
<!--     <th>cumulative</th> -->
    
  </tr>
  
    <?php

  		$keys_1 = array_keys($histo_1);
  		$keys_2 = array_keys($histo_2);
  		
  		if (isset($histo_Other)) {
  			
	  		$keys_Other = array_keys($histo_Other);
	  		
  		}

//   		debug(count($keys_Other));
  		
  		// set the size => smaller histo
  		if (isset($histo_Other)) {
  		
	  		$len = min(count($keys_1), count($keys_2), count($keys_Other));
  		
  		} else {
  		
  			$len = min(count($keys_1), count($keys_2));
  			
  		}//if (isset(($histo_Other)))
  		
  		// modify length
  		if (isset($topX) && $len > $topX) {
  			
			$len = $topX;
			
  		}
  		
//   		$len = (count($keys_1) < count($keys_2)) ? count($keys_1) : count($keys_2);
//   		$len = ($keys_1 < $keys_2) ? $keys_1 : $keys_2;
  		
//   		debug($len);
  		
  		$ratio_sum_1 = 0;
  		$ratio_sum_2 = 0;
  		$ratio_sum_Other = 0;
  
  		for ($i = 0; $i < $len; $i++) {
//   		for ($i = 0; $i < count($histo_1); $i++) {

	?>  			
	
	  <tr>
	    <td>
	    	<?php 
	    	
	    		echo ($i + 1);
	    		
	    	?>
	    </td>
	    
	    <td>
	    	
	    	<?php 
	    	
	    		echo $keys_1[$i];
	    	
	    	?>
	    	
    	</td>
	    
	    <td>
	    
    	   	<?php 
	    	
	    		echo $histo_1[$keys_1[$i]];
	    	
	    	?>
	    	
    	</td>
	    
	    <td>

	      	<?php 
	    	
	      		if ($total_1 > 0) {
	      		
	      			echo round($histo_1[$keys_1[$i]] / $total_1 * 100, 4);
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

// 		    	if ($total_1 > 0) {
		    		 
// 		    		$ratio_sum_1 += $histo_1[$keys_1[$i]] / $total_1;
		    		
// 		    		echo round($ratio_sum_1 * 100, 4);
// // 		    		echo $ratio_sum_1;
		    		 
// 		    	} else {
		    		 
// 		    		echo "0";
		    	
// 		    	}//if ($total_1 > 0)
		    	
	    	
// 	    	?>
	    
<!-- 	    </td> -->

	    <!-- histo 2 --------------------------------------->
	    <?php 

	  		if (isset($total_2)) {
	  		
		  		echo $this->element(
		  						'tokens/tests/test_NVP_2_Categories_Compare_Histo_2',
		  						array(
									'i' => $i, 
									'keys_2' => $keys_2, 
									'histo_2' => $histo_2,
									'total_2' => $total_2,
								)
				); 

	  		}
	  		
	  ?>
	    
	  <!-- histo Other --------------------------------------->
	  <?php 

	  		if (isset($total_Other)) {
	  		
		  		echo $this->element(
		  						'tokens/tests/test_NVP_2_Categories_Compare_Other',
		  						array(
									'i' => $i, 
									'keys_Other' => $keys_Other, 
									'histo_Other' => $histo_Other,
									'total_Other' => $total_Other,
								)
				); 

	  		}
	  		
	  ?>
	  
	  </tr>
	  
  <?php 
  		}
  ?>
  
</table>

<br>
<br>
(<a href="#top">Top</a><a name="bottom"></a>)
