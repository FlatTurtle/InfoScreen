(function($){
	
	var view = Backbone.View.extend({
		initialize : function() {
			// bind render event
			this.bind("born", this.render);
			
			// render map when api is loaded
			this.bind("mapsReady", this.renderMap);
			
			// are we already loading the google maps api?
			if(typeof(window.mapsReady) == "undefined") {
				window.mapsReady = false;
				$.getScript("http://maps.googleapis.com/maps/api/js?sensor=false&callback=mapsLoaded");
			}
		},
		render : function() {
			var self = this;
			$.get('turtles/map/map.html', function(template) {
				self.el.html($.tmpl(template, {
					location : self.options.location
				})).trigger("rendered");
				
				// is the google api ready? else wait untill the mapsReady trigger is activated
				if(window.mapsReady) {
					self.renderMap();
				}
			});
		},
		renderMap : function() {
			// the canvas container
			var canvas = this.el.find("#canvas")[0];
			
			// api options
			var options = {
				zoom : this.options.zoom || 12,
				disableDefaultUI: true,
				mapTypeId : google.maps.MapTypeId.ROADMAP
			};
			
			var map = new google.maps.Map(canvas, options);
			
			// get the coordinates of the location
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({
				"address" : this.options.location
			}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					map.setCenter(results[0].geometry.location);
					
					var marker = new google.maps.Marker({
			            map: map,
			            position: results[0].geometry.location
			        });
				}
			});
			
			// add traffic layer
			var trafficLayer = new google.maps.TrafficLayer();
			trafficLayer.setMap(map);
		}
	});
	
	// register turtle
	Turtles.register("map", {
		view : view
	});
	
})(jQuery);

// callback when the google maps api is ready
if (typeof mapsLoaded != 'function') {
	function mapsLoaded() {
		window.mapsReady = true;
		
		// trigger for all map turtles
		Turtles.trigger("map", "mapsReady");
	}
}