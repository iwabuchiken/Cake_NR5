<button class="basic" id="links_Show_Hide">
	Links
<!-- 	Show/Hide -->
</button>

<div id="div_Default_Layout_Footer">

	<table id="links">
		<tr>
		
			<td>
			
				<?php echo $this->Html->link(
									'Articles',
									array('controller' => 'Articles', 
											'action' => 'index'),
									array('class' => "button"));
				?>
				
			</td>
			
			<td>
			
				<?php echo $this->Html->link(
									'Genres',
									array('controller' => 'Genres', 
											'action' => 'index'),
									array('class' => "button"));
				?>
				
			</td>
		
			<td>
			
				<?php echo $this->Html->link(
									'Categories',
									array('controller' => 'Categorys', 
											'action' => 'index'),
									array('class' => "button"));
				?>
				
			</td>
		
			<td>
			
				<?php echo $this->Html->link(
									'Keywords',
									array('controller' => 'Keywords', 
											'action' => 'index'),
									array('class' => "button"));
				?>
				
			</td>
		
		</tr>
	
		<tr>
		
			<td>
	
				<?php echo $this->Html->link(
						
						'History',
						array('controller' => 'Historys', 
								'action' => 'index'),
						array('class' => "button"));
				?>
			
			</td>
			
			<td>
	
				<?php echo $this->Html->link(
						
						'Token',
						array('controller' => 'Tokens', 
	// 					array('controller' => 'tokens', 
								'action' => 'index'),
						array('class' => "button"));
				?>
			
			</td>
			
			<td>
	
				<?php echo $this->Html->link(
						
						'Skimmed token',
						array('controller' => 'Skimmedtokens', 
								'action' => 'index'),
						array('class' => "button"));
				?>
			
			</td>
			
			<td>
	
				<?php echo $this->Html->link(
						
						'Admin',
						array('controller' => 'Admins', 
								'action' => 'index'),
						array('class' => "button"));
				?>
			
			</td>
			
			<td>
	
				<?php 
				
					echo $this->Html->link(
						
						'Stats2',
						array('controller' => 'Admins', 
								'action' => 'stats2'),
						array(
								'class' => "button"
								
								,'target'	=> '_blank'
								
						)
					);
				
				?>
			
			</td>
			
	<!-- 		<td> -->
	
				<?php 
	// 				echo $this->Html->link(
						
	// 					'Delete Tokens',
	// 					array('controller' => 'tokens', 
	// 							'action' => 'delete_all'),
	// 					array('class' => "button"),
	// 					__("Delete all tokens?"));
				?>
			
	<!-- 		</td> -->
			
		</tr>
	
		<tr>
			<td>
			
				<?php echo $this->Html->link(
							
							'EQ',
							array('controller' => 'qs', 
									'action' => 'index'),
							array('class' => "button"));
					?>
			</td>
		
			<td>
			
				<?php echo $this->Html->link(
							
							'EQ/map',
							array('controller' => 'eqs', 
									'action' => 'map'),
							array('class' => "button"));
					?>
			</td>
		
			<td>
			
				<?php 
					echo $this->Html->link(
							
							'Genre names',
							array('controller' => 'genre_names', 
									'action' => 'index'),
							array(
									'class' => "button"
									,'target'	=> "_blank"
							)
					);
				?>
			</td>
		
			<td>
			
				<?php 
					echo $this->Html->link(
							
							'Articles2',
							array('controller' => 'articles2', 
									'action' => 'index'),
							array(
									'class' => "button"
									,'target'	=> "_blank"
							)
					);
				?>
			</td>
		
			<td>
			
				<?php 
					echo $this->Html->link(
							
							'Geschichte',
							array('controller' => 'geschichtes', 
									'action' => 'index'),
							array(
									'class' => "button"
									,'target'	=> "_blank"
							)
					);
				?>
			</td>
		
		</tr>
		
	</table>
</div>

