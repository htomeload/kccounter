<html>
	<head>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/font-awesome.min.css" />
		<link rel="stylesheet" href="css/jquery-ui.css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-ui.js"></script>
		<script src="js/fn.js"></script>
		<title id="head-title">12 time(s) remaining KanColle leveling round counter - Decreasing type</title>
	</head>
	<body style="font-size: 16px;">
		<h2 id="title" style="position: absolute; top: 20%; left: 50%; transform: translate(-50%, -50%); z-index: 3; color: white;">
			KanColle leveling round counter - Decreasing type
			<br />
			<div style="margin-top: 2rem; text-align: center;">
				<div id="times-outpost" style="margin-right: 1rem; display: inline-block;"></div>
				time(s) remaining
			</div>
		</h2>
		<div id="container" style="position: relative; height: 100%; width: 100%; background: black; z-index: 1;">
			<div id="panel-wrap" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); border: 2px solid whitesmoke; border-radius: 6px; padding: 3rem; width: 52.6%; background: lightgrey;">
				<div id="main-console"  class="collapse in">
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
						value="" onchange="checkvalue(event);" onkeyup="checkvalue(event);" onblur="checknull(event);" />
					<button class="btn btn-success" id="minus" onclick="minus();" style="display: inline-block; margin-right: 1rem; margin-bottom: 1rem;">
						<i class="fa fa-minus" style="margin-right: 1rem;"></i>Minus
					</button>
					<button class="btn btn-warning" id="plus" onclick="plus();" style="display: inline-block; margin-bottom: 1rem;">
						<i class="fa fa-plus" style="margin-right: 1rem;"></i>Plus
					</button>
					<br />
					<div style="width: 100%; text-align: center; margin-top: 1rem;">
						<button class="btn btn-default" onclick="shiftmode();" id="shiftmode" style="margin: auto;">
							<i class="fa fa-moon-o" style="margin-right: 1rem;"></i>Night mode
						</button>
					</div>
				</div>
				<div style="width: 100%; text-align: center; cursor: pointer;" data-toggle="collapse" data-target="#defcount" onclick="consoleCollapser();">
					<div style="width: 80%; height: 3px; margin-left: auto; margin-right: auto; margin-top: 2.5rem; margin-bottom: 0.1rem; background-color: white;"></div>
					<i class="fa fa-sort-desc" aria-hidden="true" style="margin: auto; font-size: 3rem;"></i>
				</div>
				<div id="defcount" class="collapse" style="width: 100%; margin-top: 1.5rem;">
					<div style="width: 100%; text-align: center; padding: 0.5rem;">
						<div style="margin: auto;">
							<button class="btn btn-success" id="defcountminus" onclick="defcountminus();" style="display: inline-block; margin-right: 1rem; margin-bottom: 1rem;">
								<i class="fa fa-minus" style="margin-right: 1rem;"></i>Minus
							</button>
							<div id="defcount-outpost" style="display: inline-block; width: 5%; text-align: center; margin-right: 1rem; margin-bottom: 1rem;"></div>
							<button class="btn btn-warning" id="defcountplus" onclick="defcountplus();" style="display: inline-block; margin-bottom: 1rem;">
								<i class="fa fa-plus" style="margin-right: 1rem;"></i>Plus
							</button>
						</div>
					</div>
				</div>
			</div>
			<h3 id="message-outpost" style="position: absolute; top: 70%; left: 50%; transform: translate(-50%, -50%); z-index: 2;"></h3>
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
	var ic = $("#input-counter");
	var mo = $("#message-outpost");
	var v = localStorage.getItem("bgmode");
	var dco = $("#defcount-outpost");
	var dcv = localStorage.getItem("defcount");

	if (typeof dcv == "undefined" || dcv == null || !dcv){
		localStorage.setItem("defcount", "12");
		dco.html(12);
	}else{
		dco.html(dcv);
		ic.val(dcv);
		change_title(dcv);
	}
	
	switch(v){
		case "normal": {
			sb.css("filter", "");
			c.css("background", "white");
			pw.css("background", "lightgrey");
			t.css("color", "black");
			mo.css("color", "black");
			dco.css("color", "black");
			localStorage.setItem("bgmode", "normal");
			break;
		}
		case "night": {
			sb.css("filter", "invert(100%)");
			c.css("background", "#263947");
			pw.css("background", "#68868E");
			t.css("color", "white");
			mo.css("color", "white");
			dco.css("color", "white");
			localStorage.setItem("bgmode", "night");
			break;
		}
		default: {
			sb.css("filter", "");
			c.css("background", "white");
			pw.css("background", "lightgrey");
			t.css("color", "black");
			dco.css("color", "black");
			localStorage.setItem("bgmode", "normal");
			break;
		}
	}
});
</script>