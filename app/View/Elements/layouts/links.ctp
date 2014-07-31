<br>
<br>

<table id="links">
	<tr>
	
		<td>
		
			<?php echo $this->Html->link(
								'Videos',
								array('controller' => 'videos', 
										'action' => 'index'),
								array('class' => "button"));
			?>
			
		</td>
		
		<td>
		
			<?php echo $this->Html->link(
								'Genres',
								array('controller' => 'genres', 
										'action' => 'index'),
								array('class' => "button"));
			?>
			
		</td>
	
		<td>
		
			<?php echo $this->Html->link(
								'Positions',
								array('controller' => 'positions', 
										'action' => 'index'),
								array('class' => "button"));
			?>
		</td>
		
		<td>
		
			<?php echo $this->Html->link(
								'Remote app',
								$url = "http://benfranklin.chips.jp/cake_apps/VM_Cake/videos",
								array('target' => '_blank'));
			?>
	
		</td>
		
	</tr>
	
	<tr>
	
		<td>
		
			<?php echo $this->Html->link(
								'Login',
								array('controller' => 'users', 
										'action' => 'login'),
								array('class' => "button"));
			?>
			
		</td>
	
		<td>
		
			<?php echo $this->Html->link(
								'Logout',
								array('controller' => 'users', 
										'action' => 'logout'),
								array('class' => "button"));
			?>
			
		</td>
	
	</tr>
	
</table>
