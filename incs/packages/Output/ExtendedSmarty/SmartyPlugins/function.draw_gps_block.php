<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {draw_gps_block} function plugin
 *
 * Type:     function
 * Name:     draw_gps_block
 * Purpose:  returns gps tree html code using template
 * 
 * @param string $tpl Field template path
 * @param boolean $customs Show customs or not (shows by default)
 * @param array $data Field values equal to $_POST by default
 * @example var_dump output
 * 		$data = array(3) {
 *			  [5] => string(2) "59"
 *			  [10] => string(4) "1165"
 *			  ["customs"] => array(2) {
 *			    [2] => string(7) "MyCity"
 *			    [1] => string(4) "MyZipCode000"
 *			  }
 *		}
 *
 * @return string
 */
function smarty_function_draw_gps_block($params, &$smarty)
{
	
	/**
	 * Field template path
	 * 
	 * @var string $templatePath
	 */
	$data = empty($params["data"]) ? parseGpsFormData() : $params["data"];

	/**
	 * Parameter to whether to show or not custom fields
	 * 
	 * @var boolean $showCustoms
	 */
	$showCustoms = empty($params["customs"]) ? true : false;
	
	/**
	 * Output string
	 * 
	 * @var string $gpsFields
	 */	
	$gpsFields = "";
	
	/**
	 * Zero value for generated comboboxes
	 */
	$zeroValueNode = array("id" => "", "name" => "---------------");
	
	
	$currentLeafId = Gps::ROOT_NODE;
	
	// Get country id to show fields labels correctly
	if(empty($data[5])){
		$countryId = 0;
	}
	else{
		$countryId = $data[5]; 
	}
		
	while(
		// Chacking if current leaf has children
		($childrenCount = Reg::get('gps')->getChildrenCount($currentLeafId)) |
		// Or has custom fields to show
		($showCustoms and $customFields = Reg::get('gps')->fieldsToShow($currentLeafId))
	){
		
		// Reseting type value
		$type = null;
		
		if($childrenCount){
			// Current leaf children's type
			$type = Reg::get('gps')->getChildrenType($currentLeafId);
			
			// Fetching current leaf children
			$nodes = Reg::get('gps')->getChildren($currentLeafId);
			array_unshift($nodes, $zeroValueNode);
			
			$value = null;
			if(isset($data[$type['id']])){
				$value = $data[$type['id']];
			}
			
			// Adding custom nodes in case when field is a country
			if($type["id"] == 5){
				unshiftImportantCountries($nodes);
				if(empty($data[$type['id']])){
					$value = Reg::get('geoGps')->getCountryGpsByIP();
					$data[$type['id']] = $value;
					$countryId = $value;
				}
			}
			
			// Collecting current field params for template
			$field = array(
				"id"	=> $type['id'],
				"name"	=> constant(Reg::get('gps')->getTypeLabel($type['type'],$countryId)),
				"value"	=> $value
			);
			
			$smarty->assign("field", $field);
			$smarty->assign("nodes", $nodes);
			$gpsFields .= $smarty->fetch($smarty->getChunkPath($params["chunk"]));
			
		}
		
		if($showCustoms and count($customFields)){
			// Adding them into $gpsFields array
			foreach($customFields as $customId){
				// Collecting custom field params for template
				$field = array(
					"id"	=> $customId,
					"name"	=> constant(Reg::get('gps')->getFieldName($customId)),
					"value"	=> $data["customs"][$customId],
				);
				
				$smarty->assign("field", $field);
				$smarty->assign("nodes", null);
				$gpsFields .= $smarty->fetch($smarty->getChunkPath($params["chunk"]));
			}
		}
		
		if(empty($data[$type['id']])){
			break;
		}
		else{
			$currentLeafId = $data[$type['id']];
		}
	}
	
	return $gpsFields;
}
