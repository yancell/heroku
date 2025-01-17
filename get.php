<?php

	require_once("config.php");

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'User-Agent: '.$_SERVER['HTTP_USER_AGENT']
    ]);
	curl_setopt($ch, CURLOPT_URL, $e);
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie".$user.".txt");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_exec($ch);
	curl_close($ch);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'User-Agent: '.$_SERVER['HTTP_USER_AGENT'],
        'Referer: https://'.$d.'/auth/select_game_v2.php'
    ]);
	curl_setopt($ch, CURLOPT_URL, "https://".$d."/var_api.php");
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie".$user.".txt");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$cnt = curl_exec($ch);
	curl_close($ch);
	
	require_once("wheel.php");