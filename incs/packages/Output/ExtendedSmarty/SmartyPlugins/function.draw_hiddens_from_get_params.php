<?php
/**
 * Draw Hiddens from get params
 *
 * @param $online
 * @return string
 */
function smarty_function_draw_hiddens_from_get_params($params, &$smarty){
	extract($params);
	$exclude_array = explode(",", $exclude);
	return draw_hiddens_from_get_params($exclude_array);
}

function draw_hiddens_from_get_params($exclude_array = '') {
	if (!is_array($exclude_array)) $exclude_array = array();
	$hiddens = '';
	if (is_array($_GET) && (sizeof($_GET) > 0)) {
		reset($_GET);
		while (list($key, $value) = each($_GET)) {
			if ( (strlen($value) > 0) && (!in_array($key, $exclude_array))) {
				$hiddens .= '<input type="hidden" name="'.$key.'" value="'.$value.'">';
			}
		}
	}

	return $hiddens;
}
