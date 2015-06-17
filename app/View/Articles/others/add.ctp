<h1>Add Article from URL</h1>
<?php

	$opt_input = array(
			
			'onmouseover' => 'this.select()',
			'rows' => '1',
				
// 			'class'	=> 'add_name'
			
	);

	$opt_create = array(
			'div' => false,
			//REF http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#options-for-create
			'type' => 'get',
	
			'action'	=> 'store_Article'
	
	);
	
	echo $this->Form->create('Article', $opt_create);
	
	echo $this->Form->input('url', $opt_input);
	
	echo $this->Form->end('Add article');
?>