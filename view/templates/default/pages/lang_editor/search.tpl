<form action="{'lang_editor/search/do:search'|glink}" method="get">
	<input type="hidden" name="module" value="lang_editor" />
	<input type="hidden" name="page" value="search" />
	<input type="hidden" name="do" value="search" />
	<table>
		<tr>
			<td align="right">key: </td>
			<td><input type="text" name="key" {if isset($smarty.post.key)}value="{$smarty.post.key}"{/if} size="30"></td>
		</tr>
		<tr>
			<td align="right">value: </td>
			<td><input type="text" name="value" {if isset($smarty.post.value)}value="{$smarty.post.value}"{/if} size="30"></td>
		</tr>
		<tr>
			<td align="right">lang: </td>
			<td>
			<select name="lang">
				<option value="0">----</option>
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
				<option value="0">----</option>
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
			<td><input type="submit" value="Search" name="search"></td>
		</tr>
	</table>
</form>