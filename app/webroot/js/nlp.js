var hins_Checked = true;	// default ---> all checked (input.cb_hin)
var types_Checked = true;	// default ---> all checked (input.cb_type)
var groups_Checked = false;	// default ---> all unchecked (input.cb_type)
var filter_Hin_1_Checked = true;	// default ---> all checked (input.cb_type)

var flag_Table_Stats_Joshis = 1;
var flag_Table_Stats_Hins = 1;
var flag_Table_Stats_Nouns = 1;
var flag_Table_Stats_Symbols = 1;

var flag_Table_Stats_Top10_Genres = 1;
var flag_Table_Stats_Top10_GenresAndCategories = 1;

var flag_Btn_Links_2_Show_Hide = 1;	// 1 : shown / -1 : folded
var flag_Btn_Links_Show_Hide = 1;	// 1 : shown / -1 : folded

function show_Hiraganas() {
	
	var url_curr = $(location).attr('href');
	var url;
	
	var hostname = window.location.hostname;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/Cake_NR5/keywords/add_KW__Genre_Changed";
		
	} else {
	
		url = "/Eclipse_Luna/Cake_NR5/pieces/filter_List_By_Type";
	}
	
	/*
	 * ajax
	 */
	
	var type_name = "hiragana";
	
	$.ajax({
		
	    url: url,
	    type: "GET",
	    //REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
	    data: {type: type_name},
	    
	    timeout: 10000
	    
	}).done(function(data, status, xhr) {
		
		$("#list_area").html(data);
	}).fail(function(xhr, status, error) {
		
		alert(xhr.status);
		
	});
}

function _show_List(query_String) {

	/***************************
		button 'Go' => disable
	 ***************************/
	var button_Go = $('#index_2_go');
	button_Go.prop('disabled', false);
	
	/***************************
		change color
	 ***************************/
	var button_Go = $('#index_2_go');
	
	//ref C:\WORKS_2\WS\Eclipse_Luna\Cake_IFM11\app\webroot\js\main.js
	button_Go.css("background", "yellow");
	
	/***************************
		build : url
	 ***************************/
	var url_curr = $(location).attr('href');
	var url;
	
	var hostname = window.location.hostname;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/Cake_NR5/pieces/index?action=filter"
				+ "&"
				+ query_String
				;
		
	} else {
		
		url = "/Eclipse_Luna/Cake_NR5/pieces/filter_List_By_Type"
			+ "?"
			+ query_String
			;
		
	}
	/***************************
		set message
	 ***************************/
	//	data: {type: param_types, 
	//		sort : param_Sorts, 
	//		sort_direction : param_Sorts_Directions,
	//		filter_Hins	: param_Hins
	//		}
//	var message = "type=" + param_types
//				+ "&"
//				+ "sort=" + param_Sorts
//				+ "&"
//				+ "sort_direction=" + param_Sorts_Directions
//				+ "&"
//				+ "filter_Hins=" + param_Hins
//				+ "&"
//				+ "group_by=" + param_Group_By
//				+ "&"
//				+ "filter_hin_1_hin_name=" + val_Filter_Hin_1_Hin_Name
//				+ "&"
//				+ "filter_hin_1_chosen_hin_1=" + param_Filter_Hin_1
//				
	$('span#message').html("ajaxing...<br><font color='blue'>" + query_String + "</font>");
//	$('span#message').html("ajaxing...");
//	$('span#message').html(query_String);
	
	/********************
	 * ajax
	 ********************/
	var type_name = "hiragana";
	
	$.ajax(
			{
		
				url: url,
				type: "GET",
		//		//REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
		//		data: {type: param_types, 
		//			sort : param_Sorts, 
		//			sort_direction : param_Sorts_Directions,
		//			filter_Hins	: param_Hins,
		//			group_by	: param_Group_By,
		//			filter_hin_1_hin_name	: val_Filter_Hin_1_Hin_Name,
		//			filter_hin_1_chosen_hin_1	: param_Filter_Hin_1
		//			}
		//		,
				timeout: 10000
		
			}
	).done(
			function(data, status, xhr) {
				// button color
				button_Go.css("background", "PaleTurquoise");
			
				// disable ---> false
				button_Go.prop('disabled', false);
				$("#list_area").html(data);
				var rowCount = $('table#pieces tr').length;
			//	var rowCount = $('#myTable tr').length;
				
				// set table height
				var tmp = rowCount / 1.5;
			//	var tmp = rowCount / 2.0;
				
				if (tmp < 50) {
					
					tmp = 50;
					
				} else if (tmp > 130) {
					
					tmp = 130;
					
				}
				var table_Height = tmp + "%";
			//	var table_Height = rowCount / 2.0 + "%";
				$("#list_area").css("height", table_Height);
				
				/***************************
					row count ---> display
				 ***************************/
				if(rowCount > 1) {
					rowCount = rowCount - 1;
				}
				
				var span_Message = $('span#message_2');
//				var span_Message = $('span#message');
				
				span_Message.append("<br>" + "records=" + rowCount);
//				$('span#message').append("<br>" + "records=" + rowCount);
				
				span_Message.css("background", "yellow");
				
				/***************************
					stats
				 ***************************/
				//ref https://www.w3schools.com/jsref/jsref_number.asp
				var total_Pieces = Number($('span#stats_area').text());	//=>
				
//				$('span#message').append(" ("
				$('span#message_2').append(" ("
						//ref https://stackoverflow.com/questions/11695618/dealing-with-float-precision-in-javascript 'answered Jul 27 '12 at 21:14'
						+ (((rowCount - 1) / total_Pieces) * 100).toFixed(2)	//=> '42.35'
						
						+ " %"
						+ ")");
		
	}
	).fail(
		function(xhr, status, error) {
		
			alert(xhr.status);
		
		}
	);

}//_show_List(query_String)

function _show_List__Done(data, status, xhr) {

//	alert("done");
	
	//debug
	var button_Go = $('#index_2_go');

	// button color
	button_Go.css("background", "PaleTurquoise");

	// disable ---> false
	button_Go.prop('disabled', false);
	
	$("#list_area").html(data);
//	$("#list_area").html(data);
	
//	alert("data ==> set");
	
	var rowCount = $('table#pieces tr').length;
//	var rowCount = $('#myTable tr').length;
	
	// set table height
	var tmp = rowCount / 1.5;
//	var tmp = rowCount / 2.0;
	
	if (tmp < 50) {
		
		tmp = 50;
		
	} else if (tmp > 130) {
		
		tmp = 130;
		
	}
	var table_Height = tmp + "%";
//	var table_Height = rowCount / 2.0 + "%";
	$("#list_area").css("height", table_Height);

	/***************************
		stats
	 ***************************/
	//ref https://www.w3schools.com/jsref/jsref_number.asp
	var total_Pieces = Number($('span#stats_area').text());	//=>
	
	var percentage = 
					"("
					+ (((rowCount - 1) / total_Pieces) * 100).toFixed(2)	//=> '42.35'
					+ " %"
					+ ")";

	/***************************
		row count ---> display
	 ***************************/
	if(rowCount > 1) {
		rowCount = rowCount - 1;
	}
	
	$('table#tbl_index_2_Message_Area').prepend(
			
//			"<tr><td>"
			"<tr><td class='td_index_2_Message_Area'>"
			+ "records=" + rowCount
			+ " "
			+ percentage
			+ "</td></tr>"
	);
//	$('span#message').append("<br>" + "records=" + rowCount);
	
//	/***************************
//		stats
//	 ***************************/
//	//ref https://www.w3schools.com/jsref/jsref_number.asp
//	var total_Pieces = Number($('span#stats_area').text());	//=>
//	
//	var percentage = (((rowCount - 1) / total_Pieces) * 100).toFixed(2)	//=> '42.35'
//					+ " %"
//					+ ")";
	
//	$('span#message').append(" ("
//			//ref https://stackoverflow.com/questions/11695618/dealing-with-float-precision-in-javascript 'answered Jul 27 '12 at 21:14'
//			+ (((rowCount - 1) / total_Pieces) * 100).toFixed(2)	//=> '42.35'
//			
////			+ ((rowCount - 1) / total_Pieces) * 100	//=> '(42.3469387755102)'
////			+ Math.floor( (rowCount - 1) / total_Pieces * 100).toFixed(2)	//=> '42.00'
////			+ Math.floor( (rowCount - 1) / total_Pieces * 100)	//=> '42'
////			+ (Math.floor( (rowCount - 1) / total_Pieces ) * 100).toFixed(2)
////			+ ((rowCount - 1) / total_Pieces) 
//			+ " %"
//			+ ")");
////	$('span#message').append(" (" + ((rowCount - 1) / total_Pieces) + ")");

}//_show_List__Done(data, status, xhr)

function show_List() {

	/***************************
		validate : filter with query string
	 ***************************/
	var query_String = $('input#input_Query_String').val();
	
	if (query_String != null && query_String != '') {
		/***************************
			dispatch
		 ***************************/
		_show_List(query_String);
		
		return;
	}

	/***************************
		button --> disable
	 ***************************/
	$('button#index_2_go').prop('disabled', true);
	
	/***************************
		get values : sort
	 ***************************/
	//ref https://jquery.nj-clucker.com/select-set-get/
	var val_Sort_1 = $("#select_sort_column_1").val();
	var val_Sort_2 = $("#select_sort_column_2").val();
	var val_Sort_3 = $("#select_sort_column_3").val();
	var val_Sort_4 = $("#select_sort_column_4").val();
	/***************************
		get values : radio button : sort_1
	 ***************************/
	
	var radio_1 = $('input[name=sort_direction_1]:checked').val();
	var radio_2 = $('input[name=sort_direction_2]:checked').val();
	var radio_3 = $('input[name=sort_direction_3]:checked').val();
	var radio_4 = $('input[name=sort_direction_4]:checked').val();
		
	/***************************
		build param : sort
	***************************/
	var param_Sorts = "";
	
	var param_Sorts_Directions = "";
	
	if (val_Sort_1 == 0) {
		
		param_Sorts = "id";
		
		// direction
		param_Sorts_Directions = radio_1;
		
	} else {
		
		param_Sorts = val_Sort_1;

		// direction
		param_Sorts_Directions = radio_1;

		if (val_Sort_2 != 0) {
			
			param_Sorts += "," + val_Sort_2;

			// direction
			param_Sorts_Directions += "," + radio_2;

			if (val_Sort_3 != 0) {
				
				param_Sorts += "," + val_Sort_3;
				
				// direction
				param_Sorts_Directions += "," + radio_3;

				if (val_Sort_4 != 0) {
					
					param_Sorts += "," + val_Sort_4;
					
					// direction
					param_Sorts_Directions += "," + radio_4;

				}				
			}//if (val_Sort_3 != 0) {
			
		}
		
	}//if (val_Sort_1 == 0) {
	/***************************
		get values : types
	 ***************************/
//	var val = $(".cb_type:checked").val();	//=> w.
	//ref http://qiita.com/kazu56/items/36b025dac5802b76715c
	var val = $(".cb_type:checked").map(function() {
		  return $(this).val();
	}).get();
	var lenOf_Types = val.length;
	//ref https://www.ajaxtower.jp/js/array_class/index3.html
	var param_types = val.join(",");

	/***************************
		get values : hin names
	 ***************************/
//	var val = $(".cb_hin:checked").val();	//=> w.
	//ref http://qiita.com/kazu56/items/36b025dac5802b76715c
	var val_hins = $(".cb_hin:checked").map(function() {
		return $(this).val();
	}).get();
	
	var lenOf_Hins = val_hins.length;
	//ref https://www.ajaxtower.jp/js/array_class/index3.html
	var param_Hins = val_hins.join(",");
	
	/***************************
		get values : group by
	 ***************************/
//	var val = $(".cb_hin:checked").val();	//=> w.
	//ref http://qiita.com/kazu56/items/36b025dac5802b76715c
	var val_Group_By = $(".cb_Group_By:checked").map(function() {
		return $(this).val();
	}).get();
	
	var lenOf_Group_By = val_Group_By.length;
	//ref https://www.ajaxtower.jp/js/array_class/index3.html
	var param_Group_By = val_Group_By.join(",");

	//debug
	var button_Go = $('#index_2_go');
	button_Go.prop('disabled', false);
//	return;
	
	/***************************
		get values : selected hin name
	 ***************************/
	var val_Filter_Hin_1_Hin_Name = $("select#select_Filter_Hin_1").val();
//	var val_Filter_Hin_1 = $("select#select_Filter_Hin_1").val();
	
	/***************************
		get values : hin_1
	 ***************************/
	//ref http://qiita.com/kazu56/items/36b025dac5802b76715c
	var val_Filter_Hin_1 = $(".cb_Filter_Hin_1:checked").map(function() {
		return $(this).val();
	}).get();
	
	var lenOf_Filter_Hin_1 = val_Filter_Hin_1.length;
	//ref https://www.ajaxtower.jp/js/array_class/index3.html
	var param_Filter_Hin_1 = val_Filter_Hin_1.join(",");
	
	//=> blank if '0' chosen
	
//	//test
//	return;
	
	/***************************
		button 'Go' => disable
	 ***************************/
	var button_Go = $('#index_2_go');
	button_Go.prop('disabled', false);
	/***************************
		build : url
	 ***************************/
	var url_curr = $(location).attr('href');
	var url;
	
	var hostname = window.location.hostname;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/Cake_NR5/pieces/index?action=filter";
//		url = "/cake_apps/Cake_NR5/pieces/index?actoin=filter";
//		url = "/cake_apps/Cake_NR5/pieces/filter_List_By_Type";
//		url = "/cake_apps/Cake_NR5/keywords/add_KW__Genre_Changed";
		
	} else {
		
		url = "/Eclipse_Luna/Cake_NR5/pieces/filter_List_By_Type";
	}
	/***************************
		change color
	 ***************************/
	var button_Go = $('#index_2_go');
	
	//ref C:\WORKS_2\WS\Eclipse_Luna\Cake_IFM11\app\webroot\js\main.js
	button_Go.css("background", "yellow");
	
	/***************************
		set message
	 ***************************/
	//	data: {type: param_types, 
	//		sort : param_Sorts, 
	//		sort_direction : param_Sorts_Directions,
	//		filter_Hins	: param_Hins
	//		}
	var message = "type=" + param_types
				+ "&"
				+ "sort=" + param_Sorts
				+ "&"
				+ "sort_direction=" + param_Sorts_Directions
				+ "&"
				+ "filter_Hins=" + param_Hins
				+ "&"
				+ "group_by=" + param_Group_By
				+ "&"
				+ "filter_hin_1_hin_name=" + val_Filter_Hin_1_Hin_Name
				+ "&"
				+ "filter_hin_1_chosen_hin_1=" + param_Filter_Hin_1
				
//				var message = "param_types=" + param_types
//				+ "/"
//				+ "param_Sorts=" + param_Sorts
//				+ "/"
//				+ "param_Sorts_Directions=" + param_Sorts_Directions
//				+ "/"
//				+ "param_Hins=" + param_Hins
//				+ "/"
//				+ "param_Group_By=" + param_Group_By
				
	$('span#message').html(message);
//	$('span#message').html("prep --> done");
	
//	return;
	
	/*
	 * ajax
	 */
	
	var type_name = "hiragana";
	
	$.ajax({
		
		url: url,
		type: "GET",
		//REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
		data: {type: param_types, 
			sort : param_Sorts, 
			sort_direction : param_Sorts_Directions,
			filter_Hins	: param_Hins,
			group_by	: param_Group_By,
			filter_hin_1_hin_name	: val_Filter_Hin_1_Hin_Name,
			filter_hin_1_chosen_hin_1	: param_Filter_Hin_1
			}
		,
		timeout: 10000
		
	}).done(function(data, status, xhr) {
		
		_show_List__Done(data, status, xhr);
		
//		// button color
//		button_Go.css("background", "PaleTurquoise");
//
//		// disable ---> false
//		button_Go.prop('disabled', false);
//		$("#list_area").html(data);
//		var rowCount = $('table#pieces tr').length;
////		var rowCount = $('#myTable tr').length;
//		
//		// set table height
//		var tmp = rowCount / 1.5;
////		var tmp = rowCount / 2.0;
//		
//		if (tmp < 50) {
//			
//			tmp = 50;
//			
//		} else if (tmp > 130) {
//			
//			tmp = 130;
//			
//		}
//		var table_Height = tmp + "%";
////		var table_Height = rowCount / 2.0 + "%";
//		$("#list_area").css("height", table_Height);
//		
//		/***************************
//			row count ---> display
//		 ***************************/
//		if(rowCount > 1) {
//			rowCount = rowCount - 1;
//		}
//		
//		$('span#message').append("<br>" + "records=" + rowCount);
//		
//		/***************************
//			stats
//		 ***************************/
//		//ref https://www.w3schools.com/jsref/jsref_number.asp
//		var total_Pieces = Number($('span#stats_area').text());	//=>
//		
//		$('span#message').append(" ("
//				//ref https://stackoverflow.com/questions/11695618/dealing-with-float-precision-in-javascript 'answered Jul 27 '12 at 21:14'
//				+ (((rowCount - 1) / total_Pieces) * 100).toFixed(2)	//=> '42.35'
//				
////				+ ((rowCount - 1) / total_Pieces) * 100	//=> '(42.3469387755102)'
////				+ Math.floor( (rowCount - 1) / total_Pieces * 100).toFixed(2)	//=> '42.00'
////				+ Math.floor( (rowCount - 1) / total_Pieces * 100)	//=> '42'
////				+ (Math.floor( (rowCount - 1) / total_Pieces ) * 100).toFixed(2)
////				+ ((rowCount - 1) / total_Pieces) 
//				+ " %"
//				+ ")");
////		$('span#message').append(" (" + ((rowCount - 1) / total_Pieces) + ")");
	}).fail(function(xhr, status, error) {
		
		alert(xhr.status);
		
	});
	
}

function uncheck_All_Hins() {
	
	var inputs = $('input.cb_hin');
	
	if (hins_Checked == true) {

		inputs.prop('checked', false);
		
		hins_Checked = false;

	} else {

		inputs.prop('checked', true);
		
		hins_Checked = true;

	}//if (hins_unchecked == true)
//	inputs.prop('checked', false);
}//uncheck_All_Hins()

function uncheck_All_Types() {
	
	var inputs = $('input.cb_type');
	
	if (types_Checked == true) {
		
		inputs.prop('checked', false);
		
		types_Checked = false;
		
	} else {
		
		inputs.prop('checked', true);
		
		types_Checked = true;
		
	}//if (hins_unchecked == true)
//	inputs.prop('checked', false);
}//uncheck_All_Types

function uncheck_All_Groups() {
	
	var inputs = $('input.cb_Group_By');
	
	if (groups_Checked == true) {
		
		inputs.prop('checked', false);
		
		groups_Checked = false;
		
	} else {
		
		inputs.prop('checked', true);
		
		groups_Checked = true;
		
	}//if (hins_unchecked == true)
//	inputs.prop('checked', false);
}//uncheck_All_Types

function uncheck_All_Hin_1() {
	
	var inputs = $('input.cb_Filter_Hin_1');
	
	if (filter_Hin_1_Checked == true) {
		
		inputs.prop('checked', false);
		
		filter_Hin_1_Checked = false;
		
	} else {
		
		inputs.prop('checked', true);
		
		filter_Hin_1_Checked = true;
		
	}//if (hins_unchecked == true)
//	inputs.prop('checked', false);
}//uncheck_All_Hin_1

function _onChange_Filter_Hin_1(hin_Name) {
//	//test
//	
//	return;
	
	/***************************
		validate
	 ***************************/
	if (hin_Name == '0') {
//		$('td#td_Filter_Hin_1_Data_Area').html().text();
//		$('td#td_Filter_Hin_1_Data_Area').html("abc");
		$('span#td_Filter_Hin_1_Data_Area').html("");
		
		return;
	}
	
	/***************************
		build : url
	 ***************************/
	var url_curr = $(location).attr('href');
	var url;
	
	var hostname = window.location.hostname;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/Cake_NR5/pieces/index?action=get_list_of_hin_name";
//		url = "/cake_apps/Cake_NR5/pieces/get_ListOf__Hin_1?action=get_list_of_hin_name";
//		url = "/cake_apps/Cake_NR5/pieces/get_ListOf__Hin_1";
//		url = "/cake_apps/Cake_NR5/keywords/add_KW__Genre_Changed";
		
	} else {
		
		url = "/Eclipse_Luna/Cake_NR5/pieces/get_ListOf__Hin_1";
		
	}

//	alert("url => " + url);
	
	/***************************
		change color
	 ***************************/
	$('span#label_Filter_Hin_1').css("background", "yellow");
	
	/***************************
		ajax
	 ***************************/
	$.ajax({
		
		url: url,
		type: "GET",
		//REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
		data: {
			
				hin_name : hin_Name
				
			}
		,
		timeout: 10000
		
	}).done(function(data, status, xhr) {
		
		$('span#td_Filter_Hin_1_Data_Area').html(data);
//		$('td#td_Filter_Hin_1').append(data);
		
		/***************************
			change color
		 ***************************/
		$('span#label_Filter_Hin_1').css("background", "white");
	
	}).fail(function(xhr, status, error) {
		
		alert(xhr.status);

		/***************************
			change color
		 ***************************/
		$('span#label_Filter_Hin_1').css("background", "white");

	});
}//_onChange_Filter_Hin_1()

function _setup_Buttons() {

    $('button#index_2_Show_Hide').click(
    		
    		function(){
    			
    			$('div#link_area').toggle('fast');
//    			$('div#link_area').toggle('slow');
    			
    		}
    		
	);//$('#toggletest1').click(

    $('button#links_2_Show_Hide').click(
    		
    		function(){
    			
    			var button = $('button#links_2_Show_Hide');
    			
    			$('div#div_Default_Layout_Footer_2').toggle('fast');
//    			$('div#link_area').toggle('slow');
    			
    			// change label
    			if (flag_Btn_Links_2_Show_Hide == 1) {

//    				alert("flag => 1 !!!");
    				
    				//ref https://stackoverflow.com/questions/21131548/change-button-value-onclick 'answered Jan 15 '14 at 7:46'
    				$(this).text("Fold");
//    				button.text("Fold");
//    				button.val("Fold");
//    				$(this).val("Fold");

    				$(this).css("background-color", "LightSteelBlue");
//    				$(this).css("background-color", "Lavender");
    				
    				flag_Btn_Links_2_Show_Hide = flag_Btn_Links_2_Show_Hide * (-1);
    				
//    				alert("flag is now => " + flag_Btn_Links_2_Show_Hide);
    				
				} else {

//					alert("flag => -1");
					
					$(this).text("Links 2");
//					button.text("Links 2");
//					button.val("Links 2");
//    				$(this).val("Links 2");

					$(this).css("background-color", "white");
					
    				flag_Btn_Links_2_Show_Hide = flag_Btn_Links_2_Show_Hide * (-1);

//    				alert("flag is now => " + flag_Btn_Links_2_Show_Hide);
    				
				}//if (flag_Btn_Links_2_Show_Hide == 1)
				
//    			$(this).val("Fold");
    			
    		}
    		
    );//$('#toggletest1').click(
    
    $('button#links_Show_Hide').click(
    		
    		function(){
    			
    			$('div#div_Default_Layout_Footer').toggle('fast');
//    			$('div#link_area').toggle('slow');
    			
    			// change label
    			if (flag_Btn_Links_Show_Hide == 1) {

//    				alert("flag => 1 !!!");
    				
    				//ref https://stackoverflow.com/questions/21131548/change-button-value-onclick 'answered Jan 15 '14 at 7:46'
    				$(this).text("Fold");
//    				button.text("Fold");
//    				button.val("Fold");
//    				$(this).val("Fold");

    				$(this).css("background-color", "LightSteelBlue");
//    				$(this).css("background-color", "Lavender");
    				
    				flag_Btn_Links_Show_Hide = flag_Btn_Links_Show_Hide * (-1);
    				
//    				alert("flag is now => " + flag_Btn_Links_2_Show_Hide);
    				
				} else {

//					alert("flag => -1");
					
					$(this).text("Links");

					$(this).css("background-color", "white");
					
    				flag_Btn_Links_Show_Hide = flag_Btn_Links_Show_Hide * (-1);

//    				alert("flag is now => " + flag_Btn_Links_2_Show_Hide);
    				
				}//if (flag_Btn_Links_Show_Hide == 1)
				
    			
    		}//function(){
    		
    );//$('#toggletest1').click(
    
    $('button#bt_Stats_Hins_Show_Hide').click(
    		
    		function(){
    			
    			$('table#tbl_Stats_Hins').toggle('fast');
    			
    			if (flag_Table_Stats_Hins == 1) {	// if closed

    				//ref css https://stackoverflow.com/questions/9821691/jquery-background-color-change-on-button-click 'answered Mar 22 '12 at 11:52'
    				$('button#bt_Stats_Hins_Show_Hide').css("background-color", "yellow");
//    				$('button#bt_Stats_Hins_Show_Hide').css("background-color", "#aaffaa");
//    				$('button#bt_Stats_Hins_Show_Hide').css("background-color", "white");
					
					flag_Table_Stats_Hins = flag_Table_Stats_Hins * (-1);
					
				} else {	// if opened

					$('button#bt_Stats_Hins_Show_Hide').css("background-color", "#aaffaa");
//					$('button#bt_Stats_Hins_Show_Hide').css("background-color", "yellow");
					
					flag_Table_Stats_Hins = flag_Table_Stats_Hins * (-1);
					
				}//if (flag_Table_Stats_Joshi == 1)

    		}
    		
    );//$('#toggletest1').click(

    $('button#bt_Stats_Joshis_Show_Hide').click(
    		
    		function(){
    			
    			$('table#tbl_Stats_Joshis').toggle('fast');
//    			$('div#link_area').toggle('slow');
    			
    			if (flag_Table_Stats_Joshis == 1) {

//    				alert("flag => 1");
    				
    				//ref css https://stackoverflow.com/questions/9821691/jquery-background-color-change-on-button-click 'answered Mar 22 '12 at 11:52'
    				$('button#bt_Stats_Joshis_Show_Hide').css("background-color", "yellow");
//    				$('button#bt_Stats_Joshis_Show_Hide').css("background-color", "white");
//    				$('button#bt_Stats_Joshis_Show_Hide').attr("background-color", "blue");
//					this.attr("background-color", "blue");
					
					flag_Table_Stats_Joshis = flag_Table_Stats_Joshis * (-1);
//					flag_Table_Stats_Joshi *= -1;

//					alert("flag is now => " + flag_Table_Stats_Joshi);
					
				} else {

//					alert("flag => -1");
					
					$('button#bt_Stats_Joshis_Show_Hide').css("background-color", "#aaffaa");
//					$('button#bt_Stats_Joshis_Show_Hide').css("background-color", "yellow");
//					this.attr("background-color", "yellow");
					
					flag_Table_Stats_Joshis = flag_Table_Stats_Joshis * (-1);
//					flag_Table_Stats_Joshi *= -1;

//					alert("flag is now => " + flag_Table_Stats_Joshi);
					
				}//if (flag_Table_Stats_Joshi == 1)
    			
    		}
    		
    );//$('#toggletest1').click(

    $('button#bt_Stats_Nouns_Show_Hide').click(
    		
    		function(){
    			
    			$('table#tbl_Stats_Nouns').toggle('fast');
//    			$('div#link_area').toggle('slow');
    			
    			if (flag_Table_Stats_Nouns == 1) {
    				
//    				alert("flag => 1");
    				
    				//ref css https://stackoverflow.com/questions/9821691/jquery-background-color-change-on-button-click 'answered Mar 22 '12 at 11:52'
    				$('button#bt_Stats_Nouns_Show_Hide').css("background-color", "yellow");
//    				$('button#bt_Stats_Joshis_Show_Hide').css("background-color", "white");
//    				$('button#bt_Stats_Joshis_Show_Hide').attr("background-color", "blue");
//					this.attr("background-color", "blue");
    				
    				flag_Table_Stats_Nouns = flag_Table_Stats_Nouns * (-1);
//					flag_Table_Stats_Joshi *= -1;
    				
//					alert("flag is now => " + flag_Table_Stats_Joshi);
    				
    			} else {
    				
//					alert("flag => -1");
    				
    				$('button#bt_Stats_Nouns_Show_Hide').css("background-color", "#aaffaa");
    				
    				flag_Table_Stats_Nouns = flag_Table_Stats_Nouns * (-1);
    				
    			}//if (flag_Table_Stats_Joshi == 1)
    			
    		}
    		
    );//$('#toggletest1').click(
    
    $('button#bt_Stats_Top10_Genres_Show_Hide').click(
    		
    		function(){
    			
    			$('table#tbl_Stats_Top10_Genres').toggle('fast');
//    			$('div#link_area').toggle('slow');
    			
    			if (flag_Table_Stats_Top10_Genres == 1) {
    				
//    				alert("flag => 1");
    				
    				//ref css https://stackoverflow.com/questions/9821691/jquery-background-color-change-on-button-click 'answered Mar 22 '12 at 11:52'
    				$('button#bt_Stats_Top10_Genres_Show_Hide').css("background-color", "yellow");
//    				$('button#bt_Stats_Joshis_Show_Hide').css("background-color", "white");
//    				$('button#bt_Stats_Joshis_Show_Hide').attr("background-color", "blue");
//					this.attr("background-color", "blue");
    				
    				flag_Table_Stats_Top10_Genres = flag_Table_Stats_Top10_Genres * (-1);
//					flag_Table_Stats_Joshi *= -1;
    				
//					alert("flag is now => " + flag_Table_Stats_Joshi);
    				
    			} else {
    				
//					alert("flag => -1");
    				
    				$('button#bt_Stats_Top10_Genres_Show_Hide').css("background-color", "#aaffaa");
    				
    				flag_Table_Stats_Top10_Genres = flag_Table_Stats_Top10_Genres * (-1);
    				
    			}//if (flag_Table_Stats_Joshi == 1)
    			
    		}
    		
    );//$('#toggletest1').click(
    
    $('button#bt_Stats_Top10_GenresAndCategories_Show_Hide').click(
    		
    		function(){
    			
    			$('table#tbl_Stats_Top10_GenresAndCategories').toggle('fast');
//    			$('div#link_area').toggle('slow');
    			
    			if (flag_Table_Stats_Top10_GenresAndCategories == 1) {
    				
//    				alert("flag => 1");
    				
    				//ref css https://stackoverflow.com/questions/9821691/jquery-background-color-change-on-button-click 'answered Mar 22 '12 at 11:52'
    				$('button#bt_Stats_Top10_GenresAndCategories_Show_Hide')
    						.css("background-color", "yellow");
    				
    				flag_Table_Stats_Top10_GenresAndCategories = flag_Table_Stats_Top10_GenresAndCategories * (-1);
    				
//    				alert("flag changed to => " + flag_Table_Stats_Top10_GenresAndCategories);
    				
    			} else {
    				
//					alert("flag => -1");
    				
//    				$('button#bt_Stats_Top10_GenresAndCategories_Show_Hide').css("background-color", "green");
    				$('button#bt_Stats_Top10_GenresAndCategories_Show_Hide').css("background-color", "#aaffaa");
    				
    				flag_Table_Stats_Top10_GenresAndCategories = flag_Table_Stats_Top10_GenresAndCategories * (-1);
    				
//    				alert("flag changed to => " + flag_Table_Stats_Top10_GenresAndCategories);
    				
    			}//if (flag_Table_Stats_Joshi == 1)
    			
    		}
    		
    );//$('#toggletest1').click(
    
    $('button#bt_Stats_Symbols_Show_Hide').click(
    		
    		function(){
    			
    			$('table#tbl_Stats_Symbols').toggle('fast');
//    			$('div#link_area').toggle('slow');
    			
    			if (flag_Table_Stats_Symbols == 1) {
    				
//    				alert("flag => 1");
    				
    				//ref css https://stackoverflow.com/questions/9821691/jquery-background-color-change-on-button-click 'answered Mar 22 '12 at 11:52'
    				$('button#bt_Stats_Symbols_Show_Hide').css("background-color", "yellow");
//    				$('button#bt_Stats_Joshis_Show_Hide').css("background-color", "white");
//    				$('button#bt_Stats_Joshis_Show_Hide').attr("background-color", "blue");
//					this.attr("background-color", "blue");
    				
    				flag_Table_Stats_Symbols = flag_Table_Stats_Symbols * (-1);
//					flag_Table_Stats_Joshi *= -1;
    				
//					alert("flag is now => " + flag_Table_Stats_Joshi);
    				
    			} else {
    				
//					alert("flag => -1");
    				
    				$('button#bt_Stats_Symbols_Show_Hide').css("background-color", "#aaffaa");
    				
    				flag_Table_Stats_Symbols = flag_Table_Stats_Symbols * (-1);
    				
    			}//if (flag_Table_Stats_Joshi == 1)
    			
    		}
    		
    );//$('#toggletest1').click(
    
	
}//_setup_Buttons()

function btn_Get_SVO_List() {
	
//	alert("svo");
	
	/***************************
		get : id
	 ***************************/
	var id = $('input#ipt_SVO_Geschichte_Id').val();
	
//	alert("geschichte id => " + id);
	
	if (id == '') {

		alert("id ==> blank");

		return;
		
	} else {//if (id == '') {
		
//		alert("id => " + id);
		
	}//if (id == '') {
	
	/***************************
		validate : numeric
	 ***************************/
	if (!Number.isInteger(Number(id))) {
//		if (!Number.isInteger(id)) {
//		if (!($.isNUmeric(id))) {
//		if (!$.isNUmeric(id)) {

		alert("id is not numeric => '" + id + "'");

		return;
		
	} else {//if (!) {
		
//		alert("id is numeric");
		
	}//if (!) {
	

	/***************************
		build : url
	 ***************************/
	var url_curr = $(location).attr('href');
	var url;
	
	var hostname = window.location.hostname;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/Cake_NR5/pieces/index?action=svo_table";
//		url = "/cake_apps/Cake_NR5/pieces/index?action=svo";
//		url = "/cake_apps/Cake_NR5/pieces/index?action=get_list_of_hin_name";
		
	} else {
		
		url = "/Eclipse_Luna/Cake_NR5/pieces/svo_table";
		
	}
	
	//alert("url => " + url);
	
	/***************************
		change color
	 ***************************/
	$('button#btn_SVO_Geschichte_Id').css("background-color", "yellow");
	
//	//debug
//	return;
	
	/***************************
		ajax
	 ***************************/
	$.ajax({
		
		url: url,
		type: "GET",
		//REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
		data: {
			
				geschichte_id : id
				
			}
		,
		timeout: 10000
		
	}).done(function(data, status, xhr) {
		
		$('div#div_SVO_Table').html(data);

		/***************************
			change color
		 ***************************/
		$('button#btn_SVO_Geschichte_Id').css("background-color", "Green");
//		$('span#label_Filter_Hin_1').css("background", "white");
	
	}).fail(function(xhr, status, error) {
		
		alert(xhr.status);
	
		/***************************
			change color
		 ***************************/
		$('button#btn_SVO_Geschichte_Id').css("background-color", "Green");
	
	});



	
}

$(function() {
	
    _setup_Buttons();
    
});//$(function() {

$(document).ready(function(){

    $('select#select_Filter_Hin_1').change(
		function(){

			var val = $('select#select_Filter_Hin_1').find(":selected").val();
    	
			// exec
			_onChange_Filter_Hin_1(val);
			
    	}//function(){
    );//change(
    
})//$(document).ready(function(){
