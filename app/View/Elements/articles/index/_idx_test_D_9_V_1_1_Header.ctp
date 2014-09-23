
<div id="a_list_header">

<!-- 	Header<br> -->
	
	<?php 

		if (count($keys) < 2) {
			
			echo $keys[0];
			
		} else {
			
			$i = 0;
			
			$col_num = 7;
			
			echo "<table>";
			
			for (; $i < count($keys) - 1; $i++) {

				if ($i % $col_num == 0) {
					echo "<tr><td>";
				} else {
					echo "<td>";
				}
				
// 				echo $keys[$i];
				echo "<a href=\"#".$keys[$i]."\">".$keys[$i]."</a>";

				echo "(".count($a_categorized[$keys[$i]]).")";
			
// 				echo " | ";
				
				if ($i % $col_num == $col_num - 1) {
					
					echo "</td></tr>";
					
				} else {
					
					echo "</td>";
					
				}
				
			}
			
			echo "<tr><td>";
// 			echo $keys[$i];
			echo "<a href=\"#".$keys[$i]."\">".$keys[$i]."</a>";
			
			echo "(".count($a_categorized[$keys[$i]]).")";
			
			echo "</td></tr>";
			
			echo "</table>";
			
		}//if (count($keys) < 2)
	
	?>
	
</div>

<?php 


// 	$keys = array_keys($a_categorized);
	
?>


