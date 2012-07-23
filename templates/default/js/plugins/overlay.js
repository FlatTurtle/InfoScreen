var Overlay = {

	element : $("#overlay"),
	timer : null,

	add : function(url, duration) {
		// default duration
		if (duration == undefined)
			duration = 30000;
		
		// check if overlay element exists
		if (Overlay.element.length == 0) {
			Overlay.element = $('<div id="overlay"></div>');
			$("body").prepend(Overlay.element);
		}
		
		Overlay.element.css("background-image", "url(" + url + ")");
		
		// show element
		Overlay.element.fadeIn();
		
		// remove
		if (duration != 0) {
			clearTimeout(Overlay.timer);
			Overlay.timer = setTimeout(Overlay.remove, duration);
		}
	},

	remove : function() {
		// hide overlay
		Overlay.element.fadeOut();
	},

	destroy : function() {
		// remove element
		Overlay.element.remove();
	}

};