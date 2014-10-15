<?php foreach ($eqs as $eq): ?>
<tr>
		<td><?php echo $eq['Eq']['id']; ?></td>
		
		<td><?php echo $eq['Eq']['epi']; ?></td>
		
		<td><?php echo $eq['Eq']['time_eq']; ?></td>
		
		<td><?php echo $eq['Eq']['mag']; ?></td>
		
<!-- 		<td> -->
			<?php 
// 			echo $this->Html->link($eq['Eq']['name'],
// 							array(
// 								'controller' => 'eqs', 
// 								'action' => 'view', 
// 								$eq['Eq']['id'])
// 							); ?>
<!-- 		</td> -->
		
		
		<td><?php echo $eq['Eq']['created_at']; ?></td>
		<td><?php echo $eq['Eq']['updated_at']; ?></td>
		
</tr>
<?php endforeach; ?>
<?php unset($eq); ?>
