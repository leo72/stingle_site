<?php
function commonLayoutInit(){
	Reg::get('smarty')->addCustomHeadTag('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />');
	
	Reg::get('smarty')->addCustomHeadTag('<!--[if IE 8]>
			<link rel="stylesheet" href="'.SITE_PATH.'view/templates/default/css/ie8.css" type="text/css" />
			<![endif]-->');
	
	Reg::get('smarty')->addCustomHeadTag('<!--[if IE 7]>
			<link rel="stylesheet" href="'.SITE_PATH.'view/templates/default/css/ie7.css" type="text/css" />
			<![endif]-->');
	
	Reg::get('smarty')->addPrimaryJs("http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js");
	Reg::get('smarty')->addPrimaryJs("http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js");
	Reg::get('smarty')->addPrimaryCss("jquery-ui-1.10.2.custom.min.css");



	Reg::get('smarty')->addJs("common.js");
	
	//Reg::get('smarty')->addCustomHeadTag('<link rel="shortcut icon" href="'.SITE_PATH.Reg::get('smarty')->getFilePathFromTemplate('img/favicon.ico', true).'" />');
	
}


function smartyAssigns(){

	$config = ConfigManager::getGlobalConfig();
    Reg::get('smarty')->assign('config', $config->toArray(true));
    Reg::get('smarty')->assign('error', Reg::get('error'));
    Reg::get('smarty')->assign('info', Reg::get('info'));
    Reg::get('smarty')->assign('formKey', Reg::get('formKey'));
    Reg::get('smarty')->assign('host', Reg::get('host'));
    Reg::get('smarty')->assign('language', Reg::get('language'));

    if(isAuthorized()){
        Reg::get('smarty')->assign('usr', Reg::get('usr'));
    }
}


function initTemplate_default(){
		Reg::get('smarty')->addPrimaryCssSmart('main.css');
}