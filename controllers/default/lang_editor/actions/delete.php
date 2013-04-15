<?php
Reg::get('formKey')->validate((isset($_POST['fkey']) ? $_POST['fkey'] : (isset($_GET['fkey']) ? $_GET['fkey'] : null)));

	if(!empty($_POST['ids'])) {
		$constIds = $_POST['ids'];
		foreach ($constIds as $constId) {
			$constArray = explode(':', $constId);
			$lang = new Language($constArray[2]);
			$lcm = new LanguageManager($lang);
			$lcm->setLogging(true);
			$lcm->setLogger($session_logger);
			$lcm->removeConstantValue($constArray[1], $lang);
			deleteMemcacheKeys("LanguageManager");
		}
		redirect(Reg::get('rewriteURL')->glink("lang_editor"));
	}
 	else {
 		if(!empty($_GET["lang_id"])) {
			$lng = new Language($_GET["lang_id"]);
			$lcm = new LanguageManager($lng);
			$lcm->setLogging(true);
			$lcm->setLogger($session_logger);
			if($lcm->removeConstantValue($_GET['key'], $lng)){
				deleteMemcacheKeys("LanguageManager");
				redirect(Reg::get('rewriteURL')->glink("lang_editor"));
			}
		}
	}
