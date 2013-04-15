<?php
if(!empty($_POST["r"]["email"])){
	if(Reg::get('userMgr')->isUserExists($_POST["r"]["email"], 0)){
		$emailIsAvailable = false;
	}
	else{
        $emailIsAvailable = true;
	}
    Reg::get('uo')->set('isAvailable', $emailIsAvailable);
}
else{
    Reg::get('error')->add("Email is not set!");
}

