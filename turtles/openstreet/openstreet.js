(function($) {

	var settings = {
		location : "Gent"
	};

	var view = Backbone.View.extend({
		initialize : function() {
			this.bind("born", this.render);

			this.el = $('<section id="openstreet"></section>');
			$("#main").append(this.el);

			$.getScript("http://ol.openstreet.nl/OpenLayers.js", function() {
				console.log("loaded");
				
				var lat = 50.85;
				var lon = 4.6;
				var zoom = 9;

				// complex object of type OpenLayers.Map
				var map = new OpenLayers.Map('map');
				var layerTileNL = new OpenLayers.Layer.OSM("OpenStreetMap", "http://tile.openstreetmap.nl/tiles/${z}/${x}/${y}.png", { numZoomLevels : 19 });

				map.addLayers([layerTileNL]);
				
				if (!map.getCenter()) {
					map.setCenter(new OpenLayers.LonLat(lon, lat).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject()), zoom);
				}
			});

		},
		render : function() {
			var data = {
				location : settings.location
			};

			var el = this.el;

			$.get('turtles/openstreet/map.html', function(template) {
				$(el).html($.tmpl(template, data));
				$(el).trigger("rendered");
			});
		}
	});

	// register turtle
	Turtles.register("openstreet", {
		view : view
	});

})(jQuery);