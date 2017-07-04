

<table>

	<!-- ref http://html.com/tables/rowspan-colspan/ -->
	<caption>Sentences</caption>
	<tr>
		<th>no.</th>
		<th colspan="1">Sentences</th>
	</tr>

	<?php 

		/*******************************
			validate
		*******************************/
		if (!isset($pairOf_Sens_Symbols)) {
		
			debug("\$pairOf_Sens_Symbols => not set");
		
			return;
			
		}//if (!isset($pairOf_Sens_Symbols))
		;
	
		$count = 1;
	
		foreach ($pairOf_Sens_Symbols as $item) {
		
			
	?>	
	<tr>
<!-- 	<tr rowspan="2"> -->
		<th rowspan="2">
<!-- 		<th> -->
<!-- 		<td> -->
<!-- 		<td rowspan="2"> -->
			<?php 
			
				echo $count;
				
				$count ++;
				
			?>
		</th>
<!-- 		</td> -->
	
		<td colspan="1">
		
			<?php 
			
				echo $item[0];
			
			?>
			
		</td>
	</tr>
	<tr>		
		<td colspan="2" class="td_SVO_Symbols">
<!-- 		<td colspan="1"> -->
<!-- 		<td colspan="1" rowspan="2"> -->
		
			<?php 
			
				echo $item[1];
			
			?>

		</td>
	</tr>
	
	<?php 
	
	
		}//foreach ($array_expression as $value)
	
	?>
	
</table>
