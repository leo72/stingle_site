<?php
/**
 * Sets smiley images into text constants
 *
 * @param string $string
 * @return string
 */

function smarty_modifier_translate_smilies($string){
	global $smilies;
	$sml_vals = array_map("add_img_tag", array_values($smilies));
	return str_replace(array_keys($smilies), $sml_vals, $string);
}
