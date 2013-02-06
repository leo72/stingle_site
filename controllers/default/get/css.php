<?php
if(isset($_GET['name']) and !empty($_GET['name'])){
	header("Content-Type: text/css");
	$path = null;
	if(isset($_GET['path']) and !empty($_GET['path'])){
		$path = base64_decode($_GET['path']);
	}
	
	$filePath = Reg::get('smarty')->findFilePath("css/" . base64_decode($_GET['name']), $path);
	echo Reg::get('smarty')->fetch($filePath);
}
exit;
