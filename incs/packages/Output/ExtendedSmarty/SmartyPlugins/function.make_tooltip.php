<?php
function smarty_function_make_tooltip($params, &$smarty){
	global $relation_types, $sexes;
	extract($params);
	if(empty($user_id)){
		return false;
	}
	try{
		Reg::get('usr')=Reg::get('userMgr')->getUserById($user_id);
	}
	catch (UserNotFoundException $e){
		return false;
	}
	$fields='<strong>'.NAME.': </strong>'.Reg::get('usr')->login.'<br>';
	$fields.='<strong>'.SEX.': </strong>'.constant($sexes[Reg::get('usr')->props->sex]).'<br>';
	$fields.='<strong>'.REL_TYPE.': </strong>'.constant($relation_types[Reg::get('usr')->props->relation]).'<br>';
	$fields.='<strong>'.AGE_TEMP.': </strong>'.get_age(Reg::get('usr')->props->birthdate). ' ' . YEARS_OLD . '<br>';
	$node_tree=Reg::get('gps')->getNodeTree(Reg::get('usr')->props->gps);
	foreach ($node_tree as $node){
		$fields.='<strong>'.Reg::get('lm')->getValueOf($node['type_name']).': </strong>'.$node['name']. '<br>';
	}
	$fields.='<strong>'.IS_USR_ONLINE.': </strong>'.((Reg::get('usr')->props->online==1 or Reg::get('usr')->props->online==3 or Reg::get('usr')->props->online==4) ? YES : NO) . '<br>';
	$fields=base64_encode($fields);
	//return 'onMouseOver="tooltipObj.showWithTimeout(100, Base64.decode(\'' . $fields. '\'))" onMouseMove="tooltipObj.show(Base64.decode(\'' . $fields  . '\'))" onMouseOut="tooltipObj.hideWithTimeout(50)"';
	return "onmouseover=\"tooltipObj.ShowTooltip(Base64.decode('$fields') )\" onmouseout=\"tooltipObj.HideTooltip()\"";
}
