<input type="button" onclick="document.location='{"lang_editor/log/action:clear_log/key:"|cat:$formKey->getKey()|glink}'" value="Clear Log" /><br /><br />
{foreach from=$qlog item=log_row}
	{$log_row};<br />
{/foreach}