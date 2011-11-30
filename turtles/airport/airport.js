(function($) {

	var settings = {
		code : "BRU",
		direction : "departures",
		lang : "en"
	};

	var model = Backbone.Model.extend({});

	var collection = Backbone.Collection.extend({
		initialize : function() {
			this.refresh();

			// bind refresh method to refresh event
			this.bind("refresh", this.refresh);
		},
		refresh : function() {
			this.fetch({
				data : {
					direction : settings.direction,
					lang : settings.lang
				}
			});
		},
		url : function() {
			// build the remote source url
			return "http://www2.jenssegers.be/datatank/Airports/Liveboard/"
					+ settings.code + ".json";
		},
		parse : function(json) {
			// parse ajax results
			json.Liveboard = json.Liveboard || {
				Liveboard : []
			}

			for ( var i in json.Liveboard) {
				var data = json.Liveboard[i];

				if (data.delay)
					data.delay = this.formatTime(data.time + data.delay);
				else
					data.delay = false;

				data.time = this.formatTime(data.time);
				data.airport = data.direction.name;
				data.type = data.vehicle;
			}

			return json.Liveboard;
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
			_.bindAll(this, 'render');

			this.bind("born", this.render);
			this.collection.bind("reset", this.render);
			
			// create placeholder
			this.el = $('<section id="airport"></section>');
			$("#main").append(this.el);
		},
		render : function() {
			var data = {
				direction : settings.direction,
				boards : [ {
					airport : settings.code,
					entries : this.collection.toJSON()
				},
				{
					airport : "TEST",
					entries : this.collection.toJSON()
				}]
			};
			
			var el = this.el;

			$.get('turtles/airport/list.html', function(template) {
				$(el).html($.tmpl(template, data)).trigger("rendered");
			});
		}
	});

	// register turtle
	Turtles.grow("airport", {
		collection : collection,
		view : view,
		model : model
	});

})(jQuery);