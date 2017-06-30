<br>

<span>
	助詞毎　割合
</span>

<button class="basic_2" id="bt_Stats_Joshis_Show_Hide">
	Show/Hide
</button>



<table id="tbl_Stats_Joshis">


	<tr>
		<?php 
		
			$count = 1;
		
			$column_Names = array(
					
					"no.",
					"Item",
					"Data",
					"Ratio"
					
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
	
		foreach ($data_Joshis as $item) {
			
			
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
  		
		<?php 
			
// 			}//foreach ($item as $tds)
			
		?>
		
  	</tr>
  	
  	<?php 
  	
  		}//foreach ($data_2 as $item)
  	  
  	?>

</table>
