<br>
<br>

<?php 

	$keys = array_keys($a_categorized);
	
?>

<?php 
	
	$vars = array('keys' => $keys);

	//REF http://weble.org/2012/05/03/cakephp-variable-element
	echo $this->element('articles/index/_idx_test_D_9_V_1_1_Header', $vars); 
?>

<?php 

	foreach ($keys as $k) {
	
		$a_group = $a_categorized[$k];

		// validate: any articles?
		if (count($a_group) < 1) {
			
			continue;
			
		}
		
		echo "<a name=\"$k\">$k</a>";

		echo " (".count($a_group).")";
		
		echo " | ";
		
		echo "<a href=\"#top\">Top</a>";
		
		echo " ";
		
		echo "<a href=\"#bottom\">Bottom</a>";
		
		echo "<br>";
		
?>

<table>

	<?php 
	
		$counter = 1;
		
		foreach ($a_group as $a) {
	?>

	<tr>
	
		<td 
			<?php 
				if($counter % 2 == 0) {
					
					echo "class=\"td_id\"";
				
				} else {
	
					echo "class=\"td_id_color\"";
	
				}
			?>
		>
			<?php echo $counter; ?>
		</td>
	
		<td class="article_line">
			<?php 
				
				$option = array(
						'target'	=> '_blank',
						'escape'	=> false
				);
			
				echo $this->Html->link(
								$a['line'],
								$a['url'],
								$option
					);
			?>
			<?php //echo $a['line']; ?>
		</td>
	
		<td class="td_news_time">
			<?php echo $a['vendor']; ?>
		</td>
	
		<td class="td_news_time">
			<?php echo $a['news_time']; ?>
		</td>
	
	</tr>
	
	<?php
	
			$counter += 1;
	
		}//foreach ($a_group as $a)
	
	?>

</table>


<?php

	}//foreach ($keys as $k)
	
?>
