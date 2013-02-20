<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Check if User has given perrmision draw content in block, 
 * else if there is {has_permission_else} block draw thats contnet
 * @param array $params
 * @param string $content
 * @param Smarty $smarty
 * @param Integer $repeat
 */
function smarty_block_has_permission($params, $content, &$smarty, &$repeat) 
{ 
	if(!$repeat) {
      // Get the permission parameter.
      $permission = $params['p'];

      // Define the has_permission_else tag, using Smarty's delimiters.
      $else = $smarty->left_delimiter . 'has_permission_else' . $smarty->right_delimiter;

      // Use PHP's explode function to split the content at the point where the else tag occurs.
      $true_false = explode($else, $content, 2);

      // If explode has worked, the true_false array will contain the 'true' value in position zero.
      $true = (isset($true_false[0]) ? $true_false[0] : null);

      // If there is a 'false' value, this will be contained in position one.
      $false = (isset($true_false[1]) ? $true_false[1] : null);

      // Call user defined function to determine if site user has appropriate permission.
      if(Reg::get('usr')->perms->hasPermission($permission)) {
         return $true;
      }
      else {
         return $false;
      }
      return null;
   } 
}