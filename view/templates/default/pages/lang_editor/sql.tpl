<form action="{'lang_editor/sql/action:exec_sql'|glink}" method="POST">
	<input type="hidden" name="key" value="{$formKey->getKey()}">
    <table style="font-family: courier, serif;">
        <tr>
            <td>
                SQL:
            </td>
        </tr>
        <tr>
            <td>
                <font color="gray">
                    //DO NOT FORGET DO <b>BACKUP</b>
                    YOUR DATABASE BEFORE USING THIS *THINGY*
                </font>
            </td>
        </tr>
        <tr>
            <td>
                <textarea id="sql_input_box" name="sql" style="width:750px;;height:300px;">{if isset($smarty.post.sql)}{$smarty.post.sql|htmlspecialchars}{/if}</textarea>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Execute" />&nbsp;<input type="button" value="Reset" onclick="resetForm()"/>
            </td>
        </tr>
        {if isset($errors) and count($errors) > 0}
        <tr>
            <td style="padding-top:15px;">
                SQL execution: 
                <font style="color:red">
                    ERROR
                </font>
            </td>
        </tr>
        {foreach from=$errors item=error}
        <tr>
            <td style="border-top:1px solid black;">
                Error: 
                <font style="color:red">
					{$error.errno|htmlspecialchars}:{$error.error|htmlspecialchars}
                </font>
                <br/>
                Query: 
                <font style="color:green">
					{$error.query|htmlspecialchars}
                </font>
            </td>
        </tr>
        {/foreach}
        {elseif isset($smarty.post.sql) and !empty($smarty.post.sql)}
        <tr>
            <td>
                SQL execution: 
                <font style="color:green">
                    OK
                </font>
            </td>
        </tr>
        {/if}
        {if isset($finished) and count($finished)}
            {foreach from=$finished item=finished_query}
                {if $finished_query.aff_rows != - 1}
                    <tr>
        				<td>
        					Query: {$finished_query.query|htmlspecialchars}<br />
        					Affected Rows: <font style="color:green">{$finished_query.aff_rows}</font>
        				</td>
        			</tr>
                {/if}
            {/foreach}
        {/if}
    </table>
</form>
{literal}
<script>
    function resetForm(){
        document.getElementById('sql_input_box').value = '';
    }
</script>
{/literal}