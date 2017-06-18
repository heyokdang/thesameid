<?php

$aa = array("aaa","bbb","ccc","ddd","eee","fff","ggg");

$x = 5;

$i = 0;

while(count($aa)>$i){
	echo "<br>\n";
	echo $aa[$i];
	unset($aa[$i]);
	$aa[] = $x + 1;
	$aa[] = $x + 2;
	$aa[] = $x + 3;
	$x = $x + 3;
	$i++;
	if($i==20) break;
}

echo "<br>\n";
echo "<br>\n";
echo count($aa);
echo "<br>\n";
echo "<br>\n";
var_dump($aa);


$bb = array();
$bb[] = 1;
$bb[] = 2;
$bb[] = 3;
$bb[] = 4;
$bb[] = 5;
$bb[] = 6;
$bb[] = 7;
$bb[] = 8;
$bb[] = 9;
$bb[] = 10;
unset($bb[0]);
unset($bb[1]);
unset($bb[2]);
unset($bb[3]);
var_dump($bb);

$cc = array();
$cc[] = 1;
$cc[] = 2;
$cc[] = 3;
$cc[] = 4;
$cc[] = 5;
var_dump($cc);
$result = array_unique(array_merge($bb, $cc));
var_dump($result);
$result = $bb + $cc;
var_dump($result);



