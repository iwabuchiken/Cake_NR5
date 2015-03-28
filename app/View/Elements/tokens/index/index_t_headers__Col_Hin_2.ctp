<th id="hin_2">

	<?php 
		
		$link_Options['?'] = 'sort=hin_2';
	
		echo $this->Html->link(
						'Hin 2',
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
				'label'	=> false,
				'id'	=> 'form_hin_2'
		
		);
	
		$opt_input_Hins= array(
				'type' => 'select',
				'options' => $hins_2_Array,
				'label'	=> false,
				'id'	=> 'header_hins_2',
		);
		
		if (isset($chosen_hin_2)) {
		
			//REF http://stackoverflow.com/questions/6259371/cakephp-this-form-input-how-to-set-a-select-default-option answered Jun 7 '11 at 0:38
			$opt_input_Hins['default'] = $chosen_hin_2;
				
		}
		
		echo $this->Form->create('', $opt_create);
		 
		echo $this->Form->input(
				CONS::$str_Filter_Hins_2,
				$opt_input_Hins
		);
		 
		echo $this->Form->end('Filter');
			
	?>
	
</th>
