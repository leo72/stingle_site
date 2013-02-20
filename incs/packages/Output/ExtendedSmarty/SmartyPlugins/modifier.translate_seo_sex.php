<?php
/**
 * @param string $string
 * @return string
 */
function smarty_modifier_translate_seo_sex($string, $lang_id=0){
	global $seo_sexes;

	if(!empty($lang_id)){
		return Reg::get('lm')->getValueOf($seo_sexes[$string],$lang_id);
	}
	else{
		return constant($seo_sexes[$string]);
	}
}
