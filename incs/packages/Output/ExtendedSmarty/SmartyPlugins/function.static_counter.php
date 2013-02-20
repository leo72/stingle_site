<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {loop} function plugin
 *
 * Type:     function<br>
 * Name:     sprintf<br>
 * Purpose:  same as in php
 * @author   Alex Amiryan
 * Input:
 *         - value = value to return
 *         - count = number of steps to return
 *         - name = name of the loop
 *         - dofirst = return or not on first step
 *         - do_x_times = return only x times, not more
 * @return string
 */

function smarty_function_static_counter($params, &$smarty){
	static $static_counter;
	extract($params);
	if (isset($increment)){
		$static_counter++;
	}
	else{
		return $static_counter;
	}
}
