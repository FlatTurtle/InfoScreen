(function($){
	
	var view = Backbone.View.extend({

		// map object
		map : null,

		initialize : function() {
			// bind render event
			this.bind('born', this.render);
		},
		render : function() {
			var self = this;
			$.get('turtles/osm/map.html', function(template) {
				var data = {
					location : self.options.location,
					i18n : self.options.i18n
				};
				
				self.$el.html($.tmpl(template, data));
				
				// display map
				self.renderMap();
			});
		},
		renderMap : function() {
			var self = this;
			
			this.map = new L.Map('canvas', {
				minZoom: 10,
				zoom: 12
			});

			wax.tilejson('http://api.tiles.mapbox.com/v3/mapbox.mapbox-streets.jsonp', function(tilejson) {
				self.map.addLayer(new wax.leaf.connector(tilejson));
				self.map.setView(new L.LatLng(38.9, -77.035), 15);
			});
		}
	});
	
	// register turtle
	Turtles.register('osm', {
		view : view
	});
	
})(jQuery);