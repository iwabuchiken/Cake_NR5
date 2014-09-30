<!-- File: /app/View/Posts/add.ctp -->

<h1>Edit Admin</h1>
<?php
	echo $this->Form->create('Admin');
	
	$opt_input = array(
	
			'onmouseover' => 'this.select()',
			'rows' => '1',
			'cols'	=> '5'
			
	);
	
	echo $this->Form->input('open_mode', $opt_input);
	
	echo $this->Form->end('Update admin');
	
?>

<br>

<?php echo $this->Html->link(
    'Back to list',
    array('controller' => 'admins', 'action' => 'index')
); ?>
