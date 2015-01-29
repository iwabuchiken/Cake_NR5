<th>
		
	<?php echo $this->Html->link(
						'Category',
						array('controller' => 'historys', 
								'action' => 'index',
								'?'		=> 'sort=category_id')
				);
	?>
		

	<?php 
	
// 		$opt_input = array(
		
// 				'onmouseover' => 'this.select()',
// 				'rows' => '1',
// 				//REF http://stackoverflow.com/questions/973637/how-do-i-set-the-width-of-a-text-box-in-cakephp-using-the-style-option
// 				'style'	=> 'width: 200px',
// 				'label'	=> '',
// 				'name'	=> 'filter_Line'
	
// 		);
		
		$opt_input = array(
				'type' => 'select',
				'options' => $category_Id_Array,
				'label'	=> false
		);
		
		if (isset($chosen_history_id)) {
		
			//REF http://stackoverflow.com/questions/6259371/cakephp-this-form-input-how-to-set-a-select-default-option answered Jun 7 '11 at 0:38
			$opt_input['default'] = $chosen_history_id;
		
		}
		
		$opt_create = array(
				
				'div'	=> false,
				//REF http://wiltonsoftware.com/posts/view/customizing-your-form-labels-in-cakephp-1-2
				'label'	=> false,
				'url'	=> array(
								'controller'	=> 'historys',
								'action'	=> 'index'),
				'type'	=> 'get'
				
			
		);
			
		$opt_End = array(
				
				'div'	=> false,
				'label'	=> false,
			
		);
			
		echo $this->Form->create(null, $opt_create);
		
		echo $this->Form->input('filter_Cat', $opt_input);
		
		echo $this->Form->end(
						'Filter');
		
	?>

</th>

