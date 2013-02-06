<?php
try{
	Reg::get('needCaptcha');
}
catch (Exception $e){
	redirect(SITE_PATH);
}
