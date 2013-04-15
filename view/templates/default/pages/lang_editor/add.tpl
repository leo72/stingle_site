<form action="{'lang_editor/add/action:add'|glink}" method="post">
	<input type="hidden" name="formKey" value="{$formKey->getKey()}">
	<table>
		<tr>
			<td align="right">key: </td>
			<td><input type="text" name="key" {if isset($smarty.post.key)}value="{$smarty.post.key}"{/if} size="30"></td>
		</tr>
		<tr>
			<td align="right">value: </td>
			<td><textarea name="value" rows="6" cols="40">{if isset($smarty.post.value)}{$smarty.post.value}{/if}</textarea></td>
		</tr>
		<tr>
			<td align="right">lang: </td>
			<td>
			<select name="lang">
			{foreach from=$languages item=language}
				<option value="{$language->id}" {if isset($smarty.post.lang) and ($smarty.post.lang == $language->id)}selected{/if}>
					{$language->longName}
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
				<option value="{$type}" {if isset($smarty.post.type) and ($smarty.post.type == $type)}selected{/if}>
					{$type|const_type}
				</option>
			{/foreach}
			</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="Add" name="add"></td>
		</tr>
	</table>
</form>