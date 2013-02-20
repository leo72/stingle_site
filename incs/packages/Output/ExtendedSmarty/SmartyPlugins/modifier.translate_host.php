<?php
/**
 * @param string $string
 * @return string
 */

function smarty_modifier_translate_host($hostId){
	
	if(!empty($hostId)){
		try{
			$host= new Host($hostId);
			return $host->host;
		}
		catch(Exception $e){
			//TODO: exception 
		}
	}
	return $hostId;
}
