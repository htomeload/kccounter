<html>
	<head>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/font-awesome.min.css" />
		<link rel="stylesheet" href="css/jquery-ui.css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-ui.js"></script>
		<title>KanColle leveling round counter - Decreasing type</title>
	</head>
	<body style="font-size: 16px;">
		<h2 style="position: absolute; top: 25%; left: 50%; transform: translate(-50%, -50%);">KanColle leveling round counter - Decreasing type</h2>
		<div style="position: relative; height: 100%; width: 100%;">
			<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); border: 2px solid whitesmoke; border-radius: 6px; padding: 3rem; width: 52.6%;">
				<button class="btn btn-default" id="save" onclick="save();" style="display: inline-block; margin-right: 1rem;">
					<i class="fa fa-floppy-o" style="margin-right: 1rem;"></i>Save
				</button>
				<button class="btn btn-default" id="load" onclick="load();" style="display: inline-block; margin-right: 1rem;">
					<i class="fa fa-recycle" style="margin-right: 1rem;"></i>Load
				</button>
				<button class="btn btn-primary" id="reset" onclick="reset();" style="display: inline-block; margin-right: 1rem;">
					<i class="fa fa-refresh" style="margin-right: 1rem;"></i>Reset
				</button>
				<input type="number" id="input-counter" class="form-control" style="display: inline-block; margin-right: 1rem; width: initial;" value="12" />
				<button class="btn btn-success" onclick="minus();" style="display: inline-block; margin-right: 1rem;">
					<i class="fa fa-minus" style="margin-right: 1rem;"></i>Minus
				</button>
				<button class="btn btn-warning" onclick="plus();" style="display: inline-block;">
					<i class="fa fa-plus" style="margin-right: 1rem;"></i>Plus
				</button>
			</div>
			<h3 id="message-outpost" style="position: absolute; top: 60%; left: 50%; transform: translate(-50%, -50%);"></h3>
		</div>
		<div id="dialog"></div>
	</body>
</html>
<script>
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
	
	ic.val(v);
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
}
	
function plus(){
	var ic = $("#input-counter");
	var v = ic.val();
	
	ic.val(parseInt(v)+1);
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
}
	
function enabled(){
	var s = $("#save");
	var l = $("#load");
	var r = $("#reset");
	
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
}
</script>