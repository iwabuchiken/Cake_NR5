<br>
<br>

<table>


<?php 

	$count = 1;
	
	//test
	mb_language("Japanese"); //ref Cake_IFM11\app\View\Elements\images\index\index_t_headers.ctp
	
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
// 						.mb_string($a['line'])
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
