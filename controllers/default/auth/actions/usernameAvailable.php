<?php
if(!empty($_POST["r"]["username"])){
	if(Reg::get('userMgr')->isUserExists($_POST["r"]["username"], 0)){
		$usernameIsAvailable = false;
	}
	else{
        $usernameIsAvailable = true;
	}
    Reg::get('uo')->set('isAvailable', $usernameIsAvailable);
}
else{
    Reg::get('error')->add("Username is not set!");
}

