<?php
/**
 * @param string $string
 * @return string
 */

function smarty_function_get_gps_node_tree($params, &$smarty){
	$leaf = null;
	$delimiter = null;
	$depth = null;
	$start_level = null;
	
	extract($params);
	
	return get_gps_node_tree($leaf, $delimiter, $depth, $start_level);
}
