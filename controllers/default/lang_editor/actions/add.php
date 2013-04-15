<?php
Reg::get('formKey')->validate($_POST['formKey']);

if(($_POST['key'] == '')){
	die("Input KEY");
}
if(($_POST['value'] == '')){
	die("Input VALUE");
}

if(($_POST['lang'] == '')){
	die("Input LANG");
}
$lng = new Language($_POST['lang']);
$lcm = new LanguageManager($lng);
$lcm->setLogging(true);
$lcm->setLogger($session_logger);
$lcm->addConstant($_POST['key'], $_POST['value'], $_POST['type'], $lng);

deleteMemcacheKeys("LanguageManager");

redirect(Reg::get('rewriteURL')->glink("lang_editor/add/"));
