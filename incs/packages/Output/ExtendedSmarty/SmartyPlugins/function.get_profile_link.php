<?php
/**
 * Get profile link
 *
 * @param user object $user
 * @return string
 */
function smarty_function_get_profile_link($params, &$smarty){
	extract($params);
	
	if(is_numeric($user)) {
		try{
	       $user = Reg::get('userMgr')->getUserById($user, UserManager::INIT_PROPERTIES);
		}
		catch(Exception $e){
			return SITE_PATH;
		}
	}
	elseif(is_string($user)) {
		$usersFilter = new UsersFilter();
		$usersFilter->setEnabledStatus(UserManager::STATE_ENABLED_ENABLED);
		$usersFilter->setLogin($user);
	    try{
	    	$user = Reg::get('userMgr')->getUser($usersFilter, UserManager::INIT_PROPERTIES);
	    }
	    catch (Exception $e){
	    	return SITE_PATH;
	    }
	}
	
	return get_profile_link($user);
}
