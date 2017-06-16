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

<!-- 		<th> -->
			
			<?php 
// 				echo $this->Html->link(
// 								'Form',
// 								array('controller' => 'Pieces', 
// 										'action' => 'index',
// // 										'sort'		=> 'id')
// 										'?'		=> 'sort=form')
// 						);
// 			?>
			
<!-- 		</th> -->

<!-- 		<th> -->
			
			<?php 
// 				echo $this->Html->link(
// 								'Hin',
// 								array('controller' => 'Pieces', 
// 										'action' => 'index',
// // 										'sort'		=> 'id')
// 										'?'		=> 'sort=hin')
// 						);
// 			?>
			
<!-- 		</th> -->

<!-- 		<th> -->
			
			<?php
// 			echo $this->Html->link(
// 								'Hin_1',
// 								array('controller' => 'Pieces', 
// 										'action' => 'index',
// // 										'sort'		=> 'id')
// 										'?'		=> 'sort=hin_1')
// 						);
// 			?>
			
<!-- 		</th> -->

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
						'form'			=> 'Form',
						'hin'			=> '品詞',
						'hin_1'			=> '品詞　１',
						'hin_2'			=> '品詞　２',
						'hin_3'			=> '品詞　３',
						'katsu_kei'		=> '活用形',
						'katsu_kata'	=> '活用型',
						'genkei'		=> '原型',
						'yomi'			=> '読み',
						'hatsu'			=> '発音',
						'type'			=> 'タイプ',
						'geschichte_id'			=> 'Geschichte Id',
						'category_id'			=> 'Category Id',
						'genre_id'			=> 'Genre Id'
			);
			
			$names_keys = array_keys($names);
			
// 			$names = array(
// 						'hin_2', 'hin_3', 'katsu_kei', 'katsu_kata',
// 						'genkei', 'yomi', 'hatsu', 'type',
// 						'geschichte_id', 'category_id', 'genre_id'
// 			);
			
			foreach ($names_keys as $name) {
// 			foreach ($names as $name) {
			
		?>
		<th>
			
			<?php 
				
				$opt = Utils_2::update_URL__Param_Sort($name, "desc");
// 				$opt = $url_new;
// 				$opt = 'http://localhost/Eclipse_Luna/Cake_NR5/Pieces/index';
// 				$opt = array(
						
// 						'url'	=> 'http://localhost/Eclipse_Luna/Cake_NR5/Pieces/index'
// 				);
				
// 				$opt = array(
// 						'controller' => 'Pieces', 
// 						'action' => 'index',
// // 						'http://localhost/Eclipse_Luna/Cake_NR5/Pieces/index'
// 						'?'		=> "sort=$name"
// // 						'?'		=> 'sort=katsu_kata'
						
// 				);
				
// 				$names = array('katsu_kata');
			
				echo $this->Html->link(
					
								$names[$name],
// 								$name,
// 								$names[0],
// 								'katsu_kata',
// 								array('url'	=> $opt)
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
