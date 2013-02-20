<?php
/**
 * @param string $string
 * @return string
 */

function smarty_function_get_gps_search_string($params, &$smarty){
	extract($params);
	if(empty($leaf)){
		return false;
	}
	if(!isset($delimiter)){
		$delimiter='/';
	}
	if(!isset($eq_sign)){
		$eq_sign=':';
	}
	if(!isset($depth)){
		$depth=0;
	}
	$node_tree=Reg::get('gps')->getNodeTree($leaf);
	if(!isset($start_level)){
		$start_level = 0;
	}
	$return_string='';
	$count=0;
	foreach ($node_tree as $node){
		$count++;
		if($count < $start_level + 1){
			continue;
		}
		$return_string .= "type_" . $node['type_id'] . $eq_sign . $node['node_id'] . $delimiter;
		if($depth>0 and $count==$depth){
			break;
		}
	}
	$return_string=substr($return_string,0,strlen($return_string)-strlen($delimiter));
	return $return_string;
}
