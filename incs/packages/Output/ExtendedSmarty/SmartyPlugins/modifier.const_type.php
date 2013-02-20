<?php
function smarty_modifier_const_type($int){
	switch ($int){
		case 1:
			return "Site constant";
			break;
		case 2:
			return "Common constant";
			break;
		case 3:
			return "Admin panel constant";
			break;
	}
}
