function show_Hiraganas() {
	
//	alert("hiraganas");
//	$("#list_area").html("yes");
	
	var url_curr = $(location).attr('href');
	
//	$("#list_area").html(url_curr);
	
	var url;
	
	var hostname = window.location.hostname;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/Cake_NR5/keywords/add_KW__Genre_Changed";
		
	} else {
	
		url = "/Eclipse_Luna/Cake_NR5/pieces/filter_List_By_Type";
//		url = "/Cake_NR5/keywords/add_KW__Genre_Changed";

//		/Eclipse_Luna/Cake_NR5/pieces/filter_List_By_Type?type=hiragana
		
	}
	
//	alert(url);
	
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
		
//	//	alert(conv_Float_to_TimeLabel(data.point));
//	//	addPosition_ToList(data.point);
//		
////		_delete_position_Ajax__Done(data, status, xhr);
//		_add_KW__Genre_Changed__Done(data, status, xhr);
		
	}).fail(function(xhr, status, error) {
		
		alert(xhr.status);
		
	});


	
}


function show_List() {
	
	/***************************
		get values : sort
	 ***************************/
	//ref https://jquery.nj-clucker.com/select-set-get/
	var val_Sort_1 = $("#select_sort_column_1").val();
	var val_Sort_2 = $("#select_sort_column_2").val();
	var val_Sort_3 = $("#select_sort_column_3").val();
	
	alert(
			"select_sort_column_1 => " + val_Sort_1
			+ " / "
			+ "select_sort_column_2 => " + val_Sort_2
			+ " / "
			+ "select_sort_column_3 => " + val_Sort_3
	);
//	alert("select_sort_column_1 => " + val_Sort_1);
	
	/***************************
		get values : radio button : sort_1
	 ***************************/
	
	var radio_1 = $('input[name=sort_direction_1]:checked').val();
	var radio_2 = $('input[name=sort_direction_2]:checked').val();
	var radio_3 = $('input[name=sort_direction_3]:checked').val();
	
	alert(
				"radio_1 => " + radio_1
				+ " / "
				+ "radio_2 => " + radio_2
				+ " / "
				+ "radio_3 => " + radio_3
				
	);
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
				
			}
			
		}
		
	}//if (val_Sort_1 == 0) {
	
	alert("param_Sorts => " + param_Sorts);
	alert("param_Sorts_Directions => " + param_Sorts_Directions);
	
	
	return;
	
	/***************************
		get values
	 ***************************/
//	alert("checkboxes...");
	
	
//	var val = $(".cb_type:checked").map(function() {
//		  return $(this).val();
	var val = $(".cb_type:checked").val();	//=> w.
	//ref http://qiita.com/kazu56/items/36b025dac5802b76715c
	var val = $(".cb_type:checked").map(function() {
		  return $(this).val();
	}).get();
//	var val = $("input[type='checkbox']").val();	//=> works
//	
//	alert(val.name);	//=> 'undefined'
//	alert(val[1]);
//	alert(val.length);
//	alert(val);

	/***************************
		build : type string
	 ***************************/
	var lenOf_Types = val.length;
	
//	alert("lenOf_Types => " + lenOf_Types);

	//ref https://www.ajaxtower.jp/js/array_class/index3.html
	var param_types = val.join(",");
	
//	alert(param_types);
	
//	return;
	
	
//	alert("hiraganas");
//	$("#list_area").html("yes");
	
	var url_curr = $(location).attr('href');
	
//	$("#list_area").html(url_curr);
	
	var url;
	
	var hostname = window.location.hostname;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/Cake_NR5/keywords/add_KW__Genre_Changed";
		
	} else {
		
		url = "/Eclipse_Luna/Cake_NR5/pieces/filter_List_By_Type";
//		url = "/Cake_NR5/keywords/add_KW__Genre_Changed";
		
//		/Eclipse_Luna/Cake_NR5/pieces/filter_List_By_Type?type=hiragana
		
	}
	
//	alert(url);
	
	/*
	 * ajax
	 */
	
	var type_name = "hiragana";
	
	$.ajax({
		
		url: url,
		type: "GET",
		//REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
		data: {type: param_types},
//		data: {type: type_name},
		
		timeout: 10000
		
	}).done(function(data, status, xhr) {
		
		$("#list_area").html(data);
		
//	//	alert(conv_Float_to_TimeLabel(data.point));
//	//	addPosition_ToList(data.point);
//		
////		_delete_position_Ajax__Done(data, status, xhr);
//		_add_KW__Genre_Changed__Done(data, status, xhr);
		
	}).fail(function(xhr, status, error) {
		
		alert(xhr.status);
		
	});
	
	
	
}

