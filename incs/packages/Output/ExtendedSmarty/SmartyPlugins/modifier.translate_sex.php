<?php
/**
 * @param string $string
 * @return string
 */
function smarty_modifier_translate_sex($string, $lang_id=0){
	$sexes = $GLOBALS["sexes"];
	if(key_exists($string, $sexes)){
		if(!empty($lang_id)){
			return Reg::get('lm')->getValueOf($sexes[$string],$lang_id);
		}
		else{
			return constant($sexes[$string]);
		}
	}
	else{
		return $string;
	}
}
