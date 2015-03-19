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
	
	var url;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/Cake_NR5/keywords/add_KW__Genre_Changed";
		
	} else {
	
		url = "/Cake_NR5/keywords/add_KW__Genre_Changed";
	
	}
	
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
	
//	alert("ready");

	//REF http://stackoverflow.com/questions/3224535/how-do-i-add-an-onchange-event-to-select-tag-in-cakephp answered Jul 13 '10 at 11:15
//    $('#category').change(function(){
//        alert("changed");
//    });
	
    $('#genre').change(function(){

    	//REF http://stackoverflow.com/questions/10659097/jquery-get-selected-option-from-dropdown answered May 18 '12 at 20:14
//    	alert($('#genre').find(":selected").val());
    	
    	var id = $('#genre').find(":selected").val();
    	
    	add_KW__Genre_Changed(id);
    	
//    	alert($('#genre').find(":selected").text());	// displayed
//    	alert(this.find(":selected").text());	// no display
    	
//    	alert("changed");
    });
    
    $('#Genre').change(function(){
    	
    	//REF http://stackoverflow.com/questions/10659097/jquery-get-selected-option-from-dropdown answered May 18 '12 at 20:14
    	var id = $('#Genre').find(":selected").val();
    	
    	var hostname = window.location.hostname;
    	
    	var url = "";
    	
    	if (hostname == "localhost") {
			
    		url = "http://localhost/Cake_NR5/articles?genre_id=" + id;
    			
		} else {
			
			url = "http://benfranklin.chips.jp/cake_apps/Cake_NR5/articles?genre_id=" + id;

		}
    	
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
    	
//    	alert(url);
    	
//    	//test
//    	alert($('#header_hins_1').html());
    	
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

    		var options = $('#header_hins_1');
//    		var options = $('header_hins_1');
    		
//    		alert(options);
    		
//    		alert($('#header_hins_1').html());
    		
    		$('header_hins_1').html(data);	//=> working
//    		$("header_hins_1").html(data);	//=> n/w
//    		$("header_hins_1").replaceWith(data);	//=> n/w
    		
    		
    		$('#header_hins_1').replaceWith(data);	//=> working

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
    
    $('#header_hins_1').change(function(){
    	
    	//REF http://stackoverflow.com/questions/10659097/jquery-get-selected-option-from-dropdown answered May 18 '12 at 20:14
    	var id = $('#header_hins_1').find(":selected").val();
    	
//    	alert(id);
    	
//    	//test
//    	alert($('#header_hins_1').html());	//=> working
//    	alert($("header_hins_1").html());	//=> undefined
    	
//    	alert($('#header_hins_1').html());
    	
//    	var hostname = window.location.hostname;
//    	
//    	var url = "";
//    	
//    	if (hostname == "localhost") {
//    		
//    		url = "http://localhost/Cake_NR5/articles?genre_id=" + id;
//    		
//    	} else {
//    		
//    		url = "http://benfranklin.chips.jp/cake_apps/Cake_NR5/articles?genre_id=" + id;
//    		
//    	}
//    	
//    	//REF https://developer.mozilla.org/en-US/docs/Web/API/window.location "Basic Example"
//    	location.assign(url);
    	
    });//$('#Genre').change(function(){
    
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

