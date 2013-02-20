<?php
/**
 * Get profile link
 *
 * @param user object $user
 * @return string
 */
function smarty_modifier_get_profile_link($string, $user){
	return $string . get_profile_link($user);
}
