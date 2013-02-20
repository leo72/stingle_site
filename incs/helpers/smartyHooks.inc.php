<?php
function commonLayoutInit(){
	Reg::get('smarty')->addCustomHeadTag('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />');
	
	Reg::get('smarty')->addCustomHeadTag('<!--[if IE 8]>
			<link rel="stylesheet" href="'.SITE_PATH.'view/templates/default/css/ie8.css" type="text/css" />
			<![endif]-->');
	
	Reg::get('smarty')->addCustomHeadTag('<!--[if IE 7]>
			<link rel="stylesheet" href="'.SITE_PATH.'view/templates/default/css/ie7.css" type="text/css" />
			<![endif]-->');
	
	//Reg::get('smarty')->addCustomHeadTag('<link rel="shortcut icon" href="'.SITE_PATH.Reg::get('smarty')->getFilePathFromTemplate('img/favicon.ico', true).'" />');
	
}


function smartyAssigns(){
	$config = ConfigManager::getGlobalConfig();
}


function initTemplate_default(){
		Reg::get('smarty')->addPrimaryCssSmart('main.css');
}