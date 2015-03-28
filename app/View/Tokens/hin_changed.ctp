	<?php 
	
// 		//log
// 		Utils::write_Log(
// 						Utils::get_dPath_Log(),
// 						"view",
// 						__FILE__, __LINE__);
		
	
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
				'label'	=> false,
				'id'	=> 'header_hins_1',
				'div'	=> false,
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
		