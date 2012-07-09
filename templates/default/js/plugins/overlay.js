var Overlay = {

	element : $('#overlay'),

	add : function(url) {
		// check if overlay element exists
		if (Overlay.element.length == 0) {
			Overlay.element = $('<div id="overlay"></div>');
			$('body').prepend(Overlay.element);
		}
		
		Overlay.element.css('background-image', 'url(' + url + ')');
		
		// show element
		Overlay.element.show();
	},

	remove : function() {
		// hide overlay
		Overlay.element.hide();
	},

	destroy : function() {
		// remove element
		Overlay.element.remove();
	}

};