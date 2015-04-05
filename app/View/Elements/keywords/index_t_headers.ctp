<tr>

		<th class="table_header">
		
			<?php echo $this->Html->link(
								'ID',
								array('controller' => 'keywords', 
										'action' => 'index',
										'?' => "sort=id"),
								array('class'	=> 'has_link'));
			?>
				
				
		</th>
		
		<?php echo $this->element("keywords/index/_index_t_headers_Col_name")?>
		
		<?php echo $this->element("keywords/index/_index_t_headers_Col_category")?>
		
		<th class="table_header">Genre</th>
		<th class="table_header">Created at</th>
		<th class="table_header">updated at</th>
		
</tr>
