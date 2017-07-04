<h1>

	SVO
		
</h1>

(<a href="#bottom">Bottom</a><a name="top"></a>)

<br>
<br>

<?php 

	$count = 1;

?>

<div>

	<?php 
	
		if (isset($query_Geschichte_Id)) {
		
			$geschichte_Id = $query_Geschichte_Id;
			
		}//if (isset($query_Geschichte_Id))
		;
	
	
	?>

	<input type="text" 
		 
		id="ipt_SVO_Geschichte_Id">

	<button id="btn_SVO_Geschichte_Id" onclick="btn_Get_SVO_List();">
		Go
	</button>

</div>

<div id="div_SVO_Table">

	<table>
	
		<!-- ref http://html.com/tables/rowspan-colspan/ -->
		<caption>Sentences</caption>
		<tr>
			<th>no.</th>
			<th colspan="1">Sentences</th>
		</tr>
	
		<?php 
		
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
				
					echo $item[1];
				
				?>
	
			</td>
		</tr>
		
		<?php 
		
		
			}//foreach ($array_expression as $value)
		
		?>
		
	</table>
	
</div>

<!-- <div> -->

	<?php 
	
// 		echo $sen_New;
	
// 	?>

<!-- </div> -->

<!-- <div> -->

	<?php 
	
// 		echo $sen_Symbolized;
	
// 	?>

<!-- </div> -->

<br>
<br>
(<a href="#top">Top</a><a name="bottom"></a>)

