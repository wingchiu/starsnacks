<!doctype html>
<html lang="zh-Hans">
<head>
  <meta charset="UTF-8">
  <meta id="viewport" name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no">
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

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "starsnacks";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	echo 'alert("Connection failed")';
} 

$sql = "SELECT explanation FROM sunmoonanalysis where sun='$sun' and moon='$moon'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
	   $explanation=$row["explanation"];
	echo "1 results";
	}
//	echo $result;
} 
else {
    echo "0 results";
}
$conn->close();

?>



<body style="margin:0px; background:black;font-family: Microsoft YaHei; color:black; font-size:20px;">
	<div class="p0" style="color:white;position:absolute;width:100%;max-width:500px; overflow: hidden;background:black;background-image:url(galaxy.jpg);background-repeat: repeat ;background-size :100%;z-index:90; text-align: center;">
		<p style="margin:3px;text-align=center;">我的星盘卡-性格透视</p>

		<div style="padding-left:25px;padding-right:25px; text-align:left;">
			<p>
			<?php
			echo $explanation;
			?>
			</p>
		</div>

		<div align="center" style="max-width:580px;">
					
			<div style="text-align:center; font-size:20px;color:white;padding:5px;margin:0px;">					
				<img src="next.gif" style="width:30%;" onclick=character.submit()>
				<!--<button onlick=document.getElementById("character").submit();>更多分析>></button>-->
			</div>
			
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
			<form id="character" action="chart.php" method="GET">
			<?php
				echo "<input id='sunid' type='text' name='sun' value=$sun hidden='Yes'>";
				echo "<input id='moonid' type='text' name='moon'  value=$moon hidden='Yes'>";
				echo "<input id='yyyy' type='text' name='yyyy'  value=$yyyy hidden='Yes'>";
				echo "<input id='mm' type='text' name='mm'  value=$mm hidden='Yes'>";
				echo "<input id='dd' type='text' name='dd'  value=$dd hidden='Yes'>";
				echo "<input id='hhss' type='text' name='hhss'  value=$hhss hidden='Yes'>";
				echo "<input id='spot' type='text' name='spot'  value=$spot hidden='Yes'>";					
			?>
			</form>				
			<br>
		</div>
	</div>
</body>
