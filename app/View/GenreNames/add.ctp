<h1>Add GenreName</h1>
	<?php
	
		$opt_input = array(
					
				'onmouseover' => 'this.select()',
				'rows' => '1',
		
				'class'	=> 'add_name'
			
		);
		
		echo $this->Form->create('GenreName');
		
		echo $this->Form->input('id_master', $opt_input);
		
		echo $this->Form->input('media_name', $opt_input);
		
		echo $this->Form->input('genre_name', $opt_input);
		
		echo $this->Form->input('memo', $opt_input);
	// 	echo $this->Form->input('body', array('rows' => '3'));
	
		echo $this->Form->end('Save GenreName');
		
	?>