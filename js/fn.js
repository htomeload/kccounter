// ================================ GUI FUNCTIONS GROUP. ================================

// Make #main-console be collapsed or expanded.
function consoleCollapser(){
	var mc = $("#main-console");

	if (mc.attr("class") == "collapse in"){
		setTimeout(function(){
			mc.attr("class", "collapse");
		}, 10);
	}else{
		setTimeout(function(){
			mc.attr("class", "collapse in");
		}, 10);
	}
}

// Central for inject message to display.
function messager(msg, timeIn = 2000, timeOut = 2000){
    var mo = $("#message-outpost");

	mo.fadeOut(1, function(){
		mo.html(msg);
		mo.fadeIn(timeIn, function(){
			mo.fadeOut(timeOut, function(){
				enabled();
				mo.empty();
			});
		});
	});
}

// Change title in head tag, response to changing counter.
function change_title(counter){
	var ht = $("#head-title");
	var to = $("#times-outpost");
	var dh = "KanColle leveling round counter - Decreasing type";

	ht.html(counter+" time(s) remaining "+dh);
	to.html(counter);
}

// Switch mode between normal and night.
function shiftmode() {
	var sb = $("#shiftmode");
	var c = $("#container");
	var pw = $("#panel-wrap");
	var t = $("#title");
	var mo = $("#message-outpost");
	var v = localStorage.getItem("bgmode");
	
	switch(v){
		case "normal": {
			sb.css("filter", "invert(100%)");
			c.css("background", "#263947");
			pw.css("background", "#68868E");
			t.css("color", "white");
			mo.css("color", "white");
			localStorage.setItem("bgmode", "night");
			break;
		}
		case "night": {
			sb.css("filter", "");
			c.css("background", "white");
			pw.css("background", "lightgrey");
			t.css("color", "black");
			mo.css("color", "black");
			localStorage.setItem("bgmode", "normal");
			break;
		}
		default: {
			sb.css("filter", "");
			c.css("background", "white");
			pw.css("background", "lightgrey");
			t.css("color", "black");
			localStorage.setItem("bgmode", "normal");
			break;
		}
	}
}	

// Display popup when counter reach to zero.
function askreset(){
	var d = $("#dialog");
	
	d.attr("title", "Counter reseting");
	d.html("Counter reached to zero now, Wanna reset counter to default ?");
	
	d.dialog({
		resizable: false,
		height: "auto",
		width: "auto",
		modal: true,
		buttons: {
			"Yes": function() {
				reset();
				$( this ).dialog( "close" );
			},
			"No": function() {
				$( this ).dialog( "close" );
			}
		}
	});
}

// ================================ BACKBORE FUNCTIONS GROUP. ================================

// Check for invalid from input value.
function checkvalue(event){
	var v = event.target.value;
	var ic = $("#input-counter");
	
	if (v < 0){
		ic.val(0);
	}
	change_title(ic.val());
}

// Check for null from input value.
function checknull(event){
	var v = event.target.value;
	var ic = $("#input-counter");
	
	if (v == '' || v == null){
		ic.val(0);
	}
	change_title(ic.val());
}

// Save counter Function.
function save(){
	var ic = $("#input-counter");
	
	var v = ic.val();
	
	localStorage.setItem("counter", v.toString());
	disabled();
	messager("Save!");
}

// Load counter Function.
function load(){
	var ic = $("#input-counter");
	
	var v = parseInt(localStorage.getItem("counter"));

	if (!$.isNumeric(v)){
		v = 0;
	}
	
	ic.val(v);
	change_title(ic.val());
	disabled();
	messager("Loaded!");
}

// Reset counter to default Function.
function reset(){
	var ic = $("#input-counter");
	var dc = parseInt(localStorage.getItem("defcount"));
	
	ic.val(dc);
	change_title(ic.val());
	localStorage.setItem("counter", dc.toString());
	disabled();
	messager("Resetted!");
}

// Decreasing counter by 1.
function minus(){
	var ic = $("#input-counter");
	var v = ic.val();
	
	if (v-1 > 0){
		ic.val(v-1);
	}else{
		askreset();
		ic.val(0);
	}
	change_title(ic.val());	
}

// Increasing counter by 1.
function plus(){
	var ic = $("#input-counter");
	var v = ic.val();
	
	ic.val(parseInt(v)+1);
	change_title(ic.val());
}

// Decreasing default counter by 1.
function defcountminus(){
	var dc = parseInt(localStorage.getItem("defcount"));
	var dco = $("#defcount-outpost");

	if (dc > 1){
		localStorage.setItem("defcount", (dc-1).toString());
		dco.html(dc-1);
	}else{
		disabled();
		messager("Minimum counter is 1.");
	}
}

// Increasing default counter by 1.
function defcountplus(){
	var dc = parseInt(localStorage.getItem("defcount"));
	var dco = $("#defcount-outpost");

	localStorage.setItem("defcount", dc+1);
	dco.html(dc+1);
}

// ================================ ENABLE AND DISABLE FUNCTIONS GROUP. ================================

// Make things be disabled, response to caller.
function disabled(){
	var s = $("#save");
	var l = $("#load");
	var r = $("#reset");
	var m = $("#minus");
	var p = $("#plus");
	var dcm = $("#defcountminus");
	var dcp = $("#defcountplus");
	var ic = $("#input-counter");
	
	s.attr({
		"onclick": "",
		"class": s.attr("class")+" disabled",
	});
	l.attr({
		"onclick": "",
		"class": l.attr("class")+" disabled",
	});
	r.attr({
		"onclick": "",
		"class": r.attr("class")+" disabled",
	});
	m.attr({
		"onclick": "",
		"class": m.attr("class")+" disabled",
	});
	p.attr({
		"onclick": "",
		"class": p.attr("class")+" disabled",
	});
	dcm.attr({
		"onclick": "",
		"class": dcm.attr("class")+" disabled",
	});
	dcp.attr({
		"onclick": "",
		"class": dcp.attr("class")+" disabled",
	});
	ic.attr({
		"disabled": "disabled",
		"readonly": "readonly",
	});
}

// Make things be enabled, response to caller.
function enabled(){
	var s = $("#save");
	var l = $("#load");
	var r = $("#reset");
	var m = $("#minus");
	var p = $("#plus");
	var dcm = $("#defcountminus");
	var dcp = $("#defcountplus");
	var ic = $("#input-counter");
	
	s.attr({
		"onclick": "save();",
		"class": "btn btn-default",
	});
	l.attr({
		"onclick": "load();",
		"class": "btn btn-default",
	});
	r.attr({
		"onclick": "reset();",
		"class": "btn btn-primary",
	});
	m.attr({
		"onclick": "minus();",
		"class": "btn btn-warning",
	});
	p.attr({
		"onclick": "plus();",
		"class": "btn btn-success",
	});
	dcm.attr({
		"onclick": "defcountminus();",
		"class": "btn btn-warning",
	});
	dcp.attr({
		"onclick": "defcountplus();",
		"class": "btn btn-success",
	});
	ic.attr({
		"disabled": false,
		"readonly": false,
	});
}