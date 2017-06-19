<?php 

// 	echo "yes";
	
// 	echo "<br>"; echo "<br>";
	
	echo count($listOf_Pieces);
	
?>

<table id="pieces">

	<?php 
		
		echo $this->element('pieces/index_2/_index_t_headers')
	
	?>

	<?php 
			
		echo $this->element('pieces/index_2/_index_t_entries')
	
	?>

</table>

	
