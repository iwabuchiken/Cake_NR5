<h1>
<!-- 	Articles 2: index_2  -->
<?php 

	if (isset($articles_categorized)) {

		$genre_name = $articles_categorized[0];
		
		echo "<font color='blue'>$genre_name</font> (total = ".$articles_categorized[2].")";
// 		echo $articles_categorized[0];
		
		echo "<br>"; echo "<br>";
	
	} else {
	
		echo "\$articles_categorized => not set";
		
		return;
		
	}//if (isset($articles_categorized))
	
	

?>

	
</h1>

(<a href="#bottom">Bottom</a><a name="top"></a>)

<!-- <div id="message_space"> -->

<!-- message space -->

<!-- </div> -->

<?php 

	echo "<br>"; echo "<br>";

	echo $this->element('articles2/index/_header');
	
	echo "<br>"; echo "<br>";
	
?>

<?php 	

	//test
	mb_language("Japanese");

?>

<!-- ------------------------------------------------ -->

<table>

<?php 

	$count_article = 1;
	
	foreach ($articles_categorized[1] as $category_set) {
	
		$category_name = $category_set[0];
		
		echo "<tr>";
		
			echo "<td colspan='3' bgcolor='yellow'>";
			
				echo "$category_name (".count($category_set[1]).")";
				
			echo "</td>";

		echo "</tr>";
		
		/*******************************
			tag: tr
		*******************************/
		$lenof_category_set_1 = count($category_set[1]);
		
// 		//debug
// 		if (isset($category_set[1][0])) {
// // 		if ($category_name != "others") {
			
// 			debug($category_set[1][0]);
			
// 		} else {
			
// 			debug($category_set);
// // 			debug($category_set[1]);
			
// 		}

// 		debug("\$category_set[1] =>");
// 		debug($category_set[1]);
// 		debug($category_set[1][0]);
		
		for ($i = 0; $i < $lenof_category_set_1; $i++) {
			
			$article_set = $category_set[1][$i];
		
			echo "<tr>";
			
				/*******************************
					serial number
				*******************************/
				echo "<td>";
				
					echo $count_article;
					
					$count_article ++;
					
				echo "</td>";
				
				/*******************************
					line
				*******************************/
				
				echo $this->element('articles2/index/_index_td_line', 
				
					array(
					
							"category_name"	=> $category_name
					
							, "article_set"	=> $article_set
					
					)
				
				);
				
// 				echo "<td>";
				
			
// 				if ($category_name != "others") {
				
// 					echo "<a href=\"".$article_set[0]['url']."\" target=_blank".">"
// 					// 						."$count) "
// 					// 						.mb_string($a['line'])
// 					.mb_convert_encoding($article_set[0]['line'], 'UTF-8')
// 					// 						.$a['line']
// 					."</a>";
						
// // 					echo $article_set[0]['line'];
				
// 				} else {
				
// // 					echo $article_set['line'];
// 					echo "<a href=\"".$article_set['url']."\" target=_blank".">"
// 							// 						."$count) "
// 					// 						.mb_string($a['line'])
// 					.mb_convert_encoding($article_set['line'], 'UTF-8')
// 					// 						.$a['line']
// 					."</a>";
						
					
// 				}//if ($category_name != "others")

// 				echo "</td>";
				
				/*******************************
					vendor
				*******************************/
				echo "<td>";
				
				if ($category_name != "others") {
				
					echo $article_set[0]['vendor'];
				
				} else {
				
					echo $article_set['vendor'];
						
				}//if ($category_name != "others")
				
				echo "</td>";
				
				
// 				echo "</td>";
				
			echo "</tr>";
				
		}//for ($i = 0; $i < $lenof_category_set; $i++)

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

