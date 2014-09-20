<h1>Articles</h1>

<?php 

	echo $ahrefs_hl[0]->plaintext;
	echo "<br>";
	
// 	echo $articles[0]['url'];	// Undefined offset: 0
// 	echo "<br>";

// 	debug($ahrefs_hl[0]);
	
?>

<table>

<?php 

// 	echo "<table>";

	echo $this->element('articles/index/_idx_t_entries');
	
// 	foreach ($ahrefs_hl as $a) {
	
// 		echo "<tr>";
// 		echo "<td>";
// 		echo $this->Html->link(
// 		//     					'news',
// 								//REF http://so-zou.jp/web-app/tech/programming/php/library/simplehtmldom/#no7
// 		    					$a->plaintext,
// 								$a->href,
// 								array('target' => '_blank')
// 		//     					array('url' => $ahrefs_hl[0]->href)
// 							); 

// 		echo "</td>";
// 		echo "</tr>";
	
// 	}
	
// 	echo "</table>";

?>

</table>
