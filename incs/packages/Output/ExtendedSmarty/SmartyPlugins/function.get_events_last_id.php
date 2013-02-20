<?php
/**
 * Get comet events last ID
 *
 * @return integer
 */
function smarty_function_get_events_last_id($params, &$smarty){
	return Reg::get('cometEvents')->getEventsLastId();
}
