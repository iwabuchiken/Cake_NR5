<th id="hin_3">

	<?php 
		
		$link_Options['?'] = 'sort=hin_3';
	
		echo $this->Html->link(
						'Hin 3',
						$link_Options

		);

	?>
	
	
	<?php

		$opt_create = array(
				 
				'div'	=> false,
				//REF http://wiltonsoftware.com/posts/view/customizing-your-form-labels-in-cakephp-1-2
				'label'	=> false,
				'url'	=> array(
						'controller'	=> 'Tokens',
// 						'controller'	=> 'tokens',
						'action'	=> 'index'),
				'type'	=> 'get',
				'label'	=> false
		
		);
	
		$opt_input_Hins= array(
				'type' => 'select',
				'options' => $hins_3_Array,
				'label'	=> false,
				'id'	=> 'header_hins_3',
		);
		
		if (isset($chosen_hin_3)) {
		
			//REF http://stackoverflow.com/questions/6259371/cakephp-this-form-input-how-to-set-a-select-default-option answered Jun 7 '11 at 0:38
			$opt_input_Hins['default'] = $chosen_hin_3;
				
		}
		
		echo $this->Form->create('', $opt_create);
		 
		echo $this->Form->input(
				CONS::$str_Filter_Hins_3,
				$opt_input_Hins
		);
		 
		echo $this->Form->end('Filter');
			
	?>
	
</th>
