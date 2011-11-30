(function($){

	var settings = {
		location : "Gent"
	};

	var view = Backbone.View.extend({
		initialize : function() {
			this.bind("born", this.render);
			
			this.el = $('<section id="map"></section>');
			$("#main").append(this.el);
		},
		render : function() {
			var data = {
				location : settings.location
			};
			
			var el = this.el;

			$.get('turtles/map/map.html', function(template) {
				$(el).html($.tmpl(template, data));
				$(el).trigger("rendered");
			});
		}
	});
	
	// register turtle
	Turtles.grow("map", {
		view : view
	});
	
})(jQuery);