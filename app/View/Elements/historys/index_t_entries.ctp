<?php 

	$option = array(
						'target'	=> '_blank',
						'escape'	=> false,
// 						'?'	=> "article_url=".$a['url']
// 						'article_url'	=> $a['url']
				);

?>

<?php foreach ($historys as $history): ?>
<tr>
		<td><?php echo $history['History']['id']; ?></td>

		<td>
			<?php 
			
				$line = $history['History']['line'];
				
				$line = $this->History->sanitize($line);
			
// 				echo $this->Html->link($history['History']['line'],
				echo $this->Html->link($line,
// 				echo $this->Html->link(Sanitize::html($line, array('remove' => true)),
// 				echo $this->Html->link(Sanitize::html($line, remove),	// Unsupported operand types
// 				echo $this->Html->link(Sanitize::html($line, true),		// Unsupported operand types
// 				echo $this->Html->link(htmlentities($history['History']['line']),
							array(
								'controller' => 'Historys', 
// 								'action' => 'bufferTo_View', 
								'action' => 'view', 
								$history['History']['id'],
// 								'?' => array('refer' => 'true')
							),
							$option
							); ?>
		</td>
		
		<td><?php echo $history['History']['vendor']; ?></td>
		
		<td><?php echo $history['History']['news_time']; ?></td>
		
<!-- 		<td> -->
			<?php //echo $history['History']['category_id']; ?>
<!-- 		</td> -->
		
		<td>
		
			<?php 
			
				echo $history['Category']['name']
					."(".$history['Category']['id']."/".$history['Category']['genre_id'].")"; 
				
			?>
			
		</td>
		
		<td>
		
			<?php 
			
				$txt = "";
				
// 				if (defined($history['History']['updates'])) {
				if ($history['History']['updates'] != null) {
				
					$tokens = explode(CONS::$his_Updates_Delimiter, 
										$history['History']['updates']);
// 					$tokens = explode(" ", $history['History']['updates']);
					
					echo count($tokens);
				
				} else {
				
					echo "*";
// 					echo "NO DATA";
					
				}//if ($history['History']['updates'] != null)
				
			?>
			
		</td>
		
		<td><?php echo $history['History']['created_at']; ?></td>
		<td><?php echo $history['History']['updated_at']; ?></td>
		
</tr>
<?php endforeach; ?>
<?php unset($history); ?>
