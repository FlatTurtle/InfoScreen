(function($){

	var view = Backbone.View.extend({
		initialize : function() {
			// bind render event
			this.bind("born", this.render);
		},
		render : function() {
			var self = this;

			$.get('turtles/map/map.html', function(template) {
				self.el.html($.tmpl(template, {
					location : self.options.location
				}));
				self.el.trigger("rendered");
			});
		}
	});
	
	// register turtle
	Turtles.register("map", {
		view : view
	});
	
})(jQuery);