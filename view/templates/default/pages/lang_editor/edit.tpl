<form action="{"lang_editor/edit/action:save/key:`$smarty.get.key`/lang_id:`$smarty.get.lang_id`"|glink}" method="post">
	<input type="hidden" name="formKey" value="{$formKey->getKey()}">
	<table>
		<tr>
			<td align="right">key: </td>
			<td><input type="text" name="key" value="{$const.key}" size="30"></td>
		</tr>
		<tr>
			<td align="right">value: </td>
			<td><textarea name="value" rows="16" cols="100">{$const.value}</textarea>
			</td>
		</tr>
		<tr>
			<td align="right">lang: </td>
			<td>
				<select name="lang_id">
				{foreach from=$languages item=lang}
					<option value="{$lang->id}" {if ($const.lang_id == $lang->id)}selected{/if}>
						{$lang->longName}
					</option>
				{/foreach}
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">types: </td>
			<td>
			<select name="type">
			{foreach from=$types item=type}
				<option value="{$type}" {if ($const.type == $type)}selected{/if}>
					{$type|const_type}
				</option>
			{/foreach}
			</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
			<input type="hidden" name="old_key" value="{$const.key}">
			<input type="hidden" name="old_lang_id" value="{$smarty.get.lang_id}">
			<input type="hidden" name="back_url" value="{$back_url}">
			<input type="submit" value="Save" name="save">
			</td>
		</tr>
	</table>
</form>