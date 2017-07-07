<button class="basic" id="links_2_Show_Hide">
	Links 2
<!-- 	Show/Hide -->
</button>

<div class="footer" id="div_Default_Layout_Footer_2">


	<table id="links_2">
		<tr>
		
		
		</tr>
	
		<tr>
		
			<td>
	
				<?php 
					
					$servername = env('SERVER_NAME');
					
					$option = null;
					
					if ($servername == 'localhost') {
							
						$option = array(
									
								'controller' => 'Pieces',
								'action' => 'stats'
					
						);
					
					} else {//if ($servername == 'localhost')
							
						$option = 'http://benfranklin.chips.jp/cake_apps/Cake_NR5/pieces/index?action=stats';
					
					}//if ($servername == 'localhost')
							
				
				
					echo $this->Html->link(
						
						'Stats',
						$option,
	// 					array('controller' => 'Pieces', 
	// 							'action' => 'stats'),
						array('class' => "button"));
				?>
			
			</td>
			
			<td>
	
				<?php 
				
	// 				$servername = env('SERVER_NAME');
					
					$option = null;
					
					if ($servername == 'localhost') {
						
						$option = array(
								
								'controller' => 'Pieces',
								'action' => 'index_2'
						
						);
							
					} else {//if ($servername == 'localhost')
						
						
						$option = array(
									
								'controller' => 'Pieces',
								'action' => 'index'
				
						);
							
					}//if ($servername == 'localhost')
				
					echo $this->Html->link(
						
						'Pieces',
						$option,
	// 					array('controller' => 'Pieces', 
	// 							'action' => 'stats'),
						array('class' => "button")
					);
				?>
			
			</td>
			
			<td>
	
				<?php echo $this->Html->link(
						
						'Pieces(remote)',
						'http://benfranklin.chips.jp/cake_apps/Cake_NR5/pieces/index',
						array('target'	=> '_blank')
						
						);
				?>
			
			</td>
			
			<td>
	
				<?php echo $this->Html->link(
						
						'Pieces(local)',
						'http://localhost/Eclipse_Luna/Cake_NR5/pieces/index_2',
						array('target'	=> '_blank')
						
						);
				?>
			
			</td>
			
			<td>
	
				<?php 
				
					$option = null;
					
					if ($servername == 'localhost') {
						
						$option = array(
								
								'controller' => 'Pieces',
								'action' => 'svo'
						
						);
							
					} else {//if ($servername == 'localhost')
						
						$option = "http://benfranklin.chips.jp"
									."/cake_apps/Cake_NR5/pieces/index"
									."?action=svo";
						
					}//if ($servername == 'localhost')
				
					echo $this->Html->link(
						
						'SVO',
						$option,
	// 					array('controller' => 'Pieces', 
	// 							'action' => 'stats'),
						array('class' => "button")
					);
				?>
			
			</td>
			
			
		</tr>
		
	</table>
</div>
	
