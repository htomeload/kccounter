<html>
	<head>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/font-awesome.min.css" />
		<link rel="stylesheet" href="css/jquery-ui.css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-ui.js"></script>
		<title id="head-title">12 time(s) remaining KanColle leveling round counter - Decreasing type</title>
	</head>
	<body style="font-size: 16px;">
		<h2 id="title" style="position: absolute; top: 20%; left: 50%; transform: translate(-50%, -50%); z-index: 3; color: white;">
			KanColle leveling round counter - Decreasing type
		</h2>
		<div id="container" style="position: relative; height: 100%; width: 100%; background: black; z-index: 1;">
			<div id="panel-wrap" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); border: 2px solid whitesmoke; border-radius: 6px; padding: 3rem; width: 52.6%; background: lightgrey;">
				<button class="btn btn-default" id="save" onclick="save();" style="display: inline-block; margin-right: 1rem; margin-bottom: 1rem;">
					<i class="fa fa-floppy-o" style="margin-right: 1rem;"></i>Save
				</button>
				<button class="btn btn-default" id="load" onclick="load();" style="display: inline-block; margin-right: 1rem; margin-bottom: 1rem;">
					<i class="fa fa-recycle" style="margin-right: 1rem;"></i>Load
				</button>
				<button class="btn btn-primary" id="reset" onclick="reset();" style="display: inline-block; margin-right: 1rem; margin-bottom: 1rem;">
					<i class="fa fa-refresh" style="margin-right: 1rem;"></i>Reset
				</button>
				<input type="number" id="input-counter" class="form-control" min="0" 
					   style="display: inline-block; margin-right: 1rem; margin-bottom: 1rem; width: initial; vertical-align: middle;" 
					   value="12" onchange="checkvalue(event);" onkeyup="checkvalue(event);" onblur="checknull(event);" />
				<button class="btn btn-success" id="minus" onclick="minus();" style="display: inline-block; margin-right: 1rem; margin-bottom: 1rem;">
					<i class="fa fa-minus" style="margin-right: 1rem;"></i>Minus
				</button>
				<button class="btn btn-warning" id="plus" onclick="plus();" style="display: inline-block; margin-bottom: 1rem;">
					<i class="fa fa-plus" style="margin-right: 1rem;"></i>Plus
				</button>
				<br />
				<div style="width: 100%; text-align: center;">
					<button class="btn btn-default" onclick="shiftmode();" id="shiftmode" style="margin: auto;">
						<i class="fa fa-moon-o" style="margin-right: 1rem;"></i>Night mode
					</button>
				</div>
			</div>
			<h3 id="message-outpost" style="position: absolute; top: 65%; left: 50%; transform: translate(-50%, -50%); z-index: 2;"></h3>
		</div>
		<div id="dialog"></div>
	</body>
</html>
<script>
$(document).on("ready", function(){
	var sb = $("#shiftmode");
	var c = $("#container");
	var pw = $("#panel-wrap");
	var t = $("#title");
	var mo = $("#message-outpost");
	var v = localStorage.getItem("bgmode");
	
	switch(v){
		case "normal": {
			sb.css("filter", "");
			c.css("background", "white");
			pw.css("background", "lightgrey");
			t.css("color", "black");
			mo.css("color", "black");
			localStorage.setItem("bgmode", "normal");
			break;
		}
		case "night": {
			sb.css("filter", "invert(100%)");
			c.css("background", "#263947");
			pw.css("background", "#68868E");
			t.css("color", "white");
			mo.css("color", "white");
			localStorage.setItem("bgmode", "night");
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
});

function change_title(counter){
	var ht = $("#head-title");
	var dh = "KanColle leveling round counter - Decreasing type";

	ht.html(counter+" time(s) remaining "+dh);
}
	
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
	
function checkvalue(event){
	var v = event.target.value;
	var ic = $("#input-counter");
	
	if (v < 0){
		ic.val(0);
	}
	change_title(ic.val());
}
	
function checknull(event){
	var v = event.target.value;
	var ic = $("#input-counter");
	
	if (v == '' || v == null){
		ic.val(0);
	}
	change_title(ic.val());
}
	
function save(){
	var ic = $("#input-counter");
	var mo = $("#message-outpost");
	
	var v = ic.val();
	
	localStorage.setItem("counter", v.toString());
	disabled();
	
	mo.fadeOut(1, function(){
		mo.html("Save!");
		mo.fadeIn(2000, function(){
			mo.fadeOut(2000, function(){
				enabled();
				mo.empty();
			});
		});
	});
}
	
function load(){
	var ic = $("#input-counter");
	var mo = $("#message-outpost");
	
	var v = parseInt(localStorage.getItem("counter"));

	if (!$.isNumeric(v)){
		v = 0;
	}
	
	ic.val(v);
	change_title(ic.val());
	disabled();
	
	mo.fadeOut(1, function(){
		mo.html("Loaded!");
		mo.fadeIn(2000, function(){
			mo.fadeOut(2000, function(){
				enabled();
				mo.empty();
			});
		});
	});
}
	
function reset(){
	var ic = $("#input-counter");
	var mo = $("#message-outpost");
	
	ic.val(12);
	change_title(ic.val());
	localStorage.setItem("counter", "12");
	disabled();
	
	mo.fadeOut(1, function(){
		mo.html("Reseted!");
		mo.fadeIn(2000, function(){
			mo.fadeOut(2000, function(){
				enabled();
				mo.empty();
			});
		});
	});
}
	
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
	
function plus(){
	var ic = $("#input-counter");
	var v = ic.val();
	
	ic.val(parseInt(v)+1);
	change_title(ic.val());
}
	
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
	
function disabled(){
	var s = $("#save");
	var l = $("#load");
	var r = $("#reset");
	var m = $("#minus");
	var p = $("#plus");
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
	ic.attr({
		"disabled": "disabled",
		"readonly": "readonly",
	});
}
	
function enabled(){
	var s = $("#save");
	var l = $("#load");
	var r = $("#reset");
	var m = $("#minus");
	var p = $("#plus");
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
	ic.attr({
		"disabled": false,
		"readonly": false,
	});
}
</script>