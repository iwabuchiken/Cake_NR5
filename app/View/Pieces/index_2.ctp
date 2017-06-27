<h1>

	Pieces
		
</h1>

(<a href="#bottom">Bottom</a><a name="top"></a>)

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

	<span id="message"></span>
	<span id="message_2"></span>
	
	<div>
		total = 
		<span id="stats_area">
			<?php 
			
				echo $numOf_Pieces_All;
			
			?>
		
		</span>
	</div>
	
</div><!-- <div id="link_area"> -->

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

