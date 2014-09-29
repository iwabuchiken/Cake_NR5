<?php foreach ($tokens as $token): ?>
<tr>
		<td><?php echo $token['Token']['id']; ?></td>
		
		<td><?php echo $token['Token']['form']; ?></td>
		
		<td><?php echo $token['Token']['hin']; ?></td>
		
		<td><?php echo $token['Token']['yomi']; ?></td>
		
		<td><?php echo $token['Token']['created_at']; ?></td>
		<td><?php echo $token['Token']['updated_at']; ?></td>
		
</tr>
<?php endforeach; ?>
<?php unset($token); ?>
