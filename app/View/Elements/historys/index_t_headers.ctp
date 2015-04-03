<tr>
		<th>
		
			<?php echo $this->Html->link(
								'Id',
								array('controller' => 'historys', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=id')
						);
			?>
			
		</th>
		
		<?php echo $this->element('historys/_index_t_headers__Line')?>
		
		<th>
			
			<?php echo $this->Html->link(
								'Vendor',
								array('controller' => 'historys', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=vendor')
						);
			?>
			
			
		</th>

		<th>
			
			<?php echo $this->Html->link(
								'Time',
								array('controller' => 'historys', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=news_time')
						);
			?>
			
		</th>
		
		<?php echo $this->element('historys/_index_t_headers__Category'); ?>
		
<!-- 		<th> -->
			<?php 
		
// 				$link_Options = array(

// 						'controller' => 'historys',
// 						'action' => 'index',
// 						"?"			=> "sort=category_id",

// 				);
			
// 				$link_Options['?'] = 'sort=category_id';
			
			?>
					
			<?php 
// 				echo $this->Html->link(
// 								'Category ID',
// 								$link_Options
// // 								array('controller' => 'historys', 
// // 										'action' => 'index',
// // // 										'sort'		=> 'id')
// // 										'?'		=> 'sort=category_id')
// 				);
			?>
<!-- 		</th> -->
		
		<th>
			
			<?php echo $this->Html->link(
								'Created at',
								array('controller' => 'historys', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=created_at')
						);
			?>
		</th>
		
		<th>
			
			<?php echo $this->Html->link(
								'Updated at',
								array('controller' => 'historys', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=updated_at')
						);
			?>
			
		</th>

</tr>
