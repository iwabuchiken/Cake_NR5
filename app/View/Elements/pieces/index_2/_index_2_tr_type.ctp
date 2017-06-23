		<tr id="tr_type">
		
			<td colspan="2">
			
				<!-- ref http://www.htmq.com/html/input_checkbox.shtml -->
				<font color="blue">
					Type
				</font>
					<?php 
					
						$aryOf_Type_Names = CONS::$listOf_Type_Nams;
						
						foreach ($aryOf_Type_Names as $name) {
							
					?>
				
						<input 
							type="checkbox" 
							class="cb_type" 
							name="riyu" 
							value="<?php echo $name; ?>" 
							checked="checked">
							
							<?php 
							
								echo $name;
							
							?>

						<!-- ref https://stackoverflow.com/questions/6293588/how-to-create-an-html-checkbox-with-a-clickable-label -->
		
					<?php
							
						}//foreach ($aryOf_Type_Names as $name)
						
					?>

				<button id="uncheck_All_Types" 
						onclick="uncheck_All_Types();">
						
						Check/Uncheck
						
				</button>
				
			</td>
		
			<td colspan="2">
			
				<font color="blue">
					Filter
				</font>
			
				<?php
					
					$index = 0;
					
					foreach ($listOf_Hin_Nams as $item) {
				?>
				
				<input type="checkbox" class="cb_hin" name="riyu" 
						value="<?php echo $index; ?>"
						
						checked="checked"
						>
						
						<?php echo $item; ?>
							
				<?php 	
				
						$index += 1;
				
					}//foreach ($listOf_ColumnNames as $item)
					
				?>
				
				<button id="uncheck_all_hins" onclick="uncheck_All_Hins();">Check/Uncheck</button>
			
			</td>
		
		</tr><!-- <tr id="tr_type"> -->
