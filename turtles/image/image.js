(function($){	
    var view = Backbone.View.extend({
	// hold google maps objects
	center : null,

	initialize : function() {
	    // bind render event
	    this.bind("born", this.render);
	},
	render : function() {
	    var self = this;
	    $.get('turtles/image/image.html', function(template) {
		var data = {
		    url : self.options.url,
		    i18n : self.options.i18n
		};
		
		self.$el.html($.tmpl(template, data));
		// notify listeners render completed and pass element
		self.trigger("rendered", self.$el);
	    });
	},
    });
    
    // register turtle
    Turtles.register("image", {
	view : view
    });
    
})(jQuery);

