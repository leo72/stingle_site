/**
 * JS for submit form, and add action (delete selected or export selected)
 * And Check all checkbox 
 */

$(document).ready(function(){
	
	$("#delete").click(function(){
		$("#constantsForm").attr('action', "{'lang_editor/action:delete'|glink}").submit();
		return false;
	});
	
	$("#export").click(function(){
		$("#constantsForm").attr('action', "{'lang_editor/export'|glink}").submit();
		return false;
	});
		
	$("#checkAll").click(function()	{
		var checked_status = this.checked;
		$("input[type='checkbox']").attr('checked', checked_status);
	});
});