<?php

    if (!$target){
        echo "ERROR";
        exit;
    }
    
	$value = cut($cnt, 'ancklanlkn:[', ']');
	$parcel = cut($cnt, "bbc7=", ";");
	$accept1 = cut($cnt, "date_prz = [", ',"NULL"');
	$accept2 = cut($cnt, "hasil_prz = [", ',"NULL"');
	$total = cut($cnt, 'numb_kupn = ', ';');
	$session = cut($cnt, "gassxx= '", "'");
	$result = cut($cnt, 'clinkclank = "', '";');
	echo json_encode([
	    "value" => json_decode("[".$value."]"),
	    "result" => $result,
	    "bonus" => $total,
	    "session" => $session,
	    "parcel" => json_decode($parcel),
	    "accept" => json_decode("[".$accept1.",".$accept2."]")
	]);