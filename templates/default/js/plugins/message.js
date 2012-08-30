var Message = {

	element : $("#message"),
	timer : null,

	add : function(text, duration) {
		// default duration
		if (duration == undefined)
			duration = 30000;
		
		// check if message element exists
		if (Message.element.length == 0) {
			Message.element = $('<div id="message"><span class="color"></span></div>').hide();
			$("body").prepend(Message.element);
		}
		
		// show
		var span = Message.element.find("span");
		span.html(text);
		
		Message.element.fadeIn();
		span.css("margin-top", "-" + (span.height()/2) + "px");
		
		// remove
		if (duration != 0) {
			clearTimeout(Message.timer);
			Message.timer = setTimeout(Message.remove, duration);
		}
	},

	remove : function() {
		// hide message
		Message.element.fadeOut();
	},

	destroy : function() {
		// remove element
		Message.element.remove();
	}

};