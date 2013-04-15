<?php
Reg::get('formKey')->validate((isset($_GET['key']) ? $_GET['key'] : null));

$session_logger->clearLog(MySqlQuery::LOGGER_NAME);
redirect(SITE_PATH . Reg::get('nav')->module ."/".Reg::get('nav')->page);
