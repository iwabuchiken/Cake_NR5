//function
//$(document).ready(function(){
//	
//	alert("ready: test_NVP.js");
//
//	
//})

// used: d3_alert
var col_State = 1;

//REF http://stackoverflow.com/questions/610406/javascript-equivalent-to-printf-string-format answered Nov 23 '10 at 12:41
String.prototype.format = function() {
    var formatted = this;
    for (var i = 0; i < arguments.length; i++) {
        var regexp = new RegExp('\\{'+i+'\\}', 'gi');
        formatted = formatted.replace(regexp, arguments[i]);
    }
    return formatted;
};

/***************************
	@param
	basic	=> "2015/03/30 12:46:19"
	serial	=> "20150330_124619"
	mill	=> "1427..."
 ***************************/
function 
get_DateLabel(type) {
	
	//REF http://www.tizag.com/javascriptT/javascriptdate.php
	var date = new Date();
	
	var y = date.getFullYear();	// XXXX
	var M = date.getMonth();
	var D = date.getDate();
	
	var h = date.getHours();
	var m = date.getMinutes();
	var s = date.getSeconds();
	
	/***************************
		build: string
	 ***************************/
	if (type == "basic") {
		
		var d = y + "/" + M + "/" + D;
		
		var t = h + ":" + m + ":" + s;
		
//		alert(d + " " + t);
		return (d + " " + t);
		
	} else if (type == "serial") {
		
		var d = "" + y + M + D;
		
		var t = "" + h + m + s;
		
		return (d + "_" + t);
		
	} else if (type == "mill") {
		
		return date.getTime();
		
	} else {

		var d = y + "/" + M + "/" + D;
		
		var t = h + ":" + m + ":" + s;
		
//		alert(d + " " + t);
		return (d + " " + t);

	}
	
//	var fullDate = new Date();
//	
////	alert(fullDate.getTime());
//	
//	//REF http://stackoverflow.com/questions/1531093/how-to-get-current-date-in-javascript/ answered Sep 29 '13 at 14:13
//	//REF className http://stackoverflow.com/questions/7468551/get-class-name-in-javascript answered Sep 19 '11 at 9:13
////	alert(new Date().className);	//=> undefined
////	alert(new Date());
////	alert(new Date().toJSON());		//=> XXXTYYYZ
////	alert(new Date().toJSON().slice(0,15));
////	alert(new Date().toJSON().className);	//=> undefined
//	
//	//REF https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/split?redirectlocale=en-US&redirectslug=JavaScript%2FReference%2FGlobal_Objects%2FString%2Fsplit
//	alert(new Date().toJSON().split("T")[1]);	//=> dddddZ
//	
////	alert(new Date().getTime().getTimezoneOffset());	//=> no display 
	
	
	
}//get_DateLabel

function

d3_alert(msg) {
	
//	var str = "{0}{1}".format("{1}", "{0}");
//	var str = "{0}{1}".format("abc", "def");	//=> abcdef
//	var str = "{0}{0}".format("abc", "def");	//=> abcabc
	
	//REF http://www.diveintojavascript.com/projects/javascript-sprintf
	var str = sprintf("%s %s", "aaa", "bbb");

	/***************************
		test: 4
	 ***************************/
	//REF http://bost.ocks.org/mike/bar/	<= https://github.com/mbostock/d3/wiki/Tutorials
	var div = document.createElement("div");
	
	alert("div => " + div.className);
	
	div.innerHTML = "Hello, world!";
	document.body.appendChild(div);
	
	
//	/***************************
//		test: 3		//=> n/w
//	 ***************************/
//	//REF http://d3js.org/
////	d3.select("body").selectAll("p")
//	d3.select("body").selectAll("span")
//			    .data([4, 8, 15, 16, 23, 42])
//			  .enter().append("p")
//			    .text(function(d) { return "I’m number " + d + "!"; });
//	
//	/***************************
//		test: 2
//	 ***************************/
//	d3.selectAll("p").style("color", "hsl(" + Math.random() * 360 + ",100%,50%)");	//=> w
	
//	d3.selectAll("p").style("color", function() {
//		return "hsl(" + Math.random() * 360 + ",100%,50%)";
//	});		//=> w
//	
//	alert(Math.random() * 360);
	
//	var f = function() {
//		  return "hsl(" + Math.random() * 360 + ",100%,50%)";
//	};
//	
//	alert(f);
	
//	alert(function() {
//		  return "hsl(" + Math.random() * 360 + ",100%,50%)";
//		});
	
//	//REF http://d3js.org/
//	var colName = "red";
//	
//	if (col_State == 1) {
//		
//		colName = "red";
//		
//		col_State *= -1;
//		
//	} else {
//		
//		colName = "green";
//		
//		col_State *= -1;
//		
//	}
//	
//	d3.selectAll("p").style("color", colName);	//=> w
//	d3.selectAll("p").style("color", "green");	//=> w
//	d3.selectAll("p").style("color", "white");	//=> working
	
//	alert(get_DateLabel("mill"));
//	alert(get_DateLabel("serial"));
//	alert(get_DateLabel("basic"));
	
//	alert(str);
//	alert(msg);
	
}//d3_alert