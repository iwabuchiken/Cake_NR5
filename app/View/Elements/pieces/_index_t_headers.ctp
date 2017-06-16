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

		<th>
			
			<?php echo $this->Html->link(
								'Hin',
								array('controller' => 'Pieces', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=hin')
						);
			?>
			
		</th>

		<th>
			
			<?php echo $this->Html->link(
								'Hin_1',
								array('controller' => 'Pieces', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=hin_1')
						);
			?>
			
		</th>

<!-- 		<th> -->
			
			<?php 
// 				echo $this->Html->link(
// 								'Hin_2',
// 								array('controller' => 'Pieces', 
// 										'action' => 'index',
// // 										'sort'		=> 'id')
// 										'?'		=> 'sort=hin_2')
// 						);
// 			?>
			
<!-- 		</th> -->

<!-- 		<th> -->
			
			<?php 
// 			echo $this->Html->link(
// 								'Hin_3',
// 								array('controller' => 'Pieces', 
// 										'action' => 'index',
// // 										'sort'		=> 'id')
// 										'?'		=> 'sort=hin_3')
// 						);
			?>
			
<!-- 		</th> -->

<!-- 		<th> -->
			
			<?php 
// 			echo $this->Html->link(
// 								'katsu_kei',
// 								array('controller' => 'Pieces', 
// 										'action' => 'index',
// // 										'sort'		=> 'id')
// 										'?'		=> 'sort=katsu_kei')
// 						);
			?>
			
<!-- 		</th> -->

		<?php 
		
// 			$names = array('katsu_kei', 'katsu_kata');
			$names = array(
						'hin_2', 'hin_3', 'katsu_kei', 'katsu_kata',
						'genkei', 'yomi', 'hatsu', 'type',
						'geschichte_id', 'category_id', 'genre_id'
			);
			
			foreach ($names as $name) {
			
		?>
		<th>
			
			<?php 
				
				$opt = array(
						'controller' => 'Pieces', 
						'action' => 'index',
						'?'		=> "sort=$name"
// 						'?'		=> 'sort=katsu_kata'
						
				);
				
				$names = array('katsu_kata');
			
				echo $this->Html->link(
					
								$name,
// 								$names[0],
// 								'katsu_kata',
								$opt
// 								array('controller' => 'Pieces', 
// 										'action' => 'index',
// // 										'sort'		=> 'id')
// 										'?'		=> 'sort=katsu_kata')
						);
			?>
			
		</th>

		<?php 
		
		}//foreach ($names as $name)
				
				
		
		
		
		
		?>

</tr>
