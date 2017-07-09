<h1>
	gen kw
</h1>

(<a href="#bottom">Bottom</a><a name="top"></a>)

Geschichte => <?php echo $geschichte_Id; ?>

<div>

	<table>
	<tr>
		<?php 
		
			$count = 1;
			
			$accum = 0.0;
		
			$column_Names = array(
					
					"no.",
					"Noun",
					"Histo",
					
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
		
		foreach ($aryOf_Nouns as $item) {
			
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
			
				echo $item;
				
			?>
		
		</td>

		<td>
	
			<?php 
			
				echo $aryOf_Histogram[$item];
				
			?>
		
		</td>

	</tr>

  	<?php 
  	
  		}//foreach ($data_2 as $item)
  	  
  	?>
	

	</table>
	

</div>


<br>
<br>

(<a href="#top">Top</a><a name="bottom"></a>)
