<tr>
		<th>Id</th>
		<th>Form</th>
		
		<th>
		
			Hin
			
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
			
				$opt_input_Hins= array(
						'type' => 'select',
						'options' => $hins_Array,
						'label'	=> false
				);
				
				if (isset($chosen_hin)) {
				
					//REF http://stackoverflow.com/questions/6259371/cakephp-this-form-input-how-to-set-a-select-default-option answered Jun 7 '11 at 0:38
					$opt_input_Hins['default'] = $chosen_hin;
						
				}
				
				
				echo $this->Form->create('', $opt_create);
				 
				echo $this->Form->input(
						CONS::$str_Filter_Hins,
// 						'filter_hins',
						$opt_input_Hins
				);
				 
				echo $this->Form->end('Filter');
					
			?>
			
		</th>
		
		<th>
		
			Hin 1
			
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
// 						'filter_hins',
						$opt_input_Hins
				);
				 
				echo $this->Form->end('Filter');
					
			?>
			
		</th>
		
		<th>Hin 2</th>
		<th>Hin 3</th>
		
		<th>katsu_kei</th>
		<th>katsu_kata</th>
		
		<th>genkei</th>
		<th>yomi</th>
		<th>hatsu</th>
		
		<th>History</th>
		
		<th>Created at</th>
		<th>updated at</th>
		
</tr>
