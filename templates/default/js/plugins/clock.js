var Clock = {

	element : $("#clock"),
	timer : null,

	add : function() {
		// check if clock element exists
		if (Clock.element.length == 0) {
			Clock.element = $('<div id="clock" class="color"><span id="hour">00</span><img src="templates/default/img/colon.gif"><span id="minutes">00</span></div>');
			$("body").prepend(Clock.element);
		}

		// start timer if needed
		if (Clock.timer == null) {
			Clock.timer = window.setInterval(Clock.refresh, 500);
		}

		// show element
		Clock.element.show();
	},

	remove : function() {
		// hide clock
		Clock.element.hide();

		// stop timer
		window.clearInterval(Clock.timer);
		Clock.timer = null;
	},

	refresh : function() {
		var now = new Date();
		var hours = now.getHours();
		var minutes = now.getMinutes();

		hours = (hours < 10 ? "0" : "") + hours;
		minutes = (minutes < 10 ? "0" : "") + minutes;

		Clock.element.find("#hour").html(hours);
		Clock.element.find("#minutes").html(minutes);
	},

	destroy : function() {
		// remove element
		Clock.element.empty();
		Clock.element.remove();

		// clear timer
		window.clearInterval(Clock.timer);
		Clock.timer = null;
	}

};

$(document).ready(function() {
	// auto start clock
	Clock.add();
});