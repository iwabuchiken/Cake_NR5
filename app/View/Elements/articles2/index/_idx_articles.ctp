<br>
<br>

<table>


<?php 

	$count = 1;
	
	foreach ($articles as $a) {

?>

<?php 

	/*******************************
		separator row
	*******************************/
	if ($count % 10 == 0) {
		
		echo "<tr><td>";
		echo "</td>";
		
		echo "<td bgcolor=\"aquamarine\">";
		echo "<a href=\"#top\">Top</a>";
		echo "||";
		echo "<a href=\"#bottom\">Bottom</a>";
		echo "</td></tr>";
		
	}


?>

<tr>
	<td>
<?php 
	
	echo $count;
	
?>
	</td>
	<td>
		<?php 		
				// 		echo $article['line']." / ".$article['url'];
			
				// 		echo "<br>"; echo "<br>";
			
				echo "<a href=\"".$a['url']."\" target=_blank".">"
// 						."$count) "
						.$a['line']
						."</a>";
						// 		echo "<a href=\"".$a['url']."\"".">".$a['line']."</a>";
			
						echo "<br>"; echo "<br>";
			
						// increment
						$count ++;
		?>

	</td>
	
</tr>

<?php 

	}//foreach ($articles as $article)

?>

</table>
