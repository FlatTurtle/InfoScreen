(function() {

	// container for turtles
	var rootElement = "#main";
	var columns = 0;

	/*
	 * We are extending the main turtles class with a specific grow function for
	 * our situation. This grow function will automatically load the correct
	 * turtle and create a placeholder.
	 */
	TurtleManager.prototype.grow = function(id, options) {
		if (options == null || typeof options != "object") {
			options = {};
		}

		// default group is the turtle's name. if a manual group name is passed,
		// the turtle will be grouped in a different placeholder class
		if (!options.group) {
			options.group = id;
		}
		
		// default colspan width
		if (!options.colspan) {
			options.colspan = 1;
		}

		// check if the group needs to be created
		var group = $("section.group#" + options.group);
		if (group.length == 0) {
			group = $('<section class="group" id="' + options.group + '" data-colspan="' + options.colspan + '"></section>');
			
			// add group colspan to total columns
			columns += parseInt(options.colspan);
			
			$(rootElement).append(group);
			
			// update all group widths calculated from the new total columns
			$("section.group").each(function() {
				var colspan = $(this).data("colspan");
				$(this).width(((100 / columns) * colspan) + "%");
			});
		}
		
		// create placeholder and append it to the group
		options.el = $('<div class="turtle"></div>');
		$(group).append(options.el);
		
		// if a turtle does not have a source, still do a last effort
		if (!options.source)
			options.source = 'turtles/' + id + '/' + id + '.js';

		if (!this.registered(id)) {
			var self = this;
			// load turtle javascript
			$.ajax({
				url : options.source,
				dataType : 'script',
				async : false, // to prevent duplicate javascript file loading
				success : function() {
					self.instantiate(id, options);
				}
			});
		} else {
			this.instantiate(id, options);
		}
	}

	// register the Turtles object on the global namespace
	if (!((global = typeof exports !== "undefined" && exports !== null ? exports : window).Turtles != null)) {
		global.Turtles = new TurtleManager();
	}

})();