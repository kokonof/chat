<?php

	error_reporting(E_ALL ^ E_NOTICE);
	$arr = ['a' => 1];
	$arr['b'];

	$num = mt_rand(1, 10);
	echo $num;

	if($num & 1){
		echo ' - odd';
	}

	