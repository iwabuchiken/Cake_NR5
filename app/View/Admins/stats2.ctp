stats 2

&nbsp;
&nbsp;

(sum of frequencies = <?php echo $sumof_freqs; ?>)

<?php 

	echo "<br>";
	echo "<br>";

?>

<table>
  <tr>
    <th>s.n.</th>
    <th>category id</th>
    <th>category name</th>
    
    <th>genre name</th>
    
    <th>freq</th>
    
  </tr>
 
<?php 

	$count = 1;

	foreach ($aryof_category_stats as $ary) {
	
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
			
				echo $ary[0];
				
			?>
		
		</td>
	
		<td>
		
			<?php 
			
				echo $ary[1];
				
			?>
		
		</td>
	
		<td>
		
			<?php 
			
				echo $ary[2];
				
			?>
		
		</td>
	
		<td>
		
			<?php 
			
				echo $ary[3];
				
			?>
		
		</td>
	
	</tr>

<?php 		

	}//foreach ($aryof_category_stats as $ary)
	
	
	

?>

</table>

