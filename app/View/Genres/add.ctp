<h1>Add Genre</h1>
	<?php
	echo $this->Form->create('Genre');
	echo $this->Form->input('name', array('onmouseover' => 'this.select();'));
	echo $this->Form->input('code', array('onmouseover' => 'this.select();'));
// 	echo $this->Form->input('body', array('rows' => '3'));
	echo $this->Form->end('Save Genre');
	?>