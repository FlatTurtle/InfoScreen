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
				$('div#listticker').html('<div>As from the 20th of August we would like to welcome EUROFER as a new tenant to the Cortenbergh 172.</div><div>EUROFER will start its works on the first floor and part of the second floor, we apologize in case of any inconvenience and we thank you for your understanding. <p></p></div><div>Nous souhaitons la bienvenue à EUROFER, nouveau locataire du bâtiment Cortenbergh 172 à partir du 20 août.</div><div>EUROFER entamera ses travaux d’aménagements au premier étage et sur une partie du deuxième étage.</div><div>Nous vous prions de bien vouloir nous excuser des désagréments qui pourraient en résulter et nous vous remercions de votre compréhension. <p></p></div><div>Op 20 augustus heten wij EUROFER van harte welkom in Cortenbergh 172.</div><div>EUROFER zal zijn werken uitvoeren op de 1ste verdieping en een deel van de 2de verdieping.</div>');
				//$('div#listticker').append(self.options.info);

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
