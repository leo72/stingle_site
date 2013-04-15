<?php
$const = Reg::get('lm')->search(null,null, null,"lc.`key`='".mysql_real_escape_string($_GET["key"])."' AND cv.`lang_id`='".mysql_real_escape_string($_GET['lang_id']). "'");

$language = new Language($const[0]["lang_id"]);
Reg::get('smarty')->assign("const", $const[0]);
Reg::get('smarty')->assign("language", $language->shortName);
Reg::get('smarty')->assign('languages', Language::getAllLanguages());
Reg::get('smarty')->assign('types', Constant::getAvailableTypes());
Reg::get('smarty')->assign("back_url", $_SERVER['HTTP_REFERER']);
