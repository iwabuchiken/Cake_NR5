<h1>

	Tokens (<a href="#bottom">Bottom</a><a name="top"></a>)
	
		(total = <?php echo $num_of_tokens; ?>, 
			pages = <?php echo $num_of_pages; ?>, 
			current = <font color="blue"><?php echo $num_of_tokens_Current; ?></font>
		)
	
	<br>
	(chosen hin = <font color="blue"><?php echo $chosen_hin; ?></font> / 
		chosen hin_1 = <font color="blue"><?php echo $chosen_hin_1; ?></font> / 
		chosen history_id = <font color="blue"><?php echo $chosen_history_id; ?></font> /
		chosen category = <font color="blue"><?php echo $chosen_category_id; ?></font>
		 | sort = <font color="blue"><?php echo $sort; ?></font> 
		)
	
</h1>

<br>

<?php echo $this->element('tokens/_index_pagination')?>

<table>

	<?php echo $this->element('tokens/index_t_headers'); ?>

		<!-- Here is where we loop through our $tokens array, printing out post info -->

	<?php echo $this->element('tokens/index_t_entries'); ?>
		
</table>

<?php echo $this->element('tokens/_index_pagination')?>

<br>

<?php echo $this->Html->link("Add token",
							array(
								'controller' => 'tokens', 
								'action' => 'add')
							); 
?>


(<a href="#top">Top</a><a name="bottom"></a>)


<br>
<br>

<?php 

	echo $this->Html->link(
				    'Delete all',
				    array('controller' => 'tokens', 'action' => 'delete_all'),
					null,
					__("Delete all tokens?")
	); 

?>


<?php 

// 	echo $this->Html->link(
// 				    'Add Token',
// 				    array('controller' => 'tokens', 'action' => 'add')
// 	); 

?>
