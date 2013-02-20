<?php
function smarty_function_get_region_specific_link($params, &$smarty){
	$region_id = null;
	$rel_id = null;
	
	extract($params);
	
	return getRegionSpecificLink($region_id, $rel_id);
}
