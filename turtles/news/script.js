var first = 0;
var speed = 1000;
var pause = 3000;

function removeFirst() {
	first = $('div#listticker div:first').html();
	/*$('div#listticker div:first').animate({
		opacity : 0
	}, speed).fadeOut('slow', function() {
		$(this).remove();
	});*/
	$('div#listticker div:first').slideUp('slow', function() {
		$(this).remove();
	});
	addLast(first);
}

function addLast(first) {
	last = '<div>' + first + '</div>';
	$('div#listticker').append(last)
	$('div#listticker div:last').animate({
		opacity : 1
	}, speed).fadeIn('slow');
}

interval = setInterval(removeFirst, pause);