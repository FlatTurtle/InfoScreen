(function($) {

	var view = Backbone.View.extend({
		first: 0,
		speed: 1000,
		pause: 3000,
		refreshInterval:'',
		
		resize: function(){
        	var self = this;
			var textSpan = $('div#listticker div');
			var textdiv = $('div#listticker');

	        //textSpan.style.fontSize = 64;
			var font = 64;
			textSpan.css('font-size','64pt');
			if(textSpan.height() == '0'){
				return false;
			}
	        while(textSpan.height() > textdiv.height())
	        {
	        		font--;
	                textSpan.css('font-size',font+'pt');
	        }
	        window.clearInterval(this.refreshInterval);
	        return true;
		},

		/*removeFirst : function() {
			var self = this;
			first = $('div#listticker div:first').html();
			$('div#listticker div:first').slideUp('slow', function() {
				$(this).remove();
			});
			this.addLast(first);
		},

		addLast: function(first) {
			last = '<div>' + first + '</div>';
			$('div#listticker').append(last)
			$('div#listticker div:last').animate({
				opacity : 1
			}, this.speed).fadeIn('slow');
		},*/
		
		initialize : function() {
			//bind this to all functions so it keeps track of this
			_.bindAll(this);
			
			// bind render event
			this.bind("born", this.render);
			this.refreshInterval = window.setInterval(this.resize, 100);
			
			//if(this.options.speed != null) this.speed = this.options.speed;
			//if(this.options.speed != null) this.pause = this.options.pause;
			

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
				var div = $('<div></div>').html(str);
				$('div#listticker').append(div);
				//resize();
				//$('div#listticker div').watch("display,visibility", function() { alert('visible') });
				//interval = setInterval(self.removeFirst, self.pause);
			});
		}
	});

	// register turtle
	Turtles.register("news", {
		view : view
	});

})(jQuery);
