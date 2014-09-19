<h1>Videos</h1>
a => 
<?php echo $a['url']; ?>

<br>
<br>

<?php echo $ahrefs_hl[0]->href; ?>

<br>
<br>

<?php 

	echo "<table>";

	foreach ($ahrefs_hl as $a) {
	
		echo "<tr>";
		echo "<td>";
		echo $this->Html->link(
		//     					'news',
								//REF http://so-zou.jp/web-app/tech/programming/php/library/simplehtmldom/#no7
		    					$a->plaintext,
								$a->href,
								array('target' => '_blank')
		//     					array('url' => $ahrefs_hl[0]->href)
							); 

		echo "</td>";
		echo "</tr>";
	
	}
	
	echo "</table>";

?>