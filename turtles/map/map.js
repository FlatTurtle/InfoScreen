(function($){

	var view = Backbone.View.extend({
		initialize : function() {
			// bind render event
			this.bind("born", this.render);
			
			// load the google maps api, since google loads their api asynchronously we will 
			// need a timer to check if the api has been loaded.
			$.getScript("http://maps.googleapis.com/maps/api/js?sensor=false&callback=false");
		},
		render : function() {
			var self = this;
			$.get('turtles/map/map.html', function(template) {
				self.el.html($.tmpl(template, {
					location : self.options.location
				})).trigger("rendered");
				
				// check if the google api is ready
				self.checkReady();
			});
		},
		checkReady : function() {
			var self = this;
			
			// render the map if the google object exists
			if(typeof(google) == 'object' && typeof(google.maps) == 'object') {
				self.renderMap();
			}
			// otherwise, check again later
			else {
				var t = setTimeout(function() { self.checkReady(); }, 1000);
			}
		},
		renderMap : function() {
			console.log(this);
			console.log(google);
			
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
						map : map,
						position : results[0].geometry.location
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