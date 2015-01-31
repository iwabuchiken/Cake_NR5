<?php 

// 	echo "NO DATA"; 

	
// 	echo $token['History']['category_id'];
	
	/*******************************
		get: category
	*******************************/
	$cat = Utils::get_Category_From_Id($token['History']['category_id']);
	
	if ($cat == null) {
	
		echo "NULL";
	
	} else {

		echo $cat['Category']['name']."(".$cat['Genre']['name'].")";
// 		echo $cat['Category']['name'];
// 		echo "Category obtained";
	
	}
	
	
?>