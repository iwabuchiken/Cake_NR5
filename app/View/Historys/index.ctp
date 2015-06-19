<h1>

	Histories (<a href="#bottom">Bottom</a><a name="top"></a>)
	
		(
			total = <?php 
			
						if (isset($num_of_histories)) {
							
							echo $num_of_histories; 
							
						}
						
						?>, 
						
			pages = <?php 
			
						if (isset($num_of_pages)) {
							
							echo $num_of_pages; 
							
						}
						
						?>,
			
			current = <?php 
							if (isset($num_of_histories_Current)) {

								echo "<font color=\"blue\">$num_of_histories_Current</font>";

								echo "/page";
					
							}
					?>
		)
	<br>
	(filter_Line = <?php echo "<font color=\"blue\">".$filter_Line."</font>" ?> / 
		filter_Category = <?php echo "<font color=\"blue\">".$filter_Cat."</font>" ?> / 
		sort = <?php echo "<font color=\"blue\">".$sort."</font>" ?>)
		
</h1>

<?php echo $this->element('historys/_index_pagination')?>

<table>

	<?php echo $this->element('historys/index_t_headers'); ?>

		<!-- Here is where we loop through our $genres array, printing out post info -->

	<?php echo $this->element('historys/index_t_entries'); ?>
		
</table>

<br>

<?php echo $this->element('historys/_index_pagination')?>

<br>

<?php echo $this->Html->link("Add history",
							array(
								'controller' => 'Historys', 
								'action' => 'add')
							); 
?>


(<a href="#top">Top</a><a name="bottom"></a>)

<?php 

// 	echo $this->Html->link(
// 				    'Add Genre',
// 				    array('controller' => 'genres', 'action' => 'add')
// 	); 

?>
