<?php

    require_once("config.php");
    
    if (file_exists("cookie".$user."data.txt") && empty($target)){
	    $data = unserialize(file_get_contents("cookie".$user."data.txt"));
	    $target = $data["target"];
    }
    
    $key = array_search($target, $var);
	if ($key != NULL){
    	
		$ch = curl_init();
    	curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: '.$_SERVER['HTTP_USER_AGENT'],
            'Referer: https://'.$d.'/wheel.php',
            'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            'X-Requested-With: XMLHttpRequest'
        ]);
		curl_setopt($ch, CURLOPT_URL, "https://".$d."/bq2.php");
    	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie".$user.".txt");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'resres='.$res[$key].'&res='.$res[$key]);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
		curl_close($ch);
		if (isset($error_msg)){
        	echo "ERROR";
		    exit;
        }
		unlink("cookie".$user."data.txt");
		exit;
	}
	
	echo "ERROR";