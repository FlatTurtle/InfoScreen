(function($) {

	var view = Backbone.View.extend({
		initialize : function() {
			// bind render event
			this.bind("born", this.render);

		},
		render : function() {
			var self = this;
			// self.$el.html('hello');
			$.get('turtles/news/news.html', function(template) {
				var data = {
					i18n : self.options.i18n
				};

				self.$el.html($.tmpl(template, data));
				var str = self.options.info;
				str = '<div>'+ str;
				str = str.replace(/\./g,"<br><br></div><div>");
				if(str.charAt(str.length-1) == '>') str+='</div>';
				$('div#listticker').html(str);

				// notify listeners render completed and pass element
				// self.trigger("rendered", self.$el);
			});
		}
	});

	// register turtle
	Turtles.register("news", {
		view : view
	});

})(jQuery);
