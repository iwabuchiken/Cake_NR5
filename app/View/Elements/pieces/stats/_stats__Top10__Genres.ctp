<br>

<span>
	Genres
</span>



<button class="basic_2" id="bt_Stats_Top10_Genres_Show_Hide">
	Show/Hide
</button>


<table id="tbl_Stats_Top10_Genres">

	<tr>
		<?php 
		
			$count = 1;
			
			$accum = 0.0;
		
			$column_Names = array(
					
					"no.",
					"Genre Id",
					"Name",
					"Entries",
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
		
		foreach ($aryOf_Data as $item) {
			
			
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
			
				echo $item[2];
			
			?>
		
		</td>  
  		
		<td>
		
			<?php 
			
				echo sprintf("%.2f %%", ($item[2] / $numOf_Geschichte_Total * 100));
			
			?>
		
		</td>  
  		
		<td>
		
			<?php 
			
				$accum += $item[2] / $numOf_Geschichte_Total;
				
				echo sprintf("%.2f %%", ($accum * 100));
			
			?>
		
		</td>  
  		
  	</tr>
  	
  	<?php 
  	
  		}//foreach ($data_2 as $item)
  	  
  	?>

	<tr>
	
		<td colspan="3">

			Total
		
		</td>
	
		<td colspan="3">
		
			<?php 
			
				echo $numOf_Geschichte_Total;
			
			?>
			
		
		</td>
	
	
	</tr>

</table>
