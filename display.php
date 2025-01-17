<?php

	require_once("config.php");
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'User-Agent: '.$_SERVER['HTTP_USER_AGENT'],
        'Referer: https://'.$d.'/auth/select_game_v2.php'
    ]);
	curl_setopt($ch, CURLOPT_URL, "https://".$d."/wheel.php");
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie".$user.".txt");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$cnt = curl_exec($ch);
	curl_close($ch);
	
	require_once("wheel.php");