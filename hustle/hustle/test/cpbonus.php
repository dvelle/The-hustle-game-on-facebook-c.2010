<?php
/*
Weighted Random Ver 1.2 by Mgccl(mgcclx@gmail.com)
http://www.webdevlogs.com
Update: Nov/29/06

o Faster Speed
o allow non-weighted random, seprate the string storing array and the weight storing array.

Useage: input $array[$i] = 'string' format(where $i is a number)
    o $array[$i]    is the string you want to return
    o $weight[$i]    is the weight of the string

if one of the $array[$i] does not have a $weight[$i] as a match,
it automatically set $weight[$i] as 1.

To use the weighted function, call the function like this :

    rand_string_pro($array, $weight);
*/

//$bonus = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

//function rand_string_pro($seed, $weighted = false){
//        $count = count($seed);
//        if($weighted === false){
//                return $seed[mt_rand(0, $count - 1)];
//        }else{
//                $i = 0; $n = 0;
//                $num = mt_rand(0, array_sum($weighted) + ($count-count($weighted)));
//                while($i < $count){
//                        if(empty($weighted[$i])){
//                                ++$n;
//                        }else{
//                        $n += $weighted[$i];
//                   }
//                 if($n >= $num){
//                   break;
//             }
//           ++$i;
//     }
//   return $seed[$i];
// }
//}
//smaller
//function weightedrand($min, $max, $gamma) {
//    $offset= $max-$min+1;
//    return floor($min+pow(lcg_value(), $gamma)*$offset);
//}
//$max_cool = 1935000;
//$current_cool = 1835300;
function bonus($level, $rank_title){
	if($rank_title == "Rookie"){
		$r = 1;
	} elseif($rank_title == "Amateur"){
		$r = 2;
	} elseif($rank_title == "Upstart"){
		$r = 3;
	} elseif($rank_title == "Pro"){
		$r = 4;
	} elseif($rank_title == "Boss"){
		$r = 5;
	} elseif($rank_title == "Mastermind"){
		$r = 6;
	} else {
		$r = 7;
	}
	//do the biz!
$level = $level + $r;
$level_number = rand(0,$level);
	if($level_number > 10){
		$level_number = 9;
	}
	$cpb = rand($level_number,10);
	if($cpb > 10){
		$cpb = 10;
	}
	return $cpb;
}
//while($i <= 21){	
//	$r = $i;
	//if($r > 7){
		//$r = 7;
	//}
	//$level = $i;
	//echo "USER LEVEL ".$level. " </br>";
	//$level = $level + $r;
	//$level_number = rand(0,$level);
	//if($level_number > 10){
		//$level_number = 9;
	//}
	//$cpb = rand($level_number,10);
	//if($cpb > 10){
		//$cpb = 10;
	//}
	//echo $cpb."= bonus|</br>";
	//echo "******************** </br>";
//$i++;
//}
?>