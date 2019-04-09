// Well hello there. Looks like we don't have any Javascript.
// Maybe you could help a friend out and put some in here?
// Or at least, when ready, this might be a good place for it.
$(function() {
	$('[data-toggle="tooltip"]').tooltip();
	init_datepicker();
});

function init_datepicker() {
	$('.datepicker').each(function(index) {
		$(this).datepicker({
			date: $(this).find('.date-input').val(),
			allowPastDates: true,
		});
	});
}
