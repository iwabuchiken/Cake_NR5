<h1><?php echo __FILE__; ?></h1>

<a href="#bottom">Bottom</a><a name="top"></a>

<br>
<br>

<table>
  <tr>
    <th>SN</th>
    <th>form</th>
    <th>histo</th>
    <th>ratio</th>
    <th>cumulative</th>
  </tr>
  
  <?php

  		$keys = array_keys($histo);
  		
  		$ratio_sum = 0;
  
  		for ($i = 0; $i < count($histo); $i++) {

	?>  			
	
	  <tr>
	    <td>
	    	<?php 
	    	
	    		echo ($i + 1);
	    		
	    	?>
	    </td>
	    
	    <td>
	    	
	    	<?php 
	    	
	    		echo $keys[$i];
	    	
	    	?>
	    	
    	</td>
	    
	    <td>
	    
    	   	<?php 
	    	
	    		echo $histo[$keys[$i]];
	    	
	    	?>
	    	
    	</td>
	    
	    <td>

	      	<?php 
	    	
	    		echo $histo[$keys[$i]] / $total;
	    	
	    	?>
	    
    	</td>
	    
	    <td>

	    	<?php 
	    	
	    		$ratio_sum += $histo[$keys[$i]] / $total;
	    		
	    		echo $ratio_sum;
	    	
	    	?>
	    
	    </td>
	    
	  </tr>
	  
  <?php 
  		}
  ?>
  
</table>


<a onclick="d3_alert('clicked')">click</a>

<br>
<br>
(<a href="#top">Top</a><a name="bottom"></a>)
