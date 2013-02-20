<?php
/**
 * @param string $string
 * @return string
 */

function smarty_function_getRegisteredUsersCount($params, &$smarty){
	$date = null;
	
	extract($params);
	
	$filter = new DatingClubUsersFilter();
	$filter->setCreationDate($date);
	$filter->setEnabledStatus(UserManager::STATE_ENABLED_ENABLED);
	
	$usersCount = Reg::get('userMgr')->getUsersListCount($filter);
	
	return $usersCount;
}
