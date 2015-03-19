<h1>Admins (<a href="#bottom">Bottom</a><a name="top"></a>)</h1>
<table>

	<?php echo $this->element('admins/index_t_headers'); ?>

		<!-- Here is where we loop through our $admins array, printing out post info -->

	<?php echo $this->element('admins/index_t_entries'); ?>
		
</table>

<?php echo $this->Html->link("Add admin",
							array(
								'controller' => 'admins', 
								'action' => 'add')
							); 
?>

<br>
<br>

<?php echo $this->Html->link("Stats",
							array(
								'controller' => 'admins', 
								'action' => 'stats')
							); 
?>

|

<?php echo $this->Html->link("CSV",
							array(
								'controller' => 'admins', 
								'action' => 'csv')
							); 
?>

<br>
<br>

(<a href="#top">Top</a><a name="bottom"></a>)

<?php 

// 	echo $this->Html->link(
// 				    'Add Admin',
// 				    array('controller' => 'admins', 'action' => 'add')
// 	); 

?>
