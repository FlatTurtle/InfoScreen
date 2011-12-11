(function($) {

	/*
	 * We are extending the main turtles class with a specific grow function for
	 * our situation. This grow function will automatically load the correct
	 * turtle and create a placeholder.
	 */
	TurtleManager.prototype.grow = function(id, options) {
		if (options == null || typeof options != "object")
			options = {};

		// create placeholder
		options.el = $('<section class="' + id + '"></section>');
		$("#main").append(options.el);

		if (!this.registered(id)) {
			var self = this;
			// load turtle script
			$.ajax({
				url : 'turtles/' + id + '/' + id + '.js',
				dataType : 'script',
				async : false, // for now
				success : function() {
					self.instantiate(id, options);
				}
			});
		} else {
			this.instantiate(id, options);
		}
	}

	// register on global namespace
	if (!((global = typeof exports !== "undefined" && exports !== null ? exports
			: window).Turtles != null)) {
		global.Turtles = new TurtleManager();
	}

	Turtles.grow("airport", {
		code : "BRU",
		direction : "departures",
		lang : "en"
	});

	Turtles.grow("airport", {
		code : "BRU",
		direction : "arrivals",
		lang : "en"
	});

	Turtles.grow("map", {
		location : "Gent"
	});
	
})(jQuery);