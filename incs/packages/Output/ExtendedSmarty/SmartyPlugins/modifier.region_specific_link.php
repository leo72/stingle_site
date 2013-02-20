<?php
function smarty_modifier_region_specific_link($region_id, $rel_id = null){
	return getRegionSpecificLink($region_id, $rel_id);
}
