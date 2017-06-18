<h1>

	Pieces
		
</h1>

(<a href="#bottom">Bottom</a><a name="top"></a>)

<hr>

<div>
<!-- <div> -->
	Type
	<SELECT>
	<OPTION value="kanji">Kanji</OPTION>
	<OPTION value="hiragana" selected>Hiragana</OPTION>
	<OPTION value="katakana">Katakana</OPTION>
	</SELECT>
</div>

<div>
	abc
	<SELECT>
	<OPTION value="1">項目１</OPTION>
	<OPTION value="2" selected>項目２</OPTION>
	<OPTION value="3">項目３</OPTION>
	<OPTION value="4">項目４</OPTION>
	<OPTION value="5">項目５</OPTION>
	</SELECT>
</div>

<hr>

<p class="radio-area">
    <input type="radio" name="lang" value="ruby" checked="checked">Ruby
    &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="lang" value="perl">Perl
</p>

<hr>
<form method="post" action="example.cgi">

<p>デフォルト<br>
<input type="radio" name="q1" value="はい"> はい
<input type="radio" name="q1" value="いいえ"> いいえ
</p>

<p>「いいえ」を選択済みに<br>
<input type="radio" name="q2" value="はい"> はい
<input type="radio" name="q2" value="いいえ" checked> いいえ
</p>

<p>「いいえ」を無効化<br>
<input type="radio" name="q3" value="はい"> はい
<input type="radio" name="q3" value="いいえ" disabled> いいえ
</p>

<p><input type="submit" value="送信する"></p>

</form>
<br>
<br>

<form>

	<p>
		<input type="radio" name="type" value="kanji" checked>Kanji<br>
		<input type="radio" name="type" value="hiragana">Hiragana
	</p>


</form>


<div id="link_area">

	<a onclick="filter_By_Type()">Filter by type</a>
	
	<p>
		<input type="radio" name="type" value="kanji" checked>Kanji<br>
		<input type="radio" name="type" value="hiragana">Hiragana
	</p>

</div>

<div id="list_area">
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