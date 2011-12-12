(function($) {
	
	var model = Backbone.Model.extend({});

	var collection = Backbone.Collection.extend({
		initialize : function() {
			// prevents loss of 'this' inside methods
			_.bindAll(this, "refresh");
			
			// bind refresh
			this.bind("born", this.refresh);
			this.bind("refresh", this.refresh);
			
			// automatic collection refresh
			refreshInterval = window.setInterval(this.refresh, 60000);
		},
		refresh : function() {
			// NOTE: this.options is only available after the born event is triggered
			this.fetch({
				data : {
					direction : this.options.direction,
					lang : this.options.lang
				}
			});
		},
		url : function() {
			// build the remote source url
			return "http://data.irail.be/Airports/Liveboard/"
					+ this.options.code + ".json";
		},
		parse : function(json) {
			// parse ajax results
			var liveboard = json.Liveboard.departures || json.Liveboard.arrivals;

			for ( var i in liveboard) {
				var data = liveboard[i];

				if (data.delay)
					data.delay = this.formatTime(data.time + data.delay);
				else
					data.delay = false;

				data.time = this.formatTime(data.time);
				data.airport = data.direction;
				data.type = data.vehicle;
			}
			
			return liveboard;
		},
		formatTime : function(timestamp) {
			var time = new Date(timestamp * 1000);
			var hours = time.getHours();
			var minutes = time.getMinutes();
			return (hours < 10 ? '0' : '') + hours + ':'
					+ (minutes < 10 ? '0' : '') + minutes;
		}
	});

	var view = Backbone.View.extend({
		initialize : function() {
			// prevents loss of 'this' inside methods
			_.bindAll(this, "render");

			// bind render
			this.bind("born", this.render);
			this.collection.bind("reset", this.render);
		},
		render : function() {
			var data = {
				direction : this.options.direction,
				airport : this.options.code,
				entries : this.collection.toJSON()
			};
			
			var self = this;
			$.get("turtles/airport/list.html", function(template) {
				self.el.html($.tmpl(template, data)).trigger("rendered");
			});
		}
	});

	// register turtle
	Turtles.register("airport", {
		collection : collection,
		view : view,
		model : model
	});

})(jQuery);
