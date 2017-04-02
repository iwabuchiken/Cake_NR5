<h1>
	Genre names 
	
</h1>

(<a href="#bottom">Bottom</a><a name="top"></a>)

<?php echo $this->element('genre_names/index/_header'); ?>

<table>

	<?php echo $this->element('genre_names/index_t_headers'); ?>
	
  <?php 
  
  	foreach ($genre_names as $genre_name) {
  		;
  	
  
  ?>
  
  <tr>
  
  	<td>
  		<?php 
  			
  			echo $genre_name['GenreName']['id'];
  		
  		?>
  
  	</td>
  	<td>
  		<?php 

  			echo $genre_name['Genre']['name']."(".$genre_name['Genre']['id'].")";
//   			echo $genre_name['Genre']['name']."(".$genre_name['GenreName']['id'].")";
//   			echo $genre_name['GenreName']['genre_id'];
//   			echo $genre_name['GenreName']['id_master'];
  		
  		?>
  
  	</td>
  	
  	<td>
  		<?php 
  		
  			echo $genre_name['GenreName']['media_name'];
  		
  		?>
  
  	</td>
  	<td>
  		<?php 
  		
  			echo $genre_name['GenreName']['genre_name'];
  		
  		?>
  
  	</td>
  	<td>
  		<?php 
  		
  			echo $genre_name['GenreName']['created_at'];
  		
  		?>
  
  	</td>
  	
  </tr>
  
  <?php 
  
  	}
  
  ?>
  
</table>


(<a href="#top">Top</a><a name="bottom"></a>)

<?php 
	
	echo "<br>"; echo "<br>";
	
?>

<?php echo $this->Html->link("Add genre name",
							array(
								'controller' => 'genre_names', 
								'action' => 'add')
							); 
?>
