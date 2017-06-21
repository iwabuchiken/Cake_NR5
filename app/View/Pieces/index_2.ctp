<h1>

	Pieces
		
</h1>

(<a href="#bottom">Bottom</a><a name="top"></a>)

<br>
<br>
<hr>

<div id="link_area">

<!-- <div> -->

	<span id="numOf_sort_block" hidden>1</span>
	
	<!-- ref select http://html.eweb-design.com/0905_slc.html -->
	
	<table>
	
		<tr>
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
			
			</td>
			
			<?php 
			
				}//foreach ($sort_block_ids as $id_num)
				
			?>
			
		</tr>
<!-- 	</table> -->
	
<!-- </div> -->

		<tr>
<?php 

// 	$sort_block_ids = array(1, 2, 3, );

	foreach ($sort_block_ids as $id_num) {
	
?>

	<td>
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
<!-- 	</table> -->

		<tr>
			<td colspan="2">
			<!-- <div> -->
			<!-- ref http://www.htmq.com/html/input_checkbox.shtml -->
			<font color="blue">
				Type
			</font>
			<!-- <p> -->
			<input type="checkbox" class="cb_type" name="riyu" value="Kanji" checked="checked">Kanji
			<input type="checkbox" class="cb_type" name="riyu" value="Hiragana" >Hiragana
			<input type="checkbox" class="cb_type" name="riyu" value="Katakana" >Katakana
			<!-- <label>Number</label><input type="checkbox" class="cb_type" name="riyu" value="number" > -->
			
			<input type="checkbox" class="cb_type" name="riyu" value="Number" >Number
			<input type="checkbox" class="cb_type" name="riyu" value="Other" >Other
			<!-- ref https://stackoverflow.com/questions/6293588/how-to-create-an-html-checkbox-with-a-clickable-label -->
			<!-- <label class="basic"><input type="checkbox" class="cb_type" name="riyu" value="number" >Number</label> -->
			<!-- </p> -->
			<!-- </div> -->

			</td>
<!-- 		</tr> -->
		
		
<!-- 		<tr> -->
		
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
			
			</td>
		
		</tr>
		
		
	</table>
<br>

<!-- 	<a onclick="filter_By_Type()"> -->
<!-- 	<a onclick="show_List()"> -->
	<button onclick="show_List()" class="basic" id="index_2_go">
		Go
	</button>
<!-- 	</a> -->
	
</div><!-- <div id="link_area"> -->

<br>
<hr>

<br>
<br>

<div id="list_area" >
<!-- <div id="list_area" style="height:100px;width:140px;overflow:auto;background-color:yellowgreen;color:white;scrollbar-base-color:gold;font-family:sans-serif;padding:10px;"> -->
<!-- <div id="list_area" style="height:100px;overflow:auto;background-color:yellowgreen;color:white;scrollbar-base-color:gold;font-family:sans-serif;padding:10px;"> -->
List

</div>
<br>
<br>
(<a href="#top">Top</a><a name="bottom"></a>)

<?php 

// 	$count = 1;

// 	foreach ($articles as $a) {
	
// // 		echo $article['line']." / ".$article['url'];
		
// // 		echo "<br>"; echo "<br>";
		
// 		echo "<a href=\"".$a['url']."\" target=_blank".">"
// 				."$count) "
// 				.$a['line']
// 				."</a>";
// // 		echo "<a href=\"".$a['url']."\"".">".$a['line']."</a>";
		
// 		echo "<br>"; echo "<br>";
		
// 		// increment
// 		$count ++;
		
// 	}//foreach ($articles as $article)
	
	



?>