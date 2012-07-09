var Pincode = {

	element : $('#pincodewrapper'),

	add : function() {
		// check if clock element exists
		if (Pincode.element.length == 0) {
			Pincode.element = $('<div id=\'pincodewrapper\'><div id="pincode" class="color">123456</div></div>');
			Pincode.element.insertAfter('#clock');
		}

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
;
	}

}
