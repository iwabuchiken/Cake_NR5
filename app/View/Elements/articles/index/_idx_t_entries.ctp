<?php 

	$index = 1;

	foreach ($articles as $a) {
	
		echo "<tr>";
		echo "<td>";
		echo $index;
		echo "</td>";
	
		echo "<td>";
		echo $this->Html->link(
				//     					'news',
				//REF http://so-zou.jp/web-app/tech/programming/php/library/simplehtmldom/#no7
				$a['line'],
				$a['url'],
				array('target' => '_blank')
				//     					array('url' => $ahrefs_hl[0]->href)
		);
	
		echo "</td>";
			
		echo "<td>";
			
		echo $a['vendor'];
		// 				echo $a['vendor'];	// Cannot use object of type simple_html_dom_node as array
			
		echo "</td>";
		
		echo "<td>";
			
		echo $a['news_time'];
		// 				echo $a['vendor'];	// Cannot use object of type simple_html_dom_node as array
			
		echo "</td>";
			
		echo "</tr>";
	
		$index += 1;
	
	}
	
// 	foreach ($ahrefs_hl as $a) {
	
// 		echo "<tr>";
// 			echo "<td>";
// 				echo $index;
// 			echo "</td>";
		
// 			echo "<td>";
// 				echo $this->Html->link(
// 				//     					'news',
// 										//REF http://so-zou.jp/web-app/tech/programming/php/library/simplehtmldom/#no7
// 				    					$a->plaintext,
// 										$a->href,
// 										array('target' => '_blank')
// 				//     					array('url' => $ahrefs_hl[0]->href)
// 									); 
		
// 			echo "</td>";
			
// 			echo "<td>";
			
// 				echo $a->vendor;
// // 				echo $a['vendor'];	// Cannot use object of type simple_html_dom_node as array
			
// 			echo "</td>";
			
// 		echo "</tr>";
	
// 		$index += 1;
		
// 	}
 ?>