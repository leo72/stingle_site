<?php
$display_log = array();
$qlog = $session_logger->getLog(MySqlQuery::LOGGER_NAME);

foreach($qlog as $log_row){
	if(preg_match('/^((insert)|(delete)|(update))/i', $log_row)){
		array_push($display_log, htmlspecialchars($log_row));
	}
}

Reg::get('smarty')->assign("qlog",$display_log);
