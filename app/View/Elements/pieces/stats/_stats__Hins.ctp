<br>

<span>
	品詞毎　割合
</span>

<button class="basic_2" id="bt_Stats_Hins_Show_Hide">
	Show/Hide
</button>



<table id="tbl_Stats_Hins">


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
		
		foreach ($data_2 as $item) {
			
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
  		
		<?php 
			
// 			}//foreach ($item as $tds)
			
		?>
		
  	</tr>
  	
  	<?php 
  	
  		}//foreach ($data_2 as $item)
  	  
  	?>

	<tr>
		
		<td>
			<?php 
			
				echo $count;
			
			?>
		</td>
	
		<td>

			Total
		
		</td>
	
		<td>
		
			<?php 
			
				echo $numOf_Pieces_Total;
			
			?>
		
		</td>
	
		<td>
		
			<?php 
				
			
				echo sprintf("%.2f %%", 
						$numOf_Pieces_Total / $numOf_Pieces_Total * 100);
			
			?>
		
		</td>
	
	</tr>

</table>
