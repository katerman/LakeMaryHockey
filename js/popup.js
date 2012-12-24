$(function(){

	var dg = $('<div id="dialog1">If you have a payment question, email lakemaryhockey@gmail.com</div>').dialog({
		modal:true,
		resizable:false,
		title: 'Payment',
		autoOpen: false,
		buttons: {
			"Ok":function(){
				$(this).dialog('close')
			}
		}
	});
	
	$('#payment').bind('click', function(){
		dg.dialog('open');
		return false;
	});

});