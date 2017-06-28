<h1>

	Pieces
		
</h1>

(<a href="#bottom">Bottom</a><a name="top"></a>)

	<button class="basic" id="index_2_Show_Hide">
		Show/Hide
	</button>
<br>
<br>
<hr>

<div id="link_area">

<!-- <div> -->

	<span id="numOf_sort_block" hidden>1</span>
	
	<!-- ref select http://html.eweb-design.com/0905_slc.html -->
	
	<table>
	
		<?php echo $this->element('pieces/index_2/_index_2_tr_sort'); ?>
	
		<?php echo $this->element('pieces/index_2/_index_2_tr_type'); ?>
	
		<?php echo $this->element('pieces/index_2/_index_2_tr_group_by'); ?>
		
		<?php echo $this->element('pieces/index_2/_index_2_tr_filter_hin_1'); ?>
	
	</table>
<br>

	<button onclick="show_List()" class="basic" id="index_2_go">
		Go
	</button>

	<!-- ref http://www.htmq.com/html/input.shtml -->
	<input type="text" id="input_Query_String" name="name" size="30">
<!-- 	<input type="text" id="input_Query_String" name="name" size="30" maxlength="40" width="10"> -->

<!-- 	<span id="message"></span> -->
<!-- 	<span id="message_2"></span> -->
	
<!-- 	<div> -->
<!-- 		total =  -->
<!-- 		<span id="stats_area"> -->
			<?php 
			
// 				echo $numOf_Pieces_All;
			
// 			?>
		
<!-- 		</span> -->
<!-- 	</div> -->
	
</div><!-- <div id="link_area"> -->

<div id="div_index_2_Message_Area">

	<table id="tbl_index_2_Message_Area">
	
		<tr>
<!-- 			<td width="200"> -->
			<td width="200" class="td_index_2_Message_Area">
				<span id="message"></span>
			</td>
		</tr>
		
<!-- 		<tr> -->
<!-- 			<td> -->
<!-- 			<span id="message_2"></span> -->
<!-- 			</td> -->
<!-- 		</tr> -->
		
<!-- 		<span id="message_2"></span> -->
		
		<tr>
<!-- 			<div> -->
				
				<td>
				total = 
				
				<span id="stats_area">
					<?php 
					
						echo $numOf_Pieces_All;
					
					?>
				
				</span>
				</td>
<!-- 			</div> -->
		</tr>
		
		
	</table>

</div><!-- <div id="index_2_Message_Area"> -->

<br>
<hr>

<br>
<br>

<div id="list_area" >

	List

</div>
<br>
<br>
(<a href="#top">Top</a><a name="bottom"></a>)

