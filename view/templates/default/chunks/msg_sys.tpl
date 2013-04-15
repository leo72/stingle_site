<script type="text/javascript">

function msgSystem(params){

    $("<div/>").attr("id", "msg-info").hide().appendTo(document.body);
    $("<div/>").attr("id", "msg-error").hide().appendTo(document.body);

    var dialogButtons = {};
    dialogButtons[params.closeTitle] = function(){
        $(this).html("");
        $(this).dialog('close');
    };

    $('#msg-info,#msg-error').dialog({
        modal: false,
        autoOpen: false,
        resizable: false,
        draggable: true,
        buttons: dialogButtons
    });

    this.addError = function(value){
        $("#msg-error").append(
                $("<div></div>")
                        .addClass("msg-item")
                        .addClass("error")
                        .append(value)
        );
    };

    this.addInfo = function(value){
        $("#msg-info").append(
                $("<div></div>")
                        .addClass("msg-item")
                        .addClass("info")
                        .append(value)
        );
    };

    this.emptyErrors = function(){
        $("#msg-error").html("");
    };

    this.emptyInfo = function(){
        $("#msg-info").html("");
    };

    this.showErrors = function(){
        $("#msg-error").dialog('open');
    };

    this.showInfos = function(){
        $("#msg-info").dialog('open');
    };
}

var infos = new Array();
var errors = new Array();

{foreach from=$error->getAll() item=err}
	errors.push("{$err|escape:javascript}");
{/foreach}
{foreach from=$info->getAll() item=inf}
	infos.push("{$inf|escape:javascript}");
{/foreach}
</script>
{literal}
<script type="text/javascript">
$(document).ready(function(){
	wInfo = new msgSystem({
		closeTitle: 'Close'
	});
	
	if(infos.length){
		$.each(infos, function(index, value) {
			wInfo.addInfo(value);
		});
	}
			
	if(errors.length){
		$.each(errors, function(index, value) {
			wInfo.addError(value);
		});
	}
	
	if(infos.length){
		wInfo.showInfos();
	}
			
	if(errors.length){
		wInfo.showErrors();
	}
})
</script>
{/literal}