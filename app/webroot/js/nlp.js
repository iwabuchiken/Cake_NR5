var hins_Checked = true;	// default ---> all checked (input.cb_hin)
var types_Checked = true;	// default ---> all checked (input.cb_type)
var groups_Checked = false;	// default ---> all checked (input.cb_type)


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
	
	alert(param_Group_By);
	
//	return;
	
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
			group_by	: param_Group_By
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


