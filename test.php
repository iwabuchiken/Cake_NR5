<?php

function test_Regex_ShowResult($url, $pattern) {

	echo "url => $url";
	echo "\n";
	
	echo "pattern => $pattern";
	echo "\n";
	
	preg_match($pattern, $url, $matches);
	
	if (count($matches) > 1) {
	
	echo $matches[1];;
	
	} else {
	
	echo "No matches";
	
	}

	echo "\n";
	print_r($matches);
	
}//function test_Regex_ShowResult()

function test_Regex() {

	/******************************
	
		Round: 1
	
	******************************/
	echo "\n";
	echo "=========== <1> ===========";
	echo "\n";
			
	$url = "https://www.youtube.com/watch?v=imc4xQDp_Fs&list=WL&undex=32";

	$pattern = '/\?v=(.+?)&/';
	
	test_Regex_ShowResult($url, $pattern);
	
	echo "\n";
	
	/******************************
	
		Round: 2
	
	******************************/
	echo "\n";
	echo "=========== <2> ===========";
	echo "\n";
			
	$pattern = '/\?v=(.+?)&?/';
	
	test_Regex_ShowResult($url, $pattern);
	
	echo "\n";
	
	/******************************
	
		Round: 3
	
	******************************/
	echo "\n";
	echo "=========== <3> ===========";
	echo "\n";
			
	$pattern = '/\?v=(.+?)&*/';
	
	test_Regex_ShowResult($url, $pattern);
	
	echo "\n";
	
	/******************************
	
		Round: 4
	
	******************************/
	echo "\n";
	echo "=========== <4> ===========";
	echo "\n";
			
// 	$pattern = '/([a-z]+)/g';
	$pattern = '/([a-z]+)/';	// Array
								// (
								//     [0] => https
								//     [1] => https
								// )
// 	$pattern = '/[a-z]+/';
	
	test_Regex_ShowResult($url, $pattern);
	
	echo "\n";
	
	/******************************
	
		Round: 5
	
	******************************/
	echo "\n";
	echo "=========== <5> ===========";
	echo "\n";
			
// 	$pattern = '/([a-z]+)/g';
	$pattern = '/\?v=(.+)?&*/';	// [1] => imc4xQDp_Fs&list=WL&undex=32
	
	test_Regex_ShowResult($url, $pattern);
	
	echo "\n";
	
	/******************************
	
		Round: 6
	
	******************************/
	echo "\n";
	echo "=========== <6> ===========";
	echo "\n";
			
// 	$pattern = '/([a-z]+)/g';
	$pattern = '/\?v=(.+)?&{0,1}/';	//
// 	$pattern = '/\?v=(.+)?&?/';	// [1] => imc4xQDp_Fs&list=WL&undex=32
	
	test_Regex_ShowResult($url, $pattern);
	
	echo "\n";
	
}

function test_ArrayPush() {
	
	$a = array();
	
	$a[0] = array();
	$a[1] = array();
	
	array_push($a[0], 111);
	array_push($a[1], 22);
	
	print_r($a);
	
}

function test_PrefMatch() {

	setlocale(LC_ALL, 'ja_JP.UTF-8');
	
	$s = "関西を医療のメッカに、大阪でフォーラム−有識者8人が議論";
	
	$p = "医療";
	
	$res = preg_match($p, $s, $matches);
	
	echo "\$res => ".$res;
	
	echo "\n";
	
	echo "\$matches => ".$matches;
	
	echo "\n";
	
	echo "mb_strlen => ".mb_strlen($s);
	
	echo "\n";
	
	echo "s => ".$s;
	
	echo "\n";
	
	echo "s, mb_convert_encoding => ".mb_convert_encoding($s, "SJIS", "UTF-8");
	
	echo "\n";
	
	echo "strlen(mb_convert_encoding => ".strlen(mb_convert_encoding($s, "SJIS", "UTF-8"));
	
	echo "\n";
	
	echo "mb_strlen(mb_convert_encoding => "
			.mb_strlen(mb_convert_encoding($s, "SJIS", "UTF-8"));
	
	echo "\n";
	
	echo "mb_strlen(\$s, \"SJIS\") => "
			.mb_strlen($s, "SJIS");
	
	echo "\n";
	
	echo "mb_strlen(\$s, \"UTF-8\") => "
			.mb_strlen($s, "UTF-8");
	
	
	
}

function 
test_PrefMatch_2() {

	setlocale(LC_ALL, 'ja_JP.UTF-8');
	
// 	$s = "関西を医療のメッカに、大阪でフォーラム−有識者8人が議論";
	$s = "関西を医療のメッカに、大阪でフォーラム医療−有識者8人が議論";
	
	$s2 = mb_convert_encoding($s, "SJIS", "UTF-8");
	
	$reg = mb_convert_encoding("医療", "SJIS", "UTF-8");
	
	echo "\$reg => $reg";
	
	$p = "/$reg/";
// 	$p = "/医療/";
	echo "\n";
	
	$res = preg_match($p, $s2, $matches);
	
	echo "\$res => ".$res;
	
	echo "\n";

	print_r($matches);
// 	echo "\$matches => ".$matches;
	
	
	echo "\n";
	
	echo "mb_strlen(\$s, \"UTF-8\") => "
			.mb_strlen($s, "UTF-8");
	
	
	
}//test_PrefMatch2

function 
test_PrefMatch_3__MatchAll() {

	setlocale(LC_ALL, 'ja_JP.UTF-8');
	
// 	$s = "関西を医療のメッカに、大阪でフォーラム−有識者8人が議論";
	$s = "関西を医療のメッカに、大阪でフォーラム医療−有識者8人が議論";
	
	$s2 = mb_convert_encoding($s, "SJIS", "UTF-8");
	
	echo "s2 => $s2";
	
	echo "\n";
	
	$reg = mb_convert_encoding("医療", "SJIS", "UTF-8");
	
	echo "\$reg => $reg";
	
	$p = "/$reg/";
// 	$p = "/医療/";
	echo "\n";
	
	$res = preg_match_all($p, $s2, $matches);
	
	echo "\$res => ".$res;
	
	echo "\n";

	echo "matches----------------------------\n";
	print_r($matches);
// 	echo "\$matches => ".$matches;
	
	
	echo "\n";
	
	//REF http://blog.ishitoya.info/entry/20090707/1246970868
	echo "mb_strlen(\$s, \"UTF-8\") => "
			.mb_strlen($s, "UTF-8");
	
	
	
}//test_PrefMatch_3__MatchAll

function 
test_Replace() {

	setlocale(LC_ALL, 'ja_JP.UTF-8');
	
	// 	$s = "関西を医療のメッカに、大阪でフォーラム−有識者8人が議論";
	$s = "関西を医療のメッカに、大阪でフォーラム医療−有識者8人が議論";
	
	$s2 = mb_convert_encoding($s, "SJIS", "UTF-8");
	
	echo "s2 => $s2";
	
	echo "\n";
	
	$reg = mb_convert_encoding("医療", "SJIS", "UTF-8");

	$res = str_replace($reg, "<b>".$reg."</b>", $s2);
	
	print_r($res);
	
	
}//test_Replace

function execute() {
	
	test_Replace();
// 	test_PrefMatch_3__MatchAll();
// 	test_PrefMatch_2();
// 	test_PrefMatch();
	
// 	test_ArrayPush();
	
// 	test_Regex();
	
}

execute();
