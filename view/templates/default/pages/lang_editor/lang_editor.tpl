    <table border=0 cellspacing=0 cellpadding=2>
    	<tr>
            <td style="padding-top:15px;" colspan="5">
				{draw_pager visualPagesCount=10}
			</td>
        </tr>
        <tr>
            <td colspan="5" style="text-align:left;border:0px;">
                &nbsp;<button id="delete">Delet Selected</button>
            </td>
        </tr>
        <tr>
        	<td colspan="5" style="text-align:left;border:0px;">
                &nbsp;<button id="export">Export</button>
            </td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid black;"><input type="checkbox" id="checkAll">&nbsp;</td>
            <td style="border-bottom:1px solid black;">KEY</td>
            <td style="border-bottom:1px solid black;">VALUE</td>
            <td style="border-bottom:1px solid black;">LANGUAGE</td>
			<td style="border-bottom:1px solid black;">TYPE</td>
            <td style="border-bottom:1px solid black;text-align:right;">ACTION</td>
        </tr>
        <form method="POST" action="" id="constantsForm">
        <input type="hidden" name="fkey" value="{$formKey->getKey()}">
		{foreach from=$lang_constants item=const}
        <tr>
            <td style="border-bottom:1px solid black;">
                <input type="checkbox" name="ids['{$const.id}:{$const.lang_id}']" value="{$const.id}:{$const.key}:{$const.lang_id}" />
            </td>
            <td style="border-bottom:1px solid black;">{$const.key}</td>
            <td style="border-bottom:1px solid black;" width="500">{$const.value}</td>
            <td style="border-bottom:1px solid black;">{$const.lang_name}</td>
			<td style="border-bottom:1px solid black;">{$const.type|const_type}</td>
            <td style="border-bottom:1px solid black;">
                <a href= "{"lang_editor/edit/key:`$const.key`/lang_id:`$const.lang_id`"|glink}">edit</a> | 
				<a href = "{"lang_editor/action:delete/key:`$const.key`/lang_id:`$const.lang_id`"|cat:'/fkey:'|cat:$formKey->getKey()|glink}">delete</a>
            </td>
        </tr>
		{/foreach}
		 </form>
		<tr>
            <td style="padding-top:15px;" colspan="5">
				{draw_pager visualPagesCount=10}
			</td>
        </tr>
		
    </table>