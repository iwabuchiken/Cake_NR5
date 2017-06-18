<?php 

	$option = array(
						'target'	=> '_blank',
						'escape'	=> false,
// 						'?'	=> "article_url=".$a['url']
// 						'article_url'	=> $a['url']
				);

?>

<?php foreach ($listOf_Pieces as $piece): ?>
<?php //foreach ($pieces_Paginated as $piece): ?>

	<tr>
			
			<?php 
			
				$names = CONS::$piece_ColumnNames_Entry;
				
// 				$names = array(
// 						'id', 'created_at', 'updated_at',
// 						'form', 'hin', 'hin_1', 'hin_2', 'hin_3', 
// 						'katsu_kei', 'katsu_kata', 
// 						'genkei', 'yomi', 'hatsu',
// 						'type',
						
// 						'intext_id',
						
// 						'geschichte_id', 'category_id', 'genre_id'
// // 						'id', 'created_at', 'updated_at',
// // 						'form', 'hin',
// // 						'hin_1', 'hin_2', 'hin_3', 'katsu_kei',
// // 						'katsu_kata', 'genkei', 'yomi', 'hatsu', 'type',
						
// // 						'geschichte_id', 'category_id', 'genre_id'
						
// 				);
// 				$names = array('type');
				
				foreach ($names as $name) {
			
			?>
	
				<td>
					<?php 
						echo $piece['Piece'][$name]; 
// 						echo $piece['Piece']['type']; 
					?>
				</td>

			<?php 
			
				}//foreach ($names as $name)
			
			?>			
	</tr>
	
<?php endforeach; ?>
<?php unset($piece); ?>
