<?php
/**
 * Draw Pager
 *
 * @param [$user_id]
 * @param [$show_only]
 * @return string
 */
function smarty_function_draw_profile($params, &$smarty){
	extract($params);
	
	if(!isset($user_id) or empty($user_id)){
		$user_id = 0;
	}
	
	$profile = new UserProfile($user_id);
	$profs = $profile->get_answers();
	
	$ret_str='';
	
	if(empty($show_only)){
		foreach ($profs as $question => $val){
			$ret_str .= '<tr>
							<td align="right" class="mid">'.Reg::get('lm')->getValueOf($question).'</td>
							<td height="23">';
			if($val["type"]==Profile::TYPE_SINGLE){
				$ret_str .= '<select name="answers[]" class="select">
								<option value="">-&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;</option>';
				foreach ($val["answers"] as $answer){
					$ret_str .= '<option value="'.$answer["id"].'"'.($answer["is_selected"]==1 ? " selected" : "").'>'.Reg::get('lm')->getValueOf($answer["value"]).'</option>';
				}
				$ret_str .= '</select>';
			}
			elseif($val["type"]==Profile::TYPE_MULTIPLE){
				foreach ($val["answers"] as $answer){
					$ret_str .= '<input type="checkbox" name="answers[]" value="'.$answer["id"].'"'.($answer["is_selected"]==1 ? " checked" : "").'>&nbsp;<span class="grey">'.Reg::get('lm')->getValueOf($answer["value"]).'</span><br>';
				}
			}
			$ret_str.='</td></tr>';
		}
	}
	else{
		foreach ($profs as $question => $val){
			$answers = '';
			
			if($val["type"]==Profile::TYPE_SINGLE){
				foreach ($val["answers"] as $answer){
					if($answer["is_selected"]==1){
						$answers = Reg::get('lm')->getValueOf($answer["value"]);
					}
				}
			}
			elseif($val["type"]==Profile::TYPE_MULTIPLE){
				$filled_answers = array();
				foreach ($val["answers"] as $answer){
					if($answer["is_selected"]==1){
						array_push($filled_answers, Reg::get('lm')->getValueOf($answer["value"]));
					}
				}
				if(count($filled_answers)){
					$answers = implode(", ", $filled_answers);
				}
			}
			
			if(!empty($answers)){
				$ret_str .= '<tr>
								<td class="mid">'.Reg::get('lm')->getValueOf($question).'</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td class="mid">' . $answers . '</td>
							</tr>';
			}
			
		}
	}
	
	return $ret_str;
}
