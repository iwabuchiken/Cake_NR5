<?php 

// 	$link_Options = array('controller' => 'tokens', 
	$link_Options = array('controller' => 'Tokens', 
										'action' => 'index');

?>

<tr>
		<th>
			<?php 
			
				$link_Options['?'] = 'sort=id';
			
				echo $this->Html->link(
								'Id',
								$link_Options

				);
			?>
			
		</th>
		
		<th>
			<?php 
			
				$link_Options['?'] = 'sort=form';
			
				echo $this->Html->link(
								'Form',
								$link_Options

				);?>
			
		</th>
		
		<?php echo $this->element('tokens/index/index_t_headers__Col_Hin'); ?>
		
		<?php echo $this->element('tokens/index/index_t_headers__Col_Hin_1'); ?>
		
		<?php echo $this->element('tokens/index/index_t_headers__Col_Hin_2'); ?>
		
		<?php echo $this->element('tokens/index/index_t_headers__Col_Hin_3'); ?>
		
		
<!-- 		<th>Hin 2</th> -->
<!-- 		<th>Hin 3</th> -->
		
		<th>katsu_kei</th>
		<th>katsu_kata</th>
		
		<th>genkei</th>
		
		<th>
			<?php 
			
				$link_Options['?'] = 'sort=yomi';
			
				echo $this->Html->link(
								'yomi',
								$link_Options

				);
			?>
			
		</th>
		
		<th>hatsu</th>
		
		<?php echo $this->element('tokens/index/index_t_headers__Col_History'); ?>
		
<!-- 		<th>History</th> -->
		
		<?php echo $this->element('tokens/index/index_t_headers__Col_Category'); ?>
		
<!-- 		<th>Category</th> -->
		
		<th>Created at</th>
		<th>updated at</th>
		
</tr>
