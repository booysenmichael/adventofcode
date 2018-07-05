<?php
//ANSWERS:
//STEPS: 650
//MAX_DISTANCE: 1465


//STARTING POINT 0;
//6 DIRECTIONS N, NE, NW, S, SE, SW
//HOWEVER, WE CAN USE 3 directions, x,y,z because N,S = 0 steps, SW,NE = 0 step
//Hexagonal Grids (flat top): https://www.redblobgames.com/grids/hexagons/
/*
N:	X=0;Y=1;Z=-1
S:	X=0;Y=-1;Z=+1
NE:	X=+1;Y=0;Z=-1
NW:	X=-1;Y=+1;Z=0
SE: X=+1;Y=-1;Z=0
SW:	X=-1;Y=0;Z=+1
*/

$file = 'directions.txt'; //ADDED KNOWN STEPS TO A FILE
$fileContent=file_get_contents($file); //PUT THE STEPS IN VARIABLE
$directionsArray = explode(',',$fileContent); //CREATED AN ARRAY


$x=0;
$y=0;
$z=0;
$max_distance=0;
foreach ($directionsArray as $key => $value) {
	if($value=='n'){
		$x += 0;
		$y += 1;
		$z += -1;
		
	}elseif($value=='s'){
		$x += 0;
		$y += -1;
		$z += 1;
		
	}elseif($value=='ne'){
		$x += 1;
		$y += 0;
		$z += -1;
		 
	}elseif($value=='nw'){
		$x += -1;
		$y += 1;
		$z += 0;
		
	}elseif($value=='se'){
		$x += 1;
		$y += -1;
		$z += 0;
		
	}elseif($value=='sw'){
		$x += -1;
		$y += 0;
		$z += 1;
	}
	$max_distance = max($max_distance,abs($x),abs($y),abs($z));
}

echo "steps:".max(abs($x),abs($y),abs($z));
echo "<br>";
echo "max_distance:".$max_distance;
?>