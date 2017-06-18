<tr>
		<?php 
		
			$names = CONS::$piece_ColumnNames;
// 			$names = array(
// 						'id'			=> 'Id',
// 						'created_at'	=> '作成',
// 						'updated_at'	=> '変更',	// 3
						
// 						'form'			=> 'Form',
// 						'hin'			=> '品詞',
// 						'hin_1'			=> '品詞　１',
// 						'hin_2'			=> '品詞　２',
// 						'hin_3'			=> '品詞　３',	// 5
						
// 						'katsu_kei'		=> '活用形',
// 						'katsu_kata'	=> '活用型',	// 2
						
// 						'genkei'		=> '原型',
// 						'yomi'			=> '読み',
// 						'hatsu'			=> '発音',
// 						'type'			=> 'タイプ',
// 						'geschichte_id'			=> 'Geschichte Id',
// 						'category_id'			=> 'Category Id',
// 						'genre_id'			=> 'Genre Id'
// 			);
			
			$names_keys = array_keys($names);
			
			foreach ($names_keys as $name) {
			
		?>
		<th>
			
			<?php 
				
				$opt = Utils_2::update_URL__Param_Sort($name, "desc");
			
				#ref https://stackoverflow.com/questions/8332166/cakephp-redirect-to-external-url 'answered Nov 30 '11 at 20:03'
				echo $this->Html->link(
					
								$names[$name],

								$opt
						);
			?>
			
		</th>
		<?php 
		
		}//foreach ($names as $name)
		
		?>
</tr>
