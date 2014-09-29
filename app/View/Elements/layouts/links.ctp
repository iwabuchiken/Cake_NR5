<br>
<br>

<table id="links">
	<tr>
	
		<td>
		
			<?php echo $this->Html->link(
								'Articles',
								array('controller' => 'articles', 
										'action' => 'index'),
								array('class' => "button"));
			?>
			
		</td>
		
		<td>
		
			<?php echo $this->Html->link(
								'Genres',
								array('controller' => 'genres', 
										'action' => 'index'),
								array('class' => "button"));
			?>
			
		</td>
	
		<td>
		
			<?php echo $this->Html->link(
								'Categories',
								array('controller' => 'categorys', 
										'action' => 'index'),
								array('class' => "button"));
			?>
			
		</td>
	
		<td>
		
			<?php echo $this->Html->link(
								'Keywords',
								array('controller' => 'keywords', 
										'action' => 'index'),
								array('class' => "button"));
			?>
			
		</td>
	
	</tr>

	<tr>
	
		<td>

			<?php echo $this->Html->link(
					
					'History',
					array('controller' => 'historys', 
							'action' => 'index'),
					array('class' => "button"));
			?>
		
		</td>
		
		<td>

			<?php echo $this->Html->link(
					
					'Token',
					array('controller' => 'tokens', 
							'action' => 'index'),
					array('class' => "button"));
			?>
		
		</td>
		
	</tr>
		
	
</table>
