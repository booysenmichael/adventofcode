<?php
//ANSWER PART 1: YOHREPXWN
//ANSWER PART 2: 16734
function outputChar($char){
	switch($char){
		case "|":
			return "up/down";
		break;
		case "+":
			return "change";
		break;
		case "-":
			return "left/right";
		break;
	}
}

$file="path.txt";

$lineCount = 0;
$pathArray=array();
$f=fopen($file,'r');
	while(!feof($f)){
		$line = fgets($f);
		for($i=0;$i<strlen($line);$i++){
			$tempText=substr($line, $i,1);
			$pathArray[$lineCount][$i]=$tempText;
		}
		++$lineCount;

	}

$prevChar = '';
$prevPostion = '';

//WE KNOW IT START ON TOP OF SCREEN, LINE 0 / key 0. NOW WE NEED TO GET THE POSTION
foreach ($pathArray['0'] as $key => $value) {
	if($value=='|'){
		$prevPostion=$key;
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
while(!$end){
	echo $direction;
	$currentChar = $pathArray[$lineNumber][$prevPostion];
	if(ctype_alpha($currentChar)){
		echo $currentChar.$currentChar;
		array_push($charArray, $currentChar);
	}
	if(($currentChar==$prevChar)||(ctype_alpha($currentChar))){
		
		//echo $currentChar;
		//echo outputChar($currentChar)."<br>";
		switch($direction){
			case "l":
				$prevPostion = $prevPostion-1;
				++$x;
			break;
			case "r":
				$prevPostion = $prevPostion+1;
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
	}else{
		if($currentChar=="+"){
			if(($direction=='l')||($direction=='r')){
				if($pathArray[$lineNumber-1][$prevPostion]=='|'){
					echo 'g Up';
					$direction='u';
					$lineNumber=$lineNumber-1;
					++$x;
				}elseif($pathArray[$lineNumber+1][$prevPostion]=='|'){
					echo 'g Dwn';
					$direction='d';
					$lineNumber=$lineNumber+1;
					++$x;
				}	
			}elseif(($direction=='u')||($direction=='d')){
				if($pathArray[$lineNumber][$prevPostion+1]=='-'){
					echo 'g Right';
					$direction='r';
					$prevPostion=$prevPostion+1;
					++$x;
				}elseif($pathArray[$lineNumber][$prevPostion-1]=='-'){
					echo 'g Left';
					$direction='l';
					$prevPostion=$prevPostion-1;
					++$x;
				}	
			}	
		}
	}
	
	
	$prevChar=$currentChar;
	echo $lineNumber." ".$prevPostion."(".$pathArray[$lineNumber][$prevPostion].")";
	if($pathArray[$lineNumber][$prevPostion]==' '){

		$end=true;
	}

	echo "<br>";
}


foreach($charArray as $key => $value){
	echo $value;
}
echo "<br>";
echo $x;



?>