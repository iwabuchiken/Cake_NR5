<br>

<span>
	Genres and Categories
</span>



<button class="basic_2" id="bt_Stats_Top10_GenresAndCategories_Show_Hide">
<!-- <button class="basic_2" id="bt_Stats_Top10_GenresAndCategories_Show_Hide"> -->
	Show/Hide
</button>


<table id="tbl_Stats_Top10_GenresAndCategories">

	<tr>
		<?php 
		
			$count = 1;
			
			$accum = 0.0;
		
			$column_Names = array(
					
					"no.",
					"Genre",
					"Category",
					"Entries",
					"Ratio",
					"Accum"
					
			);
		
			foreach ($column_Names as $item) {
			
		?>
		
		
			<th>
				<?php 
				
					echo $item;
				
				?>
			</th>

		<?php 

			}//foreach ($column_Names as $item)
				
		?>
	</tr>

	<?php 
	
		$sumOf_Percentage = 0;
		
		foreach ($aryOf_Data__Genres_And_Categories as $k => $v) {
// 		foreach ($aryOf_Data as $k => $v) {
// 		foreach ($aryOf_Data as $item) {
			
			$tokensOf_Keyword = explode(",", $k);
			
			$genre_Id = intval($tokensOf_Keyword[0]);
			$cat_Id = intval($tokensOf_Keyword[1]);
// 			$genre_Id = intval(explode(",", $k)[0]);
// 			$cat_Id = intval(explode(",", $k)[1]);
			
	?>
	
	<tr>

		<td>
	
			<?php 
			
				echo $count;
				
				$count ++;
			
			?>
		
		</td>
	
		<td>
		
			<?php 
			
// 				echo $tds;

				$genre = Utils::get_Genre_From_Genre_Id($genre_Id);
			
				echo $genre['Genre']['name'];
// 				echo $item[0];
			
			?>
		
		</td>  
  		
		<td>
		
			<?php 

				$cat = Utils::get_Category_From_Id($cat_Id);

				if (count($cat) < 1) {
				
					echo "Other";
				
				} else {
				
// 					debug($cat);
					echo $cat['Category']['name'];
					
				}//if (count($cat) < 1)
				
				
// 				debug($cat);
// // 				echo $cat;
// // 				echo $cat['name'];
// 				echo $cat['Category']['name'];
// 				echo $item[1];
			
			?>
		
		</td>  
  		
		<td>
		
			<?php 
			
				echo $v;
			
			?>
		
		</td>  
  		
		<td>
		
			<?php 
			
				echo sprintf("%.2f %%", ($v / $numOf_Geschichtes * 100));
// 				echo sprintf("%.2f %%", ($item[2] / $numOf_Geschichte_Total * 100));
			
			?>
		
		</td>  
  		
		<td>
		
			<?php 
			
// 				$accum += $item[2] / $numOf_Geschichte_Total;
				$accum += $v / $numOf_Geschichtes;
				
				echo sprintf("%.2f %%", ($accum * 100));
			
			?>
		
		</td>  
  		
  	</tr>
  	
  	<?php 
  	
  		}//foreach ($data_2 as $item)
  	  
  	?>

	<tr>
	
		<td colspan="3">

			Total
		
		</td>
	
		<td colspan="3">
		
			<?php 
			
				echo $numOf_Geschichtes;
// 				echo $numOf_Geschichte_Total;
			
			?>
			
		
		</td>
	
	
	</tr>

</table>
