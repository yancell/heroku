<!DOCTYPE html>
<html lang="en" style="-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;">
	<head>
	    <title></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, viewport-fit=cover">
	</head>
	<body>
	    <p>BONUS: <span id="total">0</span> | LOAD: <span id="load">0</span></p>
		<form onsubmit="ok(); return false;">
			<label>Username</label>
			<input tyoe="text" name="user">
			<label>Password</label>
			<input tyoe="text" name="password">
			<label>Type</label>
			<select name="type" onchange="change(this);" >
				<option value="reload">RELOAD</option>
				<option value="reloadinject">RELOAD INJECT</option>
				<option value="reloadw">RELOAD W</option>
				<option value="logininject">LOGIN INJECT</option>
				<option value="autoinject">AUTO INJECT</option>
				<option value="manualinject">MANUAL INJECT</option>
				<option value="next">NEXT</option>
				<option value="update">UPDATE</option>
				<option value="stop">STOP</option>
			</select>
			<label>Value</label>
			<select name="val[]" multiple>
				<option value="500000" selected>500000</option>
				<option value="250000">250000</option>
				<option value="175000">175000</option>
				<option value="50000">50000</option>
				<option value="25000">25000</option>
				<option value="15000">15000</option>
				<option value="10000">10000</option>
				<option value="5000">5000</option>
			</select>
			<input type="submit" value="START">
		</form>
		<div class="price0" data="0">0 = 0x</div>
		<div class="price5000" data="0">5000 = 0x</div>
		<div class="price10000" data="0">10000 = 0x</div>
		<div class="price15000" data="0">15000 = 0x</div>
		<div class="price25000" data="0">25000 = 0x</div>
		<div class="price50000" data="0">50000 = 0x</div>
		<div class="price175000" data="0">175000 = 0x</div>
		<div class="price250000" data="0">250000 = 0x</div>
		<div class="price500000" data="0">500000 = 0x</div>
		<div id="data"></div>
		<script src="js/jquery-3.6.0.min.js"></script>
		<script src="js/decode.js"></script>
		<script>
		    sessionInterval = "";
		    accept = "";
		    signin = "";
		    refresh = "";
			function ok(){
				var start = $('input[type="submit"]').val();
				var type = $('select[name="type"]').val();
				$("title").html($('input[name="user"]').val());
				if (start == 'STOP'){
					$('input[type="submit"]').attr('value', 'START');
				    $('select[name="type"]').removeAttr("disabled");
				    $('input[name="user"]').removeAttr("disabled");
				    if (type == "update"){
		                clearInterval(sessionInterval);
				    }
					return;
				}
				$('input[type="submit"]').attr('value', 'STOP');
				$('select[name="type"]').attr("disabled", true);
				$('input[name="user"]').attr("disabled", true);
				if (type == "next"){
				    get();
				    return;
				}
				if (type == "autoinject" || type == "manualinject"){
				    inject();
				    return;
				}
				if (type == "update"){
				    update();
				    return;
				}
                login();
			}
			function change(obj){
				var a = $(obj);
				var b = a.find(":selected").val();
				var html ="";
				if (b == "autoinject"){
				    if (accept) html = '<option value="'+accept+'">'+accept+'</option>';
				    $('select[name="val[]"]').html(html);
				    return;
				}
				["500000", "250000", "175000", "50000", "25000", "15000", "10000", "5000"].forEach(function(v){
				    html += '<option value="'+v+'">'+v+'</option>';
				});
				$('select[name="val[]"]').html(html);
			}
			function login(){
				var user = $('input[name="user"]').val();
				var password = $('input[name="password"]').val();
				var urlParams = new URLSearchParams(window.location.search);
				var type = $('select[name="type"]').val();
				$.ajax({
					type: "POST",
					url: 'login.php',
                    data: {
						user: user,
						password: password,
						c: urlParams.get("c"),
						d: urlParams.get("d")
					},
					success: function(data){
					    console.log(data);
					    if (data == "ERROR"){
						    $('input[type="submit"]').attr('value', 'START');
				            $('select[name="type"]').removeAttr("disabled");
				            $('input[name="user"]').removeAttr("disabled");
				            return;
					    }
					    signin = data;
					    get();
					},
					error: function(){
					    $('input[type="submit"]').attr('value', 'START');
			            $('select[name="type"]').removeAttr("disabled");
				        $('input[name="user"]').removeAttr("disabled");
					}
				});
			}
			function get(){
				var user = $('input[name="user"]').val();
				var action = $('select[name="val[]"]').val();
				var urlParams = new URLSearchParams(window.location.search);
				var start = $('input[type="submit"]').val();
				var type = $('select[name="type"]').val();
				if (start == "START"){
				    return;
				}
				$.ajax({
					type: "POST",
					url: (signin ? "get.php" : "display.php"),
                    data: {
						user: user,
						val: action,
						c: urlParams.get("c"),
						d: urlParams.get("d"),
						e: signin
					},
					success: function(data){
					    console.log(data);
					    if (data == "ERROR"){
						    $('input[type="submit"]').attr('value', 'START');
				            $('select[name="type"]').removeAttr("disabled");
				            $('input[name="user"]').removeAttr("disabled");
				            return;
					    }
					    var parse = JSON.parse(data);
                        _aProbability = new Array();
                        clinkclank = parse.result;
                        _initProbability();
                        setTimeout(function(){
                            var xxo =  Math.floor(Math.random()*_aProbability.length);
                            var iPrizeToChoose = Math.floor(xxo);        
                            var _iCurWin = _aProbability[iPrizeToChoose];
    						var vl = $(".price" + parse.value[_iCurWin]).attr("data");
    						var price = parseInt(vl);
    						var pr = price + 1;
    						$(".price" + parse.value[_iCurWin]).attr("data", pr);
    						$(".price" + parse.value[_iCurWin]).html(parse.value[_iCurWin] + " = " + pr + "x");
    						$('#total').html(parse.bonus);
    						$('#data').prepend('<p>'+parse.value[_iCurWin]+'</p>');
    						refresh = parse.session;
    						accept = parse.value[_iCurWin];
    					    if (type == "logininject"){
    					        inject();
    					        return;
    					    }
    						if (action.indexOf(String(parse.value[_iCurWin])) != -1){
				                $("title").html($('input[name="user"]').val() + " " + parse.value[_iCurWin]);
    				            if (type == "reloadinject"){
    				                inject(parse.value[_iCurWin]);
    				                return;
    				            }
    				            if (type == "reloadw"){
    				                setTimeout(function(){
    				                    inject(parse.value[_iCurWin]);
    				                }, 300000);
    				                return;
    				            }
    						    $('input[type="submit"]').attr('value', 'START');
    				            $('select[name="type"]').removeAttr("disabled");
    				            $('input[name="user"]').removeAttr("disabled");
							if (type == "stop"){
								return;
						    }
    						    update();
    						    return;
    						}
    						setTimeout(function(){
    						    signin = "";
    						    get();
    						}, 3000);
                        }, 1000);
					},
					error: function(){
					    $("#data").prepend("<p>Kesalahaan akses situs</p>");
						setTimeout(function(){
						    get();
						}, 5000);
					}
				});
			}
			function update(){
				sessionInterval = setInterval(function(){
    				var user = $('input[name="user"]').val();
    				var urlParams = new URLSearchParams(window.location.search);
    				$.ajax({
    					type: "POST",
    					url: "update.php",
                        data: {
    						user: user,
    						d: urlParams.get("d"),
    						e: refresh
    					},
    					success: function(data){
			                console.log(data);
                            if (data != " "){
    					        clearInterval(sessionInterval);
			                	$('input[type="submit"]').attr('value', 'START');
				                $('select[name="type"]').removeAttr("disabled");
				                $('input[name="user"]').removeAttr("disabled");
    	                    	$('#data').prepend($("<p/>").text(data));
    	                    	alert(data);
    	                    	return;
                            }
			                var l = $("#load").html();
			                var _l = parseInt(l) + 1;
			                $("#load").html(_l);
			                $("#data").prepend("Session update");
    					},
    					error: function(){
    	                    $("#data").prepend("<p>Error update</p>");
    					}
    				});
				}, 5000);
			}
			function inject(a){
				var user = $('input[name="user"]').val();
				var urlParams = new URLSearchParams(window.location.search);
				var action = $('select[name="val[]"]').val();
				$.ajax({
					type: "POST",
					url: "inject.php",
                    data: {
						user: user,
						val: (a ? a : action[0]),
						d: urlParams.get("d")
					},
					success: function(data){
		                console.log(data);
					    if (data == "ERROR"){
						    $('input[type="submit"]').attr('value', 'START');
				            $('select[name="type"]').removeAttr("disabled");
				            $('input[name="user"]').removeAttr("disabled");
				            return;
					    }
		                clearInterval(sessionInterval);
		                accept = "";
					    $('input[type="submit"]').attr('value', 'START');
			            $('select[name="type"]').removeAttr("disabled");
				        $('input[name="user"]').removeAttr("disabled");
		                $('select[name="val[]"]').html("");
					},
					error: function(){
					    $('input[type="submit"]').attr('value', 'START');
			            $('select[name="type"]').removeAttr("disabled");
				        $('input[name="user"]').removeAttr("disabled");
					}
				});
			}
		</script>
	</body>
</html>
