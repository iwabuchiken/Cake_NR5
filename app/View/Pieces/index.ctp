<h1>

	Pieces (<a href="<?php echo $url_new; ?>"><?php echo $url_new; ?></a>)
		
</h1>

<?php echo $this->element('pieces/_index_pagination')?>

(<a href="#bottom">Bottom</a><a name="top"></a>)
<br>
<br>

<table border="1">

	<?php echo $this->element('pieces/_index_t_headers')?>
	<?php echo $this->element('pieces/_index_t_entries')?>

</table>

<br>
<br>
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