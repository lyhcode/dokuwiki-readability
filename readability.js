$(function() {
	$('#dokuwiki__toc').dialog({
		width: '60%',
		modal: true,
		autoOpen: false,
		resizable: false
	});
	$('#dokuwiki__aside').dialog({
		width: '60%',
		modal: true,
		autoOpen: false,
		resizable: false
	});
	$('#dokuwiki__toc a').click(function() {
		$('#dokuwiki__toc').dialog('close');
	});
	$('#button-toc').click(function() {
		$('#dokuwiki__toc').dialog('open');
		$('#dokuwiki__toc').dialog('option', 'position', 'center');
		return false;
	});
	$('#button-menu').click(function() {
		$('#dokuwiki__aside').dialog('open');
		$('#dokuwiki__aside').dialog('option', 'position', 'center');
		return false;
	});
});
