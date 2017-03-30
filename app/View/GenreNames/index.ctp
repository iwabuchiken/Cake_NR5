<h1>
	Genre names 
	
</h1>

(<a href="#bottom">Bottom</a><a name="top"></a>)

<table>

  <tr>
    <th>id</th>

    <th>id master</th>

    <th>media name</th>

    <th>genre name</th>

    <th>created at</th>

  </tr>
  
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
  		
  			echo $genre_name['GenreName']['id_master'];
  		
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
