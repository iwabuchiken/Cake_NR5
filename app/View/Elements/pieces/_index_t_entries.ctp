<?php 

	$option = array(
						'target'	=> '_blank',
						'escape'	=> false,
// 						'?'	=> "article_url=".$a['url']
// 						'article_url'	=> $a['url']
				);

?>

<?php foreach ($pieces_Paginated as $piece): ?>
<?php //foreach ($historys as $history): ?>

	<tr>
			<td><?php echo $piece['Piece']['id']; ?></td>
	
			
			<td><?php echo $piece['Piece']['created_at']; ?></td>
			<td><?php echo $piece['Piece']['updated_at']; ?></td>
			
			<td><?php echo $piece['Piece']['form']; ?></td>
			
			<td><?php echo $piece['Piece']['hin']; ?></td>
			
			<td><?php echo $piece['Piece']['hin_1']; ?></td>
			
			<td><?php echo $piece['Piece']['hin_2']; ?></td>
			
			<td><?php echo $piece['Piece']['hin_3']; ?></td>
			
	</tr>
	
<?php endforeach; ?>
<?php unset($piece); ?>
