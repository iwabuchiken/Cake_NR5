<h1>

	Pieces
		
</h1>

(<a href="#bottom">Bottom</a><a name="top"></a>)

<br>
<br>
<hr>

<div id="link_area">

<div>

<!-- <div> -->
<!-- ref select http://html.eweb-design.com/0905_slc.html -->
	Sort
	<SELECT>
	<OPTION value="1">項目１</OPTION>
	<OPTION value="2" selected>項目２</OPTION>
	<OPTION value="3">項目３</OPTION>
	<OPTION value="4">項目４</OPTION>
	<OPTION value="5">項目５</OPTION>
	</SELECT>
<!-- </div> -->

</div>
<div>
<!-- ref http://www.htmq.com/html/input_checkbox.shtml -->
Type
<!-- <p> -->
<input type="checkbox" class="cb_type" name="riyu" value="kanji" checked="checked">Kanji
<input type="checkbox" class="cb_type" name="riyu" value="hiragana" >Hiragana
<input type="checkbox" class="cb_type" name="riyu" value="katakana" >Katakana
<!-- <label>Number</label><input type="checkbox" class="cb_type" name="riyu" value="number" > -->

<input type="checkbox" class="cb_type" name="riyu" value="number" >Number
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