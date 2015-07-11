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
	$command = "swetest -b$date -n1 -s1 -fPZ -pp -eswe";
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