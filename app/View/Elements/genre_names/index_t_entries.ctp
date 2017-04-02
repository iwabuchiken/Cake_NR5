<?php 

	$count = 0;
	
	$separate_length = 20;
// 	$separate_length = 10;

	foreach ($categories as $category): 


?>

<?php 



?>

<tr>
		<td class="td_id"><?php echo $category['Category']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($category['Category']['name'],
							array(
								'controller' => 'Categorys', 
								'action' => 'view', 
								$category['Category']['id'])
							); ?>
		</td>
		
		<td class="td_news_time"><?php echo $category['Genre']['name']; ?></td>
		
		<td class="td_news_time"><?php echo $category['Category']['original_id']; ?></td>
		
		<td class="td_news_time"><?php echo $category['Category']['created_at']; ?></td>
		<td class="td_news_time"><?php echo $category['Category']['updated_at']; ?></td>
		
</tr>

<?php 


	$count ++;
	
	// add separator
	if ($count % $separate_length == 0) {
// 	if ($count % 10 == 0) {
		
		echo "<tr>"
// 				."<td>"
// 				."</td>"
				//ref http://www.tagindex.com/html_tag/table/table_bgcolor.html
				."<td colspan=6 bgcolor=\"greenyellow\">"
				//ref http://www.newcredge.com/IT/www/html/tag/font/color.html
				."<a href=\"#top\"><font color=\"red\">Top</font></a>"
				." || "
				."<a href=\"#bottom\"><font color=\"red\">Bottom</font></a>"
				." (".($count + 1)." - ".($count + $separate_length).")"
// 				." (".($count + 1)." - ".($count + 10).")"
				."</td>"
			."</tr>";
		
	}

	endforeach; 
	
?>

<?php unset($category); ?>
