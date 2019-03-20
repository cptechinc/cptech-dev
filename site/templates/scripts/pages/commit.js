$(function() {
	$('body').on('change', '.commit-check', function() {
		var checkbox = $(this);
		var form = checkbox.closest('form');
		postnotify(form);
	});
	
	$('.placard').on('accepted.fu.placard', function () {
		var placard = $(this);
		var form = placard.closest('form');
		postnotify(form);
	});
});
