<?php
//ANSWER PART 1: YOHREPXWN
//ANSWER PART 2: 16734


$file="path.txt";

$lineCount = 0;
$pathArray=array();
$f=fopen($file,'r');
	while(!feof($f)){ //LOOP THROUGH FILE TO CREATE ARRAY, EASIER TO "MOVE" IN AN ARRAY THAT IN A FILE
		$line = fgets($f);
		for($i=0;$i<strlen($line);$i++){
			$tempText=substr($line, $i,1);
			$pathArray[$lineCount][$i]=$tempText;
		}
		++$lineCount;

	}

$prevChar = '';
$position = 0;

//WE KNOW IT START ON TOP OF SCREEN, LINE 0 / key 0. NOW WE NEED TO GET THE POSTION
foreach ($pathArray['0'] as $key => $value) {
	if($value=='|'){
		$position=$key;
		$prevChar = $value;
		break 1;
	}
}
$x=1;
$end=false;
$direction = 'd'; //d,u,l,r
$prevLineNumber=0;
$lineNumber=1;
$charArray = array();

//THE POSTION AND THE NEXT LINE KEY 0, TO GET THE NEXT CHAR
while(!$end){
	
	$currentChar = $pathArray[$lineNumber][$position];
	if(ctype_alpha($currentChar)){
		array_push($charArray, $currentChar);
	}
	if(($currentChar==$prevChar)||(ctype_alpha($currentChar))){ // IF CHAR IS THE SAME CONTINUE ON THE PATH d/u = line number changes, l/r = the position changes 
		switch($direction){
			case "l":
				$position = $position-1;
				++$x;
			break;
			case "r":
				$position = $position+1;
				++$x;
			break;
			case "d":
				$lineNumber = $lineNumber+1;
				++$x;
			break;
			case "u":
				$lineNumber = $lineNumber-1;
				++$x;
			break;
		}
	}else{ // IF NOT THE SAME, only + will cause the path to change
		if($currentChar=="+"){
			if(($direction=='l')||($direction=='r')){
				if($pathArray[$lineNumber-1][$position]=='|'){
					$direction='u';
					$lineNumber=$lineNumber-1;
					++$x;
				}elseif($pathArray[$lineNumber+1][$position]=='|'){
					$direction='d';
					$lineNumber=$lineNumber+1;
					++$x;
				}	
			}elseif(($direction=='u')||($direction=='d')){
				if($pathArray[$lineNumber][$position+1]=='-'){
					$direction='r';
					$position=$position+1;
					++$x;
				}elseif($pathArray[$lineNumber][$position-1]=='-'){
					$direction='l';
					$position=$position-1;
					++$x;
				}	
			}	
		}
	}
	
	
	$prevChar=$currentChar; //Assign current character to previous character.
	if($currentChar==' '){ //If the current character is blank, change end to true
		$end=true;
	}


}

echo "The Letters you will see: ";
foreach($charArray as $key => $value){
	echo $value;
}
echo "<br>";
echo "The total number of steps: ".$x;



?>