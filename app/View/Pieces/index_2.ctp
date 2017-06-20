<h1>

	Pieces
		
</h1>

(<a href="#bottom">Bottom</a><a name="top"></a>)

<br>
<br>
<hr>

<div id="link_area">

<div>

<span id="numOf_sort_block" hidden>1</span>
<!-- <div> -->
<!-- ref select http://html.eweb-design.com/0905_slc.html -->
	Sort 1
	<SELECT id="select_sort_column_1">
	
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
	
	Sort 2
	<SELECT id="select_sort_column_2">
	
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
	
	Sort 3
	<SELECT id="select_sort_column_3">
	
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
	
</div>

<div class="radio_buttons">

	<input type="radio" name="sort_direction_1" id="sort_direction_1_asc" value="asc" checked/>
	<label for="sort_direction_1_asc">ASC</label>
	
	<input type="radio" name="sort_direction_1" id="sort_direction_1_desc" value="desc"/>
	<label for="sort_direction_1_desc">DESC</label>
	
</div>

<div class="radio_buttons">

	<input type="radio" name="sort_direction_2" id="sort_direction_2_asc" value="asc" checked/>
	<label for="sort_direction_2_asc">ASC</label>
	
	<input type="radio" name="sort_direction_2" id="sort_direction_2_desc" value="desc"/>
	<label for="sort_direction_2_desc">DESC</label>
	
</div>

<div class="radio_buttons">

	<input type="radio" name="sort_direction_3" id="sort_direction_3_asc" value="asc" checked/>
	<label for="sort_direction_3_asc">ASC</label>
	
	<input type="radio" name="sort_direction_3" id="sort_direction_3_desc" value="desc"/>
	<label for="sort_direction_3_desc">DESC</label>
	
</div>


<div>
<!-- ref http://www.htmq.com/html/input_checkbox.shtml -->
Type
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
</div>


<br>

<!-- 	<a onclick="filter_By_Type()"> -->
<!-- 	<a onclick="show_List()"> -->
	<button onclick="show_List()" class="basic">
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