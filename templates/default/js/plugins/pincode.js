var Pincode = {

	element : $('#pincode'),

	add : function(code) {
		// check if clock element exists
		if (Pincode.element.length == 0) {
			Pincode.element = $('<div id="pincode" class="color"></div>');
			Pincode.element.insertAfter('#clock');
		}
		
        Pincode.element.text(code);

		// show element
		Pincode.element.show();
	},

	remove : function() {
		// hide clock
		Pincode.element.hide();
	},

	destroy : function() {
		// remove element
		Pincode.element.empty();
		Pincode.element.remove();
	}

};
