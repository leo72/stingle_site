<?php
if(isInProductionMode() and !Reg::get('usr')->hasGroup(DatingClubUserManager::GROUP_ADMINS)){
	redirect(SITE_PATH);
}

Reg::get('smarty')->setLayout("cleanHtml");
Reg::get('smarty')->addJsSmart("langEditor.js");
Reg::get('smarty')->setWrapper("lang_editor");

$session_logger = new SessionLogger();

Reg::get('lm')->setLogging(true);
Reg::get('lm')->setLogger($session_logger);
