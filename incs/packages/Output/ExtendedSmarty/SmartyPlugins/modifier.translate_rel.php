<?php
/**
 * @param string $string
 * @return string
 */

function smarty_modifier_translate_rel($string, $lang_id=0){
	global $relation_types;
	
	if(!empty($lang_id)){
		return Reg::get('lm')->getValueOf($relation_types[$string],$lang_id);
	}
	else{
		return constant($relation_types[$string]);
	}
}
