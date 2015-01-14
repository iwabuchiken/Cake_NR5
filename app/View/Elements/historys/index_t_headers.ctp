<tr>
		<th>Id</th>
		
		<th>
			Line
			<?php 

				$opt_input = array(
				
						'onmouseover' => 'this.select()',
						'rows' => '1',
// 						'cols'	=> '1'
						//REF http://stackoverflow.com/questions/973637/how-do-i-set-the-width-of-a-text-box-in-cakephp-using-the-style-option
						'style'	=> 'width: 200px',
						'label'	=> '',
						'name'	=> 'filter'
// 						'div'	=> false,
			
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
// 						'size'	=> 10,
// 						'style'	=> '',
// 						'font'	=> '',
// 						'style'	=> 'font-size: 3px',
// 						'class'	=> 'form-button',
					
				);
					
				echo $this->Form->create(null, $opt_create);
// 				echo $this->Form->create('', $opt_create);
// 				echo $this->Form->create('Filter');
				
				echo $this->Form->input('filter', $opt_input);
				
// 				echo $this->Form->end('Go', $opt_End);
				//REF http://cakephp.1045679.n5.nabble.com/removing-lt-div-gt-in-Form-gt-end-closing-in-cakephp-1-3-td5714867.html
// 				echo $this->Form->end(array('div' => false, 'text' => 'send'));	//=> n/w
// 				echo $this->Form->end('', array('div' => false, 'text' => 'send'));	//=> n/w
				echo $this->Form->end(
								'Filter("__@" to clear)');
// 							'Filter', 
// 							array('div' => false, 'text' => 'send'));
					
			?>
			
		</th>
		
		<th>
			Vendor
			
			
		</th>
		
		<th>Time</th>
		<th>Category</th>
		<th>Genre</th>
		<th>Created at</th>
		<th>updated at</th>
		
</tr>
