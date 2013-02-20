<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {draw_countries} function plugin
 *
 * Type:     function
 * Name:     draw_countries
 * Purpose:  returns countries html code (<option> tags)
 * @param integer $selected_country_id
 * @return 	 string
 */
function smarty_function_draw_countries($params, &$smarty){
	$selected_country_id = null;
	
	extract($params);
	
	$config = ConfigManager::getGlobalConfig();
	
	if(!empty($selected_country_id) and !is_numeric($selected_country_id)){
		throw new InvalidArgumentException("draw_countires smarty function should get integer \$selected_country_id");
	}
	
	$already_selected=false;
	$countries=Reg::get('gps')->getChildren(0);
	$ret_val = '<option value="">---------------</option>';
	foreach($config->domains->important_countries->toArray() as $country_name=>$const){
		$country_id = Reg::get('gps')->getIdByName($country_name, 5, false);
		
		$selected_str='';
		if($selected_country_id == $country_id){
			$selected_str = ' selected';
			$already_selected=true;
		}
		$ret_val .= '<option value="'.$country_id.'"'.$selected_str.'>'.constant($const).'</option>';
	}

	$ret_val .= '<option value="0" disabled>---------------</option>';


	foreach ($countries as $country){
		$selected_str='';
		if(!$already_selected and $selected_country_id == $country['id']){
			$selected_str = ' selected';
		}
		$ret_val .= '<option value="'.$country['id'].'"'.$selected_str.'>'.$country['name'].'</option>';
	}
	
	return $ret_val;
}
