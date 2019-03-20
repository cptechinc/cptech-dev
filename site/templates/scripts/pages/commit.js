$(function() {
	$('body').on('change', '.commit-check', function() {
		var checkbox = $(this);
		var form = checkbox.closest('form');
		postnotify(form);
	});
});
