<h1><?php echo h($keyword['Keyword']['name']); ?></h1>

<table class="table_show">
  <tr>
    <td class="td_label_narrow">ID</td>
    <td class="td_value_mideum"><?php echo $keyword['Keyword']['id']; ?></td>
  </tr>
  <tr>
    <td class="td_label_narrow">name</td>
    <td class="td_value_mideum"><?php echo $keyword['Keyword']['name']; ?></td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Category</td>
    <td class="td_value_mideum"><?php echo $keyword['Category']['name']; ?></td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Genre</td>
    <td class="td_value_mideum"><?php echo $genre['Genre']['name']; ?></td>
  </tr>
  
</table>

<p>
	<?php echo $this->Html->link(
					'Delete Keyword',
					array(
							'controller' => 'keywords', 
							'action' => 'delete', 
							$keyword['Keyword']['id']
					),
					array(
							// 							'style'	=> 'color: blue'
// 							'class'		=> 'link_word_alert'
					),
						
					//REF http://stackoverflow.com/questions/22519966/cakephp-delete-confirmation answered Mar 19 at 23:18
					__("Delete? => %s", $keyword['Keyword']['name'])
	
				);
	?>

</p>
