(function($) {

	// not necessary, only used as backbone example
	var model = Backbone.Model.extend({});

	var collection = Backbone.Collection.extend({
		initialize : function(models, options) {
			// prevents loss of 'this' inside methods
			_.bindAll(this, "refresh");

			// bind refresh
			this.bind("born", this.refresh);
			this.bind("refresh", this.refresh);

			// default error value
			options.error = false;

			// automatic collection refresh each minute, this will 
			// trigger the reset event
			refreshInterval = window.setInterval(this.refresh, 60000);
		},
		refresh : function() {
			var self = this;
			self.fetch({
				data : {
				},
				error : function() {
					// will allow the view to detect errors
					self.options.error = true;
					
					// if there are no previous items to show, display error message
					if(self.length == 0)
						self.trigger("reset");
				}
			});
		},
		url : function() {
			var today = new Date();
			var month = today.getMonth() + 1;
			var day = today.getDate();
			var year = today.getFullYear();
			var minutes = today.getMinutes();
			var hours = today.getHours();

			if (minutes < 10)
				minutes = "0" + minutes;

			if (hours < 10)
				hours = "0" + hours;

			if (month < 10)
				month = "0" + month;

			if (day < 10)
				day = "0" + day;

			var query = this.options.location + "/" + year + "/" + month + "/" + day + "/" + hours + "/" + minutes;

			// remote source url
		        //Todo: add departures or arrivals
			return "http://data.irail.be/spectql/Airports/Liveboard/" + query + "departures:json";
		},
		parse : function(json) {
			// parse ajax results
			var liveboard = json.departures || json.arrivals;

			// everything ok
			if (liveboard)
				this.options.error = false;

			if (!this.options.airport)
				this.options.airport = json.Liveboard.location.name;

			for ( var i in liveboard) {
				liveboard[i].delay = liveboard[i].delay ? this.formatTime(liveboard[i].time + liveboard[i].delay) : false;
				liveboard[i].time = this.formatTime(liveboard[i].time);
			}

			return liveboard;
		},
		formatTime : function(timestamp) {
			var time = new Date(timestamp * 1000);
			var hours = time.getHours();
			var minutes = time.getMinutes();
			return (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') + minutes;
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
			if (this.template == null) {
				$.get("turtles/airport/list.html", function(template) {
					self.template = template;
					self.render();
				});
			}
		},
		render : function() {
			// only render when template file is loaded
			if (this.template) {
				var data = {
					direction : this.options.direction || "departures",
					airport : this.options.airport || this.options.location,
					entries : this.collection.toJSON(),
					error : this.options.error // have there been any errors?
				};

				this.el.html($.tmpl(this.template, data)).trigger("rendered");
			}
		}
	});

	// register turtle
	Turtles.register("airport", {
		collection : collection,
		view : view,
		model : model
	});

})(jQuery);