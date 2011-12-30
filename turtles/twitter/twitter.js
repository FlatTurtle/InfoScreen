(function($) {
	
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
				data : {
					q : this.options.hashtag  || "flatturtle"
				}
			});
		},
		url : function() {
			// remote source url
			return 'http://data.irail.be/feeds/twitter/' + this.options.hashtag + ".json";
		},
		parse : function(json) {
			// parse ajax results
			var liveboard = json.results;

			for (var i in liveboard) {
				liveboard[i].time = this.formatTime(liveboard[i].created_at);
			}
			
			return liveboard;
		},
		formatTime : function(timestamp) {
			return timestamp;
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
				$.get("turtles/twitter/list.html", function(template) {
					self.template = template;
					self.render();
				});
			}
		},
		render : function() {
			// only render when template file is loaded
			if(this.template) {
				var data = {
					station : this.options.hashtag,
					entries : this.collection.toJSON(),
				};
				
				this.el.html($.tmpl(this.template, data)).trigger("rendered");
			}
		}
	});

	// register turtle
	Turtles.register("twitter", {
		collection : collection,
		view : view
	});

})(jQuery);
