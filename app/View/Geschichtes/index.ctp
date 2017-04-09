<h1>
	
	Geschichtes 
	
</h1>

(<a href="#bottom">Bottom</a><a name="top"></a>)

&nbsp;&nbsp;&nbsp;
(geschichte stats)

<?php 

	//test
	mb_language("Japanese");

?>

<?php 

	echo "<br>"; echo "<br>";
	
	
// 	echo $this->element('articles/index/_header'); 

?>	

<table>
  <tr>
    <th>Id</th>
    <th>Line</th>
    <th>Vendor</th>
    <th>Genre</th>
    <th>Category</th>
  </tr>
  
<?php 

	foreach ($geschichtes as $g) {
		
?>
	<tr>
		<td>
			<?php 
			
				echo $g['Geschichte']['id'];
			
			?>
		</td>
	

		<td>
			<?php 

				$option = array(
						
						"target"	=> "_blank"
						
				);
			
				//ref http://d.hatena.ne.jp/SumiTomohiko/20061227/1167233803 "linkメソッドをみると"
				echo $this->Html->link(
						$g['Geschichte']['line'],
							$g['Geschichte']['url']
							, $option
// 							$url = $g['Geschichte']['line']
					);
						
// 				echo $g['Geschichte']['line'];
			
			?>
		</td>

		<td>
			<?php 
			
				echo $g['Geschichte']['vendor'];
			
			?>
		</td>
	
		<td>
			<?php
			
				$genre = Utils::get_Genre_From_Genre_Id($g['Geschichte']['genre_id']);
			
				echo $genre['Genre']['name']."(".$genre['Genre']['id'].")";
			
			?>
		</td>
	
		<td>
			<?php
			
				$cat_id = $g['Geschichte']['category_id'];
			
				if ($cat_id == "-1") {
				
					$cat_label = "others";
					
				} else {//if ($g[])
					
					$cat = Utils::get_Category_From_Id(intval($cat_id));
					
					$cat_label = $cat['Category']['name']."(".$cat['Category']['id'].")";
					
				}//if ($g[])
			
				echo $cat_label;
			
			?>
		</td>
	
	</tr>

<?php 		

	}//foreach ($geschichtes as $g)
	
?>
  <tr>
<!--     <td>Row 1: Col 1</td> -->
<!--     <td>Row 1: Col 2</td> -->
  </tr>
</table>



<?php 

	echo "<br>"; echo "<br>";
	
?>	

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