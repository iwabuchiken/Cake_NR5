<th>

	<?php 
		
		$link_Options['?'] = 'sort=hin';
	
		echo $this->Html->link(
						'Hin',
						$link_Options

		);

	?>

<div id="header_hin">	
	<?php

		$opt_create = array(
				 
				'div'	=> false,
				//REF http://wiltonsoftware.com/posts/view/customizing-your-form-labels-in-cakephp-1-2
				'label'	=> false,
				'url'	=> array(
						'controller'	=> 'Tokens',
// 						'controller'	=> 'tokens',
						'action'	=> 'index'),
				'type'	=> 'get'
		
		);
	
		$opt_input_Hins= array(
				'type' => 'select',
				'options' => $hins_Array,
				'label'	=> false,
				'id'	=> 'header_hins'
		);
		
		if (isset($chosen_hin)) {
		
			//REF http://stackoverflow.com/questions/6259371/cakephp-this-form-input-how-to-set-a-select-default-option answered Jun 7 '11 at 0:38
			$opt_input_Hins['default'] = $chosen_hin;
				
		}
		
		
		echo $this->Form->create('Hin', $opt_create);
// 		echo $this->Form->create('', $opt_create);
		 
		echo $this->Form->input(
				CONS::$str_Filter_Hins,
				$opt_input_Hins
		);
		 
		echo $this->Form->end('Filter');
			
	?>

</div>
</th>

