(function($) {
	
	var collection = Backbone.Collection.extend({
		initialize : function(models, options) {
			// prevents loss of 'this' inside methods
			_.bindAll(this, "refresh");
			
			// bind refresh
			this.bind("born", this.refresh);
			this.bind("refresh", this.refresh);
			
			// default hashtag
			if(!options.hashtag)
				options.hashtag = "flatturtle";
			
			// automatic collection refresh each minute, this will automatically
			// trigger the reset event
			refreshInterval = window.setInterval(this.refresh, 60000);
		},
		refresh : function() {
			this.fetch();
		},
		url : function() {
			// remote source url
			return 'http://data.irail.be/spectql/twitter/search/' + this.options.hashtag + "/results.limit(15):json";
		},
		parse : function(json) {
			return json.spectql;
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
					hashtag : this.options.hashtag,
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
