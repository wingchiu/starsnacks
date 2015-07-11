<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script src="http://www.w3schools.com/appml/2.0.2/appml.js"></script>
-->

<link rel="stylesheet" href="jquery.mobile-1.4.5.min.css">
<script src="jquery-1.11.3.min.js"></script>
<script src="jquery.mobile-1.4.5.min.js"></script>
<script src="appml.js"></script>


<script>
$(document).on("pagecreate","#pageone",function(){
  $("#pageone").on("swipeleft",function(){
	$("#gotop2").click();  
  });                       
});

$(document).on("pagecreate","#pagetwo",function(){
  $("#pagetwo").on("swipeleft",function(){
    $("#gotop3").click();
  });
  
  $("#pagetwo").on("swiperight",function(){
    $("#gobkp1").click();
  });  
});

$(document).on("pagecreate","#pagethree",function(){
  $("#pagethree").on("swipeleft",function(){
    $("#gotop4").click();
  });

  $("#pagethree").on("swiperight",function(){
    $("#gobkp2").click();
  });         
});

$(document).on("pagecreate","#pagethree",function(){
//  $("#pagefour").on("swipeleft",function(){
//    $("#gotop3").click();
//  });

  $("#pagefour").on("swiperight",function(){
    $("#gobkp3").click();
  });         
});
  

</script>

<style>
#arrowright {
    position: fixed;
    top: 50%;
    right: 5px;
    color: white;
	font-size:50px;
	-webkit-animation: mymove 2s infinite; /* Chrome, Safari, Opera */
    animation: mymove 2s infinite;
}

#arrowleft {
    position: fixed;
    top: 50%;
    left: 5px;
    color: white;
	font-size:50px;
}

@-webkit-keyframes mymove {
    from {right: 0px;}
    to {right: 10px;}
}

@keyframes mymove {
    from {right: 0px;}
    to {right: 10px;}
}

</style>

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

$chartll="-".substr($ll,1,6)." ".substr($ll,8,6);

date_default_timezone_set("Europe/London");
$currentdatetime=getdate();
$cyyyy=$currentdatetime[year];
$cmm=$currentdatetime[mon];
$cdd=$currentdatetime[mday];
$chh=$currentdatetime[hours];
$cmin=$currentdatetime[minutes];

if($hhss==""){
	$command = "swetest -b$date -n1 -s1 -fPZ -pp -eswe -ut04:00 -house+114.17,+22.27,p";
	$commandchart = "C:\astrology\astrolog -qa $mm $dd $yyyy 12.00 -8 $chartll -R[C,u,U] -Xb -Xo $yyyy$mm$dd$hhss$spot.bmp";	
	$commandnow = "swetest -b$cdd.$cmm.$cyyyy -n1 -s1 -fPZ -pp -eswe -ut$chh:$cmin -house+114.17,+22.27,p";
}
else{
	$command = "swetest -b$date -n1 -s1 -fPZ -pp -eswe -ut$time -house$ll,p";
	$commandchart = "C:\astrology\astrolog -qa $mm $dd $yyyy $charthhss -8 $chartll -R[C,u,U] -Xb -Xo $yyyy$mm$dd$hhss$spot.bmp";
	$commandnow = "swetest -b$cdd.$cmm.$cyyyy -n1 -s1 -fPZ -pp -eswe -ut$chh:$cmin -house$ll,p";
}


$r = exec($command, $out, $status);
//$rc = exec($commandchart, $outc, $status);
$rn = exec($commandnow, $outnow, $statusnow);

for ($i=0; $i<count($out); $i++){
	//echo $out[$i];
	$str=trim(substr($out[$i],0,16));
    $sign=trim(substr($out[$i],19,2));
	$angle=getsigndegree($sign);
	$angle=$angle+trim(substr($out[$i],16,2))+trim(substr($out[$i],22,2)/100);
	
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
		break;
	case "house 11":
		$houseangle[11]=$angle;
		break;
	case "house 12":
		$houseangle[12]=$angle;	
		$houseangle[13]=$houseangle[1];
		break;
	default:
		$starangle[$str]=$angle;
		//echo $starangle[$str];
		break;	
	}
}

for ($i=0; $i<count($outnow); $i++){
	//echo $out[$i];
	$str=trim(substr($outnow[$i],0,16));
    $sign=trim(substr($outnow[$i],19,2));
	$angle=getsigndegree($sign);
	$angle=$angle+trim(substr($outnow[$i],16,2))+trim(substr($outnow[$i],22,2)/100);
	
	switch ($str){

/*	case "Sun":
		$staranglenow[$str]=$angle;
		//echo $starangle[$str];
		break;
	case "Moon":
		$staranglenow[$str]=$angle;
		//echo $starangle[$str];
		break;
	case "Saturn":
		$staranglenow[$str]=$angle;
		//echo $starangle[$str];
		break;*/
	case "Sun":
	case "Moon":
	case "Saturn":
	case "Jupiter":
	case "Mars":
	case "Venus":
	case "Mercury":	
		$starhousenow[$str]=checkhouse($angle);
		break;	
	}
}

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

}




echo '<p style="text-align:left; font-size:6px;padding:2px;margin:1px;">';
echo "$yyyy"."年"."$mm"."月"."$dd"."日";
if($hhss!=""){
	echo "$time";
}
echo "<br>";
echo "$command<br>";
echo "</p>";
?>


</head>



<body style="margin:0px; background:black;font-family: Microsoft YaHei; color:black; font-size:20px; text-shadow:none;">

<div data-role="page" id="pageone" style="background-image:url(galaxy.jpg);background-repeat: repeat ;background-size :cover; color:white;" >
  
  <div data-role="header" style="border:0px; background:none;text-shadow:none;color:white;">
    <h1>简简单单星盘卡</h1>
  </div>

  <div data-role="main" class="ui-content" style="padding:0px 50px 0px 50px;">
    <p>
		<?php
		echo '<table align=center style="width:100%;margin:0px; text-align:center;font-size:25px;text-shadow:none;" >';
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
		//print_r($houseangle);
		?>		
	</p>	
  </div>

  <div id="arrowright">
	<
  </div>
  
  <div data-role="footer" style="border:0px; background:none;text-shadow:none;color:white;">
    <div appml-include-html="inc_footer.htm"></div>	
  </div>
</div> 

<div data-role="page" id="pagetwo" style="background-image:url(galaxy.jpg);background-repeat:repeat ;background-size:100%;background-attachment:fixed;color:white;">
<!--<div data-role="page" id="pagetwo" style="background: url(galaxy.jpg) no-repeat center center fixed; background-size: 100%;background-attachment: scroll; color:white;">-->
  <div data-role="header" style="border:0px; background:none;text-shadow:none;color:white;">
    <h1>日月组合变性格</h1>
  </div>

  <div data-role="main" class="ui-content" style="padding:0px 50px 0px 50px;">
    <p>
		<img src="sunmoon.jpg" style="width:100%;">
		
		<?php
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
			//;echo "1 results";
			}
		//	echo $result;
		} 
		else {
			//echo "0 results";
		}
		$conn->close();
		
		echo $explanation;
		
		?>
	</p>
  </div>
  
  <div id="arrowright">
	<
  </div>

  <div data-role="footer" style="border:0px; background:none;text-shadow:none;color:white;">
    <div appml-include-html="inc_footer.htm"></div>	
  </div>
</div> 

<div data-role="page" id="pagethree" style="background: url(galaxy.jpg) no-repeat center center fixed; background-size: cover; color:white;">
  <div data-role="header" style="border:0px; background:none;text-shadow:none;color:white;">
    <h1>土星走那霉到哪</h1>
  </div>

  <div data-role="main" class="ui-content">
    <p>
		<img src="saturn.jpg" style="width:100%;">
		<?php
			//print_r($currentdatetime);
			//echo $commandnow;
			//print_r($starhousenow);
		
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

			$sql = "SELECT explanation FROM saturntransitanalysis where house=$starhousenow[Saturn]";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
				   //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
				   $explanation=$row["explanation"];
				//;echo "1 results";
				}
			//	echo $result;
			} 
			else {
				//echo "0 results";
			}
			$conn->close();
			
			echo $explanation;
		
		?>
	</p>
    
  </div>
  
  <div id="arrowright">
	<
  </div>

  <div data-role="footer" style="border:0px; background:none;text-shadow:none;color:white;">
    <div appml-include-html="inc_footer.htm"></div>	
  </div>
</div> 

<div data-role="page" id="pagefour" style="background: url(galaxy.jpg) no-repeat center center fixed; background-size: cover; color:white;">
  <div data-role="header" style="border:0px; background:none;text-shadow:none;color:white;">
    <h1>是时候支持我们啦</h1>
  </div>

  <div data-role="main" class="ui-content" style="text-align:center;">
    <p>
	<img src="starsnacksqr.jpg" style="width:80%;">
	</p>
	<p>星座零食-让占星实用起来</p>
  </div>  

  <div data-role="footer" style="border:0px; background:none;text-shadow:none;color:white;">
    <div appml-include-html="inc_footer.htm"></div>	
  </div>
</div> 



<a href="#pageone" data-transition="slide" id="gotop1"></a>
<a href="#pageone" data-transition="slide" data-direction="reverse" id="gobkp1"></a>
<a href="#pagetwo" data-transition="slide" id="gotop2"></a>
<a href="#pagetwo" data-transition="slide" data-direction="reverse" id="gobkp2"></a>
<a href="#pagethree" data-transition="slide" id="gotop3"></a>
<a href="#pagethree" data-transition="slide" data-direction="reverse" id="gobkp3"></a>
<a href="#pagefour" data-transition="slide" id="gotop4"></a>
<a href="#pagefour" data-transition="slide" data-direction="reverse" id="gobkp4"></a>


</body>
</html>