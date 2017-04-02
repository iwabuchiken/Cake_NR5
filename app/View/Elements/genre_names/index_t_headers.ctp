<tr>
		<th class="table_header">
		
<!-- 				Id -->
			<?php echo $this->Html->link(
					'ID',
					array('controller' => 'GenreNames', 
							'action' => 'index',
							'?' => "sort_genrenames=id"),
					array('class'	=> 'has_link'));
			?>
			
				
		</th>
		
		<th class="table_header">
		
<!-- 				Name -->
			<?php echo $this->Html->link(
					'Genre id',
					array('controller' => 'GenreNames', 
							'action' => 'index',
							'?' => "sort_genrenames=genre_id"),
					array('class'	=> 'has_link'));
			?>
			
				
		</th>
		
		<th class="table_header">
		
			<?php echo $this->Html->link(
					'media name',
					array('controller' => 'GenreNames', 
							'action' => 'index',
							'?' => "sort_genrenames=media_name"),
// 							'?' => "sort=genre"),
					array('class'	=> 'has_link'));
			?>
			
				
		</th>
		
		<th class="table_header">
		
			<?php echo $this->Html->link(
					'genre name',
					array('controller' => 'GenreNames', 
							'action' => 'index',
							'?' => "sort_genrenames=genre_name"),
// 							'?' => "sort=genre"),
					array('class'	=> 'has_link'));
			?>
			
				
		</th>
		
<!-- 		<th class="table_header">Genre</th> -->
<!-- 		<th class="table_header">Original ID</th> -->
		<th class="table_header">Created at</th>
<!-- 		<th class="table_header">updated at</th> -->
		
</tr>
