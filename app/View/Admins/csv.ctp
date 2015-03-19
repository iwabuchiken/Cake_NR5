<table>

	<tr>
		
		<th class="csv_maintable">
		<!-- <th style="width: 20%;"> -->

			Create CSV
		
		</th>
	
		<th class="csv_maintable">
		<!-- <th style="width: 100px;"> -->

			Download CSV
		
		</th>
	
	</tr>

	<tr>
		
		<td class="csv_maintable">
		
			<?php echo $this->Html->link("Tokens",
								array(
									'controller' => 'admins', 
									'action' => 'csv_Tokens_create',
									'tokens'
									)
								); 
			?>
		
		</td>
	
		<td class="csv_maintable">
		
			<?php echo $this->Html->link("Tokens",
								array(
									'controller' => 'admins', 
									'action' => 'csv_Tokens_dl',
									'tokens')
// 									'name')
// 									'name' => 'index')
// 									'action' => 'csv_Tokens_dl')
								); 
			?>
		
		</td>
	
	</tr>

</table>