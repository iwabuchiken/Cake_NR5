links

<?php 

	/**************************************************************
		biuld list
	**************************************************************/
// 	debug(count($articles_categorized));
// 	debug($articles_categorized[1]);
	// 	array(
	// 			(int) 0 => array(
	// 					(int) 0 => 'Energy',
	// 					(int) 1 => array(
	// 							(int) 0 => array(
	// 									(int) 0 => array(
	// 											'url' => 'http://www.asahi.com/articles/ASK3Y4JQSK3YPLFA002.html',
	// 											'line' => '屋内でも発電、太陽光いらずの太陽電池　積水化学(4/2) ',
	// 											'vendor' => 'www.asahi.com'
	// 									),
	// 									(int) 1 => '1000',
	// 									(int) 2 => '太陽電池'
	// 							)
	// 					)
	// 			),
	// 			(int) 1 => array(
	// 					(int) 0 => 'Nuke',
	// 					(int) 1 => array()

// 	debug($articles_categorized[2]);

// 	$category_names = array_keys($articles_categorized[1]);

// 	debug($category_names);
	
	/*******************************
		cat names
	*******************************/
	$cat_label_set = array();

	foreach ($articles_categorized[1] as $cat_set) {
	
		$cat_name = $cat_set[0];
		
		$numof_articles = count($cat_set[1]);
		
// 		debug($numof_articles);
		
// 		$cat_name = $cat_set[0][0];

		array_push($cat_label_set, array($cat_name, $numof_articles));
// 		array_push($cat_set, $cat_name);
		
// 		debug("\$cat_name =>");
// 		debug($cat_name);
		
	}//foreach ($articles_categorized[1] as $cat_set)
	
// 	debug($cat_label_set);
// 	debug($cat_set);
	
	/*******************************
		build: table
	*******************************/

?>
	
<table>

  <tr>
<?php 

	foreach ($cat_label_set as $member) {
// 	foreach ($cat_set as $member) {
	
// 		debug($member);
		
		/*******************************
			color
		*******************************/
// 		if ($member[1] == 0) {
		
// 			echo "<td color='grey'>";
		
// 		} else {
		
// 			echo "<td>";
			
// 		}//if ($member[1] == 0)
		
		
		
		echo "<td>";
		
// 		echo "<a href=\"#".$member[0]."\">";
			
		if ($member[1] == 0) {
		
			echo "<a href=\"#".$member[0]."\" class=\"no_article\">";
// 			echo "!!<a href=\"#".$member[0]."\" color=\"gray\">";
// 			echo "<a href=\"#".$member[0]."\" color=\"grey\">";
	// 			echo "<span color=\"grey\">";
				echo $member[0]." (".$member[1].")";
				
	// 			echo "</span>";
		
		} else {
		
			echo "<a href=\"#".$member[0]."\" class=\"has_link\">";
// 			echo "<a href=\"#".$member[0]."\">";
				echo $member[0]." (".$member[1].")";
			
		}//if ($member[1] == 0)
		
		
// 		echo $member[0]." (".$member[1].")";
		
		echo "</a>";		
// 		echo "<a href=\"#".$member[0]."\">".$member[0]." (".count($member[1])."</a>";		
		
		echo "</td>";
		

	}//foreach ($cat_set as $member)

?>

  </tr>
  
</table>
	
	
	
	