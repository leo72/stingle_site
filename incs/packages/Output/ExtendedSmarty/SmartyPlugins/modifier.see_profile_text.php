<?php
/**
 * @param int $userSex
 * @return string
 */

function smarty_modifier_see_profile_text($userSex){
	global $sexes;
	switch($sexes[$userSex]){
		case 'MALE':
			return SEE_HIS_PROFILE;
			break;
		case 'FEMALE':
			return SEE_HER_PROFILE;
			break;
		case 'COUPLE':
			return SEE_THEIR_PROFILE;
			break;
		/*default:*/			
	}
}
