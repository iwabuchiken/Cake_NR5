<?php foreach ($admins as $admin): ?>
<tr>
		<td><?php echo $admin['Admin']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($admin['Admin']['open_mode'],
							array(
								'controller' => 'admins', 
								'action' => 'view', 
								$admin['Admin']['id'])
							); ?>
		</td>
		
		<td><?php echo $admin['Admin']['created_at']; ?></td>
		<td><?php echo $admin['Admin']['updated_at']; ?></td>
		
</tr>
<?php endforeach; ?>
<?php unset($admin); ?>
