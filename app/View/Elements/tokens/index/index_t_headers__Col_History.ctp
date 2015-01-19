<th>

	<?php 
		
		$link_Options['?'] = 'sort=history_id';
	
		echo $this->Html->link(
						'History Id',
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
				'type'	=> 'get'
		
		);
	
		$opt_input_History_Id= array(
				'type' => 'select',
				'options' => $history_id_Array,
				'label'	=> false
		);
		
		if (isset($chosen_history_id)) {
		
			//REF http://stackoverflow.com/questions/6259371/cakephp-this-form-input-how-to-set-a-select-default-option answered Jun 7 '11 at 0:38
			$opt_input_History_Id['default'] = $chosen_history_id;
				
		}
		
		
		echo $this->Form->create('', $opt_create);
		 
		echo $this->Form->input(
				CONS::$str_Filter_Hist_Id,
// 				CONS::$str_Filter_Hins,
				$opt_input_History_Id
		);
		 
		echo $this->Form->end('Filter');
				
	?>
	
</th>
