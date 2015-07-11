<html>
<body>
 

<!doctype html>
<html lang="zh-Hans">
<head>
  <meta charset="UTF-8">
  <meta id="viewport" name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no">
  <meta content="telephone=no" name="format-detection">
  <title>一分钟制作你的星盘</title>
  <!--<title>jQuery UI Datepicker - Display inline</title>-->
 
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="datepicker-zh-TW.js"></script>
  <script src="datepicker-ar.js"></script>
  <script src="datepicker-fr.js"></script>
  <script src="datepicker-he.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
  	$( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	//  minDate: "-100Y",
	//  maxDate: "+2Y",
	//  altFormat: "yy-mm-dd"
    });
	/*$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );*/
	var cyyyy=getCookie("year");
	var cmm=getCookie("month");
	var cdd=getCookie("date");
	var cdate=cmm+"/"+cdd+"/"+cyyyy;
	
	if (cyyyy!="") {
		$( "#datepicker" ).datepicker( "setDate", cdate );
	}
	else{
		$( "#datepicker" ).datepicker( "setDate", "01/01/1985" );
	}
	$( "#datepicker" ).datepicker( "show" );
	$( "#datepicker" ).datepicker( "option", "yearRange", "1950:2015" );
	$( "#datepicker" ).datepicker( "option", "hideIfNoPrevNext", true );
	//$( "#datepicker" ).datepicker( "option", "showButtonPanel", true );
	$( "#datepicker" ).datepicker( "option", "stepMonths", 0 );
	/*
	$("#datepicker").datepicker.setDefaults({
		showOn: "both",
		buttonImageOnly: true,
		buttonImage: "calendar.gif",
		buttonText: "Calendar"
	});*/
	/*
	$("#datepicker").datepicker.formatDate( "DD, MM d, yy", new Date( 2007, 7 - 1, 14 ), {
	dayNamesShort: $.datepicker.regional[ "fr" ].dayNamesShort,
	dayNames: $.datepicker.regional[ "fr" ].dayNames,
	monthNamesShort: $.datepicker.regional[ "fr" ].monthNamesShort,
	monthNames: $.datepicker.regional[ "fr" ].monthNames
	});*/
  });
 
	function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
	}

	function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
	} 
 
  </script>
  <script>
	function myFirstClick() {
	var date = $("#datepicker").datepicker("getDate");
	var dateFormat = $( "#datepicker" ).datepicker( "option", "dateFormat" );
	document.getElementById("yyyy").value=date.getFullYear();
	document.getElementById("mm").value=date.getMonth()+1;
	document.getElementById("dd").value=date.getDate();
	//document.getElementById("hhss").value="2345";
	document.getElementById("check").submit();
	setCookie("year",date.getFullYear(),100);
	setCookie("month",date.getMonth()+1,100);
	setCookie("date",date.getDate(),100);
	setCookie("time",document.getElementById("hhss").value,100);
	}
	
	function loadCookieTime(){
		var chhss=getCookie("time");
		document.getElementById("hhss").value=chhss;
	}
</script>

  <style>
	#p3
	{
		color:white;
		font-size: 17px;
	}
  
    .center {
    margin-left: auto;
    margin-right: auto;
    width: 90%;
	}
	
	.centerf {
    margin-left: auto;
    margin-right: auto;
    width: 75%;
	}
	
  </style>
</head>




<body style="margin:0px; font-family: Microsoft YaHei;">
<!--<div id="main" style="width: 100%; max-width: 500px; margin: 0px auto; height: 560px;">-->
<!--<div style="position:absolute;min-height:480px;height:100%;width:100%;max-width:500px;"> 
	<div class="p0" style="color:#777;position:absolute;height:480px;height:100%;width:100%;max-width:500px;overflow: hidden;background:#fff;background-image:url(starbgv.gif);background-repeat: no-repeat ;background-size :100% 100%;z-index:90;">-->
	
<div style="position:absolute;min-height:480px;height:100%;width:100%;max-width:500px;"> 
	<div class="p0" style="color:white;position:absolute;width:100%;height:100%;max-width:500px;overflow: hidden;background:#fff;background-image:url(galaxy.jpg);background-repeat: no-repeat ;background-size :100% 100% ;z-index:90; text-align: center;">

	<div id="p1" align="center" style="font-size:30px; color:white; padding:20px;">
		我的星盘卡
	</div>
	
	
	<div id="p2" align="center">
		<div id="datepicker" class="center">
		</div>
	</div>	
	
	<div id="p3" class="centerf">
	<!--<div id="p3" align="center">-->
		<form id="check" action="show.php" method="GET">
			<input id="yyyy" type="text" name="year" value="1975" hidden="Yes">
			<input id="mm" type="text" name="month" value="04" hidden="Yes">
			<input id="dd" type="text" name="date" value="17" hidden="Yes">
			<p style="font-size:15;">
			如知道出生时刻地区，请务必填写增加准确性(24小时制，如晚上12点30分填写0030):<br>			
			<input id="hhss" type="text" name="time" style="font-size:15;width:70px;height:25px;" >
			<script>
			loadCookieTime();
			</script>
			出生地区域:
			<select id="spot" name="location" value="south" style="font-size:15px;width:135px;">
				<option value="east">东方-上海周边</option>
				<option value="southeast">东南-福建周边</option>
				<option selected value="south">南方-广州周边</option>
				<option value="southwest">西南-重庆周边</option>
				<option value="west">西方-成都周边</option>
				<option value="northwest">西北-西安周边</option>
				<option value="north">北方-北京周边</option>
				<option value="northeast">东北-沈阳周边</option>
			</select>
			<div align="center"><img src="generate.gif" onclick="myFirstClick()" style="width:40%;"></div>
			
			<!--<button onclick="myFirstClick()" style="font-size:20;width:120px;height:40px;">-->
			</p>
		</form>
	</div>
	
	<!--<p>Date: <input type="text" id="datepicker"></p>-->
	<div align="center" style="max-width:580px;">
				
<!--				<div>
					<p style="text-align:center; font-size:20px;color:white;padding:10px;margin:0px;"><a href="/starsnacks/check.php" style="color:white;"><img src="regenerate.gif" style="width:30%;"></a></p>
					
				</div>-->
				
				<div>
					<img src="logo.jpg" style="width:15%;" align="center">
				</div>
				
				<div>
					<p style="text-align:center; font-size:10px;padding:0px;margin:0px;">Powered by 星座零食</p>
				</div>
				<div>
					<p style="text-align:center; font-size:10px;padding:2px;margin:1px;">提示:按右上角可以分享给朋友或朋友圈</p>
					<img src="logo_share.jpg" style="width:5px;height:5px;">
				</div>
				<br>
			</div>
	</div>
<!--</div>-->
</div>
 
</body>
</html>



</body>
</html>