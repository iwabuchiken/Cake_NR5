<h1>Test: 1</h1>

<br>
<br>

<hr>

	<?php echo $text; ?>
	
<br>
<br>

	<?php 
	
		if (isset($hins_string)) {
		
			echo $hins_string; 
		
		}
		
	?>
	
<hr>
	<?php echo $this->Html->link(
						'Hin',
						array('controller' => 'tokens', 
								'action' => 'create_hins'),
						array('class' => "button"));
	?>

	