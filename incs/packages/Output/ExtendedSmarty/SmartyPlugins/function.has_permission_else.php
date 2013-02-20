<?php
function smarty_function_has_permission_else($params, &$smarty)
{
   // Define and insert the has_permission_else tag, using Smarty's delimiters.
   // With standard Smarty delimiters, this will insert:
   // {has_permission_else}
   // into the content received by the block function.
   return $smarty->left_delimiter . 'has_permission_else' . $smarty->right_delimiter;
} 