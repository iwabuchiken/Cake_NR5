
<?php echo $keys[0]; ?>

<table>


	<?php 
		
		$a_group = $a_categorized[$keys[0]];
	
		$counter = 1;
		
		foreach ($a_group as $a) { 

	?>
		<tr>
				<td>
				
					<?php echo $counter ?>
				
				</td>
				
				<td>
				
					<?php echo $a['line']; ?>
				
				</td>
				
				<td>
				
					<?php echo $a['vendor']; ?>
				
				</td>
				
				<td>
				
					<?php echo $a['news_time']; ?>
				
				</td>
			
		</tr>	
		
	<?php 
	
			$counter += 1;
	
		} 
		
	?>

</table>