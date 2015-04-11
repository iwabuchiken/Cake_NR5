<th>
	<?php echo $this->Html->link(
						'Line',
						array('controller' => 'historys', 
								'action' => 'index',
								'?'		=> 'sort=line')
				);
	?>
	
	<?php 

		$opt_input = array(
		
				'onmouseover' => 'this.select()',
				'rows' => '1',
				//REF http://stackoverflow.com/questions/973637/how-do-i-set-the-width-of-a-text-box-in-cakephp-using-the-style-option
				'style'	=> 'width: 200px',
				'label'	=> '',
				'name'	=> 'filter_Line'
	
		);
		
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
		
		//REF http://www.cakephpexample.com/cakephp/cakephp-radio-button/
		// 			echo $this->Form->input('RadioGroup', array(
		echo $this->Form->input(CONS::$str_Filter_RadioButtons_Name_History, array(
				'div' => true,
				// 					'div' => false,
				'label' => true,
				'type' => 'radio',
				'legend' => false,
				'options' => array(
						CONS::$str_Filter_RadioButtons_History_AND
						=> CONS::$str_Filter_RadioButtons_History_AND,
						CONS::$str_Filter_RadioButtons_History_OR
						=> CONS::$str_Filter_RadioButtons_History_OR
				),
				'default'	=> CONS::$str_Filter_RadioButtons_History_AND
				// 					'options' => array(1 => 'Personal ', 2 => 'Company')
		));
		
		
		echo $this->Form->input('filter', $opt_input);
		
		echo $this->Form->end(
						'Filter("__@" to clear)');
			
	?>
	
</th>
