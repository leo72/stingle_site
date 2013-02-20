<?php
/**
 * Smarty modifier to get pass constant from given type
 * @example {1|translate_pass} 
 * @param String $string
 * @param Integer $lang_id
 * @return String
 */
function smarty_modifier_translate_pass($string, $lang_id=0){
	$passTypes = $GLOBALS["passTypes"];
	if(key_exists($string, $passTypes)){
		if(!empty($lang_id)){
			return Reg::get('lm')->getValueOf($passTypes[$string],$lang_id);
		}
		else{
			return constant($passTypes[$string]);
		}
	}
	else{
		return $string;
	}
}
