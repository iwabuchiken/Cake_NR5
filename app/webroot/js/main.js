//$(function() {
//    $( "#dialog" ).dialog();
//});

var previous_position;

function show_category_list() {
	
	var select_genre = $("#keyword_genre_id");
	
	var selected_genre_id = select_genre.val();
	
//	alert("Selected genre => " + selected_genre_id);
	
	// Chagne the div background to yellow while ajaxing
	//REF .css() http://stackoverflow.com/questions/4283141/jquery-change-background-color answered Nov 26 '10 at 7:12
	$("#category_list").css("background-color", "yellow");
	
	$.ajax({
		
	    url: "/nr4/keywords/show_category_list?selected_genre=" + selected_genre_id,
	    type: "GET",
	    timeout: 10000
	    
	}).done(function(data, status, xhr) {
		
		$("#category_list").css("background-color", "white");
		
//	    $("#js").html(data);
//	    $("#js").append(data);
		$("#category_list").html(data);
//	    $("#js").append("<br/>");
		
		// Get the background color back to white
	    
	    
	}).fail(function(xhr, status, error) {
		
	    $("#genre_list").append("xhr.status = " + xhr.status + "<br>");          // ��: 404
	    
	});
	
//	$("#category_list").html("Selected genre => " + selected_genre_id);
	
}//function show_category_list() {

function show_Message() {
	
//	alert("jquery!");
	
//	$("#jqarea").text("done");
	
	$.ajax({
		
	    url: "/VM_Cake/videos/retrieve_CurrentTime",
	    type: "GET",
	    timeout: 10000
	    
	}).done(function(data, status, xhr) {
		
		$("#jqarea").text(data);
		
		seek(data);
		
	}).fail(function(xhr, status, error) {
		
	    $("#jqarea").append("xhr.status = " + xhr.status + "<br>");          // ��: 404
	    
	});
	
}

function play() {
	
	  if (ytplayer) {
	
//		  /***********************
//			sound
//		 ***********************/
//		  var aud = $("audio#audio_play")[0];
////		  Woosh-Mark_DiAngelo-4778593.wav
//		  aud.src = "/VM_Cake/audio/POOL-Pool_Shot-709343898.mp3";
//		  aud.play();
		  
//		var audio_play = $("audio#audio_play")[0];	// [object HTMLAudioElement]
//		var audio_play = $("audio#audio_play");	// [object Object]
//		alert("audio => " + audio_play.constructor.name);
//		alert("audio => " + audio_play);	// [object Object]
//		audio_play.play();
		  
		  /***********************
			UIs
		 ***********************/
		  var current_img_src = $("img#button_play").attr("src");
		  
		  var current_img_new = 
			  		current_img_src.replace("player_play.png", "player_pause.png");
		  
		  $("img#button_play").attr("onclick", "pause()");
		  $("img#button_play").attr("src", current_img_new);
		  
		  ytplayer.playVideo();
	
	  }
	
	}

function pause() {
	
  if (ytplayer) {
	  
	  /***********************
		sound
	 ***********************/
	  sound("Woosh-Mark_DiAngelo-4778593.wav");
	  
//	  var aud = $("audio#audio_play")[0];
////	  Woosh-Mark_DiAngelo-4778593.wav
//	  aud.src = "/VM_Cake/audio/Woosh-Mark_DiAngelo-4778593.wav";
//	  $("source#audio_source").src = "/VM_Cake/audio/Woosh-Mark_DiAngelo-4778593.wav";
//	  $("source#audio_source").src = "/VM_Cake/audio/POOL-Pool_Shot-709343898.mp3";

//	  aud.load();
//	  aud.play();
//	  $("audio#audio_play")[0].load();
//	  $("audio#audio_play")[0].play();
	  
	  /***********************
		player
	 ***********************/
	  var current_img_src = $("img#button_play").attr("src");
	  
	  var current_img_new = 
		  		current_img_src.replace("player_pause.png", "player_play.png");
	  
	  $("img#button_play").attr("onclick", "play()");
	  $("img#button_play").attr("src", current_img_new);
	  
	  ytplayer.pauseVideo();

  }

}



function stop() {

  if (ytplayer) {

	  var current_img_src = $("img#button_play").attr("src");
	  
	  var current_img_new = 
		  		current_img_src.replace("player_pause.png", "player_play.png");
	  
	  $("img#button_play").attr("onclick", "play()");
	  $("img#button_play").attr("src", current_img_new);

	  
	ytplayer.stopVideo();

  }

}

//function seek(position, id) {
function 
seek(position) {
//	function seek($position) {

  if (ytplayer) {

	  alert("previous position => " + conv_Float_to_TimeLabel(previous_position))
	  
	  previous_position = position;
	  
//	ytplayer.cueVideoById(id, 0, "medium");
	  
	ytplayer.seekTo(position);
	
	$("img#button_repeat").attr("onclick", "repeat(" + position + ")");
	
	  var current_img_src = $("img#button_play").attr("src");
	  
	  var current_img_new = 
		  		current_img_src.replace("player_play.png", "player_pause.png");
	  
	  $("img#button_play").attr("onclick", "pause()");
	  $("img#button_play").attr("src", current_img_new);
	  
	  ytplayer.playVideo();

	
//	ytplayer.seekTo($position);
//		ytplayer.seekTo(<?php //echo $position;?>);
//		ytplayer.seekTo(<?php //echo 20;?>);
//		ytplayer.seekTo(10);
	
  }

}//seek(position, fromRepeatButton)

function 
seek_v2(position, id) {
//	function seek($position) {
	
	if (ytplayer) {

//		_test_seek_v2();

		/*****************
			UIs
		 ******************/
		$("img#button_repeat").attr("onclick", "repeat(" + position + ")");
		
		var current_img_src = $("img#button_play").attr("src");
		
		var current_img_new = 
			current_img_src.replace("player_play.png", "player_pause.png");
		
		$("img#button_play").attr("onclick", "pause()");
		$("img#button_play").attr("src", current_img_new);
		
		$("td#" + id).attr("class", "pos_chosen");
//		$("a#button_save_current_time").css("color", "grey");

		/***********************
			background
		 ***********************/
		//REF http://stackoverflow.com/questions/5193973/loop-through-all-td-elements-in-a-table answered Mar 4 '11 at 12:56
		$("table#table_poslist tr td").each(
				
			function() {
				
//				alert($(this).attr("class"));
				
//				var chosen = $(this).attr("class", "pos_chosen");
				var chosen = $(this).attr("class");
				
//				if(chosen != null && chosen != "delete_position") {
				if(chosen == "pos_chosen") {
//					if(chosen != null) {
					
					//REF http://api.jquery.com/removeattr/
					$(this).removeAttr("class");
					
				}
				
			}
				
//					$(this).attr("class", "pos_chosen");
			);

		// add class value
		$("td#" + id).attr("class", "pos_chosen");
		
		
		/*****************
			player
		 ******************/
		ytplayer.seekTo(position);
		
		ytplayer.playVideo();
		
		
//	ytplayer.seekTo($position);
//		ytplayer.seekTo(<?php //echo $position;?>);
//		ytplayer.seekTo(<?php //echo 20;?>);
//		ytplayer.seekTo(10);
		
	}
	
}//seek(position, fromRepeatButton)

function
_test_seek_v2() {
	
//	alert("previous position => " + conv_Float_to_TimeLabel(previous_position))
	
//	alert("attr(\"class\") => " + $("td#" + id).attr("class"));
//	var message;
//	
//	if($("td#" + id).attr("class") == "undefined") {
//		
//		message = "Not yet defined";
//		
//	} else if($("td#" + id).attr("class") == null) {
//		
//		message = "null";
//		
//	} else {
//		
//		message = "attr(\"class\") => " + $("td#" + id).attr("class");
//		
//	}
//	
//	alert(message);
//	
//	previous_position = position;
	
//ytplayer.cueVideoById(id, 0, "medium");
	
	var table = $("#table_poslist");

	//REF http://stackoverflow.com/questions/5347357/jquery-get-selected-element-tag-name answered Mar 18 '11 at 2:22
//	alert("tagName => " + table.prop("tagName"))
	
//	$("table tr td").each(
	$("table#table_poslist tr td").each(
//		$("table#table_poslist tr td").each(
		
		function() {
			
			$(this).attr("class", "pos_chosen");
			
		}
		
//			$(this).attr("class", "pos_chosen");
	);
	
//	var trs = $("table#table_poslist tr");
////	var trs = $("table#table_poslist tr").get(0);	// N/W
//	
//	alert("tagName => " + trs.prop("tagName"));
//	alert("id => " + trs.attr("id"));
//	
//	var trs = $("#table_poslist").children();
////	var trs = $("table#table_poslist").children();
//	
//	alert("trs.length => " + trs.length);
	
}

function 
seek_FromRepeatButton(position) {
//	function seek($position) {
	
	if (ytplayer) {
		
//	ytplayer.cueVideoById(id, 0, "medium");
		
		  var current_img_src = $("img#button_play").attr("src");
		  
		  //REF replace http://stackoverflow.com/questions/2145988/how-do-i-do-string-replace-in-javascript-to-convert-9-61-to-961 answered Jan 27 '10 at 10:19
		  var current_img_new = 
			  		current_img_src.replace("player_play.png", "player_pause.png");
		  
		  //REF attr http://api.jquery.com/attr/#attr2
		  $("img#button_play").attr("onclick", "pause()");
		  $("img#button_play").attr("src", current_img_new);
		
		ytplayer.seekTo(position);
		
		ytplayer.playVideo();
//		ytplayer.play();
		
//		$("img#button_repeat").attr("onclick", "repeat(" + position + ")");
//		$("img#button_repeat").prop("onclick", "repeat(" + position + ")");
			
	}
	
}//seek_FromRepeatButton(position, fromRepeatButton)

function sort() {
	
	var hostname = window.location.hostname;
	
	var url;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/VM_Cake/videos/sort_PosList";
		
	} else {

		url = "/VM_Cake/videos/sort_PosList";

	}
	
//	alert(hostname);
	
//	var video_id = $("#video_id_hidden").text();
	
	//REF http://stackoverflow.com/questions/4582423/get-value-of-input-tag-using-jquery answered Jan 3 '11 at 6:14
	var video_id = $("#video_id_hidden").val();
	
	
	
	$.ajax({
		
	    url: url,
	    type: "GET",
	    //REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
	    data: {video_id: video_id},
	    
	    //REF json http://stackoverflow.com/questions/1261747/how-to-get-json-response-into-variable-from-a-jquery-script answered Aug 11 '09 at 17:24
//	    dataType: "json",
	    timeout: 10000
	    
	}).done(function(data, status, xhr) {
		
//		alert(conv_Float_to_TimeLabel(data.point));
//		addPosition_ToList(data.point);
		
		sort__Done(data, status, xhr);
		
//		seek(data);
		
	}).fail(function(xhr, status, error) {
		
//	    $("#jqarea").append("xhr.status = " + xhr.status + "<br>");          // ��: 404
		alert(xhr.status);
	    
	});
	
	
}//function saveCurrentTime_js()

function sort__Done(data, status, xhr) {
	
//	alert("Sort => done");
	$("#table_poslist").html(data);
	
}


function saveCurrentTime_js() {
	
	/***********************
		sound
	 ***********************/
//	Tick-DeepFrozenApps-397275646.wav
	sound("Tick-DeepFrozenApps-397275646.mp3");
//	sound("Tick-DeepFrozenApps-397275646.wav");
//	  var aud = $("audio#audio_play")[0];
////	  Woosh-Mark_DiAngelo-4778593.wav
//	  aud.src = "/VM_Cake/audio/POOL-Pool_Shot-709343898.mp3";
//	  aud.play();

	
	/***********************
		UIs
	 ***********************/
	$("a#button_save_current_time").css("color", "grey");
	
	/***********************
		data
	 ***********************/
	var curTime = ytplayer.getCurrentTime();
//	var curTime = getCurrentTime();
	
	var hostname = window.location.hostname;
	
	var url;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/VM_Cake/videos/save_CurrentTime";
		
	} else {
		
		url = "/VM_Cake/videos/save_CurrentTime";
		
	}
	
//	alert(hostname);
	
//	var video_id = $("#video_id_hidden").text();
	
	//REF http://stackoverflow.com/questions/4582423/get-value-of-input-tag-using-jquery answered Jan 3 '11 at 6:14
	var video_id = $("#video_id_hidden").val();
	
	
	
	$.ajax({
		
		url: url,
		type: "GET",
		//REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
		data: {curTime: curTime, video_id: video_id},
		
		//REF json http://stackoverflow.com/questions/1261747/how-to-get-json-response-into-variable-from-a-jquery-script answered Aug 11 '09 at 17:24
//	    dataType: "json",
		timeout: 10000
		
	}).done(function(data, status, xhr) {
		
//		alert(conv_Float_to_TimeLabel(data.point));
//		addPosition_ToList(data.point);
		
		saveCurrentTime_js__Done(data, status, xhr, curTime);
		
//		seek(data);
		
	}).fail(function(xhr, status, error) {
		
		$("#jqarea").append("xhr.status = " + xhr.status + "<br>");          // ��: 404
		
	});
	
	
}//function saveCurrentTime_js()

function 
saveCurrentTime_js__Done(data, status, xhr, curTime) {
	
	/***********************
		sound
	 ***********************/
	sound("pin_dropping-Brian_Rocca-2084700791.mp3");
	
	/***********************
		UIs
	 ***********************/
	//REF css http://stackoverflow.com/questions/2001366/jquery-change-text-color-is-there-a-code-for-this answered Jan 4 '10 at 18:52
	$("a#button_save_current_time").css("color", "#088A08");
	
	/***********************
		html
	 ***********************/
	$("#table_poslist").html(data);
//	$("#table_poslist").append(data);
	
//	alert("Position saved => " + conv_Float_to_TimeLabel(curTime));
	
//	sort();
//	alert("Position saved => " + curTime);
//	addPosition_ToList(data.point);
	
}//saveCurrentTime_js__Done(data, status, xhr)

function getCurrentTime() {
	
  if (ytplayer) {

	$cur = ytplayer.getCurrentTime();

	return $cur;
//	alert($cur);
//		alert("current = ".$cur);
//		ytplayer.seekTo(<?php //echo $position;?>);
//		ytplayer.seekTo(<?php //echo 20;?>);
//		ytplayer.seekTo(10);

  }
	
  return null;
  
}

function test_AddPosition() {
	
	var current_time = getCurrentTime();
	
	var tag = "<tr><td id=\"poslist_1\" onclick=\"seek("
		+ current_time.toString()
		+ ")\">"
		//REF http://stackoverflow.com/questions/6312993/javascript-seconds-to-time-with-format-hhmmss answered Sep 27 '12 at 1:22
//		+ (new Date().toTimeString()) + "</td></tr>");
		+ current_time.toString() + "</td></tr>";
	
//	alert(tag);
	
	$("table#table_poslist").append(tag);
//	$("table#table_poslist").append(
//					"<tr><td id=\"poslist_1\" onclick=\"seek("
//					.current_time.toString()
//					.")\">"
//					//REF http://stackoverflow.com/questions/6312993/javascript-seconds-to-time-with-format-hhmmss answered Sep 27 '12 at 1:22
////					+ (new Date().toTimeString()) + "</td></tr>");
//					+ current_time.toString() + "</td></tr>");
	
}

function addPosition_ToList(position) {
	
//	var current_time = getCurrentTime();
	
	var tag = "<tr><td id=\"poslist_1\" onclick=\"seek("
		+ position.toString()
//		+ position.toFixed(5).toString()
		+ ")\">"
		//REF http://stackoverflow.com/questions/6312993/javascript-seconds-to-time-with-format-hhmmss answered Sep 27 '12 at 1:22
//		+ (new Date().toTimeString()) + "</td></tr>");
//		+ position.toString() + "</td></tr>";
		+ conv_Float_to_TimeLabel(position) + "</td></tr>";
	
//	alert(tag);
	
	$("table#table_poslist").append(tag);
//	$("table#table_poslist").append(
//					"<tr><td id=\"poslist_1\" onclick=\"seek("
//					.current_time.toString()
//					.")\">"
//					//REF http://stackoverflow.com/questions/6312993/javascript-seconds-to-time-with-format-hhmmss answered Sep 27 '12 at 1:22
////					+ (new Date().toTimeString()) + "</td></tr>");
//					+ current_time.toString() + "</td></tr>");
	
}

function conv_Float_to_TimeLabel(float_val) {
	
	//REF http://www.w3schools.com/jsref/jsref_floor.asp
	var integer = Math.floor(float_val);
	
	var decimal = float_val - integer;
	
//	var sec_num = parseInt(this, 10); // don't forget the second param
    var sec_num = integer; // don't forget the second param
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
//    var time    = hours+':'+minutes+':'+seconds;
    //REF split http://www.w3schools.com/jsref/jsref_split.asp
    var time    = hours+':'+minutes+':'+seconds + "."
    			+ decimal.toFixed(5).toString().split(".")[1];
    
    return time;
}

function repeat(position) {
	
	/***********************
		sound
	 ***********************/
//	sound("pin_dropping-Brian_Rocca-2084700791.mp3");
	
	seek_FromRepeatButton(position);
//	seek_FromRepeatButton(position, true);
//	seek(position, true);
	
}

function scroll_tobottom() {
//	function scroll_ToBottom() {

//	alert("Moving the scroll");
	
//	$("img#scroll_ToBottom")
	var objDiv = document.getElementById("div_poslist");
//	var objDiv = document.getElementById("scroll_tobottom");
	
//	alert(objDiv + "/height = " + objDiv.scrollHeight);
//	var objDiv = document.getElementById("scroll_ToBottom");
	objDiv.scrollTop = objDiv.scrollHeight;
}

function scroll_totop() {
//	function scroll_ToBottom() {
	
//	alert("Moving the scroll");
	
//	$("img#scroll_ToBottom")
	var objDiv = document.getElementById("div_poslist");
//	var objDiv = document.getElementById("scroll_tobottom");
	
//	alert(objDiv + "/height = " + objDiv.scrollHeight);
//	var objDiv = document.getElementById("scroll_ToBottom");
	objDiv.scrollTop = 0;
}

function 
delete_position(position, id) {
	/***********************
		process
	 ***********************/
//	  if(aud.ended) {
		  
	$("div#div_message").text("Delete? => "  + conv_Float_to_TimeLabel(position));
	
	$("div#div_message").dialog(
			{
				draggable:	true,
				width:		200,
				height:		200,
				title:		"Confirm",
//				modal: true,
//				position: ['center'],
//				position: [200, 200],
//				position: ['center', 200],
//				dialogClass: 'ui-dialog-osx'
				//REF http://stackoverflow.com/questions/9304830/jqueryui-dialog-positioning answered Feb 16 '12 at 23:31
				position:	{ my: 'top', at: 'top+20%' },
//				position:	{ my: 'top', at: 'top+10' },
				dialogClass:	'ui-dialog-style-1'
				,
					buttons: {
			        "Cancel": function() {
			            $(this).dialog("close");
			        }
					,
					"Go": function() {
						$(this).dialog("close");
						_delete_position_Ajax(id);
					}
			    }
			}
	);
	
			//REF http://stackoverflow.com/questions/10310004/jquery-delete-confirmation-box answered Apr 25 '12 at 5:51
//			if (confirm("Delete? => " + conv_Float_to_TimeLabel(position))) {
//				
//				_delete_position_Ajax(id);
//				
//		    }
			
//	  }
	
	
    return false;
	
}

function
_delete_position_Ajax(id) {
	
	/***********************
		UIs
	 ***********************/
//	$(this).css("background-color", "grey");
	
	/***********************
		Prep: ajax
	 ***********************/
//	alert("Start Ajax");
	var hostname = window.location.hostname;
	
	var url;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/VM_Cake/videos/delete_Ajax";
		
	} else {

		url = "/VM_Cake/videos/delete_Ajax";

	}
	
//	alert(hostname);
	
//	var video_id = $("#video_id_hidden").text();
	
	//REF http://stackoverflow.com/questions/4582423/get-value-of-input-tag-using-jquery answered Jan 3 '11 at 6:14
	var video_id = $("#video_id_hidden").val();
	
	
	
	$.ajax({
		
	    url: url,
	    type: "GET",
	    //REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
//	    data: {id: id},
	    data: {id: id, video_id: video_id},
//	    data: {video_id: video_id},
	    
	    //REF json http://stackoverflow.com/questions/1261747/how-to-get-json-response-into-variable-from-a-jquery-script answered Aug 11 '09 at 17:24
//	    dataType: "json",
	    timeout: 10000
	    
	}).done(function(data, status, xhr) {
		
//		alert(conv_Float_to_TimeLabel(data.point));
//		addPosition_ToList(data.point);
		
		_delete_position_Ajax__Done(data, status, xhr);
		
//		seek(data);
		
	}).fail(function(xhr, status, error) {
		
//	    $("#jqarea").append("xhr.status = " + xhr.status + "<br>");          // ��: 404
		alert(xhr.status);
	    
	});
	
}

function
_delete_position_Ajax__Done(data, status, xhr) {
	
	/***********************
		sound
	 ***********************/
	sound("Shells_falls-Marcel-829263474.wav");
	
	//REF substring http://www.w3schools.com/jsref/jsref_substring.asp
	//REF length http://www.w3schools.com/jsref/jsref_length_string.asp
	var data_substr = data.substring(3, data.length);
	
	var str = "abc";
	
	//REF http://stackoverflow.com/questions/10154898/string-comparison-returns-false-strange-javascript-behaviour-with-jquery-mobile answered Apr 14 '12 at 15:54
//	var index;
//	var msg = "";
//	for (index = 0; index < data.length; ++index) {
//	    msg += data.charCodeAt(index) + ", ";
//	}
//	
//	alert("data => " + msg);
//	
//	msg = "";
//	
//	for (index = 0; index < str.length; ++index) {
//		msg += str.charCodeAt(index) + ", ";
//	}
//	
//	alert("str => " + msg);
//	
//	msg = "";
//	
//	for (index = 0; index < data_substr.length; ++index) {
//		msg += data_substr.charCodeAt(index) + ", ";
//	}
//	
//	alert("data_substr => " + msg);
	
//	alert(str + "(str) => " + str.constructor.name);
//	
//	alert("data == \"failed\" => " + (data == "failed"));
	if (data_substr === str) {
//		if (data === "failed") {
//		if (data == "failed") {
		
		alert("Delete position => failed");
		
	} else {

		//REF http://stackoverflow.com/questions/10314338/get-name-of-object-or-class-in-javascript answered Apr 25 '12 at 11:15
//		alert("class => " + data.constructor.name);		// String
//		alert("data => " + data);
		
//		alert("position => deleted");
		
//		$("div#div_message").append("deleted");
//		
//		$("div#div_message").dialog();
		$("div#div_message").text("deleted");
		
//		$("div#div_message").dialog();
//		$("div#div_message").dialog(
//			{
//				draggable: true
//			}
//		);
		
		$("div#div_message").dialog(
				{
					draggable:	true,
					width:		100,
					height:		100,
					title:		"",
//					modal: true,
//					position: ['center'],
//					position: [200, 200],
//					position: ['center', 200],
//					dialogClass: 'ui-dialog-osx'
					//REF http://stackoverflow.com/questions/9304830/jqueryui-dialog-positioning answered Feb 16 '12 at 23:31
					position:	{ my: 'top', at: 'top+20%' },
//					position:	{ my: 'top', at: 'top+10' },
					dialogClass:	'ui-dialog-style-1'
					,
					buttons: {
//				        " ": function() {
////				            $(this).dialog("close");
//				        }
//					"close": function() {
//						$(this).dialog("close");
//					}
				    }
				}
		);

		
		AutoCloseDialogBox(2000);

		
		$("#table_poslist").html(data);
		
	}
	
}

function
_edit_memo_execute_Done(data, status, xhr) {
	
	/***********************
		sound
	 ***********************/
	sound("Shells_falls-Marcel-829263474.wav");
	
	//REF substring http://www.w3schools.com/jsref/jsref_substring.asp
	//REF length http://www.w3schools.com/jsref/jsref_length_string.asp
	var data_substr = data.substring(3, data.length);
	
	var str = "abc";
	
	if (data_substr === str) {
		
		alert("Edit memo => failed");
		
	} else {
		
		$("div#div_message").text("Memo => edited");
		
		$("div#div_message").dialog(
				{
					draggable:	true,
					width:		200,
					height:		100,
					title:		"",
					//REF http://stackoverflow.com/questions/9304830/jqueryui-dialog-positioning answered Feb 16 '12 at 23:31
					position:	{ my: 'top', at: 'top+20%' },
//					position:	{ my: 'top', at: 'top+10' },
					dialogClass:	'ui-dialog-style-1'
						,
						buttons: {
//				        " ": function() {
////				            $(this).dialog("close");
//				        }
//					"close": function() {
//						$(this).dialog("close");
//					}
						}
				}
		);
		
		AutoCloseDialogBox(2000);
		
		$("#table_poslist").html(data);
		
	}
	
}//_edit_memo_execute_Done(data, status, xhr)

//REF http://dotnetguts.blogspot.jp/2012/02/how-to-open-and-auto-close-jquery-ui.html
//REF referer http://forums.asp.net/t/1818619.aspx?close+alert+window+automatically+after+5+seconds Jun 27, 2012 06:59 AM
function
AutoCloseDialogBox(WaitSeconds) {
    //Auto Close Dialog Box after few seconds
    setTimeout(
        function () {
            $("div#div_message").dialog("close");
        }, WaitSeconds);
}

function
sound(file_name) {
	
	var hostname = window.location.hostname;
	
	var path;
	
	if (hostname == "benfranklin.chips.jp") {
		
		path = "/cake_apps/VM_Cake/audio";
		
	} else {
		
		path = "/VM_Cake/audio";
//		path = "/VM_Cake/videos/save_CurrentTime";
		
	}

	
	  var aud = $("audio#audio_play")[0];
//	  Woosh-Mark_DiAngelo-4778593.wav
	  var path;
	  aud.src = aud.src = path + "/" + file_name;
//	  aud.src = aud.src = "/VM_Cake/audio/" + file_name;
	  aud.play();
	  
}

function
setVolue(volume) {
	
//	$("#volume_val").text(volume.toString());
//	$("#volume_val").text(volume);
	
}

function
edit_memo(id, point, memo) {
	
//	alert("id => " + id);
	var html = "<div>" + conv_Float_to_TimeLabel(point) + "</div>";
//	var html = "<div>ID = " + id + "</div>";
	
//	if(memo == null) {
//		alert("NULL!")
//	
//	} else if(memo == "") {
//		
//		alert("Blank");		// Blank
//		
//	} else {
//		alert("Not NULL");
//	}
	
	html += "<div><textarea id='jquery_textarea'>"
//			+ "memo => "
//			+ conv_Float_to_TimeLabel(point)
			+ memo
//			+ point
			+ "</textarea></div>";
	
	$("div#div_message").html(html);
//	$("div#div_message").text("Edit memo");
	
//	$("div#div_message").dialog();
//	$("div#div_message").dialog(
//		{
//			draggable: true
//		}
//	);
	
//	alert("id => " + id);
	
	$("div#div_message").dialog(
			{
				draggable:	true,
				width:		500,
				height:		500,
				title:		"Edit memo",
//				title:		"abc",
//				modal: true,
//				position: ['center'],
//				position: [200, 200],
//				position: ['center', 200],
//				dialogClass: 'ui-dialog-osx'
				//REF http://stackoverflow.com/questions/9304830/jqueryui-dialog-positioning answered Feb 16 '12 at 23:31
				position:	{ my: 'top', at: 'top+20%' },
//				position:	{ my: 'top', at: 'top+10' },
				dialogClass:	'ui-dialog-style-1'
				,
				buttons: {
			        "Edit": function() {
			        	_edit_memo_execute(id, memo);
//			            $(this).dialog("close");
			        },
					"Close": function() {
						$(this).dialog("close");
					}
			    }
			}
	);

//	AutoCloseDialogBox(2000);
	
}

function
_edit_memo_execute(id, memo) {
	
	var memo = $("textarea#jquery_textarea").val();
//	var memo = $("textarea#jquery_textarea");
//	var memo = $("textarea#jquery_textarea").text();
	
//	alert("memo => " + memo);
	
	/***********************
		Prep: ajax
	 ***********************/
	//alert("Start Ajax");
	var hostname = window.location.hostname;
	
	var url;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/VM_Cake/positions/edit_memo";
		
	} else {
	
		url = "/VM_Cake/positions/edit_memo";
	
	}
	
	// video id
	var video_id = $("#video_id_hidden").val();
	
//	alert(
//		"url => " + url
//		+ "\n"
//		+ "memo => " + memo
//		);
	
	$.ajax({
		
	    url: url,
	    type: "GET",
//	    type: "POST",
	    //REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
	    data: {id: id, memo: memo, video_id: video_id},
	    
	    timeout: 10000
	    
	}).done(function(data, status, xhr) {
		
	//	alert(conv_Float_to_TimeLabel(data.point));
	//	addPosition_ToList(data.point);
		
//		_delete_position_Ajax__Done(data, status, xhr);
		_edit_memo_execute_Done(data, status, xhr);
		
	//	seek(data);
		
	}).fail(function(xhr, status, error) {
		
	//    $("#jqarea").append("xhr.status = " + xhr.status + "<br>");          // ��: 404
		alert(xhr.status);
	    
	});
	
}//edit_memo_execute()

$(function() {
	//REF http://iviewsource.com/codingtutorials/building-a-ui-slider-with-javascript-and-jquery-ui/
    $( "#div_slider" ).slider({
    		min: 0, 
    		max: 100, 
    		value: 100,
    		slide: function(event, ui) {
//    			alert(ui.value / 100);
//    			setVolume(ui.value / 100);
//    			setVolume(ui.value);
//    			$("#volume_val").text(volume.toString());
    			$("#volume_val").text(ui.value.toString());
    			
    			if (ytplayer) {
    				
    				ytplayer.setVolume(ui.value);
    				
    			}
    		}//slide: function(event, ui)
    	}
    
    );//$( "#div_slider" ).slider
    
//    $( "#div_slider" ).slider('option', 'value', 200);	// No image
//    $( "#div_slider" ).slider();
//    $(".ui-slider-range").css("width",300);
    var range = $( "#div_slider" ).slider( "option", "value" );
//    var range = $( ".selector" ).slider( "option", "range" );
//	    alert("range" => range);
    
  });
