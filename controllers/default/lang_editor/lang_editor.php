<?php
$pager = new MysqlPager(50);

$lcm = new LanguageManager();
$lang_constants  = $lcm->getConstsList(null,null,false,$pager);

foreach ($lang_constants as &$lc){
	$lc['value'] = htmlspecialchars($lc['value']);
	$language = new Language($lc['lang_id']);
	$lc['lang_name'] = $language->shortName;
}

Reg::get('smarty')->assign("lang_constants",$lang_constants);
