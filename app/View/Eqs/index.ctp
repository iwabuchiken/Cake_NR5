<h1>Eqs (<a href="#bottom">Bottom</a><a name="top"></a>)</h1>
<table>

	<?php echo $this->element('eqs/index_t_headers'); ?>

		<!-- Here is where we loop through our $eqs array, printing out post info -->

	<?php echo $this->element('eqs/index_t_entries'); ?>
		
</table>

<?php echo $this->Html->link("Add eq",
							array(
								'controller' => 'eqs', 
								'action' => 'add')
							); 
?>

<br>
<br>

<?php echo $this->Html->link("Delete all eqs",
							array(
								'controller' => 'eqs', 
								'action' => 'delete_all'),
							array(
									// 							'style'	=> 'color: blue'
							// 							'class'		=> 'link_word_alert'
							),
							
							//REF http://stackoverflow.com/questions/22519966/cakephp-delete-confirmation answered Mar 19 at 23:18
							__("Delete all?")

							); 
?>

<br>
<br>

(<a href="#top">Top</a><a name="bottom"></a>)

<?php 

// 	echo $this->Html->link(
// 				    'Add Genre',
// 				    array('controller' => 'eqs', 'action' => 'add')
// 	); 

?>
