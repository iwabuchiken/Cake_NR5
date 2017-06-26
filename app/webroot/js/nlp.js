var hins_Checked = true;	// default ---> all checked (input.cb_hin)
var types_Checked = true;	// default ---> all checked (input.cb_type)
var groups_Checked = false;	// default ---> all unchecked (input.cb_type)
var filter_Hin_1_Checked = true;	// default ---> all checked (input.cb_type)


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

function show_List() {
	
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
	//alert("radio_1 => " + radio_1);
	//alert("select_sort_column_1 => " + val_Sort_1);

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
	
	//alert(param_Sorts_Directions);
	
	/***************************
		get values : types
	 ***************************/
//	var val = $(".cb_type:checked").val();	//=> w.
	//ref http://qiita.com/kazu56/items/36b025dac5802b76715c
	var val = $(".cb_type:checked").map(function() {
		  return $(this).val();
	}).get();

//	alert(val);
	//alert("types => " + val);
	
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
	
//	alert(param_Group_By);
	
//	return;
	
	/***************************
		get values : selected hin name
	 ***************************/
	var val_Filter_Hin_1_Hin_Name = $("select#select_Filter_Hin_1").val();
//	var val_Filter_Hin_1 = $("select#select_Filter_Hin_1").val();
	
//	alert("val_Filter_Hin_1 => " + val_Filter_Hin_1);	//=> '助詞'
	
	/***************************
		get values : hin_1
	 ***************************/
	//ref http://qiita.com/kazu56/items/36b025dac5802b76715c
	var val_Filter_Hin_1 = $(".cb_Filter_Hin_1:checked").map(function() {
		return $(this).val();
	}).get();
	
	var lenOf_Filter_Hin_1 = val_Filter_Hin_1.length;
	
//	alert("lenOf_Filter_Hin_1 => " + lenOf_Filter_Hin_1);	//=> '0' if '---' chosen
	
	//ref https://www.ajaxtower.jp/js/array_class/index3.html
	var param_Filter_Hin_1 = val_Filter_Hin_1.join(",");
	
//	alert("param_Filter_Hin_1 => " + param_Filter_Hin_1);	//=> '0,1,2,3,4,5'
//	alert("param_Filter_Hin_1 => " + (param_Filter_Hin_1 == '' ? "blank" : "not blank"));	
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
		
		url = "/cake_apps/Cake_NR5/keywords/add_KW__Genre_Changed";
		
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
	var message = "param_types=" + param_types
				+ "/"
				+ "param_Sorts=" + param_Sorts
				+ "/"
				+ "param_Sorts_Directions=" + param_Sorts_Directions
				+ "/"
				+ "param_Hins=" + param_Hins
				+ "/"
				+ "param_Group_By=" + param_Group_By
				
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
		
		// button color
		button_Go.css("background", "PaleTurquoise");

		// disable ---> false
		button_Go.prop('disabled', false);
		
		
		$("#list_area").html(data);
		
//		alert("data.length => " + data.length);
		
		var rowCount = $('table#pieces tr').length;
		
		//alert("num of 'tr's => " + rowCount);
		
//		var rowCount = $('#myTable tr').length;
		
		// set table height
		var tmp = rowCount / 1.5;
//		var tmp = rowCount / 2.0;
		
		if (tmp < 50) {
			
			tmp = 50;
			
		} else if (tmp > 130) {
			
			tmp = 130;
			
		}
		
		
		var table_Height = tmp + "%";
//		var table_Height = rowCount / 2.0 + "%";
		
		//alert("table_Height => " + table_Height);
		
		$("#list_area").css("height", table_Height);
		
		/***************************
			row count ---> display
		 ***************************/
		if(rowCount > 1) {
			rowCount = rowCount - 1;
		}
		
		$('span#message').append("<br>" + "records=" + rowCount);
		
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
	
	
//	alert("unchecking...");
	
//	alert(inputs.length);
	
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
	
	
//	alert("unchecking...");
	
//	alert(inputs.length);
	
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
	
	
//	alert("unchecking...");
	
//	alert(inputs.length);
	
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
	
	
//	alert("unchecking...");
	
//	alert(inputs.length);
	
}//uncheck_All_Hin_1

function _onChange_Filter_Hin_1(hin_Name) {
	
//	alert("changing...");
	
//	//test
//	alert("hin => " + hin_Name);
//	
//	return;
	
	/***************************
		validate
	 ***************************/
	if (hin_Name == '0') {
		
//		alert("hin => 0");
		
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
		
		url = "/cake_apps/Cake_NR5/keywords/add_KW__Genre_Changed";
		
	} else {
		
		url = "/Eclipse_Luna/Cake_NR5/pieces/get_ListOf__Hin_1";
		
	}

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

$(document).ready(function(){

//	//test
//	test_replace_genre_id(12);
	
//	alert("ready");

	//REF http://stackoverflow.com/questions/3224535/how-do-i-add-an-onchange-event-to-select-tag-in-cakephp answered Jul 13 '10 at 11:15
//    $('#category').change(function(){
//      ("changed");
//    });
	
    $('select#select_Filter_Hin_1').change(
		function(){

			var val = $('select#select_Filter_Hin_1').find(":selected").val();
			
//			alert("changed => " + id);
//			alert("changed => " + "'" + val + "'");
			
//			var msg = "changed => " + "'" + val + "'";
			
//			$('td#tr_Filter_Hin_1').append("changed");
//			$('td#tr_Filter_Hin_1').append(msg);	//=> n.w.
//			$('td#tr_Filter_Hin_1').append("changed => " + "'" + val + "'");	//=> n.w.
//			$('td#td_Filter_Hin_1').append("changed => " + "'" + val + "'");	//=> n.w.
    	
			// exec
			_onChange_Filter_Hin_1(val);
			
    	}//function(){
    );//change(
    
})//$(document).ready(function(){
