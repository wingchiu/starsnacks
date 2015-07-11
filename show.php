<!doctype html>
<html lang="zh-Hans">
<head>
  <meta charset="UTF-8">
  <meta id="viewport" name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no">
  <meta content="telephone=no" name="format-detection">
  <title>一分钟星盘生成器</title>

<style>
div { 
    display: block;
	clear: both;
}
</style>

<body style="margin:0px; background:black;font-family: Microsoft YaHei; color:black; font-size:20px;">
<!--<div id="main" style="width: 100%; max-width: 500px; margin: 0px auto; height: 560px;">-->
	<div class="p0" style="color:white;position:absolute;width:100%;max-width:500px;overflow: hidden;background:black;background-image:url(galaxy.jpg);background-repeat: repeat ;background-size :100%;z-index:90; text-align: center;">
	<!--
	<div style="position:absolute;min-height:480px;height:100%;width:100%;max-width:500px;"> 
	<div class="p0" style="color:white;position:absolute;width:100%;height:100%;max-width:500px;overflow: hidden;background:#fff;background-image:url(galaxy.jpg);background-repeat: repeat ;background-size :100% 100% ;z-index:90; text-align: center;">
	</div>-->

<?php
$yyyy="1975";
$mm="04";
$dd="17";
$yyyy=$_GET["year"];
$mm=$_GET["month"];
$dd=$_GET["date"];
$hhss=$_GET["time"];
$spot=$_GET["location"];
$hh=substr($hhss,0,2);
$ss=substr($hhss,2,2);

$charthhss=$hh.".".$ss;

if($hh>=8){
	$hh=$hh-8;	
} else {
	$hh=7-$hh;
	$hh="-$hh";
	$ss=60-$ss;
}

$time=$hh.":".$ss;
/*
$hhss=$hhss-800;
if($hhss>0){
$time=substr($hhss,0,2).":".substr($hhss,2,2).":00";
}
else{
$time="-".substr($hhss,1,2).":".substr($hhss,3,2).":00";	
}
*/
//echo $time;
$date = "$dd.$mm.$yyyy";

switch ($spot){
	case "east":
		$ll="+121.28,+31.13";
		break;
	case "southeast":
		$ll="+118.04,+24.26";
		break;
	case "south":
		$ll="+113.15,+23.70";
		break;
	case "southwest":
		$ll="+106.33,+29.33";
		break;
	case "west":
		$ll="+104.06,+30.37";
		break;
	case "northwest":
		$ll="+108.54,+34.16";
		break;
	case "north":
		$ll="+116.24,+29.55";
		break;
	case "northeast":
		$ll="+123.25,+41.48";
		break;
}

if($hhss==""){
	//$command = "swetest -b$date -n1 -s1 -fPZ -pp -eswe";
	$command = "swetest -b$date -n1 -s1 -fPZ -pp -eswe -ut04:00 -house+114.17,+22.27,p";
}
else{
//	$command = "swetest -b$date -n1 -s1 -fPZ -pp -eswe -ut$time -house+114.17,+22.27,p";
	$command = "swetest -b$date -n1 -s1 -fPZ -pp -eswe -ut$time -house$ll,p";
}

//$chartll=substr($ll,1,3)."W".substr($ll,5,2)." ".substr($ll,9,2)."N".substr($ll,12,2);
$chartll="-".substr($ll,1,6)." ".substr($ll,8,6);

//echo $chartll;

$commandchart = "C:\astrology\astrolog -qa $mm $dd $yyyy $charthhss -8 $chartll -R[C,u,U] -Xb -Xo $yyyy$mm$dd$hhss$spot.bmp";
//echo $commandchart;
//$commandchartkill = "C:\taskkill /IM astrolog.exe";

$r = exec($command, $out, $status);
$rc = exec($commandchart, $outc, $status);
//$rk = exec($commandchartkill, $outk, $status);

for ($i=0; $i<count($out); $i++){
	//echo $out[$i];
	$str=trim(substr($out[$i],0,16));
    $sign=trim(substr($out[$i],19,2));
	$angle=getsigndegree($sign);
	$angle=$angle+trim(substr($out[$i],16,2))+trim(substr($out[$i],22,2)/100);
	//$angle=trim(substr($out[$i],16,2))+trim(substr($out[$i],22,2)/100);
	
	switch ($str){
	case "house  1":
		$houseangle[1]=$angle;		
		break;			
	case "house  2":
		$houseangle[2]=$angle;
		break;
	case "house  3":
		$houseangle[3]=$angle;
		break;
	case "house  4":
		$houseangle[4]=$angle;
		break;
	case "house  5":
		$houseangle[5]=$angle;
		break;
	case "house  6":
		$houseangle[6]=$angle;
		break;
	case "house  7":
		$houseangle[7]=$angle;
		break;
	case "house  8":
		$houseangle[8]=$angle;
		break;
	case "house  9":
		$houseangle[9]=$angle;
		break;
	case "house 10":
		$houseangle[10]=$angle;
		//echo "$houseangle[10]";
		break;
	case "house 11":
		$houseangle[11]=$angle;
		//echo "$houseangle[11]";
		break;
	case "house 12":
		$houseangle[12]=$angle;	
		//echo "$houseangle[12]";
		break;
	case "Sun":
		$starangle[$str]=$angle;
		//echo $starangle[$str];
		break;
	case "Sun":
		$starangle[$str]=$angle;
		//echo $starangle[$str];
		break;
	case "Sun":
		$starangle[$str]=$angle;
		//echo $starangle[$str];
		break;
	default:
		$starangle[$str]=$angle;
		//echo $starangle[$str];
		break;	
	}
}

//$mindegree=360;	
//
//for ($x=1; $x<=12; $x++){
//	if($houseangle[$x]<=$mindegree){
//		$mindegree=$houseangle[$x];			
//	}
//}
$houseangle[13]=$houseangle[1];

function checkhouse($degree){
	
	$houseanglelocal=$GLOBALS['houseangle'];
	$mindegree=360;	
	for ($x=1; $x<=12; $x++){
		if($houseanglelocal[$x]<=$mindegree){
			$mindegree=$houseanglelocal[$x];			
		}
	}
	$maxdegree=$mindegree+360;
		
	//$maxdegree=min(houseanglelocal(1,2,3,4,5,6,7,8,9,10,11,12))+360;
	//echo $maxdegree;
	
	for ($x=1; $x<=12; $x++){
		//echo $x;
		
		if ($houseanglelocal[$x]<$houseanglelocal[$x+1]){
			if ($degree>=$houseanglelocal[$x] and $degree<$houseanglelocal[$x+1]){
				return $x;		
			}
			elseif ($degree<$houseanglelocal[$x+1]==$mindegree){
				if ($degree>=$houseanglelocal[$x] and $degree<$maxdegree){
					return $x;
				}
			}
		}
		else
		{	
			if($degree>=$houseanglelocal[$x] and $degree<$houseanglelocal[$x+1]+360)
				return $x;
			
			if($degree+360>=$houseanglelocal[$x] and $degree+360<$houseanglelocal[$x+1]+360)
				return $x;
		}			
	}
}

function getsigndegree($symbol){
	switch ($symbol){
		case "ar":
			return 0;
		break;
		case "ta":
			return 30;
		break;
		case "ge":
			return 60;
		break;
		case "cn":
			return 90;
		break;
		case "le":
			return 120;
		break;
		case "vi":
			return 150;
		break;
		case "li":
			return 180;
		break;
		case "sc":
			return 210;
		break;
		case "sa":
			return 240;
		break;
		case "cp":
			return 270;
		break;	
		case "aq":
			return 300;
		break;
		case "pi":
			return 330;
		break;
	}
}

function signlookup($symbol) {
	switch ($symbol){
		case "ar":
		return "白羊";
		break;
		case "ge":
		return "双子";
		break;
		case "pi":
		return "双鱼";
		break;
		case "aq":
		return "水瓶";
		break;
		case "ta":
		return "金牛";
		break;
		case "cn":
		return "巨蟹";
		break;
		case "le":
		return "狮子";
		break;
		case "vi":
		return "处女";
		break;
		case "li":
		return "天秤";
		break;
		case "sc":
		return "天蝎";
		break;
		case "sa":
		return "射手";
		break;
		case "cp":
		return "摩羯";
		break;
	}

//function houselookup{
	
	
//}	
//echo "<br>";	
}

//echo "<p style:"text-align:left; font-size:10px;">$yyyy年$mm月$dd日$time</p>";
//echo "<p>$yyyy年$mm月$dd日$time</p>";
echo '<p style="text-align:left; font-size:6px;padding:2px;margin:1px;">';
echo "$yyyy"."年"."$mm"."月"."$dd"."日";
if($hhss!=""){
	echo "$time";
}
echo "<br>";
echo "$command<br>";
echo "</p>";

?>



<p style="margin:3px;">我的星盘卡</p>
<div style="font-size:25px;">
<?php
//echo $starangle['Sun'];
//echo $starangle['Moon'];
//echo $starangle['Venus'];
//echo $starangle['Mercury'];	

echo '<table align=center style="width:80%;">';
//$r = exec('swetest -b17.04.1975 -n1 -s1 -fPZ -pp -eswe -pp -eswe -ut02:12:00 -house12.05,49.50', $out, $status);
 for ($i=0; $i<count($out); $i++){
	 //echo $out[$i];
	 $str=trim(substr($out[$i],0,16));
	 $sign=trim(substr($out[$i],19,2));
	 //echo "$str <br>";
	 switch ($str){
	 case "Sun":
		echo '<tr><td width="50%">'.'太阳'.'</td>'; 
		echo '<td width=25% style="text-align:right;">';
		echo signlookup($sign);
		echo '</td>';
		$sun=$sign;
		$house=checkhouse($starangle['Sun']);
		echo "<td width=25%>";
		if($hhss!=""){
			echo "<div style='width:80px;height:25px;font-size:8px;float:right;text-align=left'>";
				echo "<div style='width:40px;height:20px;font-size:8px;float:left;background:white;color:black;text-align=left'>";
				echo "宫$house";
				echo "</div>";
			echo "</div>";
		}
		echo "</td>";		
		break;
	 case "Moon":
		echo "<tr><td>"."月亮"."</td>";
		echo '<td width=25% style="text-align:right;">';
		echo signlookup($sign);
		echo '</td>';
		$moon=$sign;
		$house=checkhouse($starangle['Moon']);
		echo "<td width=25%>";
		if($hhss!=""){
			echo "<div style='width:80px;height:25px;font-size:8px;float:right;text-align=left'>";
				echo "<div style='width:40px;height:20px;font-size:8px;float:left;background:white;color:black;text-align=left'>";
				echo "宫$house";
				echo "</div>";
			echo "</div>";
		}
		echo "</td>";
		break;
	 case "Venus":
		echo "<tr><td>"."金星"."</td>";
		echo '<td width=25% style="text-align:right;">';
		echo signlookup($sign);
		echo '</td>';
		$house=checkhouse($starangle['Venus']);
		echo "<td width=25%>";
		if($hhss!=""){
			echo "<div style='width:80px;height:25px;font-size:8px;float:right;text-align=left'>";
				echo "<div style='width:40px;height:20px;font-size:8px;float:left;background:white;color:black;text-align=left'>";
				echo "宫$house";
				echo "</div>";
			echo "</div>";
		}
		echo "</td>";
		break;
	 case "Mercury":
		echo "<tr><td>"."水星"."</td>";
		echo '<td width=25% style="text-align:right;">';
		echo signlookup($sign);
		echo '</td>';
		$house=checkhouse($starangle['Mercury']);
		echo "<td width=25%>";
		if($hhss!=""){
			echo "<div style='width:80px;height:25px;font-size:8px;float:right;text-align=left'>";
				echo "<div style='width:40px;height:20px;font-size:8px;float:left;background:white;color:black;text-align=left'>";
				echo "宫$house";
				echo "</div>";
			echo "</div>";
		}
		echo "</td>";
		break;
	 case "Mars":
	 	echo "<tr><td>"."火星"."</td>";
		echo '<td width=25% style="text-align:right;">';
		echo signlookup($sign);
		echo '</td>';
		$house=checkhouse($starangle['Mars']);		
		echo "<td width=25%>";
		if($hhss!=""){
			echo "<div style='width:80px;height:25px;font-size:8px;float:right;text-align=left'>";
				echo "<div style='width:40px;height:20px;font-size:8px;float:left;background:white;color:black;text-align=left'>";
				echo "宫$house";
				echo "</div>";
			echo "</div>";
		}
		echo "</td>";
		break;
	 case "Jupiter":
		echo "<tr><td>"."木星"."</td>";
		echo '<td width=25% style="text-align:right;">';
		echo signlookup($sign);
		echo '</td>';
		$house=checkhouse($starangle['Jupiter']);
		echo "<td width=25%>";
		if($hhss!=""){
			echo "<div style='width:80px;height:25px;font-size:8px;float:right;text-align=left'>";
				echo "<div style='width:40px;height:20px;font-size:8px;float:left;background:white;color:black;text-align=left'>";
				echo "宫$house";
				echo "</div>";
			echo "</div>";
		}
		echo "</td>";
		break;
	 case "Saturn":
		echo "<tr><td>"."土星"."</td>";
		echo '<td width=25% style="text-align:right;">';
		echo signlookup($sign);
		echo '</td>';
		$house=checkhouse($starangle['Saturn']);
		echo "<td width=25%>";
		if($hhss!=""){
			echo "<div style='width:80px;height:25px;font-size:8px;float:right;text-align=left'>";
				echo "<div style='width:40px;height:20px;font-size:8px;float:left;background:white;color:black;text-align=left'>";
				echo "宫$house";
				echo "</div>";
			echo "</div>";
		}
		echo "</td>";
		break;
	 case "Uranus":
		echo "<tr><td>"."天王"."</td>";
		echo '<td width=25% style="text-align:right;">';
		echo signlookup($sign);
		echo '</td>';
		$house=checkhouse($starangle['Uranus']);
		echo "<td width=25%>";
		if($hhss!=""){
			echo "<div style='width:80px;height:25px;font-size:8px;float:right;text-align=left'>";
				echo "<div style='width:40px;height:20px;font-size:8px;float:left;background:white;color:black;text-align=left'>";
				echo "宫$house";
				echo "</div>";
			echo "</div>";
		}
		echo "</td>";
		break;
	 case "Neptune":
		echo "<tr><td>"."海王"."</td>";
		echo '<td width=25% style="text-align:right;">';
		echo signlookup($sign);
		echo '</td>';
		$house=checkhouse($starangle['Neptune']);
		echo "<td width=25%>";
		if($hhss!=""){		
			echo "<div style='width:80px;height:25px;font-size:8px;float:right;text-align=left'>";
				echo "<div style='width:40px;height:20px;font-size:8px;float:left;background:white;color:black;text-align=left'>";
				echo "宫$house";
				echo "</div>";
			echo "</div>";
		}
		echo "</td>";
		break;
	 case "Pluto":
		echo "<tr><td>"."冥王"."</td>";	
		echo '<td width=25% style="text-align:right;">';
		echo signlookup($sign);
		echo '</td>';
		$house=checkhouse($starangle['Pluto']);
		echo "<td width=25%>";
		if($hhss!=""){
			echo "<div style='width:80px;height:25px;font-size:8px;float:right;text-align=left'>";
				echo "<div style='width:40px;height:20px;font-size:8px;float:left;background:white;color:black;text-align=left'>";
				echo "宫$house";
				echo "</div>";
			echo "</div>";
		}
		echo "</td>";
		break;
	 case "Ascendant":
		echo "<tr><td>"."上升"."</td>";
		echo '<td width=25% style="text-align:right;">';
		echo signlookup($sign);
		echo '</td>';
		echo "<td width=25%>";
		if($hhss!=""){
			echo "<div style='width:80px;height:25px;font-size:8px;float:right;text-align=left'>";
				echo "<div style='width:40px;height:20px;font-size:8px;float:left;background:white;color:black;text-align=left'>";
				echo "宫1同";
				echo "</div>";
			echo "</div>";
		}
		echo "</td>";
		break;		
	 }
 }
 
echo "</table>";
print_r($houseangle);
 

 //print_r($out);
 //print_r($status);
?>
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
				<form id="character" action="sunmoon.php" method="GET">
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
</html>