<?php 

	if (isset($listOf_Hin_1_Names)) {
	
// 		echo "\$listOf_Hin_1_Names => set";
		
	} else {//if (isset($listOf_Hin_1_Names))
		
		echo "\$listOf_Hin_1_Names => NOT set";
		
		return;
		
	}

?>

<?php 

	$index = 0;
		
	foreach ($listOf_Hin_1_Names as $item) {
		
?>
				
	<input type="checkbox" class="cb_Filter_Hin_1" name="riyu" 
			value="<?php echo $index; ?>"
			
			checked="checked"
			>
						
			<?php 
			
				echo $item['Piece']['hin_1']; 
				
			?>
			<?php //echo $item; ?>
							
<?php 	

		$index += 1;

	}//foreach ($listOf_ColumnNames as $item)
					

?>

<button id="uncheck_All_Hin_1" onclick="uncheck_All_Hin_1();">Check/Uncheck</button>

<!-- C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5\app\View\Pieces\partials\_index_Filter__Hin_1.ctp -->