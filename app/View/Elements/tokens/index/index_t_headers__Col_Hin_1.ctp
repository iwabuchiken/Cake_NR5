<th>

	<?php 
		
		$link_Options['?'] = 'sort=hin_1';
	
		echo $this->Html->link(
						'Hin 1',
						$link_Options

		);

	?>
	
	
	<?php

		$opt_create = array(
				 
				'div'	=> false,
				//REF http://wiltonsoftware.com/posts/view/customizing-your-form-labels-in-cakephp-1-2
				'label'	=> false,
				'url'	=> array(
						'controller'	=> 'tokens',
						'action'	=> 'index'),
				'type'	=> 'get',
				'label'	=> false
		
		);
	
		$opt_input_Hins= array(
				'type' => 'select',
				'options' => $hins_1_Array,
				'label'	=> false
		);
		
		if (isset($chosen_hin_1)) {
		
			//REF http://stackoverflow.com/questions/6259371/cakephp-this-form-input-how-to-set-a-select-default-option answered Jun 7 '11 at 0:38
			$opt_input_Hins['default'] = $chosen_hin_1;
				
		}
		
		echo $this->Form->create('', $opt_create);
		 
		echo $this->Form->input(
				CONS::$str_Filter_Hins_1,
				$opt_input_Hins
		);
		 
		echo $this->Form->end('Filter');
			
	?>
	
</th>
