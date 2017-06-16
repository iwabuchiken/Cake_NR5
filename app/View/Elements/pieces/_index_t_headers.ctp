<tr>
<!-- 		<th> -->
		
			<?php 
// 				echo $this->Html->link(
// 								'Id',
// 								array('controller' => 'Pieces', 
// 										'action' => 'index',
// // 										'sort'		=> 'id')
// 										'?'		=> 'sort=id')
// 						);
// 			?>
			
<!-- 		</th> -->
		
		
<!-- 		<th> -->
			
			<?php 
// 				echo $this->Html->link(
// 								'Created at',
// 								array('controller' => 'Pieces', 
// 										'action' => 'index',
// // 										'sort'		=> 'id')
// 										'?'		=> 'sort=created_at')
// 						);
// 			?>
<!-- 		</th> -->
		
<!-- 		<th> -->
			
			<?php 
// 				echo $this->Html->link(
// 								'Updated at',
// 								array('controller' => 'Pieces', 
// 										'action' => 'index',
// // 										'sort'		=> 'id')
// 										'?'		=> 'sort=updated_at')
// 						);
// 			?>
			
<!-- 		</th> -->


		<?php 
		
// 			$names = array('katsu_kei', 'katsu_kata');
			$names = array(
						'id'			=> 'Id',
						'created_at'	=> '作成',
						'updated_at'	=> '変更',	// 3
						
						'form'			=> 'Form',
						'hin'			=> '品詞',
						'hin_1'			=> '品詞　１',
						'hin_2'			=> '品詞　２',
						'hin_3'			=> '品詞　３',	// 5
						
						'katsu_kei'		=> '活用形',
						'katsu_kata'	=> '活用型',	// 2
						
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
			
				#ref https://stackoverflow.com/questions/8332166/cakephp-redirect-to-external-url 'answered Nov 30 '11 at 20:03'
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
