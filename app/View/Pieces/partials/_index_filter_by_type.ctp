<?php 

	//ref sql dump : http://qiita.com/kazu56/items/fa72b97db235193fe2d3
// echo $this->element('sql_dump');

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

	
