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
		
	</tr>
		
			<?php //echo $this->Html->link(
// 								'Save categories from csv',
// 								array('controller' => 'categorys', 
// 										'action' => 'save_Data_Categories_from_CSV'),
// // 										'action' => '_save_Data_Categories_from_CSV'),
// 								array('class' => "button"));
			?>
			
<!-- 		</td> -->
	
<!-- 		<td> -->
		
			<?php 
// 				echo $this->Html->link(
// 								'Save keywords from csv',
// 								array('controller' => 'keywords', 
// 										'action' => 'save_Data_Keywords_from_CSV'),
// // 										'action' => '_save_Data_Categories_from_CSV'),
// 								array('class' => "button"));
			?>
			
<!-- 		</td> -->
	
<!-- 	</tr> -->
	
</table>
