<?php foreach ($keywords as $keyword): ?>
<tr>
		<td><?php echo $keyword['Keyword']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($keyword['Keyword']['name'],
							array(
								'controller' => 'keywords', 
								'action' => 'view', 
								$keyword['Keyword']['id'])
							); ?>
		</td>
		
		<td><?php echo $keyword['Category']['name']; ?></td>
		
		<td><?php echo $genre['Genre']['name']; ?></td>
		
		<td><?php echo $keyword['Keyword']['created_at']; ?></td>
		<td><?php echo $keyword['Keyword']['updated_at']; ?></td>
		
</tr>
<?php endforeach; ?>
<?php unset($keyword); ?>
