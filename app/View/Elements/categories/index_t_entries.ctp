<?php foreach ($categories as $category): ?>
<tr>
		<td><?php echo $category['Category']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($category['Category']['name'],
							array(
								'controller' => 'categorys', 
								'action' => 'view', 
								$category['Category']['id'])
							); ?>
		</td>
		
		<td><?php echo $category['Category']['genre_id']; ?></td>
		
		<td><?php echo $category['Category']['created_at']; ?></td>
		<td><?php echo $category['Category']['updated_at']; ?></td>
		
</tr>
<?php endforeach; ?>
<?php unset($category); ?>
