<h1>Tokens (<a href="#bottom">Bottom</a><a name="top"></a>)</h1>
<table>

	<?php echo $this->element('tokens/index_t_headers'); ?>

		<!-- Here is where we loop through our $tokens array, printing out post info -->

	<?php echo $this->element('tokens/index_t_entries'); ?>
		
</table>

<?php echo $this->Html->link("Add token",
							array(
								'controller' => 'tokens', 
								'action' => 'add')
							); 
?>


(<a href="#top">Top</a><a name="bottom"></a>)

<?php 

// 	echo $this->Html->link(
// 				    'Add Token',
// 				    array('controller' => 'tokens', 'action' => 'add')
// 	); 

?>
