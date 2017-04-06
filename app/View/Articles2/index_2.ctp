<h1>
	Articles 2: index_2 
	
</h1>

(<a href="#bottom">Bottom</a><a name="top"></a>)

<?php 

	echo "<br>"; echo "<br>";

?>

<?php 

	//test
	mb_language("Japanese");

?>

<?php 

	if (isset($articles_categorized)) {
	
		echo $articles_categorized[0];
		
		echo "<br>"; echo "<br>";
	
	} else {
	
		echo "\$articles_categorized => not set";
		
		return;
		
	}//if (isset($articles_categorized))
	
	

?>

<!-- ------------------------------------------------ -->

<table>

<?php 

// 	debug($articles_categorized[1][0]);
// 	debug($articles_categorized[1][0][0]);	//=> 'biology'
// 	debug($articles_categorized[1][0][1][0][0]['line']);	//=> article line
// 	debug($articles_categorized[1][0][1][0][0]);	//=> 
	
	$count_article = 1;
	
	foreach ($articles_categorized[1] as $category_set) {
// 	foreach ($articles_categorized as $category_set) {
	
		echo "<tr>";
		echo "<td colspan='3' bgcolor='yellow'>";
		echo $category_set[0];	//=> 'biology'
		echo "</td>";
// 		echo "</tr>"

		$category_name = $category_set[0];
		
// // 		$lenof_category_set = count($category_set[1][0]);
// 		$lenof_category_set = count($category_set[1][0][0]);
		
// 		debug($lenof_category_set);	//	=> 3
// 		debug("\$category_set[1][0][0] =>");
// 		debug($category_set[1][0][0]);
		// 		array(
		// 				'url' => 'http://www.asahi.com/articles/ASK3W5J6KK3WPLBJ005.html',
		// 				'line' => 'ｉＰＳ、医療利用への試金石　他人の細胞から初移植(3/28)  ',
		// 				'vendor' => 'www.asahi.com'
		// 		)
		
// 		debug("\$category_set[1][0] =>");
// 		debug($category_set[1][0]);
// 		debug("\$category_set[1] =>");
// 		debug($category_set[1]);
		
		$lenof_category_set_1 = count($category_set[1]);
		
		for ($i = 0; $i < $lenof_category_set_1; $i++) {
			
			$article_set = $category_set[1][$i];
		
			echo "<tr>";
				echo "<td>";
				
					echo $count_article;
					
					$count_article ++;
					
				echo "</td>";
				echo "<td>";
				
			
				if ($category_name != "others") {
				
					echo "<a href=\"".$article_set[0]['url']."\" target=_blank".">"
					// 						."$count) "
					// 						.mb_string($a['line'])
					.mb_convert_encoding($article_set[0]['line'], 'UTF-8')
					// 						.$a['line']
					."</a>";
						
// 					echo $article_set[0]['line'];
				
				} else {
				
// 					echo $article_set['line'];
					echo "<a href=\"".$article_set['url']."\" target=_blank".">"
							// 						."$count) "
					// 						.mb_string($a['line'])
					.mb_convert_encoding($article_set['line'], 'UTF-8')
					// 						.$a['line']
					."</a>";
						
					
				}//if ($category_name != "others")

				echo "<td>";
				
				if ($category_name != "others") {
				
					echo $article_set[0]['vendor'];
				
				} else {
				
					echo $article_set['vendor'];
						
				}//if ($category_name != "others")
				
				echo "</td>";
				
				
				echo "</td>";
			echo "</tr>";
				
		}//for ($i = 0; $i < $lenof_category_set; $i++)
		
		
// 		echo "<td>";
// // 		echo $category_set[0][0];
// 		echo $category_set[1][0][0]['line'];
// // 		echo $category_set[0];
// 		echo "</td>";
		
// 		echo "</tr>";

?>
<?php 
		
	}//foreach ($articles_categorized as $category_set)

?>
</table>

<!-- ------------------------------------------------ -->

<?php 
	echo "<br>"; echo "<br>";

?>

(<a href="#top">Top</a><a name="bottom"></a>)

