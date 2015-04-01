//function
//$(document).ready(function(){
//	
//	alert("ready: test_NVP.js");
//
//	
//})

// used: d3_alert
var col_State = 1;

var p;

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
d3_alert_OFF() {
	
//	/***************************
//		validate
//	 ***************************/
//	if (p == null) {
//		
//		alert("p is null");
//		
//	} else {
//		
////		alert("not null");
//		
//	}

	/***************************
		test: 7
	 ***************************/
	d3.select("body").transition()
		.duration(2000)
		.style("background-color", "blue");

//	/***************************
//		remove: p
//	 ***************************/
//	p.exit().remove();
//	
//	alert("removed");
	
}//d3_alert_OFF

function
d3_alert(msg) {
	
//	var str = "{0}{1}".format("{1}", "{0}");
//	var str = "{0}{1}".format("abc", "def");	//=> abcdef
//	var str = "{0}{0}".format("abc", "def");	//=> abcabc
	
	//REF http://www.diveintojavascript.com/projects/javascript-sprintf
	var str = sprintf("%s %s", "aaa", "bbb");

//	/***************************
//		test: 8			//=> n/w
//	 ***************************/
//	d3.selectAll("circle").transition()
//		    .duration(750)
//		    .delay(function(d, i) { return i * 10; })
//		    .attr("r", function(d) { return Math.sqrt(d * scale); });
	
	/***************************
		test: 7
	 ***************************/
	d3.select("body").transition()
		.duration(2000)
    	.style("background-color", "black");
	
//	/***************************
//		test: 6
//	 ***************************/
////	var p = d3.select("body").selectAll("p")
//	p = d3.select("body").selectAll("p")
//			    .data([4, 8, 15, 16, 23, 42])
//			    .text(String);
//	
//	var tmp = p.enter().append("p")
//    			.text(String);
//	
//	alert(tmp.length);		//=> 1
////	alert(tmp);
	
//	alert(p.enter().append("p")
//    			.text(String));
	
//	alert(p.className);
	
//	/***************************
//		test: 5
//	 ***************************/
//	d3.select("body").selectAll("p")
//		    .data([4, 8, 15, 16, 23, 42])
//		  .enter().append("p")
//		    .text(function(d) { return sprintf("%s %s", get_DateLabel("basic"), "bbb") + " " + d + "!"; });
////	.text(function(d) { return "I’m number " + d + "!"; });
	
//	/***************************
//		test: 4
//	 ***************************/
//	//REF http://bost.ocks.org/mike/bar/	<= https://github.com/mbostock/d3/wiki/Tutorials
//	var div = document.createElement("div");
//	
//	alert("div => " + div.className);
//	
//	div.innerHTML = "Hello, world!";
//	document.body.appendChild(div);
	
	
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

function
d3_Bar_OFF() {
	
	/***************************
		test: 2
	 ***************************/
	d3.selectAll("td")
		  .remove();
//	.remove("div");			//=> td tags --> removed
	
	
}//d3_Bar_OFF

function
d3_Bar() {

	/***************************
		test: 6
	 ***************************/
	var data = [4, 8, 15, 16, 23, 42];

	d3.select(".chart2")
			.selectAll("div")
			.data(data)
			.enter().append("div")
			.style("width", function(d) { return d * 10 + "px"; })
			.text(function(d) { return d; });

	var x = d3.scale.linear()
			    .domain([0, d3.max(data)])
			    .range([0, 210]);
//	.range([0, 420]);
	
//	alert("d3.max(data) => " + d3.max(data));
	
	d3.select(".chart")
		  .selectAll("div")
		    .data(data)
		  .enter().append("div")
		    .style("width", function(d) { return x(Math.random() * d) + "px"; })
//		    .style("width", function(d) { return x(d) + "px"; })
		    .text(function(d) { return d; });
	
//	/***************************
//		test: 5
//	 ***************************/
//	var data = [4, 8, 15, 16, 23, 42];
//	
//	d3.select(".chart")
//	.selectAll("div")
//	.data(data)
//	.enter().append("div")
//	.style("width", function(d) { return d * 10 + "px"; })
//	.text(function(d) { return d; });
//	
//	/***************************
//		test: 4
//	 ***************************/
//	var obj = d3.select(".chart")
//				  .selectAll("div")
//				    .data(data);
//	
//	alert(obj.className);
	
//	d3.select(".chart")
//	  .selectAll("div")
//	    .data(data)
//	  .enter().append("div")
//	    .style("width", function(d) { return d * 10 + "px"; })
//	    .text(function(d) { return d; });
	
//	/***************************
//		test: 3
//	 ***************************/
////	var section = d3.selectAll(".chart");	//=> n/w
////	var section = d3.select("body").selectAll("div.chart");	//=> n/w
////	var section = d3.select("body").selectAll("div.chart div");	//=> w
////	var section = d3.selectAll("div.chart div");	//=> w
////	var section = d3.selectAll(".chart div");		//=> w
//	var section = d3.selectAll(".chart div");		//=> 
////	var section = d3.selectAll(".chart");
//	
//	section.style("color", "black");
	
//	/***************************
//		test: 2
//	 ***************************/
////	d3.selectAll("section")
////	d3.selectAll("abc")
////	d3.selectAll("div")		//=> w
////	d3.selectAll("td")		//=> w
//	var section = d3.selectAll("td");
//	
////	    .attr("class", "special")
//	section.append("div")
////	  .append("div")
//	    .html("Hello, div!");
	
//	/***************************
//		test: 1
//	 ***************************/
//	//REF http://bost.ocks.org/mike/bar/
//	var body = d3.select("body");
//	var div = body.append("div");
//	div.html("Hello, world!");
//
//	d3.select("body")
//	    .style("color", "black")
//	    .style("background-color", "white");
	
	
}

function
get_MaxElement(data) {
	
	//REF http://stackoverflow.com/questions/307179/what-is-javascripts-highest-integer-value-that-a-number-can-go-to-without-losin Aug 21 '14 at 17:59
	var tmp = -1 * Number.MAX_SAFE_INTEGER;

//	alert("tmp=" + tmp);
	
	var len = data.length;
	
//	alert("len=" + len);
	
	for (var i = 0; i < len; i++) {
		
		if (tmp < data[i]) {
			
			tmp = data[i];
			
		}
		
	}
	
	return tmp;
	
//	alert(tmp);
	
}

function
d3_Bar_2__Adjust(data, max) {
	
//	alert("max=" + max);
	
	var max_Elem = get_MaxElement(data);
	
	alert("max elem=" + max_Elem);
	
	var len = data.length;
	
	var data_New = new Array(len);
	
	alert(max_Elem.toFixed(2));
	
	alert(data[1] / max_Elem.toFixed(2));
	
	for (var i = 0; i < len; i++) {
		
		//REF toFixed http://stackoverflow.com/questions/4057489/javascript-convert-int-to-float answered Oct 30 '10 at 6:12
		//REF parseInt() https://www.hscripts.com/tutorials/javascript/type-conversions.php
		data_New[i] = parseInt(data[i] / max_Elem.toFixed(2) * max);
//		data_New[i] = data[i];
		
	}
	
	return data_New;
	
}

function
d3_Bar_2(data) {

	
////	alert(Number.MINIMUM_SAFE_INTEGER);
//	alert(Number.MAX_SAFE_INTEGER + " / " + (Math.pow(2,32) - 1)
//			 + " / " + (Math.pow(2,64) - 1)
//	 );
	
//	alert(data[i]);
	
	/***************************
		test: 6
	 ***************************/
//	var data = [4, 8, 15, 16, 23, 42];
	
	var max = 600;
	
	var max_elem = get_MaxElement(data);
	
//	data = d3_Bar_2__Adjust(data, max);
	
	d3.select(".chart2")
		.selectAll("div")
		.data(data)
		.enter().append("div")
		.style("width", function(d) { return parseInt(max * d / max_elem) + "px"; })
//		.style("width", function(d) { return d * 10 + "px"; })
//		.text(function(d) { return parseInt(max * d / max_elem); });
	.text(function(d) { return d; });
	
	var x = d3.scale.linear()
		.domain([0, d3.max(data)])
		.range([0, 210]);
//	.range([0, 420]);
	
//	alert("d3.max(data) => " + d3.max(data));
	
	d3.select(".chart")
		.selectAll("div")
		.data(data)
		.enter().append("div")
		.style("width", function(d) { return x(Math.random() * d) + "px"; })
	//		    .style("width", function(d) { return x(d) + "px"; })
		.text(function(d) { return d; });
	
}//d3_Bar_2


function
d3_Circle() {

	/***************************
		test: 5
	 ***************************/
	//REF http://bost.ocks.org/mike/circles/
	var svg = d3.select("svg");
	
	var circle = svg.selectAll("circle")
	    .data([32, 57])
	    ;	
	
	circle.exit().remove();
	
	circle.attr("cx", function(d, i) { return i * 100 + 30; });
	
//	/***************************
//		test: 5
//	 ***************************/
//	//REF http://bost.ocks.org/mike/circles/
//	var svg = d3.select("svg");
//	
//	svg.selectAll("circle")
//	.data([32, 57, 112, 293])
//	.enter().append("circle")
//	.attr("cy", 60)
//	.attr("cx", function(d, i) { return i * 100 + 30; })
//	.attr("r", function(d) { return Math.sqrt(d); })
//	.style("fill", function(d) { return "hsl(" + Math.random() * d + ",100%,50%)"; })
//	;	
	
//	/***************************
//		test: 4
//	 ***************************/
//	//REF http://bost.ocks.org/mike/circles/
//	var svg = d3.select("svg");
//	
//	var circle = svg.selectAll("circle")
//	.data([32, 57, 112, 293]);
//	
//	var circleEnter = circle.enter().append("circle");
//	
//	circleEnter.attr("r", function(d) { return Math.sqrt(d); });
//	
//	circleEnter.attr("cx", function(d, i) { return i * 100 + 30; });
//	circleEnter.attr("cy", 60);
//	circleEnter.style("fill", function(d) { return "hsl(" + Math.random() * d + ",100%,50%)"; });
//	
//	/***************************
//		test: 3
//	 ***************************/
//	//REF http://bost.ocks.org/mike/circles/
//	var circle = d3.selectAll("circle");
//	
//	circle.data([32, 57, 112]);
//	
//	circle.attr("r", function(d) { return Math.sqrt(d); });
//	
//	circle.style("fill", function(d) { return "hsl(" + Math.random() * d + ",100%,50%)"; });
//	
//	circle.attr("cx", function(d, i) { return i * 100 + 30; });
	
//	/***************************
//		test: 2
//	 ***************************/
//	//REF http://bost.ocks.org/mike/circles/
//	var circle = d3.selectAll("circle");
//	
//	circle.data([32, 57, 112]);
//	
////	alert("data => bound");
//	
//	circle.attr("r", function(d) { return Math.sqrt(d); });
//	
//	circle.style("fill", function(d) { return "hsl(" + Math.random() * d + ",100%,50%)"; });

//	for (var int = 0; int < 5; int++) {
		
//		setTimeout(d3_Circle_exe(), 1000);
		
//	}
	
//	//REF http://stackoverflow.com/questions/7854820/sleep-pause-wait-in-javascript answered Oct 21 '11 at 20:19
////	setTimeout(function(){alert("hi")}, 1000);	//=> w
//	setTimeout(function(){}, 1000);
//
//	alert("1000");
	
//	window.setTimeout(partB,1000);
//	
//	alert("1000");
	
//	/***************************
//		test: 1
//	 ***************************/
//	//REF http://bost.ocks.org/mike/circles/
//	var circle = d3.selectAll("circle");	
//
//	circle.style("fill", "hsl(" + Math.random() * 360 + ",100%,50%)");
////	circle.style("fill", "steelblue");
////	circle.attr("r", 30);	//=> w
//	circle.attr("cx", function() { return Math.random() * 720; });
//	circle.attr("r", function() { return Math.random() * 50; });
////	circle.style("color", "hsl(" + Math.random() * 360 + ",100%,50%)");
	
	//REF length http://stackoverflow.com/questions/14202601/array-size-vs-array-length
//	alert(circle + "(" + circle.length + ")");
	
}//d3_Circle

function
d3_Circle_exe() {
	
	/***************************
		test: 2
	 ***************************/
	//REF http://bost.ocks.org/mike/circles/
	var circle = d3.selectAll("circle");
	
//	circle.data([32, 57, 112]);
	circle.data([100, 50, 70]);
	
//	alert("data => bound");
	
	circle.attr("r", function(d) { return Math.sqrt(d); });
	
	circle.style("fill", function(d) { return "hsl(" + Math.random() * d + ",100%,50%)"; });
	
}//d3_Circle_exe

function
get_JSON_Data() {
	
	/***************************
		prep
	 ***************************/
	var hostname = window.location.hostname;
	
	var url;
	
	if (hostname == "benfranklin.chips.jp") {
		
		url = "/cake_apps/Cake_NR5/Tokens/get_JSON_Data";
		
	} else {
	
		url = "/Cake_NR5/Tokens/get_JSON_Data";
	
	}
	
//	alert(url);
	
	$.ajax({
		
	    url: url,
	    type: "GET",
	    //REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
//	    data: {id: id},
	    
	    timeout: 10000
	    
	}).done(function(data, status, xhr) {

//		alert(data);
		
		var json = $.parseJSON(data);

		var msg = "";

		var count = 0;
		
		$.each(json, function(i, obj) { count ++; });
		
//		alert("count => " + count);
		
		//REF array http://stackoverflow.com/questions/4852017/proper-way-to-initialize-an-arrays-length-in-javascript answered Jan 31 '11 at 14:32
		var ary = new Array(count);
		
//		alert(ary);
		
		count = 0;
		
		var keys = "";
		
		$.each(json, function(key, value){		//=> w
		//	$.each(json[0], function(key, value){	//=> n/w
		
			ary[count] = value;
			
			count ++;
//					msg += "(" + key + "/" + value + ")";
		//    			console.log(key, value);
			
			keys += key + "/";
			
		});
		
//		alert(ary);

		d3_Bar_2(ary);	//=> 
		
		//debug
		$('#message').text(keys);
		
		
//		$.each(json, function(i, obj) { });	//=> no response
//		$.each(myJsonObject.Apps, function(i, obj) { });
		
//		alert(obj.Groups.length;);
		
//		alert(json.length);	//=> undefined
//		alert(json);		//=> [object Object]
		
		//REF http://stackoverflow.com/questions/7073837/how-to-get-json-key-and-value answered Aug 16 '11 at 5:33
//		$.each(json, function(key, value){		//=> w
////			$.each(json[0], function(key, value){	//=> n/w
//			
//					msg += "(" + key + "/" + value + ")";
////		    			console.log(key, value);
//		});
//		
//		alert(msg);
		
//		var data = [json.a, json.b, json.c];
		
//		alert(data);
		
//		d3_Bar_2(data);	//=> w
		
//		d3_Bar();		//=> w

		//REF http://api.jquery.com/jQuery.parseJSON/
//		alert(json.a);	//=> "10"
//		alert(json.1);	//=> non response
		
//		alert(json."1");	//=> non response
		
//		alert(data.items);	//=> undefined
		
//		//REF http://www.jquery4u.com/demos/ajax/ "jQuery.getJSON() Example"
//		alert(JSON.stringify(data));	//=> w
//		alert(json.html);	//=> undefined
//		alert(json);	//=> [object Object]
//		alert(data);
		
	}).fail(function(xhr, status, error) {
		
		alert(xhr.status);
		
	});
	
}//get_JSON_Data

function
d3_Pie() {
	
	var vis = d3.select("#svg_donut");
	var arc = d3.svg.arc() 
				.innerRadius(50)
				.outerRadius(100)
				.startAngle(Math.random() * 2.0 * Math.PI)
//				.startAngle(Math.random() * 1.0 * Math.PI)
				.endAngle(Math.random() * 2.0 * Math.PI);
//	.startAngle(0)
//	.endAngle(1.0*Math.PI);
//	.endAngle(1.5*Math.PI);

//	var hsl = "hsl(" 
//				+ Math.random() * 360 
//				+ "," 
//				+ Math.random() * 360 
//				+ "," 
//				+ Math.random() * 100
//				+ "%"
//				+ ")";
//	+ Math.random() * 360 
//	+ ")";				
				//=> n/w --> color remains black
	
	var hsl = "hsl(" + Math.random() * 360 + ",100%,50%)";
	
//	alert("hsl=" + hsl);

	//REF http://stackoverflow.com/questions/11257015/how-to-give-hsl-color-value-to-an-svg-element answered Jun 29 '12 at 6:48
	var color = "hsl("+[0,0,0].map(function(){   return Math.round(100*Math.random())+"%"; }).join(',')+")";
	
//	alert(color);
	
	var hsl_2 = "hsl(" + Math.round(Math.random() * 100) + "%" + ",100%,50%)";
//	var hsl_2 = "hsl(" + Math.random() * 100 + "%" + ",100%,50%)";
	
//	alert(hsl_2);
	
	vis.append("path")
		.attr("d", arc)
//		.attr("transform", "translate(300,400)");
	.attr("transform", "translate(300,200)")
	
//	.attr("fill", hsl_2)	//=> black
//	.attr("fill", "hsl(" + Math.random() * 100 + "%" + ",100%,50%)")	//=> black
//	.attr("fill", "hsl("+[0,0,0].map(function(){   return Math.round(100*Math.random())+"%"; }).join(',')+")")	//=> color is black
//	.attr("fill", color)	//=> color is black
	.attr("fill", hsl)
//	.attr("fill", "hsl(" + Math.random() * 360 + ","  + Math.random() * 360 + ",50%)")	//=> n/w
//	.attr("fill", "hsl(" + Math.random() * 360 + ",100%,50%)")
//	.attr("fill", "green")
	;
	
}//d3_Pie
