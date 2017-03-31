<tr>
		<th class="table_header">
		
<!-- 				Id -->
			<?php echo $this->Html->link(
					'ID',
					array('controller' => 'Categorys', 
							'action' => 'index',
							'?' => "sort=id"),
					array('class'	=> 'has_link'));
			?>
			
				
		</th>
		
		<th class="table_header">
		
<!-- 				Name -->
			<?php echo $this->Html->link(
					'Name',
					array('controller' => 'Categorys', 
							'action' => 'index',
							'?' => "sort=name"),
					array('class'	=> 'has_link'));
			?>
			
				
		</th>
		
		<th class="table_header">
		
			<?php echo $this->Html->link(
					'Genre',
					array('controller' => 'Categorys', 
							'action' => 'index',
							'?' => "sort=genre"),
					array('class'	=> 'has_link'));
			?>
			
				
		</th>
		
<!-- 		<th class="table_header">Genre</th> -->
		<th class="table_header">Original ID</th>
		<th class="table_header">Created at</th>
		<th class="table_header">updated at</th>
		
</tr>
