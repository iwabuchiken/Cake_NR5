<tr id="tr_Group_By">
	<td colspan="4">

	<font color="blue">
	Group by
	</font>
	
	<?php
	
		$aryOf_ColNames = $listOf_ColumnNames;
// 		$aryOf_ColNames = array(
				
// 				"hin",
// 				"hin_1",
// 				"hin_2",
// 				"hin_3",
				
// 		);
		
	?>

	<?php 
	
		foreach ($aryOf_ColNames as $name) {
			
	?>

		<input 
			type="checkbox" 
			class="cb_Group_By" 
			name="riyu" 
			value="<?php echo $name; ?>" 
			>
			
			<?php 
			
				echo $name;
			
			?>

		<!-- ref https://stackoverflow.com/questions/6293588/how-to-create-an-html-checkbox-with-a-clickable-label -->

	<?php
			
		}//foreach ($aryOf_Type_Names as $name)
		
	?>

		<button id="uncheck_All_Types" 
				onclick="uncheck_All_Groups();">
				
				Check/Uncheck
				
		</button>

	
	</td>
	
</tr><!-- <tr id="tr_Group_By"> -->
