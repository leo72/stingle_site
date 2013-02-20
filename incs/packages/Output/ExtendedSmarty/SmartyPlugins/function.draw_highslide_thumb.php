<?php
/*
 * Requires includeHighslideScripts() to be called before use.
 */

function smarty_function_draw_highslide_thumb($params, &$smarty){
	global $photoConfig;
	
	$user = null;
	$size = null;
	$approved_only = null;
	
	extract($params);
	
	$photos = getPhotoGalleryForHighslide($user, $approved_only);
	
	$smarty->assign('defaultPhoto', $photos['defaultPhoto']);
	$smarty->assign('photos', $photos['photos']);
	$smarty->assign('img_no_photo', getUserNoPhotoThumb($size, $user->props->sex));
	$smarty->assign('thumbSize', $size);
	
	return $smarty->fetch($smarty->getChunkPath("highslideThumb.tpl"));
}