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


(<a href="#top">Top</a><a name="bottom"></a>)

<?php 

// 	echo $this->Html->link(
// 				    'Add Genre',
// 				    array('controller' => 'eqs', 'action' => 'add')
// 	); 

?>
