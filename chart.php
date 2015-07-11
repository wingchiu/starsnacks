<!doctype html>
<html lang="zh-Hans">
<head>
  <meta charset="UTF-8">
  <meta id="viewport" name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=3.0,initial-scale=1.0,user-scalable=yes">
  <meta content="telephone=no" name="format-detection">
  <title>一分钟星盘生成器</title>
</head> 

<?php
$sun=$_GET["sun"];
$moon=$_GET["moon"];
$yyyy=$_GET["yyyy"];
$mm=$_GET["mm"];
$dd=$_GET["dd"];
$hhss=$_GET["hhss"];
$spot=$_GET["spot"];
?>


<body style="margin:0px; background:black;font-family: Microsoft YaHei; color:black; font-size:20px;">
	<div class="p0" style="color:white;position:absolute;width:100%;max-width:500px;min-height:480px;overflow: hidden;background:black;background-image:url(galaxy.jpg);background-repeat: repeat ;background-size :100%;z-index:90; text-align: center;">
		<p style="margin:3px;text-align=center;">我的星盘图-专家用</p>
		
		<div style="padding-top:20px;">
			<p style="margin:3px;text-align=left;">本命盘</p>
			<img style="width:90%" src="
			<?php
				echo "$yyyy$mm$dd$hhss$spot.bmp"
			?>">	
		</div>
		
		<div style="padding-top:20px;">
			<p style="margin:3px;text-align=left;">当前推运盘</p>
			<img style="width:90%" src="temp.bmp">	
		</div>
		
		<div style="padding-top:20px;">
			<p style="margin:3px;text-align=left;">当前行运盘</p>
			<img style="width:90%" src="temp.bmp">	
		</div>
		
		<div align="center" style="max-width:580px;">
					
		<!--	<div style="text-align:center; font-size:20px;color:white;padding:5px;margin:0px;">					
				<img src="next.gif" style="width:30%;" onclick=character.submit()>
				<!--<button onlick=document.getElementById("character").submit();>更多分析>></button>-->
		<!--	</div>-->
			
			<div style="text-align:center; font-size:20px;color:white;padding:10px;padding-bottom:0px;margin:0px;">					
				<!--<img src="regenerate.gif" style="width:30%;" onclick=character.submit()>-->
				<!--<p style="text-align:center; font-size:20px;color:white;padding:10px;margin:0px;"></p>-->
				<a href="/starsnacks/check.php" style="color:white;"><img src="regenerate.gif" style="width:30%;"></a>					
			</div>
			
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
			<!--<form id="character" action="chart.php" method="GET">
			<?php
			//	echo "<input id='sunid' type='text' name='sun' value=$sun hidden='Yes'>";
			//	echo "<input id='moonid' type='text' name='moon'  value=$moon hidden='Yes'>";					
			?>
			</form>-->				
			<br>
		</div>

		
	</div>
	
</body>