<br>

<span>
	名詞毎　割合
</span>

<button class="basic_2" id="bt_Stats_Nouns_Show_Hide">
	Show/Hide
</button>



<table id="tbl_Stats_Nouns">


	<tr>
		<?php 
		
			$count = 1;
		
			$column_Names = array(
					
					"no.",
					"Item",
					"Data",
					"Ratio",
					"Accum"
					
			);
		
			foreach ($column_Names as $item) {
			
		?>
		
		
		<th>
			<?php 
			
				echo $item;
			
			?>
		</th>

		<?php 

			}//foreach ($column_Names as $item)
				
		?>
	</tr>

	<?php 
	
		$sumOf_Percentage = 0;
		
		foreach ($data_Nouns as $item) {
			
			
	?>
	
	<tr>

		<td>
	
			<?php 
			
				echo $count;
				
				$count ++;
			
			?>
		
		</td>
	
		<td>
		
			<?php 
			
// 				echo $tds;

				echo $item[0];
			
			?>
		
		</td>  
  		
		<td>
		
			<?php 
			
// 				echo $tds;

				echo $item[1];
			
			?>
		
		</td>  
  		
		<td>
		
			<?php 
			
// 				echo $tds;
				$label = sprintf("%.2f %%", $item[2] * 100);
				
				echo $label;
// 				echo $item[2];
			
			?>
		
		</td>  
  		
		<td>
		
			<?php 
			
				$sumOf_Percentage = $sumOf_Percentage + $item[2];
// 				echo $tds;
				$label_2 = sprintf("%.2f %%", $sumOf_Percentage * 100);
				
				echo $label_2;
// 				echo $item[2];
			
			?>
		
		</td>  
		
  	</tr>
  	
  	<?php 
  	
  		}//foreach ($data_2 as $item)
  	  
  	?>

</table>
