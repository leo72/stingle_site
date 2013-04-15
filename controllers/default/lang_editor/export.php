<?php
	if(!empty($_POST['ids'])) {
		$lmConst = array();
		$constKeyFlags = array();
		$constArray = $_POST['ids'];
		foreach ($constArray as $constant) {
			
			$constFields = explode(':', $constant);
			$lang = new Language($constFields[2]);
			$lcm = new LanguageManager($lang);
			$key = $constFields[1];
			$value = addslashes(htmlspecialchars($lcm->getValueOf($key, $lang)));
			$type = $lcm->getConstantType($key);
			
			if(!in_array($key, $constKeyFlags)) {
				$lmConst[] = "INSERT IGNORE INTO `lm_constants` (`key`, `type`) VALUES ('$key',  '$type')";
				$constKeyFlags[] = $key;
			}
			
			$lmConst[] = "INSERT INTO `lm_values` (`id`, `lang_id`, `value`) 
							SELECT (SELECT `id` FROM `lm_constants` WHERE `key` = '$key') as `id`, 
					'$lang->id', '$value' ON DUPLICATE KEY UPDATE `value`='$value', `lang_id`='$lang->id'"; 
		}
		Reg::get('smarty')->assign('ConstExports', $lmConst);
	}
