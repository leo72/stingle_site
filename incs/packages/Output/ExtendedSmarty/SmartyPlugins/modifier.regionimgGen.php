<?php
/**
 * Generate image cache and return resulting 
 * file path to show in HTML
 *
 * @param string $fileName
 * @param string $sizeName
 * @return string
 */
function smarty_modifier_regionimgGen($image, $sizeName){
	$resultingFilePath = "";
	if(empty($image) or empty($sizeName)){
		return;
	}
	
	try{
		$resultingFilePath = getModifiedImageWithCache($image->fileName, $sizeName);
	}
	catch(RuntimeException $e){
		//$resultingFilePath = getNoPhotoThumb($sizeName, $userSex);
		//TODO: exception 
	}
	return SITE_PATH .$resultingFilePath;
}
