		<tr id="tr_sort">
			<?php 
			
				$sort_block_ids = array(1, 2, 3, 4);
			
				foreach ($sort_block_ids as $id_num) {
				
				
			?>
			<td>
				Sort <?php echo $id_num; ?>
				<SELECT id="select_sort_column_<?php echo $id_num; ?>">
				
					<OPTION value="0">---</OPTION>
					
					<?php 
					
						$index = 0;
						
						foreach ($listOf_ColumnNames as $item) {
						
							echo "<OPTION value=\"$item\">".$item."</OPTION>";
				// 			echo "<OPTION value=\"$index\">".$item."</OPTION>";
							
							$index += 1;
							
						}//foreach ($listOf_ColumnNames as $item)
						
					?>
				</SELECT>

	<div class="radio_buttons">
	
		<input type="radio" name="sort_direction_<?php echo $id_num; ?>" id="sort_direction_<?php echo $id_num; ?>_asc" value="asc" checked/>
		<label for="sort_direction_<?php echo $id_num; ?>_asc">ASC</label>
		
		<input type="radio" name="sort_direction_<?php echo $id_num; ?>" id="sort_direction_<?php echo $id_num; ?>_desc" value="desc"/>
		<label for="sort_direction_<?php echo $id_num; ?>_desc">DESC</label>
		
	</div>
			
			</td>
			
			<?php 
			
				}//foreach ($sort_block_ids as $id_num)
				
			?>
			
		</tr>
