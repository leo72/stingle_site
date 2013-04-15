<?php
Reg::get('formKey')->validate($_POST['formKey']);

if(($_POST['key'] == '')){
	die("Input KEY");
}
if(($_POST['value'] == '')){
	die("Input VALUE");
}

if(Reg::get('lm')->updateConstant(
							$_POST['old_key'],
							new Language($_POST['old_lang_id']),
							$_POST['key'],
							$_POST['value'],
							new Language($_POST['lang_id']),
							$_POST['type']
						)){
	deleteMemcacheKeys("LanguageManager");
	redirect(SITE_PATH . Reg::get('nav')->module);
}
