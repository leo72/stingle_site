<?php
function setSitePath(){
	define('SITE_PATH',ConfigManager::getConfig("RewriteURL")->AuxConfig->site_path);
}


function requestLimiterHandler($params){
	extract($params);
	
	if(is_a($e, "RequestLimiterBlockedException")){
		Reg::register("needCaptcha", true);
		if(!isset($_GET['ajax']) or empty($_GET['ajax'])){
			if(isset($_GET['module']) and $_GET['module'] == 'captcha'){
				$error = false;
				if (isset($_POST["recaptcha_response_field"])) {
					$resp = Reg::get('recaptcha')->checkAnswer($_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

					if ($resp->is_valid){
						Reg::get(ConfigManager::getConfig("Security", "RequestLimiter")->Objects->RequestLimiter)->unblockIP();
						redirect(SITE_PATH);
					} 
					else{
						$error = true;
        			}
				}
				Reg::get('smarty')->assign("error", $error);
				Reg::get('smarty')->setLayout("cleanHtml");
				Reg::get('smarty')->output();
				exit;
			}
			else{
				redirect(SITE_PATH . 'captcha');
			}
		}
		else{
			JSON::jsonOutput(array('redirect'=>SITE_PATH));
			exit;
		}
	}
}

function localNoDebugExceptionHandler($params){
	extract($params);
	
	$doNotRecordOnExceptions = array(	"DatingClubAuthorizeException",
										"IPBlockedException", 
										"SecurityException",
										"RequestLimiterBlockedException",
										"FormKeySecurityException");
	
	if(!in_array(get_class($e), $doNotRecordOnExceptions)){
		$config = ConfigManager::getGlobalConfig();
		if(Reg::isRegistered('sql') and Reg::get('packageMgr')->isPluginLoaded('Logger', 'DBLogger')){
			@DBLogger::logCustom("Exception", format_exception($e));
		}
	
		if($config->Debug->send_email_on_exception and Reg::isRegistered('mail')){
			Reg::get('mail')->developer("Exception", format_exception($e, true));
		}
	}
}

function localExceptionHandler($params){
	extract($params);
	
	if(empty($_GET['ajax'])){
		$smartyConfig = ConfigManager::getConfig("Output", "Smarty")->AuxConfig;
		if(is_a($e, "MySqlException")){
			if(!Reg::get('smarty')->isInitialized()){
				Reg::get('smarty')->initialize(	'module', 'page', ConfigManager::getConfig("Output", "Smarty")->AuxConfig);
			}
			Reg::get('smarty')->removeWrapper();
			echo Reg::get('smarty')->fetch(Reg::get('smarty')->getFilePathFromTemplate(Reg::get('smarty')->modulesPath . $smartyConfig->errorPage . '.tpl'));
		}
		elseif(is_a($e, "DatingClubAuthorizeException")){
			redirect(SITE_PATH);
		}
		elseif(is_a($e, "IPBlockedException")){
			header("HTTP/1.1 301 Moved Permanently");
			echo "<h1>Website unavailable</h1>";
			exit;
		}
		elseif(is_a($e, "SecurityException")){
			redirect(SITE_PATH);
		}
		else{
			if(!Reg::get('smarty')->isInitialized()){
				Reg::get('smarty')->initialize(	'module', 'page', ConfigManager::getConfig("Output", "Smarty")->AuxConfig);
			}
			Reg::get('smarty')->removeWrapper();
			echo Reg::get('smarty')->fetch(Reg::get('smarty')->getFilePathFromTemplate(Reg::get('smarty')->modulesPath . $smartyConfig->exceptionPage . '.tpl'));
		}
	}
	else{
		JSON::jsonOutput(array('redirect'=>SITE_PATH));
	}
	
}

