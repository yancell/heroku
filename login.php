<?php

	require_once("config.php");
    
    echo "http://".$d."/auth/login_defor.php?userid=".$c."&sessid=".uniqid() . time()."&access_token=f2c80df303965957c33351982b173c04&sesskey=".uniqid() . time()."&is_kyc=false";