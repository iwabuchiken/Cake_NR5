<div id="a_list_header">

<!-- 	Header<br> -->
	
	<?php 

		if (count($keys) < 2) {
			
			echo $keys[0];
			
		} else {
			
			$i = 0;
			
			for (; $i < count($keys) - 1; $i++) {
				
// 				echo $keys[$i];
				echo "<a href=\"#".$keys[$i]."\">".$keys[$i]."</a>";
			
				echo " | ";
				
			}
			
// 			echo $keys[$i];
			echo "<a href=\"#".$keys[$i]."\">".$keys[$i]."</a>";
			
		}
	
	?>
	
</div>

<?php 


// 	$keys = array_keys($a_categorized);
	
?>


