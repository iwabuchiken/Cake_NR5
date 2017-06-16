<tr>
		<th>
		
			<?php echo $this->Html->link(
								'Id',
								array('controller' => 'Pieces', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=id')
						);
			?>
			
		</th>
		
		
		<th>
			
			<?php echo $this->Html->link(
								'Created at',
								array('controller' => 'Pieces', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=created_at')
						);
			?>
		</th>
		
		<th>
			
			<?php echo $this->Html->link(
								'Updated at',
								array('controller' => 'Pieces', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=updated_at')
						);
			?>
			
		</th>

		<th>
			
			<?php echo $this->Html->link(
								'Form',
								array('controller' => 'Pieces', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=form')
						);
			?>
			
		</th>

</tr>
