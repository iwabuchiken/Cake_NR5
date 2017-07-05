

<table>

	<!-- ref http://html.com/tables/rowspan-colspan/ -->
	<caption>
<!-- 		Sentences -->

		<?php 
		
			echo "Geschichte = $query_Geschichte_Id";
		
		
		?>
		
	</caption>
	<tr>
		<th>no.</th>
		<th colspan="1">Sentences</th>
	</tr>

	<?php 

		/*******************************
			validate
		*******************************/
		if (!isset($pairOf_Sens_Symbols)) {
		
			debug("\$pairOf_Sens_Symbols => not set");
		
			return;
			
		}//if (!isset($pairOf_Sens_Symbols))
		;
	
		$count = 1;
	
		foreach ($pairOf_Sens_Symbols as $item) {
		
			
	?>	
	<tr>
<!-- 	<tr rowspan="2"> -->
		<th rowspan="2">
<!-- 		<th> -->
<!-- 		<td> -->
<!-- 		<td rowspan="2"> -->
			<?php 
			
				echo $count;
				
				$count ++;
				
			?>
		</th>
<!-- 		</td> -->
	
		<td colspan="1">
		
			<?php 
			
				echo $item[0];
			
			?>
			
		</td>
	</tr>
	<tr>		
		<td colspan="2" class="td_SVO_Symbols">
<!-- 		<td colspan="1"> -->
<!-- 		<td colspan="1" rowspan="2"> -->
		
			<?php 
			
				//ref https://stackoverflow.com/questions/9814375/php-explode-all-characters
// 				$chars = str_split($item[1]);
				$chars = $item[1];

// 				debug("\$chars =>");
// 				debug($chars);
				
// 				debug("\$item[1] => " . $item[1]);	// '$item[1] => 　NNNNPNNNN（NNN）PNPNVANP、NNPPNPVA'
				
				$symbols = Utils_2::get_ListOf_Symbol_Forms();
				
// 				debug("\$symbols => " . count($symbols));

// 				debug($symbols);
				
				$chars_New = "";
				
				$lenOf_Chars = strlen($item[1]);
// 				$lenOf_Chars = count($item[1]);
// 				$lenOf_Chars = count($chars);
				
// 				debug("\$lenOf_Chars => " . $lenOf_Chars);
				
				
				for ($i = 0; $i < $lenOf_Chars; $i++) {
// 				for ($i = 0; $i < $lenOf_Chars - 1; $i++) {
				
					$chr = $chars[$i];
					
// 					debug("chr = $chr / next chr = ".$chars[$i + 1]." / i = $i");
					
					if ($chr == 'P') {
// 					if ($chr == 'P' && !in_array($chars[$i + 1], $symbols, false)) {
// 					if ($chr == 'P' && !in_array($chars[$i + 1], $symbols, true)) {
					
// 						debug("chr = $chr / next chr = ".$chars[$i + 1]." / i = $i");
						
						$chars_New .= $chr . "-";
						
// 						//debug
// 						if (in_array($chars[$i + 1], $symbols, false)) {
						
// // 							debug("in array => '" . $chars[$i + 1] . "'");
							
// 						} else {//if (in_array($chars[$i + 1], $symbols, false))

// // 							debug("NOT in array => '" . $chars[$i + 1] . "'");
							
// 						}//if (in_array($chars[$i + 1], $symbols, false))
					
					} else {
					
						$chars_New .= $chr;
						
					}//if ($chr == 'P' && $chars[$i + 1] != '')
					
				}//for ($i = 0; $i < $lenOf_Chars - 1; $i++)
				
				echo $chars_New;
// 				echo $item[1];
			
			?>

		</td>
	</tr>
	
	<?php 
	
	
		}//foreach ($array_expression as $value)
	
	?>
	
</table>
