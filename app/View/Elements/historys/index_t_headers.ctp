<tr>
		<th>
		
			<?php echo $this->Html->link(
								'Id',
								array('controller' => 'historys', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=id')
						);
			?>
			
		</th>
		
		<th>
			<?php echo $this->Html->link(
								'Line',
								array('controller' => 'historys', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=line')
						);
			?>
			
<!-- 			Line -->
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
			
			<?php echo $this->Html->link(
								'Vendor',
								array('controller' => 'historys', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=vendor')
						);
			?>
			
			
		</th>
		
		<th>
			
			<?php echo $this->Html->link(
								'Time',
								array('controller' => 'historys', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=news_time')
						);
			?>
			
		</th>
		
		<th>
			
			<?php echo $this->Html->link(
								'Category',
								array('controller' => 'historys', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=category_id')
						);
			?>
			
		</th>
		
		<th>
			
			<?php echo $this->Html->link(
								'Genre',
								array('controller' => 'historys', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=genre_id')
						);
			?>
		</th>
		
		<th>
			
			<?php echo $this->Html->link(
								'Created at',
								array('controller' => 'historys', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=created_at')
						);
			?>
		</th>
		
		<th>
			
			<?php echo $this->Html->link(
								'Updated at',
								array('controller' => 'historys', 
										'action' => 'index',
// 										'sort'		=> 'id')
										'?'		=> 'sort=updated_at')
						);
			?>
			
		</th>

</tr>
