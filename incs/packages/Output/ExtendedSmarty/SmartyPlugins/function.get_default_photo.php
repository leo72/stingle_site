<?php
/**
 * Get default photo
 *
 * @param int $usr_id
 * @param int $size (1-small, 2-med, 3-big)
 * @param string no_photo
 * @return string
 */
function smarty_function_get_default_photo($params, &$smarty){
	$usr_id = null;
	$size = null;
	$no_photo = null;
	
	extract($params);
	
	return getDefaultPhoto($usr_id, $size, $no_photo);
}
