<?php

	require_once("config.php");
	
	if (empty($e)){
	    $data = unserialize(@file_get_contents("cookie".$user."data.txt"));
	    $e = $data["session"];
	}
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'User-Agent: '.$_SERVER['HTTP_USER_AGENT'],
        'Referer: https://'.$d.'/wheel.php',
        'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
        'X-Requested-With: XMLHttpRequest'
    ]);
	curl_setopt($ch, CURLOPT_URL, "https://".$d."/_session_update.php");
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie".$user.".txt");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "resres=update&klks=".$e);
    $cnt = curl_exec($ch);
	curl_close($ch);
	echo $cnt;