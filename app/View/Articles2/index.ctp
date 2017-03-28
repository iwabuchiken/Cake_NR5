<h1>
	Articles 2 
	
</h1>

<?php 

	$count = 1;

	foreach ($articles as $a) {
	
// 		echo $article['line']." / ".$article['url'];
		
// 		echo "<br>"; echo "<br>";
		
		echo "<a href=\"".$a['url']."\" target=_blank".">"
				."$count) "
				.$a['line']
				."</a>";
// 		echo "<a href=\"".$a['url']."\"".">".$a['line']."</a>";
		
		echo "<br>"; echo "<br>";
		
		// increment
		$count ++;
		
	}//foreach ($articles as $article)
	
	



?>