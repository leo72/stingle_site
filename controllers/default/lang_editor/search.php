<?php
Reg::get('smarty')->assign('types', Constant::getAvailableTypes());
Reg::get('smarty')->assign('languages', Language::getAllLanguages());

if(!empty($_GET['do'])){
	$where = '';
	if(($_GET['key'] != '')){
		if($where != ''){
			$where .= " AND ";
		}
		$where .= "lc.`key` LIKE('".mysql_real_escape_string($_GET['key'])."')";
	}
	if(($_GET['value'] != '')){
		if($where != ''){
			$where .= " AND ";
		}
		$where .= "cv.`value` LIKE('".mysql_real_escape_string($_GET['value'])."')";
	}
	if(($_GET['lang'] != 0)){
		if($where != ''){
			$where .= " AND ";
		}
		$where .= "cv.`lang_id` = '".mysql_real_escape_string($_GET['lang'])."'";
	}
	if(($_GET['type'] != 0)){
		if($where != ''){
			$where .= " AND ";
		}
		$where .= "lc.`type` = '".mysql_real_escape_string($_GET['type'])."'";
	}
	
	$pager = new MysqlPager(50);
	$const = Reg::get('lm')->search(null, null, $pager, $where);
	
	foreach($const as &$lc){
		$lc['value'] = htmlspecialchars($lc['value']);
		$language = new Language($lc['lang_id']);
		$lc['lang_name'] = $language->shortName;
	}
	
	Reg::get('smarty')->assign("lang_constants", $const);
	Reg::get('smarty')->setPath("lang_editor/lang_editor");
}
