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
						'options' => $hins_Array,);
				
				echo $this->Form->create('', $opt_create);
				 
				echo $this->Form->input(
						'filter_hins',
						$opt_input_Hins
				);
				 
				echo $this->Form->end('Filter');
					
			?>
			
		</th>
		
		<th>Hin 1</th>
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
