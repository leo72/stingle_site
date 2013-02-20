<?php
/**
 * @param string $string
 * @return string
 */

function smarty_modifier_get_country_by_gps($leaf){
	$node_tree=Reg::get('gps')->getNodeTree($leaf);
	foreach ($node_tree as $node){
		if($node['type_name']=='COUNTRY'){
			return $node['name'];
		}
	}
	return false;
}
