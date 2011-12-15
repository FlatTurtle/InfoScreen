(function($) {
	
	var model = Backbone.Model.extend({});

	var collection = Backbone.Collection.extend({
		initialize : function(models, options) {
			// prevents loss of 'this' inside methods
			_.bindAll(this, "refresh");
			
			// bind refresh
			this.bind("born", this.refresh);
			this.bind("refresh", this.refresh);
			
			// automatic collection refresh each minute, this will automatically
			// trigger the reset event
			refreshInterval = window.setInterval(this.refresh, 60000);
		},
		refresh : function() {
			this.fetch({
				/*data : {
					direction : this.options.direction,
					lang : this.options.lang
				}*/
			});
		},
		url : function() {
			// remote source url
			return 'http://data.irail.be/NMBS/Liveboard/' + this.options.location + '.json'
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
				data.direction = data.direction;
				data.platform = data.platform.name;
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

			// bind render to collection reset
			this.collection.bind("reset", this.render);
			
			// pre-fetch template file and render when ready
			var self = this;
			if(this.template == null) {
				$.get("turtles/nmbs/list.html", function(template) {
					self.template = template;
					self.render();
				});
			}
		},
		render : function() {
			// only render when template file is loaded
			if(this.template) {
				var data = {
					direction : this.options.direction,
					location : this.options.location,
					entries : this.collection.toJSON(),
				};
				
				this.el.html($.tmpl(this.template, data)).trigger("rendered");
			}
		}
	});

	// register turtle
	Turtles.register("nmbs", {
		collection : collection,
		view : view,
		model : model
	});

})(jQuery);
