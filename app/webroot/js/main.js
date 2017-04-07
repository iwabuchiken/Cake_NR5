//alert("main.js !!!");

//ref http://stackoverflow.com/questions/406192/get-current-url-in-javascript
//ref http://stackoverflow.com/questions/1034621/get-current-url-in-web-browser
//alert(window.location.href);

//ref http://stackoverflow.com/questions/979975/how-to-get-the-value-from-the-get-parameters
//var query = window.location.search.substring(1);
//
//alert(query);

//var query_string = get_query_string();
//alert(query_string[0]);
//alert(query_string[0][0]);

//test_replace_genre_id(12);

function
add_KW__Genre_Changed
(id) {
	
	/***********************
		Prep: ajax
	 ***********************/
//	alert("Start Ajax");
	
	/***********************
		change color
	 ***********************/
//	alert($('label[for="category"]').text());
	
	$label = $('label[for="category"]');
	
	$label.css("background", "yellow");
	
	var hostname = window.location.hostname;
	
//	alert(hostname);
	
	var url;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/Cake_NR5/keywords/add_KW__Genre_Changed";
		
	} else {
	
		url = "/Eclipse_Luna/Cake_NR5/keywords/add_KW__Genre_Changed";
//		url = "/Cake_NR5/keywords/add_KW__Genre_Changed";
	
	}
	
//	alert("url -> " + url);
	
	$.ajax({
		
	    url: url,
	    type: "GET",
	    //REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
	    data: {id: id},
	    
	    timeout: 10000
	    
	}).done(function(data, status, xhr) {
		
	//	alert(conv_Float_to_TimeLabel(data.point));
	//	addPosition_ToList(data.point);
		
//		_delete_position_Ajax__Done(data, status, xhr);
		_add_KW__Genre_Changed__Done(data, status, xhr);
		
	}).fail(function(xhr, status, error) {
		
		alert(xhr.status);
		
	});
	
}//edit_memo_execute()

function
_add_KW__Genre_Changed__Done(data, status, xhr) {
	
//	alert("ajax => done");
//	alert(data);

	//REF http://jszuki.doorblog.jp/archives/31702159.html
	$label = $('label[for="category"]');
	
	//REF http://js.studio-kingdom.com/jquery/css/css
	$label.css("background", "white");
	
//	$("#add_kw_ajax").append(data);	// 
////	$("#category").append(data);	// no change
	$("#category").html(data);	// selector changes
	
}


function
modify_content
(history_id) {
	
	var hostname = window.location.hostname;

	alert(hostname);
	
	var url;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/Cake_NR5/historys/content_multilines?id=" + history_id;
		
	} else {
	
		url = "/Cake_NR5/historys/content_multilines?id=" + history_id;
	
	}
	
	$.ajax({
		
	    url: url,
	    type: "GET",
	    //REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
//	    data: {id: id},
	    
	    timeout: 10000
	    
	}).done(function(data, status, xhr) {
		
	//	alert(conv_Float_to_TimeLabel(data.point));
	//	addPosition_ToList(data.point);
		
//		_delete_position_Ajax__Done(data, status, xhr);
		_modify_content__Done(data, status, xhr);
		
	}).fail(function(xhr, status, error) {
		
		alert(xhr.status);
		
	});
	
}//modify_content

function
_modify_content__Done
(data, status, xhr) {

	alert("Ajax => done");
//	alert(data);
	
	$("td#history_content").html(data);
//	$("td#history_content").text(data);
	
//	alert($("td#history_content").text());
	
	
}//_modify_content__Done

$(document).ready(function(){

//	//test
//	test_replace_genre_id(12);
	
//	alert("ready");

	//REF http://stackoverflow.com/questions/3224535/how-do-i-add-an-onchange-event-to-select-tag-in-cakephp answered Jul 13 '10 at 11:15
//    $('#category').change(function(){
//      ("changed");
//    });
	
    $('#genre').change(function(){

    	//REF http://stackoverflow.com/questions/10659097/jquery-get-selected-option-from-dropdown answered May 18 '12 at 20:14
//    	alert($('#genre').find(":selected").val());
    	
//    	alert("genre => changed");
    	
    	var id = $('#genre').find(":selected").val();
    	
    	add_KW__Genre_Changed(id);
    	
//    	alert($('#genre').find(":selected").text());	// displayed
//    	alert(this.find(":selected").text());	// no display
    	
//    	alert("changed");
    });
    
    $('#select_genre').change(function(){
//    	$('#Genre').change(function(){		//=> working, also

//    	alert("changed");
    	
//    	alert("$('#Genre') => changed");
    	
    	//REF http://stackoverflow.com/questions/10659097/jquery-get-selected-option-from-dropdown answered May 18 '12 at 20:14
    	var id = $('#select_genre').find(":selected").val();
//    	var id = $('#Genre').find(":selected").val();

//    	alert("selected id => " + id);
    	
    	var hostname = window.location.hostname;
    	
    	var url = "";
    	
    	if (hostname == "localhost") {
//    		http://localhost/Eclipse_Luna/Cake_NR5/articles2?genre_id=4

//    		test_replace_genre_id(id);

//    		url = window.location.href;
    		url = test_replace_genre_id(id);
//    		url = "http://localhost/Eclipse_Luna/Cake_NR5/articles2?genre_id=" + id;
//    		url = "http://localhost/Cake_NR5/articles?genre_id=" + id;
    			
		} else {
			
			url = "http://benfranklin.chips.jp/cake_apps/Cake_NR5/articles2?genre_id=" + id;
//			url = "http://benfranklin.chips.jp/cake_apps/Cake_NR5/articles?genre_id=" + id;

		}

//    	alert(url);
    	
//    	alert(window.location.hostname);
//    	alert(window.location.href);	//=> working
//    	alert(location.href);			//=> n/w
//    	alert(location.url);

    	//REF https://developer.mozilla.org/en-US/docs/Web/API/window.location "Basic Example"
    	location.assign(url);
//    	location.assign("http://localhost/Cake_NR5/articles?genre_id=" + id);
    	
    });//$('#Genre').change(function(){
    
    $('#header_hins').change(function(){
    	
    	//REF http://stackoverflow.com/questions/10659097/jquery-get-selected-option-from-dropdown answered May 18 '12 at 20:14
    	var hin_name = $('#header_hins').find(":selected").val();

//    	alert(id);
    	
    	var hostname = window.location.hostname;
    	
    	var url = "";
    	
    	if (hostname == "localhost") {
    		
    		url = "http://localhost/Cake_NR5/" +
    				"Tokens/hin_changed";
//    		"tokens/hin_changed";
//    		"tokens/hin_Changed";
//    		"tokens/hin_Changed?hin_name=" + hin_name;
    		
    	} else {
    		
    		url = "http://benfranklin.chips.jp/cake_apps/Cake_NR5/" +
    				"Tokens/hin_changed";
//    		"tokens/hin_changed";
//    		"tokens/hin_Changed";
//    		"tokens/hin_Changed?hin_name=" + hin_name;
    		
    	}
    	
    	//test
//    	$('#header_hins_1').replaceWith("done");	//=> working
//    	$('#header_hins_1').html("done");	//=> working
    	
    	/***************************
			change color
		 ***************************/
		$("th#hin_1").css("background", "yellow");
		
    	$.ajax({
    		
    	    url: url,
    	    type: "GET",
    	    //REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
    	    data: {hin_name: hin_name},
//    	    data: {id: id},
    	    
    	    timeout: 10000
    	    
    	}).done(function(data, status, xhr) {

//    		alert(data);
//    		alert("done");

    		var options = $('#form_hin_1');
//    		var options = $('#TokenIndexForm');
//    		var options = $('#header_hins_1');
//    		var options = $('header_hins_1');
    		
//    		alert(options);
    		
//    		alert($('#header_hins_1').html());
    		
    		options.html(data);	//=> 
    		
//    		$('header_hins_1').html(data);	//=> working
//    		$("header_hins_1").html(data);	//=> n/w
//    		$("header_hins_1").replaceWith(data);	//=> n/w
    		
    		
//    		$('#header_hins_1').replaceWith(data);	//=> working

        	/***************************
				change color
			 ***************************/
			$("th#hin_1").css("background", "white");

    		
//    		//REF http://api.jquery.com/replaceWith/
//    		var hin_form = $("#TokenHinChangedForm");
////    		var hin_form = $("form#TokenHinChangedForm");
//    		
//    		alert(hin_form.html());
////    		alert(hin_form);
//    		
//    		$("form#TokenHinChangedForm").replaceWith(data);
    		
    	}).fail(function(xhr, status, error) {
    		
    		alert(xhr.status);
    		
    	});

//    	
//    	//REF https://developer.mozilla.org/en-US/docs/Web/API/window.location "Basic Example"
//    	location.assign(url);
    	
    });//$('#Genre').change(function(){
    
    $('#header_hins_1').change(function() {
    	
    	//REF http://stackoverflow.com/questions/10659097/jquery-get-selected-option-from-dropdown answered May 18 '12 at 20:14
    	var hin_1_name = $('#header_hins_1').find(":selected").val();
//    	var hin_1 = $('#header_hins_1').find(":selected").val();
    	var hin = $('#header_hins').find(":selected").val();
    	
//    	alert("hins_1 => " + id + "\n" + "hin => " + hin);
    	
//    	//test
//    	alert($('#header_hins_1').html());	//=> working
//    	alert($("header_hins_1").html());	//=> undefined
    	
//    	alert($('#header_hins_1').html());
    	
    	var hostname = window.location.hostname;
    	
    	var url = "";
    	
    	if (hostname == "localhost") {
    		
    		url = "http://localhost/Cake_NR5/" +
    				"Tokens/hin_1_changed";
//    		"tokens/hin_changed";
//    		"tokens/hin_Changed";
//    		"tokens/hin_Changed?hin_name=" + hin_name;
    		
    	} else {
    		
    		url = "http://benfranklin.chips.jp/cake_apps/Cake_NR5/" +
    				"Tokens/hin_1_changed";
//    		"tokens/hin_changed";
//    		"tokens/hin_Changed";
//    		"tokens/hin_Changed?hin_name=" + hin_name;
    		
    	}

//    	alert(url);
    	
    	/***************************
			change color
		 ***************************/
		$("th#hin_2").css("background", "yellow");
		
		$.ajax({
			
		    url: url,
		    type: "GET",
		    //REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
		    data: {hin_1_name: hin_1_name},
	//	    data: {id: id},
		    
		    timeout: 10000
		    
		}).done(function(data, status, xhr) {
	
	//		alert(data);
	//		alert("done");
	
			var options = $('#form_hin_2');
//			var options = $('#form_hin_1');
//			var options = $('#TokenIndexForm');
	//		var options = $('#header_hins_1');
	//		var options = $('header_hins_1');
			
	//		alert(options);
			
	//		alert($('#header_hins_1').html());
			
			options.html(data);	//=> 
			
	//		$('header_hins_1').html(data);	//=> working
	//		$("header_hins_1").html(data);	//=> n/w
	//		$("header_hins_1").replaceWith(data);	//=> n/w
			
			
	//		$('#header_hins_1').replaceWith(data);	//=> working
	
	    	/***************************
				change color
			 ***************************/
			$("th#hin_2").css("background", "white");
	
			
	//		//REF http://api.jquery.com/replaceWith/
	//		var hin_form = $("#TokenHinChangedForm");
	////		var hin_form = $("form#TokenHinChangedForm");
	//		
	//		alert(hin_form.html());
	////		alert(hin_form);
	//		
	//		$("form#TokenHinChangedForm").replaceWith(data);
			
		}).fail(function(xhr, status, error) {
			
			alert(xhr.status);
			
		});

    	
//    	//REF https://developer.mozilla.org/en-US/docs/Web/API/window.location "Basic Example"
//    	location.assign(url);
    	
    });//$('#header_hins_1').change(function()
    
})

function show_msg() {
	
	alert("jquery!");
	
//	$("#jqarea").text("done");
	
//	$.ajax({
//		
//	    url: "/VM_Cake/videos/retrieve_CurrentTime",
//	    type: "GET",
//	    timeout: 10000
//	    
//	}).done(function(data, status, xhr) {
//		
//		$("#jqarea").text(data);
//		
//		seek(data);
//		
//	}).fail(function(xhr, status, error) {
//		
//	    $("#jqarea").append("xhr.status = " + xhr.status + "<br>");          // ��: 404
//	    
//	});
	
}
//$(function() {
//    $( "#dialog" ).dialog();
//});

//ref http://stackoverflow.com/questions/979975/how-to-get-the-value-from-the-get-parameters
function get_query_string() {
	  // This function is anonymous, is executed immediately and 
	  // the return value is assigned to QueryString!
	  var query_string = {};
	  var query = window.location.search.substring(1);
	  var vars = query.split("&");
	  for (var i=0;i<vars.length;i++) {
	    var pair = vars[i].split("=");
	        // If first entry with this name
	    if (typeof query_string[pair[0]] === "undefined") {
	      query_string[pair[0]] = decodeURIComponent(pair[1]);
	        // If second entry with this name
	    } else if (typeof query_string[pair[0]] === "string") {
	      var arr = [ query_string[pair[0]],decodeURIComponent(pair[1]) ];
	      query_string[pair[0]] = arr;
	        // If third or later entry with this name
	    } else {
	      query_string[pair[0]].push(decodeURIComponent(pair[1]));
	    }
	  } 
	  
	  return query_string;
	  
}

/*************************************
 * started: 2017/04/07 00:22:42
 * 
 *************************************/
function test_replace_genre_id(id_new) {

	var url_current = window.location.href;		// 'http://localhost/Eclipse_Luna/Cake_NR5/articles2?genre_id=10&test'
	var pathname = window.location.pathname;	// '/Eclipse_Luna/Cake_NR5/articles2' 
	var params = window.location.search.substring(1);	// 'genre_id=10&test' 
	var hostname = window.location.hostname;	//  
	
	//ref http://stackoverflow.com/questions/6042007/how-to-get-the-host-url-using-javascript-from-the-current-page answered May 18 '11 at 8:44
	var protocol = location.protocol;
	var slashes = protocol.concat("//");
	var host = slashes.concat(window.location.hostname);	//=> 'http://localhost'

	var msg = host.concat(pathname).concat("?").concat(params); 
	
	/***************************
		rebuild url
	 ***************************/
	var tokens = params.split('&');
	
	var lenof_tokens = tokens.length;
	
//	alert("lenof_tokens => " + lenof_tokens);
	
	msg = "";		// reset the msg var
	
	var params_new = "";
	
	var flag_genre_id_param_given = false;
	
	// iterate params
	for (var i = 0; i < lenof_tokens; i++) {
		
		var elems = tokens[i].split('=');
		
		var lenof_elems = elems.length;
		
		if (lenof_elems == 1) {

			params_new += elems[0];

		} else {

			if (elems[0] == "genre_id") {

				params_new += "genre_id=" + id_new;
				
				// set the flag
				flag_genre_id_param_given = true;

			} else {

				params_new += elems[0] + "=" + elems[1];

			}//if (elems[0])
			;

		}//if (lenof_elems == 1)
		
		// add "&"
		if (!(i == lenof_tokens - 1)) {
			
			params_new += "&";
			
		}
		
		
//		msg += "tokens[" + i + "]"
//				+ " => " + lenof_elems + " | ";
		
	}
	
//	alert(params_new);
//	alert(msg);
	/***************************
		validate: genre_id param
	 ***************************/
	if (flag_genre_id_param_given == false) {
		
		params_new += "&genre_id=" + id_new;
		
	}
	
	
	/***************************
		rebuild
	 ***************************/
	var url_new = host.concat(pathname).concat("?").concat(params_new);
	
//	alert("url_new => " + url_new);
	
	/***************************
		return
	 ***************************/
	return url_new;
	
}//function test_replace_genre_id(url)

