<?php foreach ($historys as $history): ?>
<tr>
		<td><?php echo $history['History']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($history['History']['line'],
							array(
								'controller' => 'historys', 
								'action' => 'view', 
								$history['History']['id'])
							); ?>
		</td>
		
		<td><?php echo $history['History']['vendor']; ?></td>
		
		<td><?php echo $history['History']['news_time']; ?></td>
		
		<td><?php echo $history['Category']['name']; ?></td>
		
		<td>
		
			<?php 
			
				$genre = $this->History->get_Genre_From_HistoryID(
						$history['History']['id']);

				echo $genre['Genre']['name'];
				
// 				echo $history['Category']['name']; 
				
			?>
			
		</td>
		
		<td><?php echo $history['History']['created_at']; ?></td>
		<td><?php echo $history['History']['updated_at']; ?></td>
		
</tr>
<?php endforeach; ?>
<?php unset($history); ?>
